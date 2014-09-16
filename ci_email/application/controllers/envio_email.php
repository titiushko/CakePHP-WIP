<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Envio_email extends CI_Controller 
{
	function __construct() 
	{
		parent::__construct();
		$this->load->model('envio_email_model');	
	}
	function index()
	{
	 	$data['title'] = 'Formulario de registro';
		$data['head'] = 'Reg�strate desde aqu�';
		$this->load->view('envio_email_view', $data);
    }
	
	function nuevo_usuario()
	{
		if(isset($_POST['grabar']) and $_POST['grabar'] == 'si')
		{
			//SI EXISTE EL CAMPO OCULTO LLAMADO GRABAR CREAMOS LAS VALIDACIONES
			$this->form_validation->set_rules('nom','Nombre','required|trim|xss_clean');
			$this->form_validation->set_rules('correo','Correo','required|valid_email|trim|xss_clean');
			$this->form_validation->set_rules('nick','Usuario','required|trim|xss_clean');
			$this->form_validation->set_rules('pass','Password','required|trim|xss_clean|md5');
			
			//SI HAY ALG�NA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
			//EL COMOD�N %s SUSTITUYE LOS NOMBRES QUE LE HEMOS DADO ANTERIORMENTE, EJEMPLO, 
			//SI EL NOMBRE EST� VAC�O NOS DIR�A, EL NOMBRE ES REQUERIDO, EL COMOD�N %s 
			//SER� SUSTITUIDO POR EL NOMBRE DEL CAMPO
			$this->form_validation->set_message('required', 'El %s es requerido');
	        $this->form_validation->set_message('valid_email', 'El %s no es v�lido');
			
			//SI ALGO NO HA IDO BIEN NOS DEVOLVER� AL INDEX MOSTRANDO LOS ERRORES
			if($this->form_validation->run()==FALSE)
			{
				$this->index();
			}else{
			//EN CASO CONTRARIO PROCESAMOS LOS DATOS
				$nombre = $this->input->post('nom');
				$correo = $this->input->post('correo');
				$nick = $this->input->post('nick');
				$password = $this->input->post('pass');
				$insert = $this->envio_email_model->new_user($nombre,$correo,$nick,$password);
				//si el modelo nos responde afirmando que todo ha ido bien, env�amos un correo
				//al usuario y lo redirigimos al index, en verdad deber�amos redirigirlo al home de
				//nuestra web para que puediera iniciar sesi�n
				$this->email->from('aqui el email que quieres que env�e los datos', 'uno-de-piera.com');
				$this->email->to($correo);
				$this->email->subject('Bienvenido/a a uno-de-piera.com');
				$this->email->message('<h2>' . $nombre . ' gracias por registrarte en uno-de-piera.com</h2><hr><br><br>
				Tu nombre de usuario es: ' . $nick . '.<br>Tu password es: ' . $password);
				$this->email->send();
			}
		}
	}
}



