"use strict";
// Class definition

var KTDatatableRecordSelectionDemo = function() {
    // Private functions

    var options = {
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: DIR_JSON+'Read.php?jsonname=stores.json',
                },
            },
            pageSize: 10,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
        },

        // layout definition
        layout: {
            scroll: false, // enable/disable datatable scroll both horizontal and
            // vertical when needed.
            footer: false // display/hide footer
        },

        // column sorting
        sortable: true,

        pagination: true,

        // columns definition

        columns: [{
            field: 'usercompanyId',
            title: '#',
            sortable: false,
            width: 20,
            selector: {
                class: 'kt-checkbox--solid'
            },
            textAlign: 'center',
        }, {
					field: 'fullname',
					title: 'User Name',
					template: function(data) {
						var user_img = data.user_pic;

						var output = '';
						if (user_img) {
							output = '<div class="kt-user-card-v2">\
								<div class="kt-user-card-v2__pic">\
									<img src="'+ DIR_ROOT + user_img + '" alt="photo">\
								</div>\
								<div class="kt-user-card-v2__details">\
									<span class="kt-user-card-v2__name">' + data.fullname + '</span>\
									<a href="#" class="kt-user-card-v2__email kt-link">' +
									data.fullname + '</a>\
								</div>\
							</div>';
						}
						else {
							var stateNo = KTUtil.getRandomInt(0, 7);
							var states = [
								'success',
								'brand',
								'danger',
								'success',
								'warning',
								'dark',
								'primary',
								'info'];
							var state = states[stateNo];

							output = '<div class="kt-user-card-v2">\
								<div class="kt-user-card-v2__pic">\
									<div class="kt-badge kt-badge--xl kt-badge--' + state + '">' + data.fullname.substring(0, 1) + '</div>\
								</div>\
								<div class="kt-user-card-v2__details">\
									<span class="kt-user-card-v2__name">' + data.fullname + '</span>\
									<a href="#" class="kt-user-card-v2__email kt-link">' +
									data.fullname + '</a>\
								</div>\
							</div>';
						}

						return output;
					},
				}, {
					field: 'companyname',
					title: 'Company Name',
					template: function(data) {
						var user_img = data.profile_pic;

						var output = '';
						if (user_img) {
							output = '<div class="kt-user-card-v2">\
								<div class="kt-user-card-v2__pic">\
									<img src="'+DIR_ROOT+ user_img + '" alt="photo">\
								</div>\
								<div class="kt-user-card-v2__details">\
									<span class="kt-user-card-v2__name">' + data.companyname + '</span>\
									<a href="#" class="kt-user-card-v2__email kt-link">' +
									data.companyname + '</a>\
								</div>\
							</div>';
						}
						else {
							var stateNo = KTUtil.getRandomInt(0, 7);
							var states = [
								'success',
								'brand',
								'danger',
								'success',
								'warning',
								'dark',
								'primary',
								'info'];
							var state = states[stateNo];

							output = '<div class="kt-user-card-v2">\
								<div class="kt-user-card-v2__pic">\
									<div class="kt-badge kt-badge--xl kt-badge--' + state + '">' + data.companyname.substring(0, 1) + '</div>\
								</div>\
								<div class="kt-user-card-v2__details">\
									<span class="kt-user-card-v2__name">' + data.companyname + '</span>\
									<a href="#" class="kt-user-card-v2__email kt-link">' +
									data.companyname + '</a>\
								</div>\
							</div>';
						}

						return output;
					},
				}, {
            field: 'Actions',
            title: 'Actions',
            sortable: false,
            width: 110,
            overflow: 'visible',
            textAlign: 'left',
	        autoHide: false,
          template: function(row) {
            return '\
                  <a href="'+DIR_VIEW+DIR_ADMN+'details_stores.php?storeId=' + row.usercompanyId + '" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details">\
                      <i class="flaticon-eye"></i>\
                  </a>\
                  <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete">\
                      <i class="flaticon2-delete"></i>\
                  </a>\
              ';
          },
        }],
    };

    // basic demo
    var localSelectorDemo = function() {

        options.search = {
            input: $('#generalSearch'),
        };

        var datatable = $('#local_record_selection').KTDatatable(options);

        $('#kt_form_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'active');
        });
        $('#kt_form_login').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'login');
        });

        $('#kt_form_type').on('change', function() {
          switch ($('#kt_form_type').val()) {
            case "1":
              datatable.search("1", 'is_buyer');
              datatable.search("0", 'is_seller');
              break;
            case "2":
              datatable.search("1", 'is_seller');
              break;
            default:
            datatable.search("", 'is_buyer');
            datatable.search("", 'is_seller');
          }
        });

        $('#kt_form_status,#kt_form_type,#kt_form_login').selectpicker();

        datatable.on(
            'kt-datatable--on-check kt-datatable--on-uncheck kt-datatable--on-layout-updated',
            function(e) {
                var checkedNodes = datatable.rows('.kt-datatable__row--active').nodes();
                var count = checkedNodes.length;
                $('#kt_datatable_selected_number').html(count);
                if (count > 0) {
                    $('#kt_datatable_group_action_form').collapse('show');
                } else {
                    $('#kt_datatable_group_action_form').collapse('hide');
                }
            });

        $('#kt_modal_fetch_id').on('show.bs.modal', function(e) {
            var ids = datatable.rows('.kt-datatable__row--active').
            nodes().
            find('.kt-checkbox--single > [type="checkbox"]').
            map(function(i, chk) {
                return $(chk).val();
            });
            var c = document.createDocumentFragment();
            for (var i = 0; i < ids.length; i++) {
                var li = document.createElement('li');
                li.setAttribute('data-id', ids[i]);
                li.innerHTML = 'Selected record ID: ' + ids[i];
                c.appendChild(li);
            }
            $(e.target).find('.kt-datatable_selected_ids').append(c);
        }).on('hide.bs.modal', function(e) {
            $(e.target).find('.kt-datatable_selected_ids').empty();
        });

    };

    return {
        // public functions
        init: function() {
            localSelectorDemo();
        },
    };
}();

jQuery(document).ready(function() {
    KTDatatableRecordSelectionDemo.init();
});
