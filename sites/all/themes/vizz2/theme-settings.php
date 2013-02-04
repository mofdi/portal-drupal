<?php
/**
 * Implements hook_form_system_theme_settings_alter().
 *
 * @param $form
 *   Nested array of form elements that comprise the form.
 * @param $form_state
 *   A keyed array containing the current state of the form.
 */


function vizz2_form_system_theme_settings_alter(&$form, &$form_state, $form_id = NULL)  {
  // Work-around for a core bug affecting admin themes. See issue #943212.
  if (isset($form_id)) {
    return;
  }

  $form['vizz2_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Dataportal related settings')
   );
  $form['vizz2_settings']['vizz2_dataportal_base_url'] = array(
		'#type'          => 'textfield',
		'#title'         => t('$base_url for the dataportal'),
		'#default_value' => theme_get_setting('vizz2_dataportal_base_url'),
		'#description'   => t("Input the value for $base_url to be used when URLs are built in relation to dataportal <br> e.g. http://dataportal.gbif.org"),
	);


  // Create the form using Forms API: http://api.drupal.org/api/7

  /* -- Delete this line if you want to use this setting

  // */

  // Remove some of the base theme's settings.
  /* -- Delete this line if you want to turn off this setting.
  unset($form['themedev']['zen_wireframes']); // We don't need to toggle wireframes on this site.
  // */

  // We are editing the $form in place, so we don't need to return anything.
}
