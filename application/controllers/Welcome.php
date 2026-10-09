<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//include  "C:/xampp/htdocs/EnlaceConexion/BAR.php";

class Welcome extends CI_Controller {
	public function __construct() {	
		parent::__construct();

		$this->load->database();
		$this->load->model("usuarios_Model");
		$this->load->model('mesas_Model');
		$this->load->helper('path');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		//$this->load->view('welcome_message');
		// Cargamos los  datos para los  establecimientos  
		$datos["establecimientos"] =  $this->usuarios_Model->lit_establecimientos();
		
		$this->load->view('login',$datos);
		//login.php
	}
	// funcion para  cargar el  menu principal 
	public function  principal(){
	//	session_start();
		//echo 'llegando al controlador';
		/*$userRerotno = "";
        $RetornaUser = 1;
        $usrLogin = 'admin';
        $usrPwd   = 'Admin2024';
        $datosUser =   $this->usuarios_Model->getUserpwd($usrLogin, $usrPwd);
        if(empty($datosUser)){
            $RetornaUser = 0;
			echo $RetornaUser ;
            
        }else{
            $this->load->view('principal');
        }
       //echo $RetornaUser ; */
	   $areaEstablecimientoID = 1;

       $data['listaMesas'] = $this->mesas_Model->get_listmesas($areaEstablecimientoID);
		$this->load->view('principal', $data);
	}
	// funcion para  registrar los  usuarios del  sistema  
	// funcion para  cargar el  menu principal 
	public function  registerUser(){
		// pasamos los datos  de los niveles de usuarios 
		 $datos['listNivelusuario'] = $this->usuarios_Model->listNivelusuario();  


		$this->load->view('usuarios/registrarUsuario', $datos);
		// 
	}
	public function testConexion(){
		echo 'llegandfo a conexion'  .'<br>' ;  
		//var_dump($conexion);

		$stmt = $GLOBALS['db']->query("SELECT *  FROM fasdfds ");
       $fila = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($fila);
		echo  '<br>';

		echo  '<br>';

		$stmt = $GLOBALS['db']->query("SELECT *  FROM marcaproducto ");
       $fila = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($fila);


		



		//var_dump($conexion);
	} 

}
