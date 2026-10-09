<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class configuracioProd_Controller extends CI_Controller {  
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
           $this->load->model('equivalenteProducto_Model');             
           

           $this->load->helper('path');  
        
    }
    // funcion para  determinar que  detalle se mostrara en las tablas  de cada uno de los tab  
    public function mostrarDetalleconsiguracion(){ 
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL);
      echo 'llegando a ontrolador  de mostrar detalle de productos'; 
      /*Determinamos si  hay  un tab activo*/
      if(isset($_POST["txtmarca"])){
         echo  'en el  formulario de marca <br>';
      }else if(isset($_POST["txtpresentacion"])){
        echo  'en el  formulario de Presentacion <br>';
      }else if(isset($_POST["txtmedida"])){
        echo  'en el  formulario de Medida <br>';
      }else if(isset($_POST["txtproveedor"])){
        echo  'en el  formulario de proveedor <br>';
      }else if(isset($_POST["txtbodega"])){
        echo  'en el  formulario de BODEGA <br>';
      }else if(isset($_POST["txtturno"])){
        echo  'en el  formulario de TURNO <br>';
      }  
      
      //$data['proveedorProducto']   = $this->Proveedor_Model->get_listaProveedores();
      //$data['familiaProducto']     = $this->FamiliaProducto_Model->get_listFamiliaProducto();
      //$data['tipoProducto']        = $this->TipoProducto_Model->get_listaTipoProducto();
      //$data['medidaProducto']      = $this->MedidaProducto_Model->get_listaMedidaProducto();
      //$data['MarcaProducto']       = $this->Marcas_Model->get_listaMarcaProducto();
      //$data['prsentacionProducto'] = $this->PresentacioProducto_Model->get_listaPresentacionProducto();
      


     // $this->load->view('productos/addProducto',$data);
   

   }
  # segmento para administracion de las marcar de producto 
      public function saveMarca(){
          ini_set('display_errors',1);
            ini_set('display_startup_errors',1);
            error_reporting(E_ALL);
            /* Creamos una variable para determinar el  modelo  a ejecutar*/
            $Tabla  ="";
            if(isset($_POST['txtmarca'])){
              $marcProdDescripcion = $_POST['txtmarca'];
              $id = null;
              if($_POST['marcProdID']!=''){
                echo  'la marca se tiene que  actualizar';
                $id =$_POST['marcProdID'];
              }
              $data =  array("marcProdDescripcion"=>$marcProdDescripcion);
              $result = $this->Marcas_Model-> addMarcaProducto($data, $id);
          }else{
            echo   'no se ha dibujado el  control';
          }
      } 
      /*segmento para  actualizar la tabla de  marcas   */
      public function  mostrarDetalleMarcas(){
        //echo  'mostrado el   detalle de las marcas######################';
      $datos["datosMArcas"] =   $this->Marcas_Model->get_listaMarcaProducto();
      //var_dump($this->datos["datosMArcas"]);
      $this->load->view("configuraciones/detMarcas", $datos); 
      }
      /*Funcion para  actualzar el nombre de la marca   */
      public  function get_marcaxId($marcProdID){
              $result =  $this->Marcas_Model->get_MarcaProductoID($marcProdID);
              echo  json_encode($result);
      }

      /*Funcion para elminar marca de  producto  */
      public  function  delete_MarcaProductoID($marcProdID){
      $result =  $this->Marcas_Model->delete_MarcaProductoID($marcProdID);
      echo  $result;
      }
  # fin del  segmento para la administracion de las marcas
  # segmento paa administrar la presentacion de los productos
  
  # fin del segmento para la  presentacion de los  productos  
      
    //funcion para mostrar los  tab  de configuracion de productos  
    public function listarProductos(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        $data['listaProductos'] = $this->Producto_Model->get_listaProductos();
            

        $this->load->view('productos/producto',$data);
    }

    /*Funcion para cargar la modal para  registrar los  productos  */
     /* funcion para cargar la modal  para  procesar la venta del producto */
     public function addProducto(){ 
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL); 

        $data['proveedorProducto']   = $this->Proveedor_Model->get_listaProveedores();
        $data['familiaProducto']     = $this->FamiliaProducto_Model->get_listFamiliaProducto();
        $data['tipoProducto']        = $this->TipoProducto_Model->get_listaTipoProducto();
        $data['medidaProducto']      = $this->MedidaProducto_Model->get_listaMedidaProducto();
        $data['MarcaProducto']       = $this->Marcas_Model->get_listaMarcaProducto();
        $data['prsentacionProducto'] = $this->PresentacioProducto_Model->get_listaPresentacionProducto();
        


        $this->load->view('productos/addProducto',$data);
     

     }
     /*Funcion para almacenar el  producto */
     public function saveProducto(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL); 
        /*determinamos si  el producto ya  existe   */
         $proveedor    = '';
	      $familia      = '';
	      $tipProducto  = '';
	      $marca        = '';
	      $presentacion = '';
	      $medida       = '';
	      $descripcion  = '';


        if(isset($_POST['proveedor'])){
         $proveedor  = $_POST['proveedor'] ;
        }
        if(isset($_POST['familia'])){
         $familia =$_POST['familia'];

        }
        if(isset($_POST['tipProducto'])){
         $tipProducto =$_POST['tipProducto'];
        }
        if(isset($_POST['marca'])){
         $marca =$_POST['marca'];
        }
        if(isset($_POST['presentacion'])){
         $presentacion =$_POST['presentacion'];
        }
        if(isset($_POST['medida'])){
         $medida =$_POST['medida'];
        }
        if(isset($_POST['descripcion'])){         
         $descripcion =$_POST['descripcion'];
        }
        echo  'los  valores capturados son ' .  $proveedor ;  

        
        
        
        
        
        
        

     }
     /*Funcion paramostrar la  vista para  agregar datos del   invetario manual */
     public function addInventManual(){ 
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL); 
     
      


      $this->load->view('inventarios/tblingresar_inventario');
   

   }
 /*Funcion paramostrar la  vista para  agregar datos del   invetario manual */
 public function addTrasladosProducto(){ 
   ini_set('display_errors',1);
   ini_set('display_startup_errors',1);
   error_reporting(E_ALL); 
   $this->load->view('inventarios/traslado_prodcto');
 }

 /*funcion para  ingresar el detalle de compra del los  productos*/
 public function addCompraProducto(){ 
   ini_set('display_errors',1);
   ini_set('display_startup_errors',1);
   error_reporting(E_ALL); 
   $this->load->view('inventarios/compra_producto');
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
   //  cramos los set  de  datos para el  turno  y  la  familia de los productos existentes 
   $datos['turnos']          = $this->FamiliaProducto_Model->get_listFamiliaProducto();
   $datos['familiaProducto'] = $this->Producto_Model->get_turnooperacion();  

   $datos['equivalentes']          = $this->equivalenteProducto_Model->get_listaEquivalentes();
   //var_dump($datos['equivalentes']);
   $datos["listaProductos"] =   $this->Producto_Model->get_ListProducto(); 

   //  var_dump(  $datos['familiaProducto'] );

   $this->load->view('configuraciones/configuraciones',$datos);


 }

   



   

  }
 