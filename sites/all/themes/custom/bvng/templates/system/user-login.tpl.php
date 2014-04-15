<?php
/**
 * @file
 * Default theme implementation to user login page.
 */
?>
<div class="row user-login-row">
  <div class="subscribe col-md-8">
    <?php
      print drupal_render($form['name']);
      print drupal_render($form['pass']);
      print drupal_render($form['form_build_id']);
      print drupal_render($form['form_id']);
    ?>
  </div>
</div>
<div class="row user-login-action">
  <div class="col-md-8">
    <?php print drupal_render($form['actions']); ?>
    <p>Forgot your password?</p>
    <p>Do you need to sign up? <a href="#">Create your account</a></p>
  </div>
</div>
