<?php

try {
    // DB接続
    $pdo = new PDO(
        // ホスト名、データベース名
        'mysql:charset=UTF8;
        host=127.0.0.1;
        dbname=to_do_list;',
        // ユーザー名
        'root',
        // パスワード
        'root0629',
        // レコード列名をキーとして取得させる
        [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );

    // SQL文をセット
    $stmt = $pdo->prepare("DELETE FROM to_do WHERE id = :id");

    $id = $_POST['id'];
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			
					
			$stmt->execute();


  } catch (PDOException $e) {
    // エラー発生
    echo $e->getMessage();

} finally {
    // DB接続を閉じる
    $pdo = null;
}
header('Location: http://localhost:80/html/to_do_list.php');

?>
