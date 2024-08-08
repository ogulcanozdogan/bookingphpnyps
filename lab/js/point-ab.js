!function(e){"function"==typeof define&&define.amd?define(e):e()}(function(){var e,t=["scroll","wheel","touchstart","touchmove","touchenter","touchend","touchleave","mouseout","mouseleave","mouseup","mousedown","mousemove","mouseenter","mousewheel","mouseover"];if(function(){var e=!1;try{var t=Object.defineProperty({},"passive",{get:function(){e=!0}});window.addEventListener("test",null,t),window.removeEventListener("test",null,t)}catch(e){}return e}()){var n=EventTarget.prototype.addEventListener;e=n,EventTarget.prototype.addEventListener=function(n,o,r){var i,s="object"==typeof r&&null!==r,u=s?r.capture:r;(r=s?function(e){var t=Object.getOwnPropertyDescriptor(e,"passive");return t&&!0!==t.writable&&void 0===t.set?Object.assign({},e):e}(r):{}).passive=void 0!==(i=r.passive)?i:-1!==t.indexOf(n)&&!0,r.capture=void 0!==u&&u,e.call(this,n,o,r)},EventTarget.prototype.addEventListener._original=e}});
  
$(document).ready(function () {
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        items: 1,
        loop: true,
        margin: 2,
		dots:false,
        autoplay: true,
        slideTransition: 'linear',
        //autoplayTimeout: 3000,
        autoplaySpeed: 10000,
        //autoplayHoverPause: false,
		responsiveClass:true,
		autoplayHoverPause:true

    });

	});
jQuery.browser = {
    msie: false,
    version: 0
};
$('#txtDate').datepicker({
        buttonImage: 'images/calendar.png',
        buttonImageOnly: true,
        showOn: 'button',
        onClose: function(dateText, inst) {
            $('#year').val(dateText.split('/')[2]);
            $('#month').val(dateText.split('/')[0]);
            $('#day').val(dateText.split('/')[1]);
        }
    });
	
	$('#txtDate1').datepicker({
        buttonImage: 'images/calendar.png',
        buttonImageOnly: true,
        showOn: 'button',
        onClose: function(dateText, inst) {
            $('#year1').val(dateText.split('/')[2]);
            $('#month1').val(dateText.split('/')[0]);
            $('#day1').val(dateText.split('/')[1]);
        }
    });
	$(".ui-datepicker-trigger").attr("width","16");
	$(".ui-datepicker-trigger").attr("height","16");
$('.day-spin-month, day-spin-day, day-spin-year').on('keyup', function () {
    this.value = this.value.replace(/[^0-9\.]+/g, '');
});
$('.day-spin-month').on('keyup', function () {
console.log(this.value.length);
    if (this.value.length >= 3) {
	console.log($(this).next());
        var test=$(this).closest('span').next('span').find('input:text');
        //var test2=  $(test).next('input');
		console.log(test);
            test.focus();
    }
});
$('.day-spin-day').on('keyup', function () {
console.log(this.value.length);
    if (this.value.length >= 3) {
        var test=$(this).closest('span').next('span').find('input:text');
        var test2=  $(test).next('input');
            test.focus();
    }
	if(this.value.length==0){
	var test=$(this).closest('span').prev('span').find('input:text');
	test.focus();
	}
});
$(document).ready(function () {
			
  $("#actionForm").submit(function (event) {
$("#success").text("");
    $(".submit-btn").attr("disabled",true);
    $("#loading").text("Submitting...");
		var form = $('#actionForm')
        var formAction = 'point_a_to_point_b_pedicab_rides.php';
        var serializedFormData = form.serialize();
    $.ajax({
      type: "POST",
      url: formAction,
      data: serializedFormData,
      dataType : 'json',   //you may use jsonp for cross origin request
		crossDomain:true,
		success: function (data) {
        console.log(data);  
		}
    }).done(function (data) {
	
	if(data.success==true){
	$("#success").text("Successfully Sent!!!");
	document.getElementById("actionForm").reset();
	$(".submit-btn").attr("disabled",false);
	$("#loading").text("");
	$("#FirstName").empty();
	$("#Email").empty();
	}else{
	$("#loading").text("");
	$(".submit-btn").attr("disabled",false);
	}
      
    });
	//$("#loading").text("");
      event.preventDefault();
  });
  
});