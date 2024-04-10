<?php
  if (!isset($g_page)) {
      $g_page = '';
  }
?>
<ul id="menu">
    <li><a href="index.php" <?= ($g_page == 'index') ? "class='active'" : '' ?>>Home</a></li>
    <li><a href="create.php" <?= ($g_page == 'create') ? "class='active'" : '' ?>>New Post</a></li>
    <li><a href="privacy_policy.php" <?= ($g_page == 'privacy_policy') ? "class='active'" : '' ?>>Privacy Policy</a></li>
    <li><a href="login.php" <?= ($g_page == 'login') ? "class='active'" : '' ?>>Login</a></li>
    <li><a href="register.php" <?= ($g_page == 'register') ? "class='active'" : '' ?>>Register</a></li>
</ul>
