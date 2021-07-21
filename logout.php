<?php

session_start();
$output = '';

if (isset($_SESSION['EMAIL'])) {
  $output = 'Logoutしました';
} else {
  $output = 'SessionがTimeoutしました';
}

// セッション変数のクリア
$_SESSION = array();

// セッションクッキーも削除
if (ini_get("session.use_cookies")) {
  $params = session_get_cookie_params();
  setcookie(session_name(), '', time() -42000,
    $params['path'], $params['domein'], $params['secure'], $params['httponly']
  );
}
session_destroy();

echo $output;

?>