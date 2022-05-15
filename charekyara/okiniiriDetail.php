<?php

    //ydlp_inputから遷移した場合（APIの処理）
    $url = 'https://map.yahooapis.jp/search/local/V1/localSearch?appid=';
    $appid = 'dj00aiZpPTFibGozVXdXSXVVUCZzPWNvbnN1bWVyc2VjcmV0Jng9MzM-';
    $shop_id = $_GET['shop_id'];

    //変換

    $serch_url = $url . $appid . '&uid='. $shop_id . '&output=json&image=true&results=100';
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

    //変数に入れる
    //店舗名
    $shop_name = $result['Feature'][0]['Name'];
    //住所
    $address = $result['Feature'][0]['Property']['Address'];
    //電話番号
    if(isset($result['Feature'][0]['Property']['Tel1'])){
        $tel = $result['Feature'][0]['Property']['Tel1'];
    } else {
        $tel = "登録されておりません";
    }
    //アクセス
    if(isset($result['Feature'][0]['Property']['Access1'])){
        $access = $result['Feature'][0]['Property']['Access1'];
    }else {
        $access = "詳細なアクセス方法はありません。。";
    }
    //キャッチコピー
    if(isset($result['Feature'][0]['Property']['CatchCopy'])){
        $catchcopy = $result['Feature'][0]['Property']['CatchCopy'];
    } else {
        $catchcopy = "キャッチコピー情報はありません。";
    }

    //写真
    $image = $result['Feature'][0]['Property']['LeadImage'];

    $output = "
    <div class='sample1'><h1>基本情報</h1></div>
    <h2>{$shop_name}</h2>
    <img src=".$image." align='left' vspace='30' hspace='30'>
    <table align='left' border='1'>
        <tr>
            <th>所在地</th>
            <td>{$address}</td>
        </tr>
        <tr>
            <th>問い合わせ先</th>
            <td>TEL{$tel}</td>
        </tr>
        <tr>
            <th>アクセス</th>
            <td>{$access}</td>
        /tr>
    </table>
";

?>
<?php require './header.php'; ?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/ydlp_out.css">
</head>
<body>
<table>
    <tr>
        <th></th>
        <th></th>
    </tr>
    <?=$output?>
</table>
</body>
</html>

