use shahk5;

select * from geo;
select * from flickr;
select * from videos;
select * from reviews;

CREATE TABLE `geo` (
  `search_id` int(11) NOT NULL AUTO_INCREMENT,
  `latitude` Decimal(20,15) DEFAULT NULL,
  `longitude` Decimal(20,15) DEFAULT NULL,
  PRIMARY KEY (`search_id`)
) ENGINE=InnoDB ;

CREATE TABLE `flickr` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` bigint(20) DEFAULT NULL,
  `owner` varchar(256) DEFAULT NULL,
  `secret` varchar(256) DEFAULT NULL,
  `server` int(11) DEFAULT NULL,
  `farm` int(11) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `filename` varchar(256) DEFAULT NULL,
  `search_id` int(11) ,
  PRIMARY KEY (`photo_id`),
  CONSTRAINT `search_id` FOREIGN KEY (`search_id`) REFERENCES `geo` (`search_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

CREATE TABLE `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video` varchar(256) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `searchid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `searchid` (`searchid`),
  CONSTRAINT `searchid` FOREIGN KEY (`searchid`) REFERENCES `geo` (`search_id`)
) ENGINE=InnoDB AUTO_INCREMENT=623 DEFAULT CHARSET=latin1;

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bus_name` varchar(50) DEFAULT NULL,
  `rating` int(2) DEFAULT NULL,
  `text` varchar(500) DEFAULT NULL,
  `gsearchid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gsearchid` (`gsearchid`),
  CONSTRAINT `gsearchid` FOREIGN KEY (`gsearchid`) REFERENCES `geo` (`search_id`)
) ENGINE=InnoDB AUTO_INCREMENT=623 DEFAULT CHARSET=latin1;


