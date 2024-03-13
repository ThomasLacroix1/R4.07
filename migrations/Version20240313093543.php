<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313093543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lego_collection (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE legoCollection');
        $this->addSql('ALTER TABLE lego ADD collection_id INT NOT NULL');
        $this->addSql('ALTER TABLE lego ADD CONSTRAINT FK_E9191FC5514956FD FOREIGN KEY (collection_id) REFERENCES lego_collection (id)');
        $this->addSql('CREATE INDEX IDX_E9191FC5514956FD ON lego (collection_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lego DROP FOREIGN KEY FK_E9191FC5514956FD');
        $this->addSql('CREATE TABLE legoCollection (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE lego_collection');
        $this->addSql('DROP INDEX IDX_E9191FC5514956FD ON lego');
        $this->addSql('ALTER TABLE lego DROP collection_id');
    }
}
