<?php
/**
 * @file
 * Default theme implementation to user login page.
 */
?>
<div class="container well well-lg well-margin-top well-margin-bottom">
  <div class="row">
    <div class="col-md-12">
      <?php
        print drupal_render($form['name']);
        print drupal_render($form['pass']);
        print drupal_render($form['form_build_id']);
        print drupal_render($form['form_id']);
        print drupal_render($form['actions']);
      ?>
    </div>
  </div>
</div>