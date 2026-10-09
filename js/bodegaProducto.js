function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
// funcion para cargar el  menu inteno Categoria de productos isponible  
function get_listBodegaProducto(){
    console.log('intentando cargar precios especiales');
    var url = base_url('index.php/bodegaProducto_Controller/get_listBodegaProducto/');
      $.get(url, function (data) {
          $("#detBodegas").html(data);
      });
  
  }
  function  addBodegaProducto(){
    var formData;
    console.log('In presentacion  Producto');
    if(document.getElementById('FormFivetab')) {
      formData = new FormData($(".FormFivetab")[0]);
      console.log('formulario Creado.......Presentacion Producto');
    }else{
        console.log('no existe el formulario');
    }               
     url_destino = "index.php/bodegaProducto_Controller/addBodegaProducto/";
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
        get_listBodegaProducto();
       

        $("#txtbodegaProductoID").val(''); 
        $("#txtbodega").val('');  
      }
    });
  
  }

  /*funcion para  retornar la  marca seleccionada*/
  function  get_BodegaProductoID(bodegaProductoID){
    console.log('obtener precio especial para   modificar ');
    var url = base_url('index.php/bodegaProducto_Controller/get_BodegaProductoID/' +bodegaProductoID);
    $.get(url, function (data) {
          // console.log(data);
           var datosBodegaProd  =  JSON.parse(data);  
           $("#txtbodegaProductoID").val(datosBodegaProd[0].bodegaProductoID); 
           $("#txtbodega").val(datosBodegaProd[0].bodProdDescripcion);  
          
                   
      });  
  }
  
  /*Funcion para eliminar  un detallle de la  marca */
  function delete_BodegaProductoID(bodegaProductoID){
    swal({
      title: "Estas seguro de elimnar el  registro ?",
      text: "Este proceso eliminara el  registro de base  de  datos",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((Delete) => {
      if (Delete) {
                  var url = base_url(                              
                    "index.php/bodegaProducto_Controller/delete_BodegaProductoID/" + bodegaProductoID
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
                      get_listBodegaProducto();
                    }
  
                  });				
      } else {
        swal("Operacion  cancelada",{
          icon: "success",
        });
      }
    });
  }