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
include_once(drupal_get_path('theme', 'bvng') . '/templates/bootstrap/bootstrap-search-form-wrapper.func.php');
include_once(drupal_get_path('theme', 'bvng') . '/templates/system/status-messages.func.php');


/**
 * Implements hook_theme().
 * @see http://www.danpros.com/2013/01/creating-custom-user-login-page-in.html
 */
function bvng_theme() {
  $items = array();
  // create custom user-login.tpl.php
  $items['user_login'] = array(
    'render element' => 'form',
    'template' => 'templates/system/user-login',
    'preprocess functions' => array(
      'bvng_preprocess_user_login'
    ),
  );
  return $items;
}

function bvng_preprocess_user_login() {

}

/**
 * Implements template_preprocess_page().
 *
 * @see gbif_navigation_node_view().
 * @see http://www.dibe.gr/blog/set-path-determining-active-trail-drupal-7-menu
 */
function bvng_preprocess_page(&$variables) {
  $current_path = current_path();
  if (!empty($variables['node'])) {
    switch ($variables['node']->type) {
      case 'newsarticle':
        $system_path = drupal_get_normal_path('newsroom/news'); // taxonomy/term/566
        menu_tree_set_path('gbif-menu', $system_path);
        menu_set_active_item($system_path);
        $variables['node']->type_title = t('GBIF News');
        break;
      case 'usesofdata':
        $system_path = drupal_get_normal_path('newsroom/uses'); // taxonomy/term/566
        menu_tree_set_path('gbif-menu', $system_path);
        menu_set_active_item($system_path);
        $variables['node']->type_title = t('Featured Data Use');
        break;
    }
  }
  elseif (strpos($current_path, 'allnewsarticles')) {
    // Insert $current_path to the content region so it knows the requested path.
    $variables['page']['content']['current_path'] = $current_path;
    $system_path = drupal_get_normal_path('newsroom/news'); // taxonomy/term/566
    menu_tree_set_path('gbif-menu', $system_path);
    menu_set_active_item($system_path);
  }
  $variables['page']['highlighted_title'] = bvng_get_title_data();

  // @todo For testing purpose. To be deleted later.
  // drupal_set_message(t('An error messaged is generated for developing the message box.'), 'warning');
}

/**
 * Implements template_preprocess_region().
 */
function bvng_preprocess_region(&$variables) {
  $well = bvng_get_container_well();
  $current_path = $variables['elements']['current_path'];
  switch ($variables['region']) {
    case 'content':
      if (!empty($variables['elements']['system_main']['nodes'])) {
        break;
      }
      elseif (!empty($variables['elements']['system_main']['taxonomy_terms']) || strpos($current_path, 'allnewsarticles')) {
        $variables['well_top'] = $well['filter']['top'];
        $variables['well_bottom'] = $well['filter']['bottom'];
      }
      else {
        $variables['well_top'] = $well['normal']['top'];
        $variables['well_bottom'] = $well['normal']['bottom'];
      }
      break;
  }
}

/**
 * Implements hook_preprocess_node().
 */
function bvng_preprocess_node(&$variables) {
  /* Get sidebar content
   */
  $sidebar = bvng_get_sidebar_content($variables['nid'], $variables['vid']);
  $variables['sidebar'] = $sidebar;

  /* Processing menu_local_tasks()
   */
  global $user;

  // Bring the local tasks tab into node template.
  $variables['tabs'] = menu_local_tabs();

  /* Determine what local task to show according to the role.
   * @todo To implement this using user_permission.
   */
  foreach ($variables['tabs']['#primary'] as $key => $item) {
    // We don't need the view tab because we're already viewing it.

    switch ($item['#link']['title']) {
      case 'View':
        unset($variables['tabs']['#primary'][$key]);
        break;
      case 'Edit':
        if (!in_array('Editors', $user->roles)) unset($variables['tabs']['#primary'][$key]);
        break;
      case 'Devel':
        if (!in_array('administrator', $user->roles)) unset($variables['tabs']['#primary'][$key]);
        break;
    }
  }

  /* Get also tagged
   */
  $variables['also_tagged'] = bvng_get_also_tag_links($variables['node']);
}

function bvng_preprocess_views_view(&$variables) {

}

function bvng_preprocess_search_block_form(&$variables) {
}

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

function bvng_get_sidebar_content($nid, $vid) {
  $node = node_load($nid, $vid);

  if ($node && $node->type === 'newsarticle') {

    // PUBLICATION DATE
    $publication_date = array(
      'title' => t('Publication date'),
      'type' => 'ul',
      'items' => array(
        'data' => format_date($node->created, 'custom', 'F jS, Y '),
      ),
      'attributes' => array(
        'id' => 'publication-date',
        'class' => 'item-date',
      ),
    );

    // LAST UPDATED
    $last_updated = array(
      'title' => t('Last updated'),
      'type' => 'ul',
      'items' => array(
        'data' => format_date($node->changed, 'custom', 'F jS, Y '),
      ),
      'attributes' => array(
        'id' => 'last-updated',
        'class' => 'item-date',
      ),
    );

    // TAGS

    // Create term links.
    $term_links = array(
      'title' => t('Tags'),
      'type' => 'ul',
      'attributes' => array(
        'id' => 'tags',
        'class' => 'tags'
      ),
    );
    $tag_links = bvng_get_tag_links($node);
    foreach ($tag_links as $tag_link) {
      $term_links['items'][]['data'] = $tag_link;
    }
  }

  $markup = theme_item_list($publication_date);
  $markup .= theme_item_list($last_updated);
  $markup .= theme_item_list($term_links);

  return $markup;
}

function bvng_get_filter_links() {
  $regions = variable_get('gbif_region_definition');
  $links = '';
  $links = '<ul class="filter-list">';
  foreach ($regions as $region) {
    $links .= '<li>';
    $url_base = 'newsroom/archive/allnewsarticles/';
    $links .= l($region, $url_base . $region);
    $links .= '</li>';
  }
  $links .= '</ul>';
  return $links;
}

/**
 * Helper function to get tags from specified fields.
 */
function bvng_get_tag_links($node) {
  $terms = array();

  // List fields to get terms.
  $term_sources = array(
    'field_capacity',
    'field_country',
    'field_informatics',
    'field_organizations',
    'field_regions',
  );

  // Get all the terms.
  foreach ($term_sources as $term_source) {
    $items = field_get_items('node', $node, $term_source);
    foreach ($items as $item) {
      $terms[] = $item['tid'];
    }
  }

  $tag_links = array();
  foreach ($terms as $tid) {
    $term = taxonomy_term_load($tid);
    $uri = taxonomy_term_uri($term);
    $tag_links[] = l($term->name, $uri['path']);
  }

  return $tag_links;
}

/**
 * Helper function to get "also tagged" tag links.
 */
function bvng_get_also_tag_links($node) {
  $tag_links = bvng_get_tag_links($node);
  $term_links = t('Also tagged') . ':' . '<ul class="also-tagged">';
  foreach ($tag_links as $tag_link) {
    $term_links .= '<li>' . $tag_link . '</li>';
  }
  $term_links .= '</ul>';
  return $term_links;
}

/**
 * Helper function for the styling of external wells.
 */
function bvng_get_container_well() {
  $well = array();
  $well['normal'] = array(
    'top' => '<div class="container well well-lg well-margin-top well-margin-bottom">' . "\n" . '<div class="row">' . "\n" . '<div class="col-md-12">',
    'bottom' => '</div>' . "\n" . '</div>' . "\n" . '</div>',
  );
  $well['filter'] = array(
    'top' => '<div class="container well well-lg well-margin-top well-margin-bottom well-right-bg">' . "\n" . '<div class="row">' . "\n" . '<div class="col-md-12">',
    'bottom' => '</div>' . "\n" . '</div>' . "\n" . '</div>',
  );
  return $well;
}