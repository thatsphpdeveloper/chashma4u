<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
<?php $this->load->viewD('inc/sidebar.php'); ?>
<style type="text/css">
.form-group {
  display: block;
  margin-bottom: 15px;
}

.form-group input {
  padding: 0;
  height: initial;
  width: initial;
  margin-bottom: 0;
  display: none;
  cursor: pointer;
}

.form-group label {
  position: relative;
  cursor: pointer;
}

.form-group label:before {
  content:'';
  -webkit-appearance: none;
  background-color: transparent;
  border: 2px solid #0079bf;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
  padding: 10px;
  display: inline-block;
  position: relative;
  vertical-align: middle;
  cursor: pointer;
  margin-right: 5px;
}

.form-group input:checked + label:after {
  content: '';
  display: block;
  position: absolute;
  top: 2px;
  left: 9px;
  width: 6px;
  height: 14px;
  border: solid #0079bf;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
}
form.forms-permission label {
    min-height: 37px;
}</style>
      <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">
              <div class="col-md-12 d-flex align-items-stretch grid-margin">
                <div class="row flex-grow">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="mb-3">Permissions: <?=$roleData->role.' ('.$roleData->vendorName.')'?> <a href="<?=DASHURL.'/'.$this->sessDashboard?>/role" class="btn btn-success pull-right">Role List</a></h4>
                        <?php $permissions = ($roleData->permissions)?array_keys(unserialize($roleData->permissions)):array();?>
                        <form class="forms-permission" onSubmit="return validateRolePermission(this, event);">
                          <div class="row zone-module">
                            <h4 class="col-md-12 card-title text-primary">Set zone permissions:</h4>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_manage_all" value="1" name="can_manage_all_zone" id="can_manage_all_zone"<?=(in_array('can_manage_all_zone', $permissions)?'checked':'')?>>
                                <label for="can_manage_all_zone">Can manage all zone</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_view" value="1" name="can_view_zone" id="can_view_zone" <?=(in_array('can_view_zone', $permissions)?'checked':'')?>>
                                <label for="can_view_zone">Can view zone</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_create" value="1" name="can_create_zone" id="can_create_zone" <?=(in_array('can_create_zone', $permissions)?'checked':'')?>>
                                <label for="can_create_zone">Can create zone</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_edit" value="1" name="can_edit_zone" id="can_edit_zone" <?=(in_array('can_edit_zone', $permissions)?'checked':'')?>>
                                <label for="can_edit_zone">Can edit zone</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_delete" value="1" name="can_delete_zone" id="can_delete_zone" <?=(in_array('can_delete_zone', $permissions)?'checked':'')?>>
                                <label for="can_delete_zone">Can delete zone</label>
                              </div>
                            </div>
                          </div>
                          <div class="row pincode-module">
                            <h4 class="col-md-12 card-title text-primary">Set pincode permissions:</h4>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_manage_all" value="1" name="can_manage_all_pincode" id="can_manage_all_pincode" <?=(in_array('can_manage_all_pincode', $permissions)?'checked':'')?>>
                                <label for="can_manage_all_pincode">Can manage all pincodes</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_view" value="1" name="can_view_pincode" id="can_view_pincode" <?=(in_array('can_view_pincode', $permissions)?'checked':'')?>>
                                <label for="can_view_pincode">Can view pincodes</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_create" value="1" name="can_create_pincode" id="can_create_pincode" <?=(in_array('can_create_pincode', $permissions)?'checked':'')?>>
                                <label for="can_create_pincode">Can create pincodes</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_edit" value="1" name="can_edit_pincode" id="can_edit_pincode" <?=(in_array('can_edit_pincode', $permissions)?'checked':'')?>>
                                <label for="can_edit_pincode">Can edit pincodes</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_delete" value="1" name="can_delete_pincode" id="can_delete_pincode" <?=(in_array('can_delete_pincode', $permissions)?'checked':'')?>>
                                <label for="can_delete_pincode">Can delete pincodes</label>
                              </div>
                            </div>
                          </div>
                          <div class="row product-category-module">
                            <h4 class="col-md-12 card-title text-primary">Set product category permissions:</h4>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_manage_all" value="1" name="can_manage_all_product_category" id="can_manage_all_product_category" <?=(in_array('can_manage_all_product_category', $permissions)?'checked':'')?>>
                                <label for="can_manage_all_product_category">Can manage all product category</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_view" value="1" name="can_view_product_category" id="can_view_product_category" <?=(in_array('can_view_product_category', $permissions)?'checked':'')?>>
                                <label for="can_view_product_category">Can view product category</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_create" value="1" name="can_create_product_category" id="can_create_product_category" <?=(in_array('can_create_product_category', $permissions)?'checked':'')?>>
                                <label for="can_create_product_category">Can create product category</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_edit" value="1" name="can_edit_product_category" id="can_edit_product_category" <?=(in_array('can_edit_product_category', $permissions)?'checked':'')?>>
                                <label for="can_edit_product_category">Can edit product category</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_delete" value="1" name="can_delete_product_category" id="can_delete_product_category" <?=(in_array('can_delete_product_category', $permissions)?'checked':'')?>>
                                <label for="can_delete_product_category">Can delete product category</label>
                              </div>
                            </div>
                          </div>
                          <div class="row product-module">
                            <h4 class="col-md-12 card-title text-primary">Set product permissions:</h4>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_manage_all" value="1" name="can_manage_all_product" id="can_manage_all_product" <?=(in_array('can_manage_all_product', $permissions)?'checked':'')?>>
                                <label for="can_manage_all_product">Can manage all product</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_view" value="1" name="can_view_product" id="can_view_product" <?=(in_array('can_view_product', $permissions)?'checked':'')?>>
                                <label for="can_view_product">Can view product</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_create" value="1" name="can_create_product" id="can_create_product" <?=(in_array('can_create_product', $permissions)?'checked':'')?>>
                                <label for="can_create_product">Can create product</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_edit" value="1" name="can_edit_product" id="can_edit_product" <?=(in_array('can_edit_product', $permissions)?'checked':'')?>>
                                <label for="can_edit_product">Can edit product</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_delete" value="1" name="can_delete_product" id="can_delete_product" <?=(in_array('can_delete_product', $permissions)?'checked':'')?>>
                                <label for="can_delete_product">Can delete product</label>
                              </div>
                            </div>
                          </div>
                          <div class="row today-deal-module">
                            <h4 class="col-md-12 card-title text-primary">Set today deal permissions:</h4>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_manage_all" value="1" name="can_manage_all_today_deal" id="can_manage_all_today_deal" <?=(in_array('can_manage_all_today_deal', $permissions)?'checked':'')?>>
                                <label for="can_manage_all_today_deal">Can manage all today deal</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_view" value="1" name="can_view_today_deal" id="can_view_today_deal" <?=(in_array('can_view_today_deal', $permissions)?'checked':'')?>>
                                <label for="can_view_today_deal">Can view today deal</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_create" value="1" name="can_create_today_deal" id="can_create_today_deal" <?=(in_array('can_create_today_deal', $permissions)?'checked':'')?>>
                                <label for="can_create_today_deal">Can create today deal</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_edit" value="1" name="can_edit_today_deal" id="can_edit_today_deal" <?=(in_array('can_edit_today_deal', $permissions)?'checked':'')?>>
                                <label for="can_edit_today_deal">Can edit today deal</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_delete" value="1" name="can_delete_today_deal" id="can_delete_today_deal" <?=(in_array('can_delete_today_deal', $permissions)?'checked':'')?>>
                                <label for="can_delete_today_deal">Can delete today deal</label>
                              </div>
                            </div>
                          </div>
                          <div class="row order-module">
                            <h4 class="col-md-12 card-title text-primary">Set order permissions:</h4>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_manage_all" value="1" name="can_manage_all_order" id="can_manage_all_order" <?=(in_array('can_manage_all_order', $permissions)?'checked':'')?>>
                                <label for="can_manage_all_order">Can manage all order</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_view" value="1" name="can_view_order" id="can_view_order" <?=(in_array('can_view_order', $permissions)?'checked':'')?>>
                                <label for="can_view_order">Can view order</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_edit" value="1" name="can_edit_order" id="can_edit_order" <?=(in_array('can_edit_order', $permissions)?'checked':'')?>>
                                <label for="can_edit_order">Can edit order</label>
                              </div>
                            </div>
                          </div>
                          <div class="row vendor-module">
                            <h4 class="col-md-12 card-title text-primary">Set vendor permissions:</h4>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_manage_all" value="1" name="can_manage_all_vendor" id="can_manage_all_vendor" <?=(in_array('can_manage_all_vendor', $permissions)?'checked':'')?>>
                                <label for="can_manage_all_vendor">Can manage all vendor</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_view" value="1" name="can_view_vendor" id="can_view_vendor" <?=(in_array('can_view_vendor', $permissions)?'checked':'')?>>
                                <label for="can_view_vendor">Can view vendor</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_create" value="1" name="can_create_vendor" id="can_create_vendor" <?=(in_array('can_create_vendor', $permissions)?'checked':'')?>>
                                <label for="can_create_vendor">Can create vendor</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_edit" value="1" name="can_edit_vendor" id="can_edit_vendor" <?=(in_array('can_edit_vendor', $permissions)?'checked':'')?>>
                                <label for="can_edit_vendor">Can edit vendor</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_delete" value="1" name="can_delete_vendor" id="can_delete_vendor" <?=(in_array('can_delete_vendor', $permissions)?'checked':'')?>>
                                <label for="can_delete_vendor">Can delete vendor</label>
                              </div>
                            </div>
                          </div>
                          <div class="row role-module">
                            <h4 class="col-md-12 card-title text-primary">Set role permissions:</h4>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_manage_all" value="1" name="can_manage_all_role" id="can_manage_all_role" <?=(in_array('can_manage_all_role', $permissions)?'checked':'')?>>
                                <label for="can_manage_all_role">Can manage all role</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_view" value="1" name="can_view_role" id="can_view_role" <?=(in_array('can_view_role', $permissions)?'checked':'')?>>
                                <label for="can_view_role">Can view role</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_create" value="1" name="can_create_role" id="can_create_role" <?=(in_array('can_create_role', $permissions)?'checked':'')?>>
                                <label for="can_create_role">Can create role</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="" value="1" name="can_edit_role" id="can_edit_role" <?=(in_array('can_edit_role', $permissions)?'checked':'')?>>
                                <label for="can_edit_role">Can edit role</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_delete" value="1" name="can_delete_role" id="can_delete_role" <?=(in_array('can_delete_role', $permissions)?'checked':'')?>>
                                <label for="can_delete_role">Can delete role</label>
                              </div>
                            </div>
                          </div>
                          <div class="row employee-module">
                            <h4 class="col-md-12 card-title text-primary">Set employee permissions:</h4>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_manage_all" value="1" name="can_manage_all_employee" id="can_manage_all_employee" <?=(in_array('can_manage_all_employee', $permissions)?'checked':'')?>>
                                <label for="can_manage_all_employee">Can manage all employee</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_view" value="1" name="can_view_employee" id="can_view_employee" <?=(in_array('can_view_employee', $permissions)?'checked':'')?>>
                                <label for="can_view_employee">Can view employee</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_create" value="1" name="can_create_employee" id="can_create_employee" <?=(in_array('can_create_employee', $permissions)?'checked':'')?>>
                                <label for="can_create_employee">Can create employee</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_edit" value="1" name="can_edit_employee" id="can_edit_employee" <?=(in_array('can_edit_employee', $permissions)?'checked':'')?>>
                                <label for="can_edit_employee">Can edit employee</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="checkbox" class="can_delete" value="1" name="can_delete_employee" id="can_delete_employee" <?=(in_array('can_delete_employee', $permissions)?'checked':'')?>>
                                <label for="can_delete_employee">Can delete employee</label>
                              </div>
                            </div>
                          </div>
                          <div class="row employee-module">
                            
                            <div class="col-md-3">
                              <div class="form-group">
                                <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                                <input type="hidden" name="action" value="updateRolePermision">
                                <input type="hidden" name="hiddenval" value="<?=$roleData->roleId?>">                                
                              </div>
                            </div>
                            <div class="col-md-12 msg">
                            </div>
                            
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>                  
                </div>
              </div>
            </div> 
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->

<?php $this->load->viewD('inc/footer.php'); ?>
<script type="text/javascript">
  $(document).on('change', '.can_delete, .can_edit, .can_create, .can_view', function(){
    if($(this).prop("checked") == true) {

      if(!$(this).hasClass('can_view'))
        $(this).closest('.row').find('.can_view').prop("checked", true);

      if ($(this).closest('.row').find('.can_delete').prop("checked") == true && $(this).closest('.row').find('.can_edit').prop("checked") == true && $(this).closest('.row').find('.can_create').prop("checked") == true && $(this).closest('.row').find(' .can_view').prop("checked") == true )
        $(this).closest('.row').find('.can_manage_all').prop("checked", true);
      

    }else{

      if($(this).hasClass('can_view'))
        $(this).closest('.row').find('.can_manage_all, .can_delete, .can_edit, .can_create').prop("checked", false);

      if ($(this).closest('.row').find('.can_delete').prop("checked") == false || $(this).closest('.row').find('.can_edit').prop("checked") == false || $(this).closest('.row').find('.can_create').prop("checked") == false || $(this).closest('.row').find(' .can_view').prop("checked") == false )
        $(this).closest('.row').find('.can_manage_all').prop("checked", false);

    }
  });
  $(document).on('change', '.can_manage_all', function(){
    if($(this).prop("checked") == true)
        $(this).closest('.row').find('.can_delete, .can_edit, .can_create, .can_view').prop("checked", true);
    else
      $(this).closest('.row').find('.can_delete, .can_edit, .can_create, .can_view').prop("checked", false);
  });
</script>

