<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Formulario extends CI_Controller 
{
        function __construct() 
	{   //en el constructor cargamos nuestro modelo
		parent::__construct();
		$this->load->model('formulario_model');
	}
	
	public function index()
	{       //cargamos nuestra vista
		$this->load->view("formulario_view");
	}
	//con esta funci�n insertaremos los comentarios
	public function nuevo_comentario()
	{
           //si se ha hecho submit en el formulario...
		if(isset($_POST['grabar']))
		{
          //creamos nuestras reglas de validaci�n, 
          //required=campo obligatorio||valid_email=validar correo||xss_clean=evitamos inyecciones de c�digo
			$this->form_validation->set_rules('nom', 'Nombre', 'required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
			$this->form_validation->set_rules('asunto', 'Asunto', 'required|xss_clean');
			$this->form_validation->set_rules('mensaje', 'Mensaje', 'required|xss_clean');
	    //comprobamos si los datos son correctos, el comod�n %s nos mostrar� el nombre del campo
          //que ha fallado 
			$this->form_validation->set_message('required', 'El  %s es requerido');
	       $this->form_validation->set_message('valid_email', 'El %s no es v�lido');
            //si el formulario no pasa la validaci�n lo devolvemos a la p�gina
            //pero esta vez le mostramos los errores al lado de cada campo
			if($this->form_validation->run() == FALSE)
			{
				$this->index();
              //en caso de que la validaci�n sea correcta cogemos las variables y las env�amos
              //al modelo
			}else{
				$nombre = $this->input->post("nom");
				$email = $this->input->post("email");
				$asunto = $this->input->post("asunto");
				$mensaje = $this->input->post("mensaje");
				$insert = $this->formulario_model->insert_comment($nombre,$email,$asunto,$mensaje);
              //si el modelo hace la inserci�n en la base de datos nos devolver� a la siguiente url
              //en la que seg�n nuestro formulario debe mostrarse el mensaje de confirmaci�n.
				redirect("mensaje/enviado");
			}
		}
	}
}