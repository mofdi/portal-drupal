<?php // fetch some page variables
	global $user;
	global $base_url ;
	global $base_path ;
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
	$search_form = drupal_get_form('search_form') ; 
?>
<header>
  <div id="homepageMap"></div>
  <!-- top -->
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
      <a href="<?php print $base_url;?>" class="logo"></a>
    </div>

    <div id="metrics">
      <h1>Global Biodiversity Information Facility</h1>
      <h2>Free and open access to biodiversity data</h2>

      <ul class="counters">
        <li><a href="<?php echo $dataportal_base_url?>/occurrence"><strong id="countOccurrences">?</strong> Occurrences</a></li>
        <li><a href="<?php echo $dataportal_base_url?>/species"><strong id="countSpecies">?</strong> Species</a></li>
        <li><a href="<?php echo $dataportal_base_url?>/dataset"><strong id="countDatasets">?</strong> Datasets</a></li>
        <li><a href="<?php echo $dataportal_base_url?>/publisher/search"><strong id="countPublishers">?</strong> Data publishers</a></li>
      </ul>
    </div>

		<a class="disclaimerToggle" href="/portal/disclaimer">
		<img src="<?php echo $dataportal_base_url?>/img/beta.gif">
		</a>
	<?php get_nav($base_url) ?>

    </div>
  </div>
  <!-- /top -->




  </header>


  <div id="content">

    <div class="container">

    <article class="search">

    <header>
    </header>

    <div class="content">

      <ul>
        <li>
			<h3>Sharing biodiversity data for re-use</h3>
        <ul>
          <li><a href="#">Why publish your data?</a></li>
          <li><a href="#">How to publish your data</a></li>
          <li><a href="#">Data papers</a></li>
        </ul>
        </li>

        <li>
        <h3>Providing evidence for research and decisions</h3>
        <ul>
          <li><a href="#">How to use data from GBIF </a></li>
          <li><a href="#">Who’s using data from GBIF?</a></li>
          <li><a href="#">GBIF and biodiversity targets</a></li>
        </ul>
        </li>

        <li>
        <h3>Collaborating as a global community</h3>
        <ul>
          <li><a href="#">Who funds GBIF?</a></li>
          <li><a href="#">Why join GBIF?</a></li>
          <li><a href="#">Regional collaboration</a></li>
        </ul>
        </li>

      </ul>
    </div>
    <div class="footer">
		
		<form action="/search/node" method="post" id="search-form">
	        <span class="input_text">
			  <input id="edit-keys"  type="text" name="keys" value="<?php print ($search_form['basic']['keys']['#default_value']) ; ?>" autocomplete="off" placeholder="Search news items and information pages..."/>
	        </span>
			<input type="hidden" name="form_build_id" value="<?php print ($search_form['#build_id']) ?>" />
			<input type="hidden" name="form_token" value="<?php print ($search_form['form_token']['#default_value']) ?>" />
			<input type="hidden" name="form_id" value="search_form" />
			<input type="hidden" id="edit-submit" name="op" value="Search" class="form-submit" />
			<button class="search_button"><span>Search</span></button>
		</form>
    </div>
    <footer></footer>
    </article>

    <article class="latest-news">

    <header></header>

    <div class="content">

      <div class="header">
        <div class="left">
          <h2>Latest GBIF news</h2>
        </div>
        <div class="right seeall">
          Go to <a href="<?php print $base_url?>/newsroom/summary">GBIF Newsroom</a>
        </div>
      </div>
      
      <div class="featured">
		<?php  
			$results = array() ;
			$view = views_get_view_result('featurednewsarticles');
			foreach ($view as $key => $vnode) {
				$nid = $vnode->nid  ;
				$anode = node_load( $nid ) ;
				$results[$key] = $anode ;
			}
		?>
      
        <h3>Featured story</h3>
		<a class="title" href="<?php print $base_url.'/page/'.($results[0]->nid) ?>"><?php print ($results[0]->title)?></a>
		<?php print( render( field_view_field('node', $results[0], 'field_featured', array('settings' => array('image_style' => 'featured'))) ) ); ?>
		<p><?php print ( $results[0]->body['und'][0]['summary'] ) ; ?></p>
        <a href="<?php print $base_url.'/page/'.($results[0]->nid) ?>">Read more</a>
      </div>

      <div class="latest">
        <h3>Latest news</h3>

		<?php  
			$results = array() ;
			$view = views_get_view_result('newsarticles');

			foreach ($view as $key => $vnode) {
				$nid = $vnode->nid  ;
				$anode = node_load( $nid ) ;
				$results[$key] = $anode ;
			}
		?>
			<ul>
		<?php for ( $td = 0 ; $td < 4 ; $td++ ) : ?>
			<li>
			<div class="date"><?php { print( format_date($results[$td]->created, 'custom', 'F jS, Y')) ; } ?></div>
			<a href="<?php print $base_url.'/page/'.$results[$td]->nid ?>" class="title"><?php print $results[$td]->title ?></a>
			</li>
		<?php endfor ?>        
			</ul>

        <a href="<?php print $base_url?>/newsroom/news" class="read-more">More</a>
      </div>

	<div class="upcoming">
		<?php  
		$results = array() ;
		$view = views_get_view_result('viewallevents','page_1');
		foreach ($view as $key => $vnode) {
			$nid = $vnode->nid  ;
			$anode = node_load( $nid ) ;
			$events[$key] = $anode ;
		}
		?>
        <h3>Upcoming events</h3>
        <ul>
		<?php for ( $td = 0 ; $td < 4 ; $td++ ) : ?>
			<li>
				<div class="calendar">
				<div class="month"><?php print (date ('M',$events[$td]->field_start_date['und'][0]['value']) )?></div>
				<strong><?php print (date ('d',$events[$td]->field_start_date['und'][0]['value']) )?></strong>
				</div>
				<div class="location"><a title="<?php print $events[$td]->title ;?>" href="<?php print $base_url.'/page/'.$events[$td]->nid ?>"><?php print ( smart_trim($events[$td]->title, 55, $ending='...', $exact=false,$considerHtml = false)) ?></a></div>
			</li>
		<?php endfor ?>
        </ul>
        <a href="<?php print $base_url?>/newsroom/events" class="read-more">More</a>
	</div>


    </div>
    <footer></footer>
    </article>



    <article class="featured">
    <header></header>
    <div class="content">
      <div class="header">
        <div class="left">
          <h2>Featured GBIF data use</h2>
        </div>
        <div class="right seeall">
          See all <a href="<?php print $base_url?>/newsroom/uses">GBIF data use stories</a>
        </div>
      </div>
      <div class="inner">

		<ul>
<?php
$results = array() ;
$view = views_get_view_result('usesofdatafeaturedarticles');
foreach ($view as $key => $vnode) {
	$nid = $vnode->nid  ;
	$anode = node_load( $nid ) ;
	$results[$key] = $anode ;
} 
?>
	<?php for ( $td = 0 ; $td < 3 ; $td++ ) : ?>
		<li class="<?php  if ( (($td + 1) % 3 ) == 0 ) echo 'last' ; ?>">
			<a href="<?php print $base_url.'/page/'.($results[$td]->nid) ?>">
			<?php print( render( field_view_field('node', $results[$td], 'field_featured', array('settings' => array('image_style' => 'featured'))) ) ); ?>
			</a>
			<a class="title" title="<?php print ($results[$td]->title) ?>" href="<?php print $base_url.'/page/'.($results[$td]->nid) ?>"><?php print( smart_trim( $results[$td]->title, 60))?></a>
			<p><?php print ( $results[$td]->body['und'][0]['summary'] ) ; ?></p>
		</li>
	<?php endfor ?>
      </ul>
    </div>
  </div>

  <div class="footer">
    <a href="<?php echo $dataportal_base_url?>/species/1">Animals</a> &middot;
    <a href="<?php echo $dataportal_base_url?>/species/6">Plants</a> &middot;
    <a href="<?php echo $dataportal_base_url?>/species/5">Fungi</a> &middot;
    <a href="<?php echo $dataportal_base_url?>/species/3">Bacteria</a> &middot;
    <a href="<?php echo $dataportal_base_url?>/species/2">Archaea</a>
  </div>

  <footer></footer>
  </article>

</div>



  </div>

<?php get_footer($base_url) ?>
<?php get_bottom_js($base_url) ?>
