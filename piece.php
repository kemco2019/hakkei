<!DOCTYPE html>
<html lang="ja">

</html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/piece.css">
    <link rel="stylesheet" type="text/css" href="css/pieceView.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
    <meta charset='utf-8'>
    
    <title>書き初め2022(仮)</title>
    
</head>

<body style = "background-color: #EAEAEA;">

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.min.js"></script>
    <script type="text/javascript" src="js/piece_ajax.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>




<?php



$host = "mysql57.kemco.sakura.ne.jp";
$dbName = "kemco_kakizome";
$username = "kemco";
$password = "h76-id_z";

$dsn = "mysql:host={$host};dbname={$dbName};charser=utf8";



echo '<div class="flex_box" style = "background-color: #EAEAEA;">';
echo '<div class="flex_item" style = "background-color: #EAEAEA;">書き初め</div>';
echo '<div class="flex_item" style = "background-color: #EAEAEA;">';

try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
}
    $sql = 'SELECT * FROM tora_2022 WHERE id < :id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', 7, PDO::PARAM_INT);
try {
    $stmt->execute();
} catch (PDOException $e) {
    echo $e->getMessage();
}
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = count($images);

echo '<div class="piece_container_1" style = "background-color: #EAEAEA;">';
for($i=0; $i < $count; $i++){

    if ($i % 8 < 4){
    echo '<div class="piece_container_item" style = "background-color: #EAEAEA;">';
    echo '<div class="piece_box" style = "background-color: #EAEAEA;">';

    //echo '<div class="piece_item">'; // img
    echo '<a href="' . $images[$i]['path'] .  '" data-lightbox="group">';
    echo '<img class="lazyload piece_item" style = "background-color: #EAEAEA;" data-src="' . $images[$i]['path'] . '" alt="CLUSTER SEO" />';
    echo '</a>';
    //echo '<img class="lazyload" data-src="' . $images[$i]['path'] . '" alt="CLUSTER SEO" />';

    //echo '</div>'; //piece_item

    echo '<div class="piece_item" style = "background-color: #EAEAEA;">'; // iine
    echo '<div class="post" data-postid="' . $images[$i]['id'] . '" data-imagenum="' . $count . '" data-inum="' . $images[$i]['iine'] . '">';
    echo '<div class="btn-good" style = "background-color: #EAEAEA;">';
    echo '<i class="far fa-heart fa-1g px-16';
    echo '">';
    echo '</i>';
    echo '<span id="iineNum'.$images[$i]['id'].'">'. $images[$i]['iine'] . '</span>';
    echo '</div>';
    echo '</div>';
    echo '</div>'; //iine


    echo '</div>'; //piece_box

    echo '</div>';
    }
}
echo '</div>'; //piece_container
echo '<div class="piece_container_2" style = "background-color: #EAEAEA;">';
for($i=0; $i < $count; $i++){

    if ($i%8 >= 4){
    echo '<div class="piece_container_item" style = "background-color: #EAEAEA;">';
    echo '<div class="piece_box" style = "background-color: #EAEAEA;">';

    //echo '<div class="piece_item">'; // img
    echo '<a href="' . $images[$i]['path'] .  '" data-lightbox="group">';
    echo '<img class="lazyload piece_item" style = "background-color: #EAEAEA;" data-src="' . $images[$i]['path'] . '" alt="CLUSTER SEO" />';
    echo '</a>';
    //echo '<img class="lazyload" data-src="' . $images[$i]['path'] . '" alt="CLUSTER SEO" />';

    //echo '</div>'; //piece_item

    echo '<div class="piece_item" style = "background-color: #EAEAEA;">'; // iine
    echo '<div class="post" data-postid="' . $images[$i]['id'] . '" data-imagenum="' . $count . '" data-inum="' . $images[$i]['iine'] . '">';
    echo '<div class="btn-good" style = "background-color: #EAEAEA;">';
    echo '<i class="far fa-heart fa-1g px-16';
    echo '">';
    echo '</i>';
    echo '<span id="iineNum'.$images[$i]['id'].'">'. $images[$i]['iine'] . '</span>';
    echo '</div>';
    echo '</div>';
    echo '</div>'; //iine

    echo '</div>'; //piece_box

    echo '</div>';
    }
}
echo '</div>'; //piece_container
echo '<script>lazyload();</script>';
?>

</body>

</html>