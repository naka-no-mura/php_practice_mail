<?php

session_start();
require_once('dbconnect.php');

if (!isset($_SESSION['join'])) {
  header('Location: signUp.php');
  exit();
}

if (!empty($_POST['action'])) {
// 登録処理
  $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES(?, ?, ?)");
  $stmt->execute([
    $_SESSION['join']['name'],
    $_SESSION['join']['email'],
    $_SESSION['join']['password'],
  ]);

  $user = $pdo->prepare("SELECT id FROM users WHERE name = :name");
  $user->execute([':name' => $_SESSION['join']['name']]);
  $userId = $user->fetchAll();

  $random = $pdo->prepare("INSERT INTO cookies (user_id, random_string) VALUES(:user_id, :random_string)");
  $random->execute([
    ':user_id' => $userId[0]['id'],
    ':random_string' => $_SESSION['join']['randomString']
  ]);

  header('Location: thanks.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規登録の確認画面</title>
</head>
<body>
  <main>
    <header>
      <h1>新規登録の確認画面</h1>
    </header>
    <body>
      <form action="" method="post">
        <input type="hidden" name="action" value="submit">
        <dl>
          <dt>名前</dt>
          <dd><?php print(htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES)); ?></dd>
          <dt>メールアドレス</dt>
          <dd><?php print(htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES)); ?></dd>
          <dt>パスワード</dt>
          <dd><?php print(htmlspecialchars($_SESSION['join']['password'], ENT_QUOTES)); ?></dd>
          <dt>randomString</dt>
          <dd><?php print(htmlspecialchars($_SESSION['join']['randomString'], ENT_QUOTES)); ?></dd>
        </dl>
        <input type="submit" value="登録する">
      </form>
      <hr>
    </body>
  </main>
</body>
</html>