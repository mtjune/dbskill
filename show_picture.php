<?php
$host = "localhost";
if(!$conn = mysql_connect($host, "s1413137", "s1413137hoge")){
        die("MySQL接続エラー.<br />");
}
mysql_select_db("s1413137", $conn);
mysql_set_charset("utf8");

$pic_id = $_GET['pic_id'];
$sql = "select users.name as user_name, pics.title as title, pics.file_name as file_name, pics.remarks as remarks, pics.post_date as post_date from pics, users where pics.user_id = users.id and pics.id = '$pic_id';";

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
        print("<li><a href='search.php?search_mode=tag&word=$tag'>$tag</a></li>");
}
mysql_free_result($res);

?>
        </ul>
    </article>

    <h3 class="heading">タグを付ける</h3>
    <article>
            <form action="search.php" method="post">
            <?php print("<input type='hidden' name='pic_id' value='$pic_id' />"); ?>
            <select name="tag_name">
                    <option value="new_tag">新しいタグを付ける</option>

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