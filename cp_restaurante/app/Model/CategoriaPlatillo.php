<?php
App::uses('AppModel', 'Model');

class CategoriaPlatillo extends AppModel {
	public $displayField = 'categoria';
	
	public $validate = array(
		'categoria' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Categoría ya existe.'
			)
		)
	);
	
	public $hasMany = array(
		'Platillo' => array(
			'className' => 'Platillo',
			'foreignKey' => 'categoria_platillo_id',
			'conditions' => '',
			'order' => 'Platillo.precio DESC',
			'depend' => FALSE
		)
	);
}
