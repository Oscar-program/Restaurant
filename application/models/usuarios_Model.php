<?php 
class Usuarios_Model extends CI_Model{
  // cast(aes_decrypt(usrPwd,'xyz123') as char)
  protected $table = 'usuario';

  //  funcion  para determinar  el acceso a los  usuarios  
  function getUserpwd($usrLogin, $usrPwd){
           $query =  $this->db->select("usr.*" )   
                                ->where('usr.usrLogin',$usrLogin )                             
                                ->where("usr.usrPwd", $usrPwd)
                                ->where("usr.usrStatus", 1)                 
                             
                                ->get("usuario usr")
                                ->row();
            return  $query;  
  }

  //funcion para  almacenar los datos del  usuario 
 

    public function insert_user($data, $usuarioID)
    {

    if($usuarioID ==   NULL){
        //  ECHO  "HACER INSERCION" ;
    
            $this->db->insert("usuario",$data);
            return $this->db->insert_id();
        }else{
           //   ECHO  "HACER UPDATE    CLJDSKCSKDNJ" ;

           $this->db->set("usrNombre", $data["usrNombre"])
                    ->set("usrLogin", $data["usrLogin"])
                    ->set("usrPwd", $data["usrPwd"])
                    ->set("empresaID", $data["empresaID"])
                    ->set("nivelUsuarioID", $data["nivelUsuarioID"])
                    ->where("usuarioID", $usuarioID)
                    ->where("usrStatus",  1)
                    ->update("usuario");
            return $this->db->affected_rows();  


      //$this->db->insert("usuario",$data);
      //return $this->db->insert_id();
    }
     }

    // funcion  retorna todos los usuarios  
    public function allUserSystem(){
      $query =  $this->db->select("u.usuarioID, u.usrNombre, u.usrLogin,  u.usrPwd,  u.empresaID , u.nivelUsuarioID , 
                                   emp.empNombre, nlu.nivel ,   u.usrStatus" )
                           ->join('nuevoestablo.empresa emp','u.empresaID =  emp.empresaID','inner')
                           ->join('nuevoestablo.nivelusuario nlu','nlu.nivelUsuarioID =  u.nivelUsuarioID','inner')
                           ->where("u.usrStatus",  1)           
          
   
      ->get("nuevoestablo.usuario u ")
      ->result();
      return  $query;  
    }

    //  funcion para cargar los  establecimientos
    public function lit_establecimientos(){
      $query =  $this->db->select("estb.*" )   
            
   
      ->get("establecimientoempresa estb")
      ->result();
      return  $query;  
    }
    
    public function  get_UserID($usuarioID){
      $query =  $this->db->select("u.*" )
                     ->where("u.usuarioID", $usuarioID)
                     ->where("u.usrStatus",  1) 
                    ->get("nuevoestablo.usuario u ")
                    ->row();
      return  $query;  
      

    }
    function  del_UserID($usuarioID){
        $this->db->set("usrStatus", 0)                   
                    ->where("usuarioID", $usuarioID)                   
                    ->update("usuario");
            return $this->db->affected_rows();  

    }
    # hacemos apartado para el registro de los difrentes niveles de usuario 

    public function listNivelusuario(){
      $query =  $this->db->select("nvl.*" )
                         ->where("nvl.estado",  1)
                         ->get("nuevoestablo.nivelusuario nvl")    
                          ->result();
                        return  $query;  
    }
    public function insert_nivelUsuario($data, $nivelUsuarioID){
        if($nivelUsuarioID ==   NULL){
            $this->db->insert("nivelusuario",$data);
            return $this->db->insert_id();
        }else{             
           $this->db->set("nivel", $data["nivel"])                    
                    ->where("nivelUsuarioID", $nivelUsuarioID)
                    ->where("estado",  1)
                    ->update("nivelusuario");
            return $this->db->affected_rows();
                }
    }
    public function  get_NivelUserID($nivelUsuarioID){
      $query =  $this->db->select("nvl.*" )
                     ->where("nvl.nivelUsuarioID", $nivelUsuarioID)
                     ->where("nvl.estado",  1) 
                    ->get("nuevoestablo.nivelusuario nvl ")
                    ->row();
      return  $query;  
      

    }
    public function  delete_NivelUser($nivelUsuarioID){
        $this->db->set("estado", 0)                   
                    ->where("nivelUsuarioID", $nivelUsuarioID)                   
                    ->update("nivelusuario");
            return $this->db->affected_rows();  

    }






}
