create table meshiyas(
	name varchar(200) primary key,	// 名前
	address varchar(200),					// 住所
	category varchar(200),				// カテゴリ
	hours varchar(200),					// 営業時間
	holiday varchar(200)					// 定休日
);
create table items(
	name varchar(200) primary key,	// 名前
	materials text,							// 原材料
	allergy text,								// アレルギー表示
	picture text,								// 写真
	meshiya_name varchar(200),		// 飯屋の名前
);
create table users(
	id int primary key auto_increment,	// ユーザID
	name varchar(20),							// ユーザ名
	password varchar(16)						// パスワード
);
create table offers(
	meshiya_name varchar(200),	// 飯屋名
	item_name varchar(200),			// 商品名
	price int unsigned					// 価格
	primary key(meshiya_name, item_name)
);
create table reviews(
	meshiya_name varchar(200),	// 飯屋の名前
	user_id int,							// ユーザID
	value int,								// 評価値
	comment text,						// コメント
	primary key(meshiya_name, user_id)
);
create table materials(
	name varchar(200) primary key		// 原材料名
);
create table uses(
	item_name varchar(200),			// 商品名
	material_name varchar(200),	// 原材料名
	primary key(item_name, material_name)
);
