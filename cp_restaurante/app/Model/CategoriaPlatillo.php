<?php
App::uses('AppModel', 'Model');

class CategoriaPlatillo extends AppModel {
	public $displayField = 'categoria';
	
	public $validate = array(
		'categoria' => array(
			'rule' => 'notEmpty'
		)
	);
	
	public $hasMany = array(
		'Platillo' => array(
			'className' => 'Platillo',
			'foreignKey' => 'categoria_platillo_id',
			'conditions' => '',
			'order' => 'Platillo.precio DESC',
			'depend' => false
		)
	);
}
