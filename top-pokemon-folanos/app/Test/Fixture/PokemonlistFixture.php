<?php
/**
 * Pokemonlist Fixture
 */
class PokemonlistFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'pokemonlist';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'pokemon_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'pokemon' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'type' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 160, 'collate' => 'latin1_bin', 'charset' => 'latin1'),
		'indexes' => array(
			
		),
		'tableParameters' => array('comment' => 'VIEW')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'pokemon_id' => 1,
			'pokemon' => 'Lorem ipsum dolor sit amet',
			'type' => 'Lorem ipsum dolor sit amet'
		),
	);

}
