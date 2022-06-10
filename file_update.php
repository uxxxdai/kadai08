<?php
header('Expires: Tue, 1 Jan 2019 00:00:00 GMT');
header('Last-Modified:'. gmdate( 'D, d M Y H:i:s' ). 'GMT');
header('Cache-Control:no-cache,no-store,must-revalidate,max-age=0');
header('Cache-Control:pre-check=0,post-check=0',false);
header('Pragma:no-cache');
?>

<?php
require_once "./dbc.php";

$file = $_FILES['img'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$upload_dir = 'images/';
$save_filename = date('YmdHis').$filename;
$err_msgs = array();
$save_path = $upload_dir . $save_filename;
$post = $_POST;
$id = $_POST['id'];

// 「品名」などについて入力値チェック
$hinmei = filter_input(INPUT_POST, 'hinmei', FILTER_SANITIZE_SPECIAL_CHARS);
$color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_SPECIAL_CHARS);
$size = filter_input(INPUT_POST, 'size', FILTER_SANITIZE_SPECIAL_CHARS);
$brands = filter_input(INPUT_POST, 'brands', FILTER_SANITIZE_SPECIAL_CHARS);
$latitude = filter_input(INPUT_POST, 'latitude', FILTER_SANITIZE_SPECIAL_CHARS);
$longitude = filter_input(INPUT_POST, 'longitude', FILTER_SANITIZE_SPECIAL_CHARS);

// 「発見後の対応」について入力値チェック
$caption = filter_input(INPUT_POST, 'caption', FILTER_SANITIZE_SPECIAL_CHARS);
if(empty($caption)){
    array_push($err_msgs,'キャプションを入力してください。');
    echo '<br>';
}
if(strlen($caption)>140){
    array_push($err_msgs,'140文字以内で入力して下さい');
    echo '<br>';
}

//imageの変更なしチェックがついてる場合は、写真の更新はできない。ついてない場合は前のファイルパスをそのまま伝える
if ($post['image_update']!=null){
        $image_update = $post['image_update'];
    }else{
        $image_update = "0";
    };
if($file['name']=="" && $image_update=="0"){
    array_push($err_msgs,'ファイルを添付してください。（もしくは変更ない場合チェックを付けてください）');
    echo '<br>';
}

if($file['name']!="" && $image_update=="1"){
    array_push($err_msgs,'画像を変更する場合はチェックを外してください');
    echo '<br>';
}

if($file['name'] =="" && $image_update=="1"){
    $filename = $_POST['file_name'];
    $save_path = $_POST['file_path'];
    // var_dump($save_path);
    // echo ('<br>');
}

// 「発見後の対応」について入力値チェック
$caption = filter_input(INPUT_POST, 'caption', FILTER_SANITIZE_SPECIAL_CHARS);


if(empty($caption)){
    array_push($err_msgs,'キャプションを入力してください。');
    echo '<br>';
}
if(strlen($caption)>140){
    array_push($err_msgs,'140文字以内で入力して下さい');
    echo '<br>';
}

// アップロードされる画像についてチェック
if($filesize > 1048576 || $file_err == 2){
    echo $file;
    array_push($err_msgs, $filesize.$file_err.'ファイルサイズは１MB以内にしてくさい');
    echo '<br>';
}
$allow_ext = array('jpg','jpeg','png');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

if(!in_array(strtolower($file_ext),$allow_ext)){
    array_push($err_msgs,'画像ファイルを添付してください');
    echo '<br>';
}

//エラーなくばファイル保存とDB更新


if (count($err_msgs) === 0){
    if (is_uploaded_file($tmp_path)){
        //テンポラリフォルダから規定のフォルダに画像を保存
        if(move_uploaded_file($tmp_path, $save_path)){
            // echo $filename . 'を' . $upload_dir . 'にアップしました。';
            $result = fileUpdate($id, $filename, $save_path, $hinmei, $color, $size, $brands, $caption, $latitude, $longitude);
            // //各データのDB更新
            // $id = $_POST['id'];
            // $pdo = dbc();
            // $stmt = $pdo->prepare('UPDATE otoshimono_table 
            //     SET file_name = :filename, file_path = :save_path, hinmei = :hinmei, 
            //                 color = :color, size = :size, brand = :brand, 
            //                 description = :description, update_date = sysdate(), 
            //                 latitude = :latitude, longitude = :longitude
            //     WHERE id = :id;
            //     ');
            // // 数値の場合 PDO::PARAM_INT
            // // 文字の場合 PDO::PARAM_STR
            // $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            // $stmt->bindValue(':filename', $filename, PDO::PARAM_STR);
            // $stmt->bindValue(':save_path', $save_path, PDO::PARAM_STR);
            // $stmt->bindValue(':hinmei', $hinmei, PDO::PARAM_STR);
            // $stmt->bindValue(':color', $color, PDO::PARAM_STR);
            // $stmt->bindValue(':size', $size, PDO::PARAM_STR);
            // $stmt->bindValue(':brand', $brands, PDO::PARAM_STR);
            // $stmt->bindValue(':description', $caption, PDO::PARAM_STR);
            // $stmt->bindValue(':latitude', $latitude, PDO::PARAM_STR);
            // $stmt->bindValue(':longitude', $longitude, PDO::PARAM_STR);
           
            // $result = $stmt->execute(); //実行

            if($result){
                echo 'データベースを更新しました！';
            }else{
                echo 'データベース更新が失敗しました';
            }
        } else{
        echo 'ファイルが保存できませんでした。';
        }
    } else {
        $result = fileUpdate($id, $filename, $save_path, $hinmei, $color, $size, $brands, $caption, $latitude, $longitude);
        if($result){
            echo 'データベースを更新しました！';
        }else{
            echo 'データベース更新が失敗しました';
        }
    }
}else{
    foreach($err_msgs as $msg){
        echo $msg;
        echo '<br>';
    }
}
?>
