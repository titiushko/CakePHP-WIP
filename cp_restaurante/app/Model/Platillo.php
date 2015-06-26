<?php
App::uses('AppModel', 'Model');

class Platillo extends AppModel {
	public $displayField = 'nombre';
	
	public $validate = array(
		'nombre' => array(
			'rule' => 'notEmpty'
		),
		'precio' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty'
			),
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Sólo números.'
			)
		),
		'categoria_platillo_id' => array(
			'rule' => 'notEmpty'
		),
	);
	
	public $belongsTo = array(
		'CategoriaPlatillo' => array(
			'className' => 'CategoriaPlatillo',
			'foreignKey' => 'categoria_platillo_id'
		)
	);
	
	public $hasAndBelongsToMany = array(
		'Cocinero' => array(
			'className' => 'Cocinero',
			'joinTable' => 'cocineros_platillos',
			'foreignKey' => 'platillo_id',
			'associationForeignKey' => 'cocinero_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);
}
