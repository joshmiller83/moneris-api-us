<?php

require "../mpgClasses.php";

/************************ Request Variables **********************************/

$store_id=$argv[1];
$api_token=$argv[2];
//$status = 'false';

/************************ Transaction Variables ******************************/

$orderid=$argv[3];
$custid=$argv[4];
$amount=$argv[5];

/************ Swipe card and read Track1 and/or Track2 ***********************/

$stdin = fopen("php://stdin", 'r');
$track1 = fgets ($stdin);

$startDelim = ";";
$firstChar = $track1{0};

$track = '';

if($firstChar==$startDelim)
{
	$track = $track1;
}
else
{
	$track2 = fgets ($stdin);
	$track = $track2;
}

$track = trim($track);


/************************ Transaction Array **********************************/

$txnArray=array(type=>'us_track2_purchase',
         order_id=>$orderid,
         cust_id=>$custid,
         amount=>$amount,
         track2=>$track,
         pan=>'',
         expdate=>'',
         commcard_invoice=>'Invoice 5757FRJ8',
         commcard_tax_amount=>'0.15',
         pos_code=>'12'
           );


/************************ Transaction Object *******************************/

$mpgTxn = new mpgTransaction($txnArray);

/************************ Request Object **********************************/

$mpgRequest = new mpgRequest($mpgTxn);

/************************ mpgHttpsPost Object ******************************/

$mpgHttpPost  =new mpgHttpsPost($store_id,$api_token,$mpgRequest);

//Status check example
//$mpgHttpPost = new mpgHttpsPostStatus($store_id,$api_token,$status,$mpgRequest);

/************************ Response Object **********************************/

$mpgResponse=$mpgHttpPost->getMpgResponse();


print("\nCardType = " . $mpgResponse->getCardType());
print("\nTransAmount = " . $mpgResponse->getTransAmount());
print("\nTxnNumber = " . $mpgResponse->getTxnNumber());
print("\nReceiptId = " . $mpgResponse->getReceiptId());
print("\nTransType = " . $mpgResponse->getTransType());
print("\nReferenceNum = " . $mpgResponse->getReferenceNum());
print("\nResponseCode = " . $mpgResponse->getResponseCode());
print("\nMessage = " . $mpgResponse->getMessage());
print("\nAuthCode = " . $mpgResponse->getAuthCode());
print("\nComplete = " . $mpgResponse->getComplete());
print("\nTransDate = " . $mpgResponse->getTransDate());
print("\nTransTime = " . $mpgResponse->getTransTime());
print("\nTicket = " . $mpgResponse->getTicket());
print("\nTimedOut = " . $mpgResponse->getTimedOut());
print("\nCardLevelResult = " . $mpgResponse->getCardLevelResult());
//print("\nStatusCode = " . $mpgResponse->getStatusCode());
//print("\nStatusMessage = " . $mpgResponse->getStatusMessage());

?>