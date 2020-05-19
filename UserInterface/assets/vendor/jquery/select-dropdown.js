"use strict";
$(document).ready(function() {
  $(".dropdown-menu li a").on('click', function() {
        var selText = $(this).text();
        $(this).parents('.btn-group').find('.dropdown-toggle').html(selText + ' <span class="caret"></span>');
    });

});