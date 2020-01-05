
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/paypal-php-sdk/paypal/rest-api-sdk-php/sample/bootstrap.php'); // require paypal files

use PayPal\Api\ItemList;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;

class Paypal extends CI_Controller
{
    public $_api_context;
    public $outputData = array();

    public function  __construct()
    {
        parent::__construct();
        // paypal credentials
        $this->config->load('paypal');

        $this->_api_context = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $this->config->item('client_id'), $this->config->item('secret')
            )
        );
    }

    public function create_payment($generatedId = '')
    {   $error = "unauthorized";
        $transactionId = $this->session->userdata(PREFIX.'order_transactionId');
        if (!empty($generatedId) && !empty($transactionId)) {
            $orderData = $this->Common_model->exequery("SELECT od.*  FROM oc_order as od left join oc_order_transaction as ot on (ot.orderId = od.orderId AND ot.paymentMethod = 'paypal' AND ot.paymentStatus = 0) WHERE od.status = 0 AND ot.transactionId = '".$transactionId."' AND generatedId = '".$generatedId."'",1);
            if($orderData){

                $this->session->set_userdata(PREFIX.'generatedId',$generatedId);
                // setup PayPal api context
                $this->_api_context->setConfig($this->config->item('settings'));

                // ### Payer
                // A resource representing a Payer that funds a payment
                // For direct credit card payments, set payment method
                // to 'credit_card' and add an array of funding instruments.

                $payer['payment_method'] = 'paypal';

                // ### Itemized information
                // (Optional) Lets you specify item wise
                // information
                $invoice_number = uniqid();

                $item1["name"] = "CHASHMA4U_order_".$orderData->generatedId;
                $item1["sku"] = 2555554;  // Similar to `item_number` in Classic API 
                $item1["description"] = "CHASHMA4U_order_".$orderData->generatedId."_".$orderData->deliveryCharge."_".$orderData->grandTotal;
                $item1["currency"] ="USD";
                $item1["quantity"] =1;
                $item1["price"] = $orderData->grandTotal;
                $itemList = new ItemList();
                $itemList->setItems(array($item1));
        
                // ### Additional payment details
                // Use this optional field to set additional
                // payment information such as tax, shipping
                // charges etc.
                $details['tax'] = '0';
                $details['subtotal'] = $orderData->grandTotal;

                // ### Amount
                // Lets you specify a payment amount.
                // You can also specify additional details
                // such as shipping, tax.
                $amount['currency'] = "USD";
                $amount['total'] = $details['tax'] + $details['subtotal'];
                $amount['details'] = $details;
                // ### Transaction
                // A transaction defines the contract of a
                // payment - what is the payment for and who
                // is fulfilling it.
                $transaction['description'] ='Payment description';
                $transaction['amount'] = $amount;
                $transaction['invoice_number'] = $invoice_number;
                $transaction['item_list'] = $itemList;
                $transaction['custom'] = $orderData->generatedId; 



                // ### Redirect urls
                // Set the urls that the buyer must be redirected to after
                // payment approval/ cancellation.
                $baseUrl = BASEURL;
                $redirectUrls = new RedirectUrls();
                $redirectUrls->setReturnUrl($baseUrl."/paypal/payment_status")
                    ->setCancelUrl($baseUrl."/paypal/payment_status");
                // ### Payment
                // A Payment Resource; create one using
                // the above types and intent set to sale 'sale'
                $payment = new Payment();
                $payment->setIntent("sale")
                    ->setPayer($payer)
                    ->setRedirectUrls($redirectUrls)
                    ->setTransactions(array($transaction));

                try {
                    $payment->create($this->_api_context);
                } catch (Exception $ex) {
                    $error = $ex->getMessage();
                }
                foreach($payment->getLinks() as $link) {
                    if($link->getRel() == 'approval_url') {
                        $redirect_url = $link->getHref();
                        break;
                    }
                }

                if(isset($redirect_url))
                    redirect($redirect_url);
                else
                    $error = "wrong";

            }
        }

        $this->outputData['result'] = $error;
        $this->load->viewF("paypal/payment_status_view",$this->outputData);

    }


    public function payment_status()
    {
        $error = "unauthorized";
        
        $transactionId = $this->session->userdata(PREFIX.'order_transactionId');
        // paypal credentials
        $generatedId = $this->session->userdata(PREFIX.'generatedId');
        
        $this->outputData['generatedId'] = $generatedId;
        $this->session->unset_userdata(PREFIX.'generatedId');
        /** Get the payment ID before session clear **/
        $payment_id = $this->input->get("paymentId");
        $PayerID = $this->input->get("PayerID");
        $token = $this->input->get("token");
        /** clear the session payment ID **/
        $orderData = $this->Common_model->exequery("SELECT od.*, ot.transactionId  FROM oc_order as od left join oc_order_transaction as ot on (ot.orderId = od.orderId AND ot.paymentMethod = 'paypal' AND ot.paymentStatus = 0) WHERE od.status = 0 AND ot.transactionId = '".$transactionId."' AND generatedId = '".$generatedId."'",1);

        if (!empty($PayerID) && !empty($token) && !empty($payment_id) && !empty($orderData)){ 

            $payment = Payment::get($payment_id,$this->_api_context);


            /** PaymentExecution object includes information necessary **/
            /** to execute a PayPal account payment. **/
            /** The payer_id is added to the request query parameters **/
            /** when the user is redirected from paypal back to your site **/
            $execution = new PaymentExecution();
            $execution->setPayerId($this->input->get('PayerID'));

            /**Execute the payment **/
            $result = $payment->execute($execution,$this->_api_context);


            //  DEBUG RESULT, remove it later **/
            if ($result->getState() == 'approved') {
                $trans = $result->getTransactions();

                // item info
                // $Subtotal = $trans[0]->getAmount()->getDetails()->getSubtotal();
                // $Tax = $trans[0]->getAmount()->getDetails()->getTax();

                $payer = $result->getPayer();
                // payer info //
                $PaymentMethod =$payer->getPaymentMethod();
                $PayerStatus =$payer->getStatus();
                $PayerMail =$payer->getPayerInfo()->getEmail();

                $relatedResources = $trans[0]->getRelatedResources();
                $sale = $relatedResources[0]->getSale();
                // // sale info //
                $saleId = $sale->getId();
                // $CreateTime = $sale->getCreateTime();
                // $UpdateTime = $sale->getUpdateTime();
                $State = $sale->getState();
                $Total = $sale->getAmount()->getTotal();

                // $getItems = $trans[0]->getItemList()->getItems();
                $generatedId = $trans[0]->getCustom();
                /** it's all right **/
                /** Here Write your database logic like that insert record or value in database if you want **/
                // $this->paypal->create($Total,$Subtotal,$Tax,$PaymentMethod,$PayerStatus,$PayerMail,$saleId,$CreateTime,$UpdateTime,$State);
                $updateStatus = $this->Common_model->update("oc_order_transaction",["paymentMethod"=>$PaymentMethod, "payerMail"=>$PayerMail, "paymentMessage"=>$State, "paidAmt"=>$Total, "paymentTrxId"=>$saleId, "paymentStatus"=>1, "addedOn"=> date('Y-m-d H:i:s')], "transactionId= '".$orderData->transactionId."'");
                if($updateStatus){
                    $error = "order_success";
                    $this->common_lib->sendOrderPlacedNotifications('order_success', $generatedId);
                   
                }
                else{
                    $error = "payment_success";
                    $this->common_lib->sendOrderPlacedNotifications('payment_success', $generatedId);
                }
                // $updateData = array('paymentMethod'=>$PaymentMethod,'payerStatus'=>$PayerStatus,'payerMail'=>$PayerMail,'updated_at'=>$UpdateTime,'state'=>$State,'subtotal'=>$Subtotal,'transactionId'=>$transactionId,'paymentId'=>$payment_id,'payerId'=>$PayerID);
                // $return=$this->Common_model->update("oc_order",$updateData);
            }else{
                // v3print($result); exit;
                $this->Common_model->update("oc_order_transaction",["paymentMethod"=>"paypal", "payerMail"=>"", "paymentMessage"=>"Failed", "paymentStatus"=>2, "addedOn"=> date('y-m-d H:i:s')], "transactionId= '".$orderData->transactionId."'");
                $error = "payment_Failed";
            }
        }elseif(!empty($token) && !empty($generatedId)){
            $this->Common_model->update("oc_order_transaction",["paymentMethod"=>"paypal", "payerMail"=>"", "paymentMessage"=>"Cancelled", "paymentStatus"=>3, "addedOn"=> date('y-m-d H:i:s')], "transactionId= '".$orderData->transactionId."'");
            $error = "payment_Cancel";
        }

        $this->outputData['result'] = $error;
        $this->load->viewF("paypal/payment_status_view",$this->outputData);
    }
    public function success(){
        $this->outputData['result'] = "order_success";
        $this->load->viewF("paypal/payment_status_view",$this->outputData);
    }
    public function cancel(){
        $this->outputData['result'] = "payment_Failed";
        $this->load->viewF("paypal/payment_status_view",$this->outputData);
    }
}