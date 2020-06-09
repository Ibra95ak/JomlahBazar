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
<div id="googleMap" style="width:100%;height:400px;"></div>

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
$.ajax({
        type: "POST",
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/client/CON_Addresses.php",
        dataType: "json",
        success: function(data) {
            for($i=0;$i<data.length;i++){
                myLatLng = {lat: 25.068607, lng: 55.145040};
                
            }
        }
    });
marker = new google.maps.Marker({position: myLatLng,icon:'http://localhost/JomlahBazar/AdminPanel/pics/markers/marker-supplier.png',map:map});
var infowindow = new google.maps.InfoWindow({
  content:"Hello World!"
});
google.maps.event.addListener(marker, 'click', function() {
  infowindow.open(map,marker);
}); 
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVzo-5w2SxFAIeZ9xj586Q9OO6t4Hx6rE&callback=myMap"></script>