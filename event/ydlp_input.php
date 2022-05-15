<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>入力画面</title>
    <link rel="stylesheet" href="./css/ydlp_input.css">
</head>
<body>
<form action="ydlp_in.php" method="post">
    <h1>トップ画面：ここにお知らせが入る</h1>
    <p>
        <input type="text" name="keyword" placeholder="キーワードを入力">
        <button type="submit">検索</button>
    </p>
    <p class="genre">
        <button type="submit" name="category" value="01">
            <h2>グルメ</h2>
            <p>郷土料理、ご当地<br>グルメなど</p>
        </button>
        <button type="submit" name="category" value="0303">
            <h2>遊び</h2>
            <p>キャンプ場、スポーツ<br>リゾート施設など</p>
        </button>
    </p>
    <p class="genre">
        <button type="submit" name="category" value="0305">
            <h2>文化・歴史</h2>
            <p>公園、博物館<br>世界遺産</p>
        </button>
        <button type="submit" name="category" value="02">
            <h2>ショッピング</h2>
            <p>ショッピングセンター<br>伝統工芸品、特産品など</p>
        </button>
    </p>

</form>
</body>
</html>

<!-- いったん保留-->
<!--
        <button type="submit" name="category" value="">
            <h2>イベント</h2>
            <p>花火、祭りなど<br></p>
        </button>
        <button type="submit" name="category" value="0303">
            <h2>自然</h2>
            <p>山、海岸風景<br>植物など</p>
        </button>
-->
<!--
<p>都道府県指定</p>
<p>
    <select name="prefecture">
        <option value="01">北海道
        <option value="02">青森県
        <option value="03">岩手県
        <option value="04">宮城県
        <option value="05">秋田県
        <option value="06">山形県
        <option value="07">福島県
        <option value="08">茨城県
        <option value="09">栃木県
        <option value="10">群馬県
        <option value="11">埼玉県
        <option value="12">千葉県
        <option value="13" selected>東京都
        <option value="14">神奈川県
        <option value="15">新潟県
        <option value="16">富山県
        <option value="17">石川県
        <option value="18">福井県
        <option value="19">山梨県
        <option value="20">長野県
        <option value="21">岐阜県
        <option value="22">静岡県
        <option value="23">愛知県
        <option value="24">三重県
        <option value="25">滋賀県
        <option value="26">京都府
        <option value="27">大阪府
        <option value="28">兵庫県
        <option value="29">奈良県
        <option value="30">和歌山県
        <option value="31">鳥取県
        <option value="32">島根県
        <option value="33">岡山県
        <option value="34">広島県
        <option value="35">山口県
        <option value="36">徳島県
        <option value="37">香川県
        <option value="38">愛媛県
        <option value="39">高知県
        <option value="40">福岡県
        <option value="41">佐賀県
        <option value="42">長崎県
        <option value="43">熊本県
        <option value="44">大分県
        <option value="45">宮崎県
        <option value="46">鹿児島県
        <option value="47">沖縄県
    </select>
</p>
<p>飲食店・ショップ・施設など選べます</p>
<p>
    <select name="category">
        <option value="">ジャンル指定なし
        <option value="">企業・ビジネス
        <option value="02">ショッピング
        <option value="03">レジャー・遊び
        <option value="04">暮らし・生活
        <option value="01" selected>飲食店
        <option value="0101">　和食
        <option value="0102">　洋食
        <option value="0103">　バイキング
        <option value="0104">　中華
        <option value="0105">　アジア・エスニック料理
        <option value="0106">　ラーメン・麺料理
        <option value="0107">　カレー
        <option value="0108">　焼肉・ホルモン
        <option value="0109">　鍋
        <option value="0110">　居酒屋・ビアホール
        <option value="0111">　定食・食堂
        <option value="0112">　創作・無国籍料理
        <option value="0113">　自然食・オーガニック
        <option value="0114">　持ち帰り・宅配
        <option value="0115">　カフェ・喫茶店
        <option value="0116">　コーヒー・茶葉専門店
        <option value="0117">　パン・サンドイッチ
        <option value="0118">　スイーツ
        <option value="0119">　バー
        <option value="0120">　パブ・スナック
        <option value="0121">　ディスコ・クラブ
        <option value="0122">　ビアガーデン
        <option value="0123">　ファミレス・ファーストフード
        <option value="0124">　パーティー・カラオケ
        <option value="0125">　屋形船・クルージング
        <option value="0126">　テーマパークレストラン
        <option value="0127">　オーベルジュ
        <option value="0128">　その他の料理
    </select>
</p>
-->