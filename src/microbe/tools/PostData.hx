package microbe.tools;


using StringTools;
class PostData{

	public static  function serializeStatePostData(state:Dynamic):Dynamic {
  	var buf:StringBuf=new StringBuf();
   // var paramObj={};
  	for (a in Reflect.fields(state)){
  		#if debug
  		untyped console.log(a);
  		untyped console.log(Reflect.field(state,a));
  		untyped console.log(Type.typeof(Reflect.field(state,a)));
  		#end 
  		var val=Reflect.field(state,a);
  		if(a=="__postData")continue;
  		 if (Std.is(val,Array)){
  		 	#if debug
  		 	untyped console.log("isaArray "+a);
  		 	#end
  		 	for (it in (cast val:Iterable<Dynamic>)){
  		 	var p:String=it;
  			var _a=a+"="+p.urlEncode();
			buf.add(_a+"&");
  			}
  			continue;
  		}
  		var p:String=Reflect.field(state,a);
  		var _a=a+"="+p.urlEncode();
		buf.add(_a+"&");
    
  	}
  	
  	Reflect.setField(state,"__postData",buf.toString());
  	
  	
  	return state;
  	
  } 
}