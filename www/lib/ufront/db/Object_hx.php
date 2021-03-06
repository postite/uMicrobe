<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx
 */

namespace ufront\db;

use \tink\core\_Signal\Signal_Impl_;
use \tink\core\SignalObject;
use \ufront\db\_ValidationErrors\ValidationErrors_Impl_;
use \haxe\Unserializer;
use \haxe\ds\StringMap;
use \tink\core\SignalTrigger;
use \php\_Boot\HxException;
use \haxe\rtti\Meta;
use \php\Boot;
use \sys\db\Manager;
use \php\_Boot\HxString;
use \tink\core\Noise;
use \haxe\CallStack;
use \php\_Boot\HxAnon;
use \tink\core\_Callback\CallbackList_Impl_;
use \sys\db\Object_hx as DbObject_hx;
use \haxe\Serializer;

/**
 * Ufront DB Objects
 * This is the base class for models in Ufront's "Model, View, Controller" pattern.
 * Each model extends `ufront.db.Object`, and uses simple fields to describe what kind of data each of these objects will contain, and how that is saved to the database.
 * The type of each variable matches the type used in the database.
 * On the server, this class extends `sys.db.Object` and adds:
 * - a default unique `this.id` field (`SUId`, unsigned auto-incrementing integer)
 * - a `this.created` timestamp (`SDateTime`)
 * - a `this.modified` timestamps (`SDateTime`)
 * - modified `this.insert()` and `this.update()` methods that check validation and updates `this.created` and `this.modified` timestamps
 * - a `this.save()` method that performs either `this.insert()` or `this.update()`
 * - a `this.validate()` method that checks if the object is valid. This method is filled out with validation rules by a build macro.
 * - a `this.validationErrors` property to check which errors were found in validation.
 * - macro powered `this.hxSerialize()` and `this.hxUnserialize()` methods to ensure these objects serialize and unserialize nicely.
 * - a default `this.toString()` method that provides "${modelName}#${id}" eg "Person#23"
 * - a `save` signal
 * On the client, this *does not* longer extends `sys.db.Object`, so you can interact with your models even on targets that don't have access to the `sys.db` APIs - for example, Javascript in the browser.
 * This means that:
 * - Client side code can create, edit, and validate the objects.
 * - You can send objects back and forward using Haxe remoting, for example saving an object to the server, or retrieving a list from the server.
 * - When you unpack the object on the client it is fully typed, and you get full code re-use between client and server.
 * - They just can't save them back to the database, because you can't connect to (for example) MySQL directly.
 * - There is the experimental `ClientDS` library which allows you to save back to the server asynchronously using a remoting API.
 * You should use `-D server` or `-D client` defines in your hxml build file to help ufront know whether we're compiling for the server or client.
 * Build macro effects:
 * - Process `BelongsTo<T>`, `HasMany<T>`, `HasOne<T>` and `ManyToMany<A,B>` relationships and create the appropriate getters and setters.
 * - Add the appropriate validation checks to our `this.validate()` method.
 * - Save appropriate metadata for being able to serialize and unserialize correctly.
 * - On the server, create a `public static var manager:Manager<T> = new Manager(T)` property for each class.
 * - On the client, if using ClientDS, create a `public static var clientDS:ClientDS<T>` property for each class.
 */
class Object_hx extends DbObject_hx {
	/**
	 * @var Manager
	 * Even though it's non-sensical to have a manager on `ufront.db.Object`, the Haxe record macros (not the ufront ones) add a `__getManager` field if we don't have one (platforms other than neko.)
	 * This breaks things when you have an inheritance chain, where `ufront.db.Object` doesn't have a manager, but it's children do.
	 * As a workaround I'm putting this private static manager here.
	 */
	static public $manager;


	/**
	 * @var \Date
	 * The time this record was first created.
	 */
	public $created;
	/**
	 * @var \Array_hx
	 * An Array of all the properties that should be incuded in serialization of this object.
	 * By default, the values are pulled from the `@hxSerializationFields` metadata, which is set by the build macro.
	 * It will include all variables or properties that are saved to the database, meaning those that do not have `@:skip` metadata.
	 * If you would like to serialize a field that has `@:skip` metadata, you can include `@:includeInSerialization` metadata on the field.
	 * Relationships are not included in the serialization by default.
	 * To quickly and safely change the fields that will be included in serialization, see `DBSerializationTools`.
	 */
	public $hxSerializationFields;
	/**
	 * @var int
	 * A default ID. Auto-incrementing 32-bit Int.
	 */
	public $id;
	/**
	 * @var \Date
	 * The time this record was last modified.
	 */
	public $modified;
	/**
	 * @var SignalObject
	 * A signal that is triggered after a successful save.
	 */
	public $saved;
	/**
	 * @var SignalTrigger
	 */
	public $savedTrigger;
	/**
	 * @var StringMap
	 * If a call to validate() fails, it will populate this map with a list of errors.  The key should
	 * be the name of the field that failed validation, and the values should be a description of any errors.
	 */
	public $validationErrors;


	/**
	 * @return void
	 */
	public function __construct () {
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:85: characters 4-45
		$this->validationErrors = ValidationErrors_Impl_::_new();
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:86: characters 4-11
		parent::__construct();
	}


	/**
	 * The build macro will save override this method and populate it with validation statements.
	 * 
	 * @return void
	 */
	public function _validationsFromMacros () {
	}


	/**
	 * @return \Array_hx
	 */
	public function get_hxSerializationFields () {
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:300: lines 300-303
		if ($this->hxSerializationFields === null) {
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:301: characters 4-89
			$arr = Boot::dynamicField(Meta::getType(\Type::getClass($this)), 'hxSerializationFields');
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:302: characters 4-38
			$this->set_hxSerializationFields($arr->copy());
		}
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:304: characters 3-31
		return $this->hxSerializationFields;
	}


	/**
	 * @return SignalObject
	 */
	public function get_saved () {
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:279: lines 279-282
		if ($this->saved === null) {
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:280: characters 4-35
			$this->savedTrigger = Signal_Impl_::trigger();
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:281: characters 4-35
			$this->saved = $this->savedTrigger;
		}
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:283: characters 3-15
		return $this->saved;
	}


	/**
	 * Custom serialization.
	 * It will first serialize `hxSerializeFields` as a single string, so that the unserializer knows which properties to set.
	 * It will then serialize each property of `hxSerializeFields`, in order, using `Reflect.getProperty` to fetch the value.
	 * It will set `Serializer.useEnumIndex=true` and `Serializer.useCache=true`.
	 * 
	 * @param Serializer $s
	 * 
	 * @return void
	 */
	public function hxSerialize ($s) {
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:320: characters 3-24
		$s->useEnumIndex = true;
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:321: characters 3-21
		$s->useCache = false;
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:322: characters 3-49
		$s->serialize($this->get_hxSerializationFields()->join(","));
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:323: lines 323-325
		$_g = 0;
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:323: lines 323-325
		$_g1 = $this->get_hxSerializationFields();
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:323: lines 323-325
		while ($_g < $_g1->length) {
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:323: characters 9-10
			$f = ($_g1->arr[$_g] ?? null);
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:323: lines 323-325
			$_g = $_g + 1;
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:324: characters 4-46
			$s->serialize(\Reflect::getProperty($this, $f));
		}

	}


	/**
	 * Custom serialization.
	 * It will first unserialize `hxSerializeFields`, so that it knows which properties to set.
	 * It will then unserialize each item and use `Reflect.setProperty` to set the value.
	 * If `validationErrors` was not included in the serialization, it will be set to `new ValidationErrors()`.
	 * Any properties which were not set during serialization will remain in their default state.
	 * 
	 * @param Unserializer $s
	 * 
	 * @return void
	 */
	public function hxUnserialize ($s) {
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:337: characters 3-60
		$hxSerializationFieldsString = $s->unserialize();
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:338: characters 3-65
		$this->set_hxSerializationFields(\Array_hx::wrap(explode(",", $hxSerializationFieldsString)));
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:339: lines 339-341
		$_g = 0;
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:339: lines 339-341
		$_g1 = $this->get_hxSerializationFields();
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:339: lines 339-341
		while ($_g < $_g1->length) {
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:339: characters 9-10
			$f = ($_g1->arr[$_g] ?? null);
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:339: lines 339-341
			$_g = $_g + 1;
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:340: characters 4-49
			\Reflect::setProperty($this, $f, $s->unserialize());
		}

		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:342: lines 342-343
		if ($this->validationErrors === null) {
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:343: characters 4-50
			$this->validationErrors = ValidationErrors_Impl_::_new();
		}
	}


	/**
	 * Inserts a new record to the database.
	 * Will throw an error if `this.validate()` fails.
	 * Updates the "created" and "modified" timestamps before saving.
	 * 
	 * @return void
	 */
	public function insert () {
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:96: lines 96-106
		if ($this->validate()) {
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:97: characters 5-30
			$this->created = \Date::now();
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:98: characters 5-31
			$this->modified = \Date::now();
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:99: characters 5-19
			parent::insert();
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:100: lines 100-101
			if ($this->savedTrigger !== null) {
				#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:101: characters 6-35
				CallbackList_Impl_::invoke($this->savedTrigger->handlers, Noise::Noise());
			}
		} else {
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:104: characters 5-60
			$errors = \Lambda::array(ValidationErrors_Impl_::toSimpleMap($this->validationErrors))->join("\x0A");
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:105: characters 5-10
			throw new HxException("Data validation failed for " . (\Std::string($this)??'null') . ": \x0A" . ($errors??'null'));
		}
	}


	/**
	 * Refresh the relations on this object.
	 * Currently this does not refresh the object itself, it merely empties the cached related objects so they will be fetched again.
	 * In future we might get this to refresh the object itself from the database.
	 * 
	 * @return void
	 */
	public function refresh () {
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:158: characters 4-86
		$relArr = Boot::dynamicField(Meta::getType(\Type::getClass($this)), 'ufRelationships');
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:159: lines 159-162
		if ($relArr !== null) {
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:159: lines 159-162
			$_g = 0;
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:159: lines 159-162
			while ($_g < $relArr->length) {
				#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:159: characters 29-39
				$relDetails = ($relArr->arr[$_g] ?? null);
				#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:159: lines 159-162
				$_g = $_g + 1;
				#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:160: characters 5-46
				$fieldName = (\Array_hx::wrap(explode(",", $relDetails))->arr[0] ?? null);
				#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:161: characters 5-46
				\Reflect::setField($this, $fieldName, null);
			}
		}
	}


	/**
	 * Save a record (either inserting or updating) to the database.
	 * If `id` is null, then it needs to be inserted.
	 * If `id` already exists, try to update first.
	 * If that throws an error, it means that it is not inserted yet, so then insert it.
	 * Updates the "created" and "modified" timestamps as required.
	 * 
	 * @return void
	 */
	public function save () {
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:133: lines 133-149
		if ($this->id === null) {
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:134: characters 5-13
			$this->insert();
		} else {
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:137: lines 137-148
			try {
				#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:138: characters 14-31
				$this->_lock = true;
				#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:139: characters 6-14
				$this->update();
			} catch (\Throwable $__hx__caught_e) {
				CallStack::saveExceptionTrace($__hx__caught_e);
				$__hx__real_e = ($__hx__caught_e instanceof HxException ? $__hx__caught_e->e : $__hx__caught_e);
				$e = $__hx__real_e;
				#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:143: characters 6-70
				if (HxString::indexOf(\Std::string($e), "Data validation failed") !== -1) {
					#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:143: characters 65-70
					throw (is_object($__hx__throw = $e) && $__hx__throw instanceof \Throwable ? $__hx__throw : new HxException($__hx__throw));
				}
				#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:147: characters 6-14
				$this->insert();
			}
		}
	}


	/**
	 * @param \Array_hx $fields
	 * 
	 * @return \Array_hx
	 */
	public function set_hxSerializationFields ($fields) {
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:308: characters 3-40
		return $this->hxSerializationFields = $fields;
	}


	/**
	 * @return string
	 */
	public function toString () {
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:246: characters 3-58
		$modelName = \Type::getClassName(\Type::getClass($this));
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:247: characters 3-42
		$idStr = ($this->id !== null ? "" . ($this->id??'null') : "new");
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:248: characters 3-29
		return "" . ($modelName??'null') . "#" . ($idStr??'null');
	}


	/**
	 * Updates an existing record in the database.
	 * Will throw an error if `this.validate()` fails.
	 * Updates the "modified" timestamp before saving.
	 * 
	 * @return void
	 */
	public function update () {
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:115: lines 115-122
		if ($this->validate()) {
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:116: characters 5-31
			$this->modified = \Date::now();
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:117: characters 5-19
			parent::update();
		} else {
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:120: characters 5-60
			$errors = \Lambda::array(ValidationErrors_Impl_::toSimpleMap($this->validationErrors))->join(", ");
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:121: characters 5-10
			throw new HxException("Data validation failed for " . (\Std::string($this)??'null') . ": " . ($errors??'null'));
		}
	}


	/**
	 * A function to validate the current model.
	 * By default, this checks that no values are null unless they are Null<T> / SNull<T>, or if it the unique ID
	 * that will be automatically generated.  If any are null when they shouldn't be, the model fails to validate.
	 * It also looks for "validate_{fieldName}" functions, and if they match, it executes the function.  If the function
	 * throws an error or returns false, then validation will fail.
	 * If you override this method to add more custom validation, then we recommend starting with `super.validate()` and
	 * ending with `return validationErrors.isValid;`
	 * 
	 * @return bool
	 */
	public function validate () {
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:267: lines 267-268
		if ($this->validationErrors === null) {
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:267: characters 34-75
			$this->validationErrors = ValidationErrors_Impl_::_new();
		} else {
			#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:268: characters 8-32
			ValidationErrors_Impl_::reset($this->validationErrors);
		}
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:270: characters 3-27
		$this->_validationsFromMacros();
		#/usr/local/lib/haxe/lib/ufront-orm/1,1,0/src/ufront/db/Object.hx:272: characters 10-34
		return ValidationErrors_Impl_::get_length($this->validationErrors) === 0;
	}


	public function __toString() {
		return $this->toString();
	}


	/**
	 * @internal
	 * @access private
	 */
	static public function __hx__init ()
	{
		static $called = false;
		if ($called) return;
		$called = true;


self::$manager = new Manager(Boot::getClass(Object_hx::class));
	}
}


Boot::registerClass(Object_hx::class, 'ufront.db.Object');
Boot::registerMeta(Object_hx::class, new HxAnon(["obj" => new HxAnon([
	"rtti" => \Array_hx::wrap(["oy7:hfieldsby8:modifiedoy4:nameR1y1:tjy17:sys.db.RecordType:11:0y6:isNullfgy7:createdoR2R6R3r3R5fgy2:idoR2R7R3jR4:0:0R5fghR2y6:Objecty9:relationsahy7:indexesahy6:fieldsar5r4r2hy3:keyaR7hg"]),
	"noTable" => null,
])]));
Boot::registerGetters('ufront\\db\\Object', [
	'hxSerializationFields' => true,
	'saved' => true
]);
Boot::registerSetters('ufront\\db\\Object', [
	'hxSerializationFields' => true
]);
Object_hx::__hx__init();
