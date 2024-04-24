<?php
$host = "mysql57.kemco.sakura.ne.jp";
$dbName = "kemco_hakkei";
$username = "kemco";
$password = "h76-id_z";
$dsn = "mysql:host={$host};dbname={$dbName};charser=utf8";

try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
}

$file = $_POST['file'];
$category = $_POST['category'];
$image = $_POST['image'];

rename($file, "images/0$category/$image");
$file = "images/0$category/$image";

$sql = "INSERT INTO hakkei(path, category) VALUES (:file, :category)";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':file', $file, PDO::PARAM_STR);
$stmt->bindValue(':category', $category, PDO::PARAM_INT);

if (exif_imagetype($file)) {//画像ファイルかのチェック
    $stmt->execute();    
} else {
    $message = '画像ファイルではありません';
}
?>
<h1>アップロードしました</h1>
<a href="upload.php" class="btn">戻る</a>