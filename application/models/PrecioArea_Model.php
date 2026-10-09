<?php
defined('BASEPATH') or exit('No direct script access allowed');
class  PrecioArea_Model extends CI_Model{

    // funcion para  listar  los productos  con  su precio base , esta  es la columna  fija  de la  matriz de precios
    public function lista_productoPrecioArea() {
        $query =  $this->db->select("precprod.productoID, upper(prod.prodDescripcion)  as  prodDescripcion, precprod.precioventa, precprod.proddisponible ")
                  ->join("producto prod", "precprod.productoID  = prod.productoID","inner")
                ->where('prod.prodStatus',1)
                  ->group_by("prod.productoID")
                 ->get("precioproducto precprod")
                 ->result();
        return  $query;
    }

    //  funcion que  verifica  que  la  tabla  de  precios  por  area  ya  este  creada
    //  ( ver  sql/precios_por_area.sql ) ,  asi  el  sistema  no  se  cae  si  aun  no  se  ha  ejecutado
    public function existeTablaPrecioArea() {
        return  $this->db->table_exists('precioproductoarea');
    }

    // funcion que  retorna  todos los  precios por  area  registrados , se  usa para  armar las  columnas dinamicas
    public function get_listPreciosArea() {
        if( ! $this->existeTablaPrecioArea()){
            return array();
        }
        $query =  $this->db->select("prcarea.*")
                 ->where('prcarea.precioAreaStatus',1)
                 ->get("precioproductoarea prcarea")
                 ->result();
        return  $query;
    }

    // funcion que  arma la matriz  [productoID][areaEstablecimientoID] =  precio , asi la  vista no  consulta  por  cada  celda
    public function get_matrizPreciosArea() {
        $matriz  = array();
        $precios = $this->get_listPreciosArea();
        if(!empty($precios)){
            foreach($precios as $row){
                $matriz[$row->productoID][$row->areaEstablecimientoID] = $row;
            }
        }
        return  $matriz;
    }

    // funcio  que  identifica si el  producto ya  tiene  precio  registrado en  el  area
    public function get_PrecioAreaPorProducto($productoID, $areaEstablecimientoID) {
        if( ! $this->existeTablaPrecioArea()){
            return NULL;
        }
        $query =  $this->db->select("prcarea.*")
                 ->where('prcarea.productoID',$productoID)
                 ->where('prcarea.areaEstablecimientoID',$areaEstablecimientoID)
                 ->get("precioproductoarea prcarea")
                 ->row();
        return  $query;
    }

    // funcion para  insertar  el  precio del  producto  en  el  area
    public function  addPrecioArea($data, $precioAreaID){
        if( ! $this->existeTablaPrecioArea()){
            return 0;
        }
        if($precioAreaID ==   NULL){
            $this->db->insert("precioproductoarea",$data);
            return $this->db->insert_id();
        }else{
            $this->db->set("precioventa",     $data["precioventa"])
                     ->set("proddisponible",  $data["proddisponible"])
                     ->set("fechactualizado", $data["fechactualizado"])
                     ->set("usuarioID",       $data["usuarioID"])
                     ->where("precioAreaID",  $precioAreaID)
                     ->where("precioAreaStatus",  1)
                     ->update("precioproductoarea");
            return $this->db->affected_rows();
        }
    }
    /*producto disponible */
     public function  addDisponible($data, $precioAreaID){
        
            $this->db->set("precioventa",     $data["precioventa"])
                     ->set("proddisponible",  $data["proddisponible"])
                     ->set("fechactualizado", $data["fechactualizado"])
                     ->set("usuarioID",       $data["usuarioID"])
                     ->where("precioAreaID",  $precioAreaID)
                     ->where("precioAreaStatus",  1)
                     ->update("precioproductoarea");
            return $this->db->affected_rows();
        }
    


    //  funcion para actualizar  el precio de venta  del producto  en  el  area , si  no existe lo crea
    public function  updatePrecioArea($data, $productoID, $areaEstablecimientoID){
        $registro    = $this->get_PrecioAreaPorProducto($productoID, $areaEstablecimientoID);
        $precioAreaID = (empty($registro)) ? NULL : $registro->precioAreaID ;
        if($precioAreaID == NULL){
            $data['productoID']            = $productoID;
            $data['areaEstablecimientoID'] = $areaEstablecimientoID;
        }
        return  $this->addPrecioArea($data, $precioAreaID);
    }

    // funcion que retorna  el precio  del producto  segun  el  area  de la mesa , si  no  hay  precio de area  devuelve el  precio base
    public function get_PrecioProductoArea($productoID, $areaEstablecimientoID) {
        if( ! $this->existeTablaPrecioArea()){
            //  sin  la  tabla  de  areas  se  devuelve  el  precio  base
            $query =  $this->db->select("prod.productoID, prod.prodDescripcion, prod.prodctucocina,
                                        precprod.precioventa, precprod.proddisponible")
                     ->join("precioproducto precprod", "precprod.productoID  = prod.productoID","inner")
                     ->where('prod.productoID',$productoID)
                     ->get("producto prod")
                     ->row();
            return  $query;
        }
        $query =  $this->db->select("prod.productoID, prod.prodDescripcion, prod.prodctucocina,
                                     COALESCE(prcarea.precioventa, precprod.precioventa)   as precioventa,
                                     COALESCE(prcarea.proddisponible, precprod.proddisponible) as proddisponible")
                 ->join("precioproducto precprod", "precprod.productoID  = prod.productoID","inner")
                 ->join("precioproductoarea prcarea",
                        "prcarea.productoID = prod.productoID and prcarea.areaEstablecimientoID = ".intval($areaEstablecimientoID)." and prcarea.precioAreaStatus = 1",
                        "left", FALSE)
                 ->where('prod.productoID',$productoID)
                 ->get("producto prod")
                 ->row();
        return  $query;
    }

    /*Funcion para eliminar  el  precio  de un  producto en  un  area */
    public function delete_PrecioArea($precioAreaID) {
        $this->db->set("precioAreaStatus", 0)
                 ->where("precioAreaID",$precioAreaID)
                 ->update("precioproductoarea");
        return  $this->db->affected_rows();
    }

}
