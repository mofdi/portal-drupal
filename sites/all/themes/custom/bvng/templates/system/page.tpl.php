<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
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
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>
<section id="masthead">
  <div id="navbar" class="<?php print $navbar_classes; ?>"><!-- $navbar_classes contains 'container' -->
      <div id="user" class="row">
        <div class="col-md-4 col-md-push-8">
          <?php
            global $base_url;
            if ($user->uid == 0) {
              print l(t('Log in'), 'user/login', array('query' => drupal_get_destination()));
              print ' or <a href="' . $base_url . 'user/register">Create a new account</a>';
            }
            else {
              print t('Hello !username! ', array('!username' => theme('username', array('account' => $user))));
              print l(t('Log out'), 'user/logout', array('attributes' => array('class' => array('logout'))));
            }
          ?>
  			</div>
      </div>
      <div class="row">
        <div id="navigation" class="col-md-8">
      		<div class="navbar-header">
      			<div class="nav-inline">
        		<?php if ($logo): ?>
        		<a class="logo navbar-btn pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
        			<img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        		</a>
        		<?php endif; ?>

        		<?php if (!empty($site_name)): ?>
        		<a class="name navbar-brand" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a>
        		<?php endif; ?>

        		<?php if (!empty($site_slogan)): ?>
        			<p class="lead"><?php print $site_slogan; ?></p>
        		<?php endif; ?>

            <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
        			<!--<div class="navbar-collapse collapse">-->
        		</div>
        			<div class="nav-inline">
          			<nav role="navigation">
              		<?php get_nav(); ?>

          				<?php if (!empty($primary_nav)): ?>
          				<?php print render($primary_nav); ?>
          				<?php endif; ?>
          			</nav>
          		</div>
        			<!--</div>-->
        		<?php endif; ?>
        		
      		</div>
      	</div>
    		<div id="search" class="col-md-4">
  				<?php if (!empty($page['search'])): ?>
  				<?php print render($page['search']); ?>
  				<?php endif; ?>
    		</div>
    	</div>
  </div>
</section>
<section id="banner">
  <div role="banner" class="container">
    <div class="row">
      <div id="region-highlighted" class="col-md-8">
        <h1>
          <?php
            $highlighted_title = bvng_get_title_data();
            print $highlighted_title->name;
          ?> 
        </h1>
        <h5>
          <?php
            print $highlighted_title->description;
          ?>
        </h5>
  			<?php if (!empty($page['highlighted'])): ?>
  			<?php print render($page['highlighted']); ?>
  			<?php endif; ?>
        <!-- 
      	<h1>Region Highlighted</h1>
        <p>Title, subtitle, and occasional contextual search.</p>
        -->
      </div>
      <div id="region-shortcut" class="col-md-4">
        <p>Region Shortcut</p>
      </div>
      <div id="region-menu" class="col-md-8">
  			<?php if (!empty($page['menu'])): ?>
        <?php print render($page['menu']); ?>
  			<?php endif; ?>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumb
	<div class="row">
		<?php // if (!empty($breadcrumb)): print $breadcrumb; endif;?>
	</div>	
-->
<section id="main">
  <?php if(!empty($page['help']) OR !empty($messages) OR !empty($tabs)): ?>
    <div class="container well well-lg">
        <div class="row">
          <p>This area will be decorated in yellow, and it will show/hide accordingly.</p>
          <?php print render($page['help']); ?>
        </div>
    </div>
  <?php endif; ?>

  <div class="container well well-lg well-margin-top">
    <div class="row">
      <section class="col-md-8">
        <a id="main-content"></a>
        <?php print render($title_prefix); ?>
        <?php if (!empty($title)): ?>
          <h2 class="page-header"><?php print $title; ?></h2>
        <?php endif; ?>
        <?php print render($title_suffix); ?>
  			<?php if (!empty($tabs) && user_is_logged_in()): ?>
  				<?php print render($tabs); ?>
  			<?php endif; ?>
        <?php if (!empty($action_links)): ?>
          <ul class="action-links"><?php print render($action_links); ?></ul>
        <?php endif; ?>
        <?php print render($page['content']); ?>
      </section>

      <!-- /#sidebar-second -->
      <?php if (!empty($page['sidebar_second'])): ?>
        <aside class="col-md-4" role="complementary">
          <?php print render($page['sidebar_second']); ?>
          <?php if (!empty($page['navigation'])): ?>
  				<?php print render($page['navigation']); ?>
  				<?php endif; ?>
  				<?php if (!empty($secondary_nav)): ?>
  				<?php print render($secondary_nav); ?>
  				<?php endif; ?>
        </aside>
      <?php endif; ?>

    </div>
  </div>
</section>
<section id="footer">
  <div class="footer container">
    <?php print render($page['footer']); ?>
  </div>
</section>
