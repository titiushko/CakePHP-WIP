<?php
App::uses("AppController", "Controller");

class PokemonlistsController extends AppController {
	public $uses = array("Pokemonlist", "Pokemon");
	
	public function index() {
		$this->set(array(
			"pokemonlist" => $this->Pokemonlist->find("all"),
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
			"pokemonlist" => $this->Pokemonlist->find("all", array(
				"conditions" => array("Pokemonlist.count >" => "0"),
				"order" => array("Pokemonlist.count" => "desc"),
				"limit" => 100
			)),
			"pagina" => "<a href='votar' class='btn btn-success'>Votar</a>"
		));
	}
}
