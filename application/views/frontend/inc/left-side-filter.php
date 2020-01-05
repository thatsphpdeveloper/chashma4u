 <div class="col-lg-2 aside aside--left fixed-col js-filter-col">
                        <div class="fixed-col_container">
                            <div class="filter-close">CLOSE</div>
                            <div class="sidebar-block sidebar-block--mobile d-block d-lg-none">
                                <div class="d-flex align-items-center">
                                    <div class="selected-label">(0) FILTER</div>
                                    <div class="selected-count ml-auto hide">SELECTED <span><b>25 items</b></span></div>
                                </div>
                            </div>
                            <div class="sidebar-block filter-group-block open selected-filters-box hide">
                                <div class="sidebar-block_title"><span>Current Selection</span>
                                    <div class="toggle-arrow"></div>
                                </div>
                                <div class="sidebar-block_content">
                                    <div class="selected-filters-wrap">
                                        <ul class="selected-filters">
                                        </ul>
                                        <div class="d-flex align-items-center"><a href="#" class="clear-filters"><span>Clear All</span></a>
                                            <div class="selected-count ml-auto d-none d-lg-block hide">SELECTED<span><b>25 items</b></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-block filter-group-block collapsed hide">
                                <div class="sidebar-block_title"><span>Categories</span>
                                    <div class="toggle-arrow"></div>
                                </div>
                                <div class="sidebar-block_content">
                                    <ul class="category-list">
                                        <li class="active"><a href="<?=BASEURL?>/women-eyeglasses">Women</a></li>
                                        <li><a href="<?=BASEURL?>/men-eyeglasses">Men</a></li>
                                        <li><a href="<?=BASEURL?>/kids-eyeglasses">Kids</a></li>
                                    </ul>
                                </div>
                            </div>

                            <?php                                
                               $colorOptions = $sizeOptions = '';
                                if(isset($attributeData) && !empty($attributeData)) {
                                    foreach($attributeData as $attribute) {
                                      
                                        if($attribute->attributeId == 1)
                                          $colorOptions .= '<li class="filtering-item filtercolor-'.$attribute->name.'" data-name="filtercolor" data-value="'.$attribute->name.'" data-text="'.$attribute->name.'"><a href="javascript:" data-tooltip="'.$attribute->name.'" title="'.$attribute->name.'"><span class="value"><svg xmlns="http://www.w3.org/2000/svg"xmlns:xlink="http://www.w3.org/1999/xlink"> <circle cx="9.3" cy="9.3" r="9.3" style="fill: '.strtolower($attribute->name).';"></circle> </svg></span><span class="colorname">'.$attribute->name.'</span></a></li>';
                                        else if($attribute->attributeId == 2)
                                          $sizeOptions .= '<li class="filtering-item filtersize-'.$attribute->name.'" data-name="filtersize" data-value="'.$attribute->name.'" data-text="'.$attribute->name.'"><a href="javascript:">'.$attribute->name.'</a></li>';
                                    }
                                }  ?>
                            <div class="sidebar-block filter-group-block collapsed">
                                <div class="sidebar-block_title"><span>Colors</span>
                                    <div class="toggle-arrow"></div>
                                </div>
                                <div class="sidebar-block_content">
                                    <ul class="color-list">
                                        <?=$colorOptions?>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-block filter-group-block collapsed">
                                <div class="sidebar-block_title"><span>Brands</span>
                                    <div class="toggle-arrow"></div>
                                </div>
                                <div class="sidebar-block_content">
                                    <ul class="category-list">

                                    <?php 
                                      if(isset($brandData) && !empty($brandData)) {
                                          foreach($brandData as $brand) {          
                                              echo '<li class="filtering-item filterbrand-'.$brand->brandId.'" data-name="filterbrand" data-value="'.$brand->brandId.'" data-text="'.$brand->brandName.'"><a href="javascript:">'.$brand->brandName.'</a></li>';
                                          }
                                      }  ?>
                                        <!-- <li class="active"><a href="#">Reebok</a></li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-block filter-group-block collapsed">
                                <div class="sidebar-block_title"><span>Shapes</span>
                                    <div class="toggle-arrow"></div>
                                </div>
                                <div class="sidebar-block_content">
                                    <ul class="category-list">

                                    <?php 
                                      if(isset($shapeData) && !empty($shapeData)) {
                                          foreach($shapeData as $shape) {          
                                              echo '<li class="filtering-item filtershape-'.$shape->shapeId.'" data-name="filtershape" data-value="'.$shape->shapeId.'" data-text="'.$shape->shapeName.'"><a href="javascript:">'.$shape->shapeName.'</a></li>';
                                          }
                                      }  ?>
                                        <!-- <li class="active"><a href="#">Reebok</a></li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-block filter-group-block collapsed">
                                <div class="sidebar-block_title"><span>Price</span>
                                    <div class="toggle-arrow"></div>
                                </div>
                                <div class="sidebar-block_content">
                                    <ul class="category-list">
                                        <li class="filtering-item filtering-item-price filterprice-0-500" data-name="filterprice" data-value="0-500" data-text="₹0-₹500"><a href="javascript:">₹0-₹500</a></li>
                                        <li class="filtering-item filtering-item-price filterprice-500-1000" data-name="filterprice" data-value="500-1000" data-text="₹500-₹1000"><a href="javascript:">₹500-₹1000</a></li>
                                        <li class="filtering-item filtering-item-price filterprice-1000-2000" data-name="filterprice" data-value="1000-2000" data-text="₹1000-₹2000"><a href="javascript:">₹1000-₹2000</a></li>
                                        <li class="filtering-item filtering-item-price filterprice-2000-100000" data-name="filterprice" data-value="2000-100000" data-text="Above ₹2000"><a href="javascript:">Above ₹2000</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-block filter-group-block collapsed">
                                <div class="sidebar-block_title"><span>Size</span>
                                    <div class="toggle-arrow"></div>
                                </div>
                                <div class="sidebar-block_content">
                                    <ul class="size-list" data-sort='["XXS","XS","S","M","L","XL","XXL","XXXL"]'>
                                        <?=$sizeOptions?>
                                    </ul>
                                </div>
                            </div>
                          
                        </div>
                    </div>