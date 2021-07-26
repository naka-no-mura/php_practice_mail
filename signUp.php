<?php

session_start();
require_once('dbconnect.php');

$name = (string)filter_input(INPUT_POST, 'name');
$email = (string)filter_input(INPUT_POST, 'email');
$password = (string)filter_input(INPUT_POST, 'password');

if (!empty($name && $email && $password)) {

  // eamilのバリデーション
  if (!preg_match("/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/", $email)) {
    $error[] = '入力された値が不正です';
    return false;
  }

  // パスワードのバリデーション
  if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $password)) {
    $password = password_hash($password, PASSWORD_DEFAULT);
  } else {
    $error[] = 'パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください。';
    return false;
  }

  if (empty($error)) {
    $randomString = bin2hex(random_bytes(32));
    $_SESSION['join'] = [
      'name' => $name,
      'email' => $email,
      'password' => $password,
      'randomString' => $randomString
    ];
    header('Location: check.php');
    exit();
  }

  if (isset($_SESSION['join'])) {
    $_POST = $_SESSION['join'];
  }

} else {
  $errors[] = '入力してください';
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規登録</title>
</head>
<body>
  <main>
    <header>
      <h1>新規登録</h1>
    </header>
    <body>
      <form action="" method="post">
        <label for="name">name</label>
        <input type="text" name="name"><br>
        <label for="email">email</label>
        <input type="email" name="email"><br>
        <label for="password">password</label>
        <input type="password" name="password"><br>
        <button type="submit">Sign Up!</button>
        <p>※パスワードは半角英数字をそれぞれ１文字以上含んだ、８文字以上で設定してください。</p>
      </form>
      <a href="login.php">ログイン画面へ</a>
      <hr>
      <h2>処理結果</h2>
      <p><?= $message['signUpSuccess'] ?></p>
      <?php foreach ($errors as $error): ?>
        <p><?= $error ?></p>
      <?php endforeach; ?>
    </body>
  </main>
</body>
</html>