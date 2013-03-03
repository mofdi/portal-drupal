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
<html class="no-js" lang="en" xmlns="http://www.w3.org/1999/xhtml">
<!--<![endif]-->
<head>
  <meta charset="utf-8">
  <script type="text/javascript">
        var cfg = new Object();
    cfg.context="";
    cfg.currentUrl="http://staging.gbif.org:8080/portal/";
    cfg.serverName= "http://staging.gbif.org:8080";
    cfg.baseUrl = "http://staging.gbif.org:8080/portal";
    cfg.wsClb="http://staging.gbif.org:8080/checklistbank-ws/";
    cfg.wsClbSearch="http://staging.gbif.org:8080/checklistbank-search-ws/";
    cfg.wsClbSuggest="http://staging.gbif.org:8080/checklistbank-search-ws/suggest";
    cfg.wsReg="http://staging.gbif.org:8080/registry-ws/";
    cfg.wsRegSearch="http://staging.gbif.org:8080/registry-search-ws/";
    cfg.wsRegSuggest="http://staging.gbif.org:8080/registry-search-ws/suggest";
    cfg.wsOcc="http://staging.gbif.org:8080/occurrence-ws/";
    cfg.wsMetrics="http://staging.gbif.org:8080/metrics-ws/";
    cfg.wsOccSearch="http://staging.gbif.org:8080/occurrence-ws/occurrence/search";
    cfg.tileServerBaseUrl="http://staging.gbif.org:8080/tile-server";
    cfg.wsOccCatalogNumberSearch = "http://staging.gbif.org:8080/occurrence-ws/occurrence/search/catalog_number";
    cfg.wsOccCollectorNameSearch = "http://staging.gbif.org:8080/occurrence-ws/occurrence/search/collector_name";
    cfg.wsOccCollectionCodeSearch = "http://staging.gbif.org:8080/occurrence-ws/occurrence/search/collection_code";
    cfg.wsOccInstitutionCodeSearch = "http://staging.gbif.org:8080/occurrence-ws/occurrence/search/institution_code";
  </script>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title property="dc:title">GBIF Data Portal - Home</title>
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
<body class="home">

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
      <a href="/portal/" class="logo"></a>
    </div>

    <div class="info">
      <h1>Global Biodiversity Information Facility</h1>
      <h2>Free and open access to biodiversity data</h2>

      <ul class="counters">
        <li><strong>377,177,914</strong> Occurrences</li>
        <li><strong>1,022,246</strong> Species</li>
        <li><strong>10,028</strong> Datasets</li>
        <li><strong>419</strong> Data publishers</li>
      </ul>
    </div>
  

      <nav>
      <ul>
        <li>
        <a href="#" title="Data">Data</a>

        <div class="data">
          <a href="#"></a>
          <ul>
            <li><a href="/portal/occurrence">Occurrences</a></li>
            <li><a href="/portal/dataset">Datasets</a></li>
            <li><a href="/species">Species</a></li>
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

        <div class="about">
          <a href="#"></a>
          <ul>
            <li><a href="http://staging.gbif.org/drupal/newsroom/summary">News</a></li>
            <li class="divider"></li>
            <li><a class="placeholder_temp" href="#">Key partners</a></li>
            <li><a class="placeholder_temp" href="#">Mission</a></li>
            <li><a class="placeholder_temp" href="#">Governance details</a></li>
            <li><a class="placeholder_temp" href="#">Work programs</a></li>
            <li><a class="placeholder_temp" href="#">Key facts</a></li>
            <li class="divider"></li>
            <li><a href="/developer">Developer API</a></li>
          </ul>
        </div>

        </li>

        <li class="search">
        <form href="/dataset/search" method="GET">
          <span class="input_text">
              <!-- Global search disabled until implemented later. See issue: http://dev.gbif.org/issues/browse/POR-387 -->
            <input type="text" name="q" disabled="true"/>
          </span>
        </form>
        </li>
      </ul>
      </nav>
    </div>
  </div>
  <!-- /top -->




  </header>


  <div id="content">


    

    <div class="container">

    <article class="search">

    <header>
    </header>

    <div class="content">

      <ul>
        <li>
        <h3>Enables biodiversity data sharing and re-use</h3>
        <ul>
          <li><a href="#">Why publish your data?</a></li>
          <li><a href="#">How to publish your data</a></li>
          <li><a href="#">Data from citizen scientists</a></li>
        </ul>
        </li>

        <li>
        <h3>Supports biodiversity research</h3>
        <ul>
          <li><a href="#">Why publish your data?</a></li>
          <li><a href="#">How to publish your data</a></li>
          <li><a href="#">Data from citizen scientists</a></li>
        </ul>
        </li>

        <li>
        <h3>Collaborates as a global community</h3>
        <ul>
          <li><a href="#">Why publish your data?</a></li>
          <li><a href="#">How to publish your data</a></li>
          <li><a href="#">Data from citizen scientists</a></li>
        </ul>
        </li>

      </ul>
    </div>
    <div class="footer">

      <form action="/member/search">
        <span class="input_text">
          <input type="text" name="q" placeholder="Search GBIF for species, datasets or countries" class="focus">
        </span>
        <button type="submit" class="search_button"><span>Search</span></button>
      </form>

    </div>
    <footer></footer>
    </article>

    <article class="latest-news">

    <header></header>

    <div class="content">

      <div class="header">
        <div class="left">
          <h1>Latest GBIF news</h1>
        </div>
        <div class="right">
          Go to <a href="">GBIF Newsroom</a>
        </div>
      </div>
      
<?php  
	$results = array() ;
	$view = views_get_view_result('featurednewsarticles');
	foreach ($view as $key => $vnode) {
		$nid = $vnode->nid  ;
		$anode = node_load( $nid ) ;
		$results[$key] = $anode ;
	}
?>
      <div class="featured">
        <h3>Featured story</h3>
		<a class="title" href="<?php print $base_url.'/page/'.($results[0]->nid) ?>"><?php print ($results[0]->title)?></a>
		<?php print( render( field_view_field('node', $results[0], 'field_featured', array('settings' => array('image_style' => 'featured'))) ) ); ?>
		<p><?php print ( $results[0]->body['und'][0]['summary'] ) ; ?></p>
        <a href="<?php print $base_url.'/page/'.($results[0]->nid) ?>">Read more</a>
      </div>

      <div class="latest">
        <h3>Latest news</h3>

<?php  
	$results = array() ;
	$view = views_get_view_result('newsarticles');

	foreach ($view as $key => $vnode) {
		$nid = $vnode->nid  ;
		$anode = node_load( $nid ) ;
		$results[$key] = $anode ;
	}
?>
			<ul>
		<?php for ( $td = 0 ; $td < 5 ; $td++ ) : ?>
			<li>
			<div class="date"><?php { print( format_date($results[$td]->created, 'custom', 'F jS, Y')) ; } ?></div>
			<a href="<?php print $base_url.'/page/'.$results[$td]->nid ?>" class="title"><?php print $results[$td]->title ?></a>
			</li>
		<?php endfor ?>        
			</ul>

        <a href="#" class="read-more">More</a>
      </div>

      <div class="upcoming">
        <h3>Upcoming events</h3>

        <ul>

          <li>
          <div class="calendar">
            <div class="month">Sep</div>
            <strong>19</strong>
          </div>
          <div class="location">Lillehammer, Norway</div> 
          <a href="#">GBIF Science Symposium 2012</a>
          </li>

          <li>
          <div class="calendar">
            <div class="month">Sep</div>
            <strong>19</strong>
          </div>
          <div class="location">Lillehammer, Norway</div> 
          <a href="#">GBIF Science Symposium 2012</a>
          </li>

          <li>
          <div class="calendar">
            <div class="month">Sep</div>
            <strong>19</strong>
          </div>
          <div class="location">Lillehammer, Norway</div> 
          <a href="#">GBIF Science Symposium 2012</a>
          </li>

          <li>
          <div class="calendar">
            <div class="month">Sep</div>
            <strong>19</strong>
          </div>
          <div class="location">Lillehammer, Norway</div> 
          <a href="#">GBIF Science Symposium 2012</a>
          </li>

        </ul>

        <a href="#" class="read-more">More</a>

      </div>


    </div>
    <footer></footer>
    </article>



    <article class="featured">
    <header></header>
    <div class="content">

      <div class="inner">
        <ul>
<?php
$results = array() ;
$view = views_get_view_result('usesofdatafeaturedarticles');
foreach ($view as $key => $vnode) {
	$nid = $vnode->nid  ;
	$anode = node_load( $nid ) ;
	$results[$key] = $anode ;
} 
?>
	<?php for ( $td = 0 ; $td < 3 ; $td++ ) : ?>
		<li class="<?php  if ( (($td + 1) % 3 ) == 0 ) echo 'last' ; ?>">
			<h3>Featured data use</h3>
			<a class="title" href="<?php print $base_url.'/page/'.($results[$td]->nid) ?>"><?php print ($results[$td]->title)?></a>
			<a href="<?php print $base_url.'/page/'.($results[$td]->nid) ?>">
			<?php print( render( field_view_field('node', $results[$td], 'field_featured', array('settings' => array('image_style' => 'featured'))) ) ); ?>
			</a>
			<p><?php print ( $results[$td]->body['und'][0]['summary'] ) ; ?></p>
		</li>
	<?php endfor ?>
      </ul>
    </div>
  </div>

  <div class="footer">
    <a href="#">Birds</a> &middot;
    <a href="#">Butterflies</a> &middot;
    <a href="#">Lizards</a> &middot;
    <a href="#">Reptiles</a> &middot;
    <a href="#">Fishes</a> &middot;
    <a href="#">Mammals</a> &middot;
    <a href="#">Insects</a>
  </div>

  <footer></footer>
  </article>


  <article class="next_news">
  <header></header>
  <div class="content">
    <h3>Contribute to gbif</h3>
    <a href=""><h1>Learn how to publish your organization data in GBIF</h1></a>
  </div>
  <footer></footer>
  </article>
</div>



  </div>

  <footer>
  <div class="inner">
    <ul>
      <li><h3>EXPLORE THE DATA</h3></li>
      <li><a href="/portal/occurrence">Occurrences</a></li>
      <li><a href="/portal/dataset">Datasets</a></li>
      <li><a href="/portal/species">Species</a></li>
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
      <li><a href="/portal/dataset/register/step1">Share your data</a></li>
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
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/jquery-ui-1.8.17.min.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/jscrollpane.min.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/jquery.dropkick-1.0.0.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/jquery.uniform.min.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/mousewheel.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/jscrollpane.min.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/jquery-scrollTo-1.4.2-min.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/underscore-min.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/helpers.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/widgets.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/graphs.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/app.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/raphael-min.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/resourcebundle.js"></script>
  <!-- end scripts-->

  <!--[if lt IE 7 ]>
  <script src="<?php print ($base_url); ?>/js/libs/dd_belatedpng.js"></script>
  <script>DD_belatedPNG
    .fix("img, .png_bg"); // Fix any <img> or .png_bg bg-images. Also, please read goo.gl/mZiyb </script>
  <![endif]-->

  <!-- keep this javascript here so we can use the s.url tag -->
  <script type="text/javascript">
    $(function() {
      $('nav ul li a.more').bindLinkPopover({
        links:{
          "Countries":"/portal/country",
          "GBIF Network":"/portal/member",
          "Themes":"/portal/theme",
          "Statistics":"/portal/stats",
          "About":"http://staging.gbif.org/drupal/about"
        }
      });
    });
  </script>


</body>
</html>