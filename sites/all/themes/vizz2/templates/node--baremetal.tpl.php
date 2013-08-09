<?php
/**
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see zen_preprocess_node()
 * @see template_process()
 */
	global $user;
	global $base_url ;
	global $base_path ;
	
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
	$fields_collection = field_get_items('node',$node,'field_cchunk');

	$chunks = array() ;	
	foreach ( $fields_collection as $indx => $data) $chunks[$indx] = field_collection_item_load( $fields_collection[$indx]['value'] ) ;


?>
<?php // dpm ( $fields_collection ); ?>

<?php print render($content['body']); ?>
