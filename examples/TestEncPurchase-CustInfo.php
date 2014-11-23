<?php

require "mpgClasses.php";

/************************ Request Variables **********************************/

$store_id="monusqa002";
$api_token="qatoken";

/************************ Transaction Variables ******************************/

$orderid="enc_purchase_".date("dmy-G:i:s");
$amount="1.00";
$enc_track2="028400850000000004165A8529A950AFA87AC5C473D0B107A5D9EF77CBC057086DEBB4C170A23215E7418D6D1B76C8E146682160A426043132313231415939320000A000297C6C03";
$device_type="idtech";
$crypt="7";
// Dynamic Descriptor
$dynamic_descriptor = "desc";

/************************ CustInfo Object **********************************/

$mpgCustInfo = new mpgCustInfo();

/********************* Set E-mail and Instructions **************/

$email ='Joe@widgets.com';
$mpgCustInfo->setEmail($email);

$instructions ="Make it fast";
$mpgCustInfo->setInstructions($instructions);

/********************* Create Billing Array and set it **********/

$billing = array( first_name => 'Joe',
                  last_name => 'Thompson',
                  company_name => 'Widget Company Inc.',
                  address => '111 Bolts Ave.',
                  city => 'Toronto',
                  province => 'Ontario',
                  postal_code => 'M8T 1T8',
                  country => 'Canada',
                  phone_number => '416-555-5555',
                  fax => '416-555-5555',
                  tax1 => '123.45',
                  tax2 => '12.34',
                  tax3 => '15.45',
                  shipping_cost => '456.23');


$mpgCustInfo->setBilling($billing);

/********************* Create Shipping Array and set it **********/

$shipping = array( first_name => 'Joe',
                  last_name => 'Thompson',
                  company_name => 'Widget Company Inc.',
                  address => '111 Bolts Ave.',
                  city => 'Toronto',
                  province => 'Ontario',
                  postal_code => 'M8T 1T8',
                  country => 'Canada',
                  phone_number => '416-555-5555',
                  fax => '416-555-5555',
                  tax1 => '123.45',
                  tax2 => '12.34',
                  tax3 => '15.45',
                  shipping_cost => '456.23');

$mpgCustInfo->setShipping($shipping);


/********************* Create Item Arraya and set them **********/

$item1 = array (name=>'item 1 name',
                quantity=>'53',
                product_code=>'item 1 product code',
                extended_amount=>'1.00');

$mpgCustInfo->setItems($item1);


$item2 = array(name=>'item 2 name',
                quantity=>'53',
                product_code=>'item 2 product code',
                extended_amount=>'1.00');

$mpgCustInfo->setItems($item2);
/************************** AVS Variables *****************************/

$avs_street_number = '201';
$avs_street_name = 'Michigan Ave';
$avs_zipcode = 'M1M1M1';

/************************** CVD Variables *****************************/

$cvd_indicator = '1';
$cvd_value = '198';

/********************** AVS Associative Array *************************/

$avsTemplate = array(
		     		 avs_street_number=>$avs_street_number,
                     avs_street_name =>$avs_street_name,
                     avs_zipcode => $avs_zipcode
                    );

/********************** CVD Associative Array *************************/

$cvdTemplate = array(
		     		 cvd_indicator => $cvd_indicator,
                     cvd_value => $cvd_value
                    );

/************************** AVS Object ********************************/

$mpgAvsInfo = new mpgAvsInfo ($avsTemplate);

/************************** CVD Object ********************************/

$mpgCvdInfo = new mpgCvdInfo ($cvdTemplate);

/************************ Transaction Array **********************************/

$txnArray=array(type=>'us_enc_purchase',
         order_id=>$orderid,
         cust_id=>'cust',
         amount=>$amount,
         enc_track2=>$enc_track2,
         dynamic_descriptor=>$dynamic_descriptor,
         device_type=>$device_type,
         crypt_type=>$crypt
	
           );

/************************ Transaction Object *******************************/

$mpgTxn = new mpgTransaction($txnArray);

/************************ Set CustInfo Object *****************************/

$mpgTxn->setCustInfo($mpgCustInfo);

/************************ Set AVS and CVD *****************************/

$mpgTxn->setAvsInfo($mpgAvsInfo);
$mpgTxn->setCvdInfo($mpgCvdInfo);

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

?>
