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
	
	// $rgr = field_get_items('node',$node,'field_relatedgbifresources') ; dpm($rgr)

	// we ASSUME there is a $node since we are in a template named page--node--something.tpl.php
	// get an array with all the fields for this node
	
	if ($node) {
		$tags = field_attach_view('node', $node,'full' ) ; 
	}

	// Fetch some data from the navigation taxonomy in order to use it for the page title
	// via custom function in template.php
	global $user;
	global $base_url ;
	global $base_path ;
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
	$taxon = get_title_data() ;
// dpm($variables) ;
?>
<article class="news">
	<header></header>
	<div class="content">
		<div class="content">				
			<div class="left">
				<h2><?php $title = $view->get_title() ; if (!empty($title)) {print $title; } ?></h2>
			</div>
			<div class="left">
			<?php if ($rows): ?>
				<ul>
					<?php print $rows; ?>
				</ul>
			<?php endif; ?>
			</div>
			<div class="right">
				<div class="filters">
					<h3>Filter news by region</h3>
					<ul>
					<li><!-- class="selected" --><a href="<?php print $base_url ?>/archive/allnewsarticles">All news</a></li>
					<li><a href="<?php print $base_url ?>/archive/allnewsarticles/africa">Africa</a></li>
					<li><a href="<?php print $base_url ?>/archive/allnewsarticles/asia">Asia</a></li>
					<li><a href="<?php print $base_url ?>/archive/allnewsarticles/europe">Europe</a></li>
					<li><a href="<?php print $base_url ?>/archive/allnewsarticles/latinamerica">Latin America</a></li>
					<li><a href="<?php print $base_url ?>/archive/allnewsarticles/northamerica">North America</a></li>
					<li><a href="<?php print $base_url ?>/archive/allnewsarticles/oceania">Oceania</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="footer">
		<?php if ($pager): ?>
			<?php print $pager; ?>
		<?php endif; ?>
		</div>
	</div>
	<footer></footer>
</article>



