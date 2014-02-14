<?php 

global $user;
global $base_url ;
global $base_path ;
$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;

?>


<form action="<?php echo $base_url?>/user/register" method="post" autocomplete="off">
<?php	print render($form['form_id']); ?>
<?php	print render($form['form_build_id']); ?>

	<div class="light_box">
		<div class="content">
			<div class="field">
				<span class="input_text">
				<?php print render($form['account']['name']); ?>
				</span>
			</div>
			<div class="fields">
				<div class="field">
					<span class="input_text">
					<?php print render($form['field_firstname']); ?>
					</span>
				</div>
				<div class="field last">
					<span class="input_text">
					<?php print render($form['field_lastname']); ?>
					</span>
				</div>				

			</div>

			<div class="fields">
				<div class="field">
					<span class="input_text">
					<?php print render($form['account']['mail']); ?>
					</span>
				</div>

				<div class="field last">
					<?php print render($form['field_country']); ?>
				</div>
			</div>
			<div class="tl"></div> <div class="tr"></div> <div class="bl"></div> <div class="br"></div>
		</div>
	    <button type="submit" class="candy_white_button next"><span>Create new account</span></button>
    </div>
</form>
