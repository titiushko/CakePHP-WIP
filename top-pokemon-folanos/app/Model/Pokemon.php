<?php
App::uses('AppModel', 'Model');

class Pokemon extends AppModel {
	public $useTable = 'pokemon';
	public $primaryKey = 'id';
	public $displayField = 'identifier';
}
