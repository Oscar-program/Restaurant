function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
// funcion para listar los  traslados  realizados 
function  ListarTraslados(){
  var url = base_url('index.php/trasladoProducto_Controller/ListarTraslados/');

  //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
          $("#principal").html(data);
      });
  

}
 /*funcion para generar los traslados  */ 
 function addTrasladosProducto(){  
  console.log("iniciando la funcion de  traslado de  productos");
      //  creamos una variable de valor  aleatorio para crear el id  de la venta  
      var TrasladoId  =  new Date().getTime().toString();
      var  resultTrasID = TrasladoId.slice(-9);
      console.log('el id  generico es '+resultTrasID );

  var url = base_url('index.php/trasladoProducto_Controller/addTrasladosProducto/');

//var url = base_url("index.php/BancosController/bancos");
    $.get(url, function (data) {
        $("#principal").html(data);
        if(document.getElementById('trasladoID')){
          $("#trasladoID").val(resultTrasID);

        }
    });


 }




function saveTraslado() {
  // capturqamos los  valore del frmulario principal  ;
  var ejecutar  = "S";
  console.log("LLegando a la  funcion para almacenar el traslado");

  var productoID     = (document.getElementById("producto"))?  $("#producto").val() : 0;
  var bodProdOrigen  = (document.getElementById("bodOrigen"))?  $("#bodOrigen").val() : 0; 
  var bodProdDestino = (document.getElementById("bodDestino"))?  $("#bodDestino").val() : 0;  
  var unidMeTtrasl   = (document.getElementById("prodPresentacion"))?  $("#prodPresentacion").val() : 0;
  var cantidadTrasl  = (document.getElementById("cantidadTrasl"))?  $("#cantidadTrasl").val() : 0;        
  var cantidadProd   = (document.getElementById("cantidadProd"))?  $("#cantidadProd").val() : 0;

 
    var DJson         = {
                         productoID:productoID, bodProdOrigen:bodProdOrigen, 
                         bodProdDestino:bodProdDestino, unidMeTtrasl:unidMeTtrasl, cantidadTrasl:cantidadTrasl, cantidadProd:cantidadProd
                        };  
	url_destino       = "index.php/trasladoProducto_Controller/saveTraslado/";
	
	console.log("Almacenando el  traslado del producto  Origen " +bodProdOrigen +"Destino "+ bodProdDestino);
  if (bodProdOrigen == 0 || bodProdDestino == 0){
    console.log("Evaluando la suncionalidad de los select $$$$$$$$$$$$$$$$$$$$$$$$$$$$$");
      alertify.set("notifier", "position", "top-right");
      alertify.error("Tiene que selecionar tanto la bodega de origen y destino ");
      ejecutar  = "N"
      return  false;
  }
  if(unidMeTtrasl== 0){

  }
  if(ejecutar  == "S" ){
   
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
        alertify.set("notifier", "position", "top-right");
        alertify.success("Traslado efectuado correctamente");
       // $("#statusenvio" + identificador).val("Enviado")
        //$("#statusenvio" + identificador).css({ "background-color": "green", "color": "white", "opacity":" 0.75", });
       
      },
      complete: function () {
         
      }
    });
  }
	
	


}

//  funcion para trasladar productos a  excel  
function exportTableToExcel1(tableID, filename = ''){
  var downloadLink;
  var dataType = 'application/vnd.ms-excel';
  console.log("el nombre de la  tabla es" +  tableID);
  
  var tableSelect = document.getElementById(tableID);

  var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

  console.log("LLegando  a la  funcion para  exportar a excel");
  
  // Specify file name
  filename = filename?filename+'.xls':'excel_data.xls';
  
  // Create download link element
  downloadLink = document.createElement("a");
  
  document.body.appendChild(downloadLink);
  
  if(navigator.msSaveOrOpenBlob){
      var blob = new Blob(['ufeff', tableHTML], {
          type: dataType
      });
      navigator.msSaveOrOpenBlob( blob, filename);
  }else{
      // Create a link to the file
      downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
  
      // Setting the file name
      downloadLink.download = filename;
      
      //triggering the function
      downloadLink.click();
  }
}

// Exporta una tabla HTML a excel
function exportTableToExcel(tableID, filename) {
  // Tipo de exportación
  if (!filename) filename = 'excel_data.xls';
  let dataType = 'application/vnd.ms-excel';

  // Origen de los datos
  let tableSelect = document.getElementById(tableID);
  let tableHTML = tableSelect.outerHTML;
   
  // Crea el archivo descargable
  let blob = new Blob([tableHTML], {type: dataType});
  
  // Crea un enlace de descarga en el navegador
  if (window.navigator && window.navigator.msSaveOrOpenBlob) { // Descargar para IExplorer
    window.navigator.msSaveOrOpenBlob(blob, filename);
  } else { // Descargar para Chrome, Firefox, etc.
    let a = document.createElement("a");
    document.body.appendChild(a);
    a.style = "display: none";
    let csvUrl = URL.createObjectURL(blob);
    a.href = csvUrl;
    a.download = filename;
    a.click();
    URL.revokeObjectURL(a.href)
    a.remove();
  }
}
// funcion para  mostrar lista en movil 
// funcion para listar los  traslados  realizados 
function  Listamovil(){
  var url = base_url('index.php/trasladoProducto_Controller/Listamovil/');

  //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
          $("#principal").html(data);
      });
  

}
//  funcion para almacenar  nuevo traslado  
function savTraslado(){
  // captruamos el formulario que contiene los datos 
  console.log('LLegando a la funcion para almacenar el traslado');
  var formData ='';
    // formData = new FormData($(".FormDetGastos")[0]);    
     formData =  new FormData($(".formTraslados")[0]);

  // hacemos la peticion ajax  y   enviamos el json con los datos 
  
  url_destino = "index.php/TrasladoProducto_Controller/saveTraslado/";
  
  $.ajax({
            url: base_url(url_destino),  
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {},
            success: function(data) {
              console.log("Guardando los traslados");
            },
            complete: function(data) {}  

          });
}
// funcion que  activa y desactiva el  boton para procesar el tralado de  productos  
function activaBoton(){
  console.log("evaluando la funcionalidad del  boton de cantidad a trasladas");
  ($("#cantidadTrasl").val()>0)? document.getElementById('btnsavetraslado').disabled = false:  document.getElementById('btnsavetraslado').disabled = true;
 
    //btnsavetraslado
  
}
 // Funcion para  inicar la toma   y procesamiento de los traslados 
 function ingresarTraslados(){
        
  /*Determinamos si  los datos del  producto ya existen */
  //var valorid         = 0;  
  //var productoID      =  null;  
  //var idCompratmp     =  $("#idCompra").val();  
  console.log("Mostrando traslados de   inventarioseew");
  var url = base_url('index.php/trasladoProducto_Controller/ingresarTraslados');

  //var url = base_url("index.php/BancosController/bancos");
  $.get(url, function (data) {
      $("#principal").html(data);
      document.getElementById('btnsavetraslado').disabled = true
           
  });

}