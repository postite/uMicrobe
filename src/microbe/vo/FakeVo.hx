package microbe.vo;



class FakeVo extends ufront.db.Object implements microbe.macros.Parasite{

// #if server
// public static var manager = new ChapterManager(Chapter);
// #end
@microbe("description","TextInput")
public var text:sys.db.Types.SString<256>;
@microbe("titre","TextInput")
public var titre:sys.db.Types.SString<256>;


}

