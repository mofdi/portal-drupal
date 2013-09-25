<?php
/**
 * @file
 * Zen theme's implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation. $language->dir
 *   contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $html_attributes: String of attributes for the html element. It can be
 *   manipulated through the variable $html_attributes_array from preprocess
 *   functions.
 * - $html_attributes_array: Array of html attribute values. It is flattened
 *   into a string within the variable $html_attributes.
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
 * - $default_mobile_metatags: TRUE if default mobile metatags for responsive
 *   design should be displayed.
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $skip_link_anchor: The HTML ID of the element that the "skip link" should
 *   link to. Defaults to "main-menu".
 * - $skip_link_text: The text for the "skip link". Defaults to "Jump to
 *   Navigation".
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It should be placed within the <body> tag. When selecting through CSS
 *   it's recommended that you use the body tag, e.g., "body.front". It can be
 *   manipulated through the variable $classes_array from preprocess functions.
 *   The default values can contain one or more of the following:
 *   - front: Page is the home page.
 *   - not-front: Page is not the home page.
 *   - logged-in: The current viewer is logged in.
 *   - not-logged-in: The current viewer is not logged in.
 *   - node-type-[node type]: When viewing a single node, the type of that node.
 *     For example, if the node is a Blog entry, this would be "node-type-blog".
 *     Note that the machine name of the content type will often be in a short
 *     form of the human readable label.
 *   The following only apply with the default sidebar_first and sidebar_second
 *   block regions:
 *     - two-sidebars: When both sidebars have content.
 *     - no-sidebars: When no sidebar content exists.
 *     - one-sidebar and sidebar-first or sidebar-second: A combination of the
 *       two classes when only one of the two sidebars have content.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see zen_preprocess_html()
 * @see template_process()
 */
?><?php // fetch some page variables
	global $user;
	global $base_url ;
	global $base_path ;
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
	$api_base_url = theme_get_setting ( 'vizz2_api_base_url', 'vizz2' );
		
?><!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<!--
    __________  __________   ____        __           ____             __        __
   / ____/ __ )/  _/ ____/  / __ \____ _/ /_____ _   / __ \____  _____/ /_____ _/ /
  / / __/ __  |/ // /_     / / / / __ `/ __/ __ `/  / /_/ / __ \/ ___/ __/ __ `/ /
 / /_/ / /_/ // // __/    / /_/ / /_/ / /_/ /_/ /  / ____/ /_/ / /  / /_/ /_/ / /
 \____/_____/___/_/      /_____/\__,_/\__/\__,_/  /_/    \____/_/   \__/\__,_/_/
-->
<html class="no-js" lang="en" xmlns="http://www.w3.org/1999/xhtml">
<!--<![endif]-->
<head>
  <meta charset="utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title property="dc:title">GBIF Portal - Home</title>
  <meta name="description" content="">
  <meta name="author" content="GBIF">
  <link rel="shortcut icon" href="<?php print ($dataportal_base_url); ?>/img/favicon/favicon_32x32.ico">
  <link rel="apple-touch-icon" href="<?php print ($dataportal_base_url); ?>/img/favicon/favicon_32x32.ico">
  <link rel="stylesheet" href="<?php print ($dataportal_base_url); ?>/css/style.css?v=2"/>
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css" type="text/css" media="all"/>
  <link rel="stylesheet" href="<?php print ($dataportal_base_url); ?>/js/vendor/leaflet/leaflet.css" />		
  <!--[if lte IE 8]><link rel="stylesheet" href="<?php print ($dataportal_base_url); ?>/js/vendor/leaflet/leaflet.ie.css" /><![endif]-->		

  <!-- begin Drupal scripts -->
  <?php print $scripts; ?>
  <!-- end Drupa scripts -->
  <script src="<?php print ($dataportal_base_url); ?>/cfg"></script>
  <script src="<?php print ($dataportal_base_url); ?>/js/vendor/modernizr-1.7.min.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/jquery-1.7.1.min.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/jquery.cookie.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/menu.js"></script>  
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/jscrollpane.min.js"></script>
  <!-- we have issues with firefox, not only IE: http://dev.gbif.org/issues/browse/POR-412 -->  
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/css_browser_selector.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/leaflet/leaflet.js"></script>		
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/homepage-map.js"></script>		

	<script type="text/javascript">
		function numberWithCommas(x) {
	      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	    }
		$(function() {
			$.getJSON('<?php echo $api_base_url?>/occurrence/count?callback=?', function (data)
			{ $("#countOccurrences").html(numberWithCommas(data)); }
			);
			$.getJSON('<?php echo $api_base_url?>/name_usage/search?dataset_key=7ddf754f-d193-4cc9-b351-99906754a03b&limit=1&rank=species&status=accepted&callback=?', function (data)
			{ $("#countSpecies").html(numberWithCommas(data.count)); }
			);	
			$.getJSON('<?php echo $api_base_url?>/dataset/search?limit=1&callback=?', function (data)
			{ $("#countDatasets").html(numberWithCommas(data.count)); }
			);
			$.getJSON('<?php echo $api_base_url?>/organization/count?callback=?', function (data)
			{ $("#countPublishers").html(numberWithCommas(data)); }
			);
		});
	</script>

	<link rel="stylesheet" href="<?php print ($base_url); ?>/sites/all/themes/vizz2/css/lastminutefix.css">
</head>
<body class="home">
	<?php print $page; ?>
</body>
</html>
