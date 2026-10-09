
<div class="modal fade" id="ResumenOrden" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
            <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLabel">    Resumen de productos  por mesa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                 <table id="tblResumenOdenes" class="tabla-estilo">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Descripcion</th>
                            <th>Cantidad</th>
                            <th>Prec. Unit</th>
                            <th>Total</th>                                                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($ResumenOrdenes)){
                            if(!empty($ResumenOrdenes)){
                                $c = 1;
                                foreach($ResumenOrdenes as  $row) :?>
                                        <tr style="font-size: 12px; border:1px; border-color:cornflowerblue;">
                                                <td><?php  echo   $c; ?></td>
                                                <td><?php  echo   $row->prodDescripcion; ?></td>
                                                <td><?php  echo   $row->cantidad; ?></td>
                                                <td><?php  echo   "$ ".$row->precioUnidad; ?></td>
                                                <td><?php  echo   "$ ".$row->total; ?></td>
                                                
                                                
                                        </tr>
                                <?php  $c += 1; endforeach ?>
                            <?php } else{
                            echo  "<tr><td colspan='5' style='text-align:center; color:cornflowerblue;'> No se encontraron datos </td></tr>";
                            }
                        }
                        ?>
                    <tbody>
                 </table>
            </div>
    </div>
  </div>
</div>