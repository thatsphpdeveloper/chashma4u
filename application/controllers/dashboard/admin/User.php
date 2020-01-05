<?php
 /**
  * User Controllers
  */
 class User extends CI_Controller {
 	
  public $menu    = 11;
  public $subMenu   = 111;
 	public $outputdata 	= array();
 	function __construct(){
		parent::__construct();
		$this->session->set_userdata(PREFIX.'sessDashboard', "admin");
		$this->common_lib->setSessionVariables();
	}

 	public function index()
 	{
 		
 		redirect(DASHURL.'/admin/user/userlist');
 	}

 	public function add($userId = 0){
    $this->menu     =   11;
    $this->subMenu  =   111;
    $this->common_lib->checkRolePermission(['can_manage_all_user',($userId)?'can_edit_user':'can_create_user']);
    $countDelivery = 0;
    $this->outputdata['userData'] = ($userId > 0)?$this->Common_model->exequery("SELECT *, (case when img != '' then concat('".UPLOADPATH."/user_images/', img) else '' end) as image FROM ".tablePrefix."user WHERE status != 2 AND userId ='".$userId."'",1):array();

    if($userId>0){
      $getuserAddressDetails = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."user_address WHERE status != 2 AND userId = ".$userId);
      
      if( $getuserAddressDetails ) {
        
        $deliverySectionHtml = '';
        foreach($getuserAddressDetails as $key => $deliveryData ) {
               
            $deliverySectionHtml .='<div class="AddressSection address_row1 row" data-counter="'.$countDelivery.'">
                                <div class="form-group col-md-6">
                                  <label for="addressType">Address Type</label>
                                  <input type="text" class="form-control" id="addressType" value="'.$deliveryData->addressName.'" placeholder="Adress Type" name="addressType['.$countDelivery.']" required>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="address">Address</label>
                                  <input type="text" class="form-control" id="address" placeholder="Delivery Address" value="'.$deliveryData->address.'" name="address['.$countDelivery.']" required>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="address">Address2</label>
                                  <input type="text" class="form-control" id="addresss" placeholder="Delivery Address2" value="'.$deliveryData->address.'" name="addresss['.$countDelivery.']" required>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="city">City</label>
                                  <input type="text" class="form-control" id="city" placeholder="Delivery City" value="'.$deliveryData->city.'" name="city['.$countDelivery.']" required>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="state">State</label>
                                  <input type="text" class="form-control" id="state" placeholder="Delivery State" name="state['.$countDelivery.']" value="'.$deliveryData->state.'" required>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="country">Country</label>
                                  <input type="text" class="form-control" id="country" placeholder="Delivery Country" value="'.$deliveryData->country.'" name="country['.$countDelivery.']" required>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="pincode">Pincode</label>
                                  <input type="text" class="form-control" id="pincode" placeholder="Delivery Pincode" value="'.$deliveryData->pincode.'" name="pincode['.$countDelivery.']" required>
                                </div>
                                <div class="form-group col-md-6">
                                <input type="hidden" class="form-control"  name="addressId['.$countDelivery.']" value="'.$deliveryData->addressId.'">  
                                <button type="button" class="btn btn-success removeAddressSection"><i class="fa fa-times"></i> Remove</button>
                                </div></div>                            
                              ';
        $addressSectionHtml='';                      
        $addressSectionHtml .= $deliverySectionHtml;
        $countDelivery++;                       
      }
      $this->outputdata['addressSectionHtml'] = $addressSectionHtml;
    }
    }
 		
    $this->outputdata['countDelivery'] = $countDelivery;  
 		$this->load->viewD('admin/add_user_view',$this->outputdata);
 	}


 	public function userlist(){
    $this->menu     =   11;
    $this->subMenu  =   112;
 		/*echo "string";
    exit();*/
    $this->common_lib->checkRolePermission(['can_manage_all_user','can_view_user']);
 		$this->load->viewD('admin/user_list_view',$this->outputdata);
 	}


 	public function detail($userId = 0){
    $this->menu     =   11;
    $this->subMenu  =   112;
    $this->common_lib->checkRolePermission(['can_manage_all_user','can_view_user']);
 		$this->outputdata['userData'] = $this->Common_model->exequery("SELECT us.*,  (case when img != '' then concat('".UPLOADPATH."/user_images/', img) else '' end) as image, (CASE WHEN us.status = 0 THEN 'Active' ELSE 'DeActive' END) status, (CASE WHEN us.status = 0 THEN 'badge badge-success' ELSE 'badge badge-danger' END) class from ".tablePrefix."user as us where us.status != 2  AND userId='".$userId."'",1);

    $getuserAddressDetails = $this->outputdata['userAddress'] = $this->Common_model->exequery("SELECT usa.* from ".tablePrefix."user_address as usa where usa.status !=2 AND userId='".$userId."' order by isDefault DESC");
    if( $getuserAddressDetails ) {
      $deliverySectionHtml = '';
          foreach($getuserAddressDetails as $key => $deliveryData ) {
            $deliverySectionHtml .='<div class="AddressSection address_row1 row">
                                <div class="form-group col-lg-6">
                                  <label class="col-md-5" for="addressType"><b>Address Type</b></label>
                                  <label class="col-md-2">:</label>
                                <label class="col-md-5"> '.$deliveryData->addressName.' </label>
                                </div>
                                <div class="form-group col-md-6">
                                  <label class="col-md-5" for="address"><b>Address</b></label>
                                  <label class="col-md-2">:</label>
                                  <label class="col-md-5">'.$deliveryData->address.'</label>
                                </div>
                                <div class="form-group col-md-6">
                                  <label class="col-md-5" for="address"><b>Address2</b></label>
                                  <label class="col-md-2">:</label>
                                  <label class="col-md-5">'.$deliveryData->address.'</label>
                                </div>
                                <div class="form-group col-md-6">
                                  <label class="col-md-5" for="city"><b>City</b></label>
                                  <label class="col-md-2">:</label>
                                  <label class="col-md-5">'.$deliveryData->city.'</label>
                                </div>
                                <div class="form-group col-md-6">
                                  <label class="col-md-5" for="state">State</label>
                                  <label class="col-md-2">:</label>
                                  <label class="col-md-5">'.$deliveryData->state.'" </label>
                                </div>
                                <div class="form-group col-md-6">
                                  <label class="col-md-5" for="country"><b>Country</b></label>
                                  <label class="col-md-2">:</label>
                                  <label class="col-md-5">'.$deliveryData->country.'</label>
                                </div>
                                <div class="form-group col-md-6">
                                  <label class="col-md-5" for="pincode"><b>Pincode</b></label>
                                  <label class="col-md-2">:</label>
                                  <label class="col-md-5">'.$deliveryData->pincode.'</label>
                                </div>
                                
                                </div>                            
                              ';
        $addressSectionHtml='';                      
        $addressSectionHtml .= $deliverySectionHtml;                      
      }
      $this->outputdata['addressSectionHtml'] = $addressSectionHtml;
    }

 		$this->load->viewD('admin/user_detail_view',$this->outputdata);
 	}

  public function share_moment(){

    $this->menu     =   11;
    $this->subMenu  =   114;

    $this->common_lib->checkRolePermission(['can_manage_all_user','can_edit_user']);

    $this->outputdata['userData'] = $this->Common_model->exequery("SELECT userId, firstName FROM ".tablePrefix."user WHERE status = 0");

    $this->load->viewD('admin/user_share_moment',$this->outputdata);
  }
}