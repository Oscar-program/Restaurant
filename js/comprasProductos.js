function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
// funcion verifica el  tabSeleccionado  
function verificaTabCompras(id){  
  switch (id) {
                 case 'one-tab':
                   mostrarDetalles();
                   break;
                 case 'two-tab':          
                 get_ListCompras();
                 break;
               }
}


 /*funcion para cargar l formulario principal de la compra, selecciona, fecha, tipo comprobantye  y proveedor    */ 
 function addCompraProducto(){  
  
  var url = base_url('index.php/compraProducto_Controller/addCompraProducto/');

    $.get(url, function (data) {
        $("#principal").html(data);
    
        document.getElementById('btnSaveCompra').disabled = true;
    });


 }


   // funcion  para  cargar la modal de ingreso de producto en  factura de compra  
   function addDetCompra(){
    console.log("Almacenando el detalle de la compra ");
        
        /*Determinamos si  los datos del  producto ya existen */
       // console.log("llegando a la funcion para mostrar los produtos que se ingresan a la compra##### ");       
       var url             = base_url('index.php/compraProducto_Controller/addDetCompra/');
       var writeInTable  = true;

       if($("#fechaCompra").val().length ==0){
          alertify.set("notifier", "position", "bottom-center");
          alertify.warning("Tiene que asignar una fecha");
          writeInTable  = false;
          //$("#msjError").show();
          
          return false; 
        }

        if($("#tipocomprobante").val()==0){
          alertify.set("notifier", "position", "bottom-center");
          alertify.warning("Tiene que seleccionar un tipo de comprobante");
          writeInTable  = false;
          $("#msjError").show();
          return false;
        }

        if($("#numcomprobante").val().length ==0){
          alertify.set("notifier", "position", "bottom-center");
          alertify.warning("Tiene ingresar un numero de comprobante");
          writeInTable  = false;
          // $("#msjError").show();
          return false;
        }

        if($("#proveedor").val()==0){
          alertify.set("notifier", "position", "bottom-center");
          alertify.warning("Tiene que seleccionar un proveedor");
          writeInTable  = false;
         // $("#msjError").show();
          return false;
        }

                           
        if(writeInTable  == true){
          $.ajax({
                        url: url ,
                        type: "POST",
                        data: $("#FormCompras").serialize(),
                        //cache: false,
                        //contentType: false,
                        //processData: false,
                        beforeSend: function(){},
                        success:function(data){
                        // console.log(data);
                        $("#conteModalDetCompra").html(data);          
                        $('#adddetProducCompra').modal('show');
                        },
                        complete:function(){}
                }) ;


        }
   
   }
   //   funcion ára  mostrar la  lista general  de  compras 
 function get_ListCompras(){
  console.log("Listando copras   ingresadas ");
  var fechaIni = (document.getElementById('fechaIni') &&  $("#fechaIni").val().length >0)? $("#fechaIni").val() : '';
  var fechaFin = (document.getElementById('fechaFin') &&  $("#fechaFin").val().length >0)? $("#fechaFin").val() : '';
  var objJson  = {fechaIni:fechaIni, fechaFin:fechaFin };
  var url      = base_url('index.php/CompraProducto_Controller/get_ListCompras');  
    $.ajax({
           url: url,
           data: objJson,
           method:'POST',
           success: function(data){
              $("#listaCompras").html(data);
           },
           error:function(error){
                console.log("Surgio  un error durante la ejecucion");
           }
    });
}






   function iniciaArr(){
        
    /*Determinamos si  los datos del  producto ya existen */
    var valorid  = 0;  
    var productoID      =  null;  
    var idCompratmp =  $("#idCompra").val();  
    console.log("llegando a la funcion para mostrar los produtos que se ingresan a la compra ");
    //var url = base_url('index.php/productos_Controller/addProductoCompra/');
    //adddetCompraarr
    var url = base_url('index.php/compraProducto_Controller/createArray/');

    //var url = base_url("index.php/BancosController/bancos");
    $.get(url, function (data) {
        //  comentado solo para  trabajar con el  array 
        /*$("#addProductCompra").html(data);
      
        $('#addProducCompra').modal('show');
        $("#idCompratmp").val(idCompratmp)    */    
    });

}

   /*Funcion para almacena El  producto */
   function saveDetCompra(){
    var idCompra       = 0;
    var productoID     = 0;
    var writeInTable   = true;   
    var formData;

       if($("#producto").val()==0){
          alertify.set("notifier", "position", "top-right");
          alertify.error("Tiene que seleccionar un producto");
          writeInTable  = false;
          return false; 
        }

        if($("#prodPresentacion").val()==0){
          alertify.set("notifier", "position", "top-right");
          alertify.error("Tiene que seleccionar una presenta de  producto");
          writeInTable  = false;
          return false;
        }

        if(parseInt($("#cantidad").val())<=0){
          alertify.set("notifier", "position", "top-right");
          alertify.error("Tiene ingresar una cantida mayor a cero");
          writeInTable  = false;
          return false;
        }

        if(parseFloat($("#preCosto").val())<=0){
          alertify.set("notifier", "position", "top-right");
          alertify.error("Tiene ingresar un precio costo mayor  a cero");
          writeInTable  = false;
          return false;
        }

  
    console.log('almacenando el detalle de la compra');
    if(writeInTable   == true){
      url_destino = "index.php/CompraProducto_Controller/saveDetCompra/";
      //formData    = new FormData($(".formAddProducCompra")[0]);
      formData    =$("#formAddProducCompra");
      $.ajax({
            url: base_url(url_destino),
            type: "POST",
            data: formData.serialize(),
            // cache: false,
            //contentType: false,
            //processData: false,
            beforeSend: function () {
              // Show image container
             // $("#loader").css("display", "block");
            },
            success: function (data) {
              console.log(data);
              var datosCompra =JSON.parse(data);          

              $("#gravadas").val(datosCompra['gravado']);
              $("#gravadas").change();
              $("#excentas").val(datosCompra['excento']);
              $("#excentas").change();
              $("#nosujetas").val(datosCompra['nosujeto']);
              $("#nosujetas").change();

              $("#compProdIva").val(datosCompra['impuestos']);
              $("#compProdIva").change();
              $("#compProdTotal").val(datosCompra['totalcompra']);
              $("#compProdTotal").change();

              idCompra =  datosCompra['compraProdID'];
              $("#compraProdID").val(datosCompra['compraProdID']); 
              
              
              


            //$("#codigoCliente").prop( "disabled", true);
              alertify.set("notifier", "position", "top-right");
              alertify.warning("El producto se guardo correctamente");
              //alertify.warning('Warning message');
            },
            complete: function () {
              // Show image container
              $("#loader").css("display", "none");
              $("#cantidad").val(0);
              $("#preCosto").val(0);
              document.getElementById('btnSaveCompra').disabled = false;
           
              //recalculartotal();
              get_ListTmp(idCompra);
             // $("#btnSaveCompra").css("display", "block");
            }
          });


    }   

     
            
   }
     
    function get_ListTmp(compraProdID){
      
      /*Determinamos si  los datos del  producto ya existen */
      console.log("llegando a la funcion para mostrar los produtos que se ingresan a la compra ");
      //var idCompra =  $("#compraProdID").val();  
      console.log("el id de la compra es " + compraProdID  );    
      var url = base_url('index.php/CompraProducto_Controller/get_ListTmp/'+ compraProdID);
     
      //var url = base_url("index.php/BancosController/bancos");
        $.get(url, function (data) {
          $("#detCompra").html(data);
          //  document.getElementById('prodDescripcion').innerHTML=descripcion
          //$('#addProducCompra').modal('show');        
        });
     
    }
     // Funcion para  recalcular la  sumatoria del  comprobante  
        
    function recalculartotal(){    
      /*Determinamos si  los datos del  producto ya existen */
      var valorid  = 0;  
      var idCompra =  $("#idCompra").val(); 
  
        console.log("llegando a la funcion para recalcular  la compra ");
      var url = base_url('index.php/compraProducto_Controller/get_sumastotaltmp/'+ idCompra );
     
      //var url = base_url("index.php/BancosController/bancos");
        $.get(url, function (data) {
          //console.log(data);
          var DatosCompra  =  JSON.parse(data);
          $("#sumas").val(DatosCompra['sumas']);
          $("#impuesto").val(DatosCompra['impuestos']);
          $("#total").val(DatosCompra['totalcompra']);
         
        //  document.getElementById('prodDescripcion').innerHTML=descripcion
          //$('#addProducCompra').modal('show');
         
        
        });
     
    }
    function saveCompraproducto(){
      console.log("procesando la compra ingresada "); 
    //  funcion para  guardar la cabecesra de la   venta 
    var proveedor        = 0;
    var fecha            = '';
    var sumas            = 0;
    var impuesto         = 0;
    var total            = 0; 
    var tipocomprobante  = 0;
    var numComprobante   = 0;
    var idCompratmp      = 0;
    console.log("procesando la compra ingresada "); 
    
    var objForm          = $("#FormCompras"); 
    url_destino = "index.php/compraProducto_Controller/saveTransacCompraproducto/";
               swal({
                title: "Estas seguro  procesara la compra ?",
                text: "Este proceso registra la compra en los inventarios ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              }).then((Delete) => {
                if (Delete) {
                            $.ajax({
                                    url: base_url(url_destino),
                                    type: "POST",
                                    data: objForm.serialize(),
                                    // cache: false,
                                    // contentType: false,
                                    // processData: false,
                                    dataType:'json',
                                    beforeSend: function () {
                                      console.log("encinado la  compra");
                                      // Show image container
                                     // $("#loader").css("display", "block");
                                    },
                                    success: function (data) {
                                      console.log(data)
                                      alertify.set("notifier", "position", "bottom-center");
                                      alertify.warning("Compra procesada correctamente");
          
                                      //$("#codigoCliente").prop( "disabled", true);
                                        //alertify.set("notifier", "position", "top-right");
                                        //alertify.success("El producto se guardo correctamente");
                                        var  compraProdID =  0 ;
                                        $("#compraProdID").val(compraProdID);

                                      
                                        $("#fechaCompra").val("");
                                        $("#tipocomprobante").val(0);
                                        $("#tipocomprobante").change();

                                        $("#numcomprobante").val("");
                                        $("#proveedor").val(0);
                                        $("#proveedor").change();

                                        $("#gravadas").val(0.0);
                                        $("#excentas").val(0.0);             
                                        $("#nosujetas").val(0.0);  
                                        $("#compProdIva").val(0.0);         
                                        $("#compProdTotal").val(0.0);
             

             


                                        get_ListTmp(compraProdID);
                                       

                                    
                                    },
                                    complete: function () {
                                      // Show image container
                                      $("#loader").css("display", "none");
                                      $("#cantidad").val(0);
                                      $("#preCosto").val(0);
                                     

                                      //get_ListCompras();                                  
                                      //recalculartotal();
                                      // get_ListTmp();                                    
                                    }
                                });                            			
                } else {
                  alertify.set("notifier", "position", "bottom-center");
                  alertify.notify('Operacion cancelada.', 'custom', 2, function(){console.log('dismissed');});

                  // alertify.warning("Compra procesada correctamente");
                }
              });
    }
    // funcion pone anulada una compra  
    function deletecompras(compraProdID){
       var url = base_url('index.php/CompraProducto_Controller/del_Compras/');
       swal({
                title: "Estas seguro  de anular la compra ?",
                text: "Este proceso anula la compra ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              }).then((Delete) => {
                    if (Delete) {
                                var objJson = {compraProdID:compraProdID};
                                $.ajax({
                                          url: url,
                                          data: objJson, 
                                          method: 'POST',
                                          dataType:'json',
                                          success: function(response){
                                                              //console.log( "Registros anulados" + response['xAnulados']);
                                                                  alertify.set("notifier", "position", "bottom-center");
                                                                  alertify.warning("Anulación procesada correctamente");
                                                                  get_ListCompras();
                                                                }
                                      });
                    }else {
                              alertify.set("notifier", "position", "bottom-center");
                              alertify.warning('Operacion cancelada.', 'custom', 2, function(){console.log('dismissed');});
                    }
                    });        


     
      
         
        
       


    }

    
   

