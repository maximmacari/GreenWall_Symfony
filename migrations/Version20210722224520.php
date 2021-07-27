<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210722224520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD nif VARCHAR(12) DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD bill_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981A8C12F5 FOREIGN KEY (bill_id) REFERENCES bill (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F52993981A8C12F5 ON `order` (bill_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP nif');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993981A8C12F5');
        $this->addSql('DROP INDEX UNIQ_F52993981A8C12F5 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP bill_id');
    }
}
