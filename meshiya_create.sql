create table meshiyas(
	name varchar(200) primary key,
	address varchar(200),
	category varchar(200),
	hours varchar(200),
	holiday varchar(200)
);
create table items(
	id int primary key auto_increment,
	name varchar(200),
	picture text,
	remarks text
);
create table users(
	id int primary key auto_increment,
	name varchar(20),
	password varchar(16)
);
create table offers(
	meshiya_name varchar(200),
	item_id int,
	price int unsigned,
	primary key(meshiya_name, item_name)
);
create table reviews(
	meshiya_name varchar(200),
	user_id int,
	value int,
	comment text,
	primary key(meshiya_name, user_id)
);
create table materials(
	name varchar(200) primary key
);
create table uses(
	item_name varchar(200),
	material_name varchar(200),
	primary key(item_name, material_name)
);
