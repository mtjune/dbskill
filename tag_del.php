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

$pic_id = $_POST['pic_id'];
$tag_name = $_POST['tag_name'];

$sql = "select title from pics where id = '$pic_id'";
$res = mysql_query($sql, $conn);
$row = mysql_fetch_assoc($res);

$pic_title = $row['title'];

mysql_free_result($res);

$flag1 = false;
$flag2 = false;

$sql = "delete from additions where pic_id ='$pic_id' and tag_name = '$tag_name'";
$is_suc = mysql_query($sql, $conn);


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
            <li class="active"><a href="index.php"><strong>トップページ</strong><span>Top</span></a></li>
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
        
    <section class="content">
        <h3 class="heading">「<?php print($pic_title); ?>」のタグ「<?php print($tag_name); ?>」を削除</h3>
        <article>
<?php 
if($is_suc){
    print("「".$tag_name."」タグを削除しました。<br>");
} else {
    print("タグを削除出来ませんでした。<br>");
}

print("<br><br>");
print("<a href='show_picture.php?pic_id=$pic_id'>「".$pic_title."」へ戻る</a>");

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