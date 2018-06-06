package microbe.comps.atoms;
import microbe.Microbe;

class OkButton<T:{v:String,?n:String,?type:String}> extends Atom<T> implements Microbe<T>{

	//pour une funking raison safari ne veut pas de majuscules ..
	public function render():String{
		data.type=( data.type==null)? "button" : data.type;
		return '<div ${getId()} ><input  type="${data.type}" ${getClasses()} value="${data.v}"" name="${data.n}"><span id="retour">x</span> </div>' ;
	}

	public function execute(ctx):Void{
		trace( "i'ma a Button");

		
	}
	public function stateGood(){
		#if js
		js.Browser.document.querySelector('#$id #retour').innerText="OK";
		#end
	}

}