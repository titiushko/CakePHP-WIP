<?php
App::uses('AppModel', 'Model');

class Platillo extends AppModel {
	public $displayField = 'nombre';
	public $actsAs = array(
		'Upload.Upload' => array(
			'foto' => array(
				'fields' => array(
					'dir' => 'foto_dir'
				),
				'thumbnailMethod'  => 'php',
				'thumbnailSizes' => array(
					'vga' => '640x480',
					'thumb' => '150x150'
				),
				'deleteOnUpdate' => TRUE,
				'deleteFolderOnDelete' => TRUE
			)
		)
	);
	
	public $validate = array(
		'nombre' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Nombre requerido.'
			),
			'alphabetic' => array(
				'rule' => '/^[a-zA-Z[:space:]ñáéíóúÑÁÉÍÓÚ]*$/',
				'message' => 'Sólo letras.'
			)
		),
		'precio' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Precio requerido.'
			),
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Sólo números.'
			)
		),
		'foto' => array(
			'uploadError' => array(
				'rule' => 'uploadError',
				'message' => 'Algo anda mal, por favor intente nuevamente.',
				'on' => 'create'
			),
			'isUnderPhpSizeLimit' => array(
				'rule' => 'isUnderPhpSizeLimit',
				'message' => 'Archivo excede el límite de tamaño de archivo de subida.'
			),
			'isValidMimeType' => array(
				'rule' => array('isValidMimeType', array('image/jpeg', 'image/png'), FALSE),
				'message' => 'Solo se permiten archivos JPG o PNG.',
			),
			'isBelowMaxSize' => array(
				'rule' => array('isBelowMaxSize', 1048576),
				'message' => 'El tamaño de imagen es demasiado grande.'
			),
			'isValidExtension' => array(
				'rule' => array('isValidExtension', array('jpg', 'png'), FALSE),
				'message' => 'Solo se permiten imagenes JPG o PNG.'
			),
			'uniqueImage' => array(
				'rule' => array('uniqueImage'),
				'message' => 'La imagen ya existe.',
				'on' => 'update'
			)
			//	TODO: Validar el tipo de caracteres en el nombre de los archivos
		),
		'categoria_platillo_id' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Seleccionar una categoría.'
			)
		),
		'cocinero_id' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Seleccionar un cocinero o varios cocineros.'
			)
		)
	);
	
	public function uniqueImage($dato) {
		//	TODO: Validar si un archivo existe en la base de datos y en el directorio de archivos
		$isUnique = $this->find('first', array('fields' => array('Platillo.foto'), 'conditions' => array('Platillo.foto' => $dato['foto'], 'Platillo.foto' => 'IS NOT NULL')));
		if (!empty($isUnique)) {
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
	
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
	
	public $hasMany = array(
		'Pedido' => array(
			'className' => 'Pedido',
			'foreignKey' => 'platillo_id',
			'dependent' => FALSE
		),
		'PlatillosOrden' => array(
			'className' => 'PlatillosOrden',
			'foreignKey' => 'platillo_id',
			'dependent' => FALSE
		)
	);
	
	public function precio_platillo($platillo_id) {
		return $this->find('all', array('fields' => array('Platillo.precio'), 'conditions' => array('Platillo.id' => $platillo_id)))[0]['Platillo']['precio'];
	}
}
