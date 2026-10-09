<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  

    <script>

     $('#websendeos').stacktable();
</script>
   
</head>

<body>
<input type="text" placeholder="Ingresa algún parámetro..." class="form-control-md form-control" id="search" style="border-radius:20px;">
<br>
<table id="websendeos" class="table table-hover" style="border-width: 0px;" >
    <thead>
     <tr>
          <th>Tipo de web</th>
          <th>Formulario</th>
          <th>Cupón AdWords</th>
          <th>Valoración</th>
          <th>Demo</th>
     </tr>
</thead>
     <tbody>   
     <tr>
          <td>Web Endeos Cortesía</td>
          <td>No incluido</td>
          <td>No</td>
          <td>€</td>
         <!--<td><a href="#" target="_blank">Ver demo</a></td>-->
     </tr>
     <tr>
          <td>Web Endeos One Page</td>
          <td>Sí incluido</td>
          <td>No</td>
          <td>€€</td>
          <!-- <td><a href="#" target="_blank">Ver demo</a></td>-->
     </tr>
     <tr>
          <td>Web Endeos Estándar</td>
          <td>Sí incluido</td>
          <td>Sí</td>
          <td>€€€</td>
         <!--  <td><a href="#" target="_blank">Ver demo</a></td>-->
     </tr>
     <tr>
          <td>Web Endeos Profesional</td>
          <td>Sí incluido</td>
          <td>Sífasfs</td>
          <td>€€€€</td>
          <!-- <td><a href="#" target="_blank">Ver demo</a></td>-->
     </tr>
     <tr>
          <td>Web Endeos Cortesía</td>
          <td>No incluido</td>
          <td>No</td>
          <td>€</td>
         <!--<td><a href="#" target="_blank">Ver demo</a></td>-->
     </tr>
     <tr>
          <td>Web Endeos One Page</td>
          <td>Sí incluido</td>
          <td>No</td>
          <td>€€</td>
          <!-- <td><a href="#" target="_blank">Ver demo</a></td>-->
     </tr>
     <tr>
          <td>Web Endeos Estándar</td>
          <td>Sí incluido</td>
          <td>Sí</td>
          <td>€€€</td>
         <!--  <td><a href="#" target="_blank">Ver demo</a></td>-->
     </tr>
     <tr>
          <td>Web Endeos Profesional</td>
          <td>Sí incluido</td>
          <td>Sífasfs</td>
          <td>€€€€</td>
          <!-- <td><a href="#" target="_blank">Ver demo</a></td>-->
     </tr>
     <tr>
          <td>Web Endeos Cortesía</td>
          <td>No incluido</td>
          <td>No</td>
          <td>€</td>
         <!--<td><a href="#" target="_blank">Ver demo</a></td>-->
     </tr>
     <tr>
          <td>Web Endeos One Page</td>
          <td>Sí incluido</td>
          <td>No</td>
          <td>€€</td>
          <!-- <td><a href="#" target="_blank">Ver demo</a></td>-->
     </tr>
     <tr>
          <td>Web Endeos Estándar</td>
          <td>Sí incluido</td>
          <td>Sí</td>
          <td>€€€</td>
         <!--  <td><a href="#" target="_blank">Ver demo</a></td>-->
     </tr>
     <tr>
          <td>Web Endeos Profesional</td>
          <td>Sí incluido</td>
          <td>Sífasfs</td>
          <td>€€€€</td>
          <!-- <td><a href="#" target="_blank">Ver demo</a></td>-->
     </tr>
     <tr>
          <td>Web Endeos Cortesía</td>
          <td>No incluido</td>
          <td>No</td>
          <td>€</td>
         <!--<td><a href="#" target="_blank">Ver demo</a></td>-->
     </tr>
     <tr>
          <td>Web Endeos One Page</td>
          <td>Sí incluido</td>
          <td>No</td>
          <td>€€</td>
          <!-- <td><a href="#" target="_blank">Ver demo</a></td>-->
     </tr>
     <tr>
          <td>Web Endeos Estándar</td>
          <td>Sí incluido</td>
          <td>Sí</td>
          <td>€€€</td>
         <!--  <td><a href="#" target="_blank">Ver demo</a></td>-->
     </tr>
     <tr>
          <td>Web Endeos Profesional</td>
          <td>Sí incluido</td>
          <td>Sífasfs</td>
          <td>€€€€</td>
          <!-- <td><a href="#" target="_blank">Ver demo</a></td>-->
     </tr>
     <tr>
          <td>Web Endeos Cortesía</td>
          <td>No incluido</td>
          <td>No</td>
          <td>€</td>
         <!--<td><a href="#" target="_blank">Ver demo</a></td>-->
     </tr>
     <tr>
          <td>Web Endeos One Page</td>
          <td>Sí incluido</td>
          <td>No</td>
          <td>€€</td>
          <!-- <td><a href="#" target="_blank">Ver demo</a></td>-->
     </tr>
     <tr>
          <td>Web Endeos Estándar</td>
          <td>Sí incluido</td>
          <td>Sí</td>
          <td>€€€</td>
         <!--  <td><a href="#" target="_blank">Ver demo</a></td>-->
     </tr>
     <tr>
          <td>Web Endeos Profesional</td>
          <td>Sí incluido</td>
          <td>Sífasfs</td>
          <td>€€€€</td>
          <!-- <td><a href="#" target="_blank">Ver demo</a></td>-->
     </tr>
</tbody>  
 </table>
    
</body>

</html>
<script>
$(document).ready(function(){

$("#search").keyup(function(){

_this = this;



   /* $.each($("#websendeos tbody tr"), function() {

    if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)

    $(this).hide();

    else

    $(this).show();

    });*/

    $.each($("#websendeos tr th"), function() {

if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)

$(this).hide();

else

$(this).show();

});


});

});
    </script> 