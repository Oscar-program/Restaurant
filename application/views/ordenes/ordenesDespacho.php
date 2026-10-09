<?php  
?>
<!DOCTYPE html>
   <html lang="en">
   <head>
    <script>
        // Recarga la página cada 60,000 milisegundos (1 minuto)
        setInterval(function () {
           // get_OrdenesPendientesCobro();
            //location.reload();
            console.log("Recargando  la pagina") ;
        }, 60000);
    </script>

    <style>   
           /* .chk {
        font-size: 30px;
        cursor: pointer;
        text-align:right;
        margin-left:25px;
        }
        .chk input {
        margin-right: 2px;
        width: 25px;
        height:25px;
        }

          table {
        width: 60%;
        border-collapse: collapse;
        margin: 20px auto;
        font-family: Arial, sans-serif;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        thead {
            background-color: #2c3e50;
            color: #ffffff;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.05em;
        }

        tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        tbody tr:nth-child(even) {
            background-color: #f4f6f8;
        }

        tbody tr:hover {
            background-color: #e1f0ff;
            cursor: pointer;
        }*/

        .btn-elegante {
            width: 40%;
            height: 15%;
            background-color: #b4c555 ;  border-color:aliceblue; border-width:1px;
            color: #f5f5f5;
            border-radius: 50rem; /* estilo Bootstrap pill */
            padding: 0.55rem 1.6rem;
            font-weight: 500;
            box-shadow:
            0 0.5rem 1rem rgba(0, 0, 0, 0.25),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
          transition: all 0.25s ease-in-out;
        }

/* Hover */
.btn-elegante:hover {
 background-color: #ffffff;
  border-color: rgb(4, 38, 100);
  transform: translateY(-2px);
  box-shadow:
    0 0.75rem 1.25rem rgba(67, 130, 202, 0.35);
  color: #18191d;
}

/* Focus (accesibilidad Bootstrap) */
.btn-elegante:focus,
.btn-elegante:focus-visible {
  box-shadow:
    0 0 0 0.25rem rgba(13, 110, 253, 0.35),
    0 0.75rem 1.25rem rgba(0, 0, 0, 0.35);
}

/* Active */
/*.btn-elegante:active {
  background: linear-gradient(
    135deg,
    rgba(8, 80, 180, 0.95),
    rgba(237, 239, 241, 0.95)
  );
  transform: translateY(0);
  box-shadow:
    0 0.4rem 0.8rem rgba(0, 0, 0, 0.3);
}*/

    </style>

 	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"></script>  
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
   </head>
   <body>
<!--  style="float:left; text-align:justify; display: flex; align-items: center;height:75px; background-color:#21618C; background:linear-gradient(70deg,#1B2631 , #2196f3); box-shadow: 0px 0px 3px #21618C; "-->
    <div class ="container-fluid justify-content-center;"  style="background-color:  #ffffff;  width: 100%;">
      
  
        <div class ="row">
            

            <div class="col-12">
                                                <label for="mesa" class="col-form-label">Mesas:</label>
                                                <select name="mesaDespachar" id="mesaDespachar"  class="form-control chosen" onchange="mostrarPendientesDespacho(this)"> 
                                                    <option value ="0"> Seleccione una mesa</option> 

            <?php  if(isset($listaMesasPendientesCobro)){
                if(!empty($listaMesasPendientesCobro)){
                    foreach($listaMesasPendientesCobro as  $row){ ?>  
                     <option value="<?php echo $row->mesaID; ?>">
                                                        <?php echo $row->mesaID . " - " .  $row->mesNombre; ?>
                                                        </option>
                     
                    
            <?php }}} ?>
              </select>
        </div>
        <!-- class ="row" -->
         <div   id="ordenesPendientesDespacho" name="ordenesPendientesDespacho">
            
         
         </div>
         <div  id="detallePendienteDespacho" name="detallePendienteDespacho"  >
            
           
         </div>

       


    </div>
    
   </body>
   </html>  