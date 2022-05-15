<?php session_start() ?>
<?php
    //ydlp_inputから遷移した場合（APIの処理）
    $url = 'https://map.yahooapis.jp/search/local/V1/localSearch?appid=';
    $appid = 'dj00aiZpPVJ6akRDa3pQdlA3YiZzPWNvbnN1bWVyc2VjcmV0Jng9ZTc-';
    $keyword = $_POST['keyword'];
    $category = $_POST['category'];

    //配列作成
    $data = [];
    $data = array('query' => $_POST['keyword']);

    //変換
    $word = http_build_query($data);
    $serch_url = $url . $appid . '&' . $word . '&gc=' . $category . '&output=json&image=true&results=100';

    //curlセッション初期化
    $ch = curl_init();

    //URLとオプションを指定する
    curl_setopt($ch, CURLOPT_URL, $serch_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($ch,CURLOPT_POSTFIELDS,$serch_url);

    //URLの情報を取得
    $response = curl_exec($ch);
    $result = mb_convert_encoding($response, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $result = json_decode($result, true);

    //var_dump($result);
    //セッション終了
    curl_close($ch);

    $_SESSION['user']['id'] = 000;
    $_SESSION['user']['name'] = 'test';
//$_SESSIONに代入して各ファイルで使えるようにする
if(isset($_SESSION['PDF'])){
    unset($_SESSION['PDF']);
}
$_SESSION['PDF'] = $result; //スーパーグローバル変数
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

$shopList = [];
$cnt = 0;
foreach ($result['Feature'] as $row){
    $shopList[$cnt]['Name'] = $row['Name'];
    $shopList[$cnt]['URL'] = "ydlp_out.php?cnt=".$cnt;
    //$shop_data[$cnt]['GenreName'] = $row['Property']['Genre']['Name'];
    //$shop_data[$cnt]['CatchCopy'] = $row['Property']['CatchCopy'];
    //$shop_data[$cnt]['ZipCode'] = $row['Property']['Detail']['ZipCode'];
    $shopList[$cnt]['Address'] = $row['Property']['Address'];
    if(isset($row['Property']['Tel1'])) {
        $shopList[$cnt]['Tel'] = $row['Property']['Tel1'];
    }else{
        $shopList[$cnt]['Tel'] = "Not Tel!!";
    }
    if(isset($row['Property']['LeadImage'])) {
        $shopList[$cnt]['Image'] = $row['Property']['LeadImage'];
    }else {
        $shopList[$cnt]['Image'] = "data:image/png;base64,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";
    }
    $cnt++;
}
$return = "";
$return .= "
    <form action='ydlp_input.php' method='post'>
        <button name='result'>戻る</button>
    </form>
";
//出力処理
$output = "";
foreach ($shopList as $record) {
    $output .= "
        <tr class='detail'>
            <td><img src=".$record['Image']."></td>
            <td class='explanation'>
                <h2><a href=".$record['URL'].">{$record["Name"]}</a></h2>
                <p>{$record['Tel']}</p>
                <p>{$record['Address']}</p>
            </td>
        </tr>   
    ";
    }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>店名入力</title>
    <link rel="stylesheet" href="./css/ydlp_in.css">
</head>
<body>
<?=$return?>
<table>
    <tr>
        <th></th>
        <th></th>
    </tr>
    <?=$output?>
</table>
</body>
</html>

