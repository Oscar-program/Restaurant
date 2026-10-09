function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
// funcion para determinar si la presentacion de  u producto ya se  encuentra  registrada  
 /*mostrar el  detalle de las marcas  */
 function getunidadPresentacion(){
    console.log("Funcion que  retorna la unidad de producto de la presentacion selccionada ");
    var producto         = 0;
    var prodPresentacion = 0;
     if(document.getElementById('producto')){
        producto = $("#producto").val();
     }
     if(document.getElementById('prodPresentacion')){
        prodPresentacion = $("#prodPresentacion").val();
     }

    var url = base_url('index.php/prodPresentacion_Controller/getunidadPresentacion/' + producto + "/" +  prodPresentacion );
  
  //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
         // $("#detPresentacion").html(data);
         if(data!=0){
            $("#unidadespresentacion").val(data)
         }else{
            swal("La presentacion que ha selecciondo no  tiene  unidades equivalentes",{
                icon: "error",
              });
         }

      });
  
}
