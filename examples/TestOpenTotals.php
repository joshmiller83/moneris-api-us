<?php

require "../mpgClasses.php";

/************************ Request Variables **********************************/

$store_id=$argv[1];
$api_token=$argv[2];

/************************ Transaction Variable ******************************/

$ecr_number=$argv[3];

/************************ Transaction Array **********************************/

$txnArray=array(type=>'us_opentotals',
         	ecr_number=>$ecr_number
           	);

/************************ Transaction Object *******************************/

$mpgTxn = new mpgTransaction($txnArray);

/************************ Request Object **********************************/

$mpgReq=new mpgRequest($mpgTxn);

/************************ mpgHttpsPost Object ******************************/

$mpgHttpPost=new mpgHttpsPost($store_id,$api_token,$mpgReq);

/************************ Response Object **********************************/

$mpgResponse=$mpgHttpPost->getMpgResponse();

/************************ Array of Cedit Cards  ****************************/

$creditCards = $mpgResponse->getCreditCards($ecr_number);

/************************ Loop through Array and Display ********************/

for($i=0; $i < count($creditCards); $i++)
 {
  print "\nCard Type = $creditCards[$i]";

  print "\nPurchase Count = "
        . $mpgResponse->getPurchaseCount($ecr_number,$creditCards[$i]);

  print "\nPurchase Amount = "
        . $mpgResponse->getPurchaseAmount($ecr_number,$creditCards[$i]);


  print "\nRefund Count = "
        . $mpgResponse->getRefundCount($ecr_number,$creditCards[$i]);


  print "\nRefund Amount = "
        . $mpgResponse->getRefundAmount($ecr_number,$creditCards[$i]);



  print "\nCorrection Count = "
        . $mpgResponse->getCorrectionCount($ecr_number,$creditCards[$i]);

  print "\nCorrection Amount = "
        . $mpgResponse->getCorrectionAmount($ecr_number,$creditCards[$i]);
 }

?>