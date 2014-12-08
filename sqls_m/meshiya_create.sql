create table meshiyas(
	name varchar(20) primary key,
	address text,
	category varchar(20),
	hours text,
	holiday text
);
create table items(
	id int primary key auto_increment,
	name varchar(20),
	picture text,
	remarks text
);
create table users(
	id int primary key auto_increment,
	name varchar(20),
	password varchar(20)
);
create table offers(
	meshiya_name varchar(20),
	item_id int,
	price int unsigned,
	primary key(meshiya_name, item_id)
);
create table reviews(
	meshiya_name varchar(20),
	user_id int,
	value int,
	comment text,
	primary key(meshiya_name, user_id)
);
create table materials(
	name varchar(20) primary key
);
create table uses(
	item_id int,
	material_name varchar(20),
	primary key(item_id, material_name)
);
