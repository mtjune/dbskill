<?php
session_start();

$host = "localhost";
if(!$conn = mysql_connect($host, "s1413137", "s1413137hoge")){
        die("MySQL接続エラー.<br />");
}
mysql_select_db("s1413137", $conn);
mysql_set_charset("utf8");
?>

<!DOCTYPE html>
<html dir="ltr" lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=yes, maximum-scale=1.0, minimum-scale=1.0">
<title>Phorm : 写真投稿サイト</title>
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

<body>
<header id="header">
  <h1>Photos Posted Site.</h1>
  
  <!-- ロゴ -->
    <div class="logo">
        <a href="index.html"><img src="images/Phorm_top_logo.png" width="45" height="45" alt="Sample site" /></a>
    </div>
    <!-- / ロゴ -->
    <!-- 電話番号+受付時間 -->
    <div class="info">
<?php
if(!isset($_SESSION["user_id"])){
    print("<form action='login.php' method='post'>");
    print("<table><tr><td>ユーザID</td><td><input type='text' name='login_user_id'></td></tr><tr><td>パスワード</td><td><input type='password' name='login_user_pass'></td></tr><tr><td colspan='2'><input type='submit' value='ログイン'><td></tr></table>");
    print("</form>");
} else {
    $login_user_id = $_SESSION['user_id'];
    $sql = "select name from users where id = '$user_id'";
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
  
  <!-- メイン画像 -->
    <div id="mainBanner">
        <img src="images/Phorm_top_logo.png" width="50%" alt="Phorm" class="alignleft border">
        <p>
        <br>
        <form action="search.php" method="get">
        <table>
            <tr><td>写真を探す</td></tr>
            <tr><td><input type="text" name="word"></td><td><input type="submit" value="検索"></td></tr>
        </table>
        <table>
            <tr>
                <td><input type="radio" name="search_mode" value="keyword" checked></td>
                <td>キーワード検索</td>
            </tr>
            <tr>
                <td><input type="radio" name="search_mode" value="title"></td>
                <td>タイトル検索</td>
            </tr>
            <tr>
                <td><input type="radio" name="search_mode" value="tag"></td>
                <td>タグ検索</td>
            </tr>
        </table>
        </form>
        </p>
    </div>
    <!-- / メイン画像 -->
    

  
</div>
 
<address>Copyright(c) 2013 Sample Inc. All Rights Reserved. Design by <a href="http://f-tpl.com" target="_blank" rel="nofollow">http://f-tpl.com</a></address>

</body>
</html>