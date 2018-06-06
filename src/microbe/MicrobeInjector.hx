package microbe;
import minject.Injector;


class MicrobeInjector  {
	public static function inject(injector:Injector) {
		microbe.FormGenerator.injector=injector;
		injector.map(String,"upsPath").toValue("/ups");
        injector.map(String,"assetPath").toValue("/assets");
        injector.map(String,"micPath").toValue("microbe");
	}
}