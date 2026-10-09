function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
function verificarstadotab(id){
    // $("#principal"+id).val();
     //var tab  = 0;
    // var id = 0;
     console.log('el   id seleccionado es' + id );
     var formData;

     switch (id) {
        case 'one-tab':
          // Código a ejecutar si la expresión coincide con valor1
          //console.log('Eligiendo el  form 1');
          $("#marcProdID").val('');
          $("#txtmarca").val('');
          mostrarDetalles();
          //console.log('Eligiendo el  form 111111');
          //formData    = new FormData($(".FormOne-tab")[0]);


          break;
        case 'two-tab':
            // Código a ejecutar si la expresión coincide con valor2
            console.log('Eligiendo el  form 2');
            formData    = new FormData($(".FormOne-tab")[0]);
            getDetalPresentacion();
        break;
        case 'three-tab':
            // Código a ejecutar si la expresión coincide con valor2
            formData    = new FormData($(".FormThree-tab")[0]);
            mostrarDetalleMedProducto();
          
            console.log('Eligiendo el  form 3');
        break;
        case 'four-tab':
                // Código a ejecutar si la expresión coincide con valor2
                formData    = new FormData($(".FormFour-tab")[0]);
                console.log('Eligiendo el  form 4');
                $("#txtfamProdID").val('');
                $("#txtfamilia").val('');
                listaAllFamiliaProducto();
        break;
        case 'five-tab':
            // Código a ejecutar si la expresión coincide con valor2
            formData    = new FormData($(".FormFivetab")[0]);
            console.log('Eligiendo el  form 5');
            
            $("#txtbodega").val('');
            get_listBodegaProducto();
            break;  

        case 'six-tab':
            // Código a ejecutar si la expresión coincide con valor2
            formData    = new FormData($(".FormSixtab")[0]);
            get_listPreciosEspProducto();
            
           // $("#txtprecioespecial").val(0);
            console.log('Eligiendo el  form 6');
            break;
        case 'seven-tab':
              // Código a ejecutar si la expresión coincide con valor2
              formData    = new FormData($(".FormSeventab")[0]);
              mostrarDetalleEquivalente();
              
             // $("#txtprecioespecial").val(0);
              console.log('Eligiendo el  form 7');
              break;    
        // Más casos...
        default:
          // Código a ejecutar si no coincide con ningún caso anterior
      }
    //  base_url('index.php/productos_Controller/listarProductos/');
      /*var  url_destino = "index.php/configuracioProd_Controller/mostrarDetalleconsiguracion/";
      	
        $.ajax({
          url: base_url(url_destino),
          type: "POST",
          data: formData,
         // cache: false,
        //  contentType: false,
          processData: false,
          beforeSend: function () {
            // Show image container
            $("#loader").css("display", "block");
          },
          success: function (data) {
          //$("#codigoCliente").prop( "disabled", true);
            //alertify.set("notifier", "position", "top-right");
            //alertify.success("El producto se guardo correctamente");
          },
          complete: function () {
            // Show image container
            $("#loader").css("display", "none");
          }
        });*/

 }
/*funcion para almacenar la marca de los   productos */
function  saveMarca(){
  console.log('formulario Creado....... mARCS');
  var formData;
  if(document.getElementById('FormOnetab')) {
    formData = new FormData($(".FormOnetab")[0]);
    console.log('formulario Creado....... mARCS');
  }else{
      console.log('no existe el formulario');
  }
             
   url_destino = "index.php/configuracioProd_Controller/saveMarca/";
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
      mostrarDetalles();
      $("#marcProdID").val('');
      $("#txtmarca").val('');
    }
  });

}
/*mostrar el  detalle de las marcas  */
function mostrarDetalles(){
  console.log('llegando  a la funcion que muestra el   detalle de las marcas');
    var url = base_url('index.php/configuracioProd_Controller/mostrarDetalleMarcas/');
  
  //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
          $("#detMArcas").html(data);
      });
  
}
/*funcion para  retornar la  marca seleccionada*/
function  get_marcaxId(id){
  console.log('obtener la marca seleccionada');
  var url = base_url('index.php/configuracioProd_Controller/get_marcaxId/' +id);

//var url = base_url("index.php/BancosController/bancos");
    $.get(url, function (data) {
        // console.log(data);
         var datosMarca  =  JSON.parse(data);
         console.log(datosMarca);
         console.log(datosMarca[0].marcProdID);
        $("#marcProdID").val(datosMarca[0].marcProdID);
        $("#txtmarca").val(datosMarca[0].marcProdDescripcion);
       
    });

}

/*Funcion para eliminar  un detallle de la  marca */
function  DeleteMarcar(marcProdID){
  swal({
    title: "Estas seguro de elimnar el  registro ?",
    text: "Este proceso eliminara el  registro de base  de  datos",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((Delete) => {
    if (Delete) {
                var url = base_url(
                  "index.php/configuracioProd_Controller/delete_MarcaProductoID/" + marcProdID
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
                    mostrarDetalles();
                  }

                });				
    } else {
      swal("Operacion  cancelada",{
        icon: "success",
      });
    }
  });
}