<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  

    <script>

     $('#listDetGastos').stacktable();
</script>
   
</head>

<body>
<input type="text" placeholder="Ingresa algún parámetro..." class="form-control-md form-control" id="search" style="border-radius:20px;">
<br>
<div  class="row">
  <div class="col-lg-6">
  <table id="listDetGastos" class="table table-hover" style="border-width: 0px;" >
      <thead>
      <tr>
      <th>#</th>     
      <th>Sucursal</th>
            <th>Fecha</th>
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
                          <td><?php  echo   $row->establecimientoID; ?></td>
                          <td><?php  echo   $row->fecha; ?></td>
                          <td><?php  echo   $row->descDetGasto; ?></td>
                          <td><?php  echo   $row->cantidad; ?></td>
                          <td><?php  echo   $row->precio; ?></td>
                          <td><?php  echo   $row->total; ?></td>
                                                      
                          <td class="text-right">

                              <a href='#' class="btn-edit"
                              title="Editar Detalle"                             
                                  onclick="get_FamiliaProductoID(<?php  echo   $row->detgastosID; ?>);">
                                  <i class="fa fa-pencil" aria-hidden="true"></i> </a>

                              
                                  
                          


                                  <a href='#' class="btn-eraser" 
                                  title="Eliminar registro"
                                  onclick="delete_FamiliaProductoID(<?php  echo   $row->detgastosID; ?>);">
                                  <i class="fa fa-trash" aria-hidden="true"></i> </a>    

                              


                                  
                          </td>
                          </tr> 
          

          <?php  $c+= 1; endforeach ?>
      <?php }
    
    } ?>
      
      </tbody>  
  </table>
  </div>
  </div>   
  </body>
 
</html>
<script>
$(document).ready(function(){

$("#search").keyup(function(){

_this = this;



   /* $.each($("#websendeos tbody tr"), function() {

    if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)

    $(this).hide();

    else

    $(this).show();

    });*/

    /*$.each($("#websendeos tr th"), function() {

        if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)

        $(this).hide();

        else

        $(this).show();

        });*/


    });

});
    </script> 