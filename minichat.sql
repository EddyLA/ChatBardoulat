CREATE TABLE `minichat` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pseudo` char(30) NOT NULL,
  `message` text NOT NULL,
  `time` bigint(14) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `minichat` (`id`, `pseudo`, `message`, `time`) VALUES 
(1, 'Dex', 'Bonjour à tous, ceci est mon premier minichat.\r\nVous en pensez quoi ?', 1225684595);
