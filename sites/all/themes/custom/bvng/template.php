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
