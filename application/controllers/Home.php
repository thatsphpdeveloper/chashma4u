<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public $outputData = array();
	public $menu    = 1;
	public $subMenu   = 1;
	public function __construct(){

		parent::__construct();
	}

	public function index(){
		$this->outputData['frontData'] = '';
		$frontPageSettingData = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status = 0 AND name= 'front_page'",1);
		if (isset($frontPageSettingData->value) && !empty($frontPageSettingData->value))
	      	$this->outputData['frontData'] = $frontData = (object) unserialize($frontPageSettingData->value);
	    
	    $mainSliderArr = (isset($frontData->slider) && !empty($frontData->slider))?explode(',', $frontData->slider):array();

	    $this->outputData['frontPageSliderData'] = (isset($frontData->slider) && !empty($frontData->slider))?$this->Common_model->exequery("SELECT * FROM ch_front_page_slider WHERE status = 0 AND FIND_IN_SET(sliderId, '".$frontData->slider."') ORDER BY sliderId DESC"):array();

	    $this->outputData['frontPageCategoryData'] = (isset($frontData->category_section_category) && !empty($frontData->category_section_category))?$this->Common_model->exequery("SELECT sc.*, (case when sc.imageId != 0 then (SELECT imageName FROM ".tablePrefix."images  WHERE imageId = sc.imageId ) else '' end) as img FROM ch_subcategory as sc WHERE sc.status = 0 AND FIND_IN_SET(sc.subcategoryId, '".$frontData->category_section_category."') ORDER BY sc.subcategoryId DESC"):array();

		$this->load->viewF('home_view', $this->outputData);
	}

	
	public function contact(){
		$this->load->viewF('contact_view');
	}
	

	
	public function offer(){
		$todaydealData = $this->Common_model->exequery("SELECT td.todaydealId  , td.date, td.startTime, td.endTime, td.addedOn from ch_todaydeal as td  where td.status = 0 AND td.date = '".date('Y-m-d')."'",1);

	    if (isset($todaydealData->todaydealId) && !empty($todaydealData->todaydealId) &&  strtotime($todaydealData->endTime) > strtotime(date('H:i')) ){

	      	$todaydealData->products= $this->Common_model->exequery("SELECT tdp.productId, tdp.price, (CASE WHEN tdp.variableId > 0 THEN vd.actualPrice ELSE pd.actualPrice END) as oldPrice, pd.isSameDayDelivery, pd.slug, (CASE WHEN tdp.variableId > 0 THEN CONCAT(pd.productName,' (',vd.variableTitle,')') ELSE pd.productName END) as productName, (SELECT (SELECT categoryName FROM `ch_category` WHERE categoryId = ch_product_category.categoryId ) as categoryName FROM `ch_product_category` WHERE `productId` = 15 and categoryType = 'category' LIMIT 0, 1) as categoryName, (SELECT avg(ch_review.rating) FROM `ch_review` WHERE ch_review.productId = pd.productId) as rating, (SELECT count(*) FROM `ch_review` WHERE ch_review.productId = pd.productId) as totalReview, (case when pd.featuredImageId != 0 then (SELECT imageName FROM ".tablePrefix."images  WHERE imageId = pd.featuredImageId ) else '".NOIMAGE."' end) as img FROM ch_todaydeal_product as tdp left join ch_product as pd on pd.productId = tdp.productId left join ch_product_variable as vd on vd.variableId = tdp.variableId where tdp.status = 0  AND pd.status = 0 and tdp.todaydealId = ".$todaydealData->todaydealId." HAVING img !='' ORDER BY pd.productName ASC , vd.variableTitle ASC");

	    }
	    $this->outputData['todaydealData'] = $todaydealData;
		$this->load->viewF('offer_view',$this->outputData);
	}
	public function trending(){
	    $this->outputData['trendingData'] = $this->Common_model->exequery("SELECT pd.productId, (CASE WHEN productType = 1 THEN (SELECT actualPrice FROM ch_product_variable WHERE status = 0 AND productId = pd.productId order by actualPrice asc limit 0, 1) ELSE pd.actualPrice END ) as actualPrice, (CASE WHEN productType = 1 THEN (SELECT salePrice FROM ch_product_variable WHERE status = 0 AND productId = pd.productId order by actualPrice asc limit 0, 1) ELSE pd.salePrice END ) as salePrice, pd.isSameDayDelivery, pd.productName, pd.slug, (SELECT avg(ch_review.rating) FROM `ch_review` WHERE ch_review.productId = pd.productId) as rating, (SELECT count(*) FROM `ch_review` WHERE ch_review.productId = pd.productId) as totalReview, (SELECT imageName FROM ".tablePrefix."images  WHERE imageId = pd.featuredImageId ) as img FROM ch_product as pd where pd.status = 0 and pd.productType = 0 and pd.salePrice > 0 HAVING img !=''ORDER BY pd.productId desc LIMIT 0, 10");
		$this->load->viewF('trending_view',$this->outputData);
	}
	
	public function search() {
		if (isset($_GET['search']) && !empty($_GET['search'])) {

			$userId = ($this->session->userdata(PREFIX.'userRoleId'))?$this->session->userdata(PREFIX.'userRoleId'):0;
			$isReviewExist = ($userId > 0)?"(SELECT reviewId FROM ch_review where ch_review.status = 0 and ch_review.productId = pd.productId AND ch_review.userId = '".$userId."' LIMIT 0, 1) as isReviewExist,":"";

			$cond = " AND pd.productName like '%".trim($_GET['search'])."%'";

		    $this->outputData['descriptionData'] = $this->Common_model->exequery("SELECT ca.categoryName, sc.subcategoryName, sc.subcategoryName as title, sc.description as description FROM ch_product as pd left join ".tablePrefix."product_category as pc on (pc.categoryType = 'category' and pc.productId = pd.productId) left join ".tablePrefix."category as ca on ca.categoryId = pc.categoryId left join ".tablePrefix."product_category as pcs on (pcs.categoryType = 'subcategory' and pcs.productId = pd.productId) left join ".tablePrefix."subcategory as sc on sc.subcategoryId = pcs.categoryId where pd.status = 0 ".$cond." GROUP BY pd.productId ORDER BY pd.productId desc",1);

		    $this->outputData['subcategoryitemData'] = $this->Common_model->exequery("SELECT sci.*, ca.slug, sc.slug as subcategorySlug, sci.slug as subcategoryItemSlug, (case when sci.imageId != 0 then (SELECT imageName FROM ".tablePrefix."images  WHERE imageId = sci.imageId ) else '' end) as img FROM ch_product as pd left join ".tablePrefix."product_category as pc on (pc.categoryType = 'category' and pc.productId = pd.productId) left join ".tablePrefix."category as ca on ca.categoryId = pc.categoryId left join ".tablePrefix."product_category as pcs on (pcs.categoryType = 'subcategory' and pcs.productId = pd.productId) left join ".tablePrefix."subcategory as sc on sc.subcategoryId = pcs.categoryId left join ".tablePrefix."product_category as pcsi on (pcsi.categoryType = 'subcategoryItem' and pcsi.productId = pd.productId) left join ".tablePrefix."subcategoryitem as sci on sci.subcategoryItemId = pcsi.categoryId where pd.status = 0 ".$cond." GROUP BY pd.productId having img !='' ORDER BY pd.productId desc");

		    $this->outputData['searchData'] = $this->Common_model->exequery("SELECT pd.productId, (CASE WHEN productType = 1 THEN pv.actualPrice ELSE pd.actualPrice END ) as actualPrice, (CASE WHEN productType = 1 THEN pv.salePrice ELSE pd.salePrice END ) as salePrice, pd.isSameDayDelivery, pd.productName, pd.slug, (SELECT brandName FROM `ch_brand` WHERE ch_brand.brandId = pd.brandId) as brandName, (SELECT avg(ch_review.rating) FROM `ch_review` WHERE ch_review.productId = pd.productId) as rating, (SELECT wishlistId FROM `ch_wishlist` WHERE ch_wishlist.productId = pd.productId AND userId = $userId limit 0,1) as isWishlisted, (SELECT count(*) FROM `ch_review` WHERE ch_review.productId = pd.productId) as totalReview, (SELECT imageName FROM ".tablePrefix."images  WHERE imageId = pd.featuredImageId ) as img FROM ch_product as pd inner join ".tablePrefix."product_variable as pv on (pv.status =0 AND pv.variableId =(SELECT variableId FROM ch_product_variable WHERE status = 0 AND qty > 0 AND productId = pd.productId order by actualPrice asc limit 0, 1)) left join ".tablePrefix."product_category as pc on pc.productId = pd.productId where pd.status = 0 ".$cond." GROUP BY pd.productId having img !='' ORDER BY pd.productId desc LIMIT 0, 10");

		    $this->outputData['filterSearchCond'] =$cond;
		    $this->outputData['brandData'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."brand WHERE status = 0 order by brandName asc");
      		$this->outputData['attributeData'] = $this->Common_model->exequery("SELECT ato.*, attributeName FROM `ch_attribute_option` as ato left join ch_attribute as att on att.attributeId = ato.attributeId WHERE ato.status = 0 order by ato.name asc");
		}
		$this->load->viewF('product_view', $this->outputData);
	}
	
	public function detail($slug='') {
		$slug = ($slug)?$slug:'chocolate-cake';
		$cond1 = " AND pd.slug ='".$slug."'";
		$userId = ($this->session->userdata(PREFIX.'userRoleId'))?$this->session->userdata(PREFIX.'userRoleId'):0;
		$isReviewExist = ($userId > 0)?"(SELECT reviewId FROM ch_review where ch_review.status = 0 and ch_review.productId = pd.productId AND ch_review.userId = '".$userId."' LIMIT 0, 1) as isReviewExist,":"";
	   $this->outputData['productData'] = $this->Common_model->exequery("SELECT pd.*, pd.addonsId, (CASE WHEN productType = 1 THEN (SELECT actualPrice FROM ch_product_variable WHERE status = 0 AND productId = pd.productId order by actualPrice asc limit 0, 1) ELSE pd.actualPrice END ) as actualPrice, (CASE WHEN productType = 1 THEN (SELECT salePrice FROM ch_product_variable WHERE status = 0 AND productId = pd.productId order by actualPrice asc limit 0, 1) ELSE pd.salePrice END ) as salePrice, (CASE WHEN productType = 1 THEN (SELECT variableId FROM ch_product_variable WHERE status = 0 AND productId = pd.productId order by actualPrice asc limit 0, 1) ELSE 0 END ) as variableId, (SELECT brandName FROM `ch_brand` WHERE ch_brand.brandId = pd.brandId) as brandName, (SELECT shapeName FROM `ch_shape` WHERE ch_shape.shapeId = pd.shapeId) as shapeName, (SELECT slug FROM `ch_category` WHERE categoryId = (SELECT categoryId FROM `ch_product_category` WHERE productId = pd.productId limit 0,1)) as categorySlug, (SELECT GROUP_CONCAT(categoryId) FROM `ch_product_category` WHERE categoryType = 'category' AND productId = pd.productId limit 0,1) as categoryIds, (SELECT COUNT(*) FROM `ch_product_category` WHERE `categoryType` = 'subcategory' and `categoryId` = 5 AND productId = pd.productId limit 0,1) as kidEyeglasses, (SELECT avg(ch_review.rating) FROM `ch_review` WHERE ch_review.productId = pd.productId) as rating, $isReviewExist (SELECT imageName FROM ".tablePrefix."images  WHERE imageId = pd.featuredImageId ) as img FROM ch_product as pd where pd.status = 0 ".$cond1."",1);

	    if (!empty($this->outputData['productData']) && !empty($this->outputData['productData']->img)) {
 			$this->outputData['galleryData'] = $this->Common_model->exequery("SELECT pi.*, (case when pi.imageId > 0 then (SELECT imageName FROM ".tablePrefix."images  WHERE imageId = pi.imageId ) else '' end) as img FROM ".tablePrefix."product_images as pi WHERE pi.status = 0 AND pi.productId = ".$this->outputData['productData']->productId." having img !='' order by productImageId desc");

 			$this->outputData['variableData'] = $this->Common_model->exequery("SELECT pv.*, (SELECT imageName FROM ".tablePrefix."images  WHERE imageId = pv.imageId ) as img FROM ".tablePrefix."product_variable as pv WHERE pv.status = 0 AND pv.productId = ".$this->outputData['productData']->productId." order by actualPrice asc");
 			$lensCtegoryCond = (isset($this->outputData['productData']->kidEyeglasses) && !empty($this->outputData['productData']->kidEyeglasses))?"  AND categoryId != 1 ":'';
           	$this->outputData['lensCategoryData'] = $this->Common_model->exequery("SELECT * FROM ch_lens_category WHERE status = 0 $lensCtegoryCond order by categoryId desc");

			$this->load->viewF('product_detail_view', $this->outputData);
	    }else{
	    	$condForProduct = "";
	    	$condForItem = " AND ca.slug ='".$slug."'";
	    	$this->outputData['descriptionData'] = $this->Common_model->exequery("SELECT ca.categoryName, ca.categoryId as id, ca.categoryName as title, ca.description as description, ca.extraDescription as extraDescription, ca.bannerTitle, ca.bannerDescription, ca.bannerImg, ca.metaTitle as metaTitle, ca.metaDescription as metaDescription, ca.keywords as keywords, ca.slug as categorySlug FROM ".tablePrefix."category as ca where ca.status = 0  AND ca.slug ='".$slug."'",1);
	    	if (!isset($this->outputData['descriptionData']->title) || empty($this->outputData['descriptionData']->title)) {
	    		$condForItem = " AND sc.slug ='".$slug."'";
	    		$this->outputData['descriptionData'] = $this->Common_model->exequery("SELECT ca.categoryName, sc.subcategoryName, sc.subcategoryId as id, sc.subcategoryName as title, sc.description as description, sc.extraDescription as extraDescription, sc.bannerTitle, sc.bannerDescription, sc.bannerImg, sc.metaTitle as metaTitle, sc.metaDescription as metaDescription, sc.keywords as keywords, ca.slug as categorySlug, sc.slug as subcategorySlug FROM ".tablePrefix."subcategory as sc left join ".tablePrefix."category as ca on ca.categoryId = sc.categoryId where sc.status = 0  AND sc.slug ='".$slug."'",1);
	    		if (!isset($this->outputData['descriptionData']->title) || empty($this->outputData['descriptionData']->title)) {
	    			$this->outputData['descriptionData'] = $this->Common_model->exequery("SELECT ca.categoryName, sc.subcategoryName, sci.subcategoryItemName, sci.subcategoryItemId as id, sci.subcategoryItemName as title, sci.description as description, sci.extraDescription as extraDescription, sci.bannerTitle, sci.bannerDescription, sci.bannerImg, sci.metaTitle as metaTitle, sci.metaDescription as metaDescription, sci.keywords as keywords, ca.slug as categorySlug, sc.slug as subcategorySlug, sci.slug as subcategoryItemSlug FROM ".tablePrefix."subcategoryitem as sci left join ".tablePrefix."category as ca on ca.categoryId = sci.categoryId left join ".tablePrefix."subcategory as sc on sc.subcategoryId = sci.subcategoryId where sci.status = 0 AND sci.slug ='".$slug."'",1);
	    			if(isset($this->outputData['descriptionData']->title) && !empty($this->outputData['descriptionData']->title))
	    				$condForProduct = " AND pc.categoryType = 'subcategoryItem' AND pc.categoryId = '".$this->outputData['descriptionData']->id."'";
	    		}else
	    			$condForProduct = " AND pc.categoryType = 'subcategory' AND pc.categoryId = '".$this->outputData['descriptionData']->id."'";
	    	}else
	    		$condForProduct = " AND pc.categoryType = 'category' AND pc.categoryId = '".$this->outputData['descriptionData']->id."'";


	    	if(isset($this->outputData['descriptionData']->title) && !empty($this->outputData['descriptionData']->title)){
	        	$this->outputData['title'] = $this->outputData['descriptionData']->metaTitle;
	        	$this->outputData['description'] = $this->outputData['descriptionData']->metaDescription;
	        	$this->outputData['keyword'] = $this->outputData['descriptionData']->keywords;

        		$this->outputData['subcategoryitemData'] = $this->Common_model->exequery("SELECT sci.*, ca.slug, sc.slug as subcategorySlug, sci.slug as subcategoryItemSlug, (case when sci.imageId != 0 then (SELECT imageName FROM ".tablePrefix."images  WHERE imageId = sci.imageId ) else '' end) as img FROM ".tablePrefix."subcategoryitem as sci left join ".tablePrefix."category as ca on ca.categoryId = sci.categoryId left join ".tablePrefix."subcategory as sc on sc.subcategoryId = sci.subcategoryId WHERE sci.status = 0 ".$condForItem." having img !='' order by subcategoryItemId desc");

	    		$this->outputData['searchData'] = $this->Common_model->exequery("SELECT pd.productId, (CASE WHEN productType = 1 THEN pv.actualPrice ELSE pd.actualPrice END ) as actualPrice, (CASE WHEN productType = 1 THEN pv.salePrice ELSE pd.salePrice END ) as salePrice, pd.isSameDayDelivery, pd.productName, pd.slug, (SELECT brandName FROM `ch_brand` WHERE ch_brand.brandId = pd.brandId) as brandName, (SELECT avg(ch_review.rating) FROM `ch_review` WHERE ch_review.productId = pd.productId) as rating, (SELECT wishlistId FROM `ch_wishlist` WHERE ch_wishlist.productId = pd.productId AND userId = $userId limit 0,1) as isWishlisted, (SELECT count(*) FROM `ch_review` WHERE ch_review.productId = pd.productId) as totalReview, (SELECT imageName FROM ".tablePrefix."images  WHERE imageId = pd.featuredImageId ) as img FROM ch_product as pd inner join ".tablePrefix."product_variable as pv on (pv.status =0 AND pv.variableId =(SELECT variableId FROM ch_product_variable WHERE status = 0 AND qty > 0 AND productId = pd.productId order by actualPrice asc limit 0, 1)) left join ".tablePrefix."product_category as pc on pc.productId = pd.productId where pd.status = 0 ".$condForProduct." GROUP BY pd.productId having img !='' ORDER BY pd.productId desc LIMIT 0, 24");

	    		$this->outputData['totalProductCount'] = $this->Common_model->exequery("SELECT count(DISTINCT pd.productId) as total FROM ch_product as pd left join ".tablePrefix."product_category as pc on pc.productId = pd.productId where pd.status = 0 AND (SELECT imageName FROM ".tablePrefix."images  WHERE imageId = pd.featuredImageId ) > 0 ".$condForProduct,1);
	    		
				$this->outputData['filterSearchCond'] =$condForProduct;
				
				$this->outputData['brandData'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."brand WHERE status = 0 order by brandName asc");
      			$this->outputData['shapeData'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."shape WHERE status = 0 order by shapeName asc");
      			$this->outputData['attributeData'] = $this->Common_model->exequery("SELECT ato.*, attributeName FROM `ch_attribute_option` as ato left join ch_attribute as att on att.attributeId = ato.attributeId WHERE ato.status = 0 order by ato.name asc");
				$this->load->viewF('product_view', $this->outputData);

			}else
				$this->load->viewF('not_found_view', $this->outputData);
		}


	    
	}
	
	public function login() {
		if ($this->session->userdata(PREFIX.'userAuthId'))
			redirect(BASEURL);
		$this->load->viewF('login_view', $this->outputData);

	}

	// user logout
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

		redirect(BASEURL);
	}

	// public function our_stores(){
	// 	$this->load->viewF('our_stores_view',$this->outputData);
	// }
	public function coupon(){
	    $this->outputData['couponData'] = $this->Common_model->exequery("SELECT * FROM ch_coupon where status = 0 and isVisibleInCouponPage = 1 and endDate >= '".date('Y-m-d')."' ORDER BY couponId desc");
		$this->load->viewF('coupon_view',$this->outputData);
	}


	public function wishlist(){
	    $this->menu     =   10;
	    $this->subMenu  =   101;
		$userId = ($this->session->userdata(PREFIX.'userRoleId'))?$this->session->userdata(PREFIX.'userRoleId'):0;
	    
		$cond1 = " AND wl.userId ='".$userId."'";
		$this->outputData['productData'] = $this->Common_model->exequery("SELECT wl.wishlistId, pd.productId, pd.slug,  (CASE WHEN wl.variableId > 0 THEN CONCAT(pd.productName,' (',vd.variableTitle,')') ELSE pd.productName END) as productName, (CASE WHEN wl.variableId > 0 THEN vd.actualPrice ELSE pd.actualPrice END) as actualPrice, (CASE WHEN wl.variableId > 0 THEN vd.salePrice ELSE pd.salePrice END) as salePrice, wl.addedOn, (SELECT brandName FROM `ch_brand` WHERE ch_brand.brandId = pd.brandId) as brandName, (SELECT imageName FROM ".tablePrefix."images  WHERE imageId = pd.featuredImageId ) as img FROM ch_wishlist as wl LEFT JOIN ch_product as pd on wl.productId = pd.productId left join ".tablePrefix."product_variable as vd on vd.variableId = wl.variableId where pd.status = 0 ".$cond1."");
		$this->load->viewF('wishlist_view',$this->outputData);
	}

	public function privacy_policy(){
		$this->outputData['privacyPageSettingData'] = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'privacy_policy_page'",1);
		$this->load->viewF('privacy_policy_view',$this->outputData);
	}

	public function terms(){
		$this->outputData['termsPageSettingData'] = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'terms_condition_page'",1); 
		$this->load->viewF('terms_conditions_view',$this->outputData);
	}
	public function about(){
		$this->outputData['termsPageSettingData'] = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'about_page'",1); 
		$this->load->viewF('about_view',$this->outputData);
	}


	public function track_order($generatedId = 0) {
		$this->menu		=	1;
		$this->subMenu	=	14;
        $userId =$this->session->userdata(PREFIX.'userRoleId');
        $cond = '';
        if ($userId > 0 && !empty($generatedId)) {
        	$cond = " AND rd.userId = '".$userId."' AND rd.generatedId= '".$generatedId."'";
        }elseif (isset($_REQUEST['orderId']) && !empty($_REQUEST['orderId'])) {
        	$cond = " AND rd.generatedId= '".trim($_REQUEST['orderId'])."'";
        }elseif (isset($_REQUEST['email']) && !empty($_REQUEST['email'])) {
        	$cond = " AND us.email= '".trim($_REQUEST['email'])."'";
        }
		$orderData = (!empty($cond))?$this->Common_model->exequery("SELECT rd.* FROM ".tablePrefix."order as rd left join ch_user as us on us.userId = rd.userId WHERE rd.status < 5".$cond." order by rd.orderId desc",1):array();

		if(isset($_REQUEST['checkOnly']) && !empty($_REQUEST['checkOnly']))
			return $this->output->set_content_type('application/json')->set_output(json_encode(array('valid'=>(!empty($orderData))?true:false, 'generatedId'=>(!empty($orderData))?$orderData->generatedId:'', 'msg'=>'Order details not found.')));
		
		if (!empty($orderData)) {
			$userId = $orderData->userId;
			$orderData->detailData = $this->Common_model->exequery("SELECT od.*, pd.productName, pd.actualPrice, pd.isSameDayDelivery, pd.minHourReqtoDeliver, pd.minMinuteReqtoDeliver, pd.minDayReqtoDeliver,  pv.variableTitle, ds.deliveryType, ds.deliveryAmount, dts.startTime, dts.endTime, pc.pincode, zn.zoneName, (SELECT imageName FROM ch_images  WHERE (CASE WHEN od.variableId > 0 then imageId = pv.imageId  ELSE imageId = pd.featuredImageId end) ) as img, (SELECT reviewId FROM `ch_review` WHERE status= 0 AND productId= od.productId AND userId= $orderData->userId) as reviewId FROM ch_order_detail as od left join ch_delivery_time_slots as dts on dts.timeslotId = od.timeslotId left join ch_delivery_service as ds on ds.deliveryTimeSlotId = od.deliveryTimeSlotId left join ch_pincode as pc on pc.pincodeId = od.pincodeId left join ch_zone as zn on zn.zoneId = od.zoneId left join ch_product as pd on pd.productId = od.productId left join ch_product_variable as pv on pv.variableId = od.variableId  WHERE orderId = '".$orderData->orderId."' ");
				$orderData->addressData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."user_address WHERE addressId = '".$orderData->addressId."'",1);



	    }
	    $this->outputData['orderData'] = $orderData;
		if (empty($this->outputData['orderData'])){
			$this->common_lib->setSessMsg('Order details not found.', 2);
			redirect(($userId > 0)?BASEURL.'/user/order':BASEURL.'/contact');
		}
		$this->load->viewF('user/order_track_view',$this->outputData);
	}


	public function customer_review() {
		$this->menu		=	1;
		$this->subMenu	=	14;

		$this->outputData['reviewData'] = $this->Common_model->exequery("SELECT re.*, us.firstName, (CASE WHEN us.img='' THEN '' else concat('".UPLOADPATH."/user_images/',us.img) END) as img  FROM ch_review as re left join ".tablePrefix."user as us on us.userId = re.userId where re.status = 0 HAVING img != '' order by re.reviewId desc limit 0, 20");
		$this->load->viewF('review_view',$this->outputData);
	}

	public function setnewpassword($code='') {
		$name="";
		$customerDate=array();
		$isExist = $this->Common_model->selRowData("ch_auths","authId,roleId,status","status = 0 and verificationCode = '".$code."'");
		$status=(isset($isExist->authId) && !empty($isExist->authId))? 'notset':'notFound';
		if($status=='notset'){
			$customerDate = $this->Common_model->selRowData("ch_user","email,firstName","userId = '".$isExist->roleId."' AND status = 0");
			if(isset($customerDate->customerFirstName) && !empty($customerDate->customerFirstName))
				$name=$customerDate->customerFirstName;
		}
		if (isset($_POST['password']) && !empty($_POST['password']) && isset($isExist->authId) && !empty($isExist->authId)) {
                $updateStatus   =   $this->Common_model->update("ch_auths",array('password'=>md5($_POST['password']),'verificationCode'=>''),"authId = '".$isExist->authId."' AND status = 0");

                if($updateStatus){
                	$status = 'passwordset';
                	
                	if (isset($customerDate->email) && !empty($customerDate->email)) {
	                    //Send welcome email
	                    $settings = array();
	                    $settings["template"]               =   "password_changed_tpl.html";
	                    $settings["email"]                  =   $customerDate->email;
	                    $settings["subject"]                =   "Chashma4u | Password has been changed";
	                    $contentarr['[[[USERNAME]]]']       =   $customerDate->email;
	                    $contentarr['[[[PASSWORD]]]']       =   $_POST['password'];
	                    $contentarr['[[[LOGINURL]]]']       =   BASEURL;
	                    $settings["contentarr"]             =   $contentarr;
	                    $this->common_lib->sendMail($settings);
	                }
                }
		}

		$this->outputData['name']=$name;
		$this->outputData['status']  = $status;
		$this->outputData['code']  = $code;
		$this->load->viewF('set_new_password_view',$this->outputData);
	}
	
	public function not_found() {
		$this->load->viewF('not_found_view', $this->outputData);
	}

}
