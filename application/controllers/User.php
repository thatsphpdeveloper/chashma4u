<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public $menu		= 10;
	public $subMenu		= 101;
	public $outputData  	= array();

	public function __construct(){
		parent::__construct();
		//Check login authentication & set public veriables
		$this->session->set_userdata(PREFIX.'userRole', "user");
		$this->common_lib->setUserSessionVariables();
	}
	

	//Home page
	public function index() {
		redirect(BASEURL.'/user/profile');
	}


	public function profile() {
		$this->menu		=	10;
		$this->subMenu	=	102;
		$query	=	"SELECT *, (CASE WHEN img='' THEN '".NOIMAGE."' else concat('".UPLOADPATH."/user_images/',img) END) as img 
			from ch_user where status != 2 and  userId = '".$this->userRoleId."'";
		$this->outputData['userData'] =	$this->Common_model->exequery($query,1);

		$this->outputData['addressData'] =	$this->Common_model->exequery("SELECT * from ch_user_address where status != 2 and  userId = '".$this->userRoleId."'");
		$this->load->viewF('user/profile_view',$this->outputData);
	}
	public function address() {
		$this->menu		=	10;
		$this->subMenu	=	103;
		$this->outputData['addressData'] =	$this->Common_model->exequery("SELECT addressId as id, name as addressName, mobile as contact, address as address1, address2, city, state, country, pincode as zipcode ,isDefault as isPrimary from ch_user_address where status != 2 and  userId = '".$this->userRoleId."' order by addressName asc");
		$this->load->viewF('user/address_view',$this->outputData);
	}

	public function change_password() {
		$this->menu		=	10;
		$this->subMenu	=	105;

		$this->load->viewF('user/password_change_view',$this->outputData);
	}

	public function order() {
		$this->menu		=	10;
		$this->subMenu	=	104;

		$this->load->viewF('user/order_view',$this->outputData);
	}

	public function order_details($generatedId = 0) {
		$this->menu		=	10;
		$this->subMenu	=	104;

        $userId =$this->session->userdata(PREFIX.'userRoleId');

		$this->outputData['orderData'] = $this->Common_model->exequery("SELECT od.*,ot.paymentMethod, ot.paymentStatus, ot.paidAmt from ".tablePrefix."order as od left join ch_order_transaction as ot on ot.orderId = od.orderId where  generatedId= '".$generatedId."' AND od.userId= '".$userId."'" ,1);
      if (!isset($this->outputData['orderData']->orderId) || empty($this->outputData['orderData']->orderId)){
         $this->common_lib->setSessMsg('Invalid request.', 2);
         redirect(BASEURL.'/user/order');
      }
      $this->outputData['detailData']  = $this->Common_model->exequery("SELECT od.*, od.img as prescription_image, pd.productName, pd.actualPrice, pd.slug, pv.variableTitle, ln.name as lensName, (SELECT imageName FROM ch_images  WHERE (CASE WHEN pv.imageId > 0 then imageId = pv.imageId  ELSE imageId = pd.featuredImageId end) ) as img, (SELECT GROUP_CONCAT(categoryId) FROM `ch_product_category` WHERE categoryType = 'category' AND productId = pd.productId limit 0,1) as categoryIds, (SELECT brandName FROM `ch_brand` WHERE ch_brand.brandId = pd.brandId) as brandName FROM ch_order_detail as od left join ch_product as pd on pd.productId = od.productId left join ch_product_variable as pv on pv.variableId = od.variableId left join ch_lens as ln on ln.lensId = od.lensId WHERE od.orderId = '".$this->outputData['orderData']->orderId."'");

      $this->outputData['orderData']->addressData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."user_address WHERE addressId = '".$this->outputData['orderData']->addressId."'",1);

		$this->load->viewF('user/order_details_view',$this->outputData);
	}

	public function invoice($generatedId = 0) {
		$this->menu		=	10;
		$this->subMenu	=	104;
        $userId =$this->session->userdata(PREFIX.'userRoleId');

		$this->outputData['orderData'] = $this->Common_model->exequery("SELECT od.*, vd.vendorName, (CASE WHEN od.userId > 0 THEN us.firstName ELSE guestEmail END) user, (SELECT count(*) FROM ".tablePrefix."order_detail  WHERE orderId = od.orderId ) as itemCount from ".tablePrefix."order as od left join ".tablePrefix."user as us on us.userId = od.userId left join ".tablePrefix."vendor as vd on vd.vendorId = (SELECT vendorId FROM ch_order_detail WHERE vendorId > 0 AND orderId = od.orderId limit 0,1) where od.status = 5 and generatedId= '".$generatedId."' AND od.userId= '".$userId."'" ,1);
      if (!isset($this->outputData['orderData']->orderId) || empty($this->outputData['orderData']->orderId)){
         $this->common_lib->setSessMsg('Invalid request.', 2);
         redirect(BASEURL.'/user/order');
      }
      $this->outputData['detailData']  = $this->Common_model->exequery("SELECT od.*, pd.productName, pd.actualPrice, pd.isSameDayDelivery, pd.minHourReqtoDeliver, pd.minMinuteReqtoDeliver, pd.minDayReqtoDeliver,  pv.variableTitle, ds.deliveryType, ds.deliveryAmount, dts.startTime, dts.endTime, pc.pincode, zn.zoneName, od.attributeIds, vd.vendorName, (SELECT GROUP_CONCAT(attributeName ORDER BY attributeName ASC SEPARATOR ', ') FROM ch_product_attributeinfo WHERE find_in_set(attributeInfoId,od.attributeIds) <> 0 ) as attributes,(SELECT imageName FROM ch_images  WHERE (CASE WHEN od.variableId > 0 then imageId = pv.variableId  ELSE imageId = pd.featuredImageId end) ) as productImg FROM ch_order_detail as od left join ch_delivery_time_slots as dts on dts.timeslotId = od.timeslotId left join ch_delivery_service as ds on ds.deliveryTimeSlotId = od.deliveryTimeSlotId left join ch_pincode as pc on pc.pincodeId = od.pincodeId left join ch_zone as zn on zn.zoneId = od.zoneId left join ch_product as pd on pd.productId = od.productId left join ch_product_variable as pv on pv.variableId = od.variableId left join ch_vendor as vd on vd.vendorId = od.vendorId  WHERE od.orderId = '".$this->outputData['orderData']->orderId."' ORDER BY pd.productName ASC");
      if (!empty($this->outputData['detailData'])) {
         foreach ($this->outputData['detailData'] as $detail) {
            
            $detail->attributeData = ($detail->attributeIds)?$this->Common_model->exequery("SELECT pai.*, pa.attributeHeading FROM ch_product_attributeinfo as pai left join ch_product_attribute as pa on pa.attributeId = pai.attributeHeadingId WHERE find_in_set(pai.attributeInfoId,'".$detail->attributeIds."') <> 0 "):'';

            $detail->addonsData = ($detail->addonsIds)?$this->Common_model->exequery("SELECT * FROM ch_product_addons WHERE find_in_set(addonsId,'".$detail->addonsIds."') <> 0 "):'';
         }
      }
      $this->outputData['orderData']->addressData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."user_address WHERE addressId = '".$this->outputData['orderData']->addressId."'",1);

		
		$this->load->viewF('user/order_invoice_view',$this->outputData);
	}


	public function track_order($generatedId = 0) {
		$this->menu		=	10;
		$this->subMenu	=	104;
        $userId =$this->session->userdata(PREFIX.'userRoleId');
        $cond = '';
        if ($userId > 0 && !empty($generatedId)) {
        	$cond = " AND userId = '".$userId."' AND generatedId= '".$generatedId."'";
        }
		$orderData = (!empty($cond))?$this->Common_model->exequery("SELECT * FROM ".tablePrefix."order WHERE status < 5",1):array();
		if (!empty($orderData)) {
			$orderData->detailData = $this->Common_model->exequery("SELECT od.*, pd.productName, pd.actualPrice, pd.isSameDayDelivery, pd.minHourReqtoDeliver, pd.minMinuteReqtoDeliver, pd.minDayReqtoDeliver,  pv.variableTitle, ds.deliveryType, ds.deliveryAmount, dts.startTime, dts.endTime, pc.pincode, zn.zoneName, (SELECT imageName FROM ch_images  WHERE (CASE WHEN od.variableId > 0 then imageId = pv.imageId  ELSE imageId = pd.featuredImageId end) ) as img, (SELECT reviewId FROM `ch_review` WHERE status= 0 AND productId= od.productId AND userId= $userId) as reviewId FROM ch_order_detail as od left join ch_delivery_time_slots as dts on dts.timeslotId = od.timeslotId left join ch_delivery_service as ds on ds.deliveryTimeSlotId = od.deliveryTimeSlotId left join ch_pincode as pc on pc.pincodeId = od.pincodeId left join ch_zone as zn on zn.zoneId = od.zoneId left join ch_product as pd on pd.productId = od.productId left join ch_product_variable as pv on pv.variableId = od.variableId  WHERE orderId = '".$orderData->orderId."' ");
				$orderData->addressData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."user_address WHERE addressId = '".$orderData->addressId."'",1);



	    }
	    $this->outputData['orderData'] = $orderData;
		if (empty($this->outputData['orderData']))
			redirect(($userId > 0)?BASEURL.'/user/order':BASEURL.'/contact');
		$this->load->viewF('user/order_track_view',$this->outputData);
	}

	public function review_product($generatedId = 0) {
		$this->menu		=	10;
		$this->subMenu	=	104;
        $userId =$this->session->userdata(PREFIX.'userRoleId');
		$orderData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."order WHERE status = 4 AND userId = '".$userId."' AND generatedId= '".$generatedId."'",1);
		if (!empty($orderData)) {
			$orderData->detailData = $this->Common_model->exequery("SELECT pd.productName, pd.productId, (SELECT imageName FROM ch_images  WHERE (CASE WHEN od.variableId > 0 then imageId = pv.imageId  ELSE imageId = pd.featuredImageId end) ) as img, (SELECT reviewId FROM `ch_review` WHERE status= 0 AND productId= od.productId AND userId= $userId) as reviewId FROM ch_order_detail as od left join ch_product as pd on pd.productId = od.productId left join ch_product_variable as pv on pv.variableId = od.variableId WHERE orderId = '".$orderData->orderId."' having reviewId is null");
	    }
	    $this->outputData['orderData'] = $orderData;
		if (!isset($orderData->detailData) || empty($orderData->detailData))
			redirect(BASEURL.'/user/order');
		$this->load->viewF('user/order_product_review_view',$this->outputData);
	}

}