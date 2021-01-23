<?php

class dbconnect {

    protected static $conn ;

   public function __construct()
   {
        self::conn();       
   }

   private static function conn (){
       self::$conn = new mysqli("localhost","root","","producttracker");
      /* if(!empty(self::$conn)){
           echo "connected";
       }*/
   }

}