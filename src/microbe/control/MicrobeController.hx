package microbe.control;
import ufront.MVC;
using ufront.core.AsyncTools;
import microbe.comps.atoms.*;
import microbe.comps.molecules.*;
import microbe.comps.molecules.Login;
import microbe.result.MicrobeResult;
using tink.CoreApi;
import microbe.macros.Parasite;
import microbe.apis.*;
using microbe.control.MicrobeController;
import microbe.apis.MicrobialApi.MicrobialApiAsync;

@:less("microbeLayout.less")
@viewFolder("microbe")
//@layout("microbeLayout.html")
class MicrobeController extends Controller {

	@inject
	public var microbeApi:MicrobialApiAsync;
	
	@inject('models')
	public var models:Array<Dynamic>;

	@inject('micPath')
	public var micPath:String;
		/*
	@inject('rootUrl')
	public var rootUrl:String; 

	@inject
	public var orderApi:OrderApi;
	*/
	@post
	public function init(){
	ViewResult.globalValues.set("mods",models);//move 2 api ?
	ViewResult.globalValues.set("micPath",micPath);
	ViewResult.globalHelpers.set("microbeFarm",function(n)return "");
	ViewResult.globalPartials.set("voList", TFromEngine("/microbe/voList.html",TemplatingEngines.haxe));
	//ViewResult.globalPartials.set("voList", TFromString(CompileTime.readFile("../www/view/microbe/voList.html"),TemplatingEngines.haxe));
	ViewResult.globalPartials.set("items", TFromEngine("/microbe/items.html",TemplatingEngines.haxe));
	//ViewResult.globalPartials.set("items", TFromString(CompileTime.readFile("../www/view/microbe/items.html"),TemplatingEngines.haxe));
	ViewResult.globalPartials.set("form", TFromEngine("/microbe/form.html",TemplatingEngines.haxe));
	//ViewResult.globalPartials.set("form", TFromString(CompileTime.readFile("../www/view/microbe/form.html"),TemplatingEngines.haxe));
//	ViewResult.globalPartials.set("footer", TFromEngine("footer.html",TemplatingEngines.haxe));
	//ViewResult.globalPartials.set("footer", TFromEngine("sketchfooter/_layout.html",TemplatingEngines.haxe));
	//ViewResult.globalPartials.set("header", TFromEngine("header.html",TemplatingEngines.haxe));
	//ViewResult.globalPartials.set("side", TFromEngine("Side/index.html",TemplatingEngines.haxe));
	//ViewResult.globalValues.set("basePath", basePath);
	
	//result.GlobalPartialViewResult.transitionTimeout=2;
	
	}
	
	public static function wrapInLayout( title:String, template:String, data:TemplateData ):ViewResult {
		return new ViewResult( data )
			.setVar( "title", title )
			.usingTemplateString(
				template,
				CompileTime.readFile( "../www/view/microbe/microbeLayout.html" )
			);
	}

	@:route("/")
	public function index()
	{
		ufTrace("indox"+models);
		ViewResult.globalValues.set("items",[]);
		
			//ufTrace(untyped a.formule);
var template = CompileTime.readFile( "../www/view/microbe/index.html");
return wrapInLayout("mic",template,{})
	   // return new ViewResult({})
	    .addPartialString("microbeFarm","hellomicrobe",ufront.view.TemplatingEngines.haxe);

	}


	@:route("/mods/list/$name")
	public function mods(name:String)
	{
		return microbeApi.getAllModels(name).asPromise().next(function (items) {
ufLog("back"+items+name);
				ViewResult.globalValues.set("items",items);
				ViewResult.globalValues.set("mod",name);
			return new PartialViewResult({mod:name,items:items},"index");
			
			
		}
			).recover(function (n){
				ufLog("mods");

				return cast new PartialViewResult({mod:name,items:[]},"index").asFuture();
				
			});
	    

	}
	@:route("/mods/plus/$name")
	public function plus(name:String)
	{

		return insert(name);
	    

	}

	

	@:route("/insert/$mod")
	public function insert(mod:String){

		return microbeApi.getFormuleFromString(mod).asPromise()
		// .next(function (f) {
		// 	  microbeApi.getAllModels(mod).asPromise().next(function(items)
		// 	 	return ViewResult.globalValues.set("items",items)
		// 	 	);
		// 	  ufTrace("erto="+ViewResult.globalValues.get("items"));
		// 	 return f;
		// })
		.next(function (formule) {
			ufTrace(formule);
			//ViewResult.globalValues.set("items",[]); //hack to remove 
			return new MicrobeModelResult(mod,
	     	new microbe.comps.wrappers.FormuleWrapper(formule),
	     	//new microbe.comps.wrappers.FakeWrapper(formule),
	     	''
	     	);
		})
		
		.recover(function (n)
			return cast new ContentResult(Std.string("erreur"+n)).asFuture()
			);


		// return microbeApi.getFormuleFromString(mod).map(
		// 	function(o){
		// 		switch(o){
		// 			case Success(formule):
		// 			return new MicrobeModelResult(mod,
	 //     	//new microbe.comps.wrappers.AsyncSimpleWrapper(formule,this.context),
	 //     	new microbe.comps.wrappers.FormuleWrapper(formule),
	 //     	''
	 //     	);
		// 			case Failure(r):
		// 			return cast new ContentResult(Std.string("erreur"+r));
		// 		}
		// 	});

	    // 	    return new ViewResult({},"index.html")
	    // .addPartialString("microbeFarm","hello",ufront.view.TemplatingEngines.haxe);
	     
	}
	@:route("/affiche/$mod/mod/$id")
	public function update(mod:String,id:Int){
		return microbeApi.getDataFormule(mod,id).map(
			function(o){
				switch(o){
					case Success(formule):
					return new MicrobeModelResult(mod,
	     	new microbe.comps.wrappers.FormuleWrapper(formule),
	     	''
	     	);
					case Failure(r):
					return cast new ContentResult(Std.string(r));
				}
			});

	    // 	    return new ViewResult({},"index.html")
	    // .addPartialString("microbeFarm","hello",ufront.view.TemplatingEngines.haxe);
	     
	}

	@:route("/setup/$mod")
	public function setup(mod:String){
		return microbeApi.setupTable(mod).asPromise().next(
				function (l){
					 return new ContentResult("ok table créée");
					
					}	
				
			).recover(function(e)
				return null
				//return new ContentResult("prob table")
			);
	}


	public static inline function reloadGlobalVars(api:MicrobialApiAsync,mod):Promise<List<ufront.db.Object>>{
		trace("reloadGlobalVars");
		if( ViewResult.globalValues.get("items")==null)
					 return api.getAllModels(mod).asPromise().next(
						(items)->{
							ViewResult.globalValues.set("items",items);
							
							return items;
						
						}

					);
		ViewResult.globalValues.set("mod",mod);
		
		return cast Future.sync(Success(ViewResult.globalValues.get("items"))).asPromise();
		
		
	}


	public static inline function asPromise<T>(surp:Surprise<T,Error>):tink.core.Promise<T>{
		return (surp:Promise<T>);
	}

	/**
	@:route("/testApi/$mod/$id")
	public function testApi(?mod:String,?id:Int)
	{
		var spod:ufront.db.Object=microbeApi.getModelFromString(mod,id);
	   return new ContentResult(haxe.Json.stringify(spod));
	   
	}
	
	@:route("/testFormule/$mod/$id")
	public function testFormule(mod:String,?id:Int)
	{
		var formule=null;
		if(id==null)
		formule=microbeApi.getFormuleFromString(mod);
	    
		else 
		 formule=microbeApi.getDataFormule(mod,id);
	    ufTrace( formule);
	    
	    return new MicrobeModelResult(mod,
	    	new microbe.comps.molecules.SimpleWrapper(formule),
	    	'/microbe/testSave/$mod/$id'
	    	);
	}

	@:route("/listAndFormule/$mod/")
	public function listAndFormule(mod:String){

		var formule:microbe.Microbe.Formule=null;
		
		formule=microbeApi.getFormuleFromString(mod);
		
		
		var liste=microbeApi.getAllFromString(mod);

		return new MicrobeModelResultList({liste:liste,mod:mod},mod,
			new microbe.comps.molecules.SimpleWrapper(formule),
	    	'/microbe/testSave/$mod/'
	    	);



	}

	
	@:route(GET,"/$postSlug/edit/")
	public function editPost( postSlug:String ):FutureActionOutcome {
		PartialViewResult.startLoadingAnimations();
		var post:Surprise<BlogPost,Error> =  blogApi.getPostBySlug( postSlug );
		// `getPostBySlug` returns a `Surprise<BlogPost,TypedError<...>>`
		// Because TypedError is invariant with Error when used in a Surprise, the overload does transformation 3.v not 3.i (from the docs)
		// Then we get `Surprise<Outcome<ActionResult,TypedError>,Error>` instead of `Surprise<ActionResult,Error>`.
		// TODO: See if we can improve this. Either in tink or in ufront.
		return post >> showForm;
	}
	function showForm( post:BlogPost ):FutureActionOutcome {
		context.auth.requirePermission( BlogPermissions.WritePost );
		return blogTagApi.getAllTags() >> function( tags:Array<BlogTag> ):ActionResult {
			var title = (post.title=="") ? "New Post" : '"${post.title}"';
			return new PartialViewResult({
				title: 'Editing $title',
				description: "",
				post: post,
				tags: tags,
			}, "postForm.erazor" )
			.setVars( BlogUtil.addPermissionValues(context) )
			.addClientAction( SetupEditFormAction );
		}
	}
	


	@:route("/editListItem/$mod/$id")
	public function editListItem(mod:String,id:Int){
		
		var liste=microbeApi.getAllFromString(mod);
		var formule=microbeApi.getDataFormule(mod,id);
	    ufTrace( formule);
	    
	    return new MicrobeModelResultList({liste:liste,mod:mod},mod,
	    	new microbe.comps.molecules.SimpleWrapper(formule),
	    	'/microbe/testSave/$mod/$id'
	    	);
	}

	@:route("/editOrderedListItem/$mod/$id")
	public function editOrderedListItem(mod:String,id:Int){
		
		var liste=microbeApi.getAllFromString(mod);
		var formule=microbeApi.getDataFormule(mod,id);
	    ufTrace( formule);
	    
	    return new MicrobeModelResultOrderedList({liste:liste,mod:mod,action:'${baseUri}editOrderedListItem'},mod,
			new microbe.comps.molecules.SimpleWrapper(formule),
	    	'/microbe/testSave/$mod/$id'
	    	);
	}


	@:route("/OrderedlistAndFormule/$mod")
	public function OrderedlistAndFormule(mod:String){

		var formule:microbe.Microbe.Formule=null;
		
		formule=microbeApi.getFormuleFromString(mod);
		
		
		//var liste=microbeApi.getAllFromString(mod);
		var liste=orderApi.getOrded(mod);
		return new MicrobeModelResultOrderedList({liste:liste,mod:mod,action:'${baseUri}editOrderedListItem'},mod,
			new microbe.comps.molecules.SimpleWrapper(formule),
	    	'/microbe/testSave/$mod/'
	    	);



	}
	@:route("/testComplexFormule/")
	public function testComplexFormule(){
			return new ContentResult("not implemented");
	}

	// action form 
	@:route(POST,"/testSave/$mod/$id")
	public function testSave(mod:String,?id:Int)
	{
	  	var valided=microbeApi.recModelFromString(mod,this.context.request.params,id);
	  	switch(valided){
	  		case Success(b):ufTrace(b);
	  		case Failure(r):ufTrace(r);
	  	}	
	   //return new RedirectResult('/microbe/testFormule/$mod/$id');
	}
	@:route("/testCollection/$mod")
	public function testCollection(mod:String){
		var listed =orderApi.newCollec();
		return new MicrobeModelResultOrderedList({liste:listed,mod:mod,action:'${baseUri}editOrderedListItem'},mod,
			new microbe.comps.molecules.LabelField(new Pair("op",{v:null,n:"null"})),
	    	'/microbe/testSave/$mod/'
	    	);

	}
	**/
}