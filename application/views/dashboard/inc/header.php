<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Chashma4u</title>
  <!-- plugins:css -->
  <?php echo (isset($headScript) && !empty($headScript)) ? $headScript : '';?>
  <!-- include summernote -->
  <link rel="stylesheet" href="<?php echo DASHSTATIC; ?>/admin/dist/summernote-bs4.css">
   <link href="<?php echo DASHSTATIC; ?>/admin/dist/summernote-bs4.css">
  <link rel="stylesheet" href="<?php echo DASHSTATIC; ?>/admin/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="<?php echo DASHSTATIC; ?>/admin/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo DASHSTATIC; ?>/admin/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php echo DASHSTATIC; ?>/admin/vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="<?php echo DASHSTATIC; ?>/admin/vendors/iconfonts/font-awesome/css/font-awesome.css">

  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo DASHSTATIC; ?>/admin/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo DASHSTATIC; ?>/admin/images/favicon.png" />
  <?php $this->load->viewD('inc/constants');?>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="<?=DASHURL.'/admin/welcome'?>">
          <img src="<?php echo DASHSTATIC; ?>/admin/images/logo.png" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="<?=DASHURL.'/admin/welcome'?>">
          <img src="<?php echo DASHSTATIC; ?>/admin/images/logo.png" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex hide">
          <li class="nav-item">
            <a href="#" class="nav-link">Schedule
              <span class="badge badge-primary ml-1">New</span>
            </a>
          </li>
          <li class="nav-item active">
            <a href="#" class="nav-link">
              <i class="mdi mdi-elevation-rise"></i>Reports</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="mdi mdi-bookmark-plus-outline"></i>Score</a>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <style type="text/css">
            .dropdown-menu.dropdown-menu-right.navbar-dropdown.preview-list.show {
                max-height: 400px;
                overflow-y: scroll;
            }
          </style>
          <li class="nav-item dropdown notification-bell">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell"></i>
              <span class="count">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list hide" aria-labelledby="notificationDropdown">
              <!-- <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 4 new notifications
                </p>
                <span class="badge badge-pill badge-warning float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="mdi mdi-alert-circle-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Application Error</h6>
                  <p class="font-weight-light small-text">
                    Just now
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-comment-text-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Settings</h6>
                  <p class="font-weight-light small-text">
                    Private message
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="mdi mdi-email-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">New user registration</h6>
                  <p class="font-weight-light small-text">
                    2 days ago
                  </p>
                </div>
              </a> -->
            </div>
          </li>
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Hello, <?php echo ucwords($this->session->userdata(PREFIX."sessUserName"));?> !</span>
              <img class="img-xs rounded-circle" src="<?php echo DASHSTATIC; ?>/admin/images/faces/face1.jpg" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <!-- <a class="dropdown-item p-0">
                <div class="d-flex border-bottom">
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                  </div>
                </div>
              </a> -->
              <!-- <a class="dropdown-item mt-2">
                Manage Accounts
              </a> -->
              <?php if($this->sessRole != 'admin'){ ?>
              <a class="dropdown-item" href="<?php echo DASHURL;?>/admin/profile" style="cursor:pointer;">
                View Profile
              </a>
              <a class="dropdown-item" href="<?php echo DASHURL;?>/admin/profile/edit" style="cursor:pointer;">
                Edit Profile
              </a>
              <?php } ?>
              <a class="dropdown-item" href="<?php echo DASHURL;?>/admin/profile/change_password" style="cursor:pointer;">
                Change Password
              </a>
              <!-- <a class="dropdown-item">
                Check Inbox
              </a> -->
              <a class="dropdown-item" href="<?php echo DASHURL;?>/auth/logout" style="cursor:pointer;">
                Sign Out
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>