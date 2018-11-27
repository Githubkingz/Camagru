<?php
//include_once 'config/database.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>PhotoBooth</title>
    <link rel="stylesheet" href="booth.css" />
   </head>
<body>
    <div class="container" id="container">
    <?php include 'header.php'; ?>
        <div class="center-panel" id="center-panel">
            <video class="video" id="video" name="video" width="400" height="300">Streaming not available..</video>
            <button class="btn btn-light" id="capture-btn" name="capture-btn">Capture</button>
            <select name="" id="filter-options" class="filter-options">
                <option value="none">Normal</option>
                <option value="Grayscale(100%)">Grayscale</option>
                <option value="sepia(100%)">Sepia</option>
                <option value="invert(100%)">Invert</option>
                <option value="hue-rotate(90deg)">Hue</option>
                <option value="blur(5px)">Blur</option>
                <option value="contrast(200%)">Contrast</option>
            </select>
            <button class="btn btn-light" id="clear-btn" name="clear-btn">Clear</button>
            <canvas id="canvas" class="canvas" style="display: none;"></canvas>
        </div>
        <div class="photo-container">
            <div class="photos" id="photos"></div>
        </div>
    </div>
    <script language="javascript" src="booth.js"></script>
</body>
</html>