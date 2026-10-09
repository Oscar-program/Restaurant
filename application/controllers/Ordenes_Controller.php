<?php  
defined('BASEPATH') or  exit('No direct script access allowed');
 ini_set('display_errors',1);
 ini_set('display_startup_errors',1);
 error_reporting(E_ALL); 
 date_default_timezone_set('America/El_Salvador');  

class Ordenes_Controller extends CI_Controller{
     public function __construct(){
        parent:: __construct();
        $this->load->database();
        $this->load->model('ordenesPedido_Model');
        $this->load->model('mesas_Model');
        $this->load->model('AreasEstablecimiento_Model');
        $this->load->helper('path');
    }

    //  1-  Muestra las mesas que  tiene ordenes pendientes de DESPACHO  
    public function get_OrdenesPendientesDespachar(){   
      //echo  "Pendientes despachar " . "<br>" ;        
       $data['listaMesasPendientesCobro'] = $this->mesas_Model->listaMesasPendienteDespacho();
       $this->load->view('ordenes/ordenesDespacho', $data);
    }
    
    // funcion muestra las ordenes pendientes de COBRO 
    public function get_OrdenesPendientesCobro(){   
       //echo  "PendientesCobro " . "<br>" ;        
       $data['listaMesasPendientesCobro'] = $this->mesas_Model->listaMesasPendienteCobro();
       $this->load->view('ordenes/ordenesCobrar', $data);
    }




    // 2- muestra las  ordenes que estan pendientes de despacho agrupadas por numero de orden    
      public  function listaOrdenesPendienteDespacho(){
         //echo  "Detalle de ordenes Despacho" . "<br>" ;
         $mesaID =  (isset($_POST['mesaID']) AND  strlen($_POST['mesaID'])>0) ? $_POST['mesaID'] : "0" ; 
        // echo "la mesa para mostrar los despachos es " .  $mesaID ;
           $data['lstPendDespCabecera'] = $this->ordenesPedido_Model->listaOrdenesPendienteDespacho($mesaID);

         
         //$data['lstPendDespCabecera'] = $this->mesas_Model->listaOrdenesPendienteDespacho($mesaID);
        //var_dump($data['lstPendDespCabecera']);
         //echo "dibuja cabecera" . "<br>";          
         $this->load->view('ordenes/ordenesPendientDespachoCabecera',$data);
      }


       // funcion para  mostrar las ordenes Pendientes de cobro
        
      public  function listaOrdenesPendienteCobro(){
          //   echo  "Pendiente de cobro en funcion  " ;
         $mesaID =  (isset($_POST['mesaID']) AND  strlen($_POST['mesaID'])>0) ? $_POST['mesaID'] : "0" ;     
        // echo  "la mesa seleccionada es " .  $mesaID  ;  
        $data['lstPendDespCabecera'] = $this->ordenesPedido_Model->listaOrdenesPendienteCobro($mesaID);
        //  sumatoria  de  TODAS  las  ordenes  de  la  mesa , se  muestra  en  el  label  de  la  cabecera
        $data['totalMesa']           = $this->ordenesPedido_Model->totalMesaPendienteCobro($mesaID);
        $data['infoMesa']            = $this->mesas_Model->get_infoMesa($mesaID);

        // $data['lstPendDespCabecera'] = $this->mesas_Model->listaOrdenesPendienteDespacho($mesaID);
         if(!empty($data['lstPendDespCabecera'])){
            $this->load->view('ordenes/ordenesPendienCobrar',$data);
         }else{
            echo "no se encontraron  datos " . "<br>";
         }
         
        
      }






    // 3- lista el detalle interno de la lista de ordenes pendientes de despacho 
     public function listaDetOrdenPendienteDespacho(){   
           // echo  "el nivel de usuario " . $_SESSION["nivelUsuaio"];    
        $ordenPedidoIDCab = (isset($_POST['ordenPedidoIDCab']) &&  $_POST['ordenPedidoIDCab'] !=0) ? $_POST['ordenPedidoIDCab'] :  0;   
        $data['listaDespachoPendiente'] = $this->ordenesPedido_Model->listaDetOrdenPendienteDespacho($ordenPedidoIDCab);
        $this->load->view('ordenes/detallePendienteDespacho',$data);

     }
     // funcion para anular la orden de pedido 
       public function despacharOrden(){
          $detPedID =  (isset($_POST['detPedID']) AND  $_POST['detPedID']!=0) ? $_POST['detPedID'] : "0" ;
          $estado = (isset($_POST['estado']) AND  $_POST['estado']!=0) ? $_POST['estado'] : "0" ;

          echo  "el detalle del pedido a despachar es " . $detPedID  .  "Estyado"  . $estado;
          $result   =  $this->ordenesPedido_Model->despacharOrden($detPedID, $estado);
          echo   $result ;
       }
      
       // funcion para poner marca de cobrar a todos aquellos item marcados
       public function cobrarOrden(){
          $detPedID =  (isset($_POST['detPedID']) AND  $_POST['detPedID']!=0) ? $_POST['detPedID'] : "0" ; 
          $estado   = (isset($_POST['estado']) AND  $_POST['estado']!=0) ? $_POST['estado'] : "0" ;
          $ordenPedidoID  = (isset($_POST['ordenPedidoID']) AND  $_POST['ordenPedidoID']!=0) ? $_POST['ordenPedidoID'] : "0" ;
       //  echo  "El detalle a cobrar es " . $detPedID  ;   
          $this->ordenesPedido_Model->cobrarOrden($detPedID, $estado);
         //  echo  "Despues de cobrar " . $detPedID  ;  

          $dato = $this->ordenesPedido_Model->sumCobrar($ordenPedidoID);
          echo $dato->sumas ;

       }

       // funcion para abonar la ordenCabcera 

        public function abonarOrden(){
        // echo  "llegando al  controlador de abono  " ; 
         
          $ordPAbonoRealizar = (isset($_POST['ordPAbono']) AND  $_POST['ordPAbono']!=0) ? $_POST['ordPAbono'] :0;          
          $ordenPedidoID     = (isset($_POST['ordenPedidoID']) AND  $_POST['ordenPedidoID']!=0) ? $_POST['ordenPedidoID'] : 0 ;  
           // echo  "Los  datos antes del abono  " .  $ordenPedidoID  . "pendiente"  .    $ordPtotalcancelar  . "Abonado" .  $Abonado   ;

          $infoPedido        = $this->ordenesPedido_Model->infoPedido($ordenPedidoID) ;
        //  var_dump(  $infoPedido ) ;
          $ordPtotalcancelar = $infoPedido->ordPtotalcancelar;
          $Abonado           = $infoPedido->ordPAbono;
            //  echo  "Los  datos antes del abono  " .  $ordenPedidoID  . "pendiente"  .    $ordPtotalcancelar  . "Abonado" .  $Abonado   ;
        // echo  "Los  datos antes del abono  " .     $ordPtotalcancelar  . "Abonado" .  $Abonado   ;
          $ordPAbono         = ($Abonado + $ordPAbonoRealizar );
          $ordPAcobrar       = ($ordPtotalcancelar  - $ordPAbono ) ;

          $datos   = array('ordPtotalcancelar'=>$ordPtotalcancelar, 
                            'ordPAbono'=>$ordPAbono,
                             'ordPAcobrar'=>$ordPAcobrar) ;
          //var_dump($datos )   ;               
          



          $this->ordenesPedido_Model->abonarOrden($ordenPedidoID, $ordPAbono,   $ordPAcobrar);
        

       }

      public function listaOrdenesProcesadas(){
          $datos['listaOrdenesProcesadas']  =  $this->ordenesPedido_Model->listaOrdenesProcesadas();

      }

      // =================================================================
      //  DETALLE  DE  PRODUCTOS  VENDIDOS
      //  filtros :  rango  de  fecha ,  area ,  usuario  y  producto  de  cocina
      //  por  defecto  ( sin  filtros )  muestra  TODO
      // =================================================================

      //  funcion que  lee  los  filtros  del  request , sirve  para  la  vista , la  busqueda  y  el  Excel
      private function filtrosVendidos(){
         $fechaIni   = (isset($_REQUEST['fechaIni']) AND strlen($_REQUEST['fechaIni'])>0) ? $_REQUEST['fechaIni'] : date("Y-m-d") ;
         $fechaFin   = (isset($_REQUEST['fechaFin']) AND strlen($_REQUEST['fechaFin'])>0) ? $_REQUEST['fechaFin'] : date("Y-m-d");
         $areaID     = (isset($_REQUEST['areaEstablecimientoID']) AND $_REQUEST['areaEstablecimientoID']>0) ? $_REQUEST['areaEstablecimientoID'] : 0 ;
         $usuarioID  = (isset($_REQUEST['usuarioID']) AND $_REQUEST['usuarioID']>0) ? $_REQUEST['usuarioID'] : 0 ;
         //  "" = todos ,  "1" = solo  cocina ,  "0" = sin  cocina
         $soloCocina = (isset($_REQUEST['soloCocina']) AND ($_REQUEST['soloCocina'] === "1" OR $_REQUEST['soloCocina'] === "0")) ? $_REQUEST['soloCocina'] : "" ;

         return array('fechaIni'   => $fechaIni,
                      'fechaFin'   => $fechaFin,
                      'areaID'     => $areaID,
                      'usuarioID'  => $usuarioID,
                      'soloCocina' => $soloCocina);
      }

      public function detalleProductosVendidos(){
         $f = $this->filtrosVendidos();

         $data['listAreasEstablecimiento'] = $this->AreasEstablecimiento_Model->get_listAreasEstablecimiento($_SESSION["establecimientoID"]);
         $data['listUsuariosVentas']       = $this->ordenesPedido_Model->usuariosConVentas();
         $data['detProductosVendidos']     = $this->ordenesPedido_Model->detalleProductosVendidos($f['fechaIni'], $f['fechaFin'], $f['areaID'], $f['usuarioID'], $f['soloCocina']);
         $data['resProductosVendidos']     = $this->ordenesPedido_Model->resumenProductosVendidos($f['fechaIni'], $f['fechaFin'], $f['areaID'], $f['usuarioID'], $f['soloCocina']);
         $data['fechaIni']                 = $f['fechaIni'];
         $data['fechaFin']                 = $f['fechaFin'];
         $data['areaEstablecimientoID']    = $f['areaID'];
         $data['usuarioID']                = $f['usuarioID'];
         $data['soloCocina']               = $f['soloCocina'];

         $this->load->view('ordenes/detalleProductosVendidos', $data);
      }

      //  funcion que  recarga  unicamente  la  tabla  del  reporte  cuando  se  aplican  los  filtros
      public function buscarProductosVendidos(){
         $f = $this->filtrosVendidos();

         $data['detProductosVendidos'] = $this->ordenesPedido_Model->detalleProductosVendidos($f['fechaIni'], $f['fechaFin'], $f['areaID'], $f['usuarioID'], $f['soloCocina']);
         $data['resProductosVendidos'] = $this->ordenesPedido_Model->resumenProductosVendidos($f['fechaIni'], $f['fechaFin'], $f['areaID'], $f['usuarioID'], $f['soloCocina']);

         $this->load->view('ordenes/cuerpoProductosVendidos', $data);
      }

      // =================================================================
      //  EXPORTACION  A  EXCEL  ( CSV  con  BOM  UTF-8 )
      //  Se  genera  CSV  en  vez  de  .xls  porque  el  proyecto  no  tiene  ninguna
      //  libreria  de  Excel  instalada  ( no  hay  vendor/  ni  PhpSpreadsheet ).
      //  La  primera  linea  "sep=,"  le  indica  a  Excel  como  separar  las  columnas
      //  sin  importar  la  configuracion  regional  de  la  maquina.
      //  Respeta  exactamente  los  mismos  filtros  que  la  pantalla.
      // =================================================================
      public function exportarProductosVendidos(){
         $f       = $this->filtrosVendidos();
         $detalle = $this->ordenesPedido_Model->detalleProductosVendidos($f['fechaIni'], $f['fechaFin'], $f['areaID'], $f['usuarioID'], $f['soloCocina']);
         $resumen = $this->ordenesPedido_Model->resumenProductosVendidos($f['fechaIni'], $f['fechaFin'], $f['areaID'], $f['usuarioID'], $f['soloCocina']);

         $rangoIni = (strlen($f['fechaIni'])>0) ? $f['fechaIni'] : "INICIO" ;
         $rangoFin = (strlen($f['fechaFin'])>0) ? $f['fechaFin'] : "HOY" ;
         $lblCocina = ($f['soloCocina'] === "1") ? "SOLO COCINA" : (($f['soloCocina'] === "0") ? "SIN COCINA" : "TODOS") ;

         $csv  = "sep=,\n";
         $csv .= $this->lineaCsv(array("DETALLE DE PRODUCTOS VENDIDOS"));
         $csv .= $this->lineaCsv(array("Rango", $rangoIni." a ".$rangoFin, "Productos de cocina", $lblCocina));
         $csv .= $this->lineaCsv(array("Generado", date("d-m-Y H:i:s")));
         $csv .= "\n";

         //  hoja  1 :  resumen  por  area / producto
         $csv .= $this->lineaCsv(array("RESUMEN POR AREA Y PRODUCTO"));
         $csv .= $this->lineaCsv(array("AREA","PRODUCTO","COCINA","CANTIDAD","TOTAL"));
         $totUnidades = 0;
         $totVentas   = 0;
         if(!empty($resumen)){
            foreach($resumen as $row){
               $totUnidades += (float) $row->cantidad;
               $totVentas   += (float) $row->total;
               $csv .= $this->lineaCsv(array(strtoupper($row->area),
                                             $row->prodDescripcion,
                                             ($row->prodctucocina == 1 ? "SI" : "NO"),
                                             $row->cantidad,
                                             number_format($row->total,2,'.','')));
            }
         }
         $csv .= $this->lineaCsv(array("TOTAL GENERAL","","",$totUnidades, number_format($totVentas,2,'.','')));
         $csv .= "\n";

         //  hoja  1 :  detalle  linea  por  linea
         $csv .= $this->lineaCsv(array("DETALLE DE VENTAS"));
         $csv .= $this->lineaCsv(array("#","FECHA","HORA","USUARIO_CREACION", "HORA_PAGO", 'USUARIO_LIQUIDACION', 'TIEMPO TOTAL' ,
                                       "AREA","MESA","ORDEN #","PRODUCTO","FAMILIA","COCINA","CANTIDAD","PRECIO UNIT","TOTAL","ESTADO", "DESCRIPCION"));
         $c = 1;
         if(!empty($detalle)){
            foreach($detalle as $row){
               $csv .= $this->lineaCsv(array($c,
                                             $row->fecha,
                                             $row->hora,
                                             $row->usuario,
                                             $row->hora_liqui,
                                             $row->usuarioLiquidacion,
                                             $row->tiempoTotal,
                                             strtoupper($row->area),
                                             strtoupper($row->mesa),
                                             $row->ordenPedidoID,
                                            
                                             $row->prodDescripcion,
                                             $row->famProdDescripcion,
                                             ($row->prodctucocina == 1 ? "SI" : "NO"),
                                             $row->cantidad,
                                             number_format($row->preciounit,2,'.',''),
                                             number_format($row->dettotal,2,'.',''),
                                             ($row->ordPpenditeCobro == 1 ? "PENDIENTE DE COBRO" : "COBRADO"),
                                            str_replace(['Sin%20Comentario','Sin Comentario'],'',$row->ordPcomentario)));
               $c += 1;
            }
         }

         $nombre = 'productos_vendidos_'.date("Ymd_His").'.csv';

         $this->output
              ->set_content_type('text/csv; charset=UTF-8')
              ->set_header('Content-Disposition: attachment; filename="'.$nombre.'"')
              ->set_header('Cache-Control: no-store, no-cache, must-revalidate')
              ->set_header('Pragma: no-cache')
              //  BOM  para  que  Excel  respete  los  acentos
              ->set_output("\xEF\xBB\xBF".$csv);
      }

      //  funcion que  arma  una  linea  CSV  escapando  las  comillas
      private function lineaCsv($campos){
         $salida = array();
         foreach($campos as $valor){
            $salida[] = '"'.str_replace('"', '""', $valor).'"';
         }
         return implode(',', $salida)."\n";
      }
      public function procesarPedido($ordenPedidoID){
         $datos =  $this->ordenesPedido_Model->procesarPedido($ordenPedidoID); 

      }
      public function  resumenProductosMesa($mesaID){
          $datos['ResumenOrdenes'] =  $this->ordenesPedido_Model->resumenProductosMesa($mesaID);
           $this->load->view('ordenes/resumenOrdenesPorMesa', $datos);

         // var_dump($datos['ResumenOrdenes']) ;  
      }





      

     

     




}
?>