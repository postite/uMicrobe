package microbe.result;
using ufront.web.result.CallJavascriptResult;
using ufront.MVC;
using tink.CoreApi;
using ufront.web.result.AddClientActionResult;
import ufront.web.result.PartialViewResult;
import microbe.comps.atoms.*;
import microbe.comps.molecules.*;
import microbe.result.DataPartialResult;
import microbe.Microbe;
import microbe.FormGenerator;
import microbe.IMicrobeWrapper;
import microbe.views.ViewTools.*;
/**
	We need a way to trigger a re-render in our react app.
	Here we use a PartialViewResult with ClientAction to do that.
**/

abstract MicrobeResult<T>(AddClientActionResult<PartialViewResult, Microbe<T>>) to AddClientActionResult<PartialViewResult, Microbe<T>>
{
	public function new(comp:Microbe<T>,?formUrl:String,?classes:Array<String>){
		this = cast new DataPartialResult({}, "/microbe/index.html")
		.addPartialString('microbeForm',new FormGenerator(formUrl,classes).setData(comp.data).generate(comp),ufront.view.TemplatingEngines.haxe)
		.addClientAction(MicrobeAction,comp);
	}
}

abstract MicrobeListResult<T>(AddClientActionResult<PartialViewResult, Microbe<T>>) to AddClientActionResult<PartialViewResult, Microbe<T>>
{
	public function new(data:Dynamic,wrapper:Microbe<T>,?formUrl:String,?classes:Array<String>){
		
		this =   cast new DataPartialResult({}, "/microbe/liste.html")
		.addPartialString('microbeForm',new FormGenerator(formUrl,classes).setData(data).generate(wrapper),ufront.view.TemplatingEngines.haxe)
		.addClientAction(MicrobeAction,wrapper);
	}
}

abstract MicrobeModelResult<T>(AddClientActionResult<ViewResult,IMicrobeWrapper<T>>) to AddClientActionResult<ViewResult, IMicrobeWrapper<T>>
{
		public function new(model:String,wrapper:IMicrobeWrapper<T>,?formUrl:String,?classes:Array<String>){
		wrapper.setFormUrl(formUrl);
		this = cast new DataPartialResult({},"/microbe/index.html")
		.addPartialString('microbeFarm',new ModelFormGenerator(formUrl,classes).setData(wrapper.data).generate(wrapper),ufront.view.TemplatingEngines.haxe)
		#if client
		.addClientAction(MicrobeAction,wrapper)
		
		#else
		.addClientAction(MicrobeAction,wrapper)
		#end
		;
	}
}
abstract MicrobeModelCompileResult<T>(AddClientActionResult<ViewResult,IMicrobeWrapper<T>>) to AddClientActionResult<ViewResult, IMicrobeWrapper<T>>
{
		public function new(model:String,wrapper:IMicrobeWrapper<T>,?formUrl:String,?classes:Array<String>){
		wrapper.setFormUrl(formUrl);
		
		//this = cast new DataPartialResult({},null)
		var template=CompileTime.readFile( "../www/view/microbe/index.html");
		this=cast wrapInLayout("mic",template,{})
		//.usingTemplateString(CompileTime.readFile( "../www/view/microbe/index.html"),TemplatingEngines.haxe)
		.addPartialString('microbeFarm',new ModelFormGenerator(formUrl,classes).setData(wrapper.data).generate(wrapper),ufront.view.TemplatingEngines.haxe)
		#if client
		.addClientAction(MicrobeAction,wrapper)
		
		#else
		.addClientAction(MicrobeAction,wrapper)
		#end
		;
	}
}
// abstract MicrobeModelAsyncResult<T>(AddClientActionResult<ViewResult,Microbe<T>>) to AddClientActionResult<ViewResult, Microbe<T>>
// {
// 		public function new(model:String,comp:Microbe<T>,?action:String,?classes:Array<String>){
// 		this = cast new DataPartialResult({},"/microbe/index.html")
// 		.addPartialString('microbeFarm',new ModelFormGenerator(action,classes).setData(comp.data).generate(comp),ufront.view.TemplatingEngines.haxe)
// 		.addClientAction(MicrobeAction,comp);
// 	}

// }
abstract MicrobeModelResultList<T>(AddClientActionResult<PartialViewResult,IMicrobeWrapper<T>>) to AddClientActionResult<PartialViewResult,IMicrobeWrapper<T>>
{
	public function new (data:Dynamic,model:String,wrapper:IMicrobeWrapper<T>,?formUrl:String,?classes:Array<String>){
		this = cast new DataPartialResult(data,"/microbe/listModel.html")
		#if server
				.addPartialString('addon',"select !",ufront.view.TemplatingEngines.haxe)

		#end 
		#if client
		.addPartialString('addon',new ModelFormGenerator(formUrl,classes).setData(wrapper.data).generate(wrapper),ufront.view.TemplatingEngines.haxe)
		//.addClientAction(MicrobeAction,comp
		.addClientAction(MicrobeListAction,wrapper)
		#end;
	}
}
abstract MicrobeModelResultOrderedList<T>(AddClientActionResult<PartialViewResult,IMicrobeWrapper<T>>) to AddClientActionResult<PartialViewResult,IMicrobeWrapper<T>>
{
	public function new (data:Dynamic,model:String,wrapper:IMicrobeWrapper<T>,?formUrl:String,?classes:Array<String>){
		var listComp=new OrderedListWrapper(data,classes);
		this = cast new DataPartialResult(data,"/microbe/OrderedlistModel.html")
		.addPartialString('listed',listComp.render(),ufront.view.TemplatingEngines.haxe)
		.addPartialString('addon',new ModelFormGenerator(formUrl,classes).setData(wrapper.data).generate(wrapper),ufront.view.TemplatingEngines.haxe)
		.addClientAction(MicrobeListAction,listComp);
	}
}

// class RenderPageAction extends UFClientAction<RenderPageActionData>
// {
// 	override public function execute(httpContext:HttpContext, ?data:RenderPageActionData)
// 	{
// 		// store the current injector for use in react components
// 		Client.injector = httpContext.injector;
		
// 		// create and mount the react app if not yet done so
// 		if(Client.reactApp == null) Client.reactApp = cast ReactDOM.render(jsx('<App/>'), js.Browser.document.getElementById("app"));
		
// 		// set the contents
// 		Client.reactApp.setState({content: data.content});
// 	}
// }
// 


class MicrobeAction<Dynamic> extends UFClientAction<Microbe<Dynamic>>
{
	override public function execute(httpContext:HttpContext, ?comp:Microbe<Dynamic>)
	{
		
	
		haxe.Timer.delay(function(){
		comp.execute(httpContext);
		trace("microAct");
		}
		,500 );
		
		
	}
}


class MicrobeListAction<Dynamic> extends UFClientAction<Microbe<Dynamic>>
{
	//@inject public var signal:middleware.ResponseSignal;
	//@inject public var orderApi:apis.OrderApi;
	override public function execute(httpContext:HttpContext, ?comp:Microbe<Dynamic>)
	{
		// store the current injector for use in react components
		//Client.injector = httpContext.injector;
		
		ufTrace( "hey microbe list action");
		//signal.requestIn.add(function(e)comp.execute());
		//haxe.Timer.delay(comp.execute,200);
		haxe.Timer.delay(function() 
		//	trace("yo"+comp)
			comp.execute(httpContext)
		,200 );
		// microbe.comps.molecules.OrderedListWrapper.signal.addOnce(
		// 	function(ord:Array<String>){
				
		// 		ufTrace(orderApi.rec(ord));
		// 	}

		// 	);
		//comp.execute();
		// create and mount the react app if not yet done so
		// if(Client.reactApp == null) Client.reactApp = cast ReactDOM.render(jsx('<App/>'), js.Browser.document.getElementById("app"));
		
		// // set the contents
		// Client.reactApp.setState({content: data.content});
	}
}



// #else

// // on server-side it is just a plain view result
// abstract MicrobeResult<T>(PartialViewResult) to PartialViewResult
// {
// 	public inline function new(_,_,_)
// 		this = new PartialViewResult({}, "/form/index.html");
// }

// #end