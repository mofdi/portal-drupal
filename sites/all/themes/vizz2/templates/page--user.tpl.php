<?php

//  dpm($user);

// dpm($page);

global $base_url;
global $user ;



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
