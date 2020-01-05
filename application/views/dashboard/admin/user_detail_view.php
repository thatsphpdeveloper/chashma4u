<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
    <?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <style type="text/css">
        .address_row1 {
            align-items: flex-end;
            margin-bottom: 25px;
            border-bottom: 1px solid #222;
            padding-bottom: 18px;
        }

        .address_row1:last-child {
            border-bottom: 0;
        }
      </style>
      <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">
             
              <div class="col-3 grid-margin">
                <div class="card">
                  <div class="card-body text-center">
                    <img class="img-lg rounded-circle mb-4" src="<?=$userData->image;?>" alt="profile image">
                    
                  </div>
                </div>
              </div>
              <div class="col-9 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">User Detail <?='<span class="'.$userData->class.' ml-1">'.$userData->status.'</span>';?> 
                      <div class="btn-group pull-right" role="group" aria-label="Basic example">
                        <a href="<?=DASHURL.'/admin/User/add/'.$userData->userId?>"  class="btn btn-success">Edit</a>
                        <a href="<?=DASHURL.'/'.$this->sessDashboard?>/user/add" class="btn btn-success">Add New</a>
                        <a href="<?=DASHURL.'/'.$this->sessDashboard?>/user/userlist" class="btn btn-success">User List</a> 
                      </div>
                     </h4>
                      
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">First Name</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$userData->firstName;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Last Name</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$userData->lastName;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Email</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$userData->email;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Mobile</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$userData->mobile;?></label>
                    </div>
                    <?php if(isset($addressSectionHtml) && !empty($addressSectionHtml))
                                      echo '<h4 class="mb-4">Address List</h4>'.$addressSectionHtml;
                                else { ?>
                    <div class="AddressSection" data-counter="0">

                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div> 
        </div>

<?php $this->load->viewD('inc/footer.php'); ?>


