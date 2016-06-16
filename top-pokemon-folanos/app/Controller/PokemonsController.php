<?php
App::uses("AppController", "Controller");

class PokemonsController extends AppController {
	public $uses = array("Pokemon");
	
	public function index() {
		$this->set(array(
			"pokemonlist" => $this->Pokemon->query("SELECT DISTINCT Pokemon.id pokemon_id, initcap(Pokemon.identifier) pokemon, typesByPokemon(Pokemon.id) type, Pokemon.count count FROM pokedex.pokemon AS Pokemon WHERE Pokemon.id <= 721"),
			"pagina" => "<a href='top' class='btn btn-success'>Ver top</a>"
		));
	}
	
	public function votar() {
		return $this->redirect(array("action" => "index"));
	}
	
	public function votacion($id) {
		$pokemon = $this->Pokemon->findById($id);
		
		if (!$pokemon) {
			throw new NotFoundException(__("Pokemon no existe."));
		}
		
		$datos_pokemon = array(
			"Pokemon" => array(
				"count" => $pokemon["Pokemon"]["count"] + 1
			)
		);
		
		$this->Pokemon->id = $id;
		$this->Pokemon->save($datos_pokemon);
		
		return $this->redirect(array("action" => "top"));
	}
	
	public function top() {
		$this->set(array(
			"pokemonlist" => $this->Pokemon->query("SELECT Pokemon.id pokemon_id, initcap(Pokemon.identifier) pokemon, typesByPokemon(Pokemon.id) type, Pokemon.count count FROM pokedex.pokemon AS Pokemon WHERE Pokemon.count > 0 ORDER BY Pokemon.count desc LIMIT 100"),
			"pagina" => "<a href='votar' class='btn btn-success'>Votar</a>"
		));
	}
}
