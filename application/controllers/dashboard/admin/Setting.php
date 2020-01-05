<?php
 /**
  * Setting Controllers
  */
class Setting extends CI_Controller
 {
 	
  public $menu    = 7;
  public $subMenu   = 71;
 	public $outputData 	= array();
 	function __construct(){
		parent::__construct();
		$this->session->set_userdata(PREFIX.'sessDashboard', "admin");
		$this->common_lib->setSessionVariables();
	}

 	public function index()
 	{	
    $this->front_slider();
 	}
  public function front_slider()
  { 

    $this->menu     =   7;
    $this->subMenu  =   71;

    $this->common_lib->checkRolePermission(['can_manage_all_setting','can_edit_setting']);

    $this->load->viewD('admin/setting_front_page_slider',$this->outputData);
  }
  
  public function front_page_setting()
  { 

    $this->menu     =   7;
    $this->subMenu  =   75;

    $this->common_lib->checkRolePermission(['can_manage_all_setting','can_edit_setting']);

    $this->outputData['frontPageSettingData'] = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'front_page'",1);

    $this->outputData['frontPageSliderData'] = $this->Common_model->exequery("SELECT * FROM ch_front_page_slider WHERE status = 0 ORDER BY sliderId DESC");

    $this->outputData['subcategoryData'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."subcategory WHERE status = 0 order by subcategoryName asc");

    $this->outputData['productData'] = $this->Common_model->exequery("SELECT pd.productId, pd.productName, (CASE WHEN pd.productType = 1 THEN (SELECT vd.actualPrice FROM ch_product_variable as vd WHERE vd.productId = pd.productId ORDER BY actualPrice ASC limit 0, 1 ) ELSE pd.actualPrice END) as price FROM ch_product as pd where pd.status = 0 ORDER BY pd.productName asc");

    $this->load->viewD('admin/setting_front_page',$this->outputData);
  }

  public function front_page_menu()
  { 

    $this->menu     =   7;
    $this->subMenu  =   76;

    $this->common_lib->checkRolePermission(['can_manage_all_setting','can_edit_setting']);
    
    $menuList = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."menu WHERE status != 2 order by title asc");
    if( $menuList ) {
      foreach( $menuList as $menuVal ) {
        $subMenuList = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."submenu WHERE status != 2 AND menuId = '".$menuVal->menuId."' order by title asc");
        $menuVal->subMenuList = ($subMenuList) ? $subMenuList : array();
      }
    }
    $this->outputData['menuList'] = ( $menuList ) ? $menuList : array();

    $this->outputData['categoryList'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."category WHERE status != 2 order by categoryName asc");
    
    $this->load->viewD('admin/setting_front_menu',$this->outputData);
  }



  public function franchise_page()
  { 

    $this->menu     =   7;
    $this->subMenu  =   77;

    $this->common_lib->checkRolePermission(['can_manage_all_setting','can_edit_setting']);

    $this->outputData['franchisePageSettingData'] = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'franchise_page'",1);

    $this->load->viewD('admin/setting_franchise_page',$this->outputData);
  }

  public function social_icons()
  { 

    $this->menu     =   7;
    $this->subMenu  =   78;

    $this->common_lib->checkRolePermission(['can_manage_all_setting','can_edit_setting']);

    $this->load->viewD('admin/setting_social_icons',$this->outputData);
  }
  
  public function front_footer()
  { 

    $this->menu     =   7;
    $this->subMenu  =   79;

    $this->common_lib->checkRolePermission(['can_manage_all_setting','can_edit_setting']);

    $this->outputData['frontFooterSettingData'] = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'front_footer'",1);

    $this->outputData['frontSocialIconsData'] = $this->Common_model->exequery("SELECT * FROM ch_front_page_social_icons WHERE status = 0 ORDER BY socialId DESC");

    $this->load->viewD('admin/setting_front_footer',$this->outputData);
  }

  public function corporate_page()
  { 

    $this->menu     =   7;
    $this->subMenu  =   710;

    $this->common_lib->checkRolePermission(['can_manage_all_setting','can_edit_setting']);


    
    $this->outputData['frontPageBenefitData'] = $this->Common_model->exequery("SELECT * FROM ch_front_page_benefit WHERE status = 0 ORDER BY benefitId DESC");
    $this->outputData['subCategoryItemData'] = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."subcategoryitem WHERE status = 0 order by subcategoryItemName asc");

    $this->outputData['reviewData'] = $this->Common_model->exequery("SELECT re.*, us.firstName FROM ch_review as re left join ".tablePrefix."user as us on us.userId = re.userId where re.status = 0 AND CHAR_LENGTH(re.review) >= 110 ORDER BY us.firstName asc");
    $this->outputData['corporatePageSettingData'] = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'corporate_page'",1);  

    $this->load->viewD('admin/setting_corporate_page',$this->outputData);
  }

  public function terms_condition_page()
  { 

    $this->menu     =   7;
    $this->subMenu  =   711;

    $this->common_lib->checkRolePermission(['can_manage_all_setting','can_edit_setting']);
    
    $this->outputData['termsPageSettingData'] = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'terms_condition_page'",1); 

    $this->load->viewD('admin/setting_terms_condition_page',$this->outputData);
  }

  public function privacy_policy_page()
  { 

    $this->menu     =   7;
    $this->subMenu  =   712;

    $this->common_lib->checkRolePermission(['can_manage_all_setting','can_edit_setting']);

    $this->outputData['privacyPageSettingData'] = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'privacy_policy_page'",1);  

    $this->load->viewD('admin/setting_privacy_policy_page',$this->outputData);
  }

  public function about_page()
  { 

    $this->menu     =   7;
    $this->subMenu  =   713;

    $this->common_lib->checkRolePermission(['can_manage_all_setting','can_edit_setting']);

    $this->outputData['AboutPageSettingData'] = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'about_page'",1);  

    $this->load->viewD('admin/setting_about_page',$this->outputData);
  }

  public function order()
  { 

    $this->menu     =   7;
    $this->subMenu  =   715;

    $this->outputData['frontPageSettingData'] = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status !=2 AND name= 'order_setting'",1);

    $this->common_lib->checkRolePermission(['can_manage_all_setting','can_edit_setting']);

    $this->load->viewD('admin/setting_order',$this->outputData);
  }


}
?>