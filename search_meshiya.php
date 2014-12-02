<html>
<head><title>飯屋検索</title>
<link rel="stylesheet" type="text/css" href="style.css"></head> 
<body>
<h1>飯屋検索</h1>
<table border="1">
<tr><th>店名</th><th>住所</th><th>カテゴリ</th><th>営業時間</th><th>定休日</th></tr>
<?php
$host = "localhost";
if(!$conn = mysql_connect($host, "s1413137", "s1413137hoge")){
        die("MySQL接続エラー.<br />");
}
mysql_select_db("s1413137", $conn);
mysql_set_charset("utf8");

$meshiya_name = $_POST['meshiya_name'];

$sql = "select * from meshiyas where meshiyas.name like %".$meshiya_name."%;";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_array($res)){
        print("<tr>");
        print("<td>".$row["name"]."</td>");
        print("<td>".$row["address"]."</td>");
        print("<td>".$row["category"]."</td>");
        print("<td>".$row["hours"]."</td>");
        print("<td>".$row["holiday"]."</td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>
<?php 
	print(.$meshiya_name.);
 ?>

</body>
</html>