<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190519131202 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE date_show (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, city VARCHAR(255) NOT NULL, longitude DOUBLE PRECISION NOT NULL, latitude DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE price_period (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performance (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_82D796815E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performance_performer (performance_id INT NOT NULL, performer_id INT NOT NULL, INDEX IDX_F9A477A3B91ADEEE (performance_id), INDEX IDX_F9A477A36C6B33F3 (performer_id), PRIMARY KEY(performance_id, performer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE price (id INT AUTO_INCREMENT NOT NULL, period_id INT NOT NULL, category_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_CAC822D9EC8B7ADE (period_id), INDEX IDX_CAC822D912469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_us (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, biography LONGTEXT DEFAULT NULL, birthday DATE DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, country_iso VARCHAR(5) NOT NULL, UNIQUE INDEX UNIQ_17210BEB5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE price_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cms (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, short_description LONGTEXT NOT NULL, full_description LONGTEXT DEFAULT NULL, image_home VARCHAR(255) DEFAULT NULL, image_banner VARCHAR(255) NOT NULL, updated_at DATETIME DEFAULT NULL, cms_type INT NOT NULL, UNIQUE INDEX UNIQ_AC8F99074B48FA54 (cms_type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE performance_performer ADD CONSTRAINT FK_F9A477A3B91ADEEE FOREIGN KEY (performance_id) REFERENCES performance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE performance_performer ADD CONSTRAINT FK_F9A477A36C6B33F3 FOREIGN KEY (performer_id) REFERENCES performer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D9EC8B7ADE FOREIGN KEY (period_id) REFERENCES price_period (id)');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D912469DE2 FOREIGN KEY (category_id) REFERENCES price_category (id)');

        $this->addSql("INSERT INTO `cms` VALUES (1,'About Us', '', '', '5c49d6a01be15403479428.jpg', '5c508411ca192637051169.jpg', NULL,0)");
        $this->addSql("INSERT INTO `cms` VALUES (2,'Performers', '', '', '', '5c5084295a203646339547.jpg', NULL,1)");
        $this->addSql("INSERT INTO `cms` VALUES (3,'Performances', '', '', '', '5c50847d3e2f0280328936.jpg', NULL,2)");
        $this->addSql("INSERT INTO `cms` VALUES (4,'Dates & Prices', '', '', '', '5cd6bded7bbc4559953674.jpg', NULL,3)");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE price DROP FOREIGN KEY FK_CAC822D9EC8B7ADE');
        $this->addSql('ALTER TABLE performance_performer DROP FOREIGN KEY FK_F9A477A3B91ADEEE');
        $this->addSql('ALTER TABLE performance_performer DROP FOREIGN KEY FK_F9A477A36C6B33F3');
        $this->addSql('ALTER TABLE price DROP FOREIGN KEY FK_CAC822D912469DE2');
        $this->addSql('DROP TABLE date_show');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE price_period');
        $this->addSql('DROP TABLE performance');
        $this->addSql('DROP TABLE performance_performer');
        $this->addSql('DROP TABLE price');
        $this->addSql('DROP TABLE contact_us');
        $this->addSql('DROP TABLE performer');
        $this->addSql('DROP TABLE price_category');
        $this->addSql('DROP TABLE cms');
    }
}
