function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
function ocultarMenu() {
          var menu = document.getElementById("menu");
          //menu.classList.add("oculto");
          menu.click();
        }
function mostrarMenu() {
  document.getElementById("menuLateral").classList.remove("oculto");
}
