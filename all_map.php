<?php
require_once "./dbc.php";

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Otoshimono Map</title>
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

    <p class="title2">落とし物マップ</p>
    <div class = "wrapper" style='width:100%;height:800px;display:flex'>
        <div id="myMap" style='width:100%;height:100%'></div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=XXXXX' async defer></script>
    <script>
        var lat = "";
        var lng = "";
        var map = "";
        gps_get();

    function success(pos){
        lat = pos.coords.latitude;
        lng = pos.coords.longitude;
    }

    function fail(pos){
        alert('位置情報の取得に失敗しました。エラーコード：');
    }

    function gps_get() {
        navigator.geolocation.getCurrentPosition(success,fail);
    };

    function GetMap() {
        map = new Microsoft.Maps.Map('#myMap', {
            center: new Microsoft.Maps.Location(lat, lng),
            zoom: 15
        });

    <?php $files = getAllFile();
    foreach($files as $file):
    ?>
        var hinmei = '<?php echo h("{$file['hinmei']}"); ?>';
        var latitude = '<?php echo h("{$file['latitude']}"); ?>';
        var longitude = '<?php echo h("{$file['longitude']}"); ?>';
        console.log (hinmei,latitude,longitude);

        var location = new Microsoft.Maps.Location(latitude, longitude)
        var pin = new Microsoft.Maps.Pushpin(location, {
            text: hinmei,
            icon: './pushpin2.png'
        });
        map.entities.push(pin); 
    <?php
    endforeach;
    ?>
    }
    </script>
</body>
</html>