<?php $dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ; ?>
<article class="results light_pane">
	<header></header>
	<div class="content">
		<div class="header">
			<?php if ($search_results): ?>
			<div class="left"><h2><?php print $search_totals; ?></h2></div>
			<?php else : ?>
			<div class="left"><h2><?php print t('Your search yielded no results');?></h2></div>
			<?php endif; ?>
			<div class="right"><h3>More search options</h3></div>
		</div>
		<div class="left">
			<?php if ($search_results): ?>
				<?php print $search_results; ?>
			<?php print $pager; ?>
			<?php else : ?>
			<p><?php print search_help('search#noresults', drupal_help_arg()); ?></p>
			<?php endif; ?>
		</div>
		<div class="right">
			<div class="refine">
				<p>This search result only covers the text content of the news and information pages of the GBIF portal.</p>
				<p>If you want to search data content, start here:</p>

				<ul id="more_links">
				<li><a href="<?php print ($dataportal_base_url) ?>/dataset">Publishers and datasets</a></li>
				<li><a href="<?php print ($dataportal_base_url) ?>/country">Countries</a></li>
				<li><a href="<?php print ($dataportal_base_url) ?>/occurrence">Occurrences</a></li>
				<li><a href="<?php print ($dataportal_base_url) ?>/species">Species</a></li>
				</ul>

			</div>
		</div>
	</div>
	<footer></footer>
</article>


