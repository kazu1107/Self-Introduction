<?php
if (isset($_POST['name'])) {
  $dsn = 'mysql:dbname=certification;charset=utf8';
  $user = 'kz';
  $password = '17830';
  $dbh = new PDO($dsn, $user, $password);

  $stmt = $dbh->prepare("SELECT * FROM users WHERE name=:user");
  $stmt->bindParam(':user', $_POST['name']);
  $stmt->execute();
  if ($rows = $stmt->fetch()) {
    if ($rows["password"] ==  $_POST['password']) {
      /*print "<p>ログイン成功</p>";*/
      header('Location: http://localhost:80/html/secret.html');
    } else {
      header('Location: http://localhost:80/html/password-err.html');
    }
  } else {
    header('Location: http://localhost:80/html/name-err.html');
  }
}
