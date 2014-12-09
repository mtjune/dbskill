<html>
<head><title>全テーブル</title>
<link rel="stylesheet" type="text/css" href="style.css"></head> 
<body>
<h1>全テーブル</h1>
<h2>写真テーブル</h2>
<table border="1">
<tr><th>ID</th><th>タイトル</th><th>ファイル名</th><th>備考</th><th>ユーザID</th><th>投稿日</th><th>写真</th></tr>
<?php
$host = "localhost";
if(!$conn = mysql_connect($host, "s1413137", "s1413137hoge")){
        die("MySQL接続エラー.<br />");
}
mysql_select_db("s1413137", $conn);
mysql_set_charset("utf8");
$sql = "select * from pics";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_array($res)){
        print("<tr>");
        print("<td>".$row["id"]."</td>");
        print("<td>".$row["title"]."</td>");
        print("<td>".$row["file_name"]."</td>");
        print("<td>".$row["remarks"]."</td>");
        print("<td>".$row["user_id"]."</td>");
        print("<td>".$row["post_date"]."</td>");
        print("<td><a href='show_picture.php?pic_id=" .$row['id'] ."'><img src='" . $row["file_name"] . "' alt='写真' width='193'></a></td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>

</body>
</html>