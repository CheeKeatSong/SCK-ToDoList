CREATE TABLE IF NOT EXISTS `todotable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `todotable` (`id`, `task`, `status`) VALUES
(1, 'Clean your room', true),
(2, 'Code More', false);