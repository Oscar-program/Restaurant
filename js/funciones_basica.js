
function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
function carga_principal(){
    console.log("cargand  funcion principal");
var  url  = base_url("index.php/Welcome/principal/");

//var  url  = 'http://127.0.0.1/index.php/BartioFran/Welcome/principal/';

$.ajax({
      url:url,
      type:"POST",
      data:'',
      success:function(data){
        //console.log(data);
      }
})

}
// funcion para cargar el  menu inteno Categoria de productos isponible  
function cargarmenu_interno(){
  console.log('intentando cargar el  menu interno');
  var url = base_url('index.php/Menu_internoController/index/');

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
/* funcion que  lee  el  area  de la  mesa  y  el  filtro  de  cocina  puestos  en la  pantalla  de  ordenes ,
   con  ellos  la  lista  de  productos  muestra  el  precio  del  area  y  filtra  prodctucocina = 1 */
function paramsListaProductos(){
  var areaID     = 0;
  var soloCocina = 0;
  if(document.getElementById('ctrlAreaID')){
    areaID = document.getElementById('ctrlAreaID').value;
  }
  if(document.getElementById('ctrlSoloCocina')){
    soloCocina = document.getElementById('ctrlSoloCocina').value;
  }
  if(areaID === "" || areaID === null || areaID === undefined){ areaID = 0; }
  if(soloCocina === "" || soloCocina === null || soloCocina === undefined){ soloCocina = 0; }
  return "/" + areaID + "/" + soloCocina;
}

/*funcion  para leer el  value del   div */
function cargar_listaProductos(id){
 // var id = "";
  var valSlect =  "";
  if(document.getElementById('familProd')){
    valSlect =  id.value;
  }else{
     valSlect =  id;
  }
  console.log("#ELEMENTO SELECCIONADO ###" + valSlect );

 // $("#principal"+id).val();
 // var valorid  = 0;
  //valorid = document.getElementById('familia'+id).dataset.value;
 // valorid = $('familia'+id).attr('data-value');
// valorid      = $("#familia").val();
 //console.log("se ha hecho  click"+ id  + " capturado");
 var url = base_url('index.php/Menu_internoController/cargar_submenu/' + valSlect + paramsListaProductos());

 //var url = base_url("index.php/BancosController/bancos");
   $.get(url, function (data) {
    document.getElementById("listaProductos").innerHTML = "";
    console.log(data);
     $("#listaProductos").html(data);
   });

}

function cargar_listaProductos1(id){
  console.log("se ha seleccionado del card " + id) ;
 // var id = "";
  /*var valSlect =  "";
  if(document.getElementById('familProd')){
    valSlect =  id.value;
  }else{
     valSlect =  id;
  }*/
  //console.log("#ELEMENTO SELECCIONADO ###" + id );

 // $("#principal"+id).val();
 // var valorid  = 0;
  //valorid = document.getElementById('familia'+id).dataset.value;
 // valorid = $('familia'+id).attr('data-value');
// valorid      = $("#familia").val();
 //console.log("se ha hecho  click"+ id  + " capturado");
 var url = base_url('index.php/Menu_internoController/cargar_submenu/' + id + paramsListaProductos());

 //var url = base_url("index.php/BancosController/bancos");
   $.get(url, function (data) {
    document.getElementById("listas"+id).innerHTML = "";
    console.log(data);
     $("#listas"+id).html(data);
     $('#selectProd').hide();
   });

}


