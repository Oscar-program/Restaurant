<?php
// agregamos  librerias necesaria par la creacion del  pdf  
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL); 

 include getcwd(). "/application/libraries/fpdf/fpdf.php";
  $CI = & get_instance();
  $CI->load->model('ordenesPedido_Model');

 class CrearTicket{
  
  function ticketGeneral($mesaID)
  {
      // segmento para recorrer todas la odenes que tiene pendiente de cobro  

  }
  function tickOrden($ordenID){
        // recorremos la oden para  buscar  su detalle 
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $RVntaTotal =  $this->ordenesPedido_Model->get_TotalVenta($ordenID);
        $infoPedido =  $this->ordenesPedido_Model->infoPedido($ordenID) ;        
        $ordPAbono  =  $infoPedido->ordPAbono;
        $data       =  array( 'ordPcomentario'=> str_replace( "%20"," ",$ordPcomentario),
                          'ordPCantidadPrd'=> $RVntaTotal->cantProd, 
                          'ordPtotalcancelar'=>  round($RVntaTotal->ventatotal,2),
                          'ordPAbono'=>round($ordPAbono,2),                          
                        );

        $this->pdf = new FPDF('P', 'mm', array(82.1,297));
        $this->pdf->AddPage();
        $this->pdf->AliasNbPages();
        $this->pdf->SetTitle("Ticket");        
        $this->pdf->SetFont('Arial', 'B', 9);
        $archivo       = 'Ticket01';
        $id_sucursal   = 0;        
        $datos_fac     = $this->ordenesPedido_Model->get_datosticket($ordenPedidoID);        
        $datos         = $this->empresa_Model->get_datoEmpresa();  
        $Ntiquete      = 0; //Numero de tiquete
        $Datetime      = 0; //Fecha del ticket
        $Cajero        = 0; //Tipo de cajero
        $Ware          = 0; //Warehouse
        $wareouse      = 0; 
        $Ntiquete      = str_pad($datos_fac[0]->ordenPedidoID, 10, "0", STR_PAD_LEFT); //Numero de tiquete
        
       
        $this->pdf->SetFont('Arial', 'B', 6);       
        $this->pdf->Image(getcwd() .'/img/logoCentral.png', 25, 2, 20, 20);      
        $this->pdf->Ln(10);      
        $this->pdf->Cell(0, 4, 'NIT: '.utf8_decode($datos->empNit), 0, 0, 'C');
        $this->pdf->Ln();
        $this->pdf->Cell(0, 4, utf8_decode('GIRO:'), 0, 0, 'C');
        $this->pdf->Ln();
        $this->pdf->SetFont('Arial', 'B', 6);
        $this->pdf->MultiCell(0, 2,utf8_decode($datos->empGiro),  0, 'C',false);
        $this->pdf->Ln();

        
       // $this->pdf->Cell(0, 3, utf8_decode($datos->rango), 0, 0, 'C');
        //$this->pdf->Ln();
        $this->pdf->Cell(0, 4, utf8_decode('NUMERO DE TIQUETE: ') . str_pad($datos_fac[0]->ordenPedidoID, 10, "0", STR_PAD_LEFT), 0, 0, 'L');
        $this->pdf->Ln();

        $this->pdf->Cell(0, 4, date('d-m-Y h:i:s'), 0, 0, 'L');
        $this->pdf->Ln();

        $Cantidad   = 0; //CA 
        $Producto   = 0; //Nombre del producto
        $Preciouni  = 0; //Precio Unitario
        $Total      = 0; //Total
        $Tot        = 0; //Exento, No gravado, No sujeto, Cuentas ajenas 
        $TotalE     = 0;//exento
        $TotalA     = 0;//ajenas
        $TotalN     = 0;//no sujeto
        $TotalG     = 0;//gravado
        $TotalF     = 0;//Total a pagar


        $this->pdf->SetX(10);
        $this->pdf->SetFont('Arial', 'B', 6);
        $this->pdf->Cell(4, 4, "CA", 'B', 0, 'C');
        $this->pdf->Cell(39, 4, "PRODUCTO", 'B', 0, 'C');
        $this->pdf->Cell(11, 4, "P/U", 'B', 0, 'C');
        $this->pdf->Cell(15, 4, "TOTAL", 'B', 0, 'C');
        $this->pdf->Ln(8);
     
          foreach ($datos_fac as $key=> $datos_fac) {
               $this->pdf->SetFont('Arial', '', 5);
             
             if ($datos_fac->detcantidad > 0  ) {
                 $this->pdf->SetX(10);
                 $this->pdf->Cell(4, 6, number_format($datos_fac->detcantidad,0),  0, 0, 'C');//CA
                $this->pdf->Cell(34, 6, str_replace('STAr', '',$datos_fac->prodDescripcion), 0, 0, 'L');//Producto
                $this->pdf->Cell(13, 6, '$' .number_format($datos_fac->preciounit,2), 0, 0, 'R');//P/U
                $this->pdf->Cell(8, 6,  '$' .number_format($datos_fac->dettotal,2), 0, 0, 'R');//Total P/U
                $this->pdf->Cell(4, 6, 'N', 0, 0, 'C');//Exento, No gravado, No sujeto, Cuentas ajenas
                $this->pdf->Ln(8);
                $TotalN += $datos_fac->dettotal;
             }
             
             //$TotalF = $TotalE + $TotalG + $TotalA + $TotalN;

         }
  

      

        //  despues del  detalle de la venta 
        

         $this->pdf->SetFont('Arial', 'B', 6);
        $this->pdf->Cell(20, 6, "TOTAL A PAGAR:", 0, 0, 'L');
        $this->pdf->Cell(21, 6, "", 0, 0, 'L');
        $this->pdf->Cell(14, 6, '$' . number_format($TotalN,2), 0, 0, 'R'); //Total final
        $this->pdf->Ln();

        
        $tipoPago   = 'EFECTIVO'; //Efectivo,Tarjeta
        $recibido   = $TotalF;
        $cambio     = 0;
        $cliente    = 0;

        if ($cambio==0) {
            $cambio= '0.00';
        }
        

        $this->pdf->SetFont('Arial', 'B', 6);
        $this->pdf->Cell(0, 6, "TIPO DE PAGO: " . $tipoPago, 0, 0, 'L');//EFECTIVO,TAREJTA
        $this->pdf->Ln();
        $this->pdf->Cell(29, 6, "RECIBIDO: ", 0, 0, 'R');//CANTIDAD RECIBIDA EN EFECTIVO
        $this->pdf->Cell(11, 6, "", 0, 0, 'L');
        $this->pdf->Cell(14, 6, '$'.$recibido, 0, 0, 'L');
        $this->pdf->Ln();
        $this->pdf->Cell(29, 6, "CAMBIO: ", 0, 0, 'R'); //CAMBIO POR RECIBIDO
        $this->pdf->Cell(11, 6, "", 0, 0, 'L');
        $this->pdf->Cell(14, 6, '$'.$cambio, 0, 0, 'L');
        $this->pdf->Ln(10);
        $this->pdf->Cell(54, 6, "E=EXENTO, G=GRAVADO, N=NO SUJETO, A=CTA.AJENA", 'B', 0, 'C');
        $this->pdf->Ln(10);
        $this->pdf->SetFont('Times', 'B', 6); 
        $this->pdf->Ln();
        $this->pdf->Cell(0, 10, "DOCUMENTO: ", 'B', 0, 'L');
        $this->pdf->Ln();
        $this->pdf->Cell(0, 10, "NIT O DUI: ", 'B', 0, 'L');
        $this->pdf->Ln();
        $this->pdf->Cell(0, 10, "FIRMA: ", 'B', 'B', 'L');
        $this->pdf->Ln();     
        $this->pdf->Ln();
        $this->pdf->Cell(0, 4, utf8_decode('GRACIAS POR TU COMPRA'), 0, 0, 'C');     
        $impreso =  0;      
        if($impreso ==  1){
            $destino      = getcwd() . "/document/reimpresiones/";
            $desabsoluto  =  "document/reimpresiones/";

        }else{
            $destino      = getcwd() . "/document/tickets/";
            $desabsoluto  =  "document/tickets/";

        }       
        if (!is_dir($destino)) {
            mkdir($destino, 0777, true);
        }
        $nombre_archivo =  'Ticket'.date("Ymd",strtotime(date("Y-m-d"))).$Ntiquete.'.pdf';
        //echo  'el nombre generado es ' . $nombre_archivo ;
        // 'caja'           =>strval($datos->caja), 
        $this->pdf->Output("F", $destino . $nombre_archivo , true);
        $this->pdf->close();
        $datosretorno  = array('destino'        =>$desabsoluto, 
                               'nombre_archivo' =>$nombre_archivo,
                              
                               

        );
       
      //header('Content-type: appliation/json');*/
        echo $_SESSION["areasEstablecimientoID"] ;
       

  }


 }
 

?>