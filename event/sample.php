<?php

//$address = "〒819-1631 福岡県糸島市二丈福井２７６８−３";
//$lat =33.58371761613404;
//$lng =130.42125071225928;
$address = "麻生情報ビジネス専門学校";
//$locationbias = 'circle%3A2000%'.$lat.'%2C'.$lng;
//$phonenumber = "%2B16502530000";

//Find Place requestsを使って住所から特定の一店舗を検索
$key = "AIzaSyD756fOGZoQkH4WL5B266Ivy8h6GtSDsIU";
$url = "https://maps.googleapis.com/maps/api/place/findplacefromtext/json";

$params =[
    "input" => $address,
];

//echo 'aaa=',$params;

$query = http_build_query($params);
$request = $url . '?&' .$query.'&key='.$key;

//curlセッション初期化
$ch = curl_init();

//URLとオプションを指定する
curl_setopt($ch,CURLOPT_URL,$request);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//URLの情報を取得
$response = curl_exec($ch);
//$json=file_get_contents($request);

$result = mb_convert_encoding($response, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
//$result = json_decode($result,JSON_PRETTY_PRINT);
$result = json_decode($result,true);
curl_close($ch);

//出力
var_dump($result);

//終了
curl_close($ch);
?>