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

<div id="page">

  <header>

    <!-- top -->
    <div id="top">
      <div class="content">
        <div class="account">
            <a href="${cfg.cas}/login?service=${baseUrl}/" title='<@s.text name="menu.login"/>'>Login</a> or
            <a href="${cfg.drupal}/user/register" title='<@s.text name="menu.register"/>'>Create a new account</a>
        </div>

        <div id="logo">
          <a href="/" class="logo"><img src="http://jawa.gbif.org:8080/portal-web/img/header/logo.png"/></a>

          <h1><a href="/" title="DATA.GBIF.ORG">DATA.GBIF.ORG</a></h1>
          <span>Free and open access to biodiversity data</span>
        </div>

        <nav>
          <ul>
            <li><a href="/">Occurrences</a></li>
            <li><a href="/">Datasets</a></li>
            <li><a href="/">Species</a></li>
			<li><a href="#" class="more" title="More">More<span class="more"></span></a></li>            
            <li class="search">
              <form href="#" method="GET">
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
      <ul class="breadcrumb"><li>News</li></ul>
      <h1>Newsroom</h1>
      </div>
    </div>

    <div id="tabs">
      <div class="content">
      </div>
    </div>


    <?php if ($logo): ?>
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
    <?php endif; ?>

    <?php if ($site_name || $site_slogan): ?>
      <hgroup id="name-and-slogan">
        <?php if ($site_name): ?>
          <h1 id="site-name">
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
          </h1>
        <?php endif; ?>

        <?php if ($site_slogan): ?>
          <h2 id="site-slogan"><?php print $site_slogan; ?></h2>
        <?php endif; ?>
      </hgroup><!-- /#name-and-slogan -->
    <?php endif; ?>

    <?php if ($secondary_menu): ?>
      <nav id="secondary-menu" role="navigation">
        <?php print theme('links__system_secondary_menu', array(
          'links' => $secondary_menu,
          'attributes' => array(
            'class' => array('links', 'inline', 'clearfix'),
          ),
          'heading' => array(
            'text' => $secondary_menu_heading,
            'level' => 'h2',
            'class' => array('element-invisible'),
          ),
        )); ?>
      </nav>
    <?php endif; ?>

    <?php print render($page['header']); ?>

  </header>

  <div id="main">

    <div id="content" class="column" role="main">
      <!-- ?php print render($page['highlighted']); ? -->
      <a id="main-content"></a>
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1 class="title" id="page-title"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php print $messages; ?>
      <?php print render($tabs); ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
    </div><!-- /#content -->


    <?php
      // Render the sidebars to see if there's anything in them.
      $sidebar_first  = render($page['sidebar_first']);
      $sidebar_second = render($page['sidebar_second']);
    ?>

    <?php if ($sidebar_first || $sidebar_second): ?>
      <aside class="sidebars">
        <?php print $sidebar_first; ?>
        <?php print $sidebar_second; ?>
      </aside><!-- /.sidebars -->
    <?php endif; ?>

  </div><!-- /#main -->

  <?php print render($page['footer']); ?>

</div><!-- /#page -->

<footer>
    <div class="inner">
      <ul>
        <li><h3>EXPLORE THE DATA</h3></li>
        <li><a href="/occurrence">Occurrences</a></li>
        <li><a href="/dataset">Datasets</a></li>
        <li><a href="/species">Species</a></li>
        <li><a href="/country">Countries</a></li>
        <li><a href="/member">GBIF Network</a></li>
        <li><a href="/theme">Themes</a></li>
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
        <li><a href="http://staging.gbif.org/drupal/user/register">Create a new account</a></li>
        <li><a href="/dataset/register/step1">Share your data</a></li>
        <li><a href="http://staging.gbif.org/drupal/terms">Terms and Conditions</a></li>
        <li><a href="http://staging.gbif.org/drupal/about">About</a></li>
      </ul>

    </div>
  </footer>

  <div class="copyright">
    <div class="inner">
      <p>2012 &copy; GBIF. Data publishers retain all rights to data.</p>
    </div>
  </div>
