<div class="container-fluid m-top" style="background-color:white; border-radius:10px;">
        <div class="row" style="padding-top: 15px;">
            <div class="col-12 text-center">
                <H2 style="color:DodgerBlue;">   LISTA DE COMPRAS  REALIZADAS </H2>
            </div>
        </div>
<!-- </div> 

<div class="container-fluid m-top">-->
        <div class="row" >
            <div class="col-12 text-left" style="margin-left: -15px; margin-bottom:1px;">
            <button type="button" class="btn btn-primary  btn-md " data-toggle="tooltip" data-placement="bottom" data-title="Ingresar Compras " onclick="addCompraProducto()" ><i class="fa fa-plus" aria-hidden="true"></i> Agregar nueva compra</button>
            </div>
        </div>
        
</div>  
            
    <div class="container-fluid m-top" style="background-color: white; border-style:outset;border-color:skyblue">
        <br>
        <div class="row">
            <!-- <div class="col-1"></div>-->
            <div class="col-12">
                <div class="table-responsive">


                    <table id="tblFamiliaProd" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>FECHA</th>  
                                <th>PROVEEDOR</th>
                                <th>TIPO</th>
                                <th>COMP NUM</th>
                                <th>USUARIO</th>
                                <th>SUB TOTAL</th>
                                <th>IMPUESTO</th>
                                <th>TOTAL</th>                              
                                <th class="text-right">ACCIONES</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php  $c = 1;
                            
                            foreach ($listCompras as $row) :   ; 
                            ?>
                            <tr>

                                <td><?php echo $c ;?></td>
                                <td><?php echo $row->fecha; ?></td>
                                <td><?php echo $row->provDescripcion; ?></td>
                                <td><?php echo $row->comprobanteTipo; ?></td>
                                <td><?php echo $row->comprobantenum; ?></td>
                                <td><?php echo $row->usrNombre; ?></td>
                                <td><?php echo $row->compProdNoSujeto; ?></td>
                                <td><?php echo $row->compProdIva; ?></td>
                                <td><?php echo $row->compProdTotal; ?></td>                               
                                <td class="text-right">

                                    <a href='#' class="btn btn-primary btn-sm" style="margin:0px;  color:white;"
                                        data-title="detalle de compra"
                                        onclick="mostrar_venta();">
                                        <i class="fa fa-search" aria-hidden="true"></i> </a>

                                    
                                        
                                        <a href='#' class="btn btn-danger btn-sm"style="margin:0px; background-color:red; color:white;"
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
        <br>
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