function base_url(url){
  return window.location.origin + "/BartioFran/"+ url;
}
// funcion para cargar el  menu inteno Categoria de productos isponible
function listarProveedores(){
    console.log('intentando cargar el  menu interno');
    var url = base_url('index.php/Proveedores_Controller/listaProveedores/'); 
      $.get(url, function (data) {
          $("#principal").html(data);
      });
  }

  /*funcion para cargar la modal para  registrar los productos */
function addProveedor(proveedorID){ 
    var valorid         = 0;  
    var clasfiscalID    = "";
    var tipoContrib   = "";
   

    console.log("se ha hecho  click"+ proveedorID  + " PROVEEDOR CA´TURADO");
    var url = base_url('index.php/Proveedores_Controller/addProveedor/' + proveedorID);
   
   
      $.get(url, function (data) {
        $("#vmodaladdProveedor").html(data);             
        $('#addProveedor').modal('show');

        if(document.getElementById('clasfiscalID')){
          clasfiscalID = $("#clasfiscalID").val();
        }
        if(document.getElementById('tipoContribID')){
          tipoContrib = $("#tipoContribID").val();
        }
        //console.log("el tipo contribuyente par actualizar ees" + parseInt(tipoContrib) + "###")
        
        $("#clasFis").val(clasfiscalID);
        $("#clasFis").change();  

       $("#Contribuyente").val(tipoContrib);
        $("#Contribuyente").trigger("change");

            
      });
   
   }
 /*Funcion para almacena El  producto */
 function saveProveedor(){
  var $productoID =  0;
  console.log('llegando a la  funcion para almacenar el proveedor');
  var formData;  
	url_destino = "index.php/Proveedores_Controller/saveProveedor/";
	formData    = new FormData($(".formAddProveedor")[0]);	
	$.ajax({
          url: base_url(url_destino),
          type: "POST",
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function () {
            // Show image container
            $("#loader").css("display", "block");
          },
          success: function (data) {
          
          },
          complete: function () {
            
            $("#loader").css("display", "none");
          //  $('#addProducto').close('show');
            //$('#addProducto').modal('hide');
            $("#addProducto.close").click();
			$(".modal-backdrop").remove();

            listarProveedores();
          }
        });	
 }

 function deleteProveedor(proveedorID){
    console.log("Eliminando el PROVEEDOR") ;
     var url = base_url('index.php/Proveedores_Controller/deleteProveedor/' + proveedorID);
   
    //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
        listarProveedores();

   });
  }
