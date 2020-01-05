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
                  <h4 class="card-title">Comments List <a href="<?=DASHURL.'/'.$this->sessDashboard?>/blog/bloglist" class="btn btn-success pull-right">Blog List</a></h4>
                  <div class="table-responsive">
                    <table class="table table-bordered" id="tableDataList">
                        <thead>
                          <tr>
                            <th style="text-overflow: ellipsis;">User</th>
                            <th style="text-overflow: ellipsis;">Blog Title</th>
                            <th style="text-overflow: ellipsis;">Comment</th>
                            <th>Coment Time</th>
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

          <!-- assign Vendor Model-->
          <div id="commentViewModel" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
              </div>

            </div>
          </div>
        <!-- partial:partials/_footer.html -->
<?php $this->load->viewD('inc/footer.php'); ?>

<script type="text/javascript">
  function viewComment(obj, e, commentId) {
    viewHtml = '<h3>'+$(obj).closest('tr').find('td:eq(1)').find('.ellipsis').html()+'</h3><p>'+$(obj).closest('tr').find('td:eq(2)').find('.ellipsis').html()+'</p>';

    $('#commentViewModel').modal('show');
    $('#commentViewModel').find(".modal-body").html(viewHtml);
  
  }
</script>