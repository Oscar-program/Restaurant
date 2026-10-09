<?php
  if(isset($listNivelusuario)){
      if(!empty($listNivelusuario)){
        $c= 1;
        foreach($listNivelusuario as  $row) :?>
        			<tr>
                        <td><?php  echo   $c; ?></td>
                        <td><?php  echo   $row->nivel; ?></td>
                                                                                               
                        <td class="text-right">                        
                            <a href='#' class="btn-edit"
                                title="Editar Detalle"                             
                                onclick="get_NivelUserID(<?php  echo   $row->nivelUsuarioID; ?>);">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            <a href='#' class="btn-eraser"
                                 title="Eliminar registro"
                                onclick="deleteNivelUser(<?php  echo  $row->nivelUsuarioID; ?>);">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a> 
                        </td>
                    </tr> 
        <?php  $c+= 1; endforeach ?>
     <?php }
   
  }

 
?> 