function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}

 //   funcion ára  mostrar la  lista general  de  compras 
 function indicadorExistenciaProd(){
        
  /*Determinamos si  los datos del  producto ya existen */
  //var valorid         = 0;  
  //var productoID      =  null;  
  //var idCompratmp     =  $("#idCompra").val();  
  console.log("Mostrando el  indicador de   inventarios");
  var url = base_url('index.php/invProducto_Controller/indicadorExistenciaProd');

  //var url = base_url("index.php/BancosController/bancos");
  $.get(url, function (data) {
      $("#principal").html(data);
           
  });

}
//  funcion  para mostrar la ventana para iniciar el  inventario de los producto 
function iniciarInventario(){
        
    /*Determinamos si  los datos del  producto ya existen */
    //var valorid         = 0;  
    //var productoID      =  null;  
    //var idCompratmp     =  $("#idCompra").val();  
    console.log("Mostrando  inventarios");
    var url = base_url('index.php/invProducto_Controller/iniciarInventario');
  
    //var url = base_url("index.php/BancosController/bancos");
    $.get(url, function (data) {
        $("#principal").html(data);
             
    });
  
  }

  function capturarExistencia(){
        
    /*Determinamos si  los datos del  producto ya existen */
    //var valorid         = 0;  
    //var productoID      =  null;  
    //var idCompratmp     =  $("#idCompra").val();  
    console.log("Mostrando  inventarios");
    var url = base_url('index.php/invProducto_Controller/capturarExistencia');
  
    //var url = base_url("index.php/BancosController/bancos");
    $.get(url, function (data) {
        $("#principal").html(data);
             
    });
  
  }
 



  
