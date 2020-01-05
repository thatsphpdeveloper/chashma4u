<?php
 /**
  * Blog Controllers
  */
 class Tag extends CI_Controller {
 	
  public $menu    = 9;
  public $subMenu   = 91;
 	public $outputdata 	= array();
 	function __construct(){
		parent::__construct();
		$this->session->set_userdata(PREFIX.'sessDashboard', "admin");
		$this->common_lib->setSessionVariables();
	}
    
    public function index(){
      
      $this->menu   = 9;
    $this->subMenu  = 91;

    $this->common_lib->checkRolePermission(['can_manage_all_tags','can_view_tag']);

    	$this->load->viewD('admin/addtag_view',$this->outputdata);
    }

    public function tagjson(){
      $tagList = $this->Common_model->exequery("SELECT tagId as value, tag as `text` FROM ".tablePrefix."tags WHERE status ='0' order by tag asc");
      echo ($tagList) ? json_encode($tagList) : json_encode(array());
    }


  }