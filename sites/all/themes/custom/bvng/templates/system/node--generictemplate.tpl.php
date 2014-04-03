<?php
/**
 * @file
 * Default theme implementation to display a node.
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
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @see bvng_preprocess_node() $cchunks, $anchors and $elinks.
 *
 * @ingroup themeable
 */
?>
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
<?php if (!empty($body)): ?>
<div class="container well well-lg well-margin-top">
  <div class="row">
    <div class="col-md-12">
      <?php if ((!$page && !empty($title)) || !empty($title_prefix) || !empty($title_suffix) || $display_submitted): ?>
      <div class="row">
        <header class="content-header col-md-12">
          <h3><?php print render($type_title); ?></h3>
          <?php print render($title_prefix); ?>
          <?php if (!empty($title)): ?>
          <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
          <?php endif; ?>
          <?php print render($title_suffix); ?>
        </header>
      </div>
      <?php endif; ?>
      <div class="row">
        <div class="node-content col-md-8">
          Generic template in effect.
          <?php if ($display_submitted && user_is_logged_in()): ?>
            <span class="submitted"><?php print $submitted; ?></span>
          <?php endif; ?>
      		<?php if (!empty($tabs) && user_is_logged_in()): ?>
      			<?php print render($tabs); ?>
      		<?php endif; ?>
          <?php print render($body); ?>
        </div>
        <div class="node-sidebar col-md-3">
    			<?php
    			  if (!empty($node->field_image)) {
    				  print render(field_view_field('node', $node, 'field_image', array('settings' => array('image_style' => 'mainimage'))));
    			  }
    			?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
</article>
<?php $cchunks_count = count($cchunks); ?>
<?php foreach ($cchunks as $k => $cchunk): ?>
<?php $top_well = (empty($body) && $k == 0) ? ' well-margin-top': ''; ?>
<?php $last_well = ($k == $cchunks_count - 1) ? ' well-margin-bottom': ''; ?>
<article>
  <div class="container well well-lg<?php print $top_well.$last_well; ?>">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <header class="content-header col-md-12">
    				<?php if (!empty($cchunk->field_title['und']['0']['value'])): ?>
    					<h2><?php print $cchunk->field_title['und']['0']['value']; ?></h2>
    				<?php endif; ?>
          </header>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="node-content col-md-8">
				<?php print token_replace($cchunk->field_sectioncontent['und']['0']['value']); ?>
      </div>
      <div class="node-sidebar col-md-3">
  			<?php if (!empty($anchors[$k]->field_anchorlinkslisttitle['und']['0']['value'])): ?>
  				<h3><?php print $anchors[$k]->field_anchorlinkslisttitle['und']['0']['value'] ?></h3>
  			<?php endif; ?>
  			<?php if ($anchors[$k]->field_anchorlink['und']): ?>
  			  <ul class="tags">
  			    <?php foreach ($anchors[$k]->field_anchorlink['und'] as $anchor): ?>
  			      <?php print '<li><a href="#'.$anchor['link'].'">'.$anchor['title'].'</a></li>'; ?>
  			    <?php endforeach; ?>
  			  </ul>
  			<?php endif; ?>
  			<?php if (!empty($elinks)): ?>
  			  <?php foreach ($elinks as $elink): ?>
  			    <h3><?php print $elink->field_externallinkslisttitle['und']['0']['value']; ?></h3>
  			    <ul class="tags">
  			      <?php foreach ($elink->field_externallink['und'] as $lk => $xlink): ?>
  			        <li>
  			          <?php print l($xlink['title'], $xlink['url']); ?>
  			        </li>
  			      <?php endforeach; ?>
  			    </ul>
  			  <?php endforeach; ?>
  			<?php endif; ?>

      </div>
    </div>

</article>
<?php
  // Hide comments, tags, and links now so that we can render them later.
  hide($content['comments']);
  hide($content['links']);
  hide($content['field_tags']);
?>
<?php endforeach; ?>