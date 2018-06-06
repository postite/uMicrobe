package microbe.model;

class Article extends ufront.db.Object implements microbe.macros.Parasite{

	@microbe("titre","TextInput")
	public var titre:sys.db.Types.SString<256>;

	@microbe("illustration","UpApiComp")
	public var src:Null<sys.db.Types.SString<256>>;

	@microbe("content","MediumEditor")
	public var content:sys.db.Types.SText;

	

}