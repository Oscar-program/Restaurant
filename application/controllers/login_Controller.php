<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include getcwd(). "/application/libraries/operacionInvnt/aes_encrypt.php";
class   login_Controller extends CI_Controller{
    public   function  __construct(){
         parent::__construct();
         $this->load->database();
         $this->load->model("usuarios_Model");
         $this->load->model('mesas_Model');
         $this->load->helper("path");    
        // $this->load->library('session');
    }

    //  funcion para  obtener los  datos del usuarios que se esta loguendo  
    public function validaUser(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
       
       session_destroy();
        session_start();       
        $aes_encrypt  =  new  aes_encrypt();    
        $userRerotno  = "";
        $RetornaUser  = 1;
        $usrLogin     =  (isset($_POST["user"]))?  $_POST["user"] : ""; 
        $establecimID =  (isset($_POST["establecimID"]))?  $_POST["establecimID"] : ""; 
        $usrPwd       =  (isset($_POST["pwd"]))? $aes_encrypt->aes_encryptAcceso($_POST["pwd"] ,"encrypt"): "";         
        $datosUser   =  $this->usuarios_Model->getUserpwd($usrLogin, $usrPwd);

        if(empty($datosUser)){
            $RetornaUser = 0;   
        }else{
            $_SESSION["usuario"]           = $datosUser->usrNombre; 
            $_SESSION["usrLogin"]          = $datosUser->usrLogin;
            $_SESSION["usuarioID"]         = $datosUser->usuarioID; 
            $_SESSION["empresaID"]         = $datosUser->empresaID; 
            $_SESSION["nivelUsuaio"]       = $datosUser->nivelUsuarioID; 
            $_SESSION["areasEstablecimientoID"]       = "" ; 


            
            $_SESSION["establecimientoID"] = $establecimID;
            $_SESSION["idDetCompra"]=1;
            $_SESSION["IdTempComprea"]= rand();
            $_SESSION["detlistadecompra"]= array();        }
       // echo   'el establecimiento  capturado es ' .  $_SESSION["establecimientoID"];
        echo $RetornaUser ; 
      
    }
    //  funcion para  cerrar  la  sesion  del  usuario  y  regresar  a  la  pantalla  de  login
    public function cerrarSession(){
        if(session_status() ==  PHP_SESSION_NONE){
            session_start();
        }
        $_SESSION = array();
        session_unset();
        session_destroy();
        //  se  destruye  tambien  la  cookie  de  sesion  para  que  no  quede  rastro  del  usuario
        if(ini_get("session.use_cookies")){
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                      $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        }
        redirect(base_url());
    }

    //  segmento para  desemcrptar la clave de usuario
    public function  desempcriptar(){
        $aes_encrypt  =  new  aes_encrypt();
        $datosUser  = $this->usuarios_Model->allUserSystem();

        foreach ($datosUser as $row) {

            echo  $row->usrLogin . ' '. $aes_encrypt->aes_encryptAcceso($row->usrPwd ,"decrypt") .  ' Nivel'.   $row->nivelUsuarioID  .'<br>';

            # code...
        }
    }
    // funcion para almacenar los  datos de usuarios  
    public function saveUser(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        //session_start();
        $aes_encrypt  =  new  aes_encrypt();
       
        $aes_key       ='xyz123';
        $usuarioID     = (isset($_REQUEST["usuarioID"])  and   strlen($_REQUEST["usuarioID"])> 0) ?  $_REQUEST["usuarioID"] : NULL;         
        $usrNombre     = (isset($_POST["Fullname"]))?  $_POST["Fullname"] : "";
        $usrLogin      = (isset($_POST["Email"]))?  $_POST["Email"] : "";
        $usrPwd        = (isset($_POST["Password"]))?  $aes_encrypt->aes_encryptAcceso($_POST["Password"] ,"encrypt") : "";
        $empresaID     = $_SESSION["empresaID"] ; //(isset($_POST["empresaID"]))?  $_POST["empresaID"] : "1"; 
        $nivelUsuarioID = (isset($_POST["niveluser"]))?  $_POST["niveluser"] : "";  
        $data  =  array(           
                        'usrNombre'      => $usrNombre,
                        'usrLogin'       => $usrLogin,
                        'usrPwd'         => $usrPwd,
                        'empresaID'      => $empresaID,
                        'nivelUsuarioID' => $nivelUsuarioID,
                        
                    );
                  //  echo  "el iddelusuario es  " .  $_REQUEST["usuarioID"] . "CSDF" ; 
                   // EXIT  ;

       $this->usuarios_Model->insert_user($data, $usuarioID);

    }

    // funcion para listar los usuarios del sistema 
    function allUserSystem(){
     $datos['allUserSystem'] = $this->usuarios_Model->allUserSystem(); 
     $this->load->view('usuarios/listaUsuarios', $datos);

    }
    
    // obtener informacion de usuario para modificar 
    function  get_UserID($usuarioID){
         $datos = $this->usuarios_Model->get_UserID($usuarioID) ; 
      
           echo  json_encode($datos);
    }
    function  del_UserID($usuarioID){
          $datos = $this->usuarios_Model->del_UserID($usuarioID) ; 
        
           echo  $datos; 

    }
    #  funcion para la configuracion del  nivel del usuario 
    public function listNivelusuario(){
        $datos['listNivelusuario'] = $this->usuarios_Model->listNivelusuario(); 
        $this->load->view('confEmpresa/detNivelUsuario', $datos);
    }
    public function savenivelUsuario(){
        $nivelUsuarioID   = (isset($_POST["nivelUsuarioID"])  and   strlen($_POST["nivelUsuarioID"])> 0) ?  $_POST["nivelUsuarioID"] : NULL;     
        $nivel            = (isset($_POST["nivel"]))?  $_POST["nivel"] : "";
        $data             =  array('nivel'=>$nivel);
        $result = $this->usuarios_Model->insert_nivelUsuario($data, $nivelUsuarioID);
    }
    public function  get_NivelUserID($nivelUsuarioID){
           $datos = $this->usuarios_Model->get_NivelUserID($nivelUsuarioID) ;        
           echo  json_encode($datos);

    }
    public function  deleteNivelUser($nivelUsuarioID){
          $datos = $this->usuarios_Model->delete_NivelUser($nivelUsuarioID) ; 
          echo  $datos ;       
    }





}