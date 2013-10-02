<?php 
	
	// Fetch some data from the navigation taxonomy in order to use it for the page title
	// via custom function in template.php
	$taxon = get_title_data() ;

	global $user;
	global $base_url ;
	global $base_path ;
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
	
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

        <h1><a href="<?php print $base_url;?>" title="GBIF.ORG">GBIF.ORG</a></h1>
        <span>Free and open access to biodiversity data</span>
      </div>

		<a class="disclaimerToggle" href="/portal/disclaimer">
		<img src="<?php echo $dataportal_base_url?>/img/beta.gif">
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


    <article class="detail">

      <header></header>

      <div class="content">

        <div class="header">

          <div class="left">

            <h1>Featured uses of data accessed through GBIF</h1>

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
				<a class="title" title="<?php print ($results[$td]->title)?>" href="<?php print $base_url.'/page/'.($results[$td]->nid) ?>"><?php print ( smart_trim ($results[$td]->title, 60) )?></a>
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
				<a class="title" title="<?php print ($results[$td]->title)?>" href="<?php print $base_url.'/page/'.($results[$td]->nid) ?>"><?php print ( smart_trim ($results[$td]->title, 60) )?></a>
				<p><?php print ( $results[$td]->body['und'][0]['summary'] ) ; ?></p>
				<div class="ocurrences">
				<?php print ( $results[$td]->field_numofresused['und'][0]['safe_value'] ) ; ?>
				</div>
			</li>
			<?php endfor ?>
          </ul>


          <div class="buttonContainer">
            <a href="<?php print $base_url?>/newsroom/archive/alldatausearticles" class="candy_white_button more_news next lft" href="/newsroom/news">
              <span>More featured data uses</span>
            </a>

          </div>

        </div>

      </div>

	<footer></footer>
    </article>
  </div>
<?php get_footer($base_url) ?>		
<?php get_bottom_js($base_url) ?>  
</body>