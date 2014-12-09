<html>
<head><title>Phorm</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head> 
<body>
<h1>ユーザ登録</h1>

<?php
$host = "localhost";
if(!$conn = mysql_connect($host, "s1413137", "s1413137hoge")){
        die("MySQL接続エラー.<br />");
}
mysql_select_db("s1413137", $conn);
mysql_set_charset("utf8");

$user_id = $_POST['user_id'];
$user_name = $_POST['user_name'];
$user_pass = $_POST['user_pass'];


$sql = "insert into users(id, name, pass) value('$user_id', '$user_name', '$user_pass');";
mysql_query($sql, $conn) or die("登録できませんでした");
print("登録完了");

?>


</body>
</html>