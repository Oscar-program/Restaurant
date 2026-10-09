
function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
// funcion para cargar el  menu inteno Categoria de productos isponible  
function get_listPreciosEspProducto(){
    console.log('intentando cargar precios especiales');
    var url = base_url('index.php/preciosEpeciales_Controller/get_listPreciosEspProducto/');
      $.get(url, function (data) {
          $("#detPreciosEsp").html(data);
      });
  
  }
  function  addPreciosEspProducto(){
    var formData;
    console.log('In presentacion  Producto');
    if(document.getElementById('FormSixtab')) {
      formData = new FormData($(".FormSixtab")[0]);
      console.log('formulario Creado.......Presentacion Producto');
    }else{
        console.log('no existe el formulario');
    }               
     url_destino = "index.php/preciosEpeciales_Controller/addPreciosEspProducto/";
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
        get_listPreciosEspProducto();
       

        $("#txtdescPrecioEspecial").val('');
        $("#txtprecioespecial").val(0);
      }
    });
  
  }

  /*funcion para  retornar la  marca seleccionada*/
  function  get_PreciosEspProductoID(precioEspecialProdID){
    console.log('obtener precio especial para   modificar ');
    var url = base_url('index.php/preciosEpeciales_Controller/get_PreciosEspProductoID/' +precioEspecialProdID);
    $.get(url, function (data) {
          // console.log(data);
           var datosPrecioEspecial  =  JSON.parse(data);  
           $("#precioEspecialProdID").val(datosPrecioEspecial[0].precioEspecialProdID); 
           $("#turno").val(datosPrecioEspecial[0].turnOperaID);  
           $("#turno").change();      
         
          $("#familiaProducto").val(datosPrecioEspecial[0].famProdID);
          $("#familiaProducto").change();
          
          $("#txtdescPrecioEspecial").val(datosPrecioEspecial[0].descPrecioEspecial);
          $("#txtprecioespecial").val(datosPrecioEspecial[0].precioEspecial);
                   
      });  
  }
  /*funcion para  retornar la  marca seleccionada*/
  function  get_PreciosEspParaventa(){
    var precioespecial =  $("#precioespecial").val();
    console.log('obtener precio para registrar venta ');
    var url = base_url('index.php/preciosEpeciales_Controller/get_PreciosEspProductoID/' +precioespecial);
    $.get(url, function (data) {
          // console.log(data);
           var datosPrecioEspecial  =  JSON.parse(data);  
           
          $("#precincremento").val(datosPrecioEspecial[0].precioEspecial);
                   
      });  
  }
  
  /*Funcion para eliminar  un detallle de la  marca */
  function delete_PreciosEspProductoID(precioEspecialProdID){
    swal({
      title: "Estas seguro de elimnar el  registro ?",
      text: "Este proceso eliminara el  registro de base  de  datos",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((Delete) => {
      if (Delete) {
                  var url = base_url(                              
                    "index.php/preciosEpeciales_Controller/delete_PreciosEspProductoID/" + precioEspecialProdID
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
                      get_listPreciosEspProducto();
                    }
  
                  });				
      } else {
        swal("Operacion  cancelada",{
          icon: "success",
        });
      }
    });
  }