<?php
 /**
  * Employee Controllers
  */
 class Employee extends CI_Controller {
 	
  public $menu    = 6;
  public $subMenu   = 61;
 	public $outputdata 	= array();
 	function __construct(){
		parent::__construct();
		$this->session->set_userdata(PREFIX.'sessDashboard', "admin");
		$this->common_lib->setSessionVariables();
	}

 	public function index()
 	{
 		
 		redirect(DASHURL.'/admin/employee/employeelist');
 	}

 	public function add($employeeId = 0){

    $this->menu     =   6;
    $this->subMenu  =   62;
    $this->common_lib->checkRolePermission(['can_manage_all_employee',($employeeId)?'can_edit_employee':'can_create_employee']);
    $this->outputdata['vendorData'] = $this->Common_model->exequery("SELECT vendorId, vendorName from ".tablePrefix."vendor where status = 0 ");
 		$this->outputdata['employeeData'] = ($employeeId > 0)?$this->Common_model->exequery("SELECT em.*, (case when em.img != '' then concat('".UPLOADPATH."/employee_images/', em.img) else '' end) as img from ".tablePrefix."employee as em left join ch_vendor as vd on vd.vendorId = em.vendorId where em.status != 2 AND em.employeeId ='".$employeeId."'",1):array();
    if (isset($this->outputdata['employeeData']->vendorId))
      $this->outputdata['roleData'] = $this->Common_model->exequery("SELECT * from ".tablePrefix."role where status = 0  and addedById = '".$this->outputdata['employeeData']->vendorId."'");
    
 		$this->load->viewD('admin/add_employee_view',$this->outputdata);
 	}


 	public function employeelist(){
 		
    $this->menu     =   6;
    $this->subMenu  =   63;
    $this->common_lib->checkRolePermission(['can_manage_all_employee','can_view_employee']);
 		$this->load->viewD('admin/employee_list_view',$this->outputdata);
 	}


 	public function detail($employeeId = 0){
    $this->menu     =   6;
    $this->subMenu  =   63;
    $this->common_lib->checkRolePermission(['can_manage_all_employee','can_view_employee']);
 		$this->outputdata['employeeData'] = $this->Common_model->exequery("SELECT em.*, vd.vendorName, (case when em.img != '' then concat('".UPLOADPATH."/employee_images/', em.img) else '".NOIMAGE."' end) as img, (CASE WHEN em.status = 0 THEN 'Active' ELSE 'DeActive' END) status, (CASE WHEN em.status = 0 THEN 'badge badge-success' ELSE 'badge badge-danger' END) class from ".tablePrefix."employee as em left join ch_vendor as vd on vd.vendorId = em.vendorId where em.status != 2 AND em.employeeId ='".$employeeId."'",1);
      	if (!isset($this->outputdata['employeeData']->employeeId) || empty($this->outputdata['employeeData']->employeeId)){
          	$this->common_lib->setSessMsg('Invalid request.', 2);
          	redirect(DASHURL.'/admin/employee/employeelist');
      	}

 		$this->load->viewD('admin/employee_detail_view',$this->outputdata);
 	}
}