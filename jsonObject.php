<?php

session_start();
require_once('dbconnect.php');

$json_btn = (string)filter_input(INPUT_POST, 'json_btn');
$object_btn = (string)filter_input(INPUT_POST, 'object_btn');

if ($json_btn) {
  $stmt = $pdo->query('SELECT * FROM users');
  $stmt->execute();
  $json = $stmt->fetchAll();
  $json = json_encode($json);
}

if ($object_btn) {
  $stmt = $pdo->query('SELECT * FROM users');
  $stmt->execute();
  $object = $stmt->fetchAll();
  $object = json_encode($object);
  $object = json_decode($object,true);
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JSONとオブジェクト＄連想配列の変換画面</title>
</head>
<body>
  <header>
    <h1>JSONとオブジェクト＄連想配列の変換画面</h1>
  </header>
  <main>
    <form action="" method="post">
      <input type="hidden" name="json_btn" value="json_btn">
      <dl>
        <dt>【JSON】users情報をDBからJSONで返す</dt>
        <dd><input type="submit"></dd>
      </dl>
    </form>
    <form action="" method="post">
      <input type="hidden" name="object_btn" value="object_btn">
      <dl>
        <dt>【Object】users情報をDBからObjectで返す</dt>
        <dd><input type="submit"></dd>
      </dl>
    </form>
    <hr>
    <dl>
      <dt>JSONの結果</dt>
      <dd><?= var_dump($json) ?></dd>
      <dd><?= print_r($json) ?></dd>
      <dt>Objectの結果</dt>
      <dd><?= var_dump($object) ?></dd>
      <dd><?= print_r($object) ?></dd>
    </dl>
  </main>
</body>
</html>