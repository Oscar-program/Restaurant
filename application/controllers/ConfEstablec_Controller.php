<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class ConfEstablec_Controller extends CI_Controller {  
    public function __construct()
    {
           parent::__construct();     
           $this->load->database();   
           $this->load->model('empresa_Model');  
           $this->load->model('Establecimiento_Model'); 
           $this->load->model('AreasEstablecimiento_Model');
           $this->load->model('mesas_Model');
           $this->load->helper('path');  
        
    }
     /*Funcio  para cargar las  congiraciones de los productos */
 public function setthingEstablecimineto(){
   //$establecimientoID = 2 ;
  /*cargamos los datos principales para los select  */
 
   $data['datosEmpresa']          = $this->empresa_Model->listaEmpresas();
   $data['datosEstablecimientos'] = $this->Establecimiento_Model->listaEstablecimientos();
   $data['datosAreas']            = $this->AreasEstablecimiento_Model->get_listAllAreas();
 //  var_dump( $data['datosAreas']) ;
   $this->load->view('confEmpresa/configEstablecimiento', $data);
 }

 /* funcion pra listar los establecimientos para mostrar el detalle  */

 public function listaEstablecimientos(){
      $data['datosEstablecimiento'] =      $this->Establecimiento_Model->listaEstablecimientos();
      $this->load->view('confEmpresa/detEstablecimiento', $data);
 }

 // funcion para inserta nuevo establecimiento  
 public function insertarEstablecimiento(){
  echo  "llegando al controlador" ; 

  $establecimientoID = (isset($_REQUEST['establecimientoID'])   AND  strlen($_REQUEST['establecimientoID'])>0 )   ? $_REQUEST['establecimientoID']  : NULL;
  $estNombre         = (isset($_REQUEST['estNombre'])           AND  strlen($_REQUEST['estNombre']) > 0 )   ? $_REQUEST['estNombre'] : '' ;
  $estDireccion      = (isset($_REQUEST['estDireccion'])        AND  strlen($_REQUEST['estDireccion'])>0 )   ? $_REQUEST['estDireccion'] : '' ;
  $estTelefono       = (isset($_REQUEST['estTelefono'])         AND  strlen($_REQUEST['estTelefono'])>0 )   ? $_REQUEST['estTelefono']  :'' ;
  $empresa_origen    = (isset($_REQUEST['SelectEmpresaOrigen'])         AND  $_REQUEST['SelectEmpresaOrigen'] !=0 )   ? $_REQUEST['SelectEmpresaOrigen']  :'' ; 
  $data  = array( 'establecimientoID'=>$establecimientoID,
                 'estNombre'=>$estNombre,
                'estDireccion'=>$estDireccion,
                'estTelefono'=>$estTelefono,
                'empresa_origen' =>$empresa_origen
                
                );

//var_dump($data) ;

 $result = $this->Establecimiento_Model->insertarEstablecimiento($establecimientoID, $data);
 echo  $result ;



 }
public function get_EstablecimientoPorID($establecimientoID){
   $result = $this->Establecimiento_Model->get_EstablecimientoPorID($establecimientoID) ;
      echo  json_encode($result);


}

  public function deleteEstablecimiento($establecimientoID){
      $result =  $this->Establecimiento_Model->deleteEstablecimiento($establecimientoID);
      echo  $result;

  }

    /* funcion listar todas las areas con su establecimiento */
 


  




}