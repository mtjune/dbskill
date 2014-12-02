<html>
<head><title>たべもの検索</title>
<link rel="stylesheet" type="text/css" href="style.css"></head> 
<body>
<h1>たべもの検索</h1>
<table border="1">
<tr><th>たべもの</th><th>値段</th><th>飯屋</th></tr>
<?php
$host = "localhost";
if(!$conn = mysql_connect($host, "s1413137", "s1413137hoge")){
        die("MySQL接続エラー.<br />");
}
mysql_select_db("s1413137", $conn);
mysql_set_charset("utf8");

$item_name = $_POST['item_name'];

$sql = "select items.name as item_name, offers.price as price, meshiyas.name as meshiya_name from meshiyas, offers, items where mehiyas.name = offers.meshiya_name and offers.item_id = items.id and items.name like \"%".$item_name."%\";";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_array($res)){
        print("<tr>");
        print("<td>".$row["item_name"]."</td>");
        print("<td>".$row["price"]."</td>");
        print("<td>".$row["meshiya_name"]."</td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>
<?php 
	print($sql);
 ?>

</body>
</html>