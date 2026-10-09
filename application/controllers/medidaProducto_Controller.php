<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class   medidaProducto_Controller extends CI_Controller{
    public   function  __construct(){
         parent::__construct();
         $this->load->database();
         $this->load->model("MedidaProducto_Model");
         $this->load->helper("path");    }
    # funcion para mostrar  todas las medidas  los productos existentes    
    public function  mostrarDetalleMedProducto(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
       // echo  'llegando al controlador de la MEDIDA del producto';
        $datos["datoMedidaPeProd"] =   $this->MedidaProducto_Model->get_listaMedidaProducto();
        //var_dump($this->datos["datosMArcas"]);
         $this->load->view("configuraciones/detMedidas", $datos); 

    }
    # funcion para mostrar  todas las medidas  los productos existentes
    public function saveMedidaProducto(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        /* Creamos una variable para determinar el  modelo  a ejecutar*/
       
      if(isset($_POST['txtmedida'])){
          $medProdDescripcion = $_POST['txtmedida'];
          $medProdID = null;
          if($_POST['txtmedProdID']!=''){
           
            $medProdID = $_POST['txtmedProdID'];
          }
          $data =  array("medProdDescripcion"=>$medProdDescripcion);
          $result = $this->MedidaProducto_Model->addMedidaProducto($data, $medProdID);
      }else{
        echo   'no se ha dibujado el  control DEL  DETALLE DE LAS PRESENTACIONES';
      }
    }

  /*Funcion para  actualzar el nombre de la marca   */
  public  function get_MedidadProductoID($medProdID){
          $result =  $this->MedidaProducto_Model->get_MedidaProductoID($medProdID);
          echo  json_encode($result);
  }

  /*Funcion para elminar marca de  producto  */
  public  function  delete_MedidaProductoID($medProdID){
  $result =  $this->MedidaProducto_Model->delete_MedidaProductoID($medProdID);
  echo  $result;
  }
}