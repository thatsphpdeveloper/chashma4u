<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
    
    <?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Blog List <a href="<?=DASHURL.'/'.$this->sessDashboard?>/blog/add" class="btn btn-success pull-right">Add New Blog</a></h4>
                  <div class="table-responsive">
                    <table class="table table-bordered" id="tableDataList">
                        <thead>
                          <tr>
                            <th>Blog Image</th>
                            <th style="text-overflow: ellipsis;">Blog Title</th>
                            <th>Blog Added</th>
                            <th>Status</th>
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