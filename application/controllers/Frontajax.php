<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Frontajax extends CI_Controller {



	public $outputData 	= array();

	public $langSuffix = '';

	

	public function __construct(){

		parent::__construct();

		//Check login authentication & set public veriables

		// $this->session->set_userdata(PREFIX.'sessRole', "admin");

		// $this->common_lib->setSessionVariables();

	}

	

	// Skwoll - Ajax landing page

	public function index(){

		$action = '';

		$action = @$_POST['action'];

		$return = array("valid" => false, "data" => $_POST, "msg" => "UnAuthorised Access!");

		if( $action == "checkPincode" ) 
			$return =  $this->checkPincode();
		else if( $action == "getFutureDeliverSlot" ) 
			$return =  $this->getFutureDeliverSlot();
		else if( $action == "addReview")
			$return =  $this->addReview();
		else if($action=="logincheck")
			$return=$this->logincheck();
		else if($action=="logout")
			$return=$this->logout();
		else if( $action == "registration")
			$return =  $this->registration();
		else if($action=="forgotpassword")
			$return=$this->forgotpassword();
		else if($action == "sarchZones")
			$return =  $this->sarchZones();
		else if($action == "setZone")
			$return =  $this->setZone();
		else if($action == "updateUserDetails")
			$return =  $this->updateUserDetails();
		else if($action == "addUpdateAddress")
			$return =  $this->addUpdateAddress();
		else if($action=="changeUserPassword")
			$return=$this->changeUserPassword();
		else if( $action == "deleteRecord" )
			$return = $this->deleteRecord($_POST);
		else if( $action == "addRemoveFromWishlist" )
			$return = $this->addRemoveFromWishlist();
		else if( $action == "addProductToCart" )
			$return = $this->addProductToCart();
		else if( $action == "updateCart" )
			$return = $this->updateCart();
        else if($action == "applyCoupon")
        	$return = $this->applyCoupon();
        else if($action == "removeAppliedCoupon")
        	$return = $this->removeAppliedCoupon();
		else if( $action == "createOrder" )
			$return = $this->createOrder();
		else if( $action == "ourStores" )
			$return = $this->ourStores();
		else if( $action == "userOrderList" )
			$return = $this->userOrderList();
		else if( $action == "sendEnquiry" )
			$return = $this->sendEnquiry();
		else if( $action == "sendFanchiseEnquiry" )
			$return = $this->sendFanchiseEnquiry();
		else if( $action == "ajaxScrollProduct" )
			$return = $this->ajaxScrollProduct();
		else if( $action == "getFrontPagehtml" )
			$return = $this->getFrontPagehtml();
		else if( $action == "getFrontFooterDescription" )
			$return = $this->getFrontFooterDescription();
		else if( $action == "getFrontFooterhtml" )
			$return = $this->getFrontFooterhtml();
		else if( $action == "uploadSharedMoment" )
			$return = $this->uploadSharedMoment();
        else if($action == "blogList")
        	$return = $this->blogList();
        else if($action == "blog_comment")
        	$return = $this->blogComment();
        else if($action == "viewMoreBlogComment")
        	$return = $this->viewMoreBlogComment();
        else if($action == "viewMoreReply")
        	$return = $this->viewMoreReply();
        else if($action == "sendCorporateEnquiry")
        	$return = $this->sendCorporateEnquiry();
        else if($action == "viewMorePhotoGalleryImages")
        	$return = $this->viewMorePhotoGalleryImages();
        else if($action == "updateVisitorData")
        	$return = $this->updateVisitorData();
        else if($action == "updateCartData")
        	$return = $this->updateCartData();

		$this->output->set_content_type('application/json')->set_output(json_encode($return));



	}


	function deleteRecord($data){
		$tab = @$data['tab'];
		$id = @$data['id'];
		$updateStatus = 0;
		if ($tab == 'address')
			$updateStatus = $this->Common_model->update(tablePrefix.'user_address', array('status' => 2), "addressId =".$id." AND userId =".$this->session->userdata(PREFIX.'userRoleId'));
		elseif ($tab == 'wishlist')
			$updateStatus = $this->Common_model->del(tablePrefix.'wishlist', "wishlistId =".$id." AND userId =".$this->session->userdata(PREFIX.'userRoleId'));
		else
			$updateStatus = $this->Common_model->update(tablePrefix.$tab, array('status' => 2), $tab."Id =".$id);
		if( $updateStatus )
			return array("valid" => true, "data" => array(), "msg" => "Status updated successfully!");
		else 
			return array("valid" => false, "data" => array(), "msg" => "Something Went Wrong");
	}

	function checkPincode() {
		$todayTimeSlotData = $tomorrowTimeSlotData = $futureTimeSlotData = '';
		$courierDeliveryAmt = 0;
		$todayDate = date('Y-m-d');
		$tomorrowDate = date("Y-m-d",strtotime("tomorrow"));
		$productData = $this->Common_model->exequery("SELECT * FROM `ch_product` WHERE productId = '".$_POST['productId']."'", true);

		$calenderStart = ($productData->isSameDayDelivery || ($productData->minDayReqtoDeliver <= 2))?'+2 day':'+'.$productData->minDayReqtoDeliver.' day';
		$futureDate = date("Y-m-d",strtotime($calenderStart));

		$pincodeData = $this->Common_model->exequery("SELECT pc.*, zn.lastDeliveryTime FROM `ch_pincode` as pc left join ch_zone as zn on zn.zoneId = pc.zoneId WHERE pc.status = 0 AND zn.status = 0 AND pc.pincode = '".$_POST['pincode']."'", true);

		if(!empty($productData) && !empty($pincodeData)){

			if (!empty($productData->deliveryCityId) && !in_array($pincodeData->zoneId, explode(',', $productData->deliveryCityId))) {
				return array("valid" => false, 'todayTimeSlotData'=> '', 'msg'=> 'This product is available in only some cities.');
			}
			if (!empty($productData->undeliverCityId) && in_array($pincodeData->zoneId, explode(',', $productData->undeliverCityId))) {
				return array("valid" => false, 'todayTimeSlotData'=> '', 'msg'=> 'This product is not available on this area.');
			}
			if (!empty($productData->deliveryPincodeId) && !in_array($pincodeData->pincodeId, explode(',', $productData->deliveryPincodeId))) {
				return array("valid" => false, 'todayTimeSlotData'=> '', 'msg'=> 'This product is not available on this pincode.');
			}
			if (!empty($productData->undeliverPincodeId) && in_array($pincodeData->pincodeId, explode(',', $productData->undeliverPincodeId))) {
				return array("valid" => false, 'todayTimeSlotData'=> '', 'msg'=> 'This product is not available on this pincode.');
			}

 			$deliveryData = $this->Common_model->exequery("SELECT * FROM `ch_delivery_service` WHERE status = 0 AND pincodeId = '".$pincodeData->pincodeId."' ORDER BY deliveryType ASC");
 			// v3print($deliveryData); exit;
 			if (!empty($deliveryData)) {
 				foreach ($deliveryData as $delivery) {
 					if($courierDeliveryAmt == 0 || ($courierDeliveryAmt > $delivery->deliveryAmount)){
 						$courierDeliveryAmt = $delivery->deliveryAmount;
 						$courierDeliveryPincodeId = $delivery->pincodeId;
 					}
 					$delivery->timeSlots = $this->Common_model->exequery("SELECT *, (SELECT COUNT(DISTINCT orderId) FROM `ch_order_detail` WHERE `requestedDeliveryDate` = '".$todayDate."' and timeslotId = ch_delivery_time_slots.timeslotId) as todayOrders, (SELECT COUNT(DISTINCT orderId) FROM `ch_order_detail` WHERE `requestedDeliveryDate` = '".$tomorrowDate."' and timeslotId = ch_delivery_time_slots.timeslotId) as tomorrowOrders, (SELECT COUNT(DISTINCT orderId) FROM `ch_order_detail` WHERE `requestedDeliveryDate` = '".$futureDate."' and timeslotId = ch_delivery_time_slots.timeslotId) as futureDateOrders FROM `ch_delivery_time_slots` WHERE status = 0 AND numberofDelivery > 0 AND deliveryId = ".$delivery->deliveryTimeSlotId."  order by startTime asc");
 					if (!empty($delivery->timeSlots)) {
 						// v3print($delivery->timeSlots);
 						$todayData = '<li><div class="delivery-detail-heading"><div class="radio"><input id="radio-today-'.$delivery->deliveryTimeSlotId.'" name="del-time" type="radio"><label for="radio-today-'.$delivery->deliveryTimeSlotId.'" class="radio-label time-pattern">'.$delivery->deliveryType.':</label>';
 						$tomorrowData = '<li><div class="delivery-detail-heading"><div class="radio"><input id="radio-tomorrow-'.$delivery->deliveryTimeSlotId.'" name="del-time" type="radio"><label for="radio-tomorrow-'.$delivery->deliveryTimeSlotId.'" class="radio-label time-pattern">'.$delivery->deliveryType.':</label>';
 						$futureData = '<li><div class="delivery-detail-heading"><div class="radio"><input id="radio-future-'.$delivery->deliveryTimeSlotId.'" name="del-time" type="radio"><label for="radio-future-'.$delivery->deliveryTimeSlotId.'" class="radio-label time-pattern">'.$delivery->deliveryType.':</label>';
                        if($delivery->deliveryAmount=="0")
                        	$delivery->deliveryAmount = "Free";
                        else
                        	$delivery->deliveryAmount = '<span>₹</span>'.$delivery->deliveryAmount;

						$html2 = '</div><div class="time-price">'.$delivery->deliveryAmount.'</div></div><div class="delivery-detail-content"><div class="time-slot"><img src="'.FRONTSTATIC.'/img/product-detail/time-slot-icon.png" alt=""> '.$delivery->deliveryType.' Time Slot Selected.</div><div class="del-time-slot"><p>Delivery Time Slot (Hrs.)</p><ul>';

						$todaySlot = $tomorrowSlot = $futureSlot = '';
						foreach ($delivery->timeSlots as $timeSlot) {
							// echo "$productData->isSameDayDelivery"."--";echo "$productData->minDayReqtoDeliver"."--"; exit;
							$attr = ' timeslotId="'.$timeSlot->timeslotId.'" deliveryTimeSlotId="'.$delivery->deliveryTimeSlotId.'" pincodeId="'.$delivery->pincodeId.'" zoneId="'.$pincodeData->zoneId.'" data-price="'.$delivery->deliveryAmount.'"';
							$addTimeStr = '';
							if($productData->minHourReqtoDeliver > 0)
								$addTimeStr .='+'.$productData->minHourReqtoDeliver.' hours';
							if($productData->minMinuteReqtoDeliver > 0)
								$addTimeStr .=' +'.$productData->minMinuteReqtoDeliver.' minutes';
							// $new_date= date("Y-m-d H:i:s", strtotime($date1 . " +3 hours"));
	 						if ($productData->isSameDayDelivery && strtotime($timeSlot->startTime) >= strtotime(date('H:i:s').$addTimeStr) ) {
	 							if($timeSlot->numberofDelivery > $timeSlot->todayOrders  && strtotime($timeSlot->startTime) <= strtotime($pincodeData->lastDeliveryTime))
	 								$todaySlot .=	'<li><button type="button" class="btn btn-time-slot" '.$attr.' slotDate="'.$todayDate.'" >'.$timeSlot->startTime.' - '.$timeSlot->endTime.'</button></li>';
	 							
	 						}
	 						if($productData->isSameDayDelivery == 1 || $productData->minDayReqtoDeliver <=1){

	 							if($timeSlot->numberofDelivery > $timeSlot->tomorrowOrders)
									$tomorrowSlot .= '<li><button type="button" class="btn btn-time-slot" '.$attr.' slotDate="'.$tomorrowDate.'" >'.$timeSlot->startTime.' - '.$timeSlot->endTime.'</button></li>';
								
							}

							if($timeSlot->numberofDelivery > $timeSlot->futureDateOrders){
									$futureSlot .= '<li><button type="button" class="btn btn-time-slot" '.$attr.' slotDate="'.$futureDate.'" >'.$timeSlot->startTime.' - '.$timeSlot->endTime.'</button></li>';
								
							}
						}
						$html3 = '</ul></div></div></li>';
						$todayTimeSlotData .= ($todaySlot)?$todayData.$html2.$todaySlot.$html3:'';
						
						$tomorrowTimeSlotData .= ($tomorrowSlot)?$tomorrowData.$html2.$tomorrowSlot.$html3:'';
						$futureTimeSlotData .= ($futureSlot)?$futureData.$html2.$futureSlot.$html3:'';
 					}
 				}
 			}
		}

		if (!empty($todayTimeSlotData) || !empty($tomorrowTimeSlotData) || !empty($futureTimeSlotData)){

			$this->session->set_userdata(PREFIX.'todayTimeSlotData-'.trim($_POST['productId']), $todayTimeSlotData);
			$this->session->set_userdata(PREFIX.'tomorrowTimeSlotData-'.trim($_POST['productId']), $tomorrowTimeSlotData);
			$this->session->set_userdata(PREFIX.'futureTimeSlotData-'.trim($_POST['productId']), $futureTimeSlotData);
			$this->session->set_userdata(PREFIX.'currentPincode', $_POST['pincode']);
			$this->session->set_userdata(PREFIX.'currentDeliverTo', $_POST['deliverTo']);
			$this->session->set_userdata(PREFIX.'currentState', $_POST['state']);
			$this->session->set_userdata(PREFIX.'currentCountry', $_POST['country']);	
			return array("valid" => true, "isCourierDelivery" => $productData->isCourierDelivery, "courierDeliveryAmt" => $courierDeliveryAmt, "courierDeliveryPincodeId" => $courierDeliveryPincodeId, 'todayTimeSlotData'=>$todayTimeSlotData, 'tomorrowTimeSlotData'=>$tomorrowTimeSlotData, 'futureTimeSlotData'=>$futureTimeSlotData, 'loc'=>[$_POST['state'], $_POST['country'], $this->session->userdata(PREFIX.'currentState'), $this->session->userdata(PREFIX.'currentCountry')]);
		}
		else
			return array("valid" => false, 'todayTimeSlotData'=> '', 'msg'=> 'Sorry! We are not deliver on this pincode.');
	}

	function getFutureDeliverSlot() {
		$futureTimeSlotData = '';
		$courierDeliveryAmt = 0;

		$futureDate = date('Y-m-d', strtotime($_POST['dateStr']));
		$datetime1 = date_create(date('Y-m-d', strtotime($_POST['dateStr']))); 
		$datetime2 = date_create(date('Y-m-d'));
		$interval = date_diff($datetime2, $datetime1)->format('%a');

		$productData = $this->Common_model->exequery("SELECT * FROM `ch_product` WHERE (isSameDayDelivery = 1 OR minDayReqtoDeliver <=$interval ) AND productId = '".$_POST['productId']."'", true);
		$pincodeData = $this->Common_model->exequery("SELECT pc.*, zn.lastDeliveryTime FROM `ch_pincode` as pc left join ch_zone as zn on zn.zoneId = pc.zoneId WHERE pc.status = 0 AND zn.status = 0 AND pc.pincode = '".$_POST['pincode']."'", true);

		if(!empty($productData) && !empty($pincodeData)){

			if (!empty($productData->deliveryCityId) && !in_array($pincodeData->zoneId, explode(',', $productData->deliveryCityId))) {
				return array("valid" => false, 'futureTimeSlotData'=> '', 'msg'=> 'This product is available in only some cities.');
			}
			if (!empty($productData->undeliverCityId) && in_array($pincodeData->zoneId, explode(',', $productData->undeliverCityId))) {
				return array("valid" => false, 'futureTimeSlotData'=> '', 'msg'=> 'This product is not available on this area.');
			}
			if (!empty($productData->undeliverPincodeId) && in_array($pincodeData->pincodeId, explode(',', $productData->undeliverPincodeId))) {
				return array("valid" => false, 'futureTimeSlotData'=> '', 'msg'=> 'This product is not available on this pincode.');
			}
			$deliveryData = $this->Common_model->exequery("SELECT * FROM `ch_delivery_service` WHERE status = 0 AND pincodeId = '".$pincodeData->pincodeId."' ORDER BY deliveryType ASC");

 			// return array("valid" => false, 'todayTimeSlotData'=> '', 'msg'=> 'Sorry! We are not deliver on this pincode.');
 			if (!empty($deliveryData)) {
 				foreach ($deliveryData as $delivery) {
 					if($courierDeliveryAmt == 0 || ($courierDeliveryAmt > $delivery->deliveryAmount)){
 						$courierDeliveryAmt = $delivery->deliveryAmount;
 						$courierDeliveryPincodeId = $delivery->pincodeId;
 					}
 					$delivery->timeSlots = $this->Common_model->exequery("SELECT *, (SELECT COUNT(DISTINCT orderId) FROM `ch_order_detail` WHERE `requestedDeliveryDate` = '".$futureDate."' and timeslotId = ch_delivery_time_slots.timeslotId) as futureDateOrders FROM `ch_delivery_time_slots` WHERE status = 0 AND numberofDelivery > 0 AND deliveryId = ".$delivery->deliveryTimeSlotId." order by startTime asc");
 					if (!empty($delivery->timeSlots)) {

 						$futureData = '<li><div class="delivery-detail-heading"><div class="radio"><input id="radio-future-'.$delivery->deliveryTimeSlotId.'" name="del-time" type="radio"><label for="radio-future-'.$delivery->deliveryTimeSlotId.'" class="radio-label time-pattern">'.$delivery->deliveryType.':</label>';
                        if($delivery->deliveryAmount == "0")
                        	$delivery->deliveryAmount = "Free";
                        else
                        	$delivery->deliveryAmount = '<span>₹</span>'.$delivery->deliveryAmount;
						$html2 = '</div><div class="time-price">'.$delivery->deliveryAmount.'</div></div><div class="delivery-detail-content"><div class="time-slot"><img src="'.FRONTSTATIC.'/img/product-detail/time-slot-icon.png" alt=""> '.$delivery->deliveryType.' Time Slot Selected.</div><div class="del-time-slot"><p>Delivery Time Slot (Hrs.)</p><ul>';

						$futureSlot = '';
						foreach ($delivery->timeSlots as $timeSlot) {
							// echo "$productData->isSameDayDelivery"."--";echo "$productData->minDayReqtoDeliver"."--"; exit;
							$attr = ' timeslotId="'.$timeSlot->timeslotId.'" deliveryTimeSlotId="'.$delivery->deliveryTimeSlotId.'" pincodeId="'.$delivery->pincodeId.'" zoneId="'.$pincodeData->zoneId.'" data-price="'.$delivery->deliveryAmount.'"';

							if($timeSlot->numberofDelivery > $timeSlot->futureDateOrders){
									$futureSlot .= '<li><button type="button" class="btn btn-time-slot" '.$attr.' slotDate="'.$futureDate.'" >'.$timeSlot->startTime.' - '.$timeSlot->endTime.'</button></li>';
								
							}
						}
						$html3 = '</ul></div></div></li>';
						$futureTimeSlotData .= ($futureSlot)?$futureData.$html2.$futureSlot.$html3:'';
 					}
 				}
 			}


		}

		
		if (!empty($futureTimeSlotData)){	
			return array("valid" => true, "isCourierDelivery" => $productData->isCourierDelivery, "courierDeliveryAmt" => $courierDeliveryAmt, "courierDeliveryPincodeId" => $courierDeliveryPincodeId, 'futureTimeSlotData'=>$futureTimeSlotData);
		}
		else
			return array("valid" => false, 'todayTimeSlotData'=> '', 'msg'=> 'Sorry! We are not deliver on this pincode.');
	}


	function addReview() {

		$response = array("valid" => false, 'msg'=> 'Something is wrong.');		
		$userId = ($this->session->userdata(PREFIX.'userRoleId'))?$this->session->userdata(PREFIX.'userRoleId'):0;
		if (isset($_POST['productId']) && !empty($_POST['productId']) && $userId > 0) {
			foreach ($_POST['productId'] as $key => $productId) {
				if ($productId > 0) {
					$isExist =  $this->Common_model->exequery("SELECT * FROM ch_review WHERE status !=2 AND productId='".$productId."' AND userId = '".$userId."' ",1);
					if (!$isExist) {
						if($this->Common_model->insert("ch_review",['userId'=>$userId, 'review'=>$_POST['review'.$productId], 'rating'=>$_POST['rating'.$productId], 'productId'=>$productId, 'orderId'=>(isset($_POST['orderId']))?$_POST['orderId']:0, 'is_admin'=>0, 'status'=>-1, 'addedOn'=>date('Y-m-d H:i:s'), 'updatedOn'=>date('Y-m-d H:i:s')]))
							$response = array("valid" => true, 'msg'=> 'Thank your for your review.');
						else
							$response = array("valid" => false, 'msg'=> 'Something went wrong.');
					}else
						$response = array("valid" => false, 'msg'=> 'You have already review this.');
				}
			}

		}
		return $response;

	}

    public function logincheck(){ 

        $response = array('valid' => false, 'msg'=>'Invalid Request', 'role'=>'user', 'img'=>NOIMAGE);
        if(isset($_POST['email']) && !empty($_POST['email'])) {
           	$email   	= $_POST['email'];
            $pass       = $_POST['password'];
            $cond       = (isset($_POST['role']) && trim($_POST['role']) =='user')?" AND au.role = 'user'":"";
            $data =  $this->Common_model->exequery("SELECT au.*, us.firstName, us.mobile, (CASE WHEN us.img='' THEN '".NOIMAGE."' else concat('".UPLOADPATH."/user_images/',us.img) END) as img  FROM ch_auths as au left join ch_user as us on (us.userId = au.roleId AND au.role ='user') WHERE au.status != 2 and  (au.phoneNumber = '".$_POST['email']."' OR au.email = '".$_POST['email']."') and au.password = '".md5($_POST['password'])."'".$cond,1);

            if(isset($data->roleId)){
                if($data->status == 0){	      					
					if($data->role == 'user'){
						$this->session->set_userdata(PREFIX.'userEmail', $data->email);
						$this->session->set_userdata(PREFIX.'userRoleId', $data->roleId);
						$this->session->set_userdata(PREFIX.'userRole', 'user');
						$this->session->set_userdata(PREFIX.'userAuthId', $data->authId);
						$this->session->set_userdata(PREFIX.'userImg', $data->img);
						$this->session->set_userdata(PREFIX.'userFirstName', $data->firstName);
						$this->session->set_userdata(PREFIX.'userMobile', $data->mobile);
						$this->common_lib->setUserSessionVariables();
					}else if($data->role == 'admin' || $data->role == 'vendor' || $data->role == 'employee')  {
						$sessDashboard = $data->role;
						$sessDashboardId = $data->roleId;
						$sessEmployeeRole = $sessEmployeeRoleId = $sessPermissions =  $sessEmployeeAddedBy = '';
						$sessEmployeeAddedById = 0;

						if ($data->role == 'admin') {
							$data->username = 'Admin';
							$resultarr['flag']	=	2;
								
							
						}else if ($data->role == 'vendor') {
							$vendorData	=	$this->Common_model->exequery("SELECT *  from ".tablePrefix."vendor WHERE vendorId ='".$data->roleId."'",1);
							
							if(!empty($vendorData)){
								if($vendorData->status == 0){
									$data->username = $vendorData->vendorName;
									$resultarr['flag']	=	2;
								}else
									return $resultarr['flag']	=	3;
							}else
								return $resultarr['flag']	=	4;
							
						}else if ($data->role == 'employee') {
							$employeeData	=	$this->Common_model->exequery("SELECT em.*, rl.role, rl.addedBy, rl.addedById, rl.permissions  from ".tablePrefix."employee as em left join ch_role as rl on rl.roleId = em.roleId where em.employeeId ='".$data->roleId."'",1);
							
							if(!empty($employeeData)){

								if($employeeData->status == 0){
									$sessDashboard = strtolower($employeeData->addedBy);
									$sessDashboardId = $employeeData->vendorId;
									$data->role = $employeeData->role;
									$data->username = $employeeData->employeeName;
									
									$sessEmployeeAddedById = $employeeData->addedById;
									$sessEmployeeAddedBy = $employeeData->addedBy;
									$sessEmployeeRoleId = $employeeData->roleId;
									$sessPermissions = $employeeData->permissions;
									$resultarr['flag']	=	2;
								}else
									return $resultarr['flag']	=	3;
							}else
								return $resultarr['flag']	=	4;
							
						}
						if($resultarr['flag'] == 2){
			
							$this->session->set_userdata(PREFIX.'sessDashboard', $sessDashboard );
							$this->session->set_userdata(PREFIX.'sessDashboardId', $sessDashboardId );
							$this->session->set_userdata(PREFIX.'sessAuthId', $data->authId);
							$this->session->set_userdata(PREFIX.'sessEmail', $data->email);
							$this->session->set_userdata(PREFIX.'sessUserName', $data->username);
							$this->session->set_userdata(PREFIX.'sessRoleId', $data->roleId);
							$this->session->set_userdata(PREFIX.'sessRole', $data->role);
							$this->session->set_userdata(PREFIX.'sessLang', 'english');
							$this->session->set_userdata(PREFIX.'sessEmployeeRole', $sessEmployeeRole);
							$this->session->set_userdata(PREFIX.'sessEmployeeRoleId', $sessEmployeeRoleId);
							$this->session->set_userdata(PREFIX.'sessEmployeeAddedBy', $sessEmployeeAddedBy);
							$this->session->set_userdata(PREFIX.'sessEmployeeAddedById', $sessEmployeeAddedById);
							$this->session->set_userdata(PREFIX.'sessPermissions', ($sessPermissions)?array_keys(unserialize($sessPermissions)):array());
							$this->Common_model->update(tablePrefix."auths", array("lastAccessIp" => $_SERVER['REMOTE_ADDR'] ) , " authId = ".$data->authId);
							// $this->Common_model->insert(tablePrefix."ipaddress", array("role" => $data->role, "roleId" => $data->roleId, "lastAccessIp" => $_SERVER['REMOTE_ADDR'], "addedOn" => date('Y-m-d H:i:s')));
							$data->role = $sessDashboard;

						}else if($dbresult['flag'] == 3)
							return array('valid' => false, 'msg'=>'Your Account currenctly DeActive. Please contact with admin.', 'role'=>'user', 'img'=>NOIMAGE);
			            else if($dbresult['flag'] == 4)
							return array('valid' => false, 'msg'=>'Something is wrong with your account. Please contact with admin.', 'role'=>'user', 'img'=>NOIMAGE);
					}else
						return array('valid' => false, 'msg'=>'Something went wrong', 'role'=>'user', 'img'=>NOIMAGE);
					
					$pincode =  $this->session->userdata(PREFIX.'currentPincode');
					$addressHtml = '';
					if (isset($_POST['addressRequested']) && !empty($_POST['addressRequested']) && $data->roleId > 0 && !empty($pincode)){
						$addressData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."user_address WHERE status ='0' AND userId = '".$data->roleId."' AND pincode = '".$pincode."'");
						if (!empty($addressData)) {
							foreach ($addressData as $address) {
								$addressHtml .= '<li class="address-item '.(($addressHtml)?'':'active').'"> <input type="radio" id="addressId-'.$address->addressId.'" name="addressId" value="'.$address->addressId.'"> <label for="addressId-'.$address->addressId.'"><span>'.$address->name.'</span>  '.$address->mobile.'</label> <button type="button" class="edit-btn pull-right" onclick="window.location.href=\''.BASEURL.'/detail/'.$address->addressId.'\';">Edit</button> <div class="delivery-detail"> <p>'.$address->address.' '.$address->address2.' '.$address->city.' '.$address->pincode.'</p> <button type="button" class="delivery-here-btn'.(($addressHtml)?'hide':'').'" onclick="deliverHere(this)">Delivery Here</button> </div> </li>';
								
							}
						}
					}

                    $response = array('valid' => true, 'msg'=>'Logged in successfully.',  'role'=>$data->role, 'img'=>$data->img, 'name'=>$data->firstName, 'mobile'=>$data->mobile, 'addressHtml'=>$addressHtml);
                }else{
                	$this->session->unset_userdata(PREFIX.'userEmail');
					$this->session->unset_userdata(PREFIX.'userRoleId');
					$this->session->unset_userdata(PREFIX.'userRole');
					$this->session->unset_userdata(PREFIX.'userAuthId');
					$this->session->unset_userdata(PREFIX.'userImg');
					$this->session->unset_userdata(PREFIX.'userFirstName');
					$this->session->unset_userdata(PREFIX.'userMobile');
					$this->session->unset_userdata(PREFIX.'sessEmail');
					$this->session->unset_userdata(PREFIX.'sessRoleId');
					$this->session->unset_userdata(PREFIX.'sessRole');
					$this->session->unset_userdata(PREFIX.'sessAuthId');
                	$response['msg'] = 'Sorry! Your profile is inactive, Please Contact to admin';
                }
            }else
                $response['msg'] = 'Soory! Invalid credentials, Try again.';
	    }


        return $response;
    }

    public function logout(){
    	$this->session->unset_userdata(PREFIX.'userEmail');
		$this->session->unset_userdata(PREFIX.'userRoleId');
		$this->session->unset_userdata(PREFIX.'userRole');
		$this->session->unset_userdata(PREFIX.'userAuthId');
		$this->session->unset_userdata(PREFIX.'sessEmail');
		$this->session->unset_userdata(PREFIX.'sessRoleId');
		$this->session->unset_userdata(PREFIX.'sessRole');
		$this->session->unset_userdata(PREFIX.'sessAuthId');
		$this->session->unset_userdata(PREFIX.'userImg');
		$this->session->unset_userdata(PREFIX.'userName');
		$this->session->unset_userdata(PREFIX.'userMobile');

		return array('valid' => true);
	}
	public function registration(){
        $response = array('valid' => false, 'msg'=>'Invalid Request');
        /********** recaptcha ****/
    	$secretKey = "6LdRna8UAAAAAAMoWF90cHCgCyLINXije3JQhOdS";
		
		$responseKey = $_POST['g-recaptcha-response'];
		$UserIP = $_SERVER['REMOTE_ADDR'];
		$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$UserIP";
		// $secretKey = "6LfY3LcUAAAAABuRBY7gbFlRtkNeXG-UBExSU4BT";	
		// $responseKey = $_POST['g-recaptcha-response'];
		// $UserIP = $_SERVER['REMOTE_ADDR'];
		// $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$UserIP";
		$gResponse = file_get_contents($url);
		$gResponse = json_decode($gResponse);
		if($gResponse->success){
		}
		else
			return $response = array("valid" => false, 'msg'=> 'Invalid captcha, Try again.');
				/******** end recaptcha ********/
	    
        if (isset($_POST['password']) && !empty($_POST['password'])) {
        	if ($_POST['password'] == $_POST['confirmPassword']) {
		        $isExist = $this->Common_model->exequery("SELECT * FROM ch_auths WHERE status != 2 and (email = '".$_POST['email']."' || phoneNumber = '".$_POST['mobile']."')",1);
	            if(empty($isExist)){
	                $insertData = array();
	                $insertData['firstName'] = $_POST['firstName'];
	                $insertData['lastName'] = $_POST['lastName'];
	                $insertData['email'] 	= @$_POST['email'];
	                $insertData['mobile'] 	= $_POST['mobile'];
	                // $insertData['gender'] 	= $_POST['gender'];
	                $insertData['updatedOn'] = date('Y-m-d H:i:s');
	                $insertData['addedOn'] = date('Y-m-d H:i:s');

					$this->db->trans_start();
	                $userId   = $this->Common_model->insertUnique('ch_user',$insertData);
	                $authStatus ='';
	                if ($userId > 0)
	                    $authStatus = $this->createAuth($userId, 'user', $_POST['email'], $_POST['password'],0, $_POST['mobile']);		                

					if ($this->db->trans_status() === FALSE || !$authStatus || !$userId){
						$this->db->trans_rollback();
						$response['msg'] = 'Something is wrong.';
					}else{

						$this->db->trans_commit();


						$this->session->set_userdata(PREFIX.'userEmail', @$_POST['email']);
						$this->session->set_userdata(PREFIX.'userRoleId', $userId);
						$this->session->set_userdata(PREFIX.'userRole', 'user');
						$this->session->set_userdata(PREFIX.'userAuthId', $authStatus);
						$this->session->set_userdata(PREFIX.'userImg', NOIMAGE);
						$this->session->set_userdata(PREFIX.'userFirstName', $_POST['firstName']);
						$this->session->set_userdata(PREFIX.'userMobile', $_POST['mobile']);
						$this->common_lib->setUserSessionVariables();
					
						$response = array('valid' => true, 'msg'=>'Thank you for your registration, Your account is all set.', 'name'=>$_POST['firstName'], 'mobile'=>$_POST['mobile']);
					}
	               
	            }else{

					if (isset($isExist->email) && $isExist->email == $_POST['email'])
	                	$response['msg'] = 'This email is already in use, Please try with another email Id.';
					else
						$response['msg'] = 'Mobile Number is already in use, Please try with another.';
	            }
		    }else
		    	$response['msg'] = 'Password and confirm password dose not match.';            
		}
		return $response;
    }

    private function forgotpassword(){

        $response = array('valid' => false, 'msg'=>'Invalid Request');
        if (isset($_POST['forgotemail']) && !empty($_POST['forgotemail'])) {           
            $data = $this->Common_model->exequery("SELECT * FROM ch_auths WHERE status = 0 AND email = '".$_POST['forgotemail']."'",1);
            if (!empty($data)) {
            	if ($data->status == 0) {
            		$code = date('Ymdhis').generateStrongPassword(20,false,'lud');
            		$isUpdated = $this->Common_model->update("ch_auths",array('verificationCode'=>$code),"status = 0 and email = '".$_POST['forgotemail']."'");
            		if ($isUpdated) {
                       	if(!empty($data->email)){
							$settings = array();
							$settings["template"] 				= 	"password_forgot_tpl.html";
							$settings["email"] 					= 	trim($data->email);
							$settings["subject"] 				=	"Chashma4u | Password reset";
							$contentarr['[[[URL]]]']			=	BASEURL.'/setnewpassword/'.$code;
							$settings["contentarr"] 			= 	$contentarr;
							try{
								$isMailed = $this->common_lib->sendMail($settings);
							}catch(Exception $e){}
						}

            			$response = array('valid' => true, 'msg'=>'A password reset link has been sent to your email.');
            		}
            		else
            			$response['msg'] = 'Something went wrong.';
            	}else
            		$response['msg'] = 'Your account is not yet activated.';
            } else 
                $response['msg'] = 'That email address was not found in our database.';
            
		}
		return $response; 
    } 

    	// create auth 
	public function createAuth($roleId, $role ='user', $email ='', $pass = '123456', $isUpdate=0, $mobile=''){
		$status = '';
		if(!empty($role) && !empty($email) && !empty($mobile) && !empty($pass) && !empty($roleId)) {
			if ($isUpdate) {
				$updateData = array();
				if ($email)
					$updateData['email'] = $email;
				if ($mobile)
					$updateData['phoneNumber'] = $mobile;
				$status = $this->Common_model->update("ch_auths",$updateData,"role = '".$role."' and roleId = '".$roleId."'");
			}else{
				$cond = '';
				if (!empty($email) && !empty($mobile)) 
					$cond = " AND (email = '".$email."' OR phoneNumber = '".$mobile."')";
				else if (!empty($email) && empty($mobile)) 
					$cond = " AND email = '".$email."'";
				else if (empty($email) && !empty($mobile)) 
					$cond = " AND phoneNumber = '".$mobile."'";

				$queryData   =  array();
				$queryData['role']	 		=   $role;
				$queryData['roleId']	 	=   $roleId;
				$queryData['email']	 		=   $email;
				$queryData['phoneNumber']	=   $mobile;
				$isExist = $this->Common_model->selRowData("ch_auths","","status != 2 ".$cond);		

				if (empty($isExist)) {
					$queryData['password']		=   md5($pass);
					$queryData['addedOn']		=   date('y-m-d H:i:s');
					$status 		= 	$this->Common_model->insertUnique("ch_auths", $queryData);
					if($status && !empty($email)){
						$settings = array();
						$settings["template"] 				= 	"welcome_email_tpl.html";
						$settings["email"] 					= 	trim($email);
						$settings["subject"] 				=	"Welcome To Chashma4u";
						$contentarr['[[[LOGINURL]]]']		=	BASEURL;
						$contentarr['[[[USERNAME]]]']		=	trim($email);
						$contentarr['[[[PASSWORD]]]']		=	trim($pass);
						$settings["contentarr"] 			= 	$contentarr;
						try{
							$this->common_lib->sendMail($settings);
						}catch(Exception $e){}
					}
					
				}
			}

		}
		return $status;
	}
	function sarchZones() {
		$cond ="";
        if (!empty($_POST['search'])) {
        	$_POST['search'] = str_replace("'", '', $_POST['search']); 
        	$_POST['search'] = str_replace('"', '', $_POST['search']);
        	$cond = " and zn.zoneName like '%".trim($_POST['search'])."%'";
			$zoneData= $this->Common_model->exequery("SELECT zn.* FROM ".tablePrefix."zone as zn WHERE zn.status = 0 $cond");
			if( $zoneData ) 
				return array("valid" => true, "zones" => $zoneData, "msg" => "Records Info");

        }
		return array("valid" => false, "zones" => array(), "msg" => "No Records Founds");
	}
	function setZone() {
        if (!empty($_POST['zone']) && !empty($_POST['zoneId'])) {
			$this->session->set_userdata(PREFIX.'userZone', $_POST['zone']);
			$this->session->set_userdata(PREFIX.'userZoneId', $_POST['zoneId']);
        }
	}


		// add or update user
	public function updateUserDetails(){
		$status = $authStatus = '';
		$response =	 array('valid'=>false, 'msg'=>'Invalid request.');

		if(isset($_POST['firstName']) && !empty($_POST['firstName'])) {
			// v3print($_POST);v3print($_FILES);
			$userId =$this->session->userdata(PREFIX.'userRoleId');

			if($userId > 0){
				$isExist = $this->Common_model->selRowData("ch_user","email, mobile","status != 2 and (email = '".$_POST['email']."' OR mobile = '".$_POST['mobile']."') and userId != '".$userId."'");

				if (isset($isExist->email) && $isExist->email == $_POST['email'])
					$status = 'Email Already Exist!';
				else if (isset($_POST['mobile']) && isset($isExist->mobile) && $isExist->mobile == $_POST['mobile'])
					$status = 'Mobile Number Already Exist!';
				

				if (!valResultSet($isExist)) {
				
					$queryData   =  array();
					$queryData['firstName']	 	=   trim($_POST['firstName']);
					$queryData['lastName']	 	=   trim($_POST['lastName']);
					$queryData['gender']	 	=   trim($_POST['gender']);
					$queryData['mobile']		=   trim($_POST['mobile']);
					$queryData['email']	 		=   trim($_POST['email']);
					$queryData['updatedOn']	 	=   date('Y-m-d H:i:s');

					$imageName = $this->uploadImage('user_images');
					if ($imageName)
						$queryData['img']	 	=   $imageName;

					$cond 	=	"userId = ".$userId;
					$updatetStatus 		= 	$this->Common_model->update("ch_user", $queryData,$cond);
					if($updatetStatus){
						$status = 'updated';
						$authStatus = $this->createAuth($userId, 'user', trim($_POST['email']), 'dd',1,trim($_POST['mobile']));
						$userdata =	$this->Common_model->exequery("SELECT *, (CASE WHEN img='' THEN '".NOIMAGE."' else concat('".UPLOADPATH."/user_images/',img) END) as img from ch_user where status != 2 and  userId = ".$userId,1);
						if ($userdata) {
							$this->session->set_userdata(PREFIX.'userFirstName', $userdata->firstName);
							$this->session->set_userdata(PREFIX.'userEmail', $userdata->email);
							$this->session->set_userdata(PREFIX.'userImg', $userdata->img);
						}
						
					}
				}
			}

			if($status == 'updated'){
				$response['valid']=true;
				$response['msg']="Your profile updated successfully.";
			}
			else
				$response['msg']=$status;
		}
		return $response;
	}

	// Upload icon image
	public function uploadImage($dirname = '', $fileName = 'uploadImg'){
		$imageName = '';
		if(isset($_FILES[$fileName]['tmp_name']) && is_uploaded_file($_FILES[$fileName]['tmp_name']) != "") {

			$array 			= 	explode(' ', $_FILES[$fileName]['name']);
			$filePhotoName 	= 	end($array);
			$photoToUpload  = 	rand(1000,100000).time().'-'.$filePhotoName;
			
			$uploadSettings['upload_path']   	=	UPLOADDIR."/".$dirname."/";
			$uploadSettings['allowed_types'] 	=	'gif|jpg|png|svg|jpeg';
			$uploadSettings['file_name']	  	= 	$photoToUpload;
			$uploadSettings['inputFieldName']  	=  	$fileName;

		   	if(!is_dir($uploadSettings['upload_path']))
		   		mkdir($uploadSettings['upload_path'], 0777, TRUE);
			$fileUpload = $this->common_lib->_doUpload($uploadSettings);
			if ($fileUpload) {
			    $imgData = $this->upload->data();
				$imageName		=   $imgData['file_name'];
			}else{
				// echo $this->upload->display_errors(); exit;
			}
		}
		return $imageName;
	}

	public function addUpdateAddress(){
		$response =	 array('valid'=>false, 'msg'=>'Invalid request.');
		$userId =$this->session->userdata(PREFIX.'userRoleId');

		if(empty($userId))
			return array('valid'=>false, 'msg'=>'login required.');

		if(isset($_POST['address']) && !empty($_POST['address'])) {
			$addressId = (isset($_POST['addressId']) && $_POST['addressId'] > 0)?$_POST['addressId']:0;
			$queryData   =  array();
			$queryData['userId']		=   $userId;
			$queryData['address']	 	=   trim($_POST['address']);
			$queryData['address2']	 	=   trim($_POST['address2']);
			$queryData['city']	 		=   trim($_POST['city']);
			$queryData['state']			=   trim($_POST['state']);
			$queryData['country']	 	=   trim($_POST['country']);
			$queryData['pincode']	 	=   trim($_POST['pincode']);
			$queryData['name']	 		=   trim($_POST['name']);
			$queryData['mobile']	 	=   trim($_POST['mobile']);

			$queryData['isDefault']		=   (isset($_POST['isDefault']))?1:0;
			$queryData['updatedOn']	 	=   date('Y-m-d H:i:s');
			if($queryData['isDefault'])
				$this->Common_model->update("ch_user_address", array('isDefault'=>0), array('userId'=>$userId));
			if ($addressId > 0) {
				$cond 	=	"addressId = ".$addressId;
				$updatetStatus 		= 	$this->Common_model->update("ch_user_address", $queryData,$cond);
			}else{
				if(empty($queryData['isDefault'])){
					$addressData =  $this->Common_model->exequery("SELECT count(*) as num FROM ch_user_address WHERE status = 0 and userId = '".$userId."'",1);
					if(!empty($addressData) && $addressData->num == 0)
						$queryData['isDefault'] = 1;
				}
				$queryData['addedOn']	 	=   date('Y-m-d H:i:s');
				$updatetStatus 		= 	$this->Common_model->insertUnique("ch_user_address", $queryData);
			}

			if($updatetStatus){
					$response['valid']=true;
					$response['addressId']=($addressId > 0)?$addressId:$updatetStatus;
					$response['isNew']=($addressId > 0)?0:1;
					$response['msg']=($addressId > 0)?"Your address updated successfully.":"New address added successfully.";
			}else
				$response['msg']= "Something is wrong.";
		}
		return $response;
	}


    public function changeUserPassword(){ 

        $response = array('valid' => false, 'msg'=>'Invalid Request');
		$userId =$this->session->userdata(PREFIX.'userRoleId');
        if (isset($_POST['password']) && !empty($_POST['password']) && $userId > 0) { 

            if ($_POST['password'] == $_POST['confirmPassword']) {
                $authData =  $this->Common_model->exequery("SELECT * FROM ch_auths WHERE status != 2 and role = 'user' and roleId = '".$userId."' and password = '".md5($_POST['currentPassword'])."'",1);
                if (!empty($authData)) {
                	$isUpdated = $this->Common_model->update("ch_auths",array( 'password'=>md5($_POST['password'])),"role = 'user' and roleId = '".$userId."'");

                    if ($isUpdated)
                        $response = array('valid' => true, 'msg'=>'Your password updated successfully.');
                    else
                        $response['msg'] = 'Something is wrong';
                }else
                	$response['msg'] = "Failed! Current password is incorrect.";
            }else
                $response['msg'] = 'Password and confirm password dose not match.';  
        }

        return $response;
        

    }



	public function addProductToCart(){
        $response = array('valid' => false, 'msg'=>'Invalid Request');
	    $userIP = $this->common_lib->getUserIpAddr();
		$userId = ($this->session->userdata(PREFIX.'userRoleId'))?$this->session->userdata(PREFIX.'userRoleId'):0;
        if (isset($_POST['productId']) && !empty($_POST['productId'])) {

        	$price =  0;
        	$qty =  (isset($_POST['qty']) && $_POST['qty'] > 0)?$_POST['qty']:1;

 			$productData =  $this->Common_model->exequery("SELECT pd.*, (SELECT GROUP_CONCAT(categoryId) FROM `ch_product_category` WHERE categoryType = 'category' AND productId = pd.productId limit 0,1) as categoryIds FROM ch_product pd WHERE pd.status = 0 AND pd.productId ='".$_POST['productId']."'",1);
        	if (empty($productData))
        		return array('valid' => false, 'msg'=>'Something is wrong with this item.');
	        $categoryIds = array();
    		if(isset($productData->categoryIds) && !empty($productData->categoryIds))
    			$categoryIds = explode(',', $productData->categoryIds);
    		if((in_array(1, $categoryIds) || in_array(4, $categoryIds)))
    			$taxPer = 12;
    		else
    			$taxPer = 18;
            $price = ($productData->salePrice > 0 && $productData->salePrice < $productData->actualPrice)?$productData->salePrice:$productData->actualPrice;

        	$variableId = isset($_POST['variableId'])?$_POST['variableId']:0;
 			$variableData =  $this->Common_model->exequery("SELECT * FROM ch_product_variable WHERE status = 0 AND variableId ='".$variableId."'",1);
 			if($productData->productType && empty($variableData))
 				$variableData =  $this->Common_model->exequery("SELECT *, (CASE WHEN salePrice > 0 then salePrice else actualPrice end) as price FROM ch_product_variable WHERE status = 0 AND productId ='".$_POST['productId']."' order by price",1);

 			if (!empty($variableData)){
 				$price = ($variableData->salePrice > 0 && $variableData->salePrice < $variableData->actualPrice)?$variableData->salePrice:$variableData->actualPrice;
 				$variableId = $variableData->variableId;
 			}
        	if($productData->productType && empty($variableData))
        		return array('valid' => false, 'msg'=>'Something is wrong with this item.');
        	if (empty($userIP) && empty($userId))
        		return array('valid' => false, 'msg'=>'Please login.');
        	if($variableData->qty < 1)
        		return array('valid' => false, 'msg'=>'Sorry! This item is out of stock.');

     		$cond = ($userId>0)? " AND userId = '".$userId."' or (userId = 0 AND ip = '".$userIP."')":((!empty($userIP))? " AND ip = '".$userIP."'":'');
     		if ($cond)
     			$cartData =  $this->Common_model->exequery("SELECT * FROM ch_cart WHERE status = 0 $cond",1);

			$this->db->trans_start();
			if (isset($cartData->cartId) && !empty($cartData->cartId)) {
				$cartId = $cartData->cartId;
			}else{
	            $insertData = array();
	            $insertData['userId'] = $userId ;
	            $insertData['ip'] 	= $userIP;
	            $insertData['updatedOn'] = date('Y-m-d H:i:s');
	            $insertData['addedOn'] = date('Y-m-d H:i:s');

	            $cartId   = $this->Common_model->insertUnique('ch_cart',$insertData);
	        }
            
            if ($cartId > 0) {
            	$cartItemData =  $this->Common_model->exequery("SELECT sum(qty) as qty FROM ch_cart_detail WHERE cartId = '".$cartId."' and productId = '".$_POST['productId']."' and variableId = '".$variableId."' ",1);
            	if(isset($cartItemData->qty) && $cartItemData->qty > 0 && ($cartItemData->qty+1) > $variableData->qty)
        			return array('valid' => false, 'msg'=>'Sorry! This item is no more in stock.');

            	$subtotal = $price;
            	$image = $this->uploadImage('prescription_images', 'prescriptionImg');
            	if(isset($_FILES['prescriptionImg']['tmp_name']) && !empty($_FILES['prescriptionImg']['tmp_name']) && $image == '')
            		return array('valid' => false, 'msg'=>'Error while uploading prescriptions.');

                $insertDetailData = array();
                $insertDetailData['cartId'] = $cartId;
                $insertDetailData['productId'] 	= $_POST['productId'];
                $insertDetailData['variableId'] 	= $variableId;
                $insertDetailData['message'] 	= isset($_POST['additionalInfo'])?$_POST['additionalInfo']:'';
                $insertDetailData['img'] 	= $image;
                $insertDetailData['price'] 	= $price;
                $insertDetailData['prescription_type'] 	= $_POST['prescription_type'];
                $insertDetailData['rsph'] 	= $_POST['rsph'];
                $insertDetailData['rcyl'] 	= $_POST['rcyl'];
                $insertDetailData['raxis'] 	= $_POST['raxis'];
                $insertDetailData['radd'] 	= $_POST['radd'];
                $insertDetailData['lsph'] 	= $_POST['lsph'];
                $insertDetailData['lcyl'] 	= $_POST['lcyl'];
                $insertDetailData['laxis'] 	= $_POST['laxis'];
                $insertDetailData['ladd'] 	= $_POST['ladd'];
                $insertDetailData['pd'] 	= $_POST['pd'];
                $insertDetailData['rgn'] 	= (in_array(4, $categoryIds))?$variableData->rgn:0;
				
				if (isset($_POST['lens-option']) && !empty($_POST['lens-option'])) {
					$lensData =  $this->Common_model->exequery("SELECT * FROM ch_lens WHERE status = 0 AND  lensId = '".$_POST['lens-option']."'",1);

		 			if (isset($lensData->actualPrice)){
		 				$lensData->actualPrice = ($lensData->salePrice > 0)?$lensData->salePrice:$lensData->actualPrice;

		                $insertDetailData['lensId'] 	= $_POST['lens-option'];
		                $insertDetailData['lensPrice'] 	= $lensData->actualPrice;
						$subtotal += $lensData->actualPrice;
			 		}
				}
				if($taxPer){
					$tax = round($qty*(($subtotal*$taxPer)/100), 2);
					$subtotal = $tax+$subtotal;
				}else
					$tax = 0;

				$isExist = $this->Common_model->selRowData("ch_cart_detail","detailId,qty",$insertDetailData);
				
                $insertDetailData['qty'] 	= $qty;
                $insertDetailData['tax'] 	= $tax;
				$insertDetailData['subtotal'] 	= $qty*$subtotal;
                $insertDetailData['updatedOn'] = date('Y-m-d H:i:s');
				if($isExist){
					$this->Common_model->update('ch_cart_detail',array('qty'=>$insertDetailData['qty']+$isExist->qty),array('detailId'=>$isExist->detailId));
					$detailId   = $isExist->detailId;
				}
				else{

            		$insertDetailData['addedOn'] = date('Y-m-d H:i:s');
 					$detailId   = $this->Common_model->insertUnique('ch_cart_detail',$insertDetailData);
				}

            }		                

			if ($this->db->trans_status() === FALSE || !isset($detailId) || empty($detailId)){
				$this->db->trans_rollback();
				$response['msg'] = 'Something is wrong.';
			}else{

				$this->db->trans_commit();
				$this->updateCartdetails($cartId);
				
				$response = array('valid' => true, 'msg'=>'Added to cart.', 'cartItemsCount'=>$this->session->userdata(PREFIX.'cartItemsCount'), 'cartGrandtotal'=>$this->session->userdata(PREFIX.'cartGrandtotal'));
			}            
		}
		return $response;
    }

	private function updateCartdetails($cartId){
		$userId = ($this->session->userdata(PREFIX.'userRoleId'))?$this->session->userdata(PREFIX.'userRoleId'):0;
		$cartDetailData = $this->Common_model->exequery("SELECT * FROM ch_cart_detail WHERE cartId = '".$cartId."'");
		$cartTotal = $cartTaxTotal = $cartDeliveryChargeTotal = $cartGrandTotal = 0;
	    
		if (!empty($cartDetailData)) {
			foreach ($cartDetailData as $detail) {				
				$productSubtotal = ($detail->qty*($detail->price+$detail->lensPrice+$detail->tax))+$detail->deliveryCharge;
				$cartTotal += round(($detail->qty*($detail->price+$detail->lensPrice)), 2);
				$cartTaxTotal += round(($detail->qty*($detail->tax)), 2);
				$cartDeliveryChargeTotal += round($detail->deliveryCharge, 2);
				$cartGrandTotal += round($productSubtotal, 2);

				$this->Common_model->update('ch_cart_detail',['subtotal'=>$productSubtotal], "detailId = '".$detail->detailId."'");
			}
		}

		$cartData = $this->Common_model->exequery("SELECT *, (SELECT sum(qty) FROM ch_cart_detail where cartId = ch_cart.cartId) as cartItemsCount, (SELECT SUM(subtotal) FROM ch_cart_detail where cartId = ch_cart.cartId) as cartGrandtotal, (SELECT SUM(deliveryCharge) FROM ch_cart_detail where cartId = ch_cart.cartId) as deliveryChargeTotal, (SELECT SUM(tax) FROM ch_cart_detail where cartId = ch_cart.cartId) as taxTotal FROM ".tablePrefix."cart WHERE status ='0' AND cartId = '".$cartId."'", 1);
	    
		if (!empty($cartData)) {
			$updateData = ['cartTotal'=>round($cartTotal, 0), 'deliveryCharge'=>round($cartDeliveryChargeTotal,0), 'tax'=>round($cartTaxTotal, 0), 'couponId'=>0, 'couponDiscount'=>0, 'userId'=>$userId];

			if($cartData->couponId >  0){
				$couponData = $this->Common_model->exequery("SELECT *, (SELECT count(*) FROM ch_order WHERE status < 6 AND couponId = ch_coupon.couponId AND userId = '".$userId."' ) as totalAppliedCount FROM ch_coupon where status = 0 and endDate > now() AND couponId =".$cartData->couponId,1);

	         	if(!empty($couponData)){
	         		$cartData->grandTotal = $cartGrandTotal;
	         		$isDiscountApplicable = 1;
	         		if($couponData->minOrderAmt > 0 && $couponData->minOrderAmt > $cartData->grandTotal)
	         			$isDiscountApplicable = 0;
	         		if($couponData->maxUsagePerUser > 0 && $couponData->maxUsagePerUser <= $couponData->totalAppliedCount)
	         			$isDiscountApplicable = 0;
	         		if($isDiscountApplicable){
		         		if ($couponData->discountType == 'flat') {
		         			$discount  =  number_format((float)($couponData->discount), 2, '.', '');
		         		}else{
		         			$discount  = number_format((float)((($couponData->discount*$cartData->grandTotal)/100)), 2, '.', '');
		         			if($couponData->maxDiscountAmt > 0 && $couponData->maxDiscountAmt < $discount)
         						$discount = $couponData->maxDiscountAmt;
		         		}

		         		if ($cartData->grandTotal >= $discount) {
							$cartGrandTotal = number_format((float)($cartData->grandTotal - $discount), 2, '.', '');
							$updateData['couponId'] = $cartData->couponId;
							$updateData['couponDiscount'] = $discount;
							
		         		}
					}
	         	}
			}

			$updateData['grandTotal'] = round($cartGrandTotal, 0);

			$this->Common_model->update('ch_cart',$updateData, "cartId = '".$cartData->cartId."'");
			$this->session->set_userdata(PREFIX.'cartItemsCount',($cartData->cartItemsCount));
			$this->session->set_userdata(PREFIX.'cartTotal',$cartTotal);
			$this->session->set_userdata(PREFIX.'deliveryChargeTotal',$cartDeliveryChargeTotal);
			$this->session->set_userdata(PREFIX.'cartGrandtotal',$updateData['grandTotal']);
			$this->session->set_userdata(PREFIX.'cartId',(($cartData->cartId)?$cartData->cartId:0));
		}
	}

	public function updateCart(){
		$qty= 1;
		$subtotal = 0;
        $response = array('valid' => false, 'msg'=>'Invalid Request');
	    $userIP = $this->common_lib->getUserIpAddr();
		$userId = ($this->session->userdata(PREFIX.'userRoleId'))?$this->session->userdata(PREFIX.'userRoleId'):0;
        if (isset($_POST['detailId']) && !empty($_POST['detailId'])) {

     		$cond = ($userId>0)? " AND userId = '".$userId."' or (userId = 0 AND ip = '".$userIP."')":((!empty($userIP))? " AND ip = '".$userIP."'":'');
     		if ($cond)
     			$cartData =  $this->Common_model->exequery("SELECT * FROM ch_cart WHERE status = 0 $cond",1);

			$this->db->trans_start();
            if (isset($cartData->cartId) && !empty($cartData->cartId)) {

            	$cartDetailData =  $this->Common_model->exequery("SELECT * FROM ch_cart_detail WHERE cartId = '".$cartData->cartId."' AND detailId = '".$_POST['detailId']."'",1);
                if (!empty($cartDetailData)) {
                	$qty = isset($_POST['qty'])?$_POST['qty']:$cartDetailData->qty;
                	$productSubtotal = ($qty*($cartDetailData->price+$cartDetailData->lensPrice))+$cartDetailData->deliveryCharge;
                	$subtotal = ($qty*($cartDetailData->price+$cartDetailData->lensPrice))+$cartDetailData->deliveryCharge;

     				if(isset($_POST['removeItem']) && !empty($_POST['removeItem'])){
     					$isUpdated = $this->Common_model->del('ch_cart_detail',"detailId = '".$cartDetailData->detailId."'");
     				}else if (isset($_POST['changeQty']) && !empty($_POST['changeQty']) && isset($_POST['qty']) && !empty($_POST['qty'])) {
     					$isUpdated = $this->Common_model->update('ch_cart_detail',['qty'=>$_POST['qty'], 'subtotal'=>$productSubtotal], "detailId = '".$cartDetailData->detailId."'");
     				}else if (isset($_POST['updateCartMsg']) && !empty($_POST['updateCartMsg'])) {
     					$isUpdated = $this->Common_model->update('ch_cart_detail',['message'=>$_POST['message']], "detailId = '".$cartDetailData->detailId."'");
     				}
 				}
 			}
        }		                

		if ($this->db->trans_status() === FALSE || !isset($isUpdated) || empty($isUpdated) || $isUpdated == false){
			$this->db->trans_rollback();
			$response['msg'] = 'Something is wrong.'. $this->db->last_query();
		}else{

			$this->db->trans_commit();
			if (isset($cartData->cartId) && !empty($cartData->cartId))
				$this->updateCartdetails($cartData->cartId);

			$cartData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."cart WHERE status ='0' AND cartId = '".$cartData->cartId."'", 1);
			// if(isset($cartData->cartTotal) && isset($cartData->tax))
			// 	$cartData->cartTotal = round(($cartData->cartTotal - $cartData->tax) , 2);

			$response = array('valid' => true, 'msg'=>'Cart updated', 'qty'=>isset($_POST['qty'])?$_POST['qty']:0, 'subtotal'=>$subtotal, 'cartTotal'=>isset($cartData->cartTotal)?$cartData->cartTotal:0, 'deliveryChargeTotal'=>isset($cartData->deliveryCharge)?$cartData->deliveryCharge:0, 'cartItemsCount'=>$this->session->userdata(PREFIX.'cartItemsCount'), 'cartGrandtotal'=>isset($cartData->grandTotal)?$cartData->grandTotal:0, 'taxTotal'=>isset($cartData->tax)?$cartData->tax:0, 'discount'=>isset($cartData->couponDiscount)?$cartData->couponDiscount:0, 'couponId'=>isset($cartData->couponId)?$cartData->couponId:0);
		}  
		return $response;
    }


    public function applyCoupon(){
    	$response = array("valid" => false, 'msg'=> 'Valid promo code is required.');

		$couponId = $this->input->post('couponId');
		$coupon = $this->input->post('coupon');
		$cartId = $this->session->userdata(PREFIX.'cartId');
		$userId = ($this->session->userdata(PREFIX.'userRoleId'))?$this->session->userdata(PREFIX.'userRoleId'):0;

		if ((!empty($couponId) || !empty($coupon)) && !empty($cartId)) {
			$cond = ($couponId > 0)?" AND couponId  = '".$couponId."'":" AND couponCode  = BINARY '".trim($coupon)."'";
         	$couponData = $this->Common_model->exequery("SELECT *, (SELECT count(*) FROM ch_order WHERE status < 6 AND couponId = ch_coupon.couponId AND userId = '".$userId."' ) as totalAppliedCount FROM ch_coupon where status = 0 and endDate > now() ".$cond,1);

         	$cartData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."cart WHERE status ='0' AND cartId = '".$cartId."'", 1);

         	if(empty($couponData))
         		return array("valid" => false, 'msg'=> 'Promo code is not valid.');

         	if(!empty($couponData) && !empty($cartData)){
         		$cartData->grandTotal = $cartData->cartTotal+$cartData->tax+$cartData->deliveryCharge;


	         	if($couponData->minOrderAmt > 0 && $couponData->minOrderAmt > $cartData->grandTotal)
	         		return array("valid" => false, 'msg'=> 'Minimum order amount should be Rs'.$couponData->minOrderAmt.' for this promo code.');

	         	if($couponData->maxUsagePerUser > 0 && $couponData->maxUsagePerUser <= $couponData->totalAppliedCount)
	         		return array("valid" => false, 'msg'=> 'This coupon is applicable on maximum'.$couponData->maxUsagePerUser.' times per user.');

         		if ($couponData->discountType == 'flat') {
         			$discount  =  number_format((float)($couponData->discount), 2, '.', '');
         		}else{
         			$discount  = number_format((float)((($couponData->discount*$cartData->grandTotal)/100)), 2, '.', '');
         			if($couponData->maxDiscountAmt > 0 && $couponData->maxDiscountAmt < $discount)
         				$discount = $couponData->maxDiscountAmt;

         		}
         		if ($cartData->grandTotal >= $discount) {
					$grandTotal = number_format((float)($cartData->grandTotal - $discount), 2, '.', '');
					$isUpdated = $this->Common_model->update('ch_cart',[ 'couponId'=>$couponData->couponId, 'couponDiscount'=>$discount, 'grandTotal'=>$grandTotal], "cartId = '".$cartData->cartId."'");
					if($isUpdated){
						$this->session->set_userdata(PREFIX.'cartGrandtotal',$grandTotal);
         				return $response = array("valid"=>true, 'appliedCouponCode' => $couponData->couponCode, 'appliedCouponMsg' => (($couponData->discountType== 'flat')?'Flat Rs.'.$couponData->discount.' Off':'Flat '.$couponData->discount.'% Off'), 'discount' => $discount, 'cartGrandtotal' => $grandTotal, 'cartItemsCount' => $this->session->userdata(PREFIX.'cartItemsCount') );
					}
         			else
         				$response['msg'] = 'Something went wrong';
         		}else
         			$response['msg'] = 'Something went wrong';
         	}else
         		$response['msg'] = 'Something went wrong'; 
		}
		return $response;
    }

    public function removeAppliedCoupon(){
    	$response = array("valid" => false, 'msg'=> 'Something is wrong.');
		$cartId = $this->session->userdata(PREFIX.'cartId');

		if (!empty($cartId)) {
         	$cartData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."cart WHERE status ='0' AND cartId = '".$cartId."'", 1);

         	if(!empty($cartData)){
         		$cartData->grandTotal = $cartData->cartTotal+$cartData->tax+$cartData->deliveryCharge;
				$grandTotal = number_format((float)$cartData->grandTotal, 2, '.', '');
				$isUpdated = $this->Common_model->update('ch_cart',[ 'couponId'=>0, 'couponDiscount'=>0, 'grandTotal'=>$grandTotal], "cartId = '".$cartData->cartId."'");
				if($isUpdated){
					$this->session->set_userdata(PREFIX.'cartGrandtotal',$grandTotal);
     				return $response = array("valid"=>true, 'cartGrandtotal' => $grandTotal, 'cartItemsCount' => $this->session->userdata(PREFIX.'cartItemsCount') );
				}
     			else
     				$response['msg'] = 'Something went wrong';
         		
         	}else
         		$response['msg'] = 'Something went wrong'; 
		}
		return $response;
    }

	public function createOrder(){
        $response = array('valid' => false, 'msg'=>'Invalid Request');
        $qryStatus = 0;

		$userId = ($this->session->userdata(PREFIX.'userRoleId'))?$this->session->userdata(PREFIX.'userRoleId'):0;

		if (!$userId)
			return $response;

        if (isset($_POST['action']) && !empty($_POST['action'])) {
        	$userIP = $this->common_lib->getUserIpAddr();
			$cartId = ($this->session->userdata(PREFIX.'cartId'))?$this->session->userdata(PREFIX.'cartId'):0;

			$cartData = array();
			$cond = ($cartId>0)? " AND cartId = '".$cartId."'":(($userId>0)? " AND userId = '".$userId."'":((!empty($userIP))? " AND ip = '".$userIP."'":''));
			if ($cond)		
				$cartData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."cart WHERE status ='0' ".$cond, 1);

			if (!isset($cartData->cartId) || empty($cartData->cartId))
				return $response;
			$outOfStockItem = $this->Common_model->exequery("SELECT DISTINCT det.variableId, concat(pd.productName,' - ', pv.variableTitle) as product, pv.qty, (SELECT SUM(de.qty) FROM `ch_cart_detail` as de WHERE de.detailId = det.detailId) as vv FROM `ch_cart_detail` as det  left join ch_product as pd on pd.productId = det.productId  left join ch_product_variable as pv on pv.variableId = det.variableId WHERE  cartId = $cartData->cartId  HAVING vv > pv.qty");
			if($outOfStockItem){
				$product = '';
				foreach ($outOfStockItem as $key => $item) {
					$product .= (($product)?', ':'').$item->product.':'.$item->qty;
				}

        		return array('valid' => false, 'msg'=>"Sorry! we have less quantity of product $product in stock.");

			}

			$cartData->detailData = $this->Common_model->exequery("SELECT cd.*, pd.productName, pd.actualPrice, pv.variableTitle FROM ch_cart_detail as cd left join ch_product as pd on pd.productId = cd.productId left join ch_product_variable as pv on pv.variableId = cd.variableId  WHERE cartId = $cartData->cartId ");

			if (isset($_POST['addressId']) && !empty($_POST['addressId']))
				$addressId = $_POST['addressId'];

        	if (!isset($addressId) || empty($addressId))
        		return array('valid' => false, 'msg'=>'Something is wrong with address.');
			$addressData= $this->Common_model->exequery("SELECT * FROM ".tablePrefix."user_address WHERE status ='0' AND addressId = '".$addressId."'",1);

        	if (!isset($addressData) || empty($addressData))
        		return array('valid' => false, 'msg'=>'Something is wrong with address.');
        	if (!isset($cartData->detailData) || empty($cartData->detailData))
        		return array('valid' => false, 'msg'=>'Something is wrong with product in cart.');

			$this->db->trans_start();

			$datetime = date('Y-m-d H:i:s');

            $insertData = array();
            $insertData['generatedId'] = 'OD'.generateStrongPassword(4,false,'d').time().$cartData->cartId;
            $insertData['ip'] 	= $cartData->ip;
            $insertData['userId'] = $userId;
            $insertData['addressId'] = $addressId;
            // $insertData['guestEmail'] = ($userId > 0)?'':trim($_POST['email']);
            // $insertData['senderName'] = trim($_POST['senderName']);
            // $insertData['senderNo'] = trim($_POST['senderNo']);
            $insertData['message'] = trim($_POST['message']);
            $insertData['cartTotal'] 	= $cartData->cartTotal;
            $insertData['tax'] 	= $cartData->tax;
            $insertData['couponId'] 	= $cartData->couponId;
            $insertData['couponDiscount'] 	= $cartData->couponDiscount;
            $insertData['deliveryCharge'] 	= $cartData->deliveryCharge;
            $insertData['grandTotal'] 	= $cartData->grandTotal;
            $insertData['updatedOn'] = date('Y-m-d H:i:s');
            $insertData['addedOn'] = date('Y-m-d H:i:s');
            $orderId   = $this->Common_model->insertUnique('ch_order',$insertData);
            
            if ($orderId > 0) {
		    	foreach ($cartData->detailData as $detail) {
		    		$insertDetailData = array();
		    		$insertDetailData['orderId'] = $orderId;
		            $insertDetailData['productId'] = $detail->productId;
		    		$insertDetailData['variableId'] = $detail->variableId;
		            $insertDetailData['message'] = $detail->message;
		    		$insertDetailData['img'] = $detail->img;
		    		$insertDetailData['qty'] = $detail->qty;
		            $insertDetailData['deliveryCharge'] = $detail->deliveryCharge;
		    		$insertDetailData['price'] = $detail->price;
		            $insertDetailData['subtotal'] = $detail->subtotal;
		            $insertDetailData['addedOn'] = $datetime;
		            $insertDetailData['updatedOn'] = $datetime;
	                $insertDetailData['prescription_type'] 	= $detail->prescription_type;
	                $insertDetailData['rsph'] 	= $detail->rsph;
	                $insertDetailData['rcyl'] 	= $detail->rcyl;
	                $insertDetailData['raxis'] 	= $detail->raxis;
	                $insertDetailData['radd'] 	= $detail->radd;
	                $insertDetailData['lsph'] 	= $detail->lsph;
	                $insertDetailData['lcyl'] 	= $detail->lcyl;
	                $insertDetailData['laxis'] 	= $detail->laxis;
	                $insertDetailData['ladd'] 	= $detail->ladd;
	                $insertDetailData['pd'] 	= $detail->pd;
	                $insertDetailData['rgn'] 	= $detail->rgn;
	                $insertDetailData['lensId'] 	= $detail->lensId;
	                $insertDetailData['lensPrice'] 	= $detail->lensPrice;

		            $detailId   = $this->Common_model->insertUnique('ch_order_detail',$insertDetailData);
		    	}

				$transactionId = $this->Common_model->insertUnique("ch_order_transaction", array("orderId"=>$orderId, "paymentMethod"=>$_POST['paymentMethod'], "paidAmt"=>$insertData['grandTotal'] , "addedOn"=>$datetime, "updatedOn"=>$datetime) );
				if($transactionId){
					$this->session->set_userdata(PREFIX.'order_transactionId', $transactionId);

					$outOfStockItem = $this->Common_model->exequery("SELECT DISTINCT det.variableId, pv.qty, (SELECT SUM(de.qty) FROM `ch_cart_detail` as de WHERE de.detailId = det.detailId) as orderQty FROM `ch_cart_detail` as det left join ch_product_variable as pv on pv.variableId = det.variableId WHERE cartId = $cartData->cartId");
					if($outOfStockItem){
						$updateArray = array();
						foreach ($outOfStockItem as $key => $item) {
							$updateArray[] = array(
						        'variableId'=>$item->variableId,
						        'qty' => $item->qty-$item->orderQty
						    );
						}
						if($updateArray)
							$this->db->update_batch('ch_product_variable',$updateArray, 'variableId');
					}
				}
            }

			if ($this->db->trans_status() === FALSE || !$detailId){
				$this->db->trans_rollback();
				$response['msg'] = 'Something is wrong.';
			}else{

				$this->db->trans_commit();
				if (isset($_POST['paymentMethod']) && $_POST['paymentMethod'] == 'cod') {
					$this->common_lib->sendOrderPlacedNotifications('order_success', $insertData['generatedId']);
				}
				$response = array('valid' => true, 'msg'=>($_POST['paymentMethod'] == 'cod')?'Order Placed successfully.':'redirecting to payment page ..', "generatedId"=>$insertData['generatedId']);
			}            
		}
		return $response;
    }

	public function userOrderList() {
		$columns = array( 0 => "od.generatedId", 1 => "od.addedOn", 2 => "od.status", 3 => "od.grandTotal", 4 => "od.orderId",);

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  		$userId = ($this->session->userdata(PREFIX.'userRoleId'))?$this->session->userdata(PREFIX.'userRoleId'):0;
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."order as od where od.userId = '".$userId."'",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT od.*,ot.paymentMethod, ot.paymentStatus from ".tablePrefix."order as od  left join ch_order_transaction as ot on ot.orderId = od.orderId where od.userId = '".$userId."'"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search))
            	$search = str_replace(['"',"'"], ['', ''], $search);

            $searchCond = " AND (od.generatedId LIKE  '%".$search."%' OR od.addedOn LIKE  '%".$search."%' OR od.grandTotal LIKE  '%".$search."%' OR od.status LIKE  '%".$search."%') ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."order as od where od.userId = '".$userId."' ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();
        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	

	              if ($row->paymentStatus == 0) {
	                $row->status = "Payment Pending";
	                $row->class = "badge badge-warning";
	              }elseif ($row->paymentStatus == 2) {
	                $row->status = "Payment Failed";
	                $row->class = "badge badge-danger";
	              }elseif ($row->paymentStatus == 3) {
	                $row->status = "Payment Cancelled";
	                $row->class = "badge badge-danger";
	              }elseif ($row->paymentStatus == 1 && $row->status == 0) {
	                $row->status = "Order received";
	                $row->class = "badge badge-dark";
	              }elseif ($row->status == 1) {
	                $row->status = "Vendor confirmed";
	                $row->class = "badge badge-info";
	              }elseif ($row->status == 2) {
	                $row->status = "Processing";
	                $row->class = "badge badge-primary";
	              }elseif ($row->status == 3) {
	                $row->status = "Ready to ship";
	                $row->class = "badge badge-warning";
	              }elseif ($row->status == 4) {
	                $row->status = "Shipped";
	                $row->class = "badge badge-light";
	              }elseif ($row->status == 5) {
	                $row->status = "Delivered";
	                $row->class = "badge badge-success";
	              }elseif ($row->status == 6) {
	                $row->status = "Cancelled";
	                $row->class = "badge badge-danger";
	              }else {
	                $row->status = "Unknown";
	                $row->class = "badge badge-secondary";
	              }
            	$nestedData['generatedId'] = $row->generatedId;
            	$nestedData['addedOn'] = date('Y-m-d H:i A', strtotime($row->addedOn));
            	$nestedData['grandTotal'] = '₹'.round($row->grandTotal,2);
            	$nestedData['status'] = '<span class="'.$row->class.'">'.$row->status.'</span>';
            	$nestedData['orderId'] = '<a href="order-details/'.$row->generatedId.'" class="btn">View Details</a>';
            	
                
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}


	public function ourStores() {
		$col3 = 'vd.'.strtolower(date('l'))."Open";
		$columns = array( 0 => "vd.vendorId", 1 => "vd.vendorName", 2 => "vd.address1", 3 => $col3 );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";

        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."vendor as vd where vd.status = '0' AND vd.isShownOnOurStores = 1 ",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT *, (case when vd.imageId > 0 then (SELECT imageName FROM ".tablePrefix."images  WHERE imageId = vd.imageId ) else '' end) as img  from ".tablePrefix."vendor as vd where vd.status = '0' AND vd.isShownOnOurStores = 1"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search))
            	$search = str_replace(['"',"'"], ['', ''], $search);

            $searchCond = " AND (vd.vendorName LIKE  '%".$search."%' OR vd.address1 LIKE  '%".$search."%' OR vd.address2 LIKE  '%".$search."%' OR vd.city LIKE  '%".$search."%' OR vd.state LIKE  '%".$search."%') ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."vendor as vd where vd.status = '0' AND vd.isShownOnOurStores = 1 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();
        $days = array('sunday','monday','tuesday','wednesday','thursday','friday','saturday');
        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
                $closeArry  = (!empty($row->closeDays))?explode(',',$row->closeDays):array();
                $timingData = '';             
                foreach ($days as $day) {
	                if (!in_array($day,$closeArry)){
	                  	$open = $day.'Open';
	                  	$close = $day.'Close';
	                	$timingData .= ucfirst($day).' ('.date('g:i A', strtotime($row->$open)).' - '.date('g:i A', strtotime($row->$close)).')<br/>';
	                }
	            }
	            $row->address1 .= ($row->address2)?(($row->address1)?', ':'').$row->address2:'';
	            $row->address1 .= ($row->city)?', '.$row->city:'';
	            $row->address1 .= ($row->pincode)?', '.$row->pincode:'';
	            $row->address1 .= ($row->state)?', '.$row->state:'';

            	$nestedData['icons']		= '<div class="story-logo"> <img src="'.getResizedImg($row->img,'200_200').'" alt="'.$row->vendorName.'"> </div>';
            	$nestedData['vendorName']	= $row->vendorName;
            	$nestedData['address']		= $row->address1.'<br/>Phone: '.$row->mobile.'<br/>Email: '.$row->email; 
            	$nestedData['openHour']		= ($timingData)?$timingData:'Closed';                
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}


	function sendEnquiry() {

		$response = array("valid" => false, 'msg'=> 'Something is wrong.');
		if (isset($_POST['email']) && !empty($_POST['email'])) {
			$queryData = array();
			$queryData['name'] = trim($_POST['name']);
			$queryData['email'] = trim($_POST['email']);
			// $queryData['mobile'] = trim($_POST['mobile']);
			// $queryData['type'] = trim($_POST['type']);
			$queryData['comment'] = trim($_POST['comment']);
			// $queryData['orderId'] = trim($_POST['orderId']);
			$queryData['addedOn'] = date('Y-m-d H:i:s');

			// if(isset($_FILES['uploadImg']['tmp_name']) && !empty($_FILES['uploadImg']['tmp_name'])) {
			// 	if(is_uploaded_file($_FILES['uploadImg']['tmp_name']) != "") {
			// 		$array 			= 	explode(' ', $_FILES['uploadImg']['name']);
			// 		$filePhotoName 	= 	end($array);
			// 		$photoToUpload  = 	date('YmdHis').generateStrongPassword(5,0,'l').$filePhotoName;
					
			// 		$uploadSettings['upload_path']   	=	UPLOADDIR."/contact_images/";
			// 		$uploadSettings['allowed_types'] 	=	'gif|jpg|png|doc|docx|xls|pdf';
			// 		$uploadSettings['file_name']	  	= 	$photoToUpload;
			// 		$uploadSettings['inputFieldName']  	=  	"uploadImg";
			// 		if(!is_dir($uploadSettings['upload_path']))
			// 		   	mkdir($uploadSettings['upload_path'], 0777, TRUE);
			// 		$fileUpload = $this->common_lib->_doUpload($uploadSettings);
			// 		if ($fileUpload)
			// 			$queryData['img']	 	=   $photoToUpload;
			// 		else
			// 			return array("valid" => false, 'msg'=> 'Something is wrong with your file, Only gif, jpg, png, doc, docx, xls and pdf type file allowed with max 1mb size.');
			// 	}
			// }


			if($this->Common_model->insert("ch_contact",$queryData)){
				//Send welcome email
				$settings = array();
				$settings["template"] 				= 	"query_tpl.html";
				$settings["email"] 					= 	ADMINEMAIL;
				$settings["subject"] 				=	"New Query From CHASHMA4U";
				$settings["attachementFlag"] 		=	(isset($queryData['img']) && !empty($queryData['img']))?UPLOADPATH.'/contact_images/'.$queryData['img']:'';
				$contentarr['[[[NAME]]]']			=	$_POST['name'];
				$contentarr['[[[EMAIL]]]']			=	$_POST['email'];
				$contentarr['[[[COMMENT]]]']		=	$_POST['comment'];
				$settings["contentarr"] 			= 	$contentarr;
				$this->common_lib->sendMail($settings);

				$this->common_lib->sendMessage(ADMINMOBILE, "You have recieved new CHASHMA4U enquiry from ".$_POST['name'].".");
				$response = array("valid" => true, 'msg'=> 'Thank you for contacting us, Our team will responce you soon!');
			}
			else
				$response = array("valid" => false, 'msg'=> 'Something went wrong.');
		}
		return $response;

	}
	function sendFanchiseEnquiry() {

		$response = array("valid" => false, 'msg'=> 'Something is wrong.');
		if (isset($_POST['email']) && !empty($_POST['email'])) {
			$secretKey = "6LdRna8UAAAAAAMoWF90cHCgCyLINXije3JQhOdS";
			
			$responseKey = $_POST['g-recaptcha-response'];
			$UserIP = $_SERVER['REMOTE_ADDR'];
			$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$UserIP";

			$gResponse = file_get_contents($url);
			$gResponse = json_decode($gResponse);
			if($gResponse->success){

				$queryData = array();
				$queryData['name'] = trim($_POST['name']);
				$queryData['email'] = trim($_POST['email']);
				$queryData['mobile'] = trim($_POST['mobile']);
				$queryData['address'] = trim($_POST['address']);
				$queryData['city'] = trim($_POST['city']);
				$queryData['remark'] = trim($_POST['remark']);
				$queryData['addedOn'] = date('Y-m-d H:i:s');

				if($this->Common_model->insert("ch_fanchise_enquiry",$queryData)){
					//Send welcome email
					$settings = array();
					$settings["template"] 				= 	"fanchise_enquiry_tpl.html";
					$settings["email"] 					= 	ADMINEMAIL;
					$settings["subject"] 				=	"New Fanchise Enquiry From CHASHMA4U";
					$contentarr['[[[NAME]]]']			=	$_POST['name'];
					$contentarr['[[[EMAIL]]]']			=	$_POST['email'];
					$contentarr['[[[MOBILE]]]']			=	$_POST['mobile'];
					$contentarr['[[[ADDRESS]]]']		=	$_POST['address'];
					$contentarr['[[[CITY]]]']			=	$_POST['city'];
					$contentarr['[[[REMARK]]]']			=	$_POST['remark'];
					$settings["contentarr"] 			= 	$contentarr;
					$this->common_lib->sendMail($settings);
					$this->common_lib->sendMessage(ADMINMOBILE, "You have recieved new CHASHMA4U fanchise enquiry from ".$_POST['name'].".");
					$response = array("valid" => true, 'msg'=> 'Thank you for contacting us, We will responce you soon!');
				}
				else
					$response = array("valid" => false, 'msg'=> 'Something went wrong.');
			}else
				$response = array("valid" => false, 'msg'=> 'Invalid captcha, Try again.');
		}
		return $response;

	}

    
    function sendCorporateEnquiry() {

		$response = array("valid" => false, 'msg'=> 'Something is wrong.');
		if (isset($_POST['email']) && !empty($_POST['email'])) {
			$queryData = array();
			$queryData['name'] = trim($_POST['name']);
			$queryData['email'] = trim($_POST['email']);
			$queryData['mobile'] = trim($_POST['phone']);
			$queryData['message'] = trim($_POST['message']);
			$queryData['addedOn'] = date('Y-m-d H:i:s');

			if($this->Common_model->insert("ch_corporate_enquiry",$queryData)){
				//Send welcome email
				$settings = array();
				$settings["template"] 				= 	"fanchise_enquiry_tpl.html";
				$settings["email"] 					= 	ADMINEMAIL;
				$settings["subject"] 				=	"New Fanchise Enquiry From CHASHMA4U";
				$contentarr['[[[NAME]]]']			=	$_POST['name'];
				$contentarr['[[[EMAIL]]]']			=	$_POST['email'];
				$contentarr['[[[MOBILE]]]']			=	$_POST['phone'];
				$contentarr['[[[Message]]]']		=	$_POST['message'];
				$settings["contentarr"] 			= 	$contentarr;
				$this->common_lib->sendMail($settings);
				$this->common_lib->sendMessage(ADMINMOBILE, "You have recieved new CHASHMA4U corporate enquiry from ".$_POST['name'].".");
				$response = array("valid" => true, 'msg'=> 'Thank you for contacting us, We will responce you soon!');
			}
			else
				$response = array("valid" => false, 'msg'=> 'Something went wrong.');
		}
		return $response;

	}


	function ajaxScrollProduct() {

		$response = array("valid" => false, 'filterData'=> '<span class="alert alert-danger mt-3" style="width: 100%;">Sorry! No product available now.</span>', 'filterCount'=>0);
		if (isset($_POST['filterSearchCond']) && !empty($_POST['filterSearchCond'])) {

			$userId = ($this->session->userdata(PREFIX.'userRoleId'))?$this->session->userdata(PREFIX.'userRoleId'):0;
			$limitStart = (isset($_POST['productCount']) && !empty($_POST['productCount']))?trim($_POST['productCount']):0;

			$cond = trim($_POST['filterSearchCond']);
			$orderBy = " ORDER BY pd.productId desc";

			// if(!empty($_POST['filterSubcategoryItem']))
			// 	$cond = " AND pc.categoryType = 'subcategoryItem' AND pc.categoryId = '".trim($_POST['filterSubcategoryItem'])."'";

			if(isset($_POST['filtercolor']) && !empty($_POST['filtercolor'])){
				$cond .= " AND (";
				foreach ($_POST['filtercolor'] as $k=>$color) {
					$cond .= (($k)?' OR ':'')."pv.color = '".trim($color)."'";
				}
				$cond .= " ) ";
			}

			if(isset($_POST['filtersize']) && !empty($_POST['filtersize'])){
				$cond .= " AND (";
				foreach ($_POST['filtersize'] as $k=>$size) {
					$cond .= (($k)?' OR ':'')."pv.size = '".trim($size)."'";
				}
				$cond .= " ) ";
			}

			// if(isset($_POST['filtershape']) && !empty($_POST['filtershape'])){
			// 	$cond .= " AND (";
			// 	foreach ($_POST['filtershape'] as $k=>$size) {
			// 		$cond .= (($k)?' OR ':'')."pv.size = '".trim($size)."'";
			// 	}
			// 	$cond .= " ) ";
			// }

			if(isset($_POST['filterbrand']) && !empty($_POST['filterbrand'])){
				$cond .= " AND (";
				foreach ($_POST['filterbrand'] as $k=>$brand) {
					$cond .= (($k)?' OR ':'')."pd.brandId = '".trim($brand)."'";
				}
				$cond .= " ) ";
			}

			if(isset($_POST['filtershape']) && !empty($_POST['filtershape'])){
				$cond .= " AND (";
				foreach ($_POST['filtershape'] as $k=>$shape) {
					$cond .= (($k)?' OR ':'')."pd.shapeId = '".trim($shape)."'";
				}
				$cond .= " ) ";
			}

			$having = " HAVING img !='' ";

			if(isset($_POST['filterprice']) && !empty($_POST['filterprice'])){
				$price = explode('-', $_POST['filterprice']);
				if(isset($price[1]) && is_numeric($price[0]) && is_numeric($price[1])){
					$having = " HAVING (img !='' AND actualPrice >= '".trim($price[0])."' AND actualPrice <= '".trim($price[1])."') ";
				}
			}

			if(!empty($_POST['filterShortBy'])){
				if(trim($_POST['filterShortBy']) =="featured"){
					if($_POST['filterShortAsc'] == 'true')
						$orderBy = " ORDER BY productId asc";
					else
						$orderBy = " ORDER BY productId desc";
				}else if(trim($_POST['filterShortBy']) =="rating"){
					if($_POST['filterShortAsc'] == 'true')
						$orderBy = " ORDER BY rating asc";
					else
						$orderBy = " ORDER BY rating desc";
				}else if(trim($_POST['filterShortBy']) =="price"){
					if($_POST['filterShortAsc'] == 'true')
						$orderBy = " ORDER BY actualPrice asc";
					else
						$orderBy = " ORDER BY actualPrice desc";
				}
			}
			$response['filterCond'] = $cond." GROUP BY pd.productId $having $orderBy LIMIT $limitStart, 12";
			$searchData = $this->Common_model->exequery("SELECT pd.productId, (CASE WHEN productType = 1 THEN pv.actualPrice ELSE pd.actualPrice END ) as actualPrice, (CASE WHEN productType = 1 THEN pv.salePrice ELSE pd.salePrice END ) as salePrice, pd.isSameDayDelivery, pd.productName, pd.slug, (SELECT brandName FROM `ch_brand` WHERE ch_brand.brandId = pd.brandId) as brandName, (SELECT avg(ch_review.rating) FROM `ch_review` WHERE ch_review.productId = pd.productId) as rating, (SELECT wishlistId FROM `ch_wishlist` WHERE ch_wishlist.productId = pd.productId AND userId = $userId limit 0,1) as isWishlisted, (SELECT count(*) FROM `ch_review` WHERE ch_review.productId = pd.productId) as totalReview, (SELECT imageName FROM ".tablePrefix."images  WHERE imageId = pd.featuredImageId ) as img FROM ch_product as pd inner join ".tablePrefix."product_variable as pv on (pv.status =0 AND pv.variableId =(SELECT variableId FROM ch_product_variable WHERE status = 0 AND qty > 0 AND productId = pd.productId order by actualPrice asc limit 0, 1)) left join ".tablePrefix."product_category as pc on pc.productId = pd.productId where pd.status = 0  ".$cond." GROUP BY pd.productId $having $orderBy LIMIT $limitStart, 12");
			
			if($searchData){
				$filterData = '';

                $wishlistUrl = ($this->session->userdata(PREFIX.'userRoleId') > 0)?'javascript:':BASEURL."/login";
				foreach ($searchData as $product) {
					$gallery = $this->Common_model->exequery("SELECT pi.*, (case when pi.imageId > 0 then (SELECT imageName FROM ".tablePrefix."images  WHERE imageId = pi.imageId ) else '' end) as img FROM ".tablePrefix."product_images as pi WHERE pi.status = 0 AND pi.productId = ".$product->productId." having img !='' order by productImageId desc",1);
					$variableHtml = '';
                    $variableData = $this->Common_model->exequery("SELECT pv.color FROM ".tablePrefix."product_variable as pv WHERE pv.status = 0 AND pv.productId = ".$product->productId." limit 0, 5");
                    if($variableData){
                        foreach ($variableData as $key => $variable) {
                            $variableHtml .= '<div class="prd-color-item" style="background-color:'.$variable->color.'"></div>';
                        }
                    }
					$filterData .= '<div class="prd prd-has-loader product-item loaded" style=""> <div class="prd-inside"> <div class="prd-img-area"><a href="'.BASEURL.'/'.$product->slug.'" class="prd-img"><img src="'.FRONTSTATIC.'/images/products/product-placeholder.png" data-srcset="'.getResizedImg($product->img,'345_270').'" alt="'.$product->productName.'" class="js-prd-img lazyloaded" srcset="'.getResizedImg($product->img,'345_270').'"  srcalt="'.((isset($gallery->img) && !empty($gallery->img))?getResizedImg($gallery->img,'345_270'):'').'" hovered="0"> </a><a href="'.$wishlistUrl.'" onclick="addRemoveFromWishlist(this, event, '.$product->productId.')" class="label-wishlist icon-heart js-label-wishlist '.((isset($product->isWishlisted) && $product->isWishlisted > 0)?'active':'').'"></a> <div class="gdw-loader"></div> </div> <div class="prd-info"> <div class="prd-tag prd-hidemobile"><a href="javascript:">'.$product->brandName.'</a></div> <h2 class="prd-title"><a href="'.BASEURL.'/'.$product->slug.'">'.$product->productName.'</a></h2>'.$variableHtml.'<div class="prd-rating prd-hidemobile"><i class="icon-star '.(($product->rating >= 1)?'fill':'').'"></i><i class="icon-star  '.(($product->rating >= 2)?'fill':'').'"></i><i class="icon-star  '.(($product->rating >= 3)?'fill':'').'"></i><i class="icon-star  '.(($product->rating >= 4)?'fill':'').'"></i><i class="icon-star  '.(($product->rating >= 5)?'fill':'').'"></i></div> <div class="prd-price"> '.(($product->salePrice > 0 && $product->actualPrice > $product->salePrice  )?'<div class="price-new">₹ '.$product->salePrice.'</div><div class="price-old">₹ '.$product->actualPrice.'</div><div class="price-comment">You save ₹ '.($product->actualPrice-$product->salePrice).'</div>':'<div class="price-new">₹ '.$product->actualPrice.'</div>').'</div> <div class="prd-hover"> <div class="prd-action"> <form action="'.BASEURL.'/'.$product->slug.'" method="post"> <button type="submit" class="btn"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form> <div class="prd-links"><a href="'.BASEURL.'/'.$product->slug.'" class="icon-eye"></a></div> </div> </div> </div> </div> </div>';


				}
				$response = array("valid" => true, 'filterData'=> $filterData, 'filterCond'=> $cond." GROUP BY pd.productId $having $orderBy LIMIT $limitStart, 12");
			}
			
		}
		return $response;

	}


	function getFrontPagehtml(){
		$this->outputData['frontPageSettingData'] = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status = 0 AND name= 'front_page'",1);

		
		return $response = array( 'data' => $this->load->viewF('home_ajax_view', $this->outputData, true));

	}

	function getFrontFooterDescription(){
		$this->outputData['frontPageSettingData'] = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status = 0 AND name= 'front_page'",1);

		
		return $response = array( 'data' => $this->load->viewF('home_ajax_footer_view', $this->outputData, true));

	}


	function getFrontFooterhtml(){
		$this->outputData['frontFooterData'] = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status = 0 AND name= 'front_footer'",1);

		
		return $response = array( 'data' => $this->load->viewF('footer_ajax_view', $this->outputData, true));

	}


	// upload Shared Moment Images
	public function uploadSharedMoment(){
		
		$response =	 array('valid'=>false, 'msg'=>'Invalid request.');

		if(isset($_POST['title']) && !empty($_POST['title'])) {
			$userId =$this->session->userdata(PREFIX.'userRoleId');

			if($userId > 0){
				
				$queryData   =  array();
				$queryData['userId']	 	=   trim($userId);
				$queryData['title']	 		=   trim($_POST['title']);
				$queryData['description']	=   trim($_POST['description']);
				$queryData['status']		=   -1;
				$queryData['updatedOn']	 	=   date('Y-m-d H:i:s');

				$imageName = $this->uploadImage('share_moment_images');
				if ($imageName)
					$queryData['img']	 	=   $imageName;
				else
					return array('valid'=>false, 'msg'=>'Valid image required.');

				$updatetStatus 		= 	$this->Common_model->insert("ch_shared_moment", $queryData);
				if($updatetStatus){
					$response['valid']=true;
					$response['msg']="Your moment uploaded successfully.";

				}else
					$response['msg']="Something went wrong.";
			}else
				$response['msg']="Unauthrized request.";
		}

		return $response;
	}

    public function blogList() {
		$columns = array( 0 => "bl.blogId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  		//$userId = ($this->session->userdata(PREFIX.'userRoleId'))?$this->session->userdata(PREFIX.'userRoleId'):0;
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."blog as bl WHERE bl.status = 0",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        //return $totalFiltered;
        $qry = "SELECT *, (SELECT count(*) FROM ch_blog_comment WHERE status = 0 AND replyId = 0 AND blogId = bl.blogId) as totalComment, (SELECT GROUP_CONCAT(tag) FROM ch_tags WHERE status = 0 AND find_in_set(tagId, bl.tags)) as tags from ".tablePrefix."blog as bl WHERE bl.status = 0";

        $search = $this->input->post('search')['value'];        
        if(empty($search))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            if (!empty($search))
            	$search = str_replace(['"',"'"], ['', ''], $search);

            $searchCond = " AND (bl.blogTitle LIKE  '%".$search."%') ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);
            //return $queryData;
            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."blog as bl where bl.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();
        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            	$nestedData['blog'] = '<div class="blog-thumbnail">
							
							<div class="blog-img">
								<img src="'.UPLOADPATH.'/blog_images/'.$row->small_image.'" alt="">
							</div>
							<div class="blog-short-description">
								<div class="date">
									<p>'.(($row->addedOn)?date('d', strtotime($row->addedOn)):'').'<br/>'.(($row->addedOn)?date('M', strtotime($row->addedOn)):'').'</p>
								</div>
								<div class="blog-details">
									<h3>'.$row->blogTitle.'</h3>
									<div class="blog-brief">
										<span class="icon"><i class="fa fa-comment-o"></i></span>
										<span class="content">'.$row->totalComment.' Comments</span>
										<span class="icon"><i class="fa fa-tag"></i></span>
										<span class="content">'.$row->tags.'</span>
									</div>
									<p>'.substr(strip_tags($row->description), 0, 200).'..</p>
									<a href=\''.BASEURL.'/blog/'.$row->slug.'\'>Continue Reading <span><i class="fa fa-caret-right"></i></span></a>
								</div>
							</div>
						</div>';
                
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}
     
	public function blogComment(){
		$response = array("valid" => false, 'msg'=> 'Something is wrong.');
		if (isset($_POST['blogId']) && !empty($_POST['blogId'])) {
			if(!empty($this->session->userdata(PREFIX.'userRoleId'))){

                $queryData['blogId'] = $_POST['blogId'];
                $queryData['userId'] = $this->session->userdata(PREFIX.'userRoleId');
                $queryData['replyId'] = (isset($_POST['commentId']) && !empty($_POST['commentId'])?$_POST['commentId']:0);
                $queryData['message'] = $_POST['message'];
                $queryData['status'] = -1;
                $queryData['addedOn'] = date('Y-m-d H:i:s');
                if($this->Common_model->insert("ch_blog_comment",$queryData)){
				

					$response = array("valid" => true, 'msg'=> 'Your Blog Comment Save Successfully, We will show your comment after approve by admin');
				}else
					$response = array("valid" => false, 'msg'=> 'Something went wrong.');
	        }else
            	$response = array("valid" => false, 'msg'=> 'Sorry! login required to comment on blog.'); 
		}
		return $response;
	}
    public function viewMoreBlogComment(){
    	$response = array("valid" => false, 'msg'=> 'Something is wrong.','totalBlogComment'=>0);
		if (isset($_POST['blogId']) && !empty($_POST['blogId'])) {
         	$response = $this->Common_model->exequery("SELECT cs.*,(case when img != '' then concat('".UPLOADPATH."/user_images/', img) else '' end) as image,firstName,lastName FROM ".tablePrefix."blog_comment as cs left join ".tablePrefix."user as cu on cu.userId = cs.userId WHERE cs.status = 0 AND cs.blogId = '".$_POST['blogId']."'  AND replyId='0' order by cs.addedOn DESC LIMIT ".$_POST['countMsg'].",10");
         	$totalBlogCount = $this->Common_model->exequery("SELECT count(*) as totalBlog from ch_blog_comment WHERE status = 0 AND blogId = '".$_POST['blogId']."'  AND replyId= 0 ",1);
		  if($response){
		  	foreach($response as $key => $commentData ) { 
              $response = '<div class="blogComment">
              									<div class="blogComment-details">
              
              										<div class="img">
              											<img src="'. $commentData->image .'" alt="">
              										</div>
              										<div class="content">
              											<h3>"'.(isset($commentData->firstName) && !empty($commentData->firstName)?$commentData->firstName.' '.$commentData->lastName:'').'"</h3>
              											<div class="comment-details">
              												<p>
              													<span class="date">"'.(($commentData->addedOn)?date('d M y', strtotime($commentData->addedOn)):'').'"</span> 
              													<sapn>at</sapn> 
              													<span class="time">"'. (($commentData->addedOn)?date('H:i A', strtotime($commentData->addedOn)):'').'"</span> 
              													<span>/</span> 
              													<span class="reply-btn replyBlog" data-reply="'.(isset($commentData->commentId) && !empty($commentData->commentId)?$commentData->commentId:'').'"> Reply</span>
              												</p>
              											</div>
              											<div class="blog_rply"></div>
              											<p>"'.(isset($commentData->message) && !empty($commentData->message)?$commentData->message:'').'" </p>
              										</div>
              									</div>
              
              								</div>';
		  	}
		  	return $response = array("valid"=>true, 'data' => $response, 'totalBlogComment'=>(isset($totalBlogCount->totalBlog)?$totalBlogCount->totalBlog:0));
		  }
		  else
		  $response = array("valid"=>false,'msg'=>'No More Blog Comment Available', 'totalBlogComment'=>0); 
		}
		return $response;
    } 
    public function viewMoreReply(){
    	$response = array("valid" => false, 'msg'=> 'Something is wrong.','totalReply'=>0);
		if (isset($_POST['blogId']) && !empty($_POST['blogId'])) {
         $comments = $this->Common_model->exequery("SELECT cs.*,(case when img != '' then concat('".UPLOADPATH."/user_images/', img) else '' end) as image,firstName,lastName FROM ".tablePrefix."blog_comment as cs left join ".tablePrefix."user as cu on cu.userId = cs.userId WHERE cs.status = 0 AND blogId = '".$_POST['blogId']."'  AND replyId='".$_POST['replyId']."' order by cs.commentId DESC LIMIT ".$_POST['countMsg'].",10");
         $totalReplyCount = $this->Common_model->exequery("SELECT count(*) as totalReply from ch_blog_comment WHERE status = 0 AND blogId = '".$_POST['blogId']."'  AND replyId='".$_POST['replyId']."'",1);
          $commentsHtml = '';
         if($comments){
		  	foreach($comments as $key => $commentData ) { 
              $commentsHtml .= '<div class="blogComment blogComment-reply"> <div class="blogComment-details"> <div class="img"> <img src=" '. $commentData->image.' " alt=""> </div> <div class="content"> <h3>'.$commentData->firstName.' '.$commentData->lastName.'</h3> <p>'.$commentData->message.'</p> </div> </div> </div>';
            } 
            return $response = array("valid"=>true, 'data' => $commentsHtml, 'totalReply'=>(isset($totalReplyCount->totalReply)?$totalReplyCount->totalReply:0));
		  }
		  else
		  $response = array("valid"=>false,'msg'=>'No More Blog Comment Available', 'totalReply'=>0); 
		}
		return $response;
     }


     public function viewMorePhotoGalleryImages(){
     	$response = array("valid" => false, 'data'=> '','remainsCount'=>0);
     	$limitStart = (isset($_POST['imageCount']) && !empty($_POST['imageCount']))?$_POST['imageCount']:0;
     	$length = 8;
        $cond = " order by galleryId desc LIMIT $limitStart, $length";
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."front_page_photo_gallery as cat where cat.status = 0",1);
        $response['remainsCount'] = ( isset($totalDataCount->total)  && $totalDataCount->total > ($limitStart+$length) ) ? 1 : 0;

     	$galleryData = $this->Common_model->exequery("SELECT * from ".tablePrefix."front_page_photo_gallery as cat where cat.status = 0".$cond);
 		$galleryDataHtml = '';
 		if($galleryData){
 			foreach($galleryData as $key => $gallery ) { 
 				$galleryDataHtml .= '<li class="photo-gallery-details"> <div class="zoom-effect-container"> <div class="image-card"> <img src="'.UPLOADPATH.'/photo_gallery_images/'. $gallery->img.'" alt="Photo gallery"> </div> </div> <div class="same-delivary"> <h3>'. $gallery->description.'</h3> <a href="'. $gallery->btnUrl.'">Buy Now</a> </div> </li>';

 			} 
 			return $response = array("valid"=>true, 'data' => $galleryDataHtml, 'remainsCount'=>$response['remainsCount']);
 		}
 		else
 			$response['msg'] = 'No More Images Available'; 
     	
     	return $response;
     }

	// add or update visitor user
	public function updateVisitorData(){
		$response =	 array('valid'=>false, 'msg'=>'Invalid request.');
		$visitorId =$this->session->userdata(PREFIX.'visitorId');
		$cartId =$this->session->userdata(PREFIX.'cartId');
		if(!empty($cartId) && empty($userId) && isset($_POST) && !empty($_POST)) {

     		$visitorData =  $this->Common_model->exequery("SELECT * FROM ch_visitor WHERE status = 0 AND cartId = '".$cartId."'",1);

			if (isset($visitorData->visitorId) && !empty($visitorData->visitorId)) {
				$visitorId = $visitorData->visitorId;
			}else{
	            $insertData = array();
	            $insertData['cartId'] = $cartId ;
	            $insertData['updatedOn'] = date('Y-m-d H:i:s');
	            $insertData['addedOn'] = date('Y-m-d H:i:s');

	            $visitorId   = $this->Common_model->insertUnique('ch_visitor',$insertData);
	            $this->session->set_userdata(PREFIX.'visitorId',$visitorId);
	        }

	        $this->session->set_userdata(PREFIX.'visitorId',$visitorId);

			$queryData   =  array();

			if (isset($_POST['email']) && !empty($_POST['email'])) {
				$queryData['email']	=   trim($_POST['email']);
			}


			if (isset($_POST['name']) && !empty($_POST['name'])) {
				$queryData['addressName']	=   trim($_POST['addressName']);
				$queryData['name']	 		=   trim($_POST['name']);
				$queryData['mobile']	 	=   trim($_POST['mobile']);
				$queryData['alternateMobile']	=   trim($_POST['alternateMobile']);
				$queryData['address']	 	=   trim($_POST['address']);
				$queryData['address2']	 	=   trim($_POST['address2']);
				$queryData['city']	 		=   trim($_POST['city']);
				$queryData['state']			=   trim($_POST['state']);
				$queryData['country']	 	=   trim($_POST['country']);
				$queryData['pincode']	 	=   trim($_POST['pincode']);
				$queryData['senderName']	=   trim($_POST['senderName']);
				$queryData['senderNo']	 	=   trim($_POST['senderNo']);
				$this->Common_model->update("ch_cart", array("addressId"=>0),"cartId = '".$cartId."'");
			}

			if ($visitorId > 0 && !empty($queryData)) {
				$queryData['updatedOn']	 	=   date('Y-m-d H:i:s');
				$updatetStatus 		= 	$this->Common_model->update("ch_visitor", $queryData,"visitorId = '".$visitorId."'");

				if($updatetStatus){
						$response['valid']=true;
						$response['msg']="updated successfully.";
				}else
					$response['msg']= "Something is wrong.";
			}
		
		}
		return $response;
	}

	// add or update visitor user
	public function updateCartData(){
		$response =	 array('valid'=>false, 'msg'=>'Invalid request.');
		$cartId =$this->session->userdata(PREFIX.'cartId');
		if(!empty($cartId) && isset($_POST) && !empty($_POST)) {

     		$cartData =  $this->Common_model->exequery("SELECT * FROM ch_cart WHERE cartId = '".$cartId."'",1);


			$queryData   =  array();

			if (isset($_POST['addressId']) && !empty($_POST['addressId'])) {
				$queryData['addressId']	=   trim($_POST['addressId']);
			}

			if (isset($cartData->cartId) && !empty($queryData)) {
				$queryData['updatedOn']	 	=   date('Y-m-d H:i:s');
				$updatetStatus 		= 	$this->Common_model->update("ch_cart", $queryData,"cartId = '".$cartData->cartId."'");

				if($updatetStatus){
						$response['valid']=true;
						$response['msg']="updated successfully.";
				}else
					$response['msg']= "Something is wrong.";
			}
		
		}
		return $response;
	}

	// add or update wishlist
	public function addRemoveFromWishlist(){
		$response =	 array('valid'=>false, 'msg'=>'Invalid request.', 'wishlistId'=>0, 'notLoggedin'=>0);
		if(isset($_POST) && !empty($_POST) && $this->session->userdata(PREFIX.'userRoleId') > 0) {
			$variableId = isset($_POST['variableId'])?$_POST['variableId']:0;

			$queryData   =  array();
			$queryData['productId']	=   trim($_POST['productId']);
			$queryData['variableId']	=   $variableId;
			$queryData['addedOn']	=   date('Y-m-d H:i:s');
			$queryData['userId']	=   $this->session->userdata(PREFIX.'userRoleId');


     		$wishlistData =  $this->Common_model->exequery("SELECT * FROM ch_wishlist WHERE userId = '".$this->session->userdata(PREFIX.'userRoleId')."' AND productId = '".trim($_POST['productId'])."' AND variableId = '".$variableId."' ",1);

			if (isset($wishlistData->wishlistId)) {
				$updatetStatus 	= 	$this->Common_model->del("ch_wishlist","userId = '".$this->session->userdata(PREFIX.'userRoleId')."' AND productId = '".trim($_POST['productId'])."' AND variableId = '".$variableId."'");
			}else{

     			$productData =  $this->Common_model->exequery("SELECT * FROM ch_product WHERE status=0 and productId = '".trim($_POST['productId'])."'",1);
     			
 				$variableData =  $this->Common_model->exequery("SELECT * FROM ch_product_variable WHERE status = 0 AND variableId ='".$variableId."'",1);
	     		if($productData->productType && empty($variableData))
	 				$variableData =  $this->Common_model->exequery("SELECT *, (CASE WHEN salePrice > 0 then salePrice else actualPrice end) as price FROM ch_product_variable WHERE status = 0 AND productId ='".$_POST['productId']."' order by price",1);

	 			if (!empty($variableData))
	 				$variableId = $variableData->variableId;
	 			
				$queryData['variableId']	=   $variableId;

				$updatetStatus 	= 	$this->Common_model->insertUnique("ch_wishlist",$queryData);

			}


			if($updatetStatus){
					$response['valid']=true;
					$response['msg']=isset($wishlistData->wishlistId)?"Item removed from wishlist.":"Item added to wishlist.";
					$response['wishlistId']=isset($wishlistData->wishlistId)?0:$updatetStatus;
			}else
				$response['msg']= "Something is wrong.";
		
		}else
			$response['notLoggedin']= 1;
		return $response;
	}






}