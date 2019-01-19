CREATE TABLE IF NOT EXISTS `#__callcenter` (
  `id` integer(10) UNSIGNED NOT NULL auto_increment,
  `nombre` varchar(100) NOT NULL default '',
  `apellidos` varchar(100) NOT NULL default '',
  `telefono` varchar(10) NOT NULL default '',
  `observaciones` varchar(250) NOT NULL default '',
  `estado` varchar(10) NOT NULL default 'SinEnviar',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `intentos` int(10) unsigned NOT NULL default '0',
 
  PRIMARY KEY  (`id`),
  KEY `idx_created` (`created`)

)  DEFAULT CHARSET=utf8;

