package microbe.comps.atoms;
import microbe.Microbe;
import microbe.comps.Atom;
class Combo<T:{n:String,v:Array<{id:Int,value:String,inside:Bool}>}> extends Atom<T> implements Microbe<T> {

	//public var data:Array<{label:String,value:T}>;
	public var nullMessage:String;
	public var onChange:String;
	public var size:Int;
	public var multiple:Bool;
	public var value:String;

	public function new(d:T,name:String,?classes:Array<String>,?size:Int,?multiple:Bool=false){
		super(d,name,classes);
		this.size=size;
		this.multiple=multiple;
		this.nullMessage="indefini";
		this.value = "selected";
	}
	
	 public function render():String
	{
		var s = "";
		//var n = parentForm.name;
		//n += "_" +name;

		s += '<select name="$name" ${getId()}  class="${getClasses()}" onChange="'+onChange+'" size="$size" '+(multiple ? "multiple" : "")+'>';
		
		if (nullMessage != "")
			s += "<option value=\"\" " + (Std.string(value) == "" ? "selected":"") + ">" + nullMessage + "</option>";
			
		if (data.v != null){	
			for (row in data.v) {
				s += '<option value="' + Std.string(row.id) +  '" '+(row.inside ? "selected ":"")+' >' + Std.string(row.value) + '</option>';
			}
		}
		s += "</select>";
	 
		return s;
	}
	public function execute(ctx){
		trace( "i'm a Select");
		#if js
		var me:js.html.SelectElement=cast js.Browser.document.getElementById(this.id);
		me.addEventListener("change",function(e)untyped console.log("change"+getData()));
		#end
		trace( data);
	}
		override public function getData():T{
		#if js
		var me:js.html.SelectElement=cast js.Browser.document.getElementById(this.id);
		var tags=[for (opt in me.querySelectorAll("option:checked")) cast(opt,js.html.Element).getAttribute("value")];

		return cast {n:data.n, v:tags} ;
	#end 
return null;
}
}