<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$url_lgn = DIR_VIEW . DIR_USR . "login.php";
?>
<div id="kt_scrolltop" class="kt-scrolltop">
	<i class="fa fa-arrow-up"></i>
</div>
<div id="cookies_alert" class="alert alert-dark fade show kt-m0" role="alert" style="position: fixed;bottom: 0;width: 100%;z-index: 1;display:none;">
														<div class="alert-text">This website uses cookies to personalize content and analyse traffic in order to offer you a better experience.<a href="<?php echo DIR_VIEW . DIR_CON . "privacypolicy.php" ?>" class="kt-link kt-font-bolder">Data Privacy and Cookie policy.</a></div>
														<div class="alert-close">
															<button id="cookies_acpt" type="button" class="btn btn-warning">Continue</button>&nbsp;
														</div>
													</div>
<div id="kt_backtotop" class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop kt-mt-50">
<span class="kt-font-light text-center" style="margin:auto;margin-top: -6px;">Back to top</span><br>
</div>
<!-- begin:: Footer -->
<div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop safari-row-desktop-block" id="kt_footer">
  <div class="kt-container  kt-container--fluid ">
      <div class="col-md-2">
				<a href="<?php echo DIR_VIEW.DIR_PRO."marketplace.php?ftbs=1";?>"><img src="assets/media/logos/jb-logo-white-footer.png" alt="JB LOGO"></a>
			</div>
      <div class="col-md-2">
        <p><span class="kt-font-md kt-font-light">Get to Know Us</span></p>
        <p><a href="<?php echo DIR_VIEW.DIR_CON."about.php";?>" class="kt-link text-muted">About Us</a></p>
        <p><a href="http://magazine.jomlahbazar.com/" class="kt-link text-muted">JomlahBazar Magazine</a></p>
        <p><a href="javascript:void()" class="kt-link text-muted kt-hidden">Careers</a></p>
      </div>
      <div class="col-md-2">
        <p><span class="kt-font-md kt-font-light">Shop with Us</span></p>
        <p><a href="<?php echo $url_lgn;?>" class="kt-link text-muted">Your Account</a></p>
        <p><a href="<?php echo $url_lgn;?>" class="kt-link text-muted">Your Orders</a></p>
        <p><a href="<?php echo $url_lgn;?>" class="kt-link text-muted">Your Addresses</a></p>
        <p><a href="<?php echo $url_lgn;?>" class="kt-link text-muted">Your Wishlists</a></p>
      </div>
      <div class="col-md-2">
        <p><span class="kt-font-md kt-font-light">Make Money With Us</span></p>
        <p><a href="<?php echo DIR_VIEW.DIR_USR."login.php?type=seller"?>" class="kt-link text-muted">Sell on JomlahBazar</a></p>
				<p><span class="text-muted kt-mr-5">24x7 Support</span><a href="https://wa.me/971545277180" data-container="body" data-toggle="kt-tooltip" data-placement="bottom" title="" data-original-title="Sellers Customer Support"><i class="flaticon-whatsapp kt-font-warning kt-font-md"></i></a>
				<a href="https://wa.me/971508501162" data-container="body" data-toggle="kt-tooltip" data-placement="bottom" title="" data-original-title="Buyers Customer Support"><i class="flaticon-whatsapp kt-font-success kt-font-md"></i></a></p>

        <!-- <p><a href="https://wa.me/971545277180" class="kt-link text-muted" target="_blank">24x7 Support</a></p> -->
      </div>
      <div class="col-md-2">
        <p><span class="kt-font-md kt-font-light">Let Us Help You</span></p>
        <p><a href="<?php echo DIR_VIEW.DIR_CON."supportcenter.php";?>" class="kt-link text-muted">Help</a></p>
        <p><a href="<?php echo DIR_VIEW . DIR_CON . "Conditions_of_use.php" ?>" class="kt-link text-muted">Terms & Conditions</a></p>
        <p><a href="<?php echo DIR_VIEW . DIR_CON . "delivery.php" ?>" class="kt-link text-muted">Shipping & Delivery</a></p>
        <p><a href="<?php echo DIR_VIEW . DIR_CON . "Returns.php" ?>" class="kt-link text-muted">Returns & Refund Policy</a></p>
        <p><a href="<?php echo DIR_VIEW . DIR_CON . "privacypolicy.php" ?>" class="kt-link text-muted">Privacy Policy</a></p>
        <p><a href="https://play.google.com/store/apps/details?id=com.Pomechain.jomlahbazar" class="kt-link text-muted" target="_blank">Jomlah Bazar App Download</a></p>
      </div>
  </div>
	<hr style="border-top: 1px solid #3a4553;">
	<div class="row kt-pt10 kt-pb-10">
		<div class="col-md-12">
			<div class="alert alert-outline-light fade show kt-p0 div-center" style="width: 150px;">
				<div class="alert-text kt-font-sm"><img src="assets/media/icons/uae.webp" alt="uae flag" width='25'>United Arab Emirates</div>
			</div>
		</div>
	</div>
	<div class="row text-center">
		<div class="col-md-12">
			<span class="kt-font-md kt-font-light">Follow Us On: </span>
			<a href="https://www.facebook.com/JomlahBazarPage/" class="btn btn-icon btn-circle btn-label-light" target="_blank">
			<i class="fab fa-facebook contact_icon"></i></a>
			<a href="https://www.instagram.com/jomlahbazar/" class="btn btn-icon btn-circle btn-label-light" target="_blank">
			<i class="fab fa-instagram contact_icon"></i></a>
			<a href="https://www.linkedin.com/showcase/jomlahbazar" class="btn btn-icon btn-circle btn-label-light contact_icon" target="_blank"><i class="fab fa-linkedin"></i></a>
			<a href="https://www.youtube.com/channel/UC6yAF6ATHlGn_npDA5jH7-g" class="btn btn-icon btn-circle btn-label-light contact_icon" target="_blank"><i class="fab fa-youtube"></i></a>
		</div>
	</div>
</div>
<div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" style="background-color:#131A22;">
	<div class="row div-center">
		<a href="<?php echo DIR_VIEW . DIR_CON . "Conditions_of_use.php" ?>" class="kt-footer__menu-link kt-link kt-font-light">Conditions of Use & Sale</a>&nbsp;&nbsp;
		<a href="<?php echo DIR_VIEW . DIR_CON . "privacypolicy.php" ?>" class="kt-footer__menu-link kt-link kt-font-light">Privacy Notice</a>&nbsp;&nbsp;
		<span class="kt-font-light">© 2020-2021, JomlahBazar.com, Inc. or its affiliates</span>
	</div>
</div>
<!-- end:: Footer -->
</div>
</div>
</div>

<!-- end:: Page -->

<!-- begin::Sticky Toolbar -->
<!-- <ul class="kt-sticky-toolbar" style="margin-top: 200px;">
<li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--success" id="kt_sticky_toolbar_chat_toggler" >
<a href="https://wa.me/971545277180"><i class="flaticon-whatsapp"></i></a>
</li>
</ul> -->
<!-- end::Sticky Toolbar -->
<!--Begin:: Chat-->
<div class="modal fade- modal-sticky-bottom-right" id="kt_chat_modal" role="dialog" data-backdrop="false">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="kt-chat">
  <div class="kt-portlet kt-portlet--last">
    <div class="kt-portlet__head">
      <div class="kt-chat__head ">
        <div class="kt-chat__left">
          <div class="kt-chat__label">
            <a href="#" class="kt-chat__title">Jason Muller</a>
            <span class="kt-chat__status">
              <span class="kt-badge kt-badge--dot kt-badge--success"></span> Active
            </span>
          </div>
        </div>
        <div class="kt-chat__right">
          <div class="dropdown dropdown-inline">
            <button type="button" class="btn btn-clean btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="flaticon-more-1"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-md">

              <!--begin::Nav-->
              <ul class="kt-nav">
                <li class="kt-nav__head">
                  Messaging
                  <i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
                </li>
                <li class="kt-nav__separator"></li>
                <li class="kt-nav__item">
                  <a href="#" class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon2-group"></i>
                    <span class="kt-nav__link-text">New Group</span>
                  </a>
                </li>
                <li class="kt-nav__item">
                  <a href="#" class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon2-open-text-book"></i>
                    <span class="kt-nav__link-text">Contacts</span>
                    <span class="kt-nav__link-badge">
                      <span class="kt-badge kt-badge--brand  kt-badge--rounded-">5</span>
                    </span>
                  </a>
                </li>
                <li class="kt-nav__item">
                  <a href="#" class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon2-bell-2"></i>
                    <span class="kt-nav__link-text">Calls</span>
                  </a>
                </li>
                <li class="kt-nav__item">
                  <a href="#" class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon2-dashboard"></i>
                    <span class="kt-nav__link-text">Settings</span>
                  </a>
                </li>
                <li class="kt-nav__item">
                  <a href="#" class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon2-protected"></i>
                    <span class="kt-nav__link-text">Help</span>
                  </a>
                </li>
                <li class="kt-nav__separator"></li>
                <li class="kt-nav__foot">
                  <a class="btn btn-label-brand btn-bold btn-sm" href="#">Upgrade plan</a>
                  <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                </li>
              </ul>

              <!--end::Nav-->
            </div>
          </div>
          <button type="button" class="btn btn-clean btn-sm btn-icon" data-dismiss="modal">
            <i class="flaticon2-cross"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="kt-portlet__body">
      <div class="kt-scroll kt-scroll--pull" data-height="410" data-mobile-height="225">
        <div class="kt-chat__messages kt-chat__messages--solid">
          <div class="kt-chat__message kt-chat__message--success">
            <div class="kt-chat__user">
              <span class="kt-media kt-media--circle kt-media--sm">
                <img src="assets/media/users/default.jpg" alt="image">
              </span>
              <a href="#" class="kt-chat__username">Jason Muller</span></a>
              <span class="kt-chat__datetime">2 Hours</span>
            </div>
            <div class="kt-chat__text">
              How likely are you to recommend our company<br> to your friends and family?
            </div>
          </div>
          <div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">
            <div class="kt-chat__user">
              <span class="kt-chat__datetime">30 Seconds</span>
              <a href="#" class="kt-chat__username">You</span></a>
              <span class="kt-media kt-media--circle kt-media--sm">
                <img src="assets/media/users/default.jpg" alt="image">
              </span>
            </div>
            <div class="kt-chat__text">
              Hey there, we’re just writing to let you know that you’ve<br> been subscribed to a repository on GitHub.
            </div>
          </div>
          <div class="kt-chat__message kt-chat__message--success">
            <div class="kt-chat__user">
              <span class="kt-media kt-media--circle kt-media--sm">
                <img src="assets/media/users/default.jpg" alt="image">
              </span>
              <a href="#" class="kt-chat__username">Jason Muller</span></a>
              <span class="kt-chat__datetime">30 Seconds</span>
            </div>
            <div class="kt-chat__text">
              Ok, Understood!
            </div>
          </div>
          <div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">
            <div class="kt-chat__user">
              <span class="kt-chat__datetime">Just Now</span>
              <a href="#" class="kt-chat__username">You</span></a>
              <span class="kt-media kt-media--circle kt-media--sm">
                <img src="assets/media/users/default.jpg" alt="image">
              </span>
            </div>
            <div class="kt-chat__text">
              You’ll receive notifications for all issues, pull requests!
            </div>
          </div>
          <div class="kt-chat__message kt-chat__message--success">
            <div class="kt-chat__user">
              <span class="kt-media kt-media--circle kt-media--sm">
                <img src="assets/media/users/default.jpg" alt="image">
              </span>
              <a href="#" class="kt-chat__username">Jason Muller</span></a>
              <span class="kt-chat__datetime">2 Hours</span>
            </div>
            <div class="kt-chat__text">
              You were automatically <b class="kt-font-brand">subscribed</b> <br>because you’ve been given access to the repository
            </div>
          </div>
          <div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">
            <div class="kt-chat__user">
              <span class="kt-chat__datetime">30 Seconds</span>
              <a href="#" class="kt-chat__username">You</span></a>
              <span class="kt-media kt-media--circle kt-media--sm">
                <img src="assets/media/users/default.jpg" alt="image">
              </span>
            </div>
            <div class="kt-chat__text">
              You can unwatch this repository immediately <br>by clicking here: <a href="#" class="kt-font-bold kt-link"></a>
            </div>
          </div>
          <div class="kt-chat__message kt-chat__message--success">
            <div class="kt-chat__user">
              <span class="kt-media kt-media--circle kt-media--sm">
                <img src="assets/media/users/default.jpg" alt="image">
              </span>
              <a href="#" class="kt-chat__username">Jason Muller</span></a>
              <span class="kt-chat__datetime">30 Seconds</span>
            </div>
            <div class="kt-chat__text">
              Discover what students who viewed Learn <br>Figma - UI/UX Design Essential Training also viewed
            </div>
          </div>
          <div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">
            <div class="kt-chat__user">
              <span class="kt-chat__datetime">Just Now</span>
              <a href="#" class="kt-chat__username">You</span></a>
              <span class="kt-media kt-media--circle kt-media--sm">
                <img src="assets/media/users/default.jpg" alt="image">
              </span>
            </div>
            <div class="kt-chat__text">
              Most purchased Business courses during this sale!
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="kt-portlet__foot">
      <div class="kt-chat__input">
        <div class="kt-chat__editor">
          <textarea placeholder="Type here..." style="height: 50px"></textarea>
        </div>
        <div class="kt-chat__toolbar">
          <div class="kt_chat__tools">
            <a href="#"><i class="flaticon2-link"></i></a>
            <a href="#"><i class="flaticon2-photograph"></i></a>
            <a href="#"><i class="flaticon2-photo-camera"></i></a>
          </div>
          <div class="kt_chat__actions">
            <button type="button" class="btn btn-brand btn-md  btn-font-sm btn-upper btn-bold kt-chat__reply">reply</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<!--ENd:: Chat-->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
var KTAppOptions = {
"colors": {
"state": {
  "brand": "#2c77f4",
  "light": "#ffffff",
  "dark": "#282a3c",
  "primary": "#5867dd",
  "success": "#34bfa3",
  "info": "#36a3f7",
  "warning": "#ffb822",
  "danger": "#fd3995"
},
"base": {
  "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
  "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
}
}
};
</script>

<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="assets/js/pages/base.js" type="text/javascript"></script>
<script src="assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
<script src="assets/js/scripts.bundle.js" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<script src="//maps.google.com/maps/api/js?key=AIzaSyCVzo-5w2SxFAIeZ9xj586Q9OO6t4Hx6rE" type="text/javascript"></script>
<script src="assets/plugins/custom/gmaps/gmaps.js" type="text/javascript"></script>
<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="assets/js/pages/dashboard.js" type="text/javascript"></script>
<script src="assets/js/pages/components/extended/sweetalert2.js" type="text/javascript"></script>
<script src="assets/plugins/OwlCarousel/dist/owl.carousel.min.js"></script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-switch.js" type="text/javascript"></script>
<script type="text/javascript">
/*cookies*/
function setCookie(cname, cvalue) {
	$.ajax({
    url: DIR_CONT + DIR_CON + "CON_config.php?action=set-cookie",
		async: false,
    type: "post", //send it through get method
    data: {
      cookie_name: cname,
      cookie_value: cvalue
    },
    success: function(response) {
      console.log("cookie saved");
    },
    error: function(xhr) {
      console.log("err");
    }
  });
}
function getCookie(cname) {
	var cookie = "";
	$.ajax({
    url: DIR_CONT + DIR_CON + "CON_config.php?action=get-cookie",
		async: false,
    type: "post", //send it through get method
    data: {
      cookie_name: cname
    },
    success: function(response) {
      if(response=="NA") cookie = "";
			else cookie = response;
    },
    error: function(xhr) {
      cookie = "";
    }
  });
	return cookie;
}
$(document).ready(function(){
  var cookies = getCookie("cookiesads");
  if (cookies == "") {
    $("#cookies_alert").show();
  }
});
$("#cookies_acpt").on('click', function() {
  setCookie("cookiesads", 1);
  $("#cookies_alert").hide();
});
$('#reset_search').on('click', function() {
	$('#generalSearch').val('');
	$('#header_search_text').val('');
	$('#header_search_text_mobile').val('');
	$('#filter').click();
});
$("#kt_wrapper").on('click','.search-opt', function() {
  var search_option = $(this).data("id");
  var header_search_text = $("#header_search_text").val();
  $("#search-dropdown").html(search_option);

  switch (search_option) {
    case "Products":
      $("#search_maincat-dropdown").show();
      $("#search_role-dropdown").hide();
      $("#search_servicesrole-dropdown").hide();
      break;
    case "Services":
      $("#search_maincat-dropdown").hide();
      $("#search_role-dropdown").hide();
			$("#search_servicesrole-dropdown").show();
      break;
    case "Suppliers":
			$("#search_role-dropdown").show();
      $("#search_maincat-dropdown").hide();
			$("#search_servicesrole-dropdown").hide();
      break;
    case "Location":
      $("#search_maincat-dropdown").hide();
			$("#search_role-dropdown").hide();
			$("#search_servicesrole-dropdown").hide();
      break;
    default:
      $("#search_maincat-dropdown").show();
			$("#search_role-dropdown").hide();
			$("#search_servicesrole-dropdown").hide();
  }
});
$("#kt_wrapper").on('click','.search-mcat', function() {
  var search_mcat = $(this).data("id");
  var header_search_mcat = $(this).text();
  $("#search_maincat-dropdown").html(header_search_mcat);
  $("#search_maincat-id").val(search_mcat);
});
$("#kt_wrapper").on('click','.search-role', function() {
  var search_role = $(this).data("id");
  var header_search_role = $(this).text();
  $("#search_role-dropdown").html(header_search_role);
  $("#search_role-id").val(search_role);
  $("#filter_role").val(search_role);
});
$("#header_search").on("click", function(event) {
	var mcatId = 0;
  var searchtext = $("#header_search_text").val();
  $("#generalSearch").val(searchtext);
	var url = window.location.pathname;
	parts = url.split("/"),
	last_part = parts[parts.length-1];
	var mcat = $("#search_maincat-id").val();
	$(".search-mcat").each(function()
	{
			if (searchtext.toLowerCase() == $(this).text().toLowerCase()) {
				mcatId = $(this).data("id");
			}
	});
	if(last_part!="marketplace.php"){
		if(mcatId!=0) window.location.replace("<?php echo DIR_VIEW.DIR_PRO;?>marketplace.php?mcat="+mcatId);
		else window.location.replace("<?php echo DIR_VIEW.DIR_PRO;?>marketplace.php?ftbs=1&mcat="+mcat+"&searchtext="+searchtext);
	}else{
		$("input.checkbox_cat:checked").each(function(){
			this.checked = false;
		});
		$(".checkbox_mcat").each(function() {
			if ($(this).data("id") == mcat){
				this.checked = true;
				var cat = ".mcat-"+mcat;
				$(cat).prop('checked', this.checked);
			}else{
				this.checked = false;
			}
		});
		filtercategory();
		if(mcatId!=0) window.location.replace("<?php echo DIR_VIEW.DIR_PRO;?>marketplace.php?mcat="+mcatId);
		else $("#filter").trigger('click');
	}
});
$("#header_search_mobile").on("click", function(event) {
	var mcatId = 0;
  var searchtext = $("#header_search_text_mobile").val();
	$("#generalSearch").val(searchtext);
	var url = window.location.pathname;
	parts = url.split("/"),
	last_part = parts[parts.length-1];
	$(".search-mcat").each(function()
	{
			if (searchtext.toLowerCase() == $(this).text().toLowerCase()) {
				mcatId = $(this).data("id");
			}
	});
	if(last_part!="marketplace.php"){
		if(mcatId!=0) window.location.replace("<?php echo DIR_VIEW.DIR_PRO;?>marketplace.php?mcat="+mcatId);
		else window.location.replace("<?php echo DIR_VIEW.DIR_PRO;?>marketplace.php?ftbs=1&searchtext="+searchtext);
	}else{
		if(mcatId!=0) window.location.replace("<?php echo DIR_VIEW.DIR_PRO;?>marketplace.php?mcat="+mcatId);
		else $("#filter").trigger('click');
	}
});
var getUrlParameter = function getUrlParameter(sParam) {
	var sPageURL = window.location.search.substring(1),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;

	for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');

			if (sParameterName[0] === sParam) {
					return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
			}
	}
};
function login(redirect,param1,param2,param3){
	/*redirect guide*/
	/*
	* 1 = wishlist
	* 2 = negotiation
	*/
	/*redirect guide*/
	console.log('111');
	setCookie('redirect', redirect);
	setCookie('params1', param1);
	setCookie('params2', param2);
	setCookie('params3', param3);
	location.href = DIR_VIEW+DIR_USR+"login.php";
}
function filterrole(id){
	$("#filter_role").val(id);
	searchGridsup();
}
function showcat(mcat) {
  var div_mcat = '#categories'+mcat;
  $(div_mcat).toggle();
}
</script>
<?php
$client = new GuzzleHttp\Client();
$res_proname = $client->request('GET', DIR_CONT.DIR_PRO . 'CON_products.php?action=get-names');/*fetch all categories*/
$productsnames = json_decode($res_proname->getBody());
$res=array();
foreach ($productsnames->products_name as $product_name) {
	array_push($res, $product_name->name);
}
 ?>
<script type="text/javascript">
var states =  <?php print_r(json_encode($res))?>;
		var demo1 = function() {
				var substringMatcher = function(strs) {
						return function findMatches(q, cb) {
								var matches, substringRegex;

								// an array that will be populated with substring matches
								matches = [];

								// regex used to determine if a string contains the substring `q`
								substrRegex = new RegExp(q, 'i');

								// iterate through the pool of strings and for any string that
								// contains the substring `q`, add it to the `matches` array
								$.each(strs, function(i, str) {
										if (substrRegex.test(str)) {
												matches.push(str);
										}
								});

								cb(matches);
						};
				};

				$('#header_search_text,#header_search_text_mobile').typeahead({
						hint: true,
						highlight: true,
						minLength: 1
				}, {
						name: 'states',
						source: substringMatcher(states)
				});
		}
demo1();
// animated typing
const texts = ['Search for bazar wholesale products…','Search for bazar wholesale products…','Search for bazar wholesale products…'];
const input = document.querySelector('#header_search_text');
const animationWorker = function (input, texts) {
  this.input = input;
  this.defaultPlaceholder = this.input.getAttribute('placeholder');
  this.texts = texts;
  this.curTextNum = 0;
  this.curPlaceholder = '';
  this.blinkCounter = 0;
  this.animationFrameId = 0;
  this.animationActive = false;
  this.input.setAttribute('placeholder',this.curPlaceholder);

  this.switch = (timeout) => {
    this.input.classList.add('imitatefocus');
    setTimeout(
      () => {
        this.input.classList.remove('imitatefocus');
        if (this.curTextNum == 0)
          this.input.setAttribute('placeholder',this.defaultPlaceholder);
        else
          this.input.setAttribute('placeholder',this.curPlaceholder);

        setTimeout(
          () => {
            this.input.setAttribute('placeholder',this.curPlaceholder);
            if(this.animationActive)
              this.animationFrameId = window.requestAnimationFrame(this.animate)},
          timeout);
      },
      timeout);
  }

  this.animate = () => {
    if(!this.animationActive) return;
    let curPlaceholderFullText = this.texts[this.curTextNum];
    let timeout = 500;
    if (this.curPlaceholder == curPlaceholderFullText+'|' && this.blinkCounter==3) {
      this.blinkCounter = 0;
      this.curTextNum = (this.curTextNum >= this.texts.length-1)? 0 : this.curTextNum+1;
      this.curPlaceholder = '|';
      this.switch(3000);
      return;
    }
    else if (this.curPlaceholder == curPlaceholderFullText+'|' && this.blinkCounter<3) {
      this.curPlaceholder = curPlaceholderFullText;
      this.blinkCounter++;
    }
    else if (this.curPlaceholder == curPlaceholderFullText && this.blinkCounter<3) {
      this.curPlaceholder = this.curPlaceholder+'|';
    }
    else {
      this.curPlaceholder = curPlaceholderFullText
        .split('')
        .slice(0,this.curPlaceholder.length+1)
        .join('') + '|';
      timeout = 150;
    }
    this.input.setAttribute('placeholder',this.curPlaceholder);
    setTimeout(
      () => { if(this.animationActive) this.animationFrameId = window.requestAnimationFrame(this.animate)},
      timeout);
  }

  this.stop = () => {
    this.animationActive = false;
    window.cancelAnimationFrame(this.animationFrameId);
  }

  this.start = () => {
    this.animationActive = true;
    this.animationFrameId = window.requestAnimationFrame(this.animate);
    return this;
  }
}

document.addEventListener("DOMContentLoaded", () => {
  let aw = new animationWorker(input, texts).start();
  input.addEventListener("focus", (e) => aw.stop());
  input.addEventListener("blur", (e) => {
    aw = new animationWorker(input, texts);
    if(e.target.value == '') setTimeout( aw.start, 2000);
  });
});
document.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();
   document.getElementById("header_search").click();
  }
});
$("#header_search_text").focus(function(){
  $("#reset_search").addClass("border-top-warning border-bottom-warning");
});
$("#header_search_text").focusout(function(){
  $("#reset_search").removeClass("border-top-warning border-bottom-warning");
});
const animateCSS = (element, animation, prefix = 'animate__') =>
  // We create a Promise and return it
  new Promise((resolve, reject) => {
    const animationName = `${prefix}${animation}`;
    const node = document.querySelector(element);

    node.classList.add(`${prefix}animated`, animationName);

    // When the animation ends, we clean the classes and resolve the Promise
    function handleAnimationEnd(event) {
      event.stopPropagation();
      node.classList.remove(`${prefix}animated`, animationName);
      resolve('Animation ended');
    }

    node.addEventListener('animationend', handleAnimationEnd, {once: true});
  });

function switchtobuyer() {
	$.ajax({
  url: DIR_CONT+DIR_USR+"CON_user_access.php?action=switch-buyer",
  context: document.body
}).done(function() {
  location.href = DIR_ROOT;
});
}
function switchtoseller() {
	$.ajax({
  url: DIR_CONT+DIR_USR+"CON_user_access.php?action=switch-seller",
  context: document.body
}).done(function() {
  location.href = DIR_ROOT;
});
}
$("#usertype").bootstrapSwitch({
  onSwitchChange: function(e, state) {
    if(state==true) switchtobuyer();
		else switchtoseller();
  }
});
$("#usertype_mobile").bootstrapSwitch({
  onSwitchChange: function(e, state) {
    if(state==true) switchtobuyer();
		else switchtoseller();
  }
});
</script>
<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
