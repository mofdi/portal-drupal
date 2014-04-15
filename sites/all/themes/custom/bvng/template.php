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
 * Implements template_preprocess().
 */
function bvng_preprocess(&$variables, $hook) {
  $data_portal_base_url = variable_get('data_portal_base_url');
  $variables['data_portal_base_url'] = $data_portal_base_url;
  
  /* The $current_path will change after setting active menu item,
   * therefore a requested_path value is inserted to content region
   * for regional processing.
   */
  $current_path = current_path();
  $variables['current_path'] = $current_path;

	switch ($hook) {
  	case 'page':
  		if ($variables['page']['content']) {
  			$req_path = current_path();
  			$variables['page']['content']['requested_path'] = $req_path;
  			if (isset($variables['page']['content']['system_main']['nodes'])) {
  				$nodes = &$variables['page']['content']['system_main']['nodes'];
  				foreach ($nodes as $nid => $node) {
  					if (is_int($nid)) {
  						$node['#node']->requested_path= $req_path;
  					}
  				}
  			}
  			if (isset($variables['page']['content']['system_main']['#block'])) {
  				$block = &$variables['page']['content']['system_main']['#block'];
  				if ($block->module == 'system' && $block->delta == 'main') {
  					$block->requested_path = $req_path;
  				}
  			}
  			if (isset($variables['node'])) {
    			$variables['node']->requested_path = $req_path;
  			}
  		}
  		break;
  	case 'region':
  		switch ($variables['region']) {
  			case 'content':
  				break;
  		}
  		break;
	}
}

/**
 * Implements template_preprocess_html().
 */
function bvng_preprocess_html(&$variables) {
  $data_portal_base_url = $variables['data_portal_base_url'];
  //drupal_add_js($data_portal_base_url . '/cfg', array('type' => 'file', 'scope' => 'header'));
  //drupal_add_js($data_portal_base_url . '/js/vendor/modernizr-1.7.min.js', array('type' => 'file', 'scope' => 'header'));
  //drupal_add_js($data_portal_base_url . '/js/vendor/jquery-1.7.1.min.js', array('type' => 'file', 'scope' => 'header'));
  //drupal_add_js($data_portal_base_url . '/js/vendor/jscrollpane.min.js', array('type' => 'file', 'scope' => 'header'));
  //drupal_add_js($data_portal_base_url . '/js/vendor/css_browser_selector.js', array('type' => 'file', 'scope' => 'header'));
}


/**
 * Implements template_preprocess_page().
 *
 * @see gbif_navigation_node_view().
 * @see http://www.dibe.gr/blog/set-path-determining-active-trail-drupal-7-menu
 */
function bvng_preprocess_page(&$variables) {
	$req_path = $variables['page']['content']['requested_path'];
	$altered_path = FALSE ;
	
	/* @todo move menu_tree_set_path() and menu_set_active_item() outside the condition
	 *       breaks the menu.
	 */

	if (!empty($variables['node']->type)) {
		switch ($variables['node']->type) {
			case 'newsarticle':
				$altered_path = drupal_get_normal_path('newsroom/news'); // taxonomy/term/566
				$variables['node']->type_title = t('GBIF News');
				break;
			case 'usesofdata':
				$altered_path = drupal_get_normal_path('newsroom/uses'); // taxonomy/term/567
				$variables['node']->type_title = t('Featured Data Use');
				break;
		}
	}
	elseif (strpos($req_path, 'allnewsarticles') !== FALSE) {
		$altered_path = drupal_get_normal_path('newsroom/news'); // taxonomy/term/566
	} 
	elseif (strpos($req_path, 'alldatausearticles') !== FALSE) {
		$altered_path = drupal_get_normal_path('newsroom/uses'); // taxonomy/term/567
	}
	elseif (strpos($req_path, 'resources') !== FALSE) {
		$altered_path = drupal_get_normal_path('resources/summary'); // taxonomy/term/764
	}
	elseif (strpos($req_path, 'events') !== FALSE) {
		$altered_path = drupal_get_normal_path('newsroom/events'); // taxonomy/term/569
	}
	
	if ($altered_path) { 
		menu_tree_set_path('gbif-menu', $altered_path);
		menu_set_active_item($altered_path); 
	}
	else {
		$active_path = menu_tree_get_path('gbif-menu');
		menu_tree_set_path('gbif-menu', $active_path);
		menu_set_active_item($req_path); 
	}
  
  if (isset($variables['page']['content']['system_main']['nodes'])) {
  	$node_count = _bvng_node_count($variables['page']['content']['system_main']['nodes']);
  }
  $variables['page']['highlighted_title'] = bvng_get_title_data($node_count = NULL);
  
  // Manually set page title.
  if ($req_path == 'taxonomy/term/565') {
    drupal_set_title(t('GBIF Newsroom'));
  }

  /* Load javascripts.
   */
  //drupal_add_js($data_portal_base_url . '/js/vendor/jquery.dropkick-1.0.0.js', array('type' => 'file', 'scope' => 'footer'));
  //drupal_add_js($data_portal_base_url . '/js/vendor/jquery.uniform.min.js', array('type' => 'file', 'scope' => 'footer'));
  //drupal_add_js($data_portal_base_url . '/js/vendor/mousewheel.js', array('type' => 'file', 'scope' => 'footer'));
  //drupal_add_js($data_portal_base_url . '/js/vendor/jquery-scrollTo-1.4.2-min.js', array('type' => 'file', 'scope' => 'footer'));
  //drupal_add_js($data_portal_base_url . '/js/vendor/underscore-min.js', array('type' => 'file', 'scope' => 'footer'));
  //drupal_add_js($data_portal_base_url . '/js/helpers.js', array('type' => 'file', 'scope' => 'footer'));
  //drupal_add_js($data_portal_base_url . '/js/graphs.js', array('type' => 'file', 'scope' => 'footer'));
  //drupal_add_js($data_portal_base_url . '/js/vendor/resourcebundle.js', array('type' => 'file', 'scope' => 'footer'));
  //drupal_add_js($data_portal_base_url . '/js/app.js', array('type' => 'file', 'scope' => 'footer'));
  //drupal_add_js($data_portal_base_url . '/js/widgets.js', array('type' => 'file', 'scope' => 'footer'));

}

/**
 * Implements template_preprocess_region().
 */
function bvng_preprocess_region(&$variables) {
  switch ($variables['region']) {
    case 'content':
      $req_path = $variables['elements']['requested_path'];
      
      /* Only style outer wells at the region level for taxonomy/term pages and pages
       * with a filter sidebar. For the rest the well will be draw at the node level.
       */
      $well = bvng_get_container_well();
      if (!empty($variables['elements']['system_main'])) {
        $system_main = &$variables['elements']['system_main'];
      }
      else {
        $system_main = NULL;
      }

    	$well_type = bvng_well_type($req_path, $system_main);
    	
    	switch ($well_type) {
        case 'filter':
          $variables['well_top'] = $well['filter']['top'];
          $variables['well_bottom'] = $well['filter']['bottom'];
          break;
        case 'normal':
          $variables['well_top'] = $well['normal']['top'];
          $variables['well_bottom'] = $well['normal']['bottom'];
          break;
        case 'none':
        	break;
      }
      break;

  }
}

function bvng_well_type($req_path, $system_main) {
  // Term pages that has a special layout, hence no filter well.
  $special_layout = array(
    '565',
    '567',
  );
  // Paths that have a filter well.
  $filter_paths = array(
    'allnewsarticles',
    'alldatausearticles',
    'events',
  );
  
  // Determine giving filter sidebar or not.
  if (!empty($system_main['taxonomy_terms']) || !empty($system_main['term_heading']['term'])) {
    // If not a node page then the well is draw in the region level template.
    // Some term pages are special.
    foreach ($special_layout as $special) {
      if (array_key_exists($special, $system_main['taxonomy_terms'])) return 'none';
    }
    return 'filter';
  }
  elseif (!empty($system_main['nodes'])) {
    // If it's a node page then the well is draw in the node level template.
    return 'none';
  }
  elseif ($req_path) {
    // Others are views.
    foreach ($filter_paths as $path) {
      $match = strpos($req_path, $path);
      if ($match !== FALSE) return 'filter';
    }
    return 'normal';
  }
}

/**
 * Implements template_preprocess_block().
 */
function bvng_preprocess_block(&$variables) {
	
	// We only need to work on the system main block.
	if ($variables['block']->module == 'system' && $variables['block']->delta == 'main') {

		// Use our own template for generic taxonomy term page.
		if (strpos($variables['elements']['#block']->requested_path, 'taxonomy/term') !== FALSE) {
    	$relation = gbif_pages_term_view_relation();
    	$tid = arg(2);
    	if (!array_key_exists(arg(2), $relation)) {
    		array_push($variables['theme_hook_suggestions'], 'block__system__main__taxonomy' . '__generic');
    	}
    	// Add RSS feed icon.
    	$alt = bvng_get_title_data($count = NULL);
    	$icon = theme_image(array(
    		'path' => drupal_get_path('theme', 'bvng') . '/images/rss-feed.gif',
    		'width' => 28,
    		'height' => 28,
    		'alt' => (isset($alt['title'])) ? $alt['title'] : '',
    		'title' => t('Subscribe to this list'),
    		'attributes' => array(),
    	));
    	$icon = l($icon, $variables['elements']['#block']->requested_path . '/feed', array('html' => TRUE));
    	$variables['elements']['#block']->icon = $icon;

      // Set title of the main block according to the number of node items.
      if (isset($variables['elements']['nodes'])) {
        $node_count = _bvng_node_count($variables['elements']['nodes']);
      	$block_title = format_plural($node_count,
      	'Displaying 1 item',
      	'Displaying @count items',
      	array());
      	$variables['elements']['#block']->title = $block_title;
      }
    }

    // If it's 404 not found.
    $status = drupal_get_http_header("status");
    if ($status == '404 Not Found') {
  		array_push($variables['theme_hook_suggestions'], 'block__system__main__404');

		  $suggested_path = 'http://www-old.gbif.org/' . $variables['block']->requested_path; 
  		
		  $suggested_text .= '<p>' . t('We are sorry for the inconvenience.') . '</p>';
		  $suggested_text .= '<p>' . t('Did you try searching? Enter a keyword(s) in the search field above.') . '</p>';
		  $suggested_text .= '<p>' . t('You may be following an out-dated link based on GBIF’s previous portal which was active until September 2013 – if so, you may find the content you are looking for !here', array('!here' => l('here', $suggested_path))) . '.</p>';
		  $variables['content'] = $suggested_text;
		  
    }
  }
  
  
}

/**
 * Implements hook_preprocess_node().
 */
function bvng_preprocess_node(&$variables) {
  
  /* Add theme hook suggestion for nodes of taxonomy/term/%
   */
  if (isset($variables['requested_path'])) {
  	if (strpos($variables['requested_path'], 'taxonomy/term') !== FALSE) {
  		array_push($variables['theme_hook_suggestions'], 'node__taxonomy' . '__generic');
  	}
  }
  elseif (isset($variables['current_path'])) {
  }

  /* Prepare the prev/next $node of the same content type.
   */
  if ($variables['node']) {
    switch ($variables['node']->type) {
      default:
        $next_node = node_load(prev_next_nid($variables['node']->nid, 'prev'));
    }
    $next_node = ($next_node->status == 1) ? $next_node : NULL; // Only refer to published node.
    $variables['next_node'] = $next_node;
  }

  /* Prepare $cchunks, $anchors and $elinks for type "generic template"
   */
  // Prepare $cchunks.
  if ($variables['node']->type == 'generictemplate' && !empty($variables['field_cchunk'])) {
  	$fields_collection = field_get_items('node', $variables['node'], 'field_cchunk');
    $cchunks = array();
  	foreach ($fields_collection as $idx => $data) $cchunks[$idx] = field_collection_item_load($fields_collection[$idx]['value']);
  	$variables['cchunks'] = $cchunks;

  	// Prepare $anchors and $elinks.
  	$anchors = array();
  	$elinks = array();
  	foreach ($variables['cchunks'] as $k => $cchunk) {
  	  $anchors[$k] = field_collection_item_load($cchunk->field_anchorlinkslist['und'][0]['value']);
  	  foreach ($cchunk->field_externallinkslist['und'] as $i => $eblock) {
  	    $elinks[$k][$i] = field_collection_item_load($eblock['value']);
  	  }
  	}
  	$variables['anchors'] = $anchors;
  	$variables['elinks'] = $elinks;
  }
  
  /* Get footer fields for data use articles.
   */
  $node_footer = _bvng_get_node_footer_content($variables['node']);
  $variables['node_footer'] = $node_footer;

  /* Get sidebar content
   */
  $sidebar = bvng_get_sidebar_content($variables['nid'], $variables['vid']);
  $variables['sidebar'] = $sidebar;

  /* Process menu_local_tasks()
   */
  global $user;

  // Bring the local tasks tab into node template.
  // @todo To investigate that this doesn't work for data use.
  $variables['tabs'] = menu_local_tabs();

  /* Determine what local task to show according to the role.
   * @todo To implement this using user_permission.
   */
	if (is_array($variables['tabs']['#primary'])) {
		foreach ($variables['tabs']['#primary'] as $key => $item) {
			// We don't need the view tab because we're already viewing it.
		
			switch ($item['#link']['title']) {
				case 'View':
					unset($variables['tabs']['#primary'][$key]);
					break;
				case 'Edit':
					// Alter the 'edit' link to point to the node/%/edit
					$variables['tabs']['#primary'][$key]['#link']['href'] = 'node/' . $variables['node']->nid . '/edit';
					if (!in_array('Editors', $user->roles)) unset($variables['tabs']['#primary'][$key]);
					break;
				case 'Devel':
					// Alter the 'edit' link to point to the node/%/devel
					$variables['tabs']['#primary'][$key]['#link']['href'] = 'node/' . $variables['node']->nid . '/devel';
					if (!in_array('administrator', $user->roles)) unset($variables['tabs']['#primary'][$key]);
					break;
			}
		}		
	}
  
  /* Get also tagged
   */
  $variables['also_tagged'] = _bvng_get_also_tag_links($variables['node']);
}

/**
 * Implements template_preprocess_taxonomy_term().
 */
function bvng_preprocess_taxonomy_term(&$variables) {
}

/**
 * Implements hook_preprocess_views_view().
 */
function bvng_preprocess_views_view(&$variables) {
  drupal_set_title($variables['view']->get_title());
  switch ($variables['view']->name) {
    case 'featurednewsarticles':
      // Contruct the JSON for slideshow.
      /* The old attempt to not use views_slideshow. To be deleted.
      $slides = array();
    	foreach ($variables['view']->result as $result) {
      	$node = node_load($result->nid);
      	$slide = new stdClass();
      	$slide->title = $node->title;
      	$slide->description = $node->body['und'][0]['summary'];
      	$slide->src = file_create_url($node->field_featured['und'][0]['uri']);
      	$slide->url = '/page/' . $node->nid;
      	$slides[] = $slide;
      }
      $slides = json_encode($slides);
      drupal_add_js(array(
        'bvng' => $slides,
      ), 'setting');
      drupal_add_js(drupal_get_path('theme', 'bvng') . '/js/featuredNewsSlideshow.js', array('type' => 'file', 'scope' => 'footer', 'weight' => 50));
      */
      break;
  }
}

function bvng_preprocess_views_view_field(&$variables, $hook) {
  if ($variables['view']->name == 'featurednewsarticles') {
    $new = '';
  }
}

function bvng_preprocess_views_view_list(&$variables) {
  switch ($variables['view']->name) {
    case 'usesofdatafeaturedarticles':
      foreach ($variables['classes'] as $k => $class) {
        $odr = $k + 1;
        if ($odr % 3 === 0) {
          $variables['classes_array'][$k] = $variables['classes_array'][$k] . ' views-row-right';
        }
      }
      break;
  }
}

function bvng_preprocess_search_block_form(&$variables) {
}

/**
 * Helper function for showing the title and subtitle of a site section in the
 * highlighted region.
 *
 * The description is retrieved from the description of the menu item.
 */
function bvng_get_title_data($count) {
  $status = drupal_get_http_header("status");

	// This way disassociates the taxanavigation voc, is more reasonable, but a bit heavy.
	// Only 'GBIF Newsroom' has a shorter name in the nav.
	$active_menu_item = menu_link_get_preferred(current_path(), 'gbif-menu');
	if ($active_menu_item) {
		$parent = menu_link_load($active_menu_item['plid']);
		$title = array(
			 'mild' => $parent['mlid'],
			 'name' => ($parent['link_title'] == 'GBIF News') ? 'GBIF Newsroom' : $parent['link_title'],
			 'description' => $parent['options']['attributes']['title'],
		);
	}
	elseif (strpos(current_path(), 'taxonomy/term') !== FALSE) {
		$term = taxonomy_term_load(arg(2));
		$title = array(
			'name' => format_plural($count,
			  'Item tagged with "@term"',
				'Items tagged with "@term"',
				array('@term' => $term->name)),
		);
	}
	elseif ($status == '404 Not Found') {
	  $title = array(
	   'name' => t("Hmm, the page can't be found"),
	   'description' => t('404 Not Found'),
	  );
	}
	return $title;
}

/**
 * Retrieve sidebar content according to content type
 * @todo To investigate why passing $variables['node'] as $node will produce extra
 *       taxonomy_term object in $field_items, which cause taxonomy_term_load_multiple() to fail.
 *       Therefore here a $node object is loaded by $nid and $vid.
 */
function bvng_get_sidebar_content($nid, $vid) {
  $node = node_load($nid, $vid);
  
  if ($node) {
    switch ($node->type) {
      case 'newsarticle':
      case 'usesofdata':
        $markup = '';
        $fields = _bvng_get_sidebar_fields($node->type);
        foreach ($fields as $idx => $field) {
          $variable_name = str_replace('-', '_', $idx);
          $$variable_name = array(
            'title' => $field['title'],
            'type' => 'ul',
            'items' => array(),
            'attributes' => array(
              'id' => $idx,
              'class' => $node->type . '-sidebar' . ' ' . $idx,
            ),
          );
      		$item_list = &$$variable_name;

          if ($idx <> 'tags') {
            $field_items = field_get_items('node', $node, $field['machine_name']);
            switch ($field['field_type']) {
              case 'node_date':
          		  array_push($item_list['items'], array('data' => format_date($node->$field['machine_name'], 'custom', 'F jS, Y ')));
                break;
              case 'text':
              	foreach ($field_items as $item) {
              		array_push($item_list['items'], array('data' => $item['value']));
              	}
                break;
              case 'link_field':
              	foreach ($field_items as $item) {
              		array_push($item_list['items'], array('data' => l($item['title'], $item['url'])));
              	}
                break;
              case 'taxonomy_term_reference':
                _bvng_get_tag_links($field_items, $item_list);
                break;
            }
          }
          elseif ($idx == 'tags') {
            $terms = array();
            $term_sources = $field['fields'];
            // Get all terms.
            foreach ($term_sources as $term_source) {
              $items = field_get_items('node', $node, $term_source);
              if (is_array($items)) {
                foreach ($items as $item) {
                  $terms[] = $item['tid'];
                }
              }
            }
            _bvng_get_tag_links($terms, $item_list);
          }

          $markup .= theme_item_list($item_list);
        }
        break;
    }
  }

  return $markup;
}

function _bvng_get_node_footer_content($node) {
  $markup = '';
  switch ($node->type) {
    case 'newsarticle':
    case 'usesofdata':
      $fields = array(
        'field_citationinformation',
        'field_relatedgbifresources',
      );
      foreach ($fields as $field) {
        if (!empty($node->$field)) {
        	$item = field_view_field('node', $node, $field);
     			$markup .= render($item);
        }
      }
      break;
  }            
  
  return $markup;
}

/**
 * Defined fields to retrieve content.
 * @param $type Type of the node.
 */
function _bvng_get_sidebar_fields($type) {
  switch ($type) {
    case 'newsarticle':
      $fields = array(
        'publication-date' => array(
          'title' => t('Publication date'),
          'machine_name' => 'created',
          'field_type' => 'node_date',
        ),
        'last-updated' => array(
          'title' => t('Last updated'),
          'machine_name' => 'changed',
          'field_type' => 'node_date',
        ),
        'tags' => array(
          'title' => t('Tags'),
          'machine_name' => 'tags',
          'fields' => _bvng_get_sidebar_tags_definition($type),
        ),
      );
      break;
    case 'usesofdata':
      $fields = array(
        'publication' => array(
          'title' => t('Publication'),
          'machine_name' => 'field_publication',
        ),
        'researchers-location' => array(
          'title' => t('Location of researchers'),
          'machine_name' => 'field_reasearcherslocation',
        ),
        'study-area' => array(
          'title' => t('Study area'),
          'machine_name' => 'field_studyarea',
        ),
        'data-sources' => array(
          'title' => t('Data sources'),
          'machine_name' => 'field_datasources',
        ),
        'links-to-research' => array(
          'title' => t('Links to research'),
          'machine_name' => 'field_linkstoresearch',
        ),
        'data-use-categories' => array(
          'title' => t('Data use categories'),
          'machine_name' => 'field_datausecategories',
        ),
        'tags' => array(
          'title' => t('Tags'),
          'machine_name' => 'tags',
          'fields' => _bvng_get_sidebar_tags_definition($type),
        ),
      );
      break;
  }

  // @see https://api.drupal.org/api/drupal/modules%21field%21field.info.inc/function/field_info_instances/7
  foreach ($fields as $idx => $field) {
    if ($idx <> 'tags') {
    	if (!isset($field['field_type'])) {
    		$info = field_info_field($field['machine_name']);
    		$fields[$idx]['field_type'] = $info['type'];
    	}
    }
  }
  return $fields; 
}

function _bvng_get_tag_links(&$field_items, &$item_list) {
  $terms = taxonomy_term_load_multiple($field_items);
	foreach ($terms as $term) {
		$uri = taxonomy_term_uri($term);
		$tag_link = l($term->name, $uri['path']);
		array_push($item_list['items'], array('data' => $tag_link));
	}
}

function _bvng_get_sidebar_tags_definition($type) {
  switch ($type) {
    case 'newsarticle':
      return array(
        'field_capacity',
        'field_country',
        'field_informatics',
        'field_organizations',
        'field_regions',
      );
    case 'usesofdata':
      return array(
        'field_country',
        'field_regions',
        'field_organizations',
      );
  }  
}

function bvng_get_regional_links() {
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

function bvng_get_subject_links() {
  $subjects = variable_get('gbif_subject_definition');
  $links = '';
  $links = '<ul class="filter-list">';
  foreach ($subjects as $term => $subject) {
    $links .= '<li>';
    $url_base = 'taxonomy/term/';
    $links .= l($subject, $url_base . $term);
    $links .= '</li>';
  }
  $links .= '</ul>';
  return $links;
}

function bvng_get_more_search_options($tid) {
  $data_portal_base_url = variable_get('data_portal_base_url');
  $term = taxonomy_term_load($tid);
  $voc = taxonomy_vocabulary_load($term->vid);
	$links = '<p>' . t('This search result only covers the text content of the news and information pages of the GBIF portal.') . '</p>';
  $links .= '<p>' . t('If you want to search data content, start here:') . '</p>';
  $links .= '<ul class="filter-list">';

  // Publishers and datasets
  $link_text = t('Publishers and datasets');
  $path_dataset = $data_portal_base_url . '/dataset/search?q=' . $term->name;
  $links .= '<li>' . l($link_text, $path_dataset) . '</li>';

  // Countries  
  if ($voc->machine_name == 'countries') {
  	$iso2 = field_get_items('taxonomy_term', $term, 'field_iso2');
  	$path_country = $data_portal_base_url . '/country/' . $iso2[0]['value'];
  	$link_text = t('Country') . '(' . $term->name . ')';
  }
  else {
  	$link_text = t('Countries');
  	$path_country = $data_portal_base_url . '/country';
  }
  $links .= '<li>' . l($link_text, $path_country) . '</li>';

  // Occurrences
  $link_text = t('Occurrences');
  $path_occurrence = $data_portal_base_url . '/occurrence';
  $links .= '<li>' . l($link_text, $path_occurrence) . '</li>';

  // Species
  $link_text = t('Species');
  $path_species = $data_portal_base_url . '/species';
  $links .= '<li>' . l($link_text, $path_species) . '</li>';
  
  $links .= '</ul>';
  return $links;
}

/**
 * Helper function to get "also tagged" tag links.
 */
function _bvng_get_also_tag_links($node) {
  $term_sources = _bvng_get_sidebar_tags_definition($node->type);

  // Get all the terms.
  foreach ($term_sources as $term_source) {
    $items = field_get_items('node', $node, $term_source);
    if (is_array($items)) {
    	foreach ($items as $item) {
    		$terms[] = $item['tid'];
    	}
    }
  }
  
  //$tag_links = bvng_get_tag_links($node);
	$item_list = array(
	 'items' => array(),
	);
	_bvng_get_tag_links($terms, $item_list);
		
	$term_links = '';

	if (!empty($item_list['items'])) {
		$term_links = t('Also tagged') . ':' . '<ul class="also-tagged">';
		foreach ($item_list['items'] as $tag_link) {
			$term_links .= '<li>' . $tag_link['data'] . '</li>';
		}
		$term_links .= '</ul>';
	}

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

/**
 * Helper function for counting node number in a taxonomy term view.
 * @todo If taxonomy/term/% is implemented using views, then this function 
 *       may not be necessary.
 * @param  The node array in page element array.
 * @return (int) $count.
 */
function _bvng_node_count($nodes) {
	// Chuck off non-node children.
  if (is_array($nodes)) {
  	foreach ($nodes as $idx => $node) {
  		if (!is_int($idx)) unset($nodes[$idx]);
  	}
  }
	$count = count($nodes);
	return $count;
  
}