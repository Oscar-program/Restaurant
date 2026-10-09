<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class prodPresentacion_Model extends CI_Model{

    public function get_datoProdPresentacion($productoID, $presProdID){
        $query =  $this->db->select("*")
                            ->where("productoID",  $productoID)     
                            ->where("presProdID",  $presProdID)
                            ->get("prodpresentacion")
                            ->row();
        return  $query; 
    }

    //  funcion para  retomar las  diferentes presentaciones  de un productos
    public function get_PresentacionProd(){
        $query =  $this->db->select("*")                            
                            ->get("presentacionprod")
                            ->result();
        return  $query; 
    }
}