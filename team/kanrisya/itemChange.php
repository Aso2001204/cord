<?php
$output = "";
$pdo = new PDO('mysql:host=mysql139.phy.lolipop.lan;
                dbname=LAA1290556-mikado;charset=utf8',
    'LAA1290556',
    'mikado');

if(!isset($_POST['home'])) {
    $btn = $_POST['btn'];

//データベースの問い合わせ開始
    $sql = "select * from m_item where item_name=? AND maker_id=?";
    $result = $pdo->prepare($sql);
    $result->bindValue(1, $_POST['item_name'], PDO::PARAM_STR);
    $result->bindValue(2, $_POST['maker_id'], PDO::PARAM_STR);
    $result->execute();
    $result = $result->fetch(PDO::FETCH_ASSOC);

    if ($btn == "change") {
        $button = "変更";
    } elseif ($btn == "delete") {
        $button = "削除";
    }
//ボタン編集
    $button = "<button type='submit' name='home' value='" . $btn . "'>" . $button . "</button>";

//出力
    $output .= "
    <form action='' method='post'>
        <h1>商品情報</h1>
        <p>商品コード：<input type='text' name='item_code' value='{$result['item_code']}' readonly></p>
        <p>商品名：<input type='text' name='item_name' value='{$result["item_name"]}'></p>
        <p>価格：<input type='number' name='price' value='{$result["price"]}'</p>
        <p>数量：<input type='number' name='num' value='{$result["num"]}'></p>
        <p><textarea cols='30' name='text' rows='5'>{$result["text"]}</textarea></p>
        {$button}
    </form>
";
}
// 変更・削除処理をする
if(isset($_POST['home'])){
    if($_POST['home'] == "change"){
        // 変更処理 m_item
        $sql = "UPDATE m_item SET item_name = ? , price = ? , text = ? , num = ? WHERE item_code = ?";
        $change = $pdo -> prepare($sql);
        $change -> bindValue(1,$_POST['item_name'],PDO::PARAM_STR);
        $change -> bindValue(2,$_POST['price'],PDO::PARAM_INT);
        $change -> bindValue(3,$_POST['text'],PDO::PARAM_STR);
        $change -> bindValue(4,$_POST['num'],PDO::PARAM_INT);
        $change -> bindValue(5,$_POST['item_code'],PDO::PARAM_STR);
        $change -> execute();
        // 挿入処理 d_itemChange
        $insertsql = "INSERT INTO d_itemChange (item_code,change_flg,change_text,change_num,change_item_name,change_price) VALUES(?,'c',?,?,?,?)";
        $insert = $pdo -> prepare($insertsql);
        $insert -> bindValue(1,$_POST['item_code'],PDO::PARAM_STR);
        $insert -> bindValue(2,$_POST['text'],PDO::PARAM_STR);
        $insert -> bindValue(3,$_POST['num'],PDO::PARAM_INT);
        $insert -> bindValue(4,$_POST['item_name'],PDO::PARAM_STR);
        $insert -> bindValue(5,$_POST['price'],PDO::PARAM_INT);
        $insert -> execute();
        $output .= "
            <p>完了しました</p>
            <a href='adoministorTop.php'><button type='button'>トップページへ戻る</button></a>
        ";
    }elseif($_POST['home'] == "delete"){
        // 削除処理 m_item
        $sql = "DELETE FROM m_item WHERE item_code = ?";
        $delete = $pdo -> prepare($sql);
        $delete -> bindValue(1,$_POST['item_code'],PDO::PARAM_STR);
        $delete -> execute();
        // 挿入処理 d_itemChange
        $insertsql = "INSERT INTO d_itemChange (item_code,change_flg,change_item_name) VALUES (?,'d',?)";
        $insert = $pdo -> prepare($insertsql);
        $insert -> bindValue(1,$_POST['item_code'],PDO::PARAM_STR);
        $insert -> bindValue(2,$_POST['item_name'],PDO::PARAM_STR);
        $insert -> execute();
        $output .= "
            <p>完了しました</p>
            <a href='adoministorTop.php'><button type='button'>トップページへ戻る</button></a>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品情報変更</title>
</head>
<body>
<?= $output?>
</body>
</html>