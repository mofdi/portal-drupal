<?php 
	
	// $rgr = field_get_items('node',$node,'field_relatedgbifresources') ; dpm($rgr)

	// we ASSUME there is a $node since we are in a template named page--node--something.tpl.php
	// get an array with all the fields for this node

	/* 
	$block = module_invoke('search', 'block_view', 'form');
	print render($block); 
	*/
	
	// Fetch some data from the navigation taxonomy in order to use it for the page title
	// via custom function in template.php
	$taxon = get_title_data() ;

	global $user;
	global $base_url ;
	global $base_path ;
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
	// dpm($page['content']['system_main']['search_form']);  print $messages ;
	$results_exist = isset( $page['content']['system_main']['search_results']['#results'] ) ? : FALSE
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

		<a class="disclaimerToggle" href="/portal/disclaimer">
		<img src="<?php echo $dataportal_base_url?>/img/beta.gif">
		</a>
	<?php get_nav($base_url, $w_search=FALSE) ?>
    </div>
  </div>
  <!-- /top -->
	<?php $taxon = get_title_data() ; ?>
	<div id="infoband">
		<div class="content">

		<h2>Search GBIF</h2>

		<form action="/search/node" method="post" id="search-form">

		  <input id="edit-keys"  type="text" name="keys" value="<?php print ($page['content']['system_main']['search_form']['basic']['keys']['#default_value']) ; ?>" autocomplete="off" placeholder="Search news items and information pages..."/>

		  <input type="hidden" name="form_build_id" value="<?php print $page['content']['system_main']['search_form']['#build_id']?>" />
		  <input type="hidden" name="form_token" value="<?php print $page['content']['system_main']['search_form']['form_token']['#default_value']?>" />
		  <input type="hidden" name="form_id" value="search_form" />
		  <input type="hidden" id="edit-submit" name="op" value="Search" class="form-submit" />
		</form>

		</div>

	</div>
		<?php print render($page['sidebar_first']); ?>
</header>
<div id="content"><!-- page.tpl -->
<?php if ( $results_exist ) { ?>
		<?php print render($page['content']['system_main']['search_results']); 	 ?>
<?php } else { ?>
	    <article class="dataset">
			<header></header>
			<div class="content">
			<?php if ( $messages ) { ?>
			<p><?php echo $messages ; ?></p>
			<?php } else { ?>
			<h2>Search Error</h2>
			<p>Please enter at least one search term.</p>
			<?php } ?>
			</div>
			<footer></footer>
		</article>
<?php } ?>
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




