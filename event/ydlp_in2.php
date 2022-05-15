<?php

if(isset($_POST['keyword'])){
    $url = 'https://map.yahooapis.jp/search/local/V1/localSearch?appid=dj00aiZpPVJ6akRDa3pQdlA3YiZzPWNvbnN1bWVyc2VjcmV0Jng9ZTc-';
    $keyword = $_POST['keyword'];
    $prefecture = $_POST['prefecture'];
    $category = $_POST['category'];

    //配列作成
    $data = array(
        "keyword" => $keyword,
        "category" => $category
    );

    //変換
    $data = http_build_query($data);
    $serch_url = $url .'&ac='.$prefecture .'&output=json';
    //&query=

    //curlセッション初期化
    $ch = curl_init();

    //URLとオプションを指定する
    curl_setopt($ch,CURLOPT_URL,$serch_url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    //curl_setopt($ch,CURLOPT_POSTFIELDS,$serch_url);

    //URLの情報を取得
    $response = curl_exec($ch);
    //$result = json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    $result = mb_convert_encoding($response, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $result = json_decode($result,true);
    curl_close($ch);
//    var_dump($result);
//    exit();
    //変更ここから
    $shop_data=[];
    $cnt=0;

    foreach ($result['Feature'] as $row){
        $shop_data[$cnt]['Name'] = $row['Name'];
        $shop_data[$cnt]['GenreName'] = $row['Property']['Genre']['Name'];
        $shop_data[$cnt]['CatchCopy'] = $row['Property']['CatchCopy'];
        $shop_data[$cnt]['ZipCode'] = $row['Property']['Detail']['ZipCode'];
        $shop_data[$cnt]['Address'] = $row['Property']['Address'];
        $shop_data[$cnt]['Tel'] = $row['Property']['Tel1'];
        $shop_data[$cnt]['Fax'] = $row['Property']['Detail']['Fax1'];
        $shop_data[$cnt]['Access'] = $row['Property']['Detail']['Access1'];
        $shop_data[$cnt]['StationName'] = $row['Property']['Station']['Name'];
        $shop_data[$cnt]['PcUrl'] = $row['Property']['Detail']['PcUrl1'];
        $shop_data[$cnt]['MobileUrl'] = $row['Property']['Detail']['MobileUrl1'];
        $shop_data[$cnt]['ReviewUrl'] = $row['Property']['Detail']['ReviewUrl'];
        $shop_data[$cnt]['Image'] = $row['Property']['Detail']['Image1'];
        $cnt++;
    }

    $output = "";
    foreach ($shop_data as $record) {
        $output .= "
            <tr>
                <td>{$record["Name"]}</td>
                <td>{$record['Tel']}</td>
                <td>{$record['Address']}</td>
            </tr>
        ";
    }
//    foreach ($shop_data as $record) {
//        $output .= "
//            <tr>
//                <td>{$record["Name"]}</td>
//                <td>{$record["GenreName"]}</td>
//                <td>{$record['CatchCopy']}</td>
//                <td>{$record['ZipCode']}</td>
//                <td>{$record['Address']}</td>
//                <td>{$record['Tel']}</td>
//                <td>{$record['Fax']}</td>
//                <td>{$record['Access']}</td>
//                <td>{$record['StationName']}</td>
//                <td>{$record['PcUrl']}</td>
//                <td>{$record['MobileUrl']}</td>
//                <td>{$record['ReviewUrl']}</td>
//                <td>{$record['Image']}</td>
//            </tr>
//        ";
//    }


    //セッション終了
    curl_close($ch);
}else{
    echo '入力にミスがあります。';
    echo '<a href="http://dark-yame-3240.icurus.jp/event/ydlp/ydlp_input.php">もう一度やり直す</a>';

}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>店名入力</title>
</head>
<body>
<table>
    <tr>
        <th>店舗名</th>
        <th>電話番号</th>
        <th>住所</th>
    </tr>
    <?=$output?>
</table>

</body>
</html>

