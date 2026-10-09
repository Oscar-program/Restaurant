<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 ini_set('display_errors',1);
   ini_set('display_startup_errors',1);
   error_reporting(E_ALL); 

class Empresa_Controller extends CI_Controller {  
    public function __construct()
    {
           parent::__construct();     
           $this->load->database();   
           $this->load->model('empresa_Model'); 
    }
    /*Funcion para  listar las empresas  */
    public function listarEmpresas(){
      $data['datosEmpresa'] =      $this->empresa_Model->listaEmpresas();
      $this->load->view('confEmpresa/detEmpresa', $data);
    }

    /*Funcion para  insertar una nueva empresa  */
    public function insertarEmpresa(){
         $empresaID   = (isset($_REQUEST['empresaID'])   AND  strlen($_REQUEST['empresaID'])>0 )   ? $_REQUEST['empresaID'] : NULL ;
         $empNombre   = (isset($_REQUEST['empNombre'])   AND  strlen($_REQUEST['empNombre'])>0 )   ? $_REQUEST['empNombre'] : '' ;
         $empGiro     = (isset($_REQUEST['empGiro'])     AND  strlen($_REQUEST['empGiro'])>0 )     ? $_REQUEST['empGiro']   : '' ;
         $empNit      = (isset($_REQUEST['empNit'])      AND  strlen($_REQUEST['empNit'])>0 )      ? $_REQUEST['empNit']     :'' ;
         $empTelefono = (isset($_REQUEST['empTelefono']) AND  strlen($_REQUEST['empTelefono']) )   ? $_REQUEST['empTelefono'] : '' ;
         $data        =  array('empNombre'=>$empNombre,  
                          'empGiro'=>$empGiro, 
                          'empNit'=>$empNit, 
                          'empTelefono'=>$empTelefono, 
                           ) ;
        $result = $this->empresa_Model->insertarEmpresa($empresaID, $data);
        echo $result ;
    }
    /*funcion para obtener los datos de la empresa   por id   */
    public function get_EmpresaPorID($empresaID) {
      $result = $this->empresa_Model->get_EmpresaPorID($empresaID) ;
      echo  json_encode($result);
    }
    /*Funcion para cambiar el status de la empresa por id  */
      public function delete_EmpresaPorID($empresaID){
      $result =  $this->empresa_Model->delete_EmpresaPorID($empresaID)  ;
      echo  $result;

      }
}