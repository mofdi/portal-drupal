<?php 
	
	// $rgr = field_get_items('node',$node,'field_relatedgbifresources') ; dpm($rgr)

	// we ASSUME there is a $node since we are in a template named page--node--something.tpl.php
	// get an array with all the fields for this node
	
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

      <nav>
      <ul>
        <li>
        <a href="#" title="Data">Data</a>

        <div class="data">
          <a href="#"></a>
          <ul>
            <li><a href="<?php print $dataportal_base_url ;?>/occurrence">Occurrences</a></li>
            <li><a href="<?php print $dataportal_base_url ;?>/dataset">Datasets</a></li>
            <li><a href="<?php print $dataportal_base_url ;?>/species">Species</a></li>
            <li class="divider"></li>
            <li><a class="placeholder_temp" href="#">Themes</a></li>
            <li><a class="placeholder_temp" href="#">Statistics</a></li>
            <li><a class="placeholder_temp" href="#">GBIF Data usage</a></li>
            <li class="divider"></li>
            <li><a class="placeholder_temp" href="#">Publish your data</a></li>
            <li><a class="placeholder_temp" href="#">Publishing workflow</a></li>
          </ul>
        </div>

        </li>

        <li>
        <a class="placeholder_temp" href="#" title="Community">Community</a>

        <div class="community">
          <a href="#"></a>
          <ul>
            <li><a class="placeholder_temp" href="#">Regions</a></li>
            <li><a class="placeholder_temp" href="#">Countries</a></li>
            <li><a class="placeholder_temp" href="#">Participant organizations</a></li>
            <li><a class="placeholder_temp" href="#">Data publishers</a></li>
            <li class="divider"></li>
            <li><a class="placeholder_temp" href="#">Capacity bulding</a></li>
            <li><a class="placeholder_temp" href="#">Training</a></li>
            <li><a class="placeholder_temp" href="#">BIF building</a></li>
            <li><a class="placeholder_temp" href="#">Whitepages</a></li>
          </ul>
        </div>

        </li>

        <li>
        <a href="#" title="About GBIF">About GBIF</a>
		<?php global $base_url; ?>
        <div class="about">
          <a href="#"></a>
          <ul>
            <li><a href="<?php echo $base_url?>/newsroom/summary">GBIF Newsroom</a></li>
            <li class="divider"></li>
            <li><a class="placeholder_temp" href="<?php echo $base_url?>/key_partners">Key partners</a></li>
            <li><a class="placeholder_temp" href="<?php echo $base_url?>/miss_tab1">Mission</a></li>
            <li><a class="placeholder_temp" href="#">Governance details</a></li>
            <li><a class="placeholder_temp" href="#">Work programs</a></li>
            <li><a class="placeholder_temp" href="<?php echo $base_url?>/kf1_tab1">Key facts</a></li>
            <li class="divider"></li>
            <li><a href="/portal-web-dynamic/developer">Developer API</a></li>
          </ul>
        </div>

        </li>

        <li class="search">
        <form href="/drupal/sites/all/themes/vizz2/dataset/search" method="GET">
          <span class="input_text">
            <input type="text" name="q"/>
          </span>
        </form>
        </li>
      </ul>
      </nav>
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


    <article class="detail">

      <header></header>

      <div class="content">

        <div class="header">

          <div class="left">

            <h1> How data accessed through GBIF are being used </h1>

          </div>

        </div>

        <div class="usesMap">

          <img src="<?php print $base_url ; ?>/sites/default/files/mapdummy.jpg"></img>

        </div>

      </div>

    </article>

    <article class="data-use-news">

      <header></header>


<?php print $messages ?>

      <div class="content">

        <div class="inner clean">

			<?php  
			$results = array() ;
			$view = views_get_view_result('usesofdatafeaturedarticles');

			foreach ($view as $key => $vnode) {
				$nid = $vnode->nid  ;
				$anode = node_load( $nid ) ;
				$results[$key] = $anode ;

			}

		?>

         <ul>
			<?php for ( $td = 0 ; $td < 3 ; $td++ ) : ?>
			<li class="<?php  if ( (($td + 1) % 3 ) == 0 ) echo 'last' ; ?>">
				<?php print( render( field_view_field('node', $results[$td], 'field_featured', array('settings' => array('image_style' => 'featured'))) ) ); ?>
				<!-- img class='detect' src="<?php print file_create_url( $results[$td]->field_featured['und'][0]['uri']); ?>"></img -->
				<a class="title" title="<?php print ($results[$td]->title)?>" href="<?php print $base_url.'/page/'.($results[$td]->nid) ?>"><?php print ( smart_trim ($results[$td]->title, 50) )?></a>
				<p><?php print ( $results[$td]->body['und'][0]['summary'] ) ; ?></p>
				<div class="ocurrences">
				<?php print ( $results[$td]->field_numofresused['und'][0]['safe_value'] ) ; ?>
				</div>
			</li>
			<?php endfor ?>
          </ul>


         <ul>
			<?php for ( $td = 3 ; $td < 6 ; $td++ ) : ?>
			<li class="<?php  if ( (($td + 1) % 3 ) == 0 ) echo 'last' ; ?>">
				<?php print( render( field_view_field('node', $results[$td], 'field_featured', array('settings' => array('image_style' => 'featured'))) ) ); ?>
				<a class="title" title="<?php print ($results[$td]->title)?>" href="<?php print $base_url.'/page/'.($results[$td]->nid) ?>"><?php print ( smart_trim ($results[$td]->title, 50) )?></a>
				<p><?php print ( $results[$td]->body['und'][0]['summary'] ) ; ?></p>
				<div class="ocurrences">
				<?php print ( $results[$td]->field_numofresused['und'][0]['safe_value'] ) ; ?>
				</div>
			</li>
			<?php endfor ?>
          </ul>


          <div class="buttonContainer">
            <a href="<?php print $base_url?>/archive/alldatausearticles" class="candy_white_button more_news next lft" href="/newsroom/news">
              <span>More data use news</span>
            </a>

          </div>

        </div>

      </div>

	<footer></footer>
    </article>





  </div>
  
		
<footer>
<div class="inner">
<ul>
	<li><h3>EXPLORE THE DATA</h3></li>
	<li><a href="#">Occurrences</a></li>
	<li><a href="#">Datasets</a></li>
	<li><a href="#">Species</a></li>
	<li><a href="#">Countries</a></li>
	<li><a href="#">GBIF Network</a></li>
	<li><a href="#">Themes</a></li>
</ul>
<ul>
	<li><h3>VIEW THE STATISTICS</h3></li>
	<li><a href="#">Global numbers</a></li>
	<li><a href="#">Taxonomic coverage</a></li>
	<li><a href="#">Providers</a></li>
	<li><a href="#">Countries</a></li>
</ul>
<ul class="last">
	<li><h3>JOIN THE COMMUNITY</h3></li>
	<li><a href="#">Create a new account</a></li>
	<li><a href="#">Share your data</a></li>
	<li><a href="#">Terms and Conditions</a></li>
	<li><a href="#">About</a></li>
</ul>
</div>
</footer>
<div class="contact_footer">
<div class="inner">
	<!--<p>2012 &copy; GBIF. Data publishers retain all rights to data.</p>-->
	<div class="copyright">
	<div class="logo"></div>
	<p>2011 © GBIF</p>
	</div>

	<div class="address">
	<h3>GBIF Secretariat</h3>

	<address>
		Universitetsparken 15<br />
		DK-2100 Copenhagen Ø<br />
		DENMARK
	</address>
	</div>

	<div class="contact">
	<h3>Contact</h3>
	<ul>
		<li><strong>Email</strong> info@gbif.org</li>
		<li><strong>Tel</strong> +45 35 32 14 70</li>
		<li><strong>Fax</strong> +45 35 32 14 80</li>
	</ul>
	<p>
	You can also check the <a href="#">GBIF Directory</a>
	</p>

	</div>


</div>
</div>

  <!-- JavaScript at the bottom for fast page loading -->
  <!-- scripts concatenated and minified via ant build script  -->
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/vendor/autocomplete.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/vendor/jquery.uniform.min.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/vendor/mousewheel.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/vendor/jscrollpane.min.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/vendor/jquery-scrollTo-1.4.2-min.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/vendor/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/vendor/underscore-min.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/helpers.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/widgets.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/graphs.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/app.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/vendor/raphael-min.js"></script>
  <script type="text/javascript" src="<?php print ($base_url); ?>/sites/all/themes/vizz2/js/vendor/resourcebundle.js"></script>
  <!-- end scripts-->

  <!--[if lt IE 7 ]>
  <script src="/portal-web-dynamic/js/libs/dd_belatedpng.js"></script>
  <script>DD_belatedPNG
    .fix("img, .png_bg"); // Fix any <img> or .png_bg bg-images. Also, please read goo.gl/mZiyb </script>
  <![endif]-->

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



