<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *	 template_preprocess_views_view(). Default classes are:
 *		 .view
 *		 .view-[css_name]
 *		 .view-id-[view_name]
 *		 .view-display-id-[display_name]
 *		 .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */
?>
<?php 
	global $user;
	global $base_url ;
	global $base_path ;
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
	$taxon = get_title_data() ;
?>
	<article class="results light_pane">
		<header></header>
		<div class="content">
			<div class="header">
				<div class="left"><h2>Complete list of GBIF Resources</h2></div>
				<div class="right"></div>
			</div>
			<div class="left">
				<p><em>Due to a temporary bug in our system, you may not be able to open some resources downloaded from this site. We are working as fast as we can to fix this, and apologize for the inconvenience. 
In the meantime please contact <a href="mailto:info@gbif.org">info@gbif.org</a> with the name of the resource or document, and we will send it to you via email.</em></p>
				<?php print $rows ; ?>
				<?php print $pager?>
			</div>
		</div>
		<footer></footer>
	</article>