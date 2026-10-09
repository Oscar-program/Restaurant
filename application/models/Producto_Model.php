<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class Producto_Model extends CI_Model {

  // funcion para  crear  un  nuevo producto 
  public function  addProducto($data, $productoID){
     
    if($productoID ==   NULL){
    //    echo  'Ingresando Producto' . $productoID;
        $this->db->insert("producto",$data);
        return $this->db->insert_id();
    }else{
      //  echo  'Actualizando Producto';
      // ->set("prodClasfInvent",  $data["prodClasfInvent"])
        $this->db->set("prodDescripcion", $data["prodDescripcion"])
                ->set("famProdID",        $data["famProdID"])
                ->set("presProdID",       $data["presProdID"])                     
                ->set("tipProdID",        $data["tipProdID"])                    
                ->set("marcProdID",       $data["marcProdID"])
                ->set("medProdID",        $data["medProdID"])
                ->set("proveedorID",      $data["proveedorID"])                
                ->set("tipomovinvtId",    $data["tipomovinvtId"]) 
                ->set("prodctucocina",    $data["prodctucocina"])                 
                ->where("productoID",     $productoID)
                ->where("prodStatus",  1 )
                ->update("producto");
        return $this->db->affected_rows();   
        
    }

}

    // funcion para cargar las  categorias de los  productos  
    public function get_producto() {
        $query =  $this->db->select("*")   
                 ->get("familiaproducto")
                 ->result();
        return  $query;          
    }

    /*Funcion para cargar los submenu de los productos
      $areaEstablecimientoID = area  de la  mesa , el  precio  que  se  muestra  es  el  del  area  ( si  no  tiene , se  usa  el  precio  base )
      $soloCocina            = 1  muestra  unicamente  los  productos  marcados  como  prodctucocina = 1 */
    public function get_submenu($famProdID, $areaEstablecimientoID = 0, $soloCocina = 0) {
       // echo 'llegado al  modelo';
        $area = intval($areaEstablecimientoID);
        //  si  todavia  no  se  ha  creado  la  tabla  de  precios  por  area  se  trabaja  con  el  precio  base
        $hayPrecioArea = $this->db->table_exists('precioproductoarea');
        $selPrecio     = ($hayPrecioArea)
                         ? "COALESCE(prcarea.precioventa, prec.precioventa) as precioventa"
                         : "prec.precioventa" ;

        $this->db->select("prod.*, ".$selPrecio.", sum(inv.existenciaInvProd) existencia")
                 ->join('precioproducto prec', 'prec.productoID = prod.productoID', 'inner')
                 ->join('inventarioproducto inv', 'inv.productoID = prod.productoID', 'inner');
        if($hayPrecioArea){
            $this->db->join('precioproductoarea prcarea',
                        'prcarea.productoID = prod.productoID and prcarea.areaEstablecimientoID = '.$area.' and prcarea.precioAreaStatus = 1',
                        'left', FALSE);
        }
        $this->db->where('prod.famProdID',$famProdID)
                 ->where('prod.prodStatus',1)
                 
                 ->where('prcarea.precioventa > 0')
                 ->where('prec.proddisponible',1);
                  


        //  filtro para mostrar solo los productos  de cocina
        if($soloCocina == 1){
            $this->db->where('prod.prodctucocina', 1);
        }
        $query =  $this->db->group_by('prod.productoID')

                 ->get("producto prod")
                 ->result();
        return  $query;
    }
    public function get_listaProductos() {
        $query =  $this->db->select("prod.productoID, prod.prodDescripcion, prod.presentacion_invId, fam.famProdDescripcion, pres.presProdDescripcion,
                                     tipPro.tipProdNombre,  marc.marcProdDescripcion, med.medProdDescripcion ,prov.provDescripcion"
                                    )
                 ->join('familiaproducto fam ', 'prod.famProdID =    fam.famProdID', 'inner') 
                 ->join('presentacionproducto pres', ' pres.presProdID  = prod.presProdID', 'inner') 
                 ->join('tipoproducto tipPro', 'tipPro.tipProdID  = prod.tipProdID', 'inner') 
                 ->join('marcaproducto marc', ' marc.marcProdID  = prod.marcProdID', 'inner') 
                 ->join('medidaproducto med', 'med.medProdID  = prod.medProdID', 'inner') 
                 ->join('proveedores prov', 'prov.proveedorID  = prod.proveedorID', 'inner') 
                 ->order_by("prod.productoID")

                  ->where('prod.prodStatus',1)
               
                 ->get("producto prod")
                 ->result();
        return  $query;          
    }
    /*Funcion para obtener el producto  por id esto servira para editarlo o cuando se  busca uno en especifico */

    public function get_productoID($productoID) {
        $query =  $this->db->select("prod.*")
                 ->where('prod.productoID',$productoID)
               
                 ->get("producto prod")
                 ->row();
        return  $query;          
    }

    /*funcion para obtener lista general de productos */

    /*Funcion para obtner los tipos de comandas*/
    public function get_comandas() {
        $query =  $this->db->select("*") 
               
                 ->get("comandapedidoproducto")
                 ->result();
        return  $query;          
    }

   //  mostramos la lista  de  turnos existentes para  usar  en los  precis especiales  
   public function get_turnooperacion() {
    $query =  $this->db->select("*") 
           
             ->get("turnooperacion")
             ->result();
    return  $query;          
}
//  funcion  para carga la lista de productos existentes  
public function get_ListProducto() {
    $query =  $this->db->select("prod.*")   
             ->get("producto prod")
             ->result();
    return  $query;          
} 
// fucion para mostrar la lista de productos a  trasladar  
public function get_ListProductoTrasladar(){
    $query =  $this->db->select("max(k.kardexProdID) as idactualizar,  k.bodegaProductoID,  k.productoID, bod.bodProdDescripcion, 
                                 upper(p.prodDescripcion) as prodDescripcion, sum(k.entrada -  k.salida) as  existencia"
                                ) 
            ->join('producto  p','k.productoID =  p.productoID','inner')  
            ->join('bodegaproducto bod','k.bodegaProductoID =   bod.bodegaProductoID','inner') 
            ->where('p.famProdID',1)
            ->group_by('k.productoID') 
            ->group_by('bod.bodegaProductoID')                    
            ->get("kardexproducto k")
            ->result();
    return  $query;          
}
//  funcio  retona la  informacion del producto (Producto/servicio) - (gravado, excento,  no sujeto) 
 public function get_InfoProducto($productoID){
    $query =  $this->db->select("productoID,  tipomovinvtId,  presentacion_invId") 
            ->where("productoID", $productoID)                                
            ->get("producto")
            ->row();
    return  $query;

 }

 // funcion para eliminar  un  producto 
  public function  deleteProducto( $productoID){
        $this->db->set("prodStatus", 0)
                             
                ->where("productoID",     $productoID)
                //->where("prodStatus",  0 )
                ->update("producto");
        return $this->db->affected_rows();   
        
    

}




}

