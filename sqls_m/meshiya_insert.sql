insert into meshiyas values("龍郎", "吾妻", "ラーメン", "11:30～14:30, 17:30～22:00（材料切れ終了）", "月曜日");
insert into meshiyas values("バリ龍", "天久保2丁目", "ラーメン", "11:30~14:30, 17:30~22:00", "月曜日");

insert into items(name, picture, remarks) values("ラーメン", "pic1(保留)", "備考");
insert into items(name, picture, remarks) values("まぜそば", "pic2(保留)", "備考");
insert into items(name, picture, remarks) values("博多ラーメン", "pic3(保留)", "替え玉100円");

insert into users(name, password) values("やまじゅん", "yamayama");
insert into users(name, password) values("まつじゅん", "matsumatsu");

insert into offers values("龍郎", 1, 680);
insert into offers values("龍郎", 2, 750);
insert into offers values("バリ龍", 3, 500);

insert into reviews values("龍郎", 1, 5, "うまい！");
insert into reviews values("バリ龍", 2, 4, "良さ");

insert into materials values("小麦粉");
insert into materials values("豚肉");
insert into materials values("ネギ");

insert into uses values(1, "小麦粉");
insert into uses values(1, "豚肉");
insert into uses values(2, "小麦粉");
insert into uses values(2, "豚肉");
insert into uses values(3, "小麦粉");
insert into uses values(3, "豚肉");
insert into uses values(3, "ネギ");