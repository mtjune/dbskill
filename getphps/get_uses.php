<html>
<head><title>使用テーブル</title>
<link rel="stylesheet" type="text/css" href="style.css"></head> 
<body>
<table border="1">
<tr><th>商品ID</th><th>原材料名</th></tr>
<?php
$host = "localhost";
if(!$conn = mysql_connect($host, "s1413137", "s1413137hoge")){
        die("MySQL接続エラー.<br />");
}
mysql_select_db("s1413137", $conn);
mysql_set_charset("utf8");
$sql = "select * from uses";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_array($res)){
        print("<tr>");
        print("<td>".$row["item_id"]."</td>");
        print("<td>".$row["material_name"]."</td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>
</body>
</html>