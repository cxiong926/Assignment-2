CREATE TABLE bookinfo (
id int not null primary key auto_increment,
inserttime datetime,
booktitle varchar(255),
isbn varchar(255),
author varchar(255),
status varchar(255)
);

INSERT INTO bookinfo VALUES (0,now(),'JSSBS','5150','Steve Suehring','A');
INSERT INTO bookinfo VALUES (0,now(),'Nineteen Eighty-Four','9780451524935','George Orwell','A');
INSERT INTO bookinfo VALUES (0,now(),'Animal Farm','9780451542935','George Orwell','A');
INSERT INTO bookinfo VALUES (0,now(),'Burmese Days','9780451524535','George Orwell','A');
INSERT INTO bookinfo VALUES (0,now(),'A Clergymans Daughter','9723451524935','George Orwell','A');
INSERT INTO bookinfo VALUES (0,now(),'Coming Up For Air','9780451514935','George Orwell','A');

CREATE TABLE album (
id int not null primary key auto_increment,
inserttime datetime,
albumtitle varchar(255),
albumartist varchar(255),
albumlength int,
status varchar(255)
);

INSERT INTO album VALUES (0, now(), 'Fair Warning', 'Van Halen', '1871', 'A');
INSERT INTO album VALUES (0, now(), 'Ten', 'Pearl Jam', '3200', 'A');
INSERT INTO album VALUES (0, now(), 'Animal Tracks', 'The Animals (US)', '1893', 'A');
INSERT INTO album VALUES (0, now(), 'Appetite for Destruction', 'Guns n Roses', '3231', 'A');
INSERT INTO album VALUES (0, now(), 'Plastic Beach', 'Gorillaz', '3406', 'A');
INSERT INTO album VALUES (0, now(), 'Discovery', 'Daft Punk', '3654', 'A');
INSERT INTO album VALUES (0, now(), 'Peace is the Mission', 'Major Lazer', '1922', 'A');
INSERT INTO album VALUES (0, now(), 'Demon Days', 'Gorillaz', '3043', 'A');
INSERT INTO album VALUES (0, now(), 'Pearl', 'Janis Joplin', '2050', 'A');
INSERT INTO album VALUES (0, now(), 'Human After All', 'Daft Punk', '2738', 'A');

SELECT * FROM survey;



DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS role;
DROP TABLE IF EXISTS user2role;

CREATE TABLE userAccounts (
id int not null primary key auto_increment,
username varchar(255),
userpass varchar(255),
email varchar(255),
creationdate datetime,
realname varchar(255),
userstatus varchar(255)
);

CREATE TABLE role (
id int not null primary key auto_increment,
rolename varchar(255)
);

CREATE TABLE user2role (
id int not null primary key auto_increment,
userid int,
roleid int
);

INSERT INTO user (username,userpass,email,creationdate,realname,userstatus) VALUES ('test@example.com','$2y$10$HLfwFMf/L7FlT6tbeDZeteKhJRiri6nvlDfnjRYcA8XrkAYhF6Il2','test@example.com',now(),'Testy McTesterson','A');
INSERT INTO role (rolename) VALUES ('admin');
INSERT INTO role (rolename) VALUES ('user');
INSERT INTO user2role (userid,roleid) VALUES (1,1);
INSERT INTO user2role (userid,roleid) VALUES (1,2);

DROP TABLE album;

CREATE TABLE album (
id int not null primary key auto_increment,
inserttime datetime,
albumtitle varchar(255),
albumartist varchar(255),
albumlength int,
buylink varchar(255),
status varchar(255)
);

INSERT INTO album VALUES (0, now(), 'Fair Warning', 'Van Halen', '1871', 'https://www.amazon.com/Fair-Warning-Remastered-Van-Halen/dp/B00YJKGU92/ref=ntt_mus_dp_dpt_13', 'A');
INSERT INTO album VALUES (0, now(), 'Ten', 'Pearl Jam', '3200', 'https://www.amazon.com/Ten-Pearl-Jam/dp/B0000027RL/ref=tmm_acd_swatch_0?_encoding=UTF8&qid=&sr=', 'A');
INSERT INTO album VALUES (0, now(), 'Animal Tracks', 'The Animals (US)', '1893', 'https://www.amazon.com/Animal-Tracks-Animals/dp/B00000I5TJ/ref=tmm_acd_swatch_0?_encoding=UTF8&qid=&sr=', 'A');
INSERT INTO album VALUES (0, now(), 'Appetite for Destruction', 'Guns n Roses', '3231', 'https://www.amazon.com/Appetite-Destruction-Guns-N-Roses/dp/B000000OQF/ref=ntt_mus_dp_dpp_6', 'A');

INSERT INTO album VALUES (0, now(), 'Plastic Beach', 'Gorillaz', '3406', 'https://www.amazon.com/Plastic-Beach-Gorillaz/dp/B0035G9ABQ', 'A');
INSERT INTO album VALUES (0, now(), 'Discovery', 'Daft Punk', '3654', 'https://www.amazon.com/Discovery-Daft-Punk/dp/B000059MEK', 'A');
INSERT INTO album VALUES (0, now(), 'Peace is the Mission', 'Major Lazer', '1922', 'https://www.amazon.com/Peace-Mission-Major-Lazer/dp/B00V4RH5A6', 'A');

INSERT INTO album VALUES (0, now(), 'Demon Days', 'Gorillaz', '3043', 'https://www.amazon.com/Demon-Days-Gorillaz/dp/B00082IJ08', 'A');
INSERT INTO album VALUES (0, now(), 'Pearl', 'Janis Joplin', '2050', 'https://www.amazon.com/Pearl-Janis-Joplin/dp/B00000K2VZ', 'A');
INSERT INTO album VALUES (0, now(), 'Human After All', 'Daft Punk', '2738', 'https://www.amazon.com/Human-After-All-Daft-Punk/dp/B0007DAZW8/ref=tmm_acd_swatch_0?_encoding=UTF8&qid=&sr=', 'A');

SELECT * FROM userAccounts;

DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS role;
DROP TABLE IF EXISTS userAccounts;


CREATE TABLE userAccounts (
email varchar(255),
pass varchar(255),
realname varchar(255),
address varchar(255),
zipcode varchar(255),
city varchar(255),
state varchar(255),
submittime datetime
);

CREATE TABLE role (
id int not null primary key auto_increment,
rolename varchar(255)
);

CREATE TABLE userAccounts (
id int not null primary key auto_increment,
userid int,roleid int
);

INSERT INTO user (username,userpass,email,creationdate,realname,userstatus) 
VALUES ('Testy@example.com','$2y$10$qcIK3IAzOtCXVWpl.w80KOdVN7XTG1L/RD2uuiaJicF56J7ggUgwC','Testy@example.com',now(),'Testy McTesterson','A');

INSERT INTO role (rolename) VALUES ('admin');
INSERT INTO role (rolename) VALUES ('user');
INSERT INTO user2role (userid,roleid) VALUES (1,1);
INSERT INTO user2role (userid,roleid) VALUES (1,2);

INSERT INTO user (username,userpass,email,creationdate,realname,userstatus) 
VALUES ('Dade@example.com','$2y$10$sAOQMweTESGMvwCilNg2heP4voJTPJkXdFm5.tQGNyrlhPkriDOqm','Dade@example.com',now(),'Dade Murphy','A');

INSERT INTO user (username,userpass,email,creationdate,realname,userstatus) 
VALUES ('David@example.com','$2y$10$pt7UmyfbrkFJgRnH24IV6.RvB.RXCHv/CaqXLZ80QbxODC0rQ1Cni','David@example.com',now(),'David Lightman','A');

INSERT INTO user (username,userpass,email,creationdate,realname,userstatus) 
VALUES ('Martin@example.com','$2y$10$lotxeK6ozKWuc29Gu4Wd0OhK6dVC25/yAUGY6MIMbafWCH2HSjMr2 ','Martin@example.com',now(),'Martin Bishop','A');

SELECT * FROM user;
SELECT * FROM user2role;

INSERT INTO user2role (userid,roleid) VALUES (2,2);
INSERT INTO user2role (userid,roleid) VALUES (3,1);

