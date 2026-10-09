<?php
class operacionesInvenatarios{
    function actualizarInventario($productoID, $movtipo,$bodegaOrigen, $bodegaDest ,$cantidad){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
       // echo 'llegando a la  funcion para  actualizar el  inventario';
        //exit  ;
        /*
            Tipos de  movimientos sobre  un inventario
            'COMP'   =======> copra de producto 
            "TRASL"  =======> traslado de producto  los traslados no generan movimiento en los inventarios, ya  que el producto sigue en el inventario solo se mueve de bodega
                   /// wn caso que se haga  un tralado y este sea en diferencte sucursal ese si genera  movimiento en los   inventarios  
            "VENT"   =======> venta de producto 
            "AJUST"  =======> ajuste de producto
            "DESPERD"  =======> Salida por desperdicio
        */

        $CI = & get_instance();
        $CI->load->model('inventProducto_Model');
        
        $invProdID         =  0;
        $entradaInvProd    =  0; 
        $salidaInvProd     =  0; 
        $existencia        =  0;  
        $newEntradaInvProd =  0; 
        $newSalidaInvProd  =  0; 
        $newExistencia     =  0;
        $result            =  0;
       
                if($movtipo == "COMP"){                 
                 // $existencia     +=  ($entradaInvProd -  $salidaInvProd ) ;  
                 $resulbInv = $CI->inventProducto_Model->get_productoIDInventarios($productoID,$bodegaDest);        
                 if(Empty($resulbInv)){
                     // indica que  se creara la  linea del   inventario 
                    // echo  'Se tiene que insertar el registro en el inventario or  compra' . '<br>';                  
                     $invProdID = NULL;
                 }else{
                     //echo  'se encontro el producto  y la bodega';
                     $invProdID      =  $resulbInv->invProdID;
                     $entradaInvProd =  $resulbInv->entradaInvProd; 
                     $salidaInvProd  =  $resulbInv->salidaInvProd; 
                     //$existencia     =  $resulbInv->existencia;   
                 }
                 $entradaInvProd += $cantidad; // capturamos el  valor de  entrada                   

                  $dataComp =array( 'productoID'       =>$productoID ,  
                                    'bodegaProductoID' =>$bodegaDest,  
                                    'entradaInvProd'   =>$entradaInvProd, 
                                    'salidaInvProd'    =>$salidaInvProd,
                                    'usuarioID'        =>$_SESSION["usuarioID"] ,                                    
                                  );
                $result =  $CI->inventProducto_Model->addProductoInvent($dataComp, $invProdID); 
               /* if(!empty($result)){
                     var_dump($result); 
                    } */              
                                  
                }else if($movtipo == "TRASL"){

                  #  hacemos la salida para la bodega
                  //echo   'se  esta ejecutando  un traslado'; 
                      $resulbInv = $CI->inventProducto_Model->get_productoIDInventarios($productoID,$bodegaOrigen);        
                      if(Empty($resulbInv)){
                          // indica que  se creara la  linea del   inventario 
                          echo  'Se tiene que insertar el registro en el inventario';
                       
                          $invProdID = NULL;
                      }else{
                        //echo  'se encontro el producto  y la bodega';
                         $invProdID      =  $resulbInv->invProdID;
                          $entradaInvProd =  $resulbInv->entradaInvProd; 
                          $salidaInvProd  =  $resulbInv->salidaInvProd; 
                          //$existencia     =  $resulbInv->existencia;   
                      } 

                       $salidaInvProd   += $cantidad; // capturamos el  valor de  entrada 
                      //$existencia      +=  ($entradaInvProd -  $salidaInvProd ) ;  

                      $dataTrasSal =array('productoID'       =>$productoID ,  
                                          'bodegaProductoID' =>$bodegaOrigen,                                         
                                          'entradaInvProd'   =>$entradaInvProd,
                                          'salidaInvProd'    =>$salidaInvProd,
                                          'usuarioID'        =>1,
                                          //'existenciaInvProd'=>$existencia , 
                                        );
                                        $CI->inventProducto_Model->addProductoInvent($dataTrasSal, $invProdID);

                  # fin de la salida para la bodega 

                  #  hacemos el ingreso  para la bodega 
                  //echo  "PROCESANDO LA  SALIDA DE LA BODEGA" . '<br>';
                  $resulbInv = $CI->inventProducto_Model->get_productoIDInventarios($productoID,$bodegaDest);        
                  if(Empty($resulbInv)){
                      // indica que  se creara la  linea del   inventario 
                     // echo  'Se tiene que insertar el registro en el inventario';
                   
                      $invProdID = NULL;
                  }else{
                    //echo  'eN LA saLIDA  se encontro el producto  y la bodega' . '<br>';
                     $invProdID      =  $resulbInv->invProdID;
                      $entradaInvProd =  $resulbInv->entradaInvProd; 
                      $salidaInvProd  =  $resulbInv->salidaInvProd; 
                      //$existencia     =  $resulbInv->existencia;   
                  } 
                     $entradaInvProd  += $cantidad; // capturamos el  valor de  entrada 
                    //$existencia     +=  ($entradaInvProd -  $salidaInvProd ) ;  

                    $dataTrasEnt =array( 'productoID'        =>$productoID ,  
                                          'bodegaProductoID' =>$bodegaDest,  
                                          'entradaInvProd'   =>$entradaInvProd , 
                                          'salidaInvProd'    =>$salidaInvProd,
                                          'usuarioID'        =>1,
                                          //'existenciaInvProd'=>$existencia , 
                                        );
                   // var_dump( $dataTrasEnt);                    
                                       $CI->inventProducto_Model->addProductoInvent($dataTrasEnt , $invProdID);

                  # fin del  ingreso  para la bodega 


                }else if($movtipo == "VENT"){
                  $resulbInv = $CI->inventProducto_Model->get_productoIDInventarios($productoID,$bodegaDest);        
                  if(Empty($resulbInv)){
                      // indica que  se creara la  linea del   inventario 
                     // echo  'Se tiene que insertar el registro en el inventario';
                   
                      $invProdID = NULL;
                  }else{
                    //echo  'eN LA saLIDA  se encontro el producto  y la bodega' . '<br>';
                     $invProdID      =  $resulbInv->invProdID;
                      $entradaInvProd =  $resulbInv->entradaInvProd; 
                      $salidaInvProd  =  $resulbInv->salidaInvProd; 
                      //$existencia     =  $resulbInv->existencia;   
                  } 
                  $salidaInvProd   += $cantidad; // capturamos el  valor de  entrada 

                  $dataVenta =array( 'productoID'        =>$productoID ,  
                                        'bodegaProductoID' =>$bodegaOrigen,  
                                        'entradaInvProd'   =>$entradaInvProd, 
                                        'salidaInvProd'    =>$salidaInvProd,
                                        'usuarioID'        =>1,
                                        //'existenciaInvProd'=>$existencia , 
                                    );
                 $CI->inventProducto_Model->addProductoInvent($dataVenta , $invProdID);      

                }else if($movtipo == "AJUST"){                 
                  $entradaInvProd += $cantidad; // capturamos el  valor de  entrada 
                  $existencia     +=  ($entradaInvProd -  $salidaInvProd ) ;  

                  $dataAjust =array( 'productoID'        =>$productoID ,  
                                      'bodegaProductoID' =>$bodegaOrigen,  
                                      'entradaInvProd'   =>$entradaInvProd + $cantidad, 
                                      'salidaInvProd'    =>$salidaInvProd,
                                      'usuarioID'        =>1,
                                      'existenciaInvProd'=>$existencia , 
                                   );


                }
       

       
           
                  
        return  $result ;
        // $CI->inventProducto_Model->addProductoInvent($data, $invProdID);
      


    }

}  
?>