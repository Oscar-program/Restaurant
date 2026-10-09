<?php  
defined('BASEPATH') or  exit('No direct script access allowed');
class AreasEstablecimiento_Controller extends CI_Controller{
    public function __construct(){
        parent:: __construct();
        $this->load->database();
        $this->load->model('AreasEstablecimiento_Model');
        $this->load->helper('path');
    }
     public function get_listAreasEstablecimiento($establecimientoID){
        $data['listAreasEstablecimiento'] = $this->AreasEstablecimiento_Model->get_listAreasEstablecimiento($establecimientoID);       
        $this->load->view('mesas/listaAreasEstablecimiento',$data);

     }

     /* funcion listar todas las areas con su establecimiento */
    public function  get_listAllAreas(){          
        $data['listAllAreas'] = $this->AreasEstablecimiento_Model->get_listAllAreas();
       // var_dump($data['listAllAreas']) ;
        $this->load->view('confEmpresa/detAreas',$data);
    }


    public function insertarAreaEstablecimiento(){
     $areaEstablecimientoID =  (isset($_REQUEST['areasEstablecimientoID'])   AND  strlen($_REQUEST['areasEstablecimientoID'])>0 )   ? $_REQUEST['areasEstablecimientoID']: NULL ;
     $establecimientoID     =  (isset($_REQUEST['SEstab'])       AND  strlen($_REQUEST['SEstab'])>0 )        ? $_REQUEST['SEstab']: '2' ;
     $area                  =  (isset($_REQUEST['Area'])                    AND  strlen($_REQUEST['Area'])>0 ) ? $_REQUEST['Area']: '' ;
     $data = array( 'areaEstablecimientoID' =>$areaEstablecimientoID,  
        'establecimientoID'=>$establecimientoID, 
                    'area'=>$area,  
                    );
                 //var_dump($data);
                 //exit ;

    $result= $this->AreasEstablecimiento_Model->insertarAreaEstablecimiento( $areaEstablecimientoID, $data);
    echo $result ;
    }

     // funcion para cargar la empresa que  se  quiere  modificar  
    public function get_AreaEstablecimientoPorID($areaEstablecimientoID) {
        //  $areaEstablecimientoID =  (isset($_REQUEST['areaEstablecimientoID'])   AND  strlen($_REQUEST['areaEstablecimientoID'])> 0 )   ? $_REQUEST['areaEstablecimientoID']: 0 ;
         $result= $this->AreasEstablecimiento_Model->get_AreaEstablecimientoPorID($areaEstablecimientoID);
         echo  json_encode($result);
    }

    /*Funcion para eliminar  una medida de  producto */
    public function delete_AreaEstablecimiento($areaEstablecimientoID) {
      //  $areaEstablecimientoID =  (isset($_REQUEST['areaEstablecimientoID'])   AND  strlen($_REQUEST['areaEstablecimientoID'])> 0 )   ? $_REQUEST['areaEstablecimientoID']: 0 ;
        $result= $this->AreasEstablecimiento_Model->delete_AreaEstablecimiento($areaEstablecimientoID);
        echo   $result ;     
    }

}