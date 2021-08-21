<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
use Vectorface\Whip\Whip;
$client = new GuzzleHttp\Client();
$whip = new Whip();
if (isset($_SESSION['userId'])) {
  $res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
  $usr = json_decode($res_uid->getBody());
  $roleId = $usr->roleId;
  $userId = $usr->userId;
  switch ($_SESSION['Login_as']) {
    case 1:
      include("../" . DIR_CON . "header_buyer.php");
      break;
    case 2:
      include("../" . DIR_CON . "header_supplier.php");
      break;

    default:
      include("../" . DIR_CON . "header_buyer.php");
      break;
  }
} else {
  header("location:".DIR_VIEW.DIR_USR."login.php");
}/*Get page header*/
if (isset($_GET['addressId'])) $addressId = $_GET['addressId'];
else $addressId = 0;
$res_user = $client->request('GET', DIR_CONT . DIR_USR . 'CON_seller_profile.php?action=get&userId=' . $userId);/*fetch user info*/
$user = json_decode($res_user->getBody());
if($addressId!=0){
  $res_editaddress = $client->request('GET', DIR_CONT . DIR_ADRS . 'CON_addresses.php?action=get&userId='.$userId.'&addressId='.$addressId);
  $editaddress = json_decode($res_editaddress->getBody());
  if ($editaddress->useraddress) {
    $addresstitle = $editaddress->useraddress[0]->addresstitle;
    $address_type = $editaddress->useraddress[0]->address_type;
    $ipaddress = $editaddress->useraddress[0]->ipaddress;
    $address1 = $editaddress->useraddress[0]->address1;
    $address2 = $editaddress->useraddress[0]->address2;
    $city = $editaddress->useraddress[0]->city;
    $postalcode = $editaddress->useraddress[0]->postalcode;
    $country = $editaddress->useraddress[0]->country;
    $state = $editaddress->useraddress[0]->state;
    $latitude = $editaddress->useraddress[0]->latitude;
    $longitude = $editaddress->useraddress[0]->longitude;
    $language = $editaddress->useraddress[0]->language;
    $default = $editaddress->useraddress[0]->default_address;
  } else {
    $addresstitle = '';
    $address_type = '';
    $ipaddress ='';
    $address1 = '';
    $address2 = '';
    $city = '';
    $postalcode = '';
    $country = '';
    $state = '';
    $latitude = '';
    $longitude = '';
    $language = '';
    $default = 2;
  }
}else{
  $ipaddress = $whip->getValidIpAddress();
  $addresstitle = '';
  $address_type = '';
  $address1 = '';
  $address2 = '';
  $city = '';
  $postalcode = '';
  $country = '';
  $state = '';
  $latitude = '';
  $longitude = '';
  $language = '';
  $default = 2;
}
$res_omanareas = $client->request('GET', DIR_CONT . DIR_ADRS . 'CON_locationsDropdown.php?action=getomanareas');/*fetch user info*/
$omanareas = json_decode($res_omanareas->getBody());
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <!--Begin::Dashboard 3-->
  <div class="row safari-row-flex">
    <div class="col-md-6">
      <div class="kt-portlet">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              My Addresses
            </h3>
          </div>
        </div>
        <div class="kt-portlet__body">
          <div class="kt-section kt-section--first">
            <table class="table table-light table-responsive">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Type</th>
                  <th>Address</th>
                  <th>City</th>
                  <th>Country</th>
                  <th>Postalcode</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (is_array($user->addresses) || is_object($user->addresses)) {
                  foreach ($user->addresses as $address) {
                    switch ($address->address_type) {
                      case '1':
                        $type = "Home";
                        break;
                      case '2':
                        $type = "Office";
                        break;
                      case '3':
                        $type = "Cargo";
                        break;
                      default:
                        $type = "Home";
                        break;
                    }
                    echo '<tr>';
                    echo '<td>' . $address->addresstitle . '</td>';
                    echo '<td>' . $type . '</td>';
                    echo '<td>' . $address->address1 . '</td>';
                    echo '<td>' . $address->city . '</td>';
                    echo '<td>' . $address->country . '</td>';
                    echo '<td>' . $address->postalcode . '</td>';
                    echo '<td><div class="btn-group" role="group" aria-label="First group">
			<button type="button" class="btn btn-warning" onclick="editaddress('.$address->addressId.')"><i class="la la-edit"></i></button>
			<button type="button" class="btn btn-danger" onclick="deleteaddress(' . $address->addressId . ')"><i class="la la-trash"></i></button>
			</div></td>';
                    echo '</tr>';
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="kt-portlet">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Manage Addresses
            </h3>
          </div>
        </div>

        <!--begin::Form-->
        <form class="kt-form" id="jbform">
          <input type="hidden" name="userId" id="userId" value="<?php echo $userId ?>">
          <input type="hidden" name="addressId" id="addressId" value="<?php echo $addressId ?>">
          <div class="kt-portlet__body kt-font-dark">
            <div class="kt-section kt-section--first kt-m0">
              <div class="row safari-row-flex">
                <div class="col-xl-6">
                  <div class="form-group">
                    <input type="text" class="form-control" name="addresstitle" id="addresstitle" placeholder="Company/Person Name" value="<?php echo $addresstitle; ?>">
                    <span class="form-text text-muted">Please enter the name of Company/Person you are purchasing for.</span>
                  </div>
                </div>
                <div class="col-xl-6">
                  <div class="form-group">
                    <select class="form-control" name="address_type" id="address_type">
                      <option value="1" <?php if($address_type==1) echo "selected";?>>Home</option>
                      <option value="2" <?php if($address_type==2) echo "selected";?>>Office</option>
                      <option value="3" <?php if($address_type==3) echo "selected";?>>Cargo</option>
                    </select>
                    <span class="form-text text-muted">Please enter your Address.</span>
                  </div>
                </div>
              </div>
              <div class="row safari-row-flex">
                <div class="col-xl-6">
                  <div class="form-group">
                    <input type="text" class="form-control" name="address1" id="address1" placeholder="Address Line 1" value="<?php echo $address1; ?>" maxlength="35">
                    <span class="form-text text-muted">Please enter your Address.</span>
                  </div>
                </div>
                <div class="col-xl-6">
                  <div class="form-group">
                    <input type="text" class="form-control" name="address2" id="address2" placeholder="Address Line 2" value="<?php echo $address2; ?>" maxlength="35">
                    <span class="form-text text-muted">Please enter your Address.</span>
                  </div>
                </div>
              </div>
              <div class="row safari-row-flex">
                <div class="col-xl-6">
                  <div class="form-group">
                    <input type="text" class="form-control" name="postalcode" id="postalcode" placeholder="Postalcode" value="<?php echo $postalcode; ?>">
                    <span class="form-text text-muted">Please enter your Postalcode.</span>
                  </div>
                </div>
                <div class="col-xl-6">
                  <div class="form-group">
                    <input type="text" class="form-control" name="city" id="city" placeholder="City" value="<?php echo $city; ?>">
                    <span class="form-text text-muted">Please enter your City.</span>
                  </div>
                </div>
              </div>
              <div class="row safari-row-flex">
                <div class="col-xl-6">
                  <div class="form-group">
                    <select name="country" id="country" class="form-control">
                      <option value="">Select</option>
                      <option value="AF">Afghanistan</option>
                      <option value="AX">Åland Islands</option>
                      <option value="AL">Albania</option>
                      <option value="DZ">Algeria</option>
                      <option value="AS">American Samoa</option>
                      <option value="AD">Andorra</option>
                      <option value="AO">Angola</option>
                      <option value="AI">Anguilla</option>
                      <option value="AQ">Antarctica</option>
                      <option value="AG">Antigua and Barbuda</option>
                      <option value="AR">Argentina</option>
                      <option value="AM">Armenia</option>
                      <option value="AW">Aruba</option>
                      <option value="AU" selected="">Australia</option>
                      <option value="AT">Austria</option>
                      <option value="AZ">Azerbaijan</option>
                      <option value="BS">Bahamas</option>
                      <option value="BH">Bahrain</option>
                      <option value="BD">Bangladesh</option>
                      <option value="BB">Barbados</option>
                      <option value="BY">Belarus</option>
                      <option value="BE">Belgium</option>
                      <option value="BZ">Belize</option>
                      <option value="BJ">Benin</option>
                      <option value="BM">Bermuda</option>
                      <option value="BT">Bhutan</option>
                      <option value="BO">Bolivia, Plurinational State of</option>
                      <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                      <option value="BA">Bosnia and Herzegovina</option>
                      <option value="BW">Botswana</option>
                      <option value="BV">Bouvet Island</option>
                      <option value="BR">Brazil</option>
                      <option value="IO">British Indian Ocean Territory</option>
                      <option value="BN">Brunei Darussalam</option>
                      <option value="BG">Bulgaria</option>
                      <option value="BF">Burkina Faso</option>
                      <option value="BI">Burundi</option>
                      <option value="KH">Cambodia</option>
                      <option value="CM">Cameroon</option>
                      <option value="CA">Canada</option>
                      <option value="CV">Cape Verde</option>
                      <option value="KY">Cayman Islands</option>
                      <option value="CF">Central African Republic</option>
                      <option value="TD">Chad</option>
                      <option value="CL">Chile</option>
                      <option value="CN">China</option>
                      <option value="CX">Christmas Island</option>
                      <option value="CC">Cocos (Keeling) Islands</option>
                      <option value="CO">Colombia</option>
                      <option value="KM">Comoros</option>
                      <option value="CG">Congo</option>
                      <option value="CD">Congo, the Democratic Republic of the</option>
                      <option value="CK">Cook Islands</option>
                      <option value="CR">Costa Rica</option>
                      <option value="CI">Côte d'Ivoire</option>
                      <option value="HR">Croatia</option>
                      <option value="CU">Cuba</option>
                      <option value="CW">Curaçao</option>
                      <option value="CY">Cyprus</option>
                      <option value="CZ">Czech Republic</option>
                      <option value="DK">Denmark</option>
                      <option value="DJ">Djibouti</option>
                      <option value="DM">Dominica</option>
                      <option value="DO">Dominican Republic</option>
                      <option value="EC">Ecuador</option>
                      <option value="EG">Egypt</option>
                      <option value="SV">El Salvador</option>
                      <option value="GQ">Equatorial Guinea</option>
                      <option value="ER">Eritrea</option>
                      <option value="EE">Estonia</option>
                      <option value="ET">Ethiopia</option>
                      <option value="FK">Falkland Islands (Malvinas)</option>
                      <option value="FO">Faroe Islands</option>
                      <option value="FJ">Fiji</option>
                      <option value="FI">Finland</option>
                      <option value="FR">France</option>
                      <option value="GF">French Guiana</option>
                      <option value="PF">French Polynesia</option>
                      <option value="TF">French Southern Territories</option>
                      <option value="GA">Gabon</option>
                      <option value="GM">Gambia</option>
                      <option value="GE">Georgia</option>
                      <option value="DE">Germany</option>
                      <option value="GH">Ghana</option>
                      <option value="GI">Gibraltar</option>
                      <option value="GR">Greece</option>
                      <option value="GL">Greenland</option>
                      <option value="GD">Grenada</option>
                      <option value="GP">Guadeloupe</option>
                      <option value="GU">Guam</option>
                      <option value="GT">Guatemala</option>
                      <option value="GG">Guernsey</option>
                      <option value="GN">Guinea</option>
                      <option value="GW">Guinea-Bissau</option>
                      <option value="GY">Guyana</option>
                      <option value="HT">Haiti</option>
                      <option value="HM">Heard Island and McDonald Islands</option>
                      <option value="VA">Holy See (Vatican City State)</option>
                      <option value="HN">Honduras</option>
                      <option value="HK">Hong Kong</option>
                      <option value="HU">Hungary</option>
                      <option value="IS">Iceland</option>
                      <option value="IN">India</option>
                      <option value="ID">Indonesia</option>
                      <option value="IR">Iran, Islamic Republic of</option>
                      <option value="IQ">Iraq</option>
                      <option value="IE">Ireland</option>
                      <option value="IM">Isle of Man</option>
                      <option value="IL">Israel</option>
                      <option value="IT">Italy</option>
                      <option value="JM">Jamaica</option>
                      <option value="JP">Japan</option>
                      <option value="JE">Jersey</option>
                      <option value="JO">Jordan</option>
                      <option value="KZ">Kazakhstan</option>
                      <option value="KE">Kenya</option>
                      <option value="KI">Kiribati</option>
                      <option value="KP">Korea, Democratic People's Republic of</option>
                      <option value="KR">Korea, Republic of</option>
                      <option value="KW">Kuwait</option>
                      <option value="KG">Kyrgyzstan</option>
                      <option value="LA">Lao People's Democratic Republic</option>
                      <option value="LV">Latvia</option>
                      <option value="LB">Lebanon</option>
                      <option value="LS">Lesotho</option>
                      <option value="LR">Liberia</option>
                      <option value="LY">Libya</option>
                      <option value="LI">Liechtenstein</option>
                      <option value="LT">Lithuania</option>
                      <option value="LU">Luxembourg</option>
                      <option value="MO">Macao</option>
                      <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                      <option value="MG">Madagascar</option>
                      <option value="MW">Malawi</option>
                      <option value="MY">Malaysia</option>
                      <option value="MV">Maldives</option>
                      <option value="ML">Mali</option>
                      <option value="MT">Malta</option>
                      <option value="MH">Marshall Islands</option>
                      <option value="MQ">Martinique</option>
                      <option value="MR">Mauritania</option>
                      <option value="MU">Mauritius</option>
                      <option value="YT">Mayotte</option>
                      <option value="MX">Mexico</option>
                      <option value="FM">Micronesia, Federated States of</option>
                      <option value="MD">Moldova, Republic of</option>
                      <option value="MC">Monaco</option>
                      <option value="MN">Mongolia</option>
                      <option value="ME">Montenegro</option>
                      <option value="MS">Montserrat</option>
                      <option value="MA">Morocco</option>
                      <option value="MZ">Mozambique</option>
                      <option value="MM">Myanmar</option>
                      <option value="NA">Namibia</option>
                      <option value="NR">Nauru</option>
                      <option value="NP">Nepal</option>
                      <option value="NL">Netherlands</option>
                      <option value="NC">New Caledonia</option>
                      <option value="NZ">New Zealand</option>
                      <option value="NI">Nicaragua</option>
                      <option value="NE">Niger</option>
                      <option value="NG">Nigeria</option>
                      <option value="NU">Niue</option>
                      <option value="NF">Norfolk Island</option>
                      <option value="MP">Northern Mariana Islands</option>
                      <option value="NO">Norway</option>
                      <option value="OM">Oman</option>
                      <option value="PK">Pakistan</option>
                      <option value="PW">Palau</option>
                      <option value="PS">Palestinian Territory, Occupied</option>
                      <option value="PA">Panama</option>
                      <option value="PG">Papua New Guinea</option>
                      <option value="PY">Paraguay</option>
                      <option value="PE">Peru</option>
                      <option value="PH">Philippines</option>
                      <option value="PN">Pitcairn</option>
                      <option value="PL">Poland</option>
                      <option value="PT">Portugal</option>
                      <option value="PR">Puerto Rico</option>
                      <option value="QA">Qatar</option>
                      <option value="RE">Réunion</option>
                      <option value="RO">Romania</option>
                      <option value="RU">Russian Federation</option>
                      <option value="RW">Rwanda</option>
                      <option value="BL">Saint Barthélemy</option>
                      <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                      <option value="KN">Saint Kitts and Nevis</option>
                      <option value="LC">Saint Lucia</option>
                      <option value="MF">Saint Martin (French part)</option>
                      <option value="PM">Saint Pierre and Miquelon</option>
                      <option value="VC">Saint Vincent and the Grenadines</option>
                      <option value="WS">Samoa</option>
                      <option value="SM">San Marino</option>
                      <option value="ST">Sao Tome and Principe</option>
                      <option value="SA">Saudi Arabia</option>
                      <option value="SN">Senegal</option>
                      <option value="RS">Serbia</option>
                      <option value="SC">Seychelles</option>
                      <option value="SL">Sierra Leone</option>
                      <option value="SG">Singapore</option>
                      <option value="SX">Sint Maarten (Dutch part)</option>
                      <option value="SK">Slovakia</option>
                      <option value="SI">Slovenia</option>
                      <option value="SB">Solomon Islands</option>
                      <option value="SO">Somalia</option>
                      <option value="ZA">South Africa</option>
                      <option value="GS">South Georgia and the South Sandwich Islands</option>
                      <option value="SS">South Sudan</option>
                      <option value="ES">Spain</option>
                      <option value="LK">Sri Lanka</option>
                      <option value="SD">Sudan</option>
                      <option value="SR">Suriname</option>
                      <option value="SJ">Svalbard and Jan Mayen</option>
                      <option value="SZ">Swaziland</option>
                      <option value="SE">Sweden</option>
                      <option value="CH">Switzerland</option>
                      <option value="SY">Syrian Arab Republic</option>
                      <option value="TW">Taiwan, Province of China</option>
                      <option value="TJ">Tajikistan</option>
                      <option value="TZ">Tanzania, United Republic of</option>
                      <option value="TH">Thailand</option>
                      <option value="TL">Timor-Leste</option>
                      <option value="TG">Togo</option>
                      <option value="TK">Tokelau</option>
                      <option value="TO">Tonga</option>
                      <option value="TT">Trinidad and Tobago</option>
                      <option value="TN">Tunisia</option>
                      <option value="TR">Turkey</option>
                      <option value="TM">Turkmenistan</option>
                      <option value="TC">Turks and Caicos Islands</option>
                      <option value="TV">Tuvalu</option>
                      <option value="UG">Uganda</option>
                      <option value="UA">Ukraine</option>
                      <option value="AE">United Arab Emirates</option>
                      <option value="GB">United Kingdom</option>
                      <option value="US">United States</option>
                      <option value="UM">United States Minor Outlying Islands</option>
                      <option value="UY">Uruguay</option>
                      <option value="UZ">Uzbekistan</option>
                      <option value="VU">Vanuatu</option>
                      <option value="VE">Venezuela, Bolivarian Republic of</option>
                      <option value="VN">Viet Nam</option>
                      <option value="VG">Virgin Islands, British</option>
                      <option value="VI">Virgin Islands, U.S.</option>
                      <option value="WF">Wallis and Futuna</option>
                      <option value="EH">Western Sahara</option>
                      <option value="YE">Yemen</option>
                      <option value="ZM">Zambia</option>
                      <option value="ZW">Zimbabwe</option>
                    </select>
                  </div>
                </div>
                <div class="col-xl-6">
                  <select name="state" id="state" class="form-control" style="display:none;">
                    <option value="">Choose Area</option>
                    <?php
                      foreach ($omanareas->states as $area) {
                        echo '<option value="'.$area->area.'">'.$area->area.'</option>';
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="row safari-row-flex">
                <div class="col-xl-5">
                  <div class="form-group">
                    <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" value="<?php echo $latitude; ?>">
                    <span class="form-text text-muted">Please enter latitude.</span>
                  </div>
                </div>
                <div class="col-xl-5">
                  <div class="form-group">
                    <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="<?php echo $longitude; ?>">
                    <span class="form-text text-muted">Please enter longitude.</span>
                  </div>
                </div>
                <div class="col-xl-2">
                  <div class="form-group">
                    <button type="button" class="btn btn-brand btn-icon"><i class="fa fa-tag" onclick="getLocation()"></i></button>
                    <span class="form-text text-muted">Get current location.</span>
                  </div>
                </div>
                <div class="col-xl-6 kt-hidden">
                  <div class="form-group">
                    <input type="hidden" class="form-control" name="ipaddress" id="ipaddress" placeholder="Ip address" value="<?php echo $ipaddress; ?>" readonly>
                    <span class="form-text text-muted">Your logged in Ipaddress.</span>
                  </div>
                </div>
              </div>
              <div class="row safari-row-flex">
                <div class="col-xl-6 kt-hidden">
                  <div class="form-group">
                    <input type="hidden" class="form-control" name="language" id="language" placeholder="language" value="english">
                    <span class="form-text text-muted">Please enter your Language.</span>
                  </div>
                </div>
                <div class="col-xl-6">
                  <div class="form-group">
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                      <input type="checkbox" id="default" name="default" <?php if($default==1) echo "checked";?>> Default Address
                      <span></span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="kt-portlet__foot">
            <div class="kt-form__actions">
              <button type="submit" class="btn btn-warning" id="btn_submit">Submit</button>
              <button type="button" class="btn btn-secondary" onclick="javascript:location.replace(window.location.pathname)">Cancel</button>
            </div>
          </div>
        </form>

        <!--end::Form-->
      </div>
    </div>
  </div>
  <!--End::Dashboard 3-->
</div>

<!-- end:: Content -->
</div>
<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
<script>
$(document).ready(function(){
  var addressId = getUrlParameter('addressId');
  if (addressId) $("#country").val("<?php echo $country?>");
  if ($("#country").val()=="OM") {
    $("#state").val("<?php echo $state?>");
    $("#state").show();
  }else{
    $("#state").val("");
    $("#state").hide();
  }
});
  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    } else {
      alert("Geolocation is not supported by this browser.");
    }
  }
  function showPosition(position) {
    document.getElementById('latitude').value = position.coords.latitude;
    document.getElementById('longitude').value = position.coords.longitude;
  }
  $('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var formdata1 = new FormData($('#jbform')[0]);
    form.validate({
      rules: {
        addresstitle: {
          required: true
        },
        address_type: {
          required: true
        },
        address1: {
          required: true
        },
        postalcode: {
          required: true
        },
        city: {
          required: true,
        },
        country: {
          required: true,
        }
      }
    });

    if (!form.valid()) {
      return;
    }
    btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
    $.ajax({
      type: "POST",
      url: DIR_CONT+DIR_USR+"CON_seller_profile.php?action=post-address",
      cache: false,
      contentType: false,
      processData: false,
      data: formdata1,
      dataType: "json",
      success: function(data) {
        switch (data['err']) {
          case 0:
            // similate 2s delay
            setTimeout(function() {
              btn.removeClass(
                'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
              ).attr('disabled', false);
              //Simulate an HTTP redirect:
              window.location.replace(
                DIR_VIEW+DIR_USR+"form_useraddress.php"
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
  function editaddress(addressId) {
    location.href = DIR_VIEW+DIR_USR+"form_useraddress.php?addressId="+addressId;
  }
  function deleteaddress(addressId) {
    location.href = DIR_CONT+DIR_ADRS+"CON_addresses.php?action=delete&addressId="+addressId+"&userId="+<?php echo $userId;?>;
  }
  $("#country").change(function(){
    if(this.value=="OM") $("#state").show();
    else{
      $("#state").hide();
      $("#state").val("");
    }
  });
</script>
