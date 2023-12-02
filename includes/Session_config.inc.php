<?php
ini_set('session.use_only_coockies',1);
ini_set('session.use_strict_mode',1);

//set paramaters for all cookies in the website
session_set_cookie_params([
    //destroy the session after 800 seconds
    'lifetime'=> 800,
    //set the name for the cookie
    'domain' => 'localhost',
    //allow cookie to be used in all directories/sub directories
    'path' => '/',
    'secure'=> true,
    'httponly'=> true
]);
session_start();
// check if there is a session id if there is not regenerate the id to make it stronger
if(!isset($_SESSION['last_regeneration'])){
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
//else check if the interval hase passed if yes regenerate the id
} else{
    $interval = 60*30;
    if(time()-$_SESSION['last_regeneration']>= $interval){
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
}