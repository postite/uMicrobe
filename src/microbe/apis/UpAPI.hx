package microbe.apis;

import ufront.MVC;

#if server
	import sys.FileSystem;
	import sys.io.FileOutput;
	//import haxe.imagemagick.Imagick;
	import image.Image;
#end
using tink.CoreApi;
using StringTools;
using haxe.io.Path;
using ufront.core.AsyncTools;
import ufront.web.upload.BrowserFileUpload;

import haxe.crypto.BaseCode;

class UpApi extends UFApi {

	@inject("contentDirectory") 
	public var contentDir:String;
	@inject('upsPath') 
	public var upsPath:String;

	public function uploadImage(  upload:UFFileUpload ):Surprise<String,Error> {		
		//return Success("oyé").asSurprise();
		var dir = '.$upsPath';//contentDir+'ups';
		if ( FileSystem.exists(dir)==false )
			FileSystem.createDirectory( dir );
		var path = dir+"/"+upload.originalFileName;
		// return upload.writeToFile( path ) >> function (n:Noise):String {

		// 	return '$upsPath/${upload.originalFileName.urlEncode()}';
		// }
		return upload.writeToFile( path ).map(function(n) {
			
			return Success('$upsPath/${upload.originalFileName.urlEncode()}');
		});
	}

	public function uploadBytes(upBytes:haxe.io.Bytes,pos:Int,len:Int,name:String):Surprise<Noise,Error> {
		
		var dir = '.$upsPath/temp';//contentDir+'ups';
		 if ( FileSystem.exists(dir)==false )
		 	FileSystem.createDirectory( dir );
		// 	sys.io.File.saveBytes(dir,upBytes);
		// }else{
							

		var fo:FileOutput = sys.io.File.append(dir+"/"+name, false);
		fo.write(upBytes);
		//fo.writeString(Std.string(pos+"->"+len)+"\n");
		fo.close();
		
		
		
		
		
		return Noise.asGoodSurprise();
	}

	// public function uploadHeaderImage( postID:DatabaseID<BlogPost>, upload:UFFileUpload ):Surprise<String,Error> {
	// 	auth.requirePermission( BlogPermissions.WritePost );
	// 	var result = uploadImage( postID, upload );
	// 	var post = BlogPost.manager.get( postID );
	// 	post.headerImage = upload.originalFileName;
	// 	post.save();
	// 	return result;
	// }

	// /**
	// Get the path for a resized version of an image.

	//- If the resized image does not exist in the expected `${width}x${height}` subdirectory, then it will be created and the new path returned.
	//- If the resized image already exists, the new path to it will be returned.
	//- If the path doesn't have the extension `jpg`, `jpeg`, `png`, or `gif` then the original path will be returned.
	//**/
	// public function getResizedImage( path:String, ?newWidth:Int, ?newHeight:Int ):Surprise<String,Error> {
	// 	if ( ['gif','jpg','jpeg','png'].indexOf(path.extension().toLowerCase())==-1 )
	// 		return path;
	// 	if ( newWidth==null && newHeight==null )
	// 		newWidth = 300; // TODO: make this configurable.
	// 	var ratioName =
	// 		if (newWidth!=null && newHeight!=null) '${newWidth}x${newHeight}'
	// 		else if (newWidth!=null)'${newWidth}xAUTO'
	// 		else 'AUTOx${newHeight}';
	// 	var dir = path.directory().addTrailingSlash() + ratioName;
	// 	var newPath = dir + "/" + path.withoutDirectory();
	// 	if ( FileSystem.exists(newPath)==false || getModTime(path)>getModTime(newPath) ) {
	// 		FileSystem.createDirectory( dir );
	// 		var img = new Imagick( path );
	// 		if ( newHeight==null ) {
	// 			var ratio = img.width / img.height;
	// 			newHeight = Math.round( newWidth/ratio );
	// 		}
	// 		if ( newWidth==null ) {
	// 			var ratio = img.width / img.height;
	// 			newWidth = Math.round( ratio*newHeight );
	// 		}
	// 		if ( newWidth<img.width && newHeight<img.height ) {
	// 			img.resize( newWidth, newHeight );
	// 		}
	// 		img.setCompressionQuality( 75 );
	// 		img.save( newPath );
	// 	}
	// 	return newPath.asGoodSurprise();
	// }
	// public function getResizedImage(path:String, ?newWidth:Int, ?newHeight:Int ):Surprise<String,Error> {
	// 	if ( ['gif','jpg','jpeg','png'].indexOf(path.extension().toLowerCase())==-1 )
	// 		return path.asGoodSurprise();
	// 	// if ( newWidth==null && newHeight==null )
	// 	// 	newWidth = 300; // TODO: make this configurable.
	// 	// var ratioName =
	// 	// 	if (newWidth!=null && newHeight!=null) '${newWidth}x${newHeight}'
	// 	// 	else if (newWidth!=null)'${newWidth}xAUTO'
	// 	// 	else 'AUTOx${newHeight}';
	// 	var dir = path.directory().addTrailingSlash() + "thumb";
	// 	var thumbPath = "."+dir + "/" + path.withoutDirectory();
	// 	var relativeThumbPath=dir + "/" + path.withoutDirectory();

	// 	 if ( FileSystem.exists(thumbPath)==false || getModTime("."+path)>getModTime(thumbPath) ) {
	// 	 	FileSystem.createDirectory( "."+dir );

	// 		return Image.resize("."+path, thumbPath, {engine: Engine.GD, width: 200, height: 200})
	// 		.map(function (res) return switch res {

	// case Success(_):

 //    	Success(relativeThumbPath);
 //    case Failure(error):
 //    	ufLog("ici");
 //    	Failure(error);
	// });
	
	// 	 }
	// 	 ufLog("là bas");
	// 	 return relativeThumbPath.asGoodSurprise();
	// }
	// function getModTime( path:String ):Float {
	// 	return FileSystem.stat( path ).mtime.getTime();
	// }
}
class UpApiAsync extends UFAsyncApi<UpApi> {}
