<?php $dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ; ?>
<form action="" autocomplete="off" >
	<article class="results light_pane">
		<input type="hidden" name="q" value=""/>
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
					<p>This search result page only covers the text content of the GBIF news site for the moment.</p>
					<p>If you're looking for the GBIF data, start here:</p>
					<div class="facet">
						<ul id="">
						<li><a href="<?php print ($dataportal_base_url) ?>/dataset">Publishers and datasets</a></li>
						<li><a href="<?php print ($dataportal_base_url) ?>/country">Countries</a></li>
						<li><a href="<?php print ($dataportal_base_url) ?>/occurrence">Occurrences</a></li>
						<li><a href="<?php print ($dataportal_base_url) ?>/species">Species</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<footer></footer>
	</article>
</form>

