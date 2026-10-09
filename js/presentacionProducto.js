function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}

/*funcion para almacenar la presentacion de los   productos */
function  savePresentacionProduc(){
    var formData;
    console.log('In presentacion  Producto');
    if(document.getElementById('FormTwotab')) {
      formData = new FormData($(".FormTwotab")[0]);
      console.log('formulario Creado.......Presentacion Producto');
    }else{
        console.log('no existe el formulario');
    }               
     url_destino = "index.php/presentacionProduct_Controller/savePresentacionProducto/";
     console.log('Despues  de la URL');
  
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
      //$("#codigoCliente").prop( "disabled", true);
        alertify.set("notifier", "position", "top-right");
        alertify.success("Registro guardo correctamente");
      },
      complete: function () {
        // Show image container
        $("#loader").css("display", "none");
        getDetalPresentacion();
        $("#presProdID").val('');
        $("#txtpresentacion").val('');
      }
    });
  
  }
  /*mostrar el  detalle de las marcas  */
  function getDetalPresentacion(){
      console.log("Mostrando la  presentacion de  los  productos");
      var url = base_url('index.php/presentacionProduct_Controller/mostrarDetallePresProducto/');
    
    //var url = base_url("index.php/BancosController/bancos");
        $.get(url, function (data) {
            $("#detPresentacion").html(data);
        });
    
  }
  /*funcion para  retornar la  marca seleccionada*/
  function  get_PresentacionProductoID(id){
    console.log('obtener la marca seleccionada');
    var url = base_url('index.php/presentacionProduct_Controller/get_PresentacionProductoID/' +id);
    $.get(url, function (data) {
          // console.log(data);
           var datosPresentacion  =  JSON.parse(data);           
           $("#presProdID").val(datosPresentacion[0].presProdID);
          $("#txtpresentacion").val(datosPresentacion[0].presProdDescripcion);
         
      });  
  }
  
  /*Funcion para eliminar  un detallle de la  marca */
  function  delete_PresentacionProductoID(presProdID){
    swal({
      title: "Estas seguro de elimnar el  registro ?",
      text: "Este proceso eliminara el  registro de base  de  datos",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((Delete) => {
      if (Delete) {
                  var url = base_url(
                    "index.php/presentacionProduct_Controller/delete_PresentacionProductoID/" + presProdID
                  );
                  $.get(url, function (data) {
                    if (data == 0) {
                          swal({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Surgio un error al  eliminar el  registro',														
                          });
                    } else if (data == 1) {
                      swal("Registro eliminado corectamente", {
                        icon: "success",
                      });
                      getDetalPresentacion();
                    }
  
                  });				
      } else {
        swal("Operacion  cancelada",{
          icon: "success",
        });
      }
    });
  }