-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: mps_sys
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.10.1-log

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
-- Table structure for table `sys_dict`
--

DROP TABLE IF EXISTS `sys_dict`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_dict` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键，采用自增主键',
  `code` varchar(128) NOT NULL COMMENT '所有字典值以字符串方式存储',
  `label` varchar(255) NOT NULL COMMENT '字典显示用名称',
  `dict_group_id` int(10) NOT NULL COMMENT '字典组',
  `creator` int(10) NOT NULL COMMENT '创建者，关联sys_user表的id',
  `add_time` datetime NOT NULL COMMENT '创建时间，insert操作时必须添加！',
  `editor` int(10) NOT NULL COMMENT '最后更新者，在sys_user表中的id，如果是insert操作，同创建者',
  `edit_time` datetime NOT NULL COMMENT '最后更新时间，如果是insert操作，同创建时间',
  `del_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '删除状态,0未删除,1删除',
  PRIMARY KEY (`id`),
  KEY `dic_group_id` (`dict_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COMMENT='字典表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_dict`
--

LOCK TABLES `sys_dict` WRITE;
/*!40000 ALTER TABLE `sys_dict` DISABLE KEYS */;
INSERT INTO `sys_dict` VALUES (1,'是','3',1,1,'2016-12-01 14:27:24',1,'2016-12-01 16:22:46',1),(2,'1','是',1,1,'2016-12-01 16:44:14',0,'2016-12-01 16:44:14',0),(3,'10','否',1,1,'2016-12-01 16:44:27',0,'2016-12-01 16:44:27',0),(4,'1','是',3,5,'2016-12-16 17:20:51',0,'2016-12-16 17:20:51',0),(5,'0','否',3,5,'2016-12-16 17:21:01',0,'2016-12-16 17:21:01',0);
/*!40000 ALTER TABLE `sys_dict` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_dict_group`
--

DROP TABLE IF EXISTS `sys_dict_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_dict_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键，采用自增主键',
  `name` varchar(255) DEFAULT NULL COMMENT '组名称',
  `code` varchar(128) NOT NULL COMMENT '字典组编码',
  `creator` int(10) NOT NULL COMMENT '创建者，关联sys_user表的id',
  `add_time` datetime NOT NULL COMMENT '创建时间，insert操作时必须添加！',
  `editor` int(10) NOT NULL COMMENT '最后更新者，在sys_user表中的id，如果是insert操作，同创建者',
  `edit_time` datetime NOT NULL COMMENT '最后更新时间，如果是insert操作，同创建时间',
  `del_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '删除状态,0未删除,1删除',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='字典组信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_dict_group`
--

LOCK TABLES `sys_dict_group` WRITE;
/*!40000 ALTER TABLE `sys_dict_group` DISABLE KEYS */;
INSERT INTO `sys_dict_group` VALUES (3,'是否验证','check',5,'2016-12-16 17:20:28',0,'2016-12-16 17:20:28',0);
/*!40000 ALTER TABLE `sys_dict_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_icons`
--

DROP TABLE IF EXISTS `sys_icons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_icons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(50) NOT NULL,
  `name` varchar(10) NOT NULL,
  `del_flag` tinyint(1) DEFAULT '0',
  `add_time` datetime DEFAULT NULL,
  `edit_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_icons`
--

LOCK TABLES `sys_icons` WRITE;
/*!40000 ALTER TABLE `sys_icons` DISABLE KEYS */;
INSERT INTO `sys_icons` VALUES (1,'glyphicon-asterisk','雪花',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(2,'glyphicon-plus','加号',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(3,'glyphicon-euro','欧元',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(4,'glyphicon-minus','减号',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(5,'glyphicon-cloud','云',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(6,'glyphicon-envelope','信封',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(7,'glyphicon-pencil','铅笔',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(8,'glyphicon-glass','酒杯',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(9,'glyphicon-music','音符',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(10,'glyphicon-search','搜索',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(11,'glyphicon-heart','心',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(12,'glyphicon-star','五角星',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(13,'glyphicon-star-empty','空心五角星',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(14,'glyphicon-user','用户',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(15,'glyphicon-film','胶卷',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(16,'glyphicon-th-large','大九宫格',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(17,'glyphicon-th','小九宫格',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(18,'glyphicon-th-list','中九宫格',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(19,'glyphicon-ok','对号',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(20,'glyphicon-remove','错号',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(21,'glyphicon-zoom-in','放大',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(22,'glyphicon-zoom-out','缩小',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(23,'glyphicon-off','关闭',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(24,'glyphicon-signal','信号',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(25,'glyphicon-cog','齿轮',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(26,'glyphicon-trash','垃圾',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(27,'glyphicon-home','房子',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(28,'glyphicon-file','文件',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(29,'glyphicon-time','时钟',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(30,'glyphicon-road','路',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(31,'glyphicon-download-alt','下载1',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(32,'glyphicon-download','下载2',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(33,'glyphicon-upload','上传',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(34,'glyphicon-inbox','收件箱',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(35,'glyphicon-play-circle','开关',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(36,'glyphicon-repeat','重复',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(37,'glyphicon-refresh','刷新',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(38,'glyphicon-list-alt','列表',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(39,'glyphicon-lock','锁',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(40,'glyphicon-flag','国旗',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(41,'glyphicon-headphones','耳机',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(42,'glyphicon-volume-off','噤声',0,'2016-12-01 10:51:56','2016-12-05 13:33:04'),(43,'glyphicon-volume-down','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(44,'glyphicon-volume-up','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(45,'glyphicon-qrcode','二维码',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(46,'glyphicon-barcode','条形码',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(47,'glyphicon-tag','标签',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(48,'glyphicon-tags','多标签',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(49,'glyphicon-book','书',0,'2016-12-01 10:51:56','2016-12-05 13:33:19'),(50,'glyphicon-bookmark','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(51,'glyphicon-print','打印机',0,'2016-12-01 10:51:56','2016-12-05 13:34:18'),(52,'glyphicon-camera','照相机',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(53,'glyphicon-font','A',0,'2016-12-01 10:51:56','2016-12-05 13:33:48'),(54,'glyphicon-bold','B',0,'2016-12-01 10:51:56','2016-12-05 13:33:54'),(55,'glyphicon-italic','I',0,'2016-12-01 10:51:56','2016-12-05 13:34:00'),(56,'glyphicon-text-height','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(57,'glyphicon-text-width','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(58,'glyphicon-align-left','左对齐',0,'2016-12-01 10:51:56','2016-12-05 13:34:50'),(59,'glyphicon-align-center','居中',0,'2016-12-01 10:51:56','2016-12-05 13:35:07'),(60,'glyphicon-align-right','右对齐',0,'2016-12-01 10:51:56','2016-12-05 13:34:58'),(61,'glyphicon-align-justify','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(62,'glyphicon-list','目录',0,'2016-12-01 10:51:56','2016-12-05 13:35:19'),(63,'glyphicon-indent-left','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(64,'glyphicon-indent-right','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(65,'glyphicon-facetime-video','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(66,'glyphicon-picture','照片',0,'2016-12-01 10:51:56','2016-12-05 13:35:30'),(67,'glyphicon-map-marker','标注',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(68,'glyphicon-adjust','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(69,'glyphicon-tint','水滴',0,'2016-12-01 10:51:56','2016-12-05 13:35:43'),(70,'glyphicon-edit','编辑',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(71,'glyphicon-share','分享',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(72,'glyphicon-check','已读',0,'2016-12-01 10:51:56','2016-12-05 13:35:58'),(73,'glyphicon-move','移动',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(74,'glyphicon-step-backward','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(75,'glyphicon-fast-backward','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(76,'glyphicon-backward','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(77,'glyphicon-play','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(78,'glyphicon-pause','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(79,'glyphicon-stop','停止',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(80,'glyphicon-forward','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(81,'glyphicon-fast-forward','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(82,'glyphicon-step-forward','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(83,'glyphicon-eject','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(84,'glyphicon-chevron-left','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(85,'glyphicon-chevron-right','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(86,'glyphicon-plus-sign','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(87,'glyphicon-minus-sign','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(88,'glyphicon-remove-sign','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(89,'glyphicon-ok-sign','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(90,'glyphicon-question-sign','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(91,'glyphicon-info-sign','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(92,'glyphicon-screenshot','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(93,'glyphicon-remove-circle','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(94,'glyphicon-ok-circle','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(95,'glyphicon-ban-circle','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(96,'glyphicon-arrow-left','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(97,'glyphicon-arrow-right','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(98,'glyphicon-arrow-up','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(99,'glyphicon-arrow-down','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(100,'glyphicon-share-alt','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(101,'glyphicon-resize-full','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(102,'glyphicon-resize-small','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(103,'glyphicon-exclamation-sign','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(104,'glyphicon-gift','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(105,'glyphicon-leaf','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(106,'glyphicon-fire','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(107,'glyphicon-eye-open','睁眼',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(108,'glyphicon-eye-close','闭眼',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(109,'glyphicon-warning-sign','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(110,'glyphicon-plane','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(111,'glyphicon-calendar','日历',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(112,'glyphicon-random','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(113,'glyphicon-comment','消息',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(114,'glyphicon-magnet','磁石',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(115,'glyphicon-chevron-up','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(116,'glyphicon-chevron-down','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(117,'glyphicon-retweet','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(118,'glyphicon-shopping-cart','购物车',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(119,'glyphicon-folder-close','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(120,'glyphicon-folder-open','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(121,'glyphicon-resize-vertical','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(122,'glyphicon-resize-horizontal','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(123,'glyphicon-hdd','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(124,'glyphicon-bullhorn','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(125,'glyphicon-bell','闹铃',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(126,'glyphicon-certificate','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(127,'glyphicon-thumbs-up','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(128,'glyphicon-thumbs-down','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(129,'glyphicon-hand-right','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(130,'glyphicon-hand-left','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(131,'glyphicon-hand-up','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(132,'glyphicon-hand-down','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(133,'glyphicon-circle-arrow-right','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(134,'glyphicon-circle-arrow-left','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(135,'glyphicon-circle-arrow-up','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(136,'glyphicon-circle-arrow-down','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(137,'glyphicon-globe','地球',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(138,'glyphicon-wrench','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(139,'glyphicon-tasks','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(140,'glyphicon-filter','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(141,'glyphicon-briefcase','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(142,'glyphicon-fullscreen','全屏',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(143,'glyphicon-dashboard','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(144,'glyphicon-paperclip','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(145,'glyphicon-heart-empty','空心',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(146,'glyphicon-link','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(147,'glyphicon-phone','手机',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(148,'glyphicon-pushpin','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(149,'glyphicon-usd','美元',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(150,'glyphicon-gbp','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(151,'glyphicon-sort','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(152,'glyphicon-sort-by-alphabet','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(153,'glyphicon-sort-by-alphabet-alt','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(154,'glyphicon-sort-by-order','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(155,'glyphicon-sort-by-order-alt','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(156,'glyphicon-sort-by-attributes','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(157,'glyphicon-sort-by-attributes-alt','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(158,'glyphicon-unchecked','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(159,'glyphicon-expand','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(160,'glyphicon-collapse-down','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(161,'glyphicon-collapse-up','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(162,'glyphicon-log-in','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(163,'glyphicon-flash','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(164,'glyphicon-log-out','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(165,'glyphicon-new-window','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(166,'glyphicon-record','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(167,'glyphicon-save','保存',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(168,'glyphicon-open','打开',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(169,'glyphicon-saved','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(170,'glyphicon-import','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(171,'glyphicon-export','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(172,'glyphicon-send','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(173,'glyphicon-floppy-disk','软盘',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(174,'glyphicon-floppy-saved','软盘保存',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(175,'glyphicon-floppy-remove','软盘删除',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(176,'glyphicon-floppy-save','软盘上传',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(177,'glyphicon-floppy-open','软盘存储',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(178,'glyphicon-credit-card','信用卡',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(179,'glyphicon-transfer','转移',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(180,'glyphicon-cutlery','餐具',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(181,'glyphicon-header','H',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(182,'glyphicon-compressed','压缩',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(183,'glyphicon-earphone','听筒',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(184,'glyphicon-phone-alt','电话',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(185,'glyphicon-tower','塔',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(186,'glyphicon-stats','统计',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(187,'glyphicon-sd-video','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(188,'glyphicon-hd-video','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(189,'glyphicon-subtitles','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(190,'glyphicon-sound-stereo','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(191,'glyphicon-sound-dolby','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(192,'glyphicon-sound-5-1','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(193,'glyphicon-sound-6-1','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(194,'glyphicon-sound-7-1','',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(195,'glyphicon-copyright-mark','C',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(196,'glyphicon-registration-mark','R',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(197,'glyphicon-cloud-download','云下载',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(198,'glyphicon-cloud-upload','云上传',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(199,'glyphicon-tree-conifer','针叶树',0,'2016-12-01 10:51:56','2016-12-01 10:51:56'),(200,'glyphicon-tree-deciduous','落叶树',0,'2016-12-01 10:51:56','2016-12-01 10:51:56');
/*!40000 ALTER TABLE `sys_icons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_log`
--

DROP TABLE IF EXISTS `sys_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(4) DEFAULT '0' COMMENT '站点ID',
  `module` varchar(20) DEFAULT '' COMMENT '模块',
  `route` varchar(100) DEFAULT '' COMMENT '路由',
  `desc` text COMMENT '描述',
  `type` tinyint(1) DEFAULT '1' COMMENT '1：添加 2：修改 3：删除 4：查询',
  `operator` varchar(50) DEFAULT '' COMMENT '用户名',
  `userid` int(10) DEFAULT '0' COMMENT '关联用户表ID（外键关联）',
  `ip` varchar(15) DEFAULT '' COMMENT 'ip',
  `add_time` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2407 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_log`
--

LOCK TABLES `sys_log` WRITE;
/*!40000 ALTER TABLE `sys_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_menu`
--

DROP TABLE IF EXISTS `sys_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `parentid` int(10) DEFAULT '0' COMMENT '父类ID',
  `name` varchar(50) DEFAULT '' COMMENT '菜单名称',
  `m` varchar(20) DEFAULT '' COMMENT '模块名称',
  `c` varchar(20) DEFAULT '' COMMENT '控制器名称',
  `a` varchar(20) DEFAULT '' COMMENT '方法名称',
  `param` varchar(50) NOT NULL,
  `level` tinyint(1) DEFAULT '0' COMMENT '菜单等级',
  `sort` smallint(4) DEFAULT NULL,
  `icons` int(4) NOT NULL,
  `display` tinyint(1) DEFAULT '0' COMMENT '0：显示 1：不显示',
  `status` tinyint(1) DEFAULT '0' COMMENT '0：启用 1：禁用 默认为0',
  `add_time` datetime DEFAULT NULL COMMENT '添加时间',
  `edit_time` datetime DEFAULT NULL COMMENT '修改时间',
  `creator` int(10) DEFAULT '0' COMMENT '创建者 关联用户表ID（外键关联）',
  `updater` int(10) DEFAULT '0' COMMENT '修改人 关联用户表ID（外键关联）',
  `del_flag` tinyint(1) DEFAULT '0' COMMENT '0：正常 1：删除 默认为0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='菜单管理表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_menu`
--

LOCK TABLES `sys_menu` WRITE;
/*!40000 ALTER TABLE `sys_menu` DISABLE KEYS */;
INSERT INTO `sys_menu` VALUES (1,0,'基础数据','','','','',0,NULL,16,0,0,'2016-11-17 16:42:12','2016-12-22 16:54:56',0,5,0),(2,1,'用户管理','','','','',0,NULL,14,0,0,'2016-11-17 16:42:36','2016-12-05 12:52:08',0,0,0),(3,2,'用户列表','sys','user','index','',0,NULL,14,0,0,'2016-11-17 16:42:54','2016-12-22 17:14:29',0,4,0),(4,2,'角色列表','sys','role','index','',0,NULL,11,0,0,'2016-11-17 16:48:44','2016-12-05 12:52:01',0,0,0),(5,2,'菜单列表','sys','menu','index','?siteid=1',0,NULL,17,0,0,'2016-11-17 16:49:17','2016-11-17 16:49:54',0,0,0),(11,32,'日志列表','sys','log','index','',0,NULL,144,0,0,'2016-11-17 16:55:03','2016-12-14 11:07:59',0,5,0),(29,32,'图标列表','sys','icon','index','',0,NULL,14,0,0,'2016-12-01 10:25:18','2016-12-14 11:09:41',0,5,0),(30,32,'字典','sys','dict','index','',0,NULL,198,0,0,'2016-12-01 10:57:48','2016-12-01 16:55:15',0,1,0),(32,1,'系统设置','','','','',0,NULL,196,0,0,'2016-12-01 16:54:31','2016-12-01 16:54:31',1,1,0),(33,32,'字典组','sys','dictgroup','index','',0,NULL,1,0,0,'2016-12-01 16:56:04','2016-12-01 16:56:04',1,1,0),(34,32,'模板管理','sys','template','index','',0,NULL,1,0,0,'2016-12-02 11:53:06','2016-12-14 11:08:51',4,5,0),(35,0,'内容管理','','','','',0,NULL,1,0,0,'2017-04-06 18:21:43','2017-04-06 18:21:43',4,4,0);
/*!40000 ALTER TABLE `sys_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_role`
--

DROP TABLE IF EXISTS `sys_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_role` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `siteid` tinyint(4) DEFAULT '0' COMMENT '关联站点ID（外键关联）',
  `name` varchar(50) DEFAULT '' COMMENT '角色名称',
  `desc` varchar(200) DEFAULT '' COMMENT '描述',
  `sort` tinyint(4) DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) DEFAULT '0' COMMENT '0：启用 1：禁用 默认:0',
  `add_time` datetime DEFAULT NULL COMMENT '添加时间',
  `edit_time` datetime DEFAULT NULL COMMENT '修改时间',
  `creator` int(10) DEFAULT '0' COMMENT '创建者',
  `updater` int(10) DEFAULT '0' COMMENT '修改人',
  `del_flag` tinyint(1) DEFAULT '0' COMMENT '0:正常 1:删除 默认为0',
  PRIMARY KEY (`id`),
  KEY `siteid_index` (`siteid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='角色管理表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_role`
--

LOCK TABLES `sys_role` WRITE;
/*!40000 ALTER TABLE `sys_role` DISABLE KEYS */;
INSERT INTO `sys_role` VALUES (1,1,'超级管理员','',0,0,'2016-12-05 12:39:47','2016-12-19 16:07:23',0,0,0),(2,1,'系统角色','系统角色',NULL,0,'2016-11-17 17:01:53','2016-11-24 11:23:18',0,0,0),(3,1,'基础数据模块','基础数据模块',NULL,0,'2016-11-17 17:57:43','2016-11-18 07:40:50',0,0,0);
/*!40000 ALTER TABLE `sys_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_user`
--

DROP TABLE IF EXISTS `sys_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT '' COMMENT '用户名',
  `password` varchar(32) DEFAULT '' COMMENT '密码',
  `realname` varchar(20) DEFAULT '' COMMENT '真实姓名',
  `mobile` varchar(12) DEFAULT '' COMMENT '手机号',
  `deptid` int(10) DEFAULT '0' COMMENT '关联组织结构ID （外键关联）',
  `sort` smallint(4) DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) DEFAULT '0' COMMENT '0：启用 1：禁用 默认为0',
  `unique_code` varchar(50) DEFAULT '' COMMENT '第三方用户唯一码',
  `creator` int(10) DEFAULT '0' COMMENT '创建人ID',
  `updater` int(10) DEFAULT '0' COMMENT '修改人ID',
  `del_flag` tinyint(1) DEFAULT '0' COMMENT '0：正常 1：删除 默认为0',
  PRIMARY KEY (`id`),
  KEY `deptid_index` (`deptid`) USING BTREE,
  KEY `unique_code_index` (`unique_code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='用户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_user`
--

LOCK TABLES `sys_user` WRITE;
/*!40000 ALTER TABLE `sys_user` DISABLE KEYS */;
INSERT INTO `sys_user` VALUES (1,'admin','ecc1633d785ef59115f0d6b53d16fdc7','超级管理员','15888888888',1,0,0,NULL,33,33,0),(4,'mzq','ecc1633d785ef59115f0d6b53d16fdc7','mzq','15245124512',1,0,0,NULL,1,1,0);
/*!40000 ALTER TABLE `sys_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_user_info`
--

DROP TABLE IF EXISTS `sys_user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_user_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) DEFAULT '0' COMMENT '用户ID',
  `login_num` int(10) DEFAULT '0' COMMENT '登录次数',
  `ip` varchar(16) DEFAULT '' COMMENT '最后登陆ip',
  `login_time` datetime DEFAULT NULL COMMENT '最后登陆日期',
  `add_time` datetime DEFAULT NULL COMMENT '添加时间',
  `edit_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `userid_index` (`userid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 COMMENT='用户信息扩展表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_user_info`
--

LOCK TABLES `sys_user_info` WRITE;
/*!40000 ALTER TABLE `sys_user_info` DISABLE KEYS */;
INSERT INTO `sys_user_info` VALUES (1,1,794,'127.0.0.1','2017-04-07 14:10:07','2016-11-17 16:46:51','2016-11-17 16:46:51'),(4,4,188,'127.0.0.1','2017-04-07 14:19:52','2016-11-18 10:27:31','2016-11-18 10:27:31');
/*!40000 ALTER TABLE `sys_user_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_user_role`
--

DROP TABLE IF EXISTS `sys_user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(10) DEFAULT '0' COMMENT '用户id',
  `roleid` int(10) DEFAULT '0' COMMENT '角色ID',
  `creator` int(10) DEFAULT '0' COMMENT '创建者ID 关联角色表ID（外键关联）',
  `add_time` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `userid_index` (`userid`) USING BTREE,
  KEY `roleid_index` (`roleid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8 COMMENT='用户关联角色表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_user_role`
--

LOCK TABLES `sys_user_role` WRITE;
/*!40000 ALTER TABLE `sys_user_role` DISABLE KEYS */;
INSERT INTO `sys_user_role` VALUES (2,1,1,0,'2016-11-18 11:12:52'),(116,4,2,0,'2017-04-07 14:15:21');
/*!40000 ALTER TABLE `sys_user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_user_role_menu`
--

DROP TABLE IF EXISTS `sys_user_role_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_user_role_menu` (
  `roleid` int(10) DEFAULT '0' COMMENT '关联角色表ID（外键关联）',
  `menuid` int(10) DEFAULT '0' COMMENT '关联菜单表ID（外键关联）',
  `creator` int(10) DEFAULT '0' COMMENT '创建者ID 关联角色表ID（外键关联）',
  `add_time` datetime DEFAULT NULL COMMENT '添加时间',
  KEY `roleid_index` (`roleid`) USING BTREE,
  KEY `menuid_index` (`menuid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色关联菜单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_user_role_menu`
--

LOCK TABLES `sys_user_role_menu` WRITE;
/*!40000 ALTER TABLE `sys_user_role_menu` DISABLE KEYS */;
INSERT INTO `sys_user_role_menu` VALUES (2,1,1,'2017-04-07 14:12:26'),(2,2,1,'2017-04-07 14:12:26'),(2,3,1,'2017-04-07 14:12:26'),(2,4,1,'2017-04-07 14:12:26'),(2,5,1,'2017-04-07 14:12:26'),(2,32,1,'2017-04-07 14:13:32'),(2,11,1,'2017-04-07 14:13:32'),(2,29,1,'2017-04-07 14:13:32'),(2,30,1,'2017-04-07 14:13:32'),(2,33,1,'2017-04-07 14:13:32'),(2,34,1,'2017-04-07 14:13:32'),(1,1,1,'2017-04-07 14:14:39'),(1,2,1,'2017-04-07 14:14:39'),(1,3,1,'2017-04-07 14:14:39'),(1,4,1,'2017-04-07 14:14:39'),(1,5,1,'2017-04-07 14:14:39'),(1,32,1,'2017-04-07 14:14:39'),(1,11,1,'2017-04-07 14:14:39'),(1,29,1,'2017-04-07 14:14:39'),(1,30,1,'2017-04-07 14:14:39'),(1,33,1,'2017-04-07 14:14:39'),(1,34,1,'2017-04-07 14:14:39'),(1,35,1,'2017-04-07 14:14:39'),(1,36,1,'2017-04-07 14:14:39');
/*!40000 ALTER TABLE `sys_user_role_menu` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-07 14:25:39
