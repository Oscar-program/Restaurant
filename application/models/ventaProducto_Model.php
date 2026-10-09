<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class ventaProducto_Model  extends CI_Model{
//  segmento  para  almacenar la   venta del producto 
 /*Funcion para eliminar  una marca de producto */
 public function delete_MarcaProductoID($marcProdID) {
    $this->db->where("marcProdID",$marcProdID)         
             ->delete("marcaproducto");                 
    return  $this->db->affected_rows();          
}

}