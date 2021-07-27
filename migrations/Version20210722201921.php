<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210722201921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE basket (id INT AUTO_INCREMENT NOT NULL, create_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bill (id INT AUTO_INCREMENT NOT NULL, expedition_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(55) NOT NULL, email VARCHAR(55) NOT NULL, password VARCHAR(255) NOT NULL, direction VARCHAR(255) DEFAULT NULL, phone INT NOT NULL, type VARCHAR(30) NOT NULL, state VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_form (id INT AUTO_INCREMENT NOT NULL, direction_id INT DEFAULT NULL, name VARCHAR(80) NOT NULL, type VARCHAR(20) NOT NULL, phone INT NOT NULL, reason VARCHAR(30) NOT NULL, message VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7A777FB0AF73D997 (direction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE direction (id INT AUTO_INCREMENT NOT NULL, street VARCHAR(255) NOT NULL, number INT NOT NULL, floor VARCHAR(30) DEFAULT NULL, postal_code VARCHAR(40) NOT NULL, region VARCHAR(60) NOT NULL, other VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, basket_id INT NOT NULL, order_date DATETIME NOT NULL, status VARCHAR(40) NOT NULL, price NUMERIC(10, 2) NOT NULL, payment_method VARCHAR(40) NOT NULL, details VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_F52993981BE1FB52 (basket_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, category VARCHAR(40) NOT NULL, price NUMERIC(10, 2) NOT NULL, tax_rate INT NOT NULL, description VARCHAR(255) NOT NULL, stock INT NOT NULL, percent_reduction INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE show_case_projects (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, description VARCHAR(255) NOT NULL, images LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact_form ADD CONSTRAINT FK_7A777FB0AF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993981BE1FB52');
        $this->addSql('ALTER TABLE contact_form DROP FOREIGN KEY FK_7A777FB0AF73D997');
        $this->addSql('DROP TABLE basket');
        $this->addSql('DROP TABLE bill');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE contact_form');
        $this->addSql('DROP TABLE direction');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE show_case_projects');
    }
}
