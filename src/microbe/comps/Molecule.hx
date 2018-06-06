package microbe.comps;
import microbe.Microbe;

class Molecule<T> extends Atom<T> {

public var children:Map<String,Atom<T>>= new Map();
public function new(d:T,?classes:Array<String>){
	if (classes==null) classes=["mol"];
	super(d,classes);
}

public function gatherData():Formule{
	return null;
	//return haxe.Json.stringify(data);
	
}


//macro ?
//store each comp in a map 
// listen to data change?
// 
public  function register(a:Atom<T>):Atom<T>{
	//children.set(a.data.n,a);
	return a;
}
}