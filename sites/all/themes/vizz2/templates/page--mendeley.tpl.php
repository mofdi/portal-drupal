<?php
$taxon = get_title_data() ;

global $user;
global $base_url ;
global $base_path ;
$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;

$results = array() ;
$view = views_get_view_result('newsarticles');
foreach ($view as $key => $vnode) {
	$nid = $vnode->nid  ;
	$anode = node_load( $nid ) ;
	$results[$key] = $anode ;
	// $results[$nid]['fields'] = field_attach_view('node', $anode,'full' ) ; 
	// print render ( $result[$nid]->field_featured  ) ; 
}
// dpm($page);  print $messages ;
?>
<body class="search">
<header>
  <div id="top">
    <div class="content">
      <div class="account">
		<?php if (!$logged_in) { ?>
        <a href="<?php print $base_url?>/user/login" title='Login'>Login</a> or
        <a href="<?php print $base_url;?>/user/register" title='Create a new account'>Create a new account</a>
		<?php } else { ?>
			<?php if ($user->uid) { ?>
			<a href="<?php print $base_url;?>/user/<?php print ($user->uid) ?>/edit">Hello <?php print ( $user->name);?></a>
			<a href="<?php print $base_url;?>/user/logout">&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
			<?php } ?>
		<?php } ?>

      </div>

      <div id="logo">
        <a href="<?php print $base_url;?>/" class="logo"><img src="<?php print $dataportal_base_url;?>/img/header/logo.png"/></a>

        <h1><a href="<?php print $base_url;?>" title="GBIF.ORG">GBIF.ORG</a></h1>
        <span>Free and open access to biodiversity data</span>
      </div>

		<a class="disclaimerToggle" href="/portal/disclaimer">
		<img src="<?php echo $dataportal_base_url?>/img/beta.gif">
		</a>
	<?php get_nav($base_url) ?>
    </div>
  </div>
  <!-- /top -->
	<?php $taxon = get_title_data() ; ?>
	<div id="infoband">
		<div class="content">
		<?php $taxon = get_title_data() ; ?>
		<h1>Peer-reviewed publications</h1>
		<h3>(via <a href="http://www.mendeley.com/groups/1068301/gbif-public-library/">Mendeley</a>)</h3>
		</div>
	</div>
	<div id="tabs">
		<div class="content">
			<ul>
				<li class='selected'><a href="#" title="Summary"><span>Information</span></a></li>
			</ul>
		</div>
	</div>
</header>
<div id="content">
	<article class="results">
		<header></header>
		<div class="content">
			<div class="header">
				<div class="left">
					<?php if ($title): ?>
						<h2><?php print $title; ?></h2>
					<?php endif; ?>
				</div>
			</div>
			<div class="left">
			<?php $type = arg(1) ; $res .= substr ($res,0,60) ; $res = preg_replace('/[^\x20-\x7E]/','', $type); 

			if ( $res ) {
					$block = module_invoke('npt_mendeley','full_list',$res);
				} else {
					$block = module_invoke('npt_mendeley','full_list','usecases');
				}
				print($block);
				?>
			</div>
		</div>

		<footer></footer>
	</article>
</div>
<?php get_footer($base_url) ?>
<?php get_bottom_js($base_url) ?>		
</body>