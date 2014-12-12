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
        <h3 class="heading"><?php print($pic_title) ?></h3>
        <article>
<?php
        print("<img src='$pic_filename' width='600' alt='$pic_title' class='alignright border' />");
        
?>
        </article>
        <article>
        <table class="table">   
<?php
        print("<tr><th>タイトル</th><td>$pic_title</td></tr>");
        print("<tr><th>投稿者</th><td>$pic_user_name</td></tr>");
        print("<tr><th>投稿日</th><td>$pic_post_date</td></tr>");
        print("<tr><th>備考</th><td>$pic_remarks</td></tr>");
?>
        </table>
        </article>
    </section>
    </section>
        <!-- / コンテンツ -->

        <aside id="sidebar">
       
                <h3 class="heading">タグ</h3>
    <article>
        <ul>
<?php

$sql = "select tag_name from additions where additions.pic_id = '$pic_id';";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_assoc($res)){
        $tag = $row['tag_name'];
        print("<li><a href='search.php?search_mode=tag&word=$tag'>$tag</a><form action='bookmark.php' method='post'><input type='hidden' name='tag_name' value='$tag'><input type='submit' value='ブックマーク'></form><form action='tag_del.php' method='post'><input type='hidden' name='tag_name' value='$tag'><input type='hidden' name='pic_id' value='$pic_id'><input type='submit' value='削除'></form></li>");
}
mysql_free_result($res);

?>
        </ul>
    </article>

    <h3 class="heading">タグを付ける</h3>
    <article>
            <form action="tag_add.php" method="post">
            <?php print("<input type='hidden' name='pic_id' value='$pic_id' />"); ?>
            <select name="tag_name">
                    <option value="新しいタグを付ける">新しいタグを付ける</option>

<?php
$sql = "select name from tags;";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_assoc($res)){
        $tag = $row['name'];
        print("<option value='$tag'>$tag</option>");
}
mysql_free_result($res);
?>

            </select>
            <br>
               新しいタグ<input type="text" name="new_tag_name"><br>
               <input type="submit" value="追加">
                </form>

    </article>
        </aside>
 
</div>
 
<address>Copyright(c) 2013 Sample Inc. All Rights Reserved. Design by <a href="http://f-tpl.com" target="_blank" rel="nofollow">http://f-tpl.com</a></address>

</body>
</html>