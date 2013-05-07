<?php 
	
	$taxon = get_title_data() ;

	global $user;
	global $base_url ;
	global $base_path ;
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;

	$form = drupal_get_form("contact_site_form"); 
	
?>
<?php // print $messages ?>
	<article data-options="autoplay" class="slideshow">
    <header></header>
    <div class="content">
      <div class="header">
        <div class="left">
          <h4>FEATURED</h4>
          <ul class="bullets"></ul>
        </div>
      </div>

	<div class="left data"></div>

      <div class="right"> 
        <ul class="photos">
		</ul>
      </div>

    </div>
    <footer></footer>
    </article>


    <article class="data-use-news">
    <header></header>
    <div class="content">

      <div class="header">
        <div class="left">
          <h2>Featured data use</h2>
          <p>How data accessed through GBIF are being used in science and policy.</p>
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
				<?php print( render( field_view_field('node', $results[$td], 'field_featured', array('settings' => array('image_style' => 'featured'))) ) ); ?>
				<a class="title" title="<?php print ($results[$td]->title) ?>" href="<?php print $base_url.'/page/'.($results[$td]->nid) ?>"><?php print ( smart_trim( $results[$td]->title, 60) ) ?></a>
				<p><?php print ( $results[$td]->body['und'][0]['summary'] ) ; ?></p>
				<div class="ocurrences">
				<?php print ( $results[$td]->field_numofresused['und'][0]['safe_value'] ) ; ?>
				</div>
			</li>
		<?php endfor ?>
        </ul>

        <a href="<?php print( $base_url.'/newsroom/uses' ); ?>" class="candy_white_button more_news next lft"><span>More data use news</span></a>


      </div>


    </div>
    <footer></footer>
    </article>

    <article class="news">
    <header></header>
    <div class="content">

      <div class="header">
        <div class="left">
          <h2>GBIF news</h2>
          <p>Latest stories from around our community</p>
        </div>
      </div>

      <div class="content">
        <div class="left">
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
          <ul>
		<?php for ( $td = 0 ; $td < 3 ; $td++ ) : ?>
			<li>
				<h4 class="date"><?php { print( format_date($results[$td]->created, 'custom', 'F jS, Y')) ; } ?></h4>
				<a href="<?php print $base_url.'/page/'.$results[$td]->nid ?>" class="title"><?php print $results[$td]->title ?></a>
				<p><?php print $results[$td]->body['und'][0]['summary'] ?></p>
				<a href="<?php print $base_url.'/page/'.$results[$td]->nid ?>" class="read_more">Read more</a>
			</li>
		<?php endfor ?>
          </ul>

          <a href="<?php print $base_url?>/newsroom/news" class="candy_white_button more_news next lft"><span>More GBIF news</span></a>
        </div>

        <div class="right">
          <div class="subscribe">
            <h3>GBITS NEWSLETTER</h3>
            <p>Keep up to date with the latest GBIF news by signing up to GBits</p>

            <form action="<?php print $base_url ?>/newsroom/contact" method='post'>
              <div class="input_text">
				<?php print ( render($form['form_build_id']) ) ; print ( render($form['form_id'])) ;  ?>
				<input type="text" id="edit-mail" name="mail" value="" placeholder="Enter your email" maxlength="68" />
				<!-- input type="text" name="q" placeholder="Enter your email" / -->
              </div>
				<a href="" class="candy_blue_button"><span><input type="submit" id="edit-submit" name="op" value="Subscribe" class="form-submit" /></span></a>
              </form>

            

          </div>

        </div>
      </div>


    </div>
    <footer></footer>
    </article>

<?php  
	$results = array() ;
	$view = views_get_view_result('featurednewsarticles');

	foreach ($view as $key => $vnode) {
		$nid = $vnode->nid  ;
		$anode = node_load( $nid ) ;
		$results[$key] = $anode ;
	}

?>
    <script type="text/javascript">
      $(function() {

        var slides = [
		<?php for ( $slide = 0 ; $slide < 5 ; $slide++ ) : ?>
		{
			title: "<?php print ($results[$slide]->title)?>",
			description: "<?php print ( $results[$slide]->body['und'][0]['summary'] ) ; ?>",
			src: "<?php print file_create_url( $results[$slide]->field_featured['und'][0]['uri']);?>",
			url: "<?php print $base_url.'/page/'.($results[$slide]->nid) ?>"
		},
		<?php endfor ?>
        ];

        $(".slideshow").bindArticleSlideshow(slides);

      });

    </script>
  
