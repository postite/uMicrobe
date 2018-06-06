package microbe.comps.molecules;
import microbe.comps.atoms.*;
import microbe.Microbe;
import microbe.comps.Atom;
import tink.CoreApi;
import microbe.Microbe;
using StringTools;
using microbe.tools.PostData;
import ufront.MVC;
import microbe.signal.OrderSignal;
#if js
import postite.Sortable;
#end

class OrderedListWrapper<T:{liste:List<ufront.db.Object>,mod:String,action:String}> extends Molecule<T> implements Microbe<T>{

	public static var signal:OrderSignal= new OrderSignal();
	//var pr:Dynamic;
	var fexec:Future<Array<HttpContext->Void>>;
	var fdata:Future<Array<Void->Dynamic>>;
	public function render():String{
		var xarray = [];
		var darray = [];
		var buf= new StringBuf();
		buf.add("ordered list");
		buf.add('<ul id="orderedList" class="list-group">');
		for (item in data.liste){
			var editLink=data.action+'/${data.mod}/${item.id}';
			var item=new OrderableItem({item:item,link:editLink});
			buf.add(item.render());
			xarray.push(Future.sync(item.execute));	
			darray.push(Future.sync(item.getData));
		}
		fexec = Future.ofMany(xarray);
		fdata=Future.ofMany(darray);
		buf.add("</ul>");
		return buf.toString();
	}

	public function execute(ctx):Void{
		trace( "i'm a Listwrapper");
		//signal=new OrderSignal();
		#if client
		var sortable= new Sortable(js.Browser.document.getElementById("orderedList"),
			{onSort:sortList}
			);
		// executes microbe children
		fexec.handle(function(t:Array<HttpContext->Void>)
			t.map(function(fun) 
				fun(ctx)
			 )
			);
		
		#end
	}
	#if client
	private function sortList(evt:SortEvent){
		trace("yo");
		untyped (console.log("popopo"));
		untyped console.log(Sortable.active.toArray());
		signal.dispatch(Sortable.active.toArray());
		untyped console.log(evt);
	}
	#end

	override function gatherData():Formule{
		#if client
		var formule:Formule = new Map();
		fdata.handle(function(t:Array<Void->Dynamic>)
			t.map(function(fun){
				var k=fun();
				formule.set(k.n,k.v);
				//untyped console.log(fun());
			} )
			);

		return formule;
		#end
		return null;

	}

	// function onState(e:String,state:Dynamic):Bool{
	// 	var formule=gatherData();
	// 	//var xstate={};
	// 	for ( f in formule.keys()){
	// 		Reflect.setField(state,f,formule.get(f));
	// 	}
	// 	state.serializeStatePostData();
	// 	untyped console.log(state);
	// 	#if client
	// 	pushstate.PushState.removePreventer(pr);
 //      	pr=null;
 //      	#end
	// 	return true;
	// }


}

class OrderableItem<T:{item:Dynamic,link:String}> extends Atom<T> implements Microbe<T>{

	var pr:Dynamic;
	public function render():String{
		return '<li data-id="${data.item.pozID}">${data.item.titre}</li>';

		return '<li ${getId()} class="list-group-item">
		<span >+++</span>
		<a href="${data.link}" rel="pushstate">
		${data.item.id}
		</a></li>';

		
	} 
	public function execute(ctx){

		trace( "yo OrderableItem");
		 #if client

		 
		// if(pr==null)
  // 		pr=pushstate.PushState.addPreventer(onState);
  		#end

	}
	function onState(url:String,state:Dynamic):Bool{

		trace("item url="+url);
		// var formule=gatherData();
		// //var xstate={};
		// for ( f in formule.keys()){
		// 	Reflect.setField(state,f,formule.get(f));
		// }
		// state.serializeStatePostData();
		//untyped console.log(state);
		#if client
		pushstate.PushState.removePreventer(pr);
      	pr=null;
      	#end
		return true;
	}

}