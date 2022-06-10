<?php
header('Expires: Tue, 1 Jan 2019 00:00:00 GMT');
header('Last-Modified:'. gmdate( 'D, d M Y H:i:s' ). 'GMT');
header('Cache-Control:no-cache,no-store,must-revalidate,max-age=0');
header('Cache-Control:pre-check=0,post-check=0',false);
header('Pragma:no-cache');
require_once "./dbc.php";

//1.更新するデータのidを取得
$id = $_POST['id'];

//2.DBに接続
$pdo = dbc();

//3.データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM otoshimono_table WHERE id = :id");

$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//３．データ表示
$view = '';
if ($status === false) {
    sql_error($stmt);
} else {
    $result = $stmt->fetch();
    // var_dump($result);
}

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>更新フォーム</title>
    <!-- <link rel="stylesheet" href="css/reset.css"> -->
    <link rel="stylesheet" href="css/style.css">
  </head>
  
  <body>
    <header>
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="list.php">落とし物一覧</a></div>
            </div>
        </nav>
    </header>
    <form enctype="multipart/form-data" class = "upload_form" action="./file_update.php" method="post">
      <p class="title">落とし物登録DB【更新】</P>
      <div class="file-up">
        <input type="hidden" id="image_update" name="image_update" value="0" />  
        <p class = "checkbox">変更無し：<input type="checkbox" id="image_update" name="image_update" value="1" checked/></p>
        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
        <!-- <input name="img" type="file" accept="image/*" onclick="checkbox_check()"/> -->
        <input name="img" type="file" accept="image/*"/>
        <div class="file_confirm"><?= $result['file_name'] ?> を変更の場合は、☑ボックスの✓を外してから「ファイルを選択」を押してください。</div>
        <input type="hidden" name="file_name" value="<?= $result['file_name'] ?>"/>
        <input type="hidden" name="file_path" value="<?= $result['file_path'] ?>"/>
        <input type="hidden" name="id" value="<?= $result['id'] ?>"/>
      </div>
      <p class = "lati_long">緯度：<input type="text" name="latitude" value="<?= $result['latitude']?>" style=border:none; readonly/></P>
      <p class = "lati_long">経度：<input type="text" name="longitude" value="<?= $result['longitude']?>" style=border:none; readonly/></P>
      <div>
        <p>品名（必須）</P>
        <input class = "input_text" type="text" name="hinmei" value="<?= $result['hinmei']?>" required/>
        <p>色（任意）</P>
        <input class = "input_text" type="text" name="color" value="<?= $result['color']?>"/>
        <p>サイズ（任意）</P>
        <input class = "input_text" type="text" name="size" value="<?= $result['size']?>"/>
        <p>ブランド・製造元（任意）</P>
        <input class = "input_text" type="text" name="brands" id="brands" value="<?= $result['brand']?>"/>
        <p class = "after_found">発見後の対応（必須）（etc.公園のベンチに置いてきた。●●警察に届けた等）</P>
        <textarea
          name="caption"
          id="caption" 
          required><?= $result['description']?></textarea>
      </div>
      <div class="submit">
        <input type="submit" value="送信" class="btn"/>
      </div>
    </form>
<!-- <?php
  //   function checkbox_check(){
  //     $test_alert = "<script type='text/javascript'>alert('こんにちは！侍エンジニアです。');</script>";
  //     if(document.getElementById('image_update').checked) {
  //       return;
  //   }
  // }
?> -->