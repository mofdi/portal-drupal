<?php
/**
 * @file
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

<?php $taxon = get_title_data() ; ?>

  <title property="dc:title">
  <?php print $taxon->name?>&nbsp;&dash;&nbsp;<?php if ($taxon->description != '') print $taxon->description ; else print $head_title;  ?></title>
  <meta name="description" content="">
  <meta name="author" content="GBIF">
  <link rel="shortcut icon" href="<?php print ($dataportal_base_url); ?>/img/favicon/favicon_32x32.ico">
  <link rel="apple-touch-icon" href="<?php print ($dataportal_base_url); ?>/img/favicon/favicon_32x32.ico">
  <link rel="stylesheet" href="<?php print ($dataportal_base_url); ?>/css/style.css?v=2"/>
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css" type="text/css" media="all"/>
	<link rel="stylesheet" href="<?php print ($dataportal_base_url); ?>/css/bootstrap-tables.css"/>
  
  <!-- begin Drupal scripts -->
  <?php print $styles ; ?>
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
  	
	<style type="text/css">
		header #beta {
		left: 200px;
		top: 10px;
		}
	</style>

	<link rel="stylesheet" href="<?php print ($base_url); ?>/sites/all/themes/vizz2/css/lastminutefix.css">	
	  
</head>
<body class="newsroom">
	<?php print $page_top; ?>
	<?php print $page; ?>
	<?php print $page_bottom; ?>
</body>
</html>
