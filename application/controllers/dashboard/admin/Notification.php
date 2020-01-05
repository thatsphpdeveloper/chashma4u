<?php
 /**
  * Notification Controllers
  */
 class Notification extends CI_Controller {
 	
  public $menu    = 14;
  public $subMenu   = 141;
 	public $outputdata 	= array();
 	function __construct(){
		parent::__construct();
		$this->session->set_userdata(PREFIX.'sessDashboard', "admin");
		$this->common_lib->setSessionVariables();
	}
    
  public function index(){
  	redirect(DASHURL.'/admin/notification/notificationlist');
  }

 	public function notificationlist()
 	{

 		$this->menu     =   14;
    	$this->subMenu  =   142;
    	$this->common_lib->checkRolePermission(['can_manage_all_notification','can_view_notification']);
    	$this->load->viewD('admin/notification_list_view',$this->outputdata);
 		
 	}
    public function detail($notificationId = 0){

      $this->outputdata['notificationData'] = $this->Common_model->exequery("SELECT * from ".tablePrefix."notification where status != 3 AND role='admin' AND notificationId='".$notificationId."'",1);
      if (!isset($this->outputdata['notificationData']->notificationId) || empty($this->outputdata['notificationData']->notificationId)){
            $this->common_lib->setSessMsg('Invalid request.', 2);
            redirect(DASHURL.'/admin/notification/notificationlist');
      }
      $this->Common_model->update("ch_notification", ['status'=>2], "status != 3 AND role='admin' AND notificationId='".$notificationId."'");
    	$this->load->viewD('admin/notification_detail_view',$this->outputdata);
    }
 }