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

$mode = $_GET['search_mode'];
$word = $_GET['word'];

if($mode == "keyword"){
	$sql = "select distinct pics.id as pic_id, pics.title as title, pics.file_name as file_name, users.name as user_name from pics, additions, users where users.id = pics.user_id and ((pics.title like '%$word%') or (pics.remarks like '%$word%') or (pics.id = additions.pic_id and additions.tag_name like '%$word%'))";
} else if($mode == "title"){
	$sql = "select distinct pics.id as pic_id, pics.title as title, pics.file_name as file_name, users.name as user_name from pics, users where users.id = pics.user_id and pics.title like '%$word%'";
} else if($mode == "tag"){
	$sql = "select distinct pics.id as pic_id, pics.title as title, pics.file_name as file_name, users.name as user_name from pics, additions, users where users.id = pics.user_id and pics.id = additions.pic_id and additions.tag_name like '%$word%'";
}

$res = mysql_query($sql, $conn);


?>

<!DOCTYPE html>
<html dir="ltr" lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=yes, maximum-scale=1.0, minimum-scale=1.0">
<title>検索</title>
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
    	<h3 class="heading">検索結果</h3>
<?php

while($row = mysql_fetch_assoc($res)){
	print("<section><article>");
	print("<a href='show_picture.php?pic_id=".$row['pic_id']."'><img src='".$row['file_name']."' width='190' height='140' alt='".$row['title']."' class='alignleft border' /></a>");
	print("<table class='table'><tr><th>タイトル</th><td>".$row['title']."</td></tr>");
	print("<tr><th>投稿者</th><td>".$row['user_name']."</td></tr></table>");
	print("</article></section>");
}
mysql_free_result($res);

?>
    </section>
    </section>
	<!-- / コンテンツ -->

	<aside id="sidebar">
	<h3 class="heading">写真を探す</h3>
		<article>
		<form action="search.php" method="get">
		<table>
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
		</article>
	</aside>
 
</div>
 

<address>Copyright(c) 2013 Sample Inc. All Rights Reserved. Design by <a href="http://f-tpl.com" target="_blank" rel="nofollow">http://f-tpl.com</a></address>

</body>
</html>