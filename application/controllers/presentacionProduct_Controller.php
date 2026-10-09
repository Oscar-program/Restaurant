<?php   

defined('BASEPATH') OR exit('No direct script access allowed');
class presentacionProduct_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('PresentacioProducto_Model');
        $this->load->helper('path');
    }
    /*funcion para almacernar la presentacion de los  productos*/
    public function  mostrarDetallePresProducto(){
          ini_set('display_errors',1);
          ini_set('display_startup_errors',1);
          error_reporting(E_ALL);
         // echo  'llegando al controlador de la presentacion del producto';
       $datos["datosPresentacionProd"] =   $this->PresentacioProducto_Model->get_listaPresentacionProducto();
      //var_dump($this->datos["datosMArcas"]);
      $this->load->view("configuraciones/detPresentaciones", $datos); 

    }

    public function savePresentacionProducto(){
          ini_set('display_errors',1);
          ini_set('display_startup_errors',1);
          error_reporting(E_ALL);
          /* Creamos una variable para determinar el  modelo  a ejecutar*/
         
        if(isset($_POST['txtpresentacion'])){
            $presProdDescripcion = $_POST['txtpresentacion'];
            $presProdID = null;
            if($_POST['presProdID']!=''){
             
              $presProdID = $_POST['presProdID'];
            }
            $data =  array("presProdDescripcion"=>$presProdDescripcion);
            $result = $this->PresentacioProducto_Model->addPresentacionProducto($data, $presProdID);
        }else{
          echo   'no se ha dibujado el  control DEL  DETALLE DE LAS PRESENTACIONES';
        }
    }

    /*Funcion para  actualzar el nombre de la marca   */
    public  function get_PresentacionProductoID($presProdID){
            $result =  $this->PresentacioProducto_Model->get_PresentacionProductoID($presProdID);
            echo  json_encode($result);
    }

    /*Funcion para elminar marca de  producto  */
    public  function  delete_PresentacionProductoID($presProdID){
    $result =  $this->PresentacioProducto_Model->delete_PresentacionProductoID($presProdID);
    echo  $result;
    }





 }