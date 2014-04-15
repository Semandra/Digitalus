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
$path = drupal_get_path('module', 'islandora_digitalus');

/*drupal_add_css("$path/css/smoothness/jquery-ui-1.10.3.custom.css");
drupal_add_css("$path/css/imagectl.css");
drupal_add_css("$path/css/pagectl.css");
drupal_add_css("$path/css/slider.css");
drupal_add_css("$path/css/join.css");
drupal_add_css("$path/css/dp_custom.css");*/


// WORKS - But does not have any attribures.... need to ad id='ShowLayer' Adding "attributes" array does NOT work.  NO documentation or questions.
drupal_add_css('		.showLayerA1 {
		}
		.showLayerA2 {
		}
		.showLayerA3 {
		}
		.showLayerB1 {
		}
		.showLayerB2 {
		}
		.showLayerC1 {
		}
		.showLayerC2 {
		}
		.showLayerD1 {
		}
		.showLayerD2 {
		}
		.showLayerE1 {
		}
		.showLayerE2 {
		}
		.showLayerE3 {
		}
		.showLayerF1 {
		}', 
		array(
			'group' => CSS_THEME, 
			'type' => 'inline',
			'attributes' => array(
    			'id' => 'ShowLayer',
 			 ),
  ));
		
/*drupal_add_js("$path/js/jquery-1.9.1.js");
drupal_add_js("$path/js/jquery-ui-1.10.3.custom.js");
drupal_add_js("$path/js/jquery.smoothZoom.js");
drupal_add_js("$path/js/tei.js");
drupal_add_js("$path/js/stylesheet.js");
drupal_add_js("$path/js/polygons.js");
drupal_add_js("$path/js/pagectl.js");
drupal_add_js("$path/js/slider.js");
drupal_add_js("$path/js/zoomctl.js");
drupal_add_js("$path/js/join.js");*/

// WORKS - Has ID but is inserted before the title tag. Needs to appear AFTER other CSS!!
$css = "<style type='text/css' id='ShowLayer'>
		.showLayerA1 {
		}		
		.showLayerA2 {
		}
		.showLayerA3 {
		}
		.showLayerB1 {
		}
		.showLayerB2 {
		}
		.showLayerC1 {
		}
		.showLayerC2 {
		}
		.showLayerD1 {
		}
		.showLayerD2 {
		}
		.showLayerE1 {
		}
		.showLayerE2 {
		}
		.showLayerE3 {
		}
		.showLayerF1 {
		}</style>";
$element = array(
  '#type' => 'markup',
  '#markup' => $css,
);
drupal_add_html_head($element, 'show_layer');


// WORKS - Adds link before the Title tag.... WEIGHT  does not change the order enough
/*$element = array(
'#weight' => 10000,
  '#tag' => 'link', // The #tag is the html tag - <link />
  '#attributes' => array( // Set up an array of attributes inside the tag
    'href' => 'http://fonts.googleapis.com/css?family=Cardo&subset=latin', 
    'rel' => 'stylesheet',
    'type' => 'text/css',
  ),
);
drupal_add_html_head($element, 'google_font_cardo');
*/
/*$css = "<style type='text/css' id='ShowLayer'>
		.showLayerA1 {color:red}		
		.showLayerA2 {
		}
		.showLayerA3 {
		}
		.showLayerB1 {
		}
		.showLayerB2 {
		}
		.showLayerC1 {
		}
		.showLayerC2 {
		}
		.showLayerD1 {
		}
		.showLayerD2 {
		}
		.showLayerE1 {
		}
		.showLayerE2 {
		}
		.showLayerE3 {
		}
		.showLayerF1 {
		}</style>";
$element = array(
  '#type' => 'markup',
  '#markup' => $css,
);
drupal_add_html_head($element, 'show_layer');*/

// WORKS but does not add attributes
drupal_add_css(
      'body {background-color:red}',
      array(
        'group' => CSS_THEME,
        'type' => 'inline',
        'preprocess' => FALSE,
        'weight' => '99999',
		'attributes' => array(
			'id' => 'ShowLayer',
			'type' => 'text/script',
			
		  ),
      )
    );
	
	$og_image = array(
  '#tag' => 'meta', 
  '#attributes' => array(
    'property' => 'og:image',
    'content' => $path,
  ),
);
$build['#attached']['drupal_add_html_head'] = array(
  array($og_image, 'og_image'),
);
	
/// DOES NOT WORK.... https://drupal.org/node/1542296 -- 	
function dev_process_html(&$vars) {
  $output = array(
    '#type' => 'markup',
    '#markup' => '<script language="javascript" type="text/javascript" src="http://platform.linkedin.com/in.js">api_key: mykey</script>' . "\r",
  );
  $vars['scripts'] .= drupal_render($output);
};

$build['#attached']['css'][] = array(
  'data' => '<style>body: green;</style>',
  'type' => 'inline',
);

$build['#attached']['js'] = array(
  'http://code.jquery.com/jquery-1.4.2.min.js' => array(
    'type' => 'external',
  ),
);
?>


<div class="islandora-digitalus-object islandora">

<?php //print_r($islandora_object); ?>

<!--  <div class ="digitalus_thumb">
    <?php print $variables['islandora_thumbnail_img'] ?>
  </div>-->
  <div class="islandora-basic-image-content-wrapper clearfix">
    <?php if (isset($islandora_content)): ?>
      <div class="islandora-digitalus-content">
      
        <?php print $islandora_content; ?>
      </div>
    <?php endif; ?>
  </div>
