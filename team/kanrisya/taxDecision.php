<?php
$tax = $_POST['tax'];
?>
    <!DOCTYPE html>
    <html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>税金確定</title>
        <link rel="stylesheet" href="./css/taxDecision.css">
    </head>
    <body>
    <form action="" method="post">
        <p><input type="text" name="tax" value="<?=$tax?>"></p>
        <p>
            <button type="button" onclick="history.back()" id="return" value="<?=$tax?>">戻る</button>
            <button type="submit" name="btn" value="ok" id="decision">確定</button>
        </p>
    </form>

    </body>
    </html>
<?php if(isset($_POST['btn'])){



    $pdo = new PDO('mysql:host=mysql139.phy.lolipop.lan;
                dbname=LAA1290556-mikado;charset=utf8',
        'LAA1290556',
        'mikado');
    $sql = "UPDATE m_taxrate SET tax = ? WHERE taxrate_id = 1 ";
    $result = $pdo -> prepare($sql);
    $result -> bindValue(1,$tax,PDO::PARAM_STR);
    $result -> execute();
    echo '<body>';
    echo '<p>変更完了しました</p>';
    echo '<p><a href="adoministorTop.php">トップページへ戻る</a></p>';
    echo '</body>';
}

?>