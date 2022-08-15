<?php

header("Content-type: text/html; charset=utf-8");

require_once("db_sample01.php");
$mysqli = db_connect();

$sql = "SELECT * FROM to_do";

$result = $mysqli -> query($sql);

//クエリー失敗
if(!$result) {
	echo $mysqli->error;
	exit();
}

//連想配列で取得
while($row = $result->fetch_array(MYSQLI_ASSOC)){
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
<h1>text一覧</h1> 

<table border='1'>
<tr><td>text</td><td>textを削除する</td></tr>

<?php 
foreach($rows as $row){
?>

<tr> 
	<td><?=htmlspecialchars($row['text'], ENT_QUOTES, 'UTF-8')?></td>
	<td>
		<form action="delete2.php" method="post">
		<input type="submit" value="削除する">
		<input type="hidden" name="id" value="<?=$row['id']?>">
		</form>
	</td>
</tr>

<?php 
} 
?>

</table>

</body>
</html>
