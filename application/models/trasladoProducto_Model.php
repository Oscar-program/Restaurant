<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class trasladoProducto_Model extends CI_Model {

    // funcion para  ingresar los traslados  
     public function insertarTraslado($data, $trasProdID){
        if($trasProdID== null){
            $this->db->insert('trasladoproductobodega',$data);
            return  $this->db->insert_id();
        }else{
               $this->db->set('$data', $data['productoID'])
                     ->where('trasProdID', $trasProdID)
                     ->update('trasladoproductobodega');
                 return  $this->db->affected_rows();      

        }       

     }

  
    // funcion para cargar las  categorias de los  productos  
    public function ListarTrasladoProducto(){
        $query =  $this->db->select("k.transaccionID,  k.movtipo, k.kardfecha_transac, k.productoID, 
                                     prod.prodDescripcion,
                                     bod.bodProdDescripcion, k.entrada, k.salida,  k.precio_unit")   
                 ->join('bodegaproducto bod','k.bodegaProductoID  =  bod.bodegaProductoID','inner')
                 ->join('producto prod','k.productoID = prod.productoID','inner')
                 ->where("k.movtipo", "TRASL") 
                 ->get("kardexproducto k")
                 ->result();
        return  $query;          
    }
    //funcion que identifica que una abodega ya tiene   salida de  producto, sumar las demas salidas  acumuladas en el  dia hacia otras bodegas
    public function findSalidaProdXBod($bod, $fecha,$productoID){
        $query =  $this->db->select("k.kardexProdID,  k.salida subtotal, k.impuesto, k.total")   
                 //->join('bodegaproducto bod','k.bodegaProductoID  =  bod.bodegaProductoID','inner')
                 //->join('producto prod','k.productoID = prod.productoID','inner')
                 ->where("k.movtipo", "TRASL") 
                 ->where("k.bodegaProductoID", $bod) 
                 ->where("k.kardfecha_transac", $fecha)
                 ->where("k.productoID", $productoID)                 
                 ->where("k.salida>", 0)

                 ->row("kardexproducto k")
                 ->result();
        return  $query;          
    }  

    
}