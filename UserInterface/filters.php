<div class="col-lg-2 col-md-12" style="overflow-x: hidden;overflow-y: auto;max-height: 530px;">
    <div class="inner-left-menu">
        <div class="list-css">
            <ul>
                <li>
                    <div class="custom-select2">
                        <select>
                            <option>Default Sorting</option>
                            <option value="A-Z">A to Z</option>
                            <option value="Z-A">Z to A</option>
                            <option value="High to low price">High to low price</option>
                            <option value="Low to high price">Low to high</option>
                        </select>
                    </div>
                </li>
                <li>
                    <div class="custom-select2">
                        <select>
                            <option value="A-Z">Show 10</option>
                            <option value="Z-A">Show 20</option>
                            <option value="High to low price">Show 30</option>
                        </select>
                    </div>
                </li>
            </ul>
        </div>
        <h3>Categories</h3>
        <div class="list-css">
            <ul class="list-unstyled components">
                <?php
$API_productscategories = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Filter_Categories.php?search=".urlencode($search));
$productscategories = json_decode($API_productscategories); 
if($productscategories){
    $count=0;
    foreach($productscategories as $category){
        $count++;
        echo '<li class="active"><a href="#homeSubmenu'.$count.'" data-toggle="collapse" aria-expanded="false" class="collapsed">'.$category->name.'<i class="fa fa-angle-down" aria-hidden="true"></i></a>';
        echo '<ul class="list-unstyled collapse" id="homeSubmenu'.$count.'" style="">';
        $API_productssubcategories = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_FeaturedSubCategories.php?categoryId=".$category->categoryId);
      $productssubcategories = json_decode($API_productssubcategories); 
      if($productssubcategories){
          foreach($productssubcategories as $productssubcategory){
              echo '<li><a href="product-search.php?search_by=2&search_category='.$category->categoryId.'&search_subcategory='.$productssubcategory[0].'&search=">'.$productssubcategory[2].'</a></li>';
          }
      }
        echo '</ul></li>';
    }
}                        
?>
            </ul>
        </div>
        <h3>Filter By Price</h3>
        <div class="price-range-block">
            <div class="row">
                <div class="col-9 p-0">
                    <input type="number" min=0 max="9900" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field" placeholder="MIN" />
                    <input type="number" min=0 max="10000" oninput="validity.valid||(value='10000');" id="max_price" class="price-range-field" placeholder="MAX" />
                </div>
                <div class="col-3 p-0">
                    <button type="button" class="btn btn-filter">Filter</button>
                </div>
            </div>
        </div>
        <h3>Popular Picks</h3>
        <div class="list-css">
            <ul>
                <li>
                    <!-- Default unchecked -->
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="defaultUnchecked-1">
                        <label class="custom-control-label" for="defaultUnchecked-1">Top Sales</label>
                    </div>
                </li>
                <li>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="defaultUnchecked-2">
                        <label class="custom-control-label" for="defaultUnchecked-2">New Products</label>
                    </div>
                </li>
                <li>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="defaultUnchecked-3">
                        <label class="custom-control-label" for="defaultUnchecked-3">Featured Products</label>
                    </div>
                </li>
                <li>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="defaultUnchecked-4">
                        <label class="custom-control-label" for="defaultUnchecked-4">Bestsellers</label>
                    </div>
                </li>
            </ul>
        </div>
        <h3>brand</h3>
        <div class="tag_bottom">
            <?php
require_once '../AdminPanel/libraries/Ser_Brands.php';
$db1 = new Ser_Brands();  
$brands = $db1->Getbrands(); 
if($brands){
    foreach($brands as $brand){
        echo '<a class="tag-btn" href="brand-search.php?search_category=0&search='.$brand['brand_name'].'">'.$brand['brand_name'].'</a>';
    }
}                        
?>
        </div>
        <h3>registered suppliers</h3>
        <div class="list-css">
            <ul>
                <li><a href="">reg sup1</a></li>
                <li><a href="">reg sup2</a></li>
            </ul>
        </div>
        <h3>store</h3>
        <div class="list-css">
            <ul>
                <li><a href="">store1</a></li>
                <li><a href="">store2</a></li>
            </ul>
        </div>
        <h3>reviews</h3>
        <div class="list-css">
            <ul>
                <li><a href="">1 star</a></li>
                <li><a href="">2 stars</a></li>
            </ul>
        </div>
        <h3>location</h3>
        <div class="list-css">
            <ul>
                <li><a href="">location1</a></li>
                <li><a href="">location2</a></li>
            </ul>
        </div>
        <h3>Discout</h3>
        <div class="list-css">
            <ul>
                <li>
                    <!-- Default unchecked -->
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="defaultUnchecked-5">
                        <label class="custom-control-label" for="defaultUnchecked-5">Discount</label>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>