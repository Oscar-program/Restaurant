<?php  
class operacionesCompras{
    public $idDetCompra = null;
    public $descripcion = '';
    public $cantidad    = 1;

   public function __construct($idDetCompra, $descripcion, $cantidad){
             $this->idDetCompra = $idDetCompra;
             $this->descripcion = $descripcion;
             $this->cantidad    =  $cantidad;
   }
   
   // funcion para  retorna la informacion  del pedido 
   public function getDetallePedido(){
      return " el  id del detalle es   $this->idDetCompra, descripcion  $this->descripcion  cantidad   $this->cantidad .";
   }
   


}