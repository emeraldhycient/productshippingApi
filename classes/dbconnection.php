<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

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

   public static function sendmail($receiveremail,$receivername,$subject,$body){

    $mail = new PHPMailer(true);

    $data = [];

try {
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'shipliveinc@gmail.com';                     // SMTP username
    $mail->Password   = 'strongerindeed##';                               // SMTP password
    $mail->SMTPSecure = "ssl";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom("shipliveinc@gmail.com", "shiplive");
    $mail->addAddress($receiveremail, $receivername);     // Add a recipient

    // Attachments

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    =$body;
    $mail->send();

    $data = array(
        'status' => "success",
        'message' => "mail sent"
    );

} catch (Exception $e) {
    $data = array(
        'status' => "failed",
        'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"
    );
    
}

return json_encode($data);


   }

}