<?php
App::uses('AppController', 'Controller');

class AjaxController extends AppController {
	public function quitar_registro() {
		if ($this->request->is('ajax')) {
			$id = $this->request->data['id'];
			$modelo = $this->request->data['modelo'];
			$controlador = $this->request->data['controlador'];
			$cocineros_platillo_id = $this->request->data['cocineros_platillo_id'];
			
			switch ($modelo) {
				case 'platillo':
					switch ($controlador) {
						case 'categoria_platillos':	//quitar platillo de categoría platillo
							$this->loadModel('Platillo');
							$resultado = $this->Platillo->findById($id)['Platillo']['nombre'];
							$this->Platillo->id = $id;
							$this->Platillo->save(array('Platillo' => array('categoria_platillo_id' => 0)));
						break;
						case 'empleados':	//quitar platillo de cocinero
							$this->loadModel('CocinerosPlatillo');
							$resultado = $this->CocinerosPlatillo->findById($cocineros_platillo_id)['Platillo']['nombre'];
							$this->CocinerosPlatillo->delete($cocineros_platillo_id);
						break;
					}
				break;
				case 'mesa':	//quitar mesa de mesero
					$this->loadModel('Mesa');
					$this->Mesa->id = $id;
					$this->Mesa->save(array('Mesa' => array('mesero_id' => 0)));
					$resultado = $this->Mesa->findById($id)['Mesa']['serie'];
				break;
				case 'cocinero':	//quitar cocinero de platillo
					$this->loadModel('CocinerosPlatillo');
					$resultado = $this->CocinerosPlatillo->findById($id)['Persona']['nombre_completo'];
					$this->CocinerosPlatillo->delete($id);
				break;
			}
			
			echo json_encode(compact('resultado'));
			$this->autoRender = FALSE;
		}
	}
}
