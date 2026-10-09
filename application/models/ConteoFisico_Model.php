<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ConteoFisico_Model extends CI_Model{

    // funcion que inserta / actualiza la cabecera del conteo fisico
    public function insertar_conteo($data, $conteoID){
        if($conteoID ==   null){
            $this->db->insert("conteofisico",$data);
            return $this->db->insert_id();
        }else{
            $this->db->set("fecha", $data["fecha"])
                     ->set("turnOperaID", $data["turnOperaID"])
                     ->where("conteoID", $conteoID)
                     ->where("anulado",  0)
                     ->update("conteofisico");
            return $conteoID;
        }
    }

    // funcion que inserta / actualiza el detalle del conteo fisico
    public function insertar_detconteofisico($data, $detConteoID){
        if($detConteoID ==   null){
            $this->db->insert("det_conteofisico",$data);
            return $this->db->insert_id();
        }else{
            $this->db->set("bodegaProductoID", $data["bodegaProductoID"])
                     ->set("productoID",       $data["productoID"])
                     ->set("tcierreant",       $data["tcierreant"])
                     ->set("existenciaF",      $data["existenciaF"])
                     ->set("aberia",           $data["aberia"])
                     ->set("refil",            $data["refil"])
                     ->where("detConteoID", $detConteoID)
                     ->where("activo",  1)
                     ->update("det_conteofisico");
            return $detConteoID;
        }
    }

    // funcion que retorna la lista del  detalle de un conteo
    public function  get_listaDetConteo($conteoID){
          $query =  $this->db->select("contf.conteoID, dtCont.detConteoID,
                                        dtCont.bodegaProductoID,
                                        dtCont.productoID,
                                        contf.fecha,
                                        prod.prodDescripcion,
                                        dtCont.tcierreant,
                                        dtCont.existenciaF,
                                        dtCont.aberia,
                                        dtCont.refil,
                                        dtCont.stockf"
                                     )
                    ->join("conteofisico contf","contf.conteoID = dtCont.conteoID",'inner')
                    ->join("producto prod","prod.productoID = dtCont.productoID",'inner')
                    ->where("contf.anulado", 0)
                    ->where("dtCont.activo", 1)
                    ->where("contf.conteoID", $conteoID)
                    ->get("det_conteofisico dtCont")
                    ->result();
            return  $query;
    }

    // funcion que lista los conteos realizados en un rango de fechas (totalizado por conteo)
     public function  get_listaConteo($fechaInicio, $fechaFin ){
          $query =  $this->db->select("contf.conteoID, contf.fecha, contf.turnOperaID,  turn.turnOperaDescripcion,
                                        SUM(dtCont.tcierreant) AS tcierreant,
                                        SUM(dtCont.existenciaF) AS existenciaF,
                                        SUM(dtCont.aberia) AS aberia,
                                        SUM(dtCont.refil) AS refil,
                                        SUM(dtCont.stockf) AS stockf"
                                     )
                    ->join("turnooperacion turn","turn.turnOperaID = contf.turnOperaID",'inner')
                    ->join("det_conteofisico dtCont","dtCont.conteoID =  contf.conteoID",'inner')
                    ->where("contf.anulado", 0)
                    ->where("dtCont.activo", 1)
                    ->where("contf.fecha>=", $fechaInicio)
                    ->where("contf.fecha<=", $fechaFin)
                    ->group_by("contf.conteoID, contf.fecha, contf.turnOperaID, turn.turnOperaDescripcion")
                    ->order_by("contf.fecha", "desc")
                    ->get("conteofisico contf")
                    ->result();
            return  $query;
    }

    // obtenemos los datos de un detalle del conteo (para edicion)
    public function get_DetConteoID($detConteoID){
            $query =  $this->db->select("dtCont.detConteoID,
                                         dtCont.conteoID,
                                         dtCont.bodegaProductoID,
                                         dtCont.productoID,
                                         dtCont.tcierreant,
                                         dtCont.existenciaF,
                                         dtCont.aberia,
                                         dtCont.refil,
                                         dtCont.stockf"
                                     )
                    ->where("dtCont.activo", 1)
                    ->where("dtCont.detConteoID", $detConteoID)
                    ->get("det_conteofisico dtCont")
                    ->row();
            return  $query;
    }

    // funcion para eliminar un detalle de conteo
    public function detDetalleConteoFisico($detConteoID){
        $this->db->where("detConteoID",$detConteoID)
                 ->delete("det_conteofisico");
        return  $this->db->affected_rows();
    }

    // funcion que retorna el ultimo conteo fisico final (existencia real) registrado
    // para un producto en una bodega, para arrastrarlo como conteo inicial del nuevo turno
    public function get_cierreAnterior($productoID, $bodegaProductoID){
        $query =  $this->db->select("dtCont.existenciaF, contf.fecha")
                    ->join("conteofisico contf","contf.conteoID = dtCont.conteoID",'inner')
                    ->where("contf.anulado", 0)
                    ->where("dtCont.activo", 1)
                    ->where("dtCont.productoID", $productoID)
                    ->where("dtCont.bodegaProductoID", $bodegaProductoID)
                    ->order_by("contf.fecha", "desc")
                    ->order_by("dtCont.detConteoID", "desc")
                    ->limit(1)
                    ->get("det_conteofisico dtCont")
                    ->row();
        return  $query;
    }

    // funcion que anula (borrado logico) un conteo fisico completo
    public function anular_conteo($conteoID){
        $this->db->set("anulado", 1)
                 ->where("conteoID", $conteoID)
                 ->update("conteofisico");
        return  $this->db->affected_rows();
    }

    // funcion que retorna el resumen del inventario por producto en un rango de fechas
    // consumo = suma de la salida del periodo ; existencia_actual = ultimo conteo fisico final
    public function get_resumenInventario($fechaInicio, $fechaFin, $bodegaProductoID){
        $filtroBodega = "";
        $params = array($fechaFin, $fechaInicio, $fechaFin);
        if($bodegaProductoID != null && $bodegaProductoID > 0){
            $filtroBodega = " AND dtCont.bodegaProductoID = ? ";
            $params[]     = $bodegaProductoID;
        }
        $sql = "SELECT prod.productoID, prod.prodDescripcion,
                       SUM(dtCont.tcierreant)  AS inicial,
                       SUM(dtCont.refil)       AS refil,
                       SUM(dtCont.existenciaF) AS final,
                       SUM(dtCont.aberia)      AS averia,
                       SUM(dtCont.stockf)      AS consumo,
                       (SELECT dt2.existenciaF
                          FROM det_conteofisico dt2
                          INNER JOIN conteofisico c2 ON c2.conteoID = dt2.conteoID
                          WHERE c2.anulado = 0 AND dt2.activo = 1
                            AND dt2.productoID = prod.productoID
                            AND c2.fecha <= ?
                          ORDER BY c2.fecha DESC, dt2.detConteoID DESC
                          LIMIT 1) AS existencia_actual
                  FROM det_conteofisico dtCont
                  INNER JOIN conteofisico contf ON contf.conteoID = dtCont.conteoID
                  INNER JOIN producto prod ON prod.productoID = dtCont.productoID
                  WHERE contf.anulado = 0 AND dtCont.activo = 1
                    AND contf.fecha >= ? AND contf.fecha <= ? " . $filtroBodega . "
                  GROUP BY prod.productoID, prod.prodDescripcion
                  ORDER BY prod.prodDescripcion";
        $query = $this->db->query($sql, $params)->result();
        return  $query;
    }

}
?>
