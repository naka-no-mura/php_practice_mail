<?php

$to = (string)filter_input(INPUT_POST, 'to');
$title = (string)filter_input(INPUT_POST, 'title');
$message = (string)filter_input(INPUT_POST, 'content');

$errors = [];
$returnPath = '-f'.'test@test.com';
// 送信元
$from = "練習用アカウント";

// 送信元メールアドレス
// 動作確認時にMacに登録したメアドへ書き換える
$from_mail = "test@test.com";

// 送信者名
$from_name = "メール送信練習アカウント";

// 送信者情報の設定
// $headers = "From: test@test.com";
$headers = [
  // メール形式
  "Content-Type: text/plain \r\n",
  // 送信先メールアドレスが受け取り不可の場合に、エラー通知のいくメールアドレス
  "Return-Path: " . $from_mail . " \r\n",
  // 送信者の名前（または組織名）とメールアドレス
  "From: " . $from ." \r\n",
  // 送信者の名前（または組織名）とメールアドレス
  "Sender: " . $from ." \r\n",
  // 受け取った人に表示される返信の宛先
  "Reply-To: " . $from_mail . " \r\n",
  // 送信者名（または組織名）
  "Organization: " . $from_name . " \r\n",
  // 送信者のメールアドレス
  "X-Sender: " . $from_mail . " \r\n",
  // メールの重要度を表す
  "X-Priority: 3 \r\n"
];

mb_language('Japanese');
mb_internal_encoding('UTF-8');

if (!empty($to)) {
  if (preg_match("/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/", $to)) {
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