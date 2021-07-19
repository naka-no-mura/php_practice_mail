<?php

mb_language('Japanese');
mb_internal_encoding('UTF-8');

$to = $_POST['to'];
$title = $_POST['title'];
$message = $_POST['content'];
$headers = "From: test@test.com";

if (mb_send_mail($to, $title, $message, $headers)) {
  echo 'メール送信成功です';
} else {
  echo 'メール送信失敗です';
}

phpinfo();
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
    <h1>メール送信</h1>
  </head>
</body>
</html>