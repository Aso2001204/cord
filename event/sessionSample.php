<?php
$pdo = new PDO('mysql:host=mysql139.phy.lolipop.lan;
dbname=LAA1290556-mikado;charset=utf8',
    'LAA1290556',
    'mikado');
ini_set('display_errors',1);
/*require_once('db_info.php');*/
if (isset($_POST['abcd'])) {
    $search = htmlspecialchars($_POST['search'],ENT_HTML5,'UTF-8');
    $search_value = '%'.$_POST['search'].'%';

    $sql = "SELECT * FROM m_item WHERE item_name LIKE ? ORDER BY item_name";
    $result = $pdo -> prepare($sql);
    $result -> bindValue(1,$search_value);
    $result -> execute();
    $resultList = $result->fetchAll(PDO::FETCH_ASSOC);

} else {
    $resultList = $pdo->query('SELECT * FROM m_item');
}


$pdo = null;

/*
$sql = "SELECT * FROM m_item where item_name LIKE '%$search%' order by item_name";
$stmt = array();
foreach ($pdo->query($sql) as $row) {
array_push($stmt,$row);
}
*/
?>
<!DOCTYPE html>
<html lang="ja" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
      xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div id="header-fixed">
    <div id="header-bk">
        <div id="header">
            <div class="hedder1">
                <figure><img src="imag/title.png" alt="shop" width="80px" height="80px"></figure>
                <form action="" method="post" class="search_container">
                    <input type="text" size="25" placeholder="キーワード検索" name="search">
                    <button type="submit" name="abcd" value="&#xf002"></button>
                </form>
                <img src="imag/ハート.png" alt="hart" width="40.0px"><br>

                <a href="http://2101121.but.jp/kaihatu/kaiinzyoho.html" class="btn">会員メニュー</a>

                <a href="http://2101121.but.jp/kaihatu/ka-to.php" class="btn1">カート</a>
                <a href="http://2101121.but.jp/kaihatu/customers_login/logout.php" class="btn1">ログアウト</a>
            </div>
            <div class="border">
                <label>　Top </label>
            </div>
        </div>
    </div>
</div>
<div id="body-bk">
    <div id="body">
        <p>
            <h2>おすすめの商品</h2>
        </p>
        <?php
        $filepath='imag/';
        //require_once "TOPgamen.php";

            foreach ($resultList as $item) {
                //foreach ($stmt as $key):
                    echo  '<div class="border-underline">  ';

                    echo '<div class="syohinimg"><p><img src="', $filepath . $item['image'], '" width="110.0px"></p>';

                    echo '<div class="syohin">',$item['text'], '</div>';
                    echo '<div class="clear"></div>';
                    echo '<div class="hinmei">',$item['item_name'], '</div>';
                    echo '<div class="en">¥',$item['price'], '</div>';
                    echo '<div class="syohinbotan"><button>お気に入り</button></div>';
                    echo '<form action="ka-to.php" method="post">';
                    echo '<button class="ka-to">カート</button>';
                    $sql=$pdo->prepare('INSERT INTO d_cart(user_id,item_name,price) VALUES (?,?,?)');
                    $sql->bindValue(1, $_SESSION['m_customers']['customer_code']);
                    $sql->bindValue( 2, $item['item_name'],PDO::PARAM_STR);
                    $sql->bindValue( 3, $item['price'], PDO::PARAM_STR);
                    $sql->execute();
                //endforeach;
                echo '<hr class="syohinhr"></form>';
            }

        ?>

    </div>
</div>


<div id="footer-fixed">
    <div id="footer-bk">
        <div id="footer">
            <div class="border2"></div>

            <p class="syurui">種類別検索</p>
            <a href="" class="btn2" id="add">メーカー</a>
            <a href="" class="btn2">イヤホン種類</a>

        </div>
    </div>
</div>

<div class="cube_area" id="addCube"></div>

</body>

</html>