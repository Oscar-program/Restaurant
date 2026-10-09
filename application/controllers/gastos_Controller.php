<?php
defined('BASEPATH') or  exit('No direct script access allowed');
class gastos_Controller extends CI_Controller{
    public function __construct(){
        parent:: __construct();
        $this->load->database();
        $this->load->model('bodegaProducto_Model');
        $this->load->model('gastos_Model');
        $this->load->helper('path');
    }

    //  funcion para mostrar la cabecera de los gastos
    public function  iniciargastos(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);  
        $datos["listaSucursales"] =   $this->bodegaProducto_Model->get_Sucursales();         
        $this->load->view("gastos/ingresaGastos", $datos); 
    } 
    public function  guardarGastos(){
    // funcion para almacenar la cabecera de los  gatos 
   // echo  'GUARDANDO LA CABECESRA DE LOS  GASTOS';
	$cerrado            = ($_POST['cerrado']>0)? $_POST['cerrado'] : 0;
    $gastosID           = ($_POST['gastosID']>0)? $_POST['gastosID'] : null;
    $establecimientoID  = (isset($_POST['sucursalGasto']))? $_POST['sucursalGasto'] : null;
    $fecha              = (isset($_POST['fechaGasto']))? $_POST['fechaGasto'] : null;
    $data = array('establecimientoID'=>$establecimientoID, 'fecha'=>$fecha );
    //var_dump($data);
    //echo  'el valor de cerrado es '. $cerrado  . '<br>';
    if($gastosID == null){
        $gastosID = $this->gastos_Model->saveGastos($data, $gastosID);
        echo  $gastosID;
    }

    
 }
    // funcion ára mostrar la  vista para  ingresar el detalle de la compra 
    public function  addDetgasto(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        // echo  'llegando al controlador de la MEDIDA del producto';
        // $datos["indicadorExistenciaProd"] =   $this->inventProducto_Model->indicadorExistenciaProd();
        //var_dump($this->datos["datosMArcas"]);
        $this->load->view("gastos/detGastos"); 
        

    } 
    # funcion para almacernar el detalle de los gastos 
    public function saveDetGastos(){
       // echo 'llegando al segmento para almacenar el detalle de los gastos';
        $detgastosID  = ($_POST['detgastosID']>0)? $_POST['detgastosID'] : null ;
       // gastosIDdet     gastosIDdet   
       // contiene el id de la cabecera del gasto
        $gastosID     = (isset($_POST['gastosIDdet']))? $_POST['gastosIDdet'] : null ;      
        $descDetGasto = (isset($_POST['descripcionDetGast']))? $_POST['descripcionDetGast'] :"";
        $cantidad     = ($_POST['cantidadgasto']>0)? $_POST['cantidadgasto'] : 0  ;
        $precio       = ($_POST['preciogasto']>0)? $_POST['preciogasto'] : 0  ;
        $total        = ($_POST['totalDet']>0)? $_POST['totalDet'] : 0  ;
        $data =  array( 'gastosID'=>$gastosID,
                        'descDetGasto'=>$descDetGasto,
                        'cantidad'=>$cantidad,
                        'precio'=>$precio,
                        'total'=>$total,
                    );
       if($total>0  && strlen( $descDetGasto)>0 ){
       // echo   'almacenando el detalle';
       } else{
         // echo  'no se puede lamacenar detalle con  valor total  0';
       }   
       $this->gastos_Model->saveDetGastos($data, $detgastosID);
       $datos["listaDetGastos"] =   $this->gastos_Model->listarDetGastos($gastosID);        
       $this->load->view("gastos/detGastos",$datos); 
         

    }
    // funcion para  cerrar la cabecera de los gastos  

    public function  cerrarGastos(){
       // echo  'llegando al controlador para  cerrar los  gastos ';
         $gastosID           = ($_POST['gastosID']>0)? $_POST['gastosID'] : null;
         if($gastosID > 1){
         $totalesDetalle = $this->gastos_Model->gettotales($gastosID);
        
            if($totalesDetalle->cantidad>0){
                $data1 = array('unidades'=>$totalesDetalle->cantidad, 'total'=>$totalesDetalle->total , "cerrado"=>1 ); 
               // var_dump( $data);          
            }

           
            $result = $this->gastos_Model->saveGastos($data1, $gastosID);
            echo  $result;
        }
      
      
        
        
     }
     public function  editDetGastos(){        
          $detgastosID           = ($_POST['detgastosID']>0)? $_POST['detgastosID'] : null;
          if($detgastosID > 0){
             $detGasto = $this->gastos_Model->editDetGastos($detgastosID);             
             echo  json_encode($detGasto) ;
         }
      }

      // funcion para eliminar detalle de  gastos  
      public function delDetGasto($detgastosID, $gastosIDdet){
      //  $gastosID     = (isset($_POST['gastosIDdet']))? $_POST['gastosIDdet'] : null ; 

        if($detgastosID > 0){
          $this->gastos_Model->delDetGasto($detgastosID);             
         //  echo  json_encode($detGasto) ;
         $datos["listaDetGastos"] =   $this->gastos_Model->listarDetGastos($gastosIDdet);        
         $this->load->view("gastos/detGastos",$datos); 
       }else{
         echo 0 ;
       }
    

      }
     

     // lista general de gastos  
     // funcion para eliminar detalle de  gastos  
     public function ListGastos(){
        $datos["listaGastos"] =   $this->gastos_Model->ListGastos();        
        $this->load->view("gastos/cuerpoListaGastos",$datos); 
    

      } 
      // segmento para buscar  gasto abierto  por  fecha  
      public function searGastos(){
       // echo  'llegando al controlado';
         $fecha = (isset($_POST['fechaGasto']))? $_POST['fechaGasto']:null ;
         $datos =   $this->gastos_Model->searchGasto($fecha); 
        if(!empty( $datos )){
          echo  json_encode($datos);
        }else{
          echo  0;
        }  
       // var_dump($datos );     
       
          

      }
      //  funcion  para listar el  detalle de gastos 
      public function listarDetGastos($gastosID){
        $datos["listaDetGastos"] =   $this->gastos_Model->listarDetGastos($gastosID);        
        $this->load->view("gastos/detGastos",$datos);
      }

      // funcion par   recargar el cuerpo de los  gastos  


     


      // funcion para  habilitar una cabecera de  gastos  
      public function habilitarCabeceraGasto($gastosID){
           $this->gastos_Model->habilitarCabeceraGasto($gastosID);        
          //$this->load->view("gastos/detGastos",$datos);
      }
     


      

    


}