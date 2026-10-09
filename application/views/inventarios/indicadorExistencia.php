<div class="container-fluid m-top">
        <div class="row">
            <div class="col-12 text-center">
                <H2> Existencia productos </H2>
            </div>
        </div>
</div> 


<div class="container-fluid m-top">
    <div class="row">
        
        <div class="col-12">
            <div class="table-responsive">
                <input type="hidden" id="trasladoID" name="trasladoID">

                <table id="tblExistProd" class="table table-hover">
                    <thead>
                        <tr class="thead-secondary" style="background-color:dodgerblue; color:aliceblue;">                           
                            <th>PRODUCTO</th>                            
                            <th>BODEGA</th>                           
                            <th>EXISTENCIA</th>
                                             
                                                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($indicadorExistenciaProd)){
                            if(!empty($indicadorExistenciaProd)){
                                $c= 1;
                                foreach($indicadorExistenciaProd as  $row) :?>
                                 
                                    
                                     <?php 
                                     $minimo      =  0;
                                     $normal      =  10;
                                     $maximo      =  20;
                                     $existencia  = $row->existenciaInvProd; 
                                     ?>
                                    <tr>
                                 
                                        <td><?php echo strtoupper($row->prodDescripcion) ; ?></td>
                                        <td><?php echo strtoupper($row->bodProdDescripcion) ; ?> </td>

                                       
                                        <td class="text-left">
                                        <?php echo  $row->existenciaInvProd ; ?>
                                          <?php 
                                           if($existencia == $minimo){?> 
                                         
                                              <a href='#' class="btn btn-danger btn-sm" style="margin:0px;  color:white; border-radius: 20px"
                                                data-title="Procesar Traslado">   Comprar  </a>
                                                <?php }else if($existencia == $normal){ ?>
                                               <a href='#' class="btn btn-warning btn-sm" style="margin:0px;  color:white; border-radius: 20px"
                                            data-title="Procesar Traslado">Observar </a>
                                          

                                           <?php }else if( $existencia>$normal && $existencia<= $maximo){ ?>   
                                            <a href='#' class="btn btn-success btn-sm" style="margin:0px;  color:white; border-radius: 20px"
                                            data-title="Procesar Traslado">Maximo </a>
                                            <?php  }?>              
                                                
                                        </td>
                                        
                                    </tr>
                        
                       
                                       
                                <?php  $c =+1;      endforeach ?>
                        <?php }
                            } ?>
                    </tbody>
                </table>

            </div>
        </div>
        
    </div>
</div>
<script>
       
        
    $(document).ready(function() {
        $('#tblExistProd').DataTable({
            //para cambiar el lenguaje a español
            "paging":   false,
            "info":     false,
            "order":[[0, "asc" ]],
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                /*"oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },*/
                "sProcessing": "Procesando...",
            }
        });
    });
    </script>