<div class="container">
  <div class="row">
    <div class="col-md-9 well well-lg well-margin-top">
      <form action="<?php echo $base_url?>/user/register" method="post" autocomplete="off">
      
        <div class="row user-login-row">
          <div class="subscribe">
            <?php	print render($form['form_id']); ?>
            <?php	print render($form['form_build_id']); ?>
            <?php	print render($form['form_token']); ?>
    				<?php print render($form['field_firstname']); ?>
    				<?php print render($form['field_lastname']); ?>
    				<?php print render($form['account']['mail']); ?>
    				<?php print render($form['account']['current_pass']); ?>
    				<?php print render($form['account']['pass']); ?>
    				<?php print render($form['field_country']); ?>
          </div>
        </div>
        <div class="row user-login-action">
    	    <button type="submit" class="btn btn-primary"><span>Save account settings</span></button>
        </div>
      </form>
    </div>
  </div>
</div>