<?php  
class Config_Model extends CI_Model{
    // funcion que  retorna el tipo de movimiento en el inventario del producto 
    public function  get_listTipoMovInvnt(){
        $query =  $this->db->select("*")
                           ->get("tipomovinvt")
                           ->result();
        return $query;

    }

    // funcion que retorna la presentacion del producto , si este se trata de producto o servicio  
    public function  get_listPresentacion_inv(){
        $query =  $this->db->select("*")
                           ->get("presentacion_inv")
                           ->result();
        return $query;

    }
    //  funcion que  retorna  la informacion que se agreagra al proveedor cliente si  este gravado, excento o tasa cero  

     // funcion que retorna la presentacion del producto , si este se trata de producto o servicio  
     public function  get_listTipo_contribuyente(){
        $query =  $this->db->select("*")
                           ->get("tipo_contribuyente")
                           ->result();
        return $query;

    }



}