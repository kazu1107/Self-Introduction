<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>Self-Introduction</title>
  <link rel="stylesheet" href="../css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <header class="header">
    <div class="header-layout">
      <h1>Self-Introduction</h1>
      <div class="btn">
        <a href="./index.html">Top</a>
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
  <form action="../php/add_to_do.php" method="post">
    Form:<br />
    <input type="text" name="text" size="10" value="" required/><br />
    <br />
    <input type="submit" value="保存する" />
  </form>

  

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
