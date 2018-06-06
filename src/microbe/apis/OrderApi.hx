package microbe.apis;
import ufront.api.*;
import tink.core.Future;
//import microbe.model.Collection.IOrderable;
import microbe.model.Collection;
import microbe.MicroSpod;
import ufront.db.Object;
class OrderApi extends UFApi {
	

	
	public function rec(order:Array<String>):String {

		var collection= microbe.model.Collection.manager.all();
		var counter=0;
		collection.map(function(c){

			if( order.indexOf(Std.string(c.id))!=-1)
				c.posi=order.indexOf(Std.string(c.id))+1;
			
			c.save();
		});
		return "opla" +order;
	}

	public function getOrded(?classe:Class<Object>,?modString:String):List<Object>
	{
		if( classe!=null)
			return AutomateOrderByClass(classe);
		if (modString!=null)
			return AutomateOrderByString(modString);
		return null;
	}

	public function newCollec(?classe:Class<Object>):List<IOrderable>{

		var chaps=getOrded(IOrderable);
		var counter=1;

	for (chap in chaps){
		var col= new Collection();

		if( untyped chap.poz==null){
		col.item=cast chap;
		col.posi=counter;
		col.save();

		untyped chap.poz=col;
		chap.save();
		counter= counter+1;
		}
	}

		
		
		return cast getOrded(classe);
		
	}



	private function AutomateOrderByString(mod:String):List<Object>{
			var modClass=MicroSpod.getModelClassFromString(mod);
			return AutomateOrderByClass(modClass);
	}
	private function AutomateOrderByClass(mod:Class<Object>):List<Object>{

		var modManager= MicroSpod.getManager(mod);
		var collectionManager=Collection.manager;
		var atable=modManager.dbInfos().name;
		var btable=collectionManager.dbInfos().name;

		var sql='Select $atable.*
from $atable INNER JOIN $btable
ON ${atable}.pozID = ${btable}.id
Order By ${btable}.posi';

	return modManager.unsafeObjects(sql,true);


	}

	

	

}
class OrdedApiAsync extends UFAsyncApi<OrderApi> {}
