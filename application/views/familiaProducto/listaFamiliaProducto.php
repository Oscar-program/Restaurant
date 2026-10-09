<div class="container-fluid m-top">
        <div class="row">
            <div class="col-12 text-left">
                <H2>  LISTA DE FAMILIA DE PRODUCTOS </H2>
            </div>
        </div>
</div> 

<div class="container-fluid m-top">
        <div class="row">
            <div class="col-12 text-center">
            <button type="button" class="btn btn-danger rounded-circle" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>
        </div>
</div>  
<br>              
    <div class="container-fluid m-top">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="table-responsive">


                    <table id="tblFamiliaProd" class="table table-hover">
                        <thead>
                            <tr class="thead-dark">
                                <th>#</th>
                                <th>NOMBRE DE FAMILIA</th>
                                <th>ACTIVO</th>
                                <th class="text-right">ACCIONES</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php  $c = 1;
                             $activo ='N';
                            foreach ($listFamiliaProducto as $row) :   ; 
                            if($row->famProdStatus == 1){
                                $activo ='S';
                            }

                                                      
                            ?>
                            <tr>

                                <td><?php echo $c ;?></td>
                                <td><?php echo $row->famProdDescripcion; ?></td>
                                <td><?php echo  $activo ?></td>                               
                                <td class="text-right">

                                    <a href='#' class="btn btn-default btn-sm" style="margin:0px;  color:blue;"
                                        title="Consultar venta"
                                        onclick="mostrar_venta();">
                                        <i class="fa fa-search" aria-hidden="true"></i> </a>

                                    
                                        
                                        <a href='#' class="btn btn-default btn-sm"style="margin:0px;"
                                        title="Asignar sucursal de cobro"
                                        onclick="ver_modalsuccobro();">
                                        <i class="fa fa-eraser" aria-hidden="true"></i></a> 


                                        <a href='#' class="btn btn-default btn-sm" style="margin:0px;  color:red;"
                                        title="liberar guias procesadas"
                                        onclick="limpiar_datosGuias();">
                                        <i class="fa fa-eraser" aria-hidden="true"></i> </a>    
    
                                       

                                   
                                        
                                </td>
                            </tr>
                            <?php  $c +=1; 
                            endforeach ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="col-1"></div>
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