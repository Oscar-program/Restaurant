function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}

 /*funcion para mostrar la  lista de medida de los productos */
 function mostrarDetalleEquivalente(){
 //    console.log('MOSTRAR EL DETALLE DE LAS MEDIDAD');
  var url   =  base_url("index.php/equivalenteProducto_Controller/mostrarDetalleEquivalente/");
  $.get(url, function(data){
    $("#detEquivalentes").html(data);

  });
 }  
 function  saveEquivalenteProducto(){
    var formData;
    console.log('In presentacion  Producto');
    if(document.getElementById('FormSeventab')) {
      formData = new FormData($(".FormSeventab")[0]);
      console.log('formulario equivalente de  Producto');
    }else{
        console.log('no existe el formulario');
    }               
     url_destino = "index.php/equivalenteProducto_Controller/saveEquivalenteProducto/";
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
        mostrarDetalleEquivalente();
         $("#prouctoEquivalente").val(0);
         $("#prouctoEquivalente").change();
         $("#equivalente").val(0);
         $("#equivalente").change();
         $("#unidadequivalente").val(0);
      }
    });
  
  }

  /*funcion para  retornar la  marca seleccionada*/
  function  get_EquivalenteProductoID(prodPresentID){
    console.log('obtener la marca seleccionada');
    var url = base_url('index.php/equivalenteProducto_Controller/get_EquivalenteProductoID/' +prodPresentID);
    $.get(url, function (data) {
          // console.log(data);
           var datosMedida  =  JSON.parse(data);           
          $("#prouctoEquivalente").val(datosMedida[0].productoID);
          $("#equivalente").val(datosMedida[0].presProdID);
          $("#unidadequivalente").val(datosMedida[0].unidades); 
                   
      });  
  }
  
  /*Funcion para eliminar  un detallle de la  marca */
  function delete_EquivalenteProductoID(prodPresentID){
    swal({
      title: "Estas seguro de elimnar el  registro ?",
      text: "Este proceso eliminara el  registro de base  de  datos",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((Delete) => {
      if (Delete) {
                  var url = base_url(
                    "index.php/equivalenteProducto_Controller/delete_EquivalenteProductoID/" + prodPresentID
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
                      mostrarDetalleEquivalente();
                    }
  
                  });				
      } else {
        swal("Operacion  cancelada",{
          icon: "success",
        });
      }
    });
  }