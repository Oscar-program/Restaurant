<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class  preciosProducto_Model extends CI_Model{

    //  $famProdID = 0  trae  todas  las  familias , cualquier  otro  valor  filtra  por  esa  familia
    public function lista_productoCostear($famProdID = 0) {
        $this->db->select("precprod.productoID, upper(prod.prodDescripcion)  as  prodDescripcion, sum(invprod.existenciaInvProd)  as  existencia, precprod.precioventa, precprod.proddisponible, prod.famProdID ")
                  ->join("producto prod", "precprod.productoID  = prod.productoID","inner")
                  ->join("inventarioproducto invprod", "invprod.productoID  =  prod.productoID","inner")
                ->where('prod.prodStatus',1);
        if($famProdID > 0){
            $this->db->where('prod.famProdID', $famProdID);
        }
        $query =  $this->db->group_by("prod.productoID")
                    //->where('prodprec.productoID',$productoID)
                 ->order_by("prod.prodDescripcion", "ASC")
                 ->get("precioproducto precprod")
                 ->result();
        return  $query;
    }
    // funcio  que  identifica si e producto ya se encuentra  registrado en los  productos para asignar el precio  
    public function get_productoIDPrecios($productoID) {
        $query =  $this->db->select("prodprec.*")
                 ->where('prodprec.productoID',$productoID)
               
                 ->get("precioproducto prodprec")
                 ->row();
        return  $query;          
    }

    // funcion para insertar el productos en la lista de  productos para  asignar el precio      
     public function  addProductoPrec($data, $precProdID){
        if($precProdID ==   NULL){
            $this->db->insert("precioproducto",$data);
            return $this->db->insert_id();
        }
    } 
    //  funcion que  actualiza  UNICAMENTE  la  marca  de  disponible  del  producto.
    //  Se  usa  desde  la  pantalla  de  precios  por  area :  alli  el  precio  de  venta
    //  vive  en  precioproductoarea , por  eso  esta  funcion  NO  debe  tocar  precioventa
    //  ( updateProductoPrec  lo  dejaba  en  0  cuando  la  caja  de  texto  llegaba  vacia ).
    public function  updateDisponibleProducto($productoID, $proddisponible){
        $this->db->set("proddisponible", $proddisponible)
                 ->where("productoID", $productoID)
                 ->where("precioProdStatus",  1)
                 ->update("precioproducto");
        return $this->db->affected_rows();


        /*$this->db->set("precioventa",     $data["precioventa"])
                     ->set("proddisponible",  $data["proddisponible"])
                     ->set("fechactualizado", $data["fechactualizado"])
                     ->set("usuarioID",       $data["usuarioID"])
                     ->where("precioAreaID",  $precioAreaID)
                     ->where("precioAreaStatus",  1)
                     ->update("precioproductoarea");
            return $this->db->affected_rows();*/

    }

    //  funcion para actualizar el  precio de costo y precio de  venta fechactualizado
    public function  updateProductoPrec($data, $productoID){
        // Precio costo se registra cuando se ingresa compra de productos y se pone el del  comprobante del proveedor  

        if( $data["preciocosto"]>0){
            $this->db->set("preciocosto", $data["preciocosto"]) 
                      ->set("proddisponible", $data["proddisponible"])           
            ->where("productoID", $productoID)
            ->where("precioProdStatus",  1)
            ->update("precioproducto");
         return $this->db->affected_rows();

        }else if ($data["precioventa"]>0){
            $this->db->set("precioventa", $data["precioventa"]) 
                     ->set("fechactualizado", $data["fechactualizado"])
                     ->set("proddisponible", $data["proddisponible"])               
            ->where("productoID", $productoID)
            ->where("precioProdStatus",  1)
            ->update("precioproducto");
             return $this->db->affected_rows();
        }else{
              $this->db->set("precioventa", $data["precioventa"]) 
                     ->set("fechactualizado", $data["fechactualizado"])
                     ->set("proddisponible", $data["proddisponible"])               
            ->where("productoID", $productoID)
            ->where("precioProdStatus",  1)
            ->update("precioproducto");
             return $this->db->affected_rows();
        }  

       
    } 



}