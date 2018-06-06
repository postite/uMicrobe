package microbe.comps.atoms;
import microbe.Microbe;

class Label<T:{v:String}> extends Atom<T> implements Microbe<T>{

	
	
	
	public function render():String{
		return '<label ${getClasses()} value="${data.v}">${data.v}</label>' ;
	}

	public function execute(ctx):Void{
		
	}

}