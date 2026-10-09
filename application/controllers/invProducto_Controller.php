<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class   invProducto_Controller extends CI_Controller{
    public   function  __construct(){
         parent::__construct();
         $this->load->database();
         $this->load->model("inventProducto_Model");
         $this->load->model("Producto_Model");
         $this->load->model("bodegaProducto_Model");
         $this->load->model("prodPresentacion_Model");
         
         $this->load->helper("path");   
         }

        //   funcion para  mostra  el indicador del   inventario  
        public function  indicadorExistenciaProd(){
                ini_set('display_errors',1);
                ini_set('display_startup_errors',1);
                error_reporting(E_ALL);
           // echo  'llegando al controlador de la MEDIDA del producto';
            $datos["indicadorExistenciaProd"] =   $this->inventProducto_Model->indicadorExistenciaProd();
            //var_dump($this->datos["datosMArcas"]);
             $this->load->view("inventarios/indicadorExistencia", $datos); 

        } 
        //  segmento para procesar los inventarios manuales  
        public function  iniciarInventario(){
          ini_set('display_errors',1);
          ini_set('display_startup_errors',1);
          error_reporting(E_ALL);
          // echo  'llegando al controlador de la MEDIDA del producto';
          // $datos["indicadorExistenciaProd"] =   $this->inventProducto_Model->indicadorExistenciaProd();
          //var_dump($this->datos["datosMArcas"]);
          $this->load->view("inventarios/iniciarInventario"); 
      // $this->load->view("inventarios/iniciarinventario"); 

       } 
          //  funcion para  mostrar el  formulario de captura de existencia
     public function  capturarExistencia(){
               ini_set('display_errors',1);
               ini_set('display_startup_errors',1);
               error_reporting(E_ALL);
               // echo  'llegando al controlador de la MEDIDA del producto';
               // echo  'modificacion en la captura de existencia ' ;
                $datos["listaProductos"] =   $this->Producto_Model->get_ListProducto();
                $datos["prodPresentacion"] =   $this->prodPresentacion_Model->get_PresentacionProd();
                
               //var_dump($this->datos["datosMArcas"]);
            $this->load->view("inventarios/capturarExistencia", $datos); 
     
       } 

    


     
    }