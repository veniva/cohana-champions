-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.12-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.3.0.4818
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table champions.matches
CREATE TABLE IF NOT EXISTS `matches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_team1` int(10) unsigned NOT NULL,
  `id_team2` int(10) unsigned NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00' COMMENT 'The day of the match',
  PRIMARY KEY (`id`),
  KEY `FK__teams_2` (`id_team2`),
  KEY `Index 2` (`id_team1`),
  CONSTRAINT `FK__teams` FOREIGN KEY (`id_team1`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__teams_2` FOREIGN KEY (`id_team2`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table champions.matches: ~3 rows (approximately)
/*!40000 ALTER TABLE `matches` DISABLE KEYS */;
INSERT INTO `matches` (`id`, `id_team1`, `id_team2`, `date`) VALUES
	(2, 1, 2, '2014-07-25'),
	(11, 1, 2, '2014-07-30');
/*!40000 ALTER TABLE `matches` ENABLE KEYS */;


-- Dumping structure for table champions.players
CREATE TABLE IF NOT EXISTS `players` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT 'Player''s first name',
  `family` varchar(50) NOT NULL COMMENT 'Player''s family name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Available football players';

-- Dumping data for table champions.players: ~4 rows (approximately)
/*!40000 ALTER TABLE `players` DISABLE KEYS */;
INSERT INTO `players` (`id`, `name`, `family`) VALUES
	(1, 'Player', 'One'),
	(2, 'Player', 'Two'),
	(3, 'Player', 'Three'),
	(4, 'Player', 'Four');
/*!40000 ALTER TABLE `players` ENABLE KEYS */;


-- Dumping structure for table champions.players_teams
CREATE TABLE IF NOT EXISTS `players_teams` (
  `id_player` int(10) unsigned NOT NULL COMMENT 'The player''s id',
  `id_team` int(10) unsigned NOT NULL COMMENT 'The id of the team',
  PRIMARY KEY (`id_player`,`id_team`),
  KEY `FK_players_teams_teams` (`id_team`,`id_player`),
  CONSTRAINT `FK_players_teams_players` FOREIGN KEY (`id_player`) REFERENCES `players` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_players_teams_teams` FOREIGN KEY (`id_team`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Joining players and teams';

-- Dumping data for table champions.players_teams: ~2 rows (approximately)
/*!40000 ALTER TABLE `players_teams` DISABLE KEYS */;
INSERT INTO `players_teams` (`id_player`, `id_team`) VALUES
	(1, 1),
	(3, 1),
	(4, 3);
/*!40000 ALTER TABLE `players_teams` ENABLE KEYS */;


-- Dumping structure for table champions.teams
CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'The team name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table champions.teams: ~3 rows (approximately)
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` (`id`, `name`) VALUES
	(1, 'Germany'),
	(2, 'Mexico'),
	(3, 'Argentina');
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
