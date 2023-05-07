/*
 Navicat Premium Data Transfer

 Source Server         : Localconnection
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : sol_point_db

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 07/05/2023 19:53:20
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for attendances
-- ----------------------------
DROP TABLE IF EXISTS `attendances`;
CREATE TABLE `attendances`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int NOT NULL,
  `user_id` int NOT NULL,
  `attendance_date` date NOT NULL,
  `attendance_status` tinyint NULL DEFAULT NULL,
  `leave_category_id` int NULL DEFAULT NULL,
  `check_in` time NULL DEFAULT NULL,
  `check_out` time NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of attendances
-- ----------------------------

-- ----------------------------
-- Table structure for award_categories
-- ----------------------------
DROP TABLE IF EXISTS `award_categories`;
CREATE TABLE `award_categories`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int NOT NULL,
  `award_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `publication_status` tinyint NOT NULL,
  `deletion_status` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of award_categories
-- ----------------------------

-- ----------------------------
-- Table structure for bonuses
-- ----------------------------
DROP TABLE IF EXISTS `bonuses`;
CREATE TABLE `bonuses`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int NOT NULL,
  `user_id` int NOT NULL,
  `bonus_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bonus_month` date NOT NULL,
  `bonus_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bonus_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deletion_status` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of bonuses
-- ----------------------------

-- ----------------------------
-- Table structure for client_types
-- ----------------------------
DROP TABLE IF EXISTS `client_types`;
CREATE TABLE `client_types`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int NOT NULL,
  `client_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_type_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `publication_status` tinyint NOT NULL,
  `deletion_status` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `client_types_client_type_unique`(`client_type` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of client_types
-- ----------------------------

-- ----------------------------
-- Table structure for contacts
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of contacts
-- ----------------------------

-- ----------------------------
-- Table structure for deductions
-- ----------------------------
DROP TABLE IF EXISTS `deductions`;
CREATE TABLE `deductions`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int NOT NULL,
  `user_id` int NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deduction_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deduction_month` date NOT NULL,
  `deduction_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deduction_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deletion_status` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of deductions
-- ----------------------------
INSERT INTO `deductions` VALUES (14, 1, 102, 'allowance', 'Overtime', '2023-05-01', '4000', 'Worked for extra 40 hours', 0, '2023-05-01 18:01:48', '2023-05-01 18:01:48');
INSERT INTO `deductions` VALUES (15, 1, 105, 'allowance', 'oVERTIME', '2023-05-01', '6000', 'Overtime', 0, '2023-05-04 10:17:48', '2023-05-04 10:17:48');

-- ----------------------------
-- Table structure for departments
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int NOT NULL,
  `department` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `publication_status` tinyint NOT NULL,
  `deletion_status` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `departments_department_unique`(`department` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO `departments` VALUES (1, 1, 'Administration', 'ADMIN', 1, 0, '2023-04-28 13:04:06', NULL);
INSERT INTO `departments` VALUES (5, 1, 'IT Technicians', 'All IT Techs', 1, 0, '2023-05-01 17:42:08', '2023-05-01 17:42:08');
INSERT INTO `departments` VALUES (6, 1, 'Engineering', 'Engineers', 1, 0, '2023-05-01 17:42:36', '2023-05-01 17:42:36');

-- ----------------------------
-- Table structure for designations
-- ----------------------------
DROP TABLE IF EXISTS `designations`;
CREATE TABLE `designations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int NOT NULL,
  `department_id` int NOT NULL,
  `designation` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `publication_status` tinyint NOT NULL,
  `deletion_status` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `designations_designation_unique`(`designation` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of designations
-- ----------------------------
INSERT INTO `designations` VALUES (1, 1, 1, 'Master', 'Master', 1, 0, '2023-04-28 13:04:36', NULL);
INSERT INTO `designations` VALUES (4, 1, 5, 'System Developer', 'System Development', 1, 0, '2023-05-01 17:43:42', '2023-05-01 17:43:42');

-- ----------------------------
-- Table structure for employee_awards
-- ----------------------------
DROP TABLE IF EXISTS `employee_awards`;
CREATE TABLE `employee_awards`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int NOT NULL,
  `employee_id` int NOT NULL,
  `award_category_id` int NOT NULL,
  `gift_item` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `select_month` date NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `publication_status` tinyint NOT NULL,
  `deletion_status` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of employee_awards
-- ----------------------------

-- ----------------------------
-- Table structure for exp_purposes
-- ----------------------------
DROP TABLE IF EXISTS `exp_purposes`;
CREATE TABLE `exp_purposes`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `exp_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of exp_purposes
-- ----------------------------

-- ----------------------------
-- Table structure for expence_managements
-- ----------------------------
DROP TABLE IF EXISTS `expence_managements`;
CREATE TABLE `expence_managements`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int NOT NULL,
  `employee_id` int NOT NULL,
  `item_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `purchased_from` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `purchased_date` date NOT NULL,
  `amount_spent` int NOT NULL,
  `purchased_details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `deletion_status` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of expence_managements
-- ----------------------------

-- ----------------------------
-- Table structure for files
-- ----------------------------
DROP TABLE IF EXISTS `files`;
CREATE TABLE `files`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int NOT NULL,
  `folder_id` int NOT NULL,
  `caption` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `publication_status` tinyint NULL DEFAULT NULL,
  `deletion_status` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of files
-- ----------------------------

-- ----------------------------
-- Table structure for folders
-- ----------------------------
DROP TABLE IF EXISTS `folders`;
CREATE TABLE `folders`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int NOT NULL,
  `folder_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `folder_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `publication_status` tinyint NOT NULL,
  `deletion_status` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of folders
-- ----------------------------

-- ----------------------------
-- Table structure for general_settings
-- ----------------------------
DROP TABLE IF EXISTS `general_settings`;
CREATE TABLE `general_settings`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `updated_by` int NOT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_one` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_two` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `web` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of general_settings
-- ----------------------------
INSERT INTO `general_settings` VALUES (1, 1, 'Test', 'admin@admin.com', 'admin address', 'test', '123123', 'https://www.nanlinecompany.co.ke/', '0', NULL, NULL);

-- ----------------------------
-- Table structure for holidays
-- ----------------------------
DROP TABLE IF EXISTS `holidays`;
CREATE TABLE `holidays`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int NOT NULL,
  `holiday_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `publication_status` tinyint NOT NULL,
  `deletion_status` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of holidays
-- ----------------------------

-- ----------------------------
-- Table structure for increments
-- ----------------------------
DROP TABLE IF EXISTS `increments`;
CREATE TABLE `increments`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_by` int NULL DEFAULT NULL,
  `amount` double NULL DEFAULT NULL,
  `emp_id` int NULL DEFAULT NULL,
  `date` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `incr_purpose` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of increments
-- ----------------------------

-- ----------------------------
-- Table structure for leave_applications
-- ----------------------------
DROP TABLE IF EXISTS `leave_applications`;
CREATE TABLE `leave_applications`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int NOT NULL,
  `leave_category_id` int NOT NULL,
  `last_leave_category_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `last_leave_period` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `leave_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_leave_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `during_leave` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `publication_status` tinyint NOT NULL DEFAULT 0,
  `deletion_status` tinyint NOT NULL DEFAULT 0,
  `leave_count` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of leave_applications
-- ----------------------------
INSERT INTO `leave_applications` VALUES (1, 102, 3, NULL, NULL, '2023-05-03', '2023-05-03', NULL, NULL, 'Personal activities', 'I kindly request hal', 1, 0, '0', '2023-05-03 13:34:21', '2023-05-03 18:09:05');
INSERT INTO `leave_applications` VALUES (2, 1, 3, NULL, NULL, '2023-05-03', '2023-05-03', NULL, NULL, 'Test', 'test', 1, 0, '0.5', '2023-05-03 18:18:13', '2023-05-03 18:20:56');
INSERT INTO `leave_applications` VALUES (3, 1, 3, NULL, NULL, '2023-05-03', '2023-05-03', NULL, NULL, 'tewts', 'test', 0, 0, '0.5', '2023-05-03 18:21:17', '2023-05-03 18:21:17');
INSERT INTO `leave_applications` VALUES (4, 102, 1, NULL, NULL, '2023-05-08', '2023-05-08', NULL, NULL, 'Visit Daktari', 'please allow me to g', 0, 0, '0.5', '2023-05-05 22:42:42', '2023-05-05 22:42:42');

-- ----------------------------
-- Table structure for leave_categories
-- ----------------------------
DROP TABLE IF EXISTS `leave_categories`;
CREATE TABLE `leave_categories`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int NOT NULL,
  `leave_category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `leave_category_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `leave_days` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '0',
  `publication_status` tinyint NOT NULL,
  `deletion_status` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `leave_categories_leave_category_unique`(`leave_category` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of leave_categories
-- ----------------------------
INSERT INTO `leave_categories` VALUES (1, 1, 'Sick Leave', 'Sick Leave', '14', 1, 0, '2023-04-06 11:33:22', '2023-04-28 23:14:08');
INSERT INTO `leave_categories` VALUES (2, 1, 'Family Issue', 'Test Desc', '0', 1, 1, '2023-04-07 15:57:43', '2023-04-28 23:21:24');
INSERT INTO `leave_categories` VALUES (3, 1, 'Annual leave', 'Annual leave', '22', 1, 0, '2023-04-13 20:09:33', '2023-04-28 23:20:10');
INSERT INTO `leave_categories` VALUES (4, 1, 'Breavement', 'covers death of father, mother, spouse, children', '7', 1, 0, '2023-04-28 23:14:29', '2023-04-28 23:14:29');
INSERT INTO `leave_categories` VALUES (5, 1, 'Personal (unpaid)', 'Personal (unpaid)', '4', 1, 0, '2023-04-28 23:14:44', '2023-04-28 23:14:44');
INSERT INTO `leave_categories` VALUES (6, 1, 'Maternity', 'Maternity', '90', 1, 0, '2023-04-28 23:16:51', '2023-05-01 08:31:18');
INSERT INTO `leave_categories` VALUES (7, 1, 'Paternity', 'Paternity', '14', 1, 0, '2023-04-28 23:17:55', '2023-04-28 23:17:55');
INSERT INTO `leave_categories` VALUES (8, 1, 'Compulsory Leave', 'Compulsory Leave', '14', 1, 0, '2023-04-28 23:18:06', '2023-04-28 23:18:06');
INSERT INTO `leave_categories` VALUES (9, 1, 'Study', 'Study', '2', 1, 0, '2023-04-28 23:18:16', '2023-04-28 23:18:16');

-- ----------------------------
-- Table structure for loans
-- ----------------------------
DROP TABLE IF EXISTS `loans`;
CREATE TABLE `loans`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int NOT NULL,
  `user_id` int NOT NULL,
  `loan_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_installments` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remaining_installments` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deletion_status` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of loans
-- ----------------------------

-- ----------------------------
-- Table structure for machines
-- ----------------------------
DROP TABLE IF EXISTS `machines`;
CREATE TABLE `machines`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `activation` tinyint NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of machines
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2017_10_16_064138_create_client_types_table', 1);
INSERT INTO `migrations` VALUES (4, '2017_10_16_072245_create_designations_table', 1);
INSERT INTO `migrations` VALUES (5, '2017_11_11_090618_create_general_settings_table', 1);
INSERT INTO `migrations` VALUES (6, '2017_11_17_083029_create_files_table', 1);
INSERT INTO `migrations` VALUES (7, '2017_11_17_083147_create_folders_table', 1);
INSERT INTO `migrations` VALUES (8, '2017_12_29_092609_create_departments_table', 1);
INSERT INTO `migrations` VALUES (9, '2017_12_29_114115_create_leave_categories_table', 1);
INSERT INTO `migrations` VALUES (10, '2017_12_29_124702_create_attendances_table', 1);
INSERT INTO `migrations` VALUES (11, '2017_12_29_185757_create_working_days_table', 1);
INSERT INTO `migrations` VALUES (12, '2017_12_29_215610_create_holidays_table', 1);
INSERT INTO `migrations` VALUES (13, '2017_12_29_233919_create_personal_events_table', 1);
INSERT INTO `migrations` VALUES (14, '2017_12_30_161317_create_payrolls_table', 1);
INSERT INTO `migrations` VALUES (15, '2017_12_30_174811_create_notices_table', 1);
INSERT INTO `migrations` VALUES (16, '2017_12_31_185730_create_leave_applications_table', 1);
INSERT INTO `migrations` VALUES (17, '2018_01_03_081227_create_bonuses_table', 1);
INSERT INTO `migrations` VALUES (18, '2018_01_03_104224_create_deductions_table', 1);
INSERT INTO `migrations` VALUES (19, '2018_01_03_114151_create_loans_table', 1);
INSERT INTO `migrations` VALUES (20, '2018_01_03_153120_create_expence_managements_table', 1);
INSERT INTO `migrations` VALUES (21, '2018_01_04_061104_create_salary_payments_table', 1);
INSERT INTO `migrations` VALUES (22, '2018_01_04_173403_create_award_categories_table', 1);
INSERT INTO `migrations` VALUES (23, '2018_01_05_164319_create_employee_awards_table', 1);
INSERT INTO `migrations` VALUES (24, '2018_02_03_073729_entrust_setup_tables', 1);
INSERT INTO `migrations` VALUES (25, '2018_03_24_100116_create_salary_payment_details_table', 1);

-- ----------------------------
-- Table structure for myattendances
-- ----------------------------
DROP TABLE IF EXISTS `myattendances`;
CREATE TABLE `myattendances`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `accno` varchar(555) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `empidno` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `autosign` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `check_in` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `check_out` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `date` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `timetable` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `onduty` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `offduty` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `normal` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `realtime` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `late` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `early` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `absent` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ottime` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `worktime` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `exception` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `mustcin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `mustcout` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `department` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ndays` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `weekend` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `holiday` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `atttime` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ndaysot` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `weekendot` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `holidayot` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of myattendances
-- ----------------------------

-- ----------------------------
-- Table structure for nocs
-- ----------------------------
DROP TABLE IF EXISTS `nocs`;
CREATE TABLE `nocs`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `empid` int NULL DEFAULT NULL,
  `category` int NULL DEFAULT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `bottom` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of nocs
-- ----------------------------
INSERT INTO `nocs` VALUES (3, 103, 2, 'Keep going', 'Great work', '2023-05-02 16:03:25', '2023-05-02 16:03:25');

-- ----------------------------
-- Table structure for notices
-- ----------------------------
DROP TABLE IF EXISTS `notices`;
CREATE TABLE `notices`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int NOT NULL,
  `notice_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `publication_status` tinyint NOT NULL,
  `deletion_status` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of notices
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for payrolls
-- ----------------------------
DROP TABLE IF EXISTS `payrolls`;
CREATE TABLE `payrolls`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int NOT NULL,
  `user_id` int NOT NULL,
  `employee_type` tinyint NOT NULL COMMENT '1 for Provision & 2 for Permanent',
  `basic_salary` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `house_rent_allowance` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `medical_allowance` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `special_allowance` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `provident_fund_contribution` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `other_allowance` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tax_deduction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `provident_fund_deduction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nhif` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nssf` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `other_deduction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `activation_status` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `taxable_pay` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `income_tax` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nhif_relief` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `persnol_relief` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `paye` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `pay_after_tax` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `net_pay` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of payrolls
-- ----------------------------
INSERT INTO `payrolls` VALUES (9, 1, 102, 3, '65000', NULL, NULL, NULL, NULL, '0', NULL, NULL, '1300', '1080', '0', 0, '2023-05-01 18:03:39', '2023-05-01 18:03:39', '63920', '13959.35', '195', '2400', '11364.35', '52555.65', '51255.65');
INSERT INTO `payrolls` VALUES (10, 1, 103, 2, '89500', NULL, NULL, NULL, NULL, '0', NULL, NULL, '1500', '1080', '0', 0, '2023-05-04 09:51:27', '2023-05-04 09:51:27', '88420', '21309.35', '225', '2400', '18684.35', '69735.65', '68235.65');
INSERT INTO `payrolls` VALUES (11, 1, 105, 2, '50000', NULL, NULL, NULL, NULL, '0', NULL, NULL, '1200', '1080', '0', 0, '2023-05-04 10:18:19', '2023-05-04 10:18:19', '48920', '9459.35', '180', '2400', '6879.35', '42040.65', '40840.65');

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role`  (
  `permission_id` int UNSIGNED NOT NULL,
  `role_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `permission_role_role_id_foreign`(`role_id` ASC) USING BTREE,
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
INSERT INTO `permission_role` VALUES (1, 1);
INSERT INTO `permission_role` VALUES (2, 1);
INSERT INTO `permission_role` VALUES (3, 1);
INSERT INTO `permission_role` VALUES (4, 1);
INSERT INTO `permission_role` VALUES (5, 1);
INSERT INTO `permission_role` VALUES (6, 1);
INSERT INTO `permission_role` VALUES (7, 1);
INSERT INTO `permission_role` VALUES (8, 1);
INSERT INTO `permission_role` VALUES (9, 1);
INSERT INTO `permission_role` VALUES (10, 1);
INSERT INTO `permission_role` VALUES (11, 1);
INSERT INTO `permission_role` VALUES (12, 1);
INSERT INTO `permission_role` VALUES (13, 1);
INSERT INTO `permission_role` VALUES (14, 1);
INSERT INTO `permission_role` VALUES (15, 1);
INSERT INTO `permission_role` VALUES (16, 1);
INSERT INTO `permission_role` VALUES (17, 1);
INSERT INTO `permission_role` VALUES (18, 1);
INSERT INTO `permission_role` VALUES (19, 1);
INSERT INTO `permission_role` VALUES (20, 1);
INSERT INTO `permission_role` VALUES (21, 1);
INSERT INTO `permission_role` VALUES (22, 1);
INSERT INTO `permission_role` VALUES (23, 1);
INSERT INTO `permission_role` VALUES (24, 1);
INSERT INTO `permission_role` VALUES (25, 1);
INSERT INTO `permission_role` VALUES (26, 1);
INSERT INTO `permission_role` VALUES (27, 1);
INSERT INTO `permission_role` VALUES (28, 1);
INSERT INTO `permission_role` VALUES (29, 1);
INSERT INTO `permission_role` VALUES (11, 2);
INSERT INTO `permission_role` VALUES (13, 2);
INSERT INTO `permission_role` VALUES (19, 2);
INSERT INTO `permission_role` VALUES (23, 2);
INSERT INTO `permission_role` VALUES (25, 2);
INSERT INTO `permission_role` VALUES (26, 2);
INSERT INTO `permission_role` VALUES (28, 2);
INSERT INTO `permission_role` VALUES (4, 3);
INSERT INTO `permission_role` VALUES (5, 3);
INSERT INTO `permission_role` VALUES (6, 3);
INSERT INTO `permission_role` VALUES (11, 3);
INSERT INTO `permission_role` VALUES (15, 3);
INSERT INTO `permission_role` VALUES (23, 3);
INSERT INTO `permission_role` VALUES (26, 3);
INSERT INTO `permission_role` VALUES (27, 3);
INSERT INTO `permission_role` VALUES (28, 3);
INSERT INTO `permission_role` VALUES (29, 3);
INSERT INTO `permission_role` VALUES (3, 6);
INSERT INTO `permission_role` VALUES (4, 6);
INSERT INTO `permission_role` VALUES (8, 6);
INSERT INTO `permission_role` VALUES (9, 6);
INSERT INTO `permission_role` VALUES (10, 6);
INSERT INTO `permission_role` VALUES (11, 6);
INSERT INTO `permission_role` VALUES (12, 6);
INSERT INTO `permission_role` VALUES (13, 6);
INSERT INTO `permission_role` VALUES (14, 6);
INSERT INTO `permission_role` VALUES (15, 6);
INSERT INTO `permission_role` VALUES (16, 6);
INSERT INTO `permission_role` VALUES (17, 6);
INSERT INTO `permission_role` VALUES (18, 6);
INSERT INTO `permission_role` VALUES (19, 6);
INSERT INTO `permission_role` VALUES (20, 6);
INSERT INTO `permission_role` VALUES (21, 6);
INSERT INTO `permission_role` VALUES (22, 6);
INSERT INTO `permission_role` VALUES (23, 6);
INSERT INTO `permission_role` VALUES (24, 6);
INSERT INTO `permission_role` VALUES (25, 6);
INSERT INTO `permission_role` VALUES (26, 6);
INSERT INTO `permission_role` VALUES (27, 6);
INSERT INTO `permission_role` VALUES (28, 6);
INSERT INTO `permission_role` VALUES (29, 6);

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_unique`(`name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'hrm-setting', 'HRM Setting', 'HRM Setting', '2018-04-12 08:29:04', '2018-04-12 08:29:04');
INSERT INTO `permissions` VALUES (2, 'role', 'Role Setting', 'Role Setting Details', '2018-04-12 08:29:04', '2018-04-12 08:29:04');
INSERT INTO `permissions` VALUES (3, 'people', 'People', 'People', '2018-04-12 08:29:04', '2018-04-12 08:29:04');
INSERT INTO `permissions` VALUES (4, 'manage-employee', 'Manage employee', 'Manage employee', '2018-04-12 08:29:04', '2018-04-12 08:29:04');
INSERT INTO `permissions` VALUES (5, 'manage-clients', 'Manage clients', 'Manage clients', '2018-04-12 08:29:04', '2018-04-12 08:29:04');
INSERT INTO `permissions` VALUES (6, 'manage-references', 'Manage references', 'Manage references', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (7, 'file-upload', 'File Upload', 'File Upload', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (8, 'sms', 'SMS', 'SMS', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (9, 'payroll-management', 'Payroll Management', 'Payroll Management', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (10, 'manage-salary', 'Manage Salary', 'Manage Salary', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (11, 'salary-list', 'Salary List', 'Salary List', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (12, 'make-payment', 'Make Payment', 'Make Payment', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (13, 'generate-payslip', 'Generate Payslip', 'Generate Payslip', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (14, 'manage-bonus', 'Manage Bonus', 'Manage Bonus', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (15, 'manage-deduction', 'Manage Deduction', 'Manage Deduction', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (16, 'loan-management', 'Loan Management', 'Loan Management', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (17, 'provident-fund', 'Provident Fund', 'Provident Fund', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (18, 'attendance-management', 'Attendance Management', 'Attendance Management', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (19, 'manage-attendance', 'Manage Attendance ', 'Manage Attendance', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (20, 'attendance-report', 'Attendance Report', 'Attendance Report', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (21, 'manage-expense', 'Manage Expense', 'Manage Expense', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (22, 'manage-award', 'Manage Award', 'Manage Award', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (23, 'leave-application', 'Leave Application', 'Leave Application', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (24, 'manage-leave-application', 'Manage Leave Application List', 'Application List', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (25, 'my-leave-application', 'My Leave Application List', 'Application List', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (26, 'notice', 'Notice', 'Notice', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (27, 'manage-notice', 'Manage Notice', 'Manage Notice', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (28, 'notice-board', 'Notice Board', 'Notice Board', '2018-04-12 08:29:05', '2018-04-12 08:29:05');
INSERT INTO `permissions` VALUES (29, 'leave-reports', 'Leave Reports', 'Leave Reports', NULL, NULL);

-- ----------------------------
-- Table structure for personal_events
-- ----------------------------
DROP TABLE IF EXISTS `personal_events`;
CREATE TABLE `personal_events`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int NOT NULL,
  `personal_event` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_event_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `publication_status` tinyint NOT NULL,
  `deletion_status` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of personal_events
-- ----------------------------

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user`  (
  `user_id` int UNSIGNED NOT NULL,
  `role_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`, `role_id`) USING BTREE,
  INDEX `role_user_role_id_foreign`(`role_id` ASC) USING BTREE,
  INDEX `role_user_user_id_foreign`(`user_id` ASC) USING BTREE,
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES (1, 1);
INSERT INTO `role_user` VALUES (102, 2);
INSERT INTO `role_user` VALUES (103, 2);
INSERT INTO `role_user` VALUES (104, 2);
INSERT INTO `role_user` VALUES (105, 2);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_unique`(`name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'superadmin', 'Superadmin', 'Superadmin Details', '2018-04-12 08:35:05', '2018-04-12 08:35:05');
INSERT INTO `roles` VALUES (2, 'employee', 'Employee', 'Employee Details...', '2018-04-16 07:47:29', '2018-04-16 07:47:29');
INSERT INTO `roles` VALUES (3, 'Sub Admin', 'Sub Admin', 'No Description', '2019-10-18 20:30:22', '2019-10-18 20:30:22');
INSERT INTO `roles` VALUES (6, 'HR', 'HR', 'No Description', '2020-04-19 03:31:39', '2020-04-19 03:31:39');

-- ----------------------------
-- Table structure for salary_payment_details
-- ----------------------------
DROP TABLE IF EXISTS `salary_payment_details`;
CREATE TABLE `salary_payment_details`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `salary_payment_id` int UNSIGNED NOT NULL,
  `item_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int UNSIGNED NOT NULL,
  `status` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 130 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of salary_payment_details
-- ----------------------------
INSERT INTO `salary_payment_details` VALUES (122, 22, 'Basic Salary', 65000, 'credits', '2023-05-01 18:05:51', '2023-05-01 18:05:51');
INSERT INTO `salary_payment_details` VALUES (123, 22, 'Overtime', 4000, 'credits', '2023-05-01 18:05:51', '2023-05-01 18:05:51');
INSERT INTO `salary_payment_details` VALUES (124, 22, 'NHIF', 1300, 'debits', '2023-05-01 18:05:51', '2023-05-01 18:05:51');
INSERT INTO `salary_payment_details` VALUES (125, 22, 'NSSF', 1080, 'debits', '2023-05-01 18:05:51', '2023-05-01 18:05:51');
INSERT INTO `salary_payment_details` VALUES (126, 23, 'Basic Salary', 50000, 'credits', '2023-05-04 10:20:10', '2023-05-04 10:20:10');
INSERT INTO `salary_payment_details` VALUES (127, 23, 'oVERTIME', 6000, 'credits', '2023-05-04 10:20:10', '2023-05-04 10:20:10');
INSERT INTO `salary_payment_details` VALUES (128, 23, 'NHIF', 1200, 'debits', '2023-05-04 10:20:10', '2023-05-04 10:20:10');
INSERT INTO `salary_payment_details` VALUES (129, 23, 'NSSF', 1080, 'debits', '2023-05-04 10:20:10', '2023-05-04 10:20:10');

-- ----------------------------
-- Table structure for salary_payments
-- ----------------------------
DROP TABLE IF EXISTS `salary_payments`;
CREATE TABLE `salary_payments`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int NOT NULL,
  `user_id` int NOT NULL,
  `gross_salary` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_deduction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `net_salary` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provident_fund` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `payment_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_month` date NOT NULL,
  `payment_type` tinyint NOT NULL COMMENT '1 for cash payment, 2 for chaque payment & 3 for bank payment',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of salary_payments
-- ----------------------------
INSERT INTO `salary_payments` VALUES (22, 1, 102, '69000.00', '2380.00', '66620', '0', '66620', '2023-05-01', 3, 'Ok', '2023-05-01 18:05:51', '2023-05-01 18:05:51');
INSERT INTO `salary_payments` VALUES (23, 1, 105, '56000.00', '2280.00', '53720', '0', '53720', '2023-05-01', 1, NULL, '2023-05-04 10:20:10', '2023-05-04 10:20:10');

-- ----------------------------
-- Table structure for set_times
-- ----------------------------
DROP TABLE IF EXISTS `set_times`;
CREATE TABLE `set_times`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_by` int NULL DEFAULT NULL,
  `in_time` time NULL DEFAULT NULL,
  `out_time` time NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of set_times
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int NULL DEFAULT NULL,
  `employee_id` int NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `mother_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `spouse_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `present_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `permanent_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `home_district` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `academic_qualification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `professional_qualification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `joining_date` date NULL DEFAULT NULL,
  `experience` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `reference` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `id_name` tinyint NULL DEFAULT NULL COMMENT '1 for NID, 2 Passport, 3 for Driving License',
  `id_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `contact_no_one` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no_two` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `emergency_contact` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `web` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gender` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NULL DEFAULT NULL,
  `marital_status` tinyint NULL DEFAULT NULL COMMENT '1 for Married, Single, 3 for Divorced, 4 for Separated, 5 for Widowed',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `client_type_id` int NULL DEFAULT NULL,
  `designation_id` int NULL DEFAULT NULL,
  `joining_position` int NULL DEFAULT NULL,
  `access_label` tinyint NOT NULL COMMENT '1 for superadmin, 2 for associates, 3 for employees, 4 for references and 5 for clients',
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `activation_status` tinyint NOT NULL DEFAULT 0,
  `deletion_status` tinyint NOT NULL DEFAULT 0,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nssf_no` int NULL DEFAULT NULL,
  `nhif_no` int NULL DEFAULT NULL,
  `passport_picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `kra_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `kin_details_name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `account_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank_acc_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank_branch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank_sort_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `kin_details_relation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `kin_details_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 106 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 1, NULL, 'Admin', NULL, NULL, NULL, 'admin@websvission.store', '$2y$10$cji2pi4PLfY6zTTyMJ5yxuoi3d6mIgnCrCu9MVCe5IG21hml4RzYu', 'Admin Address', 'Admin Address', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '00000000000', NULL, NULL, 'https://websvission.store', 'm', '2023-05-01', NULL, '1682934817.jpg', NULL, 1, NULL, 1, NULL, 1, 0, '8W5xQT9brS2fBB3PsCDPeml7LCX2z0QLuxknTNd2XplV76p36VersihJ4QCR', '2019-09-07 08:25:15', '2023-05-05 18:28:45', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (102, 1, 1, 'James', 'Munywoki', 'Nzuki', NULL, 'jameki93@gmail.com', '$2y$10$aMkX82i.9C8I9uwZy8ikreQUrwJ0ogw9tjlKYmBXVxT1WFgXuBFt6', '', NULL, 'None', NULL, NULL, '2021-01-01', NULL, NULL, 1, '26120559', '07890987678', NULL, NULL, NULL, 'm', '1999-01-04', NULL, NULL, NULL, 4, 5, 2, '2', 1, 0, 'yJyOb64F1DNT0CBRU7QIFvWBRcU0lAiAB2WQfQ8bIOnRc3KGW4V7AzF2CH9Q', '2023-05-01 17:47:46', '2023-05-05 22:41:08', 6789056, 54678976, '1682948866.webp', 'A005423677K', 'Mwamba Katana', 'ABC', '567890876556', 'NAtional', 'Kenya', NULL, 'Son', '0789089789');
INSERT INTO `users` VALUES (103, 1, 2, 'James', 'Kiilu', 'Kilonzo', NULL, 'admin@admin.com', '$2y$10$td7xngcD/l3KAikIPH5bmeI7B0qTFcqXRxNIYjzMknDrJ3pw8Mpcm', '', NULL, 'None', NULL, NULL, '2021-01-01', NULL, NULL, 1, '78907890', '07890987678', NULL, NULL, NULL, 'm', '2023-05-02', NULL, NULL, NULL, 4, 5, 2, 'employee', 1, 0, NULL, '2023-05-02 10:56:40', '2023-05-05 22:39:20', 2010208179, 56789098, '1683010600.webp', 'A005467890K', 'Mwamba Katana', 'James Kilonzo', '01109186393900', 'NCBA', 'Ruiru', NULL, 'Grace', '0789543212');
INSERT INTO `users` VALUES (104, 1, 3, 'Test', 'Test', 'Test', NULL, 'taha18944@gmail.com', '$2y$10$37p2uoxZHJVDvgy6hlgvPuk/Jl4L/0ZHU0eK8ucSPXm3ljuX5nUx2', '', NULL, 'None', NULL, NULL, '2023-05-10', NULL, NULL, 3, '123123', '00000000', NULL, NULL, NULL, 'm', '1990-01-01', NULL, NULL, NULL, 4, 5, 1, '2', 0, 0, NULL, '2023-05-03 14:58:20', '2023-05-03 14:59:41', 123123, 123123, '1683111500.jpg', '000000', 'Test', 'admin@websvission.store', '23434567', 'TEST', 'TEst', '1234ERTYUI678', 'Test', '21312312312');
INSERT INTO `users` VALUES (105, 1, 4, 'Daniel', 'Maina', 'Kariuki', NULL, 'janzu87@yahoo.com', '$2y$10$ADo2s8UY3zbyzi2/foLcROOwQgf7eLbciX.9wV9SmPArYwolqARNC', '', NULL, 'None', NULL, NULL, '2020-02-03', NULL, NULL, 1, '456789098', '0710993009', NULL, NULL, NULL, 'm', '2000-02-02', NULL, NULL, NULL, 4, 5, 2, 'employee', 1, 0, NULL, '2023-05-04 10:13:19', '2023-05-05 12:09:19', 890765, 54678976, '1683180799.webp', 'A00543135G', 'Faith  Ndunge', 'Daniel MaINA', '5678908765589', 'NAtional', 'Ruiru', NULL, 'Daughter', '0789543298');

-- ----------------------------
-- Table structure for working_days
-- ----------------------------
DROP TABLE IF EXISTS `working_days`;
CREATE TABLE `working_days`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `updated_by` int NOT NULL,
  `day` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `working_status` tinyint NOT NULL COMMENT '0 for holiday & 1 for working day',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of working_days
-- ----------------------------
INSERT INTO `working_days` VALUES (1, 1, 'Fri', 1, '2018-04-12 08:25:16', '2023-04-14 03:05:01');
INSERT INTO `working_days` VALUES (2, 1, 'Sat', 1, '2018-04-12 08:25:16', '2023-04-14 03:05:01');
INSERT INTO `working_days` VALUES (3, 1, 'Sun', 0, '2018-04-12 08:25:17', '2023-04-14 03:05:01');
INSERT INTO `working_days` VALUES (4, 1, 'Mon', 1, '2018-04-12 08:25:17', '2023-04-14 03:05:01');
INSERT INTO `working_days` VALUES (5, 1, 'Tue', 1, '2018-04-12 08:25:17', '2023-04-14 03:05:01');
INSERT INTO `working_days` VALUES (6, 1, 'Wed', 1, '2018-04-12 08:25:17', '2023-04-14 03:05:01');
INSERT INTO `working_days` VALUES (7, 1, 'Thu', 1, '2018-04-12 08:25:17', '2023-04-14 03:05:01');

SET FOREIGN_KEY_CHECKS = 1;
