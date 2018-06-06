package microbe.actions;

import ufront.MVC;
import tink.CoreApi;
import apis.*;
using ufront.core.AsyncTools;
import ufront.web.upload.BrowserFileUpload;
//import postiteResult.MicBrowserFileUpload;
#if client
	import js.html.*;
	import js.Browser.*;
	using StringTools;
#end
import ufPostite.mime.MimeType;
using ufPostite.mime.Mime;

enum FailType{
  Size(n:Int);
  Type(s:String);
}
class Uplo extends UFClientAction<{inputId:String,previewId:String,hiddenId:String}>{
	var ctx:HttpContext;
	var inputId:String;
	var previewId:String;
	var hiddenId:String;
	var previewImgElement:js.html.ImageElement;
	var fileInput:js.html.InputElement;
	var hiddenFileInput:js.html.InputElement;
	@inject("assetPath")public var assetPath:String;
	@inject("upsPath")public var upsPath:String;

	//thx to Injector.injectInto(mic)
	@inject public var imageBase:microbe.apis.ImageBaseApi.ImageBaseApiAsync;
	@inject public var attachmentApi:microbe.apis.UpApi.UpApiAsync;

	override public function execute(httpContext:HttpContext,?data:{inputId:String,previewId:String,hiddenId:String}):Void{
		ufTrace( "new Uplo");
		ctx=httpContext;
		inputId=data.inputId;
		previewId=data.previewId;
		hiddenId=data.hiddenId;
		ufTrace(data);
		setupUploadHandler(httpContext);
		
		//haxe.Timer.delay(setupUploadHandler,200);
	}


	function setupUploadHandler( httpContext:HttpContext ) {
		fileInput = cast document.getElementById(inputId);
		ufTrace( fileInput);
		var preview:Element= cast document.getElementById(previewId);
		ufTrace( preview);
		previewImgElement=cast preview.getElementsByTagName("img")[0];
		ufTrace(inputId);
		hiddenFileInput=cast document.getElementById(hiddenId);
		fileInput.addEventListener("click", beforeUpload);
		fileInput.addEventListener("change",function(e) {
			e.preventDefault();
			//var currentPostID = Std.parseInt( "#id".find().val() );
			var fileList = fileInput.files;
			for ( i in 0...fileList.length ) {
				var file = fileList[i];
				var upload = new BrowserFileUpload( inputId, file );

				// upload.process(onProcess).handle(function(k)
				// 	switch(k){
				// 		case Success(_):ufTrace("gagné");
				// 		//attachmentApi.uploadImage( upload );
				// 		case Failure(r):ufTrace("pasgagné");
				// 	});
				// return ;
				//updateIco(upload.getBytes());
				updateFuturePreview(asUrl(upload));
				// Insert a placeholder
				var filename = upload.originalFileName;
				//upload.process(onProcess);
				var good:Bool=true;
				if(checkSize(file))
      			good=true;
       			else return fail(Size(file.size));
    			if(checkType(file))
      			good=true;
      			else return fail(Type(file.type));

				//var tmpText = '<Uploading "${filename}">';
				// var start = textArea.selectionStart;
				// var before = textArea.value.substring( 0, start );
				// var after = textArea.value.substring( textArea.selectionEnd, textArea.textLength );
				// textArea.value = before + tmpText + after;
				// textArea.setSelectionRange( start, tmpText.length );

				// Upload the file using our API
				
				attachmentApi.uploadImage( upload ).handle(function(outcome) {

					switch outcome {
						case Success(url):
							ufTrace('éeho $url' );
							// Replace the placeholder with a link or an image
							var newText = '[${filename}]($url)';
							if ( upload.contentType.startsWith("image/") )
								newText = '!'+newText;

							imageBase.getResizedImage(url).handle(function(t){
							
									switch(t){
									case Success(resized):
									updatePreview(resized);
									ufTrace( "resized"+resized);
									case Failure(r):throw "resizingError" +r;
									}
									});
							fileInput.value="";
							hiddenFileInput.value=url;
							//textArea.value = textArea.value.replace( tmpText, newText );
							//textArea.trigger( "keyup" );
						case Failure(err):
							ufError( 'Failed: $err' );
					}
				});
			}
		});
	}

	function onProcess(b:haxe.io.Bytes,c:Int,d:Int):Surprise<Noise,Error>{
		console.log("pos="+c);
		//if(d>0)
		 return attachmentApi.uploadBytes(b,c,d,"simpled.md");
		console.log("bytes.length="+d);
		  var t=Noise.asGoodSurprise(); //Future.async(function(f)haxe.Timer.delay(function()return Success(Noise),1000));
		 return t;
	}
	function beforeUpload(e) {
		//updatePreview();
		//var currentPostID = Std.parseInt( "#id".find().val() );
		//if ( currentPostID==null ) {
			//alert( 'You must save this post before uploading images or attachments' );
			//e.preventDefault();
		//}
	}
	function updateIco(f:Future<Outcome<haxe.io.Bytes,Error>>){
			f.handle(function(o){
				switch(o){
					case Success(ss):
					 
        			checkMime();
					previewImgElement.setAttribute("src",'$assetPath/jpg.png');
					case Failure(rr):ufTrace("rr");
				}
			});
			//previewImgElement.src=path;
	}
	function updateFuturePreview(f:Future<Outcome<String,Error>>){
		f.handle(function(o){
				switch(o){
					case Success(ss):
					 
        			checkMime();
					previewImgElement.setAttribute("src",ss);
					case Failure(rr):ufTrace("rr");
				}
			});
	}
	function updatePreview(p:String){
		previewImgElement.setAttribute("src",p);

	}
	function checkMime(){};

	//extending upload
	/**
	Get the complete `String` of the current upload.
	Optionally specify an encoding to use, the default is UTF-8.
	**/
	public function asUrl( upload:BrowserFileUpload):Surprise<String,Error> {
		

		#if js
			var t = Future.trigger();
			var fr = new FileReader();
			fr.onload = function() {
				var str:String = fr.result;
				t.trigger( Success(str) );
			};
			fr.onabort = function(e) t.trigger( Failure(HttpError.internalServerError('Error during BrowserFileUpload.asUrl(), readAsDataURL() was aborted')) );
			fr.onerror = function(e) t.trigger( Failure(HttpError.wrap(e,'Error during BrowserFileUpload.asUrl(), readAsDataURL() raised an error')) );
			fr.readAsDataURL(upload.file);
			return t.asFuture();
		#else
			return throw 'BrowserFileUpload.asUrl() was used on a target other than JS';
		#end
	}

	function checkSize(file:File):Bool{
    ufTrace("fileSize="+file.size);
    ufTrace( (ufPostite.strings.StringUtils.getExtension(file.name) : ExtGroup).toGroup());
    //if( file.size >5242880) //5M
    //if( file.size >10485760) //10M
    if( file.size >15660800) //15M
    //if( file.size >12521558) //15M
    return false;
    return true;

  }

  function fail(err:FailType){
    var msg=switch (err){
      case Size(s):'fichier trop lourd\n $s';
      case Type(s):'type de fichier non supporté\n $s';
    }
   // noteError(msg);
    ufTrace("fail="+err);
    //resetForm();
  }

  function checkType(file:File):Bool{
   // var ext= getExtension(file.name);
    return (Mime.isImage(file.name)||Mime.isVideo(file.name)||Mime.isDoc(file.name) );
   
  }

}