<?php
  if(isset($listAllAreas)){
      if(!empty($listAllAreas)){
        $c= 1;
        foreach($listAllAreas as  $row) :?>
        			<tr>
                        <td><?php  echo   $c; ?></td>
                        <td><?php  echo  $row->Establecimiento;  ?></td>
                        <td><?php  echo  $row->area;  ?></td>                                                                          
                        <td class="text-right">                        
                            <a href='#' class="btn-edit"
                                title="Editar Detalle"                             
                                onclick="obtenerAreaporId(<?php echo   $row->areaEstablecimientoID; ?>);">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            <a href='#' class="btn-eraser"
                                 title="Eliminar registro"
                                onclick="deleteAreaEstablecimiento(<?php echo $row->areaEstablecimientoID; ?>);">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a> 
                        </td>
                    </tr> 
        <?php  $c+= 1; endforeach ?>
     <?php }
   
  }

 
?> 