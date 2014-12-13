<?php
session_start();
$is_login = isset($_SESSION["user_id"]);

$host = "localhost";
if(!$conn = mysql_connect($host, "s1413137", "s1413137hoge")){
        die("MySQL接続エラー.<br />");
}
mysql_select_db("s1413137", $conn);
mysql_set_charset("utf8");

if($is_login){
    $login_user_id = $_SESSION['user_id'];
    $res = mysql_query("select name from users where id = '$login_user_id'");
    $row = mysql_fetch_assoc($res);
    $login_user_name = $row['name'];
    mysql_free_result($res);
}

?>

<!DOCTYPE html>
<html dir="ltr" lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=yes, maximum-scale=1.0, minimum-scale=1.0">
<title>全テーブルを表示 - Phorm</title>
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
if(!$is_login){
    print("<form action='login.php' method='post'>");
    print("<table><tr><td>ユーザID</td><td><input type='text' name='login_user_id'></td></tr><tr><td>パスワード</td><td><input type='password' name='login_user_pass'></td></tr><tr><td colspan='2'><input type='submit' value='ログイン'><td></tr></table>");
    print("</form>");
} else {
    print("<p class='tel'><span>ログインユーザ:</span> $login_user_name</p>");
    print("<p class='open'><form action='logout.php' method='post'><input type='submit' value='ログアウト'></form></p>");
}
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
            <li><a href="index.php"><strong>トップページ</strong><span>Top</span></a></li>
            <li><a href="bookmark_new.php"><strong>ブックマーク新着</strong><span>Bookmark</span></a></li>
            <li><a href="userpage.php"><strong>ユーザーページ</strong><span>User Page</span></a></li>
            <li><a href="picpost_form.php"><strong>写真投稿</strong><span>Photo Post</span></a></li>
            <li><a href="signup_form.php"><strong>ユーザ登録</strong><span>Sign Up</span></a></li>
            <li class="last actiove"><a href="get_tables.php"><strong>全テーブルを表示</strong><span>Show Tables</span></a></li>
        </ul>
    </div>
    </div> 
</nav>
<!-- / メインナビゲーション -->

<div id="wrapper">
  
  <!-- コンテンツ -->
        <section id="main">
<section class="content">
<h3 class="heading">写真テーブル - pics</h3>
<article>
<table class='tablerow'>
<tr><th>ID</th><th>タイトル</th><th>ファイル名</th><th>備考</th><th>ユーザID</th><th>投稿日</th></tr>
<?php
$sql = "select * from pics";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_array($res)){
        print("<tr>");
        print("<td>".$row["id"]."</td>");
        print("<td>".$row["title"]."</td>");
        print("<td>".$row["file_name"]."</td>");
        print("<td>".$row["remarks"]."</td>");
        print("<td>".$row["user_id"]."</td>");
        print("<td>".$row["post_date"]."</td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>
</article>
</section>

<section class="content">
<h3 class="heading">ユーザテーブル - users</h3>
<article>
<table class='tablerow'>
<tr><th>ID</th><th>ユーザ名</th><th>パスワード</th></tr>
<?php
$sql = "select * from users";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_array($res)){
        print("<tr>");
        print("<td>".$row["id"]."</td>");
        print("<td>".$row["name"]."</td>");
        print("<td>".$row["pass"]."</td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>
</article>
</section>

<section class="content">
<h3 class="heading">タグテーブル - tags</h3>
<article>
<table class="table">
<tr><th>タグ名</th></tr>
<?php

$sql = "select * from tags";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_array($res)){
        print("<tr>");
        print("<td>".$row["name"]."</td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>
</article>
</section>

<section class="content">
<h3 class="heading">評価テーブル - evaluations</h3>
<article>
<table class='tablerow'>
<tr><th>写真ID</th><th>ユーザID</th><th>評価値</th></tr>
<?php

$sql = "select * from evaluations";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_array($res)){
        print("<tr>");
        print("<td>".$row["pic_id"]."</td>");
        print("<td>".$row["user_id"]."</td>");
        print("<td>".$row["value"]."</td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>
</article>
</section>

<section class="content">
<h3 class="heading">付与テーブル - additions</h3>
<article>
<table class='tablerow'>
<tr><th>タグ名</th><th>写真ID</th></tr>
<?php

$sql = "select * from additiions";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_array($res)){
        print("<tr>");
        print("<td>".$row["tag_name"]."</td>");
        print("<td>".$row["pic_id"]."</td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>
</article>
</section>

<section class="content">
<h3 class="heading">ブックマークテーブル - bookmarks</h3>
<article>
<table class='tablerow'>
<tr><th>ユーザID</th><th>タグ名</th></tr>
<?php

$sql = "select * from bookmarks";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_array($res)){
        print("<tr>");
        print("<td>".$row["user_id"]."</td>");
        print("<td>".$row["tag_name"]."</td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>
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