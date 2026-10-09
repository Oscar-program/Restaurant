function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
/*funcion para cargar la modal */
function addVentaProducto(famProdID, idProducto, detPedID, prodDescripcion,  preciocosto, prodctucocina){
 // modal que carga el producto y el  precio    
  console.log("los datos de los productos son Familia  " + famProdID + "idProducto" + idProducto +  "detallePedido" +  detPedID  + "Descripcion"+  prodDescripcion + "PrecioCosto"+ preciocosto  )  
    var valorid  = 0;  
    var bodSaldID  = $("#bodSaldID").val();   
    console.log("funcion para mostrar los productos " + idProducto +   " idDetallePedido" +detPedID  ) ;
    var url = base_url('index.php/ventaProducto_Controller/addVentaProducto/' + famProdID + "/"+  detPedID);   
    //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
         $("#addVenta").html(data);
        //console.log(data);
        document.getElementById('prodDescripcion').innerHTML=prodDescripcion;
         $('#addVentaProducto').modal('show');
       // var modal  = document.getElementById("modal");
       // modal.style.display = "flex";
        // ponemos el  precio  de  costo del producto 
        $("#productoID").val(idProducto); 
        $("#bodsalida").val(bodSaldID);
         $("#precioregular").val(preciocosto.toFixed(2));
        $("#bodsalida").change();
        //  si  no  se  recibio  la  marca  de  cocina  se  asume  0  ( no  pasa  por  cocina )
        $("#prodctucocina").val((prodctucocina === undefined || prodctucocina === null) ? 0 : prodctucocina);

      });

   }
   function addVentaProducto1(select){




 
    var option          = select.options[select.selectedIndex];
    var idProducto      = option.value;
    var famProdID       = option.dataset.famprodid;
    var prodDescripcion = option.dataset.proddescripcion;
    var precioventa     = option.dataset.precioventa;
    var detPedID        = option.dataset.detpedid;
    var prodctucocina   = option.dataset.prodctucocina;

    console.log("El precio de venta es  " + precioventa);
    








  console.log("los datos de los productos son Familia  " + famProdID + " idProducto" + idProducto + 
              " detallePedido" +  detPedID  + " Descripcion"+  prodDescripcion + " PrecioCosto"+ precioventa  )  
    
  
    var valorid  = 0;  
    var bodSaldID  = $("#bodSaldID").val();   
    console.log("funcion para mostrar los productos " + idProducto +   " idDetallePedido" +detPedID  ) ;
    var url = base_url('index.php/ventaProducto_Controller/addVentaProducto/' + famProdID + "/"+  detPedID);   
    //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
         $("#addVenta").html(data);
        //console.log(data);
        document.getElementById('prodDescripcion').innerHTML=prodDescripcion;
         $('#addVentaProducto').modal('show');
       // var modal  = document.getElementById("modal");
       // modal.style.display = "flex";
        // ponemos el  precio  de  costo del producto 
        $("#productoID").val(idProducto); 
        $("#bodsalida").val(bodSaldID);
         $("#precioregular").val(precioventa);
        $("#bodsalida").change();
         $("#prodctucocina").val(prodctucocina); 
      });
   
   }

   // funcion para calcular el total de la venta  
   function calculartotalVenta(){
    //if(e.keyCode===13){
  
  
      var precioregular    = (document.getElementById("precioregular"))  ? parseFloat($("#precioregular").val())  : 0;
      var  precincremento  = (document.getElementById("precincremento")) ? parseFloat($("#precincremento").val()) : 0;
      var  cantiadVenta    = (document.getElementById("cantidadVenta"))   ? $("#cantidadVenta").val()               : 0;
      var total   = (precioregular + precincremento) *  cantiadVenta; 
      console.log("calculando el total del detalle de la venta " + precioregular + " "+ precincremento + " "+   cantiadVenta);
  
      console.log("Se ha precionado enter sobr el control" + parseFloat(total));
      $("#totalVenta").val(parseFloat(total));
      //e.preventDefault();
  
    //}
   }
   // funion para  registrar la  venta saveVentaProducto
   function saveVentaProducto(){
   // console.log("Registrando la   venta del producto");
    var precioregular  = 0;
    var comanda        = 0; 
    var bodegaOrigen   = 0;
    var precincremento = 0;
    var cantiadVenta   = 0;
    var totalVenta     = 0;
    var ordenID        = 0; 
    var productoID     = 0;
    var prodctucocina  = 0 ;
    calculartotalVenta();


    //$("#productoID").val(id);
    if(document.getElementById("productoID")){
        productoID = $("#productoID").val();
       // console.log("orden encontrado"+ ordenID);
    }


    if(document.getElementById("ordenID")){
        ordenID = $("#ordenID").val();
      //  console.log("orden encontrado"+ ordenID);
    }

    if(document.getElementById("precioregular")){
        precioregular= parseFloat($("#precioregular").val());
    }
    if(document.getElementById("comanda")){
        comanda= $("#comanda").val();
    }
    if(document.getElementById("bodsalida")){
        bodegaOrigen= $("#bodsalida").val();
    }
    if(document.getElementById("precincremento")){
        precincremento= parseFloat($("#precincremento").val());
    }
    if(document.getElementById("cantidadVenta")){
        cantidadVenta= $("#cantidadVenta").val();
    }
    if(document.getElementById("totalVenta")){
        totalVenta= parseFloat($("#totalVenta").val());
    }
    if(document.getElementById("detPedID")){
        detPedID= $("#detPedID").val();
    }
    // poemos si el producto es de cocina 
     if(document.getElementById("prodctucocina")){
        prodctucocina= $("#prodctucocina").val();
    }



    //detPedID

    //ordenID:ordenID, 
    var DJson  = { ordenID:ordenID, 
                   detPedID:detPedID,
                    productoID:productoID, 
                    precioregular:precioregular, 
                    comanda:comanda,
                    bodegaOrigen:bodegaOrigen,
                    precincremento:precincremento, 
                    cantidadVenta:cantidadVenta,
                    totalVenta:totalVenta, 
                    prodctucocina: prodctucocina 
                    };  
        url_destino       = "index.php/ventaProducto_Controller/saveVentaProducto/";

        console.log("Almacenando Venta####################");
        $.ajax({
            url: base_url(url_destino),
            type: "POST",
            data: DJson,
            // cache: false,
            //contentType: false,
            //processData: false,
            beforeSend: function () {
              // Show image container
              $("#loader").css("display", "block");
            },
            success: function (data) {
            //$("#codigoCliente").prop( "disabled", true);
              //alertify.set("notifier", "position", "top-right");
              //alertify.success("Precio actualizado correctamente");
               
              $("#detOrdenesPedido").html(data);
              calculaTotalVenta(ordenID);
              $("#addVentaProducto.close").click();
              $(".modal-backdrop").remove();  
               $('#addVentaProducto').modal('hide');  
            },
            complete: function (data) {
               // console.log(data);
                   
               //  $("#detOrdenesPedido").html(data);
            }
          });
  
  
     } 
     // funcion  para  retornar la sumatoria del  detalle de la ord3en de cliente  
  function calculaTotalVenta(ordenID){
        //get_TotalDetOrden($ordenPedidoID)
        var total  ="0.0";



       // var valorid  = 0;   
        var url = base_url('index.php/ventaProducto_Controller/get_TotalDetOrden/' + ordenID);   
        //var url = base_url("index.php/BancosController/bancos");
          $.get(url, function (data) {
             if(parseFloat(data)>0){
                total= data;
             }
             console.log("El nuevo total a cancelar es  " +  data ) ;

           // $("#addVenta").html(data);
            console.log("EL total a cancelar es  "+ data   +" sdnlksd");
            document.getElementById('lbTotal').innerHTML= "";
            document.getElementById('lbTotal').innerHTML= "Total a cancelar $" + parseFloat(total);
          //  $('#addVentaProducto').modal('show');
            // ponemos el  precio  de  costo del producto 
            //$("#totalOrden").val(data);
            //$("#productoID").val(id);
          });



  }

     // funcion para mostrar las ordenes  pendientes de   cobro 
    

       // funcion para  cargar la  orden seleccionada si esta  pendiente de cobro
       function ver_ordenePedido(ordenPedidoID, mesaID){    
         
        var url = base_url('index.php/ventaProducto_Controller/ver_ordenePedido/' + ordenPedidoID + "/" + mesaID);   
        //var url = base_url("index.php/BancosController/bancos");
          $.get(url, function (data) {
            $("#principal").html(data);
             calculaTotalVenta(ordenPedidoID);
            //console.log(data);
            //document.getElementById('prodDescripcion').innerHTML=descripcion;
           // $('#addVentaProducto').modal('show');
            // ponemos el  precio  de  costo del producto 
            //$("#precioregular").val(preciocosto.toFixed(2));
            //$("#productoID").val(id);
          });
       
       }

       // funcion  para cerrar la  orden de pedido 
        /*Funcion para eliminar  un detallle de la  marca */
  function  delete_PresentacionProductoID(presProdID){
    // obtenemos  el id de la orden de pedido 
    var   ordenID = 0;
     if(document.getElementById('ordenID')){
       ordenID =  $("#ordenID").val()
     }
    swal({
      title: "Estas seguro de cerrar la venta y  realizar el  cobro ?",
      text: "Este proceso generar  un ticke con los  datos de la  compra",
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
                          text: 'Surgio un error al  intentar cerrar la  venta',														
                          });
                    } else if (data == 1) {
                      swal("Ticket  realizado correctamente", {
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

  // funcion para  generar el   ticket de venta 
  //  funcion para lanzar el  pdf del  comprobante de tiket
function  crear_pdf_ticket(){	


	//var ordenPedidoID 			= 0; 
  var ordPcomentario       = 'Sin Comentario';
  //var ordenPedidoID        = ordenPedidoID ; 
  if(document.getElementById('ordenID')){
    ordenPedidoID =  $("#ordenID").val();
  }

  if(document.getElementById('txAcomentario')){
    
    ordPcomentario =  $("#txAcomentario").val();
     if($("#txAcomentario").val().length > 0){
    ordPcomentario =  $("#txAcomentario").val();
   }
   
  }

    //  ordPcomentario =  $("#txAcomentario").val();
    // }


  //console.log("generando la   opcion de  i,presion de  ticket")
    var url = base_url(
        "index.php/ventaProducto_Controller/pdfCrearTicket/"  + ordenPedidoID  + "/" + ordPcomentario
      );
      $.get(url, function (data) {
          console.log("El establecimiento capturado es???????????? " + data )	 ;
             // echo $_SESSION["areasEstablecimientoID"] ;
        // var datos = JSON.parse(data);
        // var caja             = datos["caja"];
         //var repositorio      = datos["destino"];
         //var comprobante      = datos["nombre_archivo"];
         //var documentomostrar = repositorio + comprobante;		 
         //crear_cintaelectronic(caja);
         //ver_ticketPDF(documentomostrar);
          swal("Operacion  exitosa",{
        icon: "success",});
         
        //get_listAreasEstablecimiento(data);

         listarMesas(data);
        
      });	


  /*swal({
    title: "Estas seguro de cerrar la ordern ?",
    text: "Este proceso cerrara la oden de pedido y no podra agregar mas  productos",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((Delete) => {
    if (Delete) {
      var url = base_url(
        "index.php/ventaProducto_Controller/pdfCrearTicket/"  + ordenPedidoID  + "/" + ordPcomentario
      );
      $.get(url, function (data) {	
         var datos = JSON.parse(data);
        // var caja             = datos["caja"];
         var repositorio      = datos["destino"];
         var comprobante      = datos["nombre_archivo"];
         var documentomostrar = repositorio + comprobante;		 
         //crear_cintaelectronic(caja);
         //ver_ticketPDF(documentomostrar);
         listarMesas();
        
      });			
    } else {
      swal("Operacion  cancelada",{
        icon: "success",
      });
    }
  });*/

  
	//let idCliente 				= $("#idCliente").val();
	//let id_enc_Comprobante 		= $("#idVenta").val();
	/*var url = base_url(
		"index.php/ventaProducto_Controller/pdfCrearTicket/"  + ordenPedidoID  + "/" + ordPcomentario
	);
	$.get(url, function (data) {	
		 var datos = JSON.parse(data);
		// var caja             = datos["caja"];
		 var repositorio      = datos["destino"];
		 var comprobante      = datos["nombre_archivo"];
		 var documentomostrar = repositorio + comprobante;		 
		 //crear_cintaelectronic(caja);
		 ver_ticketPDF(documentomostrar);
		
	});*/
} 
// funcion para realizar el  cobro de elementos marcados para cobrar  
function  realizarCobro(ordenPedidoID, mesaID){	
	
  var ordPcomentario       = 'Sin Comentario';
  var ordenPedidoID        = ordenPedidoID ; 
 

  swal({
    title: "Estas seguro de procesar el  cobro ?",
    text: "Este proceso marcara como cobrado los elementos seleccionados",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((Delete) => {
    if (Delete) {
      var url = base_url(
        "index.php/ventaProducto_Controller/realizarCobro/"  + ordenPedidoID 
      );
      $.get(url, function (data) {	
        
         mostrarPendientesCobro(mesaID);
        
      });			
    } else {
      swal("Operacion  cancelada",{
        icon: "success",
      });
    }
  });
}


// funcion para cobrar  DE  UNA  SOLA  VEZ  todas  las  ordenes  pendientes  de  la  mesa
function  realizarCobroMesa(mesaID, totalMesa){
  var total = (totalMesa === undefined || totalMesa === null) ? "" : " por $" + totalMesa ;

  swal({
    title: "Cobrar TODAS las ordenes de la mesa ?",
    text: "Se marcaran como cobradas todas las ordenes pendientes de esta mesa" + total + ". Esta accion no se puede deshacer.",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((Confirmar) => {
    if (Confirmar) {
      var url = base_url("index.php/ventaProducto_Controller/realizarCobroMesa/" + mesaID);
      $.get(url, function (data) {
        swal("Se cobraron " + data + " orden(es) de la mesa", { icon: "success" });
        mostrarPendientesCobro(mesaID);
      });
    } else {
      swal("Operacion  cancelada",{ icon: "success" });
    }
  });
}

function ver_ticketPDF(ruta) {
	var url = ruta;
	window.open(
		base_url(url),
		"ventana1",
		"width=600,height=600,scrollbars=no,toolbar=no, titlebar=no, menubar=no"
	);
}

//  funcion para determinar si en la bodega de la cual se quiere vender un  producto   tiene exixtencia 
function chekStockProduct(){

   var  productoID       = 0 ;
   var  bodegaProductoID = 0;
   if(document.getElementById('productoID')){
    productoID = $('#productoID').val();
   }

   if(document.getElementById('bodsalida')){
    bodegaProductoID = $('#bodsalida').val();
   }
  // chekStockProduct($productoID,$bodegaProductoID)

  console.log("funcion para determinar si  un  producto tiene existencia");
  var url = base_url(
		"index.php/ventaProducto_Controller/chekStockProduct/"  + productoID  + "/" + bodegaProductoID
	);
	$.get(url, function (data) {	
		  if(data<=0){
        swal("La bodega que ha seleccionado  no  tiene existencia, se sugiere  hacer un traslado de producnto",{
          icon: "warning",
        });

          // console.log("El producto no tiene existencia");
      }
		
	});

}

// funcion para   mostrar informacion de la venta del producto 
function editDetaVenta(famProdID, detPedID){    
  var valorid  = 0;   
  var url = base_url('index.php/ventaProducto_Controller/addVentaProducto/'+ famProdID + '/'+ detPedID);   
  //var url = base_url("index.php/BancosController/bancos");
    $.get(url, function (data) {
      $("#addVenta").html(data);
      //console.log(data);
      //document.getElementById('prodDescripcion').innerHTML=descripcion;
      $('#addVentaProducto').modal('show');
      // ponemos el  precio  de  costo del producto 
      $("#precioregular").val(preciocosto.toFixed(2));
      $("#productoID").val(id);
    });
 
 }

 // funcion para anular la orden de pedido 
 function  anularOrden(){
    const  ordenID  =   document.getElementById('ordenID').value ;
    const mesaID   =   document.getElementById('ctrlmesaID').value ; 
    url  =  base_url('index.php/ventaProducto_Controller/anularOrden/');
    console.log("anulando la  orden de pedido la mesa es " +  mesaID + "la orden es  " + ordenID  );
    var obJSON = {ordenID : ordenID } ;
    $.ajax({
            url: url,
            type: "POST",
            data: obJSON,
            beforeSend: function (){

            }, 
            success: function(data){                
              //console.log("modificando orden" );
               cargar_addordenes(mesaID) ;
              // ver_ordenePedido(ordenID, mesaID) ;
               $("#totalVenta").val(parseFloat(0));
               document.getElementById('bannerMesaPedido').innerHTML = "";
               document.getElementById('bannerMesaPedido').innerHTML = "MESA W" + mesaID + "         ORDEN #" + "" ;
              //console.log("Datos  Modificados" );
                 

            }

    });

 }
 // funcion que elimina el detalle de la venta  
 function anularDetOrden(detPedID){
    const  ordenID  =   document.getElementById('ordenID').value ;
    const mesaID   =   document.getElementById('ctrlmesaID').value ; 
    url  =  base_url('index.php/ventaProducto_Controller/anularDetOrden/');
    console.log("anulando la  orden de pedido la mesa es " +  mesaID + "la orden es  " + ordenID  );
    var obJSON = {detPedID : detPedID } ;
    $.ajax({
            url: url,
            type: "POST",
            data: obJSON,
            beforeSend: function (){

            }, 
            success: function(data){                
              //console.log("modificando orden" );
               //cargar_addordenes(mesaID) ;
               ver_ordenePedido(ordenID, mesaID) ;
               //calculaTotalVenta(ordenID);
               //$("#totalVenta").val(parseFloat(0));
               //document.getElementById('bannerMesaPedido').innerHTML = "";
               //document.getElementById('bannerMesaPedido').innerHTML = "MESA W" + mesaID + "         ORDEN #" + "" ;
              //console.log("Datos  Modificados" );
                 

            }

    });

 }

 // funcion para anular la orden  por el id de la orden, tenmiendo en cuenta que  el  necargado de despacho podra anular la orden  

 function  anularOrdenID(ordenID, mesaID){
    console.log("Elimiando la mesa por el  id de la orden  ") ;
    url  =  base_url('index.php/ventaProducto_Controller/anularOrden/');
    console.log("anulando la  orden de pedido la mesa es " +  mesaID + "la orden es  " + ordenID  );
    var obJSON = {ordenID : ordenID } ;
   $.ajax({
            url: url,
            type: "POST",
            data: obJSON,
            beforeSend: function (){

            }, 
            success: function(data){    
              mostrarPendientesDespachomesaID(mesaID);


             
                 

            }

    });

 }

 // funcion para anular detalle de la ordern ya registradas como ventas 
  function  anularDetalleOrdenIDdet(detPedID, mesaID){
    console.log("Eliminando un detalle de la ORDE................  ") ;
    url  =  base_url('index.php/ventaProducto_Controller/anularDetOrden/');
    console.log("anulando el MESA" +  mesaID + "DETALLE  " + detPedID  );
    var obJSON = {detPedID : detPedID } ;
   $.ajax({
            url: url,
            type: "POST",
            data: obJSON,
            beforeSend: function (){

            }, 
            success: function(data){    
              mostrarPendientesDespachomesaID(mesaID);


             
                 

            }

    });

 }



  
