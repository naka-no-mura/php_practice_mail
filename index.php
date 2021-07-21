<?php

function h($str){
  return htmlspecialchars($str, ENT_QUOTES, 'utf-8');
}

session_start();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>index.php</title>
</head>
<body>
  <main>
    <header>
      <h1>index.php</h1>
    </header>
    <body>
      <a href="login.php">ログイン画面へ</a><br>
      <a href="signUp.php">新規登録画面へ</a>
    </body>
  </main>
</body>
</html>