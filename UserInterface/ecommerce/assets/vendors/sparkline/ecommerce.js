$(document).ready(function() {
var sparklineLogin = function() { 
$('#sparkline16').sparkline([0, 20, 15, 20, 15, 8, 10], {
type: 'line',
width: '168',
height: '35',
chartRangeMax:0,
resize: true,
lineColor: '#acccff',
fillColor: '#acccff',
highlightLineColor: 'rgba(0,0,0,.1)',
highlightSpotColor: 'rgba(0,0,0,.2)',
});


$('#sparkline17').sparkline([0, 20, 15, 20, 15, 8, 10], {
type: 'line',
width: '168',
height: '35',
chartRangeMax:0,
resize: true,
lineColor: '#3c76d3',
fillColor: '#3c76d3',
highlightLineColor: 'rgba(0,0,0,.1)',
highlightSpotColor: 'rgba(0,0,0,.2)',
});

$('#sparkline18').sparkline([0, 20, 15, 20, 15, 8, 10], {
type: 'line',
width: '168',
height: '35',
chartRangeMax:0,
resize: true,
lineColor: '#9ae8ab',
fillColor: '#9ae8ab',
highlightLineColor: 'rgba(0,0,0,.1)',
highlightSpotColor: 'rgba(0,0,0,.2)',
});


$('#sparkline19').sparkline([0, 20, 15, 20, 15, 8, 10], {
type: 'line',
width: '168',
height: '35',
chartRangeMax:0,
resize: true,
lineColor: '#ffdaf5',
fillColor: '#ffdaf5',
highlightLineColor: 'rgba(0,0,0,.1)',
highlightSpotColor: 'rgba(0,0,0,.2)',
});



$('#sparkline20').sparkline([0, 20, 15, 20, 15, 8, 10], {
type: 'line',
width: '168',
height: '35',
chartRangeMax:0,
resize: true,
lineColor: '#e8b79a',
fillColor: '#e8b79a',
highlightLineColor: 'rgba(0,0,0,.1)',
highlightSpotColor: 'rgba(0,0,0,.2)',
});







}
var sparkResize;

$(window).resize(function(e) {
clearTimeout(sparkResize);
sparkResize = setTimeout(sparklineLogin, 500);
});
sparklineLogin();

});