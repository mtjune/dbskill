<?php
session_start();
$is_login = isset($_SESSION["user_id"]);

$host = "localhost";
if(!$conn = mysql_connect($host, "s1413137", "s1413137hoge")){
        die("MySQL接続エラー.<br />");
}
mysql_select_db("s1413137", $conn);
mysql_set_charset("utf8");

$pic_id = $_GET['pic_id'];
$sql = "select users.name as user_name, pics.title as title, pics.file_name as file_name, pics.remarks as remarks, pics.post_date as post_date from pics, users where pics.user_id = users.id and pics.id = '$pic_id'";

$res = mysql_query($sql, $conn);
$row = mysql_fetch_assoc($res);

$pic_title = $row['title'];
$pic_filename = $row['file_name'];
$pic_remarks = $row['remarks'];
$pic_post_date = $row['post_date'];
$pic_user_name = $row['user_name'];

mysql_free_result($res);


?>

<!DOCTYPE html>
<html dir="ltr" lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=yes, maximum-scale=1.0, minimum-scale=1.0">
<title>ユーザーページ - Phorm</title>
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
    $login_user_id = $_SESSION['user_id'];
    $sql = "select name from users where id = '$login_user_id'";
    $res = mysql_query($sql, $conn);
    $row = mysql_fetch_assoc($res);
    $login_user_name = $row['name'];

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
            <li class="active"><a href="userpage.php"><strong>ユーザーページ</strong><span>User Page</span></a></li>
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
    print("<h3 class='heading'>ログイン情報</h3>\n");
    print("<article>\n");
    print("<table class='table'>\n");
    print("<tr><th>ユーザID</th><td>$login_user_id</td></tr>\n");
    print("<tr><th>ユーザ名</th><td>$login_user_name</td></tr>\n");
    print("</table>\n");
    print("</article>\n");
    print("</section>\n");

    $sql = "select * from pics where user_id = '$login_user_id'";
    $res = mysql_query($sql, $conn);

    print("<section class='content'>\n");
    print("<h3 class='heading'>投稿写真</h3><br><br>\n");
    while($row = mysql_fetch_assoc($res)){
        print("<a href='show_picture.php?pic_id=".$row['pic_id']."'>");
        print("<section class='square'><article>");
        print("<img src='".$row['file_name']."' width='190' height='140' alt='".$row['title']."' class='alignleft border' />");
        print("<table class='table'><tr><th>タイトル</th><td>".$row['title']."</td></tr></table>");
        print("</article></section>");
        print("</a><br><br>");
    }
    print("</section>\n");
}else{
    print("<section class='content'>\n");
    print("<h3 class='heading'>ログイン情報</h3>\n");
    print("<article>\n");
    print("右上のフォームでログインしてください。<br>\n");
    print("ユーザ登録されてない方は, 上のメニューからユーザ登録をしてください");
    print("</article>\n");
    print("</section>\n");
}
?>
    </section>
        <!-- / コンテンツ -->

        <aside id="sidebar">
        <h3 class="heading">ブックマークしているタグ</h3>
        <article>
        <ul>
<?php

$sql = "select tag_name from bookmarks where user_id = '$login_user_id';";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_assoc($res)){
        $tag = $row['tag_name'];
        print("<li><a href='search.php?search_mode=tag&word=$tag'>$tag</a><form action='bookmark_del.php' method='post'><input type='hidden' name='tag_name' value='$tag'><input type='submit' value='解除'></form></li>");
}
mysql_free_result($res);

?>
        </ul>
        </article>
        </aside>
 
</div>
 
<address>Copyright(c) 2013 Sample Inc. All Rights Reserved. Design by <a href="http://f-tpl.com" target="_blank" rel="nofollow">http://f-tpl.com</a></address>

</body>
</html>