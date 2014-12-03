<html>
<head><title>たべもの表示</title>
<link rel="stylesheet" type="text/css" href="style.css"></head> 
<body>

<?php
$host = "localhost";
if(!$conn = mysql_connect($host, "s1413137", "s1413137hoge")){
        die("MySQL接続エラー.<br />");
}
mysql_select_db("s1413137", $conn);
mysql_set_charset("utf8");

$item_id = $_GET['item_id'];

$sql = "select items.name as item_name, offers.price as price, meshiyas.name as meshiya_name from meshiyas, offers, items where meshiyas.name = offers.meshiya_name and offers.item_id = items.id and items.id = \"".$item_id."\";";
$res = mysql_query($sql, $conn);

$data = $res[0];

print("<h1>".$data["item_name"]."</h1>\n");
print("<h2>".$data["meshiya_name"]."</h2>\n");
print("<h3>値段 : ".$data["price"]."</h3>\n");

mysql_free_result($res);
?>
<?php 
	print($sql);
 ?>

</body>
</html>