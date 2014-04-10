<?php

/**
 * @file
 * View template for usesofdatafeaturedarticles.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
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
<div class="container well well-lg well-margin-bottom">
<?php if ($requested_path == 'taxonomy/term/565'): ?>
  <div class="row">
    <header class="news-summary col-md-12">
      <h2><?php print $view_title = $view->get_title(); ?></h2>
      <h3><?php print $view->description; ?></h3>
    </header>
  </div>
  <hr class="summary-rule">
<?php endif; ?>
<div class="row">
  <div class="view-content-featured col-md-12">
    <div class="<?php print $classes; ?>">
      <?php if ($rows): ?>
        <div class="view-content">
          <?php print $rows; ?>
        </div>
      <?php elseif ($empty): ?>
        <div class="view-empty">
          <?php print $empty; ?>
        </div>
      <?php endif; ?>

      <hr>
      
      <button type="button" class="btn btn-primary"><a href="/newsroom/archive/alldatausearticles">more featured data uses</a></button>
      
      <?php if ($pager): ?>
        <?php print $pager; ?>
      <?php endif; ?>
      <?php if ($more): ?>
        <?php print $more; ?>
      <?php endif; ?>
      
    </div>
  </div>
    <?php if ($footer): ?>
      <div class="view-footer">
        <?php print $footer; ?>
      </div>
    <?php endif; ?>

    <?php if ($feed_icon): ?>
      <div class="feed-icon">
        <?php print $feed_icon; ?>
      </div>
    <?php endif; ?>

</div><?php /* class view */ ?>
</div>