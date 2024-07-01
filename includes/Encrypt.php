<?php
$key = base64_encode(openssl_random_pseudo_bytes(32));
$iv = base64_encode(openssl_random_pseudo_bytes(16));
function generateKey(){
    return $key = base64_encode(openssl_random_pseudo_bytes(32));
   
}
function generateIv(){
    return $iv = base64_encode(openssl_random_pseudo_bytes(16));
}
function Encrypt($data,$key,$iv){
    return base64_encode(openssl_encrypt($data,'aes-256-cbc',base64_encode($key),OPENSSL_RAW_DATA, base64_decode($iv)));
}
function Decrypt($iv,$key,$data){
    return openssl_decrypt(base64_decode($data),'eas-256-cbc',base64_decode($key),OPENSSL_RAW_DATA,base64_decode($iv))
}