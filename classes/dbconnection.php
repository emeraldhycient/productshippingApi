<?php
session_start();

class dbconnect {

    protected static $conn ;

   public function __construct()
   {
        self::conn();       
   }

   private static function conn (){
       self::$conn = new mysqli("localhost","root","","shipment");
      /* if(!empty(self::$conn)){
           echo "connected";
       }*/
   }

   protected static function filter($data){
       $data = trim($data);
       $data = htmlentities($data);
       $data = htmlspecialchars($data);
       $data = stripslashes($data);
       $data = strip_tags($data);
       $data = self::$conn->real_escape_string($data);
          return $data;
   }

}