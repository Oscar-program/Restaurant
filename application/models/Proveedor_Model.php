<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class Proveedor_Model extends CI_Model {
  
    // funcion para cargar las  categorias de los  productos  
    public function get_listaProveedores() {
        $query =  $this->db->select("prov.proveedorID,  prov.provDescripcion,
                                    prov.provContacto,  prov.emailProv, prov.provTelefono,   clasf.clasificacion, tipc.tipoContribuyente,
                                    clasf.clasfiscalID,  tipc.tipoContribID") 
                  ->join("clasificacion_fiscal clasf", "clasf.clasfiscalID =  prov.clasfiscalID","inner")
                  ->join("tipo_contribuyente tipc", "tipc.tipoContribID =  prov.tipoContribID","inner") 
                   ->where("prov.provStatus",  1 )
                 ->get("proveedores  prov")
                 ->result();
        return  $query;          
    }


     

    // funcion que retorna  la informacion general del proveedor , (Gran contribiyente, mediano y otros) (Gravados-excento-no sujetos)  
    public function  get_infoProveedor($proveedorID){
        $query =  $this->db->select("prov.proveedorID,  prov.provDescripcion,
         prov.provContacto,  prov.emailProv, prov.provTelefono,   clasf.clasificacion, tipc.tipoContribuyente,
          clasf.clasfiscalID,  tipc.tipoContribID") 
                        ->join("clasificacion_fiscal clasf", "clasf.clasfiscalID =  prov.clasfiscalID","inner")
                        ->join("tipo_contribuyente tipc", "tipc.tipoContribID =  prov.tipoContribID","inner") 
                        ->where("proveedorID", $proveedorID)
                        ->get("proveedores prov")
                        ->row();
        return  $query;

    }

    // funcion par agregar los proveedore  
   
  public function  addProveedor($data, $proveedorID){
     
    if($proveedorID ==   NULL){
       echo  'Ingresando Producto' . $proveedorID;
        $this->db->insert("proveedores",$data);
        return $this->db->insert_id();
    }else{
        echo  'Actualizando Producto';
      // ->set("prodClasfInvent",  $data["prodClasfInvent"])
        $this->db->set("clasfiscalID",   $data["clasfiscalID"])
                ->set("tipoContribID",   $data["tipoContribID"])
                ->set("provDescripcion", $data["provDescripcion"])                     
                ->set("provContacto",    $data["provContacto"])                    
                ->set("emailProv",       $data["emailProv"])
                ->set("provTelefono",    $data["provTelefono"])                             
                ->where("proveedorID",   $proveedorID)
                ->where("provStatus",  1 )
                ->update("proveedores");
        return $this->db->affected_rows();   
        
    }

}
//  funcio para obtener los datos de un proveedor  
 public function get_proveedorID($proveedorID) {
        $query =  $this->db->select("prov.*")
                 ->where('prov.proveedorID',$productoID)               
                 ->get("proveedores prov")
                 ->row();
        return  $query;          
    }



// funcion para eliminar  un proveedor
 
  public function  deleteProveedor( $proveedorID){
        $this->db->set("provStatus", 0)                             
                ->where("proveedorID",     $proveedorID)
                //->where("prodStatus",  0 )
                ->update("proveedores");
        return $this->db->affected_rows();   
        
    

}
//  funciones adicionales para cargar el tipo de clasificacion fiscal y el tipo de contribuyente

public function Listaclasificacionfiscal(){
    $query =  $this->db->select("clasf.*")                                
                 ->get("clasificacion_fiscal clasf")
                 ->result();
        return  $query;   
}

public function Listatipocontribuyente(){
     $query =  $this->db->select("tipc.*")                                
                 ->get("tipo_contribuyente tipc")
                 ->result();
        return  $query;   
}





    


}