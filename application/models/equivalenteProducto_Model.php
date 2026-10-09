<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class equivalenteProducto_Model extends CI_Model{

    // listamos los nombres de los equivalentes  
    
    public function get_listaEquivalentes() {
        $query =  $this->db->select("equiv.*")  
                 
                ->get("presentacionprod equiv")
                 ->result();
        return  $query;          
    }
    
    // funcion para cargar las  categorias de los  productos  
  public function get_listaEquivalenteProducto() {
    $query =  $this->db->select("pres.prodPresentID, prod.prodDescripcion, equiv.presentacionProd,  pres.unidades ")   
            ->join('producto prod','prod.productoID =  pres.productoID','inner') 
            ->join('presentacionprod equiv','equiv.presProdID = pres.presProdID','inner') 
            ->get("prodpresentacion pres")
             ->result();
    return  $query;          
}

/*funcion para insert nueva medida de  producto */
public function  addEquivalenteProducto($data, $prodPresentID){
    if($prodPresentID ==   null){
        $this->db->insert("prodpresentacion",$data);
        return $this->db->insert_id();
    }else{
        $this->db->set("productoID", $data["productoID"])
                 ->set("presProdID", $data["presProdID"])
                 ->set("unidades", $data["unidades"])
                ->where("prodPresentID", $prodPresentID)
                ->where("medProdStatus",  1)
                ->update("prodpresentacion");
        return $this->db->affected_rows();   
           
            }
}

   
 // funcion para cargar la medida que  se  quiere  modificar  
public function get_EquivalenteProductoID($prodPresentID) {
    $query =  $this->db->select("*")   
                       ->where("prodPresentID",$prodPresentID)         
                       ->get("prodpresentacion")
                       ->result();
    return  $query;          
}

/*Funcion para eliminar  una medida de  producto */
public function delete_EquivalenteProductoID($prodPresentID) {
    $this->db->where("prodPresentID",$prodPresentID)         
             ->delete("prodpresentacion");                 
    return  $this->db->affected_rows();          
}  
}
