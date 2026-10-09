function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
// funcion para  validar la existencia del  usuario en  la base  de datos 
function validaUser(){
    //  esto lo pasaremos por  Json para  evitar  mostrar  datos en  la  barra  direccione 
    console.log("Llegando a la funcion para  validar  al  usuarios"); 
    var user              = '';
    var pwd               = '';
    var  establecimID  ='';
    var url  = base_url('index.php/login_Controller/validaUser/');

    if(document.getElementById('user')){
        user =  $("#user").val();
    }
    if(document.getElementById('pwd')){
        pwd =  $("#pwd").val();
    }
    if(document.getElementById('establecimiento')){
        establecimID =  $("#establecimiento").val();
    }
    //console.log('EL esablecimiento seleccionado es ' + establecimiento  );   
    //alert('EL esablecimiento seleccionado es ' + establecimID )  ; 
    var DJson = { user:user, pwd:pwd, establecimID:establecimID };
  //  alert('los  datos enviados por el  Json son ' + DJson)  ; 
    $.ajax({
        url:url,
        type:"POST",
        data:DJson, 
        beforeSend:function(
        ){},
        success:function(data){
            if(data ==  0 ){
                swal("Los datos del usuario no  fueron encontrados",{
                    icon: "error",
                  });
            }else{
              window.location.href = base_url("index.php/Welcome/principal");              
            }
        },
        complete:function(){

        }

    });


}
//  funcion para  cerrar  la  sesion  del  usuario
function cerrarSession(){
    swal({
      title: "Desea cerrar la sesion ?",
      text: "Se cerrara la sesion y volvera a la pantalla de acceso",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((Cerrar) => {
      if (Cerrar) {
        window.location.href = base_url("index.php/login_Controller/cerrarSession");
      }
    });
}

function acceso(){
    var url = base_url('index.php/Welcome/principal/');
        $.get(url, function (data) {
        });
}
//  funcion para  registrar al usuarios  
function registerUser(){
     var url = base_url('index.php/Welcome/registerUser'); 
    $.get(url, function (data) {
        $("#principal").html(data);            
    });
}
// funcion para almacenar los  datos de los  nuevos usuarios 
function  saveUser(){
    console.log("Llegando a la funcion para  guardar los  datos de los  usuarios"); 
    var Fullname   =  "";
    var Email      =  "";
    var niveluser  =  "" ;
    var Password   =  "";
    var url  = base_url('index.php/login_Controller/saveUser/');
     if(document.getElementById('usuarioID')){
        usuarioID =  $("#usuarioID").val();
    }


    if(document.getElementById('Fullname')){
        Fullname =  $("#Fullname").val();
    }
    if(document.getElementById('Email')){
        Email =  $("#Email").val();
    }

    if(document.getElementById('niveluser')){
        niveluser =  $("#niveluser").val();
    }

    if(document.getElementById('password')){
        Password =  $("#password").val();
    }
    var DJson = {usuarioID:usuarioID,  Fullname: Fullname, Email:Email, niveluser:niveluser,  Password:Password };
    $.ajax({
        url:url,
        type:"POST",
        data:DJson, 
        beforeSend:function(
        ){},
        success:function(data){
          console.log("datos Almacenados  correctamente")
          listarUsuarios() ;
        },
        complete:function(){
        }
    });
}
function listarUsuarios(){
    var url = base_url('index.php/login_Controller/allUserSystem/'); 
    $.get(url, function (data) {
        $("#principal").html(data);            
    });
}

function  get_UserID(usuarioID){
     var url = base_url('index.php/login_Controller/get_UserID/' + usuarioID);
      $.get(url, function (data) {
            const  datos  =   JSON.parse(data); 
            var url = base_url('index.php/Welcome/registerUser'); 
            $.get(url, function (data) {
                $("#principal").html(data);
                  $("#usuarioID").val(datos['usuarioID'] ) ;
                  $("#usuarioID").show();
                  $("#Fullname").val(datos['usrNombre']);
                  $("#Email").val(datos['usrLogin']);             
                  $("#Password").val(datos['usrPwd']);
                  $("#niveluser").val(datos['nivelUsuarioID']); 
                  $("#niveluser").change(); 
                    
            });            
        });

}
function del_UserID(usuarioID){
     var url = base_url('index.php/login_Controller/del_UserID/' + usuarioID);
      $.get(url, function (data) {
         listarUsuarios();
      });

} 