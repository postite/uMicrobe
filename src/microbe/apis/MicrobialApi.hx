package microbe.apis;

import ufront.api.*;
import model.*;
using ufront.core.AsyncTools;
import ufront.db.Object;
import microbe.Microbe;

#if neko
import neko.Web; 
#elseif php
import php.Web;
#end
import tink.CoreApi;
import microbe.MicroSpod.*;
import ufront.remoting.RemotingError;

class MicrobialApi  extends UFApi {
	


	// from microspod
	// static var modelPath:String="model.";


	/// mmh get a post data or xhr ? 
	 function recModel(mod:Class<Object>,data:Dynamic,?id:Int):Dynamic{
		return null;
	}


	public function delete(formule:DataFormule):Surprise<Noise,Error>{

			var modClass=getModelClassFromString(formule.get("model").name);
			var manager= getManager(modClass);
			var spod:ufront.db.Object=null;
			try{
			 spod=manager.get(Std.parseInt(formule.get("model").id));
			 spod.delete();
			 return Noise.asGoodSurprise();
			}catch(msh:Dynamic){
				return Failure(msh).asSurprise();
			}	

			

	}
	#if server
	 function getModel(mod:Class<Object>,?id:Int):Object{


		var formule=getFormule(mod);
		
 		
 		var manager=getManager(mod);
		//var man= Reflect.callMethod(spodable,manager,[]);
			//Manager.cnx = db.connection;
			//
		// works with php but not neko 
		// 

		return  manager.get(id);

		//return manager.get(1);
		
	}
#end

	public function getAllModels(mod:String):Surprise<List<Object>,Error>
	{
		#if server
		ufLog("all muds");
 var modClass= getModelClassFromString(mod);
 var manager=getManager(modClass);
if ( sys.db.TableCreate.exists(manager))
 return  manager.all().asGoodSurprise();
 else
 return new Error("pas de table").asBadSurprise();
#end
return Failure(new Error("server side")).asSurprise();

	}

	
	

	public function recFromFormule(formule:DataFormule):Surprise<String,ufront.db.ValidationErrors>{
				 return SurpriseTools.asSurprise(
				 		 //Success(false)
				 		recFormule(formule)
				 		);
				}
				private function testRecFormule(formule:DataFormule):Outcome<String,ufront.db.ValidationErrors>{
					ufLog(formule);
					var modClass=getModelClassFromString(formule.get("model").name);
			 var manager= getManager(modClass);
			 var spod:ufront.db.Object=null;
			 if (formule.get("model").id!=null)
			  spod=manager.get(formule.get("model").id);
			 else
			 spod=Type.createInstance(modClass,[]);

				

					return Success("yes testRecFormule");
				}
	private function recFormule(formule:DataFormule):Outcome<String,ufront.db.ValidationErrors>{
			ufLog(formule);
			var modClass=getModelClassFromString(formule.get("model").name);
			var manager= getManager(modClass);
			var spod:ufront.db.Object=null;
			if (formule.get("model").id!=null)
			 spod=manager.get(Std.parseInt(formule.get("model").id));
			else
			spod=Type.createInstance(modClass,[]);


			ufLog("afterSpod"+spod.id);
			


			/// proto before using TypeFactory
			for (field in formule.keys()){
				if (field=="model")continue;
					var val:Dynamic=formule.get(field).data;
					
					ufLog(val);
					   
					// if relation
					if(formule.get(field).relation=="many" && val!=null){
						
						ufLog("many");
					 //get MAnager b for MANYto MANY(a,b)
					 var relationmanager=getManager(Reflect.getProperty(spod,field).b);
					
					
					//should be better with an unsafe call in sql
					 //ex get all tags
					 var dependencies= relationmanager.all();
					 ufLog("many manager");
					  var inside=dependencies.filter(function(t)					 	
					 	return  Lambda.has(val,Std.string(t.id)));
					 ufLog("many inside");
					 //fill the spod relation 
					 Reflect.getProperty(spod,field).setList(inside);
					ufLog("many done");
						
					}else if (formule.get(field).relation=="one"){
					ufLog("one");
					 var relationmanager=getManager(getModelClassFullPath(formule.get(field).relationB));
					
					ufLog(relationmanager);
					// //should be better with an unsafe call in sql
					//  //ex get all tags
					//  ufLog("valOne");
					  var dependencie= relationmanager.get(val[0]);
					//  ufLog("one manager");
					//  //  var inside=dependencies.filter(function(t)					 	
					//  // 	return  Lambda.has(val,Std.string(t.id)));
					//  // ufLog("one inside");
					//  //fill the spod relation 
					  Reflect.setProperty(spod,field,dependencie);
					 ufLog("one done");
						//
					}else{
						//why sometimes it makes an array ?
						if (Std.is(val,Array))
					   val=val[0];
				// fill the spod 
				Reflect.setProperty(spod,field,val);
					}
			}

			spod.validate(); // True or false
			ufLog("validate");
			 // [ name=>"name failed validation", password=>"Password must be at least 6 characters long" ]

			try{
			ufLog("before Save");	
			spod.save();
			ufLog("after Save");
			}catch(msg:Dynamic){
			ufLog("error Save  fait une vraie errur ici merde !");
			return Failure (switch(msg){
				//case RemotingError:cast "s";
				case _ :spod.validationErrors;
			});
			// failure not triggered here..
			
			}	
			ufLog("before Success");
			return Success(Std.string(spod.id));
				}

	public  function getDataFormule(mod:String,?id:Int):Surprise<DataFormule,Error>{
		ufLog("getDataFormule");
		var modClass=getModelClassFromString(mod);

		var spod=getModel(modClass,id);

		return getDataFormuleVO(spod).asGoodSurprise();

		
		/*

		for (field in formule.keys()){
			//ufLog(field);
			var data=Reflect.getProperty(spod,field);
			
			if( formule.get(field).relation=="many"){
			continue;	
			var ids=Lambda.array(data.toList()
								.map(
								function(d)
								return Reflect.field(d,formule.get(field).prio))
								);
			
				formule.get(field).data=ids;
				//var tags= Reflect.field(spod,field);
				formule.get(field).dependency=Lambda.array(
					getManager(data.b).all().map(
					function(n){
					var prioField=formule.get(field).prio;
					var prioValue=Reflect.field(n,prioField);
					var inside=ids.indexOf(prioValue)!=-1;

					return {id:n.id,value:prioValue,inside:inside};
				}//end if
					)
					);
				formule.get(field).data=formule.get(field).dependency;
			}else{
				formule.get(field).data=data;
			}
		}
		return formule;
		*/

	}
/*

	// public function  createModelFromString(mod:String,?data:DataFormule):Bool{
	// 	var modClass=getModelClass(mod);
	// 	var manager= getManager(modClass);
	// 	var spod=Type.createInstance(modClass,[]);

	// 	//fillwithDefaults(spod);

	// 	spod.insert();
	// 	return recModelFromString(mod,data,spod.id);
	// }

	
	
*/
	public function recModelFromString(mod:String,?data:DataFormule,?id:Int):Surprise<Int,ufront.db.ValidationErrors>{
			
			//All this stuff is dependant on serialize postData 
			// if (id==null)
			// return createModelFromString(mod,data);
			// not sure it works ... to test
			if (data==null)
			data=Web.getParams();

			ufLog(data);

		
			var modClass=getModelClassFromString(mod);
			var manager= getManager(modClass);
			var spod:ufront.db.Object=null;
			if (id!=null)
			 spod=manager.get(id);
			else
			spod=Type.createInstance(modClass,[]);

			ufLog("afterSpod");
			var formule=getFormule(modClass);


			/// proto before using TypeFactory
			for (field in formule.keys()){
					var val=data.get(field);
					
					ufLog(val);
					   
					// if relation
					if(formule.get(field).relation=="many" && val!=null){
						
						ufLog("many");
					 //get MAnager b for MANYto MANY(a,b)
					 var relationmanager=getManager(Reflect.getProperty(spod,field).b);
					
					
					//should be better with an unsafe call in sql
					 //ex get all tags
					 var dependencies= relationmanager.all();
					 ufLog("many manager");
					  var inside=dependencies.filter(function(t)					 	
					 	return  Lambda.has(val,Std.string(t.id)));
					 ufLog("many inside");
					 //fill the spod relation 
					 Reflect.getProperty(spod,field).setList(inside);
					ufLog("many done");
						
					 
					//}else if(field){
						//
					}else{
						//why sometimes it makes an array ?
						if (Std.is(val,Array))
					   val=val[0];
				// fill the spod 
				Reflect.setProperty(spod,field,val);
					}
			}

			spod.validate(); // True or false
			 // [ name=>"name failed validation", password=>"Password must be at least 6 characters long" ]

			try
			spod.save()
			catch(msg:Dynamic)
			return Failure(spod.validationErrors).asSurprise();


			return Success(spod.id).asSurprise();


	}
	/*
	public function getModelFromString(mod:String,?id:Int):Surprise<Object,Error>{

		var modClass=getModelClassFromString(mod);
		return getModel(modClass,id) >> function (spod:Object):Object {
			return spod;
		}
		
		

	}


*/

	//tools 
	//
	//
	// inline function getModelClass(stringModel:String):Class<Object>{
	// 	return microbe.MicroSpod.getModelClass(stringModel,modelPath);
		
	// }

	public function getFormuleFromString(mod:String):Surprise<Formule,Error>{
		ufLog("modClass="+mod);
		var modClass=getModelClassFromString(mod);
		
		return SurpriseTools.asSurprise(Success(getFormule(modClass)));
		
	}
	// public inline function getFormule(mod:Class<Object>):Formule{
	// 	//todo get full classPath;
	// 	return microbe.MicroSpod.getFormule(mod);
		

	// }
	

	public function getAllFromString(mod:String):Surprise<List<Object>,Error>{
		var modClass=getModelClassFromString(mod);
		var manager=getManager(modClass);
		return manager.all().asGoodSurprise();
		
	}

	public function setupTable(mod:String):Surprise<Noise,Error>{
		#if server
		ufLog(mod);
		var modClass=getModelClassFromString(mod);
		
		

		try{

			var manager=getManager(modClass);
			ufLog(untyped modClass.formule);
			if ( !sys.db.TableCreate.exists(manager))
		sys.db.TableCreate.create(manager);
		else throw("table existe");
		return Success(Noise).asSurprise();
		}catch(msg:Dynamic){
		return Failure(msg).asSurprise();
		}
		return Failure(new Error("server side")).asSurprise();
		#end
	}
	function combineDataFormule():Void{}


	
/*

	public function createChapter(text:String,titre:String):Bool{
		ufLog('createChapter');
		var c:Chapter= new Chapter();
		c.text=text;
		c.titre=titre;
		c.save();
		ufLog( 'c.id c.created, c.modified');
		return true;
	}

	public function delete(id:Int):Bool {
		var c= getChapter(id);
		c.delete();
		return true;
	}

	public function updateChapter(id:Int,text:String,titre:String):Bool{
		var c= getChapter(id);
		c.titre=titre;
		c.text=text;
		c.update();
		return true;
	}

	public function getChapter(id:Int):Chapter{
		var c:Chapter=Chapter.manager.get(id);
		return c;
	}
	public function getAllChapters():List<Chapter>{
		return Chapter.manager.all();
	}*/

}class MicrobialApiAsync extends UFAsyncApi<MicrobialApi> {}