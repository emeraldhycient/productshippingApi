<?php

class Access extends dbconnect {
    
    public  static function login($email,$pass){

        $data = [];
        $token = uniqid()."-token";

        $email = self::filter($email);
        $pass = self::filter($pass);

        $sql = "SELECT * FROM shipmentadmin WHERE email='$email' ";
        $query = self::$conn->query($sql);

        if($query){
            if($query->num_rows > 0){

                while($row = $query->fetch_object()){

                    if(password_verify($pass,$row->pass)){
                        $_SESSION["logged"] = $row->userid;
                        $_SESSION["token"] = $token;
                        $_SESSION["username"] = $row->username;

                        $data = array(
                            "status" => "success",
                            "data" => array(
                                "userid" => $row->userid,
                                "username" => $row->username,
                                "token" => $token,
                                "message" => "login successful"
                                )
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
        $token = uniqid()."-token";

        $email = self::filter($email);
        $username = self::filter($username);
        $phone = self::filter($phone);

        $hash = password_hash($pass,PASSWORD_BCRYPT);

        $sql = "INSERT INTO shipmentadmin (userid,email,username,phone,pass) VALUES ('$userid','$email','$username','$phone','$hash')";
        $query = self::$conn->query($sql);

        if($query){

            $_SESSION["logged"] = $userid;
            $_SESSION["username"] = $username;
            $_SESSION["token"] = $token;

            $body = "
                   <center>
                   <h1 style='color:#5bc0de'>shiplive</h1>
                   </center>
                   <h4>registration successful</h4>
                   <p>some of the details you provided are as follows</p>
                   <ul>
                   <l1>Email : $email</l1>
                   <l1>Username  : $username </l1>
                   <l1>Phone  : $phone</l1>
                   <l1>password  : $pass</l1>
                   </ul>
            ";

            self::sendmail($email,$username," shiplive registration",$body);

            $data = array(
                "status" => "success",
                "data" => array(
                    "userid" => $userid,
                    "username" => $username,
                    "token" => $token,
                    "message" => "account created successfully"
                )
            );



        }else{

            $data = array(
                "status" => "failed",
                "message" => self::$conn->error
            );

        }
        
            return json_encode($data);

    }

    public static function logout(){
        
        session_destroy();

        $data = array(
            "status" => "success",
            "token" => $_SESSION["token"],
        );

        unset($_SESSION["username"]);
        unset($_SESSION["token"]);
        unset($_SESSION["logged"]);

        return json_encode($data);

    }

    public static function verifyLogin(){

        $data = [];

        if(!isset($_SESSION["logged"]) && !isset($_SESSION["token"])){
            $data = array(
                "status" => "failed",
               "userid" => $_SESSION["logged"] ,
               "username" => $_SESSION["username"] ,
               "token" => $_SESSION["token"]
    
            );
        }

        $data = array(
            "status" => "success",
           "userid" => $_SESSION["logged"] ,
           "username" => $_SESSION["username"] ,
           "token" => $_SESSION["token"]

        );

        return json_encode($data);

    }

}