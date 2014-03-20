<?php

/**
 * @file
 * template.php
 * @see https://drupal.org/node/2217037 The fixed in included in the dev branch
 *      so we can avoid the include lines in this template.
 */
include_once(drupal_get_path('theme', 'bvng') . '/templates/menu/menu-local-tasks.func.php');
include_once(drupal_get_path('theme', 'bvng') . '/templates/menu/menu-local-task.func.php');
include_once(drupal_get_path('theme', 'bvng') . '/templates/menu/menu-tree.func.php');
include_once(drupal_get_path('theme', 'bvng') . '/templates/menu/menu-link.func.php');

/**
 * Helper function for showing the title and subtitle of a site section in the
 * highlighted region.
 *
 * The description is retrieved from the description of the menu item.
 */
function bvng_get_title_data() {

  // The old way
	// $trail = menu_get_active_trail() ;
	// $taxon = taxonomy_get_term_by_name($trail[2]['title'], 'taxanavigation');
	// reset($taxon);
	// return current($taxon);
	
	// This way disassociates the taxanavigation voc, is more reasonable, but a bit heavy.
	// Only 'GBIF Newsroom' has a shorter name in the nav.
	$active_menu_item = menu_link_get_preferred(current_path(), 'gbif-menu');
	$parent = menu_link_load($active_menu_item['plid']);
	$title = array(
	 'mild' => $parent['mlid'],
   'name' => ($parent['link_title'] == 'GBIF News') ? 'GBIF Newsroom' : $parent['link_title'],
	 'description' => $parent['options']['attributes']['title'],
	);
	return $title;
}

function bvng_preprocess_page(&$variables) {
  $variables['page']['highlighted_title'] = bvng_get_title_data();
}
