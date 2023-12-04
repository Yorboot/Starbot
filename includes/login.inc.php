 <?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email  = htmlspecialchars($_POST["email"]);
    $psw = htmlspecialchars($_POST["psw"]);
    if(empty($email) || empty($psw)){
        exit;
        header("Location: ../index.html");
        die();
    }
/*
   function first_register (){
    $first_data = array(
        "email"=> $_POST["email"],
        "psw"=> $_POST["psw"],

    );

    if(filesize("database/database.json") == 0){
    $first_record = array($first_data);
    $data_to_save = $first_record;
    }else{
    $old_record = json_decode(file_get_contents("database/database.json"));
    array_push($old_record, $first_data);
    $data_to_save = $old_record;
    }
    if(!file_put_contents("database/database.json", json_encode($data_to_save, JSON_PRETTY_PRINT), LOCK_EX)){
        $error = false;
    }else{
        $error = true;
    }
    }
    first_register();
*/





} else{
    header("Location: ../index.html");
}
?>