create table user
(
  id int auto_increment
    primary key,
  login varchar(20) not null,
  password char(60) not null,
  name varchar(200) null,
  birthday date null,
  description varchar(200) null,
  photo varchar(200) null,
  constraint user_login_uindex
  unique (login)
)
;

create index user_login_index
  on user (login)
;