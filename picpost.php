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
	// 各値を受け取り
	$login_user_id = $_SESSION['user_id'];
	$pic_title = $_POST['pic_title'];
	$pic_remarks = $_POST['pic_remarks'];

	// 次のIDを受け取り
	$sql = "show table status like 'pics'";
	$res = mysql_query($sql, $conn);
	$row = mysql_fetch_object($res);
	$next_id = $row->Auto_increment;
	mysql_free_result($res);

	// 状態チェック用のフラッグ
	$flag1 = false;
	$flag2 = false;
	$flag3 = false;

	if (is_uploaded_file($_FILES["file_up"]["tmp_name"])) {
		// ファイルは選択されている
		$flag1 = true;

		// ファイルの拡張子取得
		list($file_name, $file_type) = explode(".", $_FILES["file_up"]["name"]);
		// 新しいファイルの名前
		$file_name_new = "pictures/" . $next_id . "." . $file_type;

 		if (move_uploaded_file($_FILES["file_up"]["tmp_name"], $file_name_new )) {
 			// ファイルはアップロードされている
 			$flag2 = true;
			chmod($file_name_new, 0644);

			$sql = "insert into pics(title, file_name, remarks, user_id) value('$pic_title', '$file_name_new', '$pic_remarks', '$login_user_id');";
			$flag3 = mysql_query($sql, $conn);
		}
	}
}



?>

<!DOCTYPE html>
<html dir="ltr" lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=yes, maximum-scale=1.0, minimum-scale=1.0">
<title>写真投稿 - Phorm</title>
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
            <li class="active"><a href="index.php"><strong>トップページ</strong><span>Top</span></a></li>
                <li><a href="subpage.html"><strong>ブックマーク新着</strong><span>Bookmark</span></a></li>
                <li><a href="userpage.php"><strong>ユーザーページ</strong><span>User Page</span></a></li>
                <li><a href="picpost_form.html"><strong>写真投稿</strong><span>Photo Post</span></a></li>
                <li><a href="signup_form.html"><strong>ユーザ登録</strong><span>Sign Up</span></a></li>
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

<?php

if($flag3) {
	print("<h3 class='heading'>写真アップロード</h3>");
	print("<article>");
	print("「".$pic_title."」をアップロードしました");
	print("<img src='$pic_filename_new' width='600' alt='$pic_title' class='alignright border' />");
	print("</article>");
} else if($flag2) {
	print("<h3 class='heading'>写真アップロード失敗</h3>");
	print("<article>");
	print("データを登録出来ませんでした。");
	print("</article>");
} else {
	print("<h3 class='heading'>写真アップロード失敗</h3>");
	print("<article>");
	print("ファイルをアップロード出来ませんでした。");
	print("</article>");
}

?>
</section>
    </section>
        <!-- / コンテンツ -->

        <aside id="sidebar">
        
        </aside>
 
</div>
 
<address>Copyright(c) 2013 Sample Inc. All Rights Reserved. Design by <a href="http://f-tpl.com" target="_blank" rel="nofollow">http://f-tpl.com</a></address>

</body>
</html>