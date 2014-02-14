<?php
/**
 * @file
 * tools_catalogue.features.uuid_term.inc
 */

/**
 * Implements hook_uuid_features_default_terms().
 */
function tools_catalogue_uuid_features_default_terms() {
  $terms = array();

  $terms[] = array(
    'name' => 'Species information',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '005abcbd-7bdf-4bb1-b9c0-38425c97763f',
    'vocabulary_machine_name' => 'orc_data_type',
  );
  $terms[] = array(
    'name' => 'Ecological data',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '00901620-597a-4c05-9f4f-e5dcf0ffcd75',
    'vocabulary_machine_name' => 'orc_data_type',
  );
  $terms[] = array(
    'name' => 'Data curation/quality',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '030ae2e4-c9cb-4b87-81ce-3563b54832b4',
    'vocabulary_machine_name' => 'orc_purpose',
  );
  $terms[] = array(
    'name' => 'SDD',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '05059feb-9bed-4ec4-a5c6-e5890ac91a3b',
    'vocabulary_machine_name' => 'orc_bi_standard',
  );
  $terms[] = array(
    'name' => 'Data publishers',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '0753b775-453e-4ad4-93ce-57b4bf7b2ad4',
    'vocabulary_machine_name' => 'orc_target_audience',
  );
  $terms[] = array(
    'name' => 'Alpha / prototype',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '08aa011a-9bcf-4d72-a48a-c84fea642033',
    'vocabulary_machine_name' => 'orc_development_status',
  );
  $terms[] = array(
    'name' => 'Software developers',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '0c52f7ba-c4ac-4162-b7d3-947bb78e4672',
    'vocabulary_machine_name' => 'orc_target_audience',
  );
  $terms[] = array(
    'name' => 'Digital file',
    'description' => '',
    'format' => 'full_html',
    'weight' => '0',
    'uuid' => '119779c4-3a27-4111-aa06-d15375bff40d',
    'vocabulary_machine_name' => 'resource_type',
  );
  $terms[] = array(
    'name' => 'Data publishing',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '199507d4-8a0a-4277-8cdc-ac10fbeb160e',
    'vocabulary_machine_name' => 'orc_purpose',
  );
  $terms[] = array(
    'name' => 'Conservation',
    'description' => '',
    'format' => 'full_html',
    'weight' => '3',
    'uuid' => '1a51ba99-ec15-4a83-b2da-3e2dc37f028a',
    'vocabulary_machine_name' => 'data_analysis_and_use',
    'parent' => array(
      0 => '9b964fb6-0937-4c75-8f18-76c1af5b2eee',
    ),
  );
  $terms[] = array(
    'name' => 'Climate change',
    'description' => '',
    'format' => 'full_html',
    'weight' => '2',
    'uuid' => '1ba42328-1a71-4298-8ed9-f3cdf0d4f4ea',
    'vocabulary_machine_name' => 'data_analysis_and_use',
    'parent' => array(
      0 => '9b964fb6-0937-4c75-8f18-76c1af5b2eee',
    ),
  );
  $terms[] = array(
    'name' => 'SHP',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '1ceb6148-1183-4eab-b635-99b6482f871f',
    'vocabulary_machine_name' => 'orc_bi_standard',
  );
  $terms[] = array(
    'name' => 'Modellers',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '1f349ce8-e965-474a-9e34-aef7845a900f',
    'vocabulary_machine_name' => 'orc_target_audience',
  );
  $terms[] = array(
    'name' => 'Chinese',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '218b466d-5118-4b00-9751-befa795dc242',
    'vocabulary_machine_name' => 'orc_language',
  );
  $terms[] = array(
    'name' => 'RDF',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '25ceb57f-28b2-4d7d-ae60-e198c096feee',
    'vocabulary_machine_name' => 'orc_bi_standard',
  );
  $terms[] = array(
    'name' => 'Tool',
    'description' => '',
    'format' => 'full_html',
    'weight' => '0',
    'uuid' => '28461f81-e601-4baa-9765-67a5b9c616ce',
    'vocabulary_machine_name' => 'resource_type',
  );
  $terms[] = array(
    'name' => 'ISO 19115',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '2851d727-48f3-4f0a-9598-78700eb86b65',
    'vocabulary_machine_name' => 'orc_bi_standard',
  );
  $terms[] = array(
    'name' => 'Data users',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '2acec876-e0a8-4acb-b5dc-77f33eb102d3',
    'vocabulary_machine_name' => 'orc_target_audience',
  );
  $terms[] = array(
    'name' => 'Field biologists',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '2afa0bca-4163-475d-9691-544d84e3dfd9',
    'vocabulary_machine_name' => 'orc_target_audience',
  );
  $terms[] = array(
    'name' => 'Freshwater',
    'description' => '',
    'format' => 'full_html',
    'weight' => '8',
    'uuid' => '3677d3d7-5c94-4052-bb74-f8376729b57a',
    'vocabulary_machine_name' => 'data_analysis_and_use',
    'parent' => array(
      0 => '9b964fb6-0937-4c75-8f18-76c1af5b2eee',
    ),
  );
  $terms[] = array(
    'name' => 'MS Windows',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '3785c55c-847f-438e-800e-4b3d4c76407a',
    'vocabulary_machine_name' => 'orc_operating_system',
  );
  $terms[] = array(
    'name' => 'Desktop tool',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '384a17e9-f056-4a0e-ade7-18d0f0ec032e',
    'vocabulary_machine_name' => 'orc_tool_type',
  );
  $terms[] = array(
    'name' => 'Beta',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '3ff94969-c0d1-4521-95a7-b85eed3becb2',
    'vocabulary_machine_name' => 'orc_development_status',
  );
  $terms[] = array(
    'name' => 'OGC',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '5405346f-86d5-46b4-9dbf-81256e844723',
    'vocabulary_machine_name' => 'orc_bi_standard',
  );
  $terms[] = array(
    'name' => 'Linux',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '5c39a095-fd69-44b6-8121-4149455b4c07',
    'vocabulary_machine_name' => 'orc_operating_system',
  );
  $terms[] = array(
    'name' => 'Wider audiences',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '5c71038a-d097-459a-bbcb-75696ae1f3f0',
    'vocabulary_machine_name' => 'orc_target_audience',
  );
  $terms[] = array(
    'name' => 'Scientists',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '5cfa42a2-b475-4945-996f-1c24223d643a',
    'vocabulary_machine_name' => 'orc_target_audience',
  );
  $terms[] = array(
    'name' => 'Digital document',
    'description' => '',
    'format' => 'full_html',
    'weight' => '0',
    'uuid' => '5d0f5f6f-16fc-4667-b188-5396f0c007c5',
    'vocabulary_machine_name' => 'resource_type',
  );
  $terms[] = array(
    'name' => 'MS Windows ME',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '5e7b3cb2-586b-466a-8ee6-756f7dffa4d1',
    'vocabulary_machine_name' => 'orc_operating_system',
  );
  $terms[] = array(
    'name' => 'Agriculture',
    'description' => '',
    'format' => 'full_html',
    'weight' => '1',
    'uuid' => '6031f782-b17f-4abf-8d00-f11005047d03',
    'vocabulary_machine_name' => 'data_analysis_and_use',
    'parent' => array(
      0 => '9b964fb6-0937-4c75-8f18-76c1af5b2eee',
    ),
  );
  $terms[] = array(
    'name' => 'Spanish',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '632f9cc8-8eec-464b-9e01-d9a7411440ae',
    'vocabulary_machine_name' => 'orc_language',
  );
  $terms[] = array(
    'name' => 'KML',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '67db96ab-d21b-4bab-b6e4-6759002f8a42',
    'vocabulary_machine_name' => 'orc_bi_standard',
  );
  $terms[] = array(
    'name' => 'iOS',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '69077216-54b0-47a0-927a-b24281f266ee',
    'vocabulary_machine_name' => 'orc_operating_system',
  );
  $terms[] = array(
    'name' => 'Marine',
    'description' => '',
    'format' => 'full_html',
    'weight' => '9',
    'uuid' => '6de0c1a2-829a-42bb-968d-c170a440e0c2',
    'vocabulary_machine_name' => 'data_analysis_and_use',
    'parent' => array(
      0 => '9b964fb6-0937-4c75-8f18-76c1af5b2eee',
    ),
  );
  $terms[] = array(
    'name' => 'Policy uses',
    'description' => '',
    'format' => 'full_html',
    'weight' => '14',
    'uuid' => '6de67c3f-796f-4e65-ba0d-dc02f7b2719d',
    'vocabulary_machine_name' => 'data_analysis_and_use',
  );
  $terms[] = array(
    'name' => 'Evolution',
    'description' => '',
    'format' => 'full_html',
    'weight' => '2',
    'uuid' => '74b79777-596e-4b33-9f6e-e61b938c8b54',
    'vocabulary_machine_name' => 'data_analysis_and_use',
    'parent' => array(
      0 => 'e471030f-3e2f-4408-bc1c-3f3b611f092b',
    ),
  );
  $terms[] = array(
    'name' => 'Data resource',
    'description' => '',
    'format' => 'full_html',
    'weight' => '0',
    'uuid' => '77a46803-6e1c-4a3d-b3e6-be8360cc9e87',
    'vocabulary_machine_name' => 'resource_type',
  );
  $terms[] = array(
    'name' => 'French',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '78512b43-eec2-4ad3-8483-e41198cc50f3',
    'vocabulary_machine_name' => 'orc_language',
  );
  $terms[] = array(
    'name' => 'OS independent',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '7ae69726-80a9-4792-a65d-871ca4714e6b',
    'vocabulary_machine_name' => 'orc_operating_system',
  );
  $terms[] = array(
    'name' => 'Internal URL',
    'description' => '',
    'format' => 'full_html',
    'weight' => '0',
    'uuid' => '7e5aaf45-cff6-44f0-b76a-dc028a0c2cbe',
    'vocabulary_machine_name' => 'resource_type',
  );
  $terms[] = array(
    'name' => 'Mac OS X',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '835ced55-de9d-41cc-9217-d1cd1e37a6c6',
    'vocabulary_machine_name' => 'orc_operating_system',
  );
  $terms[] = array(
    'name' => 'Ecology',
    'description' => '',
    'format' => 'full_html',
    'weight' => '1',
    'uuid' => '870ca9a5-33f7-4967-ae38-504568f43c65',
    'vocabulary_machine_name' => 'data_analysis_and_use',
    'parent' => array(
      0 => 'e471030f-3e2f-4408-bc1c-3f3b611f092b',
    ),
  );
  $terms[] = array(
    'name' => 'Presentation',
    'description' => '',
    'format' => 'full_html',
    'weight' => '0',
    'uuid' => '88527dde-98c1-4fda-9cd8-a995620c13f2',
    'vocabulary_machine_name' => 'resource_type',
  );
  $terms[] = array(
    'name' => 'Darwin Core Archive',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '8d1b56a4-b35e-40f7-882f-91e8043f0c13',
    'vocabulary_machine_name' => 'orc_bi_standard',
  );
  $terms[] = array(
    'name' => 'Strategic applications',
    'description' => '',
    'format' => 'full_html',
    'weight' => '16',
    'uuid' => '9131e877-dd0a-4c0d-94e9-9279f60b2978',
    'vocabulary_machine_name' => 'data_analysis_and_use',
  );
  $terms[] = array(
    'name' => 'Web service',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '91d761fc-8f36-4af3-b6a2-e08e0c06320c',
    'vocabulary_machine_name' => 'orc_tool_type',
  );
  $terms[] = array(
    'name' => 'Data digitization',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '92839a7b-9482-4bcb-8db4-b0e3c39028b1',
    'vocabulary_machine_name' => 'orc_purpose',
  );
  $terms[] = array(
    'name' => 'Android',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '92895dc8-ba6e-43dd-b363-3890f166fed3',
    'vocabulary_machine_name' => 'orc_operating_system',
  );
  $terms[] = array(
    'name' => 'ABCD',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '93c8b5e2-3e5b-4e97-b689-8da29e73c5ba',
    'vocabulary_machine_name' => 'orc_bi_standard',
  );
  $terms[] = array(
    'name' => 'Metadata',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '95a0e4b6-b64f-4ae1-b51b-4c598cc00966',
    'vocabulary_machine_name' => 'orc_data_type',
  );
  $terms[] = array(
    'name' => 'Taxonomists',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '9625417d-f136-42ef-bc0d-1c6db1be0e6f',
    'vocabulary_machine_name' => 'orc_target_audience',
  );
  $terms[] = array(
    'name' => 'Nat. resource managers',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '97b99811-af5a-4105-b72d-87e9e836c9ae',
    'vocabulary_machine_name' => 'orc_target_audience',
  );
  $terms[] = array(
    'name' => 'Taxonomic research',
    'description' => '',
    'format' => 'full_html',
    'weight' => '3',
    'uuid' => '980951d9-d09d-4d16-a2d7-b6ab0be08afd',
    'vocabulary_machine_name' => 'data_analysis_and_use',
    'parent' => array(
      0 => 'e471030f-3e2f-4408-bc1c-3f3b611f092b',
    ),
  );
  $terms[] = array(
    'name' => 'Human health',
    'description' => '',
    'format' => 'full_html',
    'weight' => '4',
    'uuid' => '9a0e32c8-cf25-45bd-a0ca-6ebc2eaa4e8f',
    'vocabulary_machine_name' => 'data_analysis_and_use',
    'parent' => array(
      0 => '9b964fb6-0937-4c75-8f18-76c1af5b2eee',
    ),
  );
  $terms[] = array(
    'name' => 'Data analysis',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '9af81698-3865-4674-8d88-2b6b7b7c53ac',
    'vocabulary_machine_name' => 'orc_purpose',
  );
  $terms[] = array(
    'name' => 'Science uses',
    'description' => '',
    'format' => 'full_html',
    'weight' => '15',
    'uuid' => '9b964fb6-0937-4c75-8f18-76c1af5b2eee',
    'vocabulary_machine_name' => 'data_analysis_and_use',
  );
  $terms[] = array(
    'name' => 'Production ready',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => '9e031d48-5547-4e3c-9ad5-a1a307ed6007',
    'vocabulary_machine_name' => 'orc_development_status',
  );
  $terms[] = array(
    'name' => 'GBIF Metadata Profile',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'a0fe9dab-eea9-40bd-adc8-dede91735332',
    'vocabulary_machine_name' => 'orc_bi_standard',
  );
  $terms[] = array(
    'name' => 'GBIF Nodes',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'a3f1af4d-8b39-4efb-be0c-4abf2d734633',
    'vocabulary_machine_name' => 'orc_target_audience',
  );
  $terms[] = array(
    'name' => 'Mountain biodiversity',
    'description' => '',
    'format' => 'full_html',
    'weight' => '6',
    'uuid' => 'a5686ca0-2457-4bfa-9a2e-2371701d5939',
    'vocabulary_machine_name' => 'data_analysis_and_use',
    'parent' => array(
      0 => '9b964fb6-0937-4c75-8f18-76c1af5b2eee',
    ),
  );
  $terms[] = array(
    'name' => 'Species distributions',
    'description' => '',
    'format' => 'full_html',
    'weight' => '7',
    'uuid' => 'a7784c7a-e070-41ed-b3c6-5a4193d098d3',
    'vocabulary_machine_name' => 'data_analysis_and_use',
    'parent' => array(
      0 => '9b964fb6-0937-4c75-8f18-76c1af5b2eee',
    ),
  );
  $terms[] = array(
    'name' => 'In development',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'a8403f0d-f71f-4571-8d67-370c0af44c9c',
    'vocabulary_machine_name' => 'orc_development_status',
  );
  $terms[] = array(
    'name' => 'Data access/display',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'b231a3f8-9e75-4117-a020-ac223a1df01a',
    'vocabulary_machine_name' => 'orc_purpose',
  );
  $terms[] = array(
    'name' => 'Invasives',
    'description' => '',
    'format' => 'full_html',
    'weight' => '5',
    'uuid' => 'b973ae65-7db3-479b-88c1-8c51c8788005',
    'vocabulary_machine_name' => 'data_analysis_and_use',
    'parent' => array(
      0 => '9b964fb6-0937-4c75-8f18-76c1af5b2eee',
    ),
  );
  $terms[] = array(
    'name' => 'Mobile application',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'be1e59f7-1164-40f2-a125-5b835129a7a9',
    'vocabulary_machine_name' => 'orc_tool_type',
  );
  $terms[] = array(
    'name' => 'IT specialists',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'c01be341-6d6a-4b61-b698-18ec4c7c3c36',
    'vocabulary_machine_name' => 'orc_target_audience',
  );
  $terms[] = array(
    'name' => 'Practitioners',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'c039c431-8c5c-4907-9e08-a9557825683a',
    'vocabulary_machine_name' => 'orc_target_audience',
  );
  $terms[] = array(
    'name' => 'Occurrence data',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'c4bc4a52-8c56-4d6e-b8c5-c9fba6d08a14',
    'vocabulary_machine_name' => 'orc_data_type',
  );
  $terms[] = array(
    'name' => 'GML',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'c747543a-af31-4f52-a57c-8a337c577768',
    'vocabulary_machine_name' => 'orc_bi_standard',
  );
  $terms[] = array(
    'name' => 'Audubon Core',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'cbfdb260-a7fd-4f71-9be9-00091f515eed',
    'vocabulary_machine_name' => 'orc_bi_standard',
  );
  $terms[] = array(
    'name' => 'Names and taxonomy',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'ccf26ef8-65c4-44b4-8a67-9e36d05e044c',
    'vocabulary_machine_name' => 'orc_data_type',
  );
  $terms[] = array(
    'name' => 'Tool set',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'cd92e082-7f22-4c61-8a7f-a30f146d5c24',
    'vocabulary_machine_name' => 'orc_tool_type',
  );
  $terms[] = array(
    'name' => 'English',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'ce831917-8f6f-4eb3-bddf-becbff7d9443',
    'vocabulary_machine_name' => 'orc_language',
  );
  $terms[] = array(
    'name' => 'Biogeography',
    'description' => '',
    'format' => 'full_html',
    'weight' => '0',
    'uuid' => 'd5aa1d08-0017-4f60-967a-25c07625297c',
    'vocabulary_machine_name' => 'data_analysis_and_use',
    'parent' => array(
      0 => 'e471030f-3e2f-4408-bc1c-3f3b611f092b',
    ),
  );
  $terms[] = array(
    'name' => 'Server application',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'd6410ff2-8838-4349-bc31-4fcf35edbe57',
    'vocabulary_machine_name' => 'orc_tool_type',
  );
  $terms[] = array(
    'name' => 'Naturalists',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'd6dd1d04-05c4-41ce-894e-6ff8616f2e82',
    'vocabulary_machine_name' => 'orc_target_audience',
  );
  $terms[] = array(
    'name' => 'Advancing science',
    'description' => '',
    'format' => 'full_html',
    'weight' => '0',
    'uuid' => 'e471030f-3e2f-4408-bc1c-3f3b611f092b',
    'vocabulary_machine_name' => 'data_analysis_and_use',
    'parent' => array(
      0 => '9b964fb6-0937-4c75-8f18-76c1af5b2eee',
    ),
  );
  $terms[] = array(
    'name' => 'Nat. Hist. col.',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'eadf9ab1-3ac3-4730-a2d0-69238c34bb5d',
    'vocabulary_machine_name' => 'orc_target_audience',
  );
  $terms[] = array(
    'name' => 'Plinian Core',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'eb149076-171c-432e-95b0-51a80f0f811a',
    'vocabulary_machine_name' => 'orc_bi_standard',
  );
  $terms[] = array(
    'name' => 'Demo',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'ed138ef9-24de-4e1d-94e5-a7fe8c192430',
    'vocabulary_machine_name' => 'orc_development_status',
  );
  $terms[] = array(
    'name' => 'Multimedia data',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'f0d3b977-c127-4c22-a64e-3edf4c80c6fd',
    'vocabulary_machine_name' => 'orc_data_type',
  );
  $terms[] = array(
    'name' => 'Darwin Core',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'f3198e2c-34fe-4e90-baf1-85e94e58134e',
    'vocabulary_machine_name' => 'orc_bi_standard',
  );
  $terms[] = array(
    'name' => 'Online tool',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'f54aa506-2206-40a0-99bf-a542ae6778f1',
    'vocabulary_machine_name' => 'orc_tool_type',
  );
  $terms[] = array(
    'name' => 'Widget',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'f7efe121-2992-42cb-ab2a-045dd6d25bb5',
    'vocabulary_machine_name' => 'orc_tool_type',
  );
  $terms[] = array(
    'name' => 'DELTA',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'f8278621-3088-406c-ab02-4fd2d40eccb0',
    'vocabulary_machine_name' => 'orc_bi_standard',
  );
  $terms[] = array(
    'name' => 'Dublin Core',
    'description' => NULL,
    'format' => NULL,
    'weight' => '0',
    'uuid' => 'f9003555-c971-4518-8ebd-738b1d44cc70',
    'vocabulary_machine_name' => 'orc_bi_standard',
  );
  return $terms;
}
