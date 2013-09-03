<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * A QUICK OVERVIEW OF DRUPAL THEMING
 *
 *   The default HTML for all of Drupal's markup is specified by its modules.
 *   For example, the comment.module provides the default HTML markup and CSS
 *   styling that is wrapped around each comment. Fortunately, each piece of
 *   markup can optionally be overridden by the theme.
 *
 *   Drupal deals with each chunk of content using a "theme hook". The raw
 *   content is placed in PHP variables and passed through the theme hook, which
 *   can either be a template file (which you should already be familiary with)
 *   or a theme function. For example, the "comment" theme hook is implemented
 *   with a comment.tpl.php template file, but the "breadcrumb" theme hooks is
 *   implemented with a theme_breadcrumb() theme function. Regardless if the
 *   theme hook uses a template file or theme function, the template or function
 *   does the same kind of work; it takes the PHP variables passed to it and
 *   wraps the raw content with the desired HTML markup.
 *
 *   Most theme hooks are implemented with template files. Theme hooks that use
 *   theme functions do so for performance reasons - theme_field() is faster
 *   than a field.tpl.php - or for legacy reasons - theme_breadcrumb() has "been
 *   that way forever."
 *
 *   The variables used by theme functions or template files come from a handful
 *   of sources:
 *   - the contents of other theme hooks that have already been rendered into
 *     HTML. For example, the HTML from theme_breadcrumb() is put into the
 *     $breadcrumb variable of the page.tpl.php template file.
 *   - raw data provided directly by a module (often pulled from a database)
 *   - a "render element" provided directly by a module. A render element is a
 *     nested PHP array which contains both content and meta data with hints on
 *     how the content should be rendered. If a variable in a template file is a
 *     render element, it needs to be rendered with the render() function and
 *     then printed using:
 *       <?php print render($variable); ?>
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. With this file you can do three things:
 *   - Modify any theme hooks variables or add your own variables, using
 *     preprocess or process functions.
 *   - Override any theme function. That is, replace a module's default theme
 *     function with one you write.
 *   - Call hook_*_alter() functions which allow you to alter various parts of
 *     Drupal's internals, including the render elements in forms. The most
 *     useful of which include hook_form_alter(), hook_form_FORM_ID_alter(),
 *     and hook_page_alter(). See api.drupal.org for more information about
 *     _alter functions.
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   If a theme hook uses a theme function, Drupal will use the default theme
 *   function unless your theme overrides it. To override a theme function, you
 *   have to first find the theme function that generates the output. (The
 *   api.drupal.org website is a good place to find which file contains which
 *   function.) Then you can copy the original function in its entirety and
 *   paste it in this template.php file, changing the prefix from theme_ to
 *   STARTERKIT_. For example:
 *
 *     original, found in modules/field/field.module: theme_field()
 *     theme override, found in template.php: STARTERKIT_field()
 *
 *   where STARTERKIT is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_field() function.
 *
 *   Note that base themes can also override theme functions. And those
 *   overrides will be used by sub-themes unless the sub-theme chooses to
 *   override again.
 *
 *   Zen core only overrides one theme function. If you wish to override it, you
 *   should first look at how Zen core implements this function:
 *     theme_breadcrumbs()      in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called theme hook suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node--forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and theme hook suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440 and http://drupal.org/node/1089656
 */

 
/**
 *Add our own preprocessing functions for login and registration
 
 */
 
function vizz2_theme($existing, $type, $theme, $path){
	$hooks['user_register_form'] = array(
		'render element'=>'form',
		'template' =>'templates/user-register',
	);
  
	$hooks['user_profile_form'] = array(
		'render element' => 'form',
		'template' => 'templates/user-profile-edit',
    );

    $hooks['user_login'] = array(
		'render element' => 'form',
		'template' => 'templates/user-login',
    );
    
    $hooks['user_pass'] = array(
	'render element' => 'form',
	'template' => 'templates/user-password',
    );
        
return $hooks;
}

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */

function vizz2_preprocess_html(&$vars, $hook) {
// var_dump ($vars) ;
	$status = drupal_get_http_header("status");  
	if($status == "404 Not Found") {      
		$vars['theme_hook_suggestions'][] = 'html__404';
	}

}
 
  
function vizz2_preprocess_page( &$vars, $hook ) {

	if (!empty($vars['node'])) {
		$vars['theme_hook_suggestions'][] = 'page__node__' . $vars['node']->type;
//		$vars['theme_hook_suggestions'][] = 'taxonomy_term__' . $term->vocabulary_machine_name;
//		$vars['theme_hook_suggestions'][] = 'taxonomy_term__' . $term->tid;


	}

	if(isset($vars['page']['content']['system_main']['no_content'])) {
		unset($vars['page']['content']['system_main']['no_content']);
	}

	$status = drupal_get_http_header("status");  
	if($status == "404 Not Found") {      
		$vars['theme_hook_suggestions'][] = 'page__404';
	}

// 	echo '<pre>'; var_dump($vars['theme_hook_suggestions']); echo '</pre>';
}




function get_title_data() {
	$navigation_vocab = 'taxanavigation' ;
	$trail = menu_get_active_trail() ;
	$taxon = taxonomy_get_term_by_name($trail[2]['title'], $navigation_vocab ) ;
//	var_dump($taxon);
	reset ( $taxon ) ;

	return current( $taxon ) ;
}

function vizz2_menu_tree($variables){
  return '<ul>' . $variables['tree'] . '</ul>';
}

/**
 * Override menu_link to do fine alterations to theme according to vizz.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 *
 */


function vizz2_menu_link(array $variables) {

/* Clear the "theme" attributes as they're not needed
 * Change the class from "active" to "selected" but only for level
 * 2 (and active) menu entries; for the rest clear the class
 */


	$element = $variables['element'] ;
	
	$element['#localized_options']['html'] = TRUE ;

	if ( $element['#bid']['module'] === 'menu_block' ) {
		$element['#theme'] = array('') ;

		if( $element['#bid']['delta'] === '1' ) {

			$element['#title'] = '<span>'.$element['#title'].'</span>' ;

			if (	in_array( 'active', $element['#attributes']['class'] )
				OR	in_array( 'active-trail', $element['#attributes']['class'] ) ) {
				$element['#attributes']['class'] = array('selected') ;
			} else {
				$element['#attributes']['class'] = array('') ;
			}
		}

	}

	$variables['element'] = $element ;

	return theme_menu_link($variables);

}

/*
 * Fill in the missing values for the "Contact" form.
 *
 */

function vizz2_form_alter( &$form, &$form_state, $form_id ) {

// Alter the conctact us form so that it looks closer to what we need 
	if($form_id == 'contact_site_form') {
		$form['name']['#value'] = 'A guest' ;
		$form['subject']['#value'] = '*Newsletter subscription from web*' ;
		$form['cid']['#value'] = '2' ;
		$form['message']['#value'] = $form['mail']['#value'].'would like to subscribe' ;
		$form['submit']['#value'] = 'Send message';
	}

/* The search form WILL be included in all results pages. 
 * there doesn't seem to be a template/hook to prevent that so
 * brute force the form out completely when it's for search
 * 
 * ... unless you bypass $page['content'] in your tpl and go directly for
 *  $page['content']['system_main']['search_results']
 */

 /*	if ( $form['#action'] == '/search/node' ) {
		$form = array();
    } */

}


/* function vizz2_menu_link(array $variables) {

/* Clear the "theme" attributes as they're not needed
 * Change the class from "active" to "selected" but only for level
 * 2 (and active) menu entries; for the rest clear the class
 */
/*
	$element = $variables['element'] ;

	if ( $element['#bid']['module'] === 'menu_block' ) {
		$element['#theme'] = array('') ;

		if( $element['#bid']['delta'] === '2' ) {

			$element['#title'] = '<span>'.$element['#title'].'</span>' ;

			if ( in_array( 'active', $element['#attributes']['class'] ) ) {
				$element['#attributes']['class'] = array('selected') ;
			} else {
				$element['#attributes']['class'] = array('') ;
			}
		} elseif ( $element['#bid']['delta'] === '1' ) {
			$element['#attributes']['class'] = array() ;
		}
	}

	if ($element['#below']) {
		$sub_menu = drupal_render($element['#below']);
	}

	$element['#localized_options']['html'] = TRUE ;

	$output = l($element['#title'], $element['#href'], $element['#localized_options']) ;


	//  ???   $variables['element'] = $element ;

	// dpm($element);

	// return theme_menu_link($variables);
	
	return '<li' . drupal_attributes($element['#attributes']) .'>' . $output . "</li>\n";

}

*/
/*

		
		if( $element['#bid']['delta'] === '1' ) {
		}
		echo $element['#localized_options']['attributes']['title'].'<br>';

*/

/**
 * Implements hook_preprocess_search_results().
 * 
 * Brute force the problem of displaying the number of search 
 * results when using the Drupal default search engine
 * As seen here:
 * http://www.lullabot.com/blog/article/display-count-search-results-drupal-7
 *
 */
function vizz2_preprocess_search_results(&$vars) {

	// search.module shows 10 items per page (this isn't customizable)
	$itemsPerPage = 10;
	// Determine which page is being viewed
	// If $_REQUEST['page'] is not set, we are on page 1
	$currentPage = (isset($_REQUEST['page']) ? $_REQUEST['page'] : 0) + 1;

	// Get the total number of results from the global pager
	$total = $GLOBALS['pager_total_items'][0];

	// Determine which results are being shown ("Showing results x through y")
	$start = (10 * $currentPage) - 9;
	// If on the last page, only go up to $total, not the total that COULD be
	// shown on the page. This prevents things like "Displaying 11-20 of 17".
	$end = (($itemsPerPage * $currentPage) >= $total) ? $total : ($itemsPerPage * $currentPage);

	// If there is more than one page of results:
	if ($total > $itemsPerPage) {
		$vars['search_totals'] = t('Displaying !start - !end of !total results', array(
		  '!start' => $start,
		  '!end' => $end,
		  '!total' => $total,
		));
	}
	else {
		// Only one page of results, so make it simpler
		$vars['search_totals'] = t('Displaying !total !results_label', array(
		  '!total' => $total,
		  // Be smart about labels: show "result" for one, "results" for multiple
		  '!results_label' => format_plural($total, 'result', 'results'),
		));
	}
}

/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  STARTERKIT_preprocess_html($variables, $hook);
  STARTERKIT_preprocess_page($variables, $hook);
}
// */


/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_page(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // STARTERKIT_preprocess_node_page() or STARTERKIT_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  //if ($variables['block_html_id'] == 'block-system-main') {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
  //}
}
// */


/**
 *
 * This function is needed so that we can use the Prev/Next module functionality
 *
 *
 *
 */

function pn_node($node, $mode = 'n') {
	if (!function_exists('prev_next_nid')) {
		return NULL;
	}

	switch($mode) {
		case 'p':
			$n_nid = prev_next_nid($node->nid, 'prev');
			break;

		case 'n':
			$n_nid = prev_next_nid($node->nid, 'next');
			break;

		default:
			return NULL;
	}

	if ($n_nid) {
		$n_node = node_load($n_nid);

		$options = array(
			'attributes' => array('class' => 'thumbnail'),
			'html'	=> TRUE,
		);
		switch($n_node->type) {
			// For image nodes only
			case 'image':
				// This is an image node, get the thumbnail
				$html = l(image_display($n_node, 'thumbnail'), "node/$n_nid", $options);
				$html .= l($link_text, "node/$n_nid", array('html' => TRUE));
				return $html;

			// For video nodes only
			case 'video':
				foreach ($n_node->files as $fid => $file) {
					$html	= '<img src="' . base_path() . $file->filepath;
					$html .= '" alt="' . $n_node->title;
					$html .= '" title="' . $n_node->title;
					$html .= '" class="image image-thumbnail" />';
					$img_html = l($html, "node/$n_nid", $options);
					$text_html = l($link_text, "node/$n_nid", array('html' => TRUE));
					return $img_html . $text_html;
				}
			default:
				// ... theme? What theme?! :-)
				$link_text = '<h1>'.$n_node->title.'</h1>' ;
				$html = l($link_text, "page/$n_nid", array('html' => TRUE));
				return $html;
		}
	}
}

/**
 * Trim text accounting for HTML boundaries; from CakePHP project
 * http://cakephp.org/
 *
 * @param string $text String to truncate.
 * @param integer $length Length of returned string, including ellipsis.
 * @param string $ending Ending to be appended to the trimmed string.
 * @param boolean $exact If false, $text will not be cut mid-word
 * @param boolean $considerHtml If true, HTML tags would be handled correctly
 * @return string Trimmed string.
*/
function smart_trim( $text, $length = 100, $ending = '...', $exact = false, $considerHtml = true) {
	if ($considerHtml) {
		// if the plain text is shorter than the maximum length, return the whole text
		if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
			return $text;
		}
		// splits all html-tags to scanable lines
		preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
		$total_length = strlen($ending);
		$open_tags = array();
		$truncate = '';
		foreach ($lines as $line_matchings) {
			// if there is any html-tag in this line, handle it and add it (uncounted) to the output
			if (!empty($line_matchings[1])) {
				// if it's an "empty element" with or without xhtml-conform closing slash
				if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
					// do nothing
				// if tag is a closing tag
				} else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
					// delete tag from $open_tags list
					$pos = array_search($tag_matchings[1], $open_tags);
					if ($pos !== false) {
					unset($open_tags[$pos]);
					}
				// if tag is an opening tag
				} else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
					// add tag to the beginning of $open_tags list
					array_unshift($open_tags, strtolower($tag_matchings[1]));
				}
				// add html-tag to $truncate'd text
				$truncate .= $line_matchings[1];
			}
			// calculate the length of the plain text part of the line; handle entities as one character
			$content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
			if ($total_length+$content_length> $length) {
				// the number of characters which are left
				$left = $length - $total_length;
				$entities_length = 0;
				// search for html entities
				if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
					// calculate the real length of all entities in the legal range
					foreach ($entities[0] as $entity) {
						if ($entity[1]+1-$entities_length <= $left) {
							$left--;
							$entities_length += strlen($entity[0]);
						} else {
							// no more characters left
							break;
						}
					}
				}
				$truncate .= substr($line_matchings[2], 0, $left+$entities_length);
				// maximum lenght is reached, so get off the loop
				break;
			} else {
				$truncate .= $line_matchings[2];
				$total_length += $content_length;
			}
			// if the maximum length is reached, get off the loop
			if($total_length>= $length) {
				break;
			}
		}
	} else {
		if (strlen($text) <= $length) {
			return $text;
		} else {
			$truncate = substr($text, 0, $length - strlen($ending));
		}
	}
	// if the words shouldn't be cut in the middle...
	if (!$exact) {
		// ...search the last occurance of a space...
		$spacepos = strrpos($truncate, ' ');
		if (isset($spacepos)) {
			// ...and cut the text in this position
			$truncate = substr($truncate, 0, $spacepos);
		}
	}
	// add the defined ending to the text
	$truncate .= $ending;
	if($considerHtml) {
		// close all unclosed html-tags
		foreach ($open_tags as $tag) {
			$truncate .= '</' . $tag . '>';
		}
	}
	return $truncate;
}

/**
 *
 * Attempt to override the default views pager.
 *
 * "Because theming is *SO* easy when you deviate from Zen"(TM)
 *
 *
 * If you're reading this because the pager's not working you're
 * probably in the right place; Only way so far to customize the
 * pager is to override the code from includes/pager.inc
 * So what happens if that code changes significantly? Well... >:->
 *
 *
 */

 
function vizz2_pager($variables) {

	$tags = $variables['tags'];
	$element = $variables['element'];
	$parameters = $variables['parameters'];
	$quantity = $variables['quantity'];
	global $pager_page_array, $pager_total;

	// Calculate various markers within this pager piece:
	// Middle is used to "center" pages around the current page.
	$pager_middle = ceil($quantity / 2);
	// current is the page we are currently paged to
	$pager_current = $pager_page_array[$element] + 1;
	// first is the first page listed by this pager piece (re quantity)
	$pager_first = $pager_current - $pager_middle + 1;
	// last is the last page listed by this pager piece (re quantity)
	$pager_last = $pager_current + $quantity - $pager_middle;
	// max is the maximum page number
	$pager_max = $pager_total[$element];
	// End of marker calculations.

	// Prepare for generation loop.
	$i = $pager_first;
	if ($pager_last > $pager_max) {
		// Adjust "center" if at end of query.
		$i = $i + ($pager_max - $pager_last);
		$pager_last = $pager_max;
	}
	if ($i <= 0) {
		// Adjust "center" if at start of query.
		$pager_last = $pager_last + (1 - $i);
		$i = 1;
	}
	// End of generation loop preparation.

	$li_first = theme('pager_first', array('text' => (isset($tags[0]) ? $tags[0] : t('First')), 'element' => $element, 'parameters' => $parameters));
	$li_previous = theme('pager_previous', array('text' => (isset($tags[1]) ? $tags[1] : t('previous')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
	$li_next = theme('pager_next', array('text' => (isset($tags[3]) ? $tags[3] : t('next')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
	$li_last = theme('pager_last', array('text' => (isset($tags[4]) ? $tags[4] : t('Last')), 'element' => $element, 'parameters' => $parameters));

	if ($pager_total[$element] > 1) {
		if ($li_first) {
			$items[] = array(
				'class' => array(''),
				'data' => $li_first,
			);
		} else {
			// Drupal's paging is slightly different; e.g. theming engine will not return by default a "First"
			// for a pager if you are already on the first page. Rather than override yet another function just
			// brute force a dummy "First" for the moment. Of course we need to redo the calculation later because
			// dataportal counts pages differently.
			$items[] = array(
				'class' => array(''),
				'data' => '<a href="#">First</a>',
			);
		}
/*		if ($li_previous) {
			$items[] = array(
				'class' => array(''),
				'data' => $li_previous,
			);
		}
*/
	// When there is more than one page, create the pager list.
		if ($i != $pager_max) {
			if ($i > 1) {
				$items[] = array(
					'class' => array('pager-ellipsis'),
					'data' => '...',
				);
			}
			// Now generate the actual pager piece.
			for (; $i <= $pager_last && $i <= $pager_max; $i++) {
				if ($i < $pager_current) {
					$items[] = array(
						'class' => array(''),
						'data' => theme('pager_previous', array('text' => $i, 'element' => $element, 'interval' => ($pager_current - $i), 'parameters' => $parameters)),
					);
				}
				if ($i == $pager_current) { // everybody in this univers (UFO pilots included) will class the <li> as "current". Not the vizz chaps, nope! They will style the <a>... Why? Because they can!
					$items[] = array(
						'class' => array('current'),
						'data' => '<a href="#" class="current">'.$i.'</a>',
					);
				}
				if ($i > $pager_current) {
					$items[] = array(
						'class' => array(''),
						'data' => theme('pager_next', array('text' => $i, 'element' => $element, 'interval' => ($i - $pager_current), 'parameters' => $parameters)),
					);
				}
			}
			if ($i < $pager_max) {
				$items[] = array(
					'class' => array(''),
					'data' => '...',
				);
			}
		}
		// End generation.
/*		if ($li_next) {
			$items[] = array(
				'class' => array(''),
				'data' => $li_next,
			);
		}
*/
		if ($li_last) {
			$items[] = array(
				'class' => array(''),
				'data' => $li_last,
			);
		}
		return theme('item_list', array(
			'items' => $items,
			'attributes' => array('class' => array('numbered-pagination')),
		));
	}
}


/**
 *
 * As usual, Drupal is way too verbose for this theme;
 * This time we need to remove the extra <div> which is added
 * around lists...
 *
 * This is the code from /includes/theme.inc/
 *
 *
 * "Because theming is *SO* easy when you deviate from Zen"(TM)
 *
 *
 */

function vizz2_item_list($variables) {
	$items = $variables['items'];
	$title = $variables['title'];
	$type = $variables['type'];
	$attributes = $variables['attributes'];

	// Only output the list container and title, if there are any list items.
	// Check to see whether the block title exists before adding a header.
	// Empty headers are not semantic and present accessibility challenges.

	
//	$output = '<div class="item-list">'; <-- give me a f. option
//	to turn this off! How about a "silent" option??! :-@
	$output = '' ;

	if (isset($title) && $title !== '') {
		$output .= '<h3>' . $title . '</h3>';
	}

	if (!empty($items)) {
		$output .= "<$type" . drupal_attributes($attributes) . '>';
		$num_items = count($items);
		$i = 0;
		foreach ($items as $item) {
			$attributes = array();
			$children = array();
			$data = '';
			$i++;
			if (is_array($item)) {
				foreach ($item as $key => $value) {
					if ($key == 'data') {
						$data = $value;
					}
					elseif ($key == 'children') {
						$children = $value;
					}
					else {
						$attributes[$key] = $value;
					}
				}
			}
			else {
				$data = $item;
			}
			if (count($children) > 0) {
				// Render nested list.
				$data .= theme_item_list(array('items' => $children, 'title' => NULL, 'type' => $type, 'attributes' => $attributes));
			}
			if ($i == 1) {
				$attributes['class'][] = 'first';
			}
			if ($i == $num_items) {
				$attributes['class'][] = 'last';
			}
			$output .= '<li' . drupal_attributes($attributes) . '>' . $data . "</li>\n";
		}
		$output .= "</$type>";
	}
	// $output .= '</div>'; ... like I said.
	return $output;
}

/**
 *
 * Quick and dirty way to draw the menu. DEFINITELY has to be redone
 *
 *
 *
 */


function get_nav ($base_url, $w_search=TRUE) {
$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
$search_form = drupal_get_form('search_form') ; 

echo '
      <nav>
      <ul>
        <li>
        <a href="#" title="Data">Data</a>

        <div class="data">
          <a href="#"></a>
          <ul> ' ;
echo "            <li><a href='$dataportal_base_url/occurrence'>Explore occurrences</a></li> " ;
echo "            <li><a href='$dataportal_base_url/dataset'>Explore datasets</a></li> " ;
echo "            <li><a href='$dataportal_base_url/species'>Explore species</a></li> " ;
echo "            <li><a href='$dataportal_base_url/country'>Explore by country</a></li> " ;
echo "            <li class='divider'></li>" ;
echo "            <li><a href='$base_url/publishingdata/summary'>Publishing data</a></li> " ;
echo "            <li><a href='$base_url/usingdata/summary'>Using Data</a></li> " ;
echo "            <li><a href='$base_url/infrastructure/summary'>Infrastructure</a></li> " ;
echo '          </ul>
        </div>

        </li>

        <li>' ;
echo "        <a class='' href='#' title='About GBIF'>About GBIF</a> " ;

echo '        <div class="about">
          <a href="#"></a>
          <ul> ' ;
echo "            <li><a href='$base_url/whatisgbif'>What is GBIF?</a></li> " ;
echo "            <li><a href='$base_url/resources/keyinformation'>Key information</a></li> " ;
echo "            <li><a href='$base_url/governance/summary'>Governance</a></li> " ;
echo "            <li><a href='$base_url/whoweworkwith'>Who we work with</a></li> " ;
echo "            <li><a href='$base_url/contact/contactus'>Contact</a></li> " ;
echo "          </ul>
        </div>

        </li>
        
        <li> " ;
echo "        <a href='#' title='Community'>Community</a> " ;

echo '        <div class="community"> 
          <a href="#"></a>
          <ul> ' ;
echo "            <li><a href='$base_url/participation/summary'>Participation</a></li> " ;
echo "            <li><a href='$base_url/capacityenhancement/summary'>Capacity enhancement</a></li> " ;
echo "            <li><a href='$base_url/networking/nlink1'>Networking</a></li> " ;
echo "            <li><a href='$base_url/resources/summary'>Resources</a></li> " ;
echo '          </ul>
        </div>

        </li>


        <li>
        <a href="#" title="Newsroom">Newsroom</a>

        <div class="news">
          <a href="#"></a>
          <ul> ' ;
echo "            <li><a href='$base_url/newsroom/summary'>GBIF news</a></li> " ;
echo "            <li><a href='$base_url/newsroom/uses'>Featured data use</a></li> " ;
echo "            <li><a href='$base_url/newsroom/opportunities'>Opportunities</a></li> " ;
echo "            <li><a href='$base_url/newsroom/events'>Events</a></li> " ;
echo '          </ul>
        </div>

        </li>';

echo'	<li class="search">';

if ( $w_search ) {

	echo '     <form action="/search/node" method="post" id="search-form">' ;
	print "<span class='input_text'><input id='edit-keys'  type='text' name='keys' value='{$search_form['basic']['keys']['#default_value']}' autocomplete='off' placeholder='Search GBIF news and articles...'/></span>" ;
	print "<input type='hidden' name='form_build_id' value='{$search_form['#build_id']}' ";
	print "<input type='hidden' name='form_token' value='{$search_form['form_token']['#default_value']}'" ;
	echo '<input type="hidden" name="form_id" value="search_form" />' ;
	echo '<input type="hidden" id="edit-submit" name="op" value="Search" class="form-submit" />' ;
	echo '	</form> ';
} else {
	echo'     <span id="search_placeholder"></span>' ;
}        
echo '        </li>' ;

echo'      </ul>
      </nav>
' ;

}

/**
 *
 * Quick and dirty way to draw the footer. DEFINITELY to be redone
 *
 *
 *
 */


function get_footer( $base_url ) {

$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
echo "<footer>
	<div class='footer'>
		<ul>" ;
echo "		<li><h3>JOIN THE COMMUNITY</h3></li> " ;
echo "		<li><a class='placeholder_temp' href='#'>Join GBIF Community Site</a></li> " ; 
echo "		<li><a class='placeholder_temp' href='#'>Sign up to GBits newsletter</a></li> " ; 
echo "		<li><a class='placeholder_temp' href='#'>GBIF Online Resource Centre</a></li> " ; 
echo "	</ul> " ;

echo "	<ul> " ;
echo "		<li><h3>WHO’S PARTICIPATING</h3></li> " ; 
echo "		<li><a class='placeholder_temp' href='#'>Countries</a></li> " ; 
echo "		<li><a class='placeholder_temp' href='#'>Organizations</a></li> " ; 
echo "		<li><a class='placeholder_temp' href='#'>Data publishers</a></li> " ; 
echo "	</ul> " ;

echo "	<ul> " ;
echo "		<li><h3>KEY DOCUMENTS</h3></li> " ; 
echo "		<li><a class='placeholder_temp' href='#'>Data use agreement</a></li> " ; 
echo "		<li><a class='placeholder_temp' href='#'>Data sharing agreement</a></li> " ; 
echo "		<li><a class='placeholder_temp' href='#'>Memorandum of Understanding</a></li> " ; 
echo "		<li><a class='placeholder_temp' href='#'>Annual Report</a></li> " ; 
echo "		<li><a class='placeholder_temp' href='#'>GBIF Strategic Plan</a></li> " ; 
echo "		<li><a class='placeholder_temp' href='#'>GBIF Work Programme</a></li> " ; 
echo "	</ul> " ;

echo "	<ul class='last'> " ;
echo "		<li><h3>FOR DEVELOPERS</h3></li> " ; 
echo "		<li><a href='/portal/developer'>Portal API</a></li> " ; 
echo "		<li><a href='http://gbif.blogspot.com'>Developer blog</a></li> " ; 
echo "		<li><a href='http://tools.gbif.org'>Tools</a></li> " ; 
echo "		<li><a class='placeholder_temp' href='#'>Standards</a></li> " ; 
echo "	</ul> " ;

echo "  </div> " ;
echo "  </footer> " ;

echo "  <div id='contact_footer'> " ;
echo "	<div class='footer'> " ;
echo "  <ul> " ;
echo "	  <li><h3>2013 &copy; GBIF</h3></li> " ; 
echo "	  <li><div class='logo'></div></li> " ; 
echo "  </ul> " ;

echo "  <ul> " ;
echo "	  <li><h3>GBIF Secretariat</h3></li> " ; 
echo "	  <li>Universitetsparken 15</li> " ; 
echo "	  <li>DK-2100 Copenhagen Ø</li> " ; 
echo "	  <li>DENMARK</li> " ; 
echo "  </ul> " ;

echo "  <ul> " ;
echo "	<li><h3>Contact</h3></li> " ; 
echo "	<li><strong>Email</strong> info@gbif.org</li> " ; 
echo "	<li><strong>Tel</strong> +45 35 32 14 70</li> " ; 
echo "	<li><strong>Fax</strong> +45 35 32 14 80</li> " ; 
echo "	<li>You can also check the <a class='placeholder_temp' href='#'>GBIF Directory</a></li> " ; 
echo "  </ul> " ;

echo "  <ul class='last'> " ;
echo "	  <li><h3>SOCIAL MEDIA</h3></li> " ; 
echo "	  <li class='twitter'><a href='https://twitter.com/GBIF'>Follow GBIF on Twitter</a></li> " ; 
echo "	  <li class='facebook'><a href='https://www.facebook.com/gbifnews'>Like GBIF on Facebook</a></li> " ; 
echo "	  <li class='linkedin'><a href='http://www.linkedin.com/groups/GBIF-55171'>Join GBIF on Linkedin</a></li> " ; 
echo "	  <li class='vimeo'><a href='http://vimeo.com/gbif'>View GBIF on Vimeo</a></li> " ; 
echo "  </ul> " ;

echo "	</div> " ;
echo "	</div> " ;


}

function get_bottom_js ($base_url) {

	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;

	echo '  <!-- JavaScript at the bottom for fast page loading --> ' ;
	echo "<script type='text/javascript' src='$dataportal_base_url/js/vendor/jquery-ui-1.8.17.min.js'></script> " ;
	echo "<script type='text/javascript' src='$dataportal_base_url/js/vendor/jquery.dropkick-1.0.0.js'></script> " ;
	echo "<script type='text/javascript' src='$dataportal_base_url/js/vendor/jquery.uniform.min.js'></script> " ;
	echo "<script type='text/javascript' src='$dataportal_base_url/js/vendor/jquery.cookie.js'/>'></script> ";
	echo "<script type='text/javascript' src='$dataportal_base_url/js/vendor/mousewheel.js'></script> " ;
	echo "<script type='text/javascript' src='$dataportal_base_url/js/vendor/jscrollpane.min.js'></script> " ;
	echo "<script type='text/javascript' src='$dataportal_base_url/js/vendor/jquery-scrollTo-1.4.2-min.js'></script> " ;
	echo "<script type='text/javascript' src='$dataportal_base_url/js/vendor/bootstrap.min.js'></script> " ;
	echo "<script type='text/javascript' src='$dataportal_base_url/js/vendor/underscore-min.js'></script> " ;
	echo "<script type='text/javascript' src='$dataportal_base_url/js/helpers.js'></script> " ;
	echo "<script type='text/javascript' src='$dataportal_base_url/js/widgets.js'></script> " ;
	echo "<script type='text/javascript' src='$dataportal_base_url/js/graphs.js'></script> " ;
	echo "<script type='text/javascript' src='$dataportal_base_url/js/app.js'></script> " ;
	echo "<script type='text/javascript' src='$dataportal_base_url/js/vendor/raphael-min.js'></script> " ;
	echo "<script type='text/javascript' src='$dataportal_base_url/js/vendor/resourcebundle.js'></script>  " ;
	echo '<!-- JIRA feedback buttons -->' ;
	echo '<script type="text/javascript" src="http://dev.gbif.org/issues/s/en_UK-h3luf8-418945332/812/5/1.2.7/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?collectorId=d0843c23"></script>' ;
	echo '<script type="text/javascript" src="http://dev.gbif.org/issues/s/en_UK-h3luf8-418945332/812/5/1.2.7/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?collectorId=a2e9eca4"></script>' ;
	echo '<!-- end JIRA feedback buttons -->' ;
	echo '<!-- Google analytics. Use UA-42057855-1 for UAT instead of UA-myAnalyticsKey below -->';
	echo '<script>';
	echo "(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');";
	echo "ga('create', 'UA-myAnalyticsKey', 'gbif.org');";
	echo "ga('send', 'pageview');";
	echo '</script>';
	echo '  <!-- end scripts-->

  <!--[if lt IE 7 ]>
  <script src="/portal-web-dynamic/js/libs/dd_belatedpng.js"></script>
  <script>DD_belatedPNG
    .fix("img, .png_bg"); // Fix any <img> or .png_bg bg-images. Also, please read goo.gl/mZiyb </script>
  <![endif]-->
	';

}


function vizz2_preprocess_user_register(&$vars) {
	$vars['form'] = drupal_build_form('user_register_form', user_register_form(array()));

}


function vizz2_user_pass ( &$vars ) {


}
