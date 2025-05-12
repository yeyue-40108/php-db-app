<?php
$dsn = 'mysql:dbname=inryk91mz0jsr15g;host=am1shyeyqbxzy8gc.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;charset=utf8mb4';
$user = 'eb8g4cbbn4gapjz1';
$password = 'inj3di9igzfl422j';

try {
    $pdo =new PDO($dsn, $user, $password);

    // idカラムの値をプレースホルダ（:id）に置き換えたSQL文をあらかじめ用意する
    $sql_delete = 'DELETE FROM products WHERE id = :id';
    $stmt_delete = $pdo->prepare($sql_delete);

    // bindValue()メソッドを使って実際の値をプレースホルダにバインドする（割り当てる）
    $stmt_delete->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

    // SQL文を実行する
    $stmt_delete->execute();

    // 削除した件数を取得する
    $count = $stmt_delete->rowCount();

    $message = "商品を{$count}件削除しました。";

    // 商品一覧ページにリダイレクトさせる（同時にmessageパラメータも渡す）
    header("Location: read.php?message={$message}");
} catch (PDOException $e) {
    exit($e->getMessage());
}