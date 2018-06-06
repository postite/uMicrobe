package microbe.macros;
import haxe.macro.Expr;
import haxe.macro.Context;

@:remove @:autoBuild(microbe.macros.ParasiteImpl.build())
extern interface Parasite {

}

class ParasiteImpl {


#if macro
  public static function build() {
     var model=Context.getLocalModule();
   
    var model=Context.getLocalClass().get();
   
    var fields = Context.getBuildFields();
    var args = [];
    var states = [];
    var map : Array<Expr> = [];
    var noms=["name","comp","relation","relationB","prio"];

    map.push(macro "model" => {name:$v{model.module}});
    //map.push(macro "model" => {name:$v{model.name}});
    

    for (f in fields) {
    
      switch (f.meta){

        case [p]://trace(p.name  +" " +f.name );
          if (p.name=="microbe"){
          var count=0;
           var top={};
           var name:String;
           //trace( "top= "+top);
                for( par in p.params){
                switch (par.expr) {
                  case EConst(CString(s)):
                 //  trace(s);
                  
                  Reflect.setField(top,noms[count],$v{s});
                  name=$v{f.name};
                  //$v{top}.push($v{s});
                  //trace( "name="+name);
                  count++;
                 // map.push(macro  new Map().set($v{f.name},$v{s}));
                  case _:
                }
               // trace ("name="+f.name );
                
                }//end loop
                 map.push(macro $v{f.name} => $v{top});
               }//end if microbe
        case []: //trace ("nope");
      }

      // switch (f.kind) {
      //   case FVar(t,_):
      //     args.push({name:f.name, type:t, opt:false, value:null});
      //     states.push(macro $p{["this", f.name]} = $i{f.name});
      //     f.access.push(APublic);
      //   default:
      // }
    }
    fields.push({
      // The line position that will be referenced on error
      pos: Context.currentPos(),
      // Field name
      name: "formule",
      // Attached metadata (we are not adding any)
      meta: null,
      // Field type is Map<String, String>, `map` is the map
      kind: FieldType.FVar(macro : Map<String, Dynamic>, macro $a{map}),
      // Documentation (we are not adding any)
      doc: null,
      // Field visibility
      access: [Access.APublic, Access.AStatic]
    });
  
    return fields;
  }
#end
}