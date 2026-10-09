<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class Marcas_Model extends CI_Model {
  
    // funcion para cargar las  categorias de los  productos  
    public function get_listaMarcaProducto() {
        $query =  $this->db->select("*")   
                 ->get("marcaproducto")
                 ->result();
        return  $query;          
    }
    /*funcion para insertar una nueva marca de producto */
    public function  addMarcaProducto($data, $id){
        if($id ==   null){
            $this->db->insert("marcaproducto",$data);
            return $this->db->insert_id();
        }else{
            $this->db->set("marcProdDescripcion", $data["marcProdDescripcion"])
                    ->where("marcProdID", $id)
                    ->where("marcProdStatus",  1)
                    ->update("marcaproducto");
            return $this->db->affected_rows();   
               
                }

    }
    //  funcion para  retornar el  nombre de la marcar por  id 
    
     // funcion para cargar las  categorias de los  productos  
    public function get_MarcaProductoID($marcProdID) {
        $query =  $this->db->select("*")   
               ->where("marcProdID",$marcProdID)         
        ->get("marcaproducto")

                 ->result();
        return  $query;          
    }

    /*Funcion para eliminar  una marca de producto */
    public function delete_MarcaProductoID($marcProdID) {
        $this->db->where("marcProdID",$marcProdID)         
                 ->delete("marcaproducto");                 
        return  $this->db->affected_rows();          
    }

 


}