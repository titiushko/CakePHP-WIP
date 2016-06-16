<?php
App::uses('Pokemonlist', 'Model');

/**
 * Pokemonlist Test Case
 */
class PokemonlistTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.pokemonlist'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Pokemonlist = ClassRegistry::init('Pokemonlist');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Pokemonlist);

		parent::tearDown();
	}

}
