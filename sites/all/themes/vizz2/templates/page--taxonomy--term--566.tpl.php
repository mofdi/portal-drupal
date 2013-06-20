<?php 
	
	// $rgr = field_get_items('node',$node,'field_relatedgbifresources') ; dpm($rgr)

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
// dpm($page) ;  
	
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
		<a id="disclaimerToggle" href="/portal/disclaimer">
		<img id="beta" src="http://ecat-dev.gbif.org/img/beta.gif">
		</a>
	<?php get_nav($base_url) ?>
	
    </div>
  </div>
  <!-- /top -->
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
  <article class="news">

  <header></header>

  <div class="content">


<?php  
	$results = array() ;
	$view = views_get_view_result('newsarticles');

	foreach ($view as $key => $vnode) {
		$nid = $vnode->nid  ;
		$anode = node_load( $nid ) ;
		$results[$key] = $anode ;
		// $results[$nid]['fields'] = field_attach_view('node', $anode,'full' ) ; 
		// print render ( $result[$nid]->field_featured  ) ; 
	}

?>

    <div class="content">
      <div class="left">

      
      <ul>
		<?php for ( $td = 0 ; $td < 5 ; $td++ ) : ?>
			<li>
				<h4 class="date"><?php { print( format_date($results[$td]->created, 'custom', 'F jS, Y')) ; } ?></h4>
				<a href="<?php print $base_url.'/page/'.$results[$td]->nid ?>" class="title"><?php print $results[$td]->title ?></a>
				<p><?php print $results[$td]->body['und'][0]['summary'] ?></p>
				<a href="<?php print $base_url.'/page/'.$results[$td]->nid ?>" class="read_more">Read more</a>
			</li>
		<?php endfor ?>


        </ul>



        <a href="<?php print $base_url?>/newsroom/archive/allnewsarticles" class="candy_white_button more_news next lft"><span>More GBIF news</span></a>

      </div>



      <div class="right">



        <div class="filters">

			<h3>Filter news by region</h3>
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

  </div>
  
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