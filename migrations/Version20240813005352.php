<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240813005352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address_exploitation (id INT AUTO_INCREMENT NOT NULL, province VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, village VARCHAR(255) DEFAULT NULL, district VARCHAR(255) DEFAULT NULL, sector VARCHAR(255) DEFAULT NULL, quarter VARCHAR(255) DEFAULT NULL, lat VARCHAR(255) DEFAULT NULL, `long` VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address_producer (id INT AUTO_INCREMENT NOT NULL, country VARCHAR(255) NOT NULL, province VARCHAR(255) NOT NULL, city VARCHAR(255) DEFAULT NULL, territory VARCHAR(255) DEFAULT NULL, district VARCHAR(255) DEFAULT NULL, sector VARCHAR(255) DEFAULT NULL, village VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE corporation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, details LONGTEXT DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, creation_date DATE NOT NULL, ended_date DATE DEFAULT NULL, has_legal_existance TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exploitation (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, type_exploitation_id INT DEFAULT NULL, address_id INT DEFAULT NULL, corporation_id INT DEFAULT NULL, surface_acres NUMERIC(10, 2) NOT NULL, started_at DATE NOT NULL, status VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_BEBCFB14584665A (product_id), INDEX IDX_BEBCFB12E533519 (type_exploitation_id), INDEX IDX_BEBCFB1F5B7AF75 (address_id), INDEX IDX_BEBCFB1B2685369 (corporation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pricing (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, legal_price NUMERIC(10, 2) NOT NULL, real_price NUMERIC(10, 2) NOT NULL, province VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, market VARCHAR(255) DEFAULT NULL, INDEX IDX_E5F1AC334584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producer (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, middlename VARCHAR(255) DEFAULT NULL, birthdate DATE NOT NULL, gender VARCHAR(20) NOT NULL, picture VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, bank_acount VARCHAR(255) DEFAULT NULL, number_of_children INT DEFAULT NULL, marital_status VARCHAR(255) NOT NULL, handicap VARCHAR(255) DEFAULT NULL, average_month_income NUMERIC(10, 2) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_976449DCF5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producer_corporation (producer_id INT NOT NULL, corporation_id INT NOT NULL, INDEX IDX_58DC308789B658FE (producer_id), INDEX IDX_58DC3087B2685369 (corporation_id), PRIMARY KEY(producer_id, corporation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, type_product_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D34A04AD5887B07F (type_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_transformation (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, transformation_place_id INT DEFAULT NULL, transformation_date DATE DEFAULT NULL, verification_institution VARCHAR(255) DEFAULT NULL, certification VARCHAR(255) DEFAULT NULL, certification_date DATE DEFAULT NULL, INDEX IDX_A1DB64A94584665A (product_id), INDEX IDX_A1DB64A9D6F6901 (transformation_place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE production_phase (id INT AUTO_INCREMENT NOT NULL, exploitation_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, seed_source VARCHAR(255) DEFAULT NULL, fertilizer VARCHAR(255) NOT NULL, operationnal_mode VARCHAR(255) DEFAULT NULL, season VARCHAR(255) NOT NULL, year INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_ABBC12FDD967A16D (exploitation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transformation (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, process LONGTEXT DEFAULT NULL, source_product VARCHAR(255) DEFAULT NULL, restrictions LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transformation_place (id INT AUTO_INCREMENT NOT NULL, company VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, province VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_exploitation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exploitation ADD CONSTRAINT FK_BEBCFB14584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE exploitation ADD CONSTRAINT FK_BEBCFB12E533519 FOREIGN KEY (type_exploitation_id) REFERENCES type_exploitation (id)');
        $this->addSql('ALTER TABLE exploitation ADD CONSTRAINT FK_BEBCFB1F5B7AF75 FOREIGN KEY (address_id) REFERENCES address_exploitation (id)');
        $this->addSql('ALTER TABLE exploitation ADD CONSTRAINT FK_BEBCFB1B2685369 FOREIGN KEY (corporation_id) REFERENCES corporation (id)');
        $this->addSql('ALTER TABLE pricing ADD CONSTRAINT FK_E5F1AC334584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE producer ADD CONSTRAINT FK_976449DCF5B7AF75 FOREIGN KEY (address_id) REFERENCES address_producer (id)');
        $this->addSql('ALTER TABLE producer_corporation ADD CONSTRAINT FK_58DC308789B658FE FOREIGN KEY (producer_id) REFERENCES producer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE producer_corporation ADD CONSTRAINT FK_58DC3087B2685369 FOREIGN KEY (corporation_id) REFERENCES corporation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD5887B07F FOREIGN KEY (type_product_id) REFERENCES type_product (id)');
        $this->addSql('ALTER TABLE product_transformation ADD CONSTRAINT FK_A1DB64A94584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_transformation ADD CONSTRAINT FK_A1DB64A9D6F6901 FOREIGN KEY (transformation_place_id) REFERENCES transformation_place (id)');
        $this->addSql('ALTER TABLE production_phase ADD CONSTRAINT FK_ABBC12FDD967A16D FOREIGN KEY (exploitation_id) REFERENCES exploitation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exploitation DROP FOREIGN KEY FK_BEBCFB14584665A');
        $this->addSql('ALTER TABLE exploitation DROP FOREIGN KEY FK_BEBCFB12E533519');
        $this->addSql('ALTER TABLE exploitation DROP FOREIGN KEY FK_BEBCFB1F5B7AF75');
        $this->addSql('ALTER TABLE exploitation DROP FOREIGN KEY FK_BEBCFB1B2685369');
        $this->addSql('ALTER TABLE pricing DROP FOREIGN KEY FK_E5F1AC334584665A');
        $this->addSql('ALTER TABLE producer DROP FOREIGN KEY FK_976449DCF5B7AF75');
        $this->addSql('ALTER TABLE producer_corporation DROP FOREIGN KEY FK_58DC308789B658FE');
        $this->addSql('ALTER TABLE producer_corporation DROP FOREIGN KEY FK_58DC3087B2685369');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD5887B07F');
        $this->addSql('ALTER TABLE product_transformation DROP FOREIGN KEY FK_A1DB64A94584665A');
        $this->addSql('ALTER TABLE product_transformation DROP FOREIGN KEY FK_A1DB64A9D6F6901');
        $this->addSql('ALTER TABLE production_phase DROP FOREIGN KEY FK_ABBC12FDD967A16D');
        $this->addSql('DROP TABLE address_exploitation');
        $this->addSql('DROP TABLE address_producer');
        $this->addSql('DROP TABLE corporation');
        $this->addSql('DROP TABLE exploitation');
        $this->addSql('DROP TABLE pricing');
        $this->addSql('DROP TABLE producer');
        $this->addSql('DROP TABLE producer_corporation');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_transformation');
        $this->addSql('DROP TABLE production_phase');
        $this->addSql('DROP TABLE transformation');
        $this->addSql('DROP TABLE transformation_place');
        $this->addSql('DROP TABLE type_exploitation');
        $this->addSql('DROP TABLE type_product');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
