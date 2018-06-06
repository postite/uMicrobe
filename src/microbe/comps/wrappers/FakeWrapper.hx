package microbe.comps.wrappers;
using tink.CoreApi;
import ufront.MVC;
import microbe.Microbe;

using microbe.comps.wrappers.WrapperTools;
class FakeWrapper<T:Formule>  extends Wrapper<T>  implements microbe.IMicrobeWrapper<T>
{
	
	var mics:Array<Microbe<Dynamic>>;
	// var fexec:Future<Array<HttpContext->Void>>;
	// var fdata:Future<Array<Void->Dynamic>>;
	// var fvalid:Future<Array<ValidDs>>;
	var injector:minject.Injector;
var okButton:microbe.comps.atoms.OkButton<{v:String,?n:String,?type:String}>;
	var deleteButton:microbe.comps.atoms.OkButton<{v:String,?n:String,?type:String}>;
	var ctx:HttpContext;
	public function new(d:T,?classes:Array<String>){	
	super(d);

	//this.ctx=ctx;
	//injector= ctx.injector;
	}
	
	
	override public function render():String{
		var xarray = [];
				var buf= new StringBuf();
			buf.add('<div ${getId()} ${getClasses()} >');
		for (field in data.keys() ){
			if (field=="model")continue;
			var comp= data.get(field).comp;
			var data= data.get(field).data;
			var mic:Microbe<T>;
			
			mic= cast microbe.FormGenerator.instanciateComp(comp,{v:data,n:field},field);
			
			buf.add(mic.render());

			
			
			
			//storing execution in a Future;
			
			xarray.push(mic);	//execute
			      //validation
			
			
		}
		
		mics = xarray;//Future.ofMany(xarray);
	
		
		
		okButton=
		new microbe.comps.atoms.OkButton({v:"ok",type:"Submit",n:"submit"},["okbutt"]);
		buf.add(okButton.render());
		deleteButton= new microbe.comps.atoms.OkButton({v:"efface",type:"button",n:"submit"},["delbutt"]);
		buf.add(deleteButton.render());
		buf.add('</div>');
		return buf.toString();
		
	}

	

	public function test():String {
		#if js untyped console.log ("gather");#end
		return "hep";
	}
	public function execute(ctx:HttpContext):Void {
		#if client untyped console.log ("execute");
injector= ctx.injector;
		var xarray = [];
		var darray = [];
		var varray= [];
			for( mic in fmics){
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

		 var but=js.Browser.document.querySelector("#"+okButton.id +" input.okbutt");

		 var del=js.Browser.document.querySelector("#"+deleteButton.id +" input.delbutt");
		untyped console.log("but="+okButton.id + but);
		// if(but!=null)
		 but.addEventListener("click",function (e) {gatherData();e.preventDefault();});
		 del.addEventListener("click",function (e) {delete();e.preventDefault();});
	
		 #end
	}
	var valide:Bool=false;
	
	 override public function gatherData():Formule {
			untyped console.log(data);
		var formule:Formule = data;
/*
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
					untyped console.log("recorded");
					case Failure(er):
						//untyped console.log(er.data);
						switch(er.data){
							//err is ValidationErrors.
							case RApiFailure(str,err):
							untyped console.log(str);
							afficheErreur(err);
							validateComps(err);
							case RHttpError( remotingCallString, responseCode, responseData ):
							untyped console.log(remotingCallString +"-"+responseCode);
							case ufront.db.ValidationErrors(err):
							validateComps(err);
							case _: untyped console.log("no idea"+er);

							afficheErreur("erreur "+er.data);
						}
					
						
						
					
					//untyped console.log(r.toMap());
					//validateComps(r);
					valide=false;

				}
			});
			// microbial.recFromFormule(formule).map(function(o){
			// 	untyped console.log("wtf");
			// 	switch(o){
			// 		case Success(s):

			//  		formule.get("model").id=s;
			//  		valide=true;

			//  		case Failure(r):
			//  		untyped console.log("failure"+r);
			//  		//validateComps(r);
			//  		valide=false;

			// 	}
			// });
			untyped console.log("after microbial");
			}
			);
*/
		return formule;

	}
	function delete(){
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
	function afficheErreur(msg:String){
		#if client
			var err= new microbe.comps.molecules.ErrorBox({titre:"OOps !",error:msg,type:null});
			js.Browser.document.querySelector('#$id').appendChild(err.render().asNode());
		#end
	}
}