<div class="container-fluid m-top">
        <div class="row">
            <div class="col-12 text-center  bg-white rounded">
                <H3>  ORDENES PENDIENTES DE COBRO </H3>
            </div>
        </div>
</div> 

              
    <div class="container-fluid m-top shadow-sm p-3 mb-5 bg-white rounded">
        <div class="row">
            <!-- <div class="col-1"> secondary</div>-->
            <div class="col-12">
                <div class="table-responsive">


                    <table id="tblFamiliaProd" class="table table-hover">
                        <thead>
                            <tr class="thead-secondary" style="background-color:dodgerblue; color:aliceblue;">
                                <th>#</th>
                                <th>MESA</th>
                                <th>ORDEN #</th>
                                <th>FECHA</th>  
                                <th>MESERO</th>
                                <th>PENDIENTE DE COBRO</th>                                                          
                                <th class="text-right">ACCIONES</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php  $c = 1;
                              $ordPpenditeCobro="No";
                            foreach ($OrdenesPendientesCobro as $row) :   ;
                           
                              $ordPpenditeCobro="No"; 
                            if($row->ordPpenditeCobro==1){
                                $ordPpenditeCobro="SI";
                            }
                            ?>
                            <tr>

                                <td><?php echo $c ;?></td>
                                <td><?php echo $row->mesNombre; ?></td>                                
                                <td><?php echo $row->ordenPedidoID; ?></td>
                                <td><?php echo $row->ordPFecha; ?></td>
                                <td><?php echo $row->meserNombre; ?></td>
                                <td><?php echo $ordPpenditeCobro; ?></td>
                                                           
                                <td class="text-right">

                                    <a href='#' class="btn btn-default btn-sm" style="margin:0px;  color:blue; font-weight:bold;"
                                        data-title="detalle de compra"
                                        onclick="ver_ordenePedido( <?php echo $row->ordenPedidoID ?>);">
                                        <i class="fa fa-eye" aria-hidden="true"></i> </a>

                                    
                                        
                                        <a href='#' class="btn btn-default btn-sm"  style="margin:0px;  color:red; font-weight:bold;"
                                        data-title="Reporte de compras"
                                        onclick="anularOrden();">
                                        <i class="fa fa-trash" aria-hidden="true"></i></a> 


                                          
    
                                       

                                   
                                        
                                </td>
                            </tr>
                            <?php  $c +=1; 
                            endforeach ?>
                        </tbody>
                    </table>

                </div>
            </div>
           <!-- <div class="col-1"></div>-->
        </div>
    </div>

    <script>
          $(document).ready(function() 
        {
            $("#clientes").select2({
            theme: 'bootstrap4',
            placeholder: "Select Cliente",
            width: 'resolve',
            "searching"    : true,
            });
        });
        
    $(document).ready(function() {
        $('#tblFamiliaProd').DataTable({
            //para cambiar el lenguaje a español
            "order":[[0, "asc" ]],
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "sProcessing": "Procesando...",
            }
        });
    });
    </script>