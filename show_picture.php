<?php
$host = "localhost";
if(!$conn = mysql_connect($host, "s1413137", "s1413137hoge")){
        die("MySQL接続エラー.<br />");
}
mysql_select_db("s1413137", $conn);
mysql_set_charset("utf8");

$pic_id = $_GET['pic_id'];
$sql = "select * from pics where id = '$pic_id';";

$res = mysql_query($sql, $conn);
$row = mysql_fetch_assoc($res);

$pic_title = $row['title'];
$pic_filename = $row['file_name'];
$pic_user_id = $row['user_id'];
$pic_remarks = $row['remarks'];
$pic_post_date = $row['post_date'];

mysql_free_result($res);
?>



<html>
<head><title><?php print($pic_title) ?></title>
<link rel="stylesheet" type="text/css" href="style.css"></head> 
<body>
<h1><?php print($pic_title) ?></h1>

</body>
</html>