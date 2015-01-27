<?php

/**
 * @file
 * Handles the uploading of the HTML file as part of the ingest process.
 */

/**
 * Defines a file upload form for uploading the prepared HTML file.
 *
 * @param array $form
 *   The drupal form.
 * @param array $form_state
 *   The drupal form state.
 *
 * @return array
 *   The drupal form definition.
 */
function islandora_digitalus_upload_form(array $form, array &$form_state) {
  $upload_size = min((int) ini_get('post_max_size'), (int) ini_get('upload_max_filesize'));
  $extensions = array('htm html');
  $imageExtensions = array('jpg png');
  
  $form = array();
  $form['file'] = array(
    '#title' => t('HTML File'),
    '#type' => 'managed_file',
    '#required' => TRUE,
    '#description' => t('Select file to upload.<br/>Files must be less than <b>@size MB.</b><br/>Allowed file types: <b>@ext.</b>', array('@size' => $upload_size, '@ext' => $extensions[0])),
    '#default_value' => isset($form_state['values']['files']) ? $form_state['values']['files'] : NULL,
    '#upload_location' => 'temporary://',
    '#upload_validators' => array(
      'file_validate_extensions' => $extensions,
      'file_validate_size' => array($upload_size * 1024 * 1024),
    ),
  );
 
 //======= CSS File ================= 
 
  	$form['styles'] = array(
    '#title' => t('CSS File'),
    '#type' => 'managed_file',
    '#required' => TRUE,
    '#description' => t('Select the CSS file to upload. This should have an HTML extension.<br/>Files must be less than <b>@size MB.</b><br/>Allowed file types: <b>@ext.</b>', array('@size' => $upload_size, '@ext' => $extensions[0])),
    '#default_value' => isset($form_state['values']['files']) ? $form_state['values']['files'] : NULL,
    '#upload_location' => 'temporary://',
    '#upload_validators' => array(
      'file_validate_extensions' => $extensions,
      'file_validate_size' => array($upload_size * 1024 * 1024),
    ),
  );  

 //======= first image of page file ================= 
 
 	$form['pages'] = array(
    '#title' => t('Page Image File'),
    '#type' => 'managed_file',
    '#required' => FALSE,
    '#description' => t('Select images of pages to upload.<br/>Files must be less than <b>@size MB.</b><br/>Allowed file types: <b>@ext.</b>', array('@size' => $upload_size, '@ext' => $imageExtensions[0])),
    '#default_value' => isset($form_state['values']['files']) ? $form_state['values']['files'] : NULL,
    '#upload_location' => 'temporary://',
    '#upload_validators' => array(
      'file_validate_extensions' => $imageExtensions,
      'file_validate_size' => array($upload_size * 1024 * 1024),
    ),
  );  

  return $form;
}

/**
 * Adds the uploaded file into the ingestable objects 'OBJ' datastream.
 *
 * @param array $form
 *   The drupal form.
 * @param array $form_state
 *   The drupal form state.
 */
function islandora_digitalus_upload_form_submit(array $form, array &$form_state) {
  $object = $form_state['islandora']['objects'][0];
  
  if (empty($object['OBJ'])) {
    $ds = $object->constructDatastream('OBJ', 'M');
    $object->ingestDatastream($ds);
  }
  else {
    $ds = $object['OBJ'];
  }
  $pdf_file = file_load($form_state['values']['file']);
  $pdf_path = drupal_realpath($pdf_file->uri);
  $ds->setContentFromFile($pdf_path, FALSE);
  $ds->label = $pdf_file->filename;
  $ds->mimetype = $pdf_file->filemime;
  
  // CSS Styles Object 
  
  if (empty($object['STYLES'])) {
    $my_ds = $object->constructDatastream('STYLES', 'M');
    $object->ingestDatastream($my_ds);
  }
  else {
    $my_ds = $object['STYLES'];
  }
  $pdf_file = file_load($form_state['values']['styles']);
  $pdf_path = drupal_realpath($pdf_file->uri);
  $my_ds->setContentFromFile($pdf_path, FALSE);
  $my_ds->label = $pdf_file->filename;
  $my_ds->mimetype = $pdf_file->filemime;  
  
  $object->ingestDatastream($my_ds); 
  
    
  // First page image Object 

  if (empty($object['IMAGE1'])) {
    $my_ds = $object->constructDatastream('IMAGE1', 'M');
    $object->ingestDatastream($my_ds);
  }
  else {
    $my_ds = $object['STYLES'];
  }
  $pdf_file = file_load($form_state['values']['pages']);
  $pdf_path = drupal_realpath($pdf_file->uri);
  $my_ds->setContentFromFile($pdf_path, FALSE);
  $my_ds->label = $pdf_file->filename;
  $my_ds->mimetype = $pdf_file->filemime;  
  
  $object->ingestDatastream($my_ds); 


}
