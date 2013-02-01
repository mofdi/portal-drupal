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
	

	$taxon = get_title_data() ;

	global $base_path ;
	global $base_url ;


?>	


	<div id="infoband">
		<div class="content">
     
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

<?php // print $messages ?>

      <div class="content">
        <div class="inner clean">
			<?php  
			$results = array() ;
			$view = views_get_view_result('usesofdatafeaturedarticles');
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

            <li class="<?php  if ( (($td + 1) % 3 ) == 0 ) echo 'last' ; ?>">
              <img class='detect' src="<?php print file_create_url( $results[$td]->field_featured['und'][0]['uri']); ?>"></img>
              <a class="title" href="<?php print $base_url.'/node/'.($results[$td]->nid) ?>"><?php print ($results[$td]->title)?></a>
				<?php print ( $results[$td]->body['und'][0]['summary'] ) ; ?>
              <div class="ocurrences">
                <?php print ( $results[$td]->field_numofresused['und'][0]['safe_value'] ) ; ?>
              </div>
            </li>

			<? endfor ?>
          </ul>

         <ul>
			<?php for ( $td = 3 ; $td < 6 ; $td++ ) : ?>

            <li class="<?php  if ( (($td + 1) % 3 ) == 0 ) echo 'last' ; ?>">
              <img class='detect' src="<?php print file_create_url( $results[$td]->field_featured['und'][0]['uri']); ?>"></img>
              <a class="title" href="<?php print $base_url.'/node/'.($results[$td]->nid) ?>"><?php print ($results[$td]->title)?></a>
				<?php print ( $results[$td]->body['und'][0]['summary'] ) ; ?>
              <div class="ocurrences">
                <?php print ( $results[$td]->field_numofresused['und'][0]['safe_value'] ) ; ?>
              </div>
            </li>

			<? endfor ?>
          </ul>

          <div class="buttonContainer">
            <a class="candy_white_button more_news next lft" href="/newsroom/news">
              <span>More data use news</span>
            </a>
          </div>
        </div>
      </div>

    </article>


  </div>