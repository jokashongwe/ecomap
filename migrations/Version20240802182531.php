<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240802182531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE address_exploitation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE address_producer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE corporation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE exploitation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pricing_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE producer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_transformation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production_phase_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE transformation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE transformation_place_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_exploitation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE address_exploitation (id INT NOT NULL, province VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, village VARCHAR(255) DEFAULT NULL, district VARCHAR(255) DEFAULT NULL, sector VARCHAR(255) DEFAULT NULL, quarter VARCHAR(255) DEFAULT NULL, lat VARCHAR(255) DEFAULT NULL, long VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE address_producer (id INT NOT NULL, country VARCHAR(255) NOT NULL, province VARCHAR(255) NOT NULL, city VARCHAR(255) DEFAULT NULL, territory VARCHAR(255) DEFAULT NULL, district VARCHAR(255) DEFAULT NULL, sector VARCHAR(255) DEFAULT NULL, village VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN address_producer.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE corporation (id INT NOT NULL, name VARCHAR(255) NOT NULL, details TEXT DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, creation_date DATE NOT NULL, ended_date DATE DEFAULT NULL, has_legal_existance BOOLEAN DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN corporation.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE exploitation (id INT NOT NULL, product_id INT DEFAULT NULL, type_exploitation_id INT DEFAULT NULL, address_id INT DEFAULT NULL, corporation_id INT DEFAULT NULL, surface_acres NUMERIC(10, 2) NOT NULL, started_at DATE NOT NULL, status VARCHAR(20) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BEBCFB14584665A ON exploitation (product_id)');
        $this->addSql('CREATE INDEX IDX_BEBCFB12E533519 ON exploitation (type_exploitation_id)');
        $this->addSql('CREATE INDEX IDX_BEBCFB1F5B7AF75 ON exploitation (address_id)');
        $this->addSql('CREATE INDEX IDX_BEBCFB1B2685369 ON exploitation (corporation_id)');
        $this->addSql('COMMENT ON COLUMN exploitation.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE pricing (id INT NOT NULL, product_id INT DEFAULT NULL, legal_price NUMERIC(10, 2) NOT NULL, real_price NUMERIC(10, 2) NOT NULL, province VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, market VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E5F1AC334584665A ON pricing (product_id)');
        $this->addSql('CREATE TABLE producer (id INT NOT NULL, address_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, middlename VARCHAR(255) DEFAULT NULL, birthdate DATE NOT NULL, gender VARCHAR(20) NOT NULL, picture VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, bank_acount VARCHAR(255) DEFAULT NULL, number_of_children INT DEFAULT NULL, marital_status VARCHAR(255) NOT NULL, handicap VARCHAR(255) DEFAULT NULL, average_month_income NUMERIC(10, 2) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_976449DCF5B7AF75 ON producer (address_id)');
        $this->addSql('COMMENT ON COLUMN producer.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE producer_corporation (producer_id INT NOT NULL, corporation_id INT NOT NULL, PRIMARY KEY(producer_id, corporation_id))');
        $this->addSql('CREATE INDEX IDX_58DC308789B658FE ON producer_corporation (producer_id)');
        $this->addSql('CREATE INDEX IDX_58DC3087B2685369 ON producer_corporation (corporation_id)');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, type_product_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D34A04AD5887B07F ON product (type_product_id)');
        $this->addSql('COMMENT ON COLUMN product.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE product_transformation (id INT NOT NULL, product_id INT DEFAULT NULL, transformation_place_id INT DEFAULT NULL, transformation_date DATE DEFAULT NULL, verification_institution VARCHAR(255) DEFAULT NULL, certification VARCHAR(255) DEFAULT NULL, certification_date DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A1DB64A94584665A ON product_transformation (product_id)');
        $this->addSql('CREATE INDEX IDX_A1DB64A9D6F6901 ON product_transformation (transformation_place_id)');
        $this->addSql('CREATE TABLE production_phase (id INT NOT NULL, exploitation_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, seed_source VARCHAR(255) DEFAULT NULL, fertilizer VARCHAR(255) NOT NULL, operationnal_mode VARCHAR(255) DEFAULT NULL, season VARCHAR(255) NOT NULL, year INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_ABBC12FDD967A16D ON production_phase (exploitation_id)');
        $this->addSql('COMMENT ON COLUMN production_phase.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE transformation (id INT NOT NULL, title VARCHAR(255) NOT NULL, process TEXT DEFAULT NULL, source_product VARCHAR(255) DEFAULT NULL, restrictions TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN transformation.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE transformation_place (id INT NOT NULL, company VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, province VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE type_exploitation (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE type_product (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE exploitation ADD CONSTRAINT FK_BEBCFB14584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE exploitation ADD CONSTRAINT FK_BEBCFB12E533519 FOREIGN KEY (type_exploitation_id) REFERENCES type_exploitation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE exploitation ADD CONSTRAINT FK_BEBCFB1F5B7AF75 FOREIGN KEY (address_id) REFERENCES address_exploitation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE exploitation ADD CONSTRAINT FK_BEBCFB1B2685369 FOREIGN KEY (corporation_id) REFERENCES corporation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pricing ADD CONSTRAINT FK_E5F1AC334584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE producer ADD CONSTRAINT FK_976449DCF5B7AF75 FOREIGN KEY (address_id) REFERENCES address_producer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE producer_corporation ADD CONSTRAINT FK_58DC308789B658FE FOREIGN KEY (producer_id) REFERENCES producer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE producer_corporation ADD CONSTRAINT FK_58DC3087B2685369 FOREIGN KEY (corporation_id) REFERENCES corporation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD5887B07F FOREIGN KEY (type_product_id) REFERENCES type_product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_transformation ADD CONSTRAINT FK_A1DB64A94584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_transformation ADD CONSTRAINT FK_A1DB64A9D6F6901 FOREIGN KEY (transformation_place_id) REFERENCES transformation_place (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production_phase ADD CONSTRAINT FK_ABBC12FDD967A16D FOREIGN KEY (exploitation_id) REFERENCES exploitation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE address_exploitation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE address_producer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE corporation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE exploitation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pricing_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE producer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_transformation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE production_phase_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE transformation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE transformation_place_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_exploitation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_product_id_seq CASCADE');
        $this->addSql('ALTER TABLE exploitation DROP CONSTRAINT FK_BEBCFB14584665A');
        $this->addSql('ALTER TABLE exploitation DROP CONSTRAINT FK_BEBCFB12E533519');
        $this->addSql('ALTER TABLE exploitation DROP CONSTRAINT FK_BEBCFB1F5B7AF75');
        $this->addSql('ALTER TABLE exploitation DROP CONSTRAINT FK_BEBCFB1B2685369');
        $this->addSql('ALTER TABLE pricing DROP CONSTRAINT FK_E5F1AC334584665A');
        $this->addSql('ALTER TABLE producer DROP CONSTRAINT FK_976449DCF5B7AF75');
        $this->addSql('ALTER TABLE producer_corporation DROP CONSTRAINT FK_58DC308789B658FE');
        $this->addSql('ALTER TABLE producer_corporation DROP CONSTRAINT FK_58DC3087B2685369');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD5887B07F');
        $this->addSql('ALTER TABLE product_transformation DROP CONSTRAINT FK_A1DB64A94584665A');
        $this->addSql('ALTER TABLE product_transformation DROP CONSTRAINT FK_A1DB64A9D6F6901');
        $this->addSql('ALTER TABLE production_phase DROP CONSTRAINT FK_ABBC12FDD967A16D');
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
