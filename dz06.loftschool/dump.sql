create table orders
(
  id int auto_increment
    primary key,
  user_id int not null,
  street varchar(100) null,
  house varchar(10) null,
  fraction varchar(10) null,
  room varchar(10) null,
  floor int null,
  comment varchar(1000) null,
  payment int null,
  `call` int null
)
;

create index orders_users_id_fk
  on orders (user_id)
;

create table users
(
  id int auto_increment
    primary key,
  email varchar(100) not null,
  phone varchar(20) not null,
  name varchar(200) null,
  constraint users_email_uindex
  unique (email)
)
;

alter table orders
  add constraint orders_users_id_fk
foreign key (user_id) references users (id)
;

