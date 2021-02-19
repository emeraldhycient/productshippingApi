<?php

header('Access-Control-Allow-Origin: *');  
header('Content-Type: application/json;charset=UTF-8'); 

require "../classes/dbconnection.php";
require "../classes/product.php";


$db = new dbconnect();

$product = new product();

if(isset($_POST["updateShipment"])){
   echo $product::updateShipment($_POST["senderName"],$_POST["senderEmail"],$_POST["senderPhone"],$_POST["senderCity"],$_POST["receivername"],
   $_POST["receiverEmail"],$_POST["receiverPhone"],$_POST["receiverCity"],$_POST["tracking"],$_POST["weight"],$_POST["qty"],$_POST["deliveryType"],
   $_POST["bookingDate"],$_POST["deliveryDate"],$_POST["paymentStatus"],$_POST["status"],$_POST["description"],$_POST["comment"]);

}