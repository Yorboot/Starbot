<?php
declare(strict_types=1);

function isInputEmpty(string $username, string $psw, string $email):bool{
    if(empty($username)|| empty($psw) || empty($username)){
        return true;
    }else{
        false;
    }
}
function isEmailValid( string $email):bool{
    if(filter_var($email, FILTER_VALDIATE_EMAIL)){
        return true;
    }else{
        false;
    }
}
function is_Username_taken(object $pdo,string $username):bool{
    if(get_username($pdo, $username)){
        return true;
    }else{
        return false;
    }
}
function is_Email_taken(object $pdo,string $email):bool{
    if(get_Email($pdo, $email)){
        return true;
    }else{
        return false;
    }
}