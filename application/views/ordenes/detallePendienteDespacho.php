<?php  
?>
<!DOCTYPE html>
   <html lang="en">
   <head>
    

    <style>   
         
    </style>
 	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"></script> 


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
   </head>
   <body>
    <div class ="container-fluid">
        <div class="modal fade" id="DetallePendienteDespacho" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header text-center" style="text-align: center;">
                <h5 class="modal-title" id="exampleModalLabel" style="text-align: center;">             Detalle de la orden</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <table  class="table"  style=" border-width:0px; margin-top:1px;">
                    <thead style="background-color:chocolate; color:red;" >
                    <tr class="header-blue">
                        <th style="color:aliceblue;">Número</th>
                        <th style ="color:aliceblue;">Descripción</th>
                        <th style ="color:aliceblue;">Presentación</th>
                        <th style ="color:aliceblue;">Tipo</th>
                        <th style ="color:aliceblue;">Cantidad</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $c=1; 
                        if(isset($listaDespachoPendiente)){
                                if(!empty($listaDespachoPendiente)){
                                foreach($listaDespachoPendiente as  $row){ ?>                              
                                          <tr>
                                            <td data-label="Número"><?php echo $c; ?></td>
                                            <td data-label="Descripción"><?php  echo  $row->prodDescripcion; ?></td>
                                            <td data-label="Presentación"><?php  echo  $row->Presentacion; ?></td>
                                            <td data-label="Tipo"><?php  echo  $row->tipo; ?></td>
                                            <td data-label="Cantidad"><?php  echo  $row->catidad; ?></td>
                                          </tr>     
      
                
                                <?php 
                                $c =$c+1;
                                } ?>
                                <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
              </div>  
            </div>
         </div>
        </div>
    </div> 
   </body>
   </html>  