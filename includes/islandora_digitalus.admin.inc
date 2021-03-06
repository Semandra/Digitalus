<?php
/**
 * @file
 * islandora_digitalus.admin.inc
 */

/**
 * Admin from.
 * @return array
 *   Returns admin form.
 */
function islandora_digitalus_admin() {
  $form = array();


  $form['islandora_digitalus_wordlength'] = array(
    '#type' => 'textfield',
    '#title' => t('Word Length'),
    '#default_value' => variable_get('islandora_digitalus_wordlength', '1'),
    '#description' => t('This does not currently do anything.'),
    '#size' => 4,
  );

  return system_settings_form($form);
}
