
// Digital Page overlay controls and fixes
// Semandra - jan 2015

var myCurrentPage;

jQuery(document).ready(function(pageCtl) {
  // Button code to toggle overlay - Semandra
	  jQuery( "#toggleBtn1" ).click(function() {
		jQuery( ".toolOverlay" ).css( "visibility", "visible" );
	  });
	  jQuery( "#toggleBtn2" ).click(function() {
		jQuery( ".toolOverlay" ).css( "visibility", "hidden" );
	  });
	  
  // Reload window (to reset overlay markup)
	  
	  window.addEventListener("resize", pageResetOnResize);
		 
		console.log ( "Current Page " + myCurrentPage);
		function pageResetOnResize(zoomData) {
			  
				currentPage = document.pageCtl.curPage; // get the current page number
				lastPage = document.pageCtl.maxPage; // get the total number of pages
				
				if (currentPage == lastPage) { 
					clearPage = currentPage - 1;
					} else {
						clearPage = currentPage + 1
						};
				
				document.pageCtl.SetPage(clearPage); // sets to a different page -- this triggers the refresh to realign page to size
				document.pageCtl.SetPage(currentPage); //  resets to the original page 
	  	};
});