DROP TABLE IF EXISTS `peq_admin`;

CREATE TABLE `peq_admin` (
  `id` int(11) AUTO_INCREMENT PRIMARY KEY,
  `login` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `administrator` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO peq_admin VALUES(1, 'admin', md5('password'), 1);
