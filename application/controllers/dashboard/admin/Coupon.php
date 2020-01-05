<?php
 /**
  * Coupon Controllers
  */
 class Coupon extends CI_Controller {
 	
  public $menu    = 13;
  public $subMenu   = 131;
 	public $outputData 	= array();
 	function __construct(){
		parent::__construct();
		$this->session->set_userdata(PREFIX.'sessDashboard', "admin");
		$this->common_lib->setSessionVariables();
	}

 	public function index()
 	{
 		
 		redirect(DASHURL.'/admin/coupon/couponlist');
 	}

 	public function add($couponId = 0){
    $this->menu     =   13;
    $this->subMenu  =   131;
    $this->common_lib->checkRolePermission(['can_manage_all_coupon',($couponId)?'can_edit_coupon':'can_create_coupon']);

    $this->outputData['couponData'] = ($couponId > 0)?$this->Common_model->exequery("SELECT * FROM ".tablePrefix."coupon WHERE status != 2 AND couponId ='".$couponId."'",1):array();

 		$this->load->viewD('admin/add_coupon_view',$this->outputData);
 	}


 	public function couponlist(){
    $this->menu     =   13;
    $this->subMenu  =   132;

    $this->common_lib->checkRolePermission(['can_manage_all_coupon','can_view_coupon']);

 		$this->load->viewD('admin/coupon_list_view',$this->outputData);
 	}


 	public function detail($couponId = 0){
    $this->menu     =   13;
    $this->subMenu  =   132;
    $this->common_lib->checkRolePermission(['can_manage_all_coupon','can_view_coupon']);

 		$this->outputData['couponData'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."coupon WHERE status != 2 AND couponId ='".$couponId."'",1);



 		$this->load->viewD('admin/coupon_detail_view',$this->outputData);
 	}

  
}