<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class  preciosEpeciales_Controller  extends CI_Controller{
    // creamos el   constructor del proyecto 
    public function __construct(){
        parent:: __construct();
        $this->load->database();
        $this->load->model('PrecioEspecial_Model');
        $this->load->helper('path');
    }
    public function get_listPreciosEspProducto(){
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL);
        $data['listPrecioEspecial'] = $this->PrecioEspecial_Model->get_listPreciosEspProducto();
        $this->load->view('configuraciones/detPrecioEspecial',$data);

     }
    # funcion para mostrar  todas las medidas  los productos existentes
    public function addPreciosEspProducto(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        //Creamos una variable para determinar el  modelo  a ejecutar
        $descPrecioEspecial   = (isset($_POST['txtdescPrecioEspecial'])) ?  $_POST['txtdescPrecioEspecial']: '';
        $turnOperaID          = (isset($_POST['turno'])) ?  $_POST['turno']: 0;
        $famProdID            = (isset($_POST['familiaprod'])) ?  $_POST['familiaprod']: 0;
        $precioEspecial       = (isset($_POST['txtprecioespecial'])) ?  $_POST['txtprecioespecial']: 0; 
        $precioEspecialProdID = null;

        if($_POST['precioEspecialProdID']!=''){           
          $precioEspecialProdID = $_POST['precioEspecialProdID'];
        }
        
        $data =  array(
                        "descPrecioEspecial"=>$descPrecioEspecial,
                        "turnOperaID"=>$turnOperaID,
                        "famProdID"=>$famProdID,
                        
                        "precioEspecial"=>$precioEspecial,
                      );



       var_dump( $data );
      if($precioEspecial > 0){
          $result = $this->PrecioEspecial_Model->addPreciosEspProducto($data, $precioEspecialProdID);
      }else{
        echo   'no se ha dibujado el  control DEL  DETALLE DE LAS PRESENTACIONES';
      }
    }

  //Funcion para  actualzar el nombre de la marca  
  public  function get_PreciosEspProductoID($precioEspecialProdID){
          $result =  $this->PrecioEspecial_Model->get_PreciosEspProductoID($precioEspecialProdID);
          echo  json_encode($result);
  }

  //Funcion para elminar marca de  producto  
  public  function  delete_PreciosEspProductoID($precioEspecialProdID){
  $result =  $this->PrecioEspecial_Model->delete_PreciosEspProductoID($precioEspecialProdID);
  echo  $result;
  
  }
  
  

  
}