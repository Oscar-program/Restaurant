<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class BodegaProducto_Model extends CI_Model{

    // funcion para cargar las las bodegas de producto existentes
  
    public function get_listBodegaProducto(){
        $query =  $this->db->select("bod.bodegaProductoID, bod.bodProdDescripcion , est.estNombre ")
                    ->join('establecimientoempresa  est',  'bod.establecimientoID   =  est.establecimientoID', 'inner')
                   
                 //->where("famProdStatus",  1)
                 ->get("bodegaproducto  bod")
                 ->result();
        return  $query;          
    }


    //funcion para insert nueva medida de  producto 
    public function  addBodegaProducto($data, $bodegaProductoID){
        if($bodegaProductoID ==   null){
            $this->db->insert("bodegaproducto",$data);
            return $this->db->insert_id();
        }else{
            $this->db->set("bodProdDescripcion", $data["bodProdDescripcion"])
                    ->set("establecimientoID",  $data["establecimientoID"])
                    ->where("bodegaProductoID", $bodegaProductoID)
                    ->where("bodProdStatus",  1)
                    ->update("bodegaproducto");
            return $this->db->affected_rows();   
               
                }
    }

       
     // funcion para cargar la medida que  se  quiere  modificar  
    public function get_BodegaProductoID($bodegaProductoID) {
        $query =  $this->db->select("*")   
                           ->where("bodegaProductoID",$bodegaProductoID)         
                           ->get("bodegaproducto")
                           ->result();
        return  $query;          
    }

    //Funcion para eliminar  una medida de  producto 
    public function delete_BodegaProductoID($bodegaProductoID) {
        $this->db->where("bodegaProductoID",$bodegaProductoID)         
                 ->delete("bodegaproducto");                 
        return  $this->db->affected_rows();          
    }

    // funcion para listar las  diferentes  sucuarsales 
    public function get_Sucursales() {
        $query =  $this->db->select("*")   
                           ->where("estStatus",1)         
                           ->get("establecimientoempresa")
                           ->result();
        return  $query;          
    }

}