<?php
defined('BASEPATH') or exit('No direct script access allowed');
class InvDiario_Model extends CI_Model {


//  funcion  para carga la lista de productos existentes
public function get_ListProducto() {
    $query =  $this->db->select("*")
             ->get("producto")
             ->result();
    return  $query;
}

public function  InsertInvDiario($data){

	$qry = $this->db->select('Id')->from('inventariodiario')
	->where('Fecha', $data["Fecha"])
	->where('IdProducto', $data["IdProducto"])
	->where('TipoMov', $data["TipoMov"])
	->get();

	if ($qry->num_rows() == 0)
	{
		$this->db->insert("inventariodiario",$data);
		return $this->db->insert_id();
	}
	else
	{
		
	}
       
}

public function  BuscarInvDiario($FechaB,$TipoMov,$Producto){

	$query = $this->db->select('*')
	->where('Fecha', $FechaB)
	->where('TipoMov', $TipoMov)
	->where('IdProducto', $Producto)
	->get("inventariodiario")
	->result();
	
	return  $query;
}

public function  GetlistaInvdiarios(){

	$query = $this->db->select('*')
	->get("inventariodiario")
	->result();
	
	return  $query;
}

}
