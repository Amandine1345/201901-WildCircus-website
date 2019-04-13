<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190413154834 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE price ADD period_id INT NOT NULL, ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D9EC8B7ADE FOREIGN KEY (period_id) REFERENCES price_period (id)');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D912469DE2 FOREIGN KEY (category_id) REFERENCES price_category (id)');
        $this->addSql('CREATE INDEX IDX_CAC822D9EC8B7ADE ON price (period_id)');
        $this->addSql('CREATE INDEX IDX_CAC822D912469DE2 ON price (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE price DROP FOREIGN KEY FK_CAC822D9EC8B7ADE');
        $this->addSql('ALTER TABLE price DROP FOREIGN KEY FK_CAC822D912469DE2');
        $this->addSql('DROP INDEX IDX_CAC822D9EC8B7ADE ON price');
        $this->addSql('DROP INDEX IDX_CAC822D912469DE2 ON price');
        $this->addSql('ALTER TABLE price DROP period_id, DROP category_id');
    }
}
