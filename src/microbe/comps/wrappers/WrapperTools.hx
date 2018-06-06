package microbe.comps.wrappers;
using microbe.comps.wrappers.WrapperTools;
typedef ValidDs = Map<String,String>->String->Void;

class WrapperTools{
#if client
	 public static function afficheErreur(me:js.html.Element,msg:String){
		
			var err= new microbe.comps.molecules.ErrorBox({titre:"OOps !",error:msg,type:null});
			me.appendChild(err.render().asNode());
		
	}
	#end

	#if client
	public static function asNode(str:String):js.html.DocumentFragment{
		return js.Browser.document.createRange().createContextualFragment(str);
	}
	#end

}