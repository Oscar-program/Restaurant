<?php  
class Turnos_Model extends CI_Model{
    public function  get_listaTurnos(){
       $query  = $this->db->select("*")
                 ->get("turnooperacion") 
                 ->result();
       return  $query ;         

    }

}
?>