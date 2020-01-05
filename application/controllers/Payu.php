<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payu extends CI_Controller
{
    public $outputData = array();

    public function  __construct()
    {
        parent::__construct();
        $this->load->config('payu');
        
    }

    public function create_payment($generatedId = ''){

        $transactionId = $this->session->userdata(PREFIX.'order_transactionId');

        if (!empty($generatedId)) {
              
            $this->outputData['orderData'] = $this->Common_model->exequery("SELECT od.*, ot.transactionId, us.firstName as user, us.email as email, us.mobile as  mobile, (SELECT GROUP_CONCAT(productName) FROM ch_product  WHERE productId IN (SELECT productId FROM ch_order_detail  WHERE orderId = od.orderId) ) as products from ".tablePrefix."order as od left join ".tablePrefix."user as us on us.userId = od.userId left join ch_order_transaction as ot on (ot.orderId = od.orderId AND ot.paymentMethod = 'payu' AND ot.paymentStatus = 0) WHERE od.status = 0 and ot.transactionId = '".$transactionId."' AND od.generatedId = '".$generatedId."'",1);
        }
            

        if (!isset($this->outputData['orderData']->orderId) || empty($this->outputData['orderData']->orderId)){
            $this->common_lib->setSessMsg('Invalid request.', 2);
            redirect(BASEURL.'/cart');
        }
        $this->session->set_userdata(PREFIX.'generatedId',$generatedId);

        $this->load->viewF("payu/payment_create_view",$this->outputData);
    }

    public function check(){
         
        $transactionId = $this->session->userdata(PREFIX.'order_transactionId');

         // all values are required
        $amount =  $this->input->post('payble_amount');
        $product_info = $this->input->post('product_info');
        $customer_name = $this->input->post('customer_name');
        $customer_emial = $this->input->post('customer_email');
        $customer_mobile = $this->input->post('mobile_number');
        $customer_address = $this->input->post('customer_address');
        
        //payu details
    
    
        $MERCHANT_KEY = $this->config->item('current_merchant_key'); //change  merchant with yours
        $SALT = $this->config->item('current_salt');  //change salt with yours 

        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        //optional udf values 
        $udf1 = '';
        $udf2 = '';
        $udf3 = '';
        $udf4 = '';
        $udf5 = '';
        
        $hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $amount . '|' . $product_info . '|' . $customer_name . '|' . $customer_emial . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $SALT;
         $hash = strtolower(hash('sha512', $hashstring));
         
        $success = BASEURL . '/payu/payment_status';  
        $fail = BASEURL . '/payu/payment_status'; 
        $cancel = BASEURL . '/payu/payment_status'; 
        
        
        $data = array(
            'mkey' => $MERCHANT_KEY,
            'tid' => $txnid,
            'hash' => $hash,
            'amount' => $amount,           
            'name' => $customer_name,
            'productinfo' => $product_info,
            'mailid' => $customer_emial,
            'phoneno' => $customer_mobile,
            'address' => $customer_address,
            'action' => $this->config->item('current_url'),
            'sucess' => $success,
            'failure' => $fail,
            'cancel' => $cancel            
        );
        $this->load->viewF("payu/payment_confirmation_view",$data);
         
    }


    public function payment_status(){

        $error = "unauthorized";
        $status = $this->input->post('status');
        $generatedId = $this->session->userdata(PREFIX.'generatedId');
        $transactionId = $this->session->userdata(PREFIX.'order_transactionId');
        
        $this->outputData['generatedId'] = $generatedId;
        // $this->session->unset_userdata(PREFIX.'generatedId');
        $orderData = $this->Common_model->exequery("SELECT od.*, ot.transactionId, us.firstName as user, us.email as email, us.mobile as  mobile  FROM ch_order as od left join ch_user as us on us.userId = od.userId left join ch_order_transaction as ot on (ot.orderId = od.orderId AND ot.paymentMethod = 'payu' AND ot.paymentStatus = 0) WHERE od.status = 0 and ot.transactionId = '".$transactionId."' AND od.generatedId = '".$generatedId."'",1);
        if(!empty($orderData)){
            if (!empty($status)) {
               
                if($status == 'success'){
                    $updateStatus = $this->Common_model->update("ch_order_transaction",["paymentMethod"=>"payu", "payerMail"=>'', "paidAmt"=>$this->input->post('amount'), "paymentTrxId"=>$this->input->post('txnid'), "paymentMessage"=>$this->input->post('status'), "paymentStatus"=>1, "addedOn"=> date('y-m-d H:i:s')], "transactionId= '".$orderData->transactionId."'");
                    if($updateStatus){
                        $error = "order_success";
                        $this->common_lib->sendOrderPlacedNotifications('order_success', $generatedId);
                       
                    }
                    else{
                        $error = "payment_success";
                        $this->common_lib->sendOrderPlacedNotifications('payment_success', $generatedId);
                    }
                }
                else{
                    $this->Common_model->update("ch_order_transaction",["paymentMethod"=>"payu", "payerMail"=>"", "paymentTrxId"=>$this->input->post('txnid'), "paymentMessage"=>($this->input->post('error_Message'))?$this->input->post('error_Message'):$this->input->post('status'), "paymentStatus"=>2, "addedOn"=> date('y-m-d H:i:s')], "transactionId= '".$orderData->transactionId."'");
                    $error = "payment_Failed";
                }
            }elseif(!empty($this->input->post('txnid')) && !empty($generatedId)){
                $this->Common_model->update("ch_order_transaction",["paymentMethod"=>"payu", "payerMail"=>"", "paymentTrxId"=>$this->input->post('txnid'), "paymentMessage"=>"Cancelled", "paymentStatus"=>3, "addedOn"=> date('y-m-d H:i:s')], "transactionId= '".$orderData->transactionId."'");
                $error = "payment_Cancel";
            }
        }


        $this->outputData['result'] = $error;
        $this->load->viewF("payu/payment_status_view",$this->outputData);
    }



}