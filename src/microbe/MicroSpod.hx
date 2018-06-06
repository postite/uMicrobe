package microbe;
import microbe.Microbe;
import ufront.db.Object;
class MicroSpod {

//injected ?
public static var modelPath:String="model.";
public static function getDataFormulefromVO(spod:Object,?formule:Formule):Formule{
		
		if (formule==null){
		var mod= Type.getClassName(Type.getClass(spod));
		var modClass=getModelClassFromString(mod);
		var formule= getFormule(modClass);
		formule= getFormule(modClass);
		}

		for (field in formule.keys()){
			var data=Reflect.getProperty(spod,field);
			formule.get(field).data=data;
		}
		return formule;

	}

public static function getDataFormuleVO(mod:Object):DataFormule{
		//ufLog("getDataFormule"+mod);

		var modClass=getModelClassFromInstance(mod);

		
		var formule= getFormule(modClass);
		
		var spod=mod;
		formule.get('model').id=spod.id;
		var valids=null;
		if(spod.validationErrors!=null)
		valids=spod.validationErrors.toSimpleMap();

		for (field in formule.keys()){
			//ufLog(field);
			var data=Reflect.getProperty(spod,field);
			
			if( formule.get(field).relation=="many" ){
			 var ids=Lambda.array(data.toList().map(function(d)
			 	return d.id));
			formule.get(field).data=ids;
			// 	//var tags= Reflect.field(spod,field);
			 	formule.get(field).dependency=Lambda.array(
					formule.get(field).dependency.map(
					function(n:{id:Int,value:Dynamic}){
					var prioField=formule.get(field).prio;
					var prioValue=n.value;
					var inside=ids.indexOf(n.id)!=-1;

					return {id:n.id,value:prioValue,inside:inside};
				}//end if
					)
					);
			 	formule.get(field).data=formule.get(field).dependency;
			}else if (formule.get(field).relation=="one"){
			
			 	if (data==null)continue;	

			 formule.get(field).dependency=Lambda.array(
		 			 formule.get(field).dependency.map(function(n:{id:Int,value:Dynamic}){
		  				var prioField=formule.get(field).prio;
		 				//var prioValue=Reflect.field(n,"value");
		 	 		
		 				return {id:n.id,value:n.value,inside:n.id==data.id};
		 			}
					));

			 formule.get(field).data=formule.get(field).dependency;
			}else{
				formule.get(field).data=data;
				if(valids!=null)
				formule.get(field).validationErrors=valids.get(field);
			}
		}

		return formule;

	}
public static function getFormule(mod:Class<Object>):Formule{
		//todo get full classPath;
		var formule:Formule= Reflect.field(mod,"formule");
		
		//get dependencys
		for (field in formule.keys()){
		if ( field=="model")continue;
			//var data=Reflect.getProperty(spod,field);

		if( formule.get(field).relation=="many" 
			|| formule.get(field).relation=="one"

			){

		var relationB=null;
		//si on a un full path genre "tags.BlogTag"
		if(hasPoint(formule.get(field).relationB))
		relationB= getModelClassFullPath(formule.get(field).relationB);
		else
		//sinon on chope le rep par default ( modelPath )
		relationB= getModelClassFromString(formule.get(field).relationB);

		formule.get(field).dependency=relationB;
		#if (!testCase)
		formule.get(field).dependency=Lambda.array(
		 	getManager(relationB).all().map(
		 	function(n){
		  	var prioField=formule.get(field).prio;
		 	var prioValue=Reflect.field(n,prioField);
		// 		// 	var inside=ids.indexOf(prioValue)!=-1;
		 	return {id:n.id,value:prioValue};
		 }
		
			));
		 #end
		 formule.get(field).data=formule.get(field).dependency;
		 }
		 		
	}
		return formule;

}
public static function hasPoint(s:String):Bool{
	return  ~/\./.match(s);
}

public static function getManager(mod:Class<Object>)#if server : sys.db.Manager<ufront.db.Object>#else :Dynamic #end{
		
		// object casting is important!
		#if server
		var manager:sys.db.Manager<ufront.db.Object>= cast Reflect.field(mod,"manager");
		return manager;
		#end 
		return null;
	}
public static function getModelClassFromInstance(spod:Object):Class<Object>{
		return  Type.getClass(spod);
}
public static  function getModelClassFromString(stringModel:String,?_modelPath:String):Class<Object>{
		
		if( _modelPath==null)_modelPath=modelPath;
		var fullClassPath=_modelPath+capitalize(stringModel);
		if(stringModel.indexOf(".")!=-1)
		fullClassPath=stringModel;
		//trace('model='+_modelPath+capitalize(stringModel));
		//return model.Article;
		return cast Type.resolveClass(fullClassPath);
	}
public static function getModelClassFullPath(stringModel:String):Class<Object>{
		
		return cast Type.resolveClass(stringModel);
	}
inline public static function capitalize (str:String):String{
     return str.charAt(0).toUpperCase() + str.substr(1);
  	

}

public static function identify():Signature{
	return "spodTable"+"spodId";
}

}