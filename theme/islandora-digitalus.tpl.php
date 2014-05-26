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
//$islandora_image = $islandora_object['image2']->content;
$path = drupal_get_path('module', 'islandora_digitalus');  //gets path for css and js in module


// SHOW_LAYER inline style
$css = '<style type="text/css">
/*		html, body {
			height: 100%;
			width: 100%;
			margin: 0;
			padding: 0
		}
		body {
			font-family: calibri
		}*/

		/*// Semandra - added because body tag is too global*/
		.islandora-digitalus-object {  
			font-family: calibri;

		}
		/*// Semandra - Added to readjust text back to full size (adjusted in global body tag)*/
		#cellContent {			
			font-size: 130%;	 	
		}
		
		.islandora-digitalus-object input {
			
		}
		
		.showLayer {
			display: none
		}
		.bracketNormal, .bracketCorrection {
			display: none;
			font-weight: bold
		}
		.bracketNormal {
			color: #DD0000;
		}
		.bracketCorrection {
			color: #DD0000
		} /* TODO: put back to #3333FF if we ever go back to brackets */
		input[type=button] {
			border: none
		}
		.sicText {
			cursor: default
		}
		.recteText {
			color: #DD0000
		}
	</style>
    <style type="text/css" id="ShowLayer">
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
		}
	</style>
    <style type="text/css" id="SessionColor">
		.sessionAColor {
			background-color: #FFBFBF
		}
		.sessionBColor {
			background-color: #FFBF7F
		}
		.sessionCColor {
			background-color: #FFFF7F
		}
		.sessionDColor {
			background-color: #7FFF7F
		}
		.sessionEColor {
			background-color: #BFBFFF
		}
		.sessionFColor {
			background-color: #CF8FFF
		}
	</style>
                <style type="text/css" id="MultiLayer">
		.layerContainer {
			display: block;
			margin-left: 35px;
			spacing: 0;
			text-indent: -35px;
			padding: 0
		}
		.layerLabel {
			display: inline-block;
			margin: 0px;
			text-indent: 0px;
			width: 31px;
			text-align: center;
			color: black
		}
		.layerSpacer {
			display: inline;
			margin: 0px;
			text-indent: 0px;
			width: 5px;
			text-align: center;
			background-color: white
		}
		.layerContents {
			display: inline;
			margin: 0px;
			text-indent: 0px
		}
</style>
                <style type="text/css" id="SingleLayer">
		.layerContainer {
			display: inline
		}
		.layerLabel {
			display: none
		}
		.layerSpacer {
			display: none
		}
		.layerContents {
			display: inline
		}
		#substJoinBar {
			display: none
		}
</style>
                <style type="text/css" id="AllChangesMode">
		.emphBold {
			font-weight: bold
		}
		.emphItalic {
			font-style: italic
		}
		.emphUnderline {
			text-decoration: underline
		}
		.emphSingleQuote:before {
			content: "‘"
		}
		.emphSingleQuote:after {
			content: "’"
		}
		.emphDoubleQuote:before {
			content: "“"
		}
		.emphDoubleQuote:after {
			content: "”"
		}
		.emphSmallCaps {
			font-variant: small-caps
		}
		.allChangesModeOn {
			display: inline
		}
		.allChangesModeOff {
			display: none
		}
		.finalModeOn {
			display: none
		}
		.finalModeOff {
			display: inline
		}
		.readingModeOn {
			display: none
		}
		.readingModeOff {
			display: inline
		}
		.pb {
			width: 300px;
			color: #3333FF;
			border-top: solid 1px #3333FF;
			margin-top: 2ex
		}
</style>
                <style type="text/css" id="FinalMode">
		.emphBold {
			font-weight: bold
		}
		.emphItalic {
			font-style: italic
		}
		.emphUnderline {
			text-decoration: underline
		}
		.emphSingleQuote:before {
			content: "‘"
		}
		.emphSingleQuote:after {
			content: "’"
		}
		.emphDoubleQuote:before {
			content: "“"
		}
		.emphDoubleQuote:after {
			content: "”"
		}
		.emphSmallCaps {
			font-variant: small-caps
		}
		.allChangesModeOn {
			display: none
		}
		.allChangesModeOff {
			display: inline
		}
		.finalModeOn {
			display: inline
		}
		.finalModeOff {
			display: none
		}
		.readingModeOn {
			display: none
		}
		.readingModeOff {
			display: inline
		}
		.pb {
			width: 200px;
			color: #3333FF;
			border-top: solid 1px #3333FF;
		}
</style>
                <style type="text/css" id="ReadingMode">
		.emphNone, .emphBold, .emphItalic, .emphUnderline, .emphSingleQuote, .emphDoubleQuote, .emphSmallCaps {
			font-style: italic
		}
		.allChangesModeOn {
			display: none
		}
		.allChangesModeOff {
			display: inline
		}
		.finalModeOn {
			display: none
		}
		.finalModeOff {
			display: inline
		}
		.readingModeOn {
			display: inline
		}
		.readingModeOff {
			display: none
		}
</style>
                <style type="text/css" id="LineBreak">
		div.lineBreak {
			display: inline
		}
</style>
                <style type="text/css" id="Highlights"></style>
                
                <style type="text/css" id="JoinHighlightSessions">
	.joinMarkerSession_A {
	}
	.joinMarkerSession_B {
	}
	.joinMarkerSession_C {
	}
	.joinMarkerSession_D {
	}
	.joinMarkerSession_E {
	}
	.joinMarkerSession_F {
	}
	</style>
                <style type="text/css" id="JoinHighlights"></style>
               
               
               
                <style>
.ui-widget {
	font-family: calibri;
	font-size: 1em;
}
</style>';
$element = array(
  '#type' => 'markup',
  '#markup' => $css,
);
drupal_add_html_head($element, 'show_layer');


drupal_add_css("$path/css/smoothness/jquery-ui-1.10.3.custom.css");
drupal_add_css("$path/css/imagectl.css");
drupal_add_css("$path/css/pagectl.css");
drupal_add_css("$path/css/slider.css");
drupal_add_css("$path/css/join.css");
//drupal_add_css("$path/css/dp_custom.css");
drupal_add_css("$path/css/islandora_digitalus.css");

//drupal_add_js("$path/js/jquery-1.9.1.js");

drupal_add_js("$path/js/jquery-ui-1.10.3.custom.js");
drupal_add_js("$path/js/jquery.smoothZoom.js");

drupal_add_js("$path/js/tei.js");
drupal_add_js("$path/js/stylesheet.js");
drupal_add_js("$path/js/polygons.js");
drupal_add_js("$path/js/pagectl.js");
drupal_add_js("$path/js/slider.js");
drupal_add_js("$path/js/zoomctl.js");
drupal_add_js("$path/js/join.js");


/*drupal_add_js(
      '  var layers = [
      
          "A1"
          ,
          "A2"
          ,
          "A3"
          ,
          "B1"
          ,
          "B2"
          ,
          "C1"
          ,
          "C2"
          ,
          "D1"
          ,
          "D2"
          ,
          "E1"
          ,
          "E2"
          ,
          "E3"
          ,
          "F1"
          
      ];
      
      
  
      
      var sessions = [
      
          "A"
          ,
          "B"
          ,
          "C"
          ,
          "D"
          ,
          "E"
          ,
          "F"
          
      ];
      
      
  
      
      var joins = [
      
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          ,
          ""
          
      ];
  
      var polygonPages = {
      	  bj1_004_1: 
          {
          page: 1,
          left: 210.784439086914,
          top: 156.903121948242,
          right: 261.764831542969,
          bottom: 178.069610595703
          }
          ,bj1_004_2: 
          {
          page: 1,
          left: 206.495162963867,
          top: 130.669158935547,
          right: 270.833343505859,
          bottom: 153.744918823242
          }
          ,bj1_004_3: 
          {
          page: 1,
          left: 380.545013427734,
          top: 173.972198486328,
          right: 528.030090332031,
          bottom: 196.037078857422
          }
          ,bj1_004_5: 
          {
          page: 1,
          left: 565.750183105469,
          top: 112.429039001465,
          right: 687.913879394531,
          bottom: 194.827911376953
          }
          ,bj1_004_6: 
          {
          page: 1,
          left: 533.801025390625,
          top: 179.562149047852,
          right: 722.206909179688,
          bottom: 200.93879699707
          }
          ,bj1_004_8: 
          {
          page: 1,
          left: 866.411682128906,
          top: 188.785934448242,
          right: 877.542602539063,
          bottom: 197.058029174805
          }
          ,bj1_004_12: 
          {
          page: 1,
          left: 691.528869628906,
          top: 3.16288375854492,
          right: 961.118896484375,
          bottom: 207.419937133789
          }
          ,bj1_004_13: 
          {
          page: 1,
          left: 123.614707946777,
          top: 200.688766479492,
          right: 246.37678527832,
          bottom: 222.551193237305
          }
          ,bj1_004_14: 
          {
          page: 1,
          left: 806.376953125,
          top: 66.7966766357422,
          right: 976.214538574219,
          bottom: 191.484619140625
          }
          ,bj1_004_15: 
          {
          page: 1,
          left: 248.934310913086,
          top: 201.376998901367,
          right: 286.445007324219,
          bottom: 220.000549316406
          }
          ,bj1_004_17: 
          {
          page: 1,
          left: 287.297485351563,
          top: 200.688766479492,
          right: 372.549011230469,
          bottom: 222.065292358398
          }
          ,bj1_004_18: 
          {
          page: 1,
          left: 877.268188476563,
          top: 105.043998718262,
          right: 984.684814453125,
          bottom: 185.915954589844
          }
          ,bj1_004_19: 
          {
          page: 1,
          left: 445.098052978516,
          top: 203.648254394531,
          right: 488.235290527344,
          bottom: 219.897277832031
          }
          ,bj1_004_20: 
          {
          page: 1,
          left: 929.411743164063,
          top: 149.263488769531,
          right: 995.098022460938,
          bottom: 215.14826965332
          }
          ,bj1_004_21: 
          {
          page: 1,
          left: 628.431396484375,
          top: 204.439758300781,
          right: 686.274536132813,
          bottom: 224.273803710938
          }
          ,bj1_004_23: 
          {
          page: 1,
          left: 769.607849121094,
          top: 226.648300170898,
          right: 886.274536132813,
          bottom: 245.271896362305
          }
          ,bj1_004_26: 
          {
          page: 1,
          left: 925.234497070313,
          top: 215.182754516602,
          right: 955.626525878906,
          bottom: 245.272018432617
          }
          ,bj1_004_27: 
          {
          page: 1,
          left: 898.167175292969,
          top: 249.71125793457,
          right: 991.304443359375,
          bottom: 475.568084716797
          }
          ,bj1_004_29: 
          {
          page: 1,
          left: 4.90196084976196,
          top: 242.105926513672,
          right: 43.1372566223145,
          bottom: 274.976409912109
          }
          ,bj1_004_32: 
          {
          page: 1,
          left: 805.672241210938,
          top: 245.463027954102,
          right: 842.968200683594,
          bottom: 264.878051757813
          }
          ,bj1_004_35: 
          {
          page: 1,
          left: 322.952728271484,
          top: 270.041198730469,
          right: 392.156860351563,
          bottom: 290.527008056641
          }
          ,bj1_004_36: 
          {
          page: 1,
          left: 210.784317016602,
          top: 315.389465332031,
          right: 361.764709472656,
          bottom: 337.597991943359
          }
          ,bj1_004_38: 
          {
          page: 1,
          left: 420.588226318359,
          top: 322.140472412109,
          right: 482.352935791016,
          bottom: 335.47412109375
          }
          ,bj1_004_39: 
          {
          page: 1,
          left: 413.725494384766,
          top: 305.099945068359,
          right: 482.352935791016,
          bottom: 322.931976318359
          }
          ,bj1_004_40: 
          {
          page: 1,
          left: 505.541351318359,
          top: 350.122314453125,
          right: 519.031188964844,
          bottom: 358.664978027344
          }
          ,bj1_004_41: 
          {
          page: 1,
          left: 502.131225585938,
          top: 339.352996826172,
          right: 520.034118652344,
          bottom: 360.729614257813
          }
          ,bj1_004_42: 
          {
          page: 1,
          left: 622.3359375,
          top: 529.839416503906,
          right: 635.524841308594,
          bottom: 541.458740234375
          }
          ,bj1_004_43: 
          {
          page: 1,
          left: 618.073303222656,
          top: 521.458740234375,
          right: 629.156005859375,
          bottom: 542.835266113281
          }
          ,bj1_004_10: 
          {
          page: 1,
          left: 860.368347167969,
          top: 185.734619140625,
          right: 884.759521484375,
          bottom: 205.810653686523
          }
          ,bj1_004_44: 
          {
          page: 1,
          left: 342.799133300781,
          top: 594.251037597656,
          right: 385.19775390625,
          bottom: 611.782897949219
          }
          ,bj1_004_46: 
          {
          page: 1,
          left: 610.859680175781,
          top: 690.89697265625,
          right: 625.942687988281,
          bottom: 703.682861328125
          }
          ,bj1_004_47: 
          {
          page: 1,
          left: 609.507507324219,
          top: 689.006286621094,
          right: 663.806091308594,
          bottom: 703.745788574219
          }
          ,bj1_004_50: 
          {
          page: 1,
          left: 388.480377197266,
          top: 717.093078613281,
          right: 398.284301757813,
          bottom: 725.502807617188
          }
          ,bj1_004_51: 
          {
          page: 1,
          left: 384.043273925781,
          top: 708.188659667969,
          right: 400.735290527344,
          bottom: 731.230346679688
          }
          ,bj1_004_56: 
          {
          page: 1,
          left: 151.016159057617,
          top: 837.127624511719,
          right: 290.577911376953,
          bottom: 860.407043457031
          }
          ,bj1_004_57: 
          {
          page: 1,
          left: 286.482177734375,
          top: 837.156433105469,
          right: 642.883605957031,
          bottom: 857.584716796875
          }
          ,bj1_004_59: 
          {
          page: 1,
          left: 81.0113983154297,
          top: 843.120666503906,
          right: 947.678100585938,
          bottom: 885.116760253906
          }
          ,bj1_004_61: 
          {
          page: 1,
          left: 327.450988769531,
          top: 892.718872070313,
          right: 350,
          bottom: 909.759460449219
          }
          ,bj1_004_62: 
          {
          page: 1,
          left: 130.392150878906,
          top: 800.811706542969,
          right: 228.431365966797,
          bottom: 833.682189941406
          }
          ,bj1_004_52: 
          {
          page: 1,
          left: 179.880599975586,
          top: 888.673156738281,
          right: 223.358917236328,
          bottom: 925.775268554688
          }
          ,bj1_004_64: 
          {
          page: 1,
          left: 238.036758422852,
          top: 807.653198242188,
          right: 267.448516845703,
          bottom: 828.651245117188
          }
          ,bj1_004_66: 
          {
          page: 1,
          left: 375.416473388672,
          top: 893.543518066406,
          right: 440.006958007813,
          bottom: 909.759460449219
          }
          ,bj1_004_69: 
          {
          page: 1,
          left: 116.486541748047,
          top: 747.39599609375,
          right: 215.192352294922,
          bottom: 813.378967285156
          }
          ,bj1_004_70: 
          {
          page: 1,
          left: 425.339294433594,
          top: 904.888549804688,
          right: 464.554992675781,
          bottom: 933.002807617188
          }
          ,bj1_004_71: 
          {
          page: 1,
          left: 189.360687255859,
          top: 752.299987792969,
          right: 286.156524658203,
          bottom: 817.86767578125
          }
          ,bj1_004_76: 
          {
          page: 1,
          left: 361.34423828125,
          top: 781.485961914063,
          right: 471.691009521484,
          bottom: 823.261657714844
          }
          ,bj1_004_77: 
          {
          page: 1,
          left: 426.900085449219,
          top: 747.161376953125,
          right: 558.885009765625,
          bottom: 786.882202148438
          }
          ,bj1_004_78: 
          {
          page: 1,
          left: 524.296630859375,
          top: 891.82421875,
          right: 558.397277832031,
          bottom: 912.512390136719
          }
          ,bj1_004_80: 
          {
          page: 1,
          left: 467.589050292969,
          top: 778.234802246094,
          right: 528.150756835938,
          bottom: 809.715759277344
          }
          ,bj1_004_81: 
          {
          page: 1,
          left: 554.879211425781,
          top: 744.96337890625,
          right: 654.083801269531,
          bottom: 775.95166015625
          }
          ,bj1_004_83: 
          {
          page: 1,
          left: 564.817016601563,
          top: 878.35009765625,
          right: 716.71826171875,
          bottom: 898.508911132813
          }
          ,bj1_004_85: 
          {
          page: 1,
          left: 797.001159667969,
          top: 891.135864257813,
          right: 833.909973144531,
          bottom: 912.552856445313
          }
          ,bj1_004_86: 
          {
          page: 1,
          left: 600.922729492188,
          top: 791.499877929688,
          right: 621.683898925781,
          bottom: 806.398620605469
          }
          ,bj1_004_87: 
          {
          page: 1,
          left: 839.677062988281,
          top: 893.929443359375,
          right: 896.193725585938,
          bottom: 910.6904296875
          }
          ,bj1_004_88: 
          {
          page: 1,
          left: 837.716186523438,
          top: 865.388793945313,
          right: 989.965270996094,
          bottom: 895.931457519531
          }
          ,bj1_004_89: 
          {
          page: 1,
          left: 626.098815917969,
          top: 789.830261230469,
          right: 674.104125976563,
          bottom: 808.999572753906
          }
          ,bj1_004_90: 
          {
          page: 1,
          left: 179.27165222168,
          top: 912.552856445313,
          right: 214.285690307617,
          bottom: 933.437866210938
          }
          ,bj1_004_91: 
          {
          page: 1,
          left: 784.313720703125,
          top: 788.972473144531,
          right: 810.924438476563,
          bottom: 803.073303222656
          }
          ,bj1_004_92: 
          {
          page: 1,
          left: 291.825805664063,
          top: 907.138061523438,
          right: 888.464538574219,
          bottom: 935.339477539063
          }
          ,bj1_004_93: 
          {
          page: 1,
          left: 575.670349121094,
          top: 794.252197265625,
          right: 915.867126464844,
          bottom: 826.936401367188
          }
          ,bj1_004_77x: 
          {
          page: 1,
          left: 6.86274528503418,
          top: 948.9287109375,
          right: 44.1176452636719,
          bottom: 980.974365234375
          }
          ,bj1_004_95: 
          {
          page: 1,
          left: 901.400634765625,
          top: 908.967834472656,
          right: 993.837524414063,
          bottom: 933.550842285156
          }
          ,bj1_004_96: 
          {
          page: 1,
          left: 80.3921585083008,
          top: 936.151611328125,
          right: 198.039215087891,
          bottom: 957.036437988281
          }
          ,bj1_004_97: 
          {
          page: 1,
          left: 5.60225963592529,
          top: 415.371307373047,
          right: 43.4173469543457,
          bottom: 950.930725097656
          }
          ,bj1_004_98: 
          {
          page: 1,
          left: 180.901275634766,
          top: 941.265808105469,
          right: 217.948760986328,
          bottom: 973.294189453125
          }
          ,bj1_004_99: 
          {
          page: 1,
          left: 46.2185440063477,
          top: 910.89013671875,
          right: 77.0307693481445,
          bottom: 957.714904785156
          }
          ,bj1_004_101: 
          {
          page: 1,
          left: 44.0638656616211,
          top: 689.147399902344,
          right: 81.8789596557617,
          bottom: 840.929138183594
          }
          ,bj1_004_100: 
          {
          page: 1,
          left: 256.862731933594,
          top: 945.423400878906,
          right: 277.450988769531,
          bottom: 962.4638671875
          }
          ,bj1_004_107: 
          {
          page: 1,
          left: 278.092590332031,
          top: 936.268798828125,
          right: 353.063812255859,
          bottom: 955.823547363281
          }
          ,bj1_004_89x: 
          {
          page: 1,
          left: 276.816558837891,
          top: 927.45166015625,
          right: 352.941162109375,
          bottom: 955.387084960938
          }
          ,bj1_004_102: 
          {
          page: 1,
          left: 43.7478790283203,
          top: 681.046020507813,
          right: 90.0522384643555,
          bottom: 719.5
          }
          ,bj1_004_114: 
          {
          page: 1,
          left: 469.758514404297,
          top: 926.982360839844,
          right: 521.040649414063,
          bottom: 948.041320800781
          }
          ,bj1_004_119: 
          {
          page: 1,
          left: 662.141784667969,
          top: 939.091430664063,
          right: 751.131164550781,
          bottom: 962.585815429688
          }
          ,bj1_004_110: 
          {
          page: 1,
          left: 359.068511962891,
          top: 940.575500488281,
          right: 477.941009521484,
          bottom: 955.736206054688
          }
          ,bj1_004_92x: 
          {
          page: 1,
          left: 481.004943847656,
          top: 941.070190429688,
          right: 519.607849121094,
          bottom: 955.241577148438
          }
          ,bj1_004_4: 
          {
          page: 1,
          left: 484.848388671875,
          top: 137.200393676758,
          right: 575.31201171875,
          bottom: 201.345748901367
          }
          ,bj1_004_9: 
          {
          page: 1,
          left: 78.4312362670898,
          top: 196.012588500977,
          right: 115.340179443359,
          bottom: 225.344604492188
          }
          ,bj1_004_11: 
          {
          page: 1,
          left: 854.449279785156,
          top: 195.367950439453,
          right: 883.107116699219,
          bottom: 213.991455078125
          }
          ,bj1_004_24: 
          {
          page: 1,
          left: 770.868347167969,
          top: 210.738525390625,
          right: 903.081298828125,
          bottom: 244.81965637207
          }
          ,bj1_004_28: 
          {
          page: 1,
          left: 210.784317016602,
          top: 248.437911987305,
          right: 250,
          bottom: 267.061431884766
          }
          ,bj1_004_37: 
          {
          page: 1,
          left: 210.784317016602,
          top: 307.474456787109,
          right: 256.862731933594,
          bottom: 333.221466064453
          }
          ,bj1_004_45: 
          {
          page: 1,
          left: 354.293395996094,
          top: 595.342895507813,
          right: 380.66259765625,
          bottom: 610.691223144531
          }
          ,bj1_004_48: 
          {
          page: 1,
          left: 220.135238647461,
          top: 709.171020507813,
          right: 250.367980957031,
          bottom: 727.1845703125
          }
          ,bj1_004_53: 
          {
          page: 1,
          left: 90.8169937133789,
          top: 869.951171875,
          right: 334.234954833984,
          bottom: 924.868041992188
          }
          ,bj1_004_67: 
          {
          page: 1,
          left: 276.283752441406,
          top: 790.714782714844,
          right: 367.656951904297,
          bottom: 827.035827636719
          }
          ,bj1_004_72: 
          {
          page: 1,
          left: 284.124603271484,
          top: 748.387084960938,
          right: 418.679931640625,
          bottom: 790.342651367188
          }
          ,bj1_004_74: 
          {
          page: 1,
          left: 448.718048095703,
          top: 890.526733398438,
          right: 519.607971191406,
          bottom: 912.194702148438
          }
          ,bj1_004_79: 
          {
          page: 1,
          left: 524.812683105469,
          top: 892.048522949219,
          right: 558.913330078125,
          bottom: 912.73681640625
          }
          ,bj1_004_82: 
          {
          page: 1,
          left: 559.348022460938,
          top: 895.755981445313,
          right: 730.014892578125,
          bottom: 911.824157714844
          }
          ,bj1_004_94: 
          {
          page: 1,
          left: 881.900451660156,
          top: 923.633911132813,
          right: 927.601745605469,
          bottom: 954.670776367188
          }
          ,bj1_004_108: 
          {
          page: 1,
          left: 316.176483154297,
          top: 929.372253417969,
          right: 347.426544189453,
          bottom: 944.532897949219
          }
          ,bj1_004_103: 
          {
          page: 1,
          left: 62.5943069458008,
          top: 415.805999755859,
          right: 222.4736328125,
          bottom: 578.546936035156
          }
          ,bj1_004_105: 
          {
          page: 1,
          left: 160.922622680664,
          top: 446.119506835938,
          right: 202.177947998047,
          bottom: 495.784301757813
          }
          ,bj1_004_104: 
          {
          page: 1,
          left: 180.926361083984,
          top: 486.925476074219,
          right: 221.491287231445,
          bottom: 515.499267578125
          }
          ,bj1_004_106: 
          {
          page: 1,
          left: 177.168441772461,
          top: 427.656982421875,
          right: 221.749649047852,
          bottom: 492.891906738281
          }
          ,bj1_004_112: 
          {
          page: 1,
          left: 524.132690429688,
          top: 940.917907714844,
          right: 578.431396484375,
          bottom: 957.106140136719
          }
          ,bj1_004_113: 
          {
          page: 1,
          left: 524.489990234375,
          top: 943.1611328125,
          right: 582.559326171875,
          bottom: 957.522766113281
          }
          ,bj1_004_116: 
          {
          page: 1,
          left: 582.956237792969,
          top: 941.526794433594,
          right: 656.108520507813,
          bottom: 957.714904785156
          }
          ,bj1_004_117: 
          {
          page: 1,
          left: 522.624389648438,
          top: 927.165283203125,
          right: 601.055786132813,
          bottom: 946.3974609375
          }
          ,bj1_004_120: 
          {
          page: 1,
          left: 663.213439941406,
          top: 938.482482910156,
          right: 753.711120605469,
          bottom: 963.194580078125
          }
          ,bj1_004_121: 
          {
          page: 1,
          left: 759.590759277344,
          top: 938.747314453125,
          right: 804.479064941406,
          bottom: 956.6826171875
          }
          ,bj1_004_122: 
          {
          page: 1,
          left: 748.901489257813,
          top: 938.747375488281,
          right: 761.2958984375,
          bottom: 957.688537597656
          }
          ,bj1_004_123: 
          {
          page: 1,
          left: 35.8055419921875,
          top: 561.458923339844,
          right: 71.611083984375,
          bottom: 682.835632324219
          }
          ,bj1_004_124: 
          {
          page: 1,
          left: 804.413452148438,
          top: 938.05908203125,
          right: 908.420349121094,
          bottom: 958.747253417969
          }
          ,bj1_004_125: 
          {
          page: 1,
          left: 43.4782066345215,
          top: 416.600189208984,
          right: 70.7587051391602,
          bottom: 559.39404296875
          }
          ,bj1_004_126: 
          {
          page: 1,
          left: 231.031600952148,
          top: 962.188720703125,
          right: 271.952270507813,
          bottom: 982.876892089844
          }
          ,bj1_004_127: 
          {
          page: 1,
          left: 231.88410949707,
          top: 952.449890136719,
          right: 272.804809570313,
          bottom: 982.773803710938
          }
          ,bj1_004_128: 
          {
          page: 1,
          left: 554.134643554688,
          top: 962.876892089844,
          right: 761.295776367188,
          bottom: 987.006469726563
          }
          ,bj1_004_130: 
          {
          page: 1,
          left: 749.140808105469,
          top: 972.009826660156,
          right: 781.578918457031,
          bottom: 999.752746582031
          }
          ,bj1_004_131: 
          {
          page: 1,
          left: 755.328369140625,
          top: 953.929565429688,
          right: 794.544067382813,
          bottom: 973.2412109375
          }
          ,bj1_004_133: 
          {
          page: 1,
          left: 763.853271484375,
          top: 964.941650390625,
          right: 889.172912597656,
          bottom: 985.630004882813
          }
          ,bj1_004_135: 
          {
          page: 1,
          left: 892.583129882813,
          top: 962.188720703125,
          right: 908.780944824219,
          bottom: 984.25341796875
          }
          ,bj1_004_136: 
          {
          page: 1,
          left: 890.878173828125,
          top: 962.876892089844,
          right: 973.572021484375,
          bottom: 983.565124511719
          }
          ,bj1_004_137: 
          {
          page: 1,
          left: 891.318725585938,
          top: 962.146850585938,
          right: 974.012634277344,
          bottom: 982.835083007813
          }
          ,bj1_004_25: 
          {
          page: 1,
          left: 880.316772460938,
          top: 237.546676635742,
          right: 910.784301757813,
          bottom: 253.978424072266
          }
          ,bj1_004_54: 
          {
          page: 1,
          left: 76.3482284545898,
          top: 816.104309082031,
          right: 966.218017578125,
          bottom: 854.962890625
          }
          ,bj1_004_34: 
          {
          page: 1,
          left: 343.713928222656,
          top: 282.146362304688,
          right: 374.855773925781,
          bottom: 303.563507080078
          }
          ,bj1_005_1: 
          {
          page: 2,
          left: 320.271759033203,
          top: 71.2121200561523,
          right: 352.399322509766,
          bottom: 94.6969680786133
          }
          ,bj1_005_3: 
          {
          page: 2,
          left: 356.415283203125,
          top: 71.9696960449219,
          right: 421.674407958984,
          bottom: 97.7272720336914
          }
          ,bj1_005_4: 
          {
          page: 2,
          left: 581.308288574219,
          top: 74.2424240112305,
          right: 717.850463867188,
          bottom: 100.75757598877
          }
          ,bj1_005_5: 
          {
          page: 2,
          left: 638.535522460938,
          top: 62.1212120056152,
          right: 743.9541015625,
          bottom: 107.575759887695
          }
          ,bj1_005_6: 
          {
          page: 2,
          left: 832.304931640625,
          top: 81.8181838989258,
          right: 854.392639160156,
          bottom: 94.6969680786133
          }
          ,bj1_005_7: 
          {
          page: 2,
          left: 851.380676269531,
          top: 58.3333320617676,
          right: 978.887023925781,
          bottom: 153.787872314453
          }
          ,bj1_005_8: 
          {
          page: 2,
          left: 162.645843505859,
          top: 99.2424240112305,
          right: 241.960784912109,
          bottom: 119.696968078613
          }
          ,bj1_005_9: 
          {
          page: 2,
          left: 162.463363647461,
          top: 79.2699661254883,
          right: 267.881958007813,
          bottom: 118.732795715332
          }
          ,bj1_005_10: 
          {
          page: 2,
          left: 275.639953613281,
          top: 100.550880432129,
          right: 358.697021484375,
          bottom: 120.798927307129
          }
          ,bj1_005_11: 
          {
          page: 2,
          left: 283.854461669922,
          top: 5.16533422470093,
          right: 439.015960693359,
          bottom: 76.5151519775391
          }
          ,bj1_005_12: 
          {
          page: 2,
          left: 455.901245117188,
          top: 98.8291320800781,
          right: 574.55419921875,
          bottom: 118.732795715332
          }
          ,bj1_005_14: 
          {
          page: 2,
          left: 444.843292236328,
          top: 166.550155639648,
          right: 509.716247558594,
          bottom: 191.142227172852
          }
          ,bj1_005_15: 
          {
          page: 2,
          left: 444.843292236328,
          top: 165.384658813477,
          right: 508.171661376953,
          bottom: 192.307723999023
          }
          ,bj1_005_17: 
          {
          page: 2,
          left: 261.566070556641,
          top: 197.132553100586,
          right: 277.946868896484,
          bottom: 216.111618041992
          }
          ,bj1_005_18: 
          {
          page: 2,
          left: 789.090881347656,
          top: 196.647277832031,
          right: 815.433044433594,
          bottom: 209.026489257813
          }
          ,bj1_005_19: 
          {
          page: 2,
          left: 786.954650878906,
          top: 193.745941162109,
          right: 854.456726074219,
          bottom: 209.993530273438
          }
          ,bj1_005_20: 
          {
          page: 2,
          left: 162.596954345703,
          top: 215.521148681641,
          right: 231.161865234375,
          bottom: 232.224700927734
          }
          ,bj1_005_21: 
          {
          page: 2,
          left: 162.596832275391,
          top: 215.521148681641,
          right: 232.141357421875,
          bottom: 238.950424194336
          }
          ,bj1_005_22: 
          {
          page: 2,
          left: 424.123077392578,
          top: 238.211349487305,
          right: 443.223358154297,
          bottom: 254.925430297852
          }
          ,bj1_005_23: 
          {
          page: 2,
          left: 423.143615722656,
          top: 237.841812133789,
          right: 446.161956787109,
          bottom: 261.936492919922
          }
          ,bj1_005_24: 
          {
          page: 2,
          left: 377.107147216797,
          top: 312.786437988281,
          right: 397.676635742188,
          bottom: 330.5986328125
          }
          ,bj1_005_25: 
          {
          page: 2,
          left: 376.127655029297,
          top: 312.416870117188,
          right: 389.840667724609,
          bottom: 323.503356933594
          }
          ,bj1_005_26: 
          {
          page: 2,
          left: 375.148162841797,
          top: 312.04736328125,
          right: 400.615173339844,
          bottom: 324.242401123047
          }
          ,bj1_005_27: 
          {
          page: 2,
          left: 403.553649902344,
          top: 312.047241210938,
          right: 424.612854003906,
          bottom: 329.120330810547
          }
          ,bj1_005_29: 
          {
          page: 2,
          left: 329.601440429688,
          top: 336.141845703125,
          right: 373.189208984375,
          bottom: 355.062866210938
          }
          ,bj1_005_30: 
          {
          page: 2,
          left: 337.927154541016,
          top: 323.503356933594,
          right: 387.881713867188,
          bottom: 339.098236083984
          }
          ,bj1_005_31: 
          {
          page: 2,
          left: 438.815704345703,
          top: 335.402740478516,
          right: 477.505798339844,
          bottom: 353.954193115234
          }
          ,bj1_005_32: 
          {
          page: 2,
          left: 436.856628417969,
          top: 312.047454833984,
          right: 492.688171386719,
          bottom: 342.42431640625
          }
          ,bj1_005_33: 
          {
          page: 2,
          left: 323.021911621094,
          top: 450.856414794922,
          right: 795.952392578125,
          bottom: 480.08984375
          }
          ,bj1_005_35: 
          {
          page: 2,
          left: 795.791442871094,
          top: 451.913940429688,
          right: 808.473449707031,
          bottom: 480.701782226563
          }
          ,bj1_005_36: 
          {
          page: 2,
          left: 797.673461914063,
          top: 451.015869140625,
          right: 810.35546875,
          bottom: 479.963226318359
          }
          ,bj1_005_39: 
          {
          page: 2,
          left: 93.4143753051758,
          top: 543.741760253906,
          right: 185.082702636719,
          bottom: 570.223999023438
          }
          ,bj1_005_38: 
          {
          page: 2,
          left: 483.659637451172,
          top: 515.019714355469,
          right: 919.302673339844,
          bottom: 542.424133300781
          }
          ,bj1_005_42: 
          {
          page: 2,
          left: 185.082702636719,
          top: 545.059204101563,
          right: 204.289413452148,
          bottom: 568.906494140625
          }
          ,bj1_005_43: 
          {
          page: 2,
          left: 80.3189315795898,
          top: 575.494140625,
          right: 899.222961425781,
          bottom: 632.015869140625
          }
          ,bj1_005_44: 
          {
          page: 2,
          left: 408.578979492188,
          top: 548.089538574219,
          right: 459.214813232422,
          bottom: 565.612731933594
          }
          ,bj1_005_45: 
          {
          page: 2,
          left: 415.563140869141,
          top: 532.542785644531,
          right: 554.375183105469,
          bottom: 554.018432617188
          }
          ,bj1_005_46: 
          {
          page: 2,
          left: 441.061767578125,
          top: 561.12841796875,
          right: 472.220001220703,
          bottom: 578.787780761719
          }
          ,bj1_005_47: 
          {
          page: 2,
          left: 555.248229980469,
          top: 525.559936523438,
          right: 600.645935058594,
          bottom: 556.653503417969
          }
          ,bj1_005_49: 
          {
          page: 2,
          left: 459.214813232422,
          top: 554.677307128906,
          right: 486.278747558594,
          bottom: 566.271484375
          }
          ,bj1_005_51: 
          {
          page: 2,
          left: 163.256927490234,
          top: 582.476928710938,
          right: 182.463638305664,
          bottom: 597.628479003906
          }
          ,bj1_005_52: 
          {
          page: 2,
          left: 182.463638305664,
          top: 568.906494140625,
          right: 264.528594970703,
          bottom: 585.111938476563
          }
          ,bj1_005_54: 
          {
          page: 2,
          left: 174.606323242188,
          top: 580.764343261719,
          right: 206.908477783203,
          bottom: 600.000061035156
          }
          ,bj1_005_56: 
          {
          page: 2,
          left: 211.273712158203,
          top: 583.135559082031,
          right: 291.592620849609,
          bottom: 595.652099609375
          }
          ,bj1_005_57: 
          {
          page: 2,
          left: 267.147674560547,
          top: 566.93017578125,
          right: 321.275726318359,
          bottom: 589.723266601563
          }
          ,bj1_005_59: 
          {
          page: 2,
          left: 295.172088623047,
          top: 582.575744628906,
          right: 344.367431640625,
          bottom: 596.212097167969
          }
          ,bj1_005_61: 
          {
          page: 2,
          left: 349.212646484375,
          top: 580.764343261719,
          right: 426.912536621094,
          bottom: 596.969787597656
          }
          ,bj1_005_63: 
          {
          page: 2,
          left: 430.404754638672,
          top: 580.764221191406,
          right: 519.454040527344,
          bottom: 596.310913085938
          }
          ,bj1_005_65: 
          {
          page: 2,
          left: 518.187927246094,
          top: 583.135681152344,
          right: 645.650634765625,
          bottom: 596.9697265625
          }
          ,bj1_005_66: 
          {
          page: 2,
          left: 520.327026367188,
          top: 572.562622070313,
          right: 650.408813476563,
          bottom: 594.696960449219
          }
          ,bj1_005_68: 
          {
          page: 2,
          left: 649.535766601563,
          top: 575.494018554688,
          right: 896.603942871094,
          bottom: 601.976257324219
          }
          ,bj1_005_69: 
          {
          page: 2,
          left: 94.2873916625977,
          top: 606.587585449219,
          right: 370.165557861328,
          bottom: 630.039489746094
          }
          ,bj1_005_72: 
          {
          page: 2,
          left: 359.689178466797,
          top: 667.061889648438,
          right: 412.944061279297,
          bottom: 691.172607421875
          }
          ,bj1_005_74: 
          {
          page: 2,
          left: 293.338714599609,
          top: 701.449279785156,
          right: 424.293487548828,
          bottom: 717.654724121094
          }
          ,bj1_005_75: 
          {
          page: 2,
          left: 293.338806152344,
          top: 702.108032226563,
          right: 424.293609619141,
          bottom: 718.313659667969
          }
          ,bj1_005_76: 
          {
          page: 2,
          left: 802.918579101563,
          top: 710.453918457031,
          right: 833.655334472656,
          bottom: 737.722045898438
          }
          ,bj1_005_77: 
          {
          page: 2,
          left: 802.105529785156,
          top: 668.972595214844,
          right: 920.849914550781,
          bottom: 710.366577148438
          }
          ,bj1_005_79: 
          {
          page: 2,
          left: 893.111633300781,
          top: 674.044738769531,
          right: 999.621643066406,
          bottom: 730.566589355469
          }
          ,bj1_005_80: 
          {
          page: 2,
          left: 889.739868164063,
          top: 740.925048828125,
          right: 918.820861816406,
          bottom: 759.106689453125
          }
          ,bj1_005_81: 
          {
          page: 2,
          left: 900.126037597656,
          top: 733.996765136719,
          right: 917.43603515625,
          bottom: 752.837219238281
          }
          ,bj1_005_82: 
          {
          page: 2,
          left: 118.852661132813,
          top: 769.383544921875,
          right: 152.328887939453,
          bottom: 791.745056152344
          }
          ,bj1_005_83: 
          {
          page: 2,
          left: 125.716651916504,
          top: 750.065795898438,
          right: 158.891830444336,
          bottom: 763.241088867188
          }
          ,bj1_005_78: 
          {
          page: 2,
          left: 822.396057128906,
          top: 702.766723632813,
          right: 900.968933105469,
          bottom: 722.266174316406
          }
          ,bj1_005_85: 
          {
          page: 2,
          left: 448.738433837891,
          top: 797.628479003906,
          right: 482.786590576172,
          bottom: 813.17529296875
          }
          ,bj1_005_86: 
          {
          page: 2,
          left: 456.595611572266,
          top: 785.111877441406,
          right: 474.929321289063,
          bottom: 802.635009765625
          }
          ,bj1_005_87: 
          {
          page: 2,
          left: 355.477966308594,
          top: 831.163208007813,
          right: 392.145355224609,
          bottom: 862.566711425781
          }
          ,bj1_005_88: 
          {
          page: 2,
          left: 364.927276611328,
          top: 810.540222167969,
          right: 404.213745117188,
          bottom: 826.086975097656
          }
          ,bj1_005_16: 
          {
          page: 2,
          left: 259.85546875,
          top: 209.803939819336,
          right: 279.935211181641,
          bottom: 226.203262329102
          }
          ,bj1_006_01: 
          {
          page: 3,
          left: 197.544464111328,
          top: 121.212120056152,
          right: 279.771087646484,
          bottom: 140.909088134766
          }
          ,bj1_006_02: 
          {
          page: 3,
          left: 192.61262512207,
          top: 100.909782409668,
          right: 306.845855712891,
          bottom: 136.394546508789
          }
          ,bj1_006_03: 
          {
          page: 3,
          left: 377.039184570313,
          top: 121.212120056152,
          right: 458.263031005859,
          bottom: 137.878784179688
          }
          ,bj1_006_04: 
          {
          page: 3,
          left: 385.061279296875,
          top: 100.757568359375,
          right: 548.511779785156,
          bottom: 122.727272033691
          }
          ,bj1_006_05: 
          {
          page: 3,
          left: 12.0331649780273,
          top: 115.909080505371,
          right: 59.1630630493164,
          bottom: 139.393936157227
          }
          ,bj1_006_06: 
          {
          page: 3,
          left: 459.265808105469,
          top: 119.696960449219,
          right: 597.647216796875,
          bottom: 138.636352539063
          }
          ,bj1_006_07: 
          {
          page: 3,
          left: 463.27685546875,
          top: 122.727272033691,
          right: 601.658264160156,
          bottom: 141.66667175293
          }
          ,bj1_006_08: 
          {
          page: 3,
          left: 703.460632324219,
          top: 130.303024291992,
          right: 742.568420410156,
          bottom: 153.820877075195
          }
          ,bj1_006_09: 
          {
          page: 3,
          left: 538.484130859375,
          top: 122.727272033691,
          right: 596.644409179688,
          bottom: 141.66667175293
          }
          ,bj1_006_10: 
          {
          page: 3,
          left: 340.939666748047,
          top: 302.272735595703,
          right: 432.191192626953,
          bottom: 328.030334472656
          }
          ,bj1_006_11: 
          {
          page: 3,
          left: 382.044311523438,
          top: 286.351593017578,
          right: 444.559387207031,
          bottom: 315.300231933594
          }
          ,bj1_006_12: 
          {
          page: 3,
          left: 771.125305175781,
          top: 299.999969482422,
          right: 820.2607421875,
          bottom: 327.272735595703
          }
          ,bj1_006_14: 
          {
          page: 3,
          left: 481.326599121094,
          top: 362.878814697266,
          right: 510.406768798828,
          bottom: 384.848510742188
          }
          ,bj1_006_15: 
          {
          page: 3,
          left: 400.102752685547,
          top: 343.939422607422,
          right: 495.365295410156,
          bottom: 369.697021484375
          }
          ,bj1_006_17: 
          {
          page: 3,
          left: 500.379119873047,
          top: 358.333374023438,
          right: 525.448181152344,
          bottom: 371.969696044922
          }
          ,bj1_006_18: 
          {
          page: 3,
          left: 525.888427734375,
          top: 358.351837158203,
          right: 650.231079101563,
          bottom: 375.018493652344
          }
          ,bj1_006_16: 
          {
          page: 3,
          left: 666.837890625,
          top: 372.727264404297,
          right: 696.920837402344,
          bottom: 401.51513671875
          }
          ,bj1_006_20: 
          {
          page: 3,
          left: 645.657470703125,
          top: 349.149963378906,
          right: 685.76806640625,
          bottom: 366.57421875
          }
          ,bj1_006_19: 
          {
          page: 3,
          left: 642.771545410156,
          top: 363.636352539063,
          right: 655.807495117188,
          bottom: 376.51513671875
          }
          ,bj1_006_22: 
          {
          page: 3,
          left: 705.945678710938,
          top: 365.909118652344,
          right: 745.053466796875,
          bottom: 385.606109619141
          }
          ,bj1_006_21: 
          {
          page: 3,
          left: 664.832397460938,
          top: 356.818176269531,
          right: 835.302185058594,
          bottom: 374.242462158203
          }
          ,bj1_006_23: 
          {
          page: 3,
          left: 311.628204345703,
          top: 395.862579345703,
          right: 351.738739013672,
          bottom: 418.822967529297
          }
          ,bj1_006_25: 
          {
          page: 3,
          left: 354.823974609375,
          top: 395.862365722656,
          right: 546.120422363281,
          bottom: 419.98828125
          }
          ,bj1_006_26: 
          {
          page: 3,
          left: 493.668395996094,
          top: 380.7109375,
          right: 553.062744140625,
          bottom: 400.058288574219
          }
          ,bj1_006_28: 
          {
          page: 3,
          left: 547.663269042969,
          top: 395.279724121094,
          right: 657.96728515625,
          bottom: 417.074615478516
          }
          ,bj1_006_32: 
          {
          page: 3,
          left: 822.266296386719,
          top: 425.131622314453,
          right: 942.597961425781,
          bottom: 449.901214599609
          }
          ,bj1_006_33: 
          {
          page: 3,
          left: 822.266418457031,
          top: 425.131561279297,
          right: 942.598022460938,
          bottom: 449.901092529297
          }
          ,bj1_006_30: 
          {
          page: 3,
          left: 674.903442382813,
          top: 402.338531494141,
          right: 704.550354003906,
          bottom: 419.202972412109
          }
          ,bj1_006_31: 
          {
          page: 3,
          left: 687.111206054688,
          top: 377.173919677734,
          right: 736.813293457031,
          bottom: 397.727264404297
          }
          ,bj1_006_34: 
          {
          page: 3,
          left: 175.027801513672,
          top: 543.526123046875,
          right: 383.785095214844,
          bottom: 569.28369140625
          }
          ,bj1_006_36: 
          {
          page: 3,
          left: 268.922973632813,
          top: 525.688781738281,
          right: 316.782165527344,
          bottom: 552.479431152344
          }
          ,bj1_006_37: 
          {
          page: 3,
          left: 292.876098632813,
          top: 574.767028808594,
          right: 826.654968261719,
          bottom: 598.309997558594
          }
          ,bj1_006_39: 
          {
          page: 3,
          left: 590.59326171875,
          top: 640.882995605469,
          right: 675.655212402344,
          bottom: 659.587341308594
          }
          ,bj1_006_40: 
          {
          page: 3,
          left: 561.547729492188,
          top: 622.178771972656,
          right: 639.002563476563,
          bottom: 660.632202148438
          }
          ,bj1_006_38: 
          {
          page: 3,
          left: 754.493286132813,
          top: 574.947814941406,
          right: 825.72412109375,
          bottom: 598.772155761719
          }
          ,bj1_006_41: 
          {
          page: 3,
          left: 921.159484863281,
          top: 855.929992675781,
          right: 949.513549804688,
          bottom: 872.021911621094
          }
          ,bj1_006_42: 
          {
          page: 3,
          left: 921.159606933594,
          top: 855.407592773438,
          right: 973.71826171875,
          bottom: 877.76904296875
          }
          ,bj1_006_44: 
          {
          page: 3,
          left: 642.252868652344,
          top: 930.302978515625,
          right: 853.178955078125,
          bottom: 953.265319824219
          }
          ,bj1_006_48: 
          {
          page: 3,
          left: 918.531616210938,
          top: 903.787902832031,
          right: 997.749938964844,
          bottom: 963.636352539063
          }
          ,bj1_006_46: 
          {
          page: 3,
          left: 866.387939453125,
          top: 942.424255371094,
          right: 926.5537109375,
          bottom: 962.878845214844
          }
          ,bj1_006_43: 
          {
          page: 3,
          left: 652.799194335938,
          top: 950,
          right: 860.371337890625,
          bottom: 966.666748046875
          }
          ,bj1_006_45: 
          {
          page: 3,
          left: 629.735656738281,
          top: 968.939392089844,
          right: 713.9677734375,
          bottom: 998.48486328125
          }
          ,bj1_006_47: 
          {
          page: 3,
          left: 748.061767578125,
          top: 967.424255371094,
          right: 988.72509765625,
          bottom: 992.424255371094
          }
          ,bj1_006_07a: 
          {
          page: 3,
          left: 588.622314453125,
          top: 127.272720336914,
          right: 610.68310546875,
          bottom: 149.999984741211
          }
          ,bj1_006_07b: 
          {
          page: 3,
          left: 588.622314453125,
          top: 127.272720336914,
          right: 610.68310546875,
          bottom: 149.999984741211
          }
          ,bj1_007_1a: 
          {
          page: 4,
          left: 89.0283126831055,
          top: 80.4544982910156,
          right: 145.046127319336,
          bottom: 121.454574584961
          }
          ,bj1_007_2: 
          {
          page: 4,
          left: 752.239196777344,
          top: 89.7272186279297,
          right: 831.264343261719,
          bottom: 103.272773742676
          }
          ,bj1_007_5: 
          {
          page: 4,
          left: 821.261169433594,
          top: 100.954582214355,
          right: 860.273559570313,
          bottom: 126.863670349121
          }
          ,bj1_007_6: 
          {
          page: 4,
          left: 758.241088867188,
          top: 45.6363410949707,
          right: 808.257019042969,
          bottom: 82.7726821899414
          }
          ,bj1_007_7: 
          {
          page: 4,
          left: 836.265930175781,
          top: 87.409049987793,
          right: 928.295166015625,
          bottom: 111.409126281738
          }
          ,bj1_007_8: 
          {
          page: 4,
          left: 144.045806884766,
          top: 112.181846618652,
          right: 493.156829833984,
          bottom: 145.045471191406
          }
          ,bj1_007_9: 
          {
          page: 4,
          left: 807.256713867188,
          top: 46.409065246582,
          right: 996.316833496094,
          bottom: 84.3181381225586
          }
          ,bj1_007_10: 
          {
          page: 4,
          left: 299.095123291016,
          top: 104.818222045898,
          right: 492.156494140625,
          bottom: 126.090942382813
          }
          ,bj1_007_4: 
          {
          page: 4,
          left: 671.213439941406,
          top: 26.6818084716797,
          right: 764.243041992188,
          bottom: 69.2272415161133
          }
          ,bj1_007_11: 
          {
          page: 4,
          left: 349.111022949219,
          top: 309.090911865234,
          right: 539.301940917969,
          bottom: 327.272735595703
          }
          ,bj1_007_12: 
          {
          page: 4,
          left: 539.301940917969,
          top: 309.051361083984,
          right: 750.673522949219,
          bottom: 331.304260253906
          }
          ,bj1_007_15: 
          {
          page: 4,
          left: 933.340209960938,
          top: 342.055328369141,
          right: 946.388000488281,
          bottom: 352.845825195313
          }
          ,bj1_007_16: 
          {
          page: 4,
          left: 930.730773925781,
          top: 328.616577148438,
          right: 948.997497558594,
          bottom: 354.189697265625
          }
          ,bj1_007_17: 
          {
          page: 4,
          left: 574.095581054688,
          top: 358.893188476563,
          right: 659.340148925781,
          bottom: 379.762786865234
          }
          ,bj1_007_20: 
          {
          page: 4,
          left: 726.420227050781,
          top: 361.462341308594,
          right: 751.645751953125,
          bottom: 383.675842285156
          }
          ,bj1_007_23: 
          {
          page: 4,
          left: 784.597290039063,
          top: 370.355712890625,
          right: 848.965637207031,
          bottom: 384.505889892578
          }
          ,bj1_007_13: 
          {
          page: 4,
          left: 629.765441894531,
          top: 348.142333984375,
          right: 660.2099609375,
          bottom: 374.387298583984
          }
          ,bj1_007_14: 
          {
          page: 4,
          left: 636.724304199219,
          top: 340.711608886719,
          right: 660.2099609375,
          bottom: 358.893371582031
          }
          ,bj1_007_19: 
          {
          page: 4,
          left: 721.66162109375,
          top: 363.833984375,
          right: 734.709350585938,
          bottom: 375.928894042969
          }
          ,bj1_007_24: 
          {
          page: 4,
          left: 139.220504760742,
          top: 400.136444091797,
          right: 270.085876464844,
          bottom: 422.818206787109
          }
          ,bj1_007_22: 
          {
          page: 4,
          left: 780.196960449219,
          top: 386.798767089844,
          right: 821.949279785156,
          bottom: 415.099029541016
          }
          ,bj1_007_27: 
          {
          page: 4,
          left: 303.523406982422,
          top: 423.399200439453,
          right: 494.888610839844,
          bottom: 442.924957275391
          }
          ,bj1_007_21: 
          {
          page: 4,
          left: 718.284606933594,
          top: 348.379211425781,
          right: 767.865600585938,
          bottom: 370.632354736328
          }
          ,bj1_007_26: 
          {
          page: 4,
          left: 922.995361328125,
          top: 415.921600341797,
          right: 958.300659179688,
          bottom: 443.996826171875
          }
          ,bj1_007_28: 
          {
          page: 4,
          left: 933.237915039063,
          top: 408.181823730469,
          right: 948.536926269531,
          bottom: 421.818206787109
          }
          ,bj1_007_29: 
          {
          page: 4,
          left: 937.945373535156,
          top: 408.181823730469,
          right: 968.543273925781,
          bottom: 422.727264404297
          }
          ,bj1_007_30: 
          {
          page: 4,
          left: 78.8485641479492,
          top: 432.500061035156,
          right: 118.037536621094,
          bottom: 456.681823730469
          }
          ,bj1_007_31: 
          {
          page: 4,
          left: 60.8428382873535,
          top: 415.181823730469,
          right: 130.276733398438,
          bottom: 440.636383056641
          }
          ,bj1_007_32: 
          {
          page: 4,
          left: 122.86255645752,
          top: 419.363647460938,
          right: 162.051528930664,
          bottom: 443.909118652344
          }
          ,bj1_007_33: 
          {
          page: 4,
          left: 131.04167175293,
          top: 410.818237304688,
          right: 154.048980712891,
          bottom: 430.545501708984
          }
          ,bj1_007_34: 
          {
          page: 4,
          left: 144.045806884766,
          top: 427.45458984375,
          right: 179.056945800781,
          bottom: 443.318176269531
          }
          ,bj1_007_36: 
          {
          page: 4,
          left: 171.054397583008,
          top: 431.318206787109,
          right: 208.066162109375,
          bottom: 455.318145751953
          }
          ,bj1_007_37: 
          {
          page: 4,
          left: 176.05598449707,
          top: 417.772796630859,
          right: 231.073486328125,
          bottom: 432.863677978516
          }
          ,bj1_007_38: 
          {
          page: 4,
          left: 224.071258544922,
          top: 425.909118652344,
          right: 254.080795288086,
          bottom: 447.95458984375
          }
          ,bj1_007_39: 
          {
          page: 4,
          left: 232.073791503906,
          top: 417.000061035156,
          right: 254.080795288086,
          bottom: 431.318206787109
          }
          ,bj1_007_43: 
          {
          page: 4,
          left: 729.231872558594,
          top: 448.727325439453,
          right: 823.261779785156,
          bottom: 466.269622802734
          }
          ,bj1_007_44: 
          {
          page: 4,
          left: 727.541564941406,
          top: 442.225860595703,
          right: 831.988647460938,
          bottom: 466.429534912109
          }
          ,bj1_007_45: 
          {
          page: 4,
          left: 314.099884033203,
          top: 481.227264404297,
          right: 346.110046386719,
          bottom: 511.409057617188
          }
          ,bj1_007_46: 
          {
          page: 4,
          left: 304.096710205078,
          top: 460.727294921875,
          right: 369.117370605469,
          bottom: 480.454528808594
          }
          ,bj1_007_47: 
          {
          page: 4,
          left: 496.157775878906,
          top: 481.227264404297,
          right: 525.1669921875,
          bottom: 513.727233886719
          }
          ,bj1_007_48: 
          {
          page: 4,
          left: 502.159698486328,
          top: 459.954559326172,
          right: 635.201965332031,
          bottom: 479.681854248047
          }
          ,bj1_007_49: 
          {
          page: 4,
          left: 625.95751953125,
          top: 475.045440673828,
          right: 681.975402832031,
          bottom: 492.454559326172
          }
          ,bj1_007_51: 
          {
          page: 4,
          left: 718.228393554688,
          top: 475.045440673828,
          right: 809.25732421875,
          bottom: 489.727264404297
          }
          ,bj1_007_52: 
          {
          page: 4,
          left: 716.227783203125,
          top: 463.045440673828,
          right: 805.256042480469,
          bottom: 477.363616943359
          }
          ,bj1_007_53: 
          {
          page: 4,
          left: 802.255126953125,
          top: 479.681854248047,
          right: 829.263671875,
          bottom: 503.272735595703
          }
          ,bj1_007_55: 
          {
          page: 4,
          left: 144.751800537109,
          top: 488.528198242188,
          right: 322.550750732422,
          bottom: 517.937316894531
          }
          ,bj1_007_54: 
          {
          page: 4,
          left: 104.739212036133,
          top: 490.076843261719,
          right: 218.203247070313,
          bottom: 519.485900878906
          }
          ,bj1_007_56: 
          {
          page: 4,
          left: 393.125,
          top: 497.677062988281,
          right: 443.140930175781,
          bottom: 513.540649414063
          }
          ,bj1_007_58: 
          {
          page: 4,
          left: 449.739044189453,
          top: 492.766662597656,
          right: 489.751770019531,
          bottom: 515.364074707031
          }
          ,bj1_007_59: 
          {
          page: 4,
          left: 450.428924560547,
          top: 492.233795166016,
          right: 525.881530761719,
          bottom: 516.155883789063
          }
          ,bj1_007_60: 
          {
          page: 4,
          left: 629.796325683594,
          top: 497.182281494141,
          right: 671.52392578125,
          bottom: 513.15625
          }
          ,bj1_007_61: 
          {
          page: 4,
          left: 678.836730957031,
          top: 496.771087646484,
          right: 701.602478027344,
          bottom: 511.755462646484
          }
          ,bj1_007_62: 
          {
          page: 4,
          left: 527.5361328125,
          top: 519.25830078125,
          right: 633.885803222656,
          bottom: 539.066955566406
          }
          ,bj1_007_63: 
          {
          page: 4,
          left: 637.044555664063,
          top: 518.851684570313,
          right: 813.942932128906,
          bottom: 538.660278320313
          }
          ,bj1_007_64: 
          {
          page: 4,
          left: 336.422698974609,
          top: 544.353942871094,
          right: 364.326385498047,
          bottom: 570.550170898438
          }
          ,bj1_007_65: 
          {
          page: 4,
          left: 329.415130615234,
          top: 529.404418945313,
          right: 479.462829589844,
          bottom: 547.82470703125
          }
          ,bj1_007_66: 
          {
          page: 4,
          left: 441.283233642578,
          top: 609.71435546875,
          right: 523.023376464844,
          bottom: 629.220764160156
          }
          ,bj1_007_67: 
          {
          page: 4,
          left: 523.023498535156,
          top: 609.714233398438,
          right: 629.343200683594,
          bottom: 628.779235839844
          }
          ,bj1_007_68: 
          {
          page: 4,
          left: 857.75048828125,
          top: 633.301452636719,
          right: 965.784851074219,
          bottom: 654.986999511719
          }
          ,bj1_007_69: 
          {
          page: 4,
          left: 140.453582763672,
          top: 655.318176269531,
          right: 186.753997802734,
          bottom: 674.554260253906
          }
          ,bj1_007_72: 
          {
          page: 4,
          left: 485.297241210938,
          top: 659.844116210938,
          right: 511.591339111328,
          bottom: 697.532409667969
          }
          ,bj1_007_73: 
          {
          page: 4,
          left: 492.156494140625,
          top: 646.961059570313,
          right: 588.758544921875,
          bottom: 666.025939941406
          }
          ,bj1_007_74: 
          {
          page: 4,
          left: 598.476013183594,
          top: 654.482788085938,
          right: 660.2099609375,
          bottom: 674.402099609375
          }
          ,bj1_007_75: 
          {
          page: 4,
          left: 649.585693359375,
          top: 653.9345703125,
          right: 786.772277832031,
          bottom: 674.325927734375
          }
          ,bj1_007_76: 
          {
          page: 4,
          left: 534.65283203125,
          top: 706.363586425781,
          right: 573.975524902344,
          bottom: 721.348022460938
          }
          ,bj1_007_77: 
          {
          page: 4,
          left: 536.722412109375,
          top: 695.172424316406,
          right: 569.836303710938,
          bottom: 711.755554199219
          }
          ,bj1_007_41: 
          {
          page: 4,
          left: 144.18391418457,
          top: 448.087799072266,
          right: 187.646026611328,
          bottom: 471.598724365234
          }
          ,bj1_007_42: 
          {
          page: 4,
          left: 142.114212036133,
          top: 448.087799072266,
          right: 197.304077148438,
          bottom: 471.598724365234
          }
          ,bj1_007_79: 
          {
          page: 4,
          left: 568.456604003906,
          top: 594.608276367188,
          right: 607.089538574219,
          bottom: 618.119140625
          }
          ,bj1_007_80: 
          {
          page: 4,
          left: 4.13924264907837,
          top: 535.266479492188,
          right: 124.17741394043,
          bottom: 703.166137695313
          }
          ,bj1_007_81: 
          {
          page: 4,
          left: 125.257278442383,
          top: 802.015747070313,
          right: 164.400177001953,
          bottom: 830.276550292969
          }
          ,bj1_007_83: 
          {
          page: 4,
          left: 293.136657714844,
          top: 814.782653808594,
          right: 320.971618652344,
          bottom: 837.707458496094
          }
          ,bj1_007_84: 
          {
          page: 4,
          left: 265.608734130859,
          top: 814.347839355469,
          right: 296.923156738281,
          bottom: 846.679870605469
          }
          ,bj1_007_85: 
          {
          page: 4,
          left: 486.241607666016,
          top: 813.438720703125,
          right: 653.251159667969,
          bottom: 839.723205566406
          }
          ,bj1_007_87: 
          {
          page: 4,
          left: 889.84814453125,
          top: 822.885314941406,
          right: 927.251220703125,
          bottom: 844.426879882813
          }
          ,bj1_007_88: 
          {
          page: 4,
          left: 881.149780273438,
          top: 804.70361328125,
          right: 951.606872558594,
          bottom: 830.948486328125
          }
          ,bj1_007_89: 
          {
          page: 4,
          left: 187.016036987305,
          top: 840.395263671875,
          right: 245.295471191406,
          bottom: 859.921020507813
          }
          ,bj1_007_91: 
          {
          page: 4,
          left: 252.868072509766,
          top: 863.715515136719,
          right: 282.442718505859,
          bottom: 881.225280761719
          }
          ,bj1_007_92: 
          {
          page: 4,
          left: 258.343048095703,
          top: 851.146240234375,
          right: 306.184356689453,
          bottom: 874.743041992188
          }
          ,bj1_007_94: 
          {
          page: 4,
          left: 319.232086181641,
          top: 814.110717773438,
          right: 361.854309082031,
          bottom: 837.707458496094
          }
          ,bj1_007_96: 
          {
          page: 4,
          left: 326.190734863281,
          top: 866.640380859375,
          right: 417.524108886719,
          bottom: 882.806335449219
          }
          ,bj1_007_97: 
          {
          page: 4,
          left: 331.972503662109,
          top: 853.87353515625,
          right: 509.573699951172,
          bottom: 871.818176269531
          }
          ,bj1_007_99: 
          {
          page: 4,
          left: 788.946411132813,
          top: 860.592956542969,
          right: 917.683044433594,
          bottom: 887.509948730469
          }
          ,bj1_007_101: 
          {
          page: 4,
          left: 601.060668945313,
          top: 892.252990722656,
          right: 643.682861328125,
          bottom: 919.169860839844
          }
          ,bj1_007_102: 
          {
          page: 4,
          left: 262.180480957031,
          top: 847.312133789063,
          right: 517.044128417969,
          bottom: 877.628479003906
          }
          ,bj1_007_103: 
          {
          page: 4,
          left: 620.197082519531,
          top: 892.253112792969,
          right: 648.902038574219,
          bottom: 919.169982910156
          }
          ,bj1_007_104: 
          {
          page: 4,
          left: 622.806701660156,
          top: 880.11865234375,
          right: 742.844848632813,
          bottom: 896.95654296875
          }
          ,bj1_007_105: 
          {
          page: 4,
          left: 642.813049316406,
          top: 888.181884765625,
          right: 665.429077148438,
          bottom: 904.347839355469
          }
          ,bj1_007_108: 
          {
          page: 4,
          left: 628.02587890625,
          top: 908.379577636719,
          right: 712.400390625,
          bottom: 927.272766113281
          }
          ,bj1_007_109: 
          {
          page: 4,
          left: 725.448120117188,
          top: 907.035583496094,
          right: 810.692565917969,
          bottom: 927.272766113281
          }
          ,bj1_007_106: 
          {
          page: 4,
          left: 203.542938232422,
          top: 917.154174804688,
          right: 240.07633972168,
          bottom: 946.798400878906
          }
          ,bj1_007_107: 
          {
          page: 4,
          left: 200.933441162109,
          top: 896.28466796875,
          right: 244.425491333008,
          bottom: 914.46630859375
          }
          ,bj1_007_82: 
          {
          page: 4,
          left: 23.4855518341064,
          top: 789.209533691406,
          right: 147.003173828125,
          bottom: 835.652160644531
          }
          ,bj1_007_1: 
          {
          page: 4,
          left: 127.86678314209,
          top: 96.2846527099609,
          right: 164.400177001953,
          bottom: 138.023788452148
          }
          ,bj1_008_1: 
          {
          page: 5,
          left: 144.504135131836,
          top: 101.527954101563,
          right: 181.157836914063,
          bottom: 117.532493591309
          }
          ,bj1_008_2: 
          {
          page: 5,
          left: 144.608474731445,
          top: 89.2344665527344,
          right: 224.593338012695,
          bottom: 119.309707641602
          }
          ,bj1_008_3: 
          {
          page: 5,
          left: 147.395065307617,
          top: 103.22981262207,
          right: 172.406234741211,
          bottom: 117.532493591309
          }
          ,bj1_008_4: 
          {
          page: 5,
          left: 486.95849609375,
          top: 99.5255508422852,
          right: 563.602172851563,
          bottom: 119.430633544922
          }
          ,bj1_008_5: 
          {
          page: 5,
          left: 486.838195800781,
          top: 93.9146041870117,
          right: 580.580261230469,
          bottom: 125.58438873291
          }
          ,bj1_008_6: 
          {
          page: 5,
          left: 890.574340820313,
          top: 145.586303710938,
          right: 929.943542480469,
          bottom: 164.383117675781
          }
          ,bj1_008_7: 
          {
          page: 5,
          left: 878.615478515625,
          top: 148.441513061523,
          right: 896.731262207031,
          bottom: 168.863647460938
          }
          ,bj1_008_8: 
          {
          page: 5,
          left: 686.171203613281,
          top: 786.61865234375,
          right: 710.253784179688,
          bottom: 803.200378417969
          }
          ,bj1_008_9: 
          {
          page: 5,
          left: 685.811889648438,
          top: 786.351989746094,
          right: 733.2578125,
          bottom: 803.467102050781
          }
          ,bj1_009_1: 
          {
          page: 6,
          left: 589.340148925781,
          top: 202.318145751953,
          right: 626.487670898438,
          bottom: 220.499969482422
          }
          ,bj1_009_2: 
          {
          page: 6,
          left: 599.380065917969,
          top: 188.772720336914,
          right: 634.519592285156,
          bottom: 208.499969482422
          }
          ,bj1_009_3: 
          {
          page: 6,
          left: 325.291687011719,
          top: 223.590850830078,
          right: 369.467102050781,
          bottom: 243.318222045898
          }
          ,bj1_009_5: 
          {
          page: 6,
          left: 655.544250488281,
          top: 290.909088134766,
          right: 687.435607910156,
          bottom: 311.818176269531
          }
          ,bj1_009_6: 
          {
          page: 6,
          left: 687.435607910156,
          top: 289.999969482422,
          right: 731.138549804688,
          bottom: 312.727294921875
          }
          ,bj1_009_7: 
          {
          page: 6,
          left: 444.116424560547,
          top: 318.181823730469,
          right: 464.196166992188,
          bottom: 331.818237304688
          }
          ,bj1_009_8: 
          {
          page: 6,
          left: 465.377380371094,
          top: 318.181823730469,
          right: 548.058654785156,
          bottom: 333.636352539063
          }
          ,bj1_009_9: 
          {
          page: 6,
          left: 721.689208984375,
          top: 415.454559326172,
          right: 765.392150878906,
          bottom: 450.909118652344
          }
          ,bj1_009_10: 
          {
          page: 6,
          left: 705.152954101563,
          top: 392.727294921875,
          right: 813.819702148438,
          bottom: 415.454559326172
          }
          ,bj1_009_11: 
          {
          page: 6,
          left: 526.797790527344,
          top: 428.181915283203,
          right: 587.036987304688,
          bottom: 453.636444091797
          }
          ,bj1_009_12: 
          {
          page: 6,
          left: 524.435363769531,
          top: 419.090881347656,
          right: 588.218139648438,
          bottom: 454.545471191406
          }
          ,bj1_009_13: 
          {
          page: 6,
          left: 304.739471435547,
          top: 454.545471191406,
          right: 343.717742919922,
          bottom: 472.727264404297
          }
          ,bj1_009_14: 
          {
          page: 6,
          left: 304.739471435547,
          top: 454.545471191406,
          right: 382.696136474609,
          bottom: 472.727264404297
          }
          ,bj1_009_15: 
          {
          page: 6,
          left: 187.084228515625,
          top: 524.92236328125,
          right: 220.877075195313,
          bottom: 540.909118652344
          }
          ,bj1_009_16: 
          {
          page: 6,
          left: 179.73811340332,
          top: 522.283813476563,
          right: 224.305236816406,
          bottom: 543.481140136719
          }
          ,bj1_011_1: 
          {
          page: 8,
          left: 346.797271728516,
          top: 926.51513671875,
          right: 386.000457763672,
          bottom: 954.545471191406
          }
          ,bj1_011_2: 
          {
          page: 8,
          left: 101.526161193848,
          top: 917.424255371094,
          right: 586.037109375,
          bottom: 945.454528808594
          }
          ,bj1_012_1: 
          {
          page: 9,
          left: 632.973876953125,
          top: 414.681884765625,
          right: 661.017028808594,
          bottom: 433.636413574219
          }
          ,bj1_012_2: 
          {
          page: 9,
          left: 640.986206054688,
          top: 413.136413574219,
          right: 658.012390136719,
          bottom: 434.409118652344
          }
          ,bj1_012_3: 
          {
          page: 9,
          left: 614.946166992188,
          top: 478.136352539063,
          right: 808.243530273438,
          bottom: 498.636322021484
          }
          ,bj1_012_4: 
          {
          page: 9,
          left: 807.124206542969,
          top: 478.181793212891,
          right: 896.673706054688,
          bottom: 499.090942382813
          }
          ,bj1_012_5: 
          {
          page: 9,
          left: 328.741088867188,
          top: 505.454528808594,
          right: 372.337585449219,
          bottom: 535.45458984375
          }
          ,bj1_012_6: 
          {
          page: 9,
          left: 30.7900257110596,
          top: 494.546997070313,
          right: 92.0792083740234,
          bottom: 540.79638671875
          }
          ,bj1_012_7: 
          {
          page: 9,
          left: 28.2788124084473,
          top: 456.363586425781,
          right: 142.572250366211,
          bottom: 582.727233886719
          }
          ,bj1_012_8: 
          {
          page: 9,
          left: 13.9195785522461,
          top: 523.243896484375,
          right: 161.213790893555,
          bottom: 634.715637207031
          }
          ,bj1_012_9: 
          {
          page: 9,
          left: 684.992614746094,
          top: 622.490112304688,
          right: 721.109497070313,
          bottom: 646.442810058594
          }
          ,bj1_012_10: 
          {
          page: 9,
          left: 694.111389160156,
          top: 618.181823730469,
          right: 715.013122558594,
          bottom: 640.395263671875
          }
          ,bj1_012_11: 
          {
          page: 9,
          left: 661.017028808594,
          top: 640,
          right: 715.218017578125,
          bottom: 657.272705078125
          }
          ,bj1_012_12: 
          {
          page: 9,
          left: 715.218200683594,
          top: 640.000122070313,
          right: 873.108093261719,
          bottom: 658.181945800781
          }
          ,bj1_012_13: 
          {
          page: 9,
          left: 426.538696289063,
          top: 663.636291503906,
          right: 460.708831787109,
          bottom: 678.181823730469
          }
          ,bj1_012_14: 
          {
          page: 9,
          left: 423.003723144531,
          top: 651.818176269531,
          right: 468.956848144531,
          bottom: 670.909057617188
          }
          ,bj1_012_15: 
          {
          page: 9,
          left: 842.47265625,
          top: 663.636291503906,
          right: 934.378662109375,
          bottom: 680
          }
          ,bj1_012_17: 
          {
          page: 9,
          left: 129.611236572266,
          top: 679.091003417969,
          right: 231.390411376953,
          bottom: 699.216369628906
          }
          ,bj1_012_19: 
          {
          page: 9,
          left: 213.26921081543,
          top: 751.818054199219,
          right: 333.454132080078,
          bottom: 775.454467773438
          }
          ,bj1_012_21: 
          {
          page: 9,
          left: 891.960510253906,
          top: 893.636413574219,
          right: 907.2783203125,
          bottom: 908.181762695313
          }
          ,bj1_012_22: 
          {
          page: 9,
          left: 907.2783203125,
          top: 893.636474609375,
          right: 957.944519042969,
          bottom: 909.091003417969
          }
          ,bj1_012_23: 
          {
          page: 9,
          left: 134.324249267578,
          top: 911.818176269531,
          right: 181.455688476563,
          bottom: 929.090881347656
          }
          ,bj1_012_18a: 
          {
          page: 9,
          left: 230.699829101563,
          top: 679.122253417969,
          right: 253.493438720703,
          bottom: 701.5673828125
          }
          ,bj1_012_18b: 
          {
          page: 9,
          left: 249.796127319336,
          top: 677.272766113281,
          right: 308.060211181641,
          bottom: 703.636291503906
          }
          ,bj1_014_1: 
          {
          page: 11,
          left: 671.582641601563,
          top: 282.575744628906,
          right: 714.175659179688,
          bottom: 296.969696044922
          }
          ,bj1_014_2: 
          {
          page: 11,
          left: 730.024230957031,
          top: 278.787872314453,
          right: 765.683471679688,
          bottom: 299.242431640625
          }
          ,bj1_014_3: 
          {
          page: 11,
          left: 428.843322753906,
          top: 767.201477050781,
          right: 512.747497558594,
          bottom: 789.839538574219
          }
          ,bj1_014_4: 
          {
          page: 11,
          left: 504.590179443359,
          top: 757.041015625,
          right: 742.318542480469,
          bottom: 778.787902832031
          }
          ,bj1_014_7: 
          {
          page: 11,
          left: 797.896362304688,
          top: 868.589233398438,
          right: 835.020812988281,
          bottom: 897.822692871094
          }
          ,bj1_014_8: 
          {
          page: 11,
          left: 276.184265136719,
          top: 904.278015136719,
          right: 640.934143066406,
          bottom: 926.024963378906
          }
          ,bj1_014_5: 
          {
          page: 11,
          left: 843.036682128906,
          top: 775.120910644531,
          right: 939.759521484375,
          bottom: 791.520263671875
          }
          ,bj1_014_6: 
          {
          page: 11,
          left: 833.181396484375,
          top: 774.820251464844,
          right: 843.103271484375,
          bottom: 791.341857910156
          }
          ,bj1_015_1: 
          {
          page: 12,
          left: 400.9970703125,
          top: 442.222686767578,
          right: 418.393951416016,
          bottom: 457.800506591797
          }
          ,bj1_015_2: 
          {
          page: 12,
          left: 401.866882324219,
          top: 442.873687744141,
          right: 430.571685791016,
          bottom: 457.800506591797
          }
          ,bj1_015_3: 
          {
          page: 12,
          left: 696.692138671875,
          top: 465.114776611328,
          right: 708.460571289063,
          bottom: 481.535095214844
          }
          ,bj1_015_4: 
          {
          page: 12,
          left: 706.106750488281,
          top: 462.472503662109,
          right: 752.003723144531,
          bottom: 483.296691894531
          }
          ,bj1_015_5: 
          {
          page: 12,
          left: 835.559753417969,
          top: 485.058227539063,
          right: 875.572509765625,
          bottom: 504.120819091797
          }
          ,bj1_015_6: 
          {
          page: 12,
          left: 875.572509765625,
          top: 485.058227539063,
          right: 915.585205078125,
          bottom: 504.120819091797
          }
          ,bj1_015_7: 
          {
          page: 12,
          left: 945.006469726563,
          top: 509.971710205078,
          right: 962.659057617188,
          bottom: 527.272705078125
          }
          ,bj1_015_8: 
          {
          page: 12,
          left: 141.221405029297,
          top: 533.438171386719,
          right: 180.057250976563,
          bottom: 550.739196777344
          }
          ,bj1_015_9: 
          {
          page: 12,
          left: 561.355041503906,
          top: 670.399536132813,
          right: 594.306579589844,
          bottom: 689.462097167969
          }
          ,bj1_015_10: 
          {
          page: 12,
          left: 595.4833984375,
          top: 670.399536132813,
          right: 681.216613769531,
          bottom: 691.65771484375
          }
          ,bj1_015_11: 
          {
          page: 12,
          left: 824.96826171875,
          top: 669.518737792969,
          right: 852.03564453125,
          bottom: 688.581298828125
          }
          ,bj1_015_12: 
          {
          page: 12,
          left: 825.220275878906,
          top: 669.518737792969,
          right: 875.824523925781,
          bottom: 688.581298828125
          }
          ,bj1_015_13: 
          {
          page: 12,
          left: 562.486633300781,
          top: 856.273132324219,
          right: 579.414916992188,
          bottom: 872.727233886719
          }
          ,bj1_015_14: 
          {
          page: 12,
          left: 580.954040527344,
          top: 856.27294921875,
          right: 623.275085449219,
          bottom: 872.398071289063
          }
          ,bj1_017_1: 
          {
          page: 14,
          left: 127.826141357422,
          top: 621.428527832031,
          right: 164.753753662109,
          bottom: 643.939392089844
          }
          ,bj1_017_2: 
          {
          page: 14,
          left: 126.405944824219,
          top: 621.428527832031,
          right: 186.058166503906,
          bottom: 645.021728515625
          }
          ,bj1_017_3: 
          {
          page: 14,
          left: 301.243682861328,
          top: 625,
          right: 321.127777099609,
          bottom: 641.666687011719
          }
          ,bj1_017_4: 
          {
          page: 14,
          left: 300.249481201172,
          top: 624.242431640625,
          right: 345.982849121094,
          bottom: 641.666687011719
          }
          ,bj1_019_1: 
          {
          page: 16,
          left: 462.873321533203,
          top: 611.363647460938,
          right: 484.772705078125,
          bottom: 631.818176269531
          }
          ,bj1_019_2: 
          {
          page: 16,
          left: 463.868743896484,
          top: 611.363647460938,
          right: 530.562316894531,
          bottom: 631.818176269531
          }
          ,bj1_019_3: 
          {
          page: 16,
          left: 343.422149658203,
          top: 646.212097167969,
          right: 357.358123779297,
          bottom: 657.575744628906
          }
          ,bj1_019_4: 
          {
          page: 16,
          left: 341.431274414063,
          top: 644.696960449219,
          right: 372.289520263672,
          bottom: 658.333374023438
          }
          ,bj1_019_5: 
          {
          page: 16,
          left: 371.294067382813,
          top: 638.636352539063,
          right: 397.175170898438,
          bottom: 656.060546875
          }
          ,bj1_019_6: 
          {
          page: 16,
          left: 661.958618164063,
          top: 637.121215820313,
          right: 692.816833496094,
          bottom: 655.303039550781
          }
          ,bj1_019_8: 
          {
          page: 16,
          left: 693.812255859375,
          top: 637.121215820313,
          right: 824.213134765625,
          bottom: 656.060546875
          }
          ,bj1_019_9: 
          {
          page: 16,
          left: 693.812255859375,
          top: 635.606079101563,
          right: 779.4189453125,
          bottom: 655.303039550781
          }
          ,bj1_019_11: 
          {
          page: 16,
          left: 827.199401855469,
          top: 636.363647460938,
          right: 869.00732421875,
          bottom: 656.818176269531
          }
          ,bj1_019_14: 
          {
          page: 16,
          left: 203.067001342773,
          top: 802.272705078125,
          right: 233.925231933594,
          bottom: 817.424255371094
          }
          ,bj1_019_15: 
          {
          page: 16,
          left: 234.920654296875,
          top: 801.51513671875,
          right: 299.623382568359,
          bottom: 818.939392089844
          }
          ,bj1_019_16: 
          {
          page: 16,
          left: 304.600494384766,
          top: 800.757568359375,
          right: 357.358123779297,
          bottom: 818.181823730469
          }
          ,bj1_019_17: 
          {
          page: 16,
          left: 370.298645019531,
          top: 800,
          right: 440.973937988281,
          bottom: 818.939392089844
          }
          ,bj1_019_12: 
          {
          page: 16,
          left: 100.538078308105,
          top: 805.303039550781,
          right: 121.442031860352,
          bottom: 821.212097167969
          }
          ,bj1_019_13: 
          {
          page: 16,
          left: 171.213363647461,
          top: 803.0302734375,
          right: 197.094451904297,
          bottom: 819.696960449219
          }
          ,bj1_020_1: 
          {
          page: 17,
          left: 107.506065368652,
          top: 165.954559326172,
          right: 170.217926025391,
          bottom: 188.772720336914
          }
          ,bj1_020_2: 
          {
          page: 17,
          left: 173.204208374023,
          top: 168.272720336914,
          right: 236.911499023438,
          bottom: 190.318161010742
          }
          ,bj1_020_3: 
          {
          page: 17,
          left: 952.623168945313,
          top: 189.545440673828,
          right: 981.490539550781,
          bottom: 210.045425415039
          }
          ,bj1_020_4: 
          {
          page: 17,
          left: 116.506698608398,
          top: 223.116683959961,
          right: 147.891906738281,
          bottom: 249.480377197266
          }
          ,bj1_020_5: 
          {
          page: 17,
          left: 110.082412719727,
          top: 212.727249145508,
          right: 156.92610168457,
          bottom: 232.727310180664
          }
          ,bj1_020_6: 
          {
          page: 17,
          left: 302.040863037109,
          top: 219.967163085938,
          right: 315.766540527344,
          bottom: 236.40202331543
          }
          ,bj1_020_7: 
          {
          page: 17,
          left: 299.765625,
          top: 211.480438232422,
          right: 317.967712402344,
          bottom: 223.922058105469
          }
          ,bj1_020_8: 
          {
          page: 17,
          left: 724.67041015625,
          top: 261.306976318359,
          right: 737.237670898438,
          bottom: 276.108123779297
          }
          ,bj1_020_9: 
          {
          page: 17,
          left: 877.966186523438,
          top: 353.181793212891,
          right: 909.81982421875,
          bottom: 373.681823730469
          }
          ,bj1_020_10: 
          {
          page: 17,
          left: 185.149322509766,
          top: 376.772674560547,
          right: 272.746856689453,
          bottom: 395.727203369141
          }
          ,bj1_020_11: 
          {
          page: 17,
          left: 539.87255859375,
          top: 373.636383056641,
          right: 601.940307617188,
          bottom: 394.54541015625
          }
          ,bj1_020_12: 
          {
          page: 17,
          left: 786.972595214844,
          top: 398.181976318359,
          right: 799.854553222656,
          bottom: 420.000091552734
          }
          ,bj1_020_13: 
          {
          page: 17,
          left: 131.162078857422,
          top: 446.363647460938,
          right: 145.215225219727,
          bottom: 461.818206787109
          }
          ,bj1_020_14: 
          {
          page: 17,
          left: 131.16194152832,
          top: 443.636322021484,
          right: 255.297500610352,
          bottom: 464.545501708984
          }
          ,bj1_020_15: 
          {
          page: 17,
          left: 953.267272949219,
          top: 469.090911865234,
          right: 981.373474121094,
          bottom: 485.454559326172
          }
          ,bj1_020_16: 
          {
          page: 17,
          left: 125.306564331055,
          top: 499.090942382813,
          right: 170.979125976563,
          bottom: 536.363586425781
          }
          ,bj1_020_17: 
          {
          page: 17,
          left: 107.740280151367,
          top: 489.999969482422,
          right: 165.123764038086,
          bottom: 511.818176269531
          }
          ,bj1_020_18: 
          {
          page: 17,
          left: 703.825073242188,
          top: 493.636352539063,
          right: 717.878173828125,
          bottom: 509.090881347656
          }
          ,bj1_020_19: 
          {
          page: 17,
          left: 460.238342285156,
          top: 517.272644042969,
          right: 488.344451904297,
          bottom: 534.545349121094
          }
          ,bj1_020_20: 
          {
          page: 17,
          left: 488.344451904297,
          top: 516.363647460938,
          right: 526.990539550781,
          bottom: 534.545471191406
          }
          ,bj1_020_21: 
          {
          page: 17,
          left: 373.577819824219,
          top: 560.000061035156,
          right: 402.855102539063,
          bottom: 581.818298339844
          }
          ,bj1_020_22: 
          {
          page: 17,
          left: 405.197113037109,
          top: 560.000061035156,
          right: 440.329803466797,
          bottom: 581.818298339844
          }
          ,bj1_020_23: 
          {
          page: 17,
          left: 580.333618164063,
          top: 606.181823730469,
          right: 597.255920410156,
          bottom: 623.590942382813
          }
          ,bj1_020_24: 
          {
          page: 17,
          left: 598.251342773438,
          top: 605.409118652344,
          right: 679.876281738281,
          bottom: 622.818176269531
          }
          ,bj1_020_25: 
          {
          page: 17,
          left: 201.628204345703,
          top: 635.480651855469,
          right: 216.149810791016,
          bottom: 648.727355957031
          }
          ,bj1_020_26: 
          {
          page: 17,
          left: 431.730590820313,
          top: 681.116943359375,
          right: 446.252197265625,
          bottom: 694.363586425781
          }
          ,bj1_020_27: 
          {
          page: 17,
          left: 895.883850097656,
          top: 775.454528808594,
          right: 907.5947265625,
          bottom: 790
          }
          ,bj1_020_28: 
          {
          page: 17,
          left: 904.081481933594,
          top: 776.363708496094,
          right: 915.792358398438,
          bottom: 790
          }
          ,bj1_020_29: 
          {
          page: 17,
          left: 106.569282531738,
          top: 941.818298339844,
          right: 147.557342529297,
          bottom: 957.272644042969
          }
          ,bj1_020_30: 
          {
          page: 17,
          left: 151.070602416992,
          top: 941.818298339844,
          right: 197.914184570313,
          bottom: 957.272644042969
          }
          ,bj1_021_1: 
          {
          page: 18,
          left: 221.162002563477,
          top: 127.9873046875,
          right: 247.939468383789,
          bottom: 158.51887512207
          }
          ,bj1_021_2: 
          {
          page: 18,
          left: 229.096069335938,
          top: 115.220390319824,
          right: 376.867980957031,
          bottom: 130.304428100586
          }
          ,bj1_021_3: 
          {
          page: 18,
          left: 491.911895751953,
          top: 122.171775817871,
          right: 507.780029296875,
          bottom: 141.117691040039
          }
          ,bj1_021_4: 
          {
          page: 18,
          left: 631.749755859375,
          top: 216.901382446289,
          right: 647.617858886719,
          bottom: 233.530181884766
          }
          ,bj1_021_5: 
          {
          page: 18,
          left: 549.433837890625,
          top: 240.890563964844,
          right: 572.244262695313,
          bottom: 253.248596191406
          }
          ,bj1_021_6: 
          {
          page: 18,
          left: 574.227783203125,
          top: 240.118194580078,
          right: 595.0546875,
          bottom: 253.248596191406
          }
          ,bj1_021_7: 
          {
          page: 18,
          left: 558.359680175781,
          top: 312.812377929688,
          right: 571.252502441406,
          bottom: 325.17041015625
          }
          ,bj1_021_8: 
          {
          page: 18,
          left: 574.227783203125,
          top: 312.812377929688,
          right: 594.062927246094,
          bottom: 326.715148925781
          }
          ,bj1_021_9: 
          {
          page: 18,
          left: 671.420043945313,
          top: 307.769226074219,
          right: 683.321166992188,
          bottom: 325.942779541016
          }
          ,bj1_021_10: 
          {
          page: 18,
          left: 685.3046875,
          top: 307.769226074219,
          right: 785.472229003906,
          bottom: 327.124053955078
          }
          ,bj1_021_11: 
          {
          page: 18,
          left: 920.351257324219,
          top: 311.267608642578,
          right: 945.145202636719,
          bottom: 326.715148925781
          }
          ,bj1_021_12: 
          {
          page: 18,
          left: 96.2005081176758,
          top: 333.303039550781,
          right: 131.903793334961,
          bottom: 360.7451171875
          }
          ,bj1_021_13: 
          {
          page: 18,
          left: 93.2252349853516,
          top: 327.896423339844,
          right: 137.854339599609,
          bottom: 345.297607421875
          }
          ,bj1_021_14: 
          {
          page: 18,
          left: 142.346405029297,
          top: 487.051330566406,
          right: 242.689010620117,
          bottom: 512.494384765625
          }
          ,bj1_021_15: 
          {
          page: 18,
          left: 243.855819702148,
          top: 488.868743896484,
          right: 519.214416503906,
          bottom: 516.129089355469
          }
          ,bj1_021_16: 
          {
          page: 18,
          left: 332.776275634766,
          top: 587.682067871094,
          right: 346.777496337891,
          bottom: 601.586181640625
          }
          ,bj1_021_17: 
          {
          page: 18,
          left: 347.115112304688,
          top: 587.651611328125,
          right: 356.510772705078,
          bottom: 601.760070800781
          }
          ,bj1_021_18: 
          {
          page: 18,
          left: 356.510772705078,
          top: 587.245056152344,
          right: 448.378936767578,
          bottom: 601.760070800781
          }
          ,bj1_021_19: 
          {
          page: 18,
          left: 282.359313964844,
          top: 607.905517578125,
          right: 408.370880126953,
          bottom: 626.987731933594
          }
          ,bj1_021_20: 
          {
          page: 18,
          left: 408.370880126953,
          top: 608.814208984375,
          right: 431.706329345703,
          bottom: 628.805114746094
          }
          ,bj1_021_21: 
          {
          page: 18,
          left: 411.871185302734,
          top: 608.814086914063,
          right: 448.041168212891,
          bottom: 629.713745117188
          }
          ,bj1_021_22: 
          {
          page: 18,
          left: 449.207885742188,
          top: 607.905578613281,
          right: 950.920654296875,
          bottom: 627.896484375
          }
          ,bj1_021_23: 
          {
          page: 18,
          left: 86.3412399291992,
          top: 628.805114746094,
          right: 285.859619140625,
          bottom: 651.522094726563
          }
          ,bj1_021_24: 
          {
          page: 18,
          left: 203.018676757813,
          top: 656.065490722656,
          right: 214.686401367188,
          bottom: 669.695617675781
          }
          ,bj1_021_25: 
          {
          page: 18,
          left: 203.0185546875,
          top: 654.248107910156,
          right: 250.856307983398,
          bottom: 671.513000488281
          }
          ,bj1_021_26: 
          {
          page: 18,
          left: 763.8408203125,
          top: 778.445495605469,
          right: 777.313598632813,
          bottom: 790.498291015625
          }
          ,bj1_021_27: 
          {
          page: 18,
          left: 775.442321777344,
          top: 778.445495605469,
          right: 820.352111816406,
          bottom: 790.498291015625
          }
          ,bj1_021_28: 
          {
          page: 18,
          left: 491.524810791016,
          top: 806.041625976563,
          right: 505.554504394531,
          bottom: 813.576965332031
          }
          ,bj1_021_29: 
          {
          page: 18,
          left: 492.008575439453,
          top: 799.548034667969,
          right: 505.070770263672,
          bottom: 813.576965332031
          }
          ,bj1_021_30: 
          {
          page: 18,
          left: 571.349243164063,
          top: 822.708129882813,
          right: 643.916870117188,
          bottom: 837.113891601563
          }
          ,bj1_021_31: 
          {
          page: 18,
          left: 653.568420410156,
          top: 820.899536132813,
          right: 830.101318359375,
          bottom: 839.845581054688
          }
          ,bj1_021_32: 
          {
          page: 18,
          left: 158.681259155273,
          top: 915.629333496094,
          right: 188.433990478516,
          bottom: 939.981872558594
          }
          ,bj1_021_33: 
          {
          page: 18,
          left: 166.138687133789,
          top: 903.805297851563,
          right: 237.545272827148,
          bottom: 921.206481933594
          }
          ,bj1_021_34: 
          {
          page: 18,
          left: 819.191955566406,
          top: 961.244934082031,
          right: 930.268859863281,
          bottom: 981.3720703125
          }
          ,bj1_022_1: 
          {
          page: 19,
          left: 875.677551269531,
          top: 143.636413574219,
          right: 912.115051269531,
          bottom: 159.090957641602
          }
          ,bj1_022_2: 
          {
          page: 19,
          left: 103.435585021973,
          top: 171.818145751953,
          right: 135.171539306641,
          bottom: 200.909088134766
          }
          ,bj1_022_3: 
          {
          page: 19,
          left: 111.66357421875,
          top: 165.454498291016,
          right: 186.889526367188,
          bottom: 185.454544067383
          }
          ,bj1_022_4: 
          {
          page: 19,
          left: 306.780975341797,
          top: 256.363647460938,
          right: 364.375915527344,
          bottom: 277.272705078125
          }
          ,bj1_023_2: 
          {
          page: 20,
          left: 103.806289672852,
          top: 967.96484375,
          right: 222.606674194336,
          bottom: 992.80810546875
          }
          ,bj1_023_1: 
          {
          page: 20,
          left: 317.185699462891,
          top: 693.769470214844,
          right: 395.617065429688,
          bottom: 720.453002929688
          }
          ,bj1_024_1: 
          {
          page: 21,
          left: 97.0588226318359,
          top: 92.0825500488281,
          right: 125.490196228027,
          bottom: 118.104850769043
          }
          ,bj1_024_2: 
          {
          page: 21,
          left: 111.764709472656,
          top: 79.2538986206055,
          right: 222.549026489258,
          bottom: 95.9630661010742
          }
          ,bj1_024_3: 
          {
          page: 21,
          left: 494.117645263672,
          top: 242.829406738281,
          right: 507.843139648438,
          bottom: 258.762359619141
          }
          ,bj1_024_4: 
          {
          page: 21,
          left: 494.117645263672,
          top: 241.277206420898,
          right: 538.235290527344,
          bottom: 261.090667724609
          }
          ,bj1_024_5: 
          {
          page: 21,
          left: 184.313720703125,
          top: 336.464050292969,
          right: 203.921569824219,
          bottom: 353.94921875
          }
          ,bj1_024_6: 
          {
          page: 21,
          left: 203.921569824219,
          top: 334.911834716797,
          right: 254.901962280273,
          bottom: 356.277526855469
          }
          ,bj1_024_7: 
          {
          page: 21,
          left: 726.6435546875,
          top: 356.094909667969,
          right: 837.370056152344,
          bottom: 379.834655761719
          }
          ,bj1_024_8: 
          {
          page: 21,
          left: 262.975769042969,
          top: 525.011779785156,
          right: 299.884735107422,
          bottom: 546.925354003906
          }
          ,bj1_024_9: 
          {
          page: 21,
          left: 299.884735107422,
          top: 523.185607910156,
          right: 393.310302734375,
          bottom: 551.490600585938
          }
          ,bj1_024_10: 
          {
          page: 21,
          left: 826.989624023438,
          top: 524.0986328125,
          right: 981.545654296875,
          bottom: 543.273071289063
          }
          ,bj1_025_1: 
          {
          page: 22,
          left: 350.682403564453,
          top: 172.727279663086,
          right: 394.642578125,
          bottom: 184.848480224609
          }
          ,bj1_025_2: 
          {
          page: 22,
          left: 328.702301025391,
          top: 160.606063842773,
          right: 422.617248535156,
          bottom: 178.030303955078
          }
          ,bj1_025_3: 
          {
          page: 22,
          left: 398.638977050781,
          top: 168.939392089844,
          right: 498.548492431641,
          bottom: 186.363632202148
          }
          ,bj1_025_4: 
          {
          page: 22,
          left: 419.619964599609,
          top: 162.878784179688,
          right: 429.610931396484,
          bottom: 172.727279663086
          }
          ,bj1_025_5: 
          {
          page: 22,
          left: 619.439025878906,
          top: 281.060607910156,
          right: 667.395568847656,
          bottom: 297.727264404297
          }
          ,bj1_025_6: 
          {
          page: 22,
          left: 105.786605834961,
          top: 352.584716796875,
          right: 178.661697387695,
          bottom: 375.222900390625
          }
          ,bj1_025_7: 
          {
          page: 22,
          left: 781.64501953125,
          top: 465.240600585938,
          right: 799.276123046875,
          bottom: 482.531219482422
          }
          ,bj1_025_8: 
          {
          page: 22,
          left: 781.64501953125,
          top: 465.240478515625,
          right: 819.258056640625,
          bottom: 482.531219482422
          }
          
      };',
      array(
        'group' => JS_THEME,
        'type' => 'inline',
        'preprocess' => FALSE,
      )
    );
	$js_add = 
	drupal_add_js(
      '  
			jQuery(document).ready(function() {	
		
			   window.imagePagePath =  "'.$variables["islandora_object_page_image"].'"	 //SEMANDRA - set a global path variable	   
			   
  			      var sliderData = [ 
                          {label:"A", color:"#FFBFBF", description:"typescript"},
                          {label:"B", color:"#FFBF7F", description:"felt pen"},
                          {label:"C", color:"#FFFF7F", description:"blue ink"},
                          {label:"D", color:"#7FFF7F", description:"pencil"},
                          {label:"E", color:"#BFBFFF", description:"ink"},
                          {label:"F", color:"#CF8FFF", description:"a later addition in pencil"}
                          ];

                      jQuery("#slider").Slider(sliderData);                    
                      
                      document.pageCtl = jQuery("#MyPageCtl").PageCtl(5, OnPageChange);                    
                      jQuery("#PageCtlAnchor").hide();
                      
                     document.zoomCtl = jQuery("#ZoomCtl").zoomCtl();
                      jQuery("#ZoomCtlAnchor").hide();
                      
                      changeRenderMode.call(document.getElementById("changesMode"));
                  
                     jQuery(document.body)
                          .css("height", "100%")
                          .css("width", "100%")
                          .keydown(OnKeyDown);
                          
                      jQuery("[data-polygons]")
                         .hover(OnMouseOver, OnMouseOut);
      
                      jQuery(".sicText")
                          .tooltip({
                              track: true,
                              content:
                                  function ()
                                  {
                                      var recte = jQuery(this).attr("title").trim();
                                      if (recte == "")
                                          return "<span class=\"recteText\">~</span>";
                                      else
                                          return recte;
                                  }
                          });
                          
                      jQuery(window).resize(positionSubstJoinHighlightDivs);

                      jQuery("#changesMode, #finalMode, #readingMode").click(changeRenderMode);
                  
                      initSubstJoinHighlight();
      
                      
                  }); ',
      array(
        'group' => JS_THEME,
        'type' => 'inline',
        'preprocess' => FALSE,
        'weight' => '99999',
      )
    );*/

drupal_add_js(
      '  
			 window.imagePagePath =  "'.$variables["islandora_object_page_image"].'";	 //SEMANDRA - set a global path variable	
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
<div id="metadataWrapper">
    <?php if (!empty($dc_array['dc:description']['value'])): ?>
      <p><?php print $dc_array['dc:description']['label']; ?> : 
      <?php print $dc_array['dc:description']['value']; ?></p>
    <?php endif; ?>
</div>

<?php //print_r($dc_array); ?>
<?php //print({$islandora_object->id}); ?>
<?php //print($islandora_object['DIGITALUS']->uri); ?>

<!--<div class ="digitalus_thumb">
    <?php print $variables['islandora_object_page_image'] ?>
  </div>-->
  <div class="islandora-basic-image-content-wrapper clearfix">
    <?php if (isset($islandora_content)): ?>
      <div class="islandora-digitalus-content">
      
        <?php print $islandora_content; ?>
     
      </div>
    <?php endif; ?>
  </div>
