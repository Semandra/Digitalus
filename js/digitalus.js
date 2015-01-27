
// Digital Page overlay controls and fixes
// Semandra - jan 2015

jQuery(document).ready(function() {
  // Button code to toggle overlay - Semandra
	  jQuery( "#toggleBtn1" ).click(function() {
		jQuery( ".toolOverlay" ).css( "visibility", "visible" );
	  });
	  jQuery( "#toggleBtn2" ).click(function() {
		jQuery( ".toolOverlay" ).css( "visibility", "hidden" );
	  });
	  
  // Reload window (to reset overlay markup) - Semandra
/*	  window.addEventListener("resize", pageResetOnResize);
		  
		function pageResetOnResize(zoomData) {
			  // remove old control
			  jQuery("#MyPageCtl").empty();
			  // reload and recalculate the page display
			  document.pageCtl = jQuery("#MyPageCtl").PageCtl(6, OnPageChange);
	  	};*/
});