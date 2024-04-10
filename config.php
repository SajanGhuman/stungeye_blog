<?php

  define('DEBUG',true);
  
  if (!DEBUG) {
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
  } else {
    error_reporting(E_ALL);
  }
  
  define('ADMIN_ADDRESS','blog_admin@mailinator.com');

  define('DB_HOSTNAME', 'localhost');
  define('DB_USER',     'DVWAadmin');
  define('DB_PASSWORD', 'password');
  define('DB_DATABASE', 'DVWA');
  
  define('BLOG_NAME','Stung Eye');
  define('BLOG_INDEX_NUM_POSTS',5);
  
  function format_mysql_datetime($datetime) {
    $time = strtotime($datetime);
    return date('F j, Y, g:i a', $time);
  }
  
  function redirect($script_name = 'index.php') {
    header("Location: $script_name");
    exit;
  }
?>