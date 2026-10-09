<?php  
defined('BASEPATH') or  exit('No direct script access allowed');
class equivalenteProducto_Controller  extends CI_Controller{ 
 public function __construct() {
    parent :: __construct();
    $this->load->database();
    $this->load->model('equivalenteProducto_Model');
    $this->load->model('Producto_Model');
    $this->load->helper('path');

 }

 # funcion para mostrar  todas las medidas  los productos existentes    
 public function  mostrarDetalleEquivalente(){
   ini_set('display_errors',1);
   ini_set('display_startup_errors',1);
   error_reporting(E_ALL);
  // echo  'llegando al controlador de la MEDIDA del producto';
   $datos["datoEquivalenteProd"] =   $this->equivalenteProducto_Model->get_listaEquivalenteProducto();
   //var_dump($this->datos["datosMArcas"]);
    $this->load->view("configuraciones/detEquivalentes", $datos); 

}
# funcion para mostrar  todas las medidas  los productos existentes
public function saveEquivalenteProducto(){
   ini_set('display_errors',1);
   ini_set('display_startup_errors',1);
   error_reporting(E_ALL);
   /* Creamos una variable para determinar el  modelo  a ejecutar*/

$productoID    = (isset($_POST['prouctoEquivalente'])) ? $_POST['prouctoEquivalente']: 0; 
$presProdID    = (isset($_POST['equivalente'])) ? $_POST['equivalente']: 0;    
$unidades      = (isset($_POST['unidadequivalente'])) ? $_POST['unidadequivalente']: 0;   
$prodPresentID = ($_POST['prodPresentID']!='') ? $_POST['prodPresentID']: null;
$data          = array("productoID"=>$productoID, "presProdID"=>$presProdID,"unidades"=>$unidades);
if($unidades>0){
  $result       = $this->equivalenteProducto_Model->addEquivalenteProducto($data, $prodPresentID); 
}

}

/*Funcion para  actualzar el nombre de la marca   */
public  function get_EquivalenteProductoID($medProdID){
     $result =  $this->equivalenteProducto_Model->get_EquivalenteProductoID($medProdID);
     echo  json_encode($result);
}

/*Funcion para elminar marca de  producto  */
public  function  delete_EquivalenteProductoID($medProdID){
$result =  $this->equivalenteProducto_Model->delete_EquivalenteProductoID($medProdID);
echo  $result;
}



    
 }
 

