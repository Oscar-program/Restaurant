  <?php 
  defined('BASEPATH') or exit('No direct script access allowed');
  class ordenesPedido_Model extends CI_Model{

    public function get_listBodegaProducto(){
        $query =  $this->db->select("bod.bodegaProductoID, bod.bodProdDescripcion , est.estNombre ")
                    ->join('establecimientoempresa  est',  'bod.establecimientoID   =  est.establecimientoID', 'inner')
                   
                 //->where("famProdStatus",  1)
                 ->get("bodegaproducto  bod")
                 ->result();
        return  $query;          
    }


    //funcion para insert nueva medida de  producto 
    public function  addOrdenPedido($data, $ordenPedidoID){
         //echo  "llamando a funcion  agregar orden pedido" ;
        if($ordenPedidoID ==   null){
          //  ECHO  "INSERTANDO UNA NUEVA ORDEN DE PEDIDO  \n" ;
            $this->db->insert("ordenpedido",$data);
            return $this->db->insert_id();
        }else{
         //   ECHO  "actualizando  UNA NUEVA ORDEN DE PEDIDO  \n" . $ordenPedidoID  ;
           



            $this->db->set("ordPcomentario", $data["ordPcomentario"])
                    ->set("ordPCantidadPrd", $data["ordPCantidadPrd"])
                    ->set("ordPtotalcancelar", $data["ordPtotalcancelar"])
                    ->set("ordPAbono",         $data["ordPAbono"])
                    ->set("ordPAcobrar",       ($data["ordPtotalcancelar"] - $data["ordPAbono"]))
                    //->set("ordPpenditeCobro", $data["ordPpenditeCobro"])
                    ->where("ordenPedidoID", $ordenPedidoID)
                    ->where("ordPanulado",  0)
                    ->update("ordenpedido");
            return $this->db->affected_rows();   
               
                }
    }
    // funcion para agregar el detalle de la orden  de pedido 
    public function  addDetOrdenPedido($data, $detPedID){
        if($detPedID ==   null){
           // echo   'llegando al   modelo para   insertar la orden de pedido';
            $this->db->insert("detordenpedido",$data);
            return $this->db->insert_id();
        }else{
            $this->db->set("detcantidad", $data["detcantidad"])
                    ->set("detprecioNormal",  $data["detprecioNormal"])
                    ->set("dettotal",  $data["dettotal"])
                    

                    ->where("detPedID", $detPedID)
                    ->where("detstatus",  1)
                    ->update("detordenpedido");
            return $this->db->affected_rows();   
               
                }
    }
    //   funcion para listar  el  detalle  de la orden de pedido del  cliente  
    public function get_listDetOrden($ordenPedidoID){
        //  echo  "la orden del pedido es  " . $ordenPedidoID ;
        $query =  $this->db->select("detOr.detPedID, detOr.ordenPedidoID, detOr.productoID, detOr.detprecioNormal, detOr.detcantidad, prod.prodDescripcion, detOr.dettotal, prod.famProdID, prod.prodctucocina, ordp.ordPcomentario")
                           ->join('producto prod',  'detOr.productoID =  prod.productoID', 'inner')        
                           ->join('ordenpedido ordp',  'detOr.ordenPedidoID =  ordp.ordenPedidoID', 'inner')
                ->where("detOr.ordenPedidoID",  $ordenPedidoID) 
                 ->where("ordp.ordPanulado",  0)
                ->where("detOr.detstatus",  1)
                ->get("detordenpedido detOr")
                ->result();
        return  $query;          
    }
    
    // funcion para  retornar la sumatoria del detalle de orde3n de producto 
    public function get_TotalDetOrden($ordenPedidoID){
        $query =  $this->db->select("sum(dettotal) as dettotal")
                //->join('producto prod',  'detOr.productoID =  prod.productoID', 'inner')
                ->where("detOr.ordenPedidoID",  $ordenPedidoID) 
                ->where("detOr.detstatus",  1)
                ->get("detordenpedido detOr")
                ->row();
        return  $query;          
    }

    // funcion que  muestra todas las  ordenes pendientes  de cobro 
    public function get_OrdenesPendientesCobro(){
        $query =  $this->db->select(" msa.mesNombre, ordp.ordenPedidoID, date_format(ordp.ordPFecha,  '%d-%m-%Y') as ordPFecha,   mesr.meserNombre,  ordp.ordPpenditeCobro ")
                ->join('usuario  u',  'ordp.usuarioID = u.usuarioID ', 'inner')
                ->join('mesa msa ',  'ordp.mesaID =  msa.mesaID', 'inner')
                //->where("ordp.mesaID",  $mesaID) 
                ->where("ordp.ordPpenditeCobro",  1)               
                ->where("ordp.ordPanulado",  0)
                ->get("ordenpedido ordp")
                ->result();
        return  $query;          
    }
    // funcion para  retornar los  datos con los  cuales  se  va  a emitir el  recibo  
    public function get_datosticket($ordenPedidoID){
        $query =  $this->db->select("msa.mesNombre,  u.usrNombre , detOr.detPedID, date_format( ord.ordPFecha,'%d-%m-%Y') as  ordPFecha,  detOr.ordenPedidoID, detOr.detcantidad, 
		prod.prodDescripcion, (detOr.detprecioNormal + detOr.detprecioEspecial)  preciounit, detOr.dettotal"
                                    )
                ->join('ordenpedido ord',  'detOr.ordenPedidoID =  ord.ordenPedidoID', 'inner')
                ->join('usuario u ',  'ord.usuarioID =  u.usuarioID', 'inner')
                ->join('mesa msa',  'ord.mesaID =  msa.mesaID', 'inner')
                ->join('producto prod',  'detOr.productoID =  prod.productoID', 'inner')                
                ->where("detOr.ordenPedidoID",  $ordenPedidoID)               
                ->where("detOr.detstatus",  1)
                ->get("detordenpedido detOr")
                ->result();
        return  $query;          
    }
    //  funcion para obtener los  totales de los  productos  de la  venta 
    public function get_TotalVenta($ordenPedidoID){
        $query =  $this->db->select("sum(detOr.detcantidad) as cantProd, sum(detOr.dettotal) as ventatotal")
                //->join('producto prod',  'detOr.productoID =  prod.productoID', 'inner')
                ->where("detOr.ordenPedidoID",  $ordenPedidoID) 
                ->where("detOr.detstatus",  1)
                ->get("detordenpedido detOr")
                ->row();
        return  $query;          
    
    }
    // funcion para  eliminar elemento del detalle de  la orden de pedido  
    public function deleteDetOrdenPedido($marcProdID) {
        $this->db->where("marcProdID",$marcProdID)         
                 ->delete("detordenpedido");                 
        return  $this->db->affected_rows();          
    }
    // funcion para  obtener  el detalla de la orden de pedido  
    public function get_DetOrden($detPedID){
        $query =  $this->db->select("detor.*, fam.famProdID, prod.prodDescripcion")
                 ->join("producto  prod", "prod.productoID =  detor.productoID", "inner")
                 ->join("familiaproducto fam", "fam.famProdID = prod.famProdID", "inner")
                ->where("detOr.detstatus",  1)
                ->where("detOr.detPedID",  $detPedID)
                ->get("detordenpedido detOr")
                ->row();
        return  $query;          
    }
    //  funcion para anular  la orden de pedido  
    public function  anularOrden($ordenID){
           //echo  "anulando la  orden de pedido " . $ordenID. "<br>" ;
               $this->db->set("ordPanulado", 1) 
                 ->where("ordenPedidoID", $ordenID)
                 ->update("ordenpedido");
        return $this->db->affected_rows();  

    }
   // funcion para eliminar el detalle de la venta 
   public function  anularDetOrden($detPedID){
     // echo  "eliminando la orden de pedido   \n";
               $this->db->where("detPedID", $detPedID)
                 ->delete("detordenpedido");
        return $this->db->affected_rows();  

   }
   // funcion para  mostrar el detalle de la orden pendiente de despacho  
  /*  public function  listaDetOrdenPendienteDespacho($ordenPedidoID){
         // echo  "llegando al  modelo  " . $ordenPedidoID ;

          // condicionamos  los datos a mostrar solo para cuado sea nivel usuario diferente de  1   mostrar  solo los productos de comedor 
           // -3 Boquitas,  4- platos,  10- tipicos
          // echo  "el nivel de usuario " . $_SESSION["nivelUsuaio"];
           if($_SESSION["nivelUsuaio"] = "2"){             
              $condicion  = "prod.famProdID = 3 or  prod.famProdID = 4 or   prod.famProdID  =  5";
              $this->db->where($condicion );
           }
            $this->db->distinct();
           $query =  $this->db->select(" prod.prodDescripcion , presen.presProdDescripcion as Presentacion,  pre.presentacionProd as tipo,  ped.detcantidad as catidad,  prod.famProdID")
                 ->join("producto prod", "prod.productoID =  ped.productoID", "inner")
                 ->join("presentacionproducto presen", "presen.presProdID = prod.presProdID", "inner")
                 ->join("nuevoestablo.presentacionprod pre", "pre.presProdID = prod.presProdID", "inner")
                 ->join("nuevoestablo.familiaproducto fam", "fam.famProdID = prod.famProdID", "left")
               
             

                ->where("ped.detstatus",  1)
                ->where("ped.ordenPedidoID",  $ordenPedidoID)
                ->get("detordenpedido ped")
                ->result();
        return  $query;     

   }*/

    public function listaOrdenesPendienteDespacho($mesaID){
           //  El  cocinero ( nivel 2 )  solo  ve  los  productos  que  pasan  por  cocina.
           //
           //  OJO :  antes  los  demas  niveles  agregaban  la  condicion  suelta
           //     "ped.despachar = 0 or ped.despachar = 1"
           //  Como  CI  une  los  where()  con  AND  y  el  OR  no  iba  entre  parentesis ,
           //  MySQL  la  interpretaba  como :
           //     ( mesaID = X AND ... AND despachar = 0 )  OR  ( despachar = 1 )
           //  La  segunda  rama  no  tenia  filtro  de  mesa , por  eso  la  pantalla
           //  mostraba  ordenes  ya  despachadas  de  TODAS  las  mesas.  Se  elimina.
        /* if($_SESSION["nivelUsuaio"] == "2"){
              $this->db->where("prod.prodctucocina", 1);
           }*/



        $this->db->distinct();
        $query = $this->db->select("ordenp.mesaID,msa.mesNombre as mesa,   ordenp.ordenPedidoID, ordenp.ordPFecha, HOUR( ordenp.ordPFecha)  as hora,
                                    MINUTE(ordenp.ordPFecha) as minuto,
                                    upper(trim(coalesce(usr.usrNombre,'SIN USUARIO'))) as usuario,
                                    date_format(ordenp.ordPFecha, '%h:%i %p') as horapedido,
                                    TIMESTAMPDIFF(SECOND, ordenp.ordPFecha, NOW()) as segundos_espera,
                                    upper(trim(ordenp.ordPcomentario)) as cliente, areEst.area,  ordenp.ordPpenditeDespacho, ordenp.ordPtotalcancelar,
                                    prod.prodDescripcion , presen.presProdDescripcion as Presentacion,  pre.presentacionProd as tipo,
                                    ped.detPedID ,ped.detcantidad as catidad,  prod.famProdID,  ped.dettotal, ped.cobrar,ped.despachar")
                      ->join('mesa as  msa',  ' msa.mesaID = ordenp.mesaID', 'inner')
                      ->join('areasestablecimiento areEst',  'areEst.areaEstablecimientoID =  msa.areaEstablecimientoID', 'inner')
                      ->join('usuario usr',  'usr.usuarioID = ordenp.usuarioID', 'left')
                      ->join('detordenpedido ped',  ' ped.ordenPedidoID =  ordenp.ordenPedidoID', 'inner')
                      ->join('producto prod',  'prod.productoID =  ped.productoID', 'inner')
                      ->join('presentacionproducto presen',  'presen.presProdID = prod.presProdID', 'inner')
                      ->join('presentacionprod pre',  'pre.presProdID = prod.presProdID', 'inner')
                      ->join('familiaproducto fam',  'fam.famProdID = prod.famProdID', 'inner')



                 ->where("ordenp.mesaID",  $mesaID)
                 ->where(" ped.despachar",  0)
                   ->where("ped.detstatus",  1)
                ->where("prod.prodctucocina", 1)
                   // ->where($this->condNoAnulada("ordenp"), NULL, FALSE)
                ->order_by("ordenp.ordPFecha", "DESC")
                 ->get("nuevoestablo.ordenpedido ordenp")
                 ->result();
        return  $query;

    }

    public function listaOrdenesPendienteCobro($mesaID){
   // echo  "mostrando los datos del  pedido" ;


        $this->db->distinct();
        $query = $this->db->select("ordenp.mesaID,msa.mesNombre as mesa,   ordenp.ordenPedidoID, ordenp.ordPFecha, HOUR( ordenp.ordPFecha)  as hora,
                                    MINUTE(ordenp.ordPFecha) as minuto,
                                    IF( LENGTH(ordenp.ordFechaVisto)> 0, CONCAT(
                                    TIMESTAMPDIFF( MINUTE, ordenp.ordPFecha,  ordenp.ordFechaVisto), 'MINUTOS TRASNCURRIDOS '), 'SIN ASIGNAR') AS minutos_transcurridos,
                                    upper(trim(coalesce(usr.usrNombre,'SIN USUARIO'))) as usuario,
                                    date_format(ordenp.ordPFecha, '%h:%i %p') as horapedido,
                                    TIMESTAMPDIFF(SECOND, ordenp.ordPFecha, NOW()) as segundos_espera,
                                    upper(trim(ordenp.ordPcomentario)) as cliente, areEst.area,  ordenp.ordPpenditeDespacho,  ordenp.ordPAbono, ordenp.ordPAcobrar  as  ordPtotalcancelar,
                                    prod.prodDescripcion , presen.presProdDescripcion as Presentacion,  pre.presentacionProd as tipo,
                                    ped.detPedID ,ped.detcantidad as catidad,  prod.famProdID,  ped.dettotal, ped.cobrar,ped.despachar")
                      ->join('mesa as  msa',  ' msa.mesaID = ordenp.mesaID', 'inner')
                      ->join('areasestablecimiento areEst',  'areEst.areaEstablecimientoID =  msa.areaEstablecimientoID', 'inner')
                      ->join('usuario usr',  'usr.usuarioID = ordenp.usuarioID', 'left')
                      ->join('detordenpedido ped',  ' ped.ordenPedidoID =  ordenp.ordenPedidoID', 'inner')
                      ->join('producto prod',  'prod.productoID =  ped.productoID', 'inner')
                      ->join('presentacionproducto presen',  'presen.presProdID = prod.presProdID', 'INNER')
                      ->join('presentacionprod pre',  'pre.presProdID = prod.presProdID', 'INNER')
                      ->join('familiaproducto fam',  'fam.famProdID = prod.famProdID', 'INNER')



                 ->where("ordenp.mesaID",  $mesaID)
                 ->where(" ordenp.ordPpenditeCobro",  1)
                   ->where("ped.detstatus",  1)
                ->order_by("ordenp.ordPFecha", "DESC")
                 ->get("nuevoestablo.ordenpedido ordenp")
                 ->result();
        return  $query;

    }

    // =====================================================================
    //  CONDICION  DE  ORDEN  NO  ANULADA
    //  addOrdenPedido()  nunca  escribe  ordPanulado  al  insertar  ( solo  anularOrden()  lo
    //  pone  en  1 ) ,  por  lo  que  el  campo  puede  quedar  en  NULL .  Un  filtro
    //  "ordPanulado = 0"  descarta  esas  filas  porque  NULL = 0  es  falso  en  SQL ,
    //  por  eso  la  condicion  se  escribe  siempre  aceptando  el  NULL.
    // =====================================================================
    private function condNoAnulada($alias = "ordenp"){
        return "(".$alias.".ordPanulado IS NULL OR ".$alias.".ordPanulado = 0)";
    }

    // =====================================================================
    //  ORDENES  ABIERTAS  ( NO  COBRADAS )  DE  UNA  MESA
    //  ordPpenditeCobro = 1  significa  que  la  orden  todavia  esta  pendiente  de  cobro ,
    //  cuando  se  procesa  el  cobro  ( procesarCobro ) el  campo  queda  en  0.
    // =====================================================================
    public function listaOrdenesAbiertasMesa($mesaID){
        $query = $this->db->select("ordenp.ordenPedidoID, ordenp.mesaID, msa.mesNombre as mesa, areEst.area,
                                    areEst.areaEstablecimientoID,
                                    ordenp.ordPFecha, date_format(ordenp.ordPFecha, '%h:%i %p') as horapedido,
                                    TIMESTAMPDIFF(SECOND, ordenp.ordPFecha, NOW()) as segundos_espera,
                                    upper(trim(coalesce(usr.usrNombre,'SIN USUARIO'))) as usuario,
                                    upper(trim(ordenp.ordPcomentario)) as cliente,
                                    ordenp.ordPpenditeCobro, ordenp.ordPpenditeDespacho,
                                    coalesce(ordenp.ordPAbono,0) as ordPAbono,
                                    coalesce(sum(ped.dettotal),0) as totalorden,
                                    coalesce(count(ped.detcantidad),0) as cantidadprod")
                      ->join('mesa as  msa',  'msa.mesaID = ordenp.mesaID', 'inner')
                      ->join('areasestablecimiento areEst',  'areEst.areaEstablecimientoID =  msa.areaEstablecimientoID', 'inner')
                      ->join('usuario usr',  'usr.usuarioID = ordenp.usuarioID', 'left')
                      ->join('detordenpedido ped',  'ped.ordenPedidoID =  ordenp.ordenPedidoID and ped.detstatus = 1', 'left', FALSE)
                 ->where("ordenp.mesaID",  $mesaID)
                 ->where("ordenp.ordPpenditeCobro",  1)
                 //->where("sum(ped.dettotal)>" 0)
                 ->group_by("ordenp.ordenPedidoID")
                 ->order_by("ordenp.ordPFecha", "DESC")
                 ->get("ordenpedido ordenp")
                 ->result();
        return  $query;
    }

    //  funcion que  valida  si  la  orden  todavia  se  puede  modificar ( no  cobrada  y  no  anulada )
    public function esOrdenAbierta($ordenPedidoID){
        $query = $this->db->select("ordenPedidoID")
                 ->where("ordenPedidoID",  $ordenPedidoID)
                 ->where("ordPpenditeCobro",  1)
                 ->where($this->condNoAnulada("ordenpedido"), NULL, FALSE)
                 ->get("ordenpedido")
                 ->row();
        return  (empty($query)) ? 0 : 1 ;
    }

    //  funcion que  detecta  si  la  orden  YA  fue  cobrada  o  anulada , en  ese  caso  no  se  le
    //  pueden  agregar  mas  productos .  Se  evalua  en  negativo  para  no  bloquear  ordenes
    //  recien  creadas  que  todavia  no  tengan  la  bandera  escrita .
    public function esOrdenCobradaOAnulada($ordenPedidoID){
        $query = $this->db->select("ordenPedidoID")
                 ->where("ordenPedidoID",  $ordenPedidoID)
                 ->group_start()
                    ->where("ordPpenditeCobro",  0)
                    ->or_where("ordPanulado",  1)
                 ->group_end()
                 ->get("ordenpedido")
                 ->row();
        return  (empty($query)) ? 0 : 1 ;
    }

    // =====================================================================
    //  SUMATORIA  DE  TODAS  LAS  ORDENES  DE  LA  MESA  ( pendientes  de  cobro )
    //  Se  resuelve  con  una  tabla  derivada  de  UNA  fila  por  orden :  si  se  sumaran
    //  los  campos  de  la  cabecera  ( ordPAbono / ordPAcobrar )  con  un  JOIN  directo  al
    //  detalle ,  cada  monto  se  repetiria  tantas  veces  como  lineas  tenga  la  orden
    //  y  el  total  saldria  inflado.
    //  Devuelve :
    //    ordenes      = cantidad  de  ordenes  abiertas  con  al  menos  un  producto
    //    cantidadprod = unidades  vendidas
    //    totalmesa    = suma  de  las  lineas  de  detalle  ( consumo  real  de  la  mesa )
    //    abonomesa    = suma  de  abonos  registrados
    //    acobrarmesa  = suma  del  " A cobrar "  que  muestra  cada  orden  en  la  lista
    //
    //  IMPORTANTE :  los  filtros  son  EXACTAMENTE  los  mismos  que  usa
    //  listaOrdenesPendienteCobro()  ( mesaID + ordPpenditeCobro = 1 + detstatus = 1 ) ,
    //  para  que  el  label  siempre  cuadre  con  las  ordenes  que  se  ven  en  pantalla.
    //  Si  se  quiere  descartar  las  anuladas  hay  que  agregar  en  AMBAS  consultas :
    //     AND (o.ordPanulado IS NULL OR o.ordPanulado = 0)
    //  ( se  escribe  aceptando  el  NULL  porque  addOrdenPedido()  no  inicializa  ese  campo )
    // =====================================================================
    public function totalMesaPendienteCobro($mesaID){
        $sql = "SELECT count(*)                            AS ordenes,
                       coalesce(sum(t.cantidadprod),0)     AS cantidadprod,
                       coalesce(sum(t.totaldetalle),0)     AS totalmesa,
                       coalesce(sum(t.abono),0)            AS abonomesa,
                       coalesce(sum(t.acobrar),0)          AS acobrarmesa
                  FROM (
                        SELECT o.ordenPedidoID,
                               coalesce(o.ordPAbono,0)   AS abono,
                               coalesce(o.ordPAcobrar,0) AS acobrar,
                               (SELECT coalesce(sum(d.detcantidad),0)
                                  FROM detordenpedido d
                                 WHERE d.ordenPedidoID = o.ordenPedidoID
                                   AND d.detstatus = 1)  AS cantidadprod,
                               (SELECT coalesce(sum(d.dettotal),0)
                                  FROM detordenpedido d
                                 WHERE d.ordenPedidoID = o.ordenPedidoID
                                   AND d.detstatus = 1)  AS totaldetalle
                          FROM ordenpedido o
                         WHERE o.mesaID = ?
                           AND o.ordPpenditeCobro = 1
                           AND EXISTS (SELECT 1 FROM detordenpedido d
                                        WHERE d.ordenPedidoID = o.ordenPedidoID
                                          AND d.detstatus = 1)
                       ) t";
        $query = $this->db->query($sql, array($mesaID))->row();
        return  $query;
    }

    // =====================================================================
    //  COBRAR  TODAS  LAS  ORDENES  DE  LA  MESA  DE  UNA  SOLA  VEZ
    //  Deja  la  cabecera  como :  ordPpenditeCobro = 0  y  ordPpenditeDespacho = 0
    //  unicamente  en  las  ordenes  NO  anuladas  de  la  mesa.
    //  La  condicion  de  anulado  se  escribe  aceptando  el  NULL  porque
    //  addOrdenPedido()  no  inicializa  ese  campo  al  crear  la  orden ;  con  un
    //  "ordPanulado = 0"  a  secas  el  UPDATE  no  afectaria  ninguna  fila.
    //  Devuelve  la  cantidad  de  ordenes  actualizadas.
    // =====================================================================
    public function cobrarTodaLaMesa($mesaID){
          $fechaHoraActual = date("Y-m-d H:i:s");
           
        //  1)  el  detalle  de  esas  ordenes  queda  marcado  como  procesado.
        //     Va  primero  porque  se  apoya  en  ordPpenditeCobro = 1 , que  el  paso  2  apaga.
        $sqlDetalle = "UPDATE detordenpedido d
                        INNER JOIN ordenpedido o ON o.ordenPedidoID = d.ordenPedidoID
                          SET d.procesado = 1
                        WHERE o.mesaID = ?
                          AND o.ordPpenditeCobro = 1
                          AND (o.ordPanulado IS NULL OR o.ordPanulado = 0)";
        $this->db->query($sqlDetalle, array($mesaID));

        //  2)  la  cabecera  queda  cobrada  y  despachada.
        //     Se  ajustan  tambien  los  montos  igual  que  procesarCobro() , para  que
        //     cobrar  toda  la  mesa  deje  los  mismos  datos  que  cobrar  orden  por  orden.
        $sqlCabecera = "UPDATE ordenpedido o
                           SET o.ordPpenditeCobro    = 0,
                               o.ordPpenditeDespacho = 0,
                               o.ordPAbono           = coalesce(o.ordPtotalcancelar,0),
                               o.ordPAcobrar         = 0,
                               o.usuarioIDliquida    = ?,
                               ordFechaliquida       = ?
                          WHERE o.mesaID = ?
                           AND o.ordPpenditeCobro = 1
                           AND (o.ordPanulado IS NULL OR o.ordPanulado = 0)";
        $this->db->query($sqlCabecera, array($_SESSION['usuario'],$fechaHoraActual,$mesaID ));

        return $this->db->affected_rows();
    }

    // =====================================================================
    //  FILTROS  COMPARTIDOS  DEL  REPORTE  DE  PRODUCTOS  VENDIDOS
    //  Se  centralizan  aqui  para  que  el  resumen , el  detalle  y  la  exportacion
    //  a  Excel  usen  EXACTAMENTE  los  mismos  criterios.
    //    $soloCocina :  ""  = todos ,  "1"  = solo  productos  de  cocina ,  "0"  = solo  los  que  no  son  de  cocina
    // =====================================================================
    private function filtrosProductosVendidos($fechaIni, $fechaFin, $areaEstablecimientoID, $usuarioID, $soloCocina){
        $this->db->where("ped.detstatus",  1)
                 ->where($this->condNoAnulada("ordenp"), NULL, FALSE);

        if(strlen($fechaIni) > 0){
            $this->db->where("date(ordenp.ordPFecha) >=", $fechaIni);
        }
        if(strlen($fechaFin) > 0){
            $this->db->where("date(ordenp.ordPFecha) <=", $fechaFin);
        }
        if($areaEstablecimientoID > 0){
            $this->db->where("areEst.areaEstablecimientoID", $areaEstablecimientoID);
        }
        if($usuarioID > 0){
            $this->db->where("ordenp.usuarioID", $usuarioID);
        }
        if($soloCocina === "1" OR $soloCocina === 1){
            $this->db->where("prod.prodctucocina", 1);
        }else if($soloCocina === "0" OR $soloCocina === 0){
            //  se  aceptan  los  NULL  porque  prodctucocina  puede  no  estar  inicializado
            $this->db->where("(prod.prodctucocina IS NULL OR prod.prodctucocina = 0)", NULL, FALSE);
        }
    }

    //  funcion que  lista  los  usuarios  que  tienen  ventas  registradas , para  el  combo  del  filtro
    public function usuariosConVentas(){
        $sql = "SELECT DISTINCT u.usuarioID, upper(trim(u.usrNombre)) AS usrNombre
                  FROM ordenpedido o
                 INNER JOIN usuario u ON u.usuarioID = o.usuarioID
                 ORDER BY u.usrNombre";
        $query = $this->db->query($sql)->result();
        return  $query;
    }

    // =====================================================================
    //  DETALLE  DE  PRODUCTOS  VENDIDOS
    //  filtros :  rango  de  fecha ,  area ,  usuario  y  producto  de  cocina
    //  si  no  se  envia  ningun  filtro  muestra  TODO
    // =====================================================================
    public function detalleProductosVendidos($fechaIni = "", $fechaFin = "", $areaEstablecimientoID = 0, $usuarioID = 0, $soloCocina = ""){
        $this->db->select(" date_format(ordenp.ordPFecha,'%d-%m-%Y') as fecha, 
                            date_format(ordenp.ordPFecha,'%h:%i %p') as hora,
                            upper(trim(coalesce(usr.usrNombre,'SIN USUARIO'))) as usuario,
                            date_format(ordenp.ordFechaliquida,'%h:%i %p') as hora_liqui,  
                             upper(trim(coalesce(usrlq.usrNombre,'SIN USUARIO'))) as usuarioLiquidacion,
                            CONCAT(
                                    TIMESTAMPDIFF(
                                        HOUR,
                                        ordenp.ordPFecha,
                                        ordenp.ordFechaliquida
                                    ),
                                    ' h ',
                                    MOD(
                                        TIMESTAMPDIFF(
                                            MINUTE,
                                            ordenp.ordPFecha,
                                            ordenp.ordFechaliquida
                                        ),
                                        60
                                    ),
                                    ' min'
                                ) as tiempoTotal,
                            msa.mesNombre as mesa,
                            ordenp.ordenPedidoID,
                            prod.productoID,
                            upper(prod.prodDescripcion) as prodDescripcion,
                            fam.famProdDescripcion,
                            coalesce(prod.prodctucocina,0) as prodctucocina,
                            ped.detcantidad as cantidad,
                            (ped.detprecioNormal + coalesce(ped.detprecioEspecial,0)) as preciounit,
                             ped.dettotal,
                            areEst.areaEstablecimientoID, areEst.area,                           
                           ordenp.ordPpenditeCobro, ordenp.ordPcomentario")
                 ->join('mesa as  msa',  'msa.mesaID = ordenp.mesaID', 'inner')
                 ->join('areasestablecimiento areEst',  'areEst.areaEstablecimientoID =  msa.areaEstablecimientoID', 'inner')
                 ->join('usuario usr',  'usr.usuarioID = ordenp.usuarioID', 'left')
                 ->join('usuario usrlq',  'usrlq.usuarioID = ordenp.usuarioIDliquida', 'left')
                 ->join('detordenpedido ped',  'ped.ordenPedidoID =  ordenp.ordenPedidoID', 'inner')
                 ->join('producto prod',  'prod.productoID =  ped.productoID', 'inner')
                 ->join('familiaproducto fam',  'fam.famProdID = prod.famProdID', 'left');

        $this->filtrosProductosVendidos($fechaIni, $fechaFin, $areaEstablecimientoID, $usuarioID, $soloCocina);

        $query = $this->db->order_by("ordenp.ordPFecha", "DESC")
                 ->order_by("ordenp.ordenPedidoID", "DESC")
                 ->get("ordenpedido ordenp")
                 ->result();
        return  $query;
    }

    //  funcion que  agrupa  los  productos  vendidos  para  el  resumen  del  reporte
    public function resumenProductosVendidos($fechaIni = "", $fechaFin = "", $areaEstablecimientoID = 0, $usuarioID = 0, $soloCocina = ""){
        $this->db->select("areEst.area, prod.productoID, upper(prod.prodDescripcion) as prodDescripcion,
                           coalesce(prod.prodctucocina,0) as prodctucocina,
                           sum(ped.detcantidad) as cantidad, sum(ped.dettotal) as total")
                 ->join('mesa as  msa',  'msa.mesaID = ordenp.mesaID', 'inner')
                 ->join('areasestablecimiento areEst',  'areEst.areaEstablecimientoID =  msa.areaEstablecimientoID', 'inner')
                 ->join('detordenpedido ped',  'ped.ordenPedidoID =  ordenp.ordenPedidoID', 'inner')
                 ->join('producto prod',  'prod.productoID =  ped.productoID', 'inner');

        $this->filtrosProductosVendidos($fechaIni, $fechaFin, $areaEstablecimientoID, $usuarioID, $soloCocina);

        $query = $this->db->group_by("areEst.areaEstablecimientoID")
                 ->group_by("prod.productoID")
                 ->order_by("total", "DESC")
                 ->get("ordenpedido ordenp")
                 ->result();
        return  $query;
    }



   // funcion que pone como despachada una orden 
    //  funcion para anular  la orden de pedido  
    public function  despacharOrden($detPedID, $estado){
          //echo  "anulando la  orden de pedido".$ordenID.   "\n";
               $this->db->set("despachar", $estado) 
                 ->where("detPedID", $detPedID)
                 ->update("detordenpedido");
        return $this->db->affected_rows();  

    }

    // funcion para poner marca de cobro a  elemnto de la orden 
    // detordenpedido
        //despachar
        //cobrar
        // procesado

        public function  cobrarOrden($detPedID, $estado){
         // echo  "Cobrando en el model".$detPedID.   "\n";
               $this->db->set("cobrar", $estado) 
                 ->where("detPedID", $detPedID)
                 ->update("detordenpedido");
        return $this->db->affected_rows();  
       



    }
    // funcion suma todos lo detalles de la ordenes marcadas para cobrar  
    public function sumCobrar($ordenPedidoID){
        $query = $this->db->select("sum(dettotal) as sumas" )
          ->where("ordenPedidoID",  $ordenPedidoID)
         ->where("cobrar",  1)
         ->where("procesado",  0)
         ->get("detordenpedido")
         ->row();
         return $query ;
    }
    // funcionn marca como procesado todas las  ordenes 
    
        public function  procesarCobro($ordenPedidoID, $ordPtotalcancelar ){  
           
            // identificamos si no hay ningun elemento seleccionado 
           // echo  "poniendo procesados" ;     
               $this->db->set("procesado", 1) 
                         ->where("ordenPedidoID",  $ordenPedidoID)
                         //->where("cobrar",  1)
                         //->where("despachar",  1)                 
                 ->update("detordenpedido");
        // return $this->db->affected_rows();  
        // poenemos abonado toda la cabecesra del abono  ordPAbono
          $this->db->set("ordPAbono", $ordPtotalcancelar) 
                    ->set("ordPAcobrar", 0.0)
                     ->set("ordPpenditeDespacho", 0)
                     ->set("ordPpenditeCobro", 0)    
                     ->set("usuarioIDliquida", $_SESSION["usuario"])
                     ->set("ordFechaliquida",date("Y-m-d H:i:s"))                     
                     ->where("ordenPedidoID",  $ordenPedidoID)
                                        
                 ->update("ordenpedido");
                 return $this->db->affected_rows();  

        }

        // funcion para abonar  el  cobro de la orden 
    public function  abonarOrden($ordenPedidoID,  $ordPAbono, $ordPAcobrar){   
               $this->db->set("ordPAbono", $ordPAbono)
                          ->set("ordPAcobrar", $ordPAcobrar) 
               
                 ->where("ordenPedidoID", $ordenPedidoID)
                 ->update("ordenpedido");
        return $this->db->affected_rows();  

    }
    // funcion para  retornar los datos de la  cabecera del pedido 
    public function infoPedido($ordenPedidoID){
        $query = $this->db->select("*" )
          ->where("ordenPedidoID",  $ordenPedidoID)
         //->where("cobrar",  1)
        // ->where("procesado",  0)
         ->get("ordenpedido")
         ->row();
         return $query ;
    }

    // funcion mustra todas las ordenes cobradas  
    public function listaOrdenesProcesadas(){
   // echo  "mostrando los datos del  pedido" ;


        $this->db->distinct();         
        $query = $this->db->select("ordenp.mesaID,msa.mesNombre as mesa,   ordenp.ordenPedidoID, ordenp.ordPFecha, HOUR( ordenp.ordPFecha)  as hora, 
                                    MINUTE(ordenp.ordPFecha) as minuto,  
                                    upper(trim(ordenp.ordPcomentario)) as cliente, areEst.area,  ordenp.ordPpenditeDespacho,  ordenp.ordPAbono, ordenp.ordPAcobrar  as  ordPtotalcancelar, 
                                    prod.prodDescripcion , presen.presProdDescripcion as Presentacion,  pre.presentacionProd as tipo, 
                                    ped.detPedID ,ped.detcantidad as catidad,  prod.famProdID,  ped.dettotal, ped.cobrar,ped.despachar")
                      ->join('usuario as  u',  ' u.usuarioID = ordenp.usuarioID', 'inner') 
                      ->join('nivelusuario as  nlu',  ' nlu.nivelUsuarioID = u.nivelUsuarioID', 'inner')  

                      ->join('mesa as  msa',  ' msa.mesaID = ordenp.mesaID', 'inner')
                      ->join('areasestablecimiento areEst',  'areEst.areaEstablecimientoID =  msa.areaEstablecimientoID', 'inner')
                      ->join('detordenpedido ped',  ' ped.ordenPedidoID =  ordenp.ordenPedidoID', 'inner')
                      ->join('producto prod',  'prod.productoID =  ped.productoID', 'inner')
                      ->join('presentacionproducto presen',  'presen.presProdID = prod.presProdID', 'inner')
                      ->join('presentacionprod pre',  'pre.presProdID = prod.presProdID', 'inner')
                      ->join('familiaproducto fam',  'fam.famProdID = prod.famProdID', 'inner')

                    
                   
                 //->where("ordenp.mesaID",  $mesaID)
                 ->where(" ordenp.ordPpenditeCobro",  0)
                   ->where("ped.detstatus",  1)
                ->order_by("ordenp.ordPFecha", "DESC")
                 ->get("nuevoestablo.ordenpedido ordenp")
                 ->result();
        return  $query;

    }

    public function  procesarPedido($ordenPedidoID){
       // echo  "la orden a procesar es "    . $ordenPedidoID ;    
       date_default_timezone_set('America/El_Salvador');       
          $this->db->set("ordVisto", 1) 
                    ->set("ordFechaVisto", date("Y-m-d H:i:s"))
                    ->where("ordenPedidoID",  $ordenPedidoID)
                                        
                 ->update("ordenpedido");
                 return $this->db->affected_rows();  

    }
    //  resumen  de venta  por mesa 
    public function  resumenProductosMesa($mesaID){
      $query = $this->db->select("depp.productoID, trim(upper(prod.prodDescripcion)) as prodDescripcion, sum(depp.detcantidad) as cantidad, depp.detprecioNormal as precioUnidad, 
                                  sum(depp.dettotal) as total,  depp.detstatus, depp.ordenPedidoID, ordp.ordPpenditeCobro")
                         ->join('ordenpedido ordp',  'ordp.ordenPedidoID = depp.ordenPedidoID', 'inner')
                         ->join('producto prod',  'prod.productoID = depp.productoID', 'inner')
                         ->where("depp.detstatus",  1)
                         ->where("ordp.ordPpenditeCobro",  1)
                         ->where("ordp.mesaID",  $mesaID)
                         ->group_by("ordp.mesaID, depp.productoID")
                         ->order_by("prod.prodDescripcion", "ASC")
                         ->get("nuevoestablo.detordenpedido depp")
                         ->result();
        return  $query;
    }
    // FUNCION ANULA TODO DEL DETALLE DE LA ORDEN CUANDO SE EJECUTA ANULAR ORDEN
   public function anularAllDetPedido($ordenPedidoID){
     $this->db->set("detstatus", 0) 
                 ->where("ordenPedidoID", $ordenPedidoID)
                 ->update("detordenpedido");
        return $this->db->affected_rows();  
    }
// funcion retorna la cabecera de todas las ordesnes pendientes de cobro 

 public function  listaOrdPendienteCob($mesaID){
      $query = $this->db->select("ord.ordenPedidoIDo")
                         ->join(' nuevoestablo.detordenpedido dp',  'dp.ordenPedidoID =  ord.ordenPedidoID', 'inner')
                         //->join('producto prod',  'prod.productoID = depp.productoID', 'inner')
                         ->where("dp.detstatus",  1)
                         ->where("ord.ordPpenditeCobro",  1)
                         ->where("ord.ordPanulado",  0)
                         ->where("ord.mesaID ",  $mesaID)
                         ->group_by("ord.ordenPedidoID")
                         ->order_by("ord.ordenPedidoID", "ASC")
                         ->get("nuevoestablo.ordenpedido ord")
                         ->result();
        return  $query;
    }



    
    





    // funcio para actualizar el abono 










  







}
