package microbe;
import ufront.web.context.HttpContext;
import ufront.MVC;
typedef Formule=Map<String,Dynamic>;
typedef DataFormule=Map<String,Dynamic>;
typedef Signature=String;

interface Microbe<T> {
	public var name:String;//field
	public var data:T;
	public function setData(d:T):Microbe<T>;
	public function render():String;
	public function getData():T;
	public function execute(ctx:HttpContext):Void;
	public function validate(err:Map<String,String>,name:String):Void;
	
}