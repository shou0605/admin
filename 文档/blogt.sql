/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : blogt

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 18/01/2020 02:31:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_admin
-- ----------------------------
DROP TABLE IF EXISTS `tb_admin`;
CREATE TABLE `tb_admin`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '密码',
  `nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `login_num` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '登录次数',
  `register_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '注册时间',
  `last_login_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后登录时间',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态[0禁用-1启用]',
  `register_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '注册ip',
  `last_login_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `color_type` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '默认颜色 0黑 1蓝 2绿 3红 4黄 5橙',
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '用户权限 对应 tp_auth_group表',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '管理员表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_admin
-- ----------------------------
INSERT INTO `tb_admin` VALUES (1, 'admin', 'd29c9203fc3bbeef96bf920f5082117e', '技术-寿峻', 139, 1532590967, 1579283920, 1579283920, 1, '255.255.255.255', '127.0.0.1', 1, 1);

-- ----------------------------
-- Table structure for tb_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `tb_auth_group`;
CREATE TABLE `tb_auth_group`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户组id,自增主键',
  `module` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户组所属模块',
  `title` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `rules` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  `description` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '描述信息',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '用户组状态：为1正常，为0禁用,2为删除',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '权限组表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_auth_group
-- ----------------------------
INSERT INTO `tb_auth_group` VALUES (1, 'admin', '超级管理员', '4', '拥有系统管理权限', 1, 1579077323, 1579077323);
INSERT INTO `tb_auth_group` VALUES (2, 'admin', '产品', '1,5,4,3,13,12,11,10,2,9,7,6,14', '产品', 1, 1579165736, 1579165736);

-- ----------------------------
-- Table structure for tb_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `tb_auth_rule`;
CREATE TABLE `tb_auth_rule`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `pid` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上级ID',
  `module` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'admin' COMMENT '规则所属module',
  `path` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则唯一英文标识',
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则中文描述',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否有效[0无效-1有效]',
  `sort` tinyint(3) NOT NULL DEFAULT 0 COMMENT '排序',
  `is_show` tinyint(1) NOT NULL COMMENT '1级菜单是否显示菜单页',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `class` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '分类等级',
  `icon` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'icon',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '权限表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_auth_rule
-- ----------------------------
INSERT INTO `tb_auth_rule` VALUES (1, 0, 'admin', '', '开发管理', 1, -1, 1, 1579077323, 1, '&#xe616;');
INSERT INTO `tb_auth_rule` VALUES (2, 1, 'admin', 'admin/user_list', '管理员列表', 1, 0, 0, 1579077323, 2, '');
INSERT INTO `tb_auth_rule` VALUES (3, 1, 'admin', 'auth/menu_list', '菜单列表', 1, 0, 0, 1579077323, 2, '');
INSERT INTO `tb_auth_rule` VALUES (4, 1, 'admin', 'auth/auth_list', '权限列表', 1, 0, 0, 1579077323, 2, '');
INSERT INTO `tb_auth_rule` VALUES (5, 1, 'admin', 'admin/operat_list', '操作日志', 1, 0, 0, 1579077323, 2, '');
INSERT INTO `tb_auth_rule` VALUES (6, 2, 'admin', 'admin/user_upstate', '禁用', 1, 0, 0, 1579080377, 3, '');
INSERT INTO `tb_auth_rule` VALUES (7, 2, 'admin', 'admin/user_del', '删除', 1, 0, 0, 1579080405, 3, '');
INSERT INTO `tb_auth_rule` VALUES (8, 2, 'admin', 'admin/user_add', '添加', 1, 0, 0, 1579080428, 3, '');
INSERT INTO `tb_auth_rule` VALUES (9, 2, 'admin', 'admin/user_edit', '编辑', 1, 0, 0, 1579080455, 3, '');
INSERT INTO `tb_auth_rule` VALUES (10, 3, 'admin', 'menu/menu_upstate', '禁用', 1, 0, 0, 1579080377, 3, '');
INSERT INTO `tb_auth_rule` VALUES (11, 3, 'admin', 'menu/menu_add', '添加', 1, 0, 0, 1579080377, 3, '');
INSERT INTO `tb_auth_rule` VALUES (12, 3, 'admin', 'menu/menu_edit', '编辑', 1, 0, 0, 1579080377, 3, '');
INSERT INTO `tb_auth_rule` VALUES (13, 3, 'admin', 'menu/menu_del', '删除', 1, 0, 0, 1579080377, 3, '');
INSERT INTO `tb_auth_rule` VALUES (14, 0, 'admin', '', '基础管理', 1, 0, 1, 1579077323, 1, '&#xe62d;');
INSERT INTO `tb_auth_rule` VALUES (15, 4, 'admin', 'auth/auth_upstate', '禁用', 1, 0, 0, 1579080377, 3, '');
INSERT INTO `tb_auth_rule` VALUES (16, 4, 'admin', 'auth/auth_add', '添加', 1, 0, 0, 1579080377, 3, '');
INSERT INTO `tb_auth_rule` VALUES (17, 4, 'admin', 'auth/auth_edit', '编辑', 1, 0, 0, 1579080377, 3, '');
INSERT INTO `tb_auth_rule` VALUES (18, 4, 'admin', 'auth/auth_del', '删除', 1, 0, 0, 1579080377, 3, '');

-- ----------------------------
-- Table structure for tb_log_operat
-- ----------------------------
DROP TABLE IF EXISTS `tb_log_operat`;
CREATE TABLE `tb_log_operat`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '地址',
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'ip地址',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '操作时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '后台操作日志表' ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
