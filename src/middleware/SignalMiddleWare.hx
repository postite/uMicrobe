package middleware;

import ufront.web.context.HttpContext;
import ufront.app.UFMiddleware;
import ufront.app.HttpApplication;
import tink.CoreApi;
import ufront.web.HttpError;
import ufront.core.AsyncTools;
import middleware.ResponseSignal;
import  ufront.web.context.HttpContext.RequestCompletion;

/**

just for testing signals but no luck with the dom
**/

import msignal.Signal;

class SignalMiddleWare implements UFMiddleware {
	

	public function new() {


	}


	
	public function requestIn( ctx:HttpContext ):Surprise<Noise,Error> {
		untyped __js__("console.log('Signal requestIn')");
		
		//not filled before 
		var signal= ctx.injector.getValue(ResponseSignal);
		//signal.requestIn.dispatch(ctx.actionContext.action);
		
		return	 SurpriseTools.success();
	}

	/**
	
	**/
	public function responseOut( ctx:HttpContext ):Surprise<Noise,Error> {
		untyped __js__("console.log('requestOut')");
		var signal= ctx.injector.getValue(ResponseSignal);
		
		 
		var suc= SurpriseTools.success();
		suc.map(function (n){
			untyped __js__("console.log('successOut')");
			signal.requestOut.dispatch(signal.response);
		});
		return  suc;
	}
}