CREATE DATABASE nest;
GRANT ALL PRIVILEGES ON nest.* TO 'nest_admin'@'localhost' IDENTIFIED BY 'choose_a_db_password';
FLUSH PRIVILEGES;

USE nest;
CREATE TABLE `rawdata` (
`timestamp` timestamp NOT NULL,
`name` char(30),
`updated` timestamp NOT NULL,
`current` numeric(7,3) NOT NULL,
`target` numeric(7,3) NOT NULL,
`humidity` tinyint unsigned NOT NULL,
`heating` tinyint unsigned NOT NULL,
`postal_code` char(10) NOT NULL,
`country` char(200) NOT NULL,
`away` tinyint unsigned NOT NULL,

`w_main` char(30),
`w_description` char(100),
`w_temp` numeric(7,3) NOT NULL,
`w_humidity` numeric(7,3) NOT NULL,
`w_tempmin` numeric(7,3) NOT NULL,
`w_tempmax` numeric(7,3) NOT NULL,
`w_pressure` numeric(7,3) NOT NULL,
`w_windspeed` numeric(7,3) NOT NULL,
`w_winddeg` numeric(7,3) NOT NULL,
`w_name` char(30),
  PRIMARY KEY (`timestamp`),	      
  UNIQUE KEY `timestamp` (`timestamp`)
)ENGINE=MyISAM DEFAULT CHARSET=latin1;

