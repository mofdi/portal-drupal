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
<html version="HTML+RDFa 1.1" class="no-js" lang="en"
      xmlns="http://www.w3.org/1999/xhtml"
        >
<!--<![endif]-->
<head>
  <meta charset="utf-8">
  <script type="text/javascript">
        var cfg = new Object();
    cfg.context="/drupal/sites/all/themes/vizz2/";
    cfg.currentUrl="http://staging.gbif.org:8080/drupal/sites/all/themes/vizz2/newsroom/uses/1";
    cfg.serverName= "http://duronel.gbif.org";
    cfg.baseUrl = "/drupal";
    cfg.wsClb="http://staging.gbif.org:8080/checklistbank-ws/";
    cfg.wsClbSearch="http://staging.gbif.org:8080/checklistbank-search-ws/";
    cfg.wsClbSuggest="http://staging.gbif.org:8080/checklistbank-search-ws/suggest";
    cfg.wsReg="http://staging.gbif.org:8080/registry-ws/";
    cfg.wsRegSearch="http://staging.gbif.org:8080/registry-search-ws/";
    cfg.wsRegSuggest="http://staging.gbif.org:8080/registry-search-ws/suggest";
    cfg.wsOcc="http://staging.gbif.org:8080/occurrence-ws/";
    cfg.wsOccSearch="http://staging.gbif.org:8080/occurrence-ws/search";
    cfg.tileServerBaseUrl="http://staging.gbif.org:8080/tile-server";
    cfg.wsOccCatalogNumberSearch = "http://staging.gbif.org:8080/occurrence-ws/searchcatalog_number";
    cfg.wsOccCollectorNameSearch = "http://staging.gbif.org:8080/occurrence-ws/searchcollector_name";
  </script>

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<?php $taxon = get_title_data() ; ?>

  <title property="dc:title">
  <?php print $taxon->name?>&nbsp;&dash;&nbsp;<?php if ($taxon->description != '') print $taxon->description ; else print $head_title;  ?></title>
  <meta name="description" content="">
  <meta name="author" content="GBIF">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?php print ($base_url); ?>/favicon.ico">
  <link rel="apple-touch-icon" href="<?php print ($base_url); ?>/apple-touch-icon.png">
  <link rel="stylesheet" href="<?php print ($dataportal_base_url); ?>/css/style.css?v=2"/>
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css" type="text/css" media="all"/>

  
  <?php print $scripts; ?>

  <script src="<?php print ($dataportal_base_url); ?>/js/vendor/modernizr-1.7.min.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/jquery-1.7.1.min.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/menu.js"></script>  
  <!-- we have issues with firefox, not only IE: http://dev.gbif.org/issues/browse/POR-412 -->
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/css_browser_selector.js"></script>

</head>
<body class="newsroom">
	<header>
  <!-- top -->
  <div id="top">
    <div class="content">

      <div class="account">
		<?php if (!$logged_in) { ?>
        <a href="<?php print $base_url?>/user/login" title='Login'>Login</a> or
        <a href="<?php print $base_url;?>/user/register" title='Create a new account'>Create a new account</a>
		<?php } else { ?>
			<?php if ($user->uid) { ?>
			<a href="<?php print $base_url;?>/user/<?php print ($user->uid) ?>/edit">Hello <?php print ( $user->name);?></a>
			<a href="<?php print $base_url;?>/user/logout">&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
			<?php } ?>
		<?php } ?>

      </div>

      <div id="logo">
        <a href="<?php print $base_url;?>/" class="logo"><img src="<?php print $base_url;?>/sites/default/files/img/header/logo.png"/></a>

        <h1><a href="<?php print $base_url;?>/newsroom/summary" title="GBIF.ORG">GBIF.ORG</a></h1>
        <span>Free and open access to biodiversity data</span>
      </div>

      <nav>
      <ul>
        <li>
        <a href="#" title="Data">Data</a>

        <div class="data">
          <a href="#"></a>
          <ul>
            <li><a href="<?php print $dataportal_base_url ;?>/occurrence">Occurrences</a></li>
            <li><a href="<?php print $dataportal_base_url ;?>/dataset">Datasets</a></li>
            <li><a href="<?php print $dataportal_base_url ;?>/species">Species</a></li>
            <li class="divider"></li>
            <li><a class="placeholder_temp" href="#">Themes</a></li>
            <li><a class="placeholder_temp" href="#">Statistics</a></li>
            <li><a class="placeholder_temp" href="#">GBIF Data usage</a></li>
            <li class="divider"></li>
            <li><a class="placeholder_temp" href="#">Publish your data</a></li>
            <li><a class="placeholder_temp" href="#">Publishing workflow</a></li>
          </ul>
        </div>

        </li>

        <li>
        <a class="placeholder_temp" href="#" title="Community">Community</a>

        <div class="community">
          <a href="#"></a>
          <ul>
            <li><a class="placeholder_temp" href="#">Regions</a></li>
            <li><a class="placeholder_temp" href="#">Countries</a></li>
            <li><a class="placeholder_temp" href="#">Participant organizations</a></li>
            <li><a class="placeholder_temp" href="#">Data publishers</a></li>
            <li class="divider"></li>
            <li><a class="placeholder_temp" href="#">Capacity bulding</a></li>
            <li><a class="placeholder_temp" href="#">Training</a></li>
            <li><a class="placeholder_temp" href="#">BIF building</a></li>
            <li><a class="placeholder_temp" href="#">Whitepages</a></li>
          </ul>
        </div>

        </li>

        <li>
        <a href="#" title="About GBIF">About GBIF</a>
		<?php global $base_url; ?>
        <div class="about">
          <a href="#"></a>
          <ul>
            <li><a href="<?php echo $base_url?>/newsroom/summary">GBIF Newsroom</a></li>
            <li class="divider"></li>
            <li><a class="placeholder_temp" href="<?php echo $base_url?>/key_partners">Key partners</a></li>
            <li><a class="placeholder_temp" href="<?php echo $base_url?>/miss_tab1">Mission</a></li>
            <li><a class="placeholder_temp" href="#">Governance details</a></li>
            <li><a class="placeholder_temp" href="#">Work programs</a></li>
            <li><a class="placeholder_temp" href="<?php echo $base_url?>/kf1_tab1">Key facts</a></li>
            <li class="divider"></li>
            <li><a href="/portal-web-dynamic/developer">Developer API</a></li>
          </ul>
        </div>

        </li>

        <li class="search">
        <form href="/drupal/sites/all/themes/vizz2/dataset/search" method="GET">
          <span class="input_text">
            <input type="text" name="q"/>
          </span>
        </form>
        </li>
      </ul>
      </nav>
    </div>
  </div>
  <!-- /top -->
  <?php print $page_top; ?>
  
<?php print $messages ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>

  <footer>
  <div class="inner">
    <ul>
      <li><h3>EXPLORE THE DATA</h3></li>
      <li><a href="/portal-web-dynamic/occurrence">Occurrences</a></li>
      <li><a href="/portal-web-dynamic/dataset">Datasets</a></li>
      <li><a href="/portal-web-dynamic/species">Species</a></li>
      <li><a href="#">Countries</a></li>
      <li><a href="#">GBIF Network</a></li>
      <li><a href="#">Themes</a></li>
    </ul>

    <ul>
      <li><h3>VIEW THE STATISTICS</h3></li>
      <li><a href="#">Global numbers</a></li>
      <li><a href="#">Taxonomic coverage</a></li>
      <li><a href="#">Providers</a></li>
      <li><a href="#">Countries</a></li>
    </ul>

    <ul class="last">
      <li><h3>JOIN THE COMMUNITY</h3></li>
      <li><a href="http://staging.gbif.org/drupal/user/register">Create a new account</a></li>
      <li><a href="/portal-web-dynamic/dataset/register/step1">Share your data</a></li>
      <li><a href="http://staging.gbif.org/drupal/terms">Terms and Conditions</a></li>
      <li><a href="http://staging.gbif.org/drupal/about">About</a></li>
    </ul>

  </div>
  </footer>

  <div class="contact_footer">
    <div class="inner">
      <!--<p>2012 &copy; GBIF. Data publishers retain all rights to data.</p>-->
      <div class="copyright">
        <div class="logo"></div>
        <p>2011 © GBIF</p>
      </div>

      <div class="address">
        <h3>GBIF Secretariat</h3>

        <address>
          Universitetsparken 15<br />
          DK-2100 Copenhagen Ø<br />
          DENMARK
        </address>
      </div>

      <div class="contact">
        <h3>Contact</h3>
        <ul>
          <li><strong>Email</strong> info@gbif.org</li>
          <li><strong>Tel</strong> +45 35 32 14 70</li>
          <li><strong>Fax</strong> +45 35 32 14 80</li>
        </ul>
        <p>
        You can also check the <a href="#">GBIF Directory</a>
        </p>

      </div>


    </div>
  </div>

  <!-- JavaScript at the bottom for fast page loading -->
  <!-- scripts concatenated and minified via ant build script  -->
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/vendor/autocomplete.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/vendor/jquery.uniform.min.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/vendor/mousewheel.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/vendor/jscrollpane.min.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/vendor/jquery-scrollTo-1.4.2-min.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/vendor/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/vendor/underscore-min.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/helpers.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/widgets.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/graphs.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/app.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/vendor/raphael-min.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/vendor/resourcebundle.js"></script>
  <!-- end scripts-->

  <!--[if lt IE 7 ]>
  <script src="/portal-web-dynamic/js/libs/dd_belatedpng.js"></script>
  <script>DD_belatedPNG
    .fix("img, .png_bg"); // Fix any <img> or .png_bg bg-images. Also, please read goo.gl/mZiyb </script>
  <![endif]-->

  <!#-- keep this javascript here so we can use the s.url tag -->
  <script type="text/javascript">
    $(function() {
      $('nav ul li a.more').bindLinkPopover({
        links:{
          "Countries":"/portal-web-dynamic/country",
          "GBIF Network":"/portal-web-dynamic/member",
          "Themes":"/portal-web-dynamic/theme",
          "Statistics":"/portal-web-dynamic/stats",
          "About":"http://staging.gbif.org/drupal/about"
        }
      });
    });
  </script>


</body>
</html>
