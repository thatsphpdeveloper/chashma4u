<?php
 /**
  * Order Controllers
  */
class Order extends CI_Controller{

   public $menu    = 4;
   public $subMenu   = 41;
   public $outputData 	= array();
   function __construct(){
      parent::__construct();
      $this->session->set_userdata(PREFIX.'sessDashboard', "admin");
      $this->common_lib->setSessionVariables();
   }

   public function index($vendorId = '')
   { 
      $this->menu     =   4;
      $this->subMenu  =   41;
      $this->common_lib->checkRolePermission(['can_manage_all_order','can_view_order']);
      $cond ="";
      if($vendorId > 0){
         $cond =  " AND od.orderId IN (SELECT DISTINCT orderId FROM `ch_order_detail` WHERE vendorId = '".$vendorId."')";
         $this->outputData['vendorData']=$this->Common_model->exequery("SELECT * FROM ch_vendor WHERE vendorId = '".$vendorId."'",1);
      }
      $this->outputData['orderData']=$this->Common_model->exequery("SELECT * FROM ((SELECT COUNT(*) as new FROM ch_order as od left join ch_order_transaction as ot on ot.orderId = od.orderId WHERE od.status = 0 AND (ot.paymentStatus = 1 OR ot.paymentMethod = 'cod') $cond) as new, (SELECT COUNT(*) as ongoing FROM ch_order as od  WHERE od.status IN (1,2,3,4) $cond) as ongoing, (SELECT COUNT(*) as completed FROM ch_order as od  WHERE od.status IN (5,6) $cond) as completed, (SELECT COUNT(*) as total FROM ch_order as od  WHERE od.orderId > 0  $cond) as total)",1);


      $this->load->viewD('admin/order_history_view',$this->outputData);
   }


   public function detail($orderId = 0)
   {
      $this->menu     =   4;
      $this->subMenu  =   41;

      $this->common_lib->checkRolePermission(['can_manage_all_order','can_view_order']);

      
      $this->outputData['orderData'] = $this->Common_model->exequery("SELECT od.*, ot.transactionId, ot.orderId, ot.paymentMethod, ot.paymentTrxId, ot.payerMail, ot.paidAmt, ot.paymentMessage, ot.paymentStatus,cp.couponCode, cp.discountType, cp.discount, us.firstName, us.mobile, (SELECT count(*) FROM ".tablePrefix."order_detail  WHERE orderId = od.orderId ) as itemCount from ".tablePrefix."order as od left join ch_order_transaction as ot on ot.orderId = od.orderId left join ch_coupon as cp on cp.couponId = od.couponId left join ".tablePrefix."user as us on us.userId = od.userId where od.orderId='".$orderId."'" ,1);
      if (!isset($this->outputData['orderData']->orderId) || empty($this->outputData['orderData']->orderId)){
         $this->common_lib->setSessMsg('Invalid request.', 2);
         redirect(DASHURL.'/admin/order');
      }

      $this->outputData['detailData']  = $this->Common_model->exequery("SELECT od.*, pd.productName, pd.isCourierDelivery, pd.actualPrice, pd.slug,  pv.variableTitle, ln.name as lensName, (SELECT imageName FROM ch_images  WHERE (CASE WHEN pv.imageId > 0 then imageId = pv.imageId  ELSE imageId = pd.featuredImageId end) ) as productImg, (SELECT GROUP_CONCAT(categoryId) FROM `ch_product_category` WHERE categoryType = 'category' AND productId = pd.productId limit 0,1) as categoryIds, (SELECT brandName FROM `ch_brand` WHERE ch_brand.brandId = pd.brandId) as brandName FROM ch_order_detail as od left join ch_product as pd on pd.productId = od.productId left join ch_product_variable as pv on pv.variableId = od.variableId left join ch_lens as ln on ln.lensId = od.lensId WHERE od.orderId = '".$this->outputData['orderData']->orderId."' ORDER BY pd.productName ASC");
      
      $this->outputData['orderData']->addressData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."user_address WHERE addressId = '".$this->outputData['orderData']->addressId."'",1);

      $this->load->viewD('admin/order_detail_view',$this->outputData);
   }

     public function invoice($orderId = 0)
   {
      $this->menu     =   4;
      $this->subMenu  =   41;

      $this->common_lib->checkRolePermission(['can_manage_all_order','can_view_order']);
      
      
      $this->outputData['orderData'] = $this->Common_model->exequery("SELECT od.*, ot.transactionId, ot.orderId, ot.paymentMethod, ot.paymentTrxId, ot.payerMail, ot.paidAmt, ot.paymentMessage, ot.paymentStatus,cp.couponCode, cp.discountType, cp.discount, (CASE WHEN od.userId > 0 THEN us.firstName ELSE guestEmail END) user, (SELECT sum(qty) FROM ".tablePrefix."order_detail  WHERE orderId = od.orderId ) as itemCount from ".tablePrefix."order as od left join ch_order_transaction as ot on ot.orderId = od.orderId left join ch_coupon as cp on cp.couponId = od.couponId left join ".tablePrefix."user as us on us.userId = od.userId where od.orderId='".$orderId."'" ,1);
      if (!isset($this->outputData['orderData']->orderId) || empty($this->outputData['orderData']->orderId)){
         $this->common_lib->setSessMsg('Invalid request.', 2);
         redirect(DASHURL.'/admin/order');
      }
      $this->outputData['detailData']  = $this->Common_model->exequery("SELECT od.*, pd.productName, pd.isCourierDelivery, pd.actualPrice, pd.slug,  pv.variableTitle, ln.name as lensName, (SELECT imageName FROM ch_images  WHERE (CASE WHEN pv.imageId > 0 then imageId = pv.imageId  ELSE imageId = pd.featuredImageId end) ) as productImg, (SELECT GROUP_CONCAT(categoryId) FROM `ch_product_category` WHERE categoryType = 'category' AND productId = pd.productId limit 0,1) as categoryIds, (SELECT brandName FROM `ch_brand` WHERE ch_brand.brandId = pd.brandId) as brandName FROM ch_order_detail as od left join ch_product as pd on pd.productId = od.productId left join ch_product_variable as pv on pv.variableId = od.variableId left join ch_lens as ln on ln.lensId = od.lensId WHERE od.orderId = '".$this->outputData['orderData']->orderId."' ORDER BY pd.productName ASC");

      $this->outputData['orderData']->addressData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."user_address WHERE addressId = '".$this->outputData['orderData']->addressId."'",1);


      $this->load->viewD('admin/order_invoice_view',$this->outputData);
   }

   public function slip($orderId = 0)
   {
      $this->menu     =   4;
      $this->subMenu  =   41;

      $this->common_lib->checkRolePermission(['can_manage_all_order','can_view_order']);
      
      
      $this->outputData['orderData'] = $this->Common_model->exequery("SELECT od.*, ot.transactionId, ot.orderId, ot.paymentMethod, ot.paymentTrxId, ot.payerMail, ot.paidAmt, ot.paymentMessage, ot.paymentStatus,cp.couponCode, cp.discountType, cp.discount, (CASE WHEN od.userId > 0 THEN us.firstName ELSE guestEmail END) user, (SELECT sum(qty) FROM ".tablePrefix."order_detail  WHERE orderId = od.orderId ) as itemCount from ".tablePrefix."order as od left join ch_order_transaction as ot on ot.orderId = od.orderId left join ch_coupon as cp on cp.couponId = od.couponId left join ".tablePrefix."user as us on us.userId = od.userId where od.orderId='".$orderId."'" ,1);
      if (!isset($this->outputData['orderData']->orderId) || empty($this->outputData['orderData']->orderId)){
         $this->common_lib->setSessMsg('Invalid request.', 2);
         redirect(DASHURL.'/admin/order');
      }
      $this->outputData['detailData']  = $this->Common_model->exequery("SELECT od.*, pd.productName, pd.isCourierDelivery, pd.actualPrice, pd.slug,  pv.variableTitle, ln.name as lensName, (SELECT imageName FROM ch_images  WHERE (CASE WHEN pv.imageId > 0 then imageId = pv.imageId  ELSE imageId = pd.featuredImageId end) ) as productImg, (SELECT GROUP_CONCAT(categoryId) FROM `ch_product_category` WHERE categoryType = 'category' AND productId = pd.productId limit 0,1) as categoryIds, (SELECT brandName FROM `ch_brand` WHERE ch_brand.brandId = pd.brandId) as brandName FROM ch_order_detail as od left join ch_product as pd on pd.productId = od.productId left join ch_product_variable as pv on pv.variableId = od.variableId left join ch_lens as ln on ln.lensId = od.lensId WHERE od.orderId = '".$this->outputData['orderData']->orderId."' ORDER BY pd.productName ASC");
      $this->outputData['orderData']->addressData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."user_address WHERE addressId = '".$this->outputData['orderData']->addressId."'",1);


      $this->load->viewD('admin/order_slip_view',$this->outputData);
   }


   public function edit($detailId = 0)
   {
      $this->menu     =   4;
      $this->subMenu  =   41;

      $this->common_lib->checkRolePermission(['can_manage_all_order','can_edit_order']);

      
      $this->outputData['detailData']  = $this->Common_model->exequery("SELECT od.*, pd.*,  pv.variableTitle, ds.deliveryType, ds.deliveryAmount, dts.startTime, dts.endTime, pc.pincode, zn.zoneName, vd.vendorName, (SELECT GROUP_CONCAT(attributeName ORDER BY attributeName ASC SEPARATOR ', ') FROM ch_product_attributeinfo WHERE attributeInfoId IN (SELECT attributeId FROM ch_order_attribute_detail WHERE detailId = od.detailId )) as attributes,(SELECT imageName FROM ch_images  WHERE (CASE WHEN od.variableId > 0 then imageId = pv.imageId  ELSE imageId = pd.featuredImageId end) ) as productImg FROM ch_order_detail as od left join ch_delivery_time_slots as dts on dts.timeslotId = od.timeslotId left join ch_delivery_service as ds on ds.deliveryTimeSlotId = od.deliveryTimeSlotId left join ch_pincode as pc on pc.pincodeId = od.pincodeId left join ch_zone as zn on zn.zoneId = od.zoneId left join ch_product as pd on pd.productId = od.productId left join ch_product_variable as pv on pv.variableId = od.variableId left join ch_vendor as vd on vd.vendorId = od.vendorId  WHERE od.detailId = '".$detailId."'",1);

      if (!isset($this->outputData['detailData']->orderId) || empty($this->outputData['detailData']->orderId)){
         $this->common_lib->setSessMsg('Invalid request.', 2);
         echo '<script>window.history.back()</script>';
      }

      $this->outputData['orderData'] = $this->Common_model->exequery("SELECT od.*, ot.transactionId, ot.orderId, ot.paymentMethod, ot.paymentTrxId, ot.payerMail, ot.paidAmt, ot.paymentMessage, ot.paymentStatus,cp.couponCode, cp.discountType, cp.discount, vd.vendorName, (CASE WHEN od.userId > 0 THEN us.firstName ELSE guestEmail END) user, (SELECT count(*) FROM ".tablePrefix."order_detail  WHERE orderId = od.orderId ) as itemCount, (SELECT pincodeId FROM ch_order_detail WHERE orderId = od.orderId limit 0,1) as pincodeId from ".tablePrefix."order as od left join ch_order_transaction as ot on ot.orderId = od.orderId left join ch_coupon as cp on cp.couponId = od.couponId left join ".tablePrefix."user as us on us.userId = od.userId left join ".tablePrefix."vendor as vd on vd.vendorId = (SELECT vendorId FROM ch_order_detail WHERE vendorId > 0 AND orderId = od.orderId limit 0,1) where od.orderId='".$this->outputData['detailData']->orderId."'" ,1);
      if (!isset($this->outputData['orderData']->orderId) || empty($this->outputData['orderData']->orderId)){
         $this->common_lib->setSessMsg('Invalid request.', 2);
         echo '<script>window.history.back()</script>';
      }


      if($this->outputData['orderData']->userId > 0 && $this->outputData['detailData']->pincode > 0)
         $this->outputData['addressData'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."user_address WHERE status ='0' AND pincode = '".$this->outputData['detailData']->pincode."' AND userId = '".$this->outputData['orderData']->userId."'");

      else if($this->outputData['orderData']->addressId > 0)
         $this->outputData['addressData'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."user_address WHERE status ='0' AND addressId = '".$this->outputData['orderData']->addressId."'");

      $this->outputData['paymentData'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."order_transaction WHERE orderId = '".$this->outputData['orderData']->orderId."' order by transactionId desc",1);


      $this->load->viewD('admin/order_edit_view',$this->outputData);
   }



   public function new()
   { 
      $this->menu     =   4;
      $this->subMenu  =   41;
      $userIP = $this->common_lib->getUserIpAddr();

      $cartData =  $this->Common_model->exequery("SELECT * FROM ch_cart WHERE status = 0  AND isAdminCart = 1 AND ip = '".$userIP."'",1);

      if (isset($cartData->cartId) && !empty($cartData->cartId)) {
         $cartId = $cartData->cartId;
      }else{
            $insertData = array();
            $insertData['isAdminCart'] = 1;
            $insertData['ip']    = $userIP;
            $insertData['updatedOn'] = date('Y-m-d H:i:s');
            $insertData['addedOn'] = date('Y-m-d H:i:s');

            $cartId   = $this->Common_model->insertUnique('ch_cart',$insertData);
      }

      if($cartId > 0)
         $this->session->set_userdata(PREFIX.'cartId',$cartId);
      else
         exit('Something went wrong.');


      $this->load->viewD('admin/order_new_view',$this->outputData);
   }

   public function visitors()
   { 
      $this->menu     =   4;
      $this->subMenu  =   41;
      $this->common_lib->checkRolePermission(['can_manage_all_order','can_view_order']);

      $this->load->viewD('admin/order_visitor_view',$this->outputData);
   }

   public function visitordetail($visitorId = 0)
   { 
      $this->menu     =   4;
      $this->subMenu  =   41;
      $this->common_lib->checkRolePermission(['can_manage_all_order','can_view_order']);

      
      $this->outputData['visitorData'] = $this->Common_model->exequery("SELECT vs.*, ct.*, vs.updatedOn as updatedOn from ".tablePrefix."visitor as vs left join ch_cart as ct on ct.cartId = vs.cartId where vs.status = 0 AND vs.visitorId='".$visitorId."'" ,1);
      if (!isset($this->outputData['visitorData']->visitorId) || empty($this->outputData['visitorData']->visitorId)){
         $this->common_lib->setSessMsg('Invalid request.', 2);
         redirect(DASHURL.'/admin/order/visitors');
      }


      $this->outputData['detailData']  = $this->Common_model->exequery("SELECT cd.*, pd.productName, pd.isCourierDelivery, pd.actualPrice, pd.isSameDayDelivery, pd.minHourReqtoDeliver, pd.minMinuteReqtoDeliver, pd.minDayReqtoDeliver, pd.slug,  pv.variableTitle, ds.deliveryType, ds.deliveryAmount, dts.startTime, dts.endTime, pc.pincode, zn.zoneName, (SELECT GROUP_CONCAT(attributeName ORDER BY attributeName ASC SEPARATOR ', ') FROM ch_product_attributeinfo WHERE attributeInfoId IN (SELECT attributeId FROM ch_cart_attribute_detail WHERE detailId = cd.detailId )) as attributes,(SELECT imageName FROM ch_images  WHERE (CASE WHEN cd.variableId > 0 then imageId = pv.imageId  ELSE imageId = pd.featuredImageId end) ) as productImg FROM ch_cart_detail as cd left join ch_delivery_time_slots as dts on dts.timeslotId = cd.timeslotId left join ch_delivery_service as ds on ds.deliveryTimeSlotId = cd.deliveryTimeSlotId left join ch_pincode as pc on pc.pincodeId = cd.pincodeId left join ch_zone as zn on zn.zoneId = cd.zoneId left join ch_product as pd on pd.productId = cd.productId left join ch_product_variable as pv on pv.variableId = cd.variableId WHERE cd.cartId = '".$this->outputData['visitorData']->cartId."' ORDER BY pd.productName ASC");
      if (!empty($this->outputData['detailData'])) {
         foreach ($this->outputData['detailData'] as $detail) {
            
            $detail->attributeData = $this->Common_model->exequery("SELECT oad.*, pai.attributeName, pa.attributeHeading FROM ch_cart_attribute_detail as oad left join ch_product_attributeinfo as pai on pai.attributeInfoId = oad.attributeId left join ch_product_attribute as pa on pa.attributeId = pai.attributeHeadingId WHERE oad.detailId = '".$detail->detailId."'");

            $detail->addonsData = $this->Common_model->exequery("SELECT oad.*, pa.addonsName, pa.img FROM ch_cart_addons_detail as oad left join ch_product_addons as pa on pa.addonsId = oad.addonsId WHERE oad.detailId = '".$detail->detailId."'");
         }
      }

      $this->load->viewD('admin/order_visitor_detail_view',$this->outputData);
   }


}
?>