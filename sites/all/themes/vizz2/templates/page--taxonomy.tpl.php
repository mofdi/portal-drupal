<?php 
	$taxon = get_title_data() ;

	global $user;
	global $base_url ;
	global $base_path ;
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
	// dpm($page); print $messages ;
	$results_exist = isset( $page['content']['system_main']['nodes'] ) ? : FALSE
?>
<body class="search">
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
			<div class="content">
				<h1>Items tagged "<?php echo $title?>"</h1>
			</div>

		</div>
	</div>	
		<?php print render($page['sidebar_first']); ?>
</header>
<div id="content"><!-- page.tpl -->
	<article class="results light_pane">
		<header></header>
		<div class="content">
			<div class="header">
				<?php if ( $results_exist ) : ?>
				<div class="left"><h2><?php print $search_totals; ?></h2><a href="<?php echo $base_url.'/taxonomy/term/'.$page['content']['system_main']['term_heading']['term']['#term']->tid?>/feed"><img src="<?php echo $base_url?>/sites/all/themes/vizz2/img/feed-icon-14x14.png"></a></div>
				<?php else : ?>
				<div class="left"><h2><?php print t('Your search yielded no results');?></h2></div>
				<?php endif; ?>
				<div class="right"><h3>More search options</h3></div>
			</div>
			<div class="left">
				<?php if ( $results_exist ) : ?>
				<?php print render($page['content']); 	 ?>
				<?php print $pager; ?>
				<?php else : ?>
				<p>For the moment there are no items tagged "<?php echo $title?>"</p>
				<?php endif; ?>
			</div>
			<div class="right">
				<div class="refine">
					<p>This search result only covers the text content of the news and information pages of the GBIF portal.</p>
					<p>If you want to search data content, start here:</p>

					<ul id="more_links">
					<li><a href="<?php print ($dataportal_base_url) ?>/dataset">Publishers and datasets</a></li>
					<li><a href="<?php print ($dataportal_base_url) ?>/country">Countries</a></li>
					<li><a href="<?php print ($dataportal_base_url) ?>/occurrence">Occurrences</a></li>
					<li><a href="<?php print ($dataportal_base_url) ?>/species">Species</a></li>
					</ul>

				</div>
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