<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class TipoProducto_Model extends CI_Model {
  
    // funcion para cargar las  categorias de los  productos  
    public function get_listaTipoProducto() {
        $query =  $this->db->select("*")   
                 ->get("tipoproducto")
                 ->result();
        return  $query;          
    }

    


}