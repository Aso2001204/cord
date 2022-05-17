<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新商品登録</title>
    <link rel="stylesheet" href="./css/newItemInput.css">
</head>
<body>
<form action="newItemIn.php" method="post" enctype="multipart/form-data">
    <p>
        <input type="text" name="itemName" placeholder="新規商品名">
        <select name="maker">
            <option value="">メーカーを選択してください</option>
            <option value="s">SONY</option>
            <option value="a">Apple</option>
            <option value="b">Bose</option>
        </select>
    </p>
    <p>
        <input type="number" name="price" placeholder="初期価格（税抜き）">
        <input type="number" name="num" placeholder="初期在庫数">
    </p>
    <p>

        <input type="file" name="image" placeholder="新規商品写真&#13;&#10;アップロード">
        <textarea name="detail" col="30" rows="5" placeholder="新規商品詳細文書"></textarea>
    </p>
    <p>
        <button type="button" onclick="history.back()">戻る</button>
        <button type="submit">登録</button>
    </p>
</form>
</body>
</html>

<!--// データベース設定ファイルを含む-->
<!--include 'dbConfig.php';-->
<!--$statusMsg = '';-->
<!---->
<!--// ファイルのアップロード先-->
<!--$targetDir = "uploads/";-->
<!--$fileName = basename($_FILES["file"]["name"]);-->
<!--$targetFilePath = $targetDir . $fileName;-->
<!--$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);-->
<!---->
<!--if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){-->
<!--// 特定のファイル形式の許可-->
<!--$allowTypes = array('jpg','png','jpeg','gif','pdf');-->
<!--if(in_array($fileType, $allowTypes)){-->
<!--// サーバーにファイルをアップロード-->
<!--if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){-->
<!--// データベースに画像ファイル名を挿入-->
<!--$insert = $db->query("INSERT into images (file_name, uploaded_on) VALUES ('".$fileName."', NOW())");-->
<!--if($insert){-->
<!--$statusMsg = " ".$fileName. " が正常にアップロードされました";-->
<!--}else{-->
<!--$statusMsg = "ファイルのアップロードに失敗しました、もう一度お試しください";-->
<!--}-->
<!--}else{-->
<!--$statusMsg = "申し訳ありませんが、ファイルのアップロードに失敗しました";-->
<!--}-->
<!--}else{-->
<!--$statusMsg = '申し訳ありませんが、アップロード可能なファイル（形式）は、JPG、JPEG、PNG、GIF、PDFのみです';-->
<!--}-->
<!--}else{-->
<!--$statusMsg = 'アップロードするファイルを選択してください';-->
<!--}-->
<!---->
<!--// ステータスメッセージを表示-->
<!--echo $statusMsg;-->
<!--?>-->