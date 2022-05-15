<?php session_start() ?>
<?php
//https://www.webdevqa.jp.net/ja/php/url%E3%83%91%E3%83%A9%E3%83%A1%E3%83%BC%E3%82%BF%E3%83%BC%E3%81%A8%E3%81%97%E3%81%A6%E9%85%8D%E5%88%97%E3%82%92%E6%B8%A1%E3%81%99/969034808/
$cnt = $_GET['cnt'];




//出力処理
//sessionに入ってるのを変数に移し、unset
$result = $_SESSION['PDF'];
//$result = serialize($result);
//$result = unserialize($result);　文字列から配列に戻す
unset($_SESSION['PDF']);
$_SESSION['PDF'] = $result;

$count = 0;
$data = [];
foreach ($result['Feature'] as $row){
    $data[$count] = $row;
    $count++;
}
//$output変数に出すものを入れる

//試しに何が入ってるかを出力
/*
 echo '<pre>';
var_dump($data[$cnt]);
echo '</pre>';
*/

//あるものとないものがあるためifで判定をする
//Telver
if(isset($data[$cnt]['Property']['Tel1'])){
    $tel = $data[$cnt]['Property']['Tel1'];
} else {
    $tel = "登録されておりません";
}
//アクセス方法ver
if(isset($data[$cnt]['Property']['Access1'])){
    $access = $data[$cnt]['Property']['Access1'];
}else {
    $access = "詳細なアクセス方法はありません。。";
}
//キャッチコピーver
if(isset($data[$cnt]['Property']['CatchCopy'])){
    $catchcopy = $data[$cnt]['Property']['CatchCopy'];
} else {
    $catchcopy = "キャッチコピー情報はありません。";
}

//お気に入りボタン
$favorite = "<form action='' method='post'>
                <button type='submit' name='favorite' value='push'>♡</button>
            </form>";
$output = "
    <button type='button' onclick='history.back()'>戻る</button>
    <div class='sample1'><h1>基本情報</h1></div>
    <h2>{$data[$cnt]['Name']}</h2>{$favorite}
    <img src=".$data[$cnt]['Property']['LeadImage']." align='left' vspace='30' hspace='30'>
    <table align='left' border='1'>
        <tr>
            <th>所在地</th>
            <td>{$data[$cnt]['Property']['Address']}</td>
        </tr>
        <tr>
            <th>問い合わせ先</th>
            <td>TEL{$tel}</td>
        </tr>
        <tr>
            <th>アクセス</th>
            <td>{$access}</td>
        </tr>
    </table>
    
";

$result = "ok";

//戻るボタンの処理
$return = "<button type='button' onclick='history.back()'><span>戻る</span></button>";

/*口コミAPIの処理開始
//Find Place requestsを使って住所から特定の一店舗を検索
$key = "AIzaSyD756fOGZoQkH4WL5B266Ivy8h6GtSDsIU";
$url = "https://maps.googleapis.com/maps/api/place/findplacefromtext/json";

$address = $data[$cnt]['Name'];
$params = [
    "input" => $address,
];



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

$resultList = mb_convert_encoding($response, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
//$result = json_decode($result,JSON_PRETTY_PRINT);
$resultList = json_decode($resultList,true);
curl_close($ch);

//試しに何が入ってるかを出力
/*
echo '<pre>';
var_dump($resultList);
echo '</pre>';
*/

// お気に入りボタン押した後
if(isset($_POST['favorite'])) {
    $user_id = 3;
    $pdo = new PDO('mysql:host=mysql154.phy.lolipop.lan;
                dbname=LAA1353460-charekyra;charset=utf8',
        'LAA1353460',
        'PassChare1019');
$sql = "INSERT INTO t_favorite(user_id,shop_id,shop_name,address,image,category) VALUES(?,?,?,?,?,?)";
$lists = $pdo -> prepare($sql);
$lists -> execute([$_SESSION['user']['id'],$data[$cnt]['Property']['Uid'],$data[$cnt]['Name'],$data[$cnt]['Property']['Address'],$data[$cnt]['Property']['LeadImage'],$data[$cnt]['Category'][0] ]);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/ydlp_out.css">
</head>
<body>
<?=$output?>


</body>
</html>

