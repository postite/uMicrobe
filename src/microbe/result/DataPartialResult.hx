package microbe.result;


import ufront.web.result.ViewResult;
import ufront.web.result.PartialViewResult;
#if client
	import ufront.view.TemplateData;
	import ufront.view.TemplatingEngines;
	import ufront.web.context.ActionContext;
	import js.ufront.web.context.HttpResponse;
	import js.Browser.*;
	import js.html.*;
#end
//using thx.Strings;

class DataPartialResult extends ViewResult {



	#if client
		/**
		Create a new PartialViewResult, with the specified data.
		This will call `startLoadingAnimations()` immediately, adding the `uf-partial-outgoing` class to any existing partials.
		@param data (optional) Some initial template data to set. If not supplied, an empty {} object will be used.
		@param viewPath (optional) A specific view path to use. If not supplied, it will be inferred based on the `ActionContext` in `this.executeResult()`.
		@param templatingEngine (optional) A specific templating engine to use for the view. If not supplied, it will be inferred based on the `viewPath` in `this.executeResult()`.
		**/
		public function new( ?data:TemplateData, ?viewPath:String, ?templatingEngine:TemplatingEngine ) {
			super( data, viewPath, templatingEngine );
			//startLoadingAnimations();
			
			
		}

	

override function writeResponse( response:String, actionContext:ActionContext ) {
			var res = actionContext.httpContext.response;
			res.contentType = "text/html";
			trace("writeResponse ");
			var newDoc = document.implementation.createHTMLDocument("");
			newDoc.documentElement.innerHTML = response;
			untyped console.log(newDoc.toString());
			if ( getAttr(document.body,"data-uf-layout")==getAttr(newDoc.body,"data-uf-layout") ) {
				//trace("layout partial");
				document.title = newDoc.title;
				var oldPartialNodes = document.querySelectorAll( "[data-uf-partial]" );
				for ( i in 0...oldPartialNodes.length ) {

					var oldPartialNode = Std.instance( oldPartialNodes.item(i), Element );
					var partialName = getAttr( oldPartialNode, "data-uf-partial" );
					var newPartialNode = newDoc.querySelector('[data-uf-partial=$partialName]');
					untyped console.log("newPartialNode="+newPartialNode);
					untyped console.log("partialName="+partialName );
					var timeout = Std.parseInt( getAttr(oldPartialNode, "data-uf-transition-timeout") );
					if ( timeout==null )
						timeout = PartialViewResult.transitionTimeout;
					if(newPartialNode !=null){
					newPartialNode.classList.add( 'uf-partial-incoming' );
					if( partialName!="menu"){
						//trace( "partial have changed" +partialName );
						//trace( "diff="+ differs(oldPartialNode.innerHTML,newPartialNode.innerHTML,70));
					HttpResponse.replaceNode( oldPartialNode, newPartialNode, timeout );
					}
					window.setTimeout(function() {
						newPartialNode.classList.remove( 'uf-partial-incoming' );
					}, 1);
				}
				}
				window.scrollTo( 0, 0 );
				//HttpResponse.reloadScripts( document );
				

				HttpResponse.reloadScripts( document );
				res.preventFlushContent();
				//super.writeResponse( response, actionContext );
			}
			else {
				trace( "else");
				// If it is a different layout, we leave it to `HttpResponse.flush` to render from scratch.
				super.writeResponse( response, actionContext );
			}
			trace( "requestIn");
			var signal=actionContext.httpContext.injector.getInstance(middleware.ResponseSignal);
				signal.response=response;
				 signal.data=data;
				 signal.requestIn.dispatch(actionContext.action);
		}

		static function getAttr( elm:Element, name:String ):Null<String> {
			if ( elm!=null ) {
				var attributeNode = elm.attributes.getNamedItem( name );
				return (attributeNode!=null) ? attributeNode.value : null;
			}
			return null;
		}
	#end


	// function differs(str1:String,str2:String,offset:Int=30):String{
	// 	var charat=str1.diffAt(str2)-10;
	// 	return str1.substr(charat,offset)+","+str2.substr(charat,offset);
	// }

}
