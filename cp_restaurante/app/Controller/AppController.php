<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $helpers = array('Html', 'Form', 'Time', 'Paginator', 'Js', 'Funciones');
	public $components = array(
		'Session',
		'RequestHandler',
		//?debug=true
		'DebugKit.Toolbar' => array('panels' => array('timer' => FALSE, 'log' => FALSE, 'environment' => FALSE, 'include' => FALSE), 'history' => 10, 'autoRun' => FALSE),
		'Auth' => array(
			'loginRedirect' => array('controller' => 'platillos', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
			'authenticate' => array('Form' => array('passwordHasher' => 'Blowfish')),
			'authorize' => 'Controller',
			'authError' => FALSE
			//'authError' => 'Usted debe estar conectado para ver esta página.',
			//'loginError' => 'Usuario o contraseña no válidos, por favor vuelva a intentarlo.'
		)
	);
	
	public function beforeFilter() {
		$this->Auth->allow('login', 'logout');
		$this->set('usuario_actual', $this->Auth->user());
	}
	
	public function isAuthorized($usuario) {
		if (isset($usuario['rol']) && $usuario['rol'] === 'admin') return TRUE;
		else return FALSE;
	}
}
