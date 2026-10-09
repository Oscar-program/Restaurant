<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class  Establecimiento_Model  extends CI_Model{
    public function listaEstablecimientos() {
   
            $query =  $this->db->select("estb.*, emp.empNombre as empresa") 
                   ->join('empresa emp ','emp.empresaID =  estb.empresa_origen','inner')  
                    ->where("estb.estStatus", 1)
                    ->get(" nuevoestablo.establecimientoempresa estb")
                    ->result();
            return  $query;          
    }
    public function insertarEstablecimiento($establecimientoID, $data){
        if($establecimientoID ==   NULL){
            $this->db->insert("establecimientoempresa",$data);
            return $this->db->insert_id();
        }else{           
            $this->db->set("estNombre",   $data["estNombre"])
                    ->set("estDireccion", $data["estDireccion"])
                    ->set("estTelefono",  $data["estTelefono"])  
                    ->set("empresa_origen",  $data["empresa_origen"])                   
                   
                    ->where("establecimientoID", $establecimientoID)
                    
                    ->update("establecimientoempresa");
            return $this->db->affected_rows();   

       }  
    }

     // funcion para cargar la empresa que  se  quiere  modificar  
    public function get_EstablecimientoPorID($establecimientoID) {
        $query =  $this->db->select("*")   
                           ->where("establecimientoID",$establecimientoID)         
                           ->get("establecimientoempresa")
                           ->result();
        return  $query;          
    }

    /*Funcion para eliminar  una medida de  producto */
    public function deleteEstablecimiento($establecimientoID) {
        $this->db->set("estStatus", 0)
                ->where("establecimientoID", $establecimientoID)
               ->update("establecimientoempresa");
            return $this->db->affected_rows();
    }




}