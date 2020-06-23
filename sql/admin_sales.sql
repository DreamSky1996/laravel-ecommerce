/*
 Navicat Premium Data Transfer

 Source Server         : DB
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : admin_sales

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 21/06/2020 11:43:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'Playground Equipment', '2020-06-03 12:16:54', '2020-06-19 14:17:21');
INSERT INTO `categories` VALUES (2, 'Firewood', '2020-06-03 12:17:01', '2020-06-19 14:17:29');
INSERT INTO `categories` VALUES (3, 'Mulch', '2020-06-03 12:44:37', '2020-06-19 14:17:43');

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstName` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `City` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Province` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PostalCode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_Address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_City` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_Province` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_PostalCode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1, 'test', 'lastName', 'test@gmail.com', 'address1', 'city1', 'province1', '5000', 'shipping address1', 'shipping city1', 'shipping  province1', '4500', '900000000', '2020-06-21 11:34:55', '2020-06-21 12:09:18');
INSERT INTO `customers` VALUES (2, 'test1', 'lastName1', 'test1@gmail.com', 'address1', 'city1', 'province1', '4500', 'shipping address1', 'shipping city1', 'shipping  province1', '5000', '900000000', '2020-06-21 18:37:12', '2020-06-21 18:37:12');

-- ----------------------------
-- Table structure for geo_histories
-- ----------------------------
DROP TABLE IF EXISTS `geo_histories`;
CREATE TABLE `geo_histories`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `Latitude` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `geo_histories_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `geo_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of geo_histories
-- ----------------------------
INSERT INTO `geo_histories` VALUES (1, 1, '67.1514624', '32.4108288', '2020-06-21 11:39:05', '2020-06-21 11:39:05');
INSERT INTO `geo_histories` VALUES (2, 1, '67.1514624', '32.4108288', '2020-06-21 18:37:26', '2020-06-21 18:37:26');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (19, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (20, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (21, '2018_12_23_120000_create_shoppingcart_table', 1);
INSERT INTO `migrations` VALUES (22, '2020_05_28_033025_create_products_table', 1);
INSERT INTO `migrations` VALUES (23, '2020_06_03_154514_create_categories_table', 1);
INSERT INTO `migrations` VALUES (24, '2020_06_11_001007_create_customers_table', 1);
INSERT INTO `migrations` VALUES (25, '2020_06_11_030831_create_orders_table', 1);
INSERT INTO `migrations` VALUES (26, '2020_06_11_030901_create_order_items_table', 1);
INSERT INTO `migrations` VALUES (27, '2020_06_11_143052_create_geo_histories_table', 1);

-- ----------------------------
-- Table structure for order_items
-- ----------------------------
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` decimal(20, 6) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_items_order_id_index`(`order_id`) USING BTREE,
  INDEX `order_items_product_id_index`(`product_id`) USING BTREE,
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_items
-- ----------------------------
INSERT INTO `order_items` VALUES (1, 1, 2, 2, 200.000000, '2020-06-21 11:34:55', '2020-06-21 11:34:55');
INSERT INTO `order_items` VALUES (2, 2, 4, 1, 300.000000, '2020-06-21 18:37:12', '2020-06-21 18:37:12');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Delivered','Hold','Cancel') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Hold',
  `grand_total` decimal(20, 6) NOT NULL,
  `item_count` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `orders_order_number_unique`(`order_number`) USING BTREE,
  INDEX `orders_customer_id_foreign`(`customer_id`) USING BTREE,
  CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (1, '$2y$10$9mzVYAnWX2NS00SgRJWLcODVpM335Q7.0XrHmSjV6Z3A4PIWU9mtK', 1, 'Hold', 400.000000, 1, 'test', 'lastName', 'address1', 'city1', 'province1', '5000', '900000000', NULL, '2020-06-21 11:34:55', '2020-06-21 11:34:55');
INSERT INTO `orders` VALUES (2, '$2y$10$ycXW16DdpSmkgTy7RKNSoeODCUzigr1vQwLyReaWII00nddokU.US', 2, 'Hold', 300.000000, 1, 'test1', 'lastName1', 'address1', 'city1', 'province1', '4500', '900000000', NULL, '2020-06-21 18:37:12', '2020-06-21 18:37:12');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `inventory` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `geofence` double NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `product_category` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'Play Logs', '1592034536.1592032442.1591904553.product.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vestibulum fermentum elementum. Ut dictum lacus mattis, volutpat erat eget, hendrerit elit. Vestibulum eleifend eros non ligula semper vestibulum. Nulla facilisi. Sed quis magna ac ex ultrices dictum euismod et velit. Phasellus vitae nisi risus. Proin vitae euismod nisi, non faucibus lectus. Nunc eu enim id purus ultrices varius. Aenean sapien enim, malesuada cursus viverra luctus, fermentum nec velit. Proin luctus vel ex id rutrum.', '200', '10', 100, 1, 'Playground Equipment', '2020-06-03 12:17:58', '2020-06-19 14:17:55');
INSERT INTO `products` VALUES (2, 'Play Logs 2', '1591904529.product.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vestibulum fermentum elementum. Ut dictum lacus mattis, volutpat erat eget, hendrerit elit. Vestibulum eleifend eros non ligula semper vestibulum. Nulla facilisi. Sed quis magna ac ex ultrices dictum euismod et velit. Phasellus vitae nisi risus. Proin vitae euismod nisi, non faucibus lectus. Nunc eu enim id purus ultrices varius. Aenean sapien enim, malesuada cursus viverra luctus, fermentum nec velit. Proin luctus vel ex id rutrum.', '200', '10', 50, 1, 'Playground Equipment', '2020-06-03 12:24:26', '2020-06-19 14:18:00');
INSERT INTO `products` VALUES (3, 'Specialty Logs', '1591904553.product.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vestibulum fermentum elementum. Ut dictum lacus mattis, volutpat erat eget, hendrerit elit. Vestibulum eleifend eros non ligula semper vestibulum. Nulla facilisi. Sed quis magna ac ex ultrices dictum euismod et velit. Phasellus vitae nisi risus. Proin vitae euismod nisi, non faucibus lectus. Nunc eu enim id purus ultrices varius. Aenean sapien enim, malesuada cursus viverra luctus, fermentum nec velit. Proin luctus vel ex id rutrum.', '200', '10', 200, 1, 'Firewood', '2020-06-03 12:42:43', '2020-06-19 14:19:14');
INSERT INTO `products` VALUES (4, 'Great Firewood', '1591908116.product.jpg', 'lipsum', '300', '12', 300, 1, 'Firewood', '2020-06-11 13:41:56', '2020-06-19 14:19:04');
INSERT INTO `products` VALUES (5, 'Test Product', '1592576165.1591904553.product.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed luctus molestie erat a tristique. Integer vehicula ex sit amet aliquet vestibulum. Vestibulum a quam eget libero vulputate molestie at et nisi. Fusce iaculis turpis non viverra facilisis. Aliquam sagittis accumsan ipsum, sit amet tincidunt tortor viverra in. Curabitur eget felis at arcu fermentum tincidunt et sed lacus. Sed dictum tortor ex, a ultrices augue ultricies et. Aenean a nulla eget orci imperdiet pulvinar. Aliquam dapibus turpis id est scelerisque, eu malesuada ligula porttitor. Nullam eget leo enim. Donec maximus semper porta. Suspendisse aliquam diam non dictum iaculis. Mauris sed sem sed diam sollicitudin accumsan eget lacinia nunc. Maecenas vestibulum nunc vel eros volutpat molestie. Sed maximus rhoncus mollis. Curabitur rhoncus in arcu ut egestas.', '400', '22', 10, 1, 'Mulch', '2020-06-19 14:16:05', '2020-06-19 14:18:15');
INSERT INTO `products` VALUES (6, 'Fine Mulch', '1592576320.1591904553.product.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed luctus molestie erat a tristique. Integer vehicula ex sit amet aliquet vestibulum. Vestibulum a quam eget libero vulputate molestie at et nisi. Fusce iaculis turpis non viverra facilisis. Aliquam sagittis accumsan ipsum, sit amet tincidunt tortor viverra in. Curabitur eget felis at arcu fermentum tincidunt et sed lacus. Sed dictum tortor ex, a ultrices augue ultricies et. Aenean a nulla eget orci imperdiet pulvinar. Aliquam dapibus turpis id est scelerisque, eu malesuada ligula porttitor. Nullam eget leo enim. Donec maximus semper porta. Suspendisse aliquam diam non dictum iaculis. Mauris sed sem sed diam sollicitudin accumsan eget lacinia nunc. Maecenas vestibulum nunc vel eros volutpat molestie. Sed maximus rhoncus mollis. Curabitur rhoncus in arcu ut egestas.', '50', '22', 10, 1, 'Mulch', '2020-06-19 14:18:40', '2020-06-19 14:18:51');

-- ----------------------------
-- Table structure for shoppingcart
-- ----------------------------
DROP TABLE IF EXISTS `shoppingcart`;
CREATE TABLE `shoppingcart`  (
  `identifier` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `instance` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`identifier`, `instance`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shoppingcart
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `loginTime` datetime(0) NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Truetimber', 'Admin', 'Admin', 'teleofilms@gmail.com', '8046771456', '12.31232, 13.34544', NULL, '$2y$10$uwaA.KeaUMBisLENq0.Q6.wEOkIOl3FvQfF4DMZLbA8GaqRnY.6T6', '2020-06-21 18:37:26', 'ih0JVuU3fTwjx4DRdEH2OqwUyVloiHYQw2DjWLxOcVW7gY76BXXF3eBcIiDj', '2020-06-03 12:16:06', '2020-06-21 18:37:26');
INSERT INTO `users` VALUES (4, 'SmithYang1', 'Normal', 'customer', 'test01@gmail.com', '9889889889', '37.5204824,-77.4874497', NULL, '$2y$10$kxqdtYZtBwt/UoYcgZJRNeZTIC9CIet72NUhikCXa6wErN8wmYrHu', NULL, NULL, '2020-06-12 07:00:47', '2020-06-19 15:34:36');
INSERT INTO `users` VALUES (5, 'SmithYang2', 'Normal', 'member', 'test02@gmail.com', '9889889889', '37.3234947,-122.0215001', NULL, '$2y$10$Oks7E3yCRaUmR6hRzXVDHepXjYee0qIm8YR3Jl2mTaAlyvVFz4fyG', NULL, NULL, '2020-06-12 07:03:53', '2020-06-12 07:03:53');
INSERT INTO `users` VALUES (6, 'Test', 'test last', 'customer', 'test1231@gmail.com', '9999999999', '0,0', NULL, '$2y$10$./ODvlLRhYg0B9B2lnhuQelx1b3FvNvyRG/rSlEb61saOf5M4C5Um', NULL, NULL, '2020-06-20 02:10:17', '2020-06-19 14:19:39');

-- ----------------------------
-- View structure for productsaletable
-- ----------------------------
DROP VIEW IF EXISTS `productsaletable`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `productsaletable` AS SELECT
	products.id, 
	products.product_name, 
	products.product_category, 
	order_items.quantity, 
	orders.address, 
	orders.city, 
	orders.created_at, 
	orders.id as order_id
FROM
	products
	INNER JOIN
	order_items
	ON 
		products.id = order_items.product_id
	INNER JOIN
	orders
	ON 
		order_items.order_id = orders.id ;

SET FOREIGN_KEY_CHECKS = 1;
