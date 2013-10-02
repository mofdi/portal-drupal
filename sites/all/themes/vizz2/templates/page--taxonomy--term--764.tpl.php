<?php 
	$taxon = get_title_data() ;

	global $user;
	global $base_url ;
	global $base_path ;
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
	
	$results = array() ;
	$view = views_get_view_result('viewallresources');

	foreach ($view as $key => $vnode) {
		$nid = $vnode->nid  ;
		$anode = node_load( $nid ) ;
		$results[$key] = $anode ;
		// $results[$nid]['fields'] = field_attach_view('node', $anode,'full' ) ; 
		// print render ( $result[$nid]->field_featured  ) ; 
	}

?>
<body class="news">
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
		<?php $taxon = get_title_data() ; ?>
		<h1><?php print $taxon->name ?></h1>
		<h3><?php print $taxon->description ?></h3>
		</div>
	</div>
		<?php print render($page['sidebar_first']); ?>
</header>

<div id="content">
	<article class="results ">
		<header></header>
		<div class="content">
		<div class="header">
			<div class="left"><h2>Finding useful resources</h2></div>
		</div>
			<div class="left">
			<p>GBIF maintains an online database of documents, manuals, tools and links useful to GBIF Participants and their biodiversity information facilities. All of these resources are available through this portal, and can be searched using the box at the top of the page. The resources added most recently to the database are shown below. </p>
			<p>In coming months, we will develop more advanced filtering and searching facilities, building on the functions of the GBIF Online Resource Centre associated with the previous GBIF portal</p>
			<br/><br/>
			<h3>Latest additions:</h3>
				<?php for ( $td = 0 ; $td < 5 ; $td++ ) : ?>
				<div class="result">
					<h2><a href="<?php print $base_url.'/resources/'.$results[$td]->nid ?>"><?php print $results[$td]->title ?></a></h2>
					<p><?php print $results[$td]->body['und'][0]['summary'] ?></p>
					<div class="footer">
						<p class="date"><?php print( render ( format_date($results[$td]->field_publishing_date['und'][0]['value'], 'custom', 'F jS, Y '))) ;  ?></p>
					</div>
				</div>
				<?php endfor ?>
			<a href="<?php print $base_url?>/resources/archive" class="candy_white_button more_news next lft"><span>Archive of all GBIF resources</span></a>
			</div>

		</div>
		<footer></footer>
	</article>
</div>

<?php get_footer($base_url) ?>
<?php get_bottom_js($base_url) ?>		
</body>
