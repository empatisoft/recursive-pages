/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50723
 Source Host           : localhost:3306
 Source Schema         : demo

 Target Server Type    : MySQL
 Target Server Version : 50723
 File Encoding         : 65001

 Date: 22/03/2019 17:01:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for languages
-- ----------------------------
DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `lang_id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_display` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `culture` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_rtl` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ----------------------------
-- Table structure for pages
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `item_number` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `summary` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `image_cover` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_social_media` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`page_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for pages_translate
-- ----------------------------
DROP TABLE IF EXISTS `pages_translate`;
CREATE TABLE `pages_translate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `summary` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;