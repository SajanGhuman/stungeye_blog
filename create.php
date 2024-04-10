<?php
  require 'config.php';
  require 'database.php';
  $g_title = BLOG_NAME . ' - New Post';
  $g_page = 'create';
  require 'header.php';
  require 'menu.php';
?>
<div id="all_blogs">
  <form action="process_post.php" method="post">
    <fieldset>
      <legend>New Blog Post</legend>
      <p>
        <label for="title">Title</label>
        <input name="title" id="title" />
      </p>
      <p>
        <label for="content">Content</label>
        <textarea name="content" id="content"></textarea>
      </p>
      <p>
        <input type="submit" name="command" value="Create" />
      </p>
    </fieldset>
  </form>
</div>
<?php
  require 'footer.php';
?>