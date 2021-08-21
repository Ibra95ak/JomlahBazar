var src=document.getElementById("uid").src;
var userId = src.split("userId=")[1];
var searchGrid = function() {
  var url = DIR_CONT+DIR_USR+"CON_userscontacts.php?action=get";
  $.ajax({url: url, success: function(result){
    document.getElementById("rec-gd").innerHTML = "";
    $("#rec-gd").html(result);
  }});
};
// Group buttons change data preview
$("#btn-dt").click(function(){
  $("#rec-dt").show();
  $("#rec-gd").hide();
  $("#kt_gmap_c").attr("style", "height: 0px; position: relative; overflow: hidden; display: none;");
});
$("#btn-gd").click(function(){
  $("#rec-dt").hide();
  $("#rec-gd").show();
  $("#kt_gmap_c").attr("style", "height: 0px; position: relative; overflow: hidden; display: none;");
});
$("#btn-map-contacts").click(function(){
  $("#rec-dt").hide();
  $("#rec-gd").hide();
  $("#kt_gmap_c").attr("style", "height: 500px; position: relative; overflow: hidden;");
});
var democ = function() {
	var map = new GMaps({
		div: '#kt_gmap_c',
		lat: 24.7563957,
		lng: 55.2597173,
	});
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			var pos = {
				lat: position.coords.latitude,
				lng: position.coords.longitude
			};
			map.setCenter(pos);
			map.setZoom(13);
			map.addMarker({
				position: pos,
				map: map,
				draggable:true,
				icon: DIR_ROOT+DIR_ICON+"marker.png"
		});
		});
	}
	var url = DIR_CONT+DIR_USR+"CON_buyer_profile.php?action=get&userId="+userId;
  console.log(DIR_CONT+DIR_USR+"CON_buyer_profile.php?action=get&userId="+userId);
	$.get(url, function(data, status) {
		var userdata = JSON.parse(data);
		var contacts = userdata.contactlist;
		contacts.forEach((item, i) => {
			map.addMarker({
				lat: item.latitude,
				lng: item.longitude,
				title: item.fullname,
				infoWindow: {
					content: '<span style="color:#000">' + item.fullname + '</span>'
				}
			});
		});
	});
	map.setZoom(7);
}
democ();
searchGrid();
