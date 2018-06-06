package app;
import ufront.MVC;
import ufront.app.UfrontApplication;
import control.*;
 
import middleware.ResponseSignal;

using Lambda;
//import ufront.web.upload.BrowserFileUploadMiddleware;
//import middleware.ResponseSignal;
//import ufront.auth.api.*;
@:less('app.less')
class App {
	

   #if server static public var ufApp:UfrontApplication;#end
	#if client static public var ufApp:ClientJsApplication; #end

	public function new() {
		
		trace("yoo");
        
	}

	static public function main(){
        CompileTime.importPackage("microbe.comps.atoms");
        CompileTime.importPackage("microbe.comps.molecules");
        CompileTime.importPackage("model");
        CompileTime.importPackage("microbe.model");
		#if server
		ufApp = new UfrontApplication({
            indexController: microbe.control.HomeController,
            remotingApi: app.Apis,
            logFile:"logs/app.log",
            
             
          
            templatingEngines: [TemplatingEngines.haxe,TemplatingEngines.erazor],
           
            
            defaultLayout: "microbe/microbeLayout.html",
            
           
        });

      
       
        inject();
        
      
        
        run();

        #elseif client
			// Initialise the app on the client and respond to "pushstate" requests as a single-page-app.
			   ufApp = new ClientJsApplication({
				indexController: microbe.control.HomeController,
          
				templatingEngines: [TemplatingEngines.haxe,TemplatingEngines.erazor],
				defaultLayout: "microbe/microbeLayout.html",
        requestMiddleware:[     
       new middleware.SignalMiddleWare()],
   responseMiddleware:[new middleware.SignalMiddleWare()],
    
                
                               
                                
             


			});

            inject();
          
			
			ufApp.listen();

      ufApp.configuration.clientActions.map(function(n)
        untyped console.log(n));
		  #end
	}

	#if server
	static function run() 
    {
    	//trace(" run");
        //
    	#if sqlite
      try{
       
        var cnx = sys.db.Sqlite.open("table.db");
     

      
        sys.db.Transaction.main(cnx, function () 
        {
           ufApp.executeRequest();
        });
      }catch(msg:Dynamic){
        throw msg;
      }
        
        #end
        

        
    }
    #end
    
   static function inject(){

    
      var m:Array<Dynamic>=[microbe.model.Article,
                              microbe.vo.FakeVo

        ];
      var models=m.map(function (n)return {name:Type.getClassName(n)} ).array();
      ufApp.injector.map('Array<Dynamic>','models').toValue(models);
       microbe.MicrobeInjector.inject(ufApp.injector);

        
        ufApp.injector.map(String,"basePath").toValue("http://localhost:8888");
        /*
        ufApp.injector.map(String,"upUrl").toValue("/up");
        ufApp.injector.map(String,"upsPath").toValue("/ups");
          
        

       ufApp.injector.map(String,"assetPath").toValue("/assets");
      #if neko 
       ufApp.injector.map(String,"rootUrl").toValue("http://localhost:2000");
    #elseif php
       ufApp.injector.map(String,"rootUrl").toValue("http://localhost:8888");
       #end
       #if client 
       ufApp.injector.map(String,"rootUrl").toValue("http://localhost:8888");
       #end
       */
        //ufApp.injector.map(app.model.InstaModel).asSingleton();
        // Execute the main request.
        
        ufApp.injector.map(ResponseSignal).asSingleton();
        
    }
    
}