create table user(
    id int(11) AUTO_INCREMENT,
    username varchar(200),
    password varchar(200),
    password_confirm varchar(50),
    image text,
    date date,
    address text,
    phone int(11),
    created_at timestamp,
    updated_at timestamp,
    primary key(id)
);