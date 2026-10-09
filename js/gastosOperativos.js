function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}

//  funcion para mostrar la vista  principal para iniciar el  ingreso de  gastos 
function  iniciarGastos(){
  var url = base_url('index.php/gastos_Controller/iniciargastos/');
  $.get(url, function (data) {
    $("#principal").html(data);
    $("#btncerrargasto").css("display", "none");
    document.getElementById('btnsavedet').disabled = true;
    $("#btnguardar").css("display", "none");
  });
}

//  funcion para mostrar el  detalle de los  gastos 
function  detalleGastos(gastoID){
    var url = base_url('index.php/gastos_Controller/addDetgasto/'); 
    $.get(url, function (data) {
      $("#principal").html(data);
      $("#IdGasto").val(gastoID);
    });
}
//  funcion para guardar la cabecera el inventario 
 function  guardarGastos(){
   console.log('llegando a la funcion para almacenar la cabecera de los  gatos')
   var formData = '';
   console.log('Guardando el encabezado de los gastos');
   if (document.getElementById('FormGastos')) {
     formData = new FormData($(".FormGastos")[0]);
   }
   url_destino = "index.php/gastos_Controller/guardarGastos/";
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
       console.log('El retorno despues de guardar la cabecera es ' + data + ' es id');
       alertify.set("notifier", "position", "top-right");
       alertify.success("Registro guardo correctamente");
       $("#gastosID").val(data);
       $("#gastosIDdet").val(data);
     },
     complete: function (data) {
       // Show image container
       $("#loader").css("display", "none");
       $("#btnguardar").css("display", "none");
       $("#btncerrargasto").css("display", "none");
      // document.getElementById('btnsavedet').disabled = false;
       document.getElementById('btnguardar').disabled = true;

     }
   });
 }

// funcion para guardar el detalle  de gastos 
function  guardarDetGastos(){
  var formData = "";    
    if(document.getElementById('FormDetGastos')) {
      formData = new FormData($(".FormDetGastos")[0]);    
    }else{
      
    }               
     url_destino = "index.php/gastos_Controller/saveDetGastos/";
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
        //console.log(data);
        document.getElementById('mostrarTabla').innerHTML = '';
        $("#mostrarTabla").html(data);
      },
      complete: function () {
   
        $("#cantidadgasto").val('');
        $("#preciogasto").val('');
        $("#totalDet").val('');
        $("#descripcionDetGast").val("");
        $("#detgastosID").val(0);
        $("#btncerrargasto").css("display", "block");
        
      }
    });
 }
 // listar detalle de gastos 
 function  listarDetGastos(){
  var url = base_url('index.php/gastos_Controller/listarDetGastos/'); 
  $.get(url, function (data) {
    $("#principal").html(data);
    //$("#IdGasto").val(gastoID);
  });
}

//  funcion  para calcular el  total detGasto por item
function  calTotalItemGasto(e){

 if(e.keyCode===13){
  

   var cantidadgasto = parseFloat($("#cantidadgasto").val());
   var preciogasto   = parseFloat($("#preciogasto").val());
   var total         = (preciogasto) * cantidadgasto;   
   $("#totalDet").val(parseFloat(total).toFixed(2));
   e.preventDefault();

 }
}
// funcion para cerrar la cabecera de los  gastos  
function cerrarGastos(){
  var url_destino ='index.php/gastos_Controller/cerrarGastos/';
  var gastosID    = 0; 

     console.log('Cerrando ..........  los gastos');
    if(document.getElementById('gastosID')){
      gastosID = $("#gastosID").val()
    }
    DJSon  = {gastosID:gastosID};   
     $.ajax({
      url: base_url(url_destino),
      type: "POST",
      data: DJSon,
     // cache: false,
     // contentType: false,
      //processData: false,
      beforeSend: function () {
        // Show image container
        $("#loader").css("display", "block");
      },
      success: function (data) {
        console.log('Retorno despues de actualizar la cabecesa ' + data + ' es id');       
        alertify.set("notifier", "position", "top-right");
        alertify.success("El ingreso de gasto se ha cerrado");
        //$("btnsavedet").disabled=true;
        //$("#btncerrargasto").disabled=true;
        document.getElementById('btncerrargasto').disabled = true;
        document.getElementById('btnsavedet').disabled = true;
        document.getElementById('btnguardar').disabled = true;
      },
      complete: function (data) {
        // Show image container
        $("#loader").css("display", "none");       
      }
    });

}
function editDetGastos(detgastosID){

  var url_destino ='index.php/gastos_Controller/editDetGastos/'
  //var detgastosID = detgastosID    = 0; 

     console.log('Editando el detalle de los gastos');
    if(document.getElementById('gastosID')){
      gastosID = $("#gastosID").val()
    }
    DJSon  = {detgastosID:detgastosID};   
     $.ajax({
      url: base_url(url_destino),
      type: "POST",
      data: DJSon,
      dataType : 'json',

     // cache: false,
     // contentType: false,
      //processData: false,
      beforeSend: function () {
        // Show image container
        $("#loader").css("display", "block");
      },
      success: function (data) {

        console.log('Retorno despues de actualizar la cabecesa ' + data[0].descDetGasto + ' es id'); 
        
        $("#detgastosID").val(data[0].detgastosID );
        $("#cantidadgasto").val(data[0].cantidad );
        $("#preciogasto").val(parseFloat(data[0].precio) );
        $("#totalDet").val(parseFloat(data[0].total) );
        $("#descripcionDetGast").val(data[0].descDetGasto );
      },
      complete: function (data) {
        // Show image container
        $("#loader").css("display", "none");       
      }
    });


}
//  funcion paa elimina un detalle de  gastos  
function delDetGasto(detgastosID){
    var gastosIDdet =0;
   if( document.getElementById('gastosIDdet')){
    gastosIDdet =$("#gastosIDdet").val();
   } 

  swal({
    title: "Estas seguro de elimnar el  registro ?",
    text: "Este proceso eliminara el  registro de base  de  datos",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((Delete) => {
    if (Delete) {
                var url = base_url(
                  "index.php/gastos_Controller/delDetGasto/" + detgastosID + "/" + gastosIDdet
                );
                $.get(url, function (data) {
                  if (data == 0) {
                        swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Surgio un error al  eliminar el  registro',														
                        });
                  } else {
                    swal("Registro eliminado corectamente", {
                      icon: "success",
                    });
                    document.getElementById('mostrarTabla').innerHTML = '';
                    $("#mostrarTabla").html(data);
                  }
  
                });				
    } else {
      swal("Operacion  cancelada",{
        icon: "success",
      });
    }
  });
} 
// funcion  para calcular el total del  detalle de la compra  
function calculartotalDetgasto(e){
  //if(e.keyCode===13){ 
     console.log("disparando el evento de calculo");
    var ejecutar      = "S";
    var totalDet      = 0 ;
    var cantidadgasto = parseFloat($("#cantidadgasto").val());
    var preciogasto   = parseFloat($("#preciogasto").val()); 
    if(cantidadgasto <= 0   || preciogasto <= 0 )  {
      ejecutar  ="N";
      alertify.set("notifier", "position", "top-right");
      alertify.error("Verifique los  valores ingresados, estos tiene que ser mayores de Cero");
      return false;
    }
  
    if(ejecutar  =="S"){
      totalDet = cantidadgasto  *  preciogasto;   
     $("#totalDet").val(parseFloat(totalDet));
    }
    
   // e.preventDefault();

 // }
 }
// funcion para  verificar el tab que se esta seleccionando 
function verificatabgasto(id){  
  switch (id) {
                 case 'one-tab':
                   mostrarDetalles();
                   break;
                 case 'two-tab':          
                 ListGastos();
                 break;
               }
}
// funcion para cargar la lista de gastos procesados
function ListGastos(){  
  var url = base_url('index.php/gastos_Controller/ListGastos/'); 
  $.get(url, function (data) {
    $("#cuerpolistagastos").html(data);
    //$("#IdGasto").val(gastoID);
  });
}
//  funcion para buscar el ultimo gasto que  no se cerrado , si esta abierto 
// retorna los datos de lo contrario notificara que se encuentra cerrado
function searGastos(){
  var fechaGasto ='';  
  if(document.getElementById('fechaGasto')){
      fechaGasto = $("#fechaGasto").val();
    }
    DJSon ={fechaGasto:fechaGasto};
  var url_destino = 'index.php/gastos_Controller/searGastos/'; 
     console.log("enviando  los datos para busca el gasto");
  $.ajax({
    url: base_url(url_destino),
    type: "POST",
    data: DJSon,
    dataType : 'json',

   // cache: false,
   // contentType: false,
    //processData: false,
    beforeSend: function () {
      // Show image container
      $("#loader").css("display", "block");
    },
    success: function (data) {
      if(data == 0){
        alert("Este dia  no tiene gastos  registrados,  favor verificar en lista de  gastos");
      }else{
        console.log('datos de  gasto abierto ' + data); 
      //console.log('datos de  gasto abierto ' + data[0].descDetGasto + ' es id'); 
      //sucursalGasto
      
      $("#sucursalGasto").val(data[0].establecimientoID );
      $("#sucursalGasto").change();
      $("#gastosID").val(data[0].gastosID );
      $("#gastosIDdet").val(data[0].gastosID );
      

      //$("#gastosID").val(data[0].gastosID );
      if(data[0].cerrado == 0){
        document.getElementById('btncerrargasto').disabled = false;
        $("#btncerrargasto").css("display", "block");
        $("#btnguardar").css("display", "none");
        listarDetGastos(data[0].gastosID);
        
      }else{
          alert("La cabecera del  gasto ya s encuentra  cerrada,  tiene que  habilitarlo para poderlo  editar");
      }
      }
      

     
    },
    complete: function (data) {
      // Show image container
      $("#loader").css("display", "none");       
    }
  });

    
  /*$.get(url, function (data) {
    $("#cuerpolistagastos").html(data);
    //$("#IdGasto").val(gastoID);
  });*/
}
//  funcion para listar el detalle de  los fastos 
function listarDetGastos(gastosID){
  var url = base_url('index.php/gastos_Controller/listarDetGastos/' + gastosID ); 
  $.get(url, function (data) {
    document.getElementById('mostrarTabla').innerHTML = '';
    $("#mostrarTabla").html(data);
  });

 


}
// funcion para  habilitar los gastos 
function habilitarCabeceraGasto(gastosID){
  var url = base_url('index.php/gastos_Controller/habilitarCabeceraGasto/' + gastosID ); 
  $.get(url, function (data) {
    ListGastos();
    //document.getElementById('mostrarTabla').innerHTML = '';
    //$("#mostrarTabla").html(data);
  });

 


}
