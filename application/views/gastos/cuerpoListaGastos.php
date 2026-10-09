 
      <?php if(isset($listaGastos)){
        if(!empty($listaGastos)){
          $c= 1;
          foreach($listaGastos as  $row) :?>
                          <tr>

                          <td><?php  echo   $c; ?></td>
                          <td><?php  echo   $row->fecha; ?></td>                          
                          <td><?php  echo   $row->estNombre; ?></td>
                          <td><?php  echo   $row->unidades; ?></td>
                          <td><?php  echo   $row->total; ?></td>
                       
                                                      
                          <td class="text-right">
                            <?php if($row->cerrado== 0){?>

                              <a href='#' class="btn-edit" title="Gasto sin  cerrar"                             
                                  onclick="get_FamiliaProductoID(<?php  echo   $row->gastosID; ?>);">
                                  <i class="fa fa-unlock" aria-hidden="true"></i> </a>
                                  <?php } else {?>   
                                    <a href='#' class="btn-edit" title="Habilitar gasto"                             
                                  onclick="habilitarCabeceraGasto(<?php echo   $row->gastosID; ?>);">
                                  <i class="fa fa-key" aria-hidden="true"></i> </a>   
                                    <?php } ?> 
                                  <a href='#' class="btn-eraser" 
                                  title="Eliminar Gasto"
                                  onclick="delete_FamiliaProductoID(<?php  echo   $row->gastosID; ?>);">
                                  <i class="fa fa-trash" aria-hidden="true"></i> </a>                                    
                          </td>
                          </tr> 
          

          <?php  $c+= 1; endforeach ?>
      <?php }
    
    } ?>
      
      