
function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
// funcion para cargar el  menu inteno Categoria de productos isponible  
function get_listFamiliaProducto(){
    console.log('intentando cargar el  menu interno');
    var url = base_url('index.php/familiaProducto_Controller/get_listFamiliaProducto/');
      $.get(url, function (data) {
          $("#detFamilia").html(data);
      });
  
  }


  function listaAllFamiliaProducto(){
    console.log('intentando cargar el  menu interno');
    var url = base_url('index.php/familiaProducto_Controller/listaAllFamiliaProducto/');
      $.get(url, function (data) {
          $("#detFamilia").html(data);
      });
  
  }


  function  saveFamiliaProducto(){
    var formData;
    console.log('In presentacion  Producto');
    if(document.getElementById('FormFourtab')) {
      formData = new FormData($(".FormFourtab")[0]);
      console.log('formulario Creado.......Presentacion Producto');
    }else{
        console.log('no existe el formulario');
    }               
     url_destino = "index.php/familiaProducto_Controller/saveFamiliaProducto/";
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
        listaAllFamiliaProducto();
       

        $("#txtfamProdID").val('');
        $("#txtfamilia").val('');
      }
    });
  
  }

  /*funcion para  retornar la  marca seleccionada*/
  function  get_FamiliaProductoID(medProdID){
    console.log('obtener la familia seleccionada');
    var url = base_url('index.php/familiaProducto_Controller/get_FamiliaProductoID/' +medProdID);
    $.get(url, function (data) {
          // console.log(data);
           var datosFamilia  =  JSON.parse(data);           
          $("#txtfamProdID").val(datosFamilia[0].famProdID);
          $("#txtfamilia").val(datosFamilia[0].famProdDescripcion);
                   
      });  
  }
  
  /*Funcion para eliminar  un detallle de la  marca */
  function delete_FamiliaProductoID(medProdID){
    swal({
      title: "Estas seguro de elimnar el  registro ?",
      text: "Este proceso eliminara el  registro de base  de  datos",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((Delete) => {
      if (Delete) {
                  var url = base_url(
                    "index.php/familiaProducto_Controller/delete_FamiliaProductoID/" + medProdID
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
                      listaAllFamiliaProducto();
                    }
  
                  });				
      } else {
        swal("Operacion  cancelada",{
          icon: "success",
        });
      }
    });
  }
