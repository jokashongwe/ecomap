<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240814000016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE producer ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE producer ADD CONSTRAINT FK_976449DCB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_976449DCB03A8386 ON producer (created_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE producer DROP FOREIGN KEY FK_976449DCB03A8386');
        $this->addSql('DROP INDEX IDX_976449DCB03A8386 ON producer');
        $this->addSql('ALTER TABLE producer DROP created_by_id');
    }
}
