package microbe.comps.atoms;
import microbe.Microbe;

class Button<T:{v:String,?n:String,?type:String}> extends Atom<T> implements Microbe<T>{

	
	public function render():String{
		data.type=( data.type==null)? "button" : data.type;
		return '<input type="${data.type}" ${getClasses()} value="${data.v}"" name="${data.n}">' ;
	}

	public function execute(ctx):Void{
		trace( "i'ma a Button");
	}

}