<html>
<head><title>原材料テーブル</title></head> 
<body>
<table border="1">
<tr><th>原材料名</tr>
<?php
$host = "localhost";
if(!$conn = mysql_connect($host, "s1413137", "s1413137hoge")){
        die("MySQL接続エラー.<br />");
}
mysql_select_db("s1413137", $conn);
mysql_set_charset("utf8");
$sql = "select * from materials";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_array($res)){
        print("<tr>");
        print("<td>".$row["name"]."</td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>
</body>
</html>