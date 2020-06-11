<?php 
include('../AdminPanel/libraries/base.php');
include("header.php");
$search_category=$_GET['search_category'];
$search=$_GET['search'];
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
                <div class="col-12">
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