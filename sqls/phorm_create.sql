create table pics(
	id int primary key auto_increment,
	title varchar(20),
	file_name text,
	remarks text,
	user_id varchar(20) references users(id),
	post_date date
);

create table users(
	id varchar(20) primary key,
	name varchar(20),
	pass varchar(100)
);

create table tags(
	name varchar(20) primary key
);

create table evaluations(
	pic_id int references pics(id),
	user_id varchar(20) references users(id),
	value int,
	primary key(pic_id, user_id),
	check(value >= 1 and value <= 5)
);

create table additions(
	tag_name varchar(20) references tags(name),
	pic_id int references pics(id),
	primary key(tag_name, pic_id)
);

create table bookmarks(
	user_id varchar(20) references users(id),
	tag_name varchar(20) references tans(name),
	primary key(user_id, tag_name)
);