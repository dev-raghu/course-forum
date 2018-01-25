$(document).ready(function() {
	var ele="<h5 style='color:blue;'>Click to post answer</h5>";
	$('#inner_div2').hide();
	$('#inner_div3').hide();
	$('#inner_div8').hide();
	var width = screen.Width;
	$(".taskbar").css("width", width);
	$("#que-btn").on("click",function() {$('#ask').openModal();});
    $('.dropdown-button').dropdown({
      inDuration: 300,
      outDuration: 225,
      constrain_width: true, // Does not change width of dropdown to that of the activator
      hover: true, // Activate on hover
      gutter: 0, // Spacing from edge
      belowOrigin: true // Displays dropdown below the button
    }
  );
  $("#bytag").on("click",function() {
     $('#inner_div').hide();
	 $('#inner_div3').hide();
	 $('#inner_div2').show();
  });
  $("#byuser").on("click",function() {
     $("#namefilter").openModal(); 
	 $('#inner_div').hide();
	 $('#inner_div2').hide();
	 $('#inner_div3').show();
  });
  $("#vbr").on("click",function() {
     $("#vbr").hide();
	 $('#inner_div').hide();
	 $('#inner_div8').show();
  });
  
});
$(document).ready(
function(){
var cnt=new ScrollMagic();
var scene=new ScrollScene({offset:0}).setPin(".taskbar").addTo(cnt);
var ft=$("#disc_cnt").offset().value=100;
$(window).scroll(function(){
var cs=$(window).scrollTop();
if(cs>=ft)
{
 $("#disc_cnt").css("position","fixed");
 $("#disc_cnt").css("top","100px");
 $("#disc_cnt").addClass("z-depth-4");
 $("#disc_cnt1").css("position","fixed");
 $("#disc_cnt1").css("top","100px");
 $("#disc_cnt1").addClass("z-depth-4");
 $("#disc_cnt3").css("position","fixed");
 $("#disc_cnt3").css("top","100px");
 $("#disc_cnt3").addClass("z-depth-4");
}
else
{
 $("#disc_cnt").css({
 position:'static'
});
 $("#disc_cnt1").css({
 position:'static'
});
$("#disc_cnt3").css({
 position:'static'
});
$("#disc_cnt").removeClass("z-depth-4");
$("#disc_cnt1").removeClass("z-depth-4");
$("#disc_cnt3").removeClass("z-depth-4");
}
});
}
);