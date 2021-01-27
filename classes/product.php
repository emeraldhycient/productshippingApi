<?php

class product extends dbconnect {

public static function track($tracking){

    $data = [];

    $tracking = self::filter($tracking);

    $sql = "SELECT * FROM shipmentdetails WHERE tracking='$tracking'";
    $query = self::$conn->query($sql);

   
    if($query){
        if($query->num_rows > 0){

            while($row = $query->fetch_object()){
                
                $data["status"] = "success";
                $data["data"] = array(
                    $row->id => array(
                        "id" => $row->id,
                        "sendername" => $row->sendername,
                        "senderphone" => $row->senderphone,
                        "sendercountry" => $row->sendercountry,
                        "senderaddress" => $row->senderaddress,
                        "receivername" => $row->receivername,
                        "receiveremail" => $row->receiveremail,
                        "receiverphone" => $row->receiverphone,
                        "receivercountry" => $row->receivercountry,
                        "receiveraddress" => $row->receiveraddress,
                        "tracking" => $row->tracking,
                        "weigth" =>  $row->weigth,
                        "qty" => $row->qty,
                        "method" => $row->method,
                        "bookingdate" => $row->bookingdate,
                        "depaturedate" => $row->depaturedate,
                        "deliverydate" => $row->deliverydate,
                        "payment" => $row->payment,
                        "carrier" => $row->carrier,
                        "status" => $row->statuz,
                        "description" => $row->description,
                        "comment" => $row->comment
                    )
                    );

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


public static function insertShipment($sendername,$senderemail,$senderphone,$sendercountry,$senderaddress,$receivername,
$receiveremail,$receiverphone,$receivercountry,$receiveraddress,$tracking,$weigth,$qty,$method,$bookingdate,	
$depaturedate,$deliverydate,$payment,$carrier,$statuz,$description,$comment
){

    $data = [];
      
    $tracking = "shiplive-".uniqid();

        $sendername = self::filter($sendername);
        $senderemail = self::filter($senderemail);
        $senderphone = self::filter($senderphone) ;
        $sendercountry = self::filter($sendercountry) ;
        $senderaddress =  self::filter($senderaddress) ;
        $receivername = self::filter($receivername) ;	
        $receiveremail =  self::filter($receiveremail) ;	
        $receiverphone	= self::filter($receiverphone) ;
        $receivercountry = self::filter($receivercountry) ;	
        $receiveraddress = self::filter($receiveraddress) ;	
        $tracking = self::filter($tracking) ; 	
        $weigth	 =  self::filter($weigth); 
        $qty	= self::filter( $qty) ; 
        $method	 = self::filter($method	) ; 
        $bookingdate = self::filter($bookingdate) ;	
        $depaturedate = self::filter($depaturedate) ;	
        $deliverydate	=  self::filter($deliverydate);
        $payment	= self::filter($payment) ;
        $carrier = self::filter($carrier) ;
        $statuz	=  self::filter($statuz);
        $description = self::filter($description) ;	
        $comment = self::filter($comment) ;
  
    $sql = "INSERT INTO shipmentadmin (sendername,senderemail,senderphone,sendercountry,senderaddress,receivername,
    receiveremail,receiverphone,receivercountry,receiveraddress,tracking,weigth,qty,method,bookingdate,	
    depaturedate,deliverydate,payment,carrier,statuz,descriptions,comment) VALUES ('$sendername','$senderemail','$senderphone','$sendercountry','$senderaddress','$receivername',
    '$receiveremail','$receiverphone','$receivercountry','$receiveraddress','$tracking','$weigth','$qty','$method','$bookingdate',	
    '$depaturedate','$deliverydate','$payment','$carrier','$statuz','$description','$comment')";
    $query = self::$conn->query($sql);

    if($query){

        $data = array(
            "status" => "success",
           
        );



    }else{

        $data = array(
            "status" => "failed",
            "message" => self::$conn->error
        );

    }
    
        return json_encode($data);


}

}