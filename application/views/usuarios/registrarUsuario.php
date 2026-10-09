<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css"> -->
  <!-- icheck bootstrap -->
  <!--<link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="../../dist/css/adminlte.min.css"> -->
  <script src=" <?php echo  base_url();?>js/login.js"></script>

  <style>
        
          
          #Email::placeholder {
            color: white;
          }
          
          #Fullname::placeholder{
            color: white;
          }

          #password::placeholder{
            color: white;
          }

          #Rpassword::placeholder{
            color: white;
          }

      </style>

</head>
<!--<body style="background-color:red ;  display:flex; justify-content:center; align-items:center;"  > -->
<div class="register-box" style="border-radius: 20px; background-color:steelblue;  margin:0 auto;">
  
  <div class="card card-outline card-primary"   style="background-color:white ;  border-radius: 20px;  " >
    <div class="card-header text-center" >
      <a href="" class="h1"><b>Nuevo</b> Usuario </a>
    </div>
    <div class="card-body"  style="background-color:dodgerblue ; border-radius: 30px 30px 10px  10px ; ">
      <p class="login-box-msg"  style="color:dodgerblue;">Registrar nuevo usuario</p>

      <form action="javascript:saveUser()" method="post">
        <input type="hidden"  name="usuarioID" id="usuarioID" >
        <div class="input-group mb-3" style=" border-radius: 0px 20px 20px  0px ; ">
            <div class="input-group-append" >            
            <div class="input-group-text" style="background-color:white ; color: steelblue ; border-radius: 20px 0px 0px  20px ;">            
              <span class="fas fa-user"></span>
            </div>
           </div>
           <input type="text" class="form-control" placeholder="Full name" name ="Fullname" id="Fullname"  style=" border-radius: 0px 20px 20px  0px ; background-color:dodgerblue; border-color:white ; color:white; "  required>
          
        </div>
        <div class="input-group mb-3">
          
          <div class="input-group-append">
            <div class="input-group-text" style="background-color:white ; color: steelblue ; border-radius: 20px 0px 0px  20px ;"> 
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <input type="email" class="form-control"  name ="Email" id  = "Email" placeholder="Email" style=" border-radius: 0px 20px 20px  0px ; background-color:dodgerblue; border-color:white ; color:white; " required >
        </div>
       
        <div class="input-group mb-3">          
          <div class="input-group-append">
            <div class="input-group-text" style="background-color:white ; color: steelblue ; border-radius: 20px 0px 0px  20px ;"> 
              <span class="fa fa-tag"></span>
            </div>
          </div>
          <select name="niveluser" id="niveluser" class="form-control" style=" background-color:dodgerblue; border-color:white ; color:white; border-radius: 0px 20px 20px  0px ; " required>
          <OPtion value="0">Seleccione el  nivel de usuario</OPtion>
          <?php 
           if(isset($listNivelusuario)  and  !empty($listNivelusuario)){
             foreach ($listNivelusuario as $key => $value) { ?>
              <OPtion value="<?php  echo  $value->nivelUsuarioID ?>"><?php  echo  $value->nivel ?></OPtion>
           
             <?php }}
          ?>
            <OPtion value="1">Administrador</OPtion>
            <OPtion value="2">Invitado</OPtion>
          </select>
        </div>
        <div class="input-group mb-3">
         
          <div class="input-group-append">
            <div class="input-group-text" style="background-color:white ; color: steelblue ; border-radius: 20px 0px 0px  20px ;"> 
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <input type="password" class="form-control" name ="password"  id  ="password" placeholder="Password" style=" border-radius: 0px 20px 20px  0px ; background-color:dodgerblue; border-color:white ; color:white; " required >
        </div>
        <div class="input-group mb-3">
          
          <div class="input-group-append">
            <div class="input-group-text" style="background-color:white ; color: steelblue ; border-radius: 20px 0px 0px  20px ;"> 
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <input type="password" name ="Rpassword" id  ="Rpassword" class="form-control" placeholder="Retype password" style=" border-radius: 0px 20px 20px  0px ; background-color:dodgerblue; border-color:white ; color:white; " required >
        </div>
        <div class="row">
         <!-- <div class="col-8">
            <div class="icheck-primary">
               <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms" style="color:white;" >
               I agree to the <a href="#" style="color:white;">terms</a>
              </label>
            </div>
          </div>-->
          <br>
          <br>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" style="background-color:white; color: midnightblue; border-radius:20px;" >Registrar </button>
          </div>
          <br>
          <!-- /.col -->
        </div>
      </form>

     <!--  <div class="social-auth-links text-center">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div> 

      <a href="login.html" class="text-center">I already have a membership</a> -->
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<!--<script src="../../plugins/jquery/jquery.min.js"></script> -->
<!-- Bootstrap 4 -->
<!--<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- AdminLTE App -->
<!--<script src="../../dist/js/adminlte.min.js"></script> -->
<!-- </body> -->
</html>