<?php

$host = "localhost";
if(!$conn = mysql_connect($host, "s1413137", "s1413137hoge")){
        die("MySQL接続エラー.<br />");
}
mysql_select_db("s1413137", $conn);
mysql_set_charset("utf8");

$mode = $_GET['search_mode'];
$word = $_GET['word'];

if($mode == "keyword"){
	$sql = "select pics.id as pic_id, pics.title as title, pics.file_name as file_name, users.name as user_name from pics, additions, users where users.id = pics.user_id and ((pics.title like '%$word%') or (pics.remarks like '%$word%') or (pics.id = additions.pic_id and additions.tag_name like '%$word%'));";
} else if($mode == "title"){
	$sql = "select pics.id as pic_id, pics.title as title, pics.file_name as file_name, users.name as user_name from pics, users where users.id = pics.user_id and pics.title like '%$word%';";
} else if($mode == "tag"){
	$sql = "select pics.id as pic_id, pics.title as title, pics.file_name as file_name, users.name as user_name from pics, additions, users where users.id = pics.user_id and pics.id = additions.pic_id and additions.tag_name like '%$word%';";
}

$res = mysql_query($sql, $conn);



?>

<!DOCTYPE html>
<html dir="ltr" lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=yes, maximum-scale=1.0, minimum-scale=1.0">
<title>ホームページサンプル株式会社のサイトです</title>
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
  <h1>ホームページサンプル株式会社のサイトです</h1>
  
  <!-- ロゴ -->
	<div class="logo">
		<a href="index.html"><img src="images/logo.png" width="45" height="45" alt="Sample site" /><p>Company Name<span>Your Company Slogan</span></p></a>
	</div>
	<!-- / ロゴ -->
	<!-- 電話番号+受付時間 -->
	<div class="info">
		<p class="tel"><span>電話:</span> 012-3456-7890</p>
		<p class="open">受付時間: 平日 AM 10:00 〜 PM 5:00</p>
	</div>
	<!-- / 電話番号+受付時間 -->
</header>

<!-- メインナビゲーション -->
<nav id="mainNav">
	<div class="inner">
  	<a class="menu" id="menu"><span>MENU</span></a>
		<div class="panel">   
    	<ul>
    		<li><a href="index.html"><strong>トップページ</strong><span>Top</span></a></li>
				<li><a href="subpage.html"><strong>ごあいさつ</strong><span>Greeting</span></a></li>
				<li><a href="subpage.html"><strong>サービス概要</strong><span>Service</span></a></li>
				<li><a href="subpage.html"><strong>弊社の取り組み</strong><span>Approach</span></a></li>
				<li class="active"><a href="subpage.html"><strong>会社情報</strong><span>Company</span></a></li>
				<li class="last"><a href="subpage.html"><strong>お問い合わせ</strong><span>Contact</span></a></li>
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
	print("<p></p>");
	print("<p><h3>".$row['title']."</h3></p>");
	print("<p></p>");
	print("<p><h4>	:".$row['user_name']."</h4></p>");
	print("</section></article");
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