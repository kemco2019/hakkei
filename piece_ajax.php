<?php
//共通変数・関数ファイルを読込み
//require('function.php');

$host = "mysql57.kemco.sakura.ne.jp";
$dbName = "kemco_hakkei";
$username = "kemco";
$password = "h76-id_z";
$dsn = "mysql:host={$host};dbname={$dbName};charser=utf8";
// postがある場合
if(isset($_POST['ipostId'])){
    $p_id = $_POST['ipostId'];
    $count = $_POST['iCount'];
    //$f_id = $_POST['favId'];
    //error_log('ajaxGood');

    try{
        //DB接続
        $dbh = new PDO($dsn, $username, $password);
        if($count % 2 == 1){
            $sql = "update hakkei SET iine = iine + 1 where id = :id";//ok
        }else{
            $sql = "update hakkei SET iine = iine - 1 where id = :id";//ok
        }
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $p_id);
        $stmt->execute();
        // レコードを挿入する
        /*$sql = 'INSERT INTO good (post_id, user_id, created_date) VALUES (:p_id, :u_id, :date)';
        $data = array(':p_id' => $p_id, ':u_id' => $f_id, ':date' => date('Y-m-d H:i:s'));
        // クエリ実行
        $stmt = queryPost($dbh, $sql, $data);
        echo count(getGood($p_id));*/

    }catch(Exception $e){
        error_log('エラー発生：'.$e->getMessage());
    }
}else if(isset($_POST['hpostId'])){
    $p_id = $_POST['hpostId'];
    $count = $_POST['hCount'];
    //$f_id = $_POST['favId'];
    //error_log('ajaxGood');

    try{
        //DB接続
        $dbh = new PDO($dsn, $username, $password);
        if($count % 2 == 1){
            $sql = "update hakkei SET hanya = hanya + 1 where id = :id";//ok
        }else{
            $sql = "update hakkei SET hanya = hanya - 1 where id = :id";//ok
        }
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $p_id);
        $stmt->execute();
        // レコードを挿入する
        /*$sql = 'INSERT INTO good (post_id, user_id, created_date) VALUES (:p_id, :u_id, :date)';
        $data = array(':p_id' => $p_id, ':u_id' => $f_id, ':date' => date('Y-m-d H:i:s'));
        // クエリ実行
        $stmt = queryPost($dbh, $sql, $data);
        echo count(getGood($p_id));*/

    }catch(Exception $e){
        error_log('エラー発生：'.$e->getMessage());
    }
}else {
    echo '<script>';
    echo 'console.log(\' db upload \')';
    echo '</script>';
    
}

?>