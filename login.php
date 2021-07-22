<?php

session_start();
require_once('dbconnect.php');

$email = (string)filter_input(INPUT_POST, 'email');
$password = (string)filter_input(INPUT_POST, 'password');

if ($_COOKIE['email'] != '') {
  $email = $_COOKIE['email'];
  $password = $_COOKIE['password'];
  $_POST['save'] = 'on';
}

if (!empty($email && $password)) {

  // メールアドレスのバリデーション
  if (!preg_match("/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/", $email)) {
    $errors[] = '入力された値が不正です';
    return false;
  }

  // メールアドレスで照合
  try {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();
  } catch (PDOException $e) {
    $errors[] = $e->getMessage();
  }

  // メールアドレスで照合してユーザが見つかったらハッシュ化したパスワードを比べて合致すればログイン成功
  if ($user) {
    if (password_verify($password, $user['password'])) {
      $_SESSION['id'] = $user['id'];
      $_SESSION['time'] = time();

      if ($_POST['save'] === 'on') {
        $stmt = $pdo->prepare('SELECT random_string FROM cookies WHERE id = ?');
        $stmt->execute([$user['id']]);
        $random = $stmt->fetchAll();
        setcookie('email', $email, time()+60*60*24*14);
        setcookie('password', $password, time()+60*60*24*14);
        setcookie('randomString', $random, time()+60*60*24*14);
      }

      header('Location: mailform.php');
      exit();
    } else {
      $errors[] = 'メールアドレスまたはパスワードが間違っています';
    }
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
  <title>ログイン</title>
</head>
<body>
  <main>
    <header>
      <h1>ログイン画面</h1>
    </header>
    <body>
      <form  action="" method="post">
        <label for="email">email</label>
        <input type="email" name="email" value="<?php print(htmlspecialchars($email, ENT_QUOTES)); ?>"><br>
        <label for="password">password</label>
        <input type="password" name="password"><br>
          <input id="save" type="checkbox" name="save" value="on">
          <label for="save">次回からは自動的にログインする</label>
        <button type="submit">Sign In!</button>
      </form>
      <hr>
      <h2>処理結果</h2>
      <p><?= $_SESSION['join']['email'] ?></p>
      <?php foreach ( $_COOKIE as $cookie): ?>
        <p><?= var_dump($cookie) ?></p>
      <?php endforeach; ?>
      <?php foreach ($errors as $error): ?>
        <p><?= $error ?></p>
      <?php endforeach; ?>
    </body>
  </main>
</body>
</html>