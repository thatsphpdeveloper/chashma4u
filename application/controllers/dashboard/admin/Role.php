<?php
 /**
  * Role Controllers
  */
 class Role extends CI_Controller
 {
 	
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
    $this->menu     =   6;
    $this->subMenu  =   61;
    $this->common_lib->checkRolePermission(['can_manage_all_role','can_view_role']); 
 		$this->outputdata['vendorData'] = $this->Common_model->exequery("SELECT vendorId, vendorName from ".tablePrefix."vendor where status = 0 ");
 		$this->load->viewD('admin/add_role_view',$this->outputdata);
 	}
 	public function permission($roleId = 0)
 	{
    $this->menu     =   6;
    $this->subMenu  =   61;
    $this->common_lib->checkRolePermission(['can_manage_all_role','can_edit_role']); 		
 		$this->outputdata['roleData'] = $this->Common_model->exequery("SELECT rl.*, vd.vendorName, (case when rl.addedBy = 'vendor' then vd.vendorName else 'Admin' end) as vendorName from ".tablePrefix."role as rl left join ch_vendor as vd on (vd.vendorId = rl.addedById AND rl.addedBy = 'vendor') where rl.status = 0 AND roleId='".$roleId."'",1);
 		if (empty($this->outputdata['roleData'])){
          	$this->common_lib->setSessMsg('Invalid request.', 2);
          	redirect(DASHURL.'/admin/role');
      	}
 		$this->load->viewD('admin/role_permission_view',$this->outputdata);
 	}

 }
?>