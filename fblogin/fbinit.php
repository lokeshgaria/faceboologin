<?php

//start the session
session_start();

//include autoload file from vendor folder
require './vendor/autoload.php';


$fb = new Facebook\Facebook([
    'app_id' => '435785410895243', // replace your app_id
    'app_secret' => '8404c399858abd60b042d895d1fa8b8c',   // replace your app_scsret
    'default_graph_version' => 'v2.7'
        ]);


$helper = $fb->getRedirectLoginHelper();
$login_url = $helper->getLoginUrl("http://localhost/fblogin/index.php");
 
try {

    $accessToken = $helper->getAccessToken();
    if (isset($accessToken)) {
        $_SESSION['access_token'] = (string) $accessToken;  //conver to string
        //if session is set we can redirect to the user to any page 
        header("Location:index.php");
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}


//now we will get users first name , email , last name
if (isset($_SESSION['access_token'])) {

    try {

        $fb->setDefaultAccessToken($_SESSION['access_token']);
        $res = $fb->get('/me?locale=en_US&fields=name,email');
        $user = $res->getGraphUser();
        echo 'Hello, ',$user->getField('name');
        
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
