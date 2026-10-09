<?php
  if(isset($listaResumen)){
      if(!empty($listaResumen)){
        $c = 1;
        foreach($listaResumen as  $row) :?>
                <tr style="font-size: 12px; border:1px; border-color:cornflowerblue;">
                        <td><?php  echo   $c; ?></td>
                        <td><?php  echo   $row->prodDescripcion; ?></td>
                        <td><?php  echo   $row->inicial; ?></td>
                        <td><?php  echo   $row->refil; ?></td>
                        <td><?php  echo   $row->final; ?></td>
                        <td><?php  echo   $row->averia; ?></td>
                        <td><?php  echo   $row->consumo; ?></td>
                        <td style="font-weight:bold; color:#2874A6;"><?php  echo  ($row->existencia_actual === null) ? 0 : $row->existencia_actual; ?></td>
                </tr>
        <?php  $c += 1; endforeach ?>
     <?php } else{
       echo  "<tr><td colspan='8' style='text-align:center; color:cornflowerblue;'> No se encontraron datos </td></tr>";
     }
  }
?>
