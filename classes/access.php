<?php
require_once("./dbconnection.php");

class Access extends dbconnect {
    
    public  static function login($email,$pass){

        $data = [];

        $email = self::filter($email);
        $pass = self::filter($pass);

        $sql = "SELECT * FROM shipmentadmin WHERE email='$email' ";
        $query = self::$conn->query($sql);

        if($query){
            if($query->num_rows > 0){

                while($row = $query->fetch_object()){

                    if(password_verify($pass,$row->pass)){
                        $_SESSION["logged"] = $row->userid;
                        $_SESSION["username"] = $row->username;

                        $data = array(
                            "status" => "success",
                            "message" => "login successful"
                        );

                    }
        
                }

            }else{
                
            $data = array(
                "status" => "failed",
                "message" => "no data found"
            );

            }         
        }else{

            $data = array(
                "status" => "failed",
                "message" => self::$conn->error
            );

        }

        return json_encode($data);

    }
    public  static function register($email,$pass,$phone,$username){

        $data = [];
      
        $userid = uniqid();

        $email = self::filter($email);
        $username = self::filter($username);
        $phone = self::filter($phone);

        $pass = self::filter($pass);

        $hash = password_hash($pass,PASSWORD_BCRYPT);

        $sql = "INSERT INTO shipmentadmin (userid,email,username,phone,pass) VALUES ('$userid','$email','$username','$phone','$hash')";
        $query = self::$conn->query($sql);
        

    }

}