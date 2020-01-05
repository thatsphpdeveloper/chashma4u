<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
<?php $this->load->viewD('inc/sidebar.php'); ?>

  <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">
              <div class="col-md-12 d-flex align-items-stretch grid-margin">
                <div class="row flex-grow">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Add Blog <a href="<?=DASHURL.'/'.$this->sessDashboard?>/blog/bloglist" class="btn btn-success pull-right">Blog List</a></h4>
                        <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateBlog(this, event);">
                          <p class="msg"></p>

                          <div class="form-group">
		                      <label for="blogName">Blog Title</label>
		                      <input type="text" class="form-control" id="blogName" rows="3" name="blogName" value="<?=isset($blogData->blogTitle)?$blogData->blogTitle:'';?>" placeholder="Enter blog title" required>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Description</label>
                                <div class="col-sm-12">
                                  <textarea class="form-control aboutus" id="extra_desc" rows="3" name="extra_desc" placeholder="Enter extra description" required><?=isset($blogData->description)?$blogData->description:'';?></textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
		                      <label for="metaTitle">Tags</label>
		                      <input type="text" class="form-control tagInputs" id="tags" value="<?=isset($blogData->tags)?$blogData->tags:''; ?>" name="tags"  placeholder="Blog tags">
	                      </div>
                          <div class="form-group">
		                      <label for="metaTitle">Meta Title</label>
		                      <input type="text" class="form-control" id="metaTitle" name="metaTitle" maxlength="65" value="<?=isset($blogData->metaTitle)?$blogData->metaTitle:'';?>" placeholder="Enter meta title">
	                      </div> 
                          <div class="clearfix"></div>
                          <div class="form-group">
		                      <label for="metaDescription">Meta Description</label>
		                      <textarea class="form-control" id="metaDescription" rows="3" name="metaDescription" maxlength="150" placeholder="Meta Description"><?=isset($blogData->metaDescription)?$blogData->metaDescription:'';?></textarea>
                          </div>
                          <div class="form-group">
		                      <label for="metaKeywords">Meta Keywords</label>
		                      <textarea class="form-control" id="metaKeywords" rows="3" name="metaKeywords" placeholder="Meta Keywords"><?=isset($blogData->keywords)?$blogData->keywords:'';?></textarea>
                          </div>
                          <div class="form-group">
		                      <label for="uploadIcons">Blog Image<span class="text-muted">( Image should be 100*100 )</span></label>
		                      <input type="file" name="uploadImage" id="uploadImage" value="" onchange="fileuploadpreview(this)" <?=(isset($blogData->big_img) && !empty($blogData->big_img))?'':'required';?>>
                                  <div class="previewimg"><?=(isset($blogData->big_img) && !empty($blogData->big_img))?'<img src="'.$blogData->big_img.'" width="70px" height="50px">':'';?></div>
                          </div>
                          <div class="form-group">
		                      <label for="uploadIcons">Small Blog Image<span class="text-muted">( Image should be 100*100 )</span></label>
		                      <input type="file" name="blogImage" id="blogImage" value="" onchange="fileuploadpreview(this)" <?=(isset($blogData->small_img) && !empty($blogData->small_img))?'':'required';?>>
                                  <div class="previewimg"><?=(isset($blogData->small_img) && !empty($blogData->small_img))?'<img src="'.$blogData->small_img.'" width="70px" height="50px">':'';?></div>
                          </div>
                          <input type="hidden" name="action" value="addBlog">
                          <input type="hidden" name="hiddenval" value="<?=isset($blogData->blogId)?$blogData->blogId:0;?>">
                          <input type="hidden" name="indexval" value="">
                          <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                          <button type="button" class="btn btn-light">Cancel</button>
                        </form>
                      </div>
                    </div>
                  </div>                  
                </div>
              </div>
            </div> 
        </div>


<?php $this->load->viewD('inc/footer.php'); ?>
<script type="text/javascript">
  var tags = <?=(isset($tags) && !empty($tags))? json_encode($tags):json_encode(array());?>;
  $(document).ready(function() {
      if (tags) {
        $.each(tags, function(i, item) {
          $("#tags").tagsinput('add', { "value": item.tagId , "text": item.tag });
        });
      }
  });
</script>