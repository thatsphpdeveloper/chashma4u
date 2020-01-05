<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Commonajax extends CI_Controller {



	public $outputData 	= array();

	public $langSuffix = '';

	

	public function __construct(){

		parent::__construct();

		//Check login authentication & set public veriables

		$this->session->set_userdata(PREFIX.'sessDashboard', "admin");

		$this->common_lib->setSessionVariables();

		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');

	}

	

	// Skwoll - Ajax landing page

	public function index(){

		$action = '';

		$action = @$_POST['action'];

		$return = array("valid" => false, "data" => array(), "msg" => "UnAuthorised Access!");

		if( $action == "addLensCategory" ) 
			$return =  $this->addLensCategory( $_POST, $_FILES );
		else if( $action == "getLensCategoryList" ) 
			$return =  $this->lensCategoryList( $_POST );
		if( $action == "addLens" ) 
			$return =  $this->addLens( $_POST, $_FILES );
		else if( $action == "getLensList" ) 
			$return =  $this->lensList( $_POST );
		else if( $action == "addBrand" ) 
			$return =  $this->AddBrand( $_POST);
		else if( $action == "getBrandList" ) 
			$return =  $this->brandList( $_POST );
		else if( $action == "addShape" ) 
			$return =  $this->AddShape( $_POST);
		else if( $action == "getShapeList" ) 
			$return =  $this->shapeList( $_POST );
		else if( $action == "addAttribute" ) 
			$return =  $this->AddAttribute( $_POST);
		else if( $action == "addAttributeOption")
			$return = $this->addAttributeOption($_POST);
		else if( $action == "getAttributeList" ) 
			$return =  $this->attributeList( $_POST );
		else if( $action == "getAttributeOptionList" ) 
			$return =  $this->attributeOptionList( $_POST );
		else if( $action == "addCategory" ) 
			$return =  $this->AddCategory( $_POST, $_FILES );
		else if( $action == "addSubCategory")
			$return = $this->AddSubCategory($_POST, $_FILES);
		else if( $action == "addSubCategoryItem")
			$return = $this->AddSubCategoryItem($_POST, $_FILES);
		else if( $action == "addProduct")
			$return = $this->addProduct($_POST, $_FILES);
		else if( $action == "getCategoryList" ) 
			$return =  $this->categoryList( $_POST );
		else if( $action == "getSubCategoryList" ) 
			$return =  $this->subcategoryList( $_POST );
		else if( $action == "getSubCategoryItemList" ) 
			$return =  $this->subcategoryItemList( $_POST );
		else if( $action == "getProductList" ) 
			$return = $this->productList($_POST);
		else if( $action == "getAddonsList" ) 
			$return = $this->getAddonsList($_POST);
		else if($action == "addAddons")
			$return = $this->addAddons($_POST, $_FILES);	
		else if( $action == "GetTodaydealList" ) 
			$return = $this->todaydealList($_POST);		
		else if($action == "getsubcategoryName")
			$return =  $this->getsubCategoryName( $_POST['categoryId'] );
		else if($action == "getsubcategoryItemName")
			$return =  $this->getsubCategoryItemName( $_POST['subcategoryId'] );
		else if($action == "gettabSubRecords")
			$return = $this->getTabSubRecords($_POST);
		else if($action == "gettabSubItemRecords")
			$return = $this->getTabSubItemRecords($_POST);	
		/******************************** Zone Section *****************************/
		else if($action == "addZone" )
			$return = $this->AddZone($_POST, $_FILES);
		else if($action == "addZoneCSV" )
			$return = $this->addZoneCSV();
		else if( $action == "getZoneList" ) 
			$return =  $this->zoneList( $_POST );
		else if( $action == "addPinCode" ) 
			$return =  $this->addPinCode( $_POST );
		else if( $action == "copyPincode" ) 
			$return =  $this->copyPincode( $_POST );
		else if($action == "addPincodeCSV" )
			$return = $this->addPincodeCSV();
		else if( $action == "getPinCodeList" )
			$return = $this->getPinCodeList( $_POST );
		else if( $action == "copyZoneDelivery" )
			 $return = $this->copyZoneDelivery( $_POST );
		/******************************** End Zone Section *************************/
		/******************************** Order Section *****************************/
		
		else if($action == "orderHistory" )
			$return = $this->orderHistory();
		else if($action == "visitorHistory" )
			$return = $this->visitorHistory();
		else if($action == "changeOrderStatus" )
			$return = $this->changeOrderStatus();
		else if($action == "exportOrderCsv")
			$return =  $this->exportOrderCsv();
		/******************************** End Order Section *************************/
		/******************************** Vendor Section *****************************/
		else if($action == "addVendor" )
			$return = $this->addVendor($_POST, $_FILES);
		else if( $action == "getVendorList" ) 
			$return = $this->vendorList($_POST);	
		/******************************** End Order Section *************************/
		/******************************** User Section *****************************/
		else if($action == "addUser" )
			$return = $this->addUser($_POST, $_FILES);
		else if( $action == "getUserList" ) 
			$return = $this->userList($_POST);
		else if($action == "addShareMoment" )
			$return = $this->addShareMoment($_POST, $_FILES);
		else if($action == "getShareMomentList" )
			$return = $this->getShareMomentList($_POST);	
		/******************************** End User Section *************************/
		/******************************** Employee Section *****************************/
		else if($action == "addEmployee" )
			$return = $this->addEmployee($_POST, $_FILES);
		else if( $action == "GetEmployeeList" ) 
			$return = $this->employeeList($_POST);	
		/******************************** End Order Section *************************/
		/******************************** Vendor Section *****************************/
		else if($action == "addRole" )
			$return = $this->addRole($_POST);
		else if($action == "updateRolePermision" )
			$return = $this->updateRolePermision();
		else if( $action == "GetRoleList" ) 
			$return = $this->roleList($_POST);	
		/******************************** End Order Section *************************/
		/******************************** Common Service *****************************/
		else if( $action == "changeStatus" )
			$return = $this->changeStatus($this->input->post('status'));
		
		else if( $action == "deleteRecord" )
			$return = $this->changeStatus(2);
		
		/******************************** End Common Service *************************/
		
		/******************************** Get Single Table Records *******************/
		else if($action == "gettabRecords")
			$return =  $this->getTabRecords( $_POST );

		/******************************** End Single Table Records *******************/

		else if($action=="update_login_password")
			$return=$this->updatePassword($_POST);		
		else if($action == "editProfile" )
			$return = $this->editProfile($_POST, $_FILES);
		else if($action == "addUpdateSetting" )
			$return = $this->addUpdateSetting($_POST, $_FILES);
		else if($action == "addFrontSlider" )
			$return = $this->addFrontSlider($_POST, $_FILES);
		else if($action == "getSliderList" )
			$return = $this->getSliderList();
		else if($action == "addShakingCategory" )
			$return = $this->addShakingCategory($_POST, $_FILES);
		else if($action == "getShakingCategoryList" )
			$return = $this->getShakingCategoryList();
		else if($action == "addBenefit" )
			$return = $this->addBenefit($_POST, $_FILES);
		else if($action == "getBenefitList" )
			$return = $this->getBenefitList();
		else if($action == "addSaleBanner" )
			$return = $this->addSaleBanner($_POST, $_FILES);
		else if($action == "getPhotoGalleryList" )
			$return = $this->getPhotoGalleryList();
		else if($action == "addPhotoGallery" )
			$return = $this->addPhotoGallery($_POST, $_FILES);
		else if($action == "getSaleBannerList" )
			$return = $this->getSaleBannerList();
		else if($action == "addUpdateFranchiseSetting" )
			$return = $this->addUpdateFranchiseSetting($_POST, $_FILES);
		else if($action == "addUpdateFooterSetting" )
			$return = $this->addUpdateFooterSetting($_POST);
		else if($action == "addFrontSocialIcons" )
			$return = $this->addFrontSocialIcons($_POST, $_FILES);
		else if($action == "getFrontSocialIconsList" )
			$return = $this->getFrontSocialIconsList();
		else if($action == "addUpdateCorporateSetting")
			$return = $this->addUpdateCorporateSetting($_POST, $_FILES);
		else if($action == "addUpdateTermsSetting")
			$return = $this->addUpdateTermsSetting($_POST);
		else if($action == "addUpdatePolicySetting")
			$return = $this->addUpdatePolicySetting($_POST);
		else if($action == "addUpdateAboutSetting")
			$return = $this->addUpdateAboutSetting($_POST);
		else if($action == "addUpdateOrderSetting")
			$return = $this->addUpdateOrderSetting($_POST);


		/******************************** Vendor Section *****************************/
		else if($action == "addUser" )
			$return = $this->addUser($_POST, $_FILES);
		else if($action == "getUserList")
		    $return = $this->userList($_POST);		
		/******************************** End Order Section *************************/

		/******************************** Blog Section *****************************/
		else if($action == "addBlog" )
			$return =  $this->addBlog($_POST, $_FILES);	
		else if( $action == "GetBlogList" ) 
			$return = $this->blogList($_POST);
		else if( $action == "GetBlogCommentsList" ) 
			$return = $this->GetBlogCommentsList($_POST);
		/******************************** End Blog Section *************************/
		/***********************Frenchise section **********************************/
		else if($action=="addFrenchise")
			$return = $this->addFrenchise($_POST);
		/********************** End Frenchise section *******************************/

		/***********************Review section **********************************/
		else if($action =="addReview")
			$return = $this->addReview($_POST);
		else if($action=="getReviewList")
			$return = $this->ReviewList($_POST);
		else if($action=="newReviewList")
			$return = $this->newReviewList($_POST);
		/********************** End Review section *******************************/
		/******************************** Tag Section *****************************/
		else if($action == "addTag" )
			$return = $this->AddTag($_POST);
		else if( $action == "getTagList" ) 
			$return =  $this->tagList( $_POST );
		/******************************** End Tag Section **************************/
		/******************************** Coupon Section *****************************/
		else if($action == "addCoupon" )
			$return = $this->addCoupon($_POST);
		else if( $action == "getCouponList" ) 
			$return =  $this->couponList( $_POST );
		/******************************** End Coupon Section **************************/
		/******************************** Coupon Section *****************************/
		else if($action == "addMenu" )
			$return = $this->addMenu($_POST);
		else if($action == "addSubMenu" )
			$return = $this->addSubMenu($_POST);
		else if($action == "addSubMenuItem" )
			$return = $this->addSubMenuItem($_POST);
		else if($action == "getsubmenu" )
			$return = $this->getsubmenu($_POST['menuId']);
		else if($action == "updateMenuSetting" )
			$return = $this->updateMenuSetting($_POST);
		else if($action == "editSubmenu" )
			$return = $this->editSubmenu($_POST);
		else if($action == "editSubmenuItem" )
			$return = $this->editSubmenuItem($_POST);
		/******************************** End Coupon Section **************************/

        /*****************************Start Enquiry********************************/
        
		else if($action=="GetFrenchiseEnquiryList")
			$return = $this->GetFrenchiseEnquiryList($_POST);
		else if($action=="GetCorporateEnquiryList")
			$return = $this->GetCorporateEnquiryList($_POST);
		else if($action=="GetContactEnquiryList")
			$return = $this->GetContactEnquiryList($_POST);
		/*****************************End Enquiry********************************/


		else if($action == "getAdminNotification" )
			$return = $this->getAdminNotification($_POST);
		else if($action == "GetNotificationList" )
			$return = $this->GetNotificationList($_POST);

		else if($action == "getTimeSlotOfDate")
			$return = $this->getTimeSlotOfDate();

		else if($action == "updateOrderDetails")
			$return = $this->updateOrderDetails($_POST, $_FILES);
		else if($action == "updateAddress")
			$return =  $this->updateAddress();
		else if($action == "getDashboardfilterData")
			$return =  $this->getDashboardfilterData();

		// create new order
		else if($action == "searchProduct")
			$return =  $this->searchProduct();
		else if($action == "getProductData")
			$return =  $this->getProductData();

		$this->output->set_content_type('application/json')->set_output(json_encode($return));



	}


	/****************************** Common Service ************************/

	function changeStatus($status = 0){

		$updateStatus = 0;

		$permissionArr = array('can_manage_all_'.$this->input->post('tab'),'can_edit_'.$this->input->post('tab'));
		$table = tablePrefix.$this->input->post('tab');
		$queryData = array('status' => $status);
		$cond = $this->input->post('tab')."Id ='".$this->input->post('id')."'";

		if( $this->input->post('tab')  == 'category' || $this->input->post('tab')  == 'lens_category'){
			$permissionArr = array('can_manage_all_product_category','can_edit_product_category');
			$cond = "categoryId =".$this->input->post('id');
		}
		elseif( $this->input->post('tab')  == 'todaydeal'){
			$permissionArr = array('can_manage_all_today_deal','can_edit_today_deal');
			$cond = "todaydealId =".$this->input->post('id');
		}
		elseif( $this->input->post('tab')  == 'shared_moment'){
			$permissionArr = array('can_manage_all_setting','can_edit_setting');
			$cond = "imageId =".$this->input->post('id');
		}
		elseif( $this->input->post('tab')  == 'tag'){
			$table = tablePrefix.'tags';
		}
		elseif( $this->input->post('tab')  == 'addons'){
			$permissionArr = array('can_manage_all_product','can_edit_product');
			$table = tablePrefix.'product_addons';
		}
		elseif( $this->input->post('tab')  == 'blog_comment'){
			$permissionArr = array('can_manage_all_blog','can_edit_blog');
			$cond = "commentId =".$this->input->post('id');
		}
		elseif( $this->input->post('tab') == 'front_page_slider'){
			$permissionArr = array('can_manage_all_setting','can_edit_setting');
			$cond = "sliderId =".$this->input->post('id');
		}
		elseif( $this->input->post('tab') == 'front_page_shaking_category'){
			$permissionArr = array('can_manage_all_setting','can_edit_setting');
			$cond = "categoryId =".$this->input->post('id');
		}
		elseif( $this->input->post('tab') == 'front_page_benefit'){
			$permissionArr = array('can_manage_all_setting','can_edit_setting');
			$cond = "benefitId =".$this->input->post('id');
		}
		elseif( $this->input->post('tab') == 'front_page_sale_banner'){
			$permissionArr = array('can_manage_all_setting','can_edit_setting');
			$cond = "bannerId =".$this->input->post('id');
		}
		elseif( $this->input->post('tab') == 'front_page_photo_gallery'){
			$permissionArr = array('can_manage_all_setting','can_edit_setting');
			$cond = "galleryId =".$this->input->post('id');
		}
		elseif( $this->input->post('tab') == 'corporate_enquiry'){
			$permissionArr = array('can_manage_all_enquiry','can_edit_enquiry');
			$cond = "corporateId =".$this->input->post('id');
		}
		elseif( $this->input->post('tab') == 'fanchise_enquiry'){
			$permissionArr = array('can_manage_all_enquiry','can_edit_enquiry');
			$cond = "enquiryId =".$this->input->post('id');
		}
		elseif( $this->input->post('tab') == 'notification'){
			$permissionArr = array('can_manage_all_notification','can_edit_notification');
			$queryData = array('status' => 3);
		}
		elseif( $this->input->post('tab') == 'product-gallery-image'){
			$permissionArr = array('can_manage_all_product','can_edit_product');
			$cond = "productImageId =".$this->input->post('id');
			$table = 'ch_product_images';
			
		}

		if(!empty($permissionArr) && !empty($table) && !empty($queryData) && !empty($cond)){
			$rolePermission = $this->common_lib->checkRolePermission($permissionArr,0);
			if($rolePermission['valid'])
				$updateStatus = $this->Common_model->update($table, $queryData, $cond);
			else
				return $rolePermission;
		}

		if( $updateStatus )
			return array("valid" => true, "data" => array(), "msg" => "Status updated successfully!");
		else 
			return array("valid" => false, "data" => array(), "msg" => "Something Went Wrong");
	}


	// function deleteRecord(){

	// 	$updateStatus = 0;

	// 	$permissionArr = array('can_manage_all_'.$this->input->post('tab'),'can_edit_'.$this->input->post('tab'));
	// 	$table = tablePrefix.$this->input->post('tab');
	// 	$queryData = array('status' => 2);
	// 	$cond = $this->input->post('tab')."Id ='".$this->input->post('id')."'";

	// 	if( $this->input->post('tab')  == 'category'){
	// 		$permissionArr = array('can_manage_all_product_category','can_edit_product_category');
	// 		$cond = "categoryId =".$this->input->post('id');
	// 	}
	// 	elseif( $this->input->post('tab')  == 'todaydeal'){
	// 		$permissionArr = array('can_manage_all_today_deal','can_edit_today_deal');
	// 		$cond = "todaydealId =".$this->input->post('id');
	// 	}
	// 	elseif( $this->input->post('tab')  == 'shared_moment'){
	// 		$permissionArr = array('can_manage_all_setting','can_edit_setting');
	// 		$cond = "imageId =".$this->input->post('id');
	// 	}
	// 	elseif( $this->input->post('tab')  == 'tag'){
	// 		$table = tablePrefix.'tags';
	// 	}
	// 	elseif( $this->input->post('tab')  == 'addons'){
	// 		$permissionArr = array('can_manage_all_product','can_edit_product');
	// 		$table = tablePrefix.'product_addons';
	// 	}
	// 	elseif( $this->input->post('tab')  == 'blog_comment'){
	// 		$permissionArr = array('can_manage_all_blog','can_edit_blog');
	// 		$cond = "commentId =".$this->input->post('id');
	// 	}
	// 	elseif( $this->input->post('tab') == 'front_page_slider'){
	// 		$permissionArr = array('can_manage_all_setting','can_edit_setting');
	// 		$cond = "sliderId =".$this->input->post('id');
	// 	}

	// 	if(!empty($permissionArr) && !empty($table) && !empty($queryData) && !empty($cond)){
	// 		$rolePermission = $this->common_lib->checkRolePermission($permissionArr,0);
	// 		if($rolePermission['valid'])
	// 			$updateStatus = $this->Common_model->update($table, $queryData, $cond);
	// 		else
	// 			return $rolePermission;
	// 	}

	// 	if( $updateStatus )
	// 		return array("valid" => true, "data" => array(), "msg" => "Status updated successfully!");
	// 	else 
	// 		return array("valid" => false, "data" => array(), "msg" => "Something Went Wrong");
	// }
	// function deleteRecord01($data){
	// 	$tab = @$data['tab'];
	// 	$id = @$data['id'];
	// 	$updateStatus = 0;
	// 	if( $tab == 'category' ){
	// 		$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product_category','can_delete_product_category'],0);
	// 		if($rolePermission['valid'])
	// 			$updateStatus = $this->Common_model->update(tablePrefix.$tab, array('status' => 2), "categoryId =".$id);
	// 		else
	// 			return $rolePermission;
	// 	}
	// 	else if( $tab == 'todaydeal' ){
	// 		$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_today_deal','can_delete_today_deal'],0);
	// 		if($rolePermission['valid'])
	// 			$updateStatus = $this->Common_model->update(tablePrefix.$tab, array('status' => 2), "todaydealId =".$id);
	// 		else
	// 			return $rolePermission;
	// 	}
	// 	else if ($tab == 'product-gallery-image'){
	// 		$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product','can_delete_product'],0);
	// 		if($rolePermission['valid'])
	// 			$updateStatus = $this->Common_model->update(tablePrefix.'product_images', array('status' => 2), "productImageId =".$id);
	// 		else
	// 			return $rolePermission;
	// 	}
	// 	else if ($tab == 'tag'){
	// 		$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_tag','can_delete_tag'],0);
	// 		if($rolePermission['valid'])
	// 			$updateStatus = $this->Common_model->update(tablePrefix.'tags', array('status' => 2), "tagId =".$id);
	// 		else
	// 			return $rolePermission;
	// 	}
	// 	else if ($tab == 'addons'){
	// 		$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product','can_delete_product'],0);
	// 		if($rolePermission['valid'])
	// 			$updateStatus = $this->Common_model->update(tablePrefix.'product_addons', array('status' => 2), "addonsId =".$id);
	// 		else
	// 			return $rolePermission;
	// 	}
	// 	else if ($tab == 'blog_comment'){
	// 		$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_blog','can_delete_blog'],0);
	// 		if($rolePermission['valid'])
	// 			$updateStatus = $this->Common_model->update(tablePrefix.'blog_comment', array('status' => 2), "commentId =".$id);
	// 		else
	// 			return $rolePermission;
	// 	}
	// 	else{

	// 		$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_'.$tab,'can_delete_'.$tab],0);
	// 		if($rolePermission['valid'])
	// 			$updateStatus = $this->Common_model->update(tablePrefix.$tab, array('status' => 2), $tab."Id =".$id);
	// 		else
	// 			return $rolePermission;
	// 	}
	// 	if( $updateStatus )
	// 		return array("valid" => true, "data" => array(), "msg" => "Status updated successfully!");
	// 	else 
	// 		return array("valid" => false, "data" => array(), "msg" => "Something Went Wrong");
	// }
	/****************************** End Common Service ********************/

	/******************************** Get Single Table Records *******************/
	function getTabRecords($data) {
		$keys = "";
		if($data['tab'] == 'category' || $data['tab'] == 'zone')
			$keys = ", (case when tb.imageId != 0 then (SELECT concat('".UPLOADPATH."/images/', imageName) FROM ".tablePrefix."images  WHERE imageId = tb.imageId ) else '' end) as img  ";
		else if($data['tab'] == 'lens_category')
			$keys = ", (case when img != '' then concat('".UPLOADPATH."/category_images/', img) else '".NOIMAGE."' end) as img  ";
		$singleTabRecords = $this->Common_model->exequery("SELECT tb.* $keys FROM ".tablePrefix.$data['tab']." as tb WHERE tb.".$data['key']." = '".$data['value']."'", true);
		if( $singleTabRecords ) 
			return array("valid" => true, "data" => $singleTabRecords, "msg" => "Records Info");
		else
			return array("valid" => false, "data" => array(), "msg" => "No Records Founds");
	}	
	/******************************** End Single Table Records *******************/

	/******************************** Utkarsh Review*****************************/
	public function getsubCategoryName($categoryid) {
		$categorydata = $this->Common_model->exequery("SELECT subcategoryName, subcategoryId, slug FROM ".tablePrefix."subcategory WHERE categoryId= ".$categoryid." ");
		return ( $categorydata ) ? $categorydata : array();
	}
	public function getsubCategoryItemName($subcategoryid) {
		$subcategorydata = $this->Common_model->exequery("SELECT subcategoryItemName, subcategoryItemId, slug FROM ".tablePrefix."subcategoryitem WHERE subcategoryId= ".$subcategoryid." ");
		return ( $subcategorydata ) ? $subcategorydata : array();
	}
	public function getsubmenu($menuId) {
		$submenudata = $this->Common_model->exequery("SELECT title, submenuId FROM ".tablePrefix."submenu WHERE menuId= ".$menuId." AND status !=2  ");
		return ( $submenudata ) ? $submenudata : array();
	}
	function getTabSubItemRecords($data) {
		$cusdata = $this->Common_model->exequery("SELECT tb.*, (case when tb.imageId != 0 then (SELECT concat('".UPLOADPATH."/images/', imageName) FROM ".tablePrefix."images  WHERE imageId = tb.imageId ) else '' end) as img FROM ".tablePrefix.$data['tab']." as tb WHERE tb.".$data['key']." = '".$data['value']."'", true);
		if ($cusdata) {
			if($data['tab'] =='role'){
				$data['roleDropDown'] = '<option value="">Select Role</option>'.$this->common_lib->getDropDown("SELECT roleId as id, role as name FROM ".tablePrefix."role WHERE status !='2' AND ".$data['key']." = '".$data['value']."' order by role asc", '');
			}
			else{
				$data['categoryDropDown'] = '<option value="">Choose Category</option>'.$this->common_lib->getDropDown("SELECT categoryId as id, categoryName as name FROM ".tablePrefix."category WHERE status !='2' order by categoryName asc", $cusdata->categoryId);
				$data['subCategoryDropDown'] = '<option value="">Choose SubCategory</option>'.$this->common_lib->getDropDown("SELECT subcategoryId as id, subcategoryName as name FROM ".tablePrefix."subcategory WHERE status !='2' AND categoryId='".$cusdata->categoryId."' order by subcategoryName asc", $cusdata->subcategoryId);
				$data['info'] = $cusdata;
			}
			return array("valid" => true, "data" => $data, "msg" => "Records Founds");
		}
		else
			return array("valid" => false, "data" => array(), "msg" => "No Records Founds");		
	}
	function getTabSubRecords($data) {
		$singleTabRecords = $this->Common_model->exequery("SELECT tb.*, (case when tb.imageId != 0 then (SELECT concat('".UPLOADPATH."/images/', imageName) FROM ".tablePrefix."images  WHERE imageId = tb.imageId ) else '' end) as img FROM ".tablePrefix.$data['tab']." as tb WHERE tb.".$data['key']." = '".$data['value']."'", true);
		if( $singleTabRecords ) 
			return array("valid" => true, "data" => $singleTabRecords, "msg" => "Records Info");
		else
			return array("valid" => false, "data" => array(), "msg" => "No Records Founds");
	}
	/******************************* End Utakarsh *******************************/
	/****************************** Product Section ************************/


	function addLensCategory($data, $filedata) {

		if(isset($data['categoryName']) && !empty($data['categoryName'])) {
			$categoryId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';

			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product_category',($categoryId)?'can_edit_product_category':'can_create_product_category'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			$insertData['categoryName'] = $data['categoryName'];

			$condArray = array("status != " => "2", "categoryName" => $data['categoryName']);
			if( $categoryId > 0 )
				$condArray['categoryId != '] = $categoryId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."lens_category", "categoryId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Category Already Exist!");
			if(isset($data['slugName']) && !empty($data['slugName'])) {
				$insertData['slug'] = $data['slugName'];
				$condArray = array("status != " => "2", "slug" => $data['slugName']);
				if( $categoryId > 0 )
					$condArray['categoryId != '] = $categoryId; 

				$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."lens_category", "categoryId", $condArray);
				if( $checkExits )
					return array("valid" => false, "data" => array(), "msg" => "Slug Already Exist!");
			}
			else{
					$categorySlug = $this->common_lib->create_unique_slug(trim($data['categoryName']),tablePrefix."lens_category","slug",$categoryId,"categoryId",$counter=0);
					$insertData['slug']			 =   $categorySlug; 
		    }
			
			$insertData['status'] = 0;
			$insertData['addedOn'] = date('Y-m-d H:i:s');

			$imageName = $this->uploadImage("category_images", "uploadIcons" );
			if($imageName) 
				$insertData['img'] = $imageName;

			if( $categoryId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."lens_category", $insertData, "categoryId = ".$categoryId);
			else
				$updateStatus = $this->Common_model->insert(tablePrefix."lens_category", $insertData);

			if( $updateStatus )
				return array("valid" => true, "data" => array(), "msg" => "Category Updated Successfully!");
			else
				return array("valid" => true, "data" => array(), "msg" => "Category Added Successfully!");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Category name is required!");
	}

	function lensCategoryList($data) {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product_category','can_view_product_category'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );

		$columns = array( 0 => "categoryId", 1 => "categoryName", 2 => "status", 3 => "categoryId",4 => "categoryId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(categoryId) as total from ".tablePrefix."lens_category as cat where cat.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT cat.*,  (case when img != '' then concat('".UPLOADPATH."/category_images/', img) else '".NOIMAGE."' end) as icons from ".tablePrefix."lens_category as cat where cat.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (cat.categoryName LIKE  '%".$search."%' OR cat.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(categoryId) as total from ".tablePrefix."lens_category as cat where cat.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['icons'] = ( $row->icons != '' ) ? '<img src="'.$row->icons.'" width="30px" height="30px">' : "";
                $nestedData['categoryName'] = $row->categoryName;
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
                $nestedData['action'] = '<button class="btn btn-icons btn-rounded btn-light editLensCategory" title="Edit" data-id="'.$row->categoryId.'"><i class="fa fa-pencil"></i></button><button onclick="ActivateDeActivateThisRecord(this,\'lens_category\','.$row->categoryId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button><button class="btn btn-icons btn-rounded btn-light deleteCategory" title="Delete Category" onclick="delete_row(this,\'lens_category\','.$row->categoryId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}
	function addLens($data) {

		if(isset($data['lensName']) && !empty($data['lensName'])) {
			$lensId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';

			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product',($lensId)?'can_edit_product':'can_create_product'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			$insertData['categoryId'] = $data['categoryId'];
			$insertData['name'] = $data['lensName'];
			$insertData['lensIndex'] = $data['lensIndex'];
			$insertData['antiReflectiveCoating'] = $data['antiReflectiveCoating'];
			$insertData['actualPrice'] = $data['actualPrice'];
			$insertData['salePrice'] = $data['salePrice'];
			$insertData['scratchResistant'] = isset($data['scratchResistant'])?1:0;
			$insertData['waterDustRepellent'] = isset($data['waterDustRepellent'])?1:0;
			$insertData['uv400Protection'] = isset($data['uv400Protection'])?1:0;
			$insertData['blueLightBlocker'] = isset($data['blueLightBlocker'])?1:0;

			$condArray = array("status != " => "2", "name" => $data['lensName']);
			if( $lensId > 0 )
				$condArray['lensId != '] = $lensId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."lens", "lensId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Lens Already Exist!");
			
			$insertData['status'] = 0;
			$insertData['addedOn'] = date('Y-m-d H:i:s');

			if( $lensId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."lens", $insertData, "lensId = ".$lensId);
			else
				$updateStatus = $this->Common_model->insert(tablePrefix."lens", $insertData);

			if( $updateStatus )
				return array("valid" => true, "data" => array(), "msg" => "Lens Updated Successfully!");
			else
				return array("valid" => true, "data" => array(), "msg" => "Lens Added Successfully!");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Lens name is required!");
	}

	function lensList($data) {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product','can_view_product'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );

		$columns = array( 0 => "name", 1 => "actualPrice", 2 => "categoryId", 3 => "status",4 => "lensId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(lensId) as total from ".tablePrefix."lens as cat where cat.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT cat.*, lc.categoryName from ".tablePrefix."lens as cat left join ch_lens_category as lc on lc.categoryId = cat.categoryId where cat.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (cat.name LIKE  '%".$search."%' OR cat.actualPrice LIKE  '%".$search."%' OR cat.salePrice LIKE  '%".$search."%' OR lc.categoryName LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(lensId) as total from ".tablePrefix."lens as cat left join ch_lens_category as lc on lc.categoryId = cat.categoryId where cat.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['categoryId'] = $row->categoryName;
                $nestedData['name'] = $row->name;
                $nestedData['price'] = ($row->salePrice)?$row->salePrice.' <del>'.$row->actualPrice.'</del>':$row->actualPrice;
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
                $nestedData['action'] = '<button class="btn btn-icons btn-rounded btn-light editLens" title="Edit" data-id="'.$row->lensId.'"><i class="fa fa-pencil"></i></button><button onclick="ActivateDeActivateThisRecord(this,\'lens\','.$row->lensId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button><button class="btn btn-icons btn-rounded btn-light deleteLens" title="Delete lens" onclick="delete_row(this,\'lens\','.$row->lensId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}

	function AddBrand($data) {

		if(isset($data['brandName']) && !empty($data['brandName'])) {
			$brandId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';

			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product_brand',($brandId)?'can_edit_product_brand':'can_create_product_brand'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;


			$condArray = array("status != " => "2", "brandName" => $data['brandName']);
			if( $brandId > 0 )
				$condArray['brandId != '] = $brandId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."brand", "brandId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Brand Already Exist!");

			$insertData['brandName'] = $data['brandName'];

			if( $brandId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."brand", $insertData, "brandId = ".$brandId);
			else{

				$insertData['status'] = 0;
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$updateStatus = $this->Common_model->insert(tablePrefix."brand", $insertData);
			}

			if( $updateStatus )
				return array("valid" => true, "data" => array(), "msg" => "Brand Updated Successfully!");
			else
				return array("valid" => true, "data" => array(), "msg" => "Brand Added Successfully!");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Brand name is required!");
	}

	function brandList($data) {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product_brand','can_view_product_brand'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );

		$columns = array( 0 => "brandName", 1 => "status", 2 => "brandId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(brandId) as total from ".tablePrefix."brand as cat where cat.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT cat.* from ".tablePrefix."brand as cat where cat.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (cat.brandName LIKE  '%".$search."%' OR cat.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(brandId) as total from ".tablePrefix."brand as cat where cat.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['brandName'] = $row->brandName;
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
                //<button class="btn btn-icons btn-rounded btn-light viewCategory" title="View Category" data-id="'.$row->brandId.'"><i class="fa fa-eye"></i></button>
                $nestedData['action'] = '<button class="btn btn-icons btn-rounded btn-light editAttribute" title="Edit" data-id="'.$row->brandId.'"><i class="fa fa-pencil"></i></button><button onclick="ActivateDeActivateThisRecord(this,\'brand\','.$row->brandId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button><button class="btn btn-icons btn-rounded btn-light deleteAttribute" title="Delete Attribute" onclick="delete_row(this,\'brand\','.$row->brandId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}

	function AddShape($data) {

		if(isset($data['shapeName']) && !empty($data['shapeName'])) {
			$shapeId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';

			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product_shape',($shapeId)?'can_edit_product_shape':'can_create_product_shape'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;


			$condArray = array("status != " => "2", "shapeName" => $data['shapeName']);
			if( $shapeId > 0 )
				$condArray['shapeId != '] = $shapeId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."shape", "shapeId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Shape Already Exist!");

			$insertData['shapeName'] = $data['shapeName'];

			if( $shapeId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."shape", $insertData, "shapeId = ".$shapeId);
			else{

				$insertData['status'] = 0;
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$updateStatus = $this->Common_model->insert(tablePrefix."shape", $insertData);
			}

			if( $updateStatus )
				return array("valid" => true, "data" => array(), "msg" => "Shape Updated Successfully!");
			else
				return array("valid" => true, "data" => array(), "msg" => "Shape Added Successfully!");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Shape name is required!");
	}

	function shapeList($data) {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product_shape','can_view_product_shape'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );

		$columns = array( 0 => "shapeName", 1 => "status", 2 => "shapeId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(shapeId) as total from ".tablePrefix."shape as cat where cat.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT cat.* from ".tablePrefix."shape as cat where cat.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (cat.shapeName LIKE  '%".$search."%' OR cat.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(shapeId) as total from ".tablePrefix."shape as cat where cat.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['shapeName'] = $row->shapeName;
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
                //<button class="btn btn-icons btn-rounded btn-light viewCategory" title="View Category" data-id="'.$row->shapeId.'"><i class="fa fa-eye"></i></button>
                $nestedData['action'] = '<button class="btn btn-icons btn-rounded btn-light editAttribute" title="Edit" data-id="'.$row->shapeId.'"><i class="fa fa-pencil"></i></button><button onclick="ActivateDeActivateThisRecord(this,\'shape\','.$row->shapeId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button><button class="btn btn-icons btn-rounded btn-light deleteAttribute" title="Delete Attribute" onclick="delete_row(this,\'shape\','.$row->shapeId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}

	function AddAttribute($data) {

		if(isset($data['attributeName']) && !empty($data['attributeName'])) {
			$attributeId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';

			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product_attribute',($attributeId)?'can_edit_product_attribute':'can_create_product_attribute'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;


			$condArray = array("status != " => "2", "attributeName" => $data['attributeName']);
			if( $attributeId > 0 )
				$condArray['attributeId != '] = $attributeId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."attribute", "attributeId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Attribute Already Exist!");

			$insertData['attributeName'] = $data['attributeName'];

			if( $attributeId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."attribute", $insertData, "attributeId = ".$attributeId);
			else{

				$insertData['status'] = 0;
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$updateStatus = $this->Common_model->insert(tablePrefix."attribute", $insertData);
			}

			if( $updateStatus )
				return array("valid" => true, "data" => array(), "msg" => "Attribute Updated Successfully!");
			else
				return array("valid" => true, "data" => array(), "msg" => "Attribute Added Successfully!");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Attribute name is required!");
	}

	
	function addAttributeOption($data) {
		if(isset($data['name']) && !empty($data['name'])) {
			$optionId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';

			//cheking permission of user
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product_attribute',($optionId)?'can_edit_product_attribute':'can_create_product_attribute'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			$insertData['name'] = $data['name'];
			$insertData['attributeId'] = $data['attributeName'];

			$condArray = array("status != " => "2", "name" => $data['name'],"attributeId" => $data['attributeName']);
			if( $optionId > 0 )
				$condArray['optionId != '] = $optionId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."attribute_option", "optionId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Attribute Option Already Exist!");

	
			if( $optionId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."attribute_option", $insertData, "optionId = ".$optionId);
			else{
				$insertData['status'] = 0;
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$updateStatus = $this->Common_model->insert(tablePrefix."attribute_option", $insertData);
			}

			if( $updateStatus )
				return array("valid" => true, "data" => array(), "msg" => "Attribute Option Updated Successfully!");
			else
				return array("valid" => true, "data" => array(), "msg" => "Attribute Option Added Successfully!");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Attribute Option name is required!");
	}


	function attributeList($data) {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product_attribute','can_view_product_attribute'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );

		$columns = array( 0 => "attributeName", 1 => "status", 2 => "attributeId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(attributeId) as total from ".tablePrefix."attribute as cat where cat.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT cat.* from ".tablePrefix."attribute as cat where cat.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (cat.attributeName LIKE  '%".$search."%' OR cat.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(attributeId) as total from ".tablePrefix."attribute as cat where cat.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['attributeName'] = $row->attributeName;
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
                //<button class="btn btn-icons btn-rounded btn-light viewCategory" title="View Category" data-id="'.$row->attributeId.'"><i class="fa fa-eye"></i></button>
                $nestedData['action'] = '<button class="btn btn-icons btn-rounded btn-light editAttribute" title="Edit" data-id="'.$row->attributeId.'"><i class="fa fa-pencil"></i></button><button onclick="ActivateDeActivateThisRecord(this,\'attribute\','.$row->attributeId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button><button class="btn btn-icons btn-rounded btn-light deleteAttribute" title="Delete Attribute" onclick="delete_row(this,\'attribute\','.$row->attributeId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}
	
	
	function attributeOptionList($data) {

			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product_attribute','can_view_product_attribute'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );

		$columns = array( 0 => "ao.name", 1 => "at.attributeName", 2 => "status",3 => "optionId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(optionId) as total from ".tablePrefix."attribute_option as ao where ao.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT ao.*, at.attributeName from ".tablePrefix."attribute_option as ao left join ".tablePrefix."attribute as at on ao.attributeId = at.attributeId where ao.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (ao.name LIKE  '%".$search."%' OR at.attributeName LIKE  '%".$search."%' OR ao.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(optionId) as total from ".tablePrefix."attribute_option as ao left join ".tablePrefix."attribute as at on ao.attributeId = at.attributeId where ao.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['attributeName'] = $row->attributeName;
                $nestedData['name'] = $row->name;
                
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
				//<button class="btn btn-icons btn-rounded btn-light viewCategory" title="View Category" data-id="'.$row->optionId.'"><i class="fa fa-eye"></i></button
                $nestedData['action'] = '<button class="btn btn-icons btn-rounded btn-light editAttributeOption" title="Edit" data-id="'.$row->optionId.'"><i class="fa fa-pencil"></i></button><button onclick="ActivateDeActivateThisRecord(this,\'attributeOption\','.$row->optionId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button><button class="btn btn-icons btn-rounded btn-light deleteAttributeOption" title="Delete Attribute Option" onclick="delete_row(this,\'attributeOption\','.$row->optionId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}
	function AddCategory($data, $filedata) {

		if(isset($data['categoryName']) && !empty($data['categoryName'])) {
			$categoryId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';

			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product_category',($categoryId)?'can_edit_product_category':'can_create_product_category'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			$insertData['categoryName'] = $data['categoryName'];

			$condArray = array("status != " => "2", "categoryName" => $data['categoryName']);
			if( $categoryId > 0 )
				$condArray['categoryId != '] = $categoryId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."category", "categoryId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Category Already Exist!");
			if(isset($data['slugName']) && !empty($data['slugName'])) {
				$insertData['slug'] = $data['slugName'];
				$condArray = array("status != " => "2", "slug" => $data['slugName']);
				if( $categoryId > 0 )
					$condArray['categoryId != '] = $categoryId; 

				$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."category", "categoryId", $condArray);
				if( $checkExits )
					return array("valid" => false, "data" => array(), "msg" => "Slug Already Exist!");
			}
			else{
					$categorySlug = $this->common_lib->create_unique_slug(trim($data['categoryName']),tablePrefix."category","slug",$categoryId,"categoryId",$counter=0);
					$insertData['slug']			 =   $categorySlug; 
		    }
			$insertData['isNew'] = (isset($data['isNew']) && !empty($data['isNew'])) ? 1 : 0;
			$insertData['description'] = (isset($data['description']) && !empty($data['description'])) ? $data['description'] : '';
			$insertData['extraDescription'] = (isset($data['extraDescription']) && !empty($data['extraDescription'])) ? $data['extraDescription'] : '';
			$insertData['bannerTitle'] = (isset($data['bannerTitle']) && !empty($data['bannerTitle'])) ? $data['bannerTitle'] : '';
			$insertData['bannerDescription'] = (isset($data['bannerDescription']) && !empty($data['bannerDescription'])) ? $data['bannerDescription'] : '';
			$insertData['metaTitle'] = (isset($data['metaTitle']) && !empty($data['metaTitle'])) ? $data['metaTitle'] : '';
			$insertData['metaDescription'] = (isset($data['metaDescription']) && !empty($data['metaDescription'])) ? $data['metaDescription'] : '';
			$insertData['keywords'] = (isset($data['metaKeywords']) && !empty($data['metaKeywords'])) ? $data['metaKeywords'] : '';
			$insertData['addedBY'] = $this->session->userdata(PREFIX."sessAuthId");
			$insertData['status'] = 0;
			$insertData['addedOn'] = date('Y-m-d H:i:s');

			if(isset($filedata) && !empty($filedata)) {
				$fileInfo = $this->common_lib->uploadImageFile($filedata, "images", false, "uploadIcons" );
				if(!empty($fileInfo['filename'])) {
					$imageId = $this->Common_model->insertUnique(tablePrefix."images", array("imageName" => $fileInfo['filename'], "addedBY" => $this->session->userdata(PREFIX."sessAuthId"), "metaTitle" => '', "status" => 0, "addedOn" => date('Y-m-d H:i:s')));
					$insertData['imageId'] = ($imageId) ? $imageId : 0;
				}
			}

			$imageName = $this->uploadImage("category_images", "bannerImg" );
			if($imageName) 
				$insertData['bannerImg'] = $imageName;

			if( $categoryId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."category", $insertData, "categoryId = ".$categoryId);
			else
				$updateStatus = $this->Common_model->insert(tablePrefix."category", $insertData);

			if( $updateStatus )
				return array("valid" => true, "data" => array(), "msg" => "Category Updated Successfully!");
			else
				return array("valid" => true, "data" => array(), "msg" => "Category Added Successfully!");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Category name is required!");
	}

	
	function AddSubCategory($data, $filedata) {
		if(isset($data['subCategoryName']) && !empty($data['subCategoryName'])) {
			$subcategoryId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';

			//cheking permission of user
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product_category',($subcategoryId)?'can_edit_product_category':'can_create_product_category'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			$insertData['subCategoryName'] = $data['subCategoryName'];

			$condArray = array("status != " => "2", "subCategoryName" => $data['subCategoryName'],"categoryId" => $data['categoryName']);
			if( $subcategoryId > 0 )
				$condArray['subcategoryId != '] = $subcategoryId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."subcategory", "subcategoryId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Sub Category Already Exist!");
			if(isset($data['slugName']) && !empty($data['slugName'])) {
				$insertData['slug'] = $data['slugName'];
				$condArray = array("status != " => "2", "slug" => $data['slugName']);
				if( $subcategoryId > 0 )
					$condArray['subcategoryId != '] = $subcategoryId; 

				$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."subcategory", "subcategoryId", $condArray);
				if( $checkExits )
					return array("valid" => false, "data" => array(), "msg" => "Slug Already Exist!");
			}	
			else{
			$categorySlug = $this->common_lib->create_unique_slug(trim($data['subCategoryName']),tablePrefix."subcategory","slug",$subcategoryId,"subcategoryId",$counter=0);
			$insertData['slug']			 =   $categorySlug; }
			$insertData['isNew'] = (isset($data['isNew']) && !empty($data['isNew'])) ? 1 : 0;
			$insertData['description'] = (isset($data['description']) && !empty($data['description'])) ? $data['description'] : '';
			$insertData['extraDescription'] = (isset($data['extraDescription']) && !empty($data['extraDescription'])) ? $data['extraDescription'] : '';
			$insertData['bannerTitle'] = (isset($data['bannerTitle']) && !empty($data['bannerTitle'])) ? $data['bannerTitle'] : '';
			$insertData['bannerDescription'] = (isset($data['bannerDescription']) && !empty($data['bannerDescription'])) ? $data['bannerDescription'] : '';
			$insertData['metaTitle'] = (isset($data['metaTitle']) && !empty($data['metaTitle'])) ? $data['metaTitle'] : '';
			$insertData['metaDescription'] = (isset($data['metaDescription']) && !empty($data['metaDescription'])) ? $data['metaDescription'] : '';
			$insertData['keywords'] = (isset($data['metaKeywords']) && !empty($data['metaKeywords'])) ? $data['metaKeywords'] : '';
			$insertData['categoryId'] = (isset($data['categoryName']) && !empty($data['categoryName'])) ? $data['categoryName'] : ''; 
			$insertData['addedBY'] = $this->session->userdata(PREFIX."sessAuthId");
			$insertData['status'] = 0;
			$insertData['addedOn'] = date('Y-m-d H:i:s');

			if(isset($filedata) && !empty($filedata)) {
				$fileInfo = $this->common_lib->uploadImageFile($filedata, "images", false, "uploadIcons" );
				if(!empty($fileInfo['filename'])) {
					$imageId = $this->Common_model->insertUnique(tablePrefix."images", array("imageName" => $fileInfo['filename'], "addedBY" => $this->session->userdata(PREFIX."sessAuthId"), "metaTitle" => '', "status" => 0, "addedOn" => date('Y-m-d H:i:s')));
					$insertData['imageId'] = ($imageId) ? $imageId : 0;
				}
			}


			$imageName = $this->uploadImage("category_images", "bannerImg" );
			if($imageName) 
				$insertData['bannerImg'] = $imageName;
			
			if( $subcategoryId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."subcategory", $insertData, "subcategoryId = ".$subcategoryId);
			else
				$updateStatus = $this->Common_model->insert(tablePrefix."subcategory", $insertData);

			if( $updateStatus )
				return array("valid" => true, "data" => array(), "msg" => "Subcategory Updated Successfully!");
			else
				return array("valid" => true, "data" => array(), "msg" => "Subcategory Added Successfully!");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Subcategory name is required!");
	}

		
	function AddSubCategoryItem($data, $filedata) {
		if(isset($data['subcategoryItemName']) && !empty($data['subcategoryItemName'])) {
			$subcategoryItemId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
			
			//cheking permission of user
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product_category',($subcategoryItemId)?'can_edit_product_category':'can_create_product_category'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			$insertData['subcategoryItemName'] = $data['subcategoryItemName'];
			
			$condArray = array("status != " => "2", "subcategoryItemName" => $data['subcategoryItemName'],"categoryId" => $data['categoryName'],"subcategoryId" => $data['subcategoryName']);
			if( $subcategoryItemId > 0 )
				$condArray['subcategoryItemId != '] = $subcategoryItemId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."subcategoryitem", "subcategoryItemId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Sub Category Item Already Exist!");
			if(isset($data['slugName']) && !empty($data['slugName'])) {
				$insertData['slug'] = $data['slugName'];
				$condArray = array("status != " => "2", "slug" => $data['slugName']);
				if( $subcategoryItemId > 0 )
					$condArray['subcategoryItemId != '] = $subcategoryItemId; 

				$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."subcategoryitem", "subcategoryItemId", $condArray);
				if( $checkExits )
					return array("valid" => false, "data" => array(), "msg" => "Slug Already Exist!");
			}				
			else{
				$categorySlug = $this->common_lib->create_unique_slug(trim($data['subcategoryItemName']),tablePrefix."subcategoryitem","slug",$subcategoryItemId,"subcategoryItemId",$counter=0);
				$insertData['slug']	 =   $categorySlug;
			}
			$insertData['isNew'] = (isset($data['isNew']) && !empty($data['isNew'])) ? 1 : 0;
			$insertData['description'] = (isset($data['description']) && !empty($data['description'])) ? $data['description'] : '';
			$insertData['extraDescription'] = (isset($data['extraDescription']) && !empty($data['extraDescription'])) ? $data['extraDescription'] : '';
			$insertData['bannerTitle'] = (isset($data['bannerTitle']) && !empty($data['bannerTitle'])) ? $data['bannerTitle'] : '';
			$insertData['bannerDescription'] = (isset($data['bannerDescription']) && !empty($data['bannerDescription'])) ? $data['bannerDescription'] : '';
			$insertData['metaTitle'] = (isset($data['metaTitle']) && !empty($data['metaTitle'])) ? $data['metaTitle'] : '';
			$insertData['metaDescription'] = (isset($data['metaDescription']) && !empty($data['metaDescription'])) ? $data['metaDescription'] : '';
			$insertData['keywords'] = (isset($data['metaKeywords']) && !empty($data['metaKeywords'])) ? $data['metaKeywords'] : '';
			$insertData['categoryId'] = (isset($data['categoryName']) && !empty($data['categoryName'])) ? $data['categoryName'] : '';
			$insertData['subcategoryId'] = (isset($data['subcategoryName']) && !empty($data['subcategoryName'])) ? $data['subcategoryName'] : ''; 
			$insertData['addedBY'] = $this->session->userdata(PREFIX."sessAuthId");
			$insertData['status'] = 0;
			$insertData['addedOn'] = date('Y-m-d H:i:s');

			if(isset($filedata) && !empty($filedata)) {
				$fileInfo = $this->common_lib->uploadImageFile($filedata, "images", false, "uploadIcons" );
				if(!empty($fileInfo['filename'])) {
					$imageId = $this->Common_model->insertUnique(tablePrefix."images", array("imageName" => $fileInfo['filename'], "addedBY" => $this->session->userdata(PREFIX."sessAuthId"), "metaTitle" => '', "status" => 0, "addedOn" => date('Y-m-d H:i:s')));
					$insertData['imageId'] = ($imageId) ? $imageId : 0;
				}
			}

			$imageName = $this->uploadImage("category_images", "bannerImg" );
			if($imageName) 
				$insertData['bannerImg'] = $imageName;

			if( $subcategoryItemId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."subcategoryitem", $insertData, "subcategoryItemId = ".$subcategoryItemId);
			else
				$updateStatus = $this->Common_model->insert(tablePrefix."subcategoryitem", $insertData);

			if( $updateStatus )
				return array("valid" => true, "data" => array(), "msg" => "Subcategory Item Updated Successfully!");
			else
				return array("valid" => true, "data" => array(), "msg" => "Subcategory Item Added Successfully!");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Subcategory Item name is required!");
	}

	function addProduct($data, $filedata) {
		if(isset($data['productName']) && !empty($data['productName'])) {
			$productId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
			// v3print($data); exit;
			
			//cheking permission of user
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product',($productId)?'can_edit_product':'can_create_product'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			$insertData['productName'] = $data['productName'];
			$insertData['brandId'] = $data['brandId'];
			$insertData['shapeId'] = $data['shapeId'];
			if(isset($data['sku']) && !empty($data['sku'])){
				$insertData['sku'] = $data['sku'];
				$condArray = array("status != " => "2", "sku" => $data['sku']);
				if( $productId > 0 )
					$condArray['productId != '] = $productId; 

				$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."product", "productId", $condArray);
				if( $checkExits )
					return array("valid" => false, "data" => array(), "msg" => "SKQ Code Already Exist!");
			}
			else{
				$sku = $this->common_lib->create_unique_sku($productId);
				$insertData['sku']	 =   $sku;
			}
			if(isset($data['slug']) && !empty($data['slug'])){
				$insertData['slug'] = $data['slug'];
				$condArray = array("status != " => "2", "slug" => $data['slug']);
				if( $productId > 0 )
					$condArray['productId != '] = $productId; 

				$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."product", "productId", $condArray);
				if( $checkExits )
					return array("valid" => false, "data" => array(), "msg" => "Slug Already Exist!");
			}
			else{
				$productSlug = $this->common_lib->create_unique_slug(trim($data['productName']),tablePrefix."product","slug",$productId,"productId",$counter=0);
				$insertData['slug']	 =   $productSlug;
			}
			$insertData['videoLink'] = $data['videoLink'];
			$insertData['description'] = $data['description'];
			// $insertData['deliveryinfo'] = $data['deliveryinfo'];
			// $insertData['careinstructions'] = $data['careinstructions'];
			$insertData['actualPrice'] = $data['actualPrice'];
			$insertData['salePrice'] = $data['salePrice'];
			$insertData['addonsId'] = (isset($data['addonsId']) && !empty($data['addonsId']))?implode(',', $data['addonsId']):'';
			$insertData['metaTitle'] = (isset($data['metaTitle']) && !empty($data['metaTitle'])) ? $data['metaTitle'] : '';
			$insertData['metaDescription'] = (isset($data['metaDescription']) && !empty($data['metaDescription'])) ? $data['metaDescription'] : '';
			$insertData['keywords'] = (isset($data['metaKeywords']) && !empty($data['metaKeywords'])) ? $data['metaKeywords'] : '';
			$insertData['addedBY'] = $this->session->userdata(PREFIX."sessAuthId");
			$insertData['status'] = 0;
			$insertData['productType'] = $data['productType'];
			// $insertData['isSameDayDelivery'] = $data['issameDayDelivery'];
			// $insertData['isCod'] = isset($data['isCod'])?1:0;
			// $insertData['isCourierDelivery'] = isset($data['isCourierDelivery'])?1:0;

			// if( $data['issameDayDelivery'] != 0 ){
			// 	$insertData['minHourReqtoDeliver'] =  $data['minHourReqtoDeliver'];
			// 	$insertData['minMinuteReqtoDeliver'] =  $data['minMinuteReqtoDeliver'];
			// }
			// $insertData['minDayReqtoDeliver'] = ( $data['issameDayDelivery'] == 0 ) ? $data['minDayReqtoDeliver']: 0;

			// $insertData['isSpecificDeliverCity'] = $data['deliveryCities'];
			// if($insertData['isSpecificDeliverCity'] == 1) {
			// 	$insertData['deliveryCityId'] = $data['specificCities'];
			// 	$insertData['undeliverCityId'] = '';
			// }
			// else {
			// 	$insertData['deliveryCityId'] = '';
			// 	$insertData['undeliverCityId'] = $data['excludedCities'];
			// }
			// $insertData['undeliverPincodeId'] = $data['excludePinCodes'];
			// if(isset($data['isPhotoReq']) && !empty($data['isPhotoReq'])) {
			// 	$insertData['isPhotoReq'] = 1;
			// 	$insertData['minPhotolen'] = ($data['isPhotoReqInfo'] > 0)?$data['isPhotoReqInfo']:1;
			// }
			// else {
			// 	$insertData['isPhotoReq'] = 0;
			// 	$insertData['minPhotolen'] = 0;
			// }

			// $insertData['isMessageReq'] = isset($data['isMessageReq'])?1:0;
			// $insertData['messagePlaceholder'] = empty($data['messagePlaceholder'])?'Message':$data['messagePlaceholder'];
			// $insertData['showTheProcessWeDo'] = isset($data['showTheProcessWeDo'])?1:0;
			// $insertData['isSpecificDeliverCity'] = $data['deliveryCities'];
			if(isset($filedata) && !empty($filedata)) {
				$fileInfo = $this->common_lib->uploadImageFile($filedata, "images", false, "featuredImage" );
				if(!empty($fileInfo['filename'])) {
					$imageId = $this->Common_model->insertUnique(tablePrefix."images", array("imageName" => $fileInfo['filename'], "addedBY" => 1, "metaTitle" => '', "status" => 0, "addedOn" => date('Y-m-d H:i:s')));
					$insertData['featuredImageId'] = ($imageId) ? $imageId : 0;
				}
			}

			if( $productId > 0 ) {
				$updateStatus = $this->Common_model->update(tablePrefix."product", $insertData, "productId = ".$productId);
				$updateStatus  = ($updateStatus) ? $productId : 0; 
			}
			else {
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$updateStatus = $this->Common_model->insert(tablePrefix."product", $insertData);
			}

			if( $updateStatus ) {
				if( $insertData['productType'] == 1 ) {
					if(isset($data['variationTitle']) && !empty($data['variationTitle'])) {
						$this->Common_model->update(tablePrefix."product_variable", ['status'=>2], "productId =".$updateStatus);
						
						foreach ($data['variationTitle'] as $key => $variableItem) {
							if (!empty($variableItem)) {
								$variableItemData = array("variableTitle" => $variableItem, "color" => $data['color'][$key], "size" => $data['size'][$key], "qty" => $data['qty'][$key], "actualPrice" => $data['variationActualPrice'][$key], "salePrice" => $data['variationSalePrice'][$key], "status" => 0);
								$rgn = @$data['rgn'][$key];
								$variableItemData['rgn'] = "$rgn";
								if(isset($filedata['variationImages']['name'][$key]) && !empty($filedata['variationImages']['name'][$key])) {
									
									$_FILES['images']['name']= $filedata['variationImages']['name'][$key];
						            $_FILES['images']['type']= $filedata['variationImages']['type'][$key];
						            $_FILES['images']['tmp_name']= $filedata['variationImages']['tmp_name'][$key];
						            $_FILES['images']['error']= $filedata['variationImages']['error'][$key];
						            $_FILES['images']['size']= $filedata['variationImages']['size'][$key];
						            $fileExtsion = $_FILES['images']['name'];//end(explode('.',$files[$fieldname]['name']));
									$config['upload_path'] = UPLOADDIR.'/images';
								    $config['allowed_types'] = 'gif|jpg|png|svg';
								    $config['file_name'] = rand(1000,100000).time().'.'.$fileExtsion;
								    $config['overwrite'] = FALSE;
								    $config['encrypt_name'] = FALSE;
								    $config['remove_spaces'] = TRUE;
								   if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
								    $this->load->library('upload', $config);
								    if ($this->upload->do_upload('images')) {
								    	$imgData = $this->upload->data();
								    	$imageId = $this->Common_model->insertUnique(tablePrefix."images", array("imageName" => $imgData['file_name'], "addedBY" => $this->session->userdata(PREFIX."sessAuthId"), "metaTitle" => '', "status" => 0, "addedOn" => date('Y-m-d H:i:s')));
										$variableItemData['imageId'] = $imageId;
								    	
									}
								}
								if(isset($data['variableId'][$key]) && !empty($data['variableId'][$key])) 
									$this->Common_model->update(tablePrefix."product_variable", $variableItemData, "variableId =".$data['variableId'][$key]);
								else {
									$variableItemData['status'] = 0;
									$variableItemData['productId'] = $updateStatus;
									$variableItemData['addedOn'] = date('Y-m-d H:i:s');
									$this->Common_model->insert(tablePrefix."product_variable", $variableItemData);
								}
							}
						}
					}
				}
				if(isset($filedata['galleryImage']['name']) && !empty($filedata['galleryImage']['name'])) {
					$galleryFileInfo = $this->common_lib->uploadImageFile($filedata, "images", false, "galleryImage", true );
					if( $galleryFileInfo['valid'] && !empty($galleryFileInfo['filename'])) {
						if(is_array($galleryFileInfo['filename'])) {
							foreach ($galleryFileInfo['filename'] as $key => $galleryImageData) {
								$imageId = $this->Common_model->insertUnique(tablePrefix."images", array("imageName" => $galleryImageData, "addedBY" => $this->session->userdata(PREFIX."sessAuthId"), "metaTitle" => '', "status" => 0, "addedOn" => date('Y-m-d H:i:s')));
								if( $imageId )
									$this->Common_model->insert(tablePrefix."product_images", array("productId" => $updateStatus, "imageId" => $imageId, "addedOn" => date('Y-m-d H:i:s')));
							}
						}
					}
				}
				if(isset($data['mainCategory']) && !empty($data['mainCategory'])) {
					$this->Common_model->del(tablePrefix."product_category", array("productId" => $updateStatus));
					foreach( $data['mainCategory'] as $catVal) {
						$this->Common_model->insert(tablePrefix."product_category", array("categoryId" => $catVal, "categoryType" => "category", "productId" => $updateStatus, "addedOn" => date('Y-m-d H:i:s')));
					}
				}
				if(isset($data['subCategory']) && !empty($data['subCategory'])) {
					foreach( $data['subCategory'] as $catVal) {
						$this->Common_model->insert(tablePrefix."product_category", array("categoryId" => $catVal, "categoryType" => "subcategory", "productId" => $updateStatus, "addedOn" => date('Y-m-d H:i:s')));
					}
				}
				// if(isset($data['subCategoryItem']) && !empty($data['subCategoryItem'])) {
				// 	$this->Common_model->del(tablePrefix."product_category", array("categoryType" => "subcategoryItem", "productId" => $updateStatus));
				// 	foreach( $data['subCategoryItem'] as $catVal) {
				// 		$this->Common_model->insert(tablePrefix."product_category", array("categoryId" => $catVal, "categoryType" => "subcategoryItem", "productId" => $updateStatus, "addedOn" => date('Y-m-d H:i:s')));
				// 	}
				// }

				if( $productId > 0 )
					return array("valid" => true, "data" => array(), "msg" => "Updated Successfully!");
				else
					return array("valid" => true, "data" => array(), "msg" => "Added Successfully!");
			}
			else
				return array("valid" => true, "data" => array(), "msg" => "Something went wrong!");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Product name is required!");
	}

	function categoryList($data) {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product_category','can_view_product_category'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );

		$columns = array( 0 => "categoryId", 1 => "categoryName", 2 => "isNew", 3 => "status",4 => "categoryId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(categoryId) as total from ".tablePrefix."category as cat where cat.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT cat.*,  (case when imageId != 0 then (SELECT concat('".UPLOADPATH."/images/', imageName) FROM ".tablePrefix."images  WHERE imageId = cat.imageId ) else '' end) as icons from ".tablePrefix."category as cat where cat.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (cat.categoryName LIKE  '%".$search."%' OR cat.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(categoryId) as total from ".tablePrefix."category as cat where cat.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['icons'] = ( $row->icons != '' ) ? '<img src="'.$row->icons.'" width="30px" height="30px">' : "";
                $nestedData['categoryName'] = $row->categoryName;
                $nestedData['isNew'] = ($row->isNew == 1 ) ? "Yes" : "No";
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
                //<button class="btn btn-icons btn-rounded btn-light viewCategory" title="View Category" data-id="'.$row->categoryId.'"><i class="fa fa-eye"></i></button>
                $nestedData['action'] = '<button class="btn btn-icons btn-rounded btn-light editCategory" title="Edit" data-id="'.$row->categoryId.'"><i class="fa fa-pencil"></i></button><button onclick="ActivateDeActivateThisRecord(this,\'category\','.$row->categoryId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button><button class="btn btn-icons btn-rounded btn-light deleteCategory" title="Delete Category" onclick="delete_row(this,\'category\','.$row->categoryId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}
	
	
	function subcategoryList($data) {

			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product_category','can_view_product_category'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );

		$columns = array( 0 => "subcategoryId", 1 => "subcategoryName", 2 => "isNew", 3 => "status",4 => "subcategoryId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(subcategoryId) as total from ".tablePrefix."subcategory as cat where cat.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT subcat.*, cat.categoryName,  (case when subcat.imageId != 0 then (SELECT concat('".UPLOADPATH."/images/', imageName) FROM ".tablePrefix."images  WHERE imageId = subcat.imageId ) else '' end) as icons from ".tablePrefix."subcategory as subcat left join ".tablePrefix."category as cat on subcat.categoryId = cat.categoryId where subcat.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (subcat.subcategoryName LIKE  '%".$search."%' OR cat.categoryName LIKE  '%".$search."%' OR subcat.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(subcategoryId) as total from ".tablePrefix."subcategory as subcat left join ".tablePrefix."category as cat on subcat.categoryId = cat.categoryId where subcat.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['icons'] = ( $row->icons != '' ) ? '<img src="'.$row->icons.'" width="30px" height="30px">' : "";
                $nestedData['categoryName'] = $row->categoryName;
                $nestedData['subcategoryName'] = $row->subcategoryName;
                $nestedData['isNew'] = ($row->isNew == 1 ) ? "Yes" : "No";
                
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
				//<button class="btn btn-icons btn-rounded btn-light viewCategory" title="View Category" data-id="'.$row->subcategoryId.'"><i class="fa fa-eye"></i></button
                $nestedData['action'] = '<button class="btn btn-icons btn-rounded btn-light editSubCategory" title="Edit" data-id="'.$row->subcategoryId.'"><i class="fa fa-pencil"></i></button><button onclick="ActivateDeActivateThisRecord(this,\'subcategory\','.$row->subcategoryId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button><button class="btn btn-icons btn-rounded btn-light deleteCategory" title="Delete Category" onclick="delete_row(this,\'subcategory\','.$row->subcategoryId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}
		
	function subcategoryItemList($data) {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product_category','can_view_product_category'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );

		$columns = array( 0 => "subcategoryItemId", 1 => "subcategoryItemName", 2 => "isNew", 3 => "status",4 => "subcategoryItemId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(subcategoryItemId) as total from ".tablePrefix."subcategoryitem as cat where cat.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;  
            
        $totalFiltered = $totalData; 
        $qry = "SELECT subcat.*, cat.categoryName,scat.subcategoryName,  (case when subcat.imageId != 0 then (SELECT concat('".UPLOADPATH."/images/', imageName) FROM ".tablePrefix."images  WHERE imageId = subcat.imageId ) else '' end) as icons from ".tablePrefix."subcategoryitem as subcat left join ".tablePrefix."subcategory as scat on subcat.subcategoryId = scat.subcategoryId left join ".tablePrefix."category as cat on subcat.categoryId = cat.categoryId where subcat.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (subcat.subcategoryItemName LIKE  '%".$search."%' OR cat.categoryName LIKE  '%".$search."%' OR scat.subcategoryName LIKE  '%".$search."%' OR cat.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(subcategoryItemId) as total from ".tablePrefix."subcategoryitem as subcat left join ".tablePrefix."subcategory as scat on subcat.subcategoryId = scat.subcategoryId left join ".tablePrefix."category as cat on subcat.categoryId = cat.categoryId where subcat.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['icons'] = ( $row->icons != '' ) ? '<img src="'.$row->icons.'" width="30px" height="30px">' : "";
                $nestedData['categoryName'] = $row->categoryName;
                $nestedData['subcategoryName'] = $row->subcategoryName;
                $nestedData['subcategoryItemName'] = $row->subcategoryItemName;
                $nestedData['isNew'] = ($row->isNew == 1 ) ? "Yes" : "No";
                
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
                //<button class="btn btn-icons btn-rounded btn-light viewCategory" title="View Category" data-id="'.$row->subcategoryItemId.'"><i class="fa fa-eye"></i></button>
                $nestedData['action'] = '<button class="btn btn-icons btn-rounded btn-light editSubCategoryItem" title="Edit" data-id="'.$row->subcategoryItemId.'"><i class="fa fa-pencil"></i></button><button onclick="ActivateDeActivateThisRecord(this,\'subcategoryitem\','.$row->subcategoryItemId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button><button class="btn btn-icons btn-rounded btn-light deleteCategory" title="Delete Category" onclick="delete_row(this,\'subcategoryitem\','.$row->subcategoryItemId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}

	function productList($data) {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product','can_view_product'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );


		$columns = array( 0 => "sku", 1 => "productId", 2 => "productName", 3 => "category", 4 => "(CASE WHEN cat.productType = 1 THEN (SELECT actualPrice FROM ch_product_variable WHERE status = 0 AND productId = cat.productId order by actualPrice asc limit 0, 1) ELSE cat.actualPrice END )", 5 => "productId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(productId) as total from ".tablePrefix."product as cat where cat.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT cat.*, (CASE WHEN cat.productType = 1 THEN (SELECT actualPrice FROM ch_product_variable WHERE status = 0 AND productId = cat.productId order by actualPrice asc limit 0, 1) ELSE cat.actualPrice END ) as actualPrice,  (case when featuredImageId != 0 then (SELECT concat('".UPLOADPATH."/images/', imageName) FROM ".tablePrefix."images  WHERE imageId = cat.featuredImageId ) else '' end) as icons, (SELECT GROUP_CONCAT(categoryName SEPARATOR ', ') FROM ch_category WHERE status = 0 AND categoryId IN (SELECT categoryId FROM ch_product_category WHERE categoryType = 'category' AND productId=cat.productId)) as category from ".tablePrefix."product as cat where cat.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (cat.productName LIKE  '%".$search."%' OR cat.sku LIKE  '%".$search."%' OR (CASE WHEN cat.productType = 1 THEN (SELECT actualPrice FROM ch_product_variable WHERE status = 0 AND productId = cat.productId order by actualPrice asc limit 0, 1) ELSE cat.actualPrice END ) LIKE  '%".$search."%' OR cat.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(productId) as total from ".tablePrefix."product as cat where cat.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		
            	$nestedData['sku'] = $row->sku;
                $nestedData['icons'] = ( $row->icons != '' ) ? '<img src="'.$row->icons.'">' : "";
                $nestedData['productName'] = $row->productName;
                $nestedData['category'] = $this->common_lib->CountWord(2,$row->category);
                $nestedData['price'] = $row->actualPrice;
                
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }

                $nestedData['action'] = '<a class="btn btn-icons btn-rounded btn-light" title="view" href="'.BASEURL.'/'.$row->slug.'"  target="_blank"><i class="fa fa-eye"></i></a>';

				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product','can_edit_product'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<a class="btn btn-icons btn-rounded btn-light" title="Edit Product" href="'.DASHURL.'/admin/product/add/'.$row->productId.'"><i class="fa fa-pencil"></i></a><button onclick="ActivateDeActivateThisRecord(this,\'product\','.$row->productId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button>';

				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product','can_delete_product'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light deleteCategory" title="Delete Product" onclick="delete_row(this,\'product\','.$row->productId.');"><i class="fa fa-trash-o"></i></button>';

                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}

	function getAddonsList($data) {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product','can_view_product'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );


		$columns = array( 0 => "addonsId", 1 => "addonsName", 2 => "price", 3 => "addonsId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."product_addons where status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT *, (case when img != 0 then concat('".UPLOADPATH."/addons_images/', img) else '' end) as icons from ".tablePrefix."product_addons where status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (addonsName LIKE  '%".$search."%' OR price LIKE  '%".$search."%') ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."product_addons where status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		
                $nestedData['img'] = ( $row->icons != '' ) ? '<img src="'.$row->icons.'">' : "";
                $nestedData['addonsName'] = $row->addonsName;
                $nestedData['price'] = $row->price;
                
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }

                $nestedData['action'] = '';

				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product','can_edit_product'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<a class="btn btn-icons btn-rounded btn-light" title="Edit Addons" href="javascript:" onclick="editAddons(this,event,'.$row->addonsId.')"><i class="fa fa-pencil"></i></a><button onclick="ActivateDeActivateThisRecord(this,\'addons\','.$row->addonsId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button>';

				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product','can_delete_product'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light" title="Delete Addons" onclick="delete_row(this,\'addons\','.$row->addonsId.');"><i class="fa fa-trash-o"></i></button>';

                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}
	
	function addAddons($data, $filedata) {
		if(isset($data['addonsName']) && !empty($data['addonsName'])) {
			$addonsId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
			
			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_product',($addonsId)?'can_edit_product':'can_create_product'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			$insertData['addonsName'] = $data['addonsName'];
			$insertData['description'] = $data['description'];
			$insertData['zeroPower'] = isset($data['zeroPower'])?1:0;
			$insertData['price'] = $data['price'];
			
			$condArray = array("status != " => "2", "addonsName" => $data['addonsName']);
			if( $addonsId > 0 )
				$condArray['addonsId != '] = $addonsId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."product_addons", "addonsId", $condArray);
			if( $checkExits )
				return array("valid" => false, "msg" => "Addons Already Exist!");


			$insertData['updatedOn']	 	=   date('Y-m-d H:i:s');

			$imageName = $this->uploadImage("addons_images", "uploadIcons" );			
			if($imageName) 
				$insertData['img'] = $imageName;


			if( $addonsId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."product_addons", $insertData, "addonsId = ".$addonsId);
			else {
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$updateStatus = $this->Common_model->insert(tablePrefix."product_addons", $insertData);
			}

			if( $updateStatus )
				return array("valid" => true, "msg" => ($addonsId > 0)?"Addons Updated Successfully!":"Addons Added Successfully!");
			else
				return array("valid" => false, "msg" => "Something went wrong.");

		}
		else 
			return array("valid" => false, "msg" => "Addons name is required!");
	}

	function todaydealList($data) {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_today_deal','can_view_today_deal'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );


		$columns = array( 0 => "date", 1 => "startTime", 2 => "endTime", 3 => "totalProduct", 4 => "status", 5 => "todaydealId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(todaydealId) as total from ".tablePrefix."todaydeal as cat where cat.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT cat.*,  (SELECT count(todaydealProductId) as total from ".tablePrefix."todaydeal_product as pro where pro.status != 2 AND pro.todaydealId = cat.todaydealId) as totalProduct from ".tablePrefix."todaydeal as cat where cat.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (cat.date LIKE  '%".$search."%' OR cat.startTime LIKE  '%".$search."%' OR cat.endTime LIKE  '%".$search."%' OR cat.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(todaydealId) as total from ".tablePrefix."todaydeal as cat where cat.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		
                $nestedData['date'] = $row->date;
                $nestedData['startTime'] = $row->startTime;
                $nestedData['endTime'] = $row->endTime;
                $nestedData['totalProduct'] = $row->totalProduct;
                
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }


                $nestedData['action'] = '<a class="btn btn-icons btn-rounded btn-light" title="view" href="'.DASHURL.'/admin/product/todaydealview/'.$row->todaydealId.'"><i class="fa fa-eye"></i></a>';

				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_today_deal','can_edit_today_deal'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<a class="btn btn-icons btn-rounded btn-light editCategory" title="Edit" href="'.DASHURL.'/admin/product/todaydeal/'.$row->todaydealId.'" data-id="'.$row->todaydealId.'"><i class="fa fa-pencil"></i></a><button onclick="ActivateDeActivateThisRecord(this,\'todaydeal\','.$row->todaydealId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button>';

				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_today_deal','can_delete_today_deal'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light deleteCategory" title="Delete" onclick="delete_row(this,\'todaydeal\','.$row->todaydealId.');"><i class="fa fa-trash-o"></i></button>';

                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}
	/****************************** End Product Section *******************/
	/****************************** Zone Section ************************/

	function AddZone($data, $filedata) {
		if(isset($data['zoneName']) && !empty($data['zoneName'])) {
			$zoneId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
			
			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_zone',($zoneId)?'can_edit_zone':'can_create_zone'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			$insertData['zoneName'] = $data['zoneName'];
			
			$condArray = array("status != " => "2", "zoneName" => $data['zoneName']);
			if( $zoneId > 0 )
				$condArray['zoneId != '] = $zoneId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."zone", "zoneId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Zone Already Exist!");
			if(isset($data['slugName']) && !empty($data['slugName'])) {
				$insertData['slug'] = $data['slugName'];
				$condArray = array("status != " => "2", "slug" => $data['slugName']);
				if( $zoneId > 0 )
					$condArray['zoneId != '] = $zoneId; 

				$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."zone", "zoneId", $condArray);
				if( $checkExits )
					return array("valid" => false, "data" => array(), "msg" => "Slug Already Exist!");
			}
			else{
				$zoneSlug = $this->common_lib->create_unique_slug(trim($data['zoneName']),tablePrefix."zone","slug",$zoneId,"zoneId",$counter=0);
				$insertData['slug']			 =   $zoneSlug;
		    }  
			$insertData['isPopular'] = (isset($data['isPopular']) && !empty($data['isPopular'])) ? 1 : 0;
			$insertData['lastDeliveryTime'] = (isset($data['lastDeliveryTime']) && !empty($data['lastDeliveryTime'])) ? $data['lastDeliveryTime'] : '';
			$insertData['status'] = 0;
			

			if(isset($filedata) && !empty($filedata)) {
				$fileInfo = $this->common_lib->uploadImageFile($filedata, "images", false, "uploadIcons" );
				if(!empty($fileInfo['filename'])) {
					$imageId = $this->Common_model->insertUnique(tablePrefix."images", array("imageName" => $fileInfo['filename'], "addedBY" => $this->session->userdata(PREFIX."sessAuthId"), "metaTitle" => '', "status" => 0, "addedOn" => date('Y-m-d H:i:s')));
					$insertData['imageId'] = ($imageId) ? $imageId : 0;
				}
			}


			if( $zoneId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."zone", $insertData, "zoneId = ".$zoneId);
			else {
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$updateStatus = $this->Common_model->insert(tablePrefix."zone", $insertData);
			}

			if( $updateStatus )
				return array("valid" => true, "data" => array(), "msg" => "Zone Updated Successfully!");
			else
				return array("valid" => true, "data" => array(), "msg" => "Zone Added Successfully!");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Zone name is required!");
	}
	function zoneList($data) {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_zone','can_view_zone'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );


		$this->common_lib->checkRolePermission(['can_manage_all_zone','can_view_zone'],0);
		$columns = array( 0 => "zoneName", 1 => "isPopular", 2 => "status",3 => "zoneId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(zoneId) as total from ".tablePrefix."zone as cat where cat.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT cat.*, (SELECT count(pincode) FROM ".tablePrefix."pincode WHERE zoneId = cat.zoneId AND status != 2) as pincode from ".tablePrefix."zone as cat where cat.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (cat.zoneName LIKE  '%".$search."%' OR cat.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(zoneId) as total from ".tablePrefix."zone as cat where cat
            	.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['zoneName'] = $row->zoneName;
                $nestedData['isPopular'] = ($row->isPopular == 1 ) ? "Yes" : "No";
                $nestedData['noOfPincode'] = $row->pincode; 
                
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
                $nestedData['action'] = '';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_zone','can_edit_zone'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light editZone" title="Edit" data-id="'.$row->zoneId.'"><i class="fa fa-pencil"></i></button><button onclick="ActivateDeActivateThisRecord(this,\'zone\','.$row->zoneId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button>';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_zone','can_delete_zone'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light deleteZone" title="Delete Zone" onclick="delete_row(this,\'zone\','.$row->zoneId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}
	function getPinCodeList($data) {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_pincode','can_view_pincode'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );


		$columns = array( 0 => "zoneName", 1 => "pincode", 2 => "deliveryType", 3 => "status", 4 => "zoneId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(zoneId) as total from ".tablePrefix."pincode as pin where pin.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT pin.*, zone.zoneName, (SELECT GROUP_CONCAT(CONCAT(deliveryType , ' ' , deliveryAmount) SEPARATOR '<br>') FROM ".tablePrefix."delivery_service  WHERE pincodeId = pin.pincodeId ) as deliveryType from ".tablePrefix."pincode as pin left join ".tablePrefix."zone as zone on pin.zoneId = zone.zoneId where pin.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (zone.zoneName LIKE  '%".$search."%' OR pin.status LIKE  '%".$search."%' OR pin.pincode LIKE '%".$search."%' ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(pin.zoneId) as total from ".tablePrefix."pincode as pin left join ".tablePrefix."zone as zone on pin.zoneId = zone.zoneId where pin.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['zoneName'] = $row->zoneName;
                $nestedData['pincode'] = $row->pincode;
                $nestedData['deliveryType'] = $row->deliveryType; 
                
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }

                $nestedData['action'] = '';

				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_pincode','can_edit_pincode'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<a class="btn btn-icons btn-rounded btn-light " title="Edit" href="'.DASHURL.'/admin/zone/addpincode/'.$row->pincodeId.'"><i class="fa fa-pencil"></i></a><a class="btn btn-icons btn-rounded btn-light copyPincodeBtn" title="Copy" href="javascript:" data-pincode-id="'.$row->pincodeId.'"><i class="fa fa-copy"></i></a><button onclick="ActivateDeActivateThisRecord(this,\'pincode\','.$row->pincodeId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button>';

				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_pincode','can_delete_pincode'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light deletePincode" title="Delete Pincode" onclick="delete_row(this,\'pincode\','.$row->pincodeId.');"><i class="fa fa-trash-o"></i></button>';

                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}
	function copyZoneDelivery($data) {
		if(isset($data['zoneId']) && !empty($data['zoneId'])) {
			$countDelivery = 0;
 			$countTimeSlots = 0;
 			$deliveryType = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."delivery_service WHERE pincodeId = (SELECT pincodeId FROM ".tablePrefix."pincode WHERE zoneId='".$data['zoneId']."' AND status = '0' order by pincodeId asc limit 0,1)");
 			if( $deliveryType ) { 					
				$deliverySectionHtml = '';
				foreach( $deliveryType 	as $key => $deliveryData ) {
					$deliverySectionHtml .= '<div class="deliverySection" data-counter="'.$countDelivery.'">
                        <div class="form-group col-md-6">
                          <label for="deliveryType">Delivery Type</label>
                          <input type="text" class="form-control" id="deliveryType" placeholder="Delivery Type" name="deliveryType['.$countDelivery.']" value="'.$deliveryData->deliveryType.'" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="deliveryAmount">Delivery Amount</label>
                          <input type="text" class="form-control" id="deliveryAmount" placeholder="Delivery Amount" name="deliveryAmount['.$countDelivery.']" value="'.$deliveryData->deliveryAmount.'" required>
                        </div>  
                        <div class="col-md-12 timeslotsSection">';
				    $deliveryTimeSlotsHtml = '';

				    $deliveryTimeSlots = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."delivery_time_slots WHERE deliveryId = ".$deliveryData->deliveryTimeSlotId);

				    if($deliveryTimeSlots) {
				    	foreach ($deliveryTimeSlots as $keyItem => $deliveryTimeSlotsData) {
				    		$deliveryTimeSlotsHtml .= '<div class="slotsItems">
	                            <div class="form-group col-md-3">
	                              <label for="startTime">Start Time</label>
	                              <input type="text" class="form-control timePicker"  placeholder="Start Time" name="startTime['.$countDelivery.']['.$countTimeSlots.']" value="'.date('H:i A',strtotime($deliveryTimeSlotsData->startTime)).'" required>
	                            </div>
	                            <div class="form-group col-md-3">    
	                              <label for="endTime">End Time</label>
	                              <input type="text" class="form-control timePicker" name="endTime['.$countDelivery.']['.$countTimeSlots.']" value="'.date('H:i A',strtotime($deliveryTimeSlotsData->endTime)).'" placeholder="End Time" required>                                      
	                            </div>
	                            <div class="form-group col-md-4">
	                              <label for="numberOfDelivery">Number of Delivery</label>
	                              <input type="text" class="form-control" placeholder="Number of Delivery" name="numberOfDelivery['.$countDelivery.']['.$countTimeSlots.']" onkeydown="OnlyNumericKey(event)" value="'.$deliveryTimeSlotsData->numberofDelivery.'" required>	                              
	                            </div>
	                            <div class="form-group col-md-2"><button class="btn btn-icons btn-rounded btn-light removeSlotsItem" title="Remove" type="button"><i class="fa fa-times"></i></button></div><div class="clearfix"></div>
	                          </div>';
	                        $countTimeSlots++;
				    	}
				    }                            

		            $deliverySectionHtml .= $deliveryTimeSlotsHtml.'<button type="button" class="btn btn-success addMoreSlots"><i class="fa fa-plus"></i> Add More</button></div><button type="button" class="btn btn-success removeDeliverySection"><i class="fa fa-times"></i> Remove</button></div>';
						$countDelivery++;
				}
				
			}
			else {
				$deliverySectionHtml = '<div class="deliverySection" data-counter="0">
                                <div class="form-group col-md-6">
                                  <label for="deliveryType">Delivery Type</label>
                                  <input type="text" class="form-control" id="deliveryType" placeholder="Delivery Type" name="deliveryType[0]" required>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="deliveryAmount">Delivery Amount</label>
                                  <input type="text" class="form-control" id="deliveryAmount" placeholder="Delivery Amount" name="deliveryAmount[0]" required>
                                </div>  
                                <div class="col-md-12 timeslotsSection">
                                  <div class="slotsItems">
                                    <div class="form-group col-md-3">
                                      <label for="startTime">Start Time</label>
                                      <input type="text" class="form-control timePicker"  placeholder="Start Time" name="startTime[0][0]" required>
                                    </div>
                                    <div class="form-group col-md-3">    
                                      <label for="endTime">End Time</label>
                                      <input type="text" class="form-control timePicker" name="endTime[0][0]" placeholder="End Time" required>                                      
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="numberOfDelivery">Number of Delivery</label>
                                      <input type="text" class="form-control" placeholder="Number of Delivery" name="numberOfDelivery[0][0]" onkeydown="OnlyNumericKey(event)" required>
                                    </div>
                                    <div class="form-group col-md-2">&nbsp;</div>
                                    <div class="clearfix"></div>
                                  </div>
                                  <button type="button" class="btn btn-success addMoreSlots"><i class="fa fa-plus"></i> Add More</button>
                                </div>                            
                              </div>';
				$countDelivery++;
				$countTimeSlots++;

			}
			return array("valid" => false, "data" => array('countDelivery' => $countDelivery, 'countTimeSlots' => $countTimeSlots, 'deliverySectionHtml' => '<div class="card-body"><h4 class="card-title">Delivery Condition</h4><p class="card-description"></p>'.$deliverySectionHtml.'</div>'), "msg" => "Available Information");
		}
		else
			return array("valid" => false, "data" => array(), "msg" => "Required field is Missing!");
	}
	function addPinCode($data) {
		if(isset($data['zoneName']) && !empty($data['zoneName']) && isset($data['pincode']) && !empty($data['pincode'])) {
			$isToUpdate = $pincodeId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
			
			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_pincode',($pincodeId)?'can_edit_pincode':'can_create_pincode'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			$condArray = array("status != " => "2", "pincode" => trim($data['pincode']) );
			if( $pincodeId > 0 )
				$condArray['pincodeId != '] = $pincodeId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."pincode", "pincodeId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Pincode Already Exist!");

			$this->db->trans_start();
			$insertData['pincode'] = trim($data['pincode']);
			$insertData['minCartValue'] = trim($data['minCartValue']);
			$insertData['isCod'] = isset($data['isCod'])?1:0;
			$insertData['zoneId'] = $data['zoneName'];
			$insertData['addedBY'] = $this->session->userdata(PREFIX."sessAuthId");
			if( $pincodeId > 0 ) 
				$updateStatus = $this->Common_model->update(tablePrefix."pincode", $insertData, "pincodeId = ".$pincodeId);			
			else {
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$updateStatus = $this->Common_model->insertUnique(tablePrefix."pincode", $insertData);
				$pincodeId = $updateStatus;
			}
			if( $updateStatus ) {


				if(isset($data['deliveryType']) && !empty($data['deliveryType'])) {
					$this->Common_model->update(tablePrefix."delivery_service",array("status"=>2), "pincodeId = '".$pincodeId."'"); 
					// echo $this->db->last_query();
					// exit;

					foreach( $data['deliveryType'] as $key => $dataVal ) {
						if( !empty( $dataVal ) ) {
							$deliveryType['deliveryType'] = $dataVal;
							$deliveryType['deliveryAmount'] = $data['deliveryAmount'][$key];
							$deliveryType['pincodeId'] = $pincodeId;
							$deliveryType['status'] = 0;
							$deliveryType['addedBY'] = $this->session->userdata(PREFIX."sessAuthId");
							if(isset($data['deliveryId'][$key]) && !empty($data['deliveryId'][$key])) {
								$deliveryId = $data['deliveryId'][$key];
								$this->Common_model->update(tablePrefix."delivery_service",$deliveryType, "deliveryTimeSlotId = ".$data['deliveryId'][$key]);
							}
							else {
								$deliveryType['addedOn'] = date('Y-m-d H:i:s');
								$deliveryId = $this->Common_model->insertUnique(tablePrefix."delivery_service",$deliveryType);
							} 
							if( $deliveryId > 0 ) {
								$this->Common_model->update(tablePrefix."delivery_time_slots",array("status"=>2), "deliveryId = '".$deliveryId."'");
								// exit;
								foreach($data['startTime'][$key] as $keyItem => $timeslots) {
									if(!empty($timeslots)) {
										$timeslotsData['deliveryId'] = $deliveryId;
										$timeslotsData['startTime'] = date('H:i', strtotime($timeslots));
										$timeslotsData['endTime'] = date('H:i', strtotime($data['endTime'][$key][$keyItem]));
										$timeslotsData['numberofDelivery'] =$data['numberOfDelivery'][$key][$keyItem];
										$timeslotsData['status'] =0;
										$timeslotsData['addedBY'] = $this->session->userdata(PREFIX."sessAuthId");

										if(isset($data['timeslotId'][$key][$keyItem]) && !empty($data['timeslotId'][$key][$keyItem])) {
											$timeslotsId = $data['timeslotId'][$key][$keyItem];
											$this->Common_model->update(tablePrefix."delivery_time_slots", $timeslotsData, "timeslotId = ". $data['timeslotId'][$key][$keyItem]);
										}
										else {
											$timeslotsData['addedOn'] = date('Y-m-d H:i:s');
											$timeslotsId = $this->Common_model->insertUnique(tablePrefix."delivery_time_slots",$timeslotsData);
										}
									}
								}
							}	
						}
					}
				}

				if ($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					return array("valid" => false, "data" => array(), "msg" => "Something went wrong.");
				}else{
					$this->db->trans_commit();
					return array("valid" => true, "data" => array(), "msg" => ($isToUpdate)?"Successfully Updated!":"Successfully Added!");
				}

			}
			else 
				return array("valid" => false, "data" => array(), "msg" => "Something went wrong!");
		}
		else
			return array("valid" => false, "data" => array(), "msg" => "Required field is Missing!");
	}
	function copyPincode($data) {
		if(isset($data['pincodeId']) && !empty($data['pincodeId']) && isset($data['pincode']) && !empty($data['pincode'])) {
			$pincodeId = $data['pincodeId'];
			
			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_pincode',($pincodeId)?'can_edit_pincode':'can_create_pincode'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			$condArray = array("status != " => "2", "pincode" => trim($data['pincode']) );		

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."pincode", "pincodeId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Pincode Already Exist!");


			$getPincodeDetails = (array) $this->Common_model->exequery("SELECT * FROM ".tablePrefix."pincode WHERE pincodeId = '".$pincodeId."'", true);
 			if(isset($getPincodeDetails['pincodeId']) && !empty($getPincodeDetails['pincodeId'])) {
 				$this->db->trans_start();
 				unset($getPincodeDetails['pincodeId']);
				$getPincodeDetails['pincode'] = trim($data['pincode']);
				$getPincodeDetails['addedBY'] = $this->session->userdata(PREFIX."sessAuthId");
				$getPincodeDetails['addedOn'] = $getPincodeDetails['updatedOn'] = date('Y-m-d H:i:s');
				$newPincodeId = $this->Common_model->insertUnique(tablePrefix."pincode", $getPincodeDetails);
				
				if( $newPincodeId ) { 				
 					$deliveryType = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."delivery_service WHERE pincodeId = ".$pincodeId);
	 				if( $deliveryType ) {
	 					foreach( $deliveryType 	as $key => $deliveryData ) {
	 						$deliveryTimeSlotId = $deliveryData->deliveryTimeSlotId;
	 						$deliveryData = (array) $deliveryData;
	 						unset($deliveryData['deliveryTimeSlotId']);
							$deliveryData['pincodeId'] = $newPincodeId;
							$deliveryData['addedBY'] = $this->session->userdata(PREFIX."sessAuthId");
							$deliveryData['addedOn'] = $deliveryData['updatedOn'] = date('Y-m-d H:i:s');
							$deliveryId = $this->Common_model->insertUnique(tablePrefix."delivery_service",$deliveryData);
							if( $deliveryId ) {
							    $deliveryTimeSlots = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."delivery_time_slots WHERE deliveryId = ".$deliveryTimeSlotId);

							    if($deliveryTimeSlots) {
							    	foreach ($deliveryTimeSlots as $keyItem => $deliveryTimeSlotsData) {
							    		$deliveryTimeSlotsData = (array) $deliveryTimeSlotsData;
	 									unset($deliveryTimeSlotsData['timeslotId']);
							    		$deliveryTimeSlotsData['deliveryId'] = $deliveryId;
										$deliveryTimeSlotsData['addedBY'] = $this->session->userdata(PREFIX."sessAuthId");
										$deliveryTimeSlotsData['addedOn'] = $deliveryTimeSlotsData['updatedOn'] = date('Y-m-d H:i:s');
											$this->Common_model->insertUnique(tablePrefix."delivery_time_slots",$deliveryTimeSlotsData);
							    		
							    	}
							    }
							}
	 					}
	 				}
	 			}
	 			
	 			// if( $newPincodeId )
	 			// 	return array("valid" => true, "data" => array(), "msg" => "Pincode copied successfully.");
	 			// else
	 			// 	return array("valid" => false, "data" => array(), "msg" => "Something went wrong.", 'qry'=> $this->db->last_query());


				if ($this->db->trans_status() === FALSE || empty($newPincodeId)){
					$this->db->trans_rollback();
					return array("valid" => false, "data" => array(), "msg" => "Something went wrong.");
				}else{
					$this->db->trans_commit();
					return array("valid" => true, "data" => array(), "msg" => "Pincode copied successfully.");
				}
 			}
 			else
 				return array("valid" => false, "data" => array(), "msg" => "Pincode details not found.");

		}
		else
			return array("valid" => false, "data" => array(), "msg" => "Required field is Missing!");
	}
	/****************************** End Zone Section ************************/

	public function orderHistory() {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_order','can_view_order'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );


		$columns = array( 0 => "od.generatedId", 1 => "us.firstName", 2 => "ad.city", 3 => "od.grandTotal", 4 => "od.status", 5 => "ot.paymentStatus", 6 => "od.addedOn", 7 => "od.orderId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";

        $filterCond = '';
        if (isset($_POST['filterOrder'])) {
        	if($_POST['filterOrder'] == 'New')
        		$filterCond = " AND od.status = 0 AND (ot.paymentStatus = 1 OR (paymentMethod = 'cod'))";
        	elseif($_POST['filterOrder'] == 'Ongoing')
        		$filterCond = ' AND od.status IN (1,2,3,4)';
        	elseif($_POST['filterOrder'] == 'Completed')
        		$filterCond = ' AND od.status IN (5,6)';
        }
        $tabCond = " AND (date(od.addedOn) >= date('".date('Y-m-d', strtotime('2019-01-01'))."') AND date(od.addedOn) <= date('".date('Y-m-d')."'))";
        if (isset($_POST['filterDateRange']) && !empty($_POST['filterDateRange'])) {

			$datesArr = explode(' - ', trim($_POST['filterDateRange']));
			$datesArr[0] = date('Y-m-d', strtotime($datesArr[0]));
			$datesArr[1] = date('Y-m-d', strtotime($datesArr[1]));
        	$filterCond .= " AND (date(od.addedOn) >= date('$datesArr[0]') AND date(od.addedOn) <= date('$datesArr[1]'))";
        	$tabCond = " AND (date(od.addedOn) >= date('$datesArr[0]') AND date(od.addedOn) <= date('$datesArr[1]'))";
        }

        
        $vendorCond = (isset($_POST['vendorId']) && $_POST['vendorId'] > 0)?" AND od.orderId IN (SELECT DISTINCT orderId FROM `ch_order_detail` WHERE vendorId = '".trim($_POST['vendorId'])."')":"";;
  		$filterCond .= $vendorCond;
  		$tabCond .= $vendorCond;
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."order as od left join ".tablePrefix."order_transaction as ot on ot.orderId = od.orderId WHERE od.orderId > 0".$filterCond,1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT od.*, ot.paymentMethod, ot.paymentStatus, ad.city, us.firstName from ".tablePrefix."order as od left join ".tablePrefix."order_transaction as ot on ot.orderId = od.orderId  left join ".tablePrefix."user as us on us.userId = od.userId left join ".tablePrefix."user_address as ad on ad.addressId = od.addressId where od.orderId > 0".$filterCond; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search))
            	$search = str_replace(['"',"'"], ['', ''], $search);

            $searchCond = " AND (us.firstName LIKE  '%".$search."%' OR ad.city LIKE  '%".$search."%' OR od.grandTotal LIKE  '%".$search."%' OR od.generatedId LIKE  '%".$search."%' OR od.status LIKE  '%".$search."%' OR ot.paymentStatus LIKE  '%".$search."%' OR od.addedOn LIKE '%".$search."%' ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."order as od left join ".tablePrefix."order_transaction as ot on ot.orderId = od.orderId  left join ".tablePrefix."user as us on us.userId = od.userId left join ".tablePrefix."user_address as ad on ad.addressId = od.addressId where od.orderId > 0 ".$filterCond.$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {
            	
            	if ($row->paymentMethod=='cod' && $row->paymentStatus == 0) {
                      $row->paymentStatus = "COD Pending";
                      $row->paymentClass = "badge badge-light text-danger";
                }elseif ($row->paymentStatus == 0) {
            		$row->paymentStatus = "Payment Pending";
            		$row->paymentClass = "badge badge-light text-danger";
            	}elseif ($row->paymentStatus == 1) {
            		$row->paymentStatus = "Payment Success";
            		$row->paymentClass = "badge badge-success";
            	}elseif ($row->paymentStatus == 2) {
            		$row->paymentStatus = "Payment Failed";
            		$row->paymentClass = "badge badge-danger";
            	}elseif ($row->paymentStatus == 3) {
            		$row->paymentStatus = "Payment Cancelled";
            		$row->paymentClass = "badge badge-dark";
            	}else {
            		$row->paymentStatus = "Unknown";
            		$row->paymentClass = "badge badge-warning";
            	}

            	if ($row->status == 0 && $row->paymentStatus=='COD Pending') {
                	$row->status = "Order received";
                	$row->class = "badge badge-dark";
              	}elseif ($row->status == 0 && $row->paymentStatus == "Payment Pending") {
            		$row->status = "Payment Pending";
            		$row->class = "badge badge-light text-danger";
            	}elseif ($row->status == 0 && $row->paymentStatus == "Payment Success") {
            		$row->status = "Order Recieved";
            		$row->class = "badge badge-dark";
            	}elseif ($row->status == 1) {
            		$row->status = "Vendor Confirmed";
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
                $nestedData['user'] = $row->firstName;
                $nestedData['city'] = $row->city;
                $nestedData['grandTotal'] = $row->grandTotal;
                $nestedData['status'] = '<span class="'.$row->class.'">'.$row->status.'</span>'; 
                $nestedData['paymentStatus'] = '<span class="'.$row->paymentClass.'">'.$row->paymentStatus.'</span>'; 
                $nestedData['addedOn'] = $row->addedOn;

                $nestedData['action'] = '<a class="btn btn-icons btn-rounded btn-light" title="view" href="'.DASHURL.'/admin/order/detail/'.$row->orderId.'"><i class="fa fa-eye"></i></a>';
                $data[] = $nestedData;

            }
        }

        $tabStatistics=$this->Common_model->exequery("SELECT * FROM ((SELECT COUNT(*) as new FROM ch_order as od left join ch_order_transaction as ot on ot.orderId = od.orderId WHERE od.status = 0 AND (ot.paymentStatus = 1 OR ot.paymentMethod = 'cod') $tabCond) as new, (SELECT COUNT(*) as ongoing FROM ch_order as od WHERE od.status IN (1,2,3,4) $tabCond) as ongoing, (SELECT COUNT(*) as completed FROM ch_order as od WHERE od.status IN (5,6) $tabCond) as completed, (SELECT COUNT(*) as total FROM ch_order as od where od.orderId > 0  $tabCond) as total)",1);
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data, "tabStatistics" => $tabStatistics );
	}

	public function visitorHistory() {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_order','can_view_order'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );


		$columns = array( 0 => "senderName", 1 => "senderNo", 2 => "name", 3 => "mobile", 4 => "(SELECT count(*) FROM ".tablePrefix."cart_detail  WHERE cartId = vs.cartId )", 5 => "visitorId",);

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."visitor as vs where vs.status = 0 AND (SELECT count(*) FROM ".tablePrefix."cart_detail  WHERE cartId = vs.cartId ) > 0",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT vs.*,  (SELECT count(*) FROM ".tablePrefix."cart_detail  WHERE cartId = vs.cartId ) as itemTotal from ".tablePrefix."visitor as vs where vs.status = 0 AND (SELECT count(*) FROM ".tablePrefix."cart_detail  WHERE cartId = vs.cartId ) > 0"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search))
            	$search = str_replace(['"',"'"], ['', ''], $search);

            $searchCond = " AND (vs.senderName LIKE  '%".$search."%' OR vs.senderNo LIKE  '%".$search."%' OR vs.mobile LIKE  '%".$search."%' OR vs.name LIKE  '%".$search."%' OR vs.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."visitor as vs where vs.status = 0 AND (SELECT count(*) FROM ".tablePrefix."cart_detail  WHERE cartId = vs.cartId ) > 0 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		
                $nestedData['senderName'] = $row->senderName;
                $nestedData['senderNo'] = $row->senderNo;
                $nestedData['mobile'] = $row->mobile.', '.$row->alternateMobile;
                $nestedData['name'] = $row->name;
                $nestedData['itemTotal'] = $row->itemTotal;
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }

				$nestedData['action'] = '';

                $nestedData['action'] .= '<a class="btn btn-icons btn-rounded btn-light" title="view" href="'.DASHURL.'/admin/order/visitordetail/'.$row->visitorId.'"><i class="fa fa-eye"></i></a>';               
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_order','can_delete_order'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light" title="Delete Vendor" onclick="delete_row(this,\'visitor\','.$row->visitorId.');"><i class="fa fa-trash-o"></i></button>';

                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}

	public function exportOrderCsv() {
			
		$response = array("valid" => false, "data" => array(), "msg" => "Something Went Wrong");
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_order','can_view_order'],0);
		if(!$checkRolePermission['valid'])
			return $checkRolePermission;

        $filterCond = '';
        if (isset($_POST['filterOrder'])) {
        	if($_POST['filterOrder'] == 'New')
        		$filterCond = " AND od.status = 0 AND (ot.paymentStatus = 1 OR (paymentMethod = 'cod'))";
        	elseif($_POST['filterOrder'] == 'Ongoing')
        		$filterCond = ' AND od.status IN (1,2,3,4)';
        	elseif($_POST['filterOrder'] == 'Completed')
        		$filterCond = ' AND od.status IN (5,6)';
        }
        if (isset($_POST['filterDateRange']) && !empty($_POST['filterDateRange'])) {

			$datesArr = explode(' - ', trim($_POST['filterDateRange']));
			$datesArr[0] = date('Y-m-d', strtotime($datesArr[0]));
			$datesArr[1] = date('Y-m-d', strtotime($datesArr[1]));
        	$filterCond .= " AND (date(od.addedOn) >= date('$datesArr[0]') AND date(od.addedOn) <= date('$datesArr[1]'))";
        }
        $vendorCond = (isset($_POST['vendorId']) && $_POST['vendorId'] > 0)?" AND od.orderId IN (SELECT DISTINCT orderId FROM `ch_order_detail` WHERE vendorId = '".trim($_POST['vendorId'])."')":"";;
  		$filterCond .= $vendorCond;

        $qry = "SELECT od.generatedId, od.ip, (CASE WHEN od.userId > 0 THEN CONCAT(us.firstName,' ',us.lastName) ELSE CONCAT('Sender Email:',od.guestEmail,' Sender Name:',od.senderName,' Sender Number:',od.senderNo) END) user, CONCAT(' Reciever:',ua.name,' Reciever Contact Number:',ua.mobile,' Address:',ua.address, ' Landmark:',ua.address2, ' City:',ua.city, ' State:',ua.state, ' Country:',ua.country, ' Pincode:',ua.pincode) as address, (SELECT sum(qty) FROM ch_order_detail WHERE  orderId = od.orderId) as totalItems, od.cartTotal, od.tax, od.grandTotal, (CASE WHEN (ot.paymentMethod = 'cod' AND ot.paymentStatus = 0) THEN 'COD Pending' WHEN ot.paymentStatus = 0 THEN 'Payment Pending' WHEN ot.paymentStatus = 1 THEN 'Payment Success' WHEN ot.paymentStatus = 2 THEN 'Payment Failed' WHEN ot.paymentStatus = 3 THEN 'Payment Cancelled' ELSE 'Unknown' END ) as paymentStatus, (CASE WHEN (od.status = 0 AND ot.paymentMethod = 'cod' AND ot.paymentStatus = 0) THEN 'Order received' WHEN (od.status = 0 AND ot.paymentStatus = 0) THEN 'Payment Pending' WHEN (od.status = 0 AND ot.paymentStatus = 1) THEN 'Order received' WHEN od.status = 1 THEN 'Vendor Confirmed' WHEN od.status = 2 THEN 'Processing' WHEN od.status = 3 THEN 'Ready to ship' WHEN od.status = 4 THEN 'Shipped' WHEN od.status = 5 THEN 'Delivered' WHEN od.status = 6 THEN 'Cancelled' ELSE 'Unknown' END ) as orderStatus, od.addedOn, od.preparingOn, od.readyToShipOn, od.shippedOn, od.deliveredOn, od.CancelledOn, od.updatedOn FROM ch_order as od left join ch_order_transaction as ot on ot.transactionId = (SELECT transactionId FROM ch_order_transaction WHERE orderId = od.orderId ORDER BY transactionId DESC limit 0,1)  left join ch_user as us on us.userId = od.userId left join ch_user_address as ua on ua.addressId = od.addressId left join ch_coupon as cp on cp.couponId = od.couponId where od.orderId > 0".$filterCond;
        if(empty($this->input->post('search')))

            $queryData = $this->Common_model->exequery($qry);
        else {
            $search = $this->input->post('search'); 
            if (!empty($search))
            	$search = str_replace(['"',"'"], ['', ''], $search);

            $searchCond = " AND (us.firstName LIKE  '%".$search."%' OR ua.city LIKE  '%".$search."%' OR od.grandTotal LIKE  '%".$search."%' OR od.guestEmail LIKE  '%".$search."%' OR od.generatedId LIKE  '%".$search."%' OR od.status LIKE  '%".$search."%' OR ot.paymentStatus LIKE  '%".$search."%' OR od.addedOn LIKE  '%".$search."%' OR od.addedOn LIKE '%".$search."%' ) ";
            $queryData = $this->Common_model->exequery($qry.$searchCond);
        }
        
        $data = array();
        $fp = fopen('ORDERS.csv', 'w');
    	$i = 0;

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {
            	
            	

            	
                if($i == 0){
		            fputcsv($fp, array_keys((array)$row));
		        }
		        fputcsv($fp, array_values((array)$row));
		        $i++;

            }
        }



    	fclose($fp);
    	if(urlExist(BASEURL.'/ORDERS.csv') && !empty($queryData))
    		return array("valid" => true);
    	else
    		return $response;

  
	}

	public function changeOrderStatus(){
		$updateStatus = 0;
		$response = array("valid" => false, "data" => array(), "msg" => "Something Went Wrong");

			
		//cheking permission role
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_order','can_edit_order'],0);
		if(!$checkRolePermission['valid'])
			return $checkRolePermission;
		
		if(isset($_POST['paymentStatus']) && $_POST['paymentStatus'] == 1 && isset($_POST['detailId']) && !empty($_POST['detailId'])){
			if (isset($_POST['orderId']) && !empty($_POST['orderId'])) {
				$cond = "status =5 AND orderId = '".trim($_POST['orderId'])."'";
				$cond01 = " AND de.status =5 AND de.orderId = '".trim($_POST['orderId'])."'";
			}else{

				$cond = "status =5 AND detailId = '".trim($_POST['detailId'])."'";
				$cond01 = " AND de.status =5 AND de.detailId = '".trim($_POST['detailId'])."'";
			}
			$updateStatus = $this->Common_model->update(tablePrefix."order_detail", array('isPaidToVendor' => 1), $cond);
			if ($updateStatus) {
				$orderDetailData=$this->Common_model->exequery("SELECT DISTINCT de.vendorId, de.orderId, od.userId FROM ch_order_detail as de left join ch_order as od on od.orderId = de.orderId WHERE de.orderId > 0 ".$cond01);
				if ($orderDetailData) {
					foreach ($orderDetailData as $detail) {
						$isExist = $this->Common_model->exequery("SELECT notificationId FROM ch_notification WHERE role = 'vendor' AND roleId='".$detail->vendorId."' AND type = 'order_item_payment_completed' AND typeId='".trim($_POST['detailId'])."'",1);
						if(empty($isExist) && $detail->vendorId > 0)
							$this->Common_model->insert(tablePrefix."notification", array("role" => 'vendor', "roleId" =>$detail->vendorId, "type" => 'order_item_payment_completed', "typeId" => trim($_POST['detailId']), "status" => 0, "addedOn" => date('Y-m-d H:i:s'), "updatedOn" => date('Y-m-d H:i:s')));
					}
				}
			}

		}else if(isset($_POST['status']) && $_POST['status'] == 6 && isset($_POST['orderId']) && !empty($_POST['orderId'])){
			$updateStatus = $this->Common_model->update(tablePrefix."order_detail", array('status' => trim($_POST['status'])), " status < 5 AND orderId ='".$_POST['orderId']."' ");
			if ($updateStatus) {

				$orderData=$this->Common_model->exequery("SELECT userId FROM ch_order WHERE orderId='".trim($_POST['orderId'])."'",1);
				if (isset($orderData->userId)) {
					$this->Common_model->insert(tablePrefix."notification", array("role" => 'user', "roleId" =>$orderData->userId, "type" => 'order_cancelled', "typeId" => trim($_POST['orderId']), "status" => 0, "addedOn" => date('Y-m-d H:i:s'), "updatedOn" => date('Y-m-d H:i:s')));
				}
			}

		}else if(isset($_POST['status']) && isset($_POST['detailId']) && !empty($_POST['detailId'])){
			$updateStatus = $this->Common_model->update(tablePrefix."order_detail", array('status' => trim($_POST['status'])), " status < '".trim($_POST['status'])."' AND detailId ='".$_POST['detailId']."' ");
			if ($updateStatus && trim($_POST['status']) == 5) {
				$orderDetailData=$this->Common_model->exequery("SELECT de.detailId, de.orderId, od.userId FROM ch_order_detail as de left join ch_order as od on od.orderId = de.orderId WHERE de.status = 5 AND de.detailId='".trim($_POST['detailId'])."'",1);
				if ($orderDetailData) {

					if (isset($orderDetailData->userId)) {
						$isExist = $this->Common_model->exequery("SELECT notificationId FROM ch_notification WHERE role = 'user' AND roleId='".$orderDetailData->userId."' AND type = 'order_item_delivered' AND typeId='".$orderDetailData->detailId."'",1);
						if(empty($isExist) && $orderDetailData->userId > 0)
							$this->Common_model->insert(tablePrefix."notification", array("role" => 'user', "roleId" =>$orderDetailData->userId, "type" => 'order_item_delivered', "typeId" => $orderDetailData->detailId, "status" => 0, "addedOn" => date('Y-m-d H:i:s'), "updatedOn" => date('Y-m-d H:i:s')));
					}
					
				}
			}

		}else if(isset($_POST['vendorId']) && !empty($_POST['vendorId']) && isset($_POST['detailId']) && !empty($_POST['detailId'])){
			$updateStatus = $this->Common_model->update(tablePrefix."order_detail", array('vendorId' => trim($_POST['vendorId']),'vendorAmt' => trim($_POST['vendorAmt']),'status' => 0), "detailId ='".$_POST['detailId']."'");

			if ($updateStatus) {
				$isExist = $this->Common_model->exequery("SELECT notificationId FROM ch_notification WHERE role = 'vendor' AND roleId='".trim($_POST['detailId'])."' AND type = 'order_assigned' AND typeId='".trim($_POST['detailId'])."'",1);
				if(empty($isExist))
					$this->Common_model->insert(tablePrefix."notification", array("role" => 'vendor', "roleId" =>trim($_POST['vendorId']), "type" => 'order_assigned', "typeId" => trim($_POST['detailId']), "status" => 0, "addedOn" => date('Y-m-d H:i:s'), "updatedOn" => date('Y-m-d H:i:s')));
			}

		}
		if( $updateStatus ){
			$this->common_lib->updateOrderStatus(0, $_POST['detailId']);

			return array("valid" => true, "data" => array(), "msg" => (isset($_POST['vendorId']) && !empty($_POST['vendorId']))?"Selected orders are assigned to vendor successfully.":"Selected orders are updated successfully.");
		}
		else 
			return $response;
	}


	public function addVendor($data, $filedata) {
		if(isset($data['vendorName']) && !empty($data['vendorName'])) {
			$vendorId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
			
			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_vendor',($vendorId)?'can_edit_vendor':'can_create_vendor'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;


			$condAuth = ""; 
			$condArray = array("status != " => "2", "vendorName" => $data['vendorName']);
			if( $vendorId > 0 ){
				$condArray['vendorId != '] = $vendorId; 
				$condAuth = " AND roleId !='".$vendorId."'"; 
			}

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."vendor", "vendorId", $condArray);
			if( $checkExits )
				return array("valid" => false, "msg" => "Vendor Already Exist!");

			$isExist = $this->Common_model->exequery("SELECT * FROM ch_auths WHERE status != 2 and (email = '".$_POST['email']."' || phoneNumber = '".$_POST['mobile']."')".$condAuth,1);
			if (isset($isExist->email)){
				if ($isExist->email == $_POST['email'])
	                return array("valid" => false, "msg" => "This email is already in use, Please try with another email Id.");
				else
					return array("valid" => false, "msg" => "Mobile Number is already in use, Please try with another.");
			}

			$insertData = array();
			$insertData['vendorName'] = trim($data['vendorName']);
			$insertData['contactName']	=   trim($_POST['contactName']);
			$insertData['mobile']		=   trim($_POST['mobile']);
			$insertData['alternateNumber']		=   trim($_POST['alternateNumber']);
			$insertData['email']	 		=   trim($_POST['email']);
			$insertData['country']		=   trim($_POST['country']);
			$insertData['state']	 		=   trim($_POST['state']);
			$insertData['city']	 		=   trim($_POST['city']);
			$insertData['address1']		=   trim($_POST['address1']);
			$insertData['address2']		=   trim($_POST['address2']);
			$insertData['pincode']	 	=   trim($_POST['pincode']);
			$insertData['lat']	 		=   trim($_POST['latitude']);
			$insertData['lang']	 		=   trim($_POST['longitude']);
			$insertData['description']	 		=   trim($_POST['description']);
			$insertData['foodLicenseNo']	 		=   trim($_POST['foodLicenseNo']);
			$insertData['accountNumber']	 		=   trim($_POST['accountNumber']);
			$insertData['ifscCode']	 			=   trim($_POST['ifscCode']);
			$insertData['accountHolderName']	 		=   trim($_POST['accountHolderName']);

			$insertData['mondayOpen']	 	=   trim($_POST['mondayOpen']);
			$insertData['tuesdayOpen']	 	=   trim($_POST['tuesdayOpen']);
			$insertData['wednesdayOpen']	=   trim($_POST['wednesdayOpen']);
			$insertData['thursdayOpen']	 	=   trim($_POST['thursdayOpen']);
			$insertData['fridayOpen']	 	=   trim($_POST['fridayOpen']);
			$insertData['saturdayOpen']	 	=   trim($_POST['saturdayOpen']);
			$insertData['sundayOpen']	 	=   trim($_POST['sundayOpen']);
			$insertData['mondayClose']	 	=   trim($_POST['mondayClose']);
			$insertData['tuesdayClose']	 	=   trim($_POST['tuesdayClose']);
			$insertData['wednesdayClose']	=   trim($_POST['wednesdayClose']);
			$insertData['thursdayClose']	=   trim($_POST['thursdayClose']);
			$insertData['fridayClose']	 	=   trim($_POST['fridayClose']);
			$insertData['saturdayClose']	=   trim($_POST['saturdayClose']);
			$insertData['sundayClose']	 	=   trim($_POST['sundayClose']);
			$insertData['closeDays']	 	=   (isset($_POST['closeDays']) && !empty($_POST['closeDays'])) ? implode(',',$_POST['closeDays']) : '';
			$insertData['deliverOnPincodes']	 	=   trim($_POST['deliverOnPincodes']);

			$insertData['updatedOn']	 	=   date('Y-m-d H:i:s');
			$insertData['status'] = 0;
			$insertData['metaTitle'] = (isset($data['metaTitle']) && !empty($data['metaTitle'])) ? $data['metaTitle'] : '';
			$insertData['metaDescription'] = (isset($data['metaDescription']) && !empty($data['metaDescription'])) ? $data['metaDescription'] : '';
			$insertData['keywords'] = (isset($data['metaKeywords']) && !empty($data['metaKeywords'])) ? $data['metaKeywords'] : '';
			$insertData['isShownOnOurStores'] = (isset($data['isShownOnOurStores']) && !empty($data['isShownOnOurStores'])) ? 1 : '';
			

			if(isset($filedata) && !empty($filedata)) {
				$fileInfo = $this->common_lib->uploadImageFile($filedata, "images", false, "uploadIcons" );
				if(!empty($fileInfo['filename'])) {
					$imageId = $this->Common_model->insertUnique(tablePrefix."images", array("imageName" => $fileInfo['filename'], "addedBY" => $this->session->userdata(PREFIX."sessAuthId"), "metaTitle" => '', "status" => 0, "addedOn" => date('Y-m-d H:i:s')));
					$insertData['imageId'] = ($imageId) ? $imageId : 0;
				}elseif(!$fileInfo['valid'])
					return array("valid" => false, "msg" => ($fileInfo['msg'])?$fileInfo['msg']:"Something went wrong with image.");

			}


			if( $vendorId > 0 ){
				$updateStatus = $this->Common_model->update(tablePrefix."vendor", $insertData, "vendorId = ".$vendorId);
				if( $updateStatus )
					$authStatus = $this->createAuth($updateStatus, $role ='vendor', $insertData['email'], $insertData['mobile'], '',1);
			}else {

				$vendorSlug = $this->common_lib->create_unique_slug(trim($data['vendorName']),tablePrefix."vendor","slug",$vendorId,"vendorId",$counter=0);

				$insertData['slug']			 =   $vendorSlug;
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$authStatus = '';
				$this->db->trans_start();
				$updateStatus = $this->Common_model->insertUnique(tablePrefix."vendor", $insertData);
				if( $updateStatus )
					$authStatus = $this->createAuth($updateStatus, $role ='vendor', $insertData['email'], $insertData['mobile'], trim($_POST['password']),0);

				if ($this->db->trans_status() === FALSE || !$authStatus || !$updateStatus){
					$this->db->trans_rollback();
					$updateStatus = false;
				}else
					$this->db->trans_commit();
				
			}

			if( $updateStatus )
				return array("valid" => true, "msg" => ( $vendorId > 0 )?"Vendor Updated Successfully!":"Vendor Added Successfully!");
			else
				return array("valid" => false, "msg" => "Something went wrong.");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Vendor name is required!");
	}

	public function vendorList() {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_vendor','can_view_vendor'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );


		$columns = array( 0 => "imageId", 1 => "vendorName", 2 => "mobile", 3 => "email", 4 => "city", 5 => "status", 6 => "vendorId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."vendor as vd where vd.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT vd.*,  (case when imageId != 0 then (SELECT concat('".UPLOADPATH."/images/', imageName) FROM ".tablePrefix."images  WHERE imageId = vd.imageId ) else '' end) as icons from ".tablePrefix."vendor as vd where vd.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search))
            	$search = str_replace(['"',"'"], ['', ''], $search);

            $searchCond = " AND (vd.vendorName LIKE  '%".$search."%' OR vd.email LIKE  '%".$search."%' OR vd.mobile LIKE  '%".$search."%' OR vd.city LIKE  '%".$search."%' OR vd.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."vendor as vd where vd.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		
                $nestedData['icons'] = ( $row->icons != '' ) ? '<img src="'.$row->icons.'" width="30px" height="30px">' : "";
                $nestedData['vendorName'] = $row->vendorName;
                $nestedData['mobile'] = $row->mobile;
                $nestedData['email'] = $row->email;
                $nestedData['city'] = $row->city;
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }

				$nestedData['action'] = '';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_order','can_view_order'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<a class="btn btn-icons btn-rounded btn-light" title="Order" href="'.DASHURL.'/admin/order/index/'.$row->vendorId.'"><i class="fa fa-file"></i></a>';

                $nestedData['action'] .= '<a class="btn btn-icons btn-rounded btn-light" title="view" href="'.DASHURL.'/admin/vendor/detail/'.$row->vendorId.'"><i class="fa fa-eye"></i></a>';

                $rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_vendor','can_edit_vendor'],0);
				if($rolePermission['valid'])
                	$nestedData['action'] .= '<a class="btn btn-icons btn-rounded btn-light" title="Edit" href="'.DASHURL.'/admin/vendor/add/'.$row->vendorId.'"><i class="fa fa-pencil"></i></a><button onclick="ActivateDeActivateThisRecord(this,\'vendor\','.$row->vendorId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button>';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_vendor','can_delete_vendor'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light" title="Delete Vendor" onclick="delete_row(this,\'vendor\','.$row->vendorId.');"><i class="fa fa-trash-o"></i></button>';

                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}

	public function addEmployee($data, $filedata) {
		if(isset($data['employeeName']) && !empty($data['employeeName'])) {
			$employeeId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
			
			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_employee',($employeeId)?'can_edit_employee':'can_create_employee'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;


			$condAuth = ""; 
			$condArray = array("status != " => "2", "vendorId" => $data['vendorId'], "roleId" => $data['roleId'], "employeeName" => $data['employeeName']);
			if( $employeeId > 0 ){
				$condArray['employeeId != '] = $employeeId; 
				$condAuth = " AND roleId !='".$employeeId."'"; 
			}

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."employee", "employeeId", $condArray);
			if( $checkExits )
				return array("valid" => false, "msg" => "Employee Already Exist!");

			$isExist = $this->Common_model->exequery("SELECT * FROM ch_auths WHERE status != 2 and (email = '".$_POST['email']."' || phoneNumber = '".$_POST['mobile']."')".$condAuth,1);
			if (isset($isExist->email)){
				if ($isExist->email == $_POST['email'])
	                return array("valid" => false, "msg" => "This email is already in use, Please try with another email Id.");
				else
					return array("valid" => false, "msg" => "Mobile Number is already in use, Please try with another.");
			}

			$insertData = array();
			$insertData['vendorId'] 	= trim($data['vendorId']);
			$insertData['roleId'] 		= trim($data['roleId']);
			$insertData['employeeName'] = trim($data['employeeName']);
			$insertData['mobile']		=   trim($_POST['mobile']);
			$insertData['email']	 		=   trim($_POST['email']);
			$insertData['updatedOn']	 	=   date('Y-m-d H:i:s');
			$insertData['status'] = 0;

			$imageName = $this->uploadImage("employee_images", "uploadIcons" );

					
			if($imageName) 
				$insertData['img'] = $imageName;

			if( $employeeId > 0 ){
				$updateStatus = $this->Common_model->update(tablePrefix."employee", $insertData, "employeeId = ".$employeeId);
				if( $updateStatus )
					$authStatus = $this->createAuth($updateStatus, $role ='employee', $insertData['email'], $insertData['mobile'], '',1);
			}else {

				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$authStatus = '';
				$this->db->trans_start();
				$updateStatus = $this->Common_model->insertUnique(tablePrefix."employee", $insertData);
				if( $updateStatus )
					$authStatus = $this->createAuth($updateStatus, $role ='employee', $insertData['email'], $insertData['mobile'], trim($_POST['password']),0);

				if ($this->db->trans_status() === FALSE || !$authStatus || !$updateStatus){
					$this->db->trans_rollback();
					$updateStatus = false;
				}else
					$this->db->trans_commit();
				
			}

			if( $updateStatus )
				return array("valid" => true, "msg" => ( $employeeId > 0 )?"Employee Updated Successfully!":"Employee Added Successfully!");
			else
				return array("valid" => false, "msg" => "Something went wrong.");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Employee name is required!");
	}

	public function employeeList() {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_employee','can_view_employee'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );


		$columns = array( 0 => "em.employeeId", 1 => "em.employeeName", 2 => "em.mobile", 3 => "em.email", 4 => "vd.vendorName", 5 => "em.status", 6 => "em.employeeId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."employee as em where em.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT em.*, CONCAT(rl.role,' (',(case when rl.addedBy = 'vendor' then vd.vendorName else 'Admin' end), ')') as vendorName, (case when img != '' then concat('".UPLOADPATH."/employee_images/', img) else '' end) as icons from ".tablePrefix."employee as em left join ch_vendor as vd on vd.vendorId = em.vendorId left join ch_role as rl on em.roleId = rl.roleId where em.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search))
            	$search = str_replace(['"',"'"], ['', ''], $search);

            $searchCond = " AND (em.employeeName LIKE  '%".$search."%' OR em.email LIKE  '%".$search."%' OR em.mobile LIKE  '%".$search."%' OR vd.vendorName LIKE  '%".$search."%' OR rl.role LIKE  '%".$search."%' OR rl.addedBy LIKE  '%".$search."%' OR em.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."employee as em left join ch_vendor as vd on vd.vendorId = em.vendorId left join ch_role as rl on em.roleId = rl.roleId where em.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		
                $nestedData['icons'] = ( $row->icons != '' ) ? '<img src="'.$row->icons.'" width="30px" height="30px">' : "";
                $nestedData['employeeName'] = $row->employeeName;
                $nestedData['mobile'] = $row->mobile;
                $nestedData['email'] = $row->email;
                $nestedData['vendorName'] = $row->vendorName;
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }

                $nestedData['action'] = '<a class="btn btn-icons btn-rounded btn-light" title="view" href="'.DASHURL.'/admin/employee/detail/'.$row->employeeId.'"><i class="fa fa-eye"></i></a>';

                $rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_employee','can_edit_employee'],0);
				if($rolePermission['valid'])
                	$nestedData['action'] .= '<a class="btn btn-icons btn-rounded btn-light" title="Edit" href="'.DASHURL.'/admin/employee/add/'.$row->employeeId.'"><i class="fa fa-pencil"></i></a><button onclick="ActivateDeActivateThisRecord(this,\'employee\','.$row->employeeId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button>';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_employee','can_delete_employee'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light" title="Delete Employee" onclick="delete_row(this,\'employee\','.$row->employeeId.');"><i class="fa fa-trash-o"></i></button>';

                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}

	// create auth 
	public function createAuth($roleId, $role ='user', $email, $mobile='', $pass = '123456', $isUpdate=0){
		$status = '';
		
		if(!empty($role) && (!empty($email) || !empty($mobile)) && !empty($pass) && !empty($roleId)) {
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
				$queryData['email']	 	=   $email;
				$queryData['phoneNumber']	 	=   $mobile;
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
						$contentarr['[[[USERNAME]]]']		=	trim($_POST['email']);
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
			}
		}
		return $imageName;
	}

	// Upload icon image
	public function uploadGalleryImage($files, $dirname = '', $fileName = 'galleryImage'){
		$uploaddataArray = array();

		$filesdata = isset($files[$fileName])?$files[$fileName]:array();
		if (isset($filesdata['name']) && !empty($filesdata['name'])) {
			foreach($filesdata['name'] as $key => $image) {
				$_FILES['images']['name']= $filesdata['name'][$key];
	            $_FILES['images']['type']= $filesdata['type'][$key];
	            $_FILES['images']['tmp_name']= $filesdata['tmp_name'][$key];
	            $_FILES['images']['error']= $filesdata['error'][$key];
	            $_FILES['images']['size']= $filesdata['size'][$key];

				$array 			= 	explode(' ', $_FILES['images']['name']);
				$filePhotoName 	= 	end($array);
				$photoToUpload  = 	rand(1000,100000).time().'-'.$filePhotoName;
				
				$uploadSettings['upload_path']   	=	UPLOADDIR."/".$dirname."/";
				$uploadSettings['allowed_types'] 	=	'gif|jpg|png|svg|jpeg';
				$uploadSettings['file_name']	  	= 	$photoToUpload;
				$uploadSettings['inputFieldName']  	=  	'images';

			   	if(!is_dir($uploadSettings['upload_path']))
			   		mkdir($uploadSettings['upload_path'], 0777, TRUE);

				$fileUpload = $this->common_lib->_doUpload($uploadSettings);
				if ($fileUpload) {
				    $imgData = $this->upload->data();
				    array_push($uploaddataArray, $imgData['file_name']);
				}
			}
		}

		return $uploaddataArray;
	}





	/******************     start role module  *****************************/
	public function addRole($data) {

		
		//cheking permission role
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_role','can_create_role'],0);
		if(!$checkRolePermission['valid'])
			return $checkRolePermission;

        if(isset($data['role']) && !empty($data['role'])) {
            $condAuth = ""; 
            $condArray = array("status != " => "2", "addedById" => $data['vendorId'], "role" => $data['role']);

            $checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."role", "roleId", $condArray);
            if( $checkExits )
                return array("valid" => false, "msg" => "Role Already Exist!");

            $insertData = array();
            $insertData['addedBy'] = (trim($data['vendorId']) > 0)?'vendor':'admin';
            $insertData['addedById'] = trim($data['vendorId']);
            $insertData['role'] = trim($data['role']);
            $insertData['updatedOn']        =   date('Y-m-d H:i:s');
            $insertData['addedOn'] = date('Y-m-d H:i:s');
            $insertData['status'] = 0;

            $updateStatus = $this->Common_model->insertUnique(tablePrefix."role", $insertData);
             
            if( $updateStatus )
                return array("valid" => true, "msg" => "Role Added Successfully!");
            else
                return array("valid" => false, "msg" => "Something went wrong.");

        }
        else 
            return array("valid" => false, "msg" => "Role is required!");
    }

    public function updateRolePermision(){
    	if(isset($_POST['hiddenval']) && !empty($_POST['hiddenval'])) {
	    	$roleId = $this->input->post('hiddenval');

			
			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_role','can_edit_role'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

	        unset($_POST['action']);unset($_POST['hiddenval']);
			$updateStatus = $this->Common_model->update("ch_role",['permissions'=>empty($_POST)?'':serialize($_POST)],"roleId = '".$roleId."'");
			if( $updateStatus ){
				if($this->sessEmployeeRoleId > 0)
					$this->session->set_userdata(PREFIX.'sessPermissions',array_keys($_POST));
                return array("valid" => true, "msg" => "Permissions are updated Successfully!");
			}
            else
                return array("valid" => false, "msg" => "Something went wrong.");
	    }
        else 
            return array("valid" => false, "msg" => "Role is required!");
    }

	public function roleList() {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_role','can_view_role'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );


		$columns = array( 0 => "rl.role", 1 => "vd.vendorName", 2 => "totalEmp", 3 => "rl.addedOn", 4 => "rl.roleId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."role as rl where rl.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT rl.*, vd.vendorName, (case when rl.addedBy = 'vendor' then vd.vendorName else 'Admin' end) as vendorName, (SELECT COUNT(*) FROM ch_employee WHERE roleId = rl.roleId AND status !=2) as totalEmp from ".tablePrefix."role as rl left join ch_vendor as vd on (vd.vendorId = rl.addedById AND rl.addedBy = 'vendor') where rl.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search))
            	$search = str_replace(['"',"'"], ['', ''], $search);

            $searchCond = " AND (rl.role LIKE  '%".$search."%' OR vendorName LIKE  '%".$search."%' OR rl.addedOn LIKE  '%".$search."%') ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."role as rl left join ch_vendor as vd on (vd.vendorId = rl.addedById AND rl.addedBy = 'vendor') where rl.status != 2".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            	
                $nestedData['role'] = $row->role;
                $nestedData['vendorName'] = $row->vendorName;
                $nestedData['totalEmp'] = $row->totalEmp;
                $nestedData['addedOn'] = $row->addedOn;

 				$nestedData['action'] = '<a class="btn btn-icons btn-rounded btn-light" title="Edit Permission" href="'.DASHURL.'/admin/role/permission/'.$row->roleId.'"><i class="fa fa-universal-access"></i></a>';

				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_role','can_delete_role'],0);
				if($rolePermission['valid'] && $row->totalEmp == 0)
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light" title="Delete Role" onclick="delete_row(this,\'role\','.$row->roleId.');"><i class="fa fa-trash-o"></i></button>';
               
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}


	/******************     end role module  *****************************/

	// admin change status of records
	public function updatePassword($data){	

		$response =	 array('valid'=>false, 'msg'=>'Something is wrong.');
		//Verify current password
		$condPass = "email = '".$this->sessEmail."' AND password = '". md5(trim($_POST['form_current_password']))."'";
		$authId =	$this->Common_model->getSelectedField("ch_auths", "authId", $condPass);
		
		if($authId) {	
			//Update password
			$updateData['password']	=   md5(trim($_POST['password_1']));
			$updateStatus 			= 	$this->Common_model->update("ch_auths", $updateData, $condPass);
			
			if($updateStatus)	{	
				//Send welcome email
				$settings = array();
				$settings["template"] 		=  "password_changed_tpl.html";
				$settings["email"] 			=  $this->sessEmail; 
				$settings["subject"] 		=  "CHASHMA4U Dashboard - password has been changed";
				$contentarr['[[[USERNAME]]]']		=	$this->sessEmail;
				$contentarr['[[[PASSWORD]]]']		=	trim($_POST['password_1']);
				$contentarr['[[[DASHURL]]]']		=	DASHURL."/".$this->sessDashboard."/login";
				$settings["contentarr"] 			= 	$contentarr;
				$this->common_lib->sendMail($settings);	
				$response =	 array('valid'=>true, 'msg'=>'Success! New password is set.');
			}else
				$response['msg']="Failed! Something is wrong.";
		}else
			$response['msg']="Failed! Current password is incorrect.";
		
		return $response;

	}

	public function editProfile($data, $filedata) {
		if(isset($data['employeeName']) && !empty($data['employeeName'])) {
			$employeeId = $this->sessRoleId;

			$condAuth = ""; 
			$condArray = array("status != " => "2", "vendorId" => $this->sessEmployeeAddedById, "roleId" => $this->sessEmployeeRoleId, "employeeName" => $data['employeeName']);
			if( $employeeId > 0 ){
				$condArray['employeeId != '] = $employeeId; 
				$condAuth = " AND roleId !='".$employeeId."'"; 
			}

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."employee", "employeeId", $condArray);
			if( $checkExits )
				return array("valid" => false, "msg" => "Name Already Exist!");

			$isExist = $this->Common_model->exequery("SELECT * FROM ch_auths WHERE status != 2 and (email = '".$_POST['email']."' || phoneNumber = '".$_POST['mobile']."')".$condAuth,1);
			if (isset($isExist->email)){
				if ($isExist->email == $_POST['email'])
	                return array("valid" => false, "msg" => "This email is already in use, Please try with another email Id.");
				else
					return array("valid" => false, "msg" => "Mobile Number is already in use, Please try with another.");
			}

			$insertData = array();
			$insertData['employeeName'] = trim($data['employeeName']);
			$insertData['mobile']		=   trim($_POST['mobile']);
			$insertData['email']	 		=   trim($_POST['email']);
			$insertData['updatedOn']	 	=   date('Y-m-d H:i:s');

			$imageName = $this->uploadImage("employee_images", "uploadIcons" );

					
			if($imageName) 
				$insertData['img'] = $imageName;

			$updateStatus = ($employeeId > 0 )?$this->Common_model->update(tablePrefix."employee", $insertData, "employeeId = ".$employeeId):0;

			if( $updateStatus ){
				$authStatus = $this->createAuth($employeeId, $role ='employee', $insertData['email'], $insertData['mobile'], '',1);
				return array("valid" => true, "msg" => "Profile Updated Successfully!");
			}
			else
				return array("valid" => false, "msg" => "Something went wrong.");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Name is required!");
	}

	public function addUpdateSetting($data, $filedata) {
		$updateStatus = '';

		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting','can_view_setting'],0);
		if(!$checkRolePermission['valid'])
				return $checkRolePermission;
		
		$frontPageSettingData = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'front_page'",1);
		if (isset($frontPageSettingData->value)) {
            $frontData = !empty($frontPageSettingData->value)?unserialize($frontPageSettingData->value):array();
            $frontData = (!empty($frontData))?$frontData: array();
            	
			if (isset($data['header_script'])) {
				$frontData['header_script'] = $data['header_script'];
				$frontData['footer_script'] = $data['footer_script'];
				$frontData['offer_slider'] = $data['offer_slider'];
			}

			if (isset($data['sliderId']))
				$frontData['slider'] = implode(',', $data['sliderId']);

			if (isset($data['category_section_category']))
				$frontData['category_section_category'] = ($data['category_section_category'])?implode(',', $data['category_section_category']):'';			

			
			for ($i=1; $i < 10; $i++) {
				if (isset($data['product_slider_'.$i.'_title'])){
					$frontData['product_slider_'.$i.'_title'] = trim($data['product_slider_'.$i.'_title']);
					$frontData['product_slider_'.$i.'_btn_title'] = trim($data['product_slider_'.$i.'_btn_title']);
					$frontData['product_slider_'.$i.'_btn_url'] = trim($data['product_slider_'.$i.'_btn_url']);
					$frontData['product_slider_'.$i.'_product'] = (isset($data['product_slider_'.$i.'_product']) && !empty($data['product_slider_'.$i.'_product']))?implode(',', $data['product_slider_'.$i.'_product']):'';
				}
			}

			if (isset($data['sale_banner_title'])) {
				$frontData['sale_banner_title'] = $data['sale_banner_title'];
				$frontData['sale_banner_text1'] = $data['sale_banner_text1'];
				$frontData['sale_banner_text2'] = $data['sale_banner_text2'];
				$frontData['sale_banner_btn_text'] = $data['sale_banner_btn_text'];
				$frontData['sale_banner_btn_url'] = $data['sale_banner_btn_url'];
				

				$imageName = $this->uploadImage('setting_images', 'uploadIcons');
				if(!empty($imageName))
					$frontData['sale_banner_img'] = $imageName;
			}

			$updateStatus = $this->Common_model->update(tablePrefix."setting", ['value'=> serialize($frontData)], "name = 'front_page' ");
        }
		
		

		if( $updateStatus )
			return array("valid" => true, "msg" => "Setting Updated Successfully!");

		else
			return array("valid" => false, "msg" => "Something went wrong.");

			
	}

	public function addUpdateFranchiseSetting($data, $filedata) {
		$updateStatus = '';

		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting','can_view_setting'],0);
		if(!$checkRolePermission['valid'])
				return $checkRolePermission;
		
		$franchisePageSettingData = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'franchise_page'",1);
		if (isset($franchisePageSettingData->name)) {
			
            $franchiseData = !empty($franchisePageSettingData->value)?unserialize($franchisePageSettingData->value):array();
            $franchiseData = (!empty($franchiseData))?$franchiseData: array();
            	
			if (isset($data['banner_title'])) {
				$franchiseData['banner_title'] = $data['banner_title'];
				$franchiseData['banner_description'] = $data['banner_description'];
				$franchiseData['tab_1_title'] = $data['tab_1_title'];
				$franchiseData['tab_1_description'] = $data['tab_1_description'];
				$franchiseData['tab_2_title'] = $data['tab_2_title'];
				$franchiseData['tab_2_description'] = $data['tab_2_description'];
				$franchiseData['tab_3_title'] = $data['tab_3_title'];
				$franchiseData['tab_3_description'] = $data['tab_3_description'];
				$franchiseData['tab_4_title'] = $data['tab_4_title'];
				$franchiseData['tab_4_description'] = $data['tab_4_description'];

				$imageName = $this->uploadImage("franchise_banner_image", "uploadIcons" );
						
				if($imageName) 
					$franchiseData['banner_image'] = $imageName;
				else if(!isset($franchiseData['banner_image']) || empty($franchiseData['banner_image']))
					return array("valid" => false, "msg" => "Failed to upload image.");
			}
           

			$updateStatus = $this->Common_model->update(tablePrefix."setting", ['value'=> serialize($franchiseData)], "name = 'franchise_page' ");
        }
		
		

		if( $updateStatus )
			return array("valid" => true, "msg" => "Setting Updated Successfully!");

		else
			return array("valid" => false, "msg" => "Something went wrong.");

			
	}

	public function addUpdateOrderSetting($data) {
		$updateStatus = '';

		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting','can_view_setting'],0);
		if(!$checkRolePermission['valid'])
				return $checkRolePermission;
		
		$settingData = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'order_setting'",1);
		if (isset($settingData->name)) {
			
            $settingDetails = !empty($settingData->value)?unserialize($settingData->value):array();
            $settingDetails = (!empty($settingDetails))?$settingDetails: array();
            	
			
			
			if (isset($data['activePaymentMethods']))
				$settingDetails['activePaymentMethods'] = implode(',', $data['activePaymentMethods']);
           

			$updateStatus = $this->Common_model->update(tablePrefix."setting", ['value'=> serialize($settingDetails)], "name = 'order_setting' ");
        }else if (isset($data['activePaymentMethods'])){
        	$settingDetails['activePaymentMethods'] = implode(',', $data['activePaymentMethods']);
			$updateStatus = $this->Common_model->insert(tablePrefix."setting", ['name' => 'order_setting','value'=> serialize($settingDetails)]);
        }
		
		

		if( $updateStatus )
			return array("valid" => true, "msg" => "Setting Updated Successfully!");

		else
			return array("valid" => false, "msg" => "Something went wrong.");

			
	}


	public function addFrontSocialIcons($data, $filedata) {
		if(isset($data['btnUrl']) && !empty($data['btnUrl'])) {
			$socialId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
			
			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting',($socialId)?'can_edit_setting':'can_create_setting'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			$insertData['btnUrl'] = $data['btnUrl'];
			$insertData['updatedOn'] = date('Y-m-d H:i:s');

			
			$condArray = array("status != " => "2", "btnUrl" => $data['btnUrl']);
			if( $socialId > 0 )
				$condArray['socialId != '] = $socialId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."front_page_social_icons", "socialId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Social Url Already Exist!");
			

			$imageName = $this->uploadImage('social_images', 'uploadIcons');
			if(!empty($imageName))
				$insertData['img'] = $imageName;

			if( $socialId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."front_page_social_icons", $insertData, "socialId = ".$socialId);
			else {
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$updateStatus = $this->Common_model->insert(tablePrefix."front_page_social_icons", $insertData);
			}

			if( $updateStatus )
				return array("valid" => true, "data" => array(), "msg" => ($socialId)?"Social Icon Updated Successfully!":"Social Icon Added Successfully!");
			else
				return array("valid" => false, "data" => array(), "msg" => "Something went wrong.");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Url is required!");
	}

	function getFrontSocialIconsList() {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting','can_view_setting'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );

		$columns = array( 0 => "img", 1 => "btnUrl", 2 => "status", 3 => "socialId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."front_page_social_icons as cat where cat.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT cat.* from ".tablePrefix."front_page_social_icons as cat where cat.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (cat.btnUrl LIKE  '%".$search."%' OR cat.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."front_page_social_icons as cat where cat
            	.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['img'] = '<img src="'.UPLOADPATH.'/social_images/'.$row->img.'" class="preview_img">';
                $nestedData['btnUrl'] = $row->btnUrl;
                
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
                $nestedData['action'] = '';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting','can_edit_setting'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light editSocialIcon" title="Edit" data-id="'.$row->socialId.'"><i class="fa fa-pencil"></i></button><button onclick="ActivateDeActivateThisRecord(this,\'front_page_social_icons\','.$row->socialId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button><button class="btn btn-icons btn-rounded btn-light deleteZone" title="Delete Slider" onclick="delete_row(this,\'front_page_social_icons\','.$row->socialId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}
	
	public function addUpdateCorporateSetting($data, $filedata) {
		$updateStatus = '';

		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting','can_view_setting'],0);
		if(!$checkRolePermission['valid'])
				return $checkRolePermission;
		
		$corporatePageSettingData = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'corporate_page'",1);
		if (isset($corporatePageSettingData->name)) {
			
            $corporateData = !empty($corporatePageSettingData->value)?unserialize($corporatePageSettingData->value):array();
            $corporateData = (!empty($corporateData))?$corporateData: array();
            	
			if (isset($data['banner_title'])) {
				$corporateData['banner_title'] = $data['banner_title'];
				$corporateData['banner_description'] = $data['banner_description'];
				$corporateData['button_text'] = $data['button_text'];
				$corporateData['button_url'] = $data['button_url'];
				$corporateData['benefit'] = implode(',', $data['benefitId']);
				$corporateData['personalised_gift_other_category'] = implode(',', $data['personalised_gift_other_category']);
			    $corporateData['extra_desc'] = $data['extra_desc'];
			    if (isset($data['customer_review'])){
					$corporateData['customer_review'] = implode(',', $data['customer_review']);
			    }

				$corporateData['tab_3_steps1_text1'] = $data['tab_3_steps1_text1'];
                $corporateData['tab_3_steps1_text2'] = $data['tab_3_steps1_text2'];
                $corporateData['tab_3_steps1_text3'] = $data['tab_3_steps1_text3'];
                $corporateData['tab_3_steps2_text1'] = $data['tab_3_steps2_text1'];
                $corporateData['tab_3_steps2_text2'] = $data['tab_3_steps2_text2'];
                $corporateData['tab_3_steps3_text1'] = $data['tab_3_steps3_text1'];
                $corporateData['tab_3_steps3_text2'] = $data['tab_3_steps3_text2'];
                
                $corporateData['tab_5_partners_text1'] = $data['tab_5_partners_text1'];
                $corporateData['tab_5_partners_text2'] = $data['tab_5_partners_text2'];
                $corporateData['tab_5_partners_text3'] = $data['tab_5_partners_text3'];
                $corporateData['tab_5_partners_text4'] = $data['tab_5_partners_text4'];
                $corporateData['tab_5_partners_text5'] = $data['tab_5_partners_text5'];

				$imageName = $this->uploadImage("corporate_page_image", "uploadIcons");
				if($imageName) 
					$corporateData['banner_image'] = $imageName;

				$imageName = $this->uploadImage("corporate_page_image", "tab_3_steps1_img");
				if($imageName) 
					$corporateData['tab_3_steps1_img'] = $imageName;
				
				$imageName = $this->uploadImage("corporate_page_image", "tab_3_steps2_img");
				if($imageName) 
					$corporateData['tab_3_steps2_img'] = $imageName;
				
				$imageName = $this->uploadImage("corporate_page_image", "tab_3_steps3_img");
				if($imageName) 
					$corporateData['tab_3_steps3_img'] = $imageName;
				

				$imageName = $this->uploadImage("corporate_page_image", "tab_5_partners_img1");
				if($imageName) 
					$corporateData['tab_5_partners_img1'] = $imageName;
				
				$imageName = $this->uploadImage("corporate_page_image", "tab_5_partners_img2");
				if($imageName) 
					$corporateData['tab_5_partners_img2'] = $imageName;
				
				$imageName = $this->uploadImage("corporate_page_image", "tab_5_partners_img3");
				if($imageName) 
					$corporateData['tab_5_partners_img3'] = $imageName;
				
                
                $imageName = $this->uploadImage("corporate_page_image", "tab_5_partners_img4");
				if($imageName) 
					$corporateData['tab_5_partners_img4'] = $imageName;
				
                
                $imageName = $this->uploadImage("corporate_page_image", "tab_5_partners_img5");
				if($imageName) 
					$corporateData['tab_5_partners_img5'] = $imageName;
				
			}
           

			$updateStatus = $this->Common_model->update(tablePrefix."setting", ['value'=> serialize($corporateData)], "name = 'corporate_page' ");
        }
		
		

		if( $updateStatus )
			return array("valid" => true, "msg" => "Setting Updated Successfully!");

		else
			return array("valid" => false, "msg" => "Something went wrong.");

			
	}
	
	public function addUpdateTermsSetting($data) {
		$updateStatus = '';

		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting','can_view_setting'],0);
		if(!$checkRolePermission['valid'])
				return $checkRolePermission;
		$insertData = array();
		$insertData['name'] = 'terms_condition_page';
		$insertData['value'] = $data['description'];
		$insertData['updatedOn'] = date('Y-m-d H:i:s');
		$corporatePageSettingData = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'terms_condition_page'",1);
		if (isset($corporatePageSettingData->name)) {
			$updateStatus = $this->Common_model->update(tablePrefix."setting", $insertData, "name = 'terms_condition_page' ");
        }else{

			$insertData['addedOn'] = date('Y-m-d H:i:s');			
			$updateStatus = $this->Common_model->insert(tablePrefix."setting", $insertData);
        }
		
		

		if( $updateStatus )
			return array("valid" => true, "msg" => "Setting Updated Successfully!");

		else
			return array("valid" => false, "msg" => "Something went wrong.");

			
	}
	
	public function addUpdatePolicySetting($data) {
		$updateStatus = '';

		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting','can_view_setting'],0);
		if(!$checkRolePermission['valid'])
				return $checkRolePermission;
		$insertData = array();
		$insertData['name'] = 'privacy_policy_page';
		$insertData['value'] = $data['description'];
		$insertData['updatedOn'] = date('Y-m-d H:i:s');
		$corporatePageSettingData = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'privacy_policy_page'",1);
		if (isset($corporatePageSettingData->name)) {
			$updateStatus = $this->Common_model->update(tablePrefix."setting", $insertData, "name = 'privacy_policy_page' ");
        }else{

			$insertData['addedOn'] = date('Y-m-d H:i:s');			
			$updateStatus = $this->Common_model->insert(tablePrefix."setting", $insertData);
        }
		
		

		if( $updateStatus )
			return array("valid" => true, "msg" => "Setting Updated Successfully!");

		else
			return array("valid" => false, "msg" => "Something went wrong.");

			
	}
	
	public function addUpdateAboutSetting($data) {
		$updateStatus = '';

		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting','can_view_setting'],0);
		if(!$checkRolePermission['valid'])
				return $checkRolePermission;
		$insertData = array();
		$insertData['name'] = 'about_page';
		$insertData['value'] = $data['description'];
		$insertData['updatedOn'] = date('Y-m-d H:i:s');
		$corporatePageSettingData = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'about_page'",1);
		if (isset($corporatePageSettingData->name)) {
			$updateStatus = $this->Common_model->update(tablePrefix."setting", $insertData, "name = 'about_page' ");
        }else{

			$insertData['addedOn'] = date('Y-m-d H:i:s');			
			$updateStatus = $this->Common_model->insert(tablePrefix."setting", $insertData);
        }
		
		

		if( $updateStatus )
			return array("valid" => true, "msg" => "Setting Updated Successfully!");

		else
			return array("valid" => false, "msg" => "Something went wrong.");

			
	}
	
	public function addUpdateFooterSetting($data) {
		$updateStatus = '';

		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting','can_view_setting'],0);
		if(!$checkRolePermission['valid'])
				return $checkRolePermission;
		
		$footerPageSettingData = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'front_footer'",1);
		if (isset($footerPageSettingData->name)) {
			
            $footerData = !empty($footerPageSettingData->value)?unserialize($footerPageSettingData->value):array();
            $footerData = (!empty($footerData))?$footerData: array();
            	
			if (isset($data['column_1_title'])) {
				$footerData['column_1_title'] = $data['column_1_title'];
				$footerData['column_1_description'] = $data['column_1_description'];
				$footerData['column_2_title'] = $data['column_2_title'];
				$footerData['column_2_description'] = $data['column_2_description'];
				$footerData['column_3_title'] = $data['column_3_title'];
				$footerData['column_3_description'] = $data['column_3_description'];
				$footerData['column_4_title'] = $data['column_4_title'];
				$footerData['column_4_description'] = $data['column_4_description'];
				$footerData['column_5_title'] = $data['column_5_title'];
				$footerData['column_5_description'] = $data['column_5_description'];
				$footerData['social_title'] = $data['social_title'];

				if (isset($data['social_icon_ids']))
					$footerData['social_icon_ids'] = implode(',', $data['social_icon_ids']);
			}
           
			$updateStatus = $this->Common_model->update(tablePrefix."setting", ['value'=> serialize($footerData)], "name = 'front_footer' ");
        }
		
		

		if( $updateStatus )
			return array("valid" => true, "msg" => "footer setting Updated Successfully!");

		else
			return array("valid" => false, "msg" => "Something went wrong.");

			
	}




 	// zone csv upload
	// public function addZoneCSV(){
	// 	$this->load->library('excel');
	// 	$qry = "INSERT INTO `ch_zone`(`zoneName`, `slug`, `lastDeliveryTime`, `isPopular`, `Description`, `imageId`, `metaTitle`, `metaDescription`, `keywords`, `status`, `addedOn`, `updatedOn`) VALUES ";
	// 	$qryRows = '';
	// 	$duplicate = 0;
	// 	$lastUpdate = date('Y-m-d H:i:s');
	// 	$response = array('valid' => false, 'msg' => 'File not found.');

	// 	if(isset($_FILES["csvfile"]["name"])) {

	// 		$path = $_FILES["csvfile"]["tmp_name"];
	// 		$object = PHPExcel_IOFactory::load($path);
	// 		foreach($object->getWorksheetIterator() as $worksheet)
	// 		{
	// 			$highestRow = $worksheet->getHighestRow();
	// 			$highestColumn = $worksheet->getHighestColumn();

	// 			$object->getActiveSheet()->setCellValue('A1', 'mydata');

	// 			for($row=1; $row<=$highestRow; $row++) {

	// 				$object->getActiveSheet()->setCellValue('A'.($row+1), $worksheet->getCellByColumnAndRow(0, $row)->getValue());
					
					
	// 			}

				
				

	// 		}

	// 		$objWriter = PHPExcel_IOFactory::createWriter($object, 'CSV');
	// 		$objWriter->save('testExportFile.csv');
	// 	} 

	// 	return $response;
	// }	



	public function addZoneCSV(){
		$this->load->library('excel');
		$qry = "INSERT INTO `ch_zone`(`zoneName`, `slug`, `lastDeliveryTime`, `isPopular`, `Description`, `imageId`, `metaTitle`, `metaDescription`, `keywords`, `status`, `addedOn`, `updatedOn`) VALUES ";
		$qryRows = '';
		$duplicate = 0;
		$lastUpdate = date('Y-m-d H:i:s');
		$response = array('valid' => false, 'msg' => 'File not found.');

		if(isset($_FILES["csvfile"]["name"])) {

			$path = $_FILES["csvfile"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=1; $row<=$highestRow; $row++) {

					$condArray = array("status != " => "2", "zoneName" => $worksheet->getCellByColumnAndRow(0, $row)->getValue());
					$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."zone", "zoneId", $condArray);
					if( !$checkExits ){
						$slug = ($worksheet->getCellByColumnAndRow(1, $row)->getValue())?$worksheet->getCellByColumnAndRow(1, $row)->getValue():$worksheet->getCellByColumnAndRow(0, $row)->getValue();
						$zoneSlug = $this->common_lib->create_unique_slug(trim($slug),tablePrefix."zone","slug",0,"zoneId",$counter=0);
						$lastDeliveryTime = '23:00';//date('h:i', strtotime($worksheet->getCellByColumnAndRow(2, $row)->getValue()))
						$qryRows .= (($qryRows)?',':'')."('".$worksheet->getCellByColumnAndRow(0, $row)->getValue()."', '".$zoneSlug."', '".$lastDeliveryTime."', '".$worksheet->getCellByColumnAndRow(3, $row)->getValue()."', '', 0, '', '', '', '0', '".$lastUpdate."', '".$lastUpdate."')";
					}else
						$duplicate++;
				}

				$qryStatus   = ($qryRows)?$this->Common_model->runquery($qry.$qryRows):'';
				if($qryStatus)
					$response = array('valid' => true, 'msg' => "Uploaded successfully, $duplicate duplicate rows found.", 'qry'=>$qry.$qryRows);
				else
					$response = array('valid' => false, 'msg' => ($duplicate)?"$duplicate duplicate rows found.":'Something went wrong.', 'qry'=>$qry.$qryRows);

				return $response;

			}
		} 

		return $response;
	}

 	// zone csv upload
	public function addPincodeCSV(){
		// /Delivery Condition (|| Means New DeliveryCondition, | Means Delivery Condition Details, ',,' Multiple Time Slots, ',' Menas Time Slots Section )

		//MidNight | AMountVal | startTime(10:50 AM), endTime (08:00 PM), numberof devilver,, startTime, endTime , numberof devilver || FixedTime Delivery | AMountVal | startTime(10:50 AM), endTime (08:00 PM), numberof devilver,, startTime, endTime , numberof devilver

		//Standard Delivery | 50 | 10:00 AM, 01:00 PM, 50,, 01:00 PM, 03:00 PM, 50,,03:00 PM, 06:00 PM, 50,,06:00 PM, 09:00 PM, 50,,09:00 PM, 10:50 PM, 50,||MidNight | 150 | 10:50 PM, 11:59 PM, 12


		$this->load->library('excel');
		$response = array('valid' => false, 'msg' => 'File not found.');

		if(isset($_FILES["csvfile"]["name"])) {

			$path = $_FILES["csvfile"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet) {

				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=1; $row<=$highestRow; $row++) {
					$zoneData = $this->Common_model->exequery("SELECT zoneId FROM ch_zone WHERE zoneName = '".$worksheet->getCellByColumnAndRow(0, $row)->getValue()."'",1);
					$pincodeDetail = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$pincode = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					if (!empty($zoneData) && !empty($pincodeDetail) && !empty($pincode)) {

						$condArray = array("status != " => "2", "pincode" => trim($pincode) );
						$pincodeId = $this->Common_model->getSelectedField(tablePrefix."pincode", "pincodeId", $condArray);
						$insertData = array();
						$insertData['pincode'] = trim($pincode);
						$insertData['minCartValue'] = 0;
						$insertData['isCod'] = 0;
						$insertData['zoneId'] = $zoneData->zoneId;
						$insertData['addedBY'] = 1;
						$insertData['updatedOn'] = date('Y-m-d H:i:s');

						
						if($pincodeId > 0){
							$this->Common_model->update(tablePrefix."pincode", $insertData, $condArray);
						}else{
							$insertData['addedOn'] = date('Y-m-d H:i:s');
							$pincodeId = $this->Common_model->insertUnique(tablePrefix."pincode",$insertData);
						}

						if ($pincodeId) {

							$pincodeDetailArr = explode('||', $pincodeDetail);
							if(!empty($pincodeDetailArr)){
								foreach ($pincodeDetailArr as $deliveryTypeDetail) {
									if (!empty($deliveryTypeDetail)) {
										$deliveryTypeDetailArr = explode('|', $deliveryTypeDetail);
										if( isset($deliveryTypeDetailArr[0]) && !empty( $deliveryTypeDetailArr[0])){

											$condArray = array("status != " => "2", "pincodeId" => trim($pincodeId), "deliveryType" => trim($deliveryTypeDetailArr[0]) );
											$deliveryTimeSlotId = $this->Common_model->getSelectedField(tablePrefix."delivery_service", "deliveryTimeSlotId", $condArray);
											$deliveryType = array();
											$deliveryType['deliveryType'] = trim($deliveryTypeDetailArr[0]);
											$deliveryType['deliveryAmount'] = @trim($deliveryTypeDetailArr[1]);
											$deliveryType['pincodeId'] = $pincodeId;
											$deliveryType['addedBY'] = 1;
											$deliveryType['updatedOn'] = date('Y-m-d H:i:s');

											if($deliveryTimeSlotId > 0){
												$this->Common_model->update(tablePrefix."delivery_service", $deliveryType, $condArray);
											}else{
												$deliveryType['addedOn'] = date('Y-m-d H:i:s');
												$deliveryTimeSlotId = $this->Common_model->insertUnique(tablePrefix."delivery_service",$deliveryType);
											}

											if ($deliveryTimeSlotId > 0) {
												// echo $deliveryTimeSlotId.'--';
												if (isset($deliveryTypeDetailArr[2]) && !empty($deliveryTypeDetailArr[2])) {
													// echo $deliveryTypeDetailArr[2].'**';
													$deliverySlotArr = explode(',,', $deliveryTypeDetailArr[2]);
													if (!empty($deliverySlotArr)) {

														// echo $deliveryTypeDetailArr[2].'##';
														foreach ($deliverySlotArr as $key => $deliverySlotDetail) {
															// echo $deliveryTypeDetailArr[2].'@@';
															if (!empty($deliverySlotDetail)) {
																$deliverySlotDetailArr = explode(',', $deliverySlotDetail);
																if (isset($deliverySlotDetailArr[0]) && !empty($deliverySlotDetailArr[0]) && isset($deliverySlotDetailArr[1])) {

																	$timeslotsData = array();
																	$timeslotsData['deliveryId'] = $deliveryTimeSlotId;
																	$timeslotsData['startTime'] = date('H:i', strtotime(trim($deliverySlotDetailArr[0])));
																	$timeslotsData['endTime'] = date('H:i', strtotime(trim($deliverySlotDetailArr[1])));
																	$timeslotsData['numberofDelivery'] =@trim($deliverySlotDetailArr[2]);
																	$timeslotsData['addedBY'] = 1;
																	$timeslotsData['updatedOn'] = date('Y-m-d H:i:s');

																	$condArray = array("status != " => "2", "deliveryId" => trim($deliveryTimeSlotId), "startTime" => trim($deliverySlotDetailArr[0]), "endTime" => trim($deliverySlotDetailArr[1]) );
																	$timeslotId = $this->Common_model->getSelectedField(tablePrefix."delivery_time_slots", "timeslotId", $condArray);

																	if($timeslotId > 0){
																		$timeslotsId = $this->Common_model->update(tablePrefix."delivery_time_slots", $timeslotsData, $condArray);
																	}else{
																		$timeslotsData['addedOn'] = date('Y-m-d H:i:s');
																		$timeslotsId = $this->Common_model->insertUnique(tablePrefix."delivery_time_slots",$timeslotsData);
																	}
																	$response['msg'] .= ($timeslotId)?"$pincode Added successfully.":"$pincode Failed.";
																	
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}

				
				if($response['msg'] != 'File not found.')
					$response = array('valid' => true, 'aaa' => "Uploaded successfully, $duplicate duplicate rows found.", 'msg'=>$response['msg']);
				else
					$response = array('valid' => false, 'msg' => 'Something went wrong.', 'qry'=>$this->db->last_query());

				return $response;

			}
		} 

		return $response;
	}



	function addFrontSlider($data, $filedata) {
		if(isset($data['title'])) {
			$sliderId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
			
			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting',($sliderId)?'can_edit_setting':'can_create_setting'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			$insertData['position'] = $data['position'];
			$insertData['title'] = $data['title'];
			$insertData['text1'] = $data['text1'];
			$insertData['text2'] = $data['text2'];
			$insertData['btnText'] = $data['btnText'];
			$insertData['btnUrl'] = $data['btnUrl'];
			$insertData['updatedOn'] = date('Y-m-d H:i:s');

			if($data['title']){
				$condArray = array("status != " => "2", "title" => $data['title']);
				if( $sliderId > 0 )
					$condArray['sliderId != '] = $sliderId; 

				$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."front_page_slider", "sliderId", $condArray);
				if( $checkExits )
					return array("valid" => false, "data" => array(), "msg" => "Slider Already Exist!");
			}
			

			$imageName = $this->uploadImage('slider_images', 'uploadIcons');
			if(!empty($imageName))
				$insertData['img'] = $imageName;

			if( $sliderId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."front_page_slider", $insertData, "sliderId = ".$sliderId);
			else {
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$updateStatus = $this->Common_model->insert(tablePrefix."front_page_slider", $insertData);
			}

			if( $updateStatus )
				return array("valid" => true, "data" => array(), "msg" => ($sliderId)?"Slider Updated Successfully!":"Slider Added Successfully!");
			else
				return array("valid" => false, "data" => array(), "msg" => "Something went wrong.");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Title is required!");
	}



	function getSliderList() {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting','can_view_setting'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );

		$columns = array( 0 => "img", 1 => "title", 2 => "text1",3 => "status", 4=>"sliderId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."front_page_slider as cat where cat.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT cat.* from ".tablePrefix."front_page_slider as cat where cat.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (cat.title LIKE  '%".$search."%' OR cat.text1 LIKE  '%".$search."%' OR cat.text2 LIKE  '%".$search."%' OR cat.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."front_page_slider as cat where cat
            	.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['img'] = '<img src="'.UPLOADPATH.'/slider_images/'.$row->img.'" class="preview_img">';
                $nestedData['title'] = $row->title;
                $nestedData['description'] = $row->text1.' '.$row->text2;
                
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
                $nestedData['action'] = '';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting','can_edit_setting'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light editSlider" title="Edit" data-id="'.$row->sliderId.'"><i class="fa fa-pencil"></i></button><button onclick="ActivateDeActivateThisRecord(this,\'front_page_slider\','.$row->sliderId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button><button class="btn btn-icons btn-rounded btn-light deleteZone" title="Delete Slider" onclick="delete_row(this,\'front_page_slider\','.$row->sliderId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}

	function addShakingCategory($data, $filedata) {
		if(isset($data['title']) && !empty($data['title'])) {
			$categoryId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
			
			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting',($categoryId)?'can_edit_setting':'can_create_setting'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			$insertData['title'] = $data['title'];
			$insertData['btnUrl'] = $data['btnUrl'];
			$insertData['updatedOn'] = date('Y-m-d H:i:s');

			
			$condArray = array("status != " => "2", "title" => $data['title']);
			if( $categoryId > 0 )
				$condArray['categoryId != '] = $categoryId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."front_page_shaking_category", "categoryId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Category Already Exist!");
			

			$imageName = $this->uploadImage('shaking_images', 'uploadIcons');
			if(!empty($imageName))
				$insertData['img'] = $imageName;

			if( $categoryId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."front_page_shaking_category", $insertData, "categoryId = ".$categoryId);
			else {
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$updateStatus = $this->Common_model->insert(tablePrefix."front_page_shaking_category", $insertData);
			}

			if( $updateStatus )
				return array("valid" => true, "data" => array(), "msg" => ($categoryId)?"Category Updated Successfully!":"Category Added Successfully!");
			else
				return array("valid" => false, "data" => array(), "msg" => "Something went wrong.");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Title is required!");
	}


	function getShakingCategoryList() {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting','can_view_setting'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );

		$columns = array( 0 => "categoryId", 1 => "title", 2 => "btnUrl",3 => "status", 4=>"categoryId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."front_page_shaking_category as cat where cat.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT cat.* from ".tablePrefix."front_page_shaking_category as cat where cat.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (cat.title LIKE  '%".$search."%' OR cat.btnUrl LIKE  '%".$search."%' OR cat.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."front_page_shaking_category as cat where cat
            	.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['img'] = '<img src="'.UPLOADPATH.'/shaking_images/'.$row->img.'" class="preview_img">';
                $nestedData['title'] = $row->title;
                $nestedData['btnUrl'] = $row->btnUrl;
                
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
                $nestedData['action'] = '';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting','can_edit_setting'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light editShakingCategory" title="Edit" data-id="'.$row->categoryId.'"><i class="fa fa-pencil"></i></button><button onclick="ActivateDeActivateThisRecord(this,\'front_page_shaking_category\','.$row->categoryId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button><button class="btn btn-icons btn-rounded btn-light deleteZone" title="Delete Slider" onclick="delete_row(this,\'front_page_shaking_category\','.$row->categoryId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}

	function addBenefit($data, $filedata) {
		if(isset($data['text1']) && !empty($data['text1'])) {
			$benefitId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
			
			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting',($benefitId)?'can_edit_setting':'can_create_setting'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			$insertData['text1'] = $data['text1'];
			$insertData['text2'] = $data['text2'];
			$insertData['updatedOn'] = date('Y-m-d H:i:s');

			
			$condArray = array("status != " => "2", "text1" => $data['text1']);
			if( $benefitId > 0 )
				$condArray['benefitId != '] = $benefitId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."front_page_benefit", "benefitId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Benifit Already Exist!");
			

			$imageName = $this->uploadImage('benefit_images', 'uploadIcons');
			if(!empty($imageName))
				$insertData['img'] = $imageName;

			if( $benefitId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."front_page_benefit", $insertData, "benefitId = ".$benefitId);
			else {
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$updateStatus = $this->Common_model->insert(tablePrefix."front_page_benefit", $insertData);
			}

			if( $updateStatus )
				return array("valid" => true, "data" => array(), "msg" => ($benefitId)?"Benifit Updated Successfully!":"Benifit Added Successfully!");
			else
				return array("valid" => false, "data" => array(), "msg" => "Something went wrong.");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "text1 is required!");
	}



	function getBenefitList() {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting','can_view_setting'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );

		$columns = array( 0 => "img", 1 => "text1", 2 => "text2",3 => "status", 4=>"benefitId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."front_page_benefit as cat where cat.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT cat.* from ".tablePrefix."front_page_benefit as cat where cat.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (cat.text1 LIKE  '%".$search."%' OR cat.text2 LIKE  '%".$search."%' OR cat.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."front_page_benefit as cat where cat
            	.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['img'] = '<img src="'.UPLOADPATH.'/benefit_images/'.$row->img.'" class="preview_img">';
                $nestedData['text1'] = $row->text1;
                $nestedData['text2'] = $row->text2;
                
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
                $nestedData['action'] = '';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting','can_edit_setting'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light editBenefit" title="Edit" data-id="'.$row->benefitId.'"><i class="fa fa-pencil"></i></button><button onclick="ActivateDeActivateThisRecord(this,\'front_page_benefit\','.$row->benefitId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button><button class="btn btn-icons btn-rounded btn-light deleteZone" title="Delete Slider" onclick="delete_row(this,\'front_page_benefit\','.$row->benefitId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}


	function addSaleBanner($data, $filedata) {
		if(isset($data['text1']) && !empty($data['text1'])) {
			$bannerId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
			
			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting',($bannerId)?'can_edit_setting':'can_create_setting'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			$insertData['text1'] = $data['text1'];
			$insertData['text2'] = $data['text2'];
			$insertData['text3'] = $data['text3'];
			$insertData['btnText'] = $data['btnText'];
			$insertData['btnUrl'] = $data['btnUrl'];
			$insertData['updatedOn'] = date('Y-m-d H:i:s');

			
			$condArray = array("status != " => "2", "text1" => $data['text1']);
			if( $bannerId > 0 )
				$condArray['bannerId != '] = $bannerId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."front_page_sale_banner", "bannerId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Banner Already Exist!");
			

			$imageName = $this->uploadImage('sale_banner_images', 'uploadIcons');
			if(!empty($imageName))
				$insertData['img'] = $imageName;

			if( $bannerId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."front_page_sale_banner", $insertData, "bannerId = ".$bannerId);
			else {
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$updateStatus = $this->Common_model->insert(tablePrefix."front_page_sale_banner", $insertData);
			}

			if( $updateStatus )
				return array("valid" => true, "data" => array(), "msg" => ($bannerId)?"Banner Updated Successfully!":"Banner Added Successfully!");
			else
				return array("valid" => false, "data" => array(), "msg" => "Something went wrong.");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "text1 is required!");
	}


	function getPhotoGalleryList() {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting','can_view_setting'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );

		$columns = array( 0 => "galleryId", 1 => "description", 2 => "btnUrl",3 => "status", 4=>"galleryId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."front_page_photo_gallery as cat where cat.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT cat.* from ".tablePrefix."front_page_photo_gallery as cat where cat.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (cat.description LIKE  '%".$search."%' OR cat.btnUrl LIKE  '%".$search."%' OR cat.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."front_page_photo_gallery as cat where cat
            	.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['img'] = '<img src="'.UPLOADPATH.'/photo_gallery_images/'.$row->img.'" class="preview_img">';
                $nestedData['description'] = $row->description;
                $nestedData['btnUrl'] = $row->btnUrl;
                
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
                $nestedData['action'] = '';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting','can_edit_setting'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light editPhotoGallery" title="Edit" data-id="'.$row->galleryId.'"><i class="fa fa-pencil"></i></button><button onclick="ActivateDeActivateThisRecord(this,\'front_page_photo_gallery\','.$row->galleryId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button><button class="btn btn-icons btn-rounded btn-light" title="Delete Slider" onclick="delete_row(this,\'front_page_photo_gallery\','.$row->galleryId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}


	function addPhotoGallery($data, $filedata) {
		if(isset($data['description'])) {
			$galleryId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
			
			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting',($galleryId)?'can_edit_setting':'can_create_setting'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			$insertData['description'] = $data['description'];
			$insertData['btnUrl'] = $data['btnUrl'];
			$insertData['updatedOn'] = date('Y-m-d H:i:s');			

			$imageName = $this->uploadImage('photo_gallery_images', 'uploadIcons');
			if(!empty($imageName))
				$insertData['img'] = $imageName;
			else if(!$galleryId)
				return array("valid" => false, "data" => array(), "msg" => "Image required!");

			if( $galleryId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."front_page_photo_gallery", $insertData, "galleryId = ".$galleryId);
			else {
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$updateStatus = $this->Common_model->insert(tablePrefix."front_page_photo_gallery", $insertData);
			}

			if( $updateStatus )
				return array("valid" => true, "data" => array(), "msg" => ($galleryId)?"Details Updated Successfully!":"Details Added Successfully!");
			else
				return array("valid" => false, "data" => array(), "msg" => "Something went wrong.");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Details are required!");
	}



	function getSaleBannerList() {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting','can_view_setting'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );

		$columns = array( 0 => "bannerId", 1 => "text1", 2 => "text2",3 => "status", 4=>"bannerId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."front_page_sale_banner as cat where cat.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT cat.* from ".tablePrefix."front_page_sale_banner as cat where cat.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (cat.text1 LIKE  '%".$search."%' OR cat.text2 LIKE  '%".$search."%' OR cat.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."front_page_sale_banner as cat where cat
            	.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['img'] = '<img src="'.UPLOADPATH.'/sale_banner_images/'.$row->img.'" class="preview_img">';
                $nestedData['text1'] = $row->text1;
                $nestedData['text2'] = $row->text2;
                
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
                $nestedData['action'] = '';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_setting','can_edit_setting'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light editSaleBanner" title="Edit" data-id="'.$row->bannerId.'"><i class="fa fa-pencil"></i></button><button onclick="ActivateDeActivateThisRecord(this,\'front_page_sale_banner\','.$row->bannerId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button><button class="btn btn-icons btn-rounded btn-light deleteZone" title="Delete Slider" onclick="delete_row(this,\'front_page_sale_banner\','.$row->bannerId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}


	function addShareMoment($data, $filedata) {
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_user','can_create_user'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

		$imageName = $this->uploadImage('share_moment_images', 'uploadIcons');
		if(!empty($imageName)){
			$insertData['userId']	 		=  isset($data['userId'])?trim($data['userId']):0;
			$insertData['title']	 		=   trim($data['title']);
			$insertData['description']	=   trim($data['description']);
			$insertData['img'] = $imageName;
			$insertData['addedOn'] = $insertData['updatedOn'] = date('Y-m-d H:i:s');
			$updateStatus = $this->Common_model->insert(tablePrefix."shared_moment", $insertData);

			if( $updateStatus )
				return array("valid" => true, "msg" => "Moment Added Successfully!");
			else
				return array("valid" => false, "msg" => "Something went wrong.");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Valid image is required!");
	}



	function getShareMomentList() {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_user','can_view_user'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );

		$columns = array( 0 => "imageId", 1 => "status", 2 => "imageId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."shared_moment as cat where cat.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT cat.* from ".tablePrefix."shared_moment as cat where cat.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (cat.img LIKE  '%".$search."%' OR cat.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."shared_moment as cat where cat
            	.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['img'] = '<img src="'.UPLOADPATH.'/share_moment_images/'.$row->img.'" class="preview_img">';
                
                if ( $row->status == -1 ) {
                	$nestedData['status'] =  "Un-approved";
                	$btnClass =  "text-danger";
                }
                else if ( $row->status == 0 ) {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
                else {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                $nestedData['action'] = '';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_user','can_edit_user'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button onclick="ActivateDeActivateThisRecord(this,\'shared_moment\','.$row->imageId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button><button class="btn btn-icons btn-rounded btn-light deleteZone" title="Delete Image" onclick="delete_row(this,\'shared_moment\','.$row->imageId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}




    //add Blog
    	
	function addBlog($data, $filedata) {
        	
		if(isset($data['blogName']) && !empty($data['blogName'])) {
			$blogId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
            //return $blogId;
            $checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_blog',($blogId)?'can_edit_blog':'can_create_blog'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;
            
            $insertData['blogTitle'] = $data['blogName'];

            $smallImageName = $this->uploadImage('blog_images', 'uploadImage');
			if(!empty($smallImageName))
				$insertData['small_image'] = $smallImageName;
            else
            	$response['msg']="Small image is not valid";

            $imageName = $this->uploadImage('blog_images', 'blogImage');
			if(!empty($imageName))
				$insertData['image'] = $imageName;
            else
            	$response['msg']="Small image is not valid";

          //   if (is_uploaded_file($_FILES['uploadImage']['tmp_name'])) {
		        // $imagename = $_FILES['uploadImage']['name'];
		        // $final_image = rand(1000,1000000).$imagename;
		        // $targetPath = UPLOADDIR.'/blog_images/'.$final_image;
		        // //return $targetPath;
		        // if (move_uploaded_file($_FILES['uploadImage']['tmp_name'], $targetPath)) {
		        //     $uploadedImagePath = $targetPath;
		        // }
		        // $insertData['small_image']=$final_image;

          //   }
          //   else
          //   	$response['msg']="Image is not valid";

          //   if (is_uploaded_file($_FILES['blogImage']['tmp_name'])) {
		        // $imagename = $_FILES['blogImage']['name'];
		        // $final_image = rand(1000,1000000).$imagename;
		        // $targetPath = UPLOADDIR.'/blog_images/'.$final_image;
		        // //return $targetPath;
		        // if (move_uploaded_file($_FILES['blogImage']['tmp_name'], $targetPath)) {
		        //     $uploadedImagePath = $targetPath;
		        // }
		        // $insertData['image']=$final_image;
            
          //   }

          //   else
          //   	$response['msg']="Image is not valid"; 

			$condArray = array("status != " => "2", "blogTitle" => $data['blogName']);
			if( $blogId > 0 )
				$condArray['blogId != '] = $blogId;

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."blog", "blogId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Blog Already Exist!");
			

			$blogSlug = $this->common_lib->create_unique_slug(trim($data['blogName']),tablePrefix."blog","slug",$blogId,"blogId",$counter=0);
					$insertData['slug']			 =   $blogSlug; 
		    
			/*$insertData['description'] = (isset($data['description']) && !empty($data['description'])) ? $data['description'] : '';*/
			$insertData['description'] = (isset($data['extra_desc']) && !empty($data['extra_desc'])) ? $data['extra_desc'] : '';
			$insertData['metaTitle'] = (isset($data['metaTitle']) && !empty($data['metaTitle'])) ? $data['metaTitle'] : '';
			$insertData['metaDescription'] = (isset($data['metaDescription']) && !empty($data['metaDescription'])) ? $data['metaDescription'] : '';
			$insertData['keywords'] = (isset($data['metaKeywords']) && !empty($data['metaKeywords'])) ? $data['metaKeywords'] : '';
            $insertData['tags'] = $data['tags']; 
			$insertData['addedBY'] = $this->session->userdata(PREFIX."sessAuthId");
			$insertData['status'] = 0;
			$insertData['addedOn'] = date('Y-m-d H:i:s');

			if( $blogId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."blog", $insertData, "blogId = ".$blogId);
			else
				$updateStatus = $this->Common_model->insert(tablePrefix."blog", $insertData);

			
				return array("valid" => true, "data" => array(), "msg" => ( $blogId > 0 )? "Blog Updated Successfully!" :"Blog Added Successfully!" );

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Blog title is required!");
	}

	public function blogList() {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_blog','can_view_blog'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );
        

		$columns = array( 0 => "bl.blogId", 1 => "bl.blogTitle", 2 => "bl.addedOn", 3 => "bl.status", 4 => "bl.blogId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."blog as bl where bl.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT bl.*, (case when small_image != '' then concat('".UPLOADPATH."/blog_images/', small_image) else '' end) as icons FROM ch_blog as bl where bl.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search))
            	$search = str_replace(['"',"'"], ['', ''], $search);

            $searchCond = " AND (bl.blogTitle LIKE  '%".$search."%' OR bl.addedBy LIKE  '%".$search."%' OR bl.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."blog as bl where bl.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		
                $nestedData['icons'] = ( $row->icons != '' ) ? '<img src="'.$row->icons.'" width="30px" height="30px">' : "";
                $nestedData['blogTitle'] = '<div class="ellipsis">'.$row->blogTitle.'</div>';
                $nestedData['addedOn'] = $row->addedOn;
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }

                $nestedData['action'] = '<a class="btn btn-icons btn-rounded btn-light" title="view" target="_blank" href="'.BASEURL.'/blog/'.$row->slug.'"><i class="fa fa-eye"></i></a>';

                $rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_blog','can_edit_blog'],0);
				if($rolePermission['valid'])
                	$nestedData['action'] .= '<a class="btn btn-icons btn-rounded btn-light" title="Edit" href="'.DASHURL.'/admin/blog/add/'.$row->blogId.'"><i class="fa fa-pencil"></i></a><button onclick="ActivateDeActivateThisRecord(this,\'blog\','.$row->blogId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button>';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_blog','can_delete_blog'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light" title="Delete Blog" onclick="delete_row(this,\'blog\','.$row->blogId.');"><i class="fa fa-trash-o"></i></button>';

                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}

	public function GetBlogCommentsList() {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_blog','can_view_blog'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );
        

		$columns = array( 0 => "us.firstName", 1 => "bl.blogTitle", 2 => "bc.message", 3 => "bc.addedOn", 4 => "bc.status", 5 => "bc.commentId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."blog_comment as bc where bc.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData;  
        $qry = "SELECT bc.*, bl.blogTitle, CONCAT(us.firstName,' ', us.lastName) as name FROM ch_blog_comment as bc left join ch_blog as bl on bl.blogId = bc.blogId left join ch_user as us on us.userId = bc.userId where bc.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search))
            	$search = str_replace(['"',"'"], ['', ''], $search);

            $searchCond = " AND (us.firstName LIKE  '%".$search."%' OR us.lastName LIKE  '%".$search."%' OR bc.message LIKE  '%".$search."%' OR bl.blogTitle LIKE  '%".$search."%' OR bc.addedOn LIKE  '%".$search."%' OR bc.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."blog_comment as bc left join ch_blog as bl on bl.blogId = bc.blogId left join ch_user as us on us.userId = bc.userId where bc.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		
                $nestedData['blogTitle'] = '<div class="ellipsis">'.$row->blogTitle.'</div>';
                $nestedData['message'] = '<div class="ellipsis">'.$row->message.'</div>';
                $nestedData['firstName'] = $row->name;
                $nestedData['addedOn'] = $row->addedOn;
                if ( $row->status == -1 ) {
                	$nestedData['status'] = "Un-approved";
                	$btnClass =  "text-danger";
                }
                else if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }

                $nestedData['action'] = '<a class="btn btn-icons btn-rounded btn-light" title="view" onclick="viewComment(this,event,'.$row->commentId.')"><i class="fa fa-eye"></i></a>';

                $rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_blog','can_edit_blog'],0);
				if($rolePermission['valid'])
                	$nestedData['action'] .= '<button onclick="ActivateDeActivateThisRecord(this,\'blog_comment\','.$row->commentId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button>';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_blog','can_delete_blog'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light" title="Delete Blog" onclick="delete_row(this,\'blog_comment\','.$row->commentId.');"><i class="fa fa-trash-o"></i></button>';

                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}
    //Add Frenchise
    function addFrenchise($data){
    	if(isset($data['type']) && !empty($data['type'])) {
			$frenchiseId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
			
			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_frenchise',($frenchiseId)?'can_edit_frenchise':'can_create_frenchise'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			$insertData['type'] = $data['type'];
			$type = ($data['type']=='faqs')?$data['frenchise_title_faq']:$data['frenchise_title'];
			$condArray = array("status != " => "2", "type" => $data['type'], "title" => $data['frenchise_title'],"title"=>$type);
			if( $frenchiseId > 0 )
				$condArray['Id != '] = $frenchiseId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."front_page_frenchise", "Id", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Frenchise Already Exist!");
            
            $insertData['title'] = ($data['type']=='faqs')?$data['frenchise_title_faq']:$data['frenchise_title'];
            $insertData['description'] = ($data['type']=='faqs')?$data['description']:'';
			$insertData['status'] = 0;
            
			if( $frenchiseId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."front_page_frenchise", $insertData, "Id = ".$frenchiseId);
			else {
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$updateStatus = $this->Common_model->insert(tablePrefix."front_page_frenchise", $insertData);
			}

			if( $frenchiseId > 0 )
				return array("valid" => true, "data" => array(), "msg" => "Frenchise Updated Successfully!");
			else
				return array("valid" => true, "data" => array(), "msg" => "Frenchise Added Successfully!");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Type is required!");
    }
	//Review Section
	function addReview($data) {
        	
		if(isset($data['review']) && !empty($data['review'])) {
			$reviewId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
            //return $blogId;
            $checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_review',($reviewId)?'can_edit_review':'can_create_review'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;
            
            $insertData['review'] = $data['review'];
            
			/*$condArray = array("status != " => "2", "blogTitle" => $data['blogName']);
			if( $blogId > 0 )
				$condArray['blogId != '] = $blogId;

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."blog", "blogId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Blog Already Exist!");*/
			

			$insertData['userId'] = (isset($data['userId']) && !empty($data['userId'])) ? $data['userId'] : '';
			$insertData['productId'] = (isset($data['productId']) && !empty($data['productId'])) ? $data['productId'] : '';
			$insertData['rating'] = (isset($data['rating']) && !empty($data['rating'])) ? $data['rating'] : '';
			$insertData['review'] = (isset($data['review']) && !empty($data['review'])) ? $data['review'] : '';
			$insertData['reviewerName'] = (isset($data['reviewerName']) && !empty($data['reviewerName'])) ? $data['reviewerName'] : '';
			$insertData['reviewerEmail'] = (isset($data['reviewerEmail']) && !empty($data['reviewerEmail'])) ? $data['reviewerEmail'] : '';
			$insertData['status'] = 0;
			$insertData['addedOn'] = date('Y-m-d H:i:s');

			if( $reviewId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."review", $insertData, "reviewId = ".$reviewId);
			else
				$updateStatus = $this->Common_model->insert(tablePrefix."review", $insertData);

			
				return array("valid" => true, "data" => array(), "msg" => ( $reviewId > 0 )? "Review Updated Successfully!" :"Review Added Successfully!" );

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Review is required!");
	}

	private function ReviewList($data) {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_review','can_view_review'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );


		$this->common_lib->checkRolePermission(['can_manage_all_review','can_view_review'],0);
		$columns = array( 0 => "productName", 1 => "userName", 2=>"orderId", 3=>"rating", 4=> "review", 5=> "reviewerName", 6=> "reviewerEmail", 7 => "status",8 => "reviewId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(reviewId) as total from ".tablePrefix."review as re where re.status IN(0, 1)",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT re.reviewId,re.productId,re.userId,re.rating,re.review,re.status,pd.productName,us.firstName as firstName,us.lastName as lastName from ".tablePrefix."review as re left join ch_product as pd on (pd.productId = re.productId) left join ch_user as us on (us.userId = re.userId) where re.status IN(0, 1)"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (pd.productName LIKE  '%".$search."%' OR us.firstName LIKE '%".$search."%' OR us.lastName LIKE '%".$search."%' OR re.orderId LIKE  '%".$search."%' OR re.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(re.reviewId),re.productId,re.userId,re.rating,re.review,re.status,pd.productName,us.firstName,us.lastName from ".tablePrefix."review as re left join ch_product as pd on (pd.productId = re.productId) left join ch_user as us on (us.userId = re.userId) where re.status IN(0, 1) ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		
                $nestedData['productName'] = $row->productName;
                $nestedData['userName'] = $row->firstName.' '.$row->lastName;
                $nestedData['rating'] = $row->rating; 
                $nestedData['review'] = '<div class="ellipsis">'.$row->review.'</div>';

                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
                $nestedData['action'] = '';

				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_review','can_edit_review'],0);

				if($rolePermission['valid'])
					$nestedData['action'] .= '<a class="btn btn-icons btn-rounded btn-light" title="Edit" href="'.DASHURL.'/admin/review/add/'.$row->reviewId.'"><i class="fa fa-pencil"></i></a><button onclick="ActivateDeActivateThisRecord(this,\'review\','.$row->reviewId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button>';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_review','can_delete_review'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light deleteTag" title="Delete" onclick="delete_row(this,\'review\','.$row->reviewId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}

	private function newReviewList($data) {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_review','can_view_review'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );


		$this->common_lib->checkRolePermission(['can_manage_all_review','can_view_review'],0);
		$columns = array( 0 => "productName", 1 => "userName", 2=>"orderId", 3=>"rating", 4=> "review", 5=> "reviewerName", 6=> "reviewerEmail", 7 => "status",8 => "reviewId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(reviewId) as total from ".tablePrefix."review as re where re.status = -1 ",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT re.reviewId,re.productId,re.userId,re.rating,re.review,re.status,pd.productName,us.firstName as firstName,us.lastName as lastName from ".tablePrefix."review as re left join ch_product as pd on (pd.productId = re.productId) left join ch_user as us on (us.userId = re.userId) where re.status = -1"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (pd.productName LIKE  '%".$search."%' OR us.firstName LIKE '%".$search."%' OR us.lastName LIKE '%".$search."%' OR re.orderId LIKE  '%".$search."%' OR re.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(re.reviewId),re.productId,re.userId,re.rating,re.review,re.status,pd.productName,us.firstName,us.lastName from ".tablePrefix."review as re left join ch_product as pd on (pd.productId = re.productId) left join ch_user as us on (us.userId = re.userId) where re.status = -1 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		
                $nestedData['productName'] = $row->productName;
                $nestedData['userName'] = $row->firstName.' '.$row->lastName;
                $nestedData['rating'] = $row->rating; 
                $nestedData['review'] = '<div class="ellipsis">'.$row->review.'</div>';

                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
                $nestedData['action'] = '';

				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_review','can_edit_review'],0);

				if($rolePermission['valid'])
					$nestedData['action'] .= '<a class="btn btn-icons btn-rounded btn-light" title="Edit" href="'.DASHURL.'/admin/review/add/'.$row->reviewId.'"><i class="fa fa-pencil"></i></a>';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_review','can_delete_review'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-success" title="Approve Review" onclick="approveReview(this,\'review\','.$row->reviewId.');"><i class="fa fa-check"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}


    // Add User
    public function addUser($data, $filedata) {
    	//return $data;
		if(isset($data['firstName']) && !empty($data['firstName'])) {
			$userId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
			
			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_user',($userId)?'can_edit_user':'can_create_user'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;


			$condAuth = ""; 
			// $condArray = array("status != " => "2", "firstName" => $data['firstName']);
			if( $userId > 0 ){
				// $condArray['userId != '] = $userId; 
				$condAuth = " AND roleId !='".$userId."'"; 
			}

			// $checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."user", "userId", $condArray);
			// if( $checkExits )
			// 	return array("valid" => false, "msg" => "User Already Exist!");

			$isExist = $this->Common_model->exequery("SELECT * FROM ch_auths WHERE status != 2 and (email = '".$_POST['email']."' || phoneNumber = '".$_POST['mobile']."')".$condAuth,1);
			if (isset($isExist->email)){
				if ($isExist->email == $_POST['email'])
	                return array("valid" => false, "msg" => "This email is already in use, Please try with another email Id.");
				else
					return array("valid" => false, "msg" => "Mobile Number is already in use, Please try with another.");
			}

			$insertData = array();
			//$insertData['userName'] = trim($data['userName']);
			$insertData['firstName']	=   trim($_POST['firstName']);
			$insertData['lastName']	=   trim($_POST['lastName']);
			$insertData['email']	 		=   trim($_POST['email']);
			$insertData['mobile']		=   trim($_POST['mobile']);
			$insertData['gender'] =  $data['gender']; 
			$insertData['updatedOn']	 	=   date('Y-m-d H:i:s');
			$insertData['status'] = 0;
			

            if (is_uploaded_file($_FILES['uploadImage']['tmp_name'])) {
		        $imagename = $_FILES['uploadImage']['name'];
		        $final_image = rand(1000,1000000).$imagename;
		        $targetPath = UPLOADDIR.'/user_images/'.$final_image;
		        //return $targetPath;
		        if (move_uploaded_file($_FILES['uploadImage']['tmp_name'], $targetPath)) {
		            $uploadedImagePath = $targetPath;
		        }
		        $insertData['img']=$final_image;

            }
            else
            	$response['msg']="Image is not valid";

			if( $userId > 0 ){
				$updateStatus = $this->Common_model->update(tablePrefix."user", $insertData, "userId = ".$userId);
				$userAddId = $userId;
				if( $updateStatus )
					$authStatus = $this->createAuth($updateStatus, $role ='user', $insertData['email'], $insertData['mobile'], '',1);
			}else {

				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$authStatus = '';
				$this->db->trans_start();
				$updateStatus = $this->Common_model->insertUnique(tablePrefix."user", $insertData);
				$userAddId = $updateStatus;
				if($updateStatus)
				   $authStatus = $this->createAuth($updateStatus, $role ='user', $insertData['email'], $insertData['mobile'], trim($_POST['password']),0);

				if ($this->db->trans_status() === FALSE || !$authStatus || !$updateStatus){
					$this->db->trans_rollback();
					$updateStatus = false;
				}else
					$this->db->trans_commit();
			}

			if( $updateStatus ) {
				if(isset($data['addressType']) && !empty($data['addressType'])) {
						foreach( $data['addressType'] as $key => $dataVal ) {
                               
							if( !empty( $dataVal ) ) {

								$addressType['userId'] = $userAddId;
								$addressType['addressName'] = $dataVal;
								$addressType['name'] = $data['firstName'].' '.$data['lastName'];
								$addressType['address'] = $data['address'][$key];
                                $addressType['address2'] = $data['addresss'][$key];
                                $addressType['city'] = $data['city'][$key];
                                $addressType['state'] = $data['state'][$key];
                                $addressType['country'] = $data['country'][$key];
                                $addressType['pincode'] = $data['pincode'][$key];

	                            if(isset($data['addressId'][$key]) && !empty($data['addressId'][$key])) {

	                            	/*$condArray = array("addressId = ".$data['addressId'][$key], "userId" => $updateStatus);*/
									$addressId = $data['addressId'][$key];
									$update = $this->Common_model->update(tablePrefix."user_address",$addressType, "addressId = ".$addressId." AND userId=".$userAddId);
									/*echo $this->db->last_query();
									exit();*/
									//return $update;
								}
								else {
									$addressType['addedOn'] = date('Y-m-d H:i:s');
									$addressId = $this->Common_model->insertUnique(tablePrefix."user_address",$addressType);
									//return $addressId;
								}     
							}
						}
				    }
				return array("valid" => true, "msg" => ( $userId > 0 )?"User Updated Successfully!":"User Added Successfully!");
			}
			else
				return array("valid" => false, "msg" => "Something went wrong.");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "User name is required!");
	}
    
    public function userList() {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_user','can_view_user'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );


		$columns = array( 0 => "img", 1 => "firstName", 2 => "email", 3 => "mobile", 4 => "status", 5 => "userId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."user as us where us.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT us.*,(case when img != '' then concat('".UPLOADPATH."/user_images/', img) else '' end) as image from ".tablePrefix."user as us where us.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search))
            	$search = str_replace(['"',"'"], ['', ''], $search);

            $searchCond = " AND (us.firstName LIKE  '%".$search."%' OR us.email LIKE  '%".$search."%' OR us.mobile LIKE  '%".$search."%' OR us.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."user as us where us.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		
                $nestedData['img'] = ( $row->image != '' ) ? '<img src="'.$row->image.'" width="30px" height="30px">' : "";
                $nestedData['userName'] = $row->firstName.' '.$row->lastName;
                $nestedData['email'] = $row->email;
                $nestedData['mobile'] = $row->mobile;
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }


                $nestedData['action'] = '<a class="btn btn-icons btn-rounded btn-light" title="view" href="'.DASHURL.'/admin/user/detail/'.$row->userId.'"><i class="fa fa-eye"></i></a>';

                $rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_user','can_edit_user'],0);
				if($rolePermission['valid'])
                	$nestedData['action'] .= '<a class="btn btn-icons btn-rounded btn-light" title="Edit" href="'.DASHURL.'/admin/user/add/'.$row->userId.'"><i class="fa fa-pencil"></i></a><button onclick="ActivateDeActivateThisRecord(this,\'user\','.$row->userId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button>';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_user','can_delete_user'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light" title="Delete User" onclick="delete_row(this,\'user\','.$row->userId.');"><i class="fa fa-trash-o"></i></button>';

                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}

    /****************************** Tag Section ************************/

	function AddTag($data) {
		if(isset($data['tagName']) && !empty($data['tagName'])) {
			$tagId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
			
			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_tag',($tagId)?'can_edit_tag':'can_create_tag'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			$insertData['tag'] = $data['tagName'];
			
			$condArray = array("status != " => "2", "tag" => $data['tagName']);
			if( $tagId > 0 )
				$condArray['tagId != '] = $tagId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."tags", "tagId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Tag Already Exist!");

				$tagSlug = $this->common_lib->create_unique_slug(trim($data['tagName']),tablePrefix."tags","slug",$tagId,"tagId",$counter=0);
				$insertData['slug']			 =   $tagSlug;

			$insertData['status'] = 0;

			if( $tagId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."tags", $insertData, "tagId = ".$tagId);
			else {
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$updateStatus = $this->Common_model->insert(tablePrefix."tags", $insertData);
			}

			if( $tagId > 0 )
				return array("valid" => true, "data" => array(), "msg" => "Tag Updated Successfully!");
			else
				return array("valid" => true, "data" => array(), "msg" => "Tag Added Successfully!");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Tag name is required!");
	}

	function tagList($data) {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_tag','can_view_tag'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );


		$this->common_lib->checkRolePermission(['can_manage_all_tag','can_view_tag'],0);
		$columns = array( 0 => "tag", 1 => "addedOn", 2 => "status",3 => "tagId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(tagId) as total from ".tablePrefix."tags as ta where ta.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT ta.* from ".tablePrefix."tags as ta where ta.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (ta.tag LIKE  '%".$search."%' OR ta.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(tagId) as total from ".tablePrefix."tags as ta where ta
            	.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['tag'] = $row->tag;
                $nestedData['addedOn'] = $row->addedOn; 
                
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
                $nestedData['action'] = '';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_tag','can_edit_tag'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light editTag" title="Edit" data-id="'.$row->tagId.'"><i class="fa fa-pencil"></i></button><button onclick="ActivateDeActivateThisRecord(this,\'tag\','.$row->tagId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button>';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_tag','can_delete_tag'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light deleteTag" title="Delete Tag" onclick="delete_row(this,\'tag\','.$row->tagId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}
	/****************************** tag Section ************************/

	

    /****************************** Coupon Section ************************/

	function addCoupon($data) {
		if(isset($data['couponCode']) && !empty($data['couponCode'])) {
			$couponId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
			
			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_coupon',($couponId)?'can_edit_coupon':'can_create_coupon'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			
			$condArray = array("status != " => "2", "couponCode" => $data['couponCode']);
			if( $couponId > 0 )
				$condArray['couponId != '] = $couponId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."coupon", "couponId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Coupon Already Exist!");
			// v3print($data); exit;
			$insertData['couponCode'] 		= trim($data['couponCode']);
			$insertData['discountType'] 	= trim($data['discountType']);
			$insertData['discount'] 		= trim($data['discount']);
			$insertData['maxDiscountAmt'] 	= trim($data['maxDiscountAmt']);
			$insertData['minOrderAmt'] 		= trim($data['minOrderAmt']);
			// $insertData['startDate'] 		= trim($data['startDate']);
			// $insertData['endDate'] 		= trim($data['endDate']);
			$insertData['startDate'] 		= date('Y-m-d H:i:s',strtotime(trim($data['startDate'])));
			$insertData['endDate'] 		= date('Y-m-d H:i:s',strtotime(trim($data['endDate'])));
			$insertData['maxUsagePerUser'] 	= trim($data['maxUsagePerUser']);
			$insertData['description'] 		= trim($data['description']);
			$insertData['isVisibleInCouponPage'] 		= isset($data['isVisibleInCouponPage'])?1:0;
			$insertData['isVisibleInCheckoutPage'] 		= isset($data['isVisibleInCheckoutPage'])?1:0;
			$insertData['updatedOn'] 		= date('Y-m-d H:i:s');

			if( $couponId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."coupon", $insertData, "couponId = ".$couponId);
			else {
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$updateStatus = $this->Common_model->insert(tablePrefix."coupon", $insertData);
			}

			if( $couponId > 0 )
				return array("valid" => true, "data" => array(), "msg" => "Coupon Updated Successfully!");
			else
				return array("valid" => true, "data" => array(), "msg" => "Coupon Added Successfully!");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Coupon is required!");
	}

	function couponList($data) {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_coupon','can_view_coupon'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );


		$columns = array( 0 => "couponCode", 1 => "discountType", 2 => "discount", 3 => "startDate", 4 => "endDate", 5 => "status", 6 => "couponId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."coupon as ta where ta.status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT ta.* from ".tablePrefix."coupon as ta where ta.status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (ta.couponCode LIKE  '%".$search."%' OR ta.discountType LIKE  '%".$search."%' OR ta.discount LIKE  '%".$search."%' OR ta.startDate LIKE  '%".$search."%' OR ta.endDate LIKE  '%".$search."%' OR ta.status LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."coupon as ta where ta
            	.status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['couponCode'] = $row->couponCode;
                $nestedData['discountType'] = ucfirst($row->discountType);
                $nestedData['discount'] = $row->discount;
                $nestedData['startDate'] = $row->startDate; 
                $nestedData['endDate'] = $row->endDate; 
                
                if ( $row->status == 1 ) {
                	$nestedData['status'] = "DeActive";
                	$btnClass =  "text-danger";
                }
                else {
                	$nestedData['status'] =  "Active";
                	$btnClass =  "text-success";
                }
                $nestedData['action'] = '';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_coupon','can_edit_coupon'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<a class="btn btn-icons btn-rounded btn-light" title="Edit Coupon" href="'.DASHURL.'/admin/coupon/add/'.$row->couponId.'"><i class="fa fa-pencil"></i></a><button onclick="ActivateDeActivateThisRecord(this,\'coupon\','.$row->couponId.');" class="btn btn-icons btn-rounded btn-light '.$btnClass.'" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="fa fa-circle"></i></button>';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_coupon','can_delete_coupon'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light deleteTag" title="Delete Coupon" onclick="delete_row(this,\'coupon\','.$row->couponId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}
	/****************************** coupon Section ************************/

	

    /****************************** menu Section ************************/

	function addMenu($data) {
		if(isset($data['title']) && !empty($data['title'])) {
			$menuId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
			
			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_menu',($menuId)?'can_edit_menu':'can_create_menu'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			
			$condArray = array("status != " => "2", "title" => $data['title']);
			if( $menuId > 0 )
				$condArray['menuId != '] = $menuId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."menu", "menuId", $condArray);
			if( $checkExits )
				return array("valid" => false, "data" => array(), "msg" => "Menu Already Exist!");
			// v3print($data); exit;
			$insertData['type'] 		= trim($data['menuType']);
			$insertData['title'] 		= trim($data['title']);
			$insertData['url'] 			= trim($data['url']);
			$insertData['categoryId'] 	= ($data['menuType'])?trim($data['categoryId']):0;
			$insertData['isNew'] 		= (isset($data['isNew']))?1:0;
			$insertData['updatedOn'] 		= date('Y-m-d H:i:s');

			if( $menuId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."menu", $insertData, "menuId = ".$menuId);
			else {
				$insertData['status'] = 1;
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$updateStatus = $this->Common_model->insert(tablePrefix."menu", $insertData);
			}

			if( $menuId > 0 )
				return array("valid" => true, "msg" => "Menu Updated Successfully!");
			else
				return array("valid" => true, "msg" => "Menu Added Successfully!");

		}
		else 
			return array("valid" => false, "data" => array(), "msg" => "Menu is required!");
	}

	function addSubMenu($data) {
		if(isset($data['submenuTitle']) && !empty($data['submenuTitle'])) {
			$submenuId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
			
			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_menu',($submenuId)?'can_edit_menu':'can_create_menu'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			
			$condArray = array("status != " => "2", "menuId" => trim($data['menuId']), "title" => $data['submenuTitle']);
			if( $submenuId > 0 )
				$condArray['submenuId != '] = $submenuId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."submenu", "submenuId", $condArray);
			if( $checkExits )
				return array("valid" => false, "msg" => "Sub Menu Already Exist!");
			// v3print($data); exit;
			$insertData['type'] 		= trim($data['submenuType']);
			$insertData['menuId'] 		= trim($data['menuId']);
			$insertData['title'] 		= trim($data['submenuTitle']);
			$insertData['url'] 			= trim($data['submenuUrl']);
			$insertData['categoryId'] 	= ($data['submenuType'])?trim($data['submenuCategoryId']):0;
			$insertData['subcategoryId'] 	= ($data['submenuType'])?trim($data['submenuSubCategoryId']):0;
			$insertData['isNew'] 		= (isset($data['isNew']))?1:0;
			$insertData['updatedOn'] 		= date('Y-m-d H:i:s');

			$imageName = $this->uploadImage("menu_images", "uploadIcons" );
			if($imageName) 
				$insertData['img'] = $imageName;

			if( $submenuId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."submenu", $insertData, "submenuId = ".$submenuId);
			else {
				$insertData['status'] = 1;
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$updateStatus = $this->Common_model->insert(tablePrefix."submenu", $insertData);
			}

			if( $submenuId > 0 )
				return array("valid" => true, "msg" => "Sub Menu Updated Successfully!");
			else
				return array("valid" => true, "msg" => "Sub Menu Added Successfully!");

		}
		else 
			return array("valid" => false, "msg" => "Sub Menu is required!");
	}


	function addSubMenuItem($data) {
		if(isset($data['submenuItemTitle']) && !empty($data['submenuItemTitle'])) {
			$submenuItemId = (isset($data['hiddenval']) && !empty($data['hiddenval']) && $data['hiddenval'] > 0 ) ? $data['hiddenval'] : '';
			
			//cheking permission role
			$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_menu',($submenuItemId)?'can_edit_menu':'can_create_menu'],0);
			if(!$checkRolePermission['valid'])
				return $checkRolePermission;

			
			$condArray = array("status != " => "2", "menuId" => trim($data['submenuItemMenuId']), "submenuId" => trim($data['submenuItemSubmenuId']), "title" => $data['submenuItemTitle']);
			if( $submenuItemId > 0 )
				$condArray['submenuItemId != '] = $submenuItemId; 

			$checkExits = $this->Common_model->checkIsExitsorNot(tablePrefix."submenuitem", "submenuItemId", $condArray);
			if( $checkExits )
				return array("valid" => false, "msg" => "Sub Menu Item Already Exist!");
			// v3print($data); exit;
			$insertData['type'] 		= trim($data['submenuItemType']);
			$insertData['menuId'] 		= trim($data['submenuItemMenuId']);
			$insertData['submenuId'] 	= trim($data['submenuItemSubmenuId']);
			$insertData['title'] 		= trim($data['submenuItemTitle']);
			$insertData['url'] 			= trim($data['submenuItemUrl']);
			$insertData['categoryId'] 	= ($data['submenuItemType'])?trim($data['submenuItemCategoryId']):0;
			$insertData['subcategoryId'] 	= ($data['submenuItemType'])?trim($data['submenuItemSubCategoryId']):0;
			$insertData['subcategoryItemId'] 	= ($data['submenuItemType'])?trim($data['submenuItemSubCategoryItemId']):0;
			$insertData['isNew'] 		= (isset($data['isNew']))?1:0;
			$insertData['updatedOn'] 		= date('Y-m-d H:i:s');

			if( $submenuItemId > 0 )
				$updateStatus = $this->Common_model->update(tablePrefix."submenuitem", $insertData, "submenuItemId = ".$submenuItemId);
			else {
				$insertData['status'] = 1;
				$insertData['addedOn'] = date('Y-m-d H:i:s');
				$updateStatus = $this->Common_model->insert(tablePrefix."submenuitem", $insertData);
			}

			if( $submenuItemId > 0 )
				return array("valid" => true, "msg" => "Sub Menu Item Updated Successfully!");
			else
				return array("valid" => true, "msg" => "Sub Menu Item Added Successfully!");

		}
		else 
			return array("valid" => false, "msg" => "Sub Menu Item is required!");
	}


	function updateMenuSetting($data) {
		if(isset($data['mainMenu']) && !empty($data['mainMenu'])) {
			$date = date('Y-m-d H:i:s');
			$this->db->trans_start();
			$this->Common_model->update(tablePrefix."menu", ['status'=>1, 'updatedOn'=>$date], "status = 0");
			$updateMainMenu = $this->Common_model->update(tablePrefix."menu", ['status'=>0, 'updatedOn'=>$date], " FIND_IN_SET(menuId, '".implode(',',$data['mainMenu'])."')");

			if(isset($data['subMenu']) && !empty($data['subMenu'])){

				$this->Common_model->update(tablePrefix."submenu", ['status'=>1, 'updatedOn'=>$date], "status = 0");
				$updateMainMenu = $this->Common_model->update(tablePrefix."submenu", ['status'=>0, 'updatedOn'=>$date], " FIND_IN_SET(submenuId, '".implode(',',$data['subMenu'])."')");
			}

			if(isset($data['subMenuItem']) && !empty($data['subMenuItem'])){

				$this->Common_model->update(tablePrefix."submenuitem", ['status'=>1, 'updatedOn'=>$date], "status = 0");
				$updateMainMenu = $this->Common_model->update(tablePrefix."submenuitem", ['status'=>0, 'updatedOn'=>$date], " FIND_IN_SET(submenuItemId, '".implode(',',$data['subMenuItem'])."')");
			}
			

			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				return array("valid" => false, "msg" => "Something went wrong.");
			}else{
				$this->db->trans_commit();
				return array("valid" => true, "msg" => "Menu Updated Successfully!");
			}
			

		}
		else 
			return array("valid" => false, "msg" => "Menu is required!");
	}

	function editSubmenu($data) {
		if(isset($data['submenuId']) && !empty($data['submenuId'])) {
		
			$subMenuData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."submenu WHERE status != 2 AND submenuId = '".$data['submenuId']."'",1);
			if (!empty($subMenuData)) {
				$subMenuData->subcategoryOptions = '<option value="">Choose Sub Category</option>';
				$subcategorydata = $this->Common_model->exequery("SELECT subcategoryName, subcategoryId, slug FROM ".tablePrefix."subcategory WHERE categoryId= ".$subMenuData->categoryId." ");
				if (!empty($subcategorydata)) {
					foreach ($subcategorydata as $key => $subcategory) {
						$subMenuData->subcategoryOptions .= '<option value="'.$subcategory->subcategoryId.'" '.(($subMenuData->subcategoryId == $subcategory->subcategoryId)?'selected':'').'>'.$subcategory->subcategoryName.'</option>';
					}
				}

				return array("valid" => true, "submenuData" => $subMenuData);
			}else
				return array("valid" => false, "msg" => "Something went wrong.");
		}else 
			return array("valid" => false, "msg" => "Menu is required!");
	}

	function editSubmenuItem($data) {
		if(isset($data['submenuItemId']) && !empty($data['submenuItemId'])) {
		
			$submenuItemData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."submenuitem WHERE status != 2 AND submenuItemId = '".$data['submenuItemId']."'",1);
			if (!empty($submenuItemData)) {
				//sub menu
				$submenuItemData->submenuOptions = '<option value="">Choose Sub Menu</option>';
				$submenudata = $this->Common_model->exequery("SELECT title, submenuId FROM ".tablePrefix."submenu WHERE menuId= ".$submenuItemData->menuId." ");
				if (!empty($submenudata)) {
					foreach ($submenudata as $key => $submenu) {
						$submenuItemData->submenuOptions .= '<option value="'.$submenu->submenuId.'" '.(($submenuItemData->submenuId == $submenu->submenuId)?'selected':'').'>'.$submenu->title.'</option>';
					}
				}
				//subcategory
				$submenuItemData->subcategoryOptions = '<option value="">Choose Sub Category</option>';
				$subcategorydata = $this->Common_model->exequery("SELECT subcategoryName, subcategoryId, slug FROM ".tablePrefix."subcategory WHERE categoryId= ".$submenuItemData->categoryId." ");
				if (!empty($subcategorydata)) {
					foreach ($subcategorydata as $key => $subcategory) {
						$submenuItemData->subcategoryOptions .= '<option value="'.$subcategory->subcategoryId.'" '.(($submenuItemData->subcategoryId == $subcategory->subcategoryId)?'selected':'').'>'.$subcategory->subcategoryName.'</option>';
					}
				}
				// subcategory item
				$submenuItemData->subcategoryItemOptions = '<option value="">Choose Sub Category Item</option>';
				$subcategoryItemdata = $this->Common_model->exequery("SELECT subcategoryItemName, subcategoryItemId, slug FROM ".tablePrefix."subcategoryitem WHERE subcategoryId= ".$submenuItemData->subcategoryId." ");
				if (!empty($subcategoryItemdata)) {
					foreach ($subcategoryItemdata as $key => $subcategoryItem) {
						$submenuItemData->subcategoryItemOptions .= '<option value="'.$subcategoryItem->subcategoryItemId.'" '.(($submenuItemData->subcategoryItemId == $subcategoryItem->subcategoryItemId)?'selected':'').'>'.$subcategoryItem->subcategoryItemName.'</option>';
					}
				}

				return array("valid" => true, "submenuItemData" => $submenuItemData);
			}else
				return array("valid" => false, "msg" => "Something went wrong.");
		}else 
			return array("valid" => false, "msg" => "Menu is required!");
	}

    /****************************** menu Section ************************/


	
	function GetNotificationList($data) {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_notification','can_view_notification'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );


		
		$columns = array( 0 => "type", 1 => "addedOn", 2=>"status", 3 => "notificationId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."notification where status != 3 AND role='admin'",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT * from ".tablePrefix."notification where status != 3 AND role='admin'"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (type LIKE  '%".$search."%' OR addedOn LIKE '%".$search."%' OR status LIKE  '%".$search."%') ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."notification where status != 3  AND role='admin'".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

				$notificationMsg = '';
				if ($row->type == 'order_cancelled') {
					$notificationMsg = 'Order cancelled';
				}else if ($row->type == 'order_assigned') {
					$notificationMsg = 'New order';
				}else if ($row->type == 'order_rejected') {
					$notificationMsg = 'Order rejected';
				}

                $nestedData['notification'] = $notificationMsg;
                $nestedData['time'] = $row->addedOn;
                $nestedData['status'] = ($row->status == 0)?'New':(($row->status == 1)?'Notified':'Seen'); 
                
                $nestedData['action'] = '<a class="btn btn-icons btn-rounded btn-light" title="view" href="'.DASHURL.'/admin/notification/detail/'.$row->notificationId.'"><i class="fa fa-eye"></i></a>';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_notification','can_delete_notification'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light deleteTag" title="Delete" onclick="delete_row(this,\'notification\','.$row->notificationId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}

    public function getAdminNotification() {

			
			
		//cheking permission role
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_notification'],0);
		if(!$checkRolePermission['valid'])
			return $checkRolePermission;
		$notificationHtml = $newOrder = '';$totalRows = 0;
		$notificationData =	$this->Common_model->exequery("SELECT * FROM `ch_notification` WHERE status IN (0,1) AND role = 'admin' ORDER BY addedOn desc");
		$newNotificationData =	$this->Common_model->exequery("SELECT GROUP_CONCAT(notificationId) as new FROM `ch_notification` WHERE status =0 AND role = 'admin'",1);
		$newNoti = (isset($newNotificationData->new) && !empty($newNotificationData->new))?$newNotificationData->new:'';
		if(!empty($newNoti)){

			$newOrderData =	$this->Common_model->exequery("SELECT count(*) as newOrder FROM `ch_notification` WHERE status = 0 AND role = 'admin' AND type = 'new_order_recieved'",1);

			$newOrder = (isset($newOrderData->newOrder) && !empty($newOrderData->newOrder))?$newOrderData->newOrder:'';

			$this->Common_model->update("ch_notification", array('status'=>1), "FIND_IN_SET(notificationId , '".$newNoti."')");
		}

		if( $notificationData ) {
			$totalRows = count($notificationData);
			$notificationHtml = getNotifictaionHtml($notificationData);

		}

		return array("valid" => ( $notificationHtml ) ? TRUE: FALSE, 'notificationHtml' => $notificationHtml, 'totalRows'=>$totalRows, 'new'=>$newNoti, 'newOrder'=>$newOrder);

	}

	
    function GetFrenchiseEnquiryList($data) {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_frenchise','can_view_frenchise'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );


		
		$columns = array( 0 => "name", 1 => "email", 2=>"mobile", 3 => "addedOn",4 => "enquiryId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."fanchise_enquiry where status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT * from ".tablePrefix."fanchise_enquiry where status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (name LIKE  '%".$search."%' OR email LIKE '%".$search."%' OR mobile LIKE  '%".$search."%' OR addedOn LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."fanchise_enquiry where status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['name'] = $row->name;
                $nestedData['email'] = $row->email;
                $nestedData['mobile'] = $row->mobile; 
                $nestedData['addedOn'] = $row->addedOn; 
                
                $nestedData['action'] = '<a class="btn btn-icons btn-rounded btn-light" title="view" href="'.DASHURL.'/admin/enquiry/frenchise_enquiry_detail/'.$row->enquiryId.'"><i class="fa fa-eye"></i></a>';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_frenchise','can_delete_frenchise'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light deleteTag" title="Delete" onclick="delete_row(this,\'fanchise_enquiry\','.$row->enquiryId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}

	function GetCorporateEnquiryList($data) {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_enquiry','can_view_enquiry'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );


		
		$columns = array( 0 => "name", 1 => "email", 2=>"mobile", 3 => "addedOn",4 => "corporateId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."corporate_enquiry where status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT * from ".tablePrefix."corporate_enquiry where status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (name LIKE  '%".$search."%' OR email LIKE '%".$search."%' OR mobile LIKE  '%".$search."%' OR addedOn LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."corporate_enquiry where status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['name'] = $row->name;
                $nestedData['email'] = $row->email;
                $nestedData['mobile'] = $row->mobile; 
                $nestedData['addedOn'] = $row->addedOn; 
                
                $nestedData['action'] = '<a class="btn btn-icons btn-rounded btn-light" title="view" href="'.DASHURL.'/admin/enquiry/corporate_enquiry_detail/'.$row->corporateId.'"><i class="fa fa-eye"></i></a>';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_enquiry','can_delete_enquiry'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light deleteTag" title="Delete" onclick="delete_row(this,\'corporate_enquiry\','.$row->corporateId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}
	function GetContactEnquiryList($data) {
			
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_enquiry','can_view_enquiry'],0);
		if(!$checkRolePermission['valid'])
			return array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval(0), "recordsFiltered" => intval(0), "data" => array() );


		
		$columns = array( 0 => "name", 1 => "email", 2=>"mobile", 3 => "addedOn",4 => "contactId");

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $cond = " order by $order $dir LIMIT $start, $limit ";
  
        $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."contact where status != 2",1);
        $totalData = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
            
        $totalFiltered = $totalData; 
        $qry = "SELECT * from ".tablePrefix."contact where status != 2"; 
        if(empty($this->input->post('search')['value']))

            $queryData = $this->Common_model->exequery($qry.$cond);
        else {
            $search = $this->input->post('search')['value']; 
            if (!empty($search)) {             	
            	$search = str_replace("'", '', $search); 
            	$search = str_replace('"', '', $search); 
             }
            $searchCond = " AND (name LIKE  '%".$search."%' OR email LIKE '%".$search."%' OR mobile LIKE  '%".$search."%' OR addedOn LIKE  '%".$search."%'  ) ";
            $cond = $searchCond.$cond;
            $queryData = $this->Common_model->exequery($qry.$cond);

            $totalDataCount = $this->Common_model->exequery("SELECT count(*) as total from ".tablePrefix."contact where status != 2 ".$searchCond,1);

            $totalFiltered = ( isset($totalDataCount->total)  && $totalDataCount->total > 0 ) ? $totalDataCount->total : 0;
        }
        $data = array();

        if(!empty($queryData))
        {
            foreach ($queryData as $row)
            {	
            		

                $nestedData['name'] = $row->name;
                $nestedData['email'] = $row->email;
                $nestedData['mobile'] = $row->mobile; 
                $nestedData['addedOn'] = $row->addedOn; 
                
                $nestedData['action'] = '<a class="btn btn-icons btn-rounded btn-light" title="view" href="'.DASHURL.'/admin/enquiry/contact_enquiry_detail/'.$row->contactId.'"><i class="fa fa-eye"></i></a>';
				$rolePermission = $this->common_lib->checkRolePermission(['can_manage_all_enquiry','can_delete_enquiry'],0);
				if($rolePermission['valid'])
					$nestedData['action'] .= '<button class="btn btn-icons btn-rounded btn-light deleteTag" title="Delete" onclick="delete_row(this,\'contact\','.$row->contactId.');"><i class="fa fa-trash-o"></i></button>';
                $data[] = $nestedData;

            }
        }
          
        return $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data );
	}

	function getTimeSlotOfDate() {
		$response = array("valid" => false, "msg" => "Invalid request", 'deliverySlotOptions'=>'<option value=""> Select time slot</option>');

		$deliverySlotOptions = '<option value=""> Select time slot</option>';
		$detailId = (isset($_POST['detailId']) && !empty($_POST['detailId']))?trim($_POST['detailId']):0;

		$detailData  = $this->Common_model->exequery("SELECT * FROM ch_order_detail WHERE detailId = '".$detailId."'",1);

		if (!empty($detailData)) {

			$requestedDate = (isset($_POST['requestedDeliveryDate']) && !empty($_POST['requestedDeliveryDate']))?date('Y-m-d', strtotime($_POST['requestedDeliveryDate'])):date('Y-m-d');

			$current = strtotime(date("Y-m-d"));
	 		$date    = strtotime($requestedDate);

	 		$datediff = $date - $current;
	 		$difference = floor($datediff/(60*60*24));

			$productData = $this->Common_model->exequery("SELECT * FROM `ch_product` WHERE productId = '".$detailData->productId."'", true);

			$pincodeData = $this->Common_model->exequery("SELECT pc.*, zn.lastDeliveryTime FROM `ch_pincode` as pc left join ch_zone as zn on zn.zoneId = pc.zoneId WHERE pc.status = 0 AND zn.status = 0 AND pc.pincodeId = '".$detailData->pincodeId."'", true);

			if(!empty($productData) && !empty($pincodeData)){

 				$timeSlots = $this->Common_model->exequery("SELECT * FROM `ch_delivery_time_slots` WHERE status = 0 AND deliveryId = ".$detailData->deliveryTimeSlotId." AND TIME(endTime) <= TIME('".$pincodeData->lastDeliveryTime."') order by startTime asc");
				if (!empty($timeSlots)) {
					foreach ($timeSlots as $timeSlot) {
						
 						// if (($difference == 0 && $productData->isSameDayDelivery && strtotime($timeSlot->startTime) >= strtotime(date('H:i'))) || ($difference > 0 && ($productData->isSameDayDelivery == 1 || $productData->minDayReqtoDeliver <= $difference)) ) {
 						if (($difference == 0 && $productData->isSameDayDelivery) || ($difference > 0 && ($productData->isSameDayDelivery == 1 || $productData->minDayReqtoDeliver <= $difference)) ) {
 							$deliverySlotOptions .=	'<option value="'.$timeSlot->timeslotId.'" '.(($detailData->timeslotId == $timeSlot->timeslotId)?'selected':'').'>'.$timeSlot->startTime.' - '.$timeSlot->endTime.'</option>';
 							
 						}
					}
				}
			}
		}
 	

		if (!empty($deliverySlotOptions))
			
			return array("valid" => true, "deliverySlotOptions" => $deliverySlotOptions);
		else
			return $response;
	}



	public function updateOrderDetails($data, $filedata) {
		$updateStatus = '';
		//cheking permission of user
		$checkRolePermission = $this->common_lib->checkRolePermission(['can_manage_all_order','can_edit_order'],0);
		if(!$checkRolePermission['valid'])
				return $checkRolePermission;

		if (isset($data['hiddenval']) && isset($data['addressId']) && !empty($data['addressId'])) {
			$updateStatus = $this->Common_model->update(tablePrefix."order", ['addressId'=> $data['addressId']], "orderId = '".$data['hiddenval']."' ");
		}elseif (isset($data['hiddenval']) && isset($data['paymentMethod']) && !empty($data['paymentMethod'])) {
			$updateStatus = $this->Common_model->update(tablePrefix."order_transaction", ['paymentMethod' => trim($data['paymentMethod']),'paymentTrxId' => trim($data['paymentTrxId']),'payerMail' => trim($data['payerMail']),'paidAmt' => trim($data['paidAmt']),'paymentMessage' => trim($data['paymentMessage']),'paymentStatus' => trim($data['paymentStatus']),'updatedOn' => date('Y-m-d H:i:s')], "transactionId = '".$data['hiddenval']."' ");
		}elseif (isset($data['hiddenval']) && isset($data['guestEmail']) && !empty($data['guestEmail'])) {
			$updateStatus = $this->Common_model->update(tablePrefix."order", ['guestEmail' => trim($data['guestEmail']),'senderName' => trim($data['senderName']),'senderNo' => trim($data['senderNo']),'updatedOn' => date('Y-m-d H:i:s')], "orderId = '".$data['hiddenval']."' ");
		}else{
		
	        $queryData = array();
			if (isset($data['requestedDeliveryDate'])) {
				$queryData['requestedDeliveryDate'] = $data['requestedDeliveryDate'];
				$queryData['timeslotId'] = $data['timeslotId'];
			}
			if (isset($data['message'])) {
				$queryData['message'] = $data['message'];
			}

			$imageName = $this->uploadImage("order_images", "uploadIcons" );
			if($imageName) 
				$queryData['img'] = $imageName;

			if(!empty($queryData))
				$updateStatus = $this->Common_model->update(tablePrefix."order_detail", $queryData, "detailId = '".$data['hiddenval']."' ");
		}

		if( $updateStatus )
			return array("valid" => true, "msg" => "Order Updated Successfully!");

		else
			return array("valid" => false, "msg" => "Something went wrong.");

			
	}
			// add or update user address
	public function updateAddress(){
		$response =	 array('valid'=>false, 'msg'=>'Invalid request.');
		if(isset($_POST['addressId']) && !empty($_POST['addressId'])) {
			$addressId = ($_POST['addressId'] > 0)?$_POST['addressId']:0;
			$queryData   =  array();
			$queryData['addressName']	=   trim($_POST['addressName']);
			$queryData['address']	 	=   trim($_POST['address']);
			$queryData['address2']	 	=   trim($_POST['address2']);
			$queryData['city']	 		=   trim($_POST['city']);
			$queryData['state']			=   trim($_POST['state']);
			$queryData['country']	 	=   trim($_POST['country']);
			$queryData['pincode']	 	=   trim($_POST['pincode']);
			$queryData['lat']	 		=   trim($_POST['lat']);
			$queryData['lang']	 		=   trim($_POST['lang']);
			$queryData['name']	 		=   trim($_POST['name']);
			$queryData['mobile']	 	=   trim($_POST['mobile']);
			$queryData['updatedOn']	 	=   date('Y-m-d H:i:s');
			
			$cond 	=	"addressId = ".$addressId;
			$updatetStatus 		= 	$this->Common_model->update("ch_user_address", $queryData,$cond);
			
			if($updatetStatus){
					$response['valid']=true;
					$response['msg']="Address updated successfully.";
				
			}else
				$response['msg']= "Something went wrong.";
		
		}
		return $response;
	}
	// get filters
	public function getDashboardfilterData(){
		$response =	 array('valid'=>false, 'msg'=>'Invalid request.');
		if(isset($_POST['daterange']) && !empty($_POST['daterange'])) {
			$datesArr = explode(' - ', trim($_POST['daterange']));
			$datesArr[0] = date('Y-m-d', strtotime($datesArr[0]));
			$datesArr[1] = date('Y-m-d', strtotime($datesArr[1]));
			// if($datesArr[0] == $datesArr[1]){
			// 	$cond = " AND date(addedOn) = date(now())";
			// }else
			$cond = " AND (date(addedOn) >= date('$datesArr[0]') AND date(addedOn) <= date('$datesArr[1]'))";
			
			$query	=	"SELECT count(*) as totalOrder,
			(SELECT Sum(paidAmt) FROM ch_order_transaction where paymentStatus = '1' and (SELECT status FROM ch_order where ch_order.orderId = ch_order_transaction.orderId limit 0, 1) = 5 $cond) as totalRevenue,
			(SELECT count(*) FROM ch_order where status = 5 $cond ) as totalSuccess,
			(SELECT count(*) FROM ch_order where status > 5 $cond ) as totalFailed
			from ch_order where orderId > 0 $cond";


			$statisticsData =	$this->Common_model->exequery($query,1);
			if(!empty($statisticsData)){
				$statisticsData->totalOrder = ($statisticsData->totalOrder > 0)?$statisticsData->totalOrder:0;
				$statisticsData->totalRevenue = ($statisticsData->totalRevenue > 0)?$statisticsData->totalRevenue:0;
				$statisticsData->totalSuccess = ($statisticsData->totalSuccess > 0)?$statisticsData->totalSuccess:0;
				$statisticsData->totalFailed = ($statisticsData->totalFailed > 0)?$statisticsData->totalFailed:0;
				$response['valid']=true;
				$response['data']=$statisticsData;
				
			}else
				$response['msg']= "Something went wrong.";
		
		}
		return $response;
	}
	
	// get product filters
	public function searchProduct(){
		$response =	 array('valid'=>false, 'msg'=>'Invalid request.');
		if(isset($_POST['str']) && !empty($_POST['str'])) {
      		$productData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."product WHERE status ='0' AND productName like '%".trim($_POST['str'])."%' order by productName asc limit 0, 10");

      
	         	$hint="";
	      	if (!empty($productData)) {
	         	foreach ($productData as $product) {
	            	$hint.="<a href='javascript:' class='search-product' data-id='".$product->productId."'>".$product->productName."</a><br/>";
	         	}
	      	}

			$response['valid']=true;
			$response['data']=($hint=="")?"no suggestion":$hint;
		}
		return $response;
	}
	// get product filters
	public function getProductData01(){
		$response =	 array('valid'=>false, 'msg'=>'Detail not found.');
		if(isset($_POST['productId']) && !empty($_POST['productId'])) {
      		$productData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."product WHERE status ='0' AND productId = '".trim($_POST['productId'])."'",1);
	      	if (!empty($productData)) {
	      		$variableData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."product_variable WHERE status ='0' AND productId = '".trim($_POST['productId'])."'");
	      		$productData->variableData  = (!empty($variableData))?$variableData:'';
	      		$addonsData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."product_addons WHERE status ='0' AND FIND_IN_SET(addonsId, '".$productData->addonsId."')");
	      		$productData->addonsData  = (!empty($addonsData))?$addonsData:'';

	      		$attributeData = $this->Common_model->exequery("SELECT * FROM `ch_product_attribute` WHERE status = 0 AND productId = ".$productData->productId." order by attributeId asc");
	 			if (!empty($attributeData)) {
	 				foreach ($attributeData as $attribute) {
	 					$attribute->attributeItems = $this->Common_model->exequery("SELECT * FROM `ch_product_attributeinfo` WHERE status = 0 AND attributeHeadingId = ".$attribute->attributeId." order by attributeInfoId asc");
	 				}
	 			}

	      		$productData->attributeData  = (!empty($attributeData))?$attributeData:'';
				$response['valid']=true;
				$response['productData']=$productData;
	      	}

		}
		return $response;
	}

	// get product filters
	public function getProductData(){
		$response =	 array('valid'=>false, 'msg'=>'Detail not found.');
		$productId = (isset($_POST['productId']) && !empty($_POST['productId']))? trim($_POST['productId']):0;
		$this->outputData['productData'] = $this->Common_model->exequery("SELECT pd.*,ca.categoryName, ca.slug as categorySlug, pd.addonsId, (CASE WHEN productType = 1 THEN (SELECT actualPrice FROM ch_product_variable WHERE status = 0 AND productId = pd.productId order by actualPrice asc limit 0, 1) ELSE pd.actualPrice END ) as actualPrice, (CASE WHEN productType = 1 THEN (SELECT salePrice FROM ch_product_variable WHERE status = 0 AND productId = pd.productId order by actualPrice asc limit 0, 1) ELSE pd.salePrice END ) as salePrice,(SELECT GROUP_CONCAT(DISTINCT categoryId) FROM `ch_product_category` WHERE `productId` = pd.productId AND `categoryType`='category') as categoryIds, (SELECT avg(ch_review.rating) FROM `ch_review` WHERE ch_review.productId = pd.productId) as rating, (SELECT imageName FROM ".tablePrefix."images  WHERE imageId = pd.featuredImageId ) as img FROM ch_product as pd left join ".tablePrefix."product_category as pc on (pc.categoryType = 'category' and pc.productId = pd.productId) left join ".tablePrefix."category as ca on ca.categoryId = pc.categoryId left join ".tablePrefix."product_category as pcs on (pcs.categoryType = 'subcategory' and pcs.productId = pd.productId) left join ".tablePrefix."subcategory as sc on sc.subcategoryId = pcs.categoryId left join ".tablePrefix."product_category as pcsi on (pcsi.categoryType = 'subcategoryItem' and pcsi.productId = pd.productId) left join ".tablePrefix."subcategoryitem as sci on sci.subcategoryItemId = pcsi.categoryId where pd.status = 0 AND  pd.productId ='".$productId."'",1);
		if (isset($this->outputData['productData']->productId) && !empty($this->outputData['productData']->productId)) {

	 		$this->outputData['variableData'] = $this->Common_model->exequery("SELECT pv.*, (case when pv.imageId > 0 then (SELECT imageName FROM ".tablePrefix."images  WHERE imageId = pv.imageId ) else '' end) as img FROM ".tablePrefix."product_variable as pv WHERE pv.status = 0 AND pv.productId = ".$this->outputData['productData']->productId." having img !='' order by actualPrice asc");

	 		$this->outputData['attributeData'] = $this->Common_model->exequery("SELECT * FROM `ch_product_attribute` WHERE status = 0 AND productId = ".$this->outputData['productData']->productId." order by attributeId asc");
 			if (!empty($this->outputData['attributeData'])) {
 				foreach ($this->outputData['attributeData'] as $attribute) {
 					$attribute->attributeItems = $this->Common_model->exequery("SELECT * FROM `ch_product_attributeinfo` WHERE status = 0 AND attributeHeadingId = ".$attribute->attributeId." order by attributeInfoId asc");
 				}
 			}

	        $this->outputData['addonsData'] = $this->Common_model->exequery("SELECT * FROM ch_product_addons WHERE status = 0 AND FIND_IN_SET(addonsId,'".$this->outputData['productData']->addonsId."') ");

			
	    	return $response = array( 'valid'=>true, 'data' => $this->load->viewD('admin/order_add_product_to_cart', $this->outputData, true));
	    }

	    return $response;
	    

	}



	

}