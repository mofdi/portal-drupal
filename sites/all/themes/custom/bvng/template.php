<?php

/**
 * @file
 * template.php
 */

include_once(drupal_get_path('theme', 'bvng') . '/templates/menu/menu-local-tasks.func.php');
include_once(drupal_get_path('theme', 'bvng') . '/templates/menu/menu-tree.func.php');

function bvng_get_title_data() {
	$trail = menu_get_active_trail() ;
	$taxon = taxonomy_get_term_by_name($trail[2]['title'], 'taxanavigation');
	reset($taxon);
	return current($taxon);
}