
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
	  
  // Reload window (to reset overlay markup) - Semandra
	  
	  window.addEventListener("resize", pageResetOnResize);
		 
		console.log ( "Current Page " + myCurrentPage);
		function pageResetOnResize(zoomData) {
			  // remove old control
			  
			 console.log(document.pageCtl);
			  
			  
			  
			 // jQuery("#MyPageCtl").empty();
			  // reload and recalculate the page display // should use the current page not reset it to first page
			//  document.pageCtl = jQuery("#MyPageCtl").PageCtl(numberOfPages, OnPageChange);
			//pageCtl.prototype.SetPage(document.pageCtl.curPage);
			/*jQuery("#MyPageCtl").change(function() {
				console.log("change function has been fired");
				
					}
				);*/
				
				currentPage = document.pageCtl.curPage; // get the current page number
				lastPage = document.pageCtl.maxPage; // get the total number of pages
				
				
				
				if (currentPage == lastPage) { 
					clearPage = currentPage - 1;
					console.log("this is the last page");
					console.log("clearPage " + clearPage);
					} else {
						clearPage = currentPage + 1
						console.log("clearPage " + clearPage);
						};
				
				document.pageCtl.SetPage(clearPage); // sets to a different page -- this triggers the refresh to realign page to size
				document.pageCtl.SetPage(currentPage); //  resets to the original page 
	  	};
});