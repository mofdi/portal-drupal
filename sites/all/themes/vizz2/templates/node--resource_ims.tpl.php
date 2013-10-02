<?php
/**
 * @file
 * Zen theme's implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   - view-mode-[mode]: The view mode, e.g. 'full', 'teaser'...
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 *   The following applies only to viewers who are registered users:
 *   - node-by-viewer: Node is authored by the user currently viewing the page.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $pubdate: Formatted date and time for when the node was published wrapped
 *   in a HTML5 time element.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content. Currently broken; see http://drupal.org/node/823380
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see zen_preprocess_node()
 * @see template_process()
 */
	global $user;
	global $base_url ;
	global $base_path ;
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
	$ims_orc_url = "http://imsgbif.gbif.org/CMS_ORC/";
	$dlsize = ( $node->field_size_text['und'][0]['value']!='') ? ' ('.$node->field_size_text['und'][0]['value'].')' : '' ;
?>
<?php if ( $view_mode == 'teaser' OR $view_mode == 'teaser_nt' ): ?>
<div class="result">
	<h2><a href="<?php print $node_url; ?>"><?php print htmlspecialchars_decode( $title ); ?></a></h2>
	<p><?php print ( $body[0]['summary']) ?></p>
	<?php if ( $view_mode == 'teaser' ): ?>
	<?php endif ?>
	<div class="footer">
		<p class="date"><?php print (render( format_date($node->field_publishing_date['und'][0]['value'], 'custom', 'F jS, Y '))); ?></p>
	</div>
</div>

<?php else: ?>

<article class="detail">
	<header></header>
	<div class="content">
	<div class="header">
		<div class="left">
			<h3><?php echo t('Resource details'); ?></h3>
			<?php if ($title): ?>
				<h1><?php print htmlspecialchars_decode($title); ?></h1>
			<?php endif; ?>
			<?php if ((! empty ( $node->field_alternative_title["und"][0]["value"] )) && ($node->field_alternative_title["und"][0]["value"] != $title)) { ?>		
				<p><?php print htmlspecialchars_decode($node->field_alternative_title["und"][0]["value"]); ?></p>
			<?php } ?>                
		</div>
		<div class="right db">
		<!-- Download button? !-->         

		</div>
	</div>
		<div class="left">				
			<?php if (render($content['body']) != " ") { ?>
			<h3><?php echo t('Description'); ?></h3>
			<p><?php
				print htmlspecialchars_decode(render($content['body'])); ?></p>
			<?php } ?>
			<?php if (render($content['field_authors']) != " ") { ?>
			<h3><?php echo t('Author(s)'); ?></h3>
			<p><?php
				print htmlspecialchars_decode(render($content['field_authors'])); ?></p>
			<?php } ?>
			<?php if (render($content['field_publisher']) != "") { ?>
			<h3><?php echo t('Publisher(s)'); ?></h3>
			<p><?php
				print substr(htmlspecialchars_decode(render($content['field_publisher'])),0,-1).", "; 
				if ($content['field_publishing_date'] != "")
					{ echo render($content['field_publishing_date']);	}					
				?></p>
			<?php } ?>
			<?php if (render($content['field_target_audience']) != " ") { ?>
			<h3><?php echo t('Target audience'); ?></h3>
			<p><?php
				print htmlspecialchars_decode(render($content['field_target_audience'])); ?></p>		
			<?php } ?>
			<?php if (render($content['field_abstract']) != " ") { ?>
			<h3><?php echo t('Abstract'); ?></h3>
			<p><?php
				print htmlspecialchars_decode(render($content['field_abstract'])); ?></p>		
			<?php } ?>
			<?php if (render($content['field_bibliographic_citation']) != " ") { ?>
			<h3><?php echo t('Bibliographic citation'); ?></h3>
			<p><?php
				print htmlspecialchars_decode(render($content['field_bibliographic_citation'])); ?></p>
			<?php } ?>
			<?php if (render($content['field_contributors']) != " ") { ?>
			<h3><?php echo t('Contributor(s)'); ?></h3>
			<p><?php
				print htmlspecialchars_decode(render($content['field_contributors'])); ?></p>
			<?php } ?>
			<?php if (render($content['field_rights']) != " ") { ?>
			<h3><?php echo t('Rights'); ?></h3>
			<p><?php
				print htmlspecialchars_decode(render($content['field_rights'])); ?></p>
			<?php } ?>
			<?php if (render($content['field_rights_holder']) != " ") { ?>
			<h3><?php echo t('Rights holder'); ?></h3>
			<p><?php
				print htmlspecialchars_decode(render($content['field_rights_holder'])); ?></p>
			<?php } ?>                               

		<?php print $messages ; ?>

		</div>
		<div class="right">

		<?php if ($node->field_orc_featured["und"][0]["value"] == 1) { ?>		
			<h2><?php echo t('Featured resource!'); ?></h2>
		<?php } ?>  
		
		<?php if (! empty ( $node->field_orc_resource_thumbnail )) { ?>
		<a href="http://imsgbif.gbif.org/CMS_ORC/?doc_id=<?php echo $node->field_orc_original_ims_id['und'][0]['value']; ?>&download=1" title="">
		<?php  $tags['field_orc_resource_thumbnail'][0]['#item']['attributes']['css'] = 'mainImage' ; print render ( field_view_field('node', $node, 'field_orc_resource_thumbnail') ); ?>
		</a>
		<?php  } ?>
		<p><a href="http://imsgbif.gbif.org/CMS_ORC/?doc_id=<?php echo $node->field_orc_original_ims_id['und'][0]['value']; ?>&download=1" title=""><span>Download<?php print $dlsize ?></span></a></p>

		<?php if ((! empty ( $node->field_regions )) OR (! empty ( $node->field_country )) OR(! empty ( $node->field_regions ))){ ?>		
			<h3><?php echo t('Tags'); ?></h3>
			<p>
			<?php print ( render ( field_view_field ('node', $node, 'field_regions') ) ) ; ?>
			<?php print ( render ( field_view_field ('node', $node, 'field_country') ) ) ; ?>
			</p>
		<?php } ?>                        
		</div>
	</div>
	<footer></footer>
</article>
<?php endif ?>