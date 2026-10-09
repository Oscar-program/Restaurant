<?php
  if(isset($datosEmpresa)){
      if(!empty($datosEmpresa)){
        $c= 1;
        foreach($datosEmpresa as  $row) :?>
        			<tr>
                        <td><?php  echo   $c; ?></td>
                        <td><?php  echo   $row->empNombre; ?></td>
                        <td><?php  echo   $row->empGiro; ?></td>
                        <td><?php  echo   $row->empNit; ?></td>
                        <td><?php  echo   $row->empNit; ?></td>                                                    
                        <td class="text-right">                        
                            <a href='#' class="btn-edit"
                                title="Editar Detalle"                             
                                onclick="get_EmpresaPorID(<?php  echo   $row->empresaID; ?>);">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            <a href='#' class="btn-eraser"
                                 title="Eliminar registro"
                                onclick="">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a> 
                        </td>
                    </tr> 
        <?php  $c+= 1; endforeach ?>
     <?php }
   
  }

 
?> 
