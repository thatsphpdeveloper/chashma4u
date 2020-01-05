<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paytm extends CI_Controller {
    public function __construct() {
        parent::__construct();

        //===================================================
        // Loads Paytm Authorized Files
        //===================================================
		header("Pragma: no-cache");
		header("Cache-Control: no-cache");
		header("Expires: 0");

        $this->load->library('stack_web_gateway_paytm_kit/Stack_web_gateway_paytm_kit');
	//===================================================
    }
    public function index()
    {
    }

    public function checkout($generatedId = '')
    {   $error = "unauthorized";

        $transactionId = $this->session->userdata(PREFIX.'order_transactionId');
        $this->session->set_userdata(PREFIX.'generatedId',$generatedId);
        if (!empty($generatedId)) {
            $orderData = $this->Common_model->exequery("SELECT od.*, ot.transactionId, (CASE WHEN od.userId > 0 THEN us.email ELSE od.guestEmail END) as email  FROM oc_order as od left join oc_user as us on us.userId = od.userId left join oc_order_transaction as ot on (ot.orderId = od.orderId AND ot.paymentMethod = 'paytm' AND ot.paymentStatus = 0) WHERE od.status = 0 and ot.transactionId = '".$transactionId."' AND od.generatedId = '".$generatedId."'",1);
            if($orderData){
    		
	    		$paytmParams = array();
	    		$paytmParams['ORDER_ID'] 		= $generatedId;
	    		$paytmParams['TXN_AMOUNT'] 		= $orderData->grandTotal;
	    		$paytmParams["CUST_ID"] 		= $orderData->userId;
	    		$paytmParams["EMAIL"] 			= $orderData->email;

			    $paytmParams["MID"] 			= PAYTM_MERCHANT_MID;
			    $paytmParams["CHANNEL_ID"] 		= PAYTM_CHANNEL_ID;
			    $paytmParams["WEBSITE"] 		= PAYTM_MERCHANT_WEBSITE;
			    $paytmParams["CALLBACK_URL"] 	= PAYTM_CALLBACK_URL;
			    $paytmParams["INDUSTRY_TYPE_ID"]= PAYTM_INDUSTRY_TYPE_ID;
	    		
			    $paytmChecksum = $this->stack_web_gateway_paytm_kit->getChecksumFromArray($paytmParams, PAYTM_MERCHANT_KEY);
			    $paytmParams["CHECKSUMHASH"] = $paytmChecksum;
			    
			    $transactionURL = PAYTM_TXN_URL;
	    		// p($posted);
	    		// p($paytmParams,1);

	    		$this->outputData['paytmParams'] 	= $paytmParams;
	    		$this->outputData['transactionURL'] = $transactionURL;
	    		
	    	}
    	}

		$this->outputData['result'] = $error;
    	$this->load->viewF("paytm/payby_paytm",$this->outputData);
        
    }

    public function response(){
    	$error = "unauthorized";
    	$paytmChecksum 	= "";
		$paramList 		= array();
		$isValidChecksum= "FALSE";

        $transactionId = $this->session->userdata(PREFIX.'order_transactionId');
        
        $generatedId = $this->session->userdata(PREFIX.'generatedId');
        $this->outputData['generatedId'] = $generatedId;
        // $this->session->unset_userdata(PREFIX.'generatedId');
		$paramList = $_POST;
		$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
        $orderData = $this->Common_model->exequery("SELECT od.*, ot.transactionId, (CASE WHEN od.userId > 0 THEN us.email ELSE od.guestEmail END) as email  FROM oc_order as od left join oc_user as us on us.userId = od.userId left join oc_order_transaction as ot on (ot.orderId = od.orderId AND ot.paymentMethod = 'paytm' AND ot.paymentStatus = 0) WHERE od.status = 0 and ot.transactionId = '".$transactionId."' AND od.generatedId = '".$generatedId."'",1);
		header("Pragma: no-cache");
		header("Cache-Control: no-cache");
		header("Expires: 0");

		//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
		$isValidChecksum = $this->stack_web_gateway_paytm_kit->verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
        if (!empty($orderData)) {
          
        
    		if($isValidChecksum == "TRUE") {
    			$generatedId = $_POST['ORDERID'];
    			if ($_POST["STATUS"] == "TXN_SUCCESS") {
    				
    			 	$updateStatus = $this->Common_model->update("oc_order_transaction",["paymentMethod"=>"paytm", "paidAmt"=>$orderData->grandTotal, "paymentTrxId"=>$_POST['TXNID'], "paymentMessage"=>$_POST['RESPMSG'], "paymentStatus"=>1, "updatedOn"=> date('y-m-d H:i:s')], "transactionId= '".$orderData->transactionId."'");
                    if($updateStatus){
                        $error = "order_success";
                        $this->common_lib->sendOrderPlacedNotifications('order_success', $generatedId);
                       
                    }
                    else{
                        $error = "payment_success";
                        $this->common_lib->sendOrderPlacedNotifications('payment_success', $generatedId);
                    }
    			}else{
                    $this->Common_model->update("oc_order_transaction",["paymentMethod"=>"paytm", "paymentTrxId"=>isset($_POST['TXNID'])?$_POST['TXNID']:'', "paymentMessage"=>@$_POST['RESPMSG'], "paymentStatus"=>2, "updatedOn"=> date('y-m-d H:i:s')], "transactionId= '".$orderData->transactionId."'");
                   	$error = $_POST['RESPMSG'];
                }
            }elseif(!empty($generatedId)){
                $this->Common_model->update("oc_order_transaction",["paymentMethod"=>"paytm", "paymentTrxId"=>isset($_POST['TXNID'])?$_POST['TXNID']:'', "paymentMessage"=>isset($_POST['RESPMSG'])?$_POST['RESPMSG']:"Cancelled", "paymentStatus"=>3, "updatedOn"=> date('y-m-d H:i:s')], "transactionId= '".$orderData->transactionId."'");
                $error = isset($_POST['RESPMSG'])?$_POST['RESPMSG']:"payment_Cancel";
            }else{
            	if (isset($_POST['ORDERID'])) {
                    $this->Common_model->update("oc_order_transaction",["paymentMethod"=>"paytm", "paymentTrxId"=>isset($_POST['TXNID'])?$_POST['TXNID']:'', "paymentMessage"=>@$_POST['RESPMSG'], "paymentStatus"=>2, "updatedOn"=> date('y-m-d H:i:s')], "transactionId= '".$orderData->transactionId."'");
                    $error = isset($_POST['RESPMSG'])?$_POST['RESPMSG']:"payment_Failed";
            	}
            }
        }
        $this->outputData['result'] = $error;
        $this->load->viewF("paytm/payment_status_view",$this->outputData);
    }
}
?>
