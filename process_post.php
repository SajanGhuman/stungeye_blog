<?php
  require 'config.php';
  require 'database.php';
  
  function validated_post($title, $content) {
    return ((strlen($title) >= 1) && (strlen($content) >= 1));
  }
  
  if (!$_POST || !isset($_POST['command']) || !isset($_POST['title']) || !isset($_POST['content'])) {
    redirect();
  }
  
  $title = $_POST['title'];
  $content = $_POST['content'];
  
  if (!validated_post($title, $content)) {
    $error_msg = 'Both the title and content must be at least one character.';
  } else if (create_new_post($title, $content)) {
    redirect();
  } else {
    $error_msg = 'Database submission error. [create]';
  }

  $g_title = "";
  // We will only reach this portion of the code if something has gone wrong and we haven't redirected.  
  require 'header.php';
?>

<h1>An error occured while processing your post.</h1>
<p>
  <?= $error_msg ?>
</p>
<a href="index.php">Return Home</a>

<?php
  require 'footer.php';
?>
