<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class InvDiario_Controller extends CI_Controller {  
    public function __construct()
    {
           parent::__construct();     
           $this->load->database();                  
           $this->load->model('InvDiario_Model');
		   $this->load->model('Turnos_Model');
		   $this->load->model('BodegaProducto_Model');


		   //Turnos_Model
		   //BodegaProducto_Model

           $this->load->helper('path');          
    }
  

	/*Funcion paramostrar la  vista para  agregar datos del   invetario manual */
	public function LoadViewInvDiario(){ 
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(E_ALL); 
		$this->load->view('inventarios/view_InventarioDiario');  

	}
   
     public function listarProductos(){
   
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(E_ALL);
	
	$data['listaProductos'] = $this->InvDiario_Model->get_ListProducto();
	$data['turnos']         = $this->Turnos_Model->get_listaTurnos();
	$data['bodegas']        = $this->BodegaProducto_Model->get_listBodegaProducto() ; // get_listBodegaProducto

	$this->load->view('inventarios/conteoFisico',$data);

	}

	public function SaveInventDiario(){
         //echo  'llegando al controlador SaveINvDiario';
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(E_ALL);
		


         $Id              = (isset($_POST['Id'])) ? $_POST['Id']: NULL;
        $TipoMov       = (isset($_POST['Tipomov'])) ? $_POST['Tipomov']: NULL;
        $IdProducto       = (isset($_POST['IdProducto'])) ? $_POST['IdProducto']: NULL;
		//echo "Id_enviado".$IdProducto."Id_enviado";
		
		
        $NombreProducto      = (isset($_POST['nProducto'])) ? $_POST['nProducto']: NULL; 
        $Fecha      = (isset($_POST['Fecha'])) ? $_POST['Fecha']: NULL;
        $Qty_Inv_Inicial       = (isset($_POST['invinicial'])) ? $_POST['invinicial']: NULL;
        $Qty_Inv_Final = (isset($_POST['invfinal'])) ? $_POST['invfinal']: NULL;
		//echo "Qty_Inv_Final".$Qty_Inv_Final."Qty_Inv_Final";
		$Qty_Conteo = (isset($_POST['conteo'])) ? $_POST['conteo']: NULL;

		$Refil      = (isset($_POST['Refil'])) ? $_POST['Refil']: NULL; 
        $Precio_Normal      = (isset($_POST['pnormal'])) ? $_POST['pnormal']: NULL;
        $Precio_Especial       = (isset($_POST['pespecial'])) ? $_POST['pespecial']: NULL;
        $Qty_Ventas_Normal = (isset($_POST['vnormal'])) ? $_POST['vnormal']: NULL;

		$Qty_Ventas_Especial      = (isset($_POST['vespecial'])) ? $_POST['vespecial']: NULL;
        $Total_Items_Vendidos       = (isset($_POST['totalv'])) ? $_POST['totalv']: NULL;
        $Total_Amt_Venta = (isset($_POST['totalamt'])) ? $_POST['totalamt']: NULL;

        $data = array('Id'=>$Id,
                          'TipoMov'=>$TipoMov,
                          'IdProducto'=>$IdProducto,
                          'NombreProducto'=>$NombreProducto,
                          'Fecha'=>$Fecha,
                          'Qty_Inv_Inicial'=>$Qty_Inv_Inicial,
                          'Qty_Inv_Final'=>$Qty_Inv_Final,
						  'Qty_Conteo'=>$Qty_Conteo,
                          'Refil'=>$Refil,
                          'Precio_Normal'=>$Precio_Normal,
						  'Precio_Especial'=>$Precio_Especial,
						  'Qty_Ventas_Normal'=>$Qty_Ventas_Normal,
						  'Qty_Ventas_Especial'=>$Qty_Ventas_Especial,
                          'Total_Items_Vendidos'=>$Total_Items_Vendidos,
                          'Total_Amt_Venta'=>$Total_Amt_Venta
                        );
         var_dump($data);
        $this->InvDiario_Model->InsertInvDiario( $data ); 
    }


	public function BuscarInvDiario(){
		//echo  'llegando al controlador BuscarInvDiario';
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(E_ALL);
		
		$FechaB = (isset($_POST['FechaB'])) ? $_POST['FechaB']: NULL;
		$TipoMov = (isset($_POST['TipoMov'])) ? $_POST['TipoMov']: NULL;
		$Producto = (isset($_POST['Producto'])) ? $_POST['Producto']: NULL;
		
		
		$res['lista'] = $this->InvDiario_Model->BuscarInvDiario($FechaB,$TipoMov,$Producto);
		if(Empty($res['lista']))
		{
			echo 0;
		}
		else
		{
			$this->load->view('inventarios/detBuscar',$res);
		}
		//var_dump($res['lista']);
		//exit;
		
		
		//$this->load->view('inventarios/view_InventarioDiario/',$res);
		//return $res;
	  
	}

	public function listarInvdiarios(){
   
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(E_ALL);
			$data['ListaInvDiario'] = $this->InvDiario_Model->GetlistaInvdiarios();
			$this->load->view('inventarios/ViewInvDiarioResumen',$data);
	
		}
}
 

	


	

