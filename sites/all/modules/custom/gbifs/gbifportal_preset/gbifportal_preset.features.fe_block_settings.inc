<?php
/**
 * @file
 * gbifportal_preset.features.fe_block_settings.inc
 */

/**
 * Implements hook_default_fe_block_settings().
 */
function gbifportal_preset_default_fe_block_settings() {
  $export = array();

  // bartik
  $theme = array();

  $theme['aggregator-category-1'] = array(
    'module' => 'aggregator',
    'delta' => 'category-1',
    'theme' => 'bartik',
    'status' => 0,
    'weight' => '0',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => '1',
  );

  $theme['aggregator-category-2'] = array(
    'module' => 'aggregator',
    'delta' => 'category-2',
    'theme' => 'bartik',
    'status' => 0,
    'weight' => '0',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => '1',
  );

  $theme['aggregator-feed-1'] = array(
    'module' => 'aggregator',
    'delta' => 'feed-1',
    'theme' => 'bartik',
    'status' => 0,
    'weight' => '0',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => '1',
  );

  $theme['aggregator-feed-2'] = array(
    'module' => 'aggregator',
    'delta' => 'feed-2',
    'theme' => 'bartik',
    'status' => 0,
    'weight' => '0',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => '1',
  );

  $theme['aggregator-feed-3'] = array(
    'module' => 'aggregator',
    'delta' => 'feed-3',
    'theme' => 'bartik',
    'status' => 0,
    'weight' => '0',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => 'Featured Development',
    'cache' => '1',
  );

  $theme['aggregator-feed-4'] = array(
    'module' => 'aggregator',
    'delta' => 'feed-4',
    'theme' => 'bartik',
    'status' => 0,
    'weight' => '0',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => '1',
  );

  $theme['gbif_spdsht-available_templates'] = array(
    'module' => 'gbif_spdsht',
    'delta' => 'available_templates',
    'theme' => 'bartik',
    'status' => '1',
    'weight' => '-50',
    'region' => 'sidebar_second',
    'custom' => '0',
    'visibility' => '1',
    'pages' => 'spreadsheet-processor',
    'title' => '',
    'cache' => '1',
  );

  $theme['gbif_spdsht-upload_and_process'] = array(
    'module' => 'gbif_spdsht',
    'delta' => 'upload_and_process',
    'theme' => 'bartik',
    'status' => '1',
    'weight' => '-60',
    'region' => 'sidebar_second',
    'custom' => '0',
    'visibility' => '1',
    'pages' => 'spreadsheet-processor',
    'title' => '',
    'cache' => '1',
  );

  $theme['search-form'] = array(
    'module' => 'search',
    'delta' => 'form',
    'theme' => 'bartik',
    'status' => '1',
    'weight' => '-1',
    'region' => 'sidebar_first',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => -1,
  );

  $theme['superfish-1'] = array(
    'module' => 'superfish',
    'delta' => '1',
    'theme' => 'bartik',
    'status' => 0,
    'weight' => '0',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => -1,
  );

  $theme['system-main-menu'] = array(
    'module' => 'system',
    'delta' => 'main-menu',
    'theme' => 'bartik',
    'status' => 0,
    'weight' => '0',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => -1,
  );

  $theme['system-powered-by'] = array(
    'module' => 'system',
    'delta' => 'powered-by',
    'theme' => 'bartik',
    'status' => '1',
    'weight' => '10',
    'region' => 'footer',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => -1,
  );

  $theme['system-user-menu'] = array(
    'module' => 'system',
    'delta' => 'user-menu',
    'theme' => 'bartik',
    'status' => 0,
    'weight' => '0',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => -1,
  );

  $theme['views-recent_content-block'] = array(
    'module' => 'views',
    'delta' => 'recent_content-block',
    'theme' => 'bartik',
    'status' => 0,
    'weight' => '0',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => -1,
  );

  $export['bartik'] = $theme;

  // gbif2012
  $theme = array();

  $theme['aggregator-category-1'] = array(
    'module' => 'aggregator',
    'delta' => 'category-1',
    'theme' => 'gbif2012',
    'status' => 0,
    'weight' => '-10',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => '1',
  );

  $theme['aggregator-category-2'] = array(
    'module' => 'aggregator',
    'delta' => 'category-2',
    'theme' => 'gbif2012',
    'status' => 0,
    'weight' => '-14',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => '1',
  );

  $theme['aggregator-feed-1'] = array(
    'module' => 'aggregator',
    'delta' => 'feed-1',
    'theme' => 'gbif2012',
    'status' => 0,
    'weight' => '-2',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => '1',
  );

  $theme['aggregator-feed-2'] = array(
    'module' => 'aggregator',
    'delta' => 'feed-2',
    'theme' => 'gbif2012',
    'status' => 0,
    'weight' => '-11',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => 'IPT Issues',
    'cache' => '1',
  );

  $theme['aggregator-feed-3'] = array(
    'module' => 'aggregator',
    'delta' => 'feed-3',
    'theme' => 'gbif2012',
    'status' => '1',
    'weight' => '0',
    'region' => 'postscript_second',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => 'Featured Development',
    'cache' => '1',
  );

  $theme['aggregator-feed-4'] = array(
    'module' => 'aggregator',
    'delta' => 'feed-4',
    'theme' => 'gbif2012',
    'status' => '1',
    'weight' => '0',
    'region' => 'postscript_third',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => 'Checklist Bank Issues',
    'cache' => '1',
  );

  $theme['gbif_spdsht-available_templates'] = array(
    'module' => 'gbif_spdsht',
    'delta' => 'available_templates',
    'theme' => 'gbif2012',
    'status' => '1',
    'weight' => '-50',
    'region' => 'sidebar_second',
    'custom' => '0',
    'visibility' => '1',
    'pages' => 'spreadsheet-processor',
    'title' => '',
    'cache' => '1',
  );

  $theme['gbif_spdsht-upload_and_process'] = array(
    'module' => 'gbif_spdsht',
    'delta' => 'upload_and_process',
    'theme' => 'gbif2012',
    'status' => '1',
    'weight' => '-60',
    'region' => 'sidebar_second',
    'custom' => '0',
    'visibility' => '1',
    'pages' => 'spreadsheet-processor',
    'title' => '',
    'cache' => '1',
  );

  $theme['search-form'] = array(
    'module' => 'search',
    'delta' => 'form',
    'theme' => 'gbif2012',
    'status' => '1',
    'weight' => '-15',
    'region' => 'menu',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => -1,
  );

  $theme['superfish-1'] = array(
    'module' => 'superfish',
    'delta' => '1',
    'theme' => 'gbif2012',
    'status' => '1',
    'weight' => '-16',
    'region' => 'menu',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => -1,
  );

  $theme['system-main-menu'] = array(
    'module' => 'system',
    'delta' => 'main-menu',
    'theme' => 'gbif2012',
    'status' => 0,
    'weight' => '-9',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => -1,
  );

  $theme['system-powered-by'] = array(
    'module' => 'system',
    'delta' => 'powered-by',
    'theme' => 'gbif2012',
    'status' => 0,
    'weight' => '-6',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => -1,
  );

  $theme['system-user-menu'] = array(
    'module' => 'system',
    'delta' => 'user-menu',
    'theme' => 'gbif2012',
    'status' => '1',
    'weight' => '-11',
    'region' => 'sidebar_second',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => -1,
  );

  $theme['views-recent_content-block'] = array(
    'module' => 'views',
    'delta' => 'recent_content-block',
    'theme' => 'gbif2012',
    'status' => '1',
    'weight' => '1',
    'region' => 'postscript_first',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => 'Recent Contents',
    'cache' => -1,
  );

  $export['gbif2012'] = $theme;

  // seven
  $theme = array();

  $theme['aggregator-category-1'] = array(
    'module' => 'aggregator',
    'delta' => 'category-1',
    'theme' => 'seven',
    'status' => 0,
    'weight' => '0',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => '1',
  );

  $theme['aggregator-category-2'] = array(
    'module' => 'aggregator',
    'delta' => 'category-2',
    'theme' => 'seven',
    'status' => 0,
    'weight' => '0',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => '1',
  );

  $theme['aggregator-feed-1'] = array(
    'module' => 'aggregator',
    'delta' => 'feed-1',
    'theme' => 'seven',
    'status' => 0,
    'weight' => '0',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => '1',
  );

  $theme['aggregator-feed-2'] = array(
    'module' => 'aggregator',
    'delta' => 'feed-2',
    'theme' => 'seven',
    'status' => 0,
    'weight' => '0',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => '1',
  );

  $theme['aggregator-feed-3'] = array(
    'module' => 'aggregator',
    'delta' => 'feed-3',
    'theme' => 'seven',
    'status' => 0,
    'weight' => '0',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => 'Featured Development',
    'cache' => '1',
  );

  $theme['aggregator-feed-4'] = array(
    'module' => 'aggregator',
    'delta' => 'feed-4',
    'theme' => 'seven',
    'status' => 0,
    'weight' => '0',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => '1',
  );

  $theme['gbif_spdsht-available_templates'] = array(
    'module' => 'gbif_spdsht',
    'delta' => 'available_templates',
    'theme' => 'seven',
    'status' => 0,
    'weight' => '-50',
    'region' => '',
    'custom' => '0',
    'visibility' => '1',
    'pages' => 'spreadsheet-processor',
    'title' => '',
    'cache' => '1',
  );

  $theme['gbif_spdsht-upload_and_process'] = array(
    'module' => 'gbif_spdsht',
    'delta' => 'upload_and_process',
    'theme' => 'seven',
    'status' => 0,
    'weight' => '-60',
    'region' => '',
    'custom' => '0',
    'visibility' => '1',
    'pages' => 'spreadsheet-processor',
    'title' => '',
    'cache' => '1',
  );

  $theme['search-form'] = array(
    'module' => 'search',
    'delta' => 'form',
    'theme' => 'seven',
    'status' => '1',
    'weight' => '-10',
    'region' => 'dashboard_sidebar',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => -1,
  );

  $theme['superfish-1'] = array(
    'module' => 'superfish',
    'delta' => '1',
    'theme' => 'seven',
    'status' => 0,
    'weight' => '0',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => -1,
  );

  $theme['system-main-menu'] = array(
    'module' => 'system',
    'delta' => 'main-menu',
    'theme' => 'seven',
    'status' => 0,
    'weight' => '0',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => -1,
  );

  $theme['system-powered-by'] = array(
    'module' => 'system',
    'delta' => 'powered-by',
    'theme' => 'seven',
    'status' => 0,
    'weight' => '10',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => -1,
  );

  $theme['system-user-menu'] = array(
    'module' => 'system',
    'delta' => 'user-menu',
    'theme' => 'seven',
    'status' => 0,
    'weight' => '0',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => -1,
  );

  $theme['views-recent_content-block'] = array(
    'module' => 'views',
    'delta' => 'recent_content-block',
    'theme' => 'seven',
    'status' => 0,
    'weight' => '0',
    'region' => '',
    'custom' => '0',
    'visibility' => '0',
    'pages' => '',
    'title' => '',
    'cache' => -1,
  );

  $export['seven'] = $theme;

  $theme_default = variable_get('theme_default', 'garland');
  $themes = list_themes();
  foreach ($export as $theme_key => $settings) {
    if ($theme_key != $theme_default && empty($themes[$theme_key]->status)) {
      unset($export[$theme_key]);
    }
  }
  return $export;
}
