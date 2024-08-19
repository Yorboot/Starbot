<?php
/*
require_once("c:/xampp/htdocs/Starbot/vendor/autoload.php");
use Dotenv\Dotenv;

$dotenv = Dotenv::createMutable(__DIR__);
$envPath = __DIR__ . '/.env';

if (!file_exists($envPath)) {
    touch($envPath);
    throw new Exception("File doesnt exist try again to make file");
}else{
    $dotenv->load();
}



function generateKey(): bool|string{
    $key = (string) base64_encode(openssl_random_pseudo_bytes(32));
    return $key;
}
function generateIv(): bool|string{
    $iv = (string) base64_encode(openssl_random_pseudo_bytes(16));
    return $iv;
}
function Encrypt($data): bool|string{
    $iv = generateIv();
    $key = generateKey();

    StoreCreds($key,$iv);
    $dIv = base64_decode($iv);
    $dkey = base64_decode($key);

    $data = openssl_encrypt($data,'aes-256-cbc',$dkey,OPENSSL_RAW_DATA,$dIv);
    $edata = base64_encode($data);
    $iv = base64_encode($iv);
    $key = base64_encode($key);
    StoreData($edata,$iv,$key);
    return $edata;
}

function Decrypt(): bool|string{
    $iv = LoadIv();
    $key = LoadKey();
    $data = LoadData();
    $dKey = base64_decode($key);
    $dIv = base64_decode($iv);
    $Error = "Failed to decode";
    if($dKey === false){
        $Error.'Key';

    }
    if($dIv === false){
        $Error.'iv';
    }
    if ($dKey === false || $dIv === false) {
        throw new Exception($Error);

    }
    //trim of double quotes on the value because they get generated without
    $iv = trim($iv, '"');
    $key = trim($key, '"');
    $Dcdata = base64_decode($data);
    if ($Dcdata === false) throw new Exception("Decoding failed");
    $dData = openssl_decrypt($Dcdata,'aes-256-cbc',$dKey,OPENSSL_RAW_DATA,$dIv);
    if($dData === false){
        while($msg = openssl_error_string()){
            echo "$msg\n";
            throw new Exception('Decryption failed');
        }

        
    }
    echo "Sucess";
    return $dData;
}

//Takes a Key and Iv generated in the Encrypt function and stores them in the .env file
function StoreCreds($key,$iv){
    $envPath = __DIR__ . '/.env';
    //gets Vars from .Env If file exists to use them in str_replace

    $Lkey = getenv("ENCRYPTION_KEY");
    $Liv = getenv("ENCRYPTION_IV");


    $envContent = file_get_contents($envPath);

    //actually search and replace for old and new Variables
    $envContentKey = str_replace("ENCRYPTION_KEY=$Lkey","ENCRYPTION_KEY=$key",$envContent);
    $envContentIv = str_replace("ENCRYPTION_IV=$Liv", "ENCRYPTION_IV=$iv", $envContent);
    //add double quots so .env recognizes the key and iv as a string to prevent white space errors
    $Qkey = '"'.$key.'"';
    $Qiv = '"' . $iv . '"';
    $Qkey = "ENCRYPTION_KEY"."=".$Qkey;
    $Qiv = "\n"."ENCRYPTION_IV" . "=" . $Qiv;

    $data =  $Qkey.$Qiv;

    file_put_contents($envPath,$data);
}
function StoreData($data,$iv,$key) {
    $envPath = __DIR__ . '/.env';
    $envContent = file_get_contents($envPath);

    $QData = '"' . $data . '"';

    //writing key and iv again because if you write to a file it will get wiped
    $Lkey = getenv("ENCRYPTION_KEY");
    $Liv = getenv("ENCRYPTION_IV");

    $QData = "\ndata" . "=" . $data;
    $Qkey = "ENCRYPTION_KEY" . "=" . $key;
    $Qiv = "\n" . "ENCRYPTION_IV" . "=" . $iv;

    $data = $Qkey . $Qiv. $QData;

    file_put_contents($envPath, $data);
}


function LoadKey(): bool|string
{
    $key = getenv("ENCRYPTION_KEY");
    return $key;
}
function LoadIv(): bool|string
{
    $iv = getenv("ENCRYPTION_IV");
    return $iv;
}
function LoadData():bool|string{
    $data = getenv("data");
    return $data;
}
*/