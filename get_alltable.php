<html>
<head><title>全テーブル</title>
<link rel="stylesheet" type="text/css" href="style.css"></head> 
<body>
<h1>全テーブル</h1>
<h2>飯屋テーブル</h2>
<table border="1">
<tr><th>店名</th><th>住所</th><th>カテゴリ</th><th>営業時間</th><th>定休日</th></tr>
<?php
$host = "localhost";
if(!$conn = mysql_connect($host, "s1413137", "s1413137hoge")){
        die("MySQL接続エラー.<br />");
}
mysql_select_db("s1413137", $conn);
mysql_set_charset("utf8");
$sql = "select * from meshiyas";
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

<h2>商品テーブル</h2>
<table border="1">
<tr><th>商品ID</th><th>商品名</th><th>写真</th><th>備考</th></tr>
<?php

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

<h2>ユーザテーブル</h2>
<table border="1">
<tr><th>ユーザID</th><th>ユーザ名</th><th>パスワード</th></tr>
<?php

$sql = "select * from users";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_array($res)){
        print("<tr>");
        print("<td>".$row["id"]."</td>");
        print("<td>".$row["name"]."</td>");
        print("<td>".$row["password"]."</td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>

<h2>提供テーブル</h2>
<table border="1">
<tr><th>飯屋名</th><th>商品ID</th><th>価格</th></tr>
<?php

$sql = "select * from offers";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_array($res)){
        print("<tr>");
        print("<td>".$row["meshiya_name"]."</td>");
        print("<td>".$row["item_id"]."</td>");
        print("<td>".$row["price"]."</td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>

<h2>レビューテーブル</h2>
<table border="1">
<tr><th>飯屋名</th><th>ユーザID</th><th>評価値</th><th>コメント</th></tr>
<?php

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

<h2>原材料テーブル</h2>
<table border="1">
<tr><th>原材料名</tr>
<?php

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

<h2>使用テーブル</h2>
<table border="1">
<tr><th>商品ID</th><th>原材料名</th></tr>
<?php

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