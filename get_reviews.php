<html>
<head><title>レビューテーブル</title></head> 
<body>
<table border="1">
<tr><th>飯屋名</th><th>ユーザID</th><th>評価値</th><th>コメント</th></tr>
<?php
$host = "localhost";
if(!$conn = mysql_connect($host, "s1413137", "s1413137hoge")){
        die("MySQL接続エラー.<br />");
}
mysql_select_db("s1413137", $conn);
mysql_set_charset("utf8");
$sql = "select * from reviews";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_array($res)){
        print("<tr>");
        print("<td>".$row["meshiya_name"]."</td>");
        print("<td>".$row["user_id"]."</td>");
        print("<td>".$row["value"]."</td>");
        print("<td>".$row["comment"]."</td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>
</body>
</html>