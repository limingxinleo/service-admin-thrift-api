# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.21)
# Database: admin
# Generation Time: 2018-01-24 08:29:43 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色名',
  `role_desc` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '注释',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='角色表';

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;

INSERT INTO `role` (`id`, `role_name`, `role_desc`, `created_at`, `updated_at`)
VALUES
	(1,'超级管理角色','所有权限','2018-01-18 11:34:44','2018-01-18 11:34:44'),
	(2,'登录角色','可以登录系统','2018-01-18 11:35:10','2018-01-18 11:35:10'),
	(3,'基础角色','路由相关权限','2018-01-23 17:50:05','2018-01-23 17:50:05');

/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table role_router
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_router`;

CREATE TABLE `role_router` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  `router_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '接口ID',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ROLE_ROUTER_UNIQUE` (`role_id`,`router_id`),
  KEY `ROUTER_INDEX` (`router_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='角色权限表';

LOCK TABLES `role_router` WRITE;
/*!40000 ALTER TABLE `role_router` DISABLE KEYS */;

INSERT INTO `role_router` (`id`, `role_id`, `router_id`, `created_at`, `updated_at`)
VALUES
	(1,1,1,'2018-01-18 11:36:35','2018-01-18 11:36:35'),
	(2,2,2,'2018-01-23 17:49:19','2018-01-23 17:49:19'),
	(3,2,3,'2018-01-23 17:49:19','2018-01-23 17:49:19'),
	(4,2,5,'2018-01-23 17:49:19','2018-01-23 17:49:19'),
	(5,3,8,'2018-01-23 17:50:25','2018-01-23 17:50:25'),
	(6,3,9,'2018-01-23 17:50:25','2018-01-23 17:50:25'),
	(7,3,4,'2018-01-23 17:50:25','2018-01-23 17:50:25');

/*!40000 ALTER TABLE `role_router` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table router
# ------------------------------------------------------------

DROP TABLE IF EXISTS `router`;

CREATE TABLE `router` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '接口名',
  `route` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '接口路由',
  `type` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '路由类型 0自定义路由 1系统路由',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='权限表';

LOCK TABLES `router` WRITE;
/*!40000 ALTER TABLE `router` DISABLE KEYS */;

INSERT INTO `router` (`id`, `pid`, `name`, `route`, `type`, `created_at`, `updated_at`)
VALUES
	(1,0,'全路由','/*',1,'2018-01-18 11:36:09','2018-01-18 11:36:09'),
	(2,0,'管理员登录','/api/user/login',1,'2018-01-18 10:14:24','2018-01-18 10:14:24'),
	(3,0,'管理员基本信息','/api/user/info',1,'2018-01-18 10:14:24','2018-01-18 10:14:24'),
	(4,0,'路由更新','/api/router/update',1,'2018-01-18 10:14:24','2018-01-18 10:14:24'),
	(5,0,'管理员登出','/api/user/logout',1,'2018-01-22 10:13:45','2018-01-22 10:15:58'),
	(6,0,'管理员列表','/api/user/list',1,'2018-01-22 10:13:45','2018-01-22 10:15:58'),
	(7,0,'保存管理员','/api/user/save',1,'2018-01-22 10:13:45','2018-01-22 10:15:58'),
	(8,0,'路由列表','/api/router/list',1,'2018-01-22 10:13:45','2018-01-22 10:15:58'),
	(9,0,'新增路由','/api/router/save',1,'2018-01-22 10:13:45','2018-01-22 10:15:58'),
	(10,0,'角色列表','/api/role/list',1,'2018-01-22 12:46:35','2018-01-22 12:46:35'),
	(11,0,'新增角色','/api/role/save',1,'2018-01-22 12:46:35','2018-01-22 12:46:35'),
	(12,0,'获取某角色绑定的路由','/api/role/routers',1,'2018-01-23 14:30:36','2018-01-23 14:30:36'),
	(13,0,'更新角色路由','/api/role/routers/update',1,'2018-01-23 17:47:23','2018-01-24 10:43:45'),
	(14,0,'刷新角色权限缓存','/api/role/routers/reload',1,'2018-01-23 18:25:19','2018-01-23 18:25:19'),
	(15,0,'获取用户角色','/api/user/roles',1,'2018-01-24 16:29:15','2018-01-24 16:29:15'),
	(16,0,'更新用户角色','/api/user/roles/update',1,'2018-01-24 16:29:15','2018-01-24 16:29:15');

/*!40000 ALTER TABLE `router` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登录名',
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '密码',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '类型 1超级管理员 0普通管理员',
  `nickname` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `avatar` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '头像',
  `email` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '手机号',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `USERNAME_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员表';

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `username`, `password`, `type`, `nickname`, `avatar`, `email`, `mobile`, `created_at`, `updated_at`)
VALUES
	(1,'superadmin','952cb18afb426370266e8a8708927348',1,'超级管理员','https://avatars0.githubusercontent.com/u/16648551?s=460&v=4','715557344@qq.com','','2018-01-17 21:46:00','2018-01-18 15:26:45'),
	(2,'test','5628a72711e02c8b1e3738d3863e878e',0,'测试管理员','https://avatars0.githubusercontent.com/u/16648551?s=460&v=4','715557344@qq.com','','2018-01-17 21:46:00','2018-01-18 15:26:45');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `role_id` int(11) unsigned NOT NULL COMMENT '角色ID',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `USER_ROLE_UNIQUE` (`user_id`,`role_id`),
  KEY `ROLE_INDEX` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员角色表';

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;

INSERT INTO `user_role` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`)
VALUES
	(1,2,2,'2018-01-18 11:36:56','2018-01-18 11:36:56');

/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
