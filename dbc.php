<?php
header('Expires: Tue, 1 Jan 2019 00:00:00 GMT');
header('Last-Modified:'. gmdate( 'D, d M Y H:i:s' ). 'GMT');
header('Cache-Control:no-cache,no-store,must-revalidate,max-age=0');
header('Cache-Control:pre-check=0,post-check=0',false);
header('Pragma:no-cache');


// function dbc(){
//     $host = "localhost";
//     $dbname = "otoshimono_db";
//     $user = "root";
//     $pass = "root";

//     $dns="mysql:host=$host;dbname=$dbname;charset=utf8";

//     try{
//         $pdo = new PDO($dns, $user, $pass,
//         [
//             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//             PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//         ]);
//         return $pdo;
//     } catch(PDOException $e){
//         exit($e->getMessage());
//     }
// }

function dbc(){
    try {
        $host = "localhost";
        $dbname = "otoshimono_db";
        $user = "root";
        $pass = "root";
        $dns="mysql:host=$host;dbname=$dbname;charset=utf8";
        $pdo = new PDO($dns, $user, $pass);
    return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}

//ファイルデータをDBに保存する
function fileSave($filename, $save_path, $hinmei, $color, $size, $brands, $caption, $latitude, $longitude){
    $result = False;

    $sql = "INSERT INTO otoshimono_table(file_name, file_path, hinmei, color, size, brand, description, latitude, longitude, delete_flag) VALUE(?,?,?,?,?,?,?,?,?,0)";
    try{
        $stmt = dbc()->prepare($sql);
        $stmt->bindValue(1, $filename);
        $stmt->bindValue(2, $save_path);
        $stmt->bindValue(3, $hinmei);
        $stmt->bindValue(4, $color);
        $stmt->bindValue(5, $size);
        $stmt->bindValue(6, $brands);
        $stmt->bindValue(7, $caption);
        $stmt->bindValue(8, $latitude);
        $stmt->bindValue(9, $longitude);
        $result = $stmt->execute();
        return $result;
    } catch(\Exception $e){
        echo $e->getMessage();
        return $result;
    }
}

//ファイルデータをDBに更新する
function fileUpdate($id, $filename, $save_path, $hinmei, $color, $size, $brands, $caption, $latitude, $longitude){
    $result = False;
    //各データのDB更新
    $id = $_POST['id'];
    $pdo = dbc();
    $stmt = $pdo->prepare('UPDATE otoshimono_table 
        SET file_name = :filename, file_path = :save_path, hinmei = :hinmei, 
                    color = :color, size = :size, brand = :brand, 
                    description = :description, update_date = sysdate(), 
                    latitude = :latitude, longitude = :longitude
        WHERE id = :id;
        ');
    // 数値の場合 PDO::PARAM_INT
    // 文字の場合 PDO::PARAM_STR
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':filename', $filename, PDO::PARAM_STR);
    $stmt->bindValue(':save_path', $save_path, PDO::PARAM_STR);
    $stmt->bindValue(':hinmei', $hinmei, PDO::PARAM_STR);
    $stmt->bindValue(':color', $color, PDO::PARAM_STR);
    $stmt->bindValue(':size', $size, PDO::PARAM_STR);
    $stmt->bindValue(':brand', $brands, PDO::PARAM_STR);
    $stmt->bindValue(':description', $caption, PDO::PARAM_STR);
    $stmt->bindValue(':latitude', $latitude, PDO::PARAM_STR);
    $stmt->bindValue(':longitude', $longitude, PDO::PARAM_STR);

    $result = $stmt->execute(); //実行
    return $result;
}

//ファイルデータを取得する
function getAllFile(){
    $sql = "SELECT * FROM otoshimono_table where delete_flag != 1 ORDER BY id DESC";

    $fileData = dbc()->query($sql);

    return $fileData;
}

function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
    }

//SQLエラー関数：sql_error($stmt)

function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
}

//リダイレクト関数: redirect($file_name)

function redirect($file_name){
    header('Location: ' . $file_name);
    exit();
}



?>