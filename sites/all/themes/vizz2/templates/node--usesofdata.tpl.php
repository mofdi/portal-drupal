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
	
	// $rgr = field_get_items('node',$node,'field_relatedgbifresources') ; 

	global $user;
	global $base_url ;
	global $base_path ;
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
	$taxon = get_title_data() ;
	
?>	
<?php if ( $view_mode == 'teaser'): ?>
	<div class="result">
		<h3><?php switch ( $type ) { // :-s
			case 'newsarticle' : 
				print ('News item') ;
				break ;
			case 'usesofdata' :
				print ('Featured data use') ;
				break ;
			default :
				print ('Information page');
			}
			?></h3>
		<h2><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
		<p><?php print ($body[0]['summary']); ?></p>
		<p>	Also tagged: 
			<?php 
			foreach ( array('field_country','field_regions','field_organizations') as $field ) { 
				print ( render ( field_view_field ('node', $node, $field) ).' ' ) ; 
				
			} ?>
		</p>
		<div class="footer">
			<?php print( date('F dS, Y',$created) ) . "\n"; ; ?>
		</div>
	</div>
<?php else: ?>
    <article class="detail">
    <header>
    </header>

    <div class="content">

		<div class="header">
			<div class="left">
				<h3>Featured Data Use</h3>
				<?php if ($title): ?>
					<h1><?php print $title; ?></h1>
				<?php endif; ?>
			</div>
		</div>
			
		<div class="left">
			<?php  $content['field_image'][0]['#item']['attributes']['css'] = 'mainImage' ; print render ( $content['field_image']  ) ; ?>
			<h4 class="subheader"><?php print render( $node->body[$node->language][0]['safe_summary'] ) ; ?></h4>
			<?php print render($content['body']); ?>
		</div>
		<div class="right">
			<?php if ( !empty ( $node->field_publication ) ) {
				echo '<h3>Publication</h3>' ;
				print ( '<p>'.render ( field_view_field ('node', $node, 'field_publication') ).'</p>' ) ; 
			}
			if ( !empty ( $node->field_rhimage ) ) {
				echo '<div class="minimap"> ' ;
				print( render( field_view_field('node', $node, 'field_rhimage', array('settings' => array('image_style' => 'rhimage'))) ) );
				echo '</div> ' ;
				echo '<br />' ;
			}
			if ( !empty ( $node->field_reasearcherslocation ) ) {
				echo '<h3>Location Of Researchers</h3>' ;
				print ( render ( field_view_field ('node', $node, 'field_reasearcherslocation') ) ) ; 
			}
			if ( !empty ( $node->field_studyarea ) ) {
				echo '<h3>Study Area</h3>' ;
				print ( '<p>'.render ( field_view_field ('node', $node, 'field_studyarea') ).'</p>' ) ; 
			}
			if ( !empty ( $node->field_datasources ) ) {
				echo '<h3>Data Sources</h3>' ;
				print ( '<p>'.render ( field_view_field ('node', $node, 'field_datasources') ).'</p>' ) ; 
			}						
			if ( !empty ( $node->field_linkstoresearch ) ) {
				echo '<h3>Links To Research</h3>' ;
				print ( render ( field_view_field ('node', $node, 'field_linkstoresearch') ) ) ; 
			}
			if ( !empty ( $node->field_datausecategories ) ) {
				echo '<h3>Data Use Categories</h3>' ;
				print ( render ( field_view_field ('node', $node, 'field_datausecategories') ) ) ; 
			}									
			?>
			<h3>Tags</h3>
			<ul class='tags'>
			<?php 
			foreach ( array('field_country','field_regions','field_organizations') as $field ) { 
				print ( '<li>'.render ( field_view_field ('node', $node, $field) ).'</li>' ) ; 
				
			} ?>
			</ul>
		</div>
		<?php if ( !empty ( $node->field_citationinformation ) ) : ?>
		<div class="left citation">
			<h3>CITATION INFORMATION</h3>
			<?php print ( render ( field_view_field ('node', $node, 'field_citationinformation') ) )  ?>
		</div>
		<?php endif ?>
		<?php if ( !empty ( $node->field_relatedgbifresources ) ) : ?>
		<div class="related footer">
			<h3>RELATED GBIF RESOURCES</h3>
			<?php print ( render ( field_view_field ('node', $node, 'field_relatedgbifresources') ) ) ;	?>
		</div>
		<?php endif ?>
    </div>
<?php if ( empty ( $node->field_relatedgbifresources ) ) : ?>
		<footer></footer>
<?php endif ?>
	</article>
	<article class="next_news">
		<header></header>
		<div class="content">
			<h3>NEXT FEATURED DATA USE</h3>
			<?php print pn_node($node, 'p'); ?>
		</div>
		<footer></footer>
	</article>
<?php endif ?>


