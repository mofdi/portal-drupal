<?php
/**
 * Implements hook_form_system_theme_settings_alter().
 *
 * @param $form
 *   Nested array of form elements that comprise the form.
 * @param $form_state
 *   A keyed array containing the current state of the form.
 */
function gbifgreen_form_system_theme_settings_alter(&$form, &$form_state, $form_id = NULL)  {
  // Work-around for a core bug affecting admin themes. See issue #943212.
  if (isset($form_id)) {
    return;
  }

  // Create the form using Forms API: http://api.drupal.org/api/7

	$form['gbifgreen_settings'] = array(
		'#type' => 'fieldset',
		'#title' => t('Data portal related settings')
	);
	$form['gbifgreen_settings']['dataportal_base_url'] = array(
		'#type'          => 'textfield',
		'#title'         => t('$base_url for the data portal'),
		'#default_value' => theme_get_setting('dataportal_base_url'),
		'#description'   => t('Input the value for $base_url to be used when URLs are built in relation to data portal, e.g. http://dataportal.gbif.org.'),
	);
	$form['gbifgreen_settings']['api_base_url'] = array(
		'#type'          => 'textfield',
		'#title'         => t('$base_url for the API site'),
		'#default_value' => theme_get_setting('api_base_url'),
		'#description'   => t('Input the value for $base_url to be used for various GBIF API calls.'),
	);
	$form['gbifgreen_settings']['google_analytics_key'] = array(
		'#type'          => 'textfield',
		'#title'         => t('Google Analytics key'),
		'#default_value' => theme_get_setting('google_analytics_key'),
		'#description'   => t('Input the value for the Google analytics key to be used in the footer section.'),
	);

  // Remove some of the base theme's settings.
  /* -- Delete this line if you want to turn off this setting.
  unset($form['themedev']['zen_wireframes']); // We don't need to toggle wireframes on this site.
  // */

  // We are editing the $form in place, so we don't need to return anything.
}
