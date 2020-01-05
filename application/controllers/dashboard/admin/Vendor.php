<?php
 /**
  * Vendor Controllers
  */
 class Vendor extends CI_Controller {
 	
  public $menu    = 5;
  public $subMenu   = 51;
 	public $outputdata 	= array();
 	function __construct(){
		parent::__construct();
		$this->session->set_userdata(PREFIX.'sessDashboard', "admin");
		$this->common_lib->setSessionVariables();
	}

 	public function index()
 	{
 		
 		redirect(DASHURL.'/admin/vendor/vendorlist');
 	}

 	public function add($vendorId = 0){
    $this->menu     =   5;
    $this->subMenu  =   51;
    $this->common_lib->checkRolePermission(['can_manage_all_vendor',($vendorId)?'can_edit_vendor':'can_create_vendor']);
 		$this->outputdata['vendorData'] = ($vendorId > 0)?$this->Common_model->exequery("SELECT *, (case when ch_vendor.imageId > 0 then (SELECT concat('".UPLOADPATH."/images/', imageName) FROM ".tablePrefix."images  WHERE imageId = ch_vendor.imageId ) else '' end) as img FROM ".tablePrefix."vendor WHERE status != 2 AND vendorId ='".$vendorId."'",1):array();

      if(isset($this->outputdata['vendorData']->deliverOnPincodes) && !empty($this->outputdata['vendorData']->deliverOnPincodes)) {
        $this->outputdata['deliverOnPincodes'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."pincode WHERE pincodeId IN(".$this->outputdata['vendorData']->deliverOnPincodes.")");
      }

      /********** Custom CSS Or header Element ************************/
      $this->outputdata['headScript'] = '<link rel="stylesheet" href="'.base_url().'system/static/dashboard/admin/css/bootstrap.css"><link rel="stylesheet" href="'.base_url().'system/static/dashboard/admin/css/bootstrap-tagsinput.css">';

      /**************** Custom JS Or Footer Element ***********************/
    $this->outputdata['footerScript'] = ' <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script><script type="text/javascript" src="'.DASHSTATIC.'/admin/js/bootstrap-tagsinput.min.js"></script><script type="text/javascript">$(document).ready(function(){ 
        localStorage.clear();
        var pincodes = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace("text"),
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          prefetch: "'.DASHURL.'/admin/zone/pincodejson"
        });
        pincodes.initialize();
       
        $("#deliverOnPincodes").tagsinput({itemValue: "value",
          itemText: "text",
          typeaheadjs: {
            name: "pincodes",
            displayKey: "text",
            source: pincodes.ttAdapter()
        }});
        });</script>';

 		$this->load->viewD('admin/add_vendor_view',$this->outputdata);
 	}


 	public function vendorlist(){
    $this->menu     =   5;
    $this->subMenu  =   52;
 		
    $this->common_lib->checkRolePermission(['can_manage_all_vendor','can_view_vendor']);
 		$this->load->viewD('admin/vendor_list_view',$this->outputdata);
 	}


 	public function detail($vendorId = 0){
    $this->menu     =   5;
    $this->subMenu  =   52;
    $this->common_lib->checkRolePermission(['can_manage_all_vendor','can_view_vendor']);
 		$this->outputdata['vendorData'] = $this->Common_model->exequery("SELECT vd.*,  (case when imageId != 0 then (SELECT concat('".UPLOADPATH."/images/', imageName) FROM ".tablePrefix."images  WHERE imageId = vd.imageId ) else '' end) as icons, (CASE WHEN vd.status = 0 THEN 'Active' ELSE 'DeActive' END) status, (CASE WHEN vd.status = 0 THEN 'badge badge-success' ELSE 'badge badge-danger' END) class from ".tablePrefix."vendor as vd where vd.status != 2  AND vendorId='".$vendorId."'",1);
 		// v3print($this->outputdata['vendorData']); exit;
      	if (!isset($this->outputdata['vendorData']->vendorId) || empty($this->outputdata['vendorData']->vendorId)){
          	$this->common_lib->setSessMsg('Invalid request.', 2);
          	redirect(DASHURL.'/admin/vendor/vendorlist');
      	}

 		$this->load->viewD('admin/vendor_detail_view',$this->outputdata);
 	}
}