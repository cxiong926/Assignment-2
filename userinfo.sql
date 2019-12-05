CREATE TABLE userinfo (
email varchar(255),
pass varchar(255),
realname varchar(255),
address varchar(255),
zipcode varchar(255),
city varchar(255),
state varchar(255),
submittime datetime
);

SELECT * FROM userinfo;

DROP TABLE IF EXISTS userinfo;