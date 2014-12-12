<html>
<head>
<title>Phorm</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h1>写真投稿</h1>

<p>
<form action="picpost.php" method="post" enctype="multipart/form-data">
<table>
<tr>
	<td>ユーザID</td><td><input type="text" name="user_id"></td>
</tr>
<tr>
	<td>パスワード</td><td><input type="password" name="user_pass"></td>
</tr>
<tr>
	<td>ファイル</td><td><input type="file" name="file_up"></td>
</tr>
<tr>
	<td>タイトル</td><td><input type="text" name="pic_title"></td>
</tr>
<tr>
	<td>備考</td><td><input type="text" name="pic_remarks"></td>
</tr>
</table>
<input type="submit" value="投稿" />
</form>
</p>

</body>
</html>
