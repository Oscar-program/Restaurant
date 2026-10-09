 function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}

 //   muestra las mesas q
 function get_listAreasEstablecimiento(establecimientoID){
    console.log("Listando Establecimientos  " + establecimientoID );
    var url = base_url('index.php/AreasEstablecimiento_Controller/get_listAreasEstablecimiento/' + establecimientoID);
    $.get(url, function (data) {
        $("#principal").html(data);
            
    });

}