<html>
<head><title>商品テーブル</title>
<link rel="stylesheet" type="text/css" href="style.css"></head> 
<body>
<table border="1">
<tr><th>商品ID</th><th>商品名</th><th>写真</th><th>備考</th></tr>
<?php
$host = "localhost";
if(!$conn = mysql_connect($host, "s1413137", "s1413137hoge")){
        die("MySQL接続エラー.<br />");
}
mysql_select_db("s1413137", $conn);
mysql_set_charset("utf8");
$sql = "select * from items";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_array($res)){
        print("<tr>");
        print("<td>".$row["id"]."</td>");
        print("<td>".$row["name"]."</td>");
        print("<td>".$row["picture"]."</td>");
        print("<td>".$row["remarks"]."</td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>
</body>
</html>