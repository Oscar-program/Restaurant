<?php  
defined('BASEPATH') or  exit('No direct script access allowed');
class bodegaProducto_Controller extends CI_Controller{
    public function __construct(){
        parent:: __construct();
        $this->load->database();
        $this->load->model('bodegaProducto_Model');
        $this->load->helper('path');
    }
    public function get_listBodegaProducto(){
        $data['listBodegaProducto'] = $this->bodegaProducto_Model->get_listBodegaProducto();
        $this->load->view('configuraciones/detBodegas',$data);

     }
    # funcion para mostrar  todas las medidas  los productos existentes
    public function addBodegaProducto(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        //Creamos una variable para determinar el  modelo  a ejecutar
        $establecimientoID =  2; // ponemos 1 porque  solo existe   un establecimiento
       
      if(isset($_POST['txtbodega'])){
          $bodProdDescripcion = $_POST['txtbodega'];
          $bodegaProductoID = null;
          if($_POST['txtbodegaProductoID']!=''){
           
            $bodegaProductoID = $_POST['txtbodegaProductoID'];
          }
          $data =  array("bodProdDescripcion"=>$bodProdDescripcion,  
                         "establecimientoID"=> $establecimientoID
                        );
          $result = $this->bodegaProducto_Model->addBodegaProducto($data, $bodegaProductoID);
      }else{
        echo   'no se ha dibujado el  control DEL  DETALLE DE LAS PRESENTACIONES';
      }
    }

  //Funcion para  actualzar el nombre de la marca  
  public  function get_BodegaProductoID($bodegaProductoID){
          $result =  $this->bodegaProducto_Model->get_BodegaProductoID($bodegaProductoID);
          echo  json_encode($result);
  }

  //Funcion para elminar marca de  producto  
  public  function  delete_BodegaProductoID($bodegaProductoID){
  $result =  $this->bodegaProducto_Model->delete_BodegaProductoID($bodegaProductoID);
  echo  $result;
  
  }

}