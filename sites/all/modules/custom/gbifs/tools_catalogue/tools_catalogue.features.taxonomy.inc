<?php
/**
 * @file
 * tools_catalogue.features.taxonomy.inc
 */

/**
 * Implements hook_taxonomy_default_vocabularies().
 */
function tools_catalogue_taxonomy_default_vocabularies() {
  return array(
    'data_analysis_and_use' => array(
      'name' => 'Data use categories',
      'machine_name' => 'data_analysis_and_use',
      'description' => '',
      'hierarchy' => '1',
      'module' => 'taxonomy',
      'weight' => '-3',
      'rdf_mapping' => array(
        'rdftype' => array(
          0 => 'skos:ConceptScheme',
        ),
        'name' => array(
          'predicates' => array(
            0 => 'dc:title',
          ),
        ),
        'description' => array(
          'predicates' => array(
            0 => 'rdfs:comment',
          ),
        ),
      ),
    ),
    'orc_bi_standard' => array(
      'name' => 'BI standard',
      'machine_name' => 'orc_bi_standard',
      'description' => '[ORC] Compliance of standard(s).',
      'hierarchy' => '0',
      'module' => 'taxonomy',
      'weight' => '6',
      'rdf_mapping' => array(
        'rdftype' => array(
          0 => 'skos:ConceptScheme',
        ),
        'name' => array(
          'predicates' => array(
            0 => 'dc:title',
          ),
        ),
        'description' => array(
          'predicates' => array(
            0 => 'rdfs:comment',
          ),
        ),
      ),
    ),
    'orc_data_type' => array(
      'name' => 'Data type',
      'machine_name' => 'orc_data_type',
      'description' => '[ORC] Applicable data types.',
      'hierarchy' => '0',
      'module' => 'taxonomy',
      'weight' => '2',
      'rdf_mapping' => array(
        'rdftype' => array(
          0 => 'skos:ConceptScheme',
        ),
        'name' => array(
          'predicates' => array(
            0 => 'dc:title',
          ),
        ),
        'description' => array(
          'predicates' => array(
            0 => 'rdfs:comment',
          ),
        ),
      ),
    ),
    'orc_development_status' => array(
      'name' => 'Development status',
      'machine_name' => 'orc_development_status',
      'description' => '[ORC] In which phase the development is.',
      'hierarchy' => '0',
      'module' => 'taxonomy',
      'weight' => '4',
      'rdf_mapping' => array(
        'rdftype' => array(
          0 => 'skos:ConceptScheme',
        ),
        'name' => array(
          'predicates' => array(
            0 => 'dc:title',
          ),
        ),
        'description' => array(
          'predicates' => array(
            0 => 'rdfs:comment',
          ),
        ),
      ),
    ),
    'orc_language' => array(
      'name' => 'Language',
      'machine_name' => 'orc_language',
      'description' => '[ORC] The language(s) for accessing this resource.',
      'hierarchy' => '0',
      'module' => 'taxonomy',
      'weight' => '1',
      'rdf_mapping' => array(
        'rdftype' => array(
          0 => 'skos:ConceptScheme',
        ),
        'name' => array(
          'predicates' => array(
            0 => 'dc:title',
          ),
        ),
        'description' => array(
          'predicates' => array(
            0 => 'rdfs:comment',
          ),
        ),
      ),
    ),
    'orc_operating_system' => array(
      'name' => 'Operating system',
      'machine_name' => 'orc_operating_system',
      'description' => '[ORC] On which platform the tool runs.',
      'hierarchy' => '0',
      'module' => 'taxonomy',
      'weight' => '5',
      'rdf_mapping' => array(
        'rdftype' => array(
          0 => 'skos:ConceptScheme',
        ),
        'name' => array(
          'predicates' => array(
            0 => 'dc:title',
          ),
        ),
        'description' => array(
          'predicates' => array(
            0 => 'rdfs:comment',
          ),
        ),
      ),
    ),
    'orc_purpose' => array(
      'name' => 'Purpose',
      'machine_name' => 'orc_purpose',
      'description' => '[ORC] The purpose of the tool',
      'hierarchy' => '0',
      'module' => 'taxonomy',
      'weight' => '-1',
      'rdf_mapping' => array(
        'rdftype' => array(
          0 => 'skos:ConceptScheme',
        ),
        'name' => array(
          'predicates' => array(
            0 => 'dc:title',
          ),
        ),
        'description' => array(
          'predicates' => array(
            0 => 'rdfs:comment',
          ),
        ),
      ),
    ),
    'orc_target_audience' => array(
      'name' => 'Target audience',
      'machine_name' => 'orc_target_audience',
      'description' => '[ORC] Targeted type of audience. For example, taxonomists or modellers.',
      'hierarchy' => '0',
      'module' => 'taxonomy',
      'weight' => '0',
      'rdf_mapping' => array(
        'rdftype' => array(
          0 => 'skos:ConceptScheme',
        ),
        'name' => array(
          'predicates' => array(
            0 => 'dc:title',
          ),
        ),
        'description' => array(
          'predicates' => array(
            0 => 'rdfs:comment',
          ),
        ),
      ),
    ),
    'orc_tool_type' => array(
      'name' => 'Tool type',
      'machine_name' => 'orc_tool_type',
      'description' => '[ORC] In which form the tool is used. For example, desktop or web based.',
      'hierarchy' => '0',
      'module' => 'taxonomy',
      'weight' => '3',
      'rdf_mapping' => array(
        'rdftype' => array(
          0 => 'skos:ConceptScheme',
        ),
        'name' => array(
          'predicates' => array(
            0 => 'dc:title',
          ),
        ),
        'description' => array(
          'predicates' => array(
            0 => 'rdfs:comment',
          ),
        ),
      ),
    ),
    'resource_type' => array(
      'name' => 'Resource type',
      'machine_name' => 'resource_type',
      'description' => 'Type of resource',
      'hierarchy' => '0',
      'module' => 'taxonomy',
      'weight' => '7',
      'rdf_mapping' => array(
        'rdftype' => array(
          0 => 'skos:ConceptScheme',
        ),
        'name' => array(
          'predicates' => array(
            0 => 'dc:title',
          ),
        ),
        'description' => array(
          'predicates' => array(
            0 => 'rdfs:comment',
          ),
        ),
      ),
    ),
  );
}
