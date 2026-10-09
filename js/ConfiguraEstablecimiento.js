 function base_url(url){
  return window.location.origin + "/BartioFran/"+ url;
}

 /*Cargando la  vista  de  configuracion de productos */
   function configurarProduct(){  
    console.log('llegando a la  configuracion del  producto');
    var url = base_url('index.php/productos_Controller/setthingProduct/');
  
  //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
          $("#principal").html(data);
      });
  
  
   }