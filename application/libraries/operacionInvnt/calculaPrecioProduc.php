<?php
class calculaPrecioProduc{
   function  calculaPrecio($datos){
       //  cargamos la informacion del modelo que contiene los datos necfesarios para el calculo  
       // echo 'llegando a la clase para configurar  impuestos';
        $CI = & get_instance();
        $CI->load->model('ConfigImpuest_Model');
        $tipocomprobante_IMPUT = 0; // compra
        $tipocomprobante_IMPUTV = 0; // venta
        //echo 'llegando a la clase para configurar  impuestos';
        $datoconfigProducto =  $CI->ConfigImpuest_Model->get_InfoConfigProducto();
        //echo 'Retorno de datps de  configuracio ';

        //  capturamos los valores de configuracion para el calculo  
        $proceso                = $datos['proceso']; // 1-comnprea  2-venta 
        $provClasfiscalID       = $datos['provClasfiscalID']; // la clasificacion del proveedor gravado, excento o no sujeto 
        $provTipoContribID      = $datos['provTipoContribID']; // provedor pequeno, medianmo  y gran contribuyente
        $tipomovinvtId          = $datos['tipomovinvtId'];    // si el producto es gravado
        $presentacion_invId     = $datos['presentacion_invId']; // producto o sservicio 
        $cantidad               = $datos['cantidad']; //   catidad  cantidad * por unidades de la presentacion  
        $preCosto               = $datos['preCosto']; //  precio costo  
        $tipocomprobanteID      = $datos['tipocomprobante_INPUT']; 
        $ivaCalculado           = 0;
        $compNoSujeto           = 0;
        $compGravado            = 0;
        $compExcento            = 0;
        $compProdIva            = 0;
        $subtotal               = 0; // para los comprobantes de consumidor y productos gravados que se agrega el iva al total
        $sumagravadoiva         = 0;
        $total                  = 0;
        $gravadas               = False;
        $desglosaIva            = False;
        $nosujeto               = False;

        // capturamos los valores para el  iva  y la retension 
        $valoriva           = $datoconfigProducto->iva; 
        $valorRetension     = $datoconfigProducto->retension;
        // segmento detemina la forma de calcular 
        //echo  'datos capturados Tipo Com' . $tipocomprobanteID . 'Calsificacion provedor'. $provClasfiscalID . ' tipo mov en el inv'. $tipomovinvtId  . '<br>'; 
        if($tipocomprobanteID ==1 && $provClasfiscalID== 1 &&  $tipomovinvtId == 1){  // se desglosa el iva del producto          
            $gravadas      = True;
            $desglosaIva   = True;
        }else if($tipocomprobanteID ==2 && $provClasfiscalID== 1 &&  $tipomovinvtId == 1){// se agrega el  iva al total del producto
            $gravadas      = True;
        }else if( $tipocomprobanteID ==1 && $provClasfiscalID== 1 &&  $tipomovinvtId == 3){ // calculo para producto no sujeto
            $nosujeto = True;
        }else if( $tipocomprobanteID ==2 && $provClasfiscalID== 1 &&  $tipomovinvtId == 3){ // calculo para producto no sujeto
            $nosujeto = True;
        }/*else if($tipocomprobanteID ==1 && $provClasfiscalID== 1 &&  $tipomovinvtId == 2){ // calculo excento 
            $excento      = True;
        }else if( $tipocomprobanteID ==2 && $provClasfiscalID== 1 &&  $tipomovinvtId == 2){
            $excento      = True;
        }else if($tipocomprobanteID ==2 && $provClasfiscalID== 2 &&  $tipomovinvtId == 1){
            $gravadas      = True;
        }else if($tipocomprobanteID ==2 && $provClasfiscalID== 2 &&  $tipomovinvtId == 2){
            $excento      = True; 
            
        }else if($tipocomprobanteID ==2 && $provClasfiscalID== 2 &&  $tipomovinvtId == 2){
            $nosujeto = True;
        }*/

        // realizamos calculos sobre el item ingresado 
        if($gravadas      == True && $desglosaIva   == True){
                   
            $subtotal      = ($preCosto * $cantidad); 
            $ivaCalculado  = ($preCosto * $cantidad) *  $valoriva;   
            $compGravado   = ($preCosto *$cantidad );
            $total         =  $subtotal   +$ivaCalculado ;
          }
        if($gravadas      == True && $desglosaIva   == False){
            $subtotal      = ($preCosto * $cantidad); 
            $ivaCalculado  = ($preCosto * $cantidad) *  $valoriva;
            $sumagravadoiva= ($cantidad *  $preCosto ) + $ivaCalculado;
            $total         =  $subtotal   +$ivaCalculado ;
          

            //$subtotal      = $sumagravadoiva ;
        }
        if($nosujeto      == True && $desglosaIva   == False){
            $subtotal      = ($preCosto * $cantidad); 
            $compNoSujeto  = ($cantidad *  $preCosto );
            $total         =  ($cantidad *  $preCosto );
        }  
        // subtotal valor usado solamente para mostrar en  la gria que muestra los prodctos  ingresados       
        $dataResult = array('compGravado' =>$compGravado,
                            'compNoSujeto'=>$compNoSujeto,                            
                            'compExcento' =>$compExcento,
                            'compProdIva' =>$ivaCalculado,
                            'subtotal'   =>$subtotal,                           
                            'total'       =>$total                            
                        );
        return   json_encode($dataResult)   ;  

   }
}