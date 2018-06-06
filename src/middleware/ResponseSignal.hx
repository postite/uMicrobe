package middleware;


import msignal.Signal;

class ResponseSignal extends Signal1<String> {


	//made for ClientResult 
	/*
	@param string1: actionContext.action ="/url"
	@param string2: data:String = template
	 */
	public var response:String;
	public var data:Dynamic;
	public var clientFlushed:Signal2<String,String>=new Signal2();
	public var requestIn:Signal1<String>= new Signal1();
	public var requestOut:Signal1<String>= new Signal1();
	public function new() {
		super(String);
	}

	
}