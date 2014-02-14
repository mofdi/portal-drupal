<?php
global $user;
global $base_url ;
global $base_path ;
$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;
// dpm($form) ;
?>


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
    </div>
		<button type="submit" class="candy_white_button next"><span>Login</span></button>
    <div class="recover_password">
    <a class="signup_now" href="<?php echo $base_url; ?>/user/password" class="recover_password" title="Recover your password">Forgot your password?</a>
    <p> Do you need to sign up? <a href="<?php echo $base_url ; ?>/user/register" class="signup_now" title="Signup now">Create your account</a></p>
    </div>
</form>
