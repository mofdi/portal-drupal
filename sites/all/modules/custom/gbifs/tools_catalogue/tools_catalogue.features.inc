<?php
/**
 * @file
 * tools_catalogue.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function tools_catalogue_ctools_plugin_api() {
  list($module, $api) = func_get_args();
  if ($module == "facetapi" && $api == "facetapi_defaults") {
    return array("version" => "1");
  }
  list($module, $api) = func_get_args();
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function tools_catalogue_views_api() {
  return array("version" => "3.0");
}

/**
 * Implements hook_node_info().
 */
function tools_catalogue_node_info() {
  $items = array(
    'resource' => array(
      'name' => t('Resource'),
      'base' => 'node_content',
      'description' => t('Resource that will be managed natively in the Drupal system.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  return $items;
}

/**
 * Implements hook_default_search_api_index().
 */
function tools_catalogue_default_search_api_index() {
  $items = array();
  $items['tools_catalogue'] = entity_import('search_api_index', '{
    "name" : "Tools catalogue",
    "machine_name" : "tools_catalogue",
    "description" : null,
    "server" : "database_server",
    "item_type" : "node",
    "options" : {
      "index_directly" : 1,
      "cron_limit" : "50",
      "fields" : {
        "type" : { "type" : "string" },
        "title" : { "type" : "text", "boost" : "5.0" },
        "author" : { "type" : "integer", "entity_type" : "user" },
        "field_target_audience" : { "type" : "text" },
        "field_abstract" : { "type" : "text" },
        "field_language_term" : { "type" : "list\\u003Cinteger\\u003E", "entity_type" : "taxonomy_term" },
        "field_purpose" : { "type" : "list\\u003Cinteger\\u003E", "entity_type" : "taxonomy_term" },
        "field_target_audience_term" : { "type" : "list\\u003Cinteger\\u003E", "entity_type" : "taxonomy_term" },
        "field_data_type" : { "type" : "list\\u003Cinteger\\u003E", "entity_type" : "taxonomy_term" },
        "field_tool_type" : { "type" : "list\\u003Cinteger\\u003E", "entity_type" : "taxonomy_term" },
        "field_development_status" : { "type" : "integer", "entity_type" : "taxonomy_term" },
        "field_standard_and_format" : { "type" : "list\\u003Cinteger\\u003E", "entity_type" : "taxonomy_term" },
        "field_operating_system" : { "type" : "list\\u003Cinteger\\u003E", "entity_type" : "taxonomy_term" },
        "field_resource_type_term" : { "type" : "integer", "entity_type" : "taxonomy_term" },
        "search_api_language" : { "type" : "string" }
      }
    },
    "enabled" : "1",
    "read_only" : "0",
    "rdf_mapping" : []
  }');
  return $items;
}

/**
 * Implements hook_default_search_api_server().
 */
function tools_catalogue_default_search_api_server() {
  $items = array();
  $items['database_server'] = entity_import('search_api_server', '{
    "name" : "Database server",
    "machine_name" : "database_server",
    "description" : "",
    "class" : "search_api_db_service",
    "options" : {
      "database" : "default:default",
      "min_chars" : "1",
      "indexes" : { "tools_catalogue" : {
          "type" : {
            "table" : "search_api_db_tools_catalogue",
            "column" : "type",
            "type" : "string",
            "boost" : "1.0"
          },
          "title" : {
            "table" : "search_api_db_tools_catalogue_title",
            "type" : "text",
            "boost" : "5.0"
          },
          "author" : {
            "table" : "search_api_db_tools_catalogue",
            "column" : "author",
            "type" : "integer",
            "boost" : "1.0"
          },
          "field_target_audience" : {
            "table" : "search_api_db_tools_catalogue_field_target_audience",
            "type" : "text",
            "boost" : "1.0"
          },
          "field_abstract" : {
            "table" : "search_api_db_tools_catalogue_field_abstract",
            "type" : "text",
            "boost" : "1.0"
          },
          "field_language_term" : {
            "table" : "search_api_db_tools_catalogue_field_language_term",
            "column" : "value",
            "type" : "list\\u003Cinteger\\u003E",
            "boost" : "1.0"
          },
          "field_purpose" : {
            "table" : "search_api_db_tools_catalogue_field_purpose",
            "column" : "value",
            "type" : "list\\u003Cinteger\\u003E",
            "boost" : "1.0"
          },
          "field_target_audience_term" : {
            "table" : "search_api_db_tools_catalogue_field_target_audience_term",
            "column" : "value",
            "type" : "list\\u003Cinteger\\u003E",
            "boost" : "1.0"
          },
          "field_data_type" : {
            "table" : "search_api_db_tools_catalogue_field_data_type",
            "column" : "value",
            "type" : "list\\u003Cinteger\\u003E",
            "boost" : "1.0"
          },
          "field_tool_type" : {
            "table" : "search_api_db_tools_catalogue_field_tool_type",
            "column" : "value",
            "type" : "list\\u003Cinteger\\u003E",
            "boost" : "1.0"
          },
          "field_development_status" : {
            "table" : "search_api_db_tools_catalogue",
            "column" : "field_development_status",
            "type" : "integer",
            "boost" : "1.0"
          },
          "field_standard_and_format" : {
            "table" : "search_api_db_tools_catalogue_field_standard_and_format",
            "column" : "value",
            "type" : "list\\u003Cinteger\\u003E",
            "boost" : "1.0"
          },
          "field_operating_system" : {
            "table" : "search_api_db_tools_catalogue_field_operating_system",
            "column" : "value",
            "type" : "list\\u003Cinteger\\u003E",
            "boost" : "1.0"
          },
          "field_resource_type_term" : {
            "table" : "search_api_db_tools_catalogue",
            "column" : "field_resource_type_term",
            "type" : "integer",
            "boost" : "1.0"
          },
          "search_api_language" : {
            "table" : "search_api_db_tools_catalogue",
            "column" : "search_api_language",
            "type" : "string",
            "boost" : "1.0"
          }
        }
      }
    },
    "enabled" : "1",
    "rdf_mapping" : []
  }');
  return $items;
}
