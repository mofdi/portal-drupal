<?php 

	$taxon = get_title_data() ;

	global $user;
	global $base_url ;
	global $base_path ;
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
	$more_user = user_load($user->uid) ;
	
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

	<?php get_nav($base_url) ?>
      
    </div>
  </div>
  <!-- /top -->
	<?php $taxon = get_title_data() ; ?>

	<div id="infoband">
		<div class="content">
		<?php if ($user->name) { ?> 
		<h1><?php print ( $more_user->field_firstname['und'][0]['value']); print '&nbsp;' ; print ( $more_user->field_lastname['und'][0]['value']); ?></h1>
		<h3>User account and personal settings</h3>
		<?php  } else { ?>
		<h1>SIGN IN TO GBIF</h1>
		<?php } ?>
		</div>
	</div>

	<div id="tabs">
		<div class="content">
			<ul>
				<li class='selected'><a href="<?php print($base_url.'/user/'.$user->uid.'/edit') ?>" title="Summary"><span>Account</span></a></li>
				<li><a href="<?php print($dataportal_base_url.'/user/downloads') ?>" title="Summary" title="News"><span>Downloads</span></a></li>
				<li><a href="<?php print($dataportal_base_url.'/user/namelists') ?>" title="Summary" title="News"><span>Name lists</span></a></li>
			</ul>
		</div>
	</div>
</header>

<div id="content"><!-- page.tpl -->
		<article id="step-0" class="register">
			<header></header>
			<div class="content">
				<div class="content">
					<?php print $messages ; ?>
					<?php print render($page['content']); ?>
				</div>
			</div>
			<footer></footer>
		</article>
</div><!-- page.tpl -->
<?php get_footer($base_url) ?>

  <!-- JavaScript at the bottom for fast page loading -->
	<script type="text/javascript" src="<?php echo $dataportal_base_url?>/js/vendor/jquery-ui-1.8.17.min.js"></script>
	<script type="text/javascript" src="<?php echo $dataportal_base_url?>/js/vendor/jquery.dropkick-1.0.0.js"></script>
	<script type="text/javascript" src="<?php echo $dataportal_base_url?>/js/vendor/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo $dataportal_base_url?>/js/vendor/mousewheel.js"></script>
	<script type="text/javascript" src="<?php echo $dataportal_base_url?>/js/vendor/jscrollpane.min.js"></script>
	<script type="text/javascript" src="<?php echo $dataportal_base_url?>/js/vendor/jquery-scrollTo-1.4.2-min.js"></script>
	<script type="text/javascript" src="<?php echo $dataportal_base_url?>/js/vendor/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $dataportal_base_url?>/js/vendor/underscore-min.js"></script>
	<script type="text/javascript" src="<?php echo $dataportal_base_url?>/js/helpers.js"></script>
	<script type="text/javascript" src="<?php echo $dataportal_base_url?>/js/widgets.js"></script>
	<script type="text/javascript" src="<?php echo $dataportal_base_url?>/js/graphs.js"></script>
	<script type="text/javascript" src="<?php echo $dataportal_base_url?>/js/app.js"></script>
	<script type="text/javascript" src="<?php echo $dataportal_base_url?>/js/vendor/raphael-min.js"></script>
	<script type="text/javascript" src="<?php echo $dataportal_base_url?>/js/vendor/resourcebundle.js"></script> 
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




