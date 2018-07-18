USE terran;

DROP TABLE
IF EXISTS `banner`;

CREATE TABLE `banner` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR (50) DEFAULT NULL COMMENT 'Banner名称，通常作为标识',
	`description` VARCHAR (255) DEFAULT NULL COMMENT 'Banner描述',
	`delete_time` INT (11) DEFAULT NULL,
	`update_time` INT (11) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COMMENT = 'banner管理表';

INSERT INTO `banner`
VALUES
	(
		'1',
		'首页置顶',
		'首页轮播图',
		NULL,
		NULL
	);

DROP TABLE
IF EXISTS `banner_item`;

CREATE TABLE `banner_item` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`img_id` INT (11) NOT NULL COMMENT '外键，关联image表',
	`key_word` VARCHAR (100) NOT NULL COMMENT '执行关键字，根据不同的type含义不同',
	`type` TINYINT (4) NOT NULL DEFAULT '1' COMMENT '跳转类型，可能导向商品，可能导向专题，可能导向其他。0，无导向；1：导向商品;2:导向专题',
	`delete_time` INT (11) DEFAULT NULL,
	`banner_id` INT (11) NOT NULL COMMENT '外键，关联banner表',
	`update_time` INT (11) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 6 DEFAULT CHARSET = utf8mb4 COMMENT = 'banner子项表';

INSERT INTO `banner_item`
VALUES
	(
		'1',
		'65',
		'6',
		'1',
		NULL,
		'1',
		NULL
	);

INSERT INTO `banner_item`
VALUES
	(
		'2',
		'2',
		'25',
		'1',
		NULL,
		'1',
		NULL
	);

INSERT INTO `banner_item`
VALUES
	(
		'3',
		'3',
		'11',
		'1',
		NULL,
		'1',
		NULL
	);

INSERT INTO `banner_item`
VALUES
	(
		'5',
		'1',
		'10',
		'1',
		NULL,
		'1',
		NULL
	);

DROP TABLE
IF EXISTS `category`;

CREATE TABLE `category` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR (50) NOT NULL COMMENT '分类名称',
	`topic_img_id` INT (11) DEFAULT NULL COMMENT '外键，关联image表',
	`delete_time` INT (11) DEFAULT NULL,
	`description` VARCHAR (100) DEFAULT NULL COMMENT '描述',
	`update_time` INT (11) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 9 DEFAULT CHARSET = utf8mb4 COMMENT = '商品类目';

INSERT INTO `category`
VALUES
	(
		'2',
		'果味',
		'6',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `category`
VALUES
	(
		'3',
		'蔬菜',
		'5',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `category`
VALUES
	(
		'4',
		'炒货',
		'7',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `category`
VALUES
	(
		'5',
		'点心',
		'4',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `category`
VALUES
	(
		'6',
		'粗茶',
		'8',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `category`
VALUES
	(
		'7',
		'淡饭',
		'9',
		NULL,
		NULL,
		NULL
	);

DROP TABLE
IF EXISTS `image`;

CREATE TABLE `image` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`url` VARCHAR (255) NOT NULL COMMENT '图片路径',
	`from` TINYINT (4) NOT NULL DEFAULT '1' COMMENT '1 来自本地，2 来自公网',
	`delete_time` INT (11) DEFAULT NULL,
	`update_time` INT (11) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 70 DEFAULT CHARSET = utf8mb4 COMMENT = '图片总表';

INSERT INTO `image`
VALUES
	(
		'1',
		'/banner-1a.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'2',
		'/banner-2a.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'3',
		'/banner-3a.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'4',
		'/category-cake.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'5',
		'/category-vg.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'6',
		'/category-dryfruit.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'7',
		'/category-fry-a.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'8',
		'/category-tea.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'9',
		'/category-rice.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'10',
		'/product-dryfruit@1.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'13',
		'/product-vg@1.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'14',
		'/product-rice@6.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'16',
		'/1@theme.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'17',
		'/2@theme.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'18',
		'/3@theme.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'19',
		'/detail-1@1-dryfruit.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'20',
		'/detail-2@1-dryfruit.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'21',
		'/detail-3@1-dryfruit.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'22',
		'/detail-4@1-dryfruit.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'23',
		'/detail-5@1-dryfruit.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'24',
		'/detail-6@1-dryfruit.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'25',
		'/detail-7@1-dryfruit.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'26',
		'/detail-8@1-dryfruit.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'27',
		'/detail-9@1-dryfruit.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'28',
		'/detail-11@1-dryfruit.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'29',
		'/detail-10@1-dryfruit.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'31',
		'/product-rice@1.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'32',
		'/product-tea@1.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'33',
		'/product-dryfruit@2.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'36',
		'/product-dryfruit@3.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'37',
		'/product-dryfruit@4.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'38',
		'/product-dryfruit@5.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'39',
		'/product-dryfruit-a@6.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'40',
		'/product-dryfruit@7.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'41',
		'/product-rice@2.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'42',
		'/product-rice@3.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'43',
		'/product-rice@4.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'44',
		'/product-fry@1.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'45',
		'/product-fry@2.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'46',
		'/product-fry@3.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'47',
		'/product-tea@2.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'48',
		'/product-tea@3.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'49',
		'/1@theme-head.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'50',
		'/2@theme-head.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'51',
		'/3@theme-head.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'52',
		'/product-cake@1.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'53',
		'/product-cake@2.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'54',
		'/product-cake-a@3.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'55',
		'/product-cake-a@4.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'56',
		'/product-dryfruit@8.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'57',
		'/product-fry@4.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'58',
		'/product-fry@5.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'59',
		'/product-rice@5.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'60',
		'/product-rice@7.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'62',
		'/detail-12@1-dryfruit.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'63',
		'/detail-13@1-dryfruit.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'65',
		'/banner-4a.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'66',
		'/product-vg@4.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'67',
		'/product-vg@5.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'68',
		'/product-vg@2.png',
		'1',
		NULL,
		NULL
	);

INSERT INTO `image`
VALUES
	(
		'69',
		'/product-vg@3.png',
		'1',
		NULL,
		NULL
	);

DROP TABLE
IF EXISTS `order`;

CREATE TABLE `order` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`order_no` VARCHAR (20) NOT NULL COMMENT '订单号',
	`user_id` INT (11) NOT NULL COMMENT '外键，用户id，注意并不是openid',
	`delete_time` INT (11) DEFAULT NULL,
	`create_time` INT (11) DEFAULT NULL,
	`total_price` DECIMAL (6, 2) NOT NULL,
	`status` TINYINT (4) NOT NULL DEFAULT '1' COMMENT '1:未支付， 2：已支付，3：已发货 , 4: 已支付，但库存不足',
	`snap_img` VARCHAR (255) DEFAULT NULL COMMENT '订单快照图片',
	`snap_name` VARCHAR (80) DEFAULT NULL COMMENT '订单快照名称',
	`total_count` INT (11) NOT NULL DEFAULT '0',
	`update_time` INT (11) DEFAULT NULL,
	`snap_items` text COMMENT '订单其他信息快照（json)',
	`snap_address` VARCHAR (500) DEFAULT NULL COMMENT '地址快照',
	`prepay_id` VARCHAR (100) DEFAULT NULL COMMENT '订单微信支付的预订单id（用于发送模板消息）',
	PRIMARY KEY (`id`),
	UNIQUE KEY `order_no` (`order_no`),
	KEY `user_id` (`user_id`)
) ENGINE = INNODB AUTO_INCREMENT = 539 DEFAULT CHARSET = utf8mb4;

DROP TABLE
IF EXISTS `order_product`;

CREATE TABLE `order_product` (
	`order_id` INT (11) NOT NULL COMMENT '联合主键，订单id',
	`product_id` INT (11) NOT NULL COMMENT '联合主键，商品id',
	`count` INT (11) NOT NULL COMMENT '商品数量',
	`delete_time` INT (11) DEFAULT NULL,
	`update_time` INT (11) DEFAULT NULL,
	PRIMARY KEY (`product_id`, `order_id`)
) ENGINE = INNODB DEFAULT CHARSET = utf8mb4;

DROP TABLE
IF EXISTS `product`;

CREATE TABLE `product` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR (80) NOT NULL COMMENT '商品名称',
	`price` DECIMAL (6, 2) NOT NULL COMMENT '价格,单位：分',
	`stock` INT (11) NOT NULL DEFAULT '0' COMMENT '库存量',
	`delete_time` INT (11) DEFAULT NULL,
	`category_id` INT (11) DEFAULT NULL,
	`main_img_url` VARCHAR (255) DEFAULT NULL COMMENT '主图ID号，这是一个反范式设计，有一定的冗余',
	`from` TINYINT (4) NOT NULL DEFAULT '1' COMMENT '图片来自 1 本地 ，2公网',
	`create_time` INT (11) DEFAULT NULL COMMENT '创建时间',
	`update_time` INT (11) DEFAULT NULL,
	`summary` VARCHAR (50) DEFAULT NULL COMMENT '摘要',
	`img_id` INT (11) DEFAULT NULL COMMENT '图片外键',
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 34 DEFAULT CHARSET = utf8mb4;

INSERT INTO `product`
VALUES
	(
		'1',
		'芹菜 半斤',
		'0.01',
		'998',
		NULL,
		'3',
		'/product-vg@1.png',
		'1',
		NULL,
		NULL,
		NULL,
		'13'
	);

INSERT INTO `product`
VALUES
	(
		'2',
		'梨花带雨 3个',
		'0.01',
		'984',
		NULL,
		'2',
		'/product-dryfruit@1.png',
		'1',
		NULL,
		NULL,
		NULL,
		'10'
	);

INSERT INTO `product`
VALUES
	(
		'3',
		'素米 327克',
		'0.01',
		'996',
		NULL,
		'7',
		'/product-rice@1.png',
		'1',
		NULL,
		NULL,
		NULL,
		'31'
	);

INSERT INTO `product`
VALUES
	(
		'4',
		'红袖枸杞 6克*3袋',
		'0.01',
		'998',
		NULL,
		'6',
		'/product-tea@1.png',
		'1',
		NULL,
		NULL,
		NULL,
		'32'
	);

INSERT INTO `product`
VALUES
	(
		'5',
		'春生龙眼 500克',
		'0.01',
		'995',
		NULL,
		'2',
		'/product-dryfruit@2.png',
		'1',
		NULL,
		NULL,
		NULL,
		'33'
	);

INSERT INTO `product`
VALUES
	(
		'6',
		'小红的猪耳朵 120克',
		'0.01',
		'997',
		NULL,
		'5',
		'/product-cake@2.png',
		'1',
		NULL,
		NULL,
		NULL,
		'53'
	);

INSERT INTO `product`
VALUES
	(
		'7',
		'泥蒿 半斤',
		'0.01',
		'998',
		NULL,
		'3',
		'/product-vg@2.png',
		'1',
		NULL,
		NULL,
		NULL,
		'68'
	);

INSERT INTO `product`
VALUES
	(
		'8',
		'夏日芒果 3个',
		'0.01',
		'995',
		NULL,
		'2',
		'/product-dryfruit@3.png',
		'1',
		NULL,
		NULL,
		NULL,
		'36'
	);

INSERT INTO `product`
VALUES
	(
		'9',
		'冬木红枣 500克',
		'0.01',
		'996',
		NULL,
		'2',
		'/product-dryfruit@4.png',
		'1',
		NULL,
		NULL,
		NULL,
		'37'
	);

INSERT INTO `product`
VALUES
	(
		'10',
		'万紫千凤梨 300克',
		'0.01',
		'996',
		NULL,
		'2',
		'/product-dryfruit@5.png',
		'1',
		NULL,
		NULL,
		NULL,
		'38'
	);

INSERT INTO `product`
VALUES
	(
		'11',
		'贵妃笑 100克',
		'0.01',
		'994',
		NULL,
		'2',
		'/product-dryfruit-a@6.png',
		'1',
		NULL,
		NULL,
		NULL,
		'39'
	);

INSERT INTO `product`
VALUES
	(
		'12',
		'珍奇异果 3个',
		'0.01',
		'999',
		NULL,
		'2',
		'/product-dryfruit@7.png',
		'1',
		NULL,
		NULL,
		NULL,
		'40'
	);

INSERT INTO `product`
VALUES
	(
		'13',
		'绿豆 125克',
		'0.01',
		'999',
		NULL,
		'7',
		'/product-rice@2.png',
		'1',
		NULL,
		NULL,
		NULL,
		'41'
	);

INSERT INTO `product`
VALUES
	(
		'14',
		'芝麻 50克',
		'0.01',
		'999',
		NULL,
		'7',
		'/product-rice@3.png',
		'1',
		NULL,
		NULL,
		NULL,
		'42'
	);

INSERT INTO `product`
VALUES
	(
		'15',
		'猴头菇 370克',
		'0.01',
		'999',
		NULL,
		'7',
		'/product-rice@4.png',
		'1',
		NULL,
		NULL,
		NULL,
		'43'
	);

INSERT INTO `product`
VALUES
	(
		'16',
		'西红柿 1斤',
		'0.01',
		'999',
		NULL,
		'3',
		'/product-vg@3.png',
		'1',
		NULL,
		NULL,
		NULL,
		'69'
	);

INSERT INTO `product`
VALUES
	(
		'17',
		'油炸花生 300克',
		'0.01',
		'999',
		NULL,
		'4',
		'/product-fry@1.png',
		'1',
		NULL,
		NULL,
		NULL,
		'44'
	);

INSERT INTO `product`
VALUES
	(
		'18',
		'春泥西瓜子 128克',
		'0.01',
		'997',
		NULL,
		'4',
		'/product-fry@2.png',
		'1',
		NULL,
		NULL,
		NULL,
		'45'
	);

INSERT INTO `product`
VALUES
	(
		'19',
		'碧水葵花籽 128克',
		'0.01',
		'999',
		NULL,
		'4',
		'/product-fry@3.png',
		'1',
		NULL,
		NULL,
		NULL,
		'46'
	);

INSERT INTO `product`
VALUES
	(
		'20',
		'碧螺春 12克*3袋',
		'0.01',
		'999',
		NULL,
		'6',
		'/product-tea@2.png',
		'1',
		NULL,
		NULL,
		NULL,
		'47'
	);

INSERT INTO `product`
VALUES
	(
		'21',
		'西湖龙井 8克*3袋',
		'0.01',
		'998',
		NULL,
		'6',
		'/product-tea@3.png',
		'1',
		NULL,
		NULL,
		NULL,
		'48'
	);

INSERT INTO `product`
VALUES
	(
		'22',
		'梅兰清花糕 1个',
		'0.01',
		'997',
		NULL,
		'5',
		'/product-cake-a@3.png',
		'1',
		NULL,
		NULL,
		NULL,
		'54'
	);

INSERT INTO `product`
VALUES
	(
		'23',
		'清凉薄荷糕 1个',
		'0.01',
		'998',
		NULL,
		'5',
		'/product-cake-a@4.png',
		'1',
		NULL,
		NULL,
		NULL,
		'55'
	);

INSERT INTO `product`
VALUES
	(
		'25',
		'小明的妙脆角 120克',
		'0.01',
		'999',
		NULL,
		'5',
		'/product-cake@1.png',
		'1',
		NULL,
		NULL,
		NULL,
		'52'
	);

INSERT INTO `product`
VALUES
	(
		'26',
		'红衣青瓜 混搭160克',
		'0.01',
		'999',
		NULL,
		'2',
		'/product-dryfruit@8.png',
		'1',
		NULL,
		NULL,
		NULL,
		'56'
	);

INSERT INTO `product`
VALUES
	(
		'27',
		'锈色瓜子 100克',
		'0.01',
		'998',
		NULL,
		'4',
		'/product-fry@4.png',
		'1',
		NULL,
		NULL,
		NULL,
		'57'
	);

INSERT INTO `product`
VALUES
	(
		'28',
		'春泥花生 200克',
		'0.01',
		'999',
		NULL,
		'4',
		'/product-fry@5.png',
		'1',
		NULL,
		NULL,
		NULL,
		'58'
	);

INSERT INTO `product`
VALUES
	(
		'29',
		'冰心鸡蛋 2个',
		'0.01',
		'999',
		NULL,
		'7',
		'/product-rice@5.png',
		'1',
		NULL,
		NULL,
		NULL,
		'59'
	);

INSERT INTO `product`
VALUES
	(
		'30',
		'八宝莲子 200克',
		'0.01',
		'999',
		NULL,
		'7',
		'/product-rice@6.png',
		'1',
		NULL,
		NULL,
		NULL,
		'14'
	);

INSERT INTO `product`
VALUES
	(
		'31',
		'深涧木耳 78克',
		'0.01',
		'999',
		NULL,
		'7',
		'/product-rice@7.png',
		'1',
		NULL,
		NULL,
		NULL,
		'60'
	);

INSERT INTO `product`
VALUES
	(
		'32',
		'土豆 半斤',
		'0.01',
		'999',
		NULL,
		'3',
		'/product-vg@4.png',
		'1',
		NULL,
		NULL,
		NULL,
		'66'
	);

INSERT INTO `product`
VALUES
	(
		'33',
		'青椒 半斤',
		'0.01',
		'999',
		NULL,
		'3',
		'/product-vg@5.png',
		'1',
		NULL,
		NULL,
		NULL,
		'67'
	);

DROP TABLE
IF EXISTS `product_image`;

CREATE TABLE `product_image` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`img_id` INT (11) NOT NULL COMMENT '外键，关联图片表',
	`delete_time` INT (11) DEFAULT NULL COMMENT '状态，主要表示是否删除，也可以扩展其他状态',
	`order` INT (11) NOT NULL DEFAULT '0' COMMENT '图片排序序号',
	`product_id` INT (11) NOT NULL COMMENT '商品id，外键',
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 21 DEFAULT CHARSET = utf8mb4;

INSERT INTO `product_image`
VALUES
	('4', '19', NULL, '1', '11');

INSERT INTO `product_image`
VALUES
	('5', '20', NULL, '2', '11');

INSERT INTO `product_image`
VALUES
	('6', '21', NULL, '3', '11');

INSERT INTO `product_image`
VALUES
	('7', '22', NULL, '4', '11');

INSERT INTO `product_image`
VALUES
	('8', '23', NULL, '5', '11');

INSERT INTO `product_image`
VALUES
	('9', '24', NULL, '6', '11');

INSERT INTO `product_image`
VALUES
	('10', '25', NULL, '7', '11');

INSERT INTO `product_image`
VALUES
	('11', '26', NULL, '8', '11');

INSERT INTO `product_image`
VALUES
	('12', '27', NULL, '9', '11');

INSERT INTO `product_image`
VALUES
	('13', '28', NULL, '11', '11');

INSERT INTO `product_image`
VALUES
	('14', '29', NULL, '10', '11');

INSERT INTO `product_image`
VALUES
	('18', '62', NULL, '12', '11');

INSERT INTO `product_image`
VALUES
	('19', '63', NULL, '13', '11');

DROP TABLE
IF EXISTS `product_property`;

CREATE TABLE `product_property` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR (30) DEFAULT '' COMMENT '详情属性名称',
	`detail` VARCHAR (255) NOT NULL COMMENT '详情属性',
	`product_id` INT (11) NOT NULL COMMENT '商品id，外键',
	`delete_time` INT (11) DEFAULT NULL,
	`update_time` INT (11) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 10 DEFAULT CHARSET = utf8mb4;

INSERT INTO `product_property`
VALUES
	(
		'1',
		'品名',
		'杨梅',
		'11',
		NULL,
		NULL
	);

INSERT INTO `product_property`
VALUES
	(
		'2',
		'口味',
		'青梅味 雪梨味 黄桃味 菠萝味',
		'11',
		NULL,
		NULL
	);

INSERT INTO `product_property`
VALUES
	(
		'3',
		'产地',
		'火星',
		'11',
		NULL,
		NULL
	);

INSERT INTO `product_property`
VALUES
	(
		'4',
		'保质期',
		'180天',
		'11',
		NULL,
		NULL
	);

INSERT INTO `product_property`
VALUES
	(
		'5',
		'品名',
		'梨子',
		'2',
		NULL,
		NULL
	);

INSERT INTO `product_property`
VALUES
	(
		'6',
		'产地',
		'金星',
		'2',
		NULL,
		NULL
	);

INSERT INTO `product_property`
VALUES
	(
		'7',
		'净含量',
		'100g',
		'2',
		NULL,
		NULL
	);

INSERT INTO `product_property`
VALUES
	(
		'8',
		'保质期',
		'10天',
		'2',
		NULL,
		NULL
	);

DROP TABLE
IF EXISTS `theme`;

CREATE TABLE `theme` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR (50) NOT NULL COMMENT '专题名称',
	`description` VARCHAR (255) DEFAULT NULL COMMENT '专题描述',
	`topic_img_id` INT (11) NOT NULL COMMENT '主题图，外键',
	`delete_time` INT (11) DEFAULT NULL,
	`head_img_id` INT (11) NOT NULL COMMENT '专题列表页，头图',
	`update_time` INT (11) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8mb4 COMMENT = '主题信息表';

INSERT INTO `theme`
VALUES
	(
		'1',
		'专题栏位一',
		'美味水果世界',
		'16',
		NULL,
		'49',
		NULL
	);

INSERT INTO `theme`
VALUES
	(
		'2',
		'专题栏位二',
		'新品推荐',
		'17',
		NULL,
		'50',
		NULL
	);

INSERT INTO `theme`
VALUES
	(
		'3',
		'专题栏位三',
		'做个干物女',
		'18',
		NULL,
		'18',
		NULL
	);

DROP TABLE
IF EXISTS `theme_product`;

CREATE TABLE `theme_product` (
	`theme_id` INT (11) NOT NULL COMMENT '主题外键',
	`product_id` INT (11) NOT NULL COMMENT '商品外键',
	PRIMARY KEY (`theme_id`, `product_id`)
) ENGINE = INNODB DEFAULT CHARSET = utf8mb4 COMMENT = '主题所包含的商品';

INSERT INTO `theme_product`
VALUES
	('1', '2');

INSERT INTO `theme_product`
VALUES
	('1', '5');

INSERT INTO `theme_product`
VALUES
	('1', '8');

INSERT INTO `theme_product`
VALUES
	('1', '10');

INSERT INTO `theme_product`
VALUES
	('1', '12');

INSERT INTO `theme_product`
VALUES
	('2', '1');

INSERT INTO `theme_product`
VALUES
	('2', '2');

INSERT INTO `theme_product`
VALUES
	('2', '3');

INSERT INTO `theme_product`
VALUES
	('2', '5');

INSERT INTO `theme_product`
VALUES
	('2', '6');

INSERT INTO `theme_product`
VALUES
	('2', '16');

INSERT INTO `theme_product`
VALUES
	('2', '33');

INSERT INTO `theme_product`
VALUES
	('3', '15');

INSERT INTO `theme_product`
VALUES
	('3', '18');

INSERT INTO `theme_product`
VALUES
	('3', '19');

INSERT INTO `theme_product`
VALUES
	('3', '27');

INSERT INTO `theme_product`
VALUES
	('3', '30');

INSERT INTO `theme_product`
VALUES
	('3', '31');

DROP TABLE
IF EXISTS `third_app`;

CREATE TABLE `third_app` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`app_id` VARCHAR (64) NOT NULL COMMENT '应用app_id',
	`app_secret` VARCHAR (64) NOT NULL COMMENT '应用secret',
	`app_description` VARCHAR (100) DEFAULT NULL COMMENT '应用程序描述',
	`scope` VARCHAR (20) NOT NULL COMMENT '应用权限',
	`scope_description` VARCHAR (100) DEFAULT NULL COMMENT '权限描述',
	`delete_time` INT (11) DEFAULT NULL,
	`update_time` INT (11) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COMMENT = '访问API的各应用账号密码表';

INSERT INTO `third_app`
VALUES
	(
		'1',
		'starcraft',
		'777*777',
		'CMS',
		'32',
		'Super',
		NULL,
		NULL
	);

DROP TABLE
IF EXISTS `user`;

CREATE TABLE `user` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`openid` VARCHAR (50) NOT NULL,
	`profile_id` INT (11) NOT NULL,
	`nickname` VARCHAR (50) DEFAULT NULL,
	`main_img_url` VARCHAR (255) DEFAULT NULL COMMENT '主图ID号，这是一个反范式设计，有一定的冗余',
	`from` TINYINT (4) NOT NULL DEFAULT '1' COMMENT '图片来自 1 本地 ，2公网',
	`create_time` INT (11) DEFAULT NULL COMMENT '创建时间',
	`update_time` INT (11) DEFAULT NULL,
	`summary` VARCHAR (50) DEFAULT NULL COMMENT '摘要',
	`img_id` INT (11) DEFAULT NULL COMMENT '图片外键',	
	`user_login` VARCHAR (60) NOT NULL DEFAULT '' COMMENT '用户名',
	`user_pass` VARCHAR (64) NOT NULL DEFAULT '' COMMENT '登录密码；sp_password加密',
	`code` VARCHAR (104) NOT NULL DEFAULT '',
	`last_login_ip` VARCHAR (20) DEFAULT NULL COMMENT '最后登录ip',
	`last_login_time` INT (11) UNSIGNED NOT NULL DEFAULT 0,
	`user_email` VARCHAR (20) NOT NULL DEFAULT '' COMMENT '登录邮箱',
	`mobile` VARCHAR (20) NOT NULL DEFAULT '' COMMENT '手机号',
	`listorder` INT (8) UNSIGNED NOT NULL DEFAULT 0,
	`status` TINYINT (1) UNSIGNED NOT NULL DEFAULT 0,
	`extend` VARCHAR (255) DEFAULT NULL,
	`delete_time` INT (11) DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `openid` (`openid`)
) ENGINE = INNODB AUTO_INCREMENT = 58 DEFAULT CHARSET = utf8mb4;

DROP TABLE
IF EXISTS `profile`;

CREATE TABLE `profile` (
	`signature` VARCHAR (255) DEFAULT NULL COMMENT '个性签名',
	`user_url` VARCHAR (100) NOT NULL DEFAULT '' COMMENT '用户个人网站',
	`avatar` VARCHAR (255) DEFAULT NULL COMMENT '用户头像，相对于upload/avatar目录',
	`sex` SMALLINT (1) DEFAULT '0' COMMENT '性别；0：保密，1：男；2：女',
	`birthday` date DEFAULT '2000-01-01' COMMENT '生日',
	`user_activation_key` VARCHAR (60) NOT NULL DEFAULT '' COMMENT '激活码',
	`user_status` INT (11) NOT NULL DEFAULT '1' COMMENT '用户状态 0：禁用； 1：正常 ；2：未验证',
	`score` INT (11) NOT NULL DEFAULT '0' COMMENT '用户积分',
	`user_type` SMALLINT (1) DEFAULT '1' COMMENT '用户类型，1:admin ;2:会员;3:工程师;4:企业',
	`coin` INT (11) NOT NULL DEFAULT '0' COMMENT '金币',
	`leave_mobile` VARCHAR (50) DEFAULT NULL COMMENT '离职时保存手机号码',
	`unionid` VARCHAR (128) DEFAULT NULL COMMENT '第三方用户登录唯一凭证',
	`access_token` VARCHAR (655) DEFAULT NULL,
	`login_type` INT (2) NOT NULL DEFAULT '1' COMMENT '登录类型，1 微信登录',
	`user_money` DECIMAL (10, 2) DEFAULT '0.00' COMMENT '总金额',
	`frozen_money` DECIMAL (10, 2) NOT NULL DEFAULT '0.00' COMMENT '冻结金额',
	`address` VARCHAR (500) DEFAULT NULL COMMENT '地址',
	`qu_address` VARCHAR (255) DEFAULT NULL COMMENT '区域',
	`province_name` VARCHAR (125) DEFAULT NULL COMMENT '省份名称',
	`city_name` VARCHAR (125) DEFAULT NULL COMMENT '城市名称',
	`district_name` VARCHAR (125) DEFAULT NULL COMMENT '区/县',
	`user_rank` INT (3) DEFAULT '0' COMMENT '等级',
	`ipcode_j` VARCHAR (255) DEFAULT NULL,
	`ipcode_w` VARCHAR (255) DEFAULT NULL,
	`casual_user` INT (11) DEFAULT NULL,
	`qrcode` VARCHAR (200) DEFAULT NULL COMMENT '二维码链接',
	`isfollow` INT (2) NOT NULL DEFAULT '0' COMMENT '是否关注',
	`is_promoters` INT (2) NOT NULL DEFAULT '0' COMMENT '推广商 1',
	`delete_time` INT (11) DEFAULT NULL,
	`user_id` INT (11) NOT NULL COMMENT '外键',
	`update_time` INT (11) DEFAULT NULL
) ENGINE = INNODB AUTO_INCREMENT = 747 DEFAULT CHARSET = utf8mb4 COMMENT = '用户信息表';

DROP TABLE
IF EXISTS `user_address`;

CREATE TABLE `user_address` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR (30) NOT NULL COMMENT '收货人姓名',
	`mobile` VARCHAR (20) NOT NULL COMMENT '手机号',
	`province` VARCHAR (20) DEFAULT NULL COMMENT '省',
	`city` VARCHAR (20) DEFAULT NULL COMMENT '市',
	`country` VARCHAR (20) DEFAULT NULL COMMENT '区',
	`detail` VARCHAR (100) DEFAULT NULL COMMENT '详细地址',
	`delete_time` INT (11) DEFAULT NULL,
	`user_id` INT (11) NOT NULL COMMENT '外键',
	`update_time` INT (11) DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `user_id` (`user_id`)
) ENGINE = INNODB AUTO_INCREMENT = 35 DEFAULT CHARSET = utf8mb4;

DROP TABLE
IF EXISTS `servicecategory`;

CREATE TABLE `servicecategory` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR (50) NOT NULL COMMENT '分类名称',
	`topic_img_id` INT (11) DEFAULT NULL COMMENT '外键，关联image表',
	`delete_time` INT (11) DEFAULT NULL,
	`description` VARCHAR (100) DEFAULT NULL COMMENT '描述',
	`update_time` INT (11) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 9 DEFAULT CHARSET = utf8mb4 COMMENT = '服务类目';

INSERT INTO `servicecategory`
VALUES
	(
		'2',
		'家电维修',
		'6',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `servicecategory`
VALUES
	(
		'3',
		'家政保洁',
		'5',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `servicecategory`
VALUES
	(
		'4',
		'空气治理',
		'7',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `servicecategory`
VALUES
	(
		'5',
		'修锁换锁',
		'4',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `servicecategory`
VALUES
	(
		'6',
		'搬家拉货',
		'8',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `servicecategory`
VALUES
	(
		'7',
		'家电清洗',
		'9',
		NULL,
		NULL,
		NULL
	);

DROP TABLE
IF EXISTS `order_service`;

CREATE TABLE `order_service` (
	`order_id` INT (11) NOT NULL COMMENT '联合主键，订单id',
	`service_id` INT (11) NOT NULL COMMENT '联合主键，服务id',
	`delete_time` INT (11) DEFAULT NULL,
	`update_time` INT (11) DEFAULT NULL,
	PRIMARY KEY (`service_id`, `order_id`)
) ENGINE = INNODB DEFAULT CHARSET = utf8mb4;

DROP TABLE
IF EXISTS `service`;

CREATE TABLE `service` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR (80) NOT NULL COMMENT '服务名称',
	`delete_time` INT (11) DEFAULT NULL,
	`category_id` INT (11) DEFAULT NULL,
	`main_img_url` VARCHAR (255) DEFAULT NULL COMMENT '主图ID号，这是一个反范式设计，有一定的冗余',
	`from` TINYINT (4) NOT NULL DEFAULT '1' COMMENT '图片来自 1 本地 ，2公网',
	`create_time` INT (11) DEFAULT NULL COMMENT '创建时间',
	`update_time` INT (11) DEFAULT NULL,
	`summary` VARCHAR (50) DEFAULT NULL COMMENT '摘要',
	`img_id` INT (11) DEFAULT NULL COMMENT '图片外键',
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 34 DEFAULT CHARSET = utf8mb4;

INSERT INTO `service`
VALUES
	(
		'1',
		'空调',
		null,
		'1',
		'/service-vg@1.png',
		'1',
		NULL,
		NULL,
		NULL,
		'13'
	);

INSERT INTO `service`
VALUES
	(
		'2',
		'洗衣机',
		NULL,
		'1',
		'/service-dryfruit@1.png',
		'1',
		NULL,
		NULL,
		NULL,
		'10'
	);

INSERT INTO `service`
VALUES
	(
		'3',
		'电视机',
		NULL,
		'1',
		'/service-rice@1.png',
		'1',
		NULL,
		NULL,
		NULL,
		'31'
	);

INSERT INTO `service`
VALUES
	(
		'4',
		'电冰箱',
		NULL,
		'1',
		'/service-tea@1.png',
		'1',
		NULL,
		NULL,
		NULL,
		'32'
	);

INSERT INTO `service`
VALUES
	(
		'5',
		'除湿机',
		NULL,
		'1',
		'/service-dryfruit@2.png',
		'1',
		NULL,
		NULL,
		NULL,
		'33'
	);

INSERT INTO `service`
VALUES
	(
		'6',
		'油烟机',
		NULL,
		'1',
		'/service-cake@2.png',
		'1',
		NULL,
		NULL,
		NULL,
		'53'
	);

INSERT INTO `service`
VALUES
	(
		'7',
		'净水器',
		NULL,
		'1',
		'/service-vg@2.png',
		'1',
		NULL,
		NULL,
		NULL,
		'68'
	);

INSERT INTO `service`
VALUES
	(
		'8',
		'空气净化器',
		NULL,
		'1',
		'/service-dryfruit@3.png',
		'1',
		NULL,
		NULL,
		NULL,
		'36'
	);

INSERT INTO `service`
VALUES
	(
		'9',
		'电热水器',
		NULL,
		'1',
		'/service-dryfruit@4.png',
		'1',
		NULL,
		NULL,
		NULL,
		'37'
	);

INSERT INTO `service`
VALUES
	(
		'10',
		'燃气热水器',
		NULL,
		'1',
		'/service-dryfruit@5.png',
		'1',
		NULL,
		NULL,
		NULL,
		'38'
	);

INSERT INTO `service`
VALUES
	(
		'11',
		'太阳能热水器',
		NULL,
		'1',
		'/service-dryfruit-a@6.png',
		'1',
		NULL,
		NULL,
		NULL,
		'39'
	);

INSERT INTO `service`
VALUES
	(
		'12',
		'空气能热水器',
		NULL,
		'1',
		'/service-dryfruit@7.png',
		'1',
		NULL,
		NULL,
		NULL,
		'40'
	);

INSERT INTO `service`
VALUES
	(
		'13',
		'电脑',
		NULL,
		'1',
		'/service-rice@2.png',
		'1',
		NULL,
		NULL,
		NULL,
		'41'
	);

INSERT INTO `service`
VALUES
	(
		'14',
		'打印机',
		NULL,
		'1',
		'/service-rice@3.png',
		'1',
		NULL,
		NULL,
		NULL,
		'42'
	);

INSERT INTO `service`
VALUES
	(
		'15',
		'其他小家电',
		NULL,
		'1',
		'/service-rice@4.png',
		'1',
		NULL,
		NULL,
		NULL,
		'43'
	);

INSERT INTO `service`
VALUES
	(
		'16',
		'西红柿 1斤',
		NULL,
		'11',
		'/service-vg@3.png',
		'1',
		NULL,
		NULL,
		NULL,
		'69'
	);

INSERT INTO `service`
VALUES
	(
		'17',
		'油炸花生 300克',
		NULL,
		'11',
		'/service-fry@1.png',
		'1',
		NULL,
		NULL,
		NULL,
		'44'
	);

INSERT INTO `service`
VALUES
	(
		'18',
		'春泥西瓜子 128克',
		NULL,
		'4',
		'/service-fry@2.png',
		'1',
		NULL,
		NULL,
		NULL,
		'45'
	);

INSERT INTO `service`
VALUES
	(
		'19',
		'碧水葵花籽 128克',
		NULL,
		'4',
		'/service-fry@3.png',
		'1',
		NULL,
		NULL,
		NULL,
		'46'
	);

INSERT INTO `service`
VALUES
	(
		'20',
		'碧螺春 12克*3袋',
		NULL,
		'6',
		'/service-tea@2.png',
		'1',
		NULL,
		NULL,
		NULL,
		'47'
	);

INSERT INTO `service`
VALUES
	(
		'21',
		'西湖龙井 8克*3袋',
		NULL,
		'6',
		'/service-tea@3.png',
		'1',
		NULL,
		NULL,
		NULL,
		'48'
	);

INSERT INTO `service`
VALUES
	(
		'22',
		'梅兰清花糕 1个',
		NULL,
		'5',
		'/service-cake-a@3.png',
		'1',
		NULL,
		NULL,
		NULL,
		'54'
	);

INSERT INTO `service`
VALUES
	(
		'23',
		'清凉薄荷糕 1个',
		NULL,
		'5',
		'/service-cake-a@4.png',
		'1',
		NULL,
		NULL,
		NULL,
		'55'
	);

INSERT INTO `service`
VALUES
	(
		'25',
		'小明的妙脆角 120克',
		NULL,
		'5',
		'/service-cake@1.png',
		'1',
		NULL,
		NULL,
		NULL,
		'52'
	);

INSERT INTO `service`
VALUES
	(
		'26',
		'红衣青瓜 混搭160克',
		NULL,
		'2',
		'/service-dryfruit@8.png',
		'1',
		NULL,
		NULL,
		NULL,
		'56'
	);

INSERT INTO `service`
VALUES
	(
		'27',
		'锈色瓜子 100克',
		NULL,
		'4',
		'/service-fry@4.png',
		'1',
		NULL,
		NULL,
		NULL,
		'57'
	);

INSERT INTO `service`
VALUES
	(
		'28',
		'春泥花生 200克',
		NULL,
		'4',
		'/service-fry@5.png',
		'1',
		NULL,
		NULL,
		NULL,
		'58'
	);

INSERT INTO `service`
VALUES
	(
		'29',
		'冰心鸡蛋 2个',
		NULL,
		'7',
		'/service-rice@5.png',
		'1',
		NULL,
		NULL,
		NULL,
		'59'
	);

INSERT INTO `service`
VALUES
	(
		'30',
		'八宝莲子 200克',
		NULL,
		'7',
		'/service-rice@6.png',
		'1',
		NULL,
		NULL,
		NULL,
		'14'
	);

INSERT INTO `service`
VALUES
	(
		'31',
		'深涧木耳 78克',
		NULL,
		'7',
		'/service-rice@7.png',
		'1',
		NULL,
		NULL,
		NULL,
		'60'
	);

INSERT INTO `service`
VALUES
	(
		'32',
		'土豆 半斤',
		NULL,
		'3',
		'/service-vg@4.png',
		'1',
		NULL,
		NULL,
		NULL,
		'66'
	);

INSERT INTO `service`
VALUES
	(
		'33',
		'青椒 半斤',
		NULL,
		'3',
		'/service-vg@5.png',
		'1',
		NULL,
		NULL,
		NULL,
		'67'
	);

DROP TABLE
IF EXISTS `service_image`;

CREATE TABLE `service_image` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`img_id` INT (11) NOT NULL COMMENT '外键，关联图片表',
	`delete_time` INT (11) DEFAULT NULL COMMENT '状态，主要表示是否删除，也可以扩展其他状态',
	`order` INT (11) NOT NULL DEFAULT '0' COMMENT '图片排序序号',
	`service_id` INT (11) NOT NULL COMMENT '商品id，外键',
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 21 DEFAULT CHARSET = utf8mb4;

INSERT INTO `service_image`
VALUES
	('4', '19', NULL, '1', '11');

INSERT INTO `service_image`
VALUES
	('5', '20', NULL, '2', '11');

INSERT INTO `service_image`
VALUES
	('6', '21', NULL, '3', '11');

INSERT INTO `service_image`
VALUES
	('7', '22', NULL, '4', '11');

INSERT INTO `service_image`
VALUES
	('8', '23', NULL, '5', '11');

INSERT INTO `service_image`
VALUES
	('9', '24', NULL, '6', '11');

INSERT INTO `service_image`
VALUES
	('10', '25', NULL, '7', '11');

INSERT INTO `service_image`
VALUES
	('11', '26', NULL, '8', '11');

INSERT INTO `service_image`
VALUES
	('12', '27', NULL, '9', '11');

INSERT INTO `service_image`
VALUES
	('13', '28', NULL, '11', '11');

INSERT INTO `service_image`
VALUES
	('14', '29', NULL, '10', '11');

INSERT INTO `service_image`
VALUES
	('18', '62', NULL, '12', '11');

INSERT INTO `service_image`
VALUES
	('19', '63', NULL, '13', '11');

DROP TABLE
IF EXISTS `service_property`;

CREATE TABLE `service_property` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR (30) DEFAULT '' COMMENT '详情属性名称',
	`detail` VARCHAR (255) NOT NULL COMMENT '详情属性',
	`service_id` INT (11) NOT NULL COMMENT '服务id，外键',
	`delete_time` INT (11) DEFAULT NULL,
	`update_time` INT (11) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 10 DEFAULT CHARSET = utf8mb4;

INSERT INTO `service_property`
VALUES
	(
		'1',
		'上门时间',
		'2018/05/24',
		'1',
		NULL,
		NULL
	);

INSERT INTO `service_property`
VALUES
	(
		'2',
		'品牌',
		'青梅味 雪梨味 黄桃味 菠萝味',
		'11',
		NULL,
		NULL
	);

INSERT INTO `service_property`
VALUES
	(
		'3',
		'产地',
		'火星',
		'11',
		NULL,
		NULL
	);

INSERT INTO `service_property`
VALUES
	(
		'4',
		'保质期',
		'180天',
		'11',
		NULL,
		NULL
	);

INSERT INTO `service_property`
VALUES
	(
		'5',
		'品名',
		'梨子',
		'2',
		NULL,
		NULL
	);

INSERT INTO `service_property`
VALUES
	(
		'6',
		'产地',
		'金星',
		'2',
		NULL,
		NULL
	);

INSERT INTO `service_property`
VALUES
	(
		'7',
		'净含量',
		'100g',
		'2',
		NULL,
		NULL
	);

INSERT INTO `service_property`
VALUES
	(
		'8',
		'保质期',
		'10天',
		'2',
		NULL,
		NULL
	);

DROP TABLE
IF EXISTS `merchant`;

CREATE TABLE `merchant` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR (80) NOT NULL COMMENT '商户名称',
	`delete_time` INT (11) DEFAULT NULL,
	`main_img_url` VARCHAR (255) DEFAULT NULL COMMENT '主图ID号，这是一个反范式设计，有一定的冗余',
	`from` TINYINT (4) NOT NULL DEFAULT '1' COMMENT '图片来自 1 本地 ，2公网',
	`create_time` INT (11) DEFAULT NULL COMMENT '创建时间',
	`update_time` INT (11) DEFAULT NULL,
	`summary` VARCHAR (50) DEFAULT NULL COMMENT '摘要',
	`img_id` INT (11) DEFAULT NULL COMMENT '图片外键',
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 34 DEFAULT CHARSET = utf8mb4;

INSERT INTO `merchant`
VALUES
	(
		'1',
		'公司A',
		NULL,
		'/merchant-vg@1.png',
		'1',
		NULL,
		NULL,
		NULL,
		'13'
	);

INSERT INTO `merchant`
VALUES
	(
		'2',
		'公司B',
		NULL,
		'/merchant-dryfruit@1.png',
		'1',
		NULL,
		NULL,
		NULL,
		'10'
	);

INSERT INTO `merchant`
VALUES
	(
		'3',
		'公司C',
		NULL,
		'/merchant-rice@1.png',
		'1',
		NULL,
		NULL,
		NULL,
		'31'
	);

INSERT INTO `merchant`
VALUES
	(
		'4',
		'红袖枸杞 6克*3袋',
		NULL,
		'/merchant-tea@1.png',
		'1',
		NULL,
		NULL,
		NULL,
		'32'
	);

INSERT INTO `merchant`
VALUES
	(
		'5',
		'春生龙眼 500克',
		NULL,
		'/merchant-dryfruit@2.png',
		'1',
		NULL,
		NULL,
		NULL,
		'33'
	);

INSERT INTO `merchant`
VALUES
	(
		'6',
		'小红的猪耳朵 120克',
		NULL,
		'/merchant-cake@2.png',
		'1',
		NULL,
		NULL,
		NULL,
		'53'
	);

INSERT INTO `merchant`
VALUES
	(
		'7',
		'泥蒿 半斤',
		NULL,
		'/merchant-vg@2.png',
		'1',
		NULL,
		NULL,
		NULL,
		'68'
	);

INSERT INTO `merchant`
VALUES
	(
		'8',
		'夏日芒果 3个',
		NULL,
		'/merchant-dryfruit@3.png',
		'1',
		NULL,
		NULL,
		NULL,
		'36'
	);

DROP TABLE
IF EXISTS `merchant_image`;

CREATE TABLE `merchant_image` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`img_id` INT (11) NOT NULL COMMENT '外键，关联图片表',
	`delete_time` INT (11) DEFAULT NULL COMMENT '状态，主要表示是否删除，也可以扩展其他状态',
	`order` INT (11) NOT NULL DEFAULT '0' COMMENT '图片排序序号',
	`merchant_id` INT (11) NOT NULL COMMENT '商品id，外键',
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 21 DEFAULT CHARSET = utf8mb4;

INSERT INTO `merchant_image`
VALUES
	('4', '19', NULL, '1', '11');

INSERT INTO `merchant_image`
VALUES
	('5', '20', NULL, '2', '11');

INSERT INTO `merchant_image`
VALUES
	('6', '21', NULL, '3', '11');

INSERT INTO `merchant_image`
VALUES
	('7', '22', NULL, '4', '11');

INSERT INTO `merchant_image`
VALUES
	('8', '23', NULL, '5', '11');

INSERT INTO `merchant_image`
VALUES
	('9', '24', NULL, '6', '11');

INSERT INTO `merchant_image`
VALUES
	('10', '25', NULL, '7', '11');

INSERT INTO `merchant_image`
VALUES
	('11', '26', NULL, '8', '11');

INSERT INTO `merchant_image`
VALUES
	('12', '27', NULL, '9', '11');

INSERT INTO `merchant_image`
VALUES
	('13', '28', NULL, '11', '11');

INSERT INTO `merchant_image`
VALUES
	('14', '29', NULL, '10', '11');

INSERT INTO `merchant_image`
VALUES
	('18', '62', NULL, '12', '11');

INSERT INTO `merchant_image`
VALUES
	('19', '63', NULL, '13', '11');

DROP TABLE
IF EXISTS `merchant_property`;

CREATE TABLE `merchant_property` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR (30) DEFAULT '' COMMENT '详情属性名称',
	`detail` VARCHAR (255) NOT NULL COMMENT '详情属性',
	`merchant_id` INT (11) NOT NULL COMMENT '商品id，外键',
	`delete_time` INT (11) DEFAULT NULL,
	`update_time` INT (11) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 10 DEFAULT CHARSET = utf8mb4;

INSERT INTO `merchant_property`
VALUES
	(
		'1',
		'品名',
		'杨梅',
		'11',
		NULL,
		NULL
	);

INSERT INTO `merchant_property`
VALUES
	(
		'2',
		'口味',
		'青梅味 雪梨味 黄桃味 菠萝味',
		'11',
		NULL,
		NULL
	);

INSERT INTO `merchant_property`
VALUES
	(
		'3',
		'产地',
		'火星',
		'11',
		NULL,
		NULL
	);

INSERT INTO `merchant_property`
VALUES
	(
		'4',
		'保质期',
		'180天',
		'11',
		NULL,
		NULL
	);

INSERT INTO `merchant_property`
VALUES
	(
		'5',
		'品名',
		'梨子',
		'2',
		NULL,
		NULL
	);

INSERT INTO `merchant_property`
VALUES
	(
		'6',
		'产地',
		'金星',
		'2',
		NULL,
		NULL
	);

INSERT INTO `merchant_property`
VALUES
	(
		'7',
		'净含量',
		'100g',
		'2',
		NULL,
		NULL
	);

INSERT INTO `merchant_property`
VALUES
	(
		'8',
		'保质期',
		'10天',
		'2',
		NULL,
		NULL
	);

DROP TABLE
IF EXISTS `service_type`;

CREATE TABLE `service_type` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`description` VARCHAR (50) NOT NULL COMMENT '服务类型描述',
	`delete_time` INT (11) DEFAULT NULL COMMENT '状态，主要表示是否删除，也可以扩展其他状态',
	`service_id` INT (11) NOT NULL COMMENT '服务id，外键',
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 21 DEFAULT CHARSET = utf8mb4;

INSERT INTO `service_type` VALUES	('1', '移机', NULL, '1');

INSERT INTO `service_type` VALUES ('2', '漏水', NULL, '1');

INSERT INTO `service_type` VALUES	(		'3',		'不制冷',		NULL,		'1'	);

INSERT INTO `service_type` VALUES ('4','制冷效果不好',		NULL,		'1');

INSERT INTO `service_type` VALUES ('5', '漏电', NULL, '1');

INSERT INTO `service_type` VALUES	(		'6',		'不制热',		NULL,		'1');

INSERT INTO `service_type` VALUES ('7','制热效果不好',		NULL,		'1');

INSERT INTO `service_type` VALUES	('8', '结霜', NULL, '1');
INSERT INTO `service_type` VALUES		('9', '有噪音', NULL, '1');
INSERT INTO `service_type` VALUES (' 10 ', ' 中途停机 ',null, ' 1');
INSERT INTO `service_type` VALUES (' 11 ', ' 加雪种 ',null, ' 1 ');
INSERT INTO `service_type` VALUES (' 12 ', ' 开机跳闸 ',null, ' 1 ');
INSERT INTO `service_type` VALUES (' 13 ',' 安装 ',null, ' 2 ');
INSERT INTO `service_type` VALUES (' 14',' 其他 ',null, ' 2 ');

DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT ' 品牌名称 ',
  `delete_time` int(11) DEFAULT NULL COMMENT ' 状态，主要表示是否删除，也可以扩展其他状态 ',
  `service_id` int(11) NOT NULL COMMENT ' 服务id，外键 ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;


INSERT INTO `brand` VALUES (' 1 ',' 格力 ', null,' 1 ');
INSERT INTO `brand` VALUES (' 2 ',' 大金 ', null,' 1 ');
INSERT INTO `brand` VALUES (' 3 ',' 海尔 ', null,' 1 ');

DROP TABLE IF EXISTS `service_merchant`;
CREATE TABLE `service_merchant` (
  `service_id` int(11) NOT NULL COMMENT '联合主键，商户id',
  `merchand_id` int(11) NOT NULL COMMENT '联合主键，服务id',
  `delete_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`service_id`,`merchand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `service_merchant` VALUES (' 1 ',' 1 ',null,  null);
INSERT INTO `service_merchant` VALUES (' 2 ',' 1 ', null, null);
INSERT INTO `service_merchant` VALUES (' 3 ',' 1 ', null,null);
INSERT INTO `service_merchant` VALUES (' 1 ',' 2 ',null,  null);
INSERT INTO `service_merchant` VALUES (' 2 ',' 3 ', null, null);
DROP TABLE IF EXISTS `service_merchant_brand`;
CREATE TABLE `service_merchant_brand` (
  `service_id` int(11) NOT NULL COMMENT '联合主键，商户id',
  `merchand_id` int(11) NOT NULL COMMENT '联合主键，服务id',
  `brand_id` int(11) NOT NULL COMMENT '联合主键，品牌id',
  `delete_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`service_id`,`merchand_id`,`brand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `service_merchant_brand` VALUES (' 1 ',' 1 ',' 1 ',null,  null);
INSERT INTO `service_merchant_brand` VALUES (' 2 ',' 1 ', ' 1 ',null, null);
INSERT INTO `service_merchant_brand` VALUES (' 3 ',' 1 ', ' 1 ',null,null);
INSERT INTO `service_merchant_brand` VALUES (' 1 ',' 2 ',' 1 ',null,  null);
INSERT INTO `service_merchant_brand` VALUES (' 2 ',' 3 ',' 1 ', null, null);


DROP TABLE
IF EXISTS `business`;

CREATE TABLE `business` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`service_id` VARCHAR (80) NOT NULL COMMENT '服务id,外键',
	`servicetable_id`  INT (11) NOT NULL   COMMENT '商户id',
	`servicetable_type`  VARCHAR (25) NOT NULL   COMMENT '商户类型表',
	`delete_time` INT (11) DEFAULT NULL,
	`create_time` INT (11) DEFAULT NULL COMMENT '创建时间',
	`update_time` INT (11) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 34 DEFAULT CHARSET = utf8mb4;

INSERT INTO `business`
VALUES
	(
		'1',
		'1',
		'1',
    'user',
		null,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'2',
		'2',
		'1',
    'user',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'3',
		'3',
		'1',
       'user',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'4',
		'4',
		'1',
    'user',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'5',
		'5',
		'1',
    'user',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'6',
		'6',
		'1',
    'user',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'7',
		'2',
		'1',
    'user',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'8',
		'2',
		'1',
    'user',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'9',
		'3',
		'1',
    'user',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'10',
		'10',
		'1',
    'user',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'11',
		'3',
		'1',
    'user',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'12',
		'4',
		'1',
    'user',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'13',
		'14',
		'1',
    'user',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'14',
		'15',
		'1',
    'user',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'15',
		'15',
		'1',
    'user',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'16',
		'16',
		'2',
    'user',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'17',
		'2',
		'2',
    'user',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'18',
		'12',
		'2',
    'merchant',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'19',
		'11',
		'2',
    'merchant',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'20',
		'2',
		'2',
    'merchant',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'21',
		'2',
		'2',
    'merchant',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'22',
		'12',
		'2',
    'merchant',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'23',
		'23',
		'2',
    'merchant',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'25',
		'11',
		'2',
    'merchant',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'26',
		'22',
		'2',
    'merchant',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'27',
		'22',
		'2',
    'merchant',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'28',
		'12',
		'2',
    'merchant',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'29',
		'13',
		'2',
    'merchant',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'30',
		'14',
		'2',
    'merchant',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'31',
		'15',
		'2',
    'merchant',
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'32',
		'16',
		'2',
    'merchant',	
		NULL,
		NULL,
		NULL
	);

INSERT INTO `business`
VALUES
	(
		'33',
		'12',
		'2',
    'merchant',
		NULL,
		NULL,
		NULL
	);


DROP TABLE IF EXISTS `serviceorder`;
CREATE TABLE `serviceorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(20) NOT NULL COMMENT '订单号',
  `user_id` int(11) NOT NULL COMMENT '外键，用户id，注意并不是openid',
  `service_id` int(11) NOT NULL COMMENT '外键，服务id',
  `delete_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0.新提交 1.受理中 2.暂停中 3.待付款 4.待评价 5.已评价  6.已取消 7.申请取消中 8.已取消（可激活）9.已取消（超时）',
  `snap_img` varchar(255) DEFAULT NULL COMMENT '订单快照图片',
  `snap_name` varchar(80) DEFAULT NULL COMMENT '订单快照名称',
  `snapServiceName` varchar(50) DEFAULT NULL COMMENT '服务名称快照名称',
  `snapServiceType` varchar(50) DEFAULT NULL COMMENT '服务类型快照名称',
  `snapWarranty` varchar(50) DEFAULT NULL COMMENT '保修期快照名称',
  `snapBrandName` varchar(50) DEFAULT NULL COMMENT '品牌快照名称',
  `snapDelegateType` varchar(50) DEFAULT NULL COMMENT '委派订单快照名称',
  `snapArriveTime` varchar(50) DEFAULT NULL COMMENT '上门服务快照名称',
  `update_time` int(11) DEFAULT NULL,
  `snap_address` varchar(500) DEFAULT NULL COMMENT '地址快照',
  `prepay_id` varchar(100) DEFAULT NULL COMMENT '订单微信支付的预订单id（用于发送模板消息）',
  `pay_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:未支付， 2：已支付',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_no` (`order_no`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
SET FOREIGN_KEY_CHECKS=1;
-- ----------------------------
-- Records of order
-- ----------------------------

DROP TABLE
IF EXISTS `order_image`;

CREATE TABLE `order_image` (
	`id` INT (11) NOT NULL AUTO_INCREMENT,
	`img_id` INT (11) NOT NULL COMMENT '外键，关联图片表',
	`delete_time` INT (11) DEFAULT NULL COMMENT '状态，主要表示是否删除，也可以扩展其他状态',
	`order` INT (11) NOT NULL DEFAULT '0' COMMENT '图片排序序号',
	`order_id` INT (11) NOT NULL COMMENT '订单id，外键',
	PRIMARY KEY (`id`)
) ENGINE = INNODB AUTO_INCREMENT = 21 DEFAULT CHARSET = utf8mb4;

INSERT INTO `order_image`
VALUES
	('4', '19', NULL, '1', '11');

INSERT INTO `order_image`
VALUES
	('5', '20', NULL, '2', '11');

INSERT INTO `order_image`
VALUES
	('6', '21', NULL, '3', '11');

INSERT INTO `order_image`
VALUES
	('7', '22', NULL, '4', '11');

INSERT INTO `order_image`
VALUES
	('8', '23', NULL, '5', '11');

INSERT INTO `order_image`
VALUES
	('9', '24', NULL, '6', '11');

INSERT INTO `order_image`
VALUES
	('10', '25', NULL, '7', '11');

INSERT INTO `order_image`
VALUES
	('11', '26', NULL, '8', '11');

INSERT INTO `order_image`
VALUES
	('12', '27', NULL, '9', '11');

INSERT INTO `order_image`
VALUES
	('13', '28', NULL, '11', '11');

INSERT INTO `order_image`
VALUES
	('14', '29', NULL, '10', '11');

INSERT INTO `order_image`
VALUES
	('18', '62', NULL, '12', '11');

INSERT INTO `order_image`
VALUES
	('19', '63', NULL, '13', '11');
