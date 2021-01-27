<?php

header('Access-Control-Allow-Origin: *');  
header('Content-Type: application/json;charset=UTF-8'); 



require_once("../classes/dbconnection.php");

$db = new dbconnect();


if(isset($_POST["username"])){
    $data2 = array(
        "name"=> $_POST["username"],
        "email"=> $_POST["email"],
        "phone"=> $_POST["phone"],
        "pass"=> $_POST["password"]
    );
    
    echo json_encode($data2);
}


if(isset($_POST["email"])){
    $data2 = array(
        "email"=> $_POST["email"],
        "pass"=> $_POST["password"]
    );
    
    echo json_encode($data2);
}

if(isset($_POST["tracking"])){
    $data2 = array(
        "tracking"=> $_POST["tracking"]
    );
    
    echo json_encode($data2);
}