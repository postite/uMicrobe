package microbe.comps.molecules;
import microbe.comps.atoms.*;
import microbe.comps.Atom;
import microbe.Microbe;
import tink.CoreApi;


class UpComp<T:ValueName> extends Molecule<T> implements Microbe<T>{


	public function render():String{
		
		if (data.v==null) data.v="turn.png";
		return "yo";
		'<div ${getId()} type="text" name="${data.n}" ${getClasses()} data-value="${data.v}">
		<div id= "preview" >
		<div class="preview_ico"></div>
		<img src=${data.v}/>
		</div>
		<input id="filec" name="content" size="15MB" type="file" multiple="::multiple::"/>
		';
	}

	public function execute(ctx):Void{
		
	}
}