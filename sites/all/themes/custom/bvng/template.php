<?php

/**
 * @file
 * template.php
 */

/**
 * Use bootstrap nav-tabs class to style menu tabs.
 */
function bvng_menu_tree__menu_block(&$variables) {
  return '<ul class="menu nav nav-tabs">' . $variables['tree'] . '</ul>';
}

function bvng_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<div class="navbar-rel"><ul class="tabs--primary nav navbar-default contextual">';
    $variables['primary']['#suffix'] = '</ul></div>';
    $output .= drupal_render($variables['primary']);
  }

  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="tabs--secondary pagination pagination-sm">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }

  return $output;
}

function get_title_data() {
	$trail = menu_get_active_trail() ;
	$taxon = taxonomy_get_term_by_name($trail[2]['title'], 'taxanavigation');
	reset($taxon);
	return current($taxon);
}

function get_nav($base_url) {
  $dataportal_base_url = 'http://www.gbif-dev.org';

  echo '<ul class="nav nav-pills">
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Data">
            Data <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">';
  echo "      <li><a href='$dataportal_base_url/occurrence'>Explore occurrences</a></li>";
  echo "      <li><a href='$dataportal_base_url/dataset'>Explore datasets</a></li>";
  echo "      <li><a href='$dataportal_base_url/species'>Explore species</a></li>";
  echo "      <li><a href='$dataportal_base_url/country'>Explore by country</a></li>";
  echo "      <li class='divider'></li>";
  echo "      <li><a href='publishingdata/summary'>Publishing data</a></li>";
  echo "      <li><a href='usingdata/summary'>Using data</a></li>";
  echo "      <li><a href='$dataportal_base_url/infrastructure/summary'>Infrastructure</a></li>";
  echo '    </ul>
          </li>';
  echo '  <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="newsroom/summary" title="News">
            News  <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">';
  echo "      <li><a href='newsroom/summary'>GBIF news</a></li>";
  echo "      <li><a href='newsroom/uses'>Featured data use</a></li>";
  echo "      <li><a href='newsroom/opportunities'>Opportunities</a></li>";
  echo "      <li><a href='newsroom/events'>Events</a></li>";
  echo "      <li><a href='newsroom/newsletter'>Newsletter</a></li>";
  echo '    </ul>
          </li>';        
  echo '  <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="participation/summary" title="Community"">
            Community <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">';
  echo "      <li><a href='participation/summary'>Participation</a></li>";
  echo "      <li><a href='capacityenhancement/summary'>Capacity enhancement</a></li>";
  echo "      <li><a href='resources/summary'>Resources</a></li>";
  echo '    </ul>
          </li>';
  echo '  <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="About GBIF">
            About <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">';
  echo "      <li><a href='whatisgbif'>What is GBIF?</a></li>";
  echo "      <li><a href='resources/keyinformation'>Key information</a></li>";
  echo "      <li><a href='governance/governingboard'>Governance</a></li>";
  echo "      <li><a href='whoweworkwith'>Who we work with</a></li>";
  echo "      <li><a href='contact/contactus'>Contact</a></li>";
  echo '    </ul>
          </li>';
  echo '</ul>';

}
