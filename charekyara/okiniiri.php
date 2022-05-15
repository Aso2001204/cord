<?php
session_start();

$pdo = new PDO('mysql:host=mysql154.phy.lolipop.lan;
                dbname=LAA1353460-charekyra;charset=utf8',
                'LAA1353460',
                'PassChare1019');
$sql = 'SELECT * FROM t_favorite WHERE user_id = ?';
$result = $pdo -> prepare($sql);
$result -> bindValue(1,$_SESSION['user']['user_id']);
$result -> execute();

?>
<?php require './header.php'; ?>
<head>
    <link rel="stylesheet"href="css/style1.css">
    <link rel="stylesheet"href="css/myPageNav.css">

</head>
<nav class="MyInformationNav">
    <ul>
        <li><a href="http://keen-akune-3587.bambina.jp/ANYPORT/mypage/mypage.php">登録情報</a></li>
        <li><a href="./okiniiri.php">お気に入り</a></li>
        <li><a href="./Shin.php">検索履歴</a></li>
    </ul>
</nav>
<div class="c">
    <h2 id="title">お気に入り結果一覧</h2>
</div>

<?php
foreach($result as $row) {
    echo '<article>';
    echo '<figure>';
    echo '<img src="' . $row["image"] . '" alt="画像">';
    echo '</figure>';
    echo '<div class="text_content">';
    echo '<h3><a href="okiniiriDetail.php?shop_id='.$row['shop_id'].'"target="_blank">' . $row["shop_name"] . '</a></h3>';
    echo '<p class="text_excerpt" > '.$row['category'].'<br > 場所　：'.$row["address"].'</p>';
    echo '</div>';
    echo '</article>';
}
?>
<?php require './footer.php';?>

<!--
<ul class="list">
    <li><a href="test3.php">1</a></li>
    <li><a href="test10.php">2</a></li>
    <li><a href="test11.php">3</a></li>
    <li><a href="test12.php">4</a></li>
    ・・・
    <li><a href="test13.php">10</a></li>
</ul>
-->