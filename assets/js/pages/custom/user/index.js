var searchtext = getUrlParameter("searchtext");
var mcat = getUrlParameter("mcat");
var cat = getUrlParameter("cat");
var brnd = getUrlParameter("brnd");
var lp = getUrlParameter("lp");
var ft = getUrlParameter("ft");
var bs = getUrlParameter("bs");
var ftbs = getUrlParameter("ftbs");
var lt = getUrlParameter("lt");
var did = getUrlParameter("did");
var eid = getUrlParameter("eid");
var maxp = getUrlParameter("maxp");
var ff = getUrlParameter("ff");
var as = getUrlParameter("as");
var lx = getUrlParameter("lx");
var ts = getUrlParameter("ts");
var gt = getUrlParameter("gt");
var eid = getUrlParameter("eid");
var gf = getUrlParameter("gf");
if(lp==1){
  $("#filter").trigger('click');
}
if(ft==1){
  $("#featured").prop("checked",true);
  $("#filter").trigger('click');
}
else $("#featured").prop("checked",false);
if(bs==1){
  $("#bestseller").prop("checked",true);
  $("#filter").trigger('click');
}
if(ftbs==1){
  $("#bestseller").prop("checked",true);
  $("#featured").prop("checked",true);
  if(searchtext){
    $("#header_search_text").val(searchtext);
    $("#generalSearch").val(searchtext);
  }
  $("#filter").trigger('click');
}
else $("#bestseller").prop("checked",false);
if(eid==1){
  $("#eid").prop("checked",true);
  $("#filter").trigger('click');
}
if(searchtext){
  $("#header_search_text").val(searchtext);
  $("#generalSearch").val(searchtext);
  $("#filter").trigger('click');
}
if(lt==1){
  $("#order_by").val(1);
  $("#filter").trigger('click');
}
if(did){
  $("#filter_demand").val(did);
  $("#filter").trigger('click');
}
if(eid){
  $("#filter_event").val(eid);
  $("#filter").trigger('click');
}
if(maxp){
  $("#max_price").val(maxp);
  $("#filter").trigger('click');
}
if(brnd){
  $("#filter_brand").val(brnd);
  $("#filter").trigger('click');
}
if(mcat){
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
      $('#filter_fragrancefor').val("");
			$('#filter_arabicscents').val("");
			$('#filter_luxuryperfume').val("");
			$('#filter_tester').val("");
			$('#filter_giftset').val("");
    }
  });
  filtercategory();
  $("#filter").trigger('click');
}else if(cat){
  $(".checkbox_cat").each(function() {
    if ($(this).data("id") == cat){
      this.checked = true;
    }else{
      this.checked = false;
      $('#filter_fragrancefor').val("");
			$('#filter_arabicscents').val("");
			$('#filter_luxuryperfume').val("");
			$('#filter_tester').val("");
			$('#filter_giftset').val("");
    }
  });
  filtercategory();
  $("#filter").trigger('click');
}
if(ff){
  $("#filter_fragrancefor").val(ff);
  $("#filter").trigger('click');
}
if(as){
  $("#filter_arabicscents").val(as);
  $("#filter").trigger('click');
}
if(lx){
  $("#filter_luxuryperfume").val(lx);
  $("#filter").trigger('click');
}
if(ts){
  $("#filter_tester").val(ts);
  $("#filter").trigger('click');
}
if(gt){
  $("#filter_giftset").val(gt);
  $("#filter").trigger('click');
}
if(gf){
  $("#gift").prop("checked",true);
  $("#filter").trigger('click');
}
$("#controller-mobile").click(function(){
  $("#controller").toggle();
});
