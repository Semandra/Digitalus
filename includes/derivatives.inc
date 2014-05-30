<?php

/**
 * @file
 * Creates additional datatreams for ingested object
 */

/**
 * Creates derivatives for object.
 *
 * The islandora_digitalus_islandora_digitalusCModel_islandora_object_ingested hook
 * calls this function. This function receives a copy of the uningested
 * islandora object and uses the OBJ datastream.
 *
 * Each datastream is constructed, labeled, assigned a mimetype, and given
 * content, either from a string, or read in from a file location.
 *
 * @param FedoraObject $object
 *   The object that will be used to generate/store the derivatives.
 *
 * @return bool
 *   TRUE if successful, FALSE otherwise.
 */
function islandora_digitalus_create_all_derivatives(FedoraObject $object) {
  if (!isset($object["OBJ"])) {
    drupal_set_message(t("Could not create derivatives for %s.  No file was uploaded.", array("%s" => $object->id), "error"));
    return FALSE;
  }
  $path = drupal_get_path('module', 'islandora_digitalus');
  $mime_detect = new MimeDetect();
  $ext = $mime_detect->getExtension($object['OBJ']->mimeType);
  $file_name = str_replace(":", "-", $object->id) . ".OBJ.{$ext}";
  $file_uri = file_create_filename($file_name, 'temporary://');
  // Add thumbnail.
  $ds = $object->constructDatastream('TN', "M");
  $ds->label = 'TN';
  $ds->mimetype = 'image/png';
  $ds->setContentFromFile("$path/images/digital_page_icon.png");
  $object->ingestDatastream($ds);
  // Create and add HTML version datastream.
  // This code was used to transform XML to HTML as a block
/*  $html_block = islandora_digitalus_transform_xml_to_html($object['OBJ']->content);
  $ds = $object->constructDatastream('DIGITALUS', "M");
  $ds->label = 'Transformed to HTML';
  $ds->mimetype = 'text/html';
  $ds->setContentFromString($html_block);
  $object->ingestDatastream($ds);*/
  
  // Add an HTML block to datastream.
  $html_block = $object['OBJ']->content;
  $ds = $object->constructDatastream('DIGITALUS', "M");
  $ds->label = 'Uploaded HTML';
  $ds->mimetype = 'text/html';
  $ds->setContentFromString($html_block);
  $object->ingestDatastream($ds);
  
  // Add an page image to datastream.
  $html_block = $object['OBJ']->content;
  $ds = $object->constructDatastream('IMAGE1', "M");
  $ds->label = 'Uploaded image';
  $ds->mimetype = 'image/jpg';
  $ds->setContentFromString($html_block);
  $object->ingestDatastream($ds);
  
  file_unmanaged_delete($file_uri);
  return TRUE;
}












/* Function to return nothing but the original file*/
// function islandora_digitalus_transform_text($input_text) {  /*This Works to do nothing to text*/
 // return $input_text;
//}

// NOT IN USE!
// This function was used to transform the xml version to html, but is not 
// used now because PHP does not suppor the v2 XSL we need. 
function islandora_digitalus_transform_xml_to_html($transform_text) {  // passed the value of 'OBJ' - contents of file
  $xsl_path = drupal_get_path('module', 'islandora_digitalus') . '/xsl/tei_mod.xsl'; // Get the XSL for the transformation
  $xsl = new DOMDocument();
  $xsl->load($xsl_path);				// $input_text was created in the transfore_xml_to_html function
  $input = new DOMDocument();
  $input->loadXML($transform_text);
  $processor = new XSLTProcessor();
  $processor->importStylesheet($xsl);
  // XXX: Suppressing warnings regarding unregistered prefixes.
  return @$processor->transformToXML($input);
}






/*
function islandora_digitalus_run_xsl_transform($transform_text) {  // passed the value of 'OBJ' - contents of file
  $xsl = new DOMDocument();
  $xsl->load($transform_text['xsl']);				// $input_text was created in the transfore_xml_to_html function
  $input = new DOMDocument();
  $input->loadXML($transform_text['input']);
  $processor = new XSLTProcessor();
  $processor->importStylesheet($xsl);
  // XXX: Suppressing warnings regarding unregistered prefixes.
  return @$processor->transformToXML($transform_text);
}

function islandora_digitalus_transform_xml_to_html($input_text) {  // called fron the ingest process /
  return islandora_digitalus_run_xsl_transform(array(
    'input' => $input_text, // Simply set the input to the passed $object variable from 
    'xsl' => drupal_get_path('module', 'islandora_digitalus') . '/xsl/sample.xsl', // Get the XSL for the transformation
	
  ));
 // return $input_text;
}

*/