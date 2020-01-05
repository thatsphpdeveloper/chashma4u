<?php
 /**
  * Setting Controllers
  */
 class Page extends CI_Controller
 {
 	
  public $menu    = 8;
  public $subMenu   = 81;
 	public $outputData 	= array();
 	function __construct(){
		parent::__construct();
		$this->session->set_userdata(PREFIX.'sessDashboard', "admin");
		$this->common_lib->setSessionVariables();
	}

 	public function index()
 	{	
    $this->front_page();
 	}
 	public function section()
 	{
    $this->menu     =   8;
    $this->subMenu  =   81;
    $this->common_lib->checkRolePermission(['can_manage_all_page_setting','can_edit_page_setting']);

 		$this->outputData['frontPageSettingData'] = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'front_page'",1);

 		$this->load->viewD('admin/setting_front_page',$this->outputData);
 	}
  public function front_slider()
  { 

    $this->menu     =   8;
    $this->subMenu  =   82;

    $this->common_lib->checkRolePermission(['can_manage_all_setting','can_edit_setting']);

    $this->load->viewD('admin/setting_front_page_slider',$this->outputData);
  }

 }
?>