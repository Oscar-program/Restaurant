<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class inventProducto_Model extends CI_Model{
 //   funcion que  identifica  si el  producto ya se  encuentra registrado en la  bodega que se esta  asignando 
       
             
 

 public function get_productoIDInventarios($productoID,$bodegaProductoID) {
    $query =  $this->db->select("invProdID,productoID
                                bodegaProductoID,
                                coalesce(inicialInvProd,0) as inicialInvProd ,
                                coalesce(entradaInvProd,0) as entradaInvProd, 
                                coalesce(salidaInvProd,0)  as salidaInvProd,
                                coalesce(existenciaInvProd,0) as existenciaInvProd")
             ->where('prodinvent.productoID',$productoID)
             ->where('prodinvent.empresaID',$_SESSION["empresaID"])
             ->where('prodinvent.establecimientoID',$_SESSION["establecimientoID"])

             ->get("inventarioproducto prodinvent")
             ->row();
    return  $query;          
  }
//  funcion para  insertar el  producto en la tabla de inventarios, para que este disponible para agrgar existencias  
    public function  addProductoInvent($data, $invProdID){
        if($invProdID ==   NULL){
          //  echo  'INSERTANDO EN EL   INVENTARIO';
            $this->db->insert("inventarioproducto",$data);
            return $this->db->insert_id();
        }else{
          //  echo  'ACTUALIZANDO EN EL   INVENTARIO';
            $this->db->set("entradaInvProd", $data["entradaInvProd"])
                      ->set("salidaInvProd", $data["salidaInvProd"])              
                ->where("productoID", $data["productoID"] )
                ->where('empresaID',$_SESSION["empresaID"])
                ->where('establecimientoID',$_SESSION["establecimientoID"])

               ->where("bodegaProductoID", $data["bodegaProductoID"])        
                ->update("inventarioproducto");
            return $this->db->affected_rows();
        }
    } 
   //  funcion para actualizar  las existencia en   los   inventarios 
   public function  updateProductoInvent($data, $productoID,$bodegaProductoID){    
        $this->db->set("existenciaInvProd", $data["existenciaInvProd"])            
        ->where("productoID", $productoID)
        ->where("bodegaProductoID", $bodegaProductoID)   
        ->where('empresaID',$_SESSION["empresaID"])
        ->where('establecimientoID',$_SESSION["establecimientoID"])

        ->update("inventarioproducto");
     return $this->db->affected_rows();
     

   
    } 

    // funcion para  identificar la existncia de producto en bodega selaccionada  
    public function  chekStockProduct($productoID,$bodegaProductoID){    
        $query =  $this->db->select("invent.existenciaInvProd as  existencia")
             ->where('invent.productoID',$productoID)
             ->where('invent.bodegaProductoID',$bodegaProductoID)
             ->where('empresaID',$_SESSION["empresaID"])
             ->where('establecimientoID',$_SESSION["establecimientoID"])

             ->get("inventarioproducto invent")
             ->row();
    return  $query;      
     

   
    } 
    //   consulta  para   obtner  el  indicador de  existencia de productos  

    public function  indicadorExistenciaProd(){    
        $query =  $this->db->select(" inv.productoID,  prod.prodDescripcion, bodp.bodProdDescripcion, inv.existenciaInvProd")
          ->join("producto prod", "prod.productoID = inv.productoID", "inner")
          ->join("bodegaproducto bodp", "bodp.bodegaProductoID  =   inv.bodegaProductoID", "inner")  
          ->where('inv.empresaID',$_SESSION["empresaID"])
          ->where('inv.establecimientoID',$_SESSION["establecimientoID"])
   
          ->get("inventarioproducto  inv")
          ->result();
        return  $query;      
     

   
    } 



}