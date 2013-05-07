<?php

if ( $element['#field_name'] == 'field_linkstoresearch' ) {
	echo '<ul>' ;
	foreach ($items as $delta => $item) {
		echo '<li>' ;
		print render($item);
		echo '</li>' ;
	}
	echo '</ul>';
} elseif ( $element['#field_name'] == 'field_researcherslocation' ) {
	echo '<ul class="tags">' ;
	foreach ($items as $delta => $item) {
		echo '<li>' ;
		print ( render($item) );
		echo '</li>' ;
	}
	echo '</ul>';
} elseif ( $element['#field_name'] == 'field_relatedgbifresources' ) {
	echo '<ul>' ;
	foreach ($items as $delta => $item) {
		echo '<li>' ;
		print ( render($item) );
		echo '</li>' ;
	}
	echo '</ul>';
} elseif ( $element['#field_name'] == 'field_datausecategories' ) {
	echo '<ul>' ;
	foreach ($items as $delta => $item) {
		echo '<li>' ;
		print ( render($item) );
		echo '</li>' ;
	}
	echo '</ul>';
}	else {
	foreach ($items as $delta => $item) {
		print ( render($item) );
	}
}
?>