<style>
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}

/*para checknox  */
.switch-container{
    display:inline-flex;
    align-items:center;
    cursor:pointer;
    user-select:none;
    font-family:Arial, Helvetica, sans-serif;
    font-size:22px;
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

/* Botón */
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

/* Cuando está activado */
.switch-container input:checked + .slider{
    background:#0d6efd;
}

.switch-container input:checked + .slider::before{
    transform:translateX(20px);
}

.texto{
    margin-left:2px;
} 


</style>
<?php 
  
  $proveedorID     =  NULL;
  $clasfiscalID    = 0;
  $tipoContribID   = 0;
  $provDescripcion = "";
  $provContacto    = "";
  $emailProv       = "";
  $provTelefono    = "";

 

  if(isset($datoProveedor)){ 
    if(!empty($datoProveedor)){
      //echo 'setiendo datos del  proveedor';
      $proveedorID        = $datoProveedor->proveedorID;
      $clasfiscalID       = $datoProveedor->clasfiscalID;
      $tipoContribID      = $datoProveedor->tipoContribID;
      $provDescripcion    = $datoProveedor->provDescripcion;
      $provContacto       = $datoProveedor->provContacto;
      $emailProv          = $datoProveedor->emailProv;
      $provTelefono       = $datoProveedor->provTelefono;
     
    }

  }
  
  

  ?>
<div class="modal fade" id="addProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title text-center" id="exampleModalLabel">    Registrar Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  metod="POST"  id ="formAddProveedor" class="formAddProveedor" action="javascript:saveProveedor()">
        <input type="hidden"  id="proveedorID"      name="proveedorID"      value =  "<?php echo $proveedorID; ?>">
        <input type="hidden"  id="clasfiscalID"     name="clasfiscalID" value =  "<?php echo $clasfiscalID; ?>">
        <input type="hidden"  id="tipoContribID"    name="tipoContribID" value =  "<?php echo $tipoContribID;?>">
       


         <div class="form-group">
            <label for="message-text" class="col-form-label">Nombre </label>
            <input type="text" class="form-control text-left" id="provDescripcion" name="provDescripcion" value ="<?php echo $provDescripcion ?>  " required>
          </div>

           <div class="form-group">
            <label for="message-text" class="col-form-label">Contacto </label>
            <input type="text" class="form-control text-left" id="provContacto" name="provContacto" value ="<?php echo $provContacto ?>  " required>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">email </label>
            <input type="email" class="form-control text-left" id="emailProv" name="emailProv" value ="<?php echo $emailProv ?>  " >
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Telefono </label>
            <input type="text" class="form-control text-left" id="provTelefono" name="provTelefono" value ="<?php echo $provTelefono ?>  " required>
          </div>
         

          <div class="form-group">
            <select name="Contribuyente" id="Contribuyente"  class="form-control chosen" required > 
              <option value="0"> Seleccione tipo de contribuyente </option>               
                 <?php foreach ($datoTipoConribuyente as $row): ?>
                    <option value="<?php echo $row->tipoContribID; ?>">
                    <?php echo $row->tipoContribID . " - " .  $row->tipoContribuyente; ?>
                    </option>
                <?php endforeach ?>
            </select>
            
        </div>


        <div class="form-group">           
            <select name="clasFis" id="clasFis"  class="form-control chosen"  required> 
                 <option value="0"> Seleccione clasificacion  fiscal </option>                  
                 <?php foreach ($datoClasificacionFiscal as $row): ?>
                    <option value="<?php echo $row->clasfiscalID; ?>">
                    <?php echo $row->clasfiscalID . " - " .  $row->clasificacion; ?>
                    </option>
                <?php endforeach ?>
            </select>
            
        </div>

       

      <div class="modal-footer">
        <button  type="submit" class="btn btn-danger"> Enviar </button>
      </div>
          

        </form>
      </div>
      
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {

    $("#marca").select2({
        theme: 'bootstrap4',
        placeholder: "Select marca",
        allowClear: true,
        width: 'resolve',
    });
	
});
  </script>
