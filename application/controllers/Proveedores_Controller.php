<?php  
defined('BASEPATH') or  exit('No direct script access allowed');
class Proveedores_Controller extends CI_Controller{
    public function __construct(){
        parent:: __construct();
        $this->load->database();
        $this->load->model('Proveedor_Model');
        $this->load->helper('path');
    }

     // funcion  retorna la lista completa de los proveedores  
     public function listaProveedores() {
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);  
        $data['listaProveedores'] = $this->Proveedor_Model->get_listaProveedores() ;
       //  var_dump($data['listaProveedores']) ;
        $this->load->view('proveedores/proveedores',$data);


     }


    // funcion sirve para cargar la ventana donde se ingresara los datos del proveedor 
      public function addProveedor($proveedorID){ 
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL); 
        $data['datoClasificacionFiscal']   = $this->Proveedor_Model->Listaclasificacionfiscal();
        $data['datoTipoConribuyente']      = $this->Proveedor_Model->Listatipocontribuyente();
        $data['datoProveedor']             = $this->Proveedor_Model->get_infoProveedor($proveedorID);
     //   var_dump(  $data['datoProveedor']   );

        $this->load->view('proveedores/addProveedor',$data);
     }




    // funcion para insertar el  proveedoor 
    public function saveProveedor(){
      //  capuramos los datos de los controles  
       $proveedorID     = (isset($_POST['proveedorID']))     ? $_POST['proveedorID']: NULL; 
       $clasfiscalID    = (isset($_POST['clasFis']))         ? $_POST['clasFis']: NULL;
       $tipoContribID   = (isset($_POST['Contribuyente']))      ? $_POST['Contribuyente']: NULL;
       $provDescripcion = (isset($_POST['provDescripcion'])) ? $_POST['provDescripcion']: NULL;
       $provContacto    = (isset($_POST['provContacto']))    ? $_POST['provContacto']: NULL; 
       $emailProv       = (isset($_POST['emailProv']))       ? $_POST['emailProv']: NULL; 
       $provTelefono    = (isset($_POST['provTelefono']))    ? $_POST['provTelefono']: NULL; 

       

      // echo "Los datos del proveedor es " .  $proveedorID   . "<br>" ;


         $data = array('clasfiscalID'=>$clasfiscalID,
                          'tipoContribID'=>$tipoContribID,
                          'provDescripcion'=>$provDescripcion,
                          'provContacto'=>$provContacto,
                          'emailProv'=>$emailProv,
                          'provTelefono'=>$provTelefono,
                          

                          
                        );
         //var_dump($data);
         //exit ;


         $result= $this->Proveedor_Model->addProveedor($data, $proveedorID) ;
         //return $result ;


    }

    //  funcion para ver los datos del proveedor 
     public function get_proveedorID($proveedorID){
         $result= $thisProveedor_Model->get_proveedorID($proveedorID);
         return $result ;
          

    }


    //  funcion para eliminar los datos del proveedor
     public function deleteProveedor($proveedorID){
         $result= $this->Proveedor_Model->deleteProveedor($proveedorID) ;
         return $result ;
          

    }


    



   


}
    ?>