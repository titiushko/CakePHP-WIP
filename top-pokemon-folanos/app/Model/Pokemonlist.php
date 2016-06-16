<?php
App::uses('AppModel', 'Model');

class Pokemonlist extends AppModel {
	public $useTable = 'pokemonlist';
	public $primaryKey = 'pokemon_id';
	public $displayField = 'pokemon';
}
