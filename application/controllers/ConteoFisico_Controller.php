<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConteoFisico_Controller extends CI_Controller{
    public function __construct()
    {
           parent::__construct();
           $this->load->database();
           $this->load->model('Producto_Model');
           $this->load->model('InvDiario_Model');
           $this->load->model('ConteoFisico_Model');
           $this->load->model('BodegaProducto_Model');
           $this->load->model('Turnos_Model');
           $this->load->helper('path');
    }

    // funcion que muestra la vista principal del conteo fisico
    public function capturaConteo(){
        $data['listaProductos'] = $this->InvDiario_Model->get_ListProducto();
        $data['turnos']         = $this->Turnos_Model->get_listaTurnos();
        $data['bodegas']        = $this->BodegaProducto_Model->get_listBodegaProducto();
        $this->load->view('conteofisico/conteoFisico',$data);
    }

    // funcion para almacenar el conteo fisico de productos (cabecera + detalle)
    public function  insertar_conteo(){
       // Codigos de error : 200 => exito , 404 => error en la ejecucion
       $resultInsert   = 0;
       $insertaDetalle = 0;

       $conteoID    = (isset($_POST['conteoID'])    &&  $_POST['conteoID']    > 0) ? $_POST['conteoID']    : null;
       $detConteoID = (isset($_POST['detConteoID']) &&  $_POST['detConteoID'] > 0) ? $_POST['detConteoID'] : null;

       // si ya existe la cabecera reutilizamos el conteoID
       if($conteoID > 0 ){
         $resultInsert =  $conteoID ;
       }

       // datos para el almacenaje de la cabecera
       if($resultInsert == 0){
            $fecha             = (isset($_REQUEST['fechaC']) && strlen($_REQUEST['fechaC']) > 0) ? $_REQUEST['fechaC'] : null;
            $establecimientoID = $_SESSION["establecimientoID"];
            $turnOperaID       = (isset($_POST['turno'])  && is_numeric($_POST['turno'])  && $_POST['turno']  > 0) ? $_POST['turno']  : null;
            $usuarioID         = $_SESSION["usuarioID"];

            if(strlen($fecha) > 0  && strlen($establecimientoID) > 0 &&  $turnOperaID != null  && $conteoID == null ){
                  $dataEncConteo = array('establecimientoID' => $establecimientoID,
                                         'fecha'             => $fecha,
                                         'turnOperaID'       => $turnOperaID,
                                         'usuarioID'         => $usuarioID
                                     );
                $resultInsert = $this->ConteoFisico_Model->insertar_conteo( $dataEncConteo, $conteoID);
                $conteoID     = $resultInsert;
             }
       }

       if($resultInsert > 0){
            $bodegaProductoID = (isset($_POST['bodega'])   && is_numeric($_POST['bodega'])   && $_POST['bodega']   > 0) ? $_POST['bodega']   : null;
            $productoID       = (isset($_POST['producto']) && is_numeric($_POST['producto']) && $_POST['producto'] > 0) ? $_POST['producto'] : null;
            $tcierreant       = (isset($_POST['tcierreant']) && strlen($_POST['tcierreant']) > 0) ? $_POST['tcierreant'] : 0;
            $existenciaF      = (isset($_POST['existenciaF']) && strlen($_POST['existenciaF']) > 0) ? $_POST['existenciaF'] : 0;
            $aberia           = (isset($_POST['aberia']) && strlen($_POST['aberia']) > 0) ? $_POST['aberia'] : 0;
            $refil            = (isset($_POST['refil'])  && strlen($_POST['refil'])  > 0) ? $_POST['refil']  : 0;

            if($bodegaProductoID == null || $productoID == null){
                $retorno = array('nError'=>"404", 'msgError'=>"Debe seleccionar bodega y producto", 'conteoID'=>$conteoID, 'detConteoID'=>0);
                header("Content-Type: application/json");
                echo  json_encode($retorno);
                return;
            }

            $dataDetconteo = array('conteoID'         => $conteoID,
                                   'bodegaProductoID' => $bodegaProductoID,
                                   'productoID'       => $productoID,
                                   'tcierreant'       => $tcierreant,
                                   'existenciaF'      => $existenciaF,
                                   'aberia'           => $aberia,
                                   'refil'            => $refil
                                     );

            $insertaDetalle = $this->ConteoFisico_Model->insertar_detconteofisico($dataDetconteo, $detConteoID);
            $retorno  = array('nError'=>"200",  'msgError'=>"Registro almacenado con éxito", 'conteoID'=>$conteoID, 'detConteoID'=>0 );
            header("Content-Type: application/json");
            echo  json_encode($retorno);
       }else{
            $retorno  = array('nError'=>"404",  'msgError'=>"Debe indicar fecha y turno para iniciar el conteo", 'conteoID'=>0, 'detConteoID'=>0 );
            header("Content-Type: application/json");
            echo  json_encode($retorno);
       }
    }

    // funcion que retorna la lista del detalle de un conteo
    public function get_listaDetConteo($conteoID){
      $data['listaDetConteo'] = $this->ConteoFisico_Model->get_listaDetConteo($conteoID);
      $this->load->view('conteofisico/detConteoFisico',$data);
    }

    // funcion que lista los conteos fisicos en un rango de fechas
   public function  get_listaConteo(){
     $FechIncio = (isset($_REQUEST['FechIncio']) && strlen($_REQUEST['FechIncio']) > 0) ? $_REQUEST['FechIncio'] : null;
     $FechFin   = (isset($_REQUEST['FechFin'])   && strlen($_REQUEST['FechFin'])   > 0) ? $_REQUEST['FechFin']   : null;
      $data['listaConteo'] = $this->ConteoFisico_Model->get_listaConteo($FechIncio, $FechFin);
      $this->load->view('conteofisico/detListaConteo',$data);
   }

   // funcion que retorna un detalle del conteo en formato json
   public function get_DetConteoID() {
    $detConteoID = (isset($_REQUEST['detConteoID'])) ? $_REQUEST['detConteoID'] : null;
    $DetConteo   = $this->ConteoFisico_Model->get_DetConteoID($detConteoID);
    echo  json_encode($DetConteo);
   }

   // funcion para eliminar el detalle del conteo
   public function detDetalleConteoFisico($detConteoID) {
    $result = $this->ConteoFisico_Model->detDetalleConteoFisico($detConteoID);
    echo  $result;
   }

   //  funcion para cargar el detalle del conteo (edicion)
   public function edit_DetConteoID($detConteoID) {
    $DetConteo = $this->ConteoFisico_Model->get_DetConteoID($detConteoID);
    echo  json_encode($DetConteo);
   }

   //  funcion para actualizar el detalle del conteo
   public function  updateDetConteoFisico(){
            $detConteoID      = (isset($_POST['detConteoID']) &&  $_POST['detConteoID'] > 0) ? $_POST['detConteoID'] : null;
            $bodegaProductoID = (isset($_POST['bodega'])   && is_numeric($_POST['bodega'])   && $_POST['bodega']   > 0) ? $_POST['bodega']   : null;
            $productoID       = (isset($_POST['producto']) && is_numeric($_POST['producto']) && $_POST['producto'] > 0) ? $_POST['producto'] : null;
            $tcierreant       = (isset($_POST['tcierreant']) && strlen($_POST['tcierreant']) > 0) ? $_POST['tcierreant'] : 0;
            $existenciaF      = (isset($_POST['existenciaF']) && strlen($_POST['existenciaF']) > 0) ? $_POST['existenciaF'] : 0;
            $aberia           = (isset($_POST['aberia']) && strlen($_POST['aberia']) > 0) ? $_POST['aberia'] : 0;
            $refil            = (isset($_POST['refil'])  && strlen($_POST['refil'])  > 0) ? $_POST['refil']  : 0;

            $dataDetconteo = array('detConteoID'      => $detConteoID,
                                   'bodegaProductoID' => $bodegaProductoID,
                                   'productoID'       => $productoID,
                                   'tcierreant'       => $tcierreant,
                                   'existenciaF'      => $existenciaF,
                                   'aberia'           => $aberia,
                                   'refil'            => $refil
                                     );

            $this->ConteoFisico_Model->insertar_detconteofisico($dataDetconteo, $detConteoID);
            $retorno = array('nError'=>"200", 'msgError'=>"Registro actualizado con éxito", 'conteoID'=>0, 'detConteoID'=>$detConteoID );
            header("Content-Type: application/json");
            echo  json_encode($retorno);
   }

   // funcion que retorna el ultimo conteo final (cierre anterior) de un producto/bodega
   public function get_cierreAnterior(){
        $productoID       = (isset($_POST['producto']) && is_numeric($_POST['producto']) && $_POST['producto'] > 0) ? $_POST['producto'] : null;
        $bodegaProductoID = (isset($_POST['bodega'])   && is_numeric($_POST['bodega'])   && $_POST['bodega']   > 0) ? $_POST['bodega']   : null;
        $existenciaF = 0;
        $fecha       = "";
        if($productoID != null && $bodegaProductoID != null){
            $row = $this->ConteoFisico_Model->get_cierreAnterior($productoID, $bodegaProductoID);
            if($row != null){
                $existenciaF = $row->existenciaF;
                $fecha       = $row->fecha;
            }
        }
        header("Content-Type: application/json");
        echo  json_encode(array('tcierreant'=>$existenciaF, 'fecha'=>$fecha));
   }

   // funcion que anula un conteo fisico completo
   public function anular_conteo($conteoID){
        $result = $this->ConteoFisico_Model->anular_conteo($conteoID);
        echo  $result;
   }

   // funcion que muestra el resumen del inventario (inventario actual) por producto
   public function resumenInventario(){
        $FechIncio = (isset($_REQUEST['FechIncio']) && strlen($_REQUEST['FechIncio']) > 0) ? $_REQUEST['FechIncio'] : null;
        $FechFin   = (isset($_REQUEST['FechFin'])   && strlen($_REQUEST['FechFin'])   > 0) ? $_REQUEST['FechFin']   : null;
        $bodega    = (isset($_REQUEST['bodega'])    && is_numeric($_REQUEST['bodega']) && $_REQUEST['bodega'] > 0) ? $_REQUEST['bodega'] : null;
        $data['listaResumen'] = $this->ConteoFisico_Model->get_resumenInventario($FechIncio, $FechFin, $bodega);
        $this->load->view('conteofisico/resumenInventario',$data);
   }

}
?>
