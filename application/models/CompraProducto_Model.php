<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class  CompraProducto_Model  extends CI_Model{

    
   
     public function get_ListComprasFiltrada($fechaInicial, $fechaFinal){
       // echo     $fechaInicial . "   " .  $fechaFinal ;
        if(strlen($fechaInicial)>0 && strlen($fechaFinal)>0){
           // echo  'filtrando en el modelo  por la compra ';
            $this->db->where("date_format(cmp.compProdFecha, '%Y-%m-%d')>=",$fechaInicial);
            $this->db->where("date_format(cmp.compProdFecha, '%Y-%m-%d')<=",$fechaFinal);

        }else{
           // echo  'MOSTRANDO GENERALES DE LA  compra ';
             $this->db->where("cmp.compProdFecha>= DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH) and cmp.compProdFecha<=CURRENT_DATE()");
        }
         $query =  $this->db->select("cmp.compraProdID, date_format(cmp.compProdFecha, '%d-%m-%Y') as fecha , prov.provDescripcion,
                                        (case
                                        when  cmp.comprobanteTipo = 1  then   'CCF'
                                        when  cmp.comprobanteTipo = 2  then   'FC' 
                                        when  cmp.comprobanteTipo = 3  then   'FEX' 
                                        else ''	
                                        end ) comprobanteTipo,
                                        cmp.comprobantenum , usr.usrNombre,
                                     cmp.compProdNoSujeto ,cmp.compProdIva, cmp.compProdTotal"
                                    )   
                        ->join('proveedores prov', 'cmp.proveedorID  =  prov.proveedorID', 'inner')
                        ->join('usuario usr', 'cmp.usuarioID =   usr.usuarioID', 'inner')  
                         ->where("cmp.compProdStatus",1)
                       ->order_by('cmp.compProdFecha', 'DESC')
                       ->get("compraproducto as  cmp")
                       ->result();
        return  $query;  

     }


    //   funcion para  insertar la  cabecera de las compras 
    public function  addCabeceracompra($data, $compraProdID){
     
       //->where('empresaID',$_SESSION["empresaID"])
        //->where('establecimientoID',$_SESSION["establecimientoID"])
        if($compraProdID ==   NULL){
            //echo  'Agregando la  cabecera de la  compra' . $compraProdID;
            $this->db->insert("compraproducto",$data);
            return $this->db->insert_id();
        }else{
           // echo  'para  actualizar Cabecera de la compra';
            $this->db->set("empresaID",        $_SESSION["empresaID"])
                    ->set("establecimientoID", $_SESSION["establecimientoID"])
                    ->set("proveedorID",       $data["proveedorID"])                     
                    ->set("comprobanteTipo",   $data["comprobanteTipo"])                    
                    ->set("comprobantenum",    $data["comprobantenum"])
                    ->set("usuarioID",         $_SESSION["usuarioID"])
                    ->set("compProdNoSujeto",  $data["compProdNoSujeto"])
                    ->set("compProdGravado",   $data["compProdGravado"]) 
                    ->set("compProdIva",       $data["compProdIva"])
                    ->set("compProdExcento",   $data["compProdExcento"])  
                    ->set("compProdTotal",     $data["compProdTotal"]) 
                    ->where("compraProdID",    $compraProdID)
                    
                    ->update("compraproducto");
            return $this->db->affected_rows();   
            
        }

    }
    //  Creando el detalle de la  compra  
    public function  adddetcompra($data, $detCompraId){
      
        if($detCompraId==   NULL){
           // echo  'Insertando el  item del  detalle de la compra ' . $detCompraId;
            $this->db->insert("compra_det_producto",$data);
            return $this->db->insert_id();
        }else{
           // echo  'para  actualizar';
            $this->db->set("cantidad",     $data["cantidad"])
                    ->set("precUnit",      $data["precUnit"])
                    ->set("sub_total",     $data["sub_total"])                     
                    ->set("impuesto",      $data["impuesto"])
                    ->set("total",         $data["total"])
                    ->where("detCompraId", $detCompraId)
                    
                    ->update("compra_det_producto");
            return $this->db->affected_rows();   
            
                }

    }
      // Creando el movimiento de producto en el kardex 
     
      public function  addMoVKardex($data, $kardexProdID){      
        if($kardexProdID ==   NULL){
           // echo  'Insertando el  item del  KARDEX' . $kardexProdID;
            $this->db->insert("kardexproducto",$data);
            return $this->db->insert_id();
        }else{
            echo  'Actualizanod El Kardex';  
            $this->db->set("movtipo",         $data["movtipo"])
                    ->set("bodegaProductoID", $data["bodegaProductoID"])
                    ->set("productoID",       $data["productoID"])                     
                    ->set("entrada",          $data["entrada"])
                    ->set("precio_unit",      $data["precio_unit"])
                    ->set("subtotal",         $data["subtotal"])
                    ->set("impuesto",         $data["impuesto"])
                    ->set("total",             $data["total"])                   
                    ->where("kardexProdID", $kardexProdID)
                    
                    ->update("kardexproducto");
            return $this->db->affected_rows();   
            
                }

    }



    # segmento para controlar los  movimiento en la tabla tempora de detalle de compra  
        /*funcion para insertar   datos en la tabla temporal*/
        public function  addtmpdetcompra($data, $idtmp){
           // echo  'el valor temp es ' . $idtmp;
            if($idtmp ==   null){
                $this->db->insert("compra_det_producto",$data);
                return $this->db->insert_id();
            }else{
                echo  'para  actualizar';
                $this->db->set("cantidad", $data["cantidad"])
                        ->set("precUnit", $data["precUnit"])
                        ->set("sub_total", $data["sub_total"])                     
                        ->set("impuesto", $data["impuesto"])
                        ->set("total",    $data["total"])
                        ->where("idtmp", $idtmp)
                        
                        ->update("compra_det_producto");
                return $this->db->affected_rows();   
                
                    }

        }
        // funcion para mostrar los productos  registrados de  forma temporal en las compras
        public function get_ListTmp($idCompra) {
               // echo  'el id de  compra es '.  $idCompra;
            $query =  $this->db->select("detcomp.detCompraId,detcomp.compraProdID,detcomp.productoID, prod.prodDescripcion, 
                                         detcomp.cantidad,detcomp.precUnit,detcomp.impuesto, detcomp.sub_total, detcomp.total"
                                     )
                    ->join('producto prod','prod.productoID =  detcomp.productoID','inner')
                    ->where("detcomp.compraProdID", $idCompra)
                    ->get("compra_det_producto detcomp")
                    ->result();
            return  $query;          
        }  

         //  funcion para calcular el total del comprobante de  compra 
        public function get_sumastotaltmp($idCompra) {       
            $query =  $this->db->select("tmp.compraProdID, 
                                        sum(case  
                                        WHEN prod.tipomovinvtId = 1    then   tmp.sub_total  else  0   
                                        end) as gravado ,
                                        sum(case  
                                        WHEN prod.tipomovinvtId = 2   then   tmp.sub_total  else  0   
                                        end) as excento ,
                                        sum(case  
                                        WHEN prod.tipomovinvtId = 3   then   tmp.sub_total  else  0   
                                        end) as nosujeto ,
                                        sum(tmp.impuesto) as  impuestos, sum(tmp.total) as  totalcompra"
                                        ) 
                     ->join("producto prod", "prod.productoID = tmp.productoID", "inner")                      
                    ->where("tmp.compraProdID", $idCompra)
                    ->group_by("tmp.compraProdID")
                    ->get("compra_det_producto tmp")
                    ->row();
            return  $query;          
        } 
        
        // funcion para poner anulada la compra 

        public  function del_compras($compraProdID){
            //echo  'llegando a la anulacion' . $compraProdID . " ";
              $this->db->set("compProdStatus", 0)
                        ->where("compraProdID",$compraProdID)         
                        ->update("compraproducto");                 
        return  $this->db->affected_rows();   

        }

    # fin de segmento para controlar los  movimiento en la tabla tempora de detalle de compra   


}