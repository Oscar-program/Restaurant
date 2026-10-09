<?php
  if(isset($listMesas)){
      if(!empty($listMesas)){
        $c= 1;
        foreach($listMesas as  $row) :?>
        			<tr>
                        <td><?php  echo   $c; ?></td>
                        <td><?php  echo   $row->area; ?></td>
                        <td><?php  echo   $row->mesa; ?></td> 
                         <td><?php  echo   $row->capacidad; ?></td>                                                                          
                        <td class="text-right">                        
                            <a href='#' class="btn-edit"
                                title="Editar Detalle"                             
                                onclick="get_MesaPorID(<?php  echo   $row->mesaID; ?>);">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            <a href='#' class="btn-eraser"
                                 title="Eliminar registro"
                                onclick="deleteMesa(<?php  echo  $row->mesaID; ?>);">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a> 
                        </td>
                    </tr> 
        <?php  $c+= 1; endforeach ?>
     <?php }
   
  }

 
?> 