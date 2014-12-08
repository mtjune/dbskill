<html>
<head><title>全テーブル</title>
<link rel="stylesheet" type="text/css" href="style.css"></head> 
<body>
<h1>全テーブル</h1>
<h2>写真テーブル</h2>
<table border="1">
<tr><th>ID</th><th>タイトル</th><th>ファイル名</th><th>備考</th><th>ユーザID</th><th>投稿日</th></tr>
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
        print("<td>".$row["date"]."</td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>

<h2>ユーザテーブル</h2>
<table border="1">
<tr><th>ID</th><th>ユーザ名</th><th>パスワード</th></tr>
<?php

$sql = "select * from users";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_array($res)){
        print("<tr>");
        print("<td>".$row["id"]."</td>");
        print("<td>".$row["name"]."</td>");
        print("<td>".$row["pass"]."</td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>

<h2>タグテーブル</h2>
<table border="1">
<tr><th>タグ名</th></tr>
<?php

$sql = "select * from tags";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_array($res)){
        print("<tr>");
        print("<td>".$row["name"]."</td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>

<h2>評価テーブル</h2>
<table border="1">
<tr><th>写真ID</th><th>ユーザID</th><th>評価値</th></tr>
<?php

$sql = "select * from evaluations";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_array($res)){
        print("<tr>");
        print("<td>".$row["pic_id"]."</td>");
        print("<td>".$row["user_id"]."</td>");
        print("<td>".$row["value"]."</td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>

<h2>付与テーブル</h2>
<table border="1">
<tr><th>飯屋名</th><th>ユーザID</th><th>評価値</th><th>コメント</th></tr>
<?php

$sql = "select * from additiions";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_array($res)){
        print("<tr>");
        print("<td>".$row["tag_name"]."</td>");
        print("<td>".$row["pic_id"]."</td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>

<h2>ブックマークテーブル</h2>
<table border="1">
<tr><th>原材料名</tr>
<?php

$sql = "select * from bookmarks";
$res = mysql_query($sql, $conn);
while($row = mysql_fetch_array($res)){
        print("<tr>");
        print("<td>".$row["user_id"]."</td>");
        print("<td>".$row["tag_name"]."</td>");
        print("</tr>\n");
}
mysql_free_result($res);
?>
</table>


</body>
</html>