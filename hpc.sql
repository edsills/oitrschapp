-- MySQL dump 10.16  Distrib 10.1.13-MariaDB, for osx10.6 (i386)
--
-- Host: localhost    Database: hpc
-- ------------------------------------------------------
-- Server version	10.1.13-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hpc_account_status`
--

DROP TABLE IF EXISTS `hpc_account_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hpc_account_status` (
  `status` char(1) NOT NULL,
  `description` varchar(40) NOT NULL,
  PRIMARY KEY (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hpc_account_status`
--

LOCK TABLES `hpc_account_status` WRITE;
/*!40000 ALTER TABLE `hpc_account_status` DISABLE KEYS */;
INSERT INTO `hpc_account_status` VALUES ('A','Active account'),('D','Disabled account'),('R','Requested account');
/*!40000 ALTER TABLE `hpc_account_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hpc_accounts`
--

DROP TABLE IF EXISTS `hpc_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hpc_accounts` (
  `login` varchar(8) NOT NULL,
  `machine_name` varchar(16) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_number` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pin` varchar(8) DEFAULT NULL,
  `shell` varchar(12) NOT NULL,
  PRIMARY KEY (`machine_name`,`login`),
  KEY `project_id` (`project_id`),
  KEY `user_number` (`user_number`),
  KEY `status` (`status`),
  CONSTRAINT `hpc_accounts_ibfk_1` FOREIGN KEY (`machine_name`) REFERENCES `hpc_machine_names` (`machine_name`),
  CONSTRAINT `hpc_accounts_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `hpc_projects` (`project_id`),
  CONSTRAINT `hpc_accounts_ibfk_3` FOREIGN KEY (`user_number`) REFERENCES `hpc_users` (`user_number`),
  CONSTRAINT `hpc_accounts_ibfk_4` FOREIGN KEY (`status`) REFERENCES `hpc_account_status` (`status`),
  CONSTRAINT `hpc_accounts_ibfk_5` FOREIGN KEY (`machine_name`) REFERENCES `hpc_machine_names` (`machine_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hpc_accounts`
--

LOCK TABLES `hpc_accounts` WRITE;
/*!40000 ALTER TABLE `hpc_accounts` DISABLE KEYS */;
INSERT INTO `hpc_accounts` VALUES ('edsills','bc01',1,1,'R',69343,'','tcsh');
/*!40000 ALTER TABLE `hpc_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hpc_departments`
--

DROP TABLE IF EXISTS `hpc_departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hpc_departments` (
  `department_id` int(11) NOT NULL,
  `department` varchar(100) NOT NULL,
  `department_abbr` varchar(16) NOT NULL,
  `college_id` varchar(16) NOT NULL,
  `institution_id` int(11) NOT NULL,
  PRIMARY KEY (`department_id`),
  UNIQUE KEY `department` (`department`,`institution_id`),
  KEY `institution_id` (`institution_id`),
  CONSTRAINT `hpc_departments_ibfk_1` FOREIGN KEY (`institution_id`) REFERENCES `hpc_institutions` (`institution_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hpc_departments`
--

LOCK TABLES `hpc_departments` WRITE;
/*!40000 ALTER TABLE `hpc_departments` DISABLE KEYS */;
INSERT INTO `hpc_departments` VALUES (517001,'Advanced Computing','HPC','51',10000);
/*!40000 ALTER TABLE `hpc_departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hpc_institutions`
--

DROP TABLE IF EXISTS `hpc_institutions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hpc_institutions` (
  `institution_id` int(11) NOT NULL,
  `institution_name` varchar(80) NOT NULL,
  `institution_abbr` varchar(10) NOT NULL,
  PRIMARY KEY (`institution_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hpc_institutions`
--

LOCK TABLES `hpc_institutions` WRITE;
/*!40000 ALTER TABLE `hpc_institutions` DISABLE KEYS */;
INSERT INTO `hpc_institutions` VALUES (10000,'North Carolina State University','NCSU'),(13500,'University of North Carolina at Greensboro','UNCG');
/*!40000 ALTER TABLE `hpc_institutions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hpc_machine_names`
--

DROP TABLE IF EXISTS `hpc_machine_names`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hpc_machine_names` (
  `machine_name` varchar(16) NOT NULL,
  `vendor` varchar(40) DEFAULT NULL,
  `model` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`machine_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hpc_machine_names`
--

LOCK TABLES `hpc_machine_names` WRITE;
/*!40000 ALTER TABLE `hpc_machine_names` DISABLE KEYS */;
INSERT INTO `hpc_machine_names` VALUES ('bc01','IBM','Linux x86');
/*!40000 ALTER TABLE `hpc_machine_names` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hpc_program_ids`
--

DROP TABLE IF EXISTS `hpc_program_ids`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hpc_program_ids` (
  `program_id` int(11) NOT NULL,
  `program` varchar(40) NOT NULL,
  PRIMARY KEY (`program_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hpc_program_ids`
--

LOCK TABLES `hpc_program_ids` WRITE;
/*!40000 ALTER TABLE `hpc_program_ids` DISABLE KEYS */;
INSERT INTO `hpc_program_ids` VALUES (0,'standard HPC project'),(1,'GRL project');
/*!40000 ALTER TABLE `hpc_program_ids` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hpc_project_types`
--

DROP TABLE IF EXISTS `hpc_project_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hpc_project_types` (
  `project_type` char(2) NOT NULL,
  `project` varchar(40) NOT NULL,
  PRIMARY KEY (`project_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hpc_project_types`
--

LOCK TABLES `hpc_project_types` WRITE;
/*!40000 ALTER TABLE `hpc_project_types` DISABLE KEYS */;
INSERT INTO `hpc_project_types` VALUES ('EC','Course Project'),('EF','Friendly User Project'),('EM','Research Project'),('SN','Service Project');
/*!40000 ALTER TABLE `hpc_project_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hpc_projects`
--

DROP TABLE IF EXISTS `hpc_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hpc_projects` (
  `project_id` int(11) NOT NULL,
  `user_number` int(11) NOT NULL,
  `project_type` char(2) NOT NULL,
  `group_name` varchar(16) NOT NULL,
  `program_id` int(11) NOT NULL,
  PRIMARY KEY (`project_id`),
  UNIQUE KEY `group_name` (`group_name`),
  KEY `ckun` (`user_number`),
  KEY `program_id` (`program_id`),
  KEY `project_type` (`project_type`),
  CONSTRAINT `ckun` FOREIGN KEY (`user_number`) REFERENCES `hpc_users` (`user_number`),
  CONSTRAINT `hpc_projects_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `hpc_program_ids` (`program_id`),
  CONSTRAINT `hpc_projects_ibfk_2` FOREIGN KEY (`project_type`) REFERENCES `hpc_project_types` (`project_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hpc_projects`
--

LOCK TABLES `hpc_projects` WRITE;
/*!40000 ALTER TABLE `hpc_projects` DISABLE KEYS */;
INSERT INTO `hpc_projects` VALUES (1,1,'EM','sills',0);
/*!40000 ALTER TABLE `hpc_projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hpc_users`
--

DROP TABLE IF EXISTS `hpc_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hpc_users` (
  `user_number` int(11) NOT NULL,
  `title` varchar(10) DEFAULT NULL,
  `firstname` varchar(40) NOT NULL,
  `middleinitial` char(1) DEFAULT NULL,
  `lastname` varchar(40) NOT NULL,
  `position` varchar(40) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`user_number`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `hpc_users_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `hpc_departments` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hpc_users`
--

LOCK TABLES `hpc_users` WRITE;
/*!40000 ALTER TABLE `hpc_users` DISABLE KEYS */;
INSERT INTO `hpc_users` VALUES (1,'Dr','Eric','D','Sills','Assistant Vice Chancellor',517001,'edsills@ncsu.edu','919-513-0324');
/*!40000 ALTER TABLE `hpc_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-23 11:07:17
