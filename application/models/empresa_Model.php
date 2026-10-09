<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class  empresa_Model  extends CI_Model{
    public function get_datoEmpresa() {
       $query =  $this->db->select("emp.*") 
            ->get("empresa emp")
            ->row();
       return  $query;          
    }
      public function listaEmpresas() {
       $query =  $this->db->select("emp.*") 
            ->get("empresa emp")
            ->result();
       return  $query;          
    }

    // funcion para  insetar una empresa  
    public function insertarEmpresa($empresaID, $data){
        if($empresaID ==   NULL){
            $this->db->insert("empresa",$data);
            return $this->db->insert_id();
        }else{           
            $this->db->set("empNombre",  $data["empNombre"])
                    ->set("empGiro",     $data["empGiro"])
                    ->set("empNit",      $data["empNit"])                     
                    ->set("empTelefono", $data["empTelefono"])
                    ->where("empresaID", $empresaID)
                    
                    ->update("empresa");
            return $this->db->affected_rows();   

       }  
    }

     // funcion para cargar la empresa que  se  quiere  modificar  
    public function get_EmpresaPorID($empresaID) {
        $query =  $this->db->select("*")   
                           ->where("empresaID",$empresaID)         
                           ->get("empresa")
                           ->result();
        return  $query;          
    }

    /*Funcion para eliminar  una medida de  producto */
    public function delete_EmpresaPorID($empresaID) {
        $this->db->where("empresaID",$empresaID)         
                 ->delete("empresa");                 
        return  $this->db->affected_rows();          
    }
}