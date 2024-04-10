<?php
  function create_database_connection() {
    $mysqli = new mysqli(DB_HOSTNAME, DB_USER, DB_PASSWORD, DB_DATABASE);
    $connect_error = mysqli_connect_errno();
    return array($mysqli, $connect_error);
  }
  
  function close_database_connection($mysqli, $connect_error) {
    if (isset($mysqli) && !$connect_error) {
      $mysqli->close();
    }
  }

  function find_all_blogs($limit = false) {
    list($mysqli, $connect_error) = create_database_connection();
    
    $blogs = array();
    
    if (!$connect_error) {
    
      $sql = "SELECT * FROM posts ORDER BY created_at DESC";
      if ($limit) {
        $sql .= " LIMIT $limit";
      }
      
      $result = $mysqli->query($sql);
      
      while ($row = $result->fetch_assoc()) {
        $row['created_at'] = format_mysql_datetime($row['created_at']);
        $blogs[] = $row;
      }
      
    }
  
    close_database_connection($mysqli, $connect_error);
    
    return $blogs;
  }
  
  function create_new_post($title, $content) {
    list($mysqli, $connect_error) = create_database_connection();
    
    if (!$connect_error) {
      $sql = "INSERT INTO posts (title,content,created_at) value ('$title', '$content', null)";
      $result = $mysqli->query($sql);
    }
    
    close_database_connection($mysqli, $connect_error);
    
    return $result;
  }
  
  function find_post_by_id($id) {
    if (!is_numeric($id)) return false;
    
    list($mysqli, $connect_error) = create_database_connection();
    $post = false;
    
    if (!$connect_error) {
      $sql = "SELECT * from posts WHERE id = $id";
      $result = $mysqli->query($sql);
      if ($result->num_rows == 1) {
        $post = $result->fetch_assoc();
      }
    }
    
    close_database_connection($mysqli, $connect_error);
    
    return $post;
  }
?>
