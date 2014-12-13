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

$tag_name = $_POST['tag_name'];
if($is_login){
    $sql = "delete from bookmarks where user_id = '$login_user_id' and tag_name = '$tag_name'";
    $is_suc = mysql_query($sql, $conn);
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=yes, maximum-scale=1.0, minimum-scale=1.0">
<title>ブックマーク削除 - Phorm</title>
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
    mysql_free_result($res);
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
            <li class="last"><a href="get_tables.php"><strong>全テーブルを表示</strong><span>Show Tables</span></a></li>
        </ul> 
    </div>
    </div> 
</nav>
<!-- / メインナビゲーション -->

<div id="wrapper">
  
  <!-- コンテンツ -->
        <section id="main">
<?php
if($is_login){
    print("<section class='content'>\n");
    print("<h3 class='heading'>ブックマーク削除</h3>\n");
    print("<article>\n");
    print("タグ「".$tag_name."」のブックマークを削除しました。\n");
    print("<br><br>");
    print("<a href='userpage.php'>ユーザーページへ戻る</a>");
    print("</article>\n");
    print("</section>\n");
}else{
    print("<section class='content'>\n");
    print("<h3 class='heading'>ログイン情報</h3>\n");
    print("<article>\n");
    print("右上のフォームでログインしてください。<br>\n");
    print("ユーザ登録されてない方は, 上のメニューからユーザ登録をしてください");
    print("<br><br>");
    print("<a href='userpage.php'>ユーザーページへ戻る</a>");
    print("</article>\n");
    print("</section>\n");
}
?>
    </section>
        <!-- / コンテンツ -->

        <aside id="sidebar">

        </aside>
 
</div>
 <!-- フッター -->
<footer id="footer">
    <div class="inner">
    <!-- 左側 -->
        <div id="info" class="grid">
            <!-- 電話番号+受付時間 -->
            <div class="info">
                <p class="tel"><span>作成者:</span> 山田純也</p>
                <p class="open">学籍番号: 201413137</p>
            </div>
            <!-- / 電話番号+受付時間 -->
        </div>  
        <!-- / 左側 -->
    </div>
</footer>
<!-- / フッター -->
<address>Copyright(c) 2013 Sample Inc. All Rights Reserved. Design by <a href="http://f-tpl.com" target="_blank" rel="nofollow">http://f-tpl.com</a></address>

</body>
</html>