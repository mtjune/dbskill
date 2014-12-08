create table pics(
	id int primary key auto_increment,
	title varchar(20),
	file_name text,
	remarks text,
	user_id int,
	post_date date
)

create table users(
	id int primary key auto_increment,
	name varchar(20),
	pass varchar(20)
)

create table tags(
	name varchar(20) primary key
)

create table evaluations(
	pic_id int,
	user_id int,
	value int,
	primary key(pic_id, user_id),
	check(value >= 1 and value <= 5)
)

create table additions(
	tag_name varchar(20),
	pic_id int,
	primary key(tag_name, pic_id)
)

create table bookmarks(
	user_id int,
	tag_name varchar(20),
	primary key(user_id, tag_name)
)