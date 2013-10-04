<?php 
	
	$taxon = get_title_data() ;

	global $user;
	global $base_url ;
	global $base_path ;
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
					
?>
<body class="infobandless">
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

        <h1><a href="<?php print $base_url;?>" title="GBIF.ORG">GBIF.ORG</a></h1>
        <span>Free and open access to biodiversity data</span>
      </div>
	<?php get_nav($base_url) ?>
    </div>
  </div>
  <!-- /top -->
</header>
<div id="content"><!-- page.tpl -->
    <article class="dataset">
    <header></header>
    <div class="content">

      <h1>403 Forbidden</h1>
      <p><?php print render($page['content']); ?><p>
      <p>We are sorry, but the requested page is not accesible.</p>

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