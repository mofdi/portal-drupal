<?php
/**
 * @file
 * gbif_pages.views.newsarticles.inc
 */                                     
 
function gbif_pages_view_viewallevents() {

  /* View All Events
   */
  $view = new view();
  $view->name = 'viewallevents';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'View All Events';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'GBIF event archive';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'full';
  $handler->display->display_options['pager']['options']['items_per_page'] = '10';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['pager']['options']['id'] = '0';
  $handler->display->display_options['pager']['options']['quantity'] = '9';
  $handler->display->display_options['pager']['options']['tags']['first'] = 'First';
  $handler->display->display_options['pager']['options']['tags']['last'] = 'Last';
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['style_options']['default_row_class'] = FALSE;
  $handler->display->display_options['style_options']['row_class_special'] = FALSE;
  $handler->display->display_options['row_plugin'] = 'node';
  $handler->display->display_options['row_options']['view_mode'] = 'teaser_nt';
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Sort criterion: Content: start_date (field_start_date) */
  $handler->display->display_options['sorts']['field_start_date_value']['id'] = 'field_start_date_value';
  $handler->display->display_options['sorts']['field_start_date_value']['table'] = 'field_data_field_start_date';
  $handler->display->display_options['sorts']['field_start_date_value']['field'] = 'field_start_date_value';
  $handler->display->display_options['sorts']['field_start_date_value']['order'] = 'DESC';
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'event_ims' => 'event_ims',
  );
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = '1';
  /* Filter criterion: Content: start_date (field_start_date) */
  $handler->display->display_options['filters']['field_start_date_value']['id'] = 'field_start_date_value';
  $handler->display->display_options['filters']['field_start_date_value']['table'] = 'field_data_field_start_date';
  $handler->display->display_options['filters']['field_start_date_value']['field'] = 'field_start_date_value';
  $handler->display->display_options['filters']['field_start_date_value']['operator'] = '<';
  $handler->display->display_options['filters']['field_start_date_value']['granularity'] = 'minute';
  $handler->display->display_options['filters']['field_start_date_value']['default_date'] = '1AM today';
  $handler->display->display_options['filters']['field_start_date_value']['year_range'] = '-0:+5';

  /* Display: Page */
  $handler = $view->new_display('page', 'Page', 'page');
  $handler->display->display_options['defaults']['hide_admin_links'] = FALSE;
  $handler->display->display_options['path'] = 'newsroom/archive/allevents';
  $handler->display->display_options['menu']['type'] = 'normal';
  $handler->display->display_options['menu']['title'] = 'A view of all GBIF events';
  $handler->display->display_options['menu']['weight'] = '0';
  $handler->display->display_options['menu']['name'] = 'main-menu';
  $handler->display->display_options['menu']['context'] = 0;
  $handler->display->display_options['menu']['context_only_inline'] = 0;

  /* Display: futureevents */
  $handler = $view->new_display('page', 'futureevents', 'page_1');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Upcoming Events';
  $handler->display->display_options['display_description'] = 'Events in the future by start_date';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Content: start_date (field_start_date) */
  $handler->display->display_options['sorts']['field_start_date_value']['id'] = 'field_start_date_value';
  $handler->display->display_options['sorts']['field_start_date_value']['table'] = 'field_data_field_start_date';
  $handler->display->display_options['sorts']['field_start_date_value']['field'] = 'field_start_date_value';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'event_ims' => 'event_ims',
  );
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = '1';
  /* Filter criterion: Content: start_date (field_start_date) */
  $handler->display->display_options['filters']['field_start_date_value']['id'] = 'field_start_date_value';
  $handler->display->display_options['filters']['field_start_date_value']['table'] = 'field_data_field_start_date';
  $handler->display->display_options['filters']['field_start_date_value']['field'] = 'field_start_date_value';
  $handler->display->display_options['filters']['field_start_date_value']['operator'] = '>=';
  $handler->display->display_options['filters']['field_start_date_value']['granularity'] = 'hour';
  $handler->display->display_options['filters']['field_start_date_value']['default_date'] = '1AM today';
  $handler->display->display_options['filters']['field_start_date_value']['year_range'] = '-0:+5';
  $handler->display->display_options['path'] = 'newseroom/events';
  $translatables['viewallevents'] = array(
    t('Master'),
    t('GBIF event archive'),
    t('more'),
    t('Apply'),
    t('Reset'),
    t('Sort by'),
    t('Asc'),
    t('Desc'),
    t('Items per page'),
    t('- All -'),
    t('Offset'),
    t('First'),
    t('‹ previous'),
    t('next ›'),
    t('Last'),
    t('Page'),
    t('futureevents'),
    t('Upcoming Events'),
    t('Events in the future by start_date'),
  );
  
  return $view;
}