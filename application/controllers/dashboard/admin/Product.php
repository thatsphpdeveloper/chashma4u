<?php
 /**
  * Product Controllers
  */
 class Product extends CI_Controller
 {
 	
  public $menu    = 3;
  public $subMenu   = 31;
 	public $outputdata 	= array();
 	function __construct(){
		parent::__construct();
		$this->session->set_userdata(PREFIX.'sessDashboard', "admin");
		$this->common_lib->setSessionVariables();
	}

 	public function index()
 	{ 
    redirect(DASHURL.'/admin/product/productlist');
 	}
 	public function brand() {
    $this->menu    = 3;
    $this->subMenu   = 3.01;
    $this->common_lib->checkRolePermission(['can_manage_all_product_brand','can_view_product_brand']);
 		$this->load->viewD('admin/add_brand_view',$this->outputdata);
 	}
  public function shape() {
    $this->menu    = 3;
    $this->subMenu   = 3.11;
    $this->common_lib->checkRolePermission(['can_manage_all_product_shape','can_view_product_shape']);
    $this->load->viewD('admin/add_shape_view',$this->outputdata);
  }
  public function attribute() {
    $this->menu    = 3;
    $this->subMenu   = 3.1;
    $this->common_lib->checkRolePermission(['can_manage_all_product_attribute','can_view_product_attribute']);
    $this->load->viewD('admin/add_attribute_view',$this->outputdata);
  }
 	public function attributeoption() {
    $this->menu    = 3;
    $this->subMenu   = 3.2;
    $this->common_lib->checkRolePermission(['can_manage_all_product_attribute','can_view_product_attribute']);
 		$this->outputdata['attributeDropDown'] = $this->common_lib->getDropDown("SELECT attributeId as id, attributeName as name FROM ".tablePrefix."attribute WHERE status = 0 order by attributeName asc");
 		$this->load->viewD('admin/add_attribute_option_view',$this->outputdata);
 	}
  public function category() {
    $this->menu    = 3;
    $this->subMenu   = 31;
    $this->common_lib->checkRolePermission(['can_manage_all_product_category','can_view_product_category']);
    $this->load->viewD('admin/addcategory_view',$this->outputdata);
  }
  public function subcategory() {
    $this->menu    = 3;
    $this->subMenu   = 32;
    $this->common_lib->checkRolePermission(['can_manage_all_product_category','can_view_product_category']);
    $this->outputdata['categoryDropDown'] = $this->common_lib->getDropDown("SELECT categoryId as id, categoryName as name FROM ".tablePrefix."category WHERE status !='2' order by categoryName asc");
    $this->load->viewD('admin/add_subcategory_view',$this->outputdata);
  }
 	public function subcategoryitem() {
    $this->menu    = 3;
    $this->subMenu   = 33;
    $this->common_lib->checkRolePermission(['can_manage_all_product_category','can_view_product_category']);
 		$this->outputdata['categoryDropDown'] = $this->common_lib->getDropDown("SELECT categoryId as id, categoryName as name FROM ".tablePrefix."category WHERE status !='2' order by categoryName asc");
 		$this->load->viewD('admin/add_subcategory_item_view',$this->outputdata);
 	}

  public function productlist(){
    $this->menu    = 3;
    $this->subMenu   = 34;
    $this->common_lib->checkRolePermission(['can_manage_all_product','can_view_product']);
    $this->load->viewD('admin/product_list',$this->outputdata);
  }
   	
  public function add($productId = '') {
    $this->menu    = 3;
    $this->subMenu   = 35;

    $this->common_lib->checkRolePermission(['can_manage_all_product',($productId)?'can_edit_product':'can_create_product']);
      if( $productId > 0 ) {
         $getProductInfo = $this->Common_model->exequery("SELECT *, (case when ch_product.featuredImageId != 0 then (SELECT concat('".UPLOADPATH."/images/', imageName) FROM ".tablePrefix."images  WHERE imageId = ch_product.featuredImageId ) else '' end) as img FROM ".tablePrefix."product WHERE productId =".$productId,1);
         if($getProductInfo) {
          $this->outputdata['productData'] = $getProductInfo;
            $productSelectedCategory = $this->Common_model->exequery("SELECT GROUP_CONCAT(categoryId) as categoryIds, categoryType FROM ".tablePrefix."product_category WHERE productId=".$productId." group by categoryType");
            // v3print($productSelectedCategory ); exit;
            if( $productSelectedCategory )
              $this->outputdata['productSelectedCategory'] = $productSelectedCategory;
            $productgalleryImage = $this->Common_model->exequery("SELECT prodImages.productImageId, (case when prodImages.imageId != 0 then (SELECT concat('".UPLOADPATH."/images/', imageName) FROM ".tablePrefix."images  WHERE imageId = prodImages.imageId ) else '".NOIMAGE."' end) as iconsUrl FROM ".tablePrefix."product_images prodImages WHERE prodImages.status != 2 AND prodImages.productId=".$productId."");
            if( $productgalleryImage )
              $this->outputdata['productgalleryImage'] = $productgalleryImage;
            // $productAttributeData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."product_attribute WHERE status != 2 AND productId=".$productId);
            // if( $productAttributeData ) {
            //   foreach($productAttributeData as $productAttributeHeading) {
            //     $productAttributeInfo = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."product_attributeinfo WHERE  status != 2 AND productId=".$productId." AND attributeHeadingId=".$productAttributeHeading->attributeId);
            //     $productAttributeHeading->productAttributeInfo = ( $productAttributeInfo ) ? $productAttributeInfo : array();
            //   }
            // }
            // if( $productAttributeData )
            //   $this->outputdata['productAttributeData'] = $productAttributeData;
            if($getProductInfo->productType == 1) {
              $this->outputdata['variableData'] = $this->Common_model->exequery("SELECT *, (case when ch_product_variable.imageId != 0 then (SELECT concat('".UPLOADPATH."/images/', imageName) FROM ".tablePrefix."images  WHERE imageId = ch_product_variable.imageId ) else '' end) as img FROM ".tablePrefix."product_variable WHERE status != 2 AND productId=".$getProductInfo->productId);
            }
            // if(!empty($getProductInfo->undeliverCityId)) {
            //   $this->outputdata['undeliverCityData'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."zone WHERE zoneId IN(".$getProductInfo->undeliverCityId.")");
            // }
            // if(!empty($getProductInfo->deliveryCityId)) {
            //   $this->outputdata['deliverCityData'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."zone WHERE zoneId IN(".$getProductInfo->deliveryCityId.")");
            // }
            // if(!empty($getProductInfo->undeliverPincodeId)) {
            //   $this->outputdata['undeliverPincodeData'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."pincode WHERE pincodeId IN(".$getProductInfo->undeliverPincodeId.")");
            // }
         }
         else
              redirect(DASHURL.'/product/productlist');
      }
      $categoryList = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."category WHERE status != 2 order by categoryName asc");
      if( $categoryList ) {
        foreach( $categoryList as $categoryVal ) {
          $subCategoryList = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."subcategory WHERE status != 2 AND categoryId = '".$categoryVal->categoryId."' order by subcategoryName asc");
          // if( $subCategoryList ) {
          //   foreach ($subCategoryList as $subCategoryVal) {
          //     $subCategoryItemList = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."subcategoryitem WHERE status != 2 AND categoryId = '".$categoryVal->categoryId."' AND subcategoryId = '".$subCategoryVal->subcategoryId."' order by subcategoryItemName asc");
          //     $subCategoryVal->subcategoryItemList = ($subCategoryItemList) ? $subCategoryItemList : array();
          //   }
          // }
          $categoryVal->subCategoryList = ($subCategoryList) ? $subCategoryList : array();
        }
      }
      $this->outputdata['categoryList'] = ( $categoryList ) ? $categoryList : array();
      // $zones = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."zone WHERE status != 2 order by zoneName asc");
      // $zonesList = array();
      // $pincodeList = array();
      // if($zones) {
      //   foreach ($zones as $key => $zoneItem) {
      //     array_push($zonesList, '"'.$zoneItem->zoneName.'"');
      //   }
      // }
      // $this->outputdata['addonsData'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."product_addons WHERE status = 0 order by addonsName asc");
      $this->outputdata['brandData'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."brand WHERE status = 0 order by brandName asc");
      $this->outputdata['shapeData'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."shape WHERE status = 0 order by shapeName asc");
      $this->outputdata['attributeData'] = $this->Common_model->exequery("SELECT ato.*, attributeName FROM `ch_attribute_option` as ato left join ch_attribute as att on att.attributeId = ato.attributeId WHERE ato.status = 0 order by ato.name asc");
      // $pincodes = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."pincode WHERE status != 2 order by pincode asc");
      // if($pincodes) {
      //   foreach ($pincodes as $key => $pinCodeItem) {
      //     array_push($pincodeList, '"'.$pinCodeItem->pincode.'"');
      //   }
      // }
      /************************* Custom CSS Or header Element *******************************/
      // $this->outputdata['headScript'] = '<link rel="stylesheet" href="'.base_url().'system/static/dashboard/admin/css/bootstrap.css"><link rel="stylesheet" href="'.base_url().'system/static/dashboard/admin/css/bootstrap-tagsinput.css">';

      /************************* Custom JS Or Footer Element *********************************/
      // $this->outputdata['footerScript'] = ' <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script><script type="text/javascript" src="'.DASHSTATIC.'/admin/js/bootstrap-tagsinput.min.js"></script><script type="text/javascript">$(document).ready(function(){ 
      //   localStorage.clear();
      //   var pincodes = new Bloodhound({
      //     datumTokenizer: Bloodhound.tokenizers.obj.whitespace("text"),
      //     queryTokenizer: Bloodhound.tokenizers.whitespace,
      //     prefetch: "'.DASHURL.'/admin/zone/pincodejson"
      //   });
      //   pincodes.initialize();
      //   var cities = new Bloodhound({
      //     datumTokenizer: Bloodhound.tokenizers.obj.whitespace("text"),
      //     queryTokenizer: Bloodhound.tokenizers.whitespace,
      //     prefetch: "'.DASHURL.'/admin/zone/zonejson"
      //   });
      //   cities.initialize();
       
      //   $("#excludedCities").tagsinput({itemValue: "value",
      //     itemText: "text",
      //     typeaheadjs: {
      //       name: "cities",
      //       displayKey: "text",
      //       source: cities.ttAdapter()
      //   }});
      //   $("#specificCities").tagsinput({itemValue: "value",
      //     itemText: "text",
      //     typeaheadjs: {
      //       name: "cities",
      //       displayKey: "text",
      //       source: cities.ttAdapter()
      //   }}); 
      //   $("#excludePinCodes").tagsinput({itemValue: "value",
      //     itemText: "text",
      //     typeaheadjs: {
      //       name: "pincodes",
      //       displayKey: "text",
      //       source: pincodes.ttAdapter()
      //   }});
      //   });</script>';
   		$this->load->viewD('admin/add_product_view',$this->outputdata);
   	}


      // today deal add view


  public function detail($productId = '') {
    $this->menu    = 3;
    $this->subMenu   = 34;

  }
  public function todaydeal($todaydealId = 0){
        $this->menu     =   3;
        $this->subMenu  =   37;
        $this->common_lib->checkRolePermission(['can_manage_all_today_deal',($todaydealId)?'can_edit_today_deal':'can_create_today_deal']);
        if(isset($_POST) && !empty($_POST['date'])) {
            $istodaydealProductUpdated = 0;$status = $updatetStatus ='';
            $this->db->trans_begin();
            $date = $_POST['date'];
            // foreach ($_POST['date'] as $date) {
                if ($date){
                    $status = $updatetStatus ='';
                    $insertData   =  array();

                    if($todaydealId > 0)
                        $isExistCond = " and todaydealId !=".$todaydealId;
                    else
                        $isExistCond = '';

                    $isExist = $this->Common_model->selRowData("ch_todaydeal","","status != '2' and date = '".$date."' and startTime = '".$_POST['startTime']."' and endTime = '".$_POST['endTime']."' ".$isExistCond);
                    $status = ($isExist)?'alreadyExist':'';
                    $status = ($status=='' && (!isset($_POST['productId']) || empty($_POST['productId'])))?'productIdRequired':$status;

                    if($status==''){
                        $insertData['date']          =   trim($date);
                        $insertData['startTime']    =   trim($_POST['startTime']);
                        $insertData['endTime']      =   trim($_POST['endTime']);
                        $productIds =   (!empty($_POST['productId']))?implode(',', $_POST['productId']):'';
                        $insertData['updatedOn']    =   date('Y-m-d H:i:s');

                        if($todaydealId > 0){
                            $cond   =   "todaydealId = ".$todaydealId;
                            $updatetStatus      =   $this->Common_model->update("ch_todaydeal", $insertData,$cond);
                            if($updatetStatus){
                                $updatetStatus = $todaydealId;
                                $status = 'updated';
                            }
                        }else if($todaydealId == 0 && !$isExist){
                            $insertData['addedOn']       =   date('Y-m-d H:i:s');
                            $updatetStatus      =   $this->Common_model->insert("ch_todaydeal", $insertData);
                            if($updatetStatus)
                                $status = 'added';
                        }
                    }

                    if($updatetStatus)
                        $istodaydealProductUpdated = $this->updateTodaydealProduct($updatetStatus,$_POST);
                }
            // }

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $this->common_lib->setSessMsg('Some thing is wrong.', 2);
                $this->outputdata['isError'] = 1;
            }
            elseif ($istodaydealProductUpdated && ($status == 'added' || $status == 'updated')){
                $this->db->trans_commit();
                if($status == 'added')
                    $this->common_lib->setSessMsg('Today Deal added successfully.', 1);
                else if($status == 'updated')
                    $this->common_lib->setSessMsg('Today Deal updated successfully.', 1);
            }
            else{
                $this->db->trans_rollback();
                $this->outputdata['isError'] = 1;
                if($status == 'alreadyExist')
                    $this->common_lib->setSessMsg('This Today Deal is already exist.', 2);
                else if($status == 'productIdRequired')
                    $this->common_lib->setSessMsg('Some thing is wrong with products.', 2);
                else
                    $this->common_lib->setSessMsg('Some thing is wrong.', 2);
            }
            
        }

        if ($todaydealId > 0){
            $this->outputdata['todaydealData'] = $this->Common_model->exequery("SELECT *, (SELECT GROUP_CONCAT(ch_todaydeal_product.productId) from ch_todaydeal_product where ch_todaydeal_product.status = 0 and ch_todaydeal_product.todaydealId = ch_todaydeal.todaydealId) as todaydealProductId FROM ch_todaydeal WHERE status != 2 AND todaydealId = ".$todaydealId,1);

            if (!isset($this->outputdata['todaydealData']->todaydealId) || empty($this->outputdata['todaydealData']->todaydealId)){
                $this->common_lib->setSessMsg('Inavlid request.', 2);
                redirect(DASHURL.'/admin/product/todaydeallist');
            }

        }

        $this->outputdata['productData'] = $this->Common_model->exequery("SELECT productId, actualPrice as price, productName, productType, (SELECT price from ch_todaydeal_product where ch_todaydeal_product.status != 2 AND ch_todaydeal_product.productId = ch_product.productId AND ch_todaydeal_product.todaydealId = $todaydealId limit 0,1 ) as discountedPrice FROM ch_product WHERE status = 0 order by productName ASC");
        if (!empty($this->outputdata['productData'])) {
            foreach ($this->outputdata['productData'] as $product) {
                $product->variableData = ($product->productType)?$this->Common_model->exequery("SELECT *, actualPrice as price, variableTitle as variableName, (SELECT price from ch_todaydeal_product where ch_todaydeal_product.status != 2 AND ch_todaydeal_product.productId = ch_product_variable.productId AND ch_todaydeal_product.variableId = ch_product_variable.variableId AND ch_todaydeal_product.todaydealId = $todaydealId limit 0,1) as discountedPrice FROM ch_product_variable WHERE status = 0 and productId = ".$product->productId." order by variableTitle ASC"):array();
            }
        }

        $this->load->viewD('admin/add_todaydeal_view',$this->outputdata);
  }

    // today deal list view

  public function todaydeallist(){   

      $this->menu     =   3;

      $this->subMenu  =   36;

      $this->common_lib->checkRolePermission(['can_manage_all_today_deal','can_view_today_deal']);

      $this->load->viewD('admin/todaydeal_list_view', $this->outputdata);

  }

    // today deal details view

  public function todaydealview($todaydealId = 0){   

      $this->menu     =   3;
      $this->subMenu  =   36;
      $this->common_lib->checkRolePermission(['can_manage_all_today_deal','can_view_today_deal']);
      $this->outputdata['todaydealData'] = $this->Common_model->exequery("SELECT hh.todaydealId  , hh.date, hh.startTime, hh.endTime, hh.addedOn, case when hh.status='0' then 'Active' else 'DeActive' end as status, case when hh.status='0' then 'label label-success' else 'label label-warning' end as class from ch_todaydeal as hh  where hh.status != 2 AND todaydealId = ".$todaydealId,1);
      if (!isset($this->outputdata['todaydealData']->todaydealId) || empty($this->outputdata['todaydealData']->todaydealId)){
          $this->common_lib->setSessMsg('Invalid request.', 2);
          redirect(DASHURL.'/admin/product/todaydeallist');
      }
      $this->outputdata['productData'] = $this->Common_model->exequery("SELECT hp.productId, hp.price, (CASE WHEN hp.variableId > 0 THEN vd.actualPrice ELSE pd.actualPrice END) as oldPrice, (CASE WHEN hp.variableId > 0 THEN CONCAT(pd.productName,' (',vd.variableTitle,')') ELSE pd.productName END) as productName FROM ch_todaydeal_product as hp left join ch_product as pd on pd.productId = hp.productId left join ch_product_variable as vd on vd.variableId = hp.variableId where hp.status = 0  AND pd.status = 0 and hp.todaydealId = ".$this->outputdata['todaydealData']->todaydealId." ORDER BY pd.productName ASC , vd.variableTitle ASC");

      $this->load->viewD('admin/todaydeal_details_view', $this->outputdata);

  } 


      // update restaurant today deal
  public function updateTodaydealProduct($todaydealId,$postData){
    $queryStatus = 0;
    if (isset($postData['productId']) && !empty($postData['productId']) && $todaydealId > 0) {

      $this->Common_model->update("ch_todaydeal_product",array('status' => 3, 'updatedOn' => date('Y-m-d H:i:s')),"status != '2' and todaydealId = ".$todaydealId);
      foreach ($postData['productId'] as $key => $productId){
        if(isset($postData['variableId'.$productId]) && !empty($postData['variableId'.$productId])){
          foreach ($postData['variableId'.$productId] as $vKey => $variableId) {
            $variableDiscountedPrice  =   (isset($postData['discountedPrice'.$productId][$vKey]) && !empty($postData['discountedPrice'.$productId][$vKey]))?$postData['discountedPrice'.$productId][$vKey]:0;
            $variablePrice  =   (isset($postData['variablePrice'.$productId][$vKey]) && !empty($postData['Price'.$productId][$vKey]))?$postData['variablePrice'.$productId][$vKey]:0;
            if ($variableDiscountedPrice > 0) {
              $cond01 = "status != '2' and todaydealId = '".$todaydealId."' and productId = '".$productId."' and variableId = '".$variableId."'";
              $todaydealProduct = array('todaydealId' => $todaydealId, 'productId' => $productId, 'variableId' => $variableId, 'oldPrice' => $variablePrice, 'price' => $variableDiscountedPrice, 'status' => 0, 'updatedOn' => date('Y-m-d H:i:s'));
              $istodaydealExist = $this->Common_model->selRowData("ch_todaydeal_product","",$cond01);
              if (!empty($istodaydealExist))
                $queryStatus = $this->Common_model->update("ch_todaydeal_product",$todaydealProduct,$cond01);
              else{
                $todaydealProduct['addedOn']  = date('Y-m-d H:i:s');
                $queryStatus = $this->Common_model->insert("ch_todaydeal_product", $todaydealProduct);
              }
            }
          }
        }else{
          $discountedPrice  =   (isset($postData['discountedPrice'][$key]) && !empty($postData['discountedPrice'][$key]))?$postData['discountedPrice'][$key]:0;
          if ($discountedPrice > 0) {
            $cond01 = "status != '2' and todaydealId = '".$todaydealId."' and productId = '".$productId."'";
            $todaydealProduct = array('todaydealId' => $todaydealId, 'productId' => $productId, 'oldPrice' => $postData['price'][$key], 'price' =>$discountedPrice, 'status' => 0, 'updatedOn' => date('Y-m-d H:i:s'));
            $istodaydealExist = $this->Common_model->selRowData("ch_todaydeal_product","",$cond01);
            if (!empty($istodaydealExist))
              $queryStatus = $this->Common_model->update("ch_todaydeal_product",$todaydealProduct,$cond01);
            else{
              $todaydealProduct['addedOn']  = date('Y-m-d H:i:s');
              $queryStatus = $this->Common_model->insert("ch_todaydeal_product", $todaydealProduct);
            }
          }
        }
      }
      $this->Common_model->update("ch_todaydeal_product",array('status' => 2, 'updatedOn' => date('Y-m-d H:i:s')),"status = 3");
    }
    return $queryStatus;
  }

  public function lenscategory() {
    $this->menu    = 3;
    $this->subMenu   = 3.02;
    $this->common_lib->checkRolePermission(['can_manage_all_product_category','can_view_product_category']);
    $this->load->viewD('admin/add_lens_category_view',$this->outputdata);
  }

  public function lens(){
    $this->menu     =   3;
    $this->subMenu  =   3.03;
    $this->common_lib->checkRolePermission(['can_create_product','can_view_product']);
    $this->outputdata['categoryDropDown'] = $this->common_lib->getDropDown("SELECT categoryId as id, categoryName as name FROM ".tablePrefix."lens_category WHERE status !='2' order by categoryName asc");
    $this->load->viewD('admin/lens_view', $this->outputdata);
  }

  public function addlens(){
    $this->menu     =   3;
    $this->subMenu  =   3.04;
    $this->common_lib->checkRolePermission(['can_create_product','can_view_product']);

    $this->load->viewD('admin/add_lens_view', $this->outputdata);
  }



 }
?>