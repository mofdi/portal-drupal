<?php 
	if ($node) {
		$tags = field_attach_view('node', $node,'full' ) ; 
	}
	$taxon = get_title_data() ;

	global $user;
	global $base_url ;
	global $base_path ;
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
	
	$results = array() ;
	$view = views_get_view_result('viewallevents');

	foreach ($view as $key => $vnode) {
		$nid = $vnode->nid  ;
		$anode = node_load( $nid ) ;
		$results[$key] = $anode ;
		// $results[$nid]['fields'] = field_attach_view('node', $anode,'full' ) ; 
		// print render ( $result[$nid]->field_featured  ) ; 
	}


// dpm($page) ;  
//newsroom/events	
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
		<?php $taxon = get_title_data() ; ?>
		<h1><?php print $taxon->name ?></h1>
		<h3><?php print $taxon->description ?></h3>
		</div>
	</div>
		<?php print render($page['sidebar_first']); ?>
</header>
<div id="content">
	<article class="results light_pane">
		<header></header>
		<div class="content">
		<div class="header">
			<div class="left"><h2>Latest GBIF Events</h2></div>
			<div class="right"><h3>Filter by region</h3></div>
		</div>
			<div class="left">
				<?php for ( $td = 0 ; $td < 5 ; $td++ ) : ?>
				<div class="result">
					<h2><a href="<?php print $base_url.'/page/'.$results[$td]->nid ?>"><?php print $results[$td]->title ?></a></h2>
					<p><?php print $results[$td]->body['und'][0]['summary'] ?></p>
					<div class="footer">
						<p class="date"><?php { print( $results[$td]->field_dates['und'][0]['value']) ; } ?></p>
					</div>
				</div>
				<?php endfor ?>
			<a href="<?php print $base_url?>/newsroom/archive/allevents" class="candy_white_button more_news next lft"><span>More GBIF events</span></a>
			</div>
			<div class="right">
				<div class="refine">
					<ul id="more_links">
						<li><a href="<?php print $base_url ?>/search/node/africa">Africa</a></li>
						<li><a href="<?php print $base_url ?>/search/node/asia">Asia</a></li>
						<li><a href="<?php print $base_url ?>/search/node/europe">Europe</a></li>
						<li><a href="<?php print $base_url ?>/search/node/latinamerica">Latin America</a></li>
						<li><a href="<?php print $base_url ?>/search/node/northamerica">North America</a></li>
						<li><a href="<?php print $base_url ?>/search/node/oceania">Oceania</a></li>
					</ul>
				</div>
			</div>
		</div>
		<footer></footer>
	</article>
</div>
<?php get_footer($base_url) ?>
<?php get_bottom_js($base_url) ?>		
</body>