
function base_url(url){
  return window.location.origin + "/BartioFran/"+ url;
}
// funcion para cargar el  menu inteno Categoria de productos isponible  

function listarProductos(){
    console.log('intentando cargar el  menu interno');
    var url = base_url('index.php/productos_Controller/listarProductos/');
  
  //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
          $("#principal").html(data);
      });
  
    /*$.ajax({
         url:url, 
         type:"POST",
         data:'',
         success:function(data){
  
         }
    })*/
  }

  /*funcion para cargar la modal para  registrar los productos */
function addProducto(productoID){    
    /*Determinamos si  los datos del  producto ya existen */
    var valorid  = 0;  
    //var productoID      =  null;
 
    var famProdID          =  1;
    var presProdID         =  1;
    var tipProdID          =  1;
    var marcProdID         =  1;
    var medProdID          =  1;
    var proveedorID        =  1;
    var presentacion_invId =  0;
    var tipomovinvtId      =  0;
    var  presProdID = 0 ;

    console.log("se ha hecho  click"+ productoID  + " capturado");
    var url = base_url('index.php/productos_Controller/addProducto/' + productoID);
   
    //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
        $("#vmodaladdProducto").html(data);
        //  document.getElementById('prodDescripcion').innerHTML=descripcion      
        $('#addProducto').modal('show');

       




        if(document.getElementById('famProdID')){
          famProdID = $("#famProdID").val();
        }
        if(document.getElementById('presProdID')){
          presProdID = $("#presProdID").val();
        }
        if(document.getElementById('tipProdID')){
          tipProdID = $("#tipProdID").val();
        }    
        if(document.getElementById('marcProdID')){
          marcProdID = $("#marcProdID").val();
        }    
        if(document.getElementById('medProdID')){
          medProdID = $("#medProdID").val();
        }    
        if(document.getElementById('proveedorID')){
          proveedorID = $("#proveedorID").val();
          console.log( 'los  datos del  proveedor id  son ' + proveedorID);
        }else{
          console.log( 'no se encontro el  control del  proveedor ');
        }
        if(document.getElementById('presentacion_invId')){
          presentacion_invId = $("#presentacion_invId").val();
        }
        if(document.getElementById('tipomovinvtId')){
          tipomovinvtId = $("#tipomovinvtId").val();
        }         
        $("#proveedor").val(proveedorID);
        $("#proveedor").change();  
        $("#familia").val(famProdID);
        $("#familia").change();       
        $("#tipProducto").val(tipProdID);
        $("#tipProducto").change();  
        $("#marca").val(marcProdID);
        $("#marca").change();  
        $("#presentacion").val(presProdID);
        $("#presentacion").change();  
        $("#medida").val(medProdID);
        $("#medida").change();
        $("#tipomovinvent").val(presentacion_invId);
        $("#tipomovinvent").change();
        $("#presentacioninvent").val(tipomovinvtId);
        $("#presentacioninvent").change();      
      });
   
   }
 /*Funcion para almacena El  producto */
 function saveProducto(){
  var $productoID =  0;
  console.log('llegando a la  funcion para almacenar el producto');
  var formData;  
	url_destino = "index.php/productos_Controller/saveProducto/";
	formData    = new FormData($(".formAddProducto")[0]);	
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
            //alertify.set("notifier", "position", "top-right");
            //alertify.success("El producto se guardo correctamente");
          },
          complete: function () {
            // Show image container
            $("#loader").css("display", "none");
          //  $('#addProducto').close('show');
            //$('#addProducto').modal('hide');
            $("#addProducto.close").click();
					  $(".modal-backdrop").remove();

            listarProductos();
          }
        });	
 } 
 /*funcion para cargar el  inventario manual de   productos  */ 
 function addInventManual(){
  console.log('cargando la vista card para  agregar datos del   inventario');
  var url = base_url('index.php/productos_Controller/addInventManual/');

//var url = base_url("index.php/BancosController/bancos");
    $.get(url, function (data) {
        $("#principal").html(data);
    });


 }

 
     /*funcion para ingresar la venta de nuevo productos  */ 
  /*function addVentaProducto(){  
    var url = base_url('index.php/productos_Controller/addVentaProducto/');
  
  //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
          $("#principal").html(data);
      });
  
  
   }*/

   /*Cargando la  vista  de  configuracion de productos */
   function configurarProduct(){  
    console.log('llegando a la  configuracion del  producto');
    var url = base_url('index.php/productos_Controller/setthingProduct/');
  
  //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
          $("#principal").html(data);
      });
  
  
   }
   // funcion para  asginar los precios a los productos
   function  preciosProducto(){
    console.log("Asignacion  de precios a productos  ");
    var url = base_url('index.php/productos_Controller/preciosProducto/');

    //var url = base_url("index.php/BancosController/bancos");
        $.get(url, function (data) {
            $("#principal").html(data);
        });

   }

   //  funcion que  recarga  UNICAMENTE  el  div  de  la  lista  de  precios , filtrada  por  la
   //  familia  seleccionada.  Se  llama  al  cambiar  el  select  y  al  guardar  un  precio ,
   //  asi  el  filtro  elegido  no  se  pierde.
   function cargarListaPrecios(){
    var famProdID = (document.getElementById('famPrecios')) ? $("#famPrecios").val() : 0 ;
    if(famProdID === "" || famProdID === null || famProdID === undefined){ famProdID = 0; }

    console.log("Recargando lista de precios de la familia " + famProdID);
    var url = base_url('index.php/productos_Controller/listaPreciosProducto/');
    $.ajax({
          url: url,
          type: "POST",
          data: { famProdID: famProdID },
          beforeSend: function () {
          },
          success: function (data) {
            $("#listaPreciosProducto").html(data);
          }
        });
   }
   //   funcion para actualizar los precios  del  producto.
   //   Esta  pantalla  ya  NO  toca  precioproducto.precioventa :  los  precios  se  guardan
   //   en  la  tabla  precioproductoarea , una  columna  por  cada  area  creada.
   function updatePrecProd(productoID, identificador){
     savePreciosProductoArea(productoID, identificador);
   }

   //   funcion para actualizar los precios  de  cada  area  del  producto ,  se envia   precios[areaEstablecimientoID] = precio
   function savePreciosProductoArea(productoID, identificador){
    var precios        = {};
    var totalAreas     = 0;
    var proddisponible = 0;

    //  estado del  switch  Disponible  de  la  fila
    var chkProducto = document.getElementById("proddisponible" + identificador);
    if(chkProducto){
        proddisponible = chkProducto.checked ? 1 : 0 ;
    }

    // se  recorren solo las  cajas  de  texto  de  la  fila  del producto
    $(".ctrlPrecioArea[data-fila='" + identificador + "']").each(function(){
        var areaID  = $(this).attr("data-area");
        var precio  = $(this).val();
        if(precio !== null && precio !== undefined && precio.toString().trim().length > 0){
            precios[areaID] = precio;
            totalAreas += 1;
        }
    });

    var DJson = { productoID:productoID, precios:precios, proddisponible:proddisponible };
    url_destino = "index.php/PrecioArea_Controller/savePreciosProductoArea/";

    console.log("Actualizando " + totalAreas + " precio(s) por area del producto " + productoID);

    $.ajax({
          url: base_url(url_destino),
          type: "POST",
          data: DJson,
          beforeSend: function () {
          },
          success: function (data) {
            console.log("precios  de  area  actualizados : " + data);
            if(typeof alertify !== "undefined"){
                alertify.set("notifier", "position", "top-right");
                alertify.success("Precios actualizados en " + data + " area(s)");
            }
            //  se  recarga  solo  el  div  de  la  lista , conservando  la  familia  filtrada
            cargarListaPrecios();
          },
          complete: function () {
          }
        });
   }

   function deleteProducto(productoID){
    console.log("Eliminando el producto") ;
     var url = base_url('index.php/productos_Controller/deleteProducto/' + productoID);
   
    //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
        listarProductos();

   });
  }


   //   funcion para motrar los  items de la tabla temporal  
  





