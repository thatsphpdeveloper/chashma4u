<?php
 /**
  * Frenchise Controllers
  */
 class Frenchise extends CI_Controller {
 	
  public $menu    = 10;
  public $subMenu   = 101;
 	public $outputdata 	= array();
 	function __construct(){
		parent::__construct();
		$this->session->set_userdata(PREFIX.'sessDashboard', "admin");
		$this->common_lib->setSessionVariables();
	}
    
    public function index(){
    
      
    }
    public function enquiry(){
    
      $this->common_lib->checkRolePermission(['can_manage_all_frenchise','can_view_frenchise']);

      $this->load->viewD('admin/frenchise_enquiry_view',$this->outputdata);
    }
    public function enquirydetail($enquiryId = 0){
    
      $this->common_lib->checkRolePermission(['can_manage_all_frenchise','can_view_frenchise']);

      $this->outputdata['enquiryData'] = $this->Common_model->exequery("SELECT * FROM `ch_fanchise_enquiry` WHERE  enquiryId='".$enquiryId."'" ,1);

      $this->load->viewD('admin/frenchise_enquiry_detail_view',$this->outputdata);
    }
 	
 }