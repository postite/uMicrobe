<?php

// Generated by Haxe 3.4.7
class microbe_apis_MicrobialApi extends ufront_api_UFApi {
	public function __construct() { if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("microbe.apis.MicrobialApi::new");
		$__hx__spos = $GLOBALS['%s']->length;
		parent::__construct();
		$GLOBALS['%s']->pop();
	}}
	public function recModel($mod, $data, $id = null) {
		$GLOBALS['%s']->push("microbe.apis.MicrobialApi::recModel");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$GLOBALS['%s']->pop();
			return null;
		}
		$GLOBALS['%s']->pop();
	}
	public function delete($formule) {
		$GLOBALS['%s']->push("microbe.apis.MicrobialApi::delete");
		$__hx__spos = $GLOBALS['%s']->length;
		$modClass = microbe_MicroSpod::getModelClassFromString(_hx_field($formule->get("model"), "name"), null);
		$manager = microbe_MicroSpod::getManager($modClass);
		$spod = null;
		try {
			$spod = $manager->unsafeGet(Std::parseInt(_hx_field($formule->get("model"), "id")), true);
			$spod->delete();
			{
				$tmp = ufront_core_SurpriseTools::asGoodSurprise(tink_core_Noise::$Noise);
				$GLOBALS['%s']->pop();
				return $tmp;
			}
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
			$msh = $_ex_;
			{
				$GLOBALS['%e'] = (new _hx_array(array()));
				while($GLOBALS['%s']->length >= $__hx__spos) {
					$GLOBALS['%e']->unshift($GLOBALS['%s']->pop());
				}
				$GLOBALS['%s']->push($GLOBALS['%e'][0]);
				{
					$tmp = ufront_core_SurpriseTools::asSurprise(tink_core_Outcome::Failure($msh));
					$GLOBALS['%s']->pop();
					return $tmp;
				}
			}
		}
		$GLOBALS['%s']->pop();
	}
	public function getModel($mod, $id = null) {
		$GLOBALS['%s']->push("microbe.apis.MicrobialApi::getModel");
		$__hx__spos = $GLOBALS['%s']->length;
		$formule = microbe_MicroSpod::getFormule($mod);
		$manager = microbe_MicroSpod::getManager($mod);
		{
			$tmp = $manager->unsafeGet($id, true);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function getAllModels($mod) {
		$GLOBALS['%s']->push("microbe.apis.MicrobialApi::getAllModels");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->messages->push(_hx_anonymous(array("msg" => "all muds", "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 72, "className" => "microbe.apis.MicrobialApi", "methodName" => "getAllModels")), "type" => ufront_log_MessageType::$MLog)));
		$modClass = microbe_MicroSpod::getModelClassFromString($mod, null);
		$manager = microbe_MicroSpod::getManager($modClass);
		if(sys_db_TableCreate::exists($manager)) {
			$tmp = ufront_core_SurpriseTools::asGoodSurprise($manager->all(null));
			$GLOBALS['%s']->pop();
			return $tmp;
		} else {
			$tmp = ufront_core_SurpriseTools::asBadSurprise(new tink_core_TypedError(null, "pas de table", _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 78, "className" => "microbe.apis.MicrobialApi", "methodName" => "getAllModels"))));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function recFromFormule($formule) {
		$GLOBALS['%s']->push("microbe.apis.MicrobialApi::recFromFormule");
		$__hx__spos = $GLOBALS['%s']->length;
		{
			$tmp = ufront_core_SurpriseTools::asSurprise($this->recFormule($formule));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function testRecFormule($formule) {
		$GLOBALS['%s']->push("microbe.apis.MicrobialApi::testRecFormule");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->messages->push(_hx_anonymous(array("msg" => $formule, "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 94, "className" => "microbe.apis.MicrobialApi", "methodName" => "testRecFormule")), "type" => ufront_log_MessageType::$MLog)));
		$modClass = microbe_MicroSpod::getModelClassFromString(_hx_field($formule->get("model"), "name"), null);
		$manager = microbe_MicroSpod::getManager($modClass);
		$spod = null;
		if(_hx_field($formule->get("model"), "id") !== null) {
			$spod = $manager->unsafeGet(_hx_field($formule->get("model"), "id"), true);
		} else {
			$spod = Type::createInstance($modClass, (new _hx_array(array())));
		}
		{
			$tmp = tink_core_Outcome::Success("yes testRecFormule");
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function recFormule($formule) {
		$GLOBALS['%s']->push("microbe.apis.MicrobialApi::recFormule");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->messages->push(_hx_anonymous(array("msg" => $formule, "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 108, "className" => "microbe.apis.MicrobialApi", "methodName" => "recFormule")), "type" => ufront_log_MessageType::$MLog)));
		$modClass = microbe_MicroSpod::getModelClassFromString(_hx_field($formule->get("model"), "name"), null);
		$manager = microbe_MicroSpod::getManager($modClass);
		$spod = null;
		if(_hx_field($formule->get("model"), "id") !== null) {
			$spod = $manager->unsafeGet(Std::parseInt(_hx_field($formule->get("model"), "id")), true);
		} else {
			$spod = Type::createInstance($modClass, (new _hx_array(array())));
		}
		$this->messages->push(_hx_anonymous(array("msg" => "afterSpod" . _hx_string_rec($spod->id, ""), "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 118, "className" => "microbe.apis.MicrobialApi", "methodName" => "recFormule")), "type" => ufront_log_MessageType::$MLog)));
		{
			$field = $formule->keys();
			while($field->hasNext()) {
				$field1 = $field->next();
				if($field1 === "model") {
					continue;
				}
				$val = _hx_field($formule->get($field1), "data");
				$this->messages->push(_hx_anonymous(array("msg" => $val, "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 127, "className" => "microbe.apis.MicrobialApi", "methodName" => "recFormule")), "type" => ufront_log_MessageType::$MLog)));
				$tmp = null;
				if(_hx_equal(_hx_field($formule->get($field1), "relation"), "many")) {
					$tmp = $val !== null;
				} else {
					$tmp = false;
				}
				if($tmp) {
					$this->messages->push(_hx_anonymous(array("msg" => "many", "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 132, "className" => "microbe.apis.MicrobialApi", "methodName" => "recFormule")), "type" => ufront_log_MessageType::$MLog)));
					$relationmanager = microbe_MicroSpod::getManager(_hx_field(Reflect::getProperty($spod, $field1), "b"));
					$dependencies = $relationmanager->all(null);
					$this->messages->push(_hx_anonymous(array("msg" => "many manager", "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 140, "className" => "microbe.apis.MicrobialApi", "methodName" => "recFormule")), "type" => ufront_log_MessageType::$MLog)));
					$inside = $dependencies->filter(array(new _hx_lambda(array(&$val), "microbe_apis_MicrobialApi_0"), 'execute'));
					$this->messages->push(_hx_anonymous(array("msg" => "many inside", "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 143, "className" => "microbe.apis.MicrobialApi", "methodName" => "recFormule")), "type" => ufront_log_MessageType::$MLog)));
					Reflect::getProperty($spod, $field1)->setList($inside);
					$this->messages->push(_hx_anonymous(array("msg" => "many done", "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 146, "className" => "microbe.apis.MicrobialApi", "methodName" => "recFormule")), "type" => ufront_log_MessageType::$MLog)));
					unset($relationmanager,$inside,$dependencies);
				} else {
					if(_hx_equal(_hx_field($formule->get($field1), "relation"), "one")) {
						$this->messages->push(_hx_anonymous(array("msg" => "one", "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 149, "className" => "microbe.apis.MicrobialApi", "methodName" => "recFormule")), "type" => ufront_log_MessageType::$MLog)));
						$relationmanager1 = microbe_MicroSpod::getManager(microbe_MicroSpod::getModelClassFullPath(_hx_field($formule->get($field1), "relationB")));
						$this->messages->push(_hx_anonymous(array("msg" => $relationmanager1, "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 152, "className" => "microbe.apis.MicrobialApi", "methodName" => "recFormule")), "type" => ufront_log_MessageType::$MLog)));
						$dependencie = $relationmanager1->unsafeGet($val[0], true);
						Reflect::setProperty($spod, $field1, $dependencie);
						$this->messages->push(_hx_anonymous(array("msg" => "one done", "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 163, "className" => "microbe.apis.MicrobialApi", "methodName" => "recFormule")), "type" => ufront_log_MessageType::$MLog)));
						unset($relationmanager1,$dependencie);
					} else {
						if(Std::is($val, _hx_qtype("Array"))) {
							$val = $val[0];
						}
						Reflect::setProperty($spod, $field1, $val);
					}
				}
				unset($val,$tmp,$field1);
			}
		}
		$spod->validate();
		$this->messages->push(_hx_anonymous(array("msg" => "validate", "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 175, "className" => "microbe.apis.MicrobialApi", "methodName" => "recFormule")), "type" => ufront_log_MessageType::$MLog)));
		try {
			$this->messages->push(_hx_anonymous(array("msg" => "before Save", "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 179, "className" => "microbe.apis.MicrobialApi", "methodName" => "recFormule")), "type" => ufront_log_MessageType::$MLog)));
			$spod->save();
			$this->messages->push(_hx_anonymous(array("msg" => "after Save", "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 181, "className" => "microbe.apis.MicrobialApi", "methodName" => "recFormule")), "type" => ufront_log_MessageType::$MLog)));
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
			$msg = $_ex_;
			{
				$GLOBALS['%e'] = (new _hx_array(array()));
				while($GLOBALS['%s']->length >= $__hx__spos) {
					$GLOBALS['%e']->unshift($GLOBALS['%s']->pop());
				}
				$GLOBALS['%s']->push($GLOBALS['%e'][0]);
				$this->messages->push(_hx_anonymous(array("msg" => "error Save  fait une vraie errur ici merde !", "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 183, "className" => "microbe.apis.MicrobialApi", "methodName" => "recFormule")), "type" => ufront_log_MessageType::$MLog)));
				{
					$tmp = tink_core_Outcome::Failure($spod->validationErrors);
					$GLOBALS['%s']->pop();
					return $tmp;
				}
			}
		}
		$this->messages->push(_hx_anonymous(array("msg" => "before Success", "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 191, "className" => "microbe.apis.MicrobialApi", "methodName" => "recFormule")), "type" => ufront_log_MessageType::$MLog)));
		{
			$tmp = tink_core_Outcome::Success(Std::string($spod->id));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function getDataFormule($mod, $id = null) {
		$GLOBALS['%s']->push("microbe.apis.MicrobialApi::getDataFormule");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->messages->push(_hx_anonymous(array("msg" => "getDataFormule", "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 196, "className" => "microbe.apis.MicrobialApi", "methodName" => "getDataFormule")), "type" => ufront_log_MessageType::$MLog)));
		$modClass = microbe_MicroSpod::getModelClassFromString($mod, null);
		$spod = $this->getModel($modClass, $id);
		{
			$tmp = ufront_core_SurpriseTools::asGoodSurprise(microbe_MicroSpod::getDataFormuleVO($spod));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function recModelFromString($mod, $data = null, $id = null) {
		$GLOBALS['%s']->push("microbe.apis.MicrobialApi::recModelFromString");
		$__hx__spos = $GLOBALS['%s']->length;
		if($data === null) {
			$data = php_Web::getParams();
		}
		$this->messages->push(_hx_anonymous(array("msg" => $data, "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 265, "className" => "microbe.apis.MicrobialApi", "methodName" => "recModelFromString")), "type" => ufront_log_MessageType::$MLog)));
		$modClass = microbe_MicroSpod::getModelClassFromString($mod, null);
		$manager = microbe_MicroSpod::getManager($modClass);
		$spod = null;
		if($id !== null) {
			$spod = $manager->unsafeGet($id, true);
		} else {
			$spod = Type::createInstance($modClass, (new _hx_array(array())));
		}
		$this->messages->push(_hx_anonymous(array("msg" => "afterSpod", "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 276, "className" => "microbe.apis.MicrobialApi", "methodName" => "recModelFromString")), "type" => ufront_log_MessageType::$MLog)));
		$formule = microbe_MicroSpod::getFormule($modClass);
		{
			$field = $formule->keys();
			while($field->hasNext()) {
				$field1 = $field->next();
				$val = $data->get($field1);
				$this->messages->push(_hx_anonymous(array("msg" => $val, "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 284, "className" => "microbe.apis.MicrobialApi", "methodName" => "recModelFromString")), "type" => ufront_log_MessageType::$MLog)));
				$tmp = null;
				if(_hx_equal(_hx_field($formule->get($field1), "relation"), "many")) {
					$tmp = $val !== null;
				} else {
					$tmp = false;
				}
				if($tmp) {
					$this->messages->push(_hx_anonymous(array("msg" => "many", "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 289, "className" => "microbe.apis.MicrobialApi", "methodName" => "recModelFromString")), "type" => ufront_log_MessageType::$MLog)));
					$relationmanager = microbe_MicroSpod::getManager(_hx_field(Reflect::getProperty($spod, $field1), "b"));
					$dependencies = $relationmanager->all(null);
					$this->messages->push(_hx_anonymous(array("msg" => "many manager", "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 297, "className" => "microbe.apis.MicrobialApi", "methodName" => "recModelFromString")), "type" => ufront_log_MessageType::$MLog)));
					$inside = $dependencies->filter(array(new _hx_lambda(array(&$val), "microbe_apis_MicrobialApi_1"), 'execute'));
					$this->messages->push(_hx_anonymous(array("msg" => "many inside", "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 300, "className" => "microbe.apis.MicrobialApi", "methodName" => "recModelFromString")), "type" => ufront_log_MessageType::$MLog)));
					Reflect::getProperty($spod, $field1)->setList($inside);
					$this->messages->push(_hx_anonymous(array("msg" => "many done", "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 303, "className" => "microbe.apis.MicrobialApi", "methodName" => "recModelFromString")), "type" => ufront_log_MessageType::$MLog)));
					unset($relationmanager,$inside,$dependencies);
				} else {
					if(Std::is($val, _hx_qtype("Array"))) {
						$val = $val[0];
					}
					Reflect::setProperty($spod, $field1, $val);
				}
				unset($val,$tmp,$field1);
			}
		}
		$spod->validate();
		try {
			$spod->save();
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
			$msg = $_ex_;
			{
				$GLOBALS['%e'] = (new _hx_array(array()));
				while($GLOBALS['%s']->length >= $__hx__spos) {
					$GLOBALS['%e']->unshift($GLOBALS['%s']->pop());
				}
				$GLOBALS['%s']->push($GLOBALS['%e'][0]);
				{
					$tmp = ufront_core_SurpriseTools::asSurprise(tink_core_Outcome::Failure($spod->validationErrors));
					$GLOBALS['%s']->pop();
					return $tmp;
				}
			}
		}
		{
			$tmp = ufront_core_SurpriseTools::asSurprise(tink_core_Outcome::Success($spod->id));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function getFormuleFromString($mod) {
		$GLOBALS['%s']->push("microbe.apis.MicrobialApi::getFormuleFromString");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->messages->push(_hx_anonymous(array("msg" => "modClass=" . _hx_string_or_null($mod), "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 354, "className" => "microbe.apis.MicrobialApi", "methodName" => "getFormuleFromString")), "type" => ufront_log_MessageType::$MLog)));
		$modClass = microbe_MicroSpod::getModelClassFromString($mod, null);
		{
			$tmp = ufront_core_SurpriseTools::asSurprise(tink_core_Outcome::Success(microbe_MicroSpod::getFormule($modClass)));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function getAllFromString($mod) {
		$GLOBALS['%s']->push("microbe.apis.MicrobialApi::getAllFromString");
		$__hx__spos = $GLOBALS['%s']->length;
		$modClass = microbe_MicroSpod::getModelClassFromString($mod, null);
		$manager = microbe_MicroSpod::getManager($modClass);
		{
			$tmp = ufront_core_SurpriseTools::asGoodSurprise($manager->all(null));
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function setupTable($mod) {
		$GLOBALS['%s']->push("microbe.apis.MicrobialApi::setupTable");
		$__hx__spos = $GLOBALS['%s']->length;
		$this->messages->push(_hx_anonymous(array("msg" => $mod, "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 377, "className" => "microbe.apis.MicrobialApi", "methodName" => "setupTable")), "type" => ufront_log_MessageType::$MLog)));
		$modClass = microbe_MicroSpod::getModelClassFromString($mod, null);
		try {
			$manager = microbe_MicroSpod::getManager($modClass);
			$this->messages->push(_hx_anonymous(array("msg" => $modClass->formule, "pos" => _hx_anonymous(array("fileName" => "MicrobialApi.hx", "lineNumber" => 385, "className" => "microbe.apis.MicrobialApi", "methodName" => "setupTable")), "type" => ufront_log_MessageType::$MLog)));
			if(!sys_db_TableCreate::exists($manager)) {
				sys_db_TableCreate::create($manager, null);
			} else {
				throw new HException("table existe");
			}
			{
				$tmp = ufront_core_SurpriseTools::asSurprise(tink_core_Outcome::Success(tink_core_Noise::$Noise));
				$GLOBALS['%s']->pop();
				return $tmp;
			}
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
			$msg = $_ex_;
			{
				$GLOBALS['%e'] = (new _hx_array(array()));
				while($GLOBALS['%s']->length >= $__hx__spos) {
					$GLOBALS['%e']->unshift($GLOBALS['%s']->pop());
				}
				$GLOBALS['%s']->push($GLOBALS['%e'][0]);
				{
					$tmp = ufront_core_SurpriseTools::asSurprise(tink_core_Outcome::Failure($msg));
					$GLOBALS['%s']->pop();
					return $tmp;
				}
			}
		}
		$GLOBALS['%s']->pop();
	}
	public function combineDataFormule() {
		$GLOBALS['%s']->push("microbe.apis.MicrobialApi::combineDataFormule");
		$__hx__spos = $GLOBALS['%s']->length;
		$GLOBALS['%s']->pop();
	}
	static function __meta__() { $args = func_get_args(); return call_user_func_array(self::$__meta__, $args); }
	static $__meta__;
	function __toString() { return 'microbe.apis.MicrobialApi'; }
}
microbe_apis_MicrobialApi::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("asyncApi" => (new _hx_array(array("microbe.apis.MicrobialApiAsync"))))), "fields" => _hx_anonymous(array("delete" => _hx_anonymous(array("returnType" => (new _hx_array(array(3))))), "getAllModels" => _hx_anonymous(array("returnType" => (new _hx_array(array(3))))), "recFromFormule" => _hx_anonymous(array("returnType" => (new _hx_array(array(3))))), "getDataFormule" => _hx_anonymous(array("returnType" => (new _hx_array(array(3))))), "recModelFromString" => _hx_anonymous(array("returnType" => (new _hx_array(array(3))))), "getFormuleFromString" => _hx_anonymous(array("returnType" => (new _hx_array(array(3))))), "getAllFromString" => _hx_anonymous(array("returnType" => (new _hx_array(array(3))))), "setupTable" => _hx_anonymous(array("returnType" => (new _hx_array(array(3)))))))));
function microbe_apis_MicrobialApi_0(&$val, $t) {
	{
		$GLOBALS['%s']->push("microbe.apis.MicrobialApi::recFormule@141");
		$__hx__spos = $GLOBALS['%s']->length;
		$inside1 = Std::string($t->id);
		{
			$tmp = Lambda::has($val, $inside1);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
function microbe_apis_MicrobialApi_1(&$val, $t) {
	{
		$GLOBALS['%s']->push("microbe.apis.MicrobialApi::recModelFromString@298");
		$__hx__spos = $GLOBALS['%s']->length;
		$inside1 = Std::string($t->id);
		{
			$tmp = Lambda::has($val, $inside1);
			$GLOBALS['%s']->pop();
			return $tmp;
		}
		$GLOBALS['%s']->pop();
	}
}
