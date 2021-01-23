<?php

header('Access-Control-Allow-Origin: *');  
header('Content-Type: application/json;charset=UTF-8'); 



require_once("../classes/dbconnection.php");

$db = new dbconnect();

/*$data = array(
'name'=>'hycient',
'age'=>'20'
);

echo json_encode($data);
*/


if(isset($_POST["name"])){
    $data2 = array(
        "name"=> $_POST["name"],
        "age"=> $_POST["age"],
    );
    
    echo json_encode($data2);
}