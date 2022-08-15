<?php
if (isset($_POST['text'])) {
  $dsn = 'mysql:dbname=to_do_list;charset=utf8';
  $user = 'kz';
  $password = '17830';
  $dbh = new PDO($dsn, $user, $password);

  $text   = $_REQUEST['text'];
  $sql = "INSERT INTO to_do (text) VALUES (:text)";
  $stmt = $dbh->prepare($sql);
  $params = array(':text' => $text);
  $stmt->execute($params);

  header('Location: http://localhost:80/html/to_do_list.php');
}
