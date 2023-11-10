<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
       function first_register (){
    $first_data = array(
        "email"=> $_POST["email"],
        "psw"=> $_POST["psw"],

    );

    if(filesize("database.json") == 0){
    $first_record = array($first_data);
    $data_to_save = $first_record;
    }else{
    $old_record = json_decode(file_get_contents("database.json"));
    array_push($old_record, $first_data);
    $data_to_save = $old_record;
    }
    if(!file_put_contents("database.json", json_encode($data_to_save, JSON_PRETTY_PRINT), LOCK_EX)){
        $error = false;
        header('Location: ../index.html');
    }else{
        $error = true;
    }
    }
    first_register();
}else{
    header('register.html');
}