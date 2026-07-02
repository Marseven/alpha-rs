-- ---------------------------------------------------------------------------
-- Relief Services — schema for the new features (workflow, AI, site images).
-- Apply ONCE on production via phpMyAdmin (git-pull deploy cannot run
-- `php artisan migrate`). Safe/idempotent: IF NOT EXISTS + guarded column.
-- Charset utf8mb4 to match the app.
-- ---------------------------------------------------------------------------

-- 1) users.workflow_role (doctor|cnamgs|admin). Guarded add.
SET @col := (SELECT COUNT(*) FROM information_schema.columns
  WHERE table_schema = DATABASE() AND table_name = 'users' AND column_name = 'workflow_role');
SET @sql := IF(@col = 0,
  'ALTER TABLE `users` ADD COLUMN `workflow_role` VARCHAR(255) NULL, ADD INDEX `users_workflow_role_index` (`workflow_role`)',
  'SELECT "users.workflow_role already exists"');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

-- 2) medical_case_workflows
CREATE TABLE IF NOT EXISTS `medical_case_workflows` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tracking_number` VARCHAR(255) NOT NULL,
  `folder_id` BIGINT UNSIGNED NULL,
  `patient_name` VARCHAR(255) NOT NULL,
  `patient_phone` VARCHAR(255) NULL,
  `doctor_id` BIGINT UNSIGNED NULL,
  `cnamgs_id` BIGINT UNSIGNED NULL,
  `status` VARCHAR(255) NOT NULL DEFAULT 'draft',
  `doctor_note` TEXT NULL,
  `cnamgs_note` TEXT NULL,
  `patient_note` TEXT NULL,
  `sent_to_cnamgs_at` TIMESTAMP NULL,
  `received_by_cnamgs_at` TIMESTAMP NULL,
  `processed_at` TIMESTAMP NULL,
  `completed_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mcw_tracking_number_unique` (`tracking_number`),
  KEY `mcw_folder_id_index` (`folder_id`),
  KEY `mcw_patient_phone_index` (`patient_phone`),
  KEY `mcw_doctor_id_index` (`doctor_id`),
  KEY `mcw_cnamgs_id_index` (`cnamgs_id`),
  KEY `mcw_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3) medical_case_status_histories
CREATE TABLE IF NOT EXISTS `medical_case_status_histories` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `medical_case_workflow_id` BIGINT UNSIGNED NOT NULL,
  `old_status` VARCHAR(255) NULL,
  `new_status` VARCHAR(255) NOT NULL,
  `changed_by` BIGINT UNSIGNED NULL,
  `note` TEXT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  KEY `mcsh_case_index` (`medical_case_workflow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4) case_notifications
CREATE TABLE IF NOT EXISTS `case_notifications` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `medical_case_workflow_id` BIGINT UNSIGNED NOT NULL,
  `channel` VARCHAR(255) NOT NULL,
  `recipient` VARCHAR(255) NULL,
  `message` TEXT NULL,
  `status` VARCHAR(255) NOT NULL DEFAULT 'pending',
  `sent_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  KEY `cn_case_index` (`medical_case_workflow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5) ai_questions
CREATE TABLE IF NOT EXISTS `ai_questions` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  `phone` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  `question` TEXT NOT NULL,
  `answer` TEXT NULL,
  `source_context` TEXT NULL,
  `status` VARCHAR(255) NOT NULL DEFAULT 'answered',
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  KEY `ai_questions_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6) site_settings
CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` VARCHAR(255) NOT NULL,
  `value` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------------
-- 7) LEGACY FIX — run ONLY if a previous deploy created the workflow with the
--    old "pharmacy_*" naming. Renames the columns and migrates the stored
--    status/role values to CNAMGS. Guarded + idempotent: every step is a no-op
--    on a fresh (cnamgs_*) schema, so it is always safe to run.
-- ---------------------------------------------------------------------------
SET @db := DATABASE();
-- 7a) pharmacy_id -> cnamgs_id
SET @c := (SELECT COUNT(*) FROM information_schema.columns
  WHERE table_schema = @db AND table_name = 'medical_case_workflows' AND column_name = 'pharmacy_id');
SET @sql := IF(@c = 1, 'ALTER TABLE `medical_case_workflows` CHANGE `pharmacy_id` `cnamgs_id` BIGINT UNSIGNED NULL', 'SELECT 1');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;
-- 7b) pharmacy_note -> cnamgs_note
SET @c := (SELECT COUNT(*) FROM information_schema.columns
  WHERE table_schema = @db AND table_name = 'medical_case_workflows' AND column_name = 'pharmacy_note');
SET @sql := IF(@c = 1, 'ALTER TABLE `medical_case_workflows` CHANGE `pharmacy_note` `cnamgs_note` TEXT NULL', 'SELECT 1');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;
-- 7c) sent_to_pharmacy_at -> sent_to_cnamgs_at
SET @c := (SELECT COUNT(*) FROM information_schema.columns
  WHERE table_schema = @db AND table_name = 'medical_case_workflows' AND column_name = 'sent_to_pharmacy_at');
SET @sql := IF(@c = 1, 'ALTER TABLE `medical_case_workflows` CHANGE `sent_to_pharmacy_at` `sent_to_cnamgs_at` TIMESTAMP NULL', 'SELECT 1');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;
-- 7d) received_by_pharmacy_at -> received_by_cnamgs_at
SET @c := (SELECT COUNT(*) FROM information_schema.columns
  WHERE table_schema = @db AND table_name = 'medical_case_workflows' AND column_name = 'received_by_pharmacy_at');
SET @sql := IF(@c = 1, 'ALTER TABLE `medical_case_workflows` CHANGE `received_by_pharmacy_at` `received_by_cnamgs_at` TIMESTAMP NULL', 'SELECT 1');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;
-- 7e) stored status + role values (legacy rows only)
UPDATE `medical_case_workflows` SET `status` = 'sent_to_cnamgs'     WHERE `status` = 'sent_to_pharmacy';
UPDATE `medical_case_workflows` SET `status` = 'received_by_cnamgs' WHERE `status` = 'received_by_pharmacy';
UPDATE `users` SET `workflow_role` = 'cnamgs' WHERE `workflow_role` = 'pharmacy';

-- ---------------------------------------------------------------------------
-- Assign roles to existing users (adapt the emails):
--   UPDATE `users` SET `workflow_role` = 'doctor' WHERE email = 'medecin@example.com';
--   UPDATE `users` SET `workflow_role` = 'cnamgs' WHERE email = 'cnamgs@example.com';
-- ---------------------------------------------------------------------------
