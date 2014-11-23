<?php

require "../mpgClasses.php";

/************************ Request Variables **********************************/

$store_id="monusqa002";
$api_token="qatoken";

/************************ Transaction Variables ******************************/

$orderid="enc_purchase_".date("dmy-G:i:s");
$amount="1.00";
$enc_track2="";
$device_type="idtech";
$crypt="7";
// Dynamic Descriptor
//$dynamic_descriptor = "INV002"

/************************** Recur Variables *****************************/

$recurUnit = 'day';
$startDate = '2006/11/30';
$numRecurs = '4';
$recurInterval = '10';
$recurAmount = '31.00';
$startNow = 'true';

/****************************** Recur Array **************************/

$recurArray = array(recur_unit=>$recurUnit,  // (day | week | month)
	start_date=>$startDate, //yyyy/mm/dd
	num_recurs=>$numRecurs,
	start_now=>$startNow,
	period => $recurInterval,
	recur_amount=> $recurAmount
	);

/****************************** Recur Object **************************/

$mpgRecur = new mpgRecur($recurArray);

/************************ Transaction Array **********************************/

$txnArray=array(type=>'us_enc_purchase',
         order_id=>$orderid,
         cust_id=>'cust',
         amount=>$amount,
         enc_track2=>$enc_track2,
         //dynamic_descriptor=>$dynamic_descriptor,
         device_type=>$device_type,
         crypt_type=>$crypt
	
           );

/************************ Transaction Object *******************************/

$mpgTxn = new mpgTransaction($txnArray);

/****************************** Set Recur Object **********************/

$mpgTxn->setRecur($mpgRecur);

/************************ Request Object **********************************/

$mpgRequest = new mpgRequest($mpgTxn);

/************************ mpgHttpsPost Object ******************************/

$mpgHttpPost  =new mpgHttpsPost($store_id,$api_token,$mpgRequest);

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
print("\nRecurSuccess = " . $mpgResponse->getRecurSuccess());

?>
