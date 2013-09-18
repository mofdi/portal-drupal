<?php
// var_dump($element['#view_mode']);
if ( $element['#field_name'] == 'field_linkstoresearch' ) {
	foreach ($items as $delta => $item) {
		if ( $element['#view_mode']=='full' ) {
			print '<li>'.(render($item)).'</li>';
		} else {
			print (render($item)).' ';
		}
	}
} elseif ( $element['#field_name'] == 'field_reasearcherslocation' ) {
	foreach ($items as $delta => $item) {
		if ( $element['#view_mode']=='full' ) {
			print '<li>'.(render($item)).'</li>';
		} else {
			print (render($item)).' ';
		}
	}
} elseif ( $element['#field_name'] == 'field_relatedgbifresources' ) {
	foreach ($items as $delta => $item) {
		if ( $element['#view_mode']=='full' ) {
			print '<li>'.(render($item)).'</li>';
		} else {
			print (render($item));
		}
	}
} elseif ( $element['#field_name'] == 'field_datausecategories' ) {
	foreach ($items as $delta => $item) {
		if ( $element['#view_mode']=='full' ) {
			print '<li>'.(render($item)).'</li>';
		} else {
			print (render($item)).' ';
		}
	}
} elseif ( $element['#field_name'] == 'field_capacity' ) {
	foreach ($items as $delta => $item) {
		if ( $element['#view_mode']=='full'){
			print '<li>'.(render($item)).'</li>';
		} else {
			print (render($item)).' ';
			
		}
	}
} elseif ( $element['#field_name'] == 'field_country' ) {
	foreach ($items as $delta => $item) {
		if ( $element['#view_mode']=='full' ) {
			print '<li>'.(render($item)).'</li>';
		} else {
			print (render($item)).' ';
		}
	}
} elseif ( $element['#field_name'] == 'field_informatics' ) {
	foreach ($items as $delta => $item) {
		if ( $element['#view_mode']=='full' ) {
			print '<li>'.(render($item)).'</li>';
		} else {
			print (render($item)).' ';
		}
	}
} elseif ( $element['#field_name'] == 'field_organizations' ) {
	foreach ($items as $delta => $item) {
		if ( $element['#view_mode']=='full' ) {
			print '<li>'.(render($item)).'</li>';
		} else {
			print (render($item)).' ';
		}
	}
} elseif ( $element['#field_name'] == 'field_regions' ) {
	foreach ($items as $delta => $item) {
		if ( $element['#view_mode']=='full' ) {
			print '<li>'.(render($item)).'</li>';
		} else {
			print (render($item)).' ';
		}
	}
} else {
	foreach ($items as $delta => $item) {
			print (render($item)).' ';
	}
}

?>