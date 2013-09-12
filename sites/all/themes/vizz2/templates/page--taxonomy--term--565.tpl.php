<?php 

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
			<a href="<?php print $base_url;?>/users/<?php print ($user->name) ?>/edit">Hello <?php print ( $user->name);?></a>
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
          <div class="subscribe"><a id="signup"></a>
            <h3>GBITS NEWSLETTER</h3>
            <p>Download the latest issue of our bimonthly newsletter <a href="http://www.gbif.org/communications/resources/newsletters/">here</a> or keep up to date with the latest GBIF news by signing up to GBits</p>

            <form method="post" action="http://www.jangomail.com/OptIn.aspx">
              <div class="input_text">
              	<input name="optinform$txtUniqueID" id="optinform_txtUniqueID" value="6f1fe36b-52ee-4ac3-a83f-98f800f3c16c" type="hidden">
				<input name="optinform$Field0" id="optinform_Field0" type="text" placeholder="Enter your email (required)" maxlength="68" >
				<input name="optinform$Field5649548" id="optinform_Field5649548" type="text" placeholder="First Name (required)" maxlength="68">
				<input name="optinform$Field5649560" id="optinform_Field5649560" type="text" placeholder="Last Name (required)" maxlength="68">
              </div>
				<a href="#" class="candy_blue_button"><span> <input type="submit" id="optinform_btnSubscribe" name="optinform$btnSubscribe" class="form-submit" value="Subscribe" /></span></a>
															
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
  
  </div> <!--  end <div id="content"> -->

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


