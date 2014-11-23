<?php

require "../mpgClasses.php";

/************************ Request Variables **********************************/

$store_id="monusqa002";
$api_token="qatoken";
//$status = 'false';

/************************ Transaction Variables ******************************/

$orderid="enc_track2_forcepost".date("dmy-G:i:s");
$amount="1.00";
$enc_track2="";
$pos_code="00";
$auth_code="654321";
$device_type="idtech";

//dynamic descriptor
//$dyn_descriptor="MYSTORE 12345 INV 2";

/************************ Transaction Array **********************************/

$txnArray=array(type=>'us_enc_track2_forcepost',
         order_id=>$orderid,
         cust_id=>'cust',
         amount=>$amount,
         enc_track2=>$enc_track2,
         auth_code=>$auth_code,
         pos_code=>$pos_code,
         device_type=>$device_type,
//         dynamic_descriptor=>$dyn_descriptor
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
print("\nTimedOut = " . $mpgResponse->getTimedOut());
print("\nMaskedPan = " . $mpgResponse->getMaskedPan());
//print("\nStatusCode = " . $mpgResponse->getStatusCode());
//print("\nStatusMessage = " . $mpgResponse->getStatusMessage());

?>
