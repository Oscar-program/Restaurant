<script>

$('#DeGastos').stacktable();
</script>
<table id="DeGastos" class="table table-hover" style="border-width: 0px;" >
                                        <thead>
                                            <tr>
                                                <th>#</th> 
                                                <th>Descripcion</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Total</th>
                                                <th>Accciones</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
<?php if(isset($listaDetGastos)){
      if(!empty($listaDetGastos)){
        $c= 1;
        foreach($listaDetGastos as  $row) :?>
        								<tr>

                        <td><?php  echo   $c; ?></td>
                       <!-- <td><?php  //echo   $row->establecimientoID; ?></td>
                        <td><?php    //echo   $row->fecha; ?></td> -->
                        <td><?php  echo   $row->descDetGasto; ?></td>
                        <td><?php  echo   $row->cantidad; ?></td>
                        <td><?php  echo   $row->precio; ?></td>
                        <td><?php  echo   $row->total; ?></td>
                     
                                                    
                        <td class="text-right">

                            <a href='#' class="btn-edit"
                            title="Editar Detalle"                             
                                onclick="editDetGastos(<?php  echo   $row->detgastosID; ?>);">
                                <i class="fa fa-pencil" aria-hidden="true"></i> </a>

                            
                                
                        


                                <a href='#' class="btn-eraser" 
                                 title="Eliminar registro"
                                onclick="delDetGasto(<?php  echo   $row->detgastosID; ?>);">
                                <i class="fa fa-trash" aria-hidden="true"></i> </a>    

                            


                                
                        </td>
                        </tr> 
        

        <?php  $c+= 1; endforeach ?>
     <?php }
   
  } ?>
       </tbody>  
       </table>