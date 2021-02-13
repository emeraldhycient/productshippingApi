<?php

header('Access-Control-Allow-Origin: *');  
header('Content-Type: application/json;charset=UTF-8'); 

require "../classes/dbconnection.php";
require "../classes/access.php";
require "../classes/product.php";


$db = new dbconnect();
$access = new Access();

$product = new product();



if(isset($_POST["verifylogin"])){
   echo $access::verifyLogin();
}

if(isset($_POST["register"])){
   
    echo $access::register($_POST["email"],$_POST["password"],$_POST["phone"],$_POST["username"]);

}


if(isset($_POST["login"])){ 
     echo $access::login($_POST["email"],$_POST["password"]);
}