package microbe.comps.wrappers;
import microbe.comps.atoms.*;
import microbe.Microbe;
import microbe.comps.Atom;
import tink.CoreApi;
import microbe.Microbe;
import ufront.MVC;
using StringTools;
//using tools.PostData;
import microbe.IMicrobeWrapper;
class ListWrapper<T:Iterable<P>,P> implements Microbe<T>{

	// var pr:Dynamic;
	// var fexec:Future<Array<HttpContext->Void>>;
	// var fdata:Future<Array<Void->Dynamic>>;
	// var fvalid:Future<Array<Void->Dynamic>>;

	public var data:T;
   	public var mics:Array<Microbe<P>>;
   	public var mic:Class<Microbe<P>>;
   	var formUrl:String;

	public function new(mic:Class<Microbe<P>>,?data:T,?name:String,?classes:Array<String>){

		this.mic=mic;
		this.data=data;
	// this.data=d;
	// this.name=name;
	// this.id="A"+Uuid.create();
	// this.classes= (classes!=null)? classes :['wrapper'];
		mics=[];

	//populate();

	}

	public function setData(d:T):Microbe<T>{
		data=d;
		populate();
		return this;
	}

	public function render():String{
    var buf= new StringBuf();
    buf.add('<div class="wrapper">');
    for (m in mics)
          buf.add(m.render());
      buf.add('<input type="submit"></input>');
     buf.add('</div>');
    return buf.toString();

   }
   public function setFormUrl(url:String){
		
		this.formUrl=url;
	}

	private function populate(){
        for(a in data){
        var dmic=instanciateMicrobe(mic,a);
        mics.push(dmic);
        }     
   	}

   private function instanciateMicrobe(inst,params):Microbe<P>{
      return Type.createInstance(inst,[params]);
   }


	public function execute(ctx:HttpContext):Void{
		// trace( "i'm a wrapper");
		// #if client
		// if(pr==null)
  // 		pr=pushstate.PushState.addPreventer(onState);
		// // executes microbe children
		// fexec.handle(function(t:Array<HttpContext->Void>)
		// 	t.map(function(fun)
		// 	fun(ctx)
		// 	)
		// 	);
		// //PushState.addPreventer(onState);
		// // var but=js.Browser.document.querySelector('.okButt');
		// // if(but!=null)
		// // but.addEventListener("click",function (e) {js.Browser.alert("hey" +gatherData());});
		// #end
	}

	public function getData():T{
		return null;
	}
	public function validate(err:Map<String,String>,name:String):Void{}

	// override public function gatherData():T{
	// 	// var formule:Formule = new Map();
	// 	// fdata.handle(function(t:Array<Void->Dynamic>)
	// 	// 	t.map(function(fun){
	// 	// 		var k=fun();
	// 	// 		formule.set(k.n,k.v);
	// 	// 		//untyped console.log(fun());
	// 	// 	} )
	// 	// 	);
	// 	// return formule;

	// }

	// function onState(url:String,state:Dynamic):Bool{
	// 	trace("simplewrapper url="+url);
	// 	var formule=gatherData();
	// 	//var xstate={};
	// 	for ( f in formule.keys()){
	// 		Reflect.setField(state,f,formule.get(f));
	// 	}
	// 	state.serializeStatePostData();
	// 	untyped console.log(state);
	// 	#if client
	// 	pushstate.PushState.removePreventer(pr);
 //      	pr=null;
 //      	#end
      	
	// 	return true;
	// }

	
	




}