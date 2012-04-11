<?php
/**
 * @file
 * gbifportal_preset.features.user_permission.inc
 */

/**
 * Implements hook_user_default_permissions().
 */
function gbifportal_preset_user_default_permissions() {
  $permissions = array();

  // Exported permission: access news feeds
  $permissions['access news feeds'] = array(
    'name' => 'access news feeds',
    'roles' => array(
      0 => 'administrator',
      1 => 'anonymous user',
      2 => 'authenticated user',
    ),
    'module' => 'aggregator',
  );

  // Exported permission: search content
  $permissions['search content'] = array(
    'name' => 'search content',
    'roles' => array(
      0 => 'administrator',
      1 => 'anonymous user',
      2 => 'authenticated user',
    ),
    'module' => 'search',
  );

  // Exported permission: use advanced search
  $permissions['use advanced search'] = array(
    'name' => 'use advanced search',
    'roles' => array(
      0 => 'administrator',
      1 => 'anonymous user',
      2 => 'authenticated user',
    ),
    'module' => 'search',
  );

  return $permissions;
}
