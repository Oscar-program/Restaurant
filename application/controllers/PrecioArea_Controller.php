<?php
defined('BASEPATH') or  exit('No direct script access allowed');
class PrecioArea_Controller extends CI_Controller{
    public function __construct(){
        parent:: __construct();
        $this->load->database();
        $this->load->model('PrecioArea_Model');
        $this->load->model('AreasEstablecimiento_Model');
        $this->load->model('preciosProducto_Model');
        $this->load->model('FamiliaProducto_Model');
        $this->load->helper('path');
    }

    //  funcion para mostrar la  lista de precios  con  una  columna  por  cada  area  creada
    public function preciosPorArea(){
        $famProdID = (isset($_REQUEST['famProdID']) AND $_REQUEST['famProdID'] > 0) ? $_REQUEST['famProdID'] : 0 ;

        $datos['lista_productoCostear']    = $this->preciosProducto_Model->lista_productoCostear($famProdID);
        $datos['listAreasEstablecimiento'] = $this->AreasEstablecimiento_Model->get_listAreasEstablecimiento($_SESSION["establecimientoID"]);
        $datos['preciosArea']              = $this->PrecioArea_Model->get_matrizPreciosArea();
        $datos['listFamiliaProducto']      = $this->FamiliaProducto_Model->listaAllFamiliaProducto();
        $datos['famProdID']                = $famProdID;
        $this->load->view('inventarios/precios_producto', $datos);
    }

    // funcion para almacenar  el  precio  de  un  producto  en  una  sola  area
    public function savePrecioArea(){
        $productoID            = (isset($_POST['productoID'])            AND  $_POST['productoID'] !=0 )              ? $_POST['productoID']            : 0 ;
        $areaEstablecimientoID = (isset($_POST['areaEstablecimientoID']) AND  strlen($_POST['areaEstablecimientoID'])>0 ) ? $_POST['areaEstablecimientoID'] : 0 ;
        $precioventa           = (isset($_POST['precioventa'])           AND  strlen($_POST['precioventa'])>0 )       ? $_POST['precioventa']           : 0 ;
        $proddisponible        = (isset($_POST['proddisponible'])  AND ($_POST['proddisponible'] == 'true' OR $_POST['proddisponible'] == '1')) ? 1 : 0 ;
        $result                = 0;

        if($productoID > 0  AND  strlen($areaEstablecimientoID) > 0){
            $data   = array('precioventa'     => $precioventa,
                            'proddisponible'  => $proddisponible,
                            'fechactualizado' => date("Y-m-d H:i:s"),
                            'usuarioID'       => $_SESSION["usuarioID"]
                        );
            $result = $this->PrecioArea_Model->updatePrecioArea($data, $productoID, $areaEstablecimientoID);
        }
        echo $result ;
    }

    // funcion para almacenar  de  una  sola  vez  los precios  de todas  las  areas  de  un  producto
    // la  vista  envia  precios[areaEstablecimientoID] =  precio
    // El  precio  de  venta  se  guarda  SOLO  en  precioproductoarea ;  de  precioproducto
    // se  actualiza  nada  mas  la  marca  de  disponible.
    public function savePreciosProductoArea(){
        $productoID     = (isset($_POST['productoID'])     AND  $_POST['productoID'] !=0 ) ? $_POST['productoID'] : 0 ;
        $precios        = (isset($_POST['precios'])        AND  is_array($_POST['precios'])) ? $_POST['precios'] : array() ;
        $proddisponible = (isset($_POST['proddisponible']) AND ($_POST['proddisponible'] == 'true' OR $_POST['proddisponible'] == '1')) ? 1 : 0 ;
        $guardados      = 0;

        if($productoID > 0){
            //  el  switch  Disponible  se  guarda  siempre , aunque  no  se  haya  escrito  ningun  precio
            $this->preciosProducto_Model->updateDisponibleProducto($productoID, $proddisponible);

            foreach($precios as $areaEstablecimientoID => $precioventa){
                // solo se  actualiza el  area  en la  que el usuario  escribio  un  precio
                if(strlen(trim($precioventa)) > 0){
                    $data = array('precioventa'     => $precioventa,
                                  'proddisponible'  => $proddisponible,
                                  'fechactualizado' => date("Y-m-d H:i:s"),
                                  'usuarioID'       => $_SESSION["usuarioID"]
                                );
                    var_dump($data ) ;           
                    $this->PrecioArea_Model->updatePrecioArea($data, $productoID, $areaEstablecimientoID);
                    $guardados += 1;
                }
            }
        }
        echo $guardados ;
    }

    // funcion para cargar el  precio  del  area  que  se  quiere  modificar
    public function get_PrecioAreaPorProducto($productoID, $areaEstablecimientoID){
        $result = $this->PrecioArea_Model->get_PrecioAreaPorProducto($productoID, $areaEstablecimientoID);
        echo  json_encode($result);
    }

    // funcion que  retorna el precio  vigente  del producto  segun  el  area  de  la  mesa
    public function get_PrecioProductoArea($productoID, $areaEstablecimientoID){
        $result = $this->PrecioArea_Model->get_PrecioProductoArea($productoID, $areaEstablecimientoID);
        echo  json_encode($result);
    }

    /*Funcion para eliminar  el  precio  de  un  producto en  un  area */
    public function delete_PrecioArea($precioAreaID){
        $result = $this->PrecioArea_Model->delete_PrecioArea($precioAreaID);
        echo   $result ;
    }

}
