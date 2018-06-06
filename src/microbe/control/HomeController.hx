package microbe.control;
import ufront.MVC;


import tink.CoreApi;
using microbe.control.MicrobeController;


class HomeController extends Controller {

@:route('/')
public function index()
{
    ufTrace("yuzu");
    
  // new microbe.model.Article();
  
    return new RedirectResult("/microbe");
}
@:route('/microbe/*')
public var mic:MicrobeController;
 
}