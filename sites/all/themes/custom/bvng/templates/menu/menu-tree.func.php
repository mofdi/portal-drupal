<?php
/**
 * @file
 * menu-tree.func.php
 */

/**
 * Overrides theme_menu_tree().
 */
function bvng_menu_tree(&$variables) {
  return '<ul class="menu nav">' . $variables['tree'] . '</ul>';
}

/**
 * Bootstrap theme wrapper function for the primary menu links.
 */
function bvng_menu_tree__primary(&$variables) {
  return '<ul class="menu nav navbar-nav">' . $variables['tree'] . '</ul>';
}

/**
 * Bootstrap theme wrapper function for the secondary menu links.
 */
function bvng_menu_tree__secondary(&$variables) {
  return '<ul class="menu nav navbar-nav secondary">' . $variables['tree'] . '</ul>';
}

/**
 * Use bootstrap nav-tabs class to style menu tabs.
 */
function bvng_menu_tree__menu_block(&$variables) {
  return '<ul class="menu nav nav-tabs">' . $variables['tree'] . '</ul>';
}
