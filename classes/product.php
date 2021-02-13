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
                        "id" => $row->id,
                        "sendername" => $row->sendername,
                        "senderphone" => $row->senderphone,
                        "senderemail" => $row->senderemail,
                        "senderaddress" => $row->senderaddress,
                        "receivername" => $row->receivername,
                        "receiveremail" => $row->receiveremail,
                        "receiverphone" => $row->receiverphone,
                        "receiveraddress" => $row->receiveraddress,
                        "tracking" => $row->tracking,
                        "weigth" =>  $row->weigth,
                        "qty" => $row->qty,
                        "method" => $row->method,
                        "bookingdate" => $row->bookingdate,
                        "deliverydate" => $row->deliverydate,
                        "payment" => $row->payment,
                        "status" => $row->statuz,
                        "description" => $row->descriptions,
                        "comment" => $row->comment
                    
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


public static function insertShipment($sendername,$senderemail,$senderphone,$senderaddress,$receivername,
$receiveremail,$receiverphone,$receiveraddress,$tracking,$weigth,$qty,$method,$bookingdate,$deliverydate,
$payment,$statuz,$description,$comment
){

    $data = [];
      
    $tracking = self::filter($tracking);

        $sendername = self::filter($sendername);
        $senderemail = self::filter($senderemail);
        $senderphone = self::filter($senderphone) ;
        $senderaddress =  self::filter($senderaddress) ;
        $receivername = self::filter($receivername) ;	
        $receiveremail =  self::filter($receiveremail) ;	
        $receiverphone	= self::filter($receiverphone) ;
        $receiveraddress = self::filter($receiveraddress) ;	
        $weigth	 =  self::filter($weigth); 
        $qty	= self::filter( $qty) ; 
        $method	 = self::filter($method	) ; 
        $bookingdate = self::filter($bookingdate) ;	
        $deliverydate	=  self::filter($deliverydate);
        $payment	= self::filter($payment) ;
        $statuz	=  self::filter($statuz);
        $description = self::filter($description) ;	
        $comment = self::filter($comment) ;
  
    $sql = "INSERT INTO shipmentdetails (sendername,senderemail,senderphone,senderaddress,receivername,
    receiveremail,receiverphone,receiveraddress,tracking,weigth,qty,method,bookingdate,	
    deliverydate,payment,statuz,descriptions,comment) VALUES ('$sendername','$senderemail','$senderphone','$senderaddress','$receivername',
    '$receiveremail','$receiverphone','$receiveraddress','$tracking','$weigth','$qty','$method','$bookingdate',	
    '$deliverydate','$payment','$statuz','$description','$comment')";
    $query = self::$conn->query($sql);

    if($query){

        $table = "
        
        <div className='table-responsive mt-5'>
        <div <b style='color:color:#5bc0de;padding:20px'><h4><center>Booking Details For Tracking :<span <b style='color:tomato'>$tracking</span></center></h4></div>
        <table border='1px'>
            <tbody>
                <tr>
                    <td>Tracking</td>
                    <td>$tracking</td>
                    <td><b style='color:tomato'>Shipment Status</b></td>
                    <td>$statuz</td>
                </tr>
                <tr>
                    <td>Booking Date</td>
                    <td>$bookingdate</td>
                    <td>Schedule delivery</td>
                    <td>$deliverydate</td>
                </tr>
                <tr>
                    <td>Sender Name</td>
                    <td>$sendername</td>
                    <td>Sender Phone</td>
                    <td>$senderphone</td>
                </tr>
                <tr>
                    <td>Sender Email</td>
                    <td>$senderemail</td>
                    <td>Sender Address</td>
                    <td>$senderaddress</td>
                </tr>
                <tr>
                    <td>Receiver Name</td>
                    <td>$receivername</td>
                    <td>receiver phone</td>
                    <td>$receiverphone</td>
                </tr>
                <tr>
                    <td>Receiver Email</td>
                    <td>$receiveremail</td>
                    <td>Receiver Address</td>
                    <td>$receiveraddress</td>
                </tr>
                <tr>
                    <td>Shipment Type</td>
                    <td>$method</td>
                    <td>Weight</td>
                    <td>$weigth</td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td>$qty</td>
                    <td>Payment</td>
                    <td>{products.payment}</td>
                </tr>
                <tr>
                    <td>Comment</td>
                    <td colSpan='3'>$comment</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td colSpan='3'>$description</td>
                </tr>
            </tbody>
        </table>
    </div>
        
        ";

        self::sendmail($senderemail,$sendername,"shiplive shipment details",$table);
        self::sendmail($receiveremail,$receivername,"shiplive product delivery details",$table);

        $data = array(
            "status" => "success",
             "data" => array(
                 "tracking" => $tracking,
                 "message" => "shipment created successfully,An email has been sent to the shippers address and the recipent "
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

public static function listshipping(){

    $data = [];

    $sql = "SELECT * FROM shipmentdetails";
    $query = self::$conn->query($sql);

    if($query){
            if($query->num_rows > 0){

                while($row = $query->fetch_object()){

                    $data["status"] = "success";
                    $data["data"][$row->id] = array(
                            "id" => $row->id,
                            "sendername" => $row->sendername,
                            "senderphone" => $row->senderphone,
                            "senderaddress" => $row->senderaddress,
                            "senderemail" => $row->senderemail,
                            "receivername" => $row->receivername,
                            "receiveremail" => $row->receiveremail,
                            "receiverphone" => $row->receiverphone,
                            "receiveraddress" => $row->receiveraddress,
                            "tracking" => $row->tracking,
                            "weigth" =>  $row->weigth,
                            "qty" => $row->qty,
                            "method" => $row->method,
                            "bookingdate" => $row->bookingdate,
                            "deliverydate" => $row->deliverydate,
                            "payment" => $row->payment,
                            "status" => $row->statuz,
                            "description" => $row->descriptions,
                            "comment" => $row->comment
                        
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

public static function deleteShipment($shipmentId){
    $data = [];

    $$shipmentId = self::filter($shipmentId);

    $sql = "DELETE FROM shipmentdetails WHERE id='$shipmentId' ";

    $query= self::$conn->query($sql);
    
    if($query){

        $data = array(
            'status' => "success",
            "message" => "$shipmentId was deleted successfully"
        );

    }else{

        $data = array(
            'status' => "failed",
            "message" => self::$conn->error
        );
        
    }

    return json_encode($data);

}

}