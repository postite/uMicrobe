<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: src/microbe/comps/molecules/UPComp.hx
 */

namespace microbe\comps\molecules;

use \microbe\Microbe;
use \ufront\web\context\HttpContext;
use \php\Boot;
use \microbe\comps\Molecule;

class UpComp extends Molecule implements Microbe {
	/**
	 * @param mixed $d
	 * @param \Array_hx $classes
	 * 
	 * @return void
	 */
	public function __construct ($d, $classes = null) {
		#src/microbe/comps/molecules/UPComp.hx:8: lines 8-27
		parent::__construct($d, $classes);
	}


	/**
	 * @param HttpContext $ctx
	 * 
	 * @return void
	 */
	public function execute ($ctx) {
	}


	/**
	 * @return string
	 */
	public function render () {
		#src/microbe/comps/molecules/UPComp.hx:13: characters 3-38
		if ($this->data->v === null) {
			#src/microbe/comps/molecules/UPComp.hx:13: characters 21-38
			$this->data->v = "turn.png";
		}
		#src/microbe/comps/molecules/UPComp.hx:14: characters 3-14
		return "yo";
	}
}


Boot::registerClass(UpComp::class, 'microbe.comps.molecules.UpComp');
