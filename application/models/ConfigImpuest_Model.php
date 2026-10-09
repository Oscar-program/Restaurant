<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ConfigImpuest_Model extends CI_Model {

    public function get_InfoConfigProducto(){
        $query = $this->db->select( "*" )
        ->get("configura_impuestos ")
        ->row(); 
        return $query ;
         
    }
}
 