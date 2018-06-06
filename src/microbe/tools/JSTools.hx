package microbe.tools;

class JSTools{

		// bouge ça dans des outils ... c'est cool ..
	public static function retente(fn:Void->Void,times:Int=3){
        try{
            fn();
        }catch(msg:Dynamic){
            trace( "nope" +msg);
            if(times>0)       
            haxe.Timer.delay(retente.bind(fn,--times),500);
        	else
        		throw (msg);
        }
    }
} 