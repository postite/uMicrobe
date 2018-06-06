package microbe.comps.atoms;
import microbe.Microbe;
import microbe.comps.Atom;
//import microbe.comps.Atom.ValueName;
#if js
import js.Browser.*;

#end
@:keep
@:less('textinput.less')
class TextInput<T:ValueName> extends Atom<T> implements Microbe<T>{

	public function render():String{
		return '<input ${getId()} type="text" name="${data.n}" ${getClasses()} value="${data.v}">' ;
	}

	public function execute(ctx):Void{
		trace( "i'ma a text Input");
		#if js
		this.data.v="polo";
		var me:js.html.InputElement=cast js.Browser.document.querySelector('input[name=${data.n}]');
		if( me!=null){
		me.addEventListener("click",function () {
			//alert("yo");
		});
		me.addEventListener("focusin",function(e){
			//styling test later
			//me.style.cssText="background: #000;  color: #FFF; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.5);";
			//me.style.cssText=
//"background: none 0% 0% / auto repeat scroll padding-box border-box rgb(245, 245, 240); font-size: 22px; color: rgb(51, 51, 50); margin: 0px 0px 20px; padding: 10px; border-width: 0px 0px 1px; border-color: rgb(51, 51, 50) rgb(51, 51, 50) rgb(204, 204, 204); border-style: none none dashed; min-height: 51px; min-width: 500px;display:none";
		});
		me.addEventListener("focusout",function (e) {
			this.data.v="me.value";
			//me.style.cssText="background: none 0% 0% / auto repeat scroll padding-box border-box rgb(245, 245, 240); font-size: 22px; color: rgb(51, 51, 50); margin: 0px 0px 20px; padding: 10px; border-width: 0px 0px 1px; border-color: rgb(51, 51, 50) rgb(51, 51, 50) rgb(204, 204, 204); border-style: none none dashed; min-height: 51px; min-width: 500px;";
			trace("olé"+me.value);
			});
		}
		#end

	}
	override function getData():T{
		#if js
		var me:js.html.InputElement=cast js.Browser.document.querySelector('input[name=${data.n}]');
		return cast {n:data.n,v:me.value};
		#end
		return null;
	}

}