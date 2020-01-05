<?php $this->load->viewD('inc/header.php'); ?>
    <?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class ="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="card-title text-warning mb-5">Contact Enquiry Details
                    <div class="template-demo pull-right">
                      <a href="<?=DASHURL.'/'.$this->sessDashboard?>/enquiry/contact_enquiry" class="btn btn-info">Contact Enquiry List</a>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Name : </div>
                        <div class="col-sm-8">
                          <?=$enquiryData->name;?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Email : </div>
                        <div class="col-sm-8">
                          <?=$enquiryData->email;?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Mobile : </div>
                        <div class="col-sm-8">
                          <?=$enquiryData->mobile;?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Type : </div>
                        <div class="col-sm-8">
                          <?=$enquiryData->type;?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Order Id : </div>
                        <div class="col-sm-8">
                          <?=$enquiryData->orderId;?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Date : </div>
                        <div class="col-sm-8">
                          <?=$enquiryData->addedOn;?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Comment : </div>
                        <div class="col-sm-8">
                          <?=$enquiryData->comment;?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 <?=(isset($enquiryData->img) && !empty($enquiryData->img))?'':'hide';?>">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Image : </div>
                        <div class="col-sm-8">
                          <div class="previewimg"><?=(isset($enquiryData->img) && !empty($enquiryData->img))?'<img src="'.UPLOADPATH.'/contact_images/'.$enquiryData->img.'" width="70px" height="50px">':'';?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

<?php $this->load->viewD('inc/footer.php'); ?>


