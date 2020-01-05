<?php $this->load->viewD('inc/header.php'); ?>  
    <?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class ="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">Visitors <a href="<?=DASHURL.'/'.$this->sessDashboard.'/order'?>" class="btn btn-info pull-right">Go To Order</a></div>

                  <div class="table-responsive">
                    <table class="table table-striped" id="tableDataList">
                      <thead>
                        <tr>
                          <th>Sender</th>
                          <th>Sender Mobile</th>
                          <th>Reciever</th>
                          <th>Reciever Mobile</th>
                          <th>Cart Items</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div> 
        </div>

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
<?php $this->load->viewD('inc/footer.php'); ?>



