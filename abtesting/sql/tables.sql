SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

DROP TABLE IF EXISTS `abtester`;
CREATE TABLE IF NOT EXISTS `abtester` (
  `id` int(11) NOT NULL auto_increment,
  `code` int(11) NOT NULL,
  `addr` varchar(64) NOT NULL,
  `time` int(11) NOT NULL,
  `abtest_id` int(11) NOT NULL,
  `r` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `codeaddr` (`code`,`addr`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;

DROP TABLE IF EXISTS `abtest`;
CREATE TABLE IF NOT EXISTS `abtest` (
  `id` int(11) NOT NULL auto_increment,
  `image` varchar(64) character set latin1 NOT NULL,
  `url` varchar(64) collate utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0;

