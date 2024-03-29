<?php

header("Content-type: text/html; charset=utf-8");

require_once("db_connect.php");
$mysqli = db_connect();

if(empty($_POST)) {
	echo "<a href='../html/to_do_list.php'>to_do_list.php</a>←こちらのページからどうぞ";
	exit();
}else{
	if (!isset($_POST['id'])  || !is_numeric($_POST['id']) ){
		echo "IDエラー";
		exit();
	}else{
		//プリペアドステートメント
		$stmt = $mysqli->prepare("DELETE FROM to_do WHERE id=?");
		
		if($stmt){
			//プレースホルダへ実際の値を設定する
			$stmt->bind_param('i', $id);
			$id = $_POST['id'];
					
			$stmt->execute();
			
			//変更された行の数が1かどうか
			if($stmt->affected_rows == 1){
				header('Location: http://localhost:80/html/to_do_list.php');
			}else{
				echo "削除失敗です";
			}
		
			//ステートメント切断
			$stmt->close();
		}else{
			echo $mysqli->errno . $mysqli->error;
		}
	}
}

// データベース切断
$mysqli->close();
		
?>
