<?php // fetch some page variables
	global $user;
	global $base_url ;
	global $base_path ;
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
?>
<header>

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

    <div class="info">
      <h1>Global Biodiversity Information Facility</h1>
      <h2>Free and open access to biodiversity data</h2>

      <ul class="counters">
        <li><a href="<?php echo $dataportal_base_url?>/occurrence"><strong id="numOcc">3000000</strong> Occurrences</a></li>
        <li><a href="<?php echo $dataportal_base_url?>/species"><strong id="numSpecies">2000000</strong> Species</a></li>
        <li><a href="<?php echo $dataportal_base_url?>/dataset"><strong>10,028</strong> Datasets</a></li>
        <li><strong>419</strong> Data publishers</li>
      </ul>
    </div>
  
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

      <form>
        <span class="input_text">
          <input type="text" name="q" placeholder="Search GBIF for species, datasets or countries" class="focus">
        </span>
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
          <h1>Latest GBIF news</h1>
        </div>
        <div class="right">
          Go to <a href="<?php print $base_url?>/newsroom/summary">GBIF Newsroom</a>
        </div>
      </div>
      
<?php  
	$results = array() ;
	$view = views_get_view_result('featurednewsarticles');
	foreach ($view as $key => $vnode) {
		$nid = $vnode->nid  ;
		$anode = node_load( $nid ) ;
		$results[$key] = $anode ;
	}
?>
      <div class="featured">
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
        <h3>Upcoming events</h3>

        <ul>

          <li>
          <div class="calendar">
            <div class="month">Sep</div>
            <strong>19</strong>
          </div>
          <div class="location">Lillehammer, Norway</div> 
          <a href="#">GBIF Science Symposium 2012</a>
          </li>

          <li>
          <div class="calendar">
            <div class="month">Sep</div>
            <strong>19</strong>
          </div>
          <div class="location">Lillehammer, Norway</div> 
          <a href="#">GBIF Science Symposium 2012</a>
          </li>

          <li>
          <div class="calendar">
            <div class="month">Sep</div>
            <strong>19</strong>
          </div>
          <div class="location">Lillehammer, Norway</div> 
          <a href="#">GBIF Science Symposium 2012</a>
          </li>

          <li>
          <div class="calendar">
            <div class="month">Sep</div>
            <strong>19</strong>
          </div>
          <div class="location">Lillehammer, Norway</div> 
          <a href="#">GBIF Science Symposium 2012</a>
          </li>

        </ul>

        <a href="#" class="read-more">More</a>

      </div>


    </div>
    <footer></footer>
    </article>



    <article class="featured">
    <header></header>
    <div class="content">
      <div class="header">
        <div class="left">
          <h1>Featured GBIF data use</h1>
        </div>
        <div class="right">
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
			<a class="title" title="<?php print ($results[$td]->title) ?>" href="<?php print $base_url.'/page/'.($results[$td]->nid) ?>"><?php print( smart_trim( $results[$td]->title, 50))?></a>
			<p><?php print ( $results[$td]->body['und'][0]['summary'] ) ; ?></p>
		</li>
	<?php endfor ?>
      </ul>
    </div>
  </div>

  <div class="footer">
    <a href="#">Birds</a> &middot;
    <a href="#">Butterflies</a> &middot;
    <a href="#">Lizards</a> &middot;
    <a href="#">Reptiles</a> &middot;
    <a href="#">Fishes</a> &middot;
    <a href="#">Mammals</a> &middot;
    <a href="#">Insects</a>
  </div>

  <footer></footer>
  </article>


  <article class="next_news">
  <header></header>
  <div class="content">
    <h3>Contribute to gbif</h3>
    <a href=""><h1>Learn how to publish your organization data in GBIF</h1></a>
  </div>
  <footer></footer>
  </article>
</div>



  </div>

<?php get_footer($base_url) ?>

  <!-- JavaScript at the bottom for fast page loading -->
  <!-- scripts concatenated and minified via ant build script  -->
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/jquery-ui-1.8.17.min.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/jscrollpane.min.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/jquery.dropkick-1.0.0.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/jquery.uniform.min.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/mousewheel.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/jscrollpane.min.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/jquery-scrollTo-1.4.2-min.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/underscore-min.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/helpers.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/widgets.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/graphs.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/app.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/raphael-min.js"></script>
  <script type="text/javascript" src="<?php print ($dataportal_base_url); ?>/js/vendor/resourcebundle.js"></script>
  <!-- end scripts-->

  <!--[if lt IE 7 ]>
  <script src="<?php print ($base_url); ?>/js/libs/dd_belatedpng.js"></script>
  <script>DD_belatedPNG
    .fix("img, .png_bg"); // Fix any <img> or .png_bg bg-images. Also, please read goo.gl/mZiyb </script>
  <![endif]-->

  <!-- keep this javascript here so we can use the s.url tag -->
  <script type="text/javascript">
    $(function() {
      $('nav ul li a.more').bindLinkPopover({
        links:{
          "Countries":"/portal/country",
          "GBIF Network":"/portal/member",
          "Themes":"/portal/theme",
          "Statistics":"/portal/stats",
          "About":"<?php print $base_url?>/drupal/about"
        }
      });
    });
  </script>


