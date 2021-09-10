<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210910145514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_form DROP FOREIGN KEY FK_7A777FB0AF73D997');
        $this->addSql('DROP INDEX UNIQ_7A777FB0AF73D997 ON contact_form');
        $this->addSql('ALTER TABLE contact_form ADD email VARCHAR(80) NOT NULL, DROP direction_id');
        $this->addSql('ALTER TABLE user DROP is_verified');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_form ADD direction_id INT DEFAULT NULL, DROP email');
        $this->addSql('ALTER TABLE contact_form ADD CONSTRAINT FK_7A777FB0AF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7A777FB0AF73D997 ON contact_form (direction_id)');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL');
    }
}
