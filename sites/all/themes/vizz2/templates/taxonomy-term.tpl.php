<?php 
	
	// $rgr = field_get_items('node',$node,'field_relatedgbifresources') ; dpm($rgr)

	// we ASSUME there is a $node since we are in a template named page--node--something.tpl.php
	// get an array with all the fields for this node
	
	if ($node) {
		$tags = field_attach_view('node', $node,'full' ) ; 
	}

	// Fetch some data from the navigation taxonomy in order to use it for the page title
	// via custom function in template.php
	$taxon = get_title_data() ;

	global $user;
	global $base_url ;
	global $base_path ;
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
// dpm($page) ;  
	
?>
    <article class="news">
    <header></header>
    <div class="content">

      <div class="content">
        <div class="left"><br /><br /><br /><br /><br /><br /><br />

		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
			<h3>... under construction</h3>
		</div>
      </div>


    </div>
    <footer></footer>
    </article>