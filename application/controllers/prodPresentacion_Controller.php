<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class prodPresentacion_Controller extends CI_Controller{

    public   function  __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model("inventProducto_Model");
        $this->load->model("Producto_Model");
        $this->load->model("bodegaProducto_Model");
        $this->load->model("prodPresentacion_Model");
        
        $this->load->helper("path");   
        }
    public function getunidadPresentacion($productoID, $presProdID){
        $unidaPresentacion = 0;
        $DatosProdPresent  =  $this->prodPresentacion_Model->get_datoProdPresentacion($productoID, $presProdID);
        if(!empty($DatosProdPresent)){
            $unidaPresentacion =  $DatosProdPresent->unidades; 
        }
        echo  $unidaPresentacion;


    }    
}