<?php

require_once("c:/xampp/htdocs/Starbot/vendor/autoload.php");
use Dotenv\Dotenv;
$dotenv = Dotenv::createMutable(__DIR__);
$dotenv ->load();
//Needed for automaticly loading dependencies on startup


function generateKey(){
    $key = base64_encode(openssl_random_pseudo_bytes(32));
    return $key;
}
function generateIv(){ 
    $iv = base64_encode(openssl_random_pseudo_bytes(16));
    return $iv;
}
function Encrypt($data){
    $iv = generateIv();
    $key = generateKey();

    StoreEnv($key,$iv);
    $dIv = base64_decode($iv);
    $dkey = base64_decode($key);
    $edata = openssl_encrypt(base64_encode($data),'aes-256-cbc',$dkey,OPENSSL_RAW_DATA,$dIv);
    return $edata;
}
function Decrypt($data){
    $iv = LoadIv();
    $key = LoadKey();
    $dKey = base64_decode($key);
    $dIv = base64_decode($iv);
    $Error = "Failed to decode";
    if($dKey === false){
        $Error.' $key ';
    
    }
    if($dIv === false){
        $Error.' $dIv ';
    }
    if($dKey === false||$dIv === false){
        throw new Exception($Error);
    }

    $dData = openssl_decrypt(base64_decode($data),'aes-256-cbc',$dKey,OPENSSL_RAW_DATA,$dIv);
    if($dData === false){
        throw new Exception('Decryption failed'.openssl_error_string());
    }
    echo "Sucess";
    return $dData;
}

//Takes a Key and Iv generated in the Encrypt function and stores them in the .env file
function StoreEnv($key,$iv,){

    $envPath = __DIR__.'/.env';
    //check if the file  exists if not create a .env file
    if(!file_exists($envPath)){
        touch($envPath);
        echo "File doesnt exist try again to make file";
    }else{

        $Lkey = getenv("ENCRYPTION_KEY");
        $Liv = getenv("ENCRYPTION_IV");
    }

    $envContent = file_get_contents($envPath);
    //checks if a key/iv exist in the iv file if yes replace them with a new ones
    $key = (string)$key;
    $iv = (string)$iv;
    $envContentKey = str_replace("ENCRYPTION_KEY=$Lkey","ENCRYPTION_KEY=$key",$envContent);
    $envContentIv = str_replace("ENCRYPTION_IV=$Liv", "ENCRYPTION_IV=$iv", $envContent);

    
    $data = "   ENCRYPTION_KEY=$key"."  ENCRYPTION_IV=$iv";

    file_put_contents($envPath,$data);

}


function LoadKey(){


    $key = getenv("ENCRYPTION_KEY");
    return $key;
}
function LoadIv(){

    $iv = getenv("ENCRYPTION_IV");
    return $iv;
}
