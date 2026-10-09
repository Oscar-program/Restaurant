<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class gastos_Model extends CI_Model{
 # funcion almacenar la cabecera de los gastos  
    public function saveGastos($data, $gastosID){
      //  ECHO  ' LCA CABECERA DEL  GASTO ES ' . $gastosID.  '<br>'; 
        if($gastosID == null){
        //    ECHO  'iNSERTANDO LA CABECERA DE LOS  GASTOS#######';
            $this->db->insert("gastosOperativos",$data);
            return $this->db->insert_id();
        }else{
           echo  'CERRANDO LOS  GASTOS';
            //var_dump($data);
            
            $this->db->set("unidades", $data["unidades"])
                    ->set("total", $data["total"])
                    ->set("cerrado", $data["cerrado"])
                    ->where("gastosID",  $gastosID)
                    ->update("gastosOperativos");
            return $this->db->affected_rows();   
        }
    } 

 # funcion para actualizar los totales de cabecera de gastos
 public function gettotales($gastosID){
    $query  =$this->db->select("sum(deg.cantidad) as cantidad, sum( deg.total) as total")
                       ->where("gastosID", $gastosID)
                       ->get("det_gastos deg")
                       ->row();
                       return  $query;    

 }
 # funcion para mostrar detalle de gastos por  id de encabezado 

 # funcion para  insertar detalle de gastos
 public function saveDetGastos($data, $detgastosID){
    if($detgastosID ==   null){
        
        $this->db->insert("det_gastostmp",$data);
        //$this->db->insert("det_gastos",$data);
        return $this->db->insert_id();
    }else{
        $this->db->set("cantidad", $data["cantidad"])
                ->set("descDetGasto", $data["descDetGasto"])
                ->set("precio", $data["precio"])
                ->set("total", $data["total"])
                ->where("detgastosID",  $detgastosID)
                ->update("det_gastos");
        return $this->db->affected_rows();   
    }
} 

 # funcion para mostrar los detalles del los gastos aun no cerrados 
 public function listarDetGastos($gastosID) {
    $query =  $this->db->select("encg.establecimientoID, encg.fecha,   deg.*")   
              ->join('gastosOperativos encg','encg.gastosID = deg.gastosID','inner')
              ->where('encg.cerrado',0)
              ->where('deg.gastosID',$gastosID)
             ->get("det_gastostmp deg")
             ->result();
    return  $query;          
}
 # funcion selecciona detalle por id
 public function editDetGastos($detgastosID) {
    $query =  $this->db->select("deg.*")   
              //->join('gastosOperativos encg','encg.gastosID = deg.gastosID','inner')
              //->where('encg.cerrado',0)
              ->where('deg.detgastosID',$detgastosID)
             ->get("det_gastos deg")
             ->result();
    return  $query;          
} 

 # funcion para eliminar detalle de gastos
 public function delDetGasto($detgastosID) {
    //echo 'el id a eliminar es' .$detgastosID;
    $this->db->where("detgastosID",$detgastosID)         
             ->delete("det_gastos");                 
    return  $this->db->affected_rows();          
}
// segmento para mostra la lista generarl de  gastos  
public function ListGastos() {
    $query =  $this->db->select("gt.gastosID , date_format( gt.fecha, '%Y-%m-%d') as fecha ,  estemp.estNombre, sum(coalesce(gt.unidades,0))as unidades, sum(coalesce(gt.total,0)) total, gt.cerrado")   
              ->join('establecimientoempresa estemp','gt.establecimientoID =  estemp.establecimientoID','inner')
              //->where('encg.cerrado',0)
              //->where('deg.detgastosID',$detgastosID)
              ->group_by('gt.gastosID')
              ->order_by('gt.gastosID', 'DESC')
              ->limit(5)
             ->get("gastosoperativos gt")
             
             ->result();
    return  $query;          
} 
// funcion  para  buscar gatos por fecha y  establecimietno


public function searchGasto($fecha) {
  //  echo 'en el modelo la fecha capturada es' . $fecha .  'el id del stablecimiento es ' . $_SESSION["establecimientoID"] . ' $$$' ; 
    $query =  $this->db->select("*")
              ->where('gt.establecimientoID',$_SESSION["establecimientoID"] )
              ->where('date_format(gt.fecha,"%Y-%m-%d")',$fecha)
              ->where('gt.cerrado',0)
             ->get("gastosoperativos gt")
             
             ->result();
    return  $query;          
} 
//  funcion para  habilitar  cabecera de gasto  
public function habilitarCabeceraGasto($gastosID){
        $this->db->set("cerrado",0)
                 ->where("gastosID", $gastosID)
                 ->update("gastosoperativos");
        return $this->db->affected_rows();   
    
} 



}