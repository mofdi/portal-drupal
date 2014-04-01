<?php
/**
 * @file
 * Default theme implementation to user login page.
 */
?>
<div class="container well well-lg well-margin-top well-margin-bottom">
  <div class="row">
    <div class="col-md-12">
      test login
      <?php print render(drupal_get_form('user_login')); ?>
    </div>
  </div>
</div>