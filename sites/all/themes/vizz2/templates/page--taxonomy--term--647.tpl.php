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
			<div class="left"><h2>Recently added resources</h2></div>
		</div>
			<div class="left">
				<?php foreach ( $results as $result) : ?>
				<div class="result">
					<h2><a href="<?php print $base_url.'/page/'.$result->nid ?>"><?php print $result->title ?></a></h2>
					<p><?php print $result->field_city['und'][0]['value'] ?>, <?php print $result->field_venuecountry['und'][0]['value'] ?></p>
					<div class="footer">
						<p class="date"><?php { print( $result->field_dates['und'][0]['value']) ; } ?></p>
					</div>
				</div>
				<?php endforeach ?>
			<a href="<?php print $base_url?>/newsroom/archive/allevents" class="candy_white_button more_news next lft"><span>Past events</span></a>
			</div>

		</div>
		<footer></footer>
	</article>
</div>




<article class="resource">
	<header></header>
	<div class="content">
	<div class="content">
	<div class="left">

	<h1><?php echo t('Upcoming events'); ?></h1>

	<ul>
	<?php for ( $td = 0 ; $td < 5 ; $td++ ) : ?>
	<?php if (!empty($results[$td]->title)) { ?>
	<li><h4 class="date"><?php { print( $results[$td]->field_dates['und'][0]['value'] ) ; } ?></h4>
	<a href="<?php print $base_url.'/page/'.$results[$td]->nid ?>" class="title"><?php print $results[$td]->title ?></a>
	<p><?php print $results[$td]->body['und'][0]['summary'] ?></p>
	<a href="<?php print $base_url.'/page/'.$results[$td]->nid ?>" class="read_more">Read more</a>
	</li>
	<?php } ?>
	<?php endfor ?>
	</ul>
	</div>
	<div class="right">
	<div class="filters">
	<h3>Filter by region</h3>
	<ul>
	<li><!--  class="selected" --><a href="<?php print $base_url ?>/allnewsarticles">All news</a></li>
	<li><a href="<?php print $base_url ?>/newsroom/archive/allnewsarticles/africa">Africa</a></li>
	<li><a href="<?php print $base_url ?>/newsroom/archive/allnewsarticles/asia">Asia</a></li>
	<li><a href="<?php print $base_url ?>/newsroom/archive/allnewsarticles/europe">Europe</a></li>
	<li><a href="<?php print $base_url ?>/newsroom/archive/allnewsarticles/latinamerica">Latin America</a></li>
	<li><a href="<?php print $base_url ?>/newsroom/archive/allnewsarticles/northamerica">North America</a></li>
	<li><a href="<?php print $base_url ?>/newsroom/archive/allnewsarticles/oceania">Oceania</a></li>
	</ul>
	</div>
	</div>
	</div>
	</div>   
	<footer></footer>
</article>
  
	<article class="news">
		<header></header>
		<div class="content">  
			<div class="left">
				<h1><?php echo t('Search events'); ?></h1>
				<!-- insert search form here !-->
				<a href="<?php print $base_url?>/newsroom/archive/allnewsarticles" class="candy_white_button more_news next lft"><span>Search</span></a>
			</div>
		</div>
		<footer></footer>  
	</article>
 </div>
<?php get_footer($base_url) ?>
<?php get_bottom_js($base_url) ?>		
</body>