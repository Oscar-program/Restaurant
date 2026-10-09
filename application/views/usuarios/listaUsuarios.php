<style>

   </style>
 <div class="container-fluid m-top">
        <div class="row">
            <div class="col-12 text-left">
                <H2> Usuarios </H2>
            </div>
        </div>
</div>

<div class="container-fluid m-top">
        <div class="row">
            <div class="col-4 text-start">
           <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Registra nuevo usuario de sistema" onclick="registerUser();"  style="background-color: #5DADE2 ;"> New <i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>
        </div>
</div>  
<br>              
<div class="container-fluid m-top">
    <div class="row">        
        <div class="col-12">
            <div class="contenedor-tabla">
                <div class ="tabla-responsive">
                   <table id="tblListaProd" class="tabla-estilo">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>USUARIO</th>
                            <th>LOGIN</th>
                            <th>PASWORD</th>
                            <th>REGISTRADO EN </th>
                            <th>NIVEL </th>
                          
                            <th class="text-right">ACCIONES</th>                                
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $c = 1;
                            $activo ='N';
                        foreach ($allUserSystem as $row) :   ; 
                        

                                                    
                        ?>
                        <tr>
                            <td><?php echo $c ;?></b></td>
                            <td><?php echo $row->usrNombre; ?></td>
                            <td><?php echo $row->usrLogin; ?></td>
                            <td><?php echo $row->usrPwd; ?></td>
                            <td><?php echo $row->empNombre; ?></td>
                            <td><?php echo $row->nivel; ?></td>                          
                            <td class="text-right">
                                <a href='#' class="btn btn-default btn-sm" style="margin:0px;    color: #5DADE2 ;"
                                    title="Consultar venta"
                                    onclick="get_UserID(<?php echo $row->usuarioID ;?>);" >
                                    <i class="fa fa-pencil" aria-hidden="true"></i></a>

                                    <a href='#' class="btn btn-default btn-sm"style="margin:0px;  color: #5DADE2 ;"
                                    title="Asignar sucursal de cobro"
                                    onclick="del_UserID(<?php echo $row->usuarioID ;?>);">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i></a>                                     
                            </td>
                        </tr>
                        <?php  $c +=1; 
                        endforeach ?>
                    </tbody>
                   </table>
                </div>
            </div>
        </div>        
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
        $('#tblListaProd').DataTable({
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