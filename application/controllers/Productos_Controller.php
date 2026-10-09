<?php 
ini_set('display_errors',1);
  ini_set('display_startup_errors',1);
  error_reporting(E_ALL); 

defined('BASEPATH') OR exit('No direct script access allowed');
class Productos_Controller extends CI_Controller {  
    public function __construct()
    {
           parent::__construct();     
           $this->load->database();                  
           $this->load->model('Producto_Model');
           $this->load->model('Proveedor_Model');
           $this->load->model('FamiliaProducto_Model');
           $this->load->model('TipoProducto_Model');
           $this->load->model('MedidaProducto_Model');
           $this->load->model('Marcas_Model');
           $this->load->model('PresentacioProducto_Model');
           $this->load->model('bodegaProducto_Model');
           $this->load->model('preciosProducto_Model');
           $this->load->model('inventProducto_Model');
           $this->load->model('equivalenteProducto_Model');
           $this->load->model('Config_Model');
           $this->load->model('PrecioArea_Model');
           $this->load->model('AreasEstablecimiento_Model');
           //preciosProducto_Model
           $this->load->helper('path');
    }
    //Creamos la funncion para  agrear el menu  interno 
    public function listarProductos(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);        
        $data['listaProductos'] = $this->Producto_Model->get_listaProductos();
        $this->load->view('productos/producto',$data);
    }

    /*Funcion para cargar la modal para  registrar los  productos  */    
     public function addProducto($productoID){ 
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL); 
        $data['proveedorProducto']   = $this->Proveedor_Model->get_listaProveedores();
        $data['familiaProducto']     = $this->FamiliaProducto_Model->listaAllFamiliaProducto();
        $data['tipoProducto']        = $this->TipoProducto_Model->get_listaTipoProducto();
        $data['medidaProducto']      = $this->MedidaProducto_Model->get_listaMedidaProducto();
        $data['MarcaProducto']       = $this->Marcas_Model->get_listaMarcaProducto();
        $data['prsentacionProducto'] = $this->PresentacioProducto_Model->get_listaPresentacionProducto();
        $data['datoproducto']        = $this->Producto_Model->get_productoID($productoID);
        $data['TipoMovInvnt']        = $this->Config_Model->get_listTipoMovInvnt();
        $data['Presentacion_inv']    = $this->Config_Model->get_listPresentacion_inv();


        $this->load->view('productos/addProducto',$data);
     }
     //    funcion para modificar los  datos del  producto 
     public function updateDatProducto($productoID){ 
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL); 
      $data['proveedorProducto']   = $this->Proveedor_Model->get_listaProveedores();
      $data['familiaProducto']     = $this->FamiliaProducto_Model->listaAllFamiliaProducto();
      $data['tipoProducto']        = $this->TipoProducto_Model->get_listaTipoProducto();
      $data['medidaProducto']      = $this->MedidaProducto_Model->get_listaMedidaProducto();
      $data['MarcaProducto']       = $this->Marcas_Model->get_listaMarcaProducto();
      $data['prsentacionProducto'] = $this->PresentacioProducto_Model->get_listaPresentacionProducto();
      $data['datoproducto']        = $this->Producto_Model->get_productoID($productoID);
      $data['TipoMovInvnt']        = $this->Config_Model->get_listTipoMovInvnt();
      $data['Presentacion_inv']    = $this->Config_Model->get_listPresentacion_inv();


      $this->load->view('productos/addProducto',$data);
   }

     /*Funcion para almacenar el  producto */
     public function saveProducto(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL); 
        /*determinamos si  el producto ya  existe   */    
          
       // $productoID       = NULL;
        $rIdProd            = 0;
        $bodegaProductoID   = 1;
        $productoID         = (isset($_POST['productoID'])) ? $_POST['productoID']: NULL; 
        $proveedorID        = (isset($_POST['proveedor'])) ? $_POST['proveedor']: NULL;
        $famProdID          = (isset($_POST['familia'])) ? $_POST['familia']: NULL;
        $tipProdID          = (isset($_POST['tipProducto'])) ? $_POST['tipProducto']: NULL;
        $marcProdID         = (isset($_POST['marca'])) ? $_POST['marca']: NULL; 
        $presProdID         = (isset($_POST['presentacion'])) ? $_POST['presentacion']: NULL;
        $medProdID          = (isset($_POST['medida'])) ? $_POST['medida']: NULL;
        $prodDescripcion    = (isset($_POST['descripcion'])) ? $_POST['descripcion']: NULL;
        $tipomovinvtId      = (isset($_POST['tipomovinvent'])) ? $_POST['tipomovinvent']: NULL;
        $presentacion_invId = (isset($_POST['presentacioninvent'])) ? $_POST['presentacioninvent']: NULL;
       // echo  "el valor del  control es" . $_POST['prodctucocina'] . "<br>" ;

        $prodctucocina   = ($_POST['prodctucocina']==true) ? '1': '0';

        
        $dataProd = array('prodDescripcion'=>$prodDescripcion,
                          'famProdID'=>$famProdID,
                          'presProdID'=>$presProdID,
                          'tipProdID'=>$tipProdID,
                          'marcProdID'=>$marcProdID,
                          'medProdID'=>$medProdID,
                          'proveedorID'=>$proveedorID,
                          'tipomovinvtId'=>$tipomovinvtId,
                          'presentacion_invId'=>$presentacion_invId, 
                          'prodctucocina'=>$prodctucocina,

                          
                        );
         var_dump($dataProd);
        //  hacemos la  insercion en la tabla de precios 
        echo    'el id del producto que se va actualizar es '. $productoID . '#'.'<br>';
        $rIdProd  = $this->Producto_Model->addProducto($dataProd,$productoID);
        if($rIdProd!=0){
          $resulbPrec =  $this->preciosProducto_Model->get_productoIDPrecios($rIdProd);
            if(Empty( $resulbPrec )){
              $precProdID = NULL;
             echo 'Creano los  precios del controlador';
              $data =array('productoID'=>$rIdProd ,  
                          'preciocosto' =>0,  
                          'precioventa' =>0);
              $this->preciosProducto_Model->addProductoPrec($data, $precProdID);
            }
            // hacemos la  insercion en  el   inventario
          $resulbInv = $this->inventProducto_Model->get_productoIDInventarios($rIdProd,$bodegaProductoID) ;
            if(Empty($resulbInv)){
              echo 'creando la linea en el   inventario';
              $invProdID = NULL;
              $data =array('productoID'      =>$rIdProd ,  
                          'bodegaProductoID' =>$bodegaProductoID,  
                          'usuarioID'        => $_SESSION["usuarioID"],
                          'existenciaInvProd' =>0);
              $this->inventProducto_Model->addProductoInvent($data, $invProdID);
            }
        }
     }
     /*Funcion paramostrar la  vista para  agregar datos del   invetario manual */
  public function addInventManual(){ 
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL); 
      $this->load->view('inventarios/tblingresar_inventario');  

  }
 


  /*funcion para  ingresar el detalle de coventampra del los  productos*/
  public function addVentaProducto(){ 
   ini_set('display_errors',1);
   ini_set('display_startup_errors',1);
   error_reporting(E_ALL); 
   $this->load->view('inventarios/venta_producto');
 }

 /*Funcio  para cargar las  congiraciones de los productos */
 public function setthingProduct(){
  ini_set('display_errors',1);
   ini_set('display_startup_errors',1);
   error_reporting(E_ALL); 
   $datos['familiaProducto']          = $this->FamiliaProducto_Model->get_listFamiliaProducto();
   $datos['turnos'] = $this->Producto_Model->get_turnooperacion();  
   $datos['equivalentes']          = $this->equivalenteProducto_Model->get_listaEquivalentes();
   //var_dump($datos['equivalentes']);
   $datos["listaProductos"] =   $this->Producto_Model->get_ListProducto();
  //   var_dump(  $datos['familiaProducto'] );
   $this->load->view('configuraciones/configuraciones', $datos);


 }
 //  funcion para mostrar los productos que se ingresa   en  el  formulario   de compra  
 
 
 public function addProductoCompra(){ 
  ini_set('display_errors',1);
  ini_set('display_startup_errors',1);
  error_reporting(E_ALL); 
  //echo  'llegando al  controlador';
  $datos['ListProducto'] =  $this->Producto_Model->get_ListProducto();
  $this->load->view('productos/addProcompra', $datos);
}
// funcion para  actualizar los precios de  los productos

public function preciosProducto(){ 
  ini_set('display_errors',1);
  ini_set('display_startup_errors',1);
  error_reporting(E_ALL); 
  //echo  'llegando al  controlador';
  //  el  filtro  de  familia  llega  vacio  la  primera  vez :  se  muestran  todas
  $famProdID = (isset($_REQUEST['famProdID']) AND $_REQUEST['famProdID'] > 0) ? $_REQUEST['famProdID'] : 0 ;

  $datos['lista_productoCostear'] =  $this->preciosProducto_Model->lista_productoCostear($famProdID);
 // var_dump($datos['lista_productoCostear']) ;
  //  se agregan  las  areas  creadas  para  dibujar  una  columna  de precio  por  cada  una  de  ellas
  $datos['listAreasEstablecimiento'] = $this->AreasEstablecimiento_Model->get_listAreasEstablecimiento($_SESSION["establecimientoID"]);
  $datos['preciosArea']              = $this->PrecioArea_Model->get_matrizPreciosArea();
  //  familias  para  el  select  del  filtro
  $datos['listFamiliaProducto']      = $this->FamiliaProducto_Model->listaAllFamiliaProducto();
  $datos['famProdID']                = $famProdID;

  $this->load->view('inventarios/precios_producto', $datos);
}

// funcion que  devuelve  UNICAMENTE  el  cuerpo  de  la  lista  de  precios  filtrada  por  familia.
// La  usa  el  select  del  filtro  y  tambien  el  boton  de  actualizar  precio , asi  solo  se
// recarga  el  div  de  la  lista  y  el  filtro  seleccionado  no  se  pierde.
public function listaPreciosProducto(){
  $famProdID = (isset($_REQUEST['famProdID']) AND $_REQUEST['famProdID'] > 0) ? $_REQUEST['famProdID'] : 0 ;

  $datos['lista_productoCostear']    = $this->preciosProducto_Model->lista_productoCostear($famProdID);
  $datos['listAreasEstablecimiento'] = $this->AreasEstablecimiento_Model->get_listAreasEstablecimiento($_SESSION["establecimientoID"]);
  $datos['preciosArea']              = $this->PrecioArea_Model->get_matrizPreciosArea();

  $this->load->view('inventarios/cuerpoPreciosProducto', $datos);
}
   
// funcion  para actualizar los precio  del  los productos 
public function  updatePrecProd (){  
  ini_set('display_errors',1);
  ini_set('display_startup_errors',1);
  error_reporting(E_ALL); 
  

  $productoID     = (isset($_POST["productoID"]))?  $_POST["productoID"] : 0;
  $preciocosto    = 0 ; //(isset($_POST["preciocosto"]))?  $_POST["preciocosto"] : 0;
  $precioventa    = (isset($_POST["precioventa"]))?  $_POST["precioventa"] : 0;    
  $fechactualizado = date("Y-m-d H:i:s");
  //echo "el valor del control es" . $_POST["proddisponible"] . "<br>" ;
  $proddisponible = (  $_POST["proddisponible"] == 'true' )? 1 : 0;
  # preparando el algoritmo para  refleja la  salida en  el kardex
 
  $data =  array( 'preciocosto'      => $preciocosto,
                  'precioventa'      => $precioventa,
                  'fechactualizado'  => $fechactualizado ,
                   'proddisponible'  => $proddisponible,                    
                );
  //var_dump($data); 
  // usamos  una nueva sincronizacin  para probar el  commit              

  $this->preciosProducto_Model->updateProductoPrec($data, $productoID);


} 

public function deleteProducto($productoID){
    $datos =  $this->Producto_Model->deleteProducto($productoID);

}



   

  }
 