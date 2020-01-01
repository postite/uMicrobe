package microbe.extern;

typedef MediumOptions={
	?activeButtonClass:String,// 'medium-editor-button-active',
    ?allowMultiParagraphSelection:Bool,// true,
    ?buttonLabels:Bool,// false,
    ?contentWindow:js.html.Window,// window,
    ?delay:Int,//0
    ?disableReturn:Bool,//false
    ?disableDoubleReturn: Bool,//false
    ?disableExtraSpaces: Bool,//false
    ?disableEditing: Bool,//false
    ?elementsContainer: Bool,//false
    ?extensions: Dynamic,//{}
    ?ownerDocument: js.html.Document,
    ?spellcheck: Bool,//true
    ?targetBlank: Bool,//false

    ?toolbar:Toolbar,

    ?anchorPreview:AnchorPreview,

    ?placeholder:PlaceHolder,
    ?paste:Paste

}

typedef PlaceHolder= {
        /* This example includes the default options for placeholder,
           if nothing is passed this is what it used */
        ?text:String// 'Type your text'
    }

typedef AnchorPreview={
	
        /* These are the default options for anchor preview,
           if nothing is passed this is what it used */
        ?hideDelay:Int,// 500,
        ?previewValueSelector:String// 'a'
    
}

typedef Toolbar={
	/* These are the default options for the toolbar,
           if nothing is passed this is what is used */
        ?allowMultiParagraphSelection:Bool,// true,
        ?buttons:Array<{name:String,contentDefault:String}>,//['bold', 'italic', 'underline', 'anchor', 'h2', 'h3', 'quote'],
        ?diffLeft:Int,// 0,
        ?diffTop:Int,// -10,
        ?firstButtonClass:String, //'medium-editor-button-first',
        ?lastButtonClass:String, //'medium-editor-button-last',
        ?standardizeSelectionStart:Bool,// false,

        //reserved keyWord shit !
        //static: Bool,//false,

        /* options which only apply when static is true */
        ?align: String,//'center',
        ?sticky:Bool,// false,
        ?updateOnEmptySelection:Bool// false
}


typedef Paste= {
        /* This example includes the default options for paste,
           if nothing is passed this is what it used */
        ?forcePlainText:Bool,// true,
        ?cleanPastedHTML:Bool,//false,
        ?cleanReplacements:Array<Dynamic>,// [],Custom pairs (2 element arrays) of RegExp and replacement text to use during paste when forcePlainText or cleanPastedHTML are true OR when calling cleanPaste(text) helper method
        ?cleanAttrs:Array<String>,// ['class', 'style', 'dir'],
        ?cleanTags:Array<String>// ['meta']
    }

@:native("MediumEditor")
extern class Medium {


	public  function new(?element:String,?elements:Array<String>,options:MediumOptions);
    // {
	// 	return untyped __js__("new MediumEditor()")(element,options);
	// }

    public static  var version:Dynamic;
    public function destroy():Void;

    //*not tested above
    public function getContent(?index:Int=0):String;
    public function serialize():String;
    //static public function getEditorFromElement(element:js.html.Element):Medium{};
}