package microbe.views;
import ufront.MVC;
class ViewTools{
  public function new(){
  }
  public static function wrapInLayout( title:String, template:String, data:TemplateData ):ViewResult {
		return new PartialViewResult( data )
			.setVar( "title", title )
			.usingTemplateString(
				template,
				CompileTime.readFile( "../www/view/microbe/microbeLayout.html" )
			);
	}
}