package microbe;
import microbe.Microbe.Formule;
interface IMicrobeWrapper<T>{
	public var data:T;
	public function setData(d:T):IMicrobeWrapper<T>;
	public function gatherData():Formule;
	public function render():String;
	public function setFormUrl(url:String):Void;
}