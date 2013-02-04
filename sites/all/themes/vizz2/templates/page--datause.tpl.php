<?php
/**
 * @file
 * Zen theme's implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $secondary_menu_heading: The title of the menu used by the secondary links.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['navigation']: Items for the navigation region, below the main menu (if any).
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['footer']: Items for the footer region.
 * - $page['bottom']: Items to appear at the bottom of the page below the footer.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see zen_preprocess_page()
 * @see template_process()
 */
?>

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

	// $view = views_get_view();

	// dpm($view);

?>
<hr><hr><hr>
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
    <header>
    </header>

    <div class="content">

<?php print $messages ?>
      <div class="header">
        <div class="left">
			<h3>GBIF News</h3>
			<?php if ($title): ?>
				<h1><?php print $title; ?></h1>
			<?php endif; ?>
        </div>
      </div>
			
	<div class="left">

		<?php print render($page['content']); ?>

	</div>

      <div class="right">


        <ul>
		<?php if ($node) { ?>
          <li>
          <h4>DATE OF PUBLICATION</h4>
          <span class="date"><?php { print( render( format_date($node->created, 'custom', 'F jS, Y'))) ; } ?></span>
          </li>
          <li>
          <h4>LAST UPDATED</h4>
          <span class="date"><?php { print( render( format_date($node->changed, 'custom', 'F jS, Y'))) ; } ?></span>
          </li>
          <li>
          <h4>AUTHOR</h4>
			<?php	$node_author = user_load($node->uid); ?>

          <address>
            <strong><?php print( render( $node_author->field_firstname['und'][0]['value']))?>&nbsp;<?php print( render( $node_author->field_lastname['und'][0]['value'])) ; ?></strong><br />
            <a href="mailto:<?php print( render( $node_author->mail))?>"><?php print( render( $node_author->mail))?></a><br />
            1-215-299-1161
          </address>
          </li>
		<?php } ?>
          <li>
          <h4>TAGS</h4>

          <ul class="tags">
			<?php  
				if ( $node ) { 
					$tags = field_attach_view('node', $node,'full' ) ; 
					$my_fields = preg_grep ( "/^field.*/", array_keys( $tags ) ) ; 
					foreach ( $my_fields as $fieldname ) { 
									if ( $fieldname != 'field_taxanavigation' AND $fieldname != 'field_citationinformation' ) { print( render ( $tags[ $fieldname ] ) ) ; } } } ?>
          </ul>

          </li>

          <li>
          <a href="#"><img src="/portal-web-dynamic/img/tmp/insects.png" /></a>
          <span class="description">Brown marmorated stink bugs</span>
          </li>
        </ul>
      </div>
    </div>

    <footer></footer>
    </article>

<?php if ($node) { ?>
    <article class="next_news">
      <header></header>
      <div class="content">
        <h3>NEXT GBIF NEWS</h3>
        <a href=""><h1>A new vision for harnesing data about life on earth</h1></a>
      </div>
      <footer></footer>
    </article>
<?php } ?>

  </div>


  <?php print render($page['footer']); ?>

  

</div><!-- /#page -->