<?php
  require 'config.php';
  require 'database.php';
  
  if (!isset($_GET['id'])) redirect();
  
  $id = $_GET['id'];
  
  $post = find_post_by_id($id);
  
  if (!$post) redirect();
  
  $g_title = BLOG_NAME . ' - ' . htmlspecialchars($post['title']);
  require 'header.php';
  require 'menu.php';
?>
  <div id="all_blogs">
    <div class="blog_post">
      <h2><?= htmlspecialchars($post['title']) ?></a></h2>
      <p>
        <small>
          <?= format_mysql_datetime($post['created_at']) ?>
        </small>
      </p>
      <div class='blog_content'>
        <?= nl2br(htmlspecialchars($post['content'])) ?>
      </div>
    </div>
  </div>
<?php
  require 'footer.php';
?>