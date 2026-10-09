<?php
defined('BASEPATH') or exit('No direct script access allowed');
//  LISTA  DE  PRODUCTOS  CON  SUS  PRECIOS  POR  AREA
//  Esta  vista  es  solo  el  cuerpo :  se  recarga  por  AJAX  cuando  cambia  el  select
//  de  familia  y  cuando  se  guarda  un  precio , sin  redibujar  el  filtro.
$areas  = (isset($listAreasEstablecimiento) && !empty($listAreasEstablecimiento)) ? $listAreasEstablecimiento : array();
$matriz = (isset($preciosArea) && !empty($preciosArea)) ? $preciosArea : array();
?>
<div class="contenedor-tabla">
    <div class="tabla-responsive">
        <input type="hidden" id="trasladoID" name="trasladoID">

        <table id="tblListaProd" class="tabla  tabla-estiloOrdn">
            <thead style="border-style: none !important;">
                <tr class="thead-dark" style="border-style: none !important;">
                    <th>#</th>
                    <th>NOMBRE DEL  PRODUCTO</th>
                    <?php foreach($areas as $area){ ?>
                        <th class="colArea"><?php echo  'PRECIO_'. strtoupper($area->area); ?></th>
                    <?php } ?>
                    <th>Disponible</th>
                    <th class="text-right">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($lista_productoCostear)){
                    if(!empty($lista_productoCostear)){
                        $c= 1;
                        foreach($lista_productoCostear as  $row) :?>

                            <tr>
                                <td data-label="#"><?php echo $c; ?> </td>
                                <td data-label="DescripciÃ³n" ><?php echo strtoupper($row->prodDescripcion) ; ?></td>

                                <?php
                                //  se dibuja  una  columna  por  cada  area , el  precio  vigente  se  muestra  arriba  de  la  caja  de  texto
                                foreach($areas as $area){
                                    $idCtrl       = 'precioArea' . $c . '_' . $area->areaEstablecimientoID ;
                                    $precioActual = isset($matriz[$row->productoID][$area->areaEstablecimientoID])
                                                    ? $matriz[$row->productoID][$area->areaEstablecimientoID]->precioventa
                                                    : $row->precioventa ;
                                ?>
                                    <td data-label="<?php echo 'PRECIO_'. strtoupper($area->area); ?>" class="colArea">
                                        <label class="lbPrecioArea"><?php echo '$ '. number_format($precioActual,2); ?></label>
                                        <input type="number"
                                               class="form-control text-right ctrlPrecioArea"
                                               id   ="<?php echo $idCtrl; ?>"
                                               name ="<?php echo $idCtrl; ?>"
                                               data-fila ="<?php echo $c; ?>"
                                               data-area ="<?php echo $area->areaEstablecimientoID; ?>"
                                               step="any">
                                    </td>
                                <?php } ?>

                                <td data-label="Disponible">
                                    <?php if($row->proddisponible ==  '1'){ ?>
                                        <label class="switch-container">
                                            <input type="checkbox" id="<?php echo 'proddisponible'  .  $c; ?>" checked>
                                            <span class="slider"></span>
                                        </label>
                                    <?php   }else { ?>
                                        <label class="switch-container">
                                            <input type="checkbox" id="<?php echo 'proddisponible'  .  $c; ?>"  >
                                            <span class="slider"></span>
                                        </label>
                                    <?php  } ?>
                                </td>

                                <td  data-label="Acciones" class="text-right">
                                    <a href='#' class="btn btn-info btn-sm" style="margin:0px;  color:white;  background-color: #5DADE2  !important ;"
                                        data-title="Actualizar precios por area"
                                        onclick="updatePrecProd(<?php echo $row->productoID; ?>, <?php echo $c; ?>)">
                                        <i class="fa fa-refresh" aria-hidden="true"></i> </a>
                                </td>

                            </tr>

                        <?php  $c +=1; endforeach ?>
                    <?php }else{ ?>
                        <tr>
                            <td colspan="<?php echo (4 + count($areas)); ?>" class="text-center">
                                No se encontraron productos para la familia seleccionada.
                            </td>
                        </tr>
                    <?php }
                    } ?>
            </tbody>
        </table>
    </div>
</div>
