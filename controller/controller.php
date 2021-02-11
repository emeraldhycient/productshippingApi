<?php

header('Access-Control-Allow-Origin: *');  
header('Content-Type: application/json;charset=UTF-8'); 

require "../classes/dbconnection.php";
require "../classes/access.php";
require "../classes/product.php";


$db = new dbconnect();
$access = new Access();

$product = new product();

if(isset($_POST["listshipping"])){
   echo $product::listshipping();
}

if(isset($_POST["createshipment"])){
   echo $product::insertShipment($_POST["senderName"],$_POST["senderEmail"],$_POST["senderPhone"],$_POST["senderCity"],$_POST["receivername"],
   $_POST["receiverEmail"],$_POST["receiverPhone"],$_POST["receiverCity"],$_POST["tracking"],$_POST["weight"],$_POST["qty"],$_POST["deliveryType"],
   $_POST["bookingDate"],$_POST["deliveryDate"],$_POST["paymentStatus"],$_POST["status"],$_POST["description"],$_POST["comment"]);

}

if(isset($_POST["verifylogin"])){
   echo $access::verifyLogin();
}

if(isset($_POST["register"])){
   
    echo $access::register($_POST["email"],$_POST["password"],$_POST["phone"],$_POST["username"]);

}


if(isset($_POST["login"])){ 
     echo $access::login($_POST["email"],$_POST["password"]);
}

if(isset($_POST["trackingnumber"])){
   echo $product::track($_POST["trackingnumber"]);
}