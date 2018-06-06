package microbe.comps.molecules;
import microbe.comps.atoms.*;
import microbe.comps.Atom;
import microbe.Microbe;
import tink.CoreApi;
class LabelPass<T:Pair<String,ValueName>> extends Molecule<T> implements Microbe<T>{

	

	public function render():String{

		//var t1= new Label({value:data.a},["label"]).render();
		var t2= new PassInput({v:data.b.v,n:data.b.n},[data.b.n]).render();
		
		return '<label ${getClasses()}> ${data.a} $t2 </label>';

	}

	public function execute(ctx):Void{
		
	}

}