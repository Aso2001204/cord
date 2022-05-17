<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>税金変更</title>
    <link rel="stylesheet" href="./css/taxChange.css">
</head>
<body>
<form action="taxDecision.php" method="post">
    <p><input type="text" name="tax" placeholder="￥税率入力"></p>
    <p>
        <button type="button" onclick="history.back()" id="return">戻る</button>
        <button type="submit" id="change">変更</button>
    </p>
</form>
</body>
</html>