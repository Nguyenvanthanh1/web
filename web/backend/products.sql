create table products(
    id int(11) AUTO_INCREMENT,
    name varchar(200),
    cate_id int(11),
    price int(20),
    image text,
    description text,
    primary key(id)
);