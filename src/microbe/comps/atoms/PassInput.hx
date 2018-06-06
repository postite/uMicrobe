package microbe.comps.atoms;
import microbe.Microbe;
import microbe.comps.Atom;
//import microbe.comps.Atom.ValueName;

class PassInput<T:ValueName> extends Atom<T> implements Microbe<T>{

	
	
	
	public function render():String{
		return '<input type="password" name="${data.n}" ${getClasses()} value="${data.v}">' ;
	}

	public function execute(ctx):Void{
		trace( "i'ma a text Input");
	}

}