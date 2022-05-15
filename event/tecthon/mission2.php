<?php
// 文字コード設定
header('Content-Type: application/json; charset=UTF-8');
const URL = 'http://check/';
// method値の確認
//echo "METHOD:".$_SERVER["REQUEST_METHOD"]."\n";
// body値の確認
// PHPでBODYの文字列を取るにはphp:://inputを取得する
//
//echo "BODY:".$_SERVER['REQUEST_URI'].file_get_contents('php://input')."\n";

//echo "status:".http_response_code()."\n";

$curl = curl_init(URL);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET'); // メソッド指定
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // レスポンスを文字列で受け取る

// レスポンスを変数に入れる
$response = curl_exec($curl);

// curlの処理を終了
curl_close($curl);


$url=$_SERVER['REQUEST_URI'];

$_GET['check']=file_get_contents('php://input');

if(isset($url)&& $url=="/check"){
    $response=[
        "status_code" => http_response_code(),
        "method" => $_SERVER["REQUEST_METHOD"]
    ];

    $Schema=[
        "schema" => "http://json-schema.org/draft-04/schema#",
        "type" => "object",
        "properties"=> [
            "status_code" => [
                "type"=> "number"
            ],
            "method"=> [
                "type"=> "string"
            ]
        ],
        $required = [
            "status_code",
            "method"
        ],
    ];
}else{
    $response='miss-url';
}


// 配列をjson形式にデコードして出力, 第二引数は、整形するためのオプション
print json_encode($response, JSON_PRETTY_PRINT);
?>
