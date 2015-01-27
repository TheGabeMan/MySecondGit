CREATE DATABASE nest;
GRANT ALL PRIVILEGES ON nest.* TO 'nest_admin'@'localhost' IDENTIFIED BY 'choose_a_db_password';
FLUSH PRIVILEGES;

USE nest;
CREATE TABLE `rawdata` (
`timestamp` timestamp NOT NULL,
`NestName` char(30),
`NestUpdated` timestamp NOT NULL,
`NestCurrentKelvin` numeric(7,3) NOT NULL,
`NestTargetKelvin` numeric(7,3) NOT NULL,
`NestHumidity` tinyint unsigned NOT NULL,
`NestHeating` tinyint unsigned NOT NULL,
`NestPostal_code` char(10) NOT NULL,
`NestCountry` char(200) NOT NULL,
`NestAway` tinyint unsigned NOT NULL,
`WeatherMain` char(30),
`WeatherDescription` char(100),
`WeatherTempKelvin` numeric(7,3) NOT NULL,
`WeatherHumidity` numeric(7,3) NOT NULL,
`WeatherTempMinKelvin` numeric(7,3) NOT NULL,
`WeatherTempMaxKelvin` numeric(7,3) NOT NULL,
`WeatherPressure` numeric(7,3) NOT NULL,
`WeatherWindspeed` numeric(7,3) NOT NULL,
`WeatherWinddeg` numeric(7,3) NOT NULL,
`WeatherCityName` char(30),
  PRIMARY KEY (`timestamp`),	      
  UNIQUE KEY `timestamp` (`timestamp`)
)ENGINE=MyISAM DEFAULT CHARSET=latin1;

