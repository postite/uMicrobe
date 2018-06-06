package microbe.comps;
using ufront.core.Uuid;
import microbe.IBehaviour;
#if js
import js.Browser.*;
#end
typedef ValueName ={
	v:String,
	n:String
}

class Atom<T>{


public var data:T;
var classes:Array<String>;
public var id:String;
var dataId:String;
public var name:String;
#if js
var validateElement:js.html.DivElement;
#end
public function new (d:T,?name:String,?classes:Array<String>){
	this.data=d;
	this.name=name;
	this.id="a"+Uuid.create().toLowerCase(); // switch to lowercase cause safari is a bitch
	this.classes= (classes!=null)? classes :["atom"];
	init();
}

public function init():Void{
	// to be overrided.
}
// binding ?
public function setData(d:T):Microbe<T>{
		this.data=d;
		return cast this;
	}
public  function getData():T{
	return data;
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
public function setId(id:String){
	throw "not implemented";
	this.id=id;
}
public function getId():String{
	//throw 'not implmented';
	return 'id="$id"';
}
public function setBehaviour(behave:IBehaviour){
	throw "not implemented";
}
public function setdataId(dataId:String){
	throw 'not implemented';
	this.dataId=dataId;
}
public function getDataId(){
	throw "not implemented";
	return this.dataId;
}

 public function validate(err:Map<String,String>,field:String):Void{
 	if (err.exists(field))
 		afficheValidation(err.get(field));
 	else
 	removeValidateElement();
 	

 }
private function removeValidateElement(){
	trace( "removeValidateElement");
	#if client
	
	if (validateElement!=null){
 	validateElement.remove();
 	validateElement=null;
 	}
 	#end
}
private function afficheValidation(err:String){
	trace( "afficheValidateElement");
	#if client
	
		var me=document.getElementById(this.id);
		validateElement=cast document.createElement("div");
		validateElement.style.color="red";
		validateElement.innerHTML="* "+err;
		me.appendChild(validateElement);
	#end
}

}