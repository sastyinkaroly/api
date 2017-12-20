/*Participants table*/

CREATE TABLE IF NOT EXISTS `participants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `profilImagePath` varchar(255) DEFAULT NULL,
  `movieTitle` varchar(100) DEFAULT NULL,
  `movieRole` enum('best actor','best supporting actor','best actress','best supporting actress') DEFAULT NULL,
  `movieBrief` text,
  `moviePlot` varchar(255) DEFAULT NULL,
  `quality` enum('nominated','winner') DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;