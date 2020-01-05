<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public $outputData = array();
	public $cartId = 0;
	public $userIP = '';
	public $userId = 0;
	public function __construct(){

		parent::__construct();

		$this->userIP = $this->common_lib->getUserIpAddr();
		$this->userId = ($this->session->userdata(PREFIX.'userRoleId'))?$this->session->userdata(PREFIX.'userRoleId'):0;
		$this->cartId = ($this->session->userdata(PREFIX.'cartId'))?$this->session->userdata(PREFIX.'cartId'):0;		
		$cond = ($this->cartId>0)? " AND cartId = '".$this->cartId."'":(($this->userId>0)? " AND userId = '".$this->userId."'":((!empty($this->userIP))? " AND ip = '".$this->userIP."'":''));
		if ($cond){
			$cartData = $this->Common_model->exequery("SELECT *, (SELECT SUM(qty) FROM ch_cart_detail where cartId = ch_cart.cartId) as cartItemsCount, (SELECT sum(qty) FROM ch_cart_lens_detail where cartId = ch_cart.cartId) as cartLensCount FROM ".tablePrefix."cart WHERE status ='0' $cond", 1);


			if (!empty($cartData)) {

				$this->session->set_userdata(PREFIX.'cartItemsCount',$cartData->cartItemsCount);
				$this->session->set_userdata(PREFIX.'cartTotal',$cartData->cartTotal);
				$this->session->set_userdata(PREFIX.'deliveryChargeTotal',$cartData->deliveryCharge);
				$this->session->set_userdata(PREFIX.'cartGrandtotal',$cartData->grandTotal);
				$this->session->set_userdata(PREFIX.'cartId',(($cartData->cartId)?$cartData->cartId:0));

			}
		}

	}

	public function index(){
		$cartId = ($this->session->userdata(PREFIX.'cartId'))?$this->session->userdata(PREFIX.'cartId'):0;
		$this->outputData['cartData'] = array();
		$cond = ($cartId>0)? " AND cartId = '".$cartId."'":'';
		if ($cond){
			$cartData = $this->Common_model->exequery("SELECT *, (SELECT IFNULL(SUM(qty), 0) FROM ch_cart_detail where cartId = ch_cart.cartId) as cartItemsCount FROM ".tablePrefix."cart WHERE status ='0' $cond", 1);

		}

		if (isset($cartData->cartId) && !empty($cartData->cartId)) {

			$cartData->detailData = $this->Common_model->exequery("SELECT cd.*, cd.img as prescription_image, pd.productName, pd.slug, pv.variableTitle, ln.name as lensName, (SELECT imageName FROM ch_images  WHERE (CASE WHEN pv.imageId > 0 then imageId = pv.imageId  ELSE imageId = pd.featuredImageId end) ) as img, (SELECT GROUP_CONCAT(categoryId) FROM `ch_product_category` WHERE categoryType = 'category' AND productId = pd.productId limit 0,1) as categoryIds FROM ch_cart_detail as cd left join ch_product as pd on pd.productId = cd.productId left join ch_product_variable as pv on pv.variableId = cd.variableId left join ch_lens as ln on ln.lensId = cd.lensId  WHERE cartId = $cartData->cartId");
			$this->outputData['cartData'] = $cartData;

	    }

		$this->outputData['addressData'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."user_address WHERE status ='0' AND userId > 0 AND userId = '".$this->userId."'");

	  

		$this->load->viewF('cart_view', $this->outputData);
	}

	public function checkout1(){

		// $userIP = $this->common_lib->getUserIpAddr();
		// $userId = ($this->session->userdata(PREFIX.'userRoleId'))?$this->session->userdata(PREFIX.'userRoleId'):0;
		$cartId = ($this->session->userdata(PREFIX.'cartId'))?$this->session->userdata(PREFIX.'cartId'):0;
		$this->outputData['cartData'] = array();
		$cond = ($cartId>0)? " AND cartId = '".$cartId."'":'';
		if ($cond){
			$cartData = $this->Common_model->exequery("SELECT *,((SELECT IFNULL(SUM(qty), 0) FROM ch_cart_detail where cartId = ch_cart.cartId)+(SELECT IFNULL(SUM(qty), 0) from ch_cart_lens_detail WHERE cartId = ch_cart.cartId)) as cartItemsCount, (SELECT SUM(subtotal) FROM ch_cart_detail where cartId = ch_cart.cartId) as cartGrandtotal, ((SELECT SUM(subtotal) FROM ch_cart_detail where cartId = ch_cart.cartId) - (SELECT SUM(deliveryCharge) FROM ch_cart_detail where cartId = ch_cart.cartId)) as cartTotal, (SELECT SUM(deliveryCharge) FROM ch_cart_detail where cartId = ch_cart.cartId) as deliveryChargeTotal, (SELECT couponCode FROM ch_coupon where couponId = ch_cart.couponId limit 0,1) as coupon, (SELECT pincode FROM ch_pincode WHERE  pincodeId = (SELECT pincodeId FROM ch_cart_detail WHERE cartId = ch_cart.cartId limit 0,1) limit 0,1) as pincode, (SELECT COUNT(*) FROM ch_pincode WHERE isCod = 0 AND pincodeId IN(SELECT pincodeId FROM ch_cart_detail WHERE cartId = ch_cart.cartId)) as isNoCod  FROM ".tablePrefix."cart WHERE status ='0' $cond", 1);
			}


		if (isset($cartData->cartId) && !empty($cartData->cartId)) {

			$cartData->detailData = $this->Common_model->exequery("SELECT cd.*, pd.productName, pd.actualPrice, pd.isSameDayDelivery, pd.isCod, pd.minHourReqtoDeliver, pd.minMinuteReqtoDeliver, pd.minDayReqtoDeliver,  pv.variableTitle, ds.deliveryType, ds.deliveryAmount, dts.startTime, dts.endTime, pc.pincode, zn.zoneName, (SELECT imageName FROM ch_images  WHERE (CASE WHEN cd.variableId > 0 then imageId = pv.imageId  ELSE imageId = pd.featuredImageId end) ) as img FROM ch_cart_detail as cd left join ch_delivery_time_slots as dts on dts.timeslotId = cd.timeslotId left join ch_delivery_service as ds on ds.deliveryTimeSlotId = cd.deliveryTimeSlotId left join ch_pincode as pc on pc.pincodeId = cd.pincodeId left join ch_zone as zn on zn.zoneId = cd.zoneId left join ch_product as pd on pd.productId = cd.productId left join ch_product_variable as pv on pv.variableId = cd.variableId  WHERE cartId = $cartData->cartId ");
			if($this->userId > 0 && $cartData->pincode > 0)
				$this->outputData['addressData'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."user_address WHERE status ='0' AND pincode = '".$cartData->pincode."' AND userId = '".$this->userId."'");

			$this->outputData['visitorData'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."visitor WHERE status ='0' AND cartId = '".$cartData->cartId."'",1);

			

	    }
	    if (isset($cartData->detailData) && !empty($cartData->detailData))
	    	$this->outputData['cartData'] = $cartData;
	    else
	    	redirect(BASEURL);
	    
	    $this->outputData['couponData'] = $this->Common_model->exequery("SELECT * FROM ch_coupon where status = 0 and  isVisibleInCheckoutPage = 1 and endDate >= '".date('Y-m-d')."' ORDER BY couponId desc");
	    
	    $this->outputData['settingData'] = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'order_setting'",1);

		$this->load->viewF('checkout_view', $this->outputData);
	}
}