package microbe.comps.molecules;
import microbe.comps.atoms.*;
import microbe.Microbe;
import microbe.comps.Atom;
import tink.CoreApi;
class Login<T:Pair<ValueName,ValueName>> extends Molecule<T> implements Microbe<T>{

	

	public function render():String{

		//var t1= new TextInput({v:data.a.v,n:data.a.n},[data.a.n]).render();
		//var t2= new PassInput({v:data.a.v,n:data.a.n},[data.b.n]).render();

		var t1= new LabelField(new Pair("pseudo",data.a)).render();
		var t2= new LabelPass(new Pair("pass",data.b)).render();
		var b= new Button({v:"ok",type:"submit",n:"butt"},["normal"]).render();

		//this register(); ?
		return '<div ${getClasses()}> $t1 $t2 $b </div>';

	}

	public function execute(ctx):Void{
		trace( "i'm a Login");
		#if client
		js.Browser.document.querySelector('.${classes[0]} .normal').addEventListener("click",function (e) {js.Browser.alert("hey" +gatherData());});
		#end
	}

}