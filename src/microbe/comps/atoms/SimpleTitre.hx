package microbe.comps.atoms;
import microbe.Microbe;

class SimpleTitre<T:{v:String,?level:Int}> extends Atom<T> implements Microbe<T>{

	
	
	override function init(){
		if (data.level==null) data.level=2;
	}
	public function render():String{
		return '<h${data.level} ${getClasses()} ">${data.v}</h${data.level}>' ;
	}

	public function execute(ctx):Void{
		
	}

}