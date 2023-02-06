(function($) {
	"use strict";
	
	// ______________Active Class
	$(".app-sidebar li a").each(function() {
	  var pageUrl = window.location.href.split(/[?#]/)[0];
		if (this.href == pageUrl) { 
			$(this).addClass("active");
			$(this).parent().addClass("active"); // add active to li of the current link
			$(this).parent().parent().prev().addClass("active"); // add active class to an anchor
			$(this).parent().parent().prev().click(); // click the item to make it drop
		}
	});
	
	//Active Class
	$(".app-sidebar li a").each(function() {
		var pageUrl = window.location.href.split(/[?#]/)[0];
		if (this.href == pageUrl) {
			$(this).addClass("active");
			$(this).parent().addClass("active"); // add active to li of the current link
			$(this).parent().parent().parent().addClass("resp-tab-content-active"); // add active to li of the current link
			$(this).parent().parent().parent().prev().addClass("active"); // add active class to an anchor
			$(this).parent().parent().parent().prev().click(); // click the item to make it drop
		}
	});
	
	$(".submenu-list li a").each(function() {
		var pageUrl = window.location.href.split(/[?#]/)[0];
		if (this.href == pageUrl) {
			$(this).addClass("active");
			$(this).parent().parent().parent().parent().parent().addClass("active"); // add active to li of the current link
			$(this).parent().parent().parent().parent().parent().addClass("resp-tab-content-active"); // add active to li of the current link
			$(this).parent().parent().parent().prev().addClass("active"); // add active class to an anchor
			$(this).parent().parent().parent().prev().click(); // click the item to make it drop
		}
	});
	
	
	$(document).ready(function(){	
	
		if ($('.home-volgh.active').hasClass('active'))
        $('li.home-volgh').addClass('active');
	
		if ($('.componet-volgh.active').hasClass('active'))
        $('li.componet-volgh').addClass('active');
	
		if ($('.widget-volgh.active').hasClass('active'))
        $('li.widget-volgh').addClass('active');
	
		if ($('.charts-volgh.active').hasClass('active'))
        $('li.charts-volgh').addClass('active');
	
		if ($('.elements-volgh.active').hasClass('active'))
        $('li.elements-volgh').addClass('active');
		
		if ($('.advancedelemnets-volgh.active').hasClass('active'))
        $('li.advanced elemnets-volgh').addClass('active');
	
		if ($('.forms-volgh.active').hasClass('active'))
        $('li.forms-volgh').addClass('active');
	
		if ($('.icons-volgh.active').hasClass('active'))
        $('li.icons-volgh').addClass('active');
	
		if ($('.tables-volgh.active').hasClass('active'))
        $('li.tables-volgh').addClass('active');
	
		if ($('.pages-volgh.active').hasClass('active'))
        $('li.pages-volgh').addClass('active');
	
		if ($('.ecommerce-volgh.active').hasClass('active'))
        $('li.e-commerce-volgh').addClass('active');
	
		if ($('.custom-volgh.active').hasClass('active'))
        $('li.custom-volgh').addClass('active');
	
		if ($('.errorpages-volgh.active').hasClass('active'))
        $('li.errorpages-volgh').addClass('active');
	
	
	});

	// VerticalTab
	$('#parentVerticalTab').easyResponsiveTabs({
		type: 'vertical',
		width: 'auto', 
		fit: true, 
		closed: 'accordion',
		tabidentify: 'hor_1',
		activate: function(event) {
			var $tab = $(this);
			var $info = $('#nested-tabInfo2');
			var $name = $('span', $info);
			$name.text($tab.text());
			$info.show();
		}
	});
	
	
	const ps5 = new PerfectScrollbar('.first-sidemenu', {
	  useBothWheelAxes:true,
	  suppressScrollX:true,
	});
	const ps6 = new PerfectScrollbar('.second-sidemenu', {
	  useBothWheelAxes:true,
	  suppressScrollX:true,
	});
				
})(jQuery);