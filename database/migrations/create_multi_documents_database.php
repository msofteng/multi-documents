<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    protected $connection = 'mysql-init';

    public function up()
    {
        Schema::dropDatabaseIfExists('multi-documents');
        Schema::createDatabase('multi-documents');

        DB::select('ALTER DATABASE `multi-documents` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');

        DB::connection("multi-documents")->select("
            CREATE TABLE IF NOT EXISTS `documento` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `nome` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
                `pais` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
                `descricao` VARCHAR(200) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL,
                PRIMARY KEY (`id`)
            ) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;
        ");

        DB::connection("multi-documents")->select("
            CREATE TABLE IF NOT EXISTS `parametro` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `titulo` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
                `tipo` VARCHAR(20) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
                `regex` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL,
                PRIMARY KEY (`id`)
            ) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;
        ");

        DB::connection("multi-documents")->select("
            CREATE TABLE IF NOT EXISTS `dados_documento` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `label` VARCHAR(200) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
                `title` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL,
                `placeholder` VARCHAR(200) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL,
                `parametro_id` INT NOT NULL,
                `documento_id` INT NOT NULL,
                PRIMARY KEY (`id`),
                FOREIGN KEY (`parametro_id`) REFERENCES `parametro` (`id`),
                FOREIGN KEY (`documento_id`) REFERENCES `documento` (`id`)
            ) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;
        ");

        DB::connection("multi-documents")->select("
            CREATE TABLE IF NOT EXISTS `usuario` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `nome` VARCHAR(200) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
                `local` VARCHAR(200) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
                `user` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
                `senha` CHAR(64) NOT NULL,
                `location` POINT NULL,
                `token` CHAR(32) NULL,
                PRIMARY KEY (`id`)
            ) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;
        ");

        DB::connection("multi-documents")->select("
            CREATE TABLE IF NOT EXISTS `documentos_usuario` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `valor` TEXT CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL,
                `dado_documento_id` INT NOT NULL,
                `usuario_id` INT NOT NULL,
                PRIMARY KEY (`id`),
                FOREIGN KEY (`dado_documento_id`) REFERENCES `dados_documento` (`id`),
                FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
            ) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropDatabaseIfExists('multi-documents');
    }
};
