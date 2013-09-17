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

	
?>
<?php if ( $view_mode == 'teaser' OR $view_mode == 'teaser_nt' ): ?>
<div class="result">
	<?php if ( $view_mode == 'teaser' ): ?>
	<h3><?php switch ( $type ) { // :-s
		case 'newsarticle' : 
			print ('News item') ;
			break ;
		case 'usesofdata' :
			print ('Featured data use') ;
			break ;
		default :
			print ('Information page');
		}
		?>
	</h3>
	<?php endif ?>
	<h2><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
	<p><?php print ($body[0]['summary']); ?></p>
	<?php if ( $view_mode == 'teaser' ): ?>
	<p>	Also tagged: 
		<?php 
		foreach ( array('field_country','field_regions','field_organizations') as $field ) { 
			print ( render ( field_view_field ('node', $node, $field) ).' ' ) ; 
			
		} ?>
	</p>
	<?php endif ?>
	<div class="footer">
		<p class="date"><?php print( date('F jS, Y',$created) ) . "\n"; ; ?></p>
	</div>
</div>


<?php else: ?>

<article class="detail">
	<header></header>
	<div class="content">
		<div class="header">
			<div class="left">
				<h3>GBIF News</h3>
				<?php if ($title): ?>
					<h1><?php print $title; ?></h1>
				<?php endif; ?>
			</div>
		</div>
		<div class="left">
			<?php
			if ( ! empty ( $node->field_image ) ) {
				print( render( field_view_field('node', $node, 'field_image', array('settings' => array('image_style' => 'mainimage'))) ) );
			}
				print render($content['body']);
			?>
				<?php // var_dump ($content['field_country']) ; print $messages ; ?>
		</div>
		<div class="right">
			<h3>Publication Date</h3>
			<p><?php print( render( format_date($node->created, 'custom', 'F jS, Y '))) ; ?></p>
			<h3>Last Updated</h3>
			<p><?php print( render( format_date($node->changed, 'custom', 'F jS, Y'))) ; ?></p>
			<?php
			if ( ! empty ( $node->field_rhimage ) ) {
				echo '<div class="minimap"> ' ;
				print( render( field_view_field('node', $node, 'field_rhimage', array('settings' => array('image_style' => 'rhimage'))) ) );
				echo '</div> ' ;
				echo '<br />' ;
			
			}
			?>

			
<!--			<div class="contact">
				<div class="contactType">
					Author
				</div>
				<?php	// $node_author = user_load($node->uid); ?>
				<div class="contactName">
					<?php // print( render( $node_author->field_firstname['und'][0]['value']))?>&nbsp;<?php // print( render( $node_author->field_lastname['und'][0]['value'])) ; ?>	
					<br /><a href="mailto:<?php // print( render( $node_author->mail))?>"><?php // print( render( $node_author->mail))?></a><br />
				</div> 
			</div> -->
			<h3>TAGS</h3>
			<ul class='tags'>
			<?php 
			foreach ( array('field_capacity','field_country','field_informatics','field_organizations','field_regions') as $field ) { 
				print ( '<li>'.render ( $content[$field] ).'</li>' ) ; 
				
			} ?>
			</ul>			

		</div>
	</div>

	<footer></footer>
</article>
<article class="next_news">
	<header></header>
	<div class="content">
		<h3>NEXT GBIF NEWS STORY</h3>
		<?php print pn_node($node, 'p'); ?>
	</div>
	<footer></footer>
</article>
<?php endif ?>