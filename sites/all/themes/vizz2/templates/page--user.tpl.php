<?php

//  dpm($user);

// dpm($page);

	global $user;
	global $base_url ;
	global $base_path ;
	$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;

?>


	<div id="infoband">
		<div class="content">

		<?php $taxon = get_title_data() ; ?>
      
		<h1><?php print $taxon->name ?></h1>
		<h3><?php print 'page--user' ?></h3>

		</div>
	</div>


  <div id="tabs">
    <div class="content">
      
  <ul>
    <li class='selected'>
      <a href="<?php print($base_url.'/user/'.$user->uid) ?>" title="Summary"><span>Summary</span></a>
    </li>
    <li>
      <a href="<?php print($base_url.'/user/'.$user->uid.'/edit') ?>" title="Summary" title="News"><span>Edit profile</span></a>
    </li>
    <li>
      <a href="<?php print($dataportal_base_url.'/user/downloads') ?>" title="Summary" title="News"><span>Downloads</span></a>
    </li>
    <li>
      <a href="<?php print($dataportal_base_url.'/user/namelists') ?>" title="Summary" title="News"><span>Name lists</span></a>
    </li>
  </ul>

    </div>
  </div>




</header>


  <div id="content">

    <article class="detail">
    <header>
    </header>

    <div class="content">

<?php print $messages ?>
     
			
	<div class="left">

		<?php print render($page['content']); ?>

	</div>
    
	</div>

    <footer></footer>
    </article>

  </div>

</div><!-- /#page -->
