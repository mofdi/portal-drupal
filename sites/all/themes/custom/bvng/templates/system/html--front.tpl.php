<?php
/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or
 *   'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see bootstrap_preprocess_html()
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 *
 * @ingroup themeable
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces;?>>
<head profile="<?php print $grddl_profile; ?>">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  

<style>@import url("http://dd.gbif.org/sites/all/themes/custom/bvng/css/style.css?n5b3hh");</style>


   <link rel="stylesheet" href="http://dd.gbif.org/sites/all/libraries/leaflet/leaflet.css" />
  <!-- HTML5 element support for IE6-8 -->
  <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <!-- beginning Drupal scripts -->
  <?php //print $scripts; ?>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write("<script src='/sites/all/modules/contrib/jquery_update/replace/jquery/1.7/jquery.min.js'>\x3C/script>")</script>
<script src="http://dd.gbif.org/misc/jquery.once.js?v=1.2"></script>
<script src="http://www.gbif.org/cfg"></script>
<script src="http://dd.gbif.org/sites/all/libraries/leaflet/leaflet.js?n542hp"></script>
<script src="http://dd.gbif.org/sites/all/libraries/moment/moment.js?n542hp"></script>
<script src="http://dd.gbif.org/sites/all/themes/custom/bvng/js/init_homepage_map.js?n542hp"></script>
<!-- script src="http://dd.gbif.org/misc/drupal.js?n542hp"></script -->  

	<!-- script type="text/javascript" src="http://www.gbif.org/js/vendor/jquery-1.7.1.min.js"></script>
	<script src="http://dd.gbif.org/sites/all/libraries/leaflet/dist/leaflet.js?n542hp"></script>
	<script src="http://dd.gbif.org/sites/all/libraries/moment/moment.js?n542hp"></script>
	<script src="http://dd.gbif.org/sites/all/themes/custom/bvng/js/init_homepage_map.js?n542hp"></script -->
	
  <!-- ending Drupal scripts -->
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
	<div id='homepageMap' class="leaflet-container"></div>

  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
	<?php print $page_top; ?>
	<?php print $page; ?>
	<?php print $page_bottom; ?>  
</body>
</html>
