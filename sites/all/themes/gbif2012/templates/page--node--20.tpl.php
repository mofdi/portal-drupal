<?php 
/**
 * @file
 * Alpha's theme implementation to display a single Drupal page.
 */
?>
<div<?php print $attributes; ?>>
  <?php if (isset($page['header'])) : ?>
    <?php print render($page['header']); ?>
  <?php endif; ?>
<section id="section-content" class="section section-content">
	<div id="zone-content-wrapper" class="zone-wrapper zone-content-wrapper clearfix">  
		<div id="zone-content" class="zone zone-content clearfix container-24">    
					<h4 style="margin: 0 0 20px 10px">Newsroom</h4>
			<div class="clearfix container-24">
				<div class="grid-18 region region-content" id="region-content" 
								<h6>GBIF News</h6>
								<?php
								$block = module_invoke('views','block_view','gbif_core_news-block');
								print render($block);
								?>
				</div>
				<div class="grid-6 region region-content" id="region-content" >
								<?php
								$block = module_invoke('views','block_view','Featured-block_1');
								print render($block);
								?>
				</div>
			</div>

			<div class="grid-18">


				<div class="grid-6 region region-content" style='margin-left:0px' id="region-content">
					<div class="region-inner region-content-inner">
						<div class="block-inner clearfix">
							<div class="content clearfix" style="border: 0">
								<h6>Community news</h6>
								<?php
								$block = module_invoke('views','block_view','community_news-block');
								print render($block);
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="grid-6 region region-content" id="region-content">
					<div class="region-inner region-content-inner">
						<div class="block-inner clearfix">
							<div class="content clearfix" style="border: 0">
								<h6>Data Use News</h6>
													<?php
													$block = module_invoke('views','block_view','data_use_news-block');
													print render($block);
													?>
							</div>
						</div>
					</div>
				</div>
				<div class="grid-6 region region-content" id="region-content" style='margin:0px'>
					<div class="region-inner region-content-inner">
						<div class="block-inner clearfix">
							<div class="content clearfix" style="border: 0">
									<h6>Dataset News</h6>
													<?php
													$block = module_invoke('views','block_view','data_set_news-block');
													print render($block);
													?>
							</div>
						</div>
					</div>
				</div>

				<div class="grid-18 region region-content" id="region-content" style='margin:0px'>
					<div class="region-inner region-content-inner">
						<div class="block-inner clearfix">
							<div class="content clearfix" style="border: 0">
									<h6>Upcoming Events</h6>
										<?php
										$block = module_invoke('views','block_view','events-block');
										print render($block);
										?>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="grid-6 region region-content" id="region-content">
				<div class="region-inner region-content-inner">
					<div class="block-inner clearfix">
						<div class="content clearfix" style="border: 0">
										<?php
										$block = module_invoke('views','block_view','AVContent-block') ;
										print render($block);
										?>

					    </div>
					</div>
				</div>
			</div>



		</div>
	</div>
</section>    

  <?php if (isset($page['footer'])) : ?>
    <?php print render($page['footer']); ?>
  <?php endif; ?>
</div>


