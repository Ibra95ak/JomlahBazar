// Class definition
var KTBootstrapDaterangepicker = function () {
    var winurl = window.location.href;
    var winurlsplit = winurl.split('?');
    if (winurlsplit[1]) {
      var urlsplit = winurlsplit[1].split('&');
      var fromsplit = urlsplit[0].split('=');
      var tosplit = urlsplit[1].split('=');
      var fromsplit=fromsplit[1];
      var tosplit=tosplit[1];
    }else {
      var d = new Date();
      var year = d.getFullYear();
      var month = ("0" + (d.getMonth() + 1)).slice(-2);
      var day = ("0" + d.getDate()).slice(-2);
      var currentdate = year+"-"+month+"-"+day;
      var fromsplit=currentdate;
      var tosplit=currentdate;
    }
    // Private functions
    var demos = function () {
        // minimum setup

        $('#kt_daterangepicker_1, #kt_daterangepicker_1_modal').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            startDate: fromsplit,
            endDate: tosplit,
            locale: {
                format: "YYYY-MM-DD",
            },
            cancelClass: 'btn-secondary'
        }, function (start, end, label) {

            $('#kt_daterangepicker_1').val(start.format('YYYY-MM-DD') + '-' + end.format('YYYY-MM-DD'));
            var from = start.format('YYYY-MM-DD');
            var to = end.format('YYYY-MM-DD');
            currentUrl= DIR_VIEW+DIR_ORD+'b2c-received-orders.php';
            window.open(currentUrl+'?from='+from+'&to='+to, '_self');
        });

        $('#kt_daterangepicker_my_orders').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            startDate: fromsplit,
            endDate: tosplit,
            locale: {
                format: "YYYY-MM-DD",
            },
            cancelClass: 'btn-secondary'
        }, function (start, end, label) {
            $('#kt_daterangepicker_my_orders').val(start.format('YYYY-MM-DD') + '-' + end.format('YYYY-MM-DD'));
            var from = start.format('YYYY-MM-DD');
            var to = end.format('YYYY-MM-DD');
            currentUrl=DIR_VIEW+DIR_ORD+'b2c-my-orders.php';
            window.open(currentUrl+'?from='+from+'&to='+to, '_self');
        });
        $('#kt_daterangepicker_my_payments').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            startDate: fromsplit,
            endDate: tosplit,
            locale: {
                format: "YYYY-MM-DD",
            },
            cancelClass: 'btn-secondary'
        }, function (start, end, label) {
            $('#kt_daterangepicker_my_payments').val(start.format('YYYY-MM-DD') + '-' + end.format('YYYY-MM-DD'));
            var from = start.format('YYYY-MM-DD');
            var to = end.format('YYYY-MM-DD');
            currentUrl=DIR_VIEW+DIR_ORD+'my-payments.php';
            window.open(currentUrl+'?from='+from+'&to='+to, '_self');
        });

        $('#kt_daterangepicker_received_quotations').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            startDate: fromsplit,
            endDate: tosplit,
            locale: {
                format: "YYYY-MM-DD",
            },
            cancelClass: 'btn-secondary'
        }, function (start, end, label) {
            $('#kt_daterangepicker_received_quotations').val(start.format('YYYY-MM-DD') + '-' + end.format('YYYY-MM-DD'));
            var from = start.format('YYYY-MM-DD');
            var to = end.format('YYYY-MM-DD');
            currentUrl=DIR_VIEW+DIR_ORD+'received-quotations.php';
            window.open(currentUrl+'?from='+from+'&to='+to, '_self');
        });
        $('#kt_daterangepicker_my_received_quotations').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            startDate: fromsplit,
            endDate: tosplit,
            locale: {
                format: "YYYY-MM-DD",
            },
            cancelClass: 'btn-secondary'
        }, function (start, end, label) {
            $('#kt_daterangepicker_my_received_quotations').val(start.format('YYYY-MM-DD') + '-' + end.format('YYYY-MM-DD'));
            var from = start.format('YYYY-MM-DD');
            var to = end.format('YYYY-MM-DD');
            currentUrl=DIR_VIEW+DIR_ORD+'my-quotations.php';
            window.open(currentUrl+'?from='+from+'&to='+to, '_self');
        });


        // input group and left alignment setup
        $('#kt_daterangepicker_2').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        }, function (start, end, label) {
            $('#kt_daterangepicker_2 .form-control').val(start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
        });

        $('#kt_daterangepicker_2_modal').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        }, function (start, end, label) {
            $('#kt_daterangepicker_2 .form-control').val(start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
        });

        // left alignment setup
        $('#kt_daterangepicker_3').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        }, function (start, end, label) {
            $('#kt_daterangepicker_3 .form-control').val(start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
        });

        $('#kt_daterangepicker_3_modal').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        }, function (start, end, label) {
            $('#kt_daterangepicker_3 .form-control').val(start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
        });


        // date & time
        $('#kt_daterangepicker_4').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary',

            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY h:mm A'
            }
        }, function (start, end, label) {
            $('#kt_daterangepicker_4 .form-control').val(start.format('MM/DD/YYYY h:mm A') + ' / ' + end.format('MM/DD/YYYY h:mm A'));
        });

        // date picker
        $('#kt_daterangepicker_5').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary',

            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'MM/DD/YYYY'
            }
        }, function (start, end, label) {
            $('#kt_daterangepicker_5 .form-control').val(start.format('MM/DD/YYYY') + ' / ' + end.format('MM/DD/YYYY'));
        });

        // predefined ranges
        var start = moment().subtract(29, 'days');
        var end = moment();

        $('#kt_daterangepicker_6').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary',

            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, function (start, end, label) {
            $('#kt_daterangepicker_6 .form-control').val(start.format('MM/DD/YYYY') + ' / ' + end.format('MM/DD/YYYY'));
        });
    }

    var validationDemos = function () {
        // input group and left alignment setup
        $('#kt_daterangepicker_1_validate').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        }, function (start, end, label) {
            $('#kt_daterangepicker_1_validate .form-control').val(start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
        });

        // input group and left alignment setup
        $('#kt_daterangepicker_2_validate').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        }, function (start, end, label) {
            $('#kt_daterangepicker_3_validate .form-control').val(start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
        });

        // input group and left alignment setup
        $('#kt_daterangepicker_3_validate').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        }, function (start, end, label) {
            $('#kt_daterangepicker_3_validate .form-control').val(start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
        });
    }

    return {
        // public functions
        init: function () {
            demos();
            validationDemos();
        }
    };
}();

jQuery(document).ready(function () {
    KTBootstrapDaterangepicker.init();
});
