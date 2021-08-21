"use strict";

// Class definition
var KTGoogleMapsDemo = function() {

  // Private functions
  var demo44 = function(supplierId) {
    var map = new GMaps({
      div: '#kt_gmap_4',
      lat: 24.7563957,
      lng: 55.2597173,
    });
    var url = DIR_CONT+"CON_productsuppliers.php?action=getloc&supplierId="+supplierId;
    $.get(url, function(data, status) {
      var users = data['data'];
      users.forEach((item, i) => {
        var username="";
        if(item['fullname']!='') username=item['fullname'];
        else if(item['email']!='') username=item['email'];
        else if(item['otp']!='') username=item['otp'];
        map.addMarker({
          lat: item['latitude'],
          lng: item['longitude'],
          title: item['fullname'],
          infoWindow: {
            content: '<span style="color:#000">' + username + '</span>'
          }
        });
      });
    });
    map.setZoom(7);
  }


  return {
    // public functions
    init: function() {
      // default charts
      demo4(0);
    }
  };
}();

jQuery(document).ready(function() {
  KTGoogleMapsDemo.init();
});
