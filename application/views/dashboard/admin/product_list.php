<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
    <style type="text/css">
      .img-xs, .table td img, .table th img {
          width: 60px;
          height: 60px;
          border: 1px solid grey;
          padding: 2px;
      }
      </style>
    <?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">
             
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Product List <a href="<?=DASHURL.'/'.$this->sessDashboard?>/product/add" class="btn btn-success pull-right">Add New Product</a></h4>                    
                    <div class="table-responsive">
                      <table class="table table-striped" id="tableDataList">
                        <thead>
                          <tr>
                            <th>SKU</th>
                            <th>Icon</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
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

