function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
/*funcion para mostrar la  lista de medida de los productos */
 function mostrarDetalleMedProducto(){
    console.log('MOSTRAR EL DETALLE DE LAS MEDIDAD');
  var url   =  base_url("index.php/medidaProducto_Controller/mostrarDetalleMedProducto/");
  $.get(url, function(data){
    $("#detMedidad").html(data);

  });
 }  
 function  saveMedidaProducto(){
    var formData;
    console.log('In presentacion  Producto');
    if(document.getElementById('FormThreetab')) {
      formData = new FormData($(".FormThreetab")[0]);
      console.log('formulario Creado.......Presentacion Producto');
    }else{
        console.log('no existe el formulario');
    }               
     url_destino = "index.php/medidaProducto_Controller/saveMedidaProducto/";
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
        mostrarDetalleMedProducto();
        $("#txtmedProdID").val('');
        $("#txtmedida").val('');
      }
    });
  
  }

  /*funcion para  retornar la  marca seleccionada*/
  function  get_MedidadProductoID(medProdID){
    console.log('obtener la marca seleccionada');
    var url = base_url('index.php/medidaProducto_Controller/get_MedidadProductoID/' +medProdID);
    $.get(url, function (data) {
          // console.log(data);
           var datosMedida  =  JSON.parse(data);           
          $("#txtmedProdID").val(datosMedida[0].medProdID);
          $("#txtmedida").val(datosMedida[0].medProdDescripcion);
                   
      });  
  }
  
  /*Funcion para eliminar  un detallle de la  marca */
  function delete_MedidaProductoID(medProdID){
    swal({
      title: "Estas seguro de elimnar el  registro ?",
      text: "Este proceso eliminara el  registro de base  de  datos",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((Delete) => {
      if (Delete) {
                  var url = base_url(
                    "index.php/medidaProducto_Controller/delete_MedidaProductoID/" + medProdID
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
                      mostrarDetalleMedProducto();
                    }
  
                  });				
      } else {
        swal("Operacion  cancelada",{
          icon: "success",
        });
      }
    });
  }