<?php
App::uses('AppHelper', 'View/Helper');

class MyHelperHelper extends AppHelper {
	public function generation($pokemon_id) {
		if ($pokemon_id >= 1 && $pokemon_id <= 151) {
			return "I";
		}
		if ($pokemon_id >= 152 && $pokemon_id <= 251) {
			return "II";
		}
		if ($pokemon_id >= 252 && $pokemon_id <= 386) {
			return "III";
		}
		if ($pokemon_id >= 387 && $pokemon_id <= 493) {
			return "IV";
		}
		if ($pokemon_id >= 494 && $pokemon_id <= 649) {
			return "V";
		}
		if ($pokemon_id >= 650 && $pokemon_id <= 721) {
			return "VI";
		}
		if ($pokemon_id >= 722) {
			return "VII";
		}
	}
}
