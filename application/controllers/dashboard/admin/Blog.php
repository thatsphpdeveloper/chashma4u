<?php
 /**
  * Blog Controllers
  */
 class Blog extends CI_Controller {
 	
  public $menu    = 8;
  public $subMenu   = 81;
 	public $outputdata 	= array();
 	function __construct(){
		parent::__construct();
		$this->session->set_userdata(PREFIX.'sessDashboard', "admin");
		$this->common_lib->setSessionVariables();
	}
    
    public function index(){
    	redirect(DASHURL.'/admin/blog/bloglist');
    }
 	public function add($blogId = 0)
 	{
 		$this->common_lib->checkRolePermission(['can_manage_all_blog',($blogId)?'can_edit_blog':'can_create_blog']);

 		$this->outputdata['blogData'] = ($blogId > 0)?$this->Common_model->exequery("SELECT bl.*, (case when bl.small_image != '' then concat('".UPLOADPATH."/blog_images/', bl.small_image) else '' end) as big_img, (case when bl.image != '' then concat('".UPLOADPATH."/blog_images/', bl.small_image) else '' end) as small_img from ".tablePrefix."blog as bl where bl.status != 2 AND bl.blogId ='".$blogId."'",1):array();

    if(isset($this->outputdata['blogData']->tags) && !empty($this->outputdata['blogData']->tags)) {
        $this->outputdata['tags'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."tags WHERE tagId IN(".$this->outputdata['blogData']->tags.")");
      }

      /********** Custom CSS Or header Element ************************/
      $this->outputdata['headScript'] = '<link rel="stylesheet" href="'.base_url().'system/static/dashboard/admin/css/bootstrap.css"><link rel="stylesheet" href="'.base_url().'system/static/dashboard/admin/css/bootstrap-tagsinput.css">';

      /**************** Custom JS Or Footer Element ***********************/
    $this->outputdata['footerScript'] = ' <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script><script type="text/javascript" src="'.DASHSTATIC.'/admin/js/bootstrap-tagsinput.min.js"></script><script type="text/javascript">$(document).ready(function(){ 
        localStorage.clear();
        var tags = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace("text"),
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          prefetch: "'.DASHURL.'/admin/tag/tagjson"
        });
        tags.initialize();
       
        $("#tags").tagsinput({itemValue: "value",
          itemText: "text",
          typeaheadjs: {
            name: "tag",
            displayKey: "text",
            source: tags.ttAdapter()
        }});
        });</script>';
        
 		$this->load->viewD('admin/addblog_view',$this->outputdata);
 	}
 	public function bloglist()
 	{

 		$this->menu     =   8;
    	$this->subMenu  =   82;
    	$this->common_lib->checkRolePermission(['can_manage_all_blog','can_view_blog']);
    	$this->load->viewD('admin/blog_list_view',$this->outputdata);
 		
 	}
  public function comments(){
    	
    $this->menu     =   8;
    $this->subMenu  =   83;
    $this->common_lib->checkRolePermission(['can_manage_all_blog','can_view_blog']);
    $this->load->viewD('admin/blog_unapproved_comments_view',$this->outputdata);
  }
}