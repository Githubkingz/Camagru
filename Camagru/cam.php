<?php

    if(isset($_POST["submit"]))
    {
        $DB_NAME = "datat";
        $DB_DSN = "mysql:host=localhost;dbname=".$DB_NAME;
        $DB_DSN1 = "mysql:localhost";
        $DB_USER = "root";
        $DB_PASSWORD = "SamsungS5";
        $dbh = new PDO($DB_DSN1, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $filename = addslashes($FILES["img"]["name"]);
        $tmpname = addslashes(file_get_contents($FILES["img"]["tmp_name"]));
        $filetype = addslashes($FILES["img"]["type"]);
        $array = array('jpg', 'jpeg', 'png');
        $ext = pathifo($filename, PATHINFO_EXTENSION);
        if(!empty($filename)){
            if(in_array($ext, $array)){
                $sql = "INSERT INTO cam(imgsrc, imgname) values('$tmpname', '$filename')";
                $dbh->exec($sql);
            }else{
                echo "unsupported format";
            }
        }
    }

   
?>
<!DOCTYPE html>
<HTML>
<head>
    <meta charset="UTF-8">
    <title>Take pic</title>
    <link rel="stylesheet" href="cam.css">
</head>
<body>
    <div class="cup">
        <div class="camField">
            <video id="video" width="400" height="300"></video>
        </div>
        <div class="picField">
            <canvas id="canvas" width="400" height="300"></canvas>
            <img id="photo" src="">
        </div>
        <input name="call cam" type="submit" value=" Take Pic " id="capture" class="camBtn">
    </div>
    <form action="#" method="post" enctype="multipart/form-data">
        <input type="file" name="img"/>
        <input type="submit" name="submit"/>
    </form>
    <script src="cam.js"></script>
</body>
</HTML>