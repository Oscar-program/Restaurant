<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
//var_dump($detalleOrden);

  if(isset($detalleOrden)){
      if(!empty($detalleOrden)){
        $c= 1;
        foreach($detalleOrden as  $row) :?>
        								<tr>
                       
                        <td data-label="Catidad"><?php  echo   $row->detcantidad; ?></td>
                        <td data-label="Descripcion"><?php  echo    mb_convert_case( $row->prodDescripcion, MB_CASE_LOWER, "UTF-8");?></td>
                        <td data-label="Total"><?php  echo   $row->dettotal; ?></td>
                                                    
                        <td class="text-right"> 
                              <a href='#' class="btn-edit"
                                 title="Editar detalle"
                                onclick="addVentaProducto(<?php echo $row->famProdID ;?>, <?php echo $row->productoID ;?>,  <?php echo $row->detPedID;?>, <?php echo "' $row->prodDescripcion '" ;?> ,  <?php echo $row->detprecioNormal ;?>,  <?php echo isset($row->prodctucocina) ? intval($row->prodctucocina) : 0 ;?>)">
                                <i class="fa fa-pencil" aria-hidden="true"></i> </a>

                                <a href='#' class="btn-eraser" 
                                 title="Eliminar venta"
                                onclick="anularDetOrden(<?php  echo   $row->detPedID; ?>);">
                                <i class="fa fa-trash" aria-hidden="true"></i> </a>

                        </td>
                        </tr> 
        

        <?php  $c+= 1; endforeach ?>
     <?php }
   
  }

 
?> 