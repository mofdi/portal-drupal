<?php 

	$taxon = get_title_data() ;

	global $user;
	global $base_url ;
	global $base_path ;
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
	$more_user = user_load($user->uid) ;
	
?>
<body class="newsroom">
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
        <a href="<?php print $base_url;?>/" class="logo"><img src="<?php print $dataportal_base_url;?>/img/header/logo.png"/></a>

        <h1><a href="<?php print $base_url;?>/newsroom/summary" title="GBIF.ORG">GBIF.ORG</a></h1>
        <span>Free and open access to biodiversity data</span>
      </div>

		<a class="disclaimerToggle" href="/portal/disclaimer">
		<img src="<?php echo $dataportal_base_url?>/img/beta.gif">
		</a>
	<?php get_nav($base_url) ?>
      
    </div>
  </div>
  <!-- /top -->
	<?php $taxon = get_title_data() ; ?>

	<div id="infoband">
		<div class="content">
			<h1>Register New GBIF Account</h1>
			<h3>Please, register to the GBIF data portal for downloading data, or login if you already have an account </h3>
		</div>
	</div>
</header>

<div id="content"><!-- page.tpl -->
		<article id="step-0" class="register">
			<header></header>
			<div class="content">
				<div class="content">
				<h3>Disclaimer</h3>
				<p>Any user accounts created may be deleted; users might need to recreate their accounts in the future</p>
				<p>By registering with GBIF you agree to abide by the terms of usage set out <a href="http://data.gbif.org/tutorial/datauseagreement">here</a></p>
										
				</div>
			</div>
			<footer></footer>
		</article>
		<?php if (!empty ($messages) ) { ?>
		<article id="step-0" class="register">
			<header></header>
			<div class="content">
				<div class="content">
					<?php print $messages ; ?>
				</div>
			</div>
			<footer></footer>
		</article>
		<?php } ?>		
		<article id="step-0" class="register">
			<header></header>
			<div class="content">
				<div class="content">
					<?php print render($page['content']); ?>					
				</div>
			</div>
			<footer></footer>
		</article>
</div><!-- page.tpl -->
<?php get_footer($base_url) ?>
<?php get_bottom_js($base_url) ?>

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