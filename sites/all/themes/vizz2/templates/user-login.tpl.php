<?php
global $user;
global $base_url ;
global $base_path ;
$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
// dpm($form) ;
?>

<form action="<?php echo $base_url?>/user/register" method="post" autocomplete="off">
<?php	print render($form['form_id']); ?>
<?php	print render($form['form_build_id']); ?>

	<div class="light_box">
		<div class="content">
				<span class="input_text">
				<?php print render($form['name']); ?>
				</span>
				
				<span class="input_text">
				<?php print render($form['pass']); ?>
				</span>

			<div class="tl"></div> <div class="tr"></div> <div class="bl"></div> <div class="br"></div>
		</div>
	    <button type="submit" class="candy_white_button next"><span>Login</span></button>
    </div>
</form>
