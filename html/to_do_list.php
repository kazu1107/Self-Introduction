<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>Self-Introduction</title>
  <link rel="stylesheet" href="../css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/favicon/favicon.ico" id="favicon">
</head>

<body>
  <header class="header">
    <div class="header-layout">
      <h1>Self-Introduction</h1>
      <div class="btn">
        <a href="./certification.html">Secret</a>
      </div>
    </div>
    <div id="menu-box">
      <div id="toggle"><a href="#">menu</a></div>
      <ul id="menu" class="">
        <li><a href="./index.html">TOP</a></li>
        <li><a href="./about.html">ABOUT</a></li>
        <li><a href="./history.html">HISTORY</a></li>
        <li><a href="./favorite.html">FAVORITE</a></li>
        <li><a href="./to_do_list.html">TO DO LIST</a></li>
      </ul>
    </div>
  </header>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <h1 style="text-align: center; margin-top: 120px;font-size: 320%;">TO DO LIST</h1>
  <form action="../php/add_to_do.php" method="post" class="add_to_do_list" style="display: flex; justify-content: center;">
    <textarea required name="text" size="10" value="" style="width: 60%;" placeholder="ここに内容を入力してください"></textarea><br />
    <br />
    <input type="submit" value="追加" style="width: 10%;" />
  </form>

  <?php

  header("Content-type: text/html; charset=utf-8");

  require_once("../php/db_connect.php");
  $mysqli = db_connect();

  $sql = "SELECT * FROM to_do";

  $result = $mysqli->query($sql);

  //クエリー失敗
  if (!$result) {
    echo $mysqli->error;
    exit();
  }

  //連想配列で取得
  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $rows[] = $row;
  }

  //結果セットを解放
  $result->free();

  // データベース切断
  $mysqli->close();

  ?>

  <!DOCTYPE html>
  <html>

  <head>
    <title>text一覧</title>
  </head>

  <body>
    <h1 style="text-align: center;">text一覧</h1>

    <table border='1' style="width: 65%;">
      <tr>
        <td style="text-align: center; font-size: 13px;">text</td>
        <td style="width: 25%; font-size: 13px;">textを削除する</td>
      </tr>

      <?php
      foreach ($rows as $row) {
      ?>

        <tr>
          <td><?= htmlspecialchars($row['text'], ENT_QUOTES, 'UTF-8') ?></td>
          <td>
            <form action="../php/delete_to_do.php" method="post">
              <input type="submit" value="削除する">
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
            </form>
          </td>
        </tr>

      <?php
      }
      ?>

    </table>

  </body>

  </html>

  <script>
    $(function() {
      $("#toggle").click(function() {
        $("#menu").slideToggle();
        return false;
      });
      $(window).resize(function() {
        var win = $(window).width();
        var p = 480;
        if (win > p) {
          $("#menu").show();
        }
      });
    });
  </script>
  <footer>
    <div class="foot-wrap">
      <div class="menu-left">
        <h3>MENU</h3>
        <ul class="foot-left">
          <li><a href="./index.html">TOP</a></li>
          <li><a href="./about.html">ABOUT</a></li>
          <li><a href="./history.html">HISTORY</a></li>
          <li><a href="./favorite.html">FAVORITE</a></li>
          <li><a href="./to_do_list.html">TO DO LIST</a></li>
        </ul>
      </div>
      <div class="menu-center">
        <h3>Link</h3>
        <ul class="foot-center">
          <li><a href="https://github.com/kazu1107">Github</a></li>
        </ul>
      </div>

      <small class="cmark">:copyright:copyright 2022
        <font color="white">Self-Introduction.</font>
      </small>
    </div>
  </footer>
</body>

</html>
