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
    

  <br>
  <div>
        <br>
        <fieldset>
            <legend>操作説明</legend>
            検索を行う場合、ロゴマーク右の検索窓に検索する語句を入力して検索ボタンをクリックします。<br>
            検索モードは3つあり、それぞれ以下の様な特徴があります。
            <ol>
                <li>キーワード検索 : 入力した語句がタイトル、備考、タグに含まれている写真をみつける。</li>
                <li>タイトル検索 : キーワード検索の調べる範囲をタイトルだけに絞ってみつける。</li>
                <li>タグ検索 : 入力した語句(タグ)がつけられている写真をみつける。</li>
            </ol>
            また検索モード「キーワード検索」で検索窓に何も入力せずに「検索」ボタンを押すと、写真一覧が表示されます。
        </fieldset>
        <fieldset>
            <legend>
                ログインについて
            </legend>
            一部の機能はログインを行わないと利用できません。<br>
            本当はユーザ登録からしなければいけませんが、今回はすぐにそれらの機能を使用できるように、ユーザーID、パスワード共に空文字列のゲストユーザを用意しました。<br>
            ログインフォームに何も入力してない状態でログインボタンを押すと「ゲスト」でログインできるので面倒ならこれでログインしてください。
        </fieldset>
        <br>
        <a href="s1413137-f-Yamada-Junya.ppt">パワーポイントファイルへのリンク</a>
        <br>
        <br>
        <h1>-----スクリプトへのリンク-----</h1>
        下のリンクはスクリプトへのリンクですが、セッションやPOSTなど利用しているので、上のボタンなどからシステムを使用してください。<br>
        (「システムに必要なスクリプトファイルへのリンクを貼る」要件を満たすためのリンクです。)<br>
        こちらのリンクは使用しないでください。<br>
        <ul>
            <li>・<a href="index.php">index.php</a></li>
            <li>・<a href="login.php">login.php</a></li>
            <li>・<a href="logout.php">logout.php</a></li>
            <li>・<a href="userpage.php">userpage.php</a></li>
            <li>・<a href="signup_form.php">signup_form.php</a></li>
            <li>・<a href="signup.php">signup.php</a></li>
            <li>・<a href="search.php">search.php</a></li>
            <li>・<a href="show_picture.php">show_picture.php</a></li>
            <li>・<a href="tag_add.php">tag_add.php</a></li>
            <li>・<a href="tag_del.php">tag_del.php</a></li>
            <li>・<a href="picpost_form.php">picpost_form.php</a></li>
            <li>・<a href="picpost.php">picpost.php</a></li>
            <li>・<a href="bookmark.php">bookmark.php</a></li>
            <li>・<a href="bookmark_new.php">bookmark_new.php</a></li>
            <li>・<a href="bookmark_del.php">bookmark_del.php</a></li>
            <li>・<a href="evaluate.php">evaluate.php</a></li>
        </ul>
</div>
</div>
<!-- フッター -->
<footer id="footer">
    <div class="inner">
    <!-- 左側 -->
        <div id="info" class="grid">
            <!-- 電話番号+受付時間 -->
            <div class="info">
                <p class="tel"><span>作成者:</span> 山田純也</p>
                <p class="open">学籍番号: 201413137</p>
            </div>
            <!-- / 電話番号+受付時間 -->
        </div>  
        <!-- / 左側 -->
    </div>
</footer>
<!-- / フッター -->
<address>Copyright(c) 2013 Sample Inc. All Rights Reserved. Design by <a href="http://f-tpl.com" target="_blank" rel="nofollow">http://f-tpl.com</a></address>

</body>
</html>