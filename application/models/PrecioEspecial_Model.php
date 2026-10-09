<?php 
defined('BASEPATH')  or exit('No direct script access allowed');
class  PrecioEspecial_Model  extends CI_Model{
     
    // funcion para cargar los precios especiales de   productos  
    public function get_listPreciosEspProducto(){
        $query =  $this->db->select(" turn.turnOperaDescripcion, fam.famProdDescripcion,
                                     psp.precioEspecialProdID,  psp.descPrecioEspecial,  psp.precioEspecial")
                    ->join('turnooperacion  turn',  'psp.turnOperaID   =  turn.turnOperaID', 'inner')
                    ->join('familiaproducto  fam',  'psp.famProdID   =  fam.famProdID', 'inner')  
                 //->where("famProdStatus",  1)
                 ->get("preciosespecialesproducto  psp")
                 ->result();
        return  $query;          
    }

    /*funcion para insert  nuevo precio especiales de  producto */
    public function  addPreciosEspProducto($data, $precioEspecialProdID){
        echo 'llegando al modelo';
        if($precioEspecialProdID ==   null){
            $this->db->insert("preciosespecialesproducto",$data);
            return $this->db->insert_id();
        }else{
            $this->db->set("descPrecioEspecial", $data["descPrecioEspecial"])
                     ->set("turnOperaID", $data["turnOperaID"])
                     ->set("famProdID", $data["famProdID"])
                     ->set("precioEspecial", $data["precioEspecial"])
                     ->where("precioEspecialProdID", $precioEspecialProdID)
                     
                     ->update("preciosespecialesproducto");
            return $this->db->affected_rows();   
               
                }
    }

       
     // funcion para cargar el precio  especial  a modificar 
    public function get_PreciosEspProductoID($precioEspecialProdID) {
        $query =  $this->db->select("*")   
                           ->where("precioEspecialProdID",$precioEspecialProdID)         
                           ->get("preciosespecialesproducto")
                           ->result();
        return  $query;          
    }

    /*Funcion para eliminar  una medida de  producto */
    public function delete_PreciosEspProductoID($precioEspecialProdID) {
        $this->db->where("precioEspecialProdID",$precioEspecialProdID)         
                 ->delete("preciosespecialesproducto");                 
        return  $this->db->affected_rows();          
    }
    // funcion para  cargar la lista de  precios especiales por  producto 
    public function ListPreciosEspPorFamiliaProd($famProdID) {
        $query =  $this->db->select("precesp.precioEspecialProdID, precesp.descPrecioEspecial")   
                           ->where("precesp.famProdID",$famProdID)         
                           ->get("preciosespecialesproducto precesp")
                           ->result();
        return  $query;          
    }


}