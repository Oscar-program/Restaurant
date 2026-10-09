<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
class Menu_internoController extends CI_Controller {  
    public function __construct()
    {
           parent::__construct();     
           $this->load->database();                  
           $this->load->model('Producto_Model');
           $this->load->model('bodegaProducto_Model');
           $this->load->model('PrecioEspecial_Model');
           $this->load->model('familiaProducto_Model');
           $this->load->model('ordenesPedido_Model');
           $this->load->model('mesas_Model');


           $this->load->helper('path');

    }
    //Creamos la funncion para  agrear el menu  interno 
    public function index(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        echo "mostrando el  menu principal" ;
                $data['sds'] = $this->Producto_Model->get_producto();
                //var_dump($data['sds'] );
         
                 //$this->load->view('menuinterno/menu_interno');

        $this->load->view('menuinterno/menu_interno',$data);
    }
    //  $areaEstablecimientoID  = area  de la  mesa , define  con  que  precio  se  muestran  los  productos
    //  $soloCocina            = 1  muestra  unicamente  los  productos  con  prodctucocina = 1
    public function cargar_submenu($famProdID, $areaEstablecimientoID = 0, $soloCocina = 0){

        //echo 'llegando al  menu interno de la familia de  productos'. $famProdID .  "<br>";
        $data['submenu'] = $this->Producto_Model->get_submenu($famProdID, $areaEstablecimientoID, $soloCocina);
        //var_dump($data['submenu']);
        //echo  "mostrando los resultados de buscar submenu";
        $data['comandas'] = $this->Producto_Model->get_comandas();
        $data['familia']  = $famProdID;
        //var_dump($data['comandas'] );
        $this->load->view('menuinterno/sub_menu',$data);

     }

    /* funcion para cargar la modal  para  procesar la venta del producto */
    public function addVentaProducto($famProdID, $id  ){  
        $data['comandas'] = $this->Producto_Model->get_comandas();
        $data['bodegas'] = $this->bodegaProducto_Model->get_listBodegaProducto();
        $data['precioespporfamilia'] = $this->PrecioEspecial_Model->ListPreciosEspPorFamiliaProd($famProdID);

        $this->load->view('menuinterno/add_ventaProducto',$data);
     

     }
     // funcion para cargar la pantalla principal de  ordenes  
     public function cargar_addordenes($mesaID, $mesNombre){
       
       //echo 'llegando al  menu interno de la familia de  productos'. $mesaID .  "<br>";
        $data['listFamiliaProducto'] = $this->familiaProducto_Model->get_listFamiliaProducto();
       // var_dump($data['listFamiliaProducto'] );
       // $data['submenu'] = $this->Producto_Model->get_submenu($famProdID);
        //var_dump($data['submenu']);
        //$data['comandas'] = $this->Producto_Model->get_comandas();
        # segmento para  generar la  cabecera  de la  orden de pedido  
        $usuarioID       =   $_SESSION["usuarioID"];
        $mesaID         = $mesaID;
        $comandaID      =  1;
        $ordenPedidoID  = null;

       $datosMEsa  =  array( 'usuarioID' =>$usuarioID,
                            'mesaID' =>$mesaID,
                          
                            'comandaID' =>$comandaID,
                            
                        );
       // echo  'llegadno al controlador';                
       $ordenID  =  $this->ordenesPedido_Model->addOrdenPedido($datosMEsa, $ordenPedidoID); 

       
        $data['familia']     = $mesaID;
        $data['datordenID']  = $ordenID ;
        $data['mesaID']      = $mesaID ;
          $data['mesNombre']      = $mesNombre ;
        //  el  area  de la  mesa  define  el  precio  con  el  que  se  muestran  los  productos
        $infoMesa                        = $this->mesas_Model->get_infoMesa($mesaID);
        $data['areaEstablecimientoID']   = (!empty($infoMesa)) ? $infoMesa->areaEstablecimientoID : 0 ;
        $data['area']                    = (!empty($infoMesa)) ? $infoMesa->area : "" ;
        $data['soloCocina']              = 0 ;


        //var_dump($data['comandas'] );
        $this->load->view('menuinterno/ordenesProducto',$data);

        //return  $ordenID ;

     }

     // =================================================================
     //  funcion que  muestra  las  ordenes  ABIERTAS ( no  cobradas )  de  una  mesa
     //  desde  aqui  se  puede  agregar  productos  a  una  orden  existente
     //  o  abrir  una  orden  nueva
     // =================================================================
     public function ordenesMesa($mesaID, $mesNombre = ""){
        $data['infoMesa']        = $this->mesas_Model->get_infoMesa($mesaID);
        $data['ordenesAbiertas'] = $this->ordenesPedido_Model->listaOrdenesAbiertasMesa($mesaID);
        $data['totalMesa']       = $this->ordenesPedido_Model->totalMesaPendienteCobro($mesaID);
        $data['mesaID']          = $mesaID ;
        $data['mesNombre']       = str_replace("%20", " ", $mesNombre);
        if(empty($data['mesNombre']) && !empty($data['infoMesa'])){
            $data['mesNombre']   = $data['infoMesa']->mesNombre ;
        }
        $this->load->view('menuinterno/ordenesMesa',$data);
     }

     // =================================================================
     //  funcion que  abre  una  orden  YA  EXISTENTE  para  agregarle  productos ,
     //  solo  se  permite  si  la  orden  no  ha  sido  cobrada
     //  $soloCocina = 1  hace  que  la  lista  de  productos  muestre  unicamente  prodctucocina = 1
     // =================================================================
     public function agregarProductosOrden($ordenPedidoID, $mesaID, $soloCocina = 1){
        if($this->ordenesPedido_Model->esOrdenAbierta($ordenPedidoID) == 0){
            echo "<div class='alert alert-warning text-center'>La orden #".$ordenPedidoID." ya fue cobrada o anulada, no se le pueden agregar productos.</div>";
            return ;
        }
        $infoMesa = $this->mesas_Model->get_infoMesa($mesaID);

        $data['listFamiliaProducto']   = $this->familiaProducto_Model->get_listFamiliaProducto();
        $data['detalleOrden']          = $this->ordenesPedido_Model->get_listDetOrden($ordenPedidoID);
        //var_dump( $data['detalleOrden'] );
        $Rdettotal                     = $this->ordenesPedido_Model->get_TotalDetOrden($ordenPedidoID);
        $data['datTotal']              = (!empty($Rdettotal)) ? (float) $Rdettotal->dettotal : 0 ;
        $data['familia']               = $mesaID;
        $data['datordenID']            = $ordenPedidoID ;
        $data['mesaID']                = $mesaID ;
        $data['mesNombre']             = (!empty($infoMesa)) ? $infoMesa->mesNombre : "" ;
        $data['areaEstablecimientoID'] = (!empty($infoMesa)) ? $infoMesa->areaEstablecimientoID : 0 ;
        $data['area']                  = (!empty($infoMesa)) ? $infoMesa->area : "" ;
        $data['soloCocina']            = ($soloCocina == 1) ? 1 : 0 ;

        $this->load->view('menuinterno/ordenesProducto',$data);
     }
     // funcion para  ver  la orden  pendiente  de cobro
      // funcion para cargar la pantalla principal de  ordenes



  }
 
