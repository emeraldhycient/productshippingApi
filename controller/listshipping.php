<?php

header('Access-Control-Allow-Origin: *');  
header('Content-Type: application/json;charset=UTF-8'); 

require "../classes/dbconnection.php";
require "../classes/product.php";


$db = new dbconnect();

$product = new product();

if(isset($_POST["listshipping"])){
   echo $product::listshipping();
}