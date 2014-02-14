<?php
/**
 * @file
 * Returns the HTML for the footer region.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728140
 */
  $dataportal_base_url = theme_get_setting('dataportal_base_url','gbifgreen');
?>
<?php if ($content): ?>
  <footer id="footer" class="<?php print $classes; ?>">
    <div id="link_footer">
     <div class="footer">
      <ul>
    		<li><h3>JOIN THE COMMUNITY</h3></li>
    		<li><a href="http://community.gbif.org/">Join GBIF Community Site</a></li>
    		<li><a href="<?php print $base_url; ?>/newsroom/summary/#signup">Sign up to GBits newsletter</a></li>
    		<li><a href="<?php print $base_url; ?>/resources/summary">GBIF Online Resource Centre</a></li>
    	</ul>
    	<ul>
    		<li><h3>WHO’S PARTICIPATING</h3></li>
    		<li><a href="<?php print $dataportal_base_url; ?>/participation/list#voting">Countries</a></li>
    		<li><a href="<?php print $dataportal_base_url; ?>/participation/list#other">Organizations</a></li>
    		<li><a href="<?php print $dataportal_base_url; ?>/publisher/search">Data publishers</a></li>
    	</ul>
    	<ul>
    		<li><h3>KEY DOCUMENTS</h3></li>
    		<li><a href="<?php print $base_url; ?>/disclaimer">Disclaimer</a></li>
    		<li><a href="<?php print $base_url; ?>/disclaimer/datause">Data use agreement</a></li>
    		<li><a href="<?php print $base_url; ?>/disclaimer/datasharing">Data sharing agreement</a></li>
    		<li><a href="<?php print $base_url; ?>/resources/2605">Memorandum of Understanding</a></li>
    		<li><a href="<?php print $base_url; ?>/resources/2262">Annual Report</a></li>
    		<li><a href="<?php print $base_url; ?>/resources/2569">GBIF Strategic Plan</a></li>
    		<li><a href="<?php print $base_url; ?>/resources/2970">GBIF Work Programme</a></li>
    	</ul>
    	<ul class="last">
    		<li><h3>FOR DEVELOPERS</h3></li>
    		<li><a href="<?php print $dataportal_base_url; ?>/developer">Portal API</a></li>
    		<li><a href="http://gbif.blogspot.com">Developer blog</a></li>
        <li><a href="<?php print $dataportal_base_url; ?>/infrastructure/tools">Tools</a></li>
    	</ul>
     </div>
    </div>

    <div id="contact_footer">
      <div class="footer">
        <ul>
        <li><h3>2013 &copy; GBIF</h3></li>
        <li><div class="logo"></div></li>
      </ul>
      <ul>
        <li><h3>GBIF Secretariat</h3></li>
        <li>Universitetsparken 15</li>
        <li>DK-2100 Copenhagen Ø</li>
        <li>DENMARK</li>
      </ul>
      <ul>
        <li><h3>Contact</h3></li>
        <li><strong>Email</strong> info@gbif.org</li>
        <li><strong>Tel</strong> +45 35 32 14 70</li>
        <li><strong>Fax</strong> +45 35 32 14 80</li>
        <li>You can also check the <a href="<?php print $base_url; ?>/contact/directoryofcontacts#secretariat">GBIF Directory</a></li>
      </ul>
      <ul class="social last">
    	  <li><h3>SOCIAL MEDIA</h3></li>
    	  <li class="twitter"><i></i><a href="https://twitter.com/GBIF">Follow GBIF on Twitter</a></li>
    	  <li class="facebook"><i></i><a href="https://www.facebook.com/gbifnews">Like GBIF on Facebook</a></li>
    	  <li class="linkedin"><i></i><a href="http://www.linkedin.com/groups/GBIF-55171">Join GBIF on Linkedin</a></li>
    	  <li class="vimeo"><i></i><a href="http://vimeo.com/gbif">View GBIF on Vimeo</a></li>
      </ul>
     </div>
    </div>
    <?php
      // Contents assigned to the footer region are omitted.
      // print $content;
    ?>
  </footer>
<?php endif; ?>