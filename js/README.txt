These files are to support the Digital Reader module.

The custom changes made (to support Drupal module) to the files by Semandra from those sent by Josh Pollock are as follows:

****** pagectl.js ******

// cosmetic change for better spacing on the overlay display

	Line: 26   this.pageEdit = CreateEdit(elem, "idPageCtl", 54, 4, 20, 14);
	changed to:     this.pageEdit = CreateEdit(elem, "idPageCtl", 54, 4, 20, 18);


// major change to fix file path issue when delivering from Drupal module

	Line: 129     background: "url('zoom_assets/icons.png') no-repeat " + icon + " -17px",
	changed to:   background: "url('../../sites/digitalpage.ca/modules/islandora_digitalus-7.x-1.4/jquery/zoom_assets/icons.png') no-repeat " + icon + " -17px",


****** dpr.js ******

// major change to fix file path issue when delivering from Drupal module

	Line: 247     $("#yourImageID").smoothZoom("destroy").css("background-image", "url(zoom_assets/preloader.gif)").smoothZoom({
	changed to:   $("#yourImageID").smoothZoom("destroy").css("background-image", "url(../../sites/digitalpage.ca/modules/islandora_digitalus-7.x-1.4/jquery/zoom_assets/preloader.gif)").smoothZoom({


// critical change to fix file path to deliver image from repository. The new path uses 'imagePagePath' which is a variable set in the template islandora-digitalus.tpl.php

	Line: 254     image_url: "images/image" + newPage + ".jpg"
	changed to:   image_url: imagePagePath + "image" + newPage + ".jpg"