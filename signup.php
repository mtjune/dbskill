<html>
<head><title>Phorm</title>
<link rel="stylesheet" type="text/css" href="style.css"></head> 
<body>
<h1>ユーザ登録</h1>
<h2>写真テーブル</h2>
<table border="1">
<tr><th>ID</th><th>タイトル</th><th>ファイル名</th><th>備考</th><th>ユーザID</th><th>投稿日</th></tr>
<?php
$host = "localhost";
if(!$conn = mysql_connect($host, "s1413137", "s1413137hoge")){
        die("MySQL接続エラー.<br />");
}
mysql_select_db("s1413137", $conn);
mysql_set_charset("utf8");

$user_name = $_POST["user_name"];
$user_pass = $_POST["user_pass"];


// $sql = "select * from users where user_name = ".$user_name.";";
$sql = "insert into users(name, pass) value('$user_name', '$user_pass');"
mysql_query($sql, $conn) or die("登録できませんでした");
print("登録完了");

mysql_free_result($res);
?>
</table>



</body>
</html>