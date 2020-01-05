<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	public $menu		= 1;
	public $subMenu		= 11;
	public $outputData 	= array();
	
	public function __construct(){
		parent::__construct();
		//Check login authentication & set public veriables
		$this->session->set_userdata(PREFIX.'sessDashboard', "admin");
		$this->common_lib->setSessionVariables();
	}

	public function index() {
		if($this->sessEmployeeRoleId > 0)
			$this->outputData['employeeData'] = $this->Common_model->exequery("SELECT em.*, (CASE WHEN em.vendorId > 0 THEN vd.vendorName ELSE 'Admin' END) as vendorName, (case when em.img != '' then concat('".UPLOADPATH."/employee_images/', em.img) else '".NOIMAGE."' end) as img, (CASE WHEN em.status = 0 THEN 'Active' ELSE 'DeActive' END) status, (CASE WHEN em.status = 0 THEN 'badge badge-success' ELSE 'badge badge-danger' END) class from ".tablePrefix."employee as em left join ch_vendor as vd on vd.vendorId = em.vendorId where em.status != 2 AND em.employeeId ='".$this->sessRoleId."'",1);
      	if (!isset($this->outputData['employeeData']->employeeId) || empty($this->outputData['employeeData']->employeeId)){
          	$this->common_lib->setSessMsg('Invalid request.', 2);
          	redirect(DASHURL.'/admin/welcome');
      	}

		$this->load->viewD($this->sessDashboard.'/profile_view', $this->outputData);	
	}
	public function edit() {
 			$this->outputData['employeeData'] = ($this->sessEmployeeRoleId > 0)?$this->Common_model->exequery("SELECT em.*, (case when em.img != '' then concat('".UPLOADPATH."/employee_images/', em.img) else '' end) as img from ".tablePrefix."employee as em left join ch_vendor as vd on vd.vendorId = em.vendorId where em.status != 2 AND em.employeeId ='".$this->sessRoleId."'",1):array();
	    if (isset($this->outputData['employeeData']->vendorId))
	      $this->outputData['roleData'] = $this->Common_model->exequery("SELECT * from ".tablePrefix."role where status = 0  and addedById = '".$this->outputData['employeeData']->vendorId."'");
	  	else{
          	$this->common_lib->setSessMsg('Invalid request.', 2);
          	redirect(DASHURL.'/admin/welcome');
      	}

		$this->load->viewD($this->sessDashboard.'/profile_edit_view', $this->outputData);	
	}
	public function change_password() {
				
		$this->load->viewD($this->sessDashboard.'/change-password', $this->outputData);	
	}	
}