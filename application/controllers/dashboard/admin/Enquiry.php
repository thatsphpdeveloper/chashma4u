<?php
 /**
  * Enquiry Controllers
  */
 class Enquiry extends CI_Controller {
 	
  public $menu    = 10;
  public $subMenu   = 101;
 	public $outputdata 	= array();
 	function __construct(){
		parent::__construct();
		$this->session->set_userdata(PREFIX.'sessDashboard', "admin");
		$this->common_lib->setSessionVariables();
	}
    
    public function index(){
      redirect(DASHURL.'/admin/enquiry/contact_enquiry');
    }
    public function frenchise_enquiry(){
    
      $this->common_lib->checkRolePermission(['can_manage_all_enquiry','can_view_enquiry']);

      $this->load->viewD('admin/frenchise_enquiry_view',$this->outputdata);
    }

    public function frenchise_enquiry_detail($enquiryId = 0){
    
      $this->common_lib->checkRolePermission(['can_manage_all_enquiry','can_view_enquiry']);

      $this->outputdata['enquiryData'] = $this->Common_model->exequery("SELECT * FROM `ch_fanchise_enquiry` WHERE  enquiryId='".$enquiryId."'" ,1);

      $this->load->viewD('admin/frenchise_enquiry_detail_view',$this->outputdata);
    }

    public function corporate_enquiry(){
      $this->menu   = 10;
      $this->subMenu  = 102;
    
      $this->common_lib->checkRolePermission(['can_manage_all_enquiry','can_view_enquiry']);

      $this->load->viewD('admin/corporate_enquiry_view',$this->outputdata);
    }

    public function corporate_enquiry_detail($enquiryId = 0){
    
      $this->common_lib->checkRolePermission(['can_manage_all_enquiry','can_view_enquiry']);

      $this->outputdata['enquiryData'] = $this->Common_model->exequery("SELECT * FROM `ch_corporate_enquiry` WHERE  corporateId='".$enquiryId."'" ,1);

      $this->load->viewD('admin/corporate_enquiry_detail_view',$this->outputdata);
    }

    public function contact_enquiry(){
      $this->menu   = 10;
      $this->subMenu  = 103;
      $this->common_lib->checkRolePermission(['can_manage_all_enquiry','can_view_enquiry']);

      $this->load->viewD('admin/contact_enquiry_view',$this->outputdata);
    }

    public function contact_enquiry_detail($enquiryId = 0){
    
      $this->common_lib->checkRolePermission(['can_manage_all_enquiry','can_view_enquiry']);

      $this->outputdata['enquiryData'] = $this->Common_model->exequery("SELECT * FROM `ch_contact` WHERE  contactId='".$enquiryId."'" ,1);

      $this->load->viewD('admin/contact_enquiry_detail_view',$this->outputdata);
    }
 	
 }