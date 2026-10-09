<?php  
defined('BASEPATH') or  exit('No direct script access allowed');
class mesa_Controller extends CI_Controller{
    public function __construct(){
        parent:: __construct();
        $this->load->database();
        $this->load->model('mesas_Model');
        $this->load->helper('path');
    }
    //   funcion para  mostrar las mesas en el menu  principal   para que se le   pueda  agregar  una  o  varias  ordenes
     public function listarMesas($areasEstablecimientoID){
         
        //ECHO "LISTANDO LAS AREAS DE LA MESA  PARA EL ESTABLECIMIENTO " . $areasEstablecimientoID  . "<br>" ;
        $areasEstablecimientoID  = str_replace("%20", "", $areasEstablecimientoID ) ;
        //ECHO "LnuevoESTABLECIMIENTO " . $areasEstablecimientoID  . "<br>" ;

        $_SESSION["areasEstablecimientoID"]       = $areasEstablecimientoID ; 
        $data['listaMesas'] = $this->mesas_Model->get_listmesas( $areasEstablecimientoID);      
        $this->load->view('mesas/listaMesas',$data);
     }
     // funcion  que lista las mesas que tiene ordenes pendientes de cobro
     public function listaMesasPendienteCobro(){
         $data['listaMesasPendientesCobro'] = $this->mesas_Model->listaMesasPendienteCobro();       
        $this->load->view('ordenes/ordenesPendientes',$data);

     }


    public function registraNewMesa(){  
        $mesaID                = (isset($_REQUEST['mesaID'])           AND  strlen($_REQUEST['mesaID'])> 0 )        ? $_REQUEST['mesaID']           : NULL;
        $establecimientoID     = (isset($_REQUEST['SEstablecimiento']) AND  $_REQUEST['SEstablecimiento'] !=0 )     ? $_REQUEST['SEstablecimiento'] : NULL;
        $areaEstablecimientoID = (isset($_REQUEST['SArea'])            AND  $_REQUEST['SArea'] !=0 )                ? $_REQUEST['SArea']            : '' ;
        $mesNombre             = (isset($_REQUEST['txtmesa'])          AND  strlen($_REQUEST['txtmesa'])>0 )        ? $_REQUEST['txtmesa']          : '' ;
        $mescapacidad          = (isset($_REQUEST['txtcapacidad'])     AND  strlen($_REQUEST['txtcapacidad'])>0 )   ? $_REQUEST['txtcapacidad']     : '' ;
        $data                  = array( 'mesaID'=>$mesaID,
                                        'establecimientoID'=>$establecimientoID,
                                        'areaEstablecimientoID'=>$areaEstablecimientoID,
                                        'mesNombre'=>$mesNombre,
                                        'mescapacidad'=>$mescapacidad                
                                    );
        $result                = $this->mesas_Model->insertarMesaEstablecimiento($data, $mesaID);
        echo  $result ;
    }

    public function  listarMesasArea(){
        $data['listMesas'] = $this->mesas_Model->get_listAllmesas();      
        $this->load->view('confEmpresa/detMesas',$data);
    }

    public function  get_MesaPorID($mesaID){
        $datosMesa = $this->mesas_Model->get_MesaPorID($mesaID);
        echo  json_encode($datosMesa) ;


    }
    public function delete_Mesa($mesaID){
         $datos = $this->mesas_Model->delete_Mesa($mesaID);
        echo $datos ;

    }

    // funcion lista las mesas  utilizadas   y  disponibles para proceder con cambios de mesa  
    public function listasMesasIntercambiar(){
        $datos["MesasUtilizadas"]  = $this->mesas_Model->get_listMesasConOrdenes();
        $datos["MesasDisponibles"] =  $this->mesas_Model->get_listMesasDisponibles();
        $this->load->view('mesas/trasladarOrdenes',$datos);
       
    }
    public function ProcesarTraslado(){
    
     $mesaRemplar = $_REQUEST['mesaRemplar'];
     $nuevaMesa   = $_REQUEST['nuevaMesa'];
     $result = $this->mesas_Model->ProcesarTraslado($mesaRemplar, $nuevaMesa);
     //  echo $result ;
    }


     


}