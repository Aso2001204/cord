<!DOCTYPE html>
<html>
<head>
    <meta chaset="UTF-8">
    <title>最終課題</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<form action="login-out.php" method="post">
    <div class="content">
        <div class="msg">
            <h1>AsoSystem</h1>
            <h2>Aso PHP Program Exercise</h2>
        </div>

        <div class="inp">
            <p>email・パスワードを入力してください</p>
            <p class="text">E-mail</p>
            <p><input type="text" class="input" name="email" placeholder="E-mail" aligin="center"></p>

            <p class="text">Password</p>
            <p><input type="text" class="input" name="pass" placeholder="Password" aligin="center"></p>
        </div>
        <p><button type="submit" class="btn">送信</button></p>

    </div>
    <p class="ms">成功例：hanako@s.asojuku.ac.jp　hanako2020</p>

</form>
</body>
</html>