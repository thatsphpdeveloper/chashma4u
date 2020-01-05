<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
    <?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">
             
              <div class="col-3 grid-margin">
                <div class="card">
                  <div class="card-body text-center">
                    <img class="img-lg rounded-circle mb-4" src="<?=$employeeData->img;?>" alt="profile image">
                  </div>
                </div>
              </div>
              <div class="col-9 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Profile Detail <?='<span class="'.$employeeData->class.' ml-1">'.$employeeData->status.'</span>';?>
                      <div class="btn-group pull-right" role="group" aria-label="Basic example">
                        <a href="<?=DASHURL.'/admin/profile/edit/'?>"  class="btn btn-success">Edit</a>
                         
                      </div> </h4>
                      
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Name</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$employeeData->employeeName;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Email</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$employeeData->email;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Mobile</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$employeeData->mobile;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Employee Of</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$employeeData->vendorName;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Create Date</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$employeeData->addedOn;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Last Update Date</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$employeeData->updatedOn;?></label>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
        </div>

<?php $this->load->viewD('inc/footer.php'); ?>


