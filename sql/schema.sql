DROP TABLE IF EXISTS `peq_admin`;

CREATE TABLE peq_admin (
id INT(11) auto_increment primary key,
login varchar(30) NOT NULL,
password varchar(255) NOT NULL,
administrator INT(11) NOT NULL DEFAULT '0'
);
INSERT INTO peq_admin VALUES(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 1);