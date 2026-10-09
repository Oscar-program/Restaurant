<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class PresentacioProducto_Model extends CI_Model {
  
    // funcion para cargar las  categorias de los  productos  
    public function get_listaPresentacionProducto() {
        $query =  $this->db->select("*")  
                 ->where("presProdStatus",  1) 
                 ->get("presentacionproducto")
                 ->result();
        return  $query;          
    }

    
    /*funcion para insertar una nueva marca de producto */
    public function  addPresentacionProducto($data, $presProdID){
        if($presProdID ==   null){
            $this->db->insert("presentacionproducto",$data);
            return $this->db->insert_id();
        }else{
            $this->db->set("presProdDescripcion", $data["presProdDescripcion"])
                    ->where("presProdID", $presProdID)
                    ->where("presProdStatus",  1)
                    ->update("presentacionproducto");
            return $this->db->affected_rows();   
               
                }

    }
    //  funcion para  retornar el  nombre de la marcar por  id 
    
     // funcion para cargar las  categorias de los  productos  
    public function get_PresentacionProductoID($presProdID) {
        $query =  $this->db->select("*")   
                           ->where("presProdID",$presProdID)         
                           ->get("presentacionproducto")
                           ->result();
        return  $query;          
    }

    /*Funcion para eliminar  una marca de producto */
    public function delete_PresentacionProductoID($presProdID) {
        $this->db->where("presProdID",$presProdID)         
                 ->delete("presentacionproducto");                 
        return  $this->db->affected_rows();          
    }

    


}