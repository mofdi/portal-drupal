<?php
/**
 * @file
 * Default theme implementation to user login page.
 */
?>
<?php
  print drupal_render($form['name']);
  print drupal_render($form['pass']);
  print drupal_render($form['form_build_id']);
  print drupal_render($form['form_id']);
  print drupal_render($form['actions']);
?>
