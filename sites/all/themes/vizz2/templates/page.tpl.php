   <?php 
	
	// $rgr = field_get_items('node',$node,'field_relatedgbifresources') ; dpm($rgr)

	// we ASSUME there is a $node since we are in a template named page--node--something.tpl.php
	// get an array with all the fields for this node
	
	if ($node) {
		$tags = field_attach_view('node', $node,'full' ) ; 
	}

	// Fetch some data from the navigation taxonomy in order to use it for the page title
	// via custom function in template.php
	$taxon = get_title_data() ;

	global $user;
	global $base_url ;
	global $base_path ;
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
					
?>
<header>
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

	<?php get_nav() ?>
    </div>
  </div>
  <!-- /top -->
	<?php $taxon = get_title_data() ; ?>
	<div id="infoband">
		<div class="content">
			<h1><?php print $taxon->name ?></h1>
			<h3><?php print $taxon->description ?></h3>
		</div>
	</div>
		<?php print render($page['sidebar_first']); ?>
</header>
<div id="content"><!-- page.tpl -->
	<?php print $messages ; ?>
	<?php print render($page['content']); ?>
	<?php print $messages ; ?>
</div><!-- page.tpl -->
		
<?php get_footer($base_url) ?>
		
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




