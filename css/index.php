<?php
$test = 0;

##TOP N を表示
$viewMAX = 3;

if ($test == 0) {
    $host = "mysql57.kemco.sakura.ne.jp";
    $dbName = "kemco_hakkei";
    $username = "kemco";
    $password = "h76-id_z";
} else {
    $host = "127.0.0.1";
    $dbName = "phpmyadmin";
    $username = "root";
    $password = "";
}
$dsn = "mysql:host={$host};dbname={$dbName};charser=utf8";

$id = 0;
try {
    $dbh = new PDO($dsn, $username, $password);
    $msg = "接続成功";
} catch (PDOException $e) {
    echo $e->getMessage();
}
    
    $sql = "SELECT * FROM hakkei";
    
    $stmt = $dbh->prepare($sql);
    #$stmt->bindValue(':id', $id);
    $stmt->execute();
    $data = $stmt->fetchALL(PDO::FETCH_ASSOC);
    
    foreach ((array) $data as $key => $value) {
        $data[$key]['sum'] =  $value['iine'] + $value['hanya'];
        $value['sum'] = $data[$key]['sum'];
        $sort[$key] = $value['sum'];
        
    }

    array_multisort($sort, SORT_DESC, $data);
    
?>

<!DOCTYPE html>
<html lang="ja">

</html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/toppage.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
    <meta charset='utf-8'>
    
    <title>八景ピース</title>
</head>

<body>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="piece_ajax.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
    <div class="flex_box pc">
        <div class="flex_item">
            <div class="bg_flex">
                <!-- <a href="view.php">すべてのピースを見る</a> -->
                <div class="wrapper">
                    <div class="box a"></div>
                    <div class="box b"></div>
                    <div class="box c">
                        <div class="text_p">
                            <div class="text_pItem">
                                <a href="select.html" class = "allpiece">全ての<br>ピース<br>を見る</a>
                            </div>
                            <div class="text_pItem">
                                <a href="select.html" class="btn">&gt;</a>
                            </div>
                        </div>
                    </div>
                    <div class="box d"></div>
                    <div class="box e"></div>
                    <div class="box f"></div>
                    <div class="box g"></div>
                    <div class="box h"></div>
                </div>
            </div>
        </div>
        <div class="flex_item">
            <div class="row_grid">
                <div class="row_box ha">八</div>
                <div class="row_box kei">景</div>
                <div class="row_box pi">ピ</div>
                <div class="row_box l">ー</div>
                <div class="row_box su">ス</div>
            </div>
        </div>
        <div class="flex_item">
            <h1>Ranking</h1>
            <div class="Rank_box">
                <?php
                    for ($i = 0; $i < $viewMAX; $i++ ) {
                        echo '<div class="Rank_item">';
                        echo '<div class="Rank_viewBox">';
                        echo '<div class="Rank_viewItem">';
                        /* echo '<h2> ID: ' . $data[$i]["id"] . ' Rank: ' . $i . ' Value: ' . $data[$i]["sum"] . '</h2>';  */
                        /* echo '<p>' . ($i + 1) . '</p>' ; */
                        echo ($i + 1) ;
                        echo '</div>';
                        //echo '<div class="Rank_viewItem">';
                        echo '<a href="' . $data[$i]["path"] . '" data-lightbox="group">' .
                        '<img src="' . $data[$i]["path"] . '" class="Rank_viewItem">';
                        echo '</a>';
                        //echo '<img src="' . $data[$i]["path"] . '" class="Rank_viewItem">';
                        //echo '</div>';
                        echo '<div class="Rank_viewItem">';

                        echo '<div class="Rank_btn_box">';
                        echo '<div class="Rank_btn_item">';
                            echo '<div class="post" data-postid="' . $data[$i]['id'] . '" data-inum="' . $data[$i]['iine'] . '">';
                            echo '<div class="btn-good">';
                                echo '<i class="far fa-heart fa-xs px-16">';
                                echo '<span id="iineNum'.$data[$i]['id'].' style="font-size : 1px" ">'. $data[$i]['iine'] . '</span>';
                                echo '</i>';
                            echo '</div>';
                            echo '</div>';
                        echo '</div>'; //btnitem
                        echo '<div class="Rank_btn_item">';
                            echo '<div class="post" data-postid="' . $data[$i]['id'] . '" data-hnum="' . $data[$i]['hanya'] . '">';
                            echo '<div class="btn-hanya">';
                                echo '<i class="far fa-lightbulb fa-xs px-16">';
                                echo '<span id="hanyaNum'.$data[$i]['id'].' style="font-size : 1px" ">'. $data[$i]['hanya'] . '</span>';
                                echo '</i>';
                            echo '</div>';
                            echo '</div>';
                        echo '</div>'; //btnitem
                        echo '</div>'; //btnbox

                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>

    <div class = "mobile">
        <h1>全てのピースを見る</h1>
        <h1>RANKING</h1>
    </div>

</body>

</html>