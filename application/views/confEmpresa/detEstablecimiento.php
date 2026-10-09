<?php
  if(isset($datosEstablecimiento)){
      if(!empty($datosEstablecimiento)){
        $c= 1;
        foreach($datosEstablecimiento as  $row) :?>
        			<tr>
                        <td><?php  echo   $c; ?></td>
                        <td><?php  echo   $row->estNombre; ?></td>
                        <td><?php  echo   $row->estDireccion; ?></td>
                        <td><?php  echo   $row->estTelefono; ?></td>
                        <td><?php  echo   $row->empresa; ?></td>                                                    
                        <td class="text-right">                        
                            <a href='#' class="btn-edit"
                                title="Editar Detalle"                             
                                onclick="get_EstablecimientoPorID(<?php  echo   $row->establecimientoID; ?>);">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            <a href='#' class="btn-eraser"
                                 title="Eliminar registro"
                                onclick="deleteEstablecimiento(<?php  echo   $row->establecimientoID; ?>);">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a> 
                        </td>
                    </tr> 
        <?php  $c+= 1; endforeach ?>
     <?php }
   
  }

 
?> 