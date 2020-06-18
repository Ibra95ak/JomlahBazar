<div class="col-lg-2 col-md-12" style="overflow-x: hidden;overflow-y: auto;max-height: 530px;">
    <div class="inner-left-menu">
        <div class="list-css">
            <ul>
                <li>
                    <div class="custom-select2">
                        <select id="order_by" name="order_by">
                            <option value="0" <?php if (isset($_GET['order_by']) && $_GET['order_by']==0) {
    echo "selected";
} else {
    echo "";
}?>>Default Sorting</option>
                            <option value="1" <?php if (isset($_GET['order_by']) && $_GET['order_by']==1) {
    echo "selected";
} else {
    echo "";
}?>>A to Z</option>
                            <option value="2" <?php if (isset($_GET['order_by']) && $_GET['order_by']==2) {
    echo "selected";
} else {
    echo "";
}?>>Z to A</option>
                            <option value="3" <?php if (isset($_GET['order_by']) && $_GET['order_by']==3) {
    echo "selected";
} else {
    echo "";
}?>>High to low price</option>
                            <option value="4" <?php if (isset($_GET['order_by']) && $_GET['order_by']==4) {
    echo "selected";
} else {
    echo "";
}?>>Low to high</option>
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
        <div id="categories-filter">
          <h3>Categories</h3>
          <div class="list-css">
              <div class="custom-select2">
                                 <select id="filter_category" name="filter_category">
                                      <option value="0">All</option>
                                      <?php
  /*Fetch categories through API*/
  $API_categories= file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Categories.php");
  $categories = json_decode($API_categories);
  if ($categories) {
      foreach ($categories as $category) {
          if (isset($_GET['filter_category']) && $_GET['filter_category']==$category->categoryId) {
              echo '<option value="'.$category->categoryId.'" selected>'.$category->name.'</option>';
          } else {
              echo '<option value="'.$category->categoryId.'" >'.$category->name.'</option>';
          }
      }
  }
  ?>
                                  </select>
                      </div>
          </div>
        </div>
        <div id="price-filter">
          <h3>Filter By Price</h3>
          <div class="price-range-block">
              <div class="row">
                  <div class="col-12 p-0">
                      <input type="number" id="min_price" name="min_price" class="price-range-field" placeholder="MIN" value="<?php if (isset($_GET['max_price'])) {
      echo $_GET['min_price'];
  }?>"/>
                      <input type="number" id="max_price" name="max_price" class="price-range-field" placeholder="MAX" value="<?php if (isset($_GET['max_price'])) {
      echo $_GET['max_price'];
  }?>"/>
                  </div>
              </div>
          </div>
        </div>
        <div id="picks-filter">
          <h3>Popular Picks</h3>
          <div class="list-css">
              <ul>
                  <li>
                      <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="featured_products" name="featured_products" <?php if (isset($_GET['fp'])) {
      echo "checked";
  }?>>
                          <label class="custom-control-label" for="featured_products">Featured Products</label>
                      </div>
                  </li>
                  <li>
                      <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="bestseller_products" name="bestseller_products" <?php if (isset($_GET['bp'])) {
      echo "checked";
  }?>>
                          <label class="custom-control-label" for="bestseller_products">Best seller</label>
                      </div>
                  </li>
                  <li>
                      <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="discount_products" name="discount_products" <?php if (isset($_GET['dp'])) {
      echo "checked";
  }?>>
                          <label class="custom-control-label" for="discount_products">Discount</label>
                      </div>
                  </li>
              </ul>
          </div>
        </div>
        <div id="brand-filter">
          <h3>brand</h3>
          <div class="list-css">
              <div class="custom-select2">
              <select id="filter_brand" name="filter_brand">
                                      <option value="0">All</option>
                                      <?php
  /*Fetch categories through API*/
  $API_filterbrand= file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_filterbrand.php");
  $filterbrand = json_decode($API_filterbrand);
  if ($filterbrand) {
      foreach ($filterbrand as $brand) {
          if (isset($_GET['filter_brand']) && $_GET['filter_brand']==$brand->brandId) {
              echo '<option value="'.$brand->brandId.'" selected>'.$brand->brand_name.'</option>';
          } else {
              echo '<option value="'.$brand->brandId.'" >'.$brand->brand_name.'</option>';
          }
      }
  }
  ?>
                                  </select>
              </div>
          </div>
        </div>
        <div id="reviews-filter">
          <h3>reviews</h3>
          <div class="list-css">
              <div class="custom-select2">
                  <select id="filter_rank" name="filter_rank">
                      <option value="0" <?php if (isset($_GET['filter_rank']) && $_GET['filter_rank']==0) {
      echo "selected";
  } else {
      echo "";
  }?>>All</option>
                      <option value="1" <?php if (isset($_GET['filter_rank']) && $_GET['filter_rank']==1) {
      echo "selected";
  } else {
      echo "";
  }?>>1</option>
                      <option value="2" <?php if (isset($_GET['filter_rank']) && $_GET['filter_rank']==2) {
      echo "selected";
  } else {
      echo "";
  }?>>2</option>
                      <option value="3" <?php if (isset($_GET['filter_rank']) && $_GET['filter_rank']==3) {
      echo "selected";
  } else {
      echo "";
  }?>>3</option>
                      <option value="4" <?php if (isset($_GET['filter_rank']) && $_GET['filter_rank']==4) {
      echo "selected";
  } else {
      echo "";
  }?>>4</option>
                      <option value="5" <?php if (isset($_GET['filter_rank']) && $_GET['filter_rank']==5) {
      echo "selected";
  } else {
      echo "";
  }?>>5</option>
                  </select>
              </div>
          </div>
        </div>
        <div id="location-filter">
          <h3>location</h3>
          <div class="list-css">
            <div class="custom-select2">
                               <select id="filter_location" name="filter_location">
                                    <option value="0">All</option>
                                    <option value="dubai">Dubai</option>
                                    <option value="abu dhabi">Abu Dhabi</option>
                                    <option value="ajman">Ajman</option>
                                    <option value="fujairah">Fujairah</option>
                                    <option value="ras al khaimah">Ras al Khaimah</option>
                                    <option value="sharjah">Sharjah</option>
                                    <option value="umm al quwain"> Umm al Quwain</option>
                                  </select>
                                </div>
          </div>
      </div>
    </div>
    <div class="sticky" id="filter">Filter</div>
</div>
<script>
document.getElementById("filter").onclick = function() {
    var filter = "";
    var search_by = document.getElementById("search_by").value;
    var search = document.getElementById("search").value;
    var filter_category = document.getElementById("filter_category").value;
    var order_by = document.getElementById("order_by").value;
    var min_price = document.getElementById("min_price").value;
    var max_price = document.getElementById("max_price").value;
    var latest_products = document.getElementById("latest_products");
    var featured_products = document.getElementById("featured_products");
    var bestseller_products = document.getElementById("bestseller_products");
    var discount_products = document.getElementById("discount_products");
    var filter_brand = document.getElementById("filter_brand").value;
    var filter_rank = document.getElementById("filter_rank").value;
    var filter_location = document.getElementById("filter_location").value;
    if(search_by) filter += "&search_by=" + search_by;
    if(filter_category) filter += "&filter_category=" + filter_category;
    if(search) filter += "&search=" + encodeURI(search);
    else filter += "&search=";
    if(order_by) filter += "&order_by=" + order_by;
    if ((min_price > max_price) && (min_price != null) && (max_price != null)) alert("fix prices");
    else {
        if (min_price) filter += "&min_price=" + min_price;
        else filter += "&min_price=0";
        if (max_price) filter += "&max_price=" + max_price;
        else filter += "&max_price=0";
    }
    if (featured_products.checked) filter+="&fp=1";
    if (bestseller_products.checked) filter+="&bp=1";
    if (discount_products.checked) filter+="&dp=1";
    if (filter_brand) filter+="&filter_brand="+filter_brand;
    if (filter_rank) filter+="&filter_rank="+filter_rank;
    if(filter_location) filter += "&filter_location=" + filter_location;
    location.href= location.protocol + '//' + location.host + location.pathname+"?"+filter;
};
$(document).ready(function(){
  var search_by = document.getElementById("search_by").value;
  switch (search_by) {
    case '1':
      document.getElementById("categories-filter").style.display="visible";
      document.getElementById("price-filter").style.display="none";
      document.getElementById("picks-filter").style.display="none";
      document.getElementById("brand-filter").style.display="none";
      document.getElementById("reviews-filter").style.display="none";
      document.getElementById("location-filter").style.display="none";
      break;
    case '2':
      document.getElementById("categories-filter").style.display="visible";
      document.getElementById("price-filter").style.display="visible";
      document.getElementById("picks-filter").style.display="visible";
      document.getElementById("brand-filter").style.display="visible";
      document.getElementById("reviews-filter").style.display="visible";
      document.getElementById("location-filter").style.display="visible";
      break;
    case '3':
      document.getElementById("categories-filter").style.display="visible";
      document.getElementById("price-filter").style.display="none";
      document.getElementById("picks-filter").style.display="none";
      document.getElementById("brand-filter").style.display="visible";
      document.getElementById("reviews-filter").style.display="visible";
      document.getElementById("location-filter").style.display="visible";
      break;
    case '4':
      document.getElementById("categories-filter").style.display="none";
      document.getElementById("price-filter").style.display="none";
      document.getElementById("picks-filter").style.display="none";
      document.getElementById("brand-filter").style.display="none";
      document.getElementById("reviews-filter").style.display="none";
      document.getElementById("location-filter").style.display="visible";
      break;
    case '5':
      document.getElementById("categories-filter").style.display="visible";
      document.getElementById("price-filter").style.display="visible";
      document.getElementById("picks-filter").style.display="visible";
      document.getElementById("brand-filter").style.display="visible";
      document.getElementById("reviews-filter").style.display="visible";
      document.getElementById("location-filter").style.display="visible";
      break;
    default:
      document.getElementById("categories-filter").style.display="visible";
      document.getElementById("price-filter").style.display="visible";
      document.getElementById("picks-filter").style.display="visible";
      document.getElementById("brand-filter").style.display="visible";
      document.getElementById("reviews-filter").style.display="visible";
      document.getElementById("location-filter").style.display="visible";

  }
});
</script>
