<?php session_start() ?>
<?php
//cssはまだやっていない

$output = "";


if(!isset($_POST['btn'])) {
    // 登録ボタン（newItemInput.phpから遷移）したときの処理
    $_SESSION = [];
    //セッションに値を入れて共有　
    //itemの中に入れておく
    $_SESSION['item']['itemName'] = $_POST['itemName']; //商品名
    $_SESSION['item']['maker'] = $_POST['maker']; //メーカー名
    $_SESSION['item']['num'] = $_POST['num']; //初期在庫数
    $_SESSION['item']['price'] = $_POST['price']; //初期価格
    $_SESSION['item']['detail'] = $_POST['detail']; //商品説明

    if(is_uploaded_file($_FILES['image']['tmp_name'])){
        if( (!file_exists('itemImage'))){
            mkdir('itemImage');
        }
        $file = 'itemImage/'.basename($_FILES['image']['name']);
        if(move_uploaded_file($_FILES['image']['tmp_name'],$file)) {
            $_SESSION['item']['image'] =  basename($_FILES['image']['name']);

        }
    }


    $output .= "
        <form action='' method='post'>
            <div>
                <h1>{$_SESSION['item']['itemName']}</h1>
                <img src='itemImage/{$_SESSION['item']['image']}'>
                {$_SESSION['item']['maker']}<br>
                {$_SESSION['item']['price']}<br>
                {$_SESSION['item']['num']}
                {$_SESSION['item']['detail']}
            </div>
            <p>
                <button type='button' onclick='history.back()'>戻る</button>
                <button type='submit' name='btn' value='20'>確定</button>
            </p>
        </form>
    ";


} else {
    // 確定ボタンを押したときの処理
    $pdo = new PDO('mysql:host=mysql139.phy.lolipop.lan;
                dbname=LAA1290556-mikado',
        'LAA1290556',
        'mikado');
    $sql = 'INSERT INTO m_item (maker_id,item_name,price,image,text,num) VALUES(?,?,?,?,?,?)';

    $result = $pdo->prepare($sql);
    $result->bindValue(1, $_SESSION['item']['maker'], PDO::PARAM_STR);
    $result->bindValue(2, $_SESSION['item']['itemName'], PDO::PARAM_STR);
    $result->bindValue(3, $_SESSION['item']['price'], PDO::PARAM_INT);
    $result->bindValue(4, $_SESSION['item']['image'], PDO::PARAM_STR);
    $result->bindValue(5, $_SESSION['item']['detail'], PDO::PARAM_STR);
    $result->bindValue(6, $_SESSION['item']['num'], PDO::PARAM_INT);
    $result->execute();
    $pdo = null;
    $output .= "
        <p>登録が完了しました。</p>
        <a href='adoministorTop.php'><img src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQnno0x2yftmlxWmrvQHkuFHoAoTyDILzFCzA&usqp=CAU'></a>
    ";
    unset($_SESSION['item']);
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>新規商品の登録画面</title>
</head>
<body>
<?= $output?>
</body>
</html>
