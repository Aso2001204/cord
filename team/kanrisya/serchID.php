<?php
$text = $_GET['btn'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品ID検索</title>
</head>
<body>
<form action="itemChange.php" method="post">
    <h1>商品情報検索</h1>
    <p>商品名：<input type="text" name="item_name"></p>
    <p>メーカー名：
        <select name="maker_id">
            <option value="s">SONY</option>
            <option value="a">Apple</option>
            <option value="b">Bose</option>
        </select>
    </p>
    <p>
        <button type="submit" name="btn" value="<?=$text?>">検索</button>
    </p>
</form>
</body>
</html>