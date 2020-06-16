<?php
include('../AdminPanel/libraries/base.php');
include("header.php");
$filter="";
if(isset($_GET['search_by'])) $filter.="&search_by=".$_GET['search_by'];
if(isset($_GET['filter_category'])) $filter.="&filter_category=".$_GET['filter_category'];
if(isset($_GET['search'])) $filter.="&search=".$_GET['search'];
if(isset($_GET['order_by'])) $filter.="&order_by=".$_GET['order_by'];
if(isset($_GET['filter_brand'])) $filter.="&filter_brand=".$_GET['filter_brand'];
if(isset($_GET['filter_rank'])) $filter.="&filter_rank=".$_GET['filter_rank'];
if(isset($_GET['filter_location'])) $filter.="&filter_location=".$_GET['filter_location'];
?>
<!-- Bread Crumbs and Filters and products -->
<div class="container container-fluid">
    <div class="row">

        <!-- Filters -->
        <?php include('filters.php');?>
        <!-- Filters -->

        <!-- Products Grid -->
        <div class="col-lg-10 col-md-12">
            <div class="row">
                <div class="col-6">
                <div id="products" class="row view-group">
<?php
$API_addresses = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Addresses.php?".$filter);
$addresses = json_decode($API_addresses);
if($addresses){
  foreach($addresses as $address){
    echo '<div class="item col-lg-4 col-md-4 mb-4 mb-4 list-group-item"><div class="thumbnail card product"><div class="caption card-body">';
    echo '<h5 class="product-type">'.$address->address1.'</h5>';
    echo '<h3 class="product-name">'.$address->address2.'</h3>';
    echo '</div></div></div>';
  }
}
?>
            <div class="clearfix"></div>
            <!-- Pagination -->
            <div class="text-center col">
              <nav aria-label="Page navigation example">
                <ul class="pagination pagination-template d-flex justify-content-center float-none">
                  <li class="page-item"><a href="#" class="page-link"> <i class="fa fa-angle-left"></i></a></li>
                  <li class="page-item"><a href="#" class="page-link active">1</a></li>
                  <li class="page-item"><a href="#" class="page-link">2</a></li>
                  <li class="page-item"><a href="#" class="page-link">3</a></li>
                  <li class="page-item"><a href="#" class="page-link"> <i class="fa fa-angle-right"></i></a></li>
                </ul>
              </nav>
            </div>
          </div>
          </div>
          <div class="col-6">
              <div class="clearfix"></div>
              <div class="row">
          <div id="googleMap" style="width:100%;height:550px;"></div>

                  <div class="clearfix"></div>
              </div>

          </div>

            </div>
        </div>


    </div>
</div>
<div class="clearfix"></div>

<?php include("footer.php");?>
<script>
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(25.068607, 55.145040),
  zoom:15,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
var marker;
var myLatLng;
var i;
var infowindow = new google.maps.InfoWindow();
$.ajax({
        type: "POST",
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/client/CON_Addresses.php",
        dataType: "json",
        success: function(data) {
            for(var i=0;i<data.length;i++){
                myLatLng = {lat: parseFloat(data[i]['latitude']), lng: parseFloat(data[i]['longitude'])};
                marker = new google.maps.Marker({position: myLatLng,icon:'http://localhost/JomlahBazar/AdminPanel/pics/markers/marker-supplier.png'});
                marker.setMap(map);
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                      infowindow.setContent(data[i]['city']);
                      infowindow.open(map, marker);
                    }
                  })(marker, i));
            }
        }
    });
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVzo-5w2SxFAIeZ9xj586Q9OO6t4Hx6rE&callback=myMap"></script>
