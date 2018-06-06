package microbe.comps.atoms;
import microbe.Microbe;
import microbe.comps.Atom;
import ufront.web.context.HttpContext;
//import microbe.comps.Atom.ValueName;
#if js
import js.Browser.*;
import js.html.FileReader;
import js.html.XMLHttpRequest;
import js.html.FormData;

#end
class UpApiComp<T:ValueName> extends Atom<T> implements Microbe<T>{
	var inputId:String="file-upload";
	var previewId:String="previewIco";

	#if js
	var goodPath:String;
	var preview:js.html.DivElement;
	var filec:js.html.DivElement;
	#end
	
	@inject('assetPath') public var assetPath:String;
	@inject('upsPath') public var upsPath:String;





	public function render():String
	{
		var src=(data.v!=null)? upsPath+"/"+data.v : '$assetPath/turn.png';
		return '<div ${getId()} >
	<div id="$previewId">
	<img src="$src"/>
	</div>
	<input type="hidden" id="${data.n}" name="${data.n}" value="$src">$src</input>
	<input id="file-upload" size="15M" type="file" multiple="false"/>
	</div>' ;
	
	}


	public function execute(ctx:HttpContext):Void{
		
		#if js
		untyped console.log("execute");
		ufront.app.ClientJsApplication.ufExecuteAction( microbe.actions.Uplo,{inputId:inputId,previewId:previewId,hiddenId:data.n} );
		#end

	}

	// public function listen(){
 //    #if js
 //    preview=cast document.getElementById("preview");
 //    filec=cast document.getElementById('filec');

 //    filec.addEventListener("change",onSelect,false);
	// #end
 //  	}

 //  	public function onSelect(e):Void {
 //  		#if js
 //   trace("onChanged");
 //    //var files=untyped __js__('this.files');
 //    var fileList=e.currentTarget.files;
    
 //    var fr = new FileReader();
 //    fr.onload = function() {
 //        var dataUrl:String = fr.result;
 //        var img = document.createImageElement();
 //        img.src = dataUrl;
        

 //        preview.replaceChild(img,preview.firstElementChild);

 //        //preview.addEventListener("click",uploadFile.bind(untyped fileList[0]));
       
 //        //or
 //       // preview.addEventListener("click",upForm));
        
 //    };
 //    fr.readAsDataURL( fileList[0] );
 //    #end
 //  }
/*
  function uploadFile(file){

    var url = data.recUrl;// '/galerie/recFA';

    var xhr = new XMLHttpRequest();

    var fd = new FormData(form);

    xhr.open("POST", url, true);

    xhr.onreadystatechange = function() {

        if (xhr.readyState == 4 && xhr.status == 200) {

            // Every thing ok, file uploaded

            console.log(xhr.responseText); // handle response.
            trace("et Zim XHR terminé"+ xhr.responseText);
            var jResponse:Dynamic= haxe.Json.parse(xhr.responseText);
            //ufTrace(jResponse);
           
            preview.getElementsByTagName("img")[0].setAttribute("src",jResponse.path);

        }

    };


    fd.append("upload_file", file);

    xhr.send(fd);

}
*/
	override function getData():T{
		#if js
		var me:js.html.InputElement=cast js.Browser.document.getElementById(data.n);
		return cast {n:data.n,v:me.value};
		#end
		return null;
	}

}