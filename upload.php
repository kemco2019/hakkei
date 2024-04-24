<?php
$host = "mysql57.kemco.sakura.ne.jp";
$dbName = "kemco_hakkei";
$username = "kemco";
$password = "h76-id_z";
$dsn = "mysql:host={$host};dbname={$dbName};charser=utf8";

$FromX = 915;
$ToX = 923;
$FromY = 773;
$ToY = 781;


try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
}
    if (isset($_POST['upload'])) {//送信ボタンが押された場合
        if (!empty($_FILES['image']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
            $image = uniqid(mt_rand(), true);//ファイル名をユニーク化
            $image .= '.jpg';# . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得

            $img = imagecreatefrompng($_FILES['image']['tmp_name']);//画像取得

            $r = 0;
            $g = 0;
            $b = 0;
            for ($i = $FromX ; $i <= $ToX ; $i ++){
                for($j = $FromY ; $j <= $ToY ; $j ++){
                    $rgb = imagecolorat($img, $i, $j);//RGB取得
                    $r += ($rgb >> 16) & 0xFF;
                    $g += ($rgb >> 8) & 0xFF;
                    $b += $rgb & 0xFF;
                }
            }
            $r = $r/81;
            $g = $g/81;
            $b = $b/81;
            $message = 'r'.$r.'g'.$g.'b'.$b;//rgb表示
            $angle_left = 90;
            $angle_right = 270;
            
            // 取得した画像リソースIDと指定角度で、画像を回転させる。
            $img_left = imagerotate($img, $angle_left, 0);
            $img_right = imagerotate($img, $angle_right, 0);

            $width  = 844;//Canvasの幅
            $height = 881;//Canvasの高さ
            $create_image = imagecreatetruecolor($width,$height);//Canvasの土台作成
            $position_x1 = 0;//画像配置するポジションX
            $position_y1 = 0;//画像配置するポジションX
            $position_x2 = 422;//画像配置するポジションX
            $position_y2 = 0;//画像配置するポジションX
            imagecopy($create_image, $img_left, $position_x1, $position_y1, 393, 986, 422, 881);//コピー先の画像リソース, コピー元の画像リソース, コピー先の x 座標, コピー先の y 座標, コピー元の x 座標,　コピー元の y 座標, コピー元の幅, コピー元の高さ
            imagecopy($create_image, $img_right, $position_x2, $position_y2, 274, 940, 422, 881);
            ImageFilter($create_image, IMG_FILTER_BRIGHTNESS, 50);
            ImageFilter($create_image, IMG_FILTER_CONTRAST, -10);
            
            if($r < 10 && $g < 10 && $b < 10){//条件分岐
                $file = "images/07/$image";
                $category = 7;
                $message1 = '8:KeMCoにアップロードします';
            }else if($b >= 90){
                if($r < 90){
                    $file = "images/06/$image";
                    $category = 6;
                    $message1 = '7:民俗学考古学にアップロードします';
                } else {
                    $file = "images/05/$image";
                    $category = 5;
                    $message1 = '6:メディアセンターにアップロードします';
                }
            }else{
                if($r < 120){
                    if($g < 70){
                        $file = "images/03/$image";
                        $category = 3;
                        $message1 = '4:美学美術史学にアップロードします';
                    } else {
                        $file = "images/00/$image";
                        $category = 0;
                        $message1 = '1:アートセンターにアップロードします';
                    }                    
                } else {
                    if($g < 60){
                        $file = "images/02/$image";
                        $category = 2;
                        $message1 = '3:斯道文庫にアップロードします';
                    } else if ($g < 110){
                        $file = "images/01/$image";
                        $category = 1;
                        $message1 = '2:古文書室にアップロードします';
                    } else {
                        $file = "images/04/$image";
                        $category = 4;
                        $message1 = '5:福沢研究センターにアップロードします';
                    }
                }
            }


            $sql = "INSERT INTO hakkei(path, category) VALUES (:file, :category)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':file', $file, PDO::PARAM_STR);
            $stmt->bindValue(':category', $category, PDO::PARAM_INT);

            // 画像を書き出す
            imagejpeg($create_image, $file);
            if (exif_imagetype($file)) {//画像ファイルかのチェック
                #$stmt->execute();
                
            } else {
                $message = '画像ファイルではありません';
            }
            

        }
    }
?>

<h1>画像アップロード</h1>
<!--送信ボタンが押された場合-->
<?php if (isset($_POST['upload'])): ?>
    <p><?php echo $message; ?></p>
    <p><?php echo $message1; ?></p>
    <form method="post" action="upload_check.php">
        <input type="hidden" name="category" value="<?php echo $category; ?>">
        変更があれば選ぶ</br>
        <input type="radio" name="category" value="0">1:アートセンター</br>
        <input type="radio" name="category" value="1">2:古文書室</br>
        <input type="radio" name="category" value="2">3:斯道文庫</br>
        <input type="radio" name="category" value="3">4:美学美術史学</br>
        <input type="radio" name="category" value="4">5:福沢研究センター</br>
        <input type="radio" name="category" value="5">6:メディアセンター</br>
        <input type="radio" name="category" value="6">7:民俗学考古学</br>
        <input type="radio" name="category" value="7">8:KeMCo</br>
        <input type="hidden" name="file" value="<?php echo $file; ?>">
        <input type="hidden" name="image" value="<?php echo $image; ?>">
        <input type="submit" value="OK">
    </form>
    
<?php else: ?>
    <form method="post" enctype="multipart/form-data">
        <p>アップロード画像</p>
        <input type="file" name="image">
        <input type="submit" name="upload" value="送信">
    </form>
<?php endif;?>