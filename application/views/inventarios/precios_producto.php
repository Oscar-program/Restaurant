<?php
defined('BASEPATH') or exit('No direct script access allowed');
$famSel = isset($famProdID) ? $famProdID : 0 ;
?>
<style>
/*para checknox  */
.switch-container{
    display:inline-flex;
    align-items:center;
    cursor:pointer;
    user-select:none;
    font-family:Arial, Helvetica, sans-serif;
    font-size:12px;
    color:#444;
}

.switch-container input{
    display:none;
}

/* Fondo del switch */
.slider{
    position:relative;
    width:42px;
    height:22px;
    background:#d8d8d8;
    border-radius:30px;
    transition:.3s;
    margin-right:10px;
}

/* BotÃ³n */
.slider::before{
    content:"";
    position:absolute;
    width:16px;
    height:16px;
    left:3px;
    top:3px;
    background:#ffffff;
    border-radius:50%;
    box-shadow:0 1px 3px rgba(0,0,0,.35);
    transition:.3s;
}

/* Cuando estÃ¡ activado */
.switch-container input:checked + .slider{
    background:#0d6efd;
}

.switch-container input:checked + .slider::before{
    transform:translateX(20px);
}

.texto{
    margin-left:2px;
}

/*  columnas de precio  por  area  */
.colArea{
    background-color:#EBF5FB;
}
.lbPrecioArea{
    display:block;
    font-size:14px;
    color:#1B4F72;
    font-weight:bold;
    text-align:right;
}


</style>

<div class="container-fluid m-top">

    <!-- ============  DIV  DEL  FILTRO  ( no  se  recarga ) ============ -->
    <div id="filtroPreciosProducto" name="filtroPreciosProducto" class="row shadow-sm p-3 mb-3 bg-white rounded">
        <div class="col-md-4 col-12">
            <label for="famPrecios" class="col-form-label">Familia de producto:</label>
            <select name="famPrecios" id="famPrecios" class="form-control chosen"
                    onchange="cargarListaPrecios()">
                <option value="0"> TODAS LAS FAMILIAS </option>
                <?php if(isset($listFamiliaProducto)){
                        if(!empty($listFamiliaProducto)){
                            foreach($listFamiliaProducto as $row){ ?>
                            <option value="<?php echo $row->famProdID; ?>"
                                <?php echo ($famSel == $row->famProdID) ? 'selected' : '' ; ?>>
                                <?php echo strtoupper($row->famProdDescripcion); ?>
                            </option>
                <?php   }}} ?>
            </select>
        </div>
        <div class="col-md-8 col-12 text-center">
            <H2 style="color:#5DADE2">  PRECIOS PRODUCTOS </H2>
        </div>
    </div>

    <!-- ============  DIV  DE  LA  LISTA  ( este  es  el  unico  que  se  recarga  por  AJAX ) ============ -->
    <div id="listaPreciosProducto" name="listaPreciosProducto">
        <?php $this->load->view('inventarios/cuerpoPreciosProducto'); ?>
    </div>

</div>
