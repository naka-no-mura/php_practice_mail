<?php

$to = (string)filter_input(INPUT_POST, 'to');
$title = (string)filter_input(INPUT_POST, 'title');
$message = (string)filter_input(INPUT_POST, 'content');

$errors = [];
$returnPath = '-f'.'test@test.com';
$headers = "From: test@test.com";

mb_language('Japanese');
mb_internal_encoding('UTF-8');

if (!empty($to)) {
  if (filter_var($to, FILTER_VALIDATE_EMAIL)) {
    $to;
  } else {
    $to = '';
    $errors[] = 'メールアドレスが不正な形式です';
  }
} else {
  $errors[] = 'メールアドレスが入力されていません';
}

if (!empty($title)) {
  if (mb_strlen($title) > 40) {
    $errors[] = '件名は40文字以内で入力してください';
  } else {
    $title;
  }
} else {
  $errors[] = '件名が入力されていません';
}

if (!empty($to && $title)) {
  if (mb_send_mail($to, $title, $message, $headers, $returnPath)) {
    echo 'メール送信成功です';
  } else {
    echo 'メール送信失敗です';
  }
} else {
  $errors[] = '入力欄を確認してください';
  $errors[] = 'メール送信失敗です';
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メールの送信練習</title>
</head>
<body>
  <head>
    <h1>メール送信の確認</h1>
  </head>
  <main>
    <p>
      <?php foreach ($errors as $error): ?>
        <p><?php echo $error; ?></p>
      <?php endforeach; ?>
    </p>
  </main>
</body>
</html>