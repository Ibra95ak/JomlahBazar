<?php 
//Get address class
require_once 'libraries/Ser_Addresses.php';
$db = new Ser_Addresses();
$err=-1;

if(isset($_GET['addressId'])) $addressId=$_GET['addressId'];
else $addressId=0;

if($addressId>0){
    //Edit address
    $get_address=$db->GetAddressById($addressId);
    if($get_address){
     $ipaddress=$get_address['ipaddress'];
     $address1=$get_address['address1'];
     $address2=$get_address['address2'];
     $city=$get_address['city'];
     $state=$get_address['state'];
     $postalcode=$get_address['postalcode'];
     $country=$get_address['country'];
     $latitude=$get_address['latitude'];
     $longitude=$get_address['longitude'];
    }else{
        $ipaddress='';
        $address1='';
        $address2='';
        $city='';
        $state='';
        $postalcode='';
        $country='';
        $latitude='';
        $longitude='';
    }
}
include('header.php');
?>
<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                3 Columns Form Layout
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right">
        <div class="kt-portlet__body">
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>ipaddress:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="ipaddress" id="ipaddress"
                            value="<?php if(isset($ipaddress)) echo $ipaddress;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your ipaddress</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Address1:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="address1" id="address1"
                            value="<?php if(isset($address1)) echo $address1;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your address1</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>address2:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="address2" id="address2"
                            value="<?php if(isset($address2)) echo $address2;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your address2</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>city:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="city" id="city"
                            value="<?php if(isset($city)) echo $city;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your city</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>state:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="state" id="state"
                            value="<?php if(isset($state)) echo $state;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your state</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>postalcode:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="postalcode" id="postalcode"
                            value="<?php if(isset($postalcode)) echo $postalcode;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your postalcode</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>country:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="country" id="country"
                            value="<?php if(isset($country)) echo $country;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your country</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>latitude:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="latitude" id="latitude"
                            value="<?php if(isset($latitude)) echo $latitude;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your latitude</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>longitude:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="" name="longitude" id="longitude"
                            value="<?php if(isset($longitude)) echo $longitude;else echo '';?>">
                    </div>
                    <span class="form-text text-muted">Please enter your longitude</span>
                </div>
            </div>
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-8">
                        <button type="reset" class="btn btn-primary" id="btn_submit">Submit</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>

<!--end::Portlet-->
<!--show/hide edit form inputs-->
<script>
var url_string = window.location.href
var url = new URL(url_string);
var addressId = url.searchParams.get("addressId");
</script>
<?php include("footer.php");?>
<script>
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var ipaddress = $("#ipaddress").val();
    var address1 = $("#address1").val();
    var address2 = $("#address2").val();
    var city = $("#city").val();
    var state = $("#state").val();
    var postalcode = $("#postalcode").val();
    var country = $("#country").val();
    var latitude = $("#latitude").val();
    var longitude = $("#longitude").val();
    form.validate({
        rules: {
            ipaddress: {
                required: true
            },
            address1: {
                required: true
            },
            address2: {
                required: true
            },
            city: {
                required: true
            },
            state: {
                required: true
            },
            postalcode: {
                required: true
            },
            country: {
                required: true
            },
            latitude: {
                required: true
            },
            longitude: {
                required: true
            },
        }
    });

    if (!form.valid()) {
        return;
    }

    btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
    $.ajax({
        type: "POST",
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/cu/cu_address.php",
        dataType: "json",
        data: {
            addressId: addressId,
            ipaddress: ipaddress,
            address1: address1,
            address2: address2,
            city: city,
            state: state,
            postalcode: postalcode,
            country: country,
            latitude: latitude,
            longitude: longitude
        },
        success: function(data) {
            switch (data) {
                case 0:
                    // similate 2s delay
                    setTimeout(function() {
                        btn.removeClass(
                            'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
                        ).attr('disabled', false);
                        // Simulate an HTTP redirect:
                        window.location.replace(
                            "http://localhost/JomlahBazar/AdminPanel/por_addresses.php"
                        );
                    }, 2000);
                    break;
                case 1:
                    // similate 2s delay
                    setTimeout(function() {
                        btn.removeClass(
                            'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
                        ).attr('disabled', false);
                        showErrorMsg(form, 'danger',
                            'Incorrect username or password. Please try again.');
                    }, 2000);
                    break;
                case 2:
                    // similate 2s delay
                    setTimeout(function() {
                        btn.removeClass(
                            'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
                        ).attr('disabled', false);
                        showErrorMsg(form, 'danger',
                            'Missing required parameters. Please try again.');
                    }, 2000);
                    break;
                default:

            }
        }
    });
});
</script>
</body>
<!-- end::Body -->

</html>