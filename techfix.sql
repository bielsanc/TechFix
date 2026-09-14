-- =========================================================
-- TechFix - Dump completo do banco de dados
-- Importe este arquivo pelo phpMyAdmin (aba "Importar")
-- para criar o banco "techfix" com todas as tabelas do sistema.
-- =========================================================

CREATE DATABASE IF NOT EXISTS `techfix`
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_unicode_ci;

USE `techfix`;

-- ---------------------------------------------------------
-- Tabela: users (login, cadastro de usuários/técnicos)
-- ---------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `usuario` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `perfil` VARCHAR(255) NOT NULL DEFAULT 'Técnico',
    `telefone` VARCHAR(255) DEFAULT NULL,
    `celular` VARCHAR(255) DEFAULT NULL,
    `endereco` VARCHAR(255) DEFAULT NULL,
    `bairro` VARCHAR(255) DEFAULT NULL,
    `cidade` VARCHAR(255) DEFAULT NULL,
    `estado` VARCHAR(2) DEFAULT NULL,
    `cep` VARCHAR(10) DEFAULT NULL,
    `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
    `password` VARCHAR(255) NOT NULL,
    `remember_token` VARCHAR(100) DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_usuario_unique` (`usuario`),
    UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Usuário administrador padrão
-- Login: admin   |   Senha: admin123
INSERT INTO `users`
    (`name`, `usuario`, `email`, `perfil`, `password`, `created_at`, `updated_at`)
VALUES
    ('Administrador', 'admin', 'admin@techfix.com', 'Administrador',
     '$2y$12$zhTij5udf1ldL9pPYROyHOZcYsTSf34wxfjBo32J.V7EmHJTNTKk2',
     NOW(), NOW());

-- ---------------------------------------------------------
-- Tabela: ordens_servico
-- ---------------------------------------------------------
DROP TABLE IF EXISTS `ordens_servico`;
CREATE TABLE `ordens_servico` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `numero` VARCHAR(255) NOT NULL,
    `cliente_nome` VARCHAR(255) NOT NULL,
    `cliente_telefone` VARCHAR(255) DEFAULT NULL,
    `cliente_email` VARCHAR(255) DEFAULT NULL,
    `tipo_equipamento` VARCHAR(255) DEFAULT NULL,
    `marca` VARCHAR(255) DEFAULT NULL,
    `modelo` VARCHAR(255) DEFAULT NULL,
    `numero_serie` VARCHAR(255) DEFAULT NULL,
    `acessorios` VARCHAR(255) DEFAULT NULL,
    `descricao_problema` TEXT DEFAULT NULL,
    `itens` JSON DEFAULT NULL,
    `valor_total` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `status` ENUM('Aberta','Em andamento','Aguardando Peças','Concluída') NOT NULL DEFAULT 'Aberta',
    `tecnico` VARCHAR(255) DEFAULT NULL,
    `data_entrada` DATE DEFAULT NULL,
    `previsao_entrega` DATE DEFAULT NULL,
    `usuario_id` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `ordens_servico_numero_unique` (`numero`),
    KEY `ordens_servico_usuario_id_foreign` (`usuario_id`),
    CONSTRAINT `ordens_servico_usuario_id_foreign`
        FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Algumas ordens de exemplo (opcional - pode apagar estas linhas se quiser começar vazio)
INSERT INTO `ordens_servico`
    (`numero`, `cliente_nome`, `cliente_telefone`, `tipo_equipamento`, `marca`, `status`, `tecnico`, `data_entrada`, `valor_total`, `created_at`, `updated_at`)
VALUES
    ('00001', 'Carlos Alberto', '(11) 98765-4321', 'Notebook', 'Dell', 'Em andamento', 'Administrador', CURDATE(), 0, NOW(), NOW()),
    ('00002', 'Juliana Silva', '(11) 91234-5678', 'Desktop', 'Genérico', 'Aguardando Peças', 'Administrador', CURDATE(), 0, NOW(), NOW());

-- ---------------------------------------------------------
-- Tabelas padrão do Laravel (sessões, cache, filas)
-- ---------------------------------------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
    `email` VARCHAR(255) NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
    `id` VARCHAR(255) NOT NULL,
    `user_id` BIGINT UNSIGNED DEFAULT NULL,
    `ip_address` VARCHAR(45) DEFAULT NULL,
    `user_agent` TEXT DEFAULT NULL,
    `payload` LONGTEXT NOT NULL,
    `last_activity` INT NOT NULL,
    PRIMARY KEY (`id`),
    KEY `sessions_user_id_index` (`user_id`),
    KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
    `key` VARCHAR(255) NOT NULL,
    `value` MEDIUMTEXT NOT NULL,
    `expiration` INT NOT NULL,
    PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
    `key` VARCHAR(255) NOT NULL,
    `owner` VARCHAR(255) NOT NULL,
    `expiration` INT NOT NULL,
    PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `queue` VARCHAR(255) NOT NULL,
    `payload` LONGTEXT NOT NULL,
    `attempts` TINYINT UNSIGNED NOT NULL,
    `reserved_at` INT UNSIGNED DEFAULT NULL,
    `available_at` INT UNSIGNED NOT NULL,
    `created_at` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
    `id` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `total_jobs` INT NOT NULL,
    `pending_jobs` INT NOT NULL,
    `failed_jobs` INT NOT NULL,
    `failed_job_ids` LONGTEXT NOT NULL,
    `options` MEDIUMTEXT DEFAULT NULL,
    `cancelled_at` INT DEFAULT NULL,
    `created_at` INT NOT NULL,
    `finished_at` INT DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `uuid` VARCHAR(255) NOT NULL,
    `connection` TEXT NOT NULL,
    `queue` TEXT NOT NULL,
    `payload` LONGTEXT NOT NULL,
    `exception` LONGTEXT NOT NULL,
    `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
