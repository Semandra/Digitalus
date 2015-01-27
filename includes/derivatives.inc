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
  };
  $path = drupal_get_path('module', 'islandora_digitalus');
  $mime_detect = new MimeDetect();
  $ext = $mime_detect->getExtension($object['OBJ']->mimeType);
  $file_name = str_replace(":", "-", $object->id) . ".OBJ.{$ext}";
  $file_uri = file_create_filename($file_name, 'temporary://');
  
  
  // Add thumbnail to object datastream
  $ds = $object->constructDatastream('TN', "M"); // use temp variable to build a new data stream
  $ds->label = 'TN';
  $ds->mimetype = 'image/png';
  $ds->setContentFromFile("$path/images/digital_page_icon.png");
  $object->ingestDatastream($ds);
  
  
  // Add an HTML block to datastream.
  $html_block = $object['OBJ']->content;
  $ds = $object->constructDatastream('DIGITALUS', "M");
  $ds->label = 'Uploaded HTML';
  $ds->mimetype = 'text/html';
  $ds->setContentFromString($html_block);
  $object->ingestDatastream($ds);
  
  file_unmanaged_delete($file_uri);
  return TRUE;
}

