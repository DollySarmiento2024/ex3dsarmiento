<?php
// ALUMNA: Dolly Fernanda Sarmiento Quintana

require_once "autoload.php";
$lighting = new Lighting();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $filter = htmlspecialchars($_POST['filter'] ?? "", ENT_QUOTES);
   $lighting->setCurrentFilter($filter); 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="center">
        <h1>BIG STADIUM - LIGHTING CONTROL PANEL</h1>
        <h2><?= $lighting->drawMonitor(); ?></h2>
        <form action="" method="post">
            <select name="filter">
                <?= $lighting->drawZonesOptions() ?>
            </select>
            <input type="submit" value="Filter by zone">
        </form> 
        <?= $lighting->drawLampsList() ?>
    </div>
</body>

</html>