<?php
require_once "vendor/autoload.php";
use Dotenv\Dotenv;

function generateKey(){
    return $key = base64_encode(openssl_random_pseudo_bytes(32));
}
function generateIv(){
    return $iv = base64_encode(openssl_random_pseudo_bytes(16));
}
function Encrypt($data){
    $iv = generateIv();
    $key = generateKey();
    StoreEnv();
    return base64_encode(openssl_encrypt($data,'aes-256-cbc',base64_encode($key),OPENSSL_RAW_DATA, base64_decode($iv)));
}
function Decrypt($data){
    $iv = LoadIv();
    $key = LoadKey();
    DumpVars($iv,$key);
    return openssl_decrypt(base64_decode($data),'eas-256-cbc',base64_decode($key),OPENSSL_RAW_DATA,base64_decode($iv));
}
//generates a new key and iv and stores them in the .env file
function StoreEnv(){
    $key = generateKey();
    $iv = generateIv();
    $envPath = __DIR__.'/.env';
    if(!file_exists($envPath)){
        touch($envPath);
    }
    $dotenv = Dotenv::createMutable(__DIR__);
    $dotenv->load();
    $envContent = file_get_contents($envPath);
    $envContent = preg_replace('/^ENCRYPTION_KEY=.*$/m',"ENCRYPTION_KEY =$key",$envContent);
    $envContent = preg_replace('/^ENCRYPTION_IV=.*$/m', "ENCRYPTION_IV=$iv", $envContent);
    if(!preg_match('/^ENCRYPTION_KEY=.*$/m',$envContent)){
        $envContent .=" \nENCRYPTION_KEY=$key";
    }
    if(!preg_match('/^ENCRYPTION_IV=.*$/m',$envContent)){
        $envContent .= "\nENCRYPTION_IV=$iv";
    }
    file_put_contents($envPath,$envContent);
}
function LoadKey(){
    $envPath = __DIR__.'/.env';
    $dotenv = Dotenv::createMutable(__DIR__);
    $dotenv ->load();

    $key = getenv("ENCRYPTION_KEY");
    return $key;
}
function LoadIv(){
    $envPath = __DIR__.'/.env';
    $dotenv = Dotenv::createMutable(__DIR__);
    $dotenv ->load();

    $iv = getenv("ENCRYTPION_IV");
    return $iv;
}
function DumpVars($iv,$key){
    $dotenv = Dotenv::createMutable(__DIR__);
    $dotenv->load();
    var_dump($iv,$key);
}