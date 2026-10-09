<!--  border-style:outset;border-color:skyblue-->
   <div class="container-fluid m-top" style="background-color: white;">
        <br>
        <div class="row">
            <!-- <div class="col-1"></div>-->
            <div class="col-12">
                <div class="table-responsive">
                    <table id="tblFamiliaProd" class="table table-hover" style="border-width: 1px; border-color:#5DADE2 ;">
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
                             if(!empty($listCompras )){
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
                                        <a href='#' style="margin-left: 10px;"
                                         title="Editar Compra"                             
                                        onclick="updatecompras(<?php  echo   $row->compraProdID; ?>);">
                                        <i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                        
                                        <a href='#'  style="margin-left: 10px;" 
                                        title="Anular Compra"
                                        onclick="deletecompras(<?php  echo   $row->compraProdID; ?>);">
                                        <i class="fa fa-trash" aria-hidden="true"></i> </a>                                                 
                                        </td>
                                    </tr>
                                    <?php  $c +=1; 
                                endforeach ?>
                            <?php  } else{ ?>
                                <tr style="background-color:#EAF2F8;">
                                <td colspan="12" style="color:#3498DB; font-weight:bold;"><?php echo "NO SE ENCONTRARON DATOS" ;?></td>
                                
                            </tr>
                             <?php  } ?>                            
                        </tbody>
                    </table>

                </div>
            </div>
           <!-- <div class="col-1"></div>-->
        </div>
        <br>
    </div>