<?php
/**
 * @file
 * This is the template file for the digitalus object page.
 *
 * Here we build an html page using the variables passed in by
 * the islandora_digitalus_preprocess_islandora_digitalus
 * function.  Elements such as labels and buttons can be added here
 */
 
$islandora_content = $islandora_object['DIGITALUS']->content;
$islandora_doc_styles = $islandora_object['STYLES']->content; //Customizable styles for document tool

//$islandora_image = $islandora_object['image2']->content;
$path = drupal_get_path('module', 'islandora_digitalus');  //gets path for css and js in module


// SHOW_LAYER inline styles are added to the Head of HTML before all other styles
	$css = '<style id="my_empty"></style>';
	if (isset($islandora_doc_styles)) {
		$css = $islandora_doc_styles;
		//	drupal_set_message(t('The custom CSS styles have been loaded.'), 'status');
	} else {
		drupal_set_message(t('The custom CSS styles for this document have not been loaded. The document tool will not function.'), 'warning');
	};
	
	$element = array(
	  '#type' => 'markup',
	  '#markup' => $css,
	);
	drupal_add_html_head($element, 'show_layer');

// CSS Styles necessary for the Digital Reader tool

	drupal_add_css("$path/jquery/css/smoothness/jquery-ui-1.10.3.custom.min.css");
	drupal_add_css("$path/css/imagectl.css");
	drupal_add_css("$path/css/pagectl.css");
	drupal_add_css("$path/css/slider.css");
	drupal_add_css("$path/css/join.css");
	
	drupal_add_css("$path/css/islandora_digitalus.css");

// JavaScript files necessary for the Digital Reader tool
//jquery-1.9.1.js is also required but is loaded by Drupal through a separate module);

	drupal_add_js("$path/jquery/js/jquery-ui-1.10.3.custom.min.js");
	drupal_add_js("$path/jquery/zoom_assets/jquery.smoothZoom.min.js");
	
	drupal_add_js("$path/js/dpr.js");
	drupal_add_js("$path/js/pagectl.js");
	drupal_add_js("$path/js/polygons.js");
	drupal_add_js("$path/js/slider.js");
	drupal_add_js("$path/js/stylesheet.js");
	drupal_add_js("$path/js/substjoin.js");
	drupal_add_js("$path/js/zoomctl.js");
	drupal_add_js("$path/js/digitalus.js");

drupal_add_js(
      '  
			 window.imagePagePath =  "'.$variables["islandora_object_page_image"].'";	 //SEMANDRA - set a global path variable
       ',
	   '  
			 window.docObjectPath =  "'.$variables["islandora_object_path"].'";	 //SEMANDRA - set a global path variable to document objects	
       ',
      array(
        'group' => JS_THEME,
        'type' => 'inline',
        'preprocess' => FALSE,
        'weight' => '99999',
      )
    );

?>
 
 
<div class="islandora-digitalus-object islandora">

   
 <div class="islandora-basic-image-content-wrapper clearfix">
    <?php if (isset($islandora_content)): ?>
        <div class="islandora-digitalus-content" >
        
          <!--div for black background behind main display-->
          <div id="overLay1" class="toolOverlay"></div>
          
          <!--div for display of text tool and images of pages-->
          <div id="overLay2" class="toolOverlay">
              <div id="toggleBtn2"  class="toggleButton">Close Digital Page Reader</div>
              <?php print $islandora_content; ?>
          </div>
          <script>
        	  var imagePagePath = "<?php  print_r($variables["islandora_object_path"])?>";
          </script>
        
        </div><!-- end content (digitalus template) -->
    <?php endif; ?>
  </div> <!-- end wrapper (digitalus template) -->
  
  

 
  <?php // Render metadata table from XSLT transform - see "mods_display.xsl"
	print $metadata;
?>

</div> <!-- end-digitalus-object (digitalus template) -->