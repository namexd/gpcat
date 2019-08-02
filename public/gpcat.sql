/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : gpcat

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-08-02 10:14:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
INSERT INTO `admin_menu` VALUES ('1', '0', '1', '首页', 'fa-bar-chart', '/', null, null, '2019-07-31 15:54:08');
INSERT INTO `admin_menu` VALUES ('2', '0', '2', '系统设置', 'fa-tasks', null, null, null, '2019-07-31 15:54:24');
INSERT INTO `admin_menu` VALUES ('3', '2', '3', '用户设置', 'fa-users', 'auth/users', null, null, '2019-07-31 15:54:42');
INSERT INTO `admin_menu` VALUES ('4', '2', '4', '角色设置', 'fa-user', 'auth/roles', null, null, '2019-07-31 15:54:56');
INSERT INTO `admin_menu` VALUES ('5', '2', '5', '权限设置', 'fa-ban', 'auth/permissions', null, null, '2019-07-31 15:55:09');
INSERT INTO `admin_menu` VALUES ('6', '2', '6', '菜单设置', 'fa-bars', 'auth/menu', null, null, '2019-07-31 15:55:23');
INSERT INTO `admin_menu` VALUES ('7', '2', '7', '操作日志', 'fa-history', 'auth/logs', null, null, '2019-07-31 15:55:37');
INSERT INTO `admin_menu` VALUES ('8', '0', '0', '商品管理', 'fa-cubes', '/goods', null, '2019-07-31 16:30:49', '2019-07-31 16:31:21');

-- ----------------------------
-- Table structure for admin_operation_log
-- ----------------------------
DROP TABLE IF EXISTS `admin_operation_log`;
CREATE TABLE `admin_operation_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_operation_log_user_id_index` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_operation_log
-- ----------------------------
INSERT INTO `admin_operation_log` VALUES ('1', '1', 'admin', 'GET', '127.0.0.1', '[]', '2019-07-31 15:53:05', '2019-07-31 15:53:05');
INSERT INTO `admin_operation_log` VALUES ('2', '1', 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2019-07-31 15:53:22', '2019-07-31 15:53:22');
INSERT INTO `admin_operation_log` VALUES ('3', '1', 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2019-07-31 15:53:27', '2019-07-31 15:53:27');
INSERT INTO `admin_operation_log` VALUES ('4', '1', 'admin/auth/users', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2019-07-31 15:53:29', '2019-07-31 15:53:29');
INSERT INTO `admin_operation_log` VALUES ('5', '1', 'admin/auth/roles', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2019-07-31 15:53:32', '2019-07-31 15:53:32');
INSERT INTO `admin_operation_log` VALUES ('6', '1', 'admin/auth/roles/1', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2019-07-31 15:53:36', '2019-07-31 15:53:36');
INSERT INTO `admin_operation_log` VALUES ('7', '1', 'admin/auth/roles', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2019-07-31 15:53:39', '2019-07-31 15:53:39');
INSERT INTO `admin_operation_log` VALUES ('8', '1', 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2019-07-31 15:53:46', '2019-07-31 15:53:46');
INSERT INTO `admin_operation_log` VALUES ('9', '1', 'admin/auth/menu/1/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2019-07-31 15:53:54', '2019-07-31 15:53:54');
INSERT INTO `admin_operation_log` VALUES ('10', '1', 'admin/auth/menu/1', 'PUT', '127.0.0.1', '{\"parent_id\":\"0\",\"title\":\"\\u9996\\u9875\",\"icon\":\"fa-bar-chart\",\"uri\":\"\\/\",\"roles\":[null],\"permission\":null,\"_token\":\"gkTljCamFpRi6K8KTv345SGJv869XHG9Aulq9BQq\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/gpcat.test\\/admin\\/auth\\/menu\"}', '2019-07-31 15:54:07', '2019-07-31 15:54:07');
INSERT INTO `admin_operation_log` VALUES ('11', '1', 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2019-07-31 15:54:09', '2019-07-31 15:54:09');
INSERT INTO `admin_operation_log` VALUES ('12', '1', 'admin/auth/menu/2/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2019-07-31 15:54:14', '2019-07-31 15:54:14');
INSERT INTO `admin_operation_log` VALUES ('13', '1', 'admin/auth/menu/2', 'PUT', '127.0.0.1', '{\"parent_id\":\"0\",\"title\":\"\\u7cfb\\u7edf\\u8bbe\\u7f6e\",\"icon\":\"fa-tasks\",\"uri\":null,\"roles\":[\"1\",null],\"permission\":null,\"_token\":\"gkTljCamFpRi6K8KTv345SGJv869XHG9Aulq9BQq\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/gpcat.test\\/admin\\/auth\\/menu\"}', '2019-07-31 15:54:24', '2019-07-31 15:54:24');
INSERT INTO `admin_operation_log` VALUES ('14', '1', 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2019-07-31 15:54:25', '2019-07-31 15:54:25');
INSERT INTO `admin_operation_log` VALUES ('15', '1', 'admin/auth/menu/3/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2019-07-31 15:54:29', '2019-07-31 15:54:29');
INSERT INTO `admin_operation_log` VALUES ('16', '1', 'admin/auth/menu/3', 'PUT', '127.0.0.1', '{\"parent_id\":\"2\",\"title\":\"\\u7528\\u6237\\u8bbe\\u7f6e\",\"icon\":\"fa-users\",\"uri\":\"auth\\/users\",\"roles\":[null],\"permission\":null,\"_token\":\"gkTljCamFpRi6K8KTv345SGJv869XHG9Aulq9BQq\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/gpcat.test\\/admin\\/auth\\/menu\"}', '2019-07-31 15:54:42', '2019-07-31 15:54:42');
INSERT INTO `admin_operation_log` VALUES ('17', '1', 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2019-07-31 15:54:43', '2019-07-31 15:54:43');
INSERT INTO `admin_operation_log` VALUES ('18', '1', 'admin/auth/menu/4/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2019-07-31 15:54:47', '2019-07-31 15:54:47');
INSERT INTO `admin_operation_log` VALUES ('19', '1', 'admin/auth/menu/4', 'PUT', '127.0.0.1', '{\"parent_id\":\"2\",\"title\":\"\\u89d2\\u8272\\u8bbe\\u7f6e\",\"icon\":\"fa-user\",\"uri\":\"auth\\/roles\",\"roles\":[null],\"permission\":null,\"_token\":\"gkTljCamFpRi6K8KTv345SGJv869XHG9Aulq9BQq\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/gpcat.test\\/admin\\/auth\\/menu\"}', '2019-07-31 15:54:56', '2019-07-31 15:54:56');
INSERT INTO `admin_operation_log` VALUES ('20', '1', 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2019-07-31 15:54:57', '2019-07-31 15:54:57');
INSERT INTO `admin_operation_log` VALUES ('21', '1', 'admin/auth/menu/5/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2019-07-31 15:55:01', '2019-07-31 15:55:01');
INSERT INTO `admin_operation_log` VALUES ('22', '1', 'admin/auth/menu/5', 'PUT', '127.0.0.1', '{\"parent_id\":\"2\",\"title\":\"\\u6743\\u9650\\u8bbe\\u7f6e\",\"icon\":\"fa-ban\",\"uri\":\"auth\\/permissions\",\"roles\":[null],\"permission\":null,\"_token\":\"gkTljCamFpRi6K8KTv345SGJv869XHG9Aulq9BQq\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/gpcat.test\\/admin\\/auth\\/menu\"}', '2019-07-31 15:55:09', '2019-07-31 15:55:09');
INSERT INTO `admin_operation_log` VALUES ('23', '1', 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2019-07-31 15:55:10', '2019-07-31 15:55:10');
INSERT INTO `admin_operation_log` VALUES ('24', '1', 'admin/auth/menu/6/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2019-07-31 15:55:14', '2019-07-31 15:55:14');
INSERT INTO `admin_operation_log` VALUES ('25', '1', 'admin/auth/menu/6', 'PUT', '127.0.0.1', '{\"parent_id\":\"2\",\"title\":\"\\u83dc\\u5355\\u8bbe\\u7f6e\",\"icon\":\"fa-bars\",\"uri\":\"auth\\/menu\",\"roles\":[null],\"permission\":null,\"_token\":\"gkTljCamFpRi6K8KTv345SGJv869XHG9Aulq9BQq\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/gpcat.test\\/admin\\/auth\\/menu\"}', '2019-07-31 15:55:23', '2019-07-31 15:55:23');
INSERT INTO `admin_operation_log` VALUES ('26', '1', 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2019-07-31 15:55:24', '2019-07-31 15:55:24');
INSERT INTO `admin_operation_log` VALUES ('27', '1', 'admin/auth/menu/7/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2019-07-31 15:55:29', '2019-07-31 15:55:29');
INSERT INTO `admin_operation_log` VALUES ('28', '1', 'admin/auth/menu/7', 'PUT', '127.0.0.1', '{\"parent_id\":\"2\",\"title\":\"\\u64cd\\u4f5c\\u65e5\\u5fd7\",\"icon\":\"fa-history\",\"uri\":\"auth\\/logs\",\"roles\":[null],\"permission\":null,\"_token\":\"gkTljCamFpRi6K8KTv345SGJv869XHG9Aulq9BQq\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/gpcat.test\\/admin\\/auth\\/menu\"}', '2019-07-31 15:55:37', '2019-07-31 15:55:37');
INSERT INTO `admin_operation_log` VALUES ('29', '1', 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2019-07-31 15:55:39', '2019-07-31 15:55:39');
INSERT INTO `admin_operation_log` VALUES ('30', '1', 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2019-07-31 15:55:45', '2019-07-31 15:55:45');
INSERT INTO `admin_operation_log` VALUES ('31', '1', 'admin', 'GET', '127.0.0.1', '[]', '2019-07-31 16:30:24', '2019-07-31 16:30:24');
INSERT INTO `admin_operation_log` VALUES ('32', '1', 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2019-07-31 16:30:29', '2019-07-31 16:30:29');
INSERT INTO `admin_operation_log` VALUES ('33', '1', 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"title\":\"\\u5546\\u54c1\\u7ba1\\u7406\",\"icon\":\"fa-bars\",\"uri\":\"\\/goods\",\"roles\":[null],\"permission\":null,\"_token\":\"gkTljCamFpRi6K8KTv345SGJv869XHG9Aulq9BQq\"}', '2019-07-31 16:30:49', '2019-07-31 16:30:49');
INSERT INTO `admin_operation_log` VALUES ('34', '1', 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2019-07-31 16:30:50', '2019-07-31 16:30:50');
INSERT INTO `admin_operation_log` VALUES ('35', '1', 'admin/auth/menu/8/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2019-07-31 16:30:57', '2019-07-31 16:30:57');
INSERT INTO `admin_operation_log` VALUES ('36', '1', 'admin/auth/menu/8', 'PUT', '127.0.0.1', '{\"parent_id\":\"0\",\"title\":\"\\u5546\\u54c1\\u7ba1\\u7406\",\"icon\":\"fa-cubes\",\"uri\":\"\\/goods\",\"roles\":[null],\"permission\":null,\"_token\":\"gkTljCamFpRi6K8KTv345SGJv869XHG9Aulq9BQq\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/gpcat.test\\/admin\\/auth\\/menu\"}', '2019-07-31 16:31:21', '2019-07-31 16:31:21');
INSERT INTO `admin_operation_log` VALUES ('37', '1', 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2019-07-31 16:31:22', '2019-07-31 16:31:22');
INSERT INTO `admin_operation_log` VALUES ('38', '1', 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2019-07-31 16:31:27', '2019-07-31 16:31:27');
INSERT INTO `admin_operation_log` VALUES ('39', '1', 'admin/goods', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2019-07-31 16:31:31', '2019-07-31 16:31:31');
INSERT INTO `admin_operation_log` VALUES ('40', '1', 'admin/goods', 'GET', '127.0.0.1', '[]', '2019-07-31 16:35:32', '2019-07-31 16:35:32');
INSERT INTO `admin_operation_log` VALUES ('41', '1', 'admin/goods', 'GET', '127.0.0.1', '[]', '2019-07-31 16:36:00', '2019-07-31 16:36:00');
INSERT INTO `admin_operation_log` VALUES ('42', '1', 'admin/goods', 'GET', '127.0.0.1', '[]', '2019-07-31 16:39:09', '2019-07-31 16:39:09');

-- ----------------------------
-- Table structure for admin_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_permissions_name_unique` (`name`),
  UNIQUE KEY `admin_permissions_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_permissions
-- ----------------------------
INSERT INTO `admin_permissions` VALUES ('1', 'All permission', '*', '', '*', null, null);
INSERT INTO `admin_permissions` VALUES ('2', 'Dashboard', 'dashboard', 'GET', '/', null, null);
INSERT INTO `admin_permissions` VALUES ('3', 'Login', 'auth.login', '', '/auth/login\r\n/auth/logout', null, null);
INSERT INTO `admin_permissions` VALUES ('4', 'User setting', 'auth.setting', 'GET,PUT', '/auth/setting', null, null);
INSERT INTO `admin_permissions` VALUES ('5', 'Auth management', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', null, null);

-- ----------------------------
-- Table structure for admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE `admin_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_roles_name_unique` (`name`),
  UNIQUE KEY `admin_roles_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_roles
-- ----------------------------
INSERT INTO `admin_roles` VALUES ('1', 'Administrator', 'administrator', '2019-07-31 15:51:33', '2019-07-31 15:51:33');

-- ----------------------------
-- Table structure for admin_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_menu`;
CREATE TABLE `admin_role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_menu_role_id_menu_id_index` (`role_id`,`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_role_menu
-- ----------------------------
INSERT INTO `admin_role_menu` VALUES ('1', '2', null, null);

-- ----------------------------
-- Table structure for admin_role_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_permissions`;
CREATE TABLE `admin_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_permissions_role_id_permission_id_index` (`role_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_role_permissions
-- ----------------------------
INSERT INTO `admin_role_permissions` VALUES ('1', '1', null, null);

-- ----------------------------
-- Table structure for admin_role_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_users`;
CREATE TABLE `admin_role_users` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_users_role_id_user_id_index` (`role_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_role_users
-- ----------------------------
INSERT INTO `admin_role_users` VALUES ('1', '1', null, null);

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_username_unique` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES ('1', 'admin', '$2y$10$o7OqQcQM9bEl49x.ZwyqFupbEoZAZAjTIZs81Ha6lgse30HrDbxPG', 'Administrator', null, 'xPCWdyF49EnS3czDSaMNQPZHBATIbBffbbhgKyKwu768g6geoXmNklZf4VZi', '2019-07-31 15:51:33', '2019-07-31 15:51:33');

-- ----------------------------
-- Table structure for admin_user_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_permissions`;
CREATE TABLE `admin_user_permissions` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_user_permissions_user_id_permission_id_index` (`user_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_user_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '型号',
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片',
  `type` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '类型',
  `model` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '型号',
  `number` int(11) NOT NULL COMMENT '库存',
  `unit` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '单位',
  `product_area` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '产地',
  `price` decimal(8,2) NOT NULL COMMENT '对接价格',
  `price_a` decimal(8,2) NOT NULL COMMENT 'A价格',
  `price_b` decimal(8,2) NOT NULL COMMENT 'B价格',
  `package` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '包装',
  `supplier` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '供应商',
  `repository` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '仓库名称',
  `oil` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '油脂',
  `size` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '尺寸规格',
  `inner_diameter` double(8,3) NOT NULL COMMENT '轴承内径',
  `out_diameter` double(8,3) NOT NULL COMMENT '轴承外径',
  `width` double(8,3) NOT NULL COMMENT '轴承宽度',
  `weight` double(8,3) NOT NULL COMMENT '轴承重量',
  `days` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '货期',
  `comment` text COLLATE utf8mb4_unicode_ci COMMENT '备注',
  `extra1` text COLLATE utf8mb4_unicode_ci COMMENT '备用字段1',
  `extra2` text COLLATE utf8mb4_unicode_ci COMMENT '备用字段2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('12', 'NMB', '/img/nmb.jpg', '深沟球轴承', 'NMB R-3HHMTRA1P25LY121(S)', '6355', '套', '新加坡', '5.55', '5.90', '6.50', '工包', '荣升富达', '仓1', '2AS', '全尺寸', '222.000', '11.000', '22.000', '0.158', '3天', null, null, null, '2019-08-02 09:20:15', '2019-08-02 09:20:15');
INSERT INTO `goods` VALUES ('13', 'NMB', '/img/nmb.jpg', '深沟球轴承', 'NMB F605ZZDDRF-1450ZZRP0P25LY121(C)', '22', '套', '泰国', '10.70', '11.85', '12.58', '工包', '荣升富达', '仓2', '2AS', '66*66*55', '666.000', '555.000', '666.000', '0.355', '5天', null, null, null, '2019-08-02 09:20:15', '2019-08-02 09:20:15');
INSERT INTO `goods` VALUES ('14', 'NMB', '/img/nmb.jpg', '深沟球轴承', 'NMB 605ZZR-1450ZZRP0P25LY72（T)', '8503', '件', '泰国', '4.50', '5.10', '5.98', '商包', '荣升富达', '仓3', '5K', '88*995*588', '123.000', '456.000', '456.000', '1.235', '6天', null, null, null, '2019-08-02 09:20:15', '2019-08-02 09:20:15');
INSERT INTO `goods` VALUES ('15', 'NMB', '/img/nmb.jpg', '调心球轴承', 'NMB 605ZZDDR-1450ZZRP0P25LY121(T)', '7850', 'PCS', '泰国', '6.00', '6.90', '7.85', '商包', '荣升富达', '华东仓', '2AS', '123.336*55.25*2', '456.000', '456.000', '45.000', '2.358', '15天', null, null, null, '2019-08-02 09:20:15', '2019-08-02 09:20:15');
INSERT INTO `goods` VALUES ('16', 'NSK', 'images/文件导出-微服务.jpeg', '圆柱滚子轴承', 'NMB 606ZZR-1760X2KKRP0P24LY121（C）', '48797', '套', '泰国', '3.35', '3.50', '4.23', '商包', '荣升富达', '华南仓', '5K', '2258*253.3*36.2', '4564.000', '456.000', '56.000', '0.589', '5天', null, null, null, '2019-08-02 09:20:15', '2019-08-02 09:20:40');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2016_01_04_173148_create_admin_tables', '1');
INSERT INTO `migrations` VALUES ('5', '2019_07_31_160552_create_goods_table', '2');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
