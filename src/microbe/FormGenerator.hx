package microbe;
import microbe.Microbe;

@:less("comps/style/forms.less")
class FormGenerator<T> {

	var formurl:String;
	var classes:Array<String>;
	var data:T;

	public static var injector:minject.Injector;
	public function new (?formurl:String="",?classes:Array<String>){
		this.formurl= formurl;
		this.classes= (classes!=null)? classes :[];
		
	}
	
	public function setData(d:T):FormGenerator<T>{
		this.data=d; 
		return this;
	}

	public function generate(m:Microbe<T>):String{
		m.setData(data);

		var c=classes.join(" ");
		return '
		<style> input{
			display:block;
		}
		</style>
		<form action="$formurl" class="$c" rel="pushstate" method="POST">
		${m.render()}
		</form>';
	}

	public static function instanciateComp<T>(comp:String,data:Dynamic,name:String):Microbe<Dynamic>{
		var fullClassPath="microbe.comps.atoms."+comp;
		trace( fullClassPath);
		if(comp.indexOf(".")!=-1)
		fullClassPath=comp;
		var mic:Microbe<T>=null;
		try
		 mic= Type.createInstance(Type.resolveClass(fullClassPath),[data,name])
		catch(msg:Dynamic)
		throw " no components found in FormGenerator for"+fullClassPath;
		try
		injector.injectInto(mic)
		catch(msg:Dynamic)
		throw " no injector found in FormGenerator do it via App please >"+mic+injector.getValue(String,"upsPath");
		return mic;
	}
	public static function instanciateWrapper<T>(wrapper:Class<microbe.IMicrobeWrapper<T>>,data:Dynamic,name:String):IMicrobeWrapper<Dynamic>{
		var wrap= Type.createInstance(wrapper,[data,name]);
		//var injector=app.App.app.injector;
		try
		injector.injectInto(wrap)
		catch(msg:Dynamic)
		throw " no injector found in FormGenerator do it via App please";
		
		return wrap;
	}



}

class ModelFormGenerator<T> {

	var model:ufront.db.Object;
	var stringModel:String;
	var formurl:String;
	var classes:Array<String>;
	var data:T;

	public function new(formurl:String="",?classes:Array<String>){
		this.formurl= formurl;
		this.classes= (classes!=null)? classes :[];
		//stringModel=model;
		
	}

	public function setData(d:T):ModelFormGenerator<T>{
		this.data=d;
		return this;
	}

	public function generate(m:IMicrobeWrapper<T>):String{
		m.setData(data);
		classes.push("pushstate");
		var c=classes.join(" ");

		return '
		<style> input{
			display:block;
		}
		</style>

		<form action="$formurl" class="$c"  method="POST">
		${m.render()}
		</form>';
	}

	

	

}