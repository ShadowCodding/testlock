

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(24) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permission` varchar(2) NOT NULL DEFAULT '0',
  `sc_count` varchar(20) NOT NULL DEFAULT '0',
  `lc_count` varchar(20) NOT NULL DEFAULT '0',
  `active` varchar(20) NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;



CREATE TABLE `announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `data` longtext DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `writer` varchar(255) DEFAULT NULL,
  `public` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `licenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `script` varchar(100) NOT NULL,
  `ip` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `variables` varchar(255) NOT NULL,
  `owner` varchar(200) NOT NULL,
  `deadline` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;


CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `data` longtext DEFAULT NULL,
  `isread` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `owner` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;


CREATE TABLE `scripts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `script` varchar(100) NOT NULL,
  `webhook` longtext NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'user',
  `variables` varchar(200) NOT NULL DEFAULT 'user',
  `owner` varchar(200) NOT NULL DEFAULT 'test',
  `serverside` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

