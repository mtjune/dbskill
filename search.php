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
    	<h3 class="heading">ホームページサンプル株式会社の取り組み</h3>
<?php

while($row = mysql_fetch_assoc($res)){
	print("<article>");
	print("<a href='show_picture.php?pic_id=".$row['pic_id']."'><img src='".$row['file_name']."' width='190' height='140' alt='".$row['title']."' class='alignleft border' /></a>");
	print("<p></p>");
	print("<p><h3>".$row['title']."</h3></p>");
	print("<p></p>");
	print("<p><h4>	:".$row['user_name']."</h4></p>");
	print("</article");
}
mysql_free_result($res);

?>
    </section>
    
    <section class="content">
			<h3 class="heading">ホームページサンプル株式会社の取り組み</h3>
      <article>
			  <img src="images/sample2.jpg" width="190" height="140" alt="" class="alignleft border" />
				<p>革新的な技術で世の中を動かす企業を目指します。ホームページサンプル株式会社では最新技術と自然との調和を目指します。革新的な技術で世の中を動かす企業を目指します。</p>
				<p>ホームページサンプル株式会社では最新技術と自然との調和を目指します。革新的な技術で世の中を動かす企業を目指します。ホームページサンプル株式会社では最新技術と自然との調和を目指します。革新的な技術で世の中を動かす。革新的な技術で世の中を動かす。</p>
      </article>
		</section>
    
		<section class="content">
			<h3 class="heading">会社概要</h3>
      <article>
				<table class="table">
				<tr>
					<th>会社名</th>
					<td>ホームページサンプル株式会社（英語表記 Homepage sample Inc.）</td>
				</tr>
				<tr>
					<th>設立</th>
					<td>平成10年1月10日</td>
				</tr>
				<tr>
					<th>事業内容</th>
					<td>IT・マーケティング・福祉など</td>
				</tr>
				<tr>
					<th>住所</th>
					<td>〒012-3456 見本県見本市サンプル1-2</td>
				</tr>
				<tr>
					<th>電話番号</th>
					<td>0123-4567-89012</td>
				</tr>
				<tr>
					<th>メールアドレス</th>
					<td>info@example.com</td>
				</tr>
				</table>
    	</article>
		</section>
    
    <section class="content" id="gallery">
			<h3 class="heading">写真ギャラリー</h3>
				<article>
					<figure class="grid"><a href="subpage.html"><img src="images/gallery1.jpg" width="190" height="140" alt=""></a></figure>
					<figure class="grid"><a href="subpage.html"><img src="images/gallery2.jpg" width="190" height="140" alt=""></a></figure>
					<figure class="grid"><a href="subpage.html"><img src="images/gallery3.jpg" width="190" height="140" alt=""></a></figure>
					<figure class="grid"><a href="subpage.html"><img src="images/gallery4.jpg" width="190" height="140" alt=""></a></figure>
					<figure class="grid"><a href="subpage.html"><img src="images/gallery5.jpg" width="190" height="140" alt=""></a></figure>
					<figure class="grid"><a href="subpage.html"><img src="images/gallery6.jpg" width="190" height="140" alt=""></a></figure>
				</article>
		</section>
    
	</section>
	<!-- / コンテンツ -->

	<aside id="sidebar">
       
		<h3 class="heading">革新的な技術</h3>
    <article>
			<ul>
				<li><a href="subpage.html">環境への取り組みについての説明ページです</a></li>
				<li><a href="subpage.html">ecoキャンペーン開催中です</a></li>
				<li><a href="subpage.html">オフィスの移転に関して</a></li>
				<li><a href="subpage.html">最新商品のご紹介</a></li>
				<li><a href="subpage.html">新規サービスを開始しました</a></li>
				<li><a href="subpage.html">環境賞受賞に関してはこちらをご確認ください</a></li>
			</ul>
    </article>
    
		<h3 class="heading">ホームページサンプル</h3>
    <article>
			<ul>
				<li><a href="subpage.html">環境への取り組みについての説明ページです</a></li>
				<li><a href="subpage.html">ecoキャンペーン開催中です</a></li>
				<li><a href="subpage.html">オフィスの移転に関して</a></li>
				<li><a href="subpage.html">最新商品のご紹介</a></li>
				<li><a href="subpage.html">新規サービスを開始しました</a></li>
				<li><a href="subpage.html">環境賞受賞に関してはこちらをご確認ください</a></li>
			</ul>
     </article>
    
		<h3 class="heading">ホームページサンプル</h3>
		<article>
			<ul class="list">
				<li><a href="subpage.html"><img src="images/thumb1.jpg" width="42" height="42" alt=""></a>サンプル株式会社では最新技術と自然との調和を目指します。</li>
				<li><a href="subpage.html"><img src="images/thumb2.jpg" width="42" height="42" alt=""></a>サンプル株式会社では最新技術と自然との調和を目指します。</li>
				<li><a href="subpage.html"><img src="images/thumb3.jpg" width="42" height="42" alt=""></a>サンプル株式会社では最新技術と自然との調和を目指します。</li>
      </ul> 
		</article>
    
	</aside>
 
</div>
 
<!-- フッター -->
<footer id="footer">
	<div class="inner">
  	<!-- 左側 -->
		<div id="info" class="grid">
			<!-- ロゴ -->
			<div class="logo">
				<a href="index.html"><img src="images/logo.png" width="45" height="45" alt="Sample site"><p>Company Name<br><span>Your Company Slogan</span></p></a>
			</div>
			<!-- / ロゴ -->
			<!-- 電話番号+受付時間 -->
			<div class="info">
				<p class="tel"><span>電話:</span> 012-3456-7890</p>
				<p class="open">受付時間: 平日 AM 10:00 〜 PM 5:00</p>
			</div>
			<!-- / 電話番号+受付時間 -->
		</div>  
		<!-- / 左側 -->
		<!-- 右側 ナビゲーション -->
		<ul class="footnav">
			<li><a href="subpage.html">eco・環境事業</a></li>
			<li><a href="subpage.html">コンピュータ事業</a></li>
			<li><a href="subpage.html">飲食店事業</a></li>
			<li><a href="subpage.html">介護・医療事業</a></li>
			<li><a href="subpage.html">ごあいさつ</a></li>
			<li><a href="subpage.html">サービス概要</a></li>
			<li><a href="subpage.html">会社情報</a></li>
			<li><a href="subpage.html">お問い合わせ</a></li>
			<li><a href="subpage.html">サイトマップ</a></li>
		</ul>
		<!-- / 右側 ナビゲーション -->
	</div>
</footer>
<!-- / フッター -->
<address>Copyright(c) 2013 Sample Inc. All Rights Reserved. Design by <a href="http://f-tpl.com" target="_blank" rel="nofollow">http://f-tpl.com</a></address>

</body>
</html>