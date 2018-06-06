package microbe.comps.wrappers;
using tink.CoreApi;
import ufront.MVC;
import microbe.Microbe;
using microbe.comps.wrappers.WrapperTools;
import microbe.comps.atoms.OkButton;
import microbe.comps.atoms.NopeButton;
import msignal.Signal;

enum Status{
	None;
	Render;
	Exec;
	Rec(id:String);
	Abort;

}
class FormuleWrapper<T:Formule> extends Wrapper<T> implements IMicrobeWrapper<T>{


	var mics:Array<Microbe<Dynamic>>;
	var fexec:Future<Array<HttpContext->Void>>;
	var fdata:Future<Array<Void->Dynamic>>;
	var fvalid:Future<Array<ValidDs>>;
	var injector:minject.Injector;
	var ctx:HttpContext;
	var okButton:OkButton<{v:String,?n:String,?type:String}>;
	var deleteButton:NopeButton<{v:String,?n:String,?type:String}>;

	public var status:Signal1<Status>;

	public function new(d:T,?name:String,?classes:Array<String>){	
	super(d,name,classes);
	status=new Signal1();
	status.dispatch(None);
	}

		override public function render():String{
		mics=  [];

			var buf= new StringBuf();
			buf.add('<div ${getId()} ${getClasses()} >');
		for (field in data.keys() ){
			if (field=="model")continue;
			var comp= data.get(field).comp;
			var data= data.get(field).data;
			var mic:Microbe<T>;
			
			mic= cast microbe.FormGenerator.instanciateComp(comp,{v:data,n:field},field);
			//buf.add( new Label({v:name}).render());
			buf.add(mic.render());
			
			mics.push(mic);	
			      
			
			
		}

		
		okButton=	new OkButton({v:"ok",type:"Submit",n:"submit"},["okbutt"]);
		buf.add(okButton.render());
		deleteButton= new NopeButton({v:"efface",type:"button",n:"submit"},["delbutt"]);
		buf.add(deleteButton.render());
		buf.add('</div>');
		status.dispatch(Render);
		return buf.toString();
		
	}

	public function execute(ctx:HttpContext):Void {
		#if client untyped console.log ("execute");
		me=js.Browser.document.querySelector('#$id');
		this.ctx=ctx;
		injector= ctx.injector;
		var xarray = [];
		var darray = [];
		var varray= [];

			for( mic in mics){
				#if js untyped console.log (mic.data);#end
				var name= mic.name;
				var binded:ValidDs=cast mic.validate.bind(_,name);
			
			//storing execution in a Future;
			
			xarray.push(Future.sync(mic.execute));	//execute
			darray.push(Future.sync(mic.getData)); //data
			varray.push(Future.sync(binded));
			}


		fexec = Future.ofMany(xarray);
		fdata=Future.ofMany(darray);
		fvalid=Future.ofMany(varray);

		fexec.handle(function(t:Array<HttpContext->Void>)
			t.map(function(fun)
			fun(ctx)
			)
			);
		
		 var but=me.querySelector("#"+okButton.id +" input.okbutt");

		 var del=me.querySelector("#"+deleteButton.id +" input.delbutt");
		
		// if(but!=null)
		 but.addEventListener("click",function (e) {gatherData();e.preventDefault();});
		 del.addEventListener("click",function (e) {delete();e.preventDefault();});
	
		 #end
		 status.dispatch(Exec);
	}
	var valide:Bool=false;
	
	 override public function gatherData():Formule {
	 	
			
		var formule:Formule = data;
		
		#if client
		untyped console.log(data);
		fdata.handle(function(t:Array<Void->Dynamic>){
			t.map(function(fun){
				var k=fun();
				
				formule.get(k.n).data=k.v;
				untyped console.log("fun");
			} );
			//formule.get("model").id= 3;
	
			untyped console.log(formule);
			 var microbial=injector.getInstance(microbe.apis.MicrobialApi.MicrobialApiAsync);

			microbial.recFromFormule(formule).handle(function(o){
				untyped console.log("inside");
				switch (o) {
					case Success(s):
					formule.get("model").id=s;
					validateComps(new ufront.db.ValidationErrors());
					valide=true;
					okButton.stateGood();
					status.dispatch(Rec(s));
					untyped console.log("recorded");
					case Failure(er):
						//untyped console.log(er.data);
						status.dispatch(Abort);
						switch(er.data){
							//err is ValidationErrors.
							case RApiFailure(str,err):
							untyped console.log(str);
							me.afficheErreur(err);
							validateComps(err);
							case RHttpError( remotingCallString, responseCode, responseData ):
							untyped console.log(remotingCallString +"-"+responseCode);
							
							case _: untyped console.log("no idea"+er);

							me.afficheErreur("erreur "+er.data);
						}
					
					valide=false;

				}
				
			});
		
			untyped console.log("after microbial");
			}
			);
		#end
		return formule;

	}

	function validateComps(errors:ufront.db.ValidationErrors){
		#if client
		var errorsMap:Map<String,String>=cast errors.toSimpleMap();
		fvalid.handle(function(t:Array<ValidDs>)

			 t.map(function(fun)
			 cast fun(errorsMap,"")
			 )
			);
			#end
	}
		function delete(){
			#if client
		var microbial=injector.getInstance(microbe.apis.MicrobialApi.MicrobialApiAsync);
		 microbial.delete(data).handle(function(o){
		 	
		 	
		 	switch (o) {
					case Success(s):
					deleteButton.stateGood();
					//reload();
					case Failure(f):
					me.afficheErreur(Std.string(f));
				}


		 });
		 #end
		}
		function reload(){
		#if client
		// reload list or default// not this item
		
		pushstate.PushState.push(this.ctx.getRequestUri());
		#end
	}
}