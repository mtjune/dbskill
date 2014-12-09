<html>
<head><title>Phorm</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head> 
<body>
<h1>ユーザ登録</h1>

<?php
// 定形
$host = "localhost";
if(!$conn = mysql_connect($host, "s1413137", "s1413137hoge")){
        die("MySQL接続エラー.<br />");
}
mysql_select_db("s1413137", $conn);
mysql_set_charset("utf8");
// 定形


// 各値を受け取り
$user_id = $_POST['user_id'];
$user_pass = $_POST['user_pass'];
$pic_title = $_POST['pic_title'];
$pic_remarks = $_POST['pic_remarks'];

// IDとパスワードが一致しているか調査
$sql = "select * from users where id = '$user_id'";
$res = mysql_query($sql, $conn);
$row = mysql_fetch_assoc($res);

if($row['pass'] == $user_pass){
	// 一致している時の処理

	if (is_uploaded_file($_FILES["file_up"]["tmp_name"])) {
 		if (move_uploaded_file($_FILES["file_up"]["tmp_name"], "pictures/" . $_FILES["file_up"]["name"])) {
			chmod("files/" . $_FILES["file_up"]["name"], 0644);
			echo $_FILES["file_up"]["name"] . "をアップロードしました。";
		} else {
			echo "ファイルをアップロードできません。";
		}
	} else {
		echo "ファイルが選択されていません。";
	}

	$file_name = $_FILES["upfile"]["name"];
	$sql = "insert into pics(title, file_name, remarks, user_id) value('$pic_title', '$file_name', '$pic_remarks', '$user_id')";
	mysql_query($sql, $conn) or die("登録できませんでした");
	print("登録完了");

} else {
	print("ユーザ認証エラーです。");
}
mysql_free_result($res);

?>


</body>
</html>