<?php
require_once "./dbc.php";
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>アップロードフォーム</title>
    <!-- <link rel="stylesheet" href="css/reset.css"> -->
    <link rel="stylesheet" href="css/style.css">
  </head>
  
  <body>
    <header>
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="input_form.php">登録画面</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="all_map.php">落とし物マップ</a></div>
            </div>
        </nav>
    </header> 
 
 <!-- 直近のものから降順に一覧表示 -->
 <p class="title2">落とし物一覧（最近のもの順）</p>
    <?php $files = getAllFile();
    foreach($files as $file):?>
      <div class="wrap">
        <div class = "text_output">
          <table class ="text_table" border = "1">
            <tr>
            <td width=30%>入力日時</td>
            <td><?php echo h("{$file['insert_date']}"); ?></td>
            </tr>
            <tr>
            <td>品名</td>
            <td><?php echo h("{$file['hinmei']}"); ?></td>
            </tr>
            <tr>
            <td>色</td>
            <td><?php echo h("{$file['color']}"); ?></td>
            </tr>
            <tr>
            <td>サイズ</td>
            <td><?php echo h("{$file['size']}"); ?></td>
            </tr>
            <tr>
            <td>ブランド・製造元</td>
            <td><?php echo h("{$file['brand']}"); ?></td>
            </tr>
            <tr>
            <td>発見後の対応</td>
            <td><?php echo h("{$file['description']}"); ?></td>
            </tr>
          </table>

          <!-- <button onclick="GetMap()">地図</button> -->
          <!-- <a href ="./map.php">地図</a> -->
          <div class="wrap">
              <form enctype="multipart/form-data" action="./map.php" method="post">
                <input type="hidden" name="hinmei" value= <?=$file['hinmei']?>>
                <input type="hidden" name="latitude" value= <?=$file['latitude']?>>
                <input type="hidden" name="longitude" value= <?=$file['longitude']?>>
                <input type="submit" value="地図" class="btn2"/>
                </form>
              <form enctype="multipart/form-data" action="./update_form.php" method="post">
                <input type="hidden" name="id" value= <?=$file['id']?>>
                <!-- <input type="hidden" name="color" value= <?=$file['color']?>>
                <input type="hidden" name="size" value= <?=$file['size']?>>
                <input type="hidden" name="brand" value= <?=$file['brand']?>>
                <input type="hidden" name="descriptin" value= <?=$file['description']?>> -->
                <input type="submit" value="更新" class="btn2"/>
              </form>
              <form enctype="multipart/form-data" action="./delete.php" method="post">
                <input type="hidden" name="id" value= <?=$file['id']?>>
                <input type="submit" value="削除" class="btn2"/>
              </form>
          </div>
          
        </div>
        <div class = "product_image">
          <img src="<?php echo "{$file['file_path']}"; ?>" alt="">
        </div>
      </div>
      <?php endforeach; ?>
    
  </body>
</html>