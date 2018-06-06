package microbe.comps.molecules;
import microbe.comps.atoms.*;
import microbe.comps.Atom;
import microbe.Microbe;
import tink.CoreApi;
enum ErrorType{
	Info;
	UserError;
	SiteError;
}
class ErrorBox<T:{?type:ErrorType,error:String,titre:String}> extends Molecule<T> implements Microbe<T>{

	
	override function init(){
		if( data.type==null)data.type=Info;
		super.addClass("errorBox");
		super.addClass(Std.string(data.type));	
	}
	public function render():String{

		var t1= new SimpleTitre({v:data.titre,level:2}).render();
		var t2= new SimpleText({v:data.error}).render();
		
		return '
		<style>
		.errorBox.Info{
			background-color:green;
		}
		.errorBox.UserError{
			background-color:orange;
		}
		.errorBox.SiteError{
			background-color:red;
		}  
		</style>
		<div ${getId()} ${getClasses()}>
		 $t1
		 $t2
		</div>'
		;

	}

	public function execute(ctx):Void{
		
	}

}