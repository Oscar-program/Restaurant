function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}

function LoadviewConteoFisico(){
  var url = base_url("index.php/ConteoFisico_Controller/capturaConteo/");
    $.get(url, function (data) {
        $("#principal").html(data);
    });
}

// dispatcher: si estamos editando un detalle actualiza, si no agrega uno nuevo
function procesarConteoFisico(){
    var detConteoID = parseInt($("#detConteoID").val());
    if(detConteoID > 0){
        updateDetConteoFisico();
    }else{
        guardarConteoFisico1();
    }
}

// valida los campos del formulario del conteo
function validarConteo(){
    if( parseInt($("#turno").val()) == 0 || isNaN(parseInt($("#turno").val())) ){
         alertify.set("notifier", "position", "bottom-center");
         alertify.error("Tiene que seleccionar un turno");
        return false;
    }
    if( parseInt($("#bodega").val()) == 0 || isNaN(parseInt($("#bodega").val())) ){
         alertify.set("notifier", "position", "bottom-center");
         alertify.error("Tiene que seleccionar una bodega");
        return false;
    }
    if( parseInt($("#producto").val()) == 0 || isNaN(parseInt($("#producto").val())) ){
         alertify.set("notifier", "position", "bottom-center");
         alertify.error("Tiene que seleccionar un producto");
        return false;
    }
    if( ($("#existenciaF").val().length) == 0 ){
          alertify.set("notifier", "position", "bottom-center");
         alertify.error("El conteo físico final es obligatorio");
        return false;
    }
    return true;
}

// funcion que almacena la cabecera y el detalle del conteo
function guardarConteoFisico1(){
    if( !validarConteo() ){ return false; }
    var  url  =  base_url("index.php/ConteoFisico_Controller/insertar_conteo/");
    $.ajax({
          url: url,
          type:"POST",
          data: $("#FormConteoFisico").serialize(),
          datatype:"json",
          success: function(data){
             if(data["nError"]=="200"){
                 alertify.set("notifier", "position", "bottom-center");
                 alertify.success("Conteo procesado correctamente");
                 $("#conteoID").val(data["conteoID"]);
                 $("#detConteoID").val(0);
                 get_listaDetConteo(data["conteoID"]) ;
                 limpiarLinea();
             }else {
                alertify.set("notifier", "position", "bottom-center");
                alertify.error(data["msgError"]);
             }
          }
    });
}

// funcion que actualiza un detalle del conteo
function  updateDetConteoFisico(){
    if( !validarConteo() ){ return false; }
    var  url  =  base_url("index.php/ConteoFisico_Controller/updateDetConteoFisico/");
    var conteoID = $("#conteoID").val();
    $.ajax({
          url: url,
          type:"POST",
          data: $("#FormConteoFisico").serialize(),
          datatype:"json",
          success: function(data){
             if(data["nError"]=="200"){
                 alertify.set("notifier", "position", "bottom-center");
                 alertify.success("Conteo actualizado correctamente");
                 $("#detConteoID").val(0);
                 get_listaDetConteo(conteoID) ;
                 limpiarLinea();
             }else {
                alertify.set("notifier", "position", "bottom-center");
                alertify.error(data["msgError"]);
             }
          }
    });
}

// limpia solamente los campos de la linea de producto (mantiene la cabecera)
function limpiarLinea(){
    $("#producto").val(0);
    $("#producto").change();
    $("#tcierreant").val("");
    $("#existenciaF").val("");
    $("#aberia").val(0);
    $("#refil").val(0);
    $("#stockf").val("");
}

// inicia un nuevo conteo (limpia cabecera y detalle)
function nuevoConteo(){
    $("#conteoID").val(0);
    $("#detConteoID").val(0);
    $("#turno").val(0);
    $("#bodega").val(0);
    limpiarLinea();
    $("#detConteo").html("");
}

// carga el detalle de un conteo en la tabla de la pestaña de ingreso
function  get_listaDetConteo(conteoID){
    var url = base_url('index.php/ConteoFisico_Controller/get_listaDetConteo/'+ conteoID);
        $.get(url, function (data) {
          $("#detConteo").html(data);
        });
}

// arrastra el ultimo conteo final del producto/bodega como conteo inicial
function cargarCierreAnterior(){
    var producto = parseInt($("#producto").val());
    var bodega   = parseInt($("#bodega").val());
    if( isNaN(producto) || producto == 0 || isNaN(bodega) || bodega == 0 ){ return false; }
    // en modo edicion no se sobreescribe el conteo inicial ya cargado
    if( parseInt($("#detConteoID").val()) > 0 ){ return false; }
    var url = base_url("index.php/ConteoFisico_Controller/get_cierreAnterior/");
    $.ajax({
        url: url,
        type: "POST",
        data: {producto:producto, bodega:bodega},
        datatype:"json",
        success: function(data){
            var res = (typeof data == "string") ? JSON.parse(data) : data;
            $("#tcierreant").val(res["tcierreant"]);
            calcularexistenciaReal();
        }
    });
}

// busca los conteos en un rango de fechas
function getlistaConteo(){
    var FechIncio =  ($("#FechIncio").val().length>0 ) ? $("#FechIncio").val() : "";
    var FechFin   =  ($("#FechFin").val().length>0 )   ? $("#FechFin").val() : "";
    if(FechIncio.length== 0 ||  FechFin.length ==  0 ){
        alertify.set("notifier", "position", "bottom-center");
        alertify.error("Las fechas no pueden estar vacías");
        return   false;
    }
    var urlDest = "index.php/ConteoFisico_Controller/get_listaConteo/";
    var datJson = {FechIncio:FechIncio, FechFin:FechFin};
    $.ajax({
             url: base_url(urlDest),
             type: "POST" ,
             data: datJson,
             success: function (data){
                $("#detListaConteo").html(data);
             }
     });
}

// carga un conteo existente en la pestaña de ingreso para agregar / editar lineas
function getDetConteo(conteoID){
    let tab = document.getElementById("one-tab");
    tab.click();
    $("#conteoID").val(conteoID);
    $("#detConteoID").val(0);
    get_listaDetConteo(conteoID);
}

// elimina un detalle (linea) del conteo
function  detDetalleConteoFisico(detConteoID){
     var  conteoID = 0;
     if(document.getElementById("conteoID")){ conteoID = $("#conteoID").val(); }
     var url = base_url('index.php/ConteoFisico_Controller/detDetalleConteoFisico/'+ detConteoID);
        $.get(url, function (data) {
            get_listaDetConteo(conteoID);
        });
}

// carga los datos de un detalle en el formulario para editarlo
function getDetConteoPorID(detConteoID){
          var urlDestino = base_url('index.php/ConteoFisico_Controller/edit_DetConteoID/'+ detConteoID);
          $.get(urlDestino, function (data) {
            var datos = (typeof data == "string") ? JSON.parse(data) : data;
            $("#detConteoID").val(datos["detConteoID"]);
            $("#conteoID").val(datos["conteoID"]);
            $("#tcierreant").val(datos["tcierreant"]);
            $("#existenciaF").val(datos["existenciaF"]);
            $("#aberia").val(datos["aberia"]);
            $("#refil").val(datos["refil"]);
            $("#stockf").val(datos["stockf"]);
            $("#producto").val(datos["productoID"]).change();
            $("#bodega").val(datos["bodegaProductoID"]);
            let tab = document.getElementById("one-tab");
            tab.click();
        });
}

// anula un conteo fisico completo
function anularConteo(conteoID){
    alertify.confirm("¿Desea anular este conteo físico?", function(){
        var url = base_url('index.php/ConteoFisico_Controller/anular_conteo/'+ conteoID);
        $.get(url, function (data) {
            alertify.set("notifier", "position", "bottom-center");
            alertify.success("Conteo anulado");
            getlistaConteo();
        });
    }, function(){ });
}

// genera el resumen del inventario actual por producto
function getResumenInventario(){
    var FechIncio =  ($("#FechIncioR").val().length>0 ) ? $("#FechIncioR").val() : "";
    var FechFin   =  ($("#FechFinR").val().length>0 )   ? $("#FechFinR").val() : "";
    if(FechIncio.length== 0 ||  FechFin.length ==  0 ){
        return   false;
    }
    var urlDest = "index.php/ConteoFisico_Controller/resumenInventario/";
    var datJson = {FechIncio:FechIncio, FechFin:FechFin};
    $.ajax({
             url: base_url(urlDest),
             type: "POST" ,
             data: datJson,
             success: function (data){
                $("#detResumen").html(data);
             }
     });
}
