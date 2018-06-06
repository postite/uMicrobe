package microbe.comps;
using ufront.core.Uuid;
import microbe.IBehaviour;
#if js
import js.Browser.*;
#end
import microbe.IMicrobeWrapper;
import microbe.Microbe.Formule;
class Wrapper<T> implements IMicrobeWrapper<T>{

	public var data:T;
	var classes:Array<String>;
	var id:String;
	var dataId:String;
	var name:String;
	var formUrl:String;
	#if client
	var me:js.html.Element;
	#end
	public function new (d:T,?name:String,?classes:Array<String>){
	this.data=d;
	this.name=name;
	this.id="A"+Uuid.create();
	this.classes= (classes!=null)? classes :['wrapper'];
	}

	public function setFormUrl(url:String){
		
		this.formUrl=url;
	}
	
	public function setData(d:T):IMicrobeWrapper<T>{
		this.data=d;
		
		return cast this;
	}
	public function gatherData():Formule{
		throw "abstract method";
	}
	public function render():String{
		return "";
	}
	public function getId():String{
	//throw 'not implmented';
	return 'id="$id"';
	}

	public function getClasses():String{
	var c=classes.join(" ");
	return 'class="$c"';
	}

	public function setClasses(classes:Array<String>){
	//throw "not implemented";
	//could be 
	this.classes=classes;
	}
	public function addClass(cl:String){
	this.classes.push(cl);
	}

	
}