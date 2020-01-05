<?php
 /**
  * User Controllers
  */
 class Review extends CI_Controller {
 	
  public $menu    = 12;
  public $subMenu   = 121;
 	public $outputdata 	= array();
 	function __construct(){
		parent::__construct();
		$this->session->set_userdata(PREFIX.'sessDashboard', "admin");
		$this->common_lib->setSessionVariables();
	}

 	public function index()
 	{
 		
 		redirect(DASHURL.'/admin/review/reviewlist');
 	}
 	public function add($reviewId=0){

 		$this->outputdata['reviewData'] = ($reviewId > 0)?$this->Common_model->exequery("SELECT * FROM ".tablePrefix."review WHERE status != 2 AND reviewId ='".$reviewId."'",1):array();
 		$userId = (isset($this->outputdata['reviewData']->userId) && !empty($this->outputdata['reviewData']->userId))?($this->outputdata['reviewData']->userId):'';
 		$this->outputdata['userId'] = $userId;
 		$productId = (isset($this->outputdata['reviewData']->productId) && !empty($this->outputdata['reviewData']->productId))?($this->outputdata['reviewData']->productId):'';
 		$this->outputdata['productId'] = $productId;
 		
        $this->outputdata['userData'] = $this->Common_model->exequery("SELECT userId, firstName, lastName FROM ".tablePrefix."user where status != 2");
        
        $this->outputdata['productData'] = $this->Common_model->exequery("SELECT productId, productName FROM ".tablePrefix."product where status != 2 ");
        
        $this->load->viewD('admin/add_review_view',$this->outputdata);
 	}
 	public function reviewlist(){
 		$this->menu     =   12;
        $this->subMenu  =   122;
        $this->common_lib->checkRolePermission(['can_manage_all_review','can_view_review']);
        $this->load->viewD('admin/review_list_view',$this->outputdata);
 	}
  public function newreviewlist(){
    $this->menu     =   12;
        $this->subMenu  =   123;
        $this->common_lib->checkRolePermission(['can_manage_all_review','can_view_review']);
        $this->load->viewD('admin/review_new_list_view',$this->outputdata);
  }
 }
 ?>