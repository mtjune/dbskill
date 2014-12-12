<?php
session_start();
$is_login = isset($_SESSION["user_id"]);

$host = "localhost";
if(!$conn = mysql_connect($host, "s1413137", "s1413137hoge")){
        die("MySQL接続エラー.<br />");
}
mysql_select_db("s1413137", $conn);
mysql_set_charset("utf8");

$login_user_id = $_POST['login_user_id'];
$login_user_pass = $_POST['login_user_pass'];

$sql = "select * from users where id = '$login_user_id'";
$res = mysql_query($sql, $conn);
$row = mysql_fetch_assoc($res);

if(mysql_num_rows($res) == 0){
    // IDが存在しない
    $login_result = 1;
}else if($row['pass'] === $login_user_pass){
    // ログイン成功
    $_SESSION['user_id'] = $login_user_id;
    $login_result = 0;
}else{
    // パスが一致しない
    $login_result = 2;
}

?>

<!DOCTYPE html>
<html dir="ltr" lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=yes, maximum-scale=1.0, minimum-scale=1.0">
<title><?php print($pic_title) ?> - Phorm</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="style.css" type="text/css" media="screen">
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<script src="js/css3-mediaqueries.js"></script>
<![endif]-->
<script src="js/jquery1.7.2.min.js"></script>
<script src="js/script.js"></script>
</head>

<body id="subpage">
<header id="header">
  <h1>Photos Posted Site.</h1>
  
  <!-- ロゴ -->
    <div class="logo">
        <a href="index.php"><img src="images/Phorm_top_logo.png" width="45" height="45" alt="Sample site" /></a>
    </div>
    <!-- / ロゴ -->
    <!-- 電話番号+受付時間 -->
    <div class="info">
<?php
$login_user_id = $_SESSION['user_id'];
$sql = "select name from users where id = '$login_user_id'";
$res = mysql_query($sql, $conn);
$row = mysql_fetch_assoc($res);
$login_user_name = $row['name'];

print("<p class='tel'><span>ログインユーザ:</span> $login_user_name</p>");
print("<p class='open'><form action='logout.php' method='post'><input type='submit' value='ログアウト'></form></p>");
mysql_free_result($res);
?>
    </div>
    <!-- / 電話番号+受付時間 -->
</header>

<!-- メインナビゲーション -->
<nav id="mainNav">
    <div class="inner">
    <a class="menu" id="menu"><span>MENU</span></a>
        <div class="panel">   
        <ul>
            <li class="active"><a href="index.php"><strong>トップページ</strong><span>Top</span></a></li>
                <li><a href="subpage.html"><strong>ブックマーク新着</strong><span>Bookmark</span></a></li>
                <li><a href="get_pics.php"><strong>ユーザーページ</strong><span>User Page</span></a></li>
                <li><a href="picpost_form.html"><strong>写真投稿</strong><span>Photo Post</span></a></li>
                <li><a href="signup_form.html"><strong>ユーザ登録</strong><span>Sign Up</span></a></li>
                <li class="last"><a href="get_tables.php"><strong>全テーブルを表示</strong><span>Show Tables</span></a></li>
            </ul>   
    </div>
    </div> 
</nav>
<!-- / メインナビゲーション -->

<div id="wrapper">
  
  <!-- コンテンツ -->
        <section id="main">
    <section class="content">
    <h3 class="heading">
<?php
    if($login_result === 0){
        print("ログインに成功しました");
    }else{
        print("ログインに失敗しました");
    }
?>
        </h3>
        <article>
<?php 
if($login_result === 0){
    print("ようこそ、".$login_user_name."さん。<br>");
}else if($login_result === 1){
    print("ユーザIDが存在しません。<br>");
}else{
    print("パスワードが一致しません。<br>");
}

?>
        </article>
    </section>
    </section>
        <!-- / コンテンツ -->

        <aside id="sidebar">

        </aside>
 
</div>
 
<address>Copyright(c) 2013 Sample Inc. All Rights Reserved. Design by <a href="http://f-tpl.com" target="_blank" rel="nofollow">http://f-tpl.com</a></address>

</body>
</html>