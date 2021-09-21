<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210921150055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE product_collection');
        $this->addSql('ALTER TABLE basket ADD products_arr LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE bill CHANGE expedition_date expedition_date INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_collection (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, basket_id INT NOT NULL, units INT NOT NULL, UNIQUE INDEX UNIQ_6F2A3A194584665A (product_id), INDEX IDX_6F2A3A191BE1FB52 (basket_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE product_collection ADD CONSTRAINT FK_6F2A3A191BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id)');
        $this->addSql('ALTER TABLE product_collection ADD CONSTRAINT FK_6F2A3A194584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE basket DROP products_arr');
        $this->addSql('ALTER TABLE bill CHANGE expedition_date expedition_date DATETIME NOT NULL');
    }
}
