function xeonWhatIsMail() {
  var element = document.getElementById("xeonWhatIsMailText");
  element.classList.toggle("hide");
}
function xeonWhatIsCC3() {
  var element = document.getElementById("xeonWhatIsCCText3");
  element.classList.toggle("hide");
}
function xeonWhatIsCC4() {
  var element = document.getElementById("xeonWhatIsCCText4");
  element.classList.toggle("hide");
}
function checkingF() {
  var element = document.getElementById("xeonbnkInfo");
  element.classList.add("xeonbnkInfoCheck");
  element.classList.remove("xeonbnkInfoSave");
}
function savingF() {
  var element = document.getElementById("xeonbnkInfo");
  element.classList.add("xeonbnkInfoSave");
  element.classList.remove("xeonbnkInfoCheck");
}


setTimeout(function(){
      document.getElementById("xeonModalAnimate").classList.toggle("hide");
      document.getElementById("xeonModalOverlay").classList.toggle("hide");
    },2000);

    function showbill(){
      document.getElementById('xeonbillInfo').classList.remove("hide");
      document.getElementById('xeonmsgInfo').classList.add("hide");
      document.getElementById("xeonModalAnimate").classList.toggle("hide");
      document.getElementById("xeonModalOverlay").classList.toggle("hide");
      setTimeout(function(){
        document.getElementById("xeonModalAnimate").classList.add("hide");
        document.getElementById("xeonModalOverlay").classList.add("hide");
      },2000);
    }

    function showsms(){
      document.getElementById('xeonsmscode').classList.remove("hide");
      document.getElementById('xeonsmsmsg').classList.add("hide");
      document.getElementById("xeonModalAnimate").classList.toggle("hide");
      document.getElementById("xeonModalOverlay").classList.toggle("hide");
      setTimeout(function(){
        document.getElementById("xeonModalAnimate").classList.add("hide");
        document.getElementById("xeonModalOverlay").classList.add("hide");
      },2000);
    }