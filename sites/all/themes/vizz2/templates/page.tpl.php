<?php 
	
	// $rgr = field_get_items('node',$node,'field_relatedgbifresources') ; dpm($rgr)

	// we ASSUME there is a $node since we are in a template named page--node--something.tpl.php
	// get an array with all the fields for this node
	// Fetch some data from the navigation taxonomy in order to use it for the page title
	// via custom function in template.php
	$taxon = get_title_data() ;

	global $user;
	global $base_url ;
	global $base_path ;
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;

	$fnode = reset($page['content']['system_main']['nodes'] ) ; 
	if ( array_key_exists ('#bundle', $fnode) AND $fnode['#bundle'] == 'resource_ims') {
		$is_rims = TRUE ;
		$keys = array_keys ($page['content']['system_main']['nodes']);
		$nid = $keys[0];
		$fnode = node_load( $nid ) ;
	
	}

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
			<h1><?php print $taxon->name ?></h1>
			<h3><?php print $taxon->description ?></h3>
			<?php if ( $is_rims ) : ?>
			<div class="box">
				<div class="content">
					<ul>
						<li class="single last"><h4><?php echo $fnode->field_number_downloads['und'][0]['value']; ?></h4>downloads</li>
					</ul>
					<a href="http://imsgbif.gbif.org/CMS_ORC/?doc_id=<?php echo $fnode->field_orc_original_ims_id['und'][0]['value']; ?>&download=1" title="" class="candy_blue_button">
						<span>Download<?php if ($fnode->field_size_text != " ") { echo " (".$fnode->field_size_text['und'][0]['value'].")"; } ?></span>
					</a>
				</div>
			</div>
			<?php endif ?>
		</div>
	</div>
	<?php print render($page['sidebar_first']); ?>
</header>
<div id="content"><!-- page.tpl -->
	<?php print render($page['content']); ?>
</div><!-- page.tpl -->
		
<?php get_footer($base_url) ?>
<?php get_bottom_js($base_url) ?>		
</body>



