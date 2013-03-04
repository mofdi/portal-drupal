<?php


global $user;
global $base_url ;
global $base_path ;
$dataportal_base_url = theme_get_setting( 'vizz2_dataportal_base_url','vizz2' ) ;


?>

<?php if ($user->name) { ?>


<a href="<?php print $base_url;?>/user/<?php print ($user->uid) ?>/edit">... edit your profile</a>

<?php } ?>

</br>
</br>

<?php print render($user_profile); ?>

