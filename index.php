<?php
  require 'config.php';
  require 'database.php';
  $g_title = BLOG_NAME . ' - Index';
  $g_page = 'index';
  require 'header.php';
  require 'menu.php';
  
  $posts = find_all_blogs(BLOG_INDEX_NUM_POSTS);
?>
<div id="all_blogs">
  <?php foreach($posts as $post): ?>
    <div class="blog_post">
      <h2><a href="show.php?id=<?=$post['id']?>"><?= htmlspecialchars($post['title']) ?></a></h2>
      <p>
        <small>
          <?= $post['created_at'] ?>
        </small>
      </p>
      <div class='blog_content'>
        <?= nl2br(htmlspecialchars($post['content'])) ?>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<?php
  require 'footer.php';
?>
