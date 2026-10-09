<?php  
class aes_encrypt{
    function  aes_encryptAcceso( $string,$action,){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);       
        $output = false;
        $encrypt_method = "AES-128-ECB";
        $key = 'F#n8(6i#$&';    
        if ( $action == 'encrypt' ) {             
            $output = openssl_encrypt($string, $encrypt_method, $key);
            $output;
        } else if( $action == 'decrypt' ) {          
            $output = openssl_decrypt($string, $encrypt_method, $key);
        }else{
           
        }       
        return $output;
    }
}