jQuery(function($) {'use strict',

	//#main-slider
	$(function(){
		$('.carousel').carousel({
			interval: 6000
		});
	});


	// accordian
	$('.accordion-toggle').on('click', function(){
		$(this).closest('.panel-group').children().each(function(){
		$(this).find('>.panel-heading').removeClass('active');
		 });

	 	$(this).closest('.panel-heading').toggleClass('active');
	});

	//Initiat WOW JS
	new WOW().init();

	// portfolio filter
	$(window).load(function(){'use strict';
		var $portfolio_selectors = $('.portfolio-filter >li>a');
		var $portfolio = $('.portfolio-items');
		$portfolio.isotope({
			itemSelector : '.portfolio-item',
			layoutMode : 'fitRows'
		});
		
		$portfolio_selectors.on('click', function(){
			$portfolio_selectors.removeClass('active');
			$(this).addClass('active');
			var selector = $(this).attr('data-filter');
			$portfolio.isotope({ filter: selector });
			return false;
		});
	});

	// Contact form
	var form = $('#main-contact-form');
	form.submit(function(event){
		event.preventDefault();
		var form_status = $('<div class="form_status"></div>');
		$.ajax({
			url: $(this).attr('action'),

			beforeSend: function(){
				form.prepend( form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Email is sending...</p>').fadeIn() );
			}
		}).done(function(data){
			form_status.html('<p class="text-success">' + data.message + '</p>').delay(3000).fadeOut();
		});
	});

	
	//goto top
	$('.gototop').click(function(event) {
		event.preventDefault();
		$('html, body').animate({
			scrollTop: $("body").offset().top
		}, 500);
	});	

	//Pretty Photo
	$("a[rel^='prettyPhoto']").prettyPhoto({
		social_tools: false
	});	
	
	//feature-wrap
	$(".feature-wrap .img-overlay").hide();
	$(".feature-wrap").hover(function(){
		$(this).find(".img-overlay").toggle();
	});
	
});

$(document).ready(function(){
  
	$(".special-navbar").hide();
	setTimeout(function(){ $(".loader-div-virtual").hide(); $(".special-navbar").show(); }, 3000);
	
	$('.subcategory-ul li').click(function(e) {
        var subcategory = $(e.target).text().toLowerCase();
		subcategory = subcategory.split(' ').join('');
		if(subcategory.indexOf("&") > 0){
		subcategory = subcategory.substring(0, subcategory.indexOf("&"));}
		
        location.href = "shop.php?subcategory=" + subcategory + "&clicked=1";

	
	
    });	
	
	var $window= $(window);
  var $slideanim= $(".slideanim");
  $window.on("scroll",check);
  $window.on("scroll resize",check);
  $window.trigger("scroll");
  
  function check(){
    var wh=$window.height();
    var wtp=$window.scrollTop();
    var wbp= (wtp + wh);
    $slideanim.each(function(){
      var eh=$(this).outerHeight();
      var etp=$(this).offset().top;
      var ebp= (eh + etp);
      if((etp <= wbp) &&(ebp >=wtp)){
        $(this).addClass("slide1");
        }
     });
   }  
   
    
   
   $(".chatter img").hover(function(){
	   var changer = $(this).attr("src");
	   $(".cover-photo img").attr("src",changer);
   });
   
   $(".loginchangebtn").click(function(){
	   $('#login-modal').modal('hide');
	   
   });
   $(".registerchangebtn").click(function(){
	   $('#register-modal').modal('hide');
   });
   setTimeout(function(){ $(".feature-header,.feature-subheader,.feature-wrap").addClass("animated");},3000);
   setTimeout(function(){ $(".feature-header,.feature-subheader,.feature-wrap").addClass("zoomIn");},3000);
	
});