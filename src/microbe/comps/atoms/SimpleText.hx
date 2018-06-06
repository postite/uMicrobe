package microbe.comps.atoms;
import microbe.Microbe;

class SimpleText<T:{v:String}> extends Atom<T> implements Microbe<T>{

	
	
	
	public function render():String{
		return '<p ${getClasses()} value="${data.v}">${data.v}</p>' ;
	}

	public function execute(ctx):Void{
		
	}

}