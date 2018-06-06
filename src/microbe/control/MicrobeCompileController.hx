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
import microbe.views.ViewTools.*;
@:less("microbeLayout.less")
//@viewFolder("microbe")
//@layout("microbeLayout.html")
class MicrobeCompileController extends Controller {

	@inject
	public var microbeApi:microbe.apis.MicrobialApi.MicrobialApiAsync;
	
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
	//ViewResult.globalPartials.set("voList", TFromEngine("/microbe/voList.html",TemplatingEngines.haxe));
	ViewResult.globalPartials.set("voList", TFromString(CompileTime.readFile("../www/view/microbe/voList.html"),TemplatingEngines.haxe));
	//ViewResult.globalPartials.set("items", TFromEngine("/microbe/items.html",TemplatingEngines.haxe));
	ViewResult.globalPartials.set("items", TFromString(CompileTime.readFile("../www/view/microbe/items.html"),TemplatingEngines.haxe));
	//ViewResult.globalPartials.set("form", TFromEngine("/microbe/form.html",TemplatingEngines.haxe));
	ViewResult.globalPartials.set("form", TFromString(CompileTime.readFile("../www/view/microbe/form.html"),TemplatingEngines.haxe));
//	ViewResult.globalPartials.set("footer", TFromEngine("footer.html",TemplatingEngines.haxe));
	//ViewResult.globalPartials.set("footer", TFromEngine("sketchfooter/_layout.html",TemplatingEngines.haxe));
	//ViewResult.globalPartials.set("header", TFromEngine("header.html",TemplatingEngines.haxe));
	//ViewResult.globalPartials.set("side", TFromEngine("Side/index.html",TemplatingEngines.haxe));
	//ViewResult.globalValues.set("basePath", basePath);
	
	//result.GlobalPartialViewResult.transitionTimeout=2;
	
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
			//return new PartialViewResult({mod:name,items:items},"index");
			ufLog("bock"+items+name);
			//return  new ContentResult("rood");
			var template=CompileTime.readFile( "../www/view/microbe/index.html");
			return wrapInLayout("mic",template,{mod:name,items:items});
			//return new PartialViewResult({mod:name,items:items},null)
			//.usingTemplateString(CompileTime.readFile( "../www/view/microbe/index.html"),TemplatingEngines.haxe);

		}
			).recover(function (n){
				ufLog("mods");

				//return cast new PartialViewResult({mod:name,items:[]},"index").asFuture();
				return cast new ContentResult("ret"+n).asFuture();
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
		.next(
				(formule)->{
					return MicrobeController.reloadGlobalVars(microbeApi,mod).next(
						items->formule
					);
					
				}
			)
		
		.next(function (formule) {
			ufTrace("items=>>>"+ViewResult.globalValues.get("items"));
			var wrap=new microbe.comps.wrappers.FormuleWrapper(formule);
				#if client wrap.status.add((s)->
				{untyped console.log('status=$s');
					switch(s){
						case Rec(id):
						ViewResult.globalValues.set("items",null);
						pushstate.PushState.push('/microbe/affiche/$mod/mod/$id');
						case Abort:throw new Error("bam");
						case(_):untyped console.log('status=$s');
					}
				});#end
			return new MicrobeModelCompileResult(mod,wrap,'');
		})
		
		.recover(function (n)
			return cast new ContentResult(Std.string("erreur"+n)).asFuture()
			);


		
	     
	}
	@:route("/affiche/$mod/mod/$id")
	public function update(mod:String,id:Int){
		//#if server
			return microbeApi.getDataFormule(mod,id).asPromise()
			.next(
				(formule)->
					return MicrobeController.reloadGlobalVars(microbeApi,mod).next(
						items->formule) 	
			)
			.next(
				(formule) -> {
					ufTrace("items=>>>"+ViewResult.globalValues.get("items"));
					ViewResult.globalValues.set("mod",mod);
					return new MicrobeModelCompileResult(mod,
	     	new microbe.comps.wrappers.FormuleWrapper(formule),'');
					
				}
			).recover(
				(err) -> cast new ContentResult(Std.string(err)).asFuture()
			);

	// 		#else
	// 	return microbeApi.getDataFormule(mod,id).map(
	// 		function(o){
	// 			switch(o){
	// 				case Success(formule):
	// 				return new MicrobeModelCompileResult(mod,
	//      	new microbe.comps.wrappers.FormuleWrapper(formule),
	//      	''
	//      	);
	// 				case Failure(r):
	// 				return cast new ContentResult(Std.string(r));
	// 			}
	// 		});
			
	// #end
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