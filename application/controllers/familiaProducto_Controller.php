<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class familiaProducto_Controller extends CI_Controller {  
    public function __construct()
    {
           parent::__construct();     
           $this->load->database();                  
           $this->load->model('familiaProducto_Model');
           $this->load->helper('path');  
        
    }
    
    public function get_listFamiliaProducto(){
        $data['listFamiliaProducto'] = $this->familiaProducto_Model->get_listFamiliaProducto();
        $this->load->view('configuraciones/detFamilia',$data);

     }
    # funcion para mostrar  todas las medidas  los productos existentes
    public function saveFamiliaProducto(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        /* Creamos una variable para determinar el  modelo  a ejecutar*/
       //echo  "el valor del control es " . $_POST['txtfamilia'] ;
      if(isset($_POST['txtfamilia'])){
          $famProdDescripcion = $_POST['txtfamilia'];
          $famProdID = null;
          if($_POST['txtfamProdID']!=''){
           
            $famProdID = $_POST['txtfamProdID'];
          }
          $data =  array("famProdDescripcion"=>$famProdDescripcion);
         // var_dump($data) ;

          $result = $this->familiaProducto_Model->addFamiliaProducto($data, $famProdID);
      }else{
        echo   'no se ha dibujado el  control DEL  DETALLE DE LAS PRESENTACIONES';
      }
    }

  /*Funcion para  actualzar el nombre de la marca   */
  public  function get_FamiliaProductoID($medProdID){
          $result =  $this->familiaProducto_Model->get_FamiliaProductoID($medProdID);
          echo  json_encode($result);
  }

  /*Funcion para elminar marca de  producto  */
  public  function  delete_FamiliaProductoID($famProdID){
  $result =  $this->familiaProducto_Model->delete_FamiliaProductoID($famProdID);
  echo  $result;
  } 

    public function listaAllFamiliaProducto(){
        $data['listFamiliaProducto'] = $this->familiaProducto_Model->listaAllFamiliaProducto();
        $this->load->view('configuraciones/detFamilia',$data);

     }


   

  }