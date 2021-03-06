<?php $this->load->viewD('inc/header.php'); ?>
    <?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class ="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="card-title text-warning mb-5">Frenchise Enquiry Details
                    <div class="template-demo pull-right">
                      <a href="<?=DASHURL.'/'.$this->sessDashboard?>/enquiry/frenchise_enquiry" class="btn btn-info">Frenchise Enquiry List</a>
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
                        <div class="col-sm-4 font-weight-bold">Address : </div>
                        <div class="col-sm-8">
                          <?=$enquiryData->address;?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Remark : </div>
                        <div class="col-sm-8">
                          <?=$enquiryData->remark;?>
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

                </div>
              </div>
            </div>
          </div>
        </div>

<?php $this->load->viewD('inc/footer.php'); ?>


