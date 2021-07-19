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
    <h1>メール送信フォーム</h1>
  </head>
  <main>
    <form action="./confirm.php" method="post">
      <dl>
        <dt>送信先</dt>
        <dd><input type="text" name="to"></dd>
        <dt>件名</dt>
        <dd><input type="text" name="title"></dd>
        <dt>本文</dt>
        <dd><textarea name="content" id="" cols="30" rows="10"></textarea></dd>
      </dl>
      <input type="submit" name="send" value="メールを送信する">
    </form>
  </main>
</body>
</html>