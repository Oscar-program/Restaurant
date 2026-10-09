<?php  
defined('BASEPATH') or  exit('No direct script access allowed');
include getcwd(). "/application/libraries/fpdf/fpdf.php";
include getcwd(). "/application/libraries/operacionInvnt/operacionesInventario.php";

class TrasladoProducto_Controller extends CI_Controller{
    public function __construct(){
        parent:: __construct();
        $this->load->database();
        $this->load->model('trasladoProducto_Model');
        $this->load->model('Producto_Model');
        $this->load->model('bodegaProducto_Model');
        $this->load->model('compraProducto_Model');
        $this->load->model('inventProducto_Model');
        $this->load->model("prodPresentacion_Model");
        

        $this->load->helper('path');
    }

    //  funcion para  listar  los  ultimos  

    public  function ListarTraslados(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
       
        // echo  'llegando al controlador de la presentacion del producto';
        $datos["listaTraslados"] =   $this->trasladoProducto_Model->ListarTrasladoProducto();
        //var_dump($this->datos["datosMArcas"]);
        $this->load->view("traslados/listaTraslados", $datos); 
       // $this->load->view("traslados/listaTraslados"); 
    }

    /*Funcion paramostrar la  vista para  agregar datos del   invetario manual */
 public function addTrasladosProducto(){ 
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL); 
    //  cargamos los  datos para  los  select  
    $datos['listaProductos']     = $this->Producto_Model->get_ListProductoTrasladar();
    $datos['listBodegaProducto'] = $this->bodegaProducto_Model->get_listBodegaProducto();
 
    $this->load->view('traslados/traslado_prodcto', $datos);
  }

  

    // funccion para procesar los traslados de los  prouctos
    public  function saveTraslado(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL); 
        //echo  'llegando al  controlador para procesar los  traslados';
        //$idTransac     = (isset($_POST["idTransac"]))?  $_POST["idTransac"] : 0;
        //echo  "El id de la transacciones es " .  $idTransac;
       // echo    'llegando al controlador',
        //$operacionesInventario  =  new  operacionesInvenatarios();
        // controles del  formulario
        /*fechatraslado
            bodOrigen 
            bodDestino
            producto
            prodPresentacion --  indica  si  es una caja o unidad como  tal 
            existenciaprod
            cantidadTrasl
            cantidadProd */
        // 
        $productoID       = 0;
        $bodProdOrigen    = 0;
        $bodProdDestino   = 0;
        $unidMeTtrasl     = 0;
        $cantidadTrasl    = 0;
        $cantidadProd     = 0;
        $fechTrasladoProd = 0;
        $usuarioID        = 0;
        $nivelUsrID       = 0;
        $alor ='';
        try {
         // echo  'calculadno';  
          $result = 10/$alor;
         // echo  'despues del calculo'.  $result;  
            
        } catch (error $e) {
           echo $e->getMessage();
         //  log_message('error: ',$e->getMessage());
          // echo   'se ha encontrando un errornen el  calculo';
          // return;
        }

        
        exit;
        $movtipo        = "TRASL" ;
        $productoID     = (isset($_POST["producto"]))?  $_POST["producto"] : 0;
        $bodProdOrigen  = (isset($_POST["bodOrigen"]))?  $_POST["bodOrigen"] : 0;
        $bodProdDestino = (isset($_POST["bodDestino"]))?  $_POST["bodDestino"] : 0;  
        $unidMeTtrasl   = (isset($_POST["prodPresentacion"]))?  $_POST["prodPresentacion"] : 0;
        $cantidadTrasl  = (isset($_POST["cantidadTrasl"]))?  $_POST["cantidadTrasl"] : 0;        
        $salida         = (isset($_POST["cantidadProd"]))?  $_POST["cantidadProd"] : 0;
        $entrada        = (isset($_POST["cantidadProd"]))?  $_POST["cantidadProd"] : 0;
        //$transaccionID  = (isset($_POST["idTransac"]))?  $_POST["idTransac"] : 0;
       
        $trasProdID     = NULL;
        $dataSalidaTras =  array(
                                  'productoID'    => $productoID,
                                  'bodProdOrigen' => $bodProdOrigen, 
                                  'bodProdDestino'=> $bodProdDestino,
                                  'unidMeTtrasl'  => $unidMeTtrasl,
                                  'cantidadTrasl' => $cantidadTrasl,
                                  'cantidadProd'  => $salida,
                                  'usuarioID'     => $usuarioID,
                                  'nivelUsrID'    => $nivelUsrID,                             
                            );
                           var_dump($dataSalidaTras);
                           exit ;  
                            //echo 'Inserta la salida en el  kardex' .  '<br>';
                           $this->compraProducto_Model->addMoVKardex( $dataSalidaTras, $trasProdID) ;  
                                               
        $dataEntradaaK =  array('transaccionID'    => $transaccionID,
                                  'movtipo'          => $movtipo, 
                                  'bodegaProductoID' => $bodegaDest,
                                  'productoID'       => $productoID,
                                  'entrada'          => $entrada,
                                  'salida'           => 0,
                                  'precio_unit'      => 1,
                                  'subtotal'         => 1,
                                  'impuesto'         => 1,
                                  'total'            => 0 
                                );
                           // var_dump($dataEntradaaK);   
                          
       $this->compraProducto_Model->addMoVKardex($dataEntradaaK, $kardexProdID) ;  
       $operacionesInventario ->actualizarInventario($productoID, $movtipo,$bodegaOrigen, $bodegaDest, $entrada ); 
       # SEGMENTO PARA  ALTERAR EL  INVENTARIO  
     
       
       #  FIN DEL SEGMENTO PARA ALTERAR EL INVENTARIO  

       
        

    }

    //  funcion para  mostrar el  formulario de captura de existencia
    public function  ingresarTraslados(){
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL);
     // echo   'variable que  se inicio en compra' . $_SESSION['idDetCompra'];
      // echo  'llegando al controlador de la MEDIDA del producto';
      // echo  'modificacion en la captura de existencia ' ;
      $datos['listBodegaProducto'] = $this->bodegaProducto_Model->get_listBodegaProducto();
      $datos["listaProductos"]     = $this->Producto_Model->get_ListProducto();
      $datos["prodPresentacion"]   = $this->prodPresentacion_Model->get_PresentacionProd();
      //var_dump($this->datos["datosMArcas"]);
    // $this->load->view("traslados/trasladosInvent", $datos);
    # la sumatoria de todos los  traslados incrementaran el refil de la  toma fisica  

  $this->load->view("traslados/IngresarTraslados", $datos); 

} 
// funcion para mostrar  lista  en movil 
public  function Listamovil(){
  ini_set('display_errors',1);
  ini_set('display_startup_errors',1);
  error_reporting(E_ALL);
  // echo  'llegando al controlador de la presentacion del producto';
 // $datos["listaTraslados"] =   $this->trasladoProducto_Model->Listamovil();
  //var_dump($this->datos["datosMArcas"]);
  $this->load->view("traslados/ultimosTraslados"); 
 // $this->load->view("traslados/listaTraslados"); 
}
// segmento que   cea un array cabecera para insertardatos y modificarlos posterior 


}