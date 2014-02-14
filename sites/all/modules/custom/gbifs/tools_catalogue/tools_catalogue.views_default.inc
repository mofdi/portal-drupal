<?php
/**
 * @file
 * tools_catalogue.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function tools_catalogue_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'tools';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'search_api_index_tools_catalogue';
  $view->human_name = 'Tools catalogue';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Tools catalogue';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'none';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'full';
  $handler->display->display_options['pager']['options']['items_per_page'] = '10';
  $handler->display->display_options['style_plugin'] = 'grid';
  $handler->display->display_options['row_plugin'] = 'fields';
  /* Field: Indexed Node: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'search_api_index_tools_catalogue';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['link_to_entity'] = 0;
  /* Field: Indexed Node: Abstract */
  $handler->display->display_options['fields']['field_abstract']['id'] = 'field_abstract';
  $handler->display->display_options['fields']['field_abstract']['table'] = 'search_api_index_tools_catalogue';
  $handler->display->display_options['fields']['field_abstract']['field'] = 'field_abstract';
  /* Field: Indexed Node: Publisher */
  $handler->display->display_options['fields']['field_publisher']['id'] = 'field_publisher';
  $handler->display->display_options['fields']['field_publisher']['table'] = 'search_api_index_tools_catalogue';
  $handler->display->display_options['fields']['field_publisher']['field'] = 'field_publisher';
  /* Field: Indexed Node: Publishing date */
  $handler->display->display_options['fields']['field_publishing_date']['id'] = 'field_publishing_date';
  $handler->display->display_options['fields']['field_publishing_date']['table'] = 'search_api_index_tools_catalogue';
  $handler->display->display_options['fields']['field_publishing_date']['field'] = 'field_publishing_date';
  $handler->display->display_options['fields']['field_publishing_date']['settings'] = array(
    'format_type' => 'long',
    'fromto' => 'both',
    'multiple_number' => '',
    'multiple_from' => '',
    'multiple_to' => '',
    'show_repeat_rule' => 'show',
  );
  /* Field: Indexed Node: Image */
  $handler->display->display_options['fields']['field_image']['id'] = 'field_image';
  $handler->display->display_options['fields']['field_image']['table'] = 'search_api_index_tools_catalogue';
  $handler->display->display_options['fields']['field_image']['field'] = 'field_image';
  $handler->display->display_options['fields']['field_image']['click_sort_column'] = 'fid';
  $handler->display->display_options['fields']['field_image']['settings'] = array(
    'image_style' => '',
    'image_link' => '',
  );
  /* Filter criterion: Indexed Node: Resource type */
  $handler->display->display_options['filters']['field_resource_type_term']['id'] = 'field_resource_type_term';
  $handler->display->display_options['filters']['field_resource_type_term']['table'] = 'search_api_index_tools_catalogue';
  $handler->display->display_options['filters']['field_resource_type_term']['field'] = 'field_resource_type_term';
  $handler->display->display_options['filters']['field_resource_type_term']['value'] = array(
    990 => '990',
  );

  /* Display: Page */
  $handler = $view->new_display('page', 'Page', 'page');
  $handler->display->display_options['path'] = 'resource/tools-catalogue';
  $translatables['tools'] = array(
    t('Master'),
    t('Tools catalogue'),
    t('more'),
    t('Apply'),
    t('Reset'),
    t('Sort by'),
    t('Asc'),
    t('Desc'),
    t('Items per page'),
    t('- All -'),
    t('Offset'),
    t('« first'),
    t('‹ previous'),
    t('next ›'),
    t('last »'),
    t('Title'),
    t('Abstract'),
    t('Publisher'),
    t('Publishing date'),
    t('Image'),
    t('Page'),
  );
  $export['tools'] = $view;

  return $export;
}
