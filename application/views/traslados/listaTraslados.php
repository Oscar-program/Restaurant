<div class="container-fluid m-top">
        <div class="row">
            <div class="col-9 text-left">
                <H2> ULTIMOS TRASLADOS  REALIZADOS </H2>
            </div>
            <div class="col-1 text-right">
            <button type="button" class="btn btn-danger  btn-lg rounded-circle" data-toggle="tooltip" data-placement="bottom" data-title="Agregar Traslados" onclick="addTrasladosProducto()"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>
            <div class="col-1 text-left">
            <button type="button" class="btn btn-info btn-lg rounded-circle" data-toggle="tooltip" data-placement="bottom" data-title="Registrar Traslados" onclick="addCompraProducto()"><i class="fa fa-file-text" aria-hidden="true"></i></button>
            </div>
            <div class="col-1 text-left">
            <button type="button" class="btn btn-success btn-lg rounded-circle" data-toggle="tooltip" data-placement="bottom" data-title="exportar a excel" onclick="exportTableToExcel('tblFamiliaProd')"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button>
            </div>


        </div>
</div> 

<div class="container-fluid m-top">
        <div class="row">
            <div class="col-12 text-center">
           
            </div>
            <div class="col-12 text-center">
           
            </div>

        </div>
</div>  
<br>              
    <div class="container-fluid m-top">
        <div class="row">
            <!-- <div class="col-1"></div>-->
            <div class="col-12">
                <div class="table-responsive">


                    <table id="tblFamiliaProd"  name  ='tblFamiliaProd'  class="table table-hover">
                        <thead>
                            <tr class="thead-secondary" style="background-color:dodgerblue; color:aliceblue;">
                                <th>#</th>
                                <th>TIPO MOVIMIENTO</th>  
                                <th>FECHA</th> 
                                <th>PRODUCTO</th>
                                <th>BODEGA ACTUAL</th>
                                <th>ENTRADA</th>
                                <th>SALIDA</th>
                                <th>PRECIO</th>
                                                      
                                <th class="text-right">ACCIONES</th>                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php  $c = 1;
                            
                            foreach ($listaTraslados as $row) :   ; 
                            ?>
                            <tr>

                                <td><?php echo $c ;?></td>
                                <td><?php echo $row->movtipo; ?></td>
                                <td><?php echo $row->kardfecha_transac; ?></td>
                                <td><?php echo $row->prodDescripcion; ?></td>
                                <td><?php echo $row->bodProdDescripcion; ?></td>
                                <td><?php echo $row->entrada; ?></td>
                                <td><?php echo $row->salida; ?></td>
                                <td><?php echo $row->precio_unit; ?></td>                                                           
                                <td class="text-right">

                                    <a href='#' class="btn btn-default btn-sm" style="margin:0px;  color:blue;"
                                        data-title="Modificar Movimiento"
                                        onclick="mostrar_venta();">
                                        <i class="fa fa-search" aria-hidden="true"></i> </a>

                                    
                                        
                                        <a href='#' class="btn btn-default btn-sm"style="margin:0px;"
                                        data-title="Reporte de compras"
                                        onclick="ver_modalsuccobro();">
                                        <i class="fa fa-file" aria-hidden="true"></i></a> 


                                          
    
                                       

                                   
                                        
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
       /* $('#tblFamiliaProd').DataTable({
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
        });*/
    });
    </script>