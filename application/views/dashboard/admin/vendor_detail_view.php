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
                    <img class="img-lg rounded-circle mb-4" src="<?=$vendorData->icons;?>" alt="profile image">
                    <?='<blockquote class="blockquote blockquote-primary"><address><p class="font-weight-bold">'.ucfirst($vendorData->address1).'</p> <p>'.$vendorData->address2.' '.$vendorData->city.'</p> <p>'.$vendorData->state.' '.$vendorData->pincode.'</p></address></blockquote>';?>
                  </div>
                </div>
              </div>
              <div class="col-9 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Vendor Detail <?='<span class="'.$vendorData->class.' ml-1">'.$vendorData->status.'</span>';?> 
                      <div class="btn-group pull-right" role="group" aria-label="Basic example">
                        <a href="<?=DASHURL.'/admin/vendor/add/'.$vendorData->vendorId?>"  class="btn btn-success">Edit</a>
                        <a href="<?=DASHURL.'/'.$this->sessDashboard?>/vendor/add" class="btn btn-success">Add New</a>
                        <a href="<?=DASHURL.'/'.$this->sessDashboard?>/vendor/vendorlist" class="btn btn-success">Vendor List</a> 
                      </div>
                     </h4>
                      
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Vendor Name</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$vendorData->vendorName;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Contact Person Name</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$vendorData->contactName;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Email</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$vendorData->email;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Mobile</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$vendorData->mobile;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Alternate Number</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$vendorData->alternateNumber;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Food License No</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$vendorData->foodLicenseNo;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Account Number</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$vendorData->accountNumber;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">IFSC Code</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$vendorData->ifscCode;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Account Holder Name</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$vendorData->accountHolderName;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Description</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$vendorData->description;?></label>
                    </div>

                    <?php
                      $days = array('sunday','monday','tuesday','wednesday','thursday','friday','saturday');
                      $closeArry  = (!empty($vendorData->closeDays))?explode(',',$vendorData->closeDays):array();
                      $timingData = '';             
                      foreach ($days as $day) {

                        if (in_array($day,$closeArry)){
                          $class = 'dark';
                          $time = 'Close';
                        }else{                          
                          $class = 'success';
                          $open = $day.'Open';
                          $close = $day.'Close';
                          $time = $vendorData->$open.' - '.$vendorData->$close;
                        }
                        $timingData .= '<tr> <td>'.ucfirst($day).'</td> <td> <label class="badge badge-'.$class.'">'.$time.'</label> </td> </tr>';
                      }
                    ?>

                    <div class=" row <?=($timingData)?'':'hide'?>">
                      <label class="col-sm-3 col-form-label">Vendor Timing</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label">
                        <style type="text/css">.table th, .table td {padding: 6px 13px;}.table td, .table th {font-size: 14px;}</style>
                        <div class="table-responsive">
                          <table class="table table-dark">
                            <thead>
                              <tr>
                                <th>Day</th>
                                <th>Timing</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?=$timingData;?>                        
                            </tbody>
                          </table>
                        </div>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Meta Title</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$vendorData->metaTitle;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Meta Description</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$vendorData->metaDescription;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Meta Keywords</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$vendorData->keywords;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Create Date</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$vendorData->addedOn;?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Last Update Date</label>
                      <label class="col-sm-1 col-form-label">:</label>
                      <label class="col-sm-8 col-form-label"><?=$vendorData->updatedOn;?></label>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
        </div>

<?php $this->load->viewD('inc/footer.php'); ?>


