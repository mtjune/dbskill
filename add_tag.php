<?php

$host = "localhost";
if(!$conn = mysql_connect($host, "s1413137", "s1413137hoge")){
        die("MySQL接続エラー.<br />");
}
mysql_select_db("s1413137", $conn);
mysql_set_charset("utf8");

$pic_id = $_POST['pic_id'];
$tag_name = $_POST['tag_name'];
$new_tag_name = $_POST['new_tag_name'];

$sql = "select title from pics where id = '$pic_id'";
$res = mysql_query($sql, $conn);
$row = mysql_fetch_assoc($res);

$pic_title = $row['title'];

mysql_free_result($res);

$flag1 = false;
$flag2 = false;

if($tag_post == "new_tag"){
    $sql = "insert into tags value('$new_tag_name');";

    $sql = "insert into additions value('$new_tag_name', $pic_id);";
    $flag1 = mysql_query($sql, $conn);

    $to_show_tag_name = $new_tag_name;
} else {
    $sql = "insert into additions value('$tag_name', $pic_id)"
    $flag2 = mysql_query($sql, $conn);
    $to_show_tag_name = $tag_name;
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
  <h1>写真投稿サイトです</h1>
  
  <!-- ロゴ -->
        <div class="logo">
                <a href="index.html"><img src="images/logo.png" width="45" height="45" alt="Sample site" /><p>Phorm<span>Photo Posted Site</span></p></a>
        </div>
        <!-- / ロゴ -->
        <!-- 電話番号+受付時間 -->
        <div class="info">
                <p class="tel"><span>作成者:</span> 山田純也</p>
                <p class="open">学籍番号: 201413137</p>
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
                                <li><a href="subpage.html"><strong>会社情報</strong><span>Company</span></a></li>
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
        <h3 class="heading">「<?php print($pic_title); ?>」へタグ「<?php print($to_show_tag_name); ?>」を追加</h3>
        <article>
<<?php 
if(flag1 || flag2){
    print("「".$to_show_tag_name."」タグを追加しました。<br>");
} else {
    print("「".$to_show_tag_name."」タグを追加出来ませんでした。<br>");
}

print("<br><br>");
print("<a href='show_picture.php&pic_id=$pic_id'>「$pic_title」へ戻る</a>");

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