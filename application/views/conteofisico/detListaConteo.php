<?php
  if(isset($listaConteo)){
      if(!empty($listaConteo)){
        $c = 1;
        foreach($listaConteo as  $row) :?>
                <tr style="font-size: 12px; border:1px; border-color:cornflowerblue;">
                        <td><?php  echo   $c; ?></td>
                        <td><?php  echo   $row->fecha; ?></td>
                        <td><?php  echo   $row->turnOperaDescripcion; ?></td>
                        <td><?php  echo   $row->tcierreant; ?></td>
                        <td><?php  echo   $row->refil; ?></td>
                        <td><?php  echo   $row->existenciaF; ?></td>
                        <td><?php  echo   $row->aberia; ?></td>
                        <td><?php  echo   $row->stockf; ?></td>
                        <td class="text-right" style="font-size: 18px; text-align:justify;">
                            <a href='#' style="margin-left: 10px;"
                               title="Cargar / editar conteo"
                               onclick="getDetConteo(<?php  echo   $row->conteoID; ?>);">
                                <i class="fa fa-pencil" aria-hidden="true"></i> </a>
                            <a href='#'  style="margin-left: 10px;"
                               title="Anular conteo"
                               onclick="anularConteo(<?php  echo   $row->conteoID; ?>);">
                                <i class="fa fa-trash" aria-hidden="true"></i> </a>
                        </td>
                </tr>
        <?php  $c += 1; endforeach ?>
     <?php } else{
       echo  "<tr><td colspan='9' style='text-align:center; color:cornflowerblue;'> No se encontraron datos </td></tr>";
     }
  }
?>
