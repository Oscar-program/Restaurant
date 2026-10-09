
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aceeso al Sistema</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  
  <!-- icheck bootstrap -->

  <!-- 
     <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
   -->
 

   <!-- Font Awesome -->
   <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="./plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="./plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.css">
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <link rel="stylesheet" href="./docs/assets/css/adminlte.css">
  <link rel="stylesheet" href="./docs/assets/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="./plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="./plugins/summernote/summernote-bs4.min.css">
  
  <script src="./js/funciones_basica.js"></script>
  <script src=" <?php echo  base_url();?>js/login.js"></script>
  <script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js "> </script>
  <script src ="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
</head>
<body class="hold-transition login-page" style =  "background-image: url(./img/logoCentral.png); background-repeat: no-repeat;background-size: cover;">
<div class="login-box" style="background-color:#1D59B0;  box-shadow: 5px 5px 15px #ffffff ; border-radius: 20px; opacity: 0.9;">
  <div class="login-logo">
    <a href="javaScript:carga_principal()" style="font-weight:bold; color:#1D59B0; font-size: 40px; text-shadow:
    1px 1px 2px black,
    0 0 1em blue,
    0 0 0.2em blue;
  color: white;"><b>NUEVO </b>ESTABLO</a>
  <br>
 

  </div>
  <!-- /.login-logo -->
   <!--  border-radius:50px 0px 15px 15px; opacity: 0.9;--> 
  <div class="card" style="background-color:#1D59B0 ; border-radius:0px 0px 15px 15px;  box-shadow: 5px 5px 15px #111111 ;">
    <div class="card-body login-card-body" style="background-color:white;">
      <br>
      <p class="login-box-msg" style="color:white; font-weight:bold;">Registrarse para iniciar session</p>
     <!--   action="index.php/Welcome/principal/"   action="javascript:validaUser()"  -->
      <form method="post" action="javascript:validaUser()">
        <div class="input-group mb-3">
          <input type="text"   id   ="user"   name  ="user"  class="form-control" placeholder="usuario" style="border-radius: 20px; background-color:#1D59B0 ; color:white">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-user" style="color:#1D59B0"></span>
              

            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password"  id  = "pwd" name  = "pwd" class="form-control" placeholder="Password" style="border-radius: 20px; background-color:#1D59B0 ; color:white">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock" style="color:#1D59B0"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
            <select name="establecimiento" id="establecimiento" class="form-control" style="border-radius: 20px;">
             <?php   foreach($establecimientos as $row): ?>
              <option value="<?php echo  $row->establecimientoID ?>">
              <?php echo  $row->establecimientoID .  '-'. $row->estNombre;  ?>  
              </option>
              <?php endforeach ?>
            </select>
          
          
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-filter" style="color:#1D59B0"></span>
            </div>
          </div>
        </div>

       

        <div class="row">
          <div class="col-10">
            <div class="icheck-primary">
              
            </div>
          </div>
          <!-- /.col -->
          <div class="col-2">
            <button type="submit" class="btn btn-primary btn-block-sm" style="color:#1D59B0; background-color:white;" >
            <i class="fa fa-key" aria-hidden="true"></i>
            </button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html" style="color:#1D59B0;">Reestablecer clave</a>
      </p>
      <p class="mb-0">
        <a href="javaScript:registerUser()" class="text-center" style="color:#1D59B0;">Registrar nuevo usuario</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->

<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
</body>
</html>