package microbe.comps.molecules;
import microbe.comps.atoms.*;
import microbe.Microbe;
import microbe.comps.Atom;
import tink.CoreApi;
import microbe.Microbe;
import ufront.MVC;
using StringTools;
using microbe.tools.PostData;
import microbe.IMicrobeWrapper;


class SimpleWrapper<T:Formule> extends Wrapper<T> implements IMicrobeWrapper<T>{

	var pr:Dynamic;
	var fexec:Future<Array<HttpContext->Void>>;
	var fdata:Future<Array<Void->Dynamic>>;
	var fvalid:Future<Array<Void->Dynamic>>;
	override public function render():String{
		var xarray = [];
		var darray = [];
		var varray= [];
		var buf= new StringBuf();

		for (field in data.keys() ){
			if (field=="model")continue;
			var comp= data.get(field).comp;
			var name=data.get(field).name;
			var data= data.get(field).data;
			var mic:Microbe<T>;
			
			mic= cast microbe.FormGenerator.instanciateComp(comp,{v:data,n:field},field);
			buf.add( new Label({v:name}).render());
			buf.add(mic.render());

			//storing execution in a Future;
			xarray.push(Future.sync(mic.execute));	
			darray.push(Future.sync(mic.getData));
			//varray.push(Future.sync(mic.validate));
		}

		fexec = Future.ofMany(xarray);
		fdata=Future.ofMany(darray);
		fvalid=Future.ofMany(varray);

		buf.add(new microbe.comps.atoms.Button({v:"ok",type:"Submit",n:"submit"},["okButt"]).render());
		return buf.toString();
	}

	public function execute(ctx:HttpContext):Void{
		trace( "i'm a wrapper");
		#if client
		if(pr==null)
  		pr=pushstate.PushState.addPreventer(onState);
		// executes microbe children
		fexec.handle(function(t:Array<HttpContext->Void>)
			t.map(function(fun)
			fun(ctx)
			)
			);
		//PushState.addPreventer(onState);
		// var but=js.Browser.document.querySelector('.okButt');
		// if(but!=null)
		// but.addEventListener("click",function (e) {js.Browser.alert("hey" +gatherData());});
		#end
	}


#if client
	override public function gatherData():Formule{
		var formule:Formule = new Map();
		fdata.handle(function(t:Array<Void->Dynamic>)
			t.map(function(fun){
				var k=fun();
				formule.set(k.n,k.v);
				//untyped console.log(fun());
			} )
			);
		return formule;

	}
#end
	function onState(url:String,state:Dynamic):Bool{
		trace("simplewrapper url="+url);
		var formule=gatherData();
		//var xstate={};
		for ( f in formule.keys()){
			Reflect.setField(state,f,formule.get(f));
		}
		state.serializeStatePostData();
		untyped console.log(state);
		#if client
		pushstate.PushState.removePreventer(pr);
      	pr=null;
      	#end
      	
		return true;
	}

	
	




}