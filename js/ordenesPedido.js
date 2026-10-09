function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}


// muestra la lista de la mesas para seleccionar la ordenes procesadas
 function get_OrdenesPendientesDespachar(){ 
         console.log("mostrando mesas con ordenes pendientes Despacho /cobro") ; 
        var url = base_url('index.php/Ordenes_Controller/get_OrdenesPendientesDespachar/' );         
          $.get(url, function (data) {
            $("#principal").html(data);         
          });
       
       }
  // funcion para mosytrar la  lista de  ordenes pendientes de cobro 
  function get_OrdenesPendientesCobro(){   
     console.log("lista mesas pendientes de cobro") ;
        var url = base_url('index.php/Ordenes_Controller/get_OrdenesPendientesCobro/' );         
          $.get(url, function (data) {
            $("#principal").html(data);         
          });
        //  ocultarMenu();
       
       }       


// =====================================================================
//  DETALLE  DE  PRODUCTOS  VENDIDOS  ( rango  de  fecha  +  area )
//  por  defecto  se  abre  sin  filtros , es  decir  mostrando  TODO
// =====================================================================
function detalleProductosVendidos(){
    console.log("Abriendo el detalle de productos vendidos");
    var url = base_url('index.php/Ordenes_Controller/detalleProductosVendidos/');
    $.ajax({
           url: url,
           type: "POST",
           data: { fechaIni:"", fechaFin:"", areaEstablecimientoID:0, usuarioID:0, soloCocina:"" },
           beforeSend: function(){
           }, success:function(data){
            $("#principal").html(data);
           }
    });
}

//  lee  los  filtros  de  la  pantalla ,  se  usa  tanto  para  buscar  como  para  exportar
function filtrosProductosVendidos(){
    return {
        fechaIni              : (document.getElementById('fechaIni'))        ? $("#fechaIni").val()        : "" ,
        fechaFin              : (document.getElementById('fechaFin'))        ? $("#fechaFin").val()        : "" ,
        areaEstablecimientoID : (document.getElementById('areaVendidos'))    ? $("#areaVendidos").val()    : 0  ,
        usuarioID             : (document.getElementById('usuarioVendidos')) ? $("#usuarioVendidos").val() : 0  ,
        soloCocina            : (document.getElementById('cocinaVendidos'))  ? $("#cocinaVendidos").val()  : ""
    };
}

//  aplica  los  filtros  y  recarga  unicamente  el  cuerpo  del  reporte
function buscarProductosVendidos(){
    var filtros = filtrosProductosVendidos();

    console.log("Filtrando productos vendidos", filtros);
    var url = base_url('index.php/Ordenes_Controller/buscarProductosVendidos/');
    $.ajax({
           url: url,
           type: "POST",
           data: filtros,
           beforeSend: function(){
           }, success:function(data){
            $("#cuerpoProductosVendidos").html(data);
           }
    });
}

//  limpia  los  filtros  y  vuelve  a  mostrar  TODO
function limpiarFiltroProductosVendidos(){
    if(document.getElementById('fechaIni')){        $("#fechaIni").val("");        }
    if(document.getElementById('fechaFin')){        $("#fechaFin").val("");        }
    if(document.getElementById('areaVendidos')){    $("#areaVendidos").val(0);     }
    if(document.getElementById('usuarioVendidos')){ $("#usuarioVendidos").val(0);  }
    if(document.getElementById('cocinaVendidos')){  $("#cocinaVendidos").val("");  }
    buscarProductosVendidos();
}

//  descarga  el  reporte  a  Excel  respetando  los  filtros  aplicados
function exportarProductosVendidos(){
    var f = filtrosProductosVendidos();
    var params = "?fechaIni="              + encodeURIComponent(f.fechaIni)
               + "&fechaFin="              + encodeURIComponent(f.fechaFin)
               + "&areaEstablecimientoID=" + encodeURIComponent(f.areaEstablecimientoID)
               + "&usuarioID="             + encodeURIComponent(f.usuarioID)
               + "&soloCocina="            + encodeURIComponent(f.soloCocina);

    console.log("Descargando productos vendidos a Excel");
    //  navegacion  directa :  el  servidor  responde  con  Content-Disposition attachment ,
    //  por  eso  el  navegador  descarga  el  archivo  sin  salir  de  la  pantalla
    window.location.href = base_url('index.php/Ordenes_Controller/exportarProductosVendidos') + params;
}

// =====================================================================
//  ORDENES  ABIERTAS  DE  UNA  MESA
//  muestra  las  ordenes  que  todavia  NO  se  han  cobrado  y  permite
//  agregarles  productos ,  ademas  muestra  el  total  de  toda  la  mesa
// =====================================================================
function ordenesMesa(mesaID, mesNombre){
    console.log("Ordenes abiertas de la mesa " + mesaID);
    var nombre = (mesNombre === undefined || mesNombre === null) ? "" : mesNombre ;
    var url = base_url('index.php/Menu_internoController/ordenesMesa/' + mesaID + '/' + encodeURIComponent(nombre));
    $.get(url, function (data) {
        $("#principal").html(data);
    });
}

//  abre  una  orden  YA  EXISTENTE  para  agregarle  productos
//  soloCocina = 1  ->  la  lista  de  productos  muestra  unicamente  prodctucocina = 1
function agregarProductosOrden(ordenPedidoID, mesaID, soloCocina){
    var filtro = (soloCocina === undefined) ? 1 : soloCocina ;
    console.log("Agregando productos a la orden " + ordenPedidoID + " soloCocina=" + filtro);
    var url = base_url('index.php/Menu_internoController/agregarProductosOrden/' + ordenPedidoID + '/' + mesaID + '/' + filtro);
    $.get(url, function (data) {
        $("#principal").html(data);
        calculaTotalVenta(ordenPedidoID);
    });
}

// =====================================================================
//  CONTADOR  ACTIVO  DEL  TIEMPO  DE  ESPERA  ( color  rojo )
//  cada  elemento  .contador-espera  trae  en  data-segundos  los  segundos
//  transcurridos  calculados  por  el  servidor ,  el  navegador  solo  suma
// =====================================================================
var intervaloContadoresEspera = null;

function formatoTiempoEspera(totalSegundos){
    if(totalSegundos < 0){ totalSegundos = 0; }
    var h = Math.floor(totalSegundos / 3600);
    var m = Math.floor((totalSegundos % 3600) / 60);
    var s = Math.floor(totalSegundos % 60);
    return (h < 10 ? "0" + h : h) + ":" + (m < 10 ? "0" + m : m) + ":" + (s < 10 ? "0" + s : s);
}

function refrescarContadoresEspera(){
    $(".contador-espera").each(function(){
        var seg = parseInt($(this).attr("data-segundos"), 10);
        if(isNaN(seg)){ seg = 0; }
        seg += 1;
        $(this).attr("data-segundos", seg);
        $(this).text(formatoTiempoEspera(seg));
    });
}

function iniciarContadoresEspera(){
    //  se  pinta  de  inmediato  para  no  esperar  el  primer  segundo
    $(".contador-espera").each(function(){
        var seg = parseInt($(this).attr("data-segundos"), 10);
        if(isNaN(seg)){ seg = 0; }
        $(this).text(formatoTiempoEspera(seg));
    });
    if(intervaloContadoresEspera != null){
        clearInterval(intervaloContadoresEspera);
    }
    intervaloContadoresEspera = setInterval(refrescarContadoresEspera, 1000);
}


// funcion para cargar la  venta principal de ordenes
function cargar_addordenes(mesaID, mesNombre){
    console.log("Listando las mesas "  + mesaID + "    "+ mesNombre);
    var url = base_url('index.php/Menu_internoController/cargar_addordenes/' + mesaID +'/'+ mesNombre );
    $.get(url, function (data) {
        $("#principal").html(data);
    });

  }

  //  el  parametro  puede  llegar  como  el  select  ( onchange )  o  como  el  id  de  la  mesa
  function resolverMesaID(origen){
    if(origen === null || origen === undefined){ return 0; }
    if(typeof origen === "object" && origen.value !== undefined){ return origen.value; }
    return origen;
  }

  // funcion para mostrar el total d ordenes por mesa
  function mostrarPendientesDespacho(select){
    var mesaID  = resolverMesaID(select);
    console.log("El detalle de la mesa a mostrar es 100000 " + mesaID ) ;
    var url = base_url('index.php/Ordenes_Controller/listaOrdenesPendienteDespacho/');
    obJson = { mesaID:mesaID};
    $.ajax({
           url: url,
           type:"POST",
           data:obJson,
           beforeSend: function(){
           }, success:function(data){
            console.log(data)       ;
            $("#ordenesPendientesDespacho").html(data);
            iniciarContadoresEspera();
           }
    });

  }
    // funcion para mostrar el total d ordenes por mesa
  function mostrarPendientesCobro(select){
    var mesaID  = resolverMesaID(select);
    var url = base_url('index.php/Ordenes_Controller/listaOrdenesPendienteCobro/');
    obJson = { mesaID:mesaID};
    $.ajax({
           url: url,
           type:"POST",
           data:obJson,
           beforeSend: function(){
           }, success:function(data){
            $("#ordenesPendientesCobrar").html(data);
            iniciarContadoresEspera();
           }
    });

  }



 

  // funcion para  mostrar el detalle de la orden pendiente a despachar  
  function mostrarDetalleORden(ordenPedidoIDCab){
    var url = base_url('index.php/Ordenes_Controller/listaDetOrdenPendienteDespacho/' );
    obJson = { ordenPedidoIDCab:ordenPedidoIDCab};
    $.ajax({
           url: url, 
           type:"POST",
           data:obJson, 
           beforeSend: function(){

           }, success:function(data){
           // console.log(data) ; 
            $("#detallePendienteDespacho").html(data);
            $('#DetallePendienteDespacho').modal('show');
            
               

           }

    });

  } 
  function  despacharOrden(c, detPedID){
    console.log("DESPACHAR ORDER ") ;
    let estado = 1;
    var detPedID = detPedID;
    const  objChk = document.getElementById('Despachar'+c);
    if (objChk ){
      /*if(objChk.checked){
        estado=1;
      }*/
        var url = base_url('index.php/Ordenes_Controller/despacharOrden/' );
        obJson = { detPedID:detPedID , estado:estado};
         $.ajax({
           url: url, 
           type:"POST",
           data:obJson, 
           beforeSend: function(){

           }, success:function(data){
           
            
               

           }

    });
    objChk.disabled = true;
    objChk.style.backgroundColor = '#999';
    objChk.style.cursor = 'not-allowed';
    objChk.style.opacity = '0.7';

      }

    
    console.log("Estado de anulado " + anular );
  }

  // funcion para escribir la cantidad de  productos  
  function escribeCantidad(ValBoton){    
    const objTexCantidadVenta  =   document.getElementById('cantidadVenta');
    if(objTexCantidadVenta.value =="0"){
       objTexCantidadVenta.value ="";
    }
    objTexCantidadVenta.select();
    objTexCantidadVenta.value =  objTexCantidadVenta.value +  ValBoton.value ;
  }
  // funcio para  limpiar la caja de texto  
  function limpiaCantidad(){
    const objTexCantidadVenta  =   document.getElementById('cantidadVenta');
    objTexCantidadVenta.value = "" ;
    objTexCantidadVenta.select();
  }

   // funcionm para mostrar el detalle de la mesa pendiente de  cobro 
  function mostrarPendientesCobro1(mesaID){
    console.log("El detalle de la mesa a mostrar es  " + mesaID ) ;   
    var url = base_url('index.php/Ordenes_Controller/listaOrdenesPendienteCobro/');
    obJson = { mesaID:mesaID};
    $.ajax({
           url: url, 
           type:"POST",
           data:obJson, 
           beforeSend: function(){
           }, success:function(data){
            $("#ordenesPendientesDespacho").html(data);
            iniciarContadoresEspera();
           }
    });

  }
  // funcion para poner marca de cobro a un producto // todos los productos ya  cobrados yano se podran marcar de  nuevo // poner bandera de finalizado a tosdos aquellos ya marcados  
  function  cobrarOrden(c, detPedID, ordenPedidoID){
    var ordenPedidoID = ordenPedidoID ;
    console.log("llenago al proceso de cobrar la orden ") ;
    let estado = 0;
    var detPedID = detPedID;
    var  objChk = document.getElementById('Cobrar'+c);
    if (objChk ){
      if(objChk.checked){
        estado=1;
      }
        var url = base_url('index.php/Ordenes_Controller/cobrarOrden/' );
         obJson = { detPedID:detPedID, estado:estado, ordenPedidoID:ordenPedidoID};
         $.ajax({
           url: url, 
           type:"POST",
           data:obJson, 
           beforeSend: function(){
           }, success:function(data){ 
              console.log("la orden es" + ordenPedidoID )  ;         
             document.getElementById('total' + ordenPedidoID).textContent ="TOTAL A CANCELAR $"  + data  ;
             console.log("la suma A OBRAR ES es  " + data);
           }
    });
     // }

    }
   // console.log("Estado de anulado " + anular );
  }

  // funcion que muestra la modal para realizar el abono 

   function mostrarModalAbono(ordenPedidoID){
     $('#addAbonoPedido').modal('show');
     $("#ordenPedidoID").val(ordenPedidoID) ;
    // ordenPedidoID

   

  } 


  // funcion para abonar orden 
   function abonarOrden(){ 


         var ordPAbono  =  $("#ordPAbono").val(); //  10;
         var ordenPedidoID  = $("#ordenPedidoID").val(); //  10;
         const select =  document.getElementById('mesaCobrar') ;//  (document.getElementById('mesaCobrar')) ? document.getElementById('mesaCobrar').value : "" ; 
         
         console.log("LA ORDEN A ABONAR ES " + ordenPedidoID  ) ;

        var url = base_url('index.php/Ordenes_Controller/abonarOrden/' );         
         var  obJson = { ordPAbono:ordPAbono, ordenPedidoID:ordenPedidoID};
         $.ajax({
           url: url, 
           type:"POST",
           data:obJson, 
           beforeSend: function(){
           }, success:function(data){ 
             $("#addAbonoPedido.close").click();
              $(".modal-backdrop").remove(); 
              mostrarPendientesCobro(select);    
           }
       
       });
      }

      function procesarPedido(ordenPedidoID){ 
        console.log("la orden a procesar es " + ordenPedidoID )  ;  

        var url = base_url('index.php/Ordenes_Controller/procesarPedido/' + ordenPedidoID );         
         
         $.ajax({
           url: url, 
           type:"POST",
           beforeSend: function(){
           }, success:function(data){ 
            

           }
       
       });
      }

      // funcion para mostrar las ordenes pendientes de despacho  por el  id de la mesa  
      function mostrarPendientesDespachomesaID(mesaID){
    var mesaID  = mesaID  ; //select.value;
    console.log("El detalle de la mesa a mostrar es 100000 " + mesaID ) ;   
    var url = base_url('index.php/Ordenes_Controller/listaOrdenesPendienteDespacho/');
    obJson = { mesaID:mesaID};
    $.ajax({
           url: url, 
           type:"POST",
           data:obJson, 
           beforeSend: function(){
           }, success:function(data){
            console.log(data)       ;
            $("#ordenesPendientesDespacho").html(data);
            iniciarContadoresEspera();
           }
    });

  }
  function mostrarResumenMesa(mesaIdCobro){
   console.log("Preparando para  mostrar la modal") ;
   var url = base_url('index.php/Ordenes_Controller/resumenProductosMesa/' +mesaIdCobro);
   // obJson = { mesaID:mesaID};
    $.ajax({
           url: url, 
           type:"get",
          // data:obJson, 
           beforeSend: function(){
           }, success:function(data){
              console.log(data) ;
            $("#divResumenPorMesa").html(data);
            $('#ResumenOrden').modal('show');
           }});
  }


  /*function  anularOrdenEnLista(){
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

 }*/










