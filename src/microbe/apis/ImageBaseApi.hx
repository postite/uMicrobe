package microbe.apis;

import ufront.MVC;

#if server
	import sys.FileSystem;
	//import haxe.imagemagick.Imagick;
	import image.Image;
#end
using tink.CoreApi;
using StringTools;
using haxe.io.Path;
using ufront.core.AsyncTools;
//import ufront.web.upload.BrowserFileUpload;
//
// typedef Resizr={
// 	n:String,
// 	w:Int,
// 	h:Int,
// 	?crop: Bool, // Defaults to true
// 	?focus: {x: Float, y: Float} // Defaults to {x: .5, y: .5}
// }
@:publicFields
@:structInit
class Resizr{
	var n:String="nada";
	var w:Int=2;
	var h:Int=3;
	var crop: Bool=true; // Defaults to true
	var focus: {x: Float, y: Float}= {x: .5, y: .5};
  public function new(n:String,w:Int,h:Int,?crop:Bool,?focus:{x:Float,y:Float}){
    this.n=n;
    this.w=w;
    this.h=h;
    this.crop=crop;
    this.focus=focus;
    
  }
}
@:forward
abstract Taille(Resizr) from Resizr to Resizr {
    public static var Square:Taille={n:"Square",w:193,h:193};
    public static var Long:Taille={n:"Long",w:600,h:300,crop:false};
    public static var Screen:Taille={n:"Screen",w:800,h:600,crop:false};
    public static var Normal:Taille={n:"Normal",w:0,h:0,crop:false};

    inline function new(i:Resizr) {
    this = i;
  	}
    
    @:to
    public static function toStr(t:Taille):String{
       return '${t.w}*${t.h}_';
    }
	
    @:to
    public static function toName(t:Taille):String{
       return t.n+"_";
    }
}


class ImageBaseApi extends UFApi{

	public static function strTaille(t:Taille):String{
		return '${t.w}*${t.h}_';
	}
	public function getResizedImage(path:String, ?taille:Taille ):Surprise<String,Error> {
		if (taille==null)taille=Taille.Square;
		if ( ['gif','jpg','jpeg','png'].indexOf(path.extension().toLowerCase())==-1 || taille==Taille.Normal)
			return path.asGoodSurprise();


		// if ( newWidth==null && newHeight==null )
		// 	newWidth = 300; // TODO: make this configurable.
		// var ratioName =
		// 	if (newWidth!=null && newHeight!=null) '${newWidth}x${newHeight}'
		// 	else if (newWidth!=null)'${newWidth}xAUTO'
		// 	else 'AUTOx${newHeight}';
		var dir = path.directory().addTrailingSlash() + "thumb";
		var thumbPath = "."+dir + "/" + taille.toName()+path.withoutDirectory();
		var relativeThumbPath=dir + "/" + taille.toName()+path.withoutDirectory();

		 if ( FileSystem.exists(thumbPath)==false || getModTime("."+path )>getModTime(thumbPath) ) {
		 	FileSystem.createDirectory( "."+dir );

			return Image.resize("."+path, thumbPath, {engine: Engine.GD, width: taille.w,height:taille.h,crop:taille.crop,focus:taille.focus})
			.map(function (res) return switch res {

			case Success(_):

    		Success(relativeThumbPath);
    		case Failure(error):
    	
    		Failure(error);
		});
	
		 }
		
		 return relativeThumbPath.asGoodSurprise();
	}
	function getModTime( path:String ):Float {
		return FileSystem.stat( path ).mtime.getTime();
	}

	

}

class ImageBaseApiAsync extends UFAsyncApi<ImageBaseApi> {}