<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class MedidaProducto_Model extends CI_Model {
  
    // funcion para cargar las  categorias de los  productos  
    public function get_listaMedidaProducto() {
        $query =  $this->db->select("*")   
                 ->get("medidaproducto")
                 ->result();
        return  $query;          
    }
   
    /*funcion para insert nueva medida de  producto */
    public function  addMedidaProducto($data, $medProdID){
        if($medProdID ==   null){
            $this->db->insert("medidaproducto",$data);
            return $this->db->insert_id();
        }else{
            $this->db->set("medProdDescripcion", $data["medProdDescripcion"])
                    ->where("medProdID", $medProdID)
                    ->where("medProdStatus",  1)
                    ->update("medidaproducto");
            return $this->db->affected_rows();   
               
                }
    }

       
     // funcion para cargar la medida que  se  quiere  modificar  
    public function get_MedidaProductoID($medProdID) {
        $query =  $this->db->select("*")   
                           ->where("medProdID",$medProdID)         
                           ->get("medidaproducto")
                           ->result();
        return  $query;          
    }

    /*Funcion para eliminar  una medida de  producto */
    public function delete_MedidaProductoID($medProdID) {
        $this->db->where("medProdID",$medProdID)         
                 ->delete("medidaproducto");                 
        return  $this->db->affected_rows();          
    }
    


}