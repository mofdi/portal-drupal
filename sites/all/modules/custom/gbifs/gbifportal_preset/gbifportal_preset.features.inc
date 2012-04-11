<?php
/**
 * @file
 * gbifportal_preset.features.inc
 */

/**
 * Implements hook_views_api().
 */
function gbifportal_preset_views_api() {
  list($module, $api) = func_get_args();
  if ($module == "views" && $api == "views_default") {
    return array("version" => "3.0");
  }
}

/**
 * Implements hook_fontyourface_features_default_font().
 */
function gbifportal_preset_fontyourface_features_default_font() {
  return array(
    'DINOT-Medium normal normal' => array(
      'name' => 'DINOT-Medium normal normal',
      'enabled' => '1',
      'url' => 'http://localhost/#bfe806ed9ceb9a0bcdc3ea2d5160809a',
      'provider' => 'local_fonts',
      'css_selector' => '.site-name',
      'css_family' => '\'DINOT-Medium\'',
      'css_style' => 'normal',
      'css_weight' => 'normal',
      'css_fallbacks' => '',
      'foundry' => '',
      'foundry_url' => '',
      'license' => '',
      'license_url' => '',
      'designer' => '',
      'designer_url' => '',
      'metadata' => 'a:1:{s:4:"path";s:75:"public://fontyourface/local_fonts/DINOT_Medium-normal-normal/stylesheet.css";}',
    ),
    'DINOT-Regular normal normal' => array(
      'name' => 'DINOT-Regular normal normal',
      'enabled' => '1',
      'url' => 'http://localhost/#7e6c098c401502886855dd12868e49d0',
      'provider' => 'local_fonts',
      'css_selector' => '#zone-footer',
      'css_family' => '\'DINOT-Regular\'',
      'css_style' => 'normal',
      'css_weight' => 'normal',
      'css_fallbacks' => '',
      'foundry' => '',
      'foundry_url' => '',
      'license' => '',
      'license_url' => '',
      'designer' => '',
      'designer_url' => '',
      'metadata' => 'a:1:{s:4:"path";s:76:"public://fontyourface/local_fonts/DINOT_Regular-normal-normal/stylesheet.css";}',
    ),
  );
}

/**
 * Implements hook_node_info().
 */
function gbifportal_preset_node_info() {
  $items = array(
    'book' => array(
      'name' => t('Book page'),
      'base' => 'node_content',
      'description' => t('<em>Books</em> have a built-in hierarchical navigation. Use for handbooks or tutorials.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'image' => array(
      'name' => t('Image'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'page' => array(
      'name' => t('Basic page'),
      'base' => 'node_content',
      'description' => t('Use <em>basic pages</em> for your static content, such as an \'About us\' page.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  return $items;
}
