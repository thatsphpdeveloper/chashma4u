<?php $this->load->viewD('inc/header.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
    <!-- partial -->
    <?php $this->load->viewD('inc/sidebar.php'); ?>
    <style type="text/css">
      .badge-secondary {
        bnotification: 1px solid #e5e5e5;
        color: #1b1919;
      }
      .badge-light {
        bnotification: 1px solid #f3f5f6;
        color: #757575;
      }
    </style>

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class ="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="card-title text-warning mb-5">Notification
                    <div class="template-demo pull-right">
                      <a href="<?=DASHURL.'/'.$this->sessDashboard?>/notification" class="btn btn-info">Notification List</a>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Notification By : </div>
                        <div class="col-sm-8">
                          <?php 
                              $notificationMsg = '';
                              if ($notificationData->type == 'order_cancelled') {
                                $notificationMsg = 'Order cancelled';
                              }else if ($notificationData->type == 'order_assigned') {
                                $notificationMsg = 'New order';
                              }else if ($notificationData->type == 'order_rejected') {
                                $notificationMsg = 'Order rejected';
                              }
                              echo $notificationMsg;
                              ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Time : </div>
                        <div class="col-sm-8">

                          <?=$notificationData->addedOn;?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Status : </div>
                        <div class="col-sm-8">
                          <?=($notificationData->status == 0)?'New':(($notificationData->status == 1)?'Notified':'Seen');?>
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



