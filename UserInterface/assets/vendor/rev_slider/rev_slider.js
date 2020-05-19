"use strict";

$(document).ready(function() {
						   

if (setREVStartSize!==undefined) setREVStartSize(
{c: '#rev_slider_342_1', responsiveLevels: [1240,1240,1240,480], gridwidth: [1000,1000,1000,1000], gridheight: [868,868,868,868], sliderLayout: 'fullscreen', fullScreenAutoWidth:'off', fullScreenAlignForce:'off', fullScreenOffsetContainer:'', fullScreenOffset:'60px'});

var revapi342,
tpj;	
(function() {			
if (!/loaded|interactive|complete/.test(document.readyState)) document.addEventListener("DOMContentLoaded",onLoad); else onLoad();	
function onLoad() {				
if (tpj===undefined) { tpj = jQuery; if("off" == "on") tpj.noConflict();}
if(tpj("#rev_slider_342_1").revolution == undefined){
revslider_showDoubleJqueryError("#rev_slider_342_1");
}else{
revapi342 = tpj("#rev_slider_342_1").show().revolution({
sliderType:"standard",
jsFileLocation:" ",
sliderLayout:"fullscreen",
dottedOverlay:"none",
delay:9000,
navigation: {
keyboardNavigation:"off",
keyboard_direction: "horizontal",
mouseScrollNavigation:"off",
mouseScrollReverse:"default",
onHoverStop:"off",
touch:{
touchenabled:"on",
touchOnDesktop:"off",
swipe_threshold: 75,
swipe_min_touches: 1,
swipe_direction: "horizontal",
drag_block_vertical: false
}
,
arrows: {
style:"metis",
enable:true,
hide_onmobile:true,
hide_under:600,
hide_onleave:false,
tmp:'',
left: {
h_align:"left",
v_align:"center",
h_offset:0,
v_offset:0
},
right: {
h_align:"right",
v_align:"center",
h_offset:0,
v_offset:0
}
}
},
responsiveLevels:[1240,1240,1240,480],
visibilityLevels:[1240,1240,1240,480],
gridwidth:[1000,1000,1000,1000],
gridheight:[868,868,868,868],
lazyType:"none",
shadow:0,
spinner:"spinner0",
stopLoop:"off",
stopAfterLoops:-1,
stopAtSlide:-1,
shuffle:"off",
autoHeight:"off",
fullScreenAutoWidth:"off",
fullScreenAlignForce:"off",
fullScreenOffsetContainer: "",
fullScreenOffset: "60px",
disableProgressBar:"on",
hideThumbsOnMobile:"off",
hideSliderAtLimit:0,
hideCaptionAtLimit:0,
hideAllCaptionAtLilmit:0,
debugMode:false,
fallbacks: {
simplifyAll:"off",
nextSlideOnWindowFocus:"off",
disableFocusListener:false,
}
});
}; /* END OF revapi call */

if(typeof ExplodingLayersAddOn !== "undefined") ExplodingLayersAddOn(tpj, revapi342);
//RsTypewriterAddOn(tpj, revapi342);
}; /* END OF ON LOAD FUNCTION */
}()); /* END OF WRAPPING FUNCTION */







var htmlDivCss = unescape("%23rev_slider_342_1%20.metis.tparrows%20%7B%0A%20%20background%3Argba%28255%2C%20255%2C%20255%2C%201%29%3B%0A%20%20padding%3A10px%3B%0A%20%20transition%3Aall%200.3s%3B%0A%20%20-webkit-transition%3Aall%200.3s%3B%0A%20%20width%3A60px%3B%0A%20%20height%3A60px%3B%0A%20%20box-sizing%3Aborder-box%3B%0A%20%7D%0A%20%0A%20%23rev_slider_342_1%20.metis.tparrows%3Ahover%20%7B%0A%20%20%20background%3Argba%28255%2C255%2C255%2C0.75%29%3B%0A%20%7D%0A%20%0A%20%23rev_slider_342_1%20.metis.tparrows%3Abefore%20%7B%0A%20%20color%3Argb%280%2C%200%2C%200%29%3B%20%20%0A%20%20%20transition%3Aall%200.3s%3B%0A%20%20-webkit-transition%3Aall%200.3s%3B%0A%20%7D%0A%20%0A%20%23rev_slider_342_1%20.metis.tparrows%3Ahover%3Abefore%20%7B%0A%20%20%20transform%3Ascale%281.5%29%3B%0A%20%20%7D%0A%20%0A");
var htmlDiv = document.getElementById('rs-plugin-settings-inline-css');
if(htmlDiv) {
htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
}
else{
var htmlDiv = document.createElement('div');
htmlDiv.innerHTML = '<style>' + htmlDivCss + '</style>';
document.getElementsByTagName('head')[0].appendChild(htmlDiv.childNodes[0]);
}



}};