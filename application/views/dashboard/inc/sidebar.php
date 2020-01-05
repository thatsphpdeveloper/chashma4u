     <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav" style="margin-bottom: 50px;">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="<?php echo base_url(); ?>system/static/dashboard/admin/images/faces/face1.jpg" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name"><?php echo ucwords($this->session->userdata(PREFIX."sessUserName"));?></p>
                  <div>
                    <small class="designation text-muted"><?php echo ucwords(($this->session->userdata(PREFIX."sessEmployeeRole"))?$this->session->userdata(PREFIX."sessEmployeeRole"):$this->session->userdata(PREFIX."sessRole"));?></small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>              
            </div>
          </li>
          <li class="nav-item <?=($this->menu == 1) ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo base_url(); ?>dashboard/admin/welcome">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
        <?php if($this->sessRole == 'admin' || (in_array('can_manage_all_product_category', $this->sessPermissions) || in_array('can_view_product_category', $this->sessPermissions) || in_array('can_manage_all_product', $this->sessPermissions) || in_array('can_view_product', $this->sessPermissions) || in_array('can_manage_all_today_deal', $this->sessPermissions) || in_array('can_view_today_deal', $this->sessPermissions))){?>
          <li class="nav-item <?=($this->menu == 3) ? 'active' : ''; ?>">
            <a class="nav-link" data-toggle="collapse" href="#ui-product" aria-expanded="<?=($this->menu == 3) ? 'true' : 'false'; ?>" aria-controls="ui-product">
              <i class="menu-icon mdi mdi-cake"></i>
              <span class="menu-title">Manage Product</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?=($this->menu == 3) ? 'show' : ''; ?>" id="ui-product">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item hide <?=($this->sessRole == 'admin' || (in_array('can_manage_all_product_brand', $this->sessPermissions) || in_array('can_view_product_brand', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 3.02) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/product/lenscategory">Lens Category</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_product_brand', $this->sessPermissions) || in_array('can_view_product_brand', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 3.03) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/product/lens">Lens</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_product_brand', $this->sessPermissions) || in_array('can_view_product_brand', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 3.04) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/product/addlens">Add Lens</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_product_brand', $this->sessPermissions) || in_array('can_view_product_brand', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 3.01) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/product/brand">Brands</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_product_shape', $this->sessPermissions) || in_array('can_view_product_shape', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 3.11) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/product/shape">Shapes</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_product_attribute', $this->sessPermissions) || in_array('can_view_product_attribute', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 3.1) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/product/attribute">Attribute</a>
                </li>
                 <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_product_attribute', $this->sessPermissions) || in_array('can_view_product_attribute', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 3.2) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/product/attributeoption">Attribute Options</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_product_category', $this->sessPermissions) || in_array('can_view_product_category', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 31) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/product/category">Category</a>
                </li>
                 <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_product_category', $this->sessPermissions) || in_array('can_view_product_category', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 32) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/product/subcategory">SubCategory</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_product', $this->sessPermissions) || in_array('can_view_product', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 34) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/product/productlist">Product List</a>
                </li>
              </ul>
            </div>
          </li>

        <?php } ?>

        <?php if($this->sessRole == 'admin' || (in_array('can_manage_all_order', $this->sessPermissions) || in_array('can_view_order', $this->sessPermissions))){?>

          <li class="nav-item <?=($this->menu == 4) ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo base_url(); ?>dashboard/admin/order">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Manage Order</span>
            </a>
          </li>

        <?php } ?>

        <?php //if($this->sessRole == 'admin' || (in_array('can_manage_all_vendor', $this->sessPermissions) || in_array('can_view_vendor', $this->sessPermissions))){?>
         <!--  <li class="nav-item <?=($this->menu == 5) ? 'active' : ''; ?>">
            <a class="nav-link" data-toggle="collapse" href="#ui-vendor" aria-expanded="<?=($this->menu == 5) ? 'true' : 'false'; ?>" aria-controls="ui-vendor">
              <i class="menu-icon mdi mdi-home-variant"></i>
              <span class="menu-title">Manage Vendor</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?=($this->menu == 5) ? 'show' : ''; ?>" id="ui-vendor">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_vendor', $this->sessPermissions) || in_array('can_create_vendor', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 51) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/vendor/add">Add Vendor</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_vendor', $this->sessPermissions) || in_array('can_view_vendor', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 52) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/vendor/vendorlist">Vendor List</a>
                </li>
              </ul>
            </div>
          </li> -->

        <?php //} ?>

        <?php //if($this->sessRole == 'admin' || (in_array('can_manage_all_employee', $this->sessPermissions) || in_array('can_view_employee', $this->sessPermissions) || in_array('can_manage_all_role', $this->sessPermissions) || in_array('can_view_role', $this->sessPermissions))){?>
          <!-- <li class="nav-item <?=($this->menu == 6) ? 'active' : ''; ?>">
            <a class="nav-link" data-toggle="collapse" href="#ui-employee" aria-expanded="<?=($this->menu == 6) ? 'true' : 'false'; ?>" aria-controls="ui-employee">
              <i class="menu-icon mdi mdi-account-network"></i>
              <span class="menu-title">Manage Employee</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?=($this->menu == 6) ? 'show' : ''; ?>" id="ui-employee">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_role', $this->sessPermissions) || in_array('can_view_role', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 61) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/role">Role List</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_employee', $this->sessPermissions) || in_array('can_create_employee', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 62) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/employee/add">Add Employee</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_employee', $this->sessPermissions) || in_array('can_view_employee', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 63) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/employee/employeelist">Employee List</a>
                </li>
              </ul>
            </div>
          </li> -->
        
        <?php //} ?>

        <?php if($this->sessRole == 'admin' || (in_array('can_manage_all_setting', $this->sessPermissions) || in_array('can_view_setting', $this->sessPermissions) )){?>
          <li class="nav-item <?=($this->menu == 7) ? 'active' : ''; ?>">
            <a class="nav-link" data-toggle="collapse" href="#ui-setting" aria-expanded="<?=($this->menu == 7) ? 'true' : 'false'; ?>" aria-controls="ui-setting">
              <i class="menu-icon mdi mdi-settings"></i>
              <span class="menu-title">Manage Frontend</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?=($this->menu == 7) ? 'show' : ''; ?>" id="ui-setting">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_setting', $this->sessPermissions) || in_array('can_view_setting', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 71) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/setting/front_slider">Front Page Slider</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_setting', $this->sessPermissions) || in_array('can_view_setting', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 75) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/setting/front_page_setting">Front Page Setting</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_setting', $this->sessPermissions) || in_array('can_view_setting', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 76) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/setting/front_page_menu">Menu Setting</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_setting', $this->sessPermissions) || in_array('can_view_setting', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 711) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/setting/terms_condition_page">Terms Page Setting</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_setting', $this->sessPermissions) || in_array('can_view_setting', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 712) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/setting/privacy_policy_page">Policy Page Setting</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_setting', $this->sessPermissions) || in_array('can_view_setting', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 713) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/setting/about_page">About Page Setting</a>
                </li>
                <!-- <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_setting', $this->sessPermissions) || in_array('can_view_setting', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 78) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/setting/social_icons">Social Icons</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_setting', $this->sessPermissions) || in_array('can_view_setting', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 79) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/setting/front_footer">Front Footer</a>
                </li> -->
               <!--  <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_setting', $this->sessPermissions) || in_array('can_view_setting', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 714) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/setting/front_photo_gallery">Front Photo Gallery</a>
                </li> -->
                <!-- <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_setting', $this->sessPermissions) || in_array('can_view_setting', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 715) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/setting/order">Order Setting</a>
                </li> -->
              </ul>
            </div>
          </li>
        
        <?php } ?>
        <?php //if($this->sessRole == 'admin' || (in_array('can_manage_all_blogs', $this->sessPermissions) || in_array('can_view_blog', $this->sessPermissions) )){?>
          <!-- <li class="nav-item <?=($this->menu == 8) ? 'active' : ''; ?>">
            <a class="nav-link" data-toggle="collapse" href="#ui-blog" aria-expanded="<?=($this->menu == 8) ? 'true' : 'false'; ?>" aria-controls="ui-blog">
              <i class="menu-icon mdi mdi-fire"></i>
              <span class="menu-title">Manage Blog</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?=($this->menu == 8) ? 'show' : ''; ?>" id="ui-blog">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_blogs', $this->sessPermissions) || in_array('can_view_blog', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 81) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/blog/add">Add Blog </a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_blogs_view', $this->sessPermissions) || in_array('can_blog_list', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 82) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/blog/bloglist">Blogs List</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_blogs_view', $this->sessPermissions) || in_array('can_blog_list', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 83) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/blog/comments">Comments List</a>
                </li>
              </ul>
            </div>
          </li> -->
          
        <?php //} ?>
        <?php //if($this->sessRole == 'admin' || (in_array('can_manage_all_tags', $this->sessPermissions) || in_array('can_view_tags', $this->sessPermissions) )){?>
          <!-- <li class="nav-item <?=($this->menu == 9) ? 'active' : ''; ?>">
            <a class="nav-link" data-toggle="collapse" href="#ui-tag" aria-expanded="<?=($this->menu == 9) ? 'true' : 'false'; ?>" aria-controls="ui-tag">
              <i class="menu-icon mdi mdi-flag-checkered"></i>
              <span class="menu-title">Manage Tags</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?=($this->menu == 9) ? 'show' : ''; ?>" id="ui-tag">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_tags', $this->sessPermissions) || in_array('can_view_tags', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 91) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/tag">Tag List</a>
                </li>
              </ul>
            </div>
          </li>
           -->
        <?php //} ?>
       
        <?php if($this->sessRole == 'admin' || (in_array('can_manage_all_enquiry', $this->sessPermissions) || in_array('can_view_enquiry', $this->sessPermissions) )){?>
          <li class="nav-item <?=($this->menu == 10) ? 'active' : ''; ?>">
            <a class="nav-link" data-toggle="collapse" href="#ui-enquiry" aria-expanded="<?=($this->menu == 10) ? 'true' : 'false'; ?>" aria-controls="ui-enquiry">
              <i class="menu-icon mdi mdi-chart-pie"></i>
              <span class="menu-title">Manage Enquiries</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?=($this->menu == 10) ? 'show' : ''; ?>" id="ui-enquiry">
              <ul class="nav flex-column sub-menu">
                <!-- <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_enquiry', $this->sessPermissions) || in_array('can_view_enquiry', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 101) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/enquiry/frenchise_enquiry">Frenchise Enquiry</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_enquiry', $this->sessPermissions) || in_array('can_view_enquiry', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 102) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/enquiry/corporate_enquiry">Corporate Enquiry</a>
                </li> -->
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_enquiry', $this->sessPermissions) || in_array('can_view_enquiry', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 103) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/enquiry/contact_enquiry">Contact Enquiry</a>
                </li>
              </ul>
            </div>
          </li>
          
        <?php } ?>
        <?php if($this->sessRole == 'admin' || (in_array('can_manage_all_review', $this->sessPermissions) || in_array('can_view_review', $this->sessPermissions) )){?>
          <li class="nav-item <?=($this->menu == 12) ? 'active' : ''; ?>">
            <a class="nav-link" data-toggle="collapse" href="#ui-review" aria-expanded="<?=($this->menu == 12) ? 'true' : 'false'; ?>" aria-controls="ui-review">
              <i class="menu-icon mdi mdi-comment-text-outline"></i>
              <span class="menu-title">Manage Review</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?=($this->menu == 12) ? 'show' : ''; ?>" id="ui-review">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_review', $this->sessPermissions) || in_array('can_view_review', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 121) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/review/add">Add Review</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_review_view', $this->sessPermissions) || in_array('can_review_list', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 122) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/review/reviewlist">Reviews List</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_review_view', $this->sessPermissions) || in_array('can_review_list', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 123) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/review/newreviewlist">New Reviews List</a>
                </li>
              </ul>
            </div>
          </li>
          
        <?php } ?>

        
        <?php if($this->sessRole == 'admin' || (in_array('can_manage_all_user', $this->sessPermissions) || in_array('can_view_user', $this->sessPermissions))){?>
          <li class="nav-item <?=($this->menu == 11) ? 'active' : ''; ?>">
            <a class="nav-link" data-toggle="collapse" href="#ui-user" aria-expanded="<?=($this->menu == 11) ? 'true' : 'false'; ?>" aria-controls="ui-user">
              <i class="menu-icon mdi mdi-account-multiple-plus"></i>
              <span class="menu-title">Manage User</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?=($this->menu == 11) ? 'show' : ''; ?>" id="ui-user">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_user', $this->sessPermissions) || in_array('can_create_user', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 111) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/user/add">Add User</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_user', $this->sessPermissions) || in_array('can_view_user', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 112) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/user/userlist">User List</a>
                </li>
                <!-- <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_user', $this->sessPermissions) || in_array('can_view_user', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 114) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/user/share_moment">Share Moment</a>
                </li> -->
              </ul>
            </div>
          </li>

        <?php } ?>

        
        <?php //if($this->sessRole == 'admin' || (in_array('can_manage_all_coupon', $this->sessPermissions) || in_array('can_view_coupon', $this->sessPermissions))){?>
         <!--  <li class="nav-item <?=($this->menu == 13) ? 'active' : ''; ?>">
            <a class="nav-link" data-toggle="collapse" href="#ui-coupon" aria-expanded="<?=($this->menu == 13) ? 'true' : 'false'; ?>" aria-controls="ui-coupon">
              <i class="menu-icon mdi mdi-minus-network"></i>
              <span class="menu-title">Manage Coupon</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?=($this->menu == 13) ? 'show' : ''; ?>" id="ui-coupon">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_coupon', $this->sessPermissions) || in_array('can_create_coupon', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 131) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/coupon/add">Add Coupon</a>
                </li>
                <li class="nav-item <?=($this->sessRole == 'admin' || (in_array('can_manage_all_coupon', $this->sessPermissions) || in_array('can_view_coupon', $this->sessPermissions)))?'':'hide'?>">
                  <a class="nav-link <?=($this->subMenu == 132) ? 'active' : ''; ?>" href="<?php echo DASHURL; ?>/admin/coupon/couponlist">Coupon List</a>
                </li>
              </ul>
            </div>
          </li> -->

        <?php //} ?>

          <li class="nav-item <?=($this->menu == 14) ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo base_url(); ?>dashboard/admin/notification">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Notification</span>
            </a>
          </li>

        </ul>
      </nav>