package microbe.comps.atoms;
import microbe.Microbe;
import microbe.comps.Atom;
import microbe.tools.JSTools.*;
#if js
import microbe.extern.Medium;

import js.Browser.*;

#end
@:less("medium.less")
class MediumEditor<T:ValueName> extends Atom<T> implements Microbe<T>{

	
	#if js
  var medium:Medium;
	var me:js.html.DivElement;
	#end
	public function render():String{
		addClass("editable");
		return '<div ${getId()} ${getClasses()} name=${data.n}>${data.v}</div>
		';

	}

	public function execute(ctx):Void{
		trace( "i'ma a meditor");

		#if js
		//this.data.v="polo";

		me=cast js.Browser.document.getElementById(this.id);
    //me.style.minHeight="120px";
    //
    retente(setupMedium,10);
      
	//	haxe.Timer.delay(setupMedium,500);
		//  			loadScript("/medium/js/medium-editor.min.js",function()trace( "reloaded callback"));

		if( me!=null){
		me.addEventListener("click",function () {//alert("yo"+this.id);

		});
		// me.addEventListener("focusout",function (e) {
			
			//this.data.v="padooo";
		// 	trace("olé");
		// 	});
		}
		#end

	}
	override public function getData():T{
		#if js
		var me=js.Browser.document.getElementById(id);
    

    var t=medium.serialize();
    console.log(Reflect.field(t,id).value);
    
		return cast {n:data.n, v:me.innerHTML} ;
		#end 
return null;
}

	#if js
	var mediumloaded:Bool=false;
	 private function setupMedium(){
    console.log( "setup mediume");
  	//ufTrace("setupMedium");
  	var mediumOptions:MediumOptions={
  		toolbar: {
                    buttons: [{
                            name: 'bold',
                            contentDefault: 'bold'
                        },
                        {
                            name: 'italic',
                            contentDefault: '<i>italic</i>'
                        },
                        {
                            name: 'underline',
                            contentDefault: '<u>underline</u>'
                        },
                        {
                            name: 'anchor',
                            contentDefault: 'link'
                        }
                    ]
                },
        paste:{
        	forcePlainText:false,
        	cleanPastedHTML:true,
            }
        };
  	//try {
  		 medium=new Medium(".editable",mediumOptions);

    
/*
  		}catch(msg:Dynamic){
  			if(!mediumloaded){
  			console.log( "catch"+msg);
  			mediumloaded=true;
  			//loadScript("/medium/js/medium-editor.min.js",function()trace( "reloaded callback"));
  		//trace( "reloaded");
  		}
  		}

  */	
  	
 


  }
  public static function loadScript(url, callback){

    //if (mediumloaded) return callback();
    trace( 'loadScript $url');
    var script:js.html.ScriptElement = cast js.Browser.document.createElement("script");
    script.type = "text/javascript";
    script.src = url;
    script.onload = function(){
          trace( "callback");
            callback();
        };
        script.async=true;
    script.defer=true;
    script.id="med";
    js.Browser.document.getElementsByTagName("head")[0].appendChild(script);
    untyped(
    if (script.readyState){  //IE
        script.onreadystatechange = function(){
            if (script.readyState == "loaded" ||
                    script.readyState == "complete"){
                script.onreadystatechange = null;
                callback();
            }
        };
    } else {  //Others
        script.onload = function(){
          trace( "callback");
            callback();
        };
    }

    );

    
    //script.setAttribute("onload",);

    return null;
}
  #end

}

class MediumExt<T:ValueName> extends MediumEditor<T>{
  #if js
  override  private function setupMedium(){
    console.log( "setup mediumExt" + mediumloaded );
    //ufTrace("setupMedium");
    var mediumOptions:MediumOptions={
      toolbar: {
                    buttons: [{
                            name: 'bold',
                            contentDefault: 'bold'
                        },
                        {
                            name: 'italic',
                            contentDefault: '<i>italic</i>'
                        },
                        {
                            name: 'underline',
                            contentDefault: '<u>underline</u>'
                        },
                        {
                            name: 'anchor',
                            contentDefault: 'link'
                        }
                    ]
                },
        paste:{
          forcePlainText:false,
          cleanPastedHTML:true,
            }
        };
    //try {
      medium=new Medium(".editable",mediumOptions);

    untyped __js__('$(".editable").mediumInsert({
        editor: {0},
        addons:{
                    images: {
                        fileUploadOptions: {
                            url: "/upload.php"
                        }
                    }
                }
    })',medium);

     var addon = me.dataset.plugin_mediumInsertImages;
      console.log("try"+ addon);
/*
      }catch(msg:Dynamic){
         console.log( "catch"+msg);
        if(!mediumloaded){
        
    console.log( "no Medium ... reloading"+msg);
        mediumloaded=true;
        //loadScript("/medium/js/medium-editor.min.js",function()trace( "reloaded callback"));
      //trace( "reloaded");
      }
      }*/

    
    
 


  }
  #end
}