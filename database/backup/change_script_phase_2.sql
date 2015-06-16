
-- 06/04/2015 QuangDV: Add new database change based on new Spec 
-- Remove some existed table

DROP TABLE IF EXISTS `t_training_participants`;
DROP TABLE IF EXISTS `t_training_session`;
DROP TABLE IF EXISTS `t_trainer_list`;
DROP TABLE IF EXISTS `t_venue_list`;

-- Dumping structure for table mss.t_gap_analysis_matrix
CREATE TABLE IF NOT EXISTS `t_gap_analysis_matrix` (
  `ID_CATEGORY` int(11) NOT NULL,
  `ID_QUESTION` int(11) NOT NULL,
  `IN_SCORE` int(11) NOT NULL,
  `TX_DEFAULT` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping structure for table mss.t_gap_analysis_rec
CREATE TABLE IF NOT EXISTS `t_gap_analysis_rec` (
  `ID_SURVEY` int(11) NOT NULL,
  `ID_CATEGORY` int(11) NOT NULL,
  `ID_QUESTION` int(11) NOT NULL,
  `IN_SCORE` int(11) NOT NULL,
  `TX_DEFAULT` varchar(255) NOT NULL,
  `TX_RECOMMENDATION` varchar(255) NOT NULL,
  `TX_NOTES` text NOT NULL,
  `DT_LAST_UPDATED` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping structure for table mss.t_tracking
CREATE TABLE IF NOT EXISTS `t_tracking` (
  `NM_COMPANY` varchar(50) DEFAULT NULL COMMENT 'Company ID',
  `ID_SURVEY` int(11) DEFAULT NULL COMMENT 'Survey ID',
  `STAGE_1` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Stage 1 status',
  `STAGE_2` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Stage 2 status',
  `STAGE_3` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Stage 3 status',
  `STAGE_4` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Stage 4 status',
  `STAGE_5` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Stage 5 status',
  `STAGE_6` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Stage 6 status',
  `ID_CONSULTANT` smallint(6) NOT NULL COMMENT 'Consultant ID',
  `DT_START` datetime NOT NULL,
  `DT_END` datetime NOT NULL,
  `ID_CONSULTANT_ORG` int(11) NOT NULL COMMENT 'Consultant Organisation',
  KEY `FK_TRACKING_W_SURVEY` (`ID_SURVEY`),
  KEY `FK_TRACKING_W_USER` (`ID_CONSULTANT`),
  KEY `FK_TRACKING_W_ORG` (`ID_CONSULTANT_ORG`),
  CONSTRAINT `FK_TRACKING_W_USER` FOREIGN KEY (`ID_CONSULTANT`) REFERENCES `t_user` (`ID_USER`) ON UPDATE NO ACTION,
  CONSTRAINT `FK_TRACKING_W_ORG` FOREIGN KEY (`ID_CONSULTANT_ORG`) REFERENCES `t_organisation` (`id`) ON UPDATE NO ACTION,
  CONSTRAINT `FK_TRACKING_W_SURVEY` FOREIGN KEY (`ID_SURVEY`) REFERENCES `t_survey_response_hdr` (`ID_SURVEY`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping structure for table mss.t_trainer_list
CREATE TABLE IF NOT EXISTS `t_trainer_list` (
  `ID_TRAINER` int(11) NOT NULL AUTO_INCREMENT,
  `NM_TRAINER` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_TRAINER`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping structure for table mss.t_venue_list
CREATE TABLE IF NOT EXISTS `t_venue_list` (
  `ID_VENUE` int(11) NOT NULL AUTO_INCREMENT,
  `NM_VENUE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_VENUE`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping structure for table mss.t_training_session
CREATE TABLE IF NOT EXISTS `t_training_session` (
  `ID_SESSION` int(11) NOT NULL AUTO_INCREMENT,
  `NM_SESSION` varchar(50) NOT NULL,
  `DT_START` datetime NOT NULL,
  `DT_END` datetime NOT NULL,
  `ID_TRAINER` int(11) NOT NULL,
  `ID_VENUE` int(11) NOT NULL,
  `ID_STATUS` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_SESSION`),
  KEY `FK_TRAINING_SESSION_W_TRAINER_LIST` (`ID_TRAINER`),
  KEY `FK_TRAINING_SESSION_W_VENUE_LIST` (`ID_VENUE`),
  CONSTRAINT `FK_TRAINING_SESSION_W_TRAINER_LIST` FOREIGN KEY (`ID_TRAINER`) REFERENCES `t_trainer_list` (`ID_TRAINER`) ON UPDATE NO ACTION,
  CONSTRAINT `FK_TRAINING_SESSION_W_VENUE_LIST` FOREIGN KEY (`ID_VENUE`) REFERENCES `t_venue_list` (`ID_VENUE`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping structure for table mss.t_training_participants
CREATE TABLE IF NOT EXISTS `t_training_participants` (
	`ID_SESSION` int(11) NOT NULL,
  `NM_PARTICIPANT` varchar(50) NOT NULL,
  `ID_ORGANISATION` int(11) NOT NULL,
  `NM_EMAIL` varchar(50) NOT NULL,
  KEY `FK_PARTICIPANT_W_SESSION` (`ID_SESSION`),
  KEY `FK_PARTICIPANT_W_ORG` (`ID_ORGANISATION`),
  CONSTRAINT `FK_PARTICIPANT_W_ORG` FOREIGN KEY (`ID_ORGANISATION`) REFERENCES `t_organisation` (`id`) ON UPDATE NO ACTION,
  CONSTRAINT `FK_PARTICIPANT_W_SESSION` FOREIGN KEY (`ID_SESSION`) REFERENCES `t_training_session` (`ID_SESSION`) ON UPDATE NO ACTION

)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=6
;


-- Reset auto increment

ALTER TABLE `t_trainer_list` AUTO_INCREMENT=1;
ALTER TABLE `t_venue_list` AUTO_INCREMENT=1;
ALTER TABLE `t_training_session` AUTO_INCREMENT=1;

-- Insert testing data
INSERT INTO `t_trainer_list` ( `NM_TRAINER`) VALUES
  ('VSII Trainer 1'),
  ('VSII Trainer 2'),
  ('VSII Trainer 3'),
  ('VSII Trainer 4'),
  ('VSII Trainer 5');

INSERT INTO `t_venue_list` (`NM_VENUE`) VALUES
  ('VSII Room 607'),
  ('VSII Room 606'),
  ('VSII Room 601'),
  ('VSII Burlinton'),
  ('VSII Tokyo');

INSERT INTO `t_training_session` (`NM_SESSION`, `DT_START`, `DT_END`, `ID_TRAINER`, `ID_VENUE`, `ID_STATUS`) VALUES
  ('Traiing session 1', '2015-04-06 17:02:41', '2015-08-06 17:02:45', 1, 4, 0),
  ('Traiing session 2', '2015-04-06 17:02:41', '2015-08-06 17:02:45', 2, 3, 1),
  ('Traiing session 3', '2015-04-06 17:02:41', '2015-08-06 17:02:45', 3, 1, 2),
  ('Traiing session 4', '2015-04-06 17:02:41', '2015-08-06 17:02:45', 3, 1, 0),
  ('Traiing session 5 ', '2015-04-06 17:02:41', '2015-08-06 17:02:45', 3, 1, 0);

  --linhnx 9/4/2015 update

ALTER TABLE `t_training_participants`
	ADD COLUMN `ID` INT(11) NOT NULL AUTO_INCREMENT FIRST,
	ADD COLUMN `STATUS` SMALLINT(6) NOT NULL DEFAULT '0' AFTER `ID`,
	ADD COLUMN `DELETED` BIT(1) NOT NULL DEFAULT b'0' AFTER `STATUS`,
	ADD PRIMARY KEY (`ID`);  

INSERT INTO `t_training_participants` (`ID_SESSION`, `NM_PARTICIPANT`, `ID_ORGANISATION`, `NM_EMAIL`) VALUES
  (4, 'Dinh Van Quang', 4, 'dinh.van.quang@vsi-international.com'),
  (4, 'Nguyen Tuan Hiep', 4, 'nguyen.tuan.hiep@vsi-international.com'),
  (4, 'Nguyen Duc Anh', 4, 'nguyen.duc.anh@vsi-international.com'),
  (4, 'Nguyen Xuan Linh', 4, 'nguyen.xuan.linh@vsi-international.com'),
  (4, 'Ta Van Huy', 4, 'ta.van.huy@vsi-international.com');
  
  
-- End script 06/04/2015
--huytv 13/4/2015
CREATE TABLE `t_company_assignment` (
	`ID_COMPANY` INT(11) NULL DEFAULT NULL,
	`ID_CONSULTANT` INT(11) NULL DEFAULT NULL,
	`ID_CONSULTANT_ORG` INT(11) NULL DEFAULT NULL
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;

-- remove index unique of ID_LOGIN, linhnx 14/4
ALTER TABLE `t_user`
	DROP INDEX `ID_LOGIN_2` IF EXISTS;


-- End
-- huytv 14/4/2015

ALTER TABLE `t_company_info`
	DROP COLUMN `TX_REMARKS`;

ALTER TABLE `t_company_info`
	ADD COLUMN `ID_STATUS` INT(11) NOT NULL DEFAULT '0' AFTER `ID_GS2`;

-- Alter table t_tracking, linhnx
ALTER TABLE `t_tracking`
	ALTER `NM_COMPANY` DROP DEFAULT;
ALTER TABLE `t_tracking`
	CHANGE COLUMN `NM_COMPANY` `ID_COMPANY` INT(11) NOT NULL COMMENT 'Company ID' FIRST;
-- set default value ID_STATUS in t_company_info to 1
ALTER TABLE `t_company_info`
	CHANGE COLUMN `ID_STATUS` `ID_STATUS` VARCHAR(250) NOT NULL DEFAULT '1' AFTER `NM_DESIGNATION`;
	
ALTER TABLE `t_company_info`
	CHANGE COLUMN `ID_STATUS` `ID_STATUS` INT NOT NULL DEFAULT '0' AFTER 

`NM_DESIGNATION`,
	CHANGE COLUMN `ID_FAMILY_OWNED` `ID_FAMILY_OWNED` INT(11) NULL DEFAULT '0' AFTER 

`ID_STATUS`;
--End



