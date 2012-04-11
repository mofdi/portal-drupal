<aside<?php print $attributes; ?>>
  <div<?php print $content_attributes; ?>>
    <?php
      if ($user->uid == 0) {
        print '<a href="' . $base_url . '/user">Log in</a> or <a href="' . $base_url . '/user/register">Create a new account</a>';
      }
      else {
        print t('Welcome, !username! ', array('!username' => theme('username', array('account' => $user))));
        print l(t('Log out'), 'user/logout', array('attributes' => array('class' => array('logout'))));
      }
      print $content;
    ?>
  </div>
</aside>