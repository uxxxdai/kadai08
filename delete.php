<?php
header('Expires: Tue, 1 Jan 2019 00:00:00 GMT');
header('Last-Modified:'. gmdate( 'D, d M Y H:i:s' ). 'GMT');
header('Cache-Control:no-cache,no-store,must-revalidate,max-age=0');
header('Cache-Control:pre-check=0,post-check=0',false);
header('Pragma:no-cache');
require_once "./dbc.php";

//1.Delete_Flagを設置
$id = $_POST['id'];

//2.DBに接続
$pdo = dbc();


//3.データ登録SQL作成
$stmt = $pdo->prepare('UPDATE otoshimono_table 
                SET delete_flag = 1
                WHERE id = :id;
                ');

$stmt->bindValue(':id', $id, PDO::PARAM_INT);
var_dump($stmt);
$status = $stmt->execute(); //実行

//4.データ登録処理後
if ($status === false) {
    sql_error($stmt);
} else {
    redirect('list.php');
}