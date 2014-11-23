<?php

require "../mpgClasses.php";

/******************************* Request Variables ********************************/

$store_id=$argv[1];
$api_token=$argv[2];
//$status='false';

/****************************** Transactional Variables ***************************/

$type='us_cavv_preauth';
$order_id=$argv[3];
$cust_id=$argv[4];
$amount=$argv[5];
$pan=$argv[6];
$expiry_date=$argv[7];
$cavv='AAABBJg0VhI0VniQEjRWAAAAAAA=';

/*************************** Transaction Associative Array ************************/

$txnArray=array(
				type=>$type,
	    		order_id=>$order_id,
				cust_id=>$cust_id,
	    		amount=>$amount,
	    		pan=>$pan,
	    		expdate=>$expiry_date,
				cavv=>$cavv
				);

/****************************** Transaction Object *******************************/

$mpgTxn = new mpgTransaction($txnArray);

/******************************* Request Object **********************************/

$mpgRequest = new mpgRequest($mpgTxn);

/****************************** HTTPS Post Object *******************************/

$mpgHttpPost  =new mpgHttpsPost($store_id,$api_token,$mpgRequest);

//Status check example
//$mpgHttpPost = new mpgHttpsPostStatus($store_id,$api_token,$status,$mpgRequest);

/************************************* Response *********************************/

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
print("\nCavvResultCode = " . $mpgResponse->getCavvResultCode());
//print("\nStatusCode = " . $mpgResponse->getStatusCode());
//print("\nStatusMessage = " . $mpgResponse->getStatusMessage());


?>