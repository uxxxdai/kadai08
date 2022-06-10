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


// 「品名」などについて入力値チェック
$hinmei = filter_input(INPUT_POST, 'hinmei', FILTER_SANITIZE_SPECIAL_CHARS);

$color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_SPECIAL_CHARS);

$size = filter_input(INPUT_POST, 'size', FILTER_SANITIZE_SPECIAL_CHARS);

$brands = filter_input(INPUT_POST, 'brands', FILTER_SANITIZE_SPECIAL_CHARS);

$latitude = filter_input(INPUT_POST, 'latitude', FILTER_SANITIZE_SPECIAL_CHARS);

$longitude = filter_input(INPUT_POST, 'longitude', FILTER_SANITIZE_SPECIAL_CHARS);


// if(empty($caption)){
//     array_push($err_msgs,'キャプションを入力してください。');
//     echo '<br>';
// }
// if(strlen($caption)>140){
//     array_push($err_msgs,'140文字以内で入力して下さい');
//     echo '<br>';
// }


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
            echo $filename . 'を' . $upload_dir . 'にアップしました。';
            //各データのDBへの保存
            $result = fileSave($filename, $save_path, $hinmei, $color, $size, $brands, $caption, $latitude, $longitude);
            if($result){
                echo 'データベースに保存しました！';
            }else{
                echo 'データベースへの保存が失敗しました';
            }
        } else{
        echo 'ファイルが保存できませんでした。';
        }
    } else {
    echo 'ファイルが選択されていません';
    echo '<br>';
    }
}else{
    foreach($err_msgs as $msg){
        echo $msg;
        echo '<br>';
    }
}
?>
