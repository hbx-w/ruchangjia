/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : hotel

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 23/02/2022 10:32:31
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tp_admin
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE `tp_admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '密码',
  `head_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '头像',
  `age` int(11) NULL DEFAULT NULL COMMENT '年龄',
  `gender` tinyint(255) NULL DEFAULT NULL COMMENT '性别 1 男 0 女',
  `real_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '真实姓名',
  `phone` varbinary(11) NULL DEFAULT NULL COMMENT '电话',
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '状态',
  `sort` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '排序',
  `create_time` int(11) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_admin
-- ----------------------------
INSERT INTO `tp_admin` VALUES (1, 'admin', '14e1b600b1fd579f47433b88e8d85291', NULL, 22, 1, '陈晨', 0x3138353339323933313732, 1, '255', 1645166702, 1645170124);
INSERT INTO `tp_admin` VALUES (2, 'csc', NULL, NULL, 22, 1, '杨东', 0x3132333435363738393031, 1, '255', 1645177961, 1645177961);

-- ----------------------------
-- Table structure for tp_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_group`;
CREATE TABLE `tp_auth_group`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `shop_id` int(11) NULL DEFAULT NULL COMMENT '0为系统其他为商店',
  `title` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `status` tinyint(1) NULL DEFAULT NULL,
  `rules` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `create_time` int(11) NULL DEFAULT NULL,
  `update_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_auth_group
-- ----------------------------
INSERT INTO `tp_auth_group` VALUES (1, 0, '管理员', 1, NULL, 1617242511, 1617242511);

-- ----------------------------
-- Table structure for tp_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_group_access`;
CREATE TABLE `tp_auth_group_access`  (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of tp_auth_group_access
-- ----------------------------

-- ----------------------------
-- Table structure for tp_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_rule`;
CREATE TABLE `tp_auth_rule`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` char(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `title` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `css` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `condition` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `pid` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `tag` tinyint(1) NOT NULL,
  `is_show` tinyint(1) NULL DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_auth_rule
-- ----------------------------
INSERT INTO `tp_auth_rule` VALUES (1, '#', '系统管理', 1, 1, 'fa fa-gear', '', 0, 1, 1, 1, 1970, 1566455553);
INSERT INTO `tp_auth_rule` VALUES (2, 'user/index', '用户管理', 1, 1, '', '', 1, 1, 0, 1, 2015, 2016);
INSERT INTO `tp_auth_rule` VALUES (3, 'role/index', '角色管理', 1, 1, '', '', 1, 1, 0, 2, 1446535750, 1446535750);
INSERT INTO `tp_auth_rule` VALUES (4, 'menu/index', '菜单管理', 1, 0, '', '', 1, 1, 0, 30, 1446535750, 1446535750);
INSERT INTO `tp_auth_rule` VALUES (5, '#', '房间管理', 1, 1, 'fa fa-home', '', 0, 1, 1, 1, 1446535750, 1446535750);
INSERT INTO `tp_auth_rule` VALUES (6, 'room/index', '房间类型', 1, 1, '', '', 5, 50, 1, 1, 144653570, 144653570);
INSERT INTO `tp_auth_rule` VALUES (7, '#', '会员管理', 1, 1, 'fa fa-user-circle-o', '', 0, 1, 1, 1, 144653570, 144653570);
INSERT INTO `tp_auth_rule` VALUES (8, 'member/index', '会员列表', 1, 1, '', '', 7, 50, 1, 1, 144653570, 144653570);
INSERT INTO `tp_auth_rule` VALUES (9, 'room/room_list', '房间列表', 1, 1, '', '', 5, 50, 1, 1, 144653570, 144653570);
INSERT INTO `tp_auth_rule` VALUES (10, '#', '楼层管理', 1, 1, 'fa fa-institution', '', 0, 1, 1, 1, 144653570, 144673570);
INSERT INTO `tp_auth_rule` VALUES (11, 'floor/index', '楼层列表', 1, 1, '', '', 10, 50, 1, 1, 144653570, 144653570);
INSERT INTO `tp_auth_rule` VALUES (12, '#', '订单管理', 1, 1, 'fa fa-first-order', '', 0, 1, 1, 1, 144653570, 144653570);
INSERT INTO `tp_auth_rule` VALUES (13, 'order/index', '订单列表', 1, 1, '', '', 12, 50, 1, 1, 144653570, 144653570);

-- ----------------------------
-- Table structure for tp_floor
-- ----------------------------
DROP TABLE IF EXISTS `tp_floor`;
CREATE TABLE `tp_floor`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `floor_num` int(11) NULL DEFAULT NULL COMMENT '楼层数',
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '状态 1 开启 0 关闭',
  `sort` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '排序',
  `create_time` int(11) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_floor
-- ----------------------------
INSERT INTO `tp_floor` VALUES (1, 1, 1, '255', 1644819088, 1644819088);
INSERT INTO `tp_floor` VALUES (2, 2, 1, '255', 1645154974, 1645154974);
INSERT INTO `tp_floor` VALUES (3, 3, 1, '255', 1645154981, 1645154981);
INSERT INTO `tp_floor` VALUES (4, 4, 1, '255', 1645154987, 1645154987);
INSERT INTO `tp_floor` VALUES (5, 5, 1, '255', 1645154992, 1645154992);
INSERT INTO `tp_floor` VALUES (6, 6, 1, '255', 1645175258, 1645175258);

-- ----------------------------
-- Table structure for tp_image_gallery
-- ----------------------------
DROP TABLE IF EXISTS `tp_image_gallery`;
CREATE TABLE `tp_image_gallery`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `act_name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '关联名称',
  `act_id` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '关联id',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '图片',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_image_gallery
-- ----------------------------

-- ----------------------------
-- Table structure for tp_member
-- ----------------------------
DROP TABLE IF EXISTS `tp_member`;
CREATE TABLE `tp_member`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '昵称',
  `head_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '头像',
  `age` int(11) NULL DEFAULT NULL COMMENT '年龄',
  `gender` tinyint(1) NULL DEFAULT 1 COMMENT '性别 1 男 2 女 0未知',
  `phone` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '电话',
  `real_name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '真实姓名',
  `id_card` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '身份证号码',
  `sort` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '排序',
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '状态',
  `create_time` int(11) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_member
-- ----------------------------
INSERT INTO `tp_member` VALUES (1, 'Onlyone', '', 22, 1, '18539293172', '陈晨', '410485199905050301', '255', 1, 1644819088, 1645412224);
INSERT INTO `tp_member` VALUES (2, 'Ru', '', 22, 1, '18939412077', '茹长佳', '410485200006053232', '255', 1, 1645412017, 1645412632);

-- ----------------------------
-- Table structure for tp_order
-- ----------------------------
DROP TABLE IF EXISTS `tp_order`;
CREATE TABLE `tp_order`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `order_num` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '订单编号',
  `user_id` int(11) NULL DEFAULT NULL COMMENT '用户ID',
  `rd_id` int(11) NULL DEFAULT NULL COMMENT '房间ID',
  `is_pay` tinyint(1) NULL DEFAULT 0 COMMENT '是否支付 1 支付 0 未支付',
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '状态',
  `sort` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '排序',
  `add_time` int(11) NULL DEFAULT NULL COMMENT '下单时间',
  `pay_time` int(11) NULL DEFAULT NULL COMMENT '订单更新时间',
  `verify_time` int(11) NULL DEFAULT NULL COMMENT '审核时间',
  `delete_time` int(11) NULL DEFAULT NULL COMMENT '订单删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_order
-- ----------------------------
INSERT INTO `tp_order` VALUES (1, '2022022176496', 1, 1, 1, 1, '255', 1645004253, 1645004253, 1645578287, 1645004253);
INSERT INTO `tp_order` VALUES (2, '2022022163623', 2, 2, 1, 1, '255', 1645437418, NULL, 1645578877, NULL);

-- ----------------------------
-- Table structure for tp_room
-- ----------------------------
DROP TABLE IF EXISTS `tp_room`;
CREATE TABLE `tp_room`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1' COMMENT '房间类型',
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '状态',
  `sort` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '排序',
  `create_time` int(11) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_room
-- ----------------------------
INSERT INTO `tp_room` VALUES (1, '豪华双人床', 1, '255', 1645148307, 1645148307);
INSERT INTO `tp_room` VALUES (2, '标准间', 1, '255', 1645004253, 1645004253);
INSERT INTO `tp_room` VALUES (3, '豪华大人床', 1, '255', 1645004571, 1645004571);
INSERT INTO `tp_room` VALUES (4, '温馨水房', 0, '255', 1645168105, 1645168105);
INSERT INTO `tp_room` VALUES (5, '情侣房', 1, '255', 1645407199, 1645407199);

-- ----------------------------
-- Table structure for tp_room_detalis
-- ----------------------------
DROP TABLE IF EXISTS `tp_room_detalis`;
CREATE TABLE `tp_room_detalis`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `room_num` int(11) NULL DEFAULT NULL COMMENT '房间号',
  `people_num` int(11) NOT NULL DEFAULT 1 COMMENT '可住人数',
  `area` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '60' COMMENT '面积',
  `desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '房间介绍',
  `f_id` int(11) NOT NULL COMMENT '楼层id',
  `r_id` int(11) NOT NULL COMMENT '房价类型id',
  `rs_id` int(11) NOT NULL COMMENT '房价状态id',
  `images` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '房间图片',
  `yprice` decimal(10, 2) NULL DEFAULT NULL COMMENT '原价',
  `price` decimal(10, 2) NULL DEFAULT NULL COMMENT '现价',
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '是否上线 1是 0 否',
  `sort` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '排序',
  `create_time` int(11) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_room_detalis
-- ----------------------------
INSERT INTO `tp_room_detalis` VALUES (1, 102, 1, '100', '1234', 1, 3, 3, '', 100.00, 90.00, 1, '255', 1645177124, 1645428867);
INSERT INTO `tp_room_detalis` VALUES (2, 201, 2, '60', '精品标准间', 2, 1, 1, '', 100.00, 80.00, 1, '255', 1645406440, 1645431895);
INSERT INTO `tp_room_detalis` VALUES (5, 301, 1, '100', '123', 3, 5, 1, NULL, 150.00, 125.00, 1, '255', 1645431920, 1645431932);

-- ----------------------------
-- Table structure for tp_room_equipment
-- ----------------------------
DROP TABLE IF EXISTS `tp_room_equipment`;
CREATE TABLE `tp_room_equipment`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `equipment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '设备',
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '状态',
  `sort` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '排序',
  `create_time` int(11) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_room_equipment
-- ----------------------------
INSERT INTO `tp_room_equipment` VALUES (1, '免费WIFI', 1, '255', 1644820105, 1644820105);
INSERT INTO `tp_room_equipment` VALUES (2, '停车场', 1, '255', 1644820105, 1644820105);
INSERT INTO `tp_room_equipment` VALUES (3, '窗台', 1, '255', 1644820105, 1644820105);
INSERT INTO `tp_room_equipment` VALUES (4, '淋浴', 1, '255', 1644820105, 1644820105);
INSERT INTO `tp_room_equipment` VALUES (5, '热水', 1, '255', 1644820105, 1644820105);

-- ----------------------------
-- Table structure for tp_room_equipment_access
-- ----------------------------
DROP TABLE IF EXISTS `tp_room_equipment_access`;
CREATE TABLE `tp_room_equipment_access`  (
  `id` int(11) NOT NULL COMMENT 'ID',
  `rd_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of tp_room_equipment_access
-- ----------------------------
INSERT INTO `tp_room_equipment_access` VALUES (1, 1, 3);
INSERT INTO `tp_room_equipment_access` VALUES (2, 1, 4);
INSERT INTO `tp_room_equipment_access` VALUES (3, 1, 5);
INSERT INTO `tp_room_equipment_access` VALUES (4, 2, 3);
INSERT INTO `tp_room_equipment_access` VALUES (5, 2, 4);
INSERT INTO `tp_room_equipment_access` VALUES (6, 2, 5);

-- ----------------------------
-- Table structure for tp_room_status
-- ----------------------------
DROP TABLE IF EXISTS `tp_room_status`;
CREATE TABLE `tp_room_status`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `room_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '房间状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_room_status
-- ----------------------------
INSERT INTO `tp_room_status` VALUES (1, '空房');
INSERT INTO `tp_room_status` VALUES (2, '在住房');
INSERT INTO `tp_room_status` VALUES (3, '净房');
INSERT INTO `tp_room_status` VALUES (4, '脏房');
INSERT INTO `tp_room_status` VALUES (5, '预定房');
INSERT INTO `tp_room_status` VALUES (6, '保留房');
INSERT INTO `tp_room_status` VALUES (7, '维修房');

SET FOREIGN_KEY_CHECKS = 1;
