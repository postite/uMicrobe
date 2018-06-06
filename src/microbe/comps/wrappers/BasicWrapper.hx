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
class BasicWrapper<T> implements Microbe<T>{

	 var pr:Dynamic;
	 var fexec:Future<HttpContext->Void>;
	 var fdata:Future<Void->Dynamic>;
	// var fvalid:Future<Array<Void->Dynamic>>;

	public var data:T;
   	//public var mics:Array<Microbe<P>>;
   	public var mic:Class<Microbe<T>>;
   	public var micinstance:Microbe<T>;
   	var formUrl:String;

	public function new(mic:Class<Microbe<T>>,?data:T,?name:String,?classes:Array<String>){

		this.mic=mic;
		this.data=data;
	// this.data=d;
	// this.name=name;
	// this.id="A"+Uuid.create();
	// this.classes= (classes!=null)? classes :['wrapper'];
		//mics=[];

	//populate();

	}

	public function setData(d:T):Microbe<T>{
		data=d;
		populate();
		return this;
	}

	public function render():String{
		populate();
	fexec=Future.sync(micinstance.execute);	
	fdata=Future.sync(micinstance.getData);
    var buf= new StringBuf();

    buf.add('<div class="wrapper">');
    //for (m in mics)
          buf.add(micinstance.render());
      buf.add('<input class="okButt" rel="pushstate" type="submit"></input>');
     buf.add('</div>');
    return buf.toString();

   }
   public function setFormUrl(url:String){
		
		this.formUrl=url;
	}

	private function populate():Microbe<T>{
        //for(a in data){
        return instanciateMicrobe(mic,data);
       // mics.push(dmic);
         
   	}

   private function instanciateMicrobe(inst,params):Microbe<T>{
      micinstance= Type.createInstance(inst,[params]);
      return micinstance;
   }


	public function execute(ctx:HttpContext):Void{
		js.Browser.console.log( "i'm a wrapper");
		#if client
		if(pr==null)
  		pr=pushstate.PushState.addPreventer(onState);
		// executes microbe children
		fexec.handle(function(fun:HttpContext->Void)
			fun(ctx)
			
			);
		//PushState.addPreventer(onState);
		 var but=js.Browser.document.querySelector('.okButt');
		 if(but!=null)
		 but.addEventListener("click",gatherData);
		#end
	}

	public function getData():T{
		return null;
	}
	
	public function validate(err:Map<String,String>,name:String):Void{}

	 public function gatherData():T{
		// var formule:Formule = new Map();
		var dat:T;
		 fdata.handle(function(fun:Void->Dynamic)
		 	 dat=fun()
		 	);
		// return formule;
		// 
		js.Browser.console.log("basicwrapper url="+dat);
		return cast  {v:"v",n:"n"};
	}

	function onState(url:String,state:Dynamic):Bool{
		js.Browser.console.log("basicwrapper url="+url);
		// var formule=gatherData();
		// //var xstate={};
		// for ( f in formule.keys()){
		// 	Reflect.setField(state,f,formule.get(f));
		// }
		// state.serializeStatePostData();
		// untyped console.log(state);
		// #if client
		// pushstate.PushState.removePreventer(pr);
  //     	pr=null;
  //     	#end
      	
		return true;
	}

	
	




}