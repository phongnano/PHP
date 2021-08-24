create table users
(
    username    varchar(30)                        not null
        primary key,
    fullname    varchar(50) charset utf8           not null,
    gender      int                                not null,
    birthday    date                               null,
    nativeplace varchar(30) charset utf8           null,
    address     varchar(100) charset utf8          null,
    password    varchar(255)                       not null,
    role        int                                not null,
    created_at  datetime default CURRENT_TIMESTAMP null
);


