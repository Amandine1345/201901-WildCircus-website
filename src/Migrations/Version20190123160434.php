<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190123160434 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE about_us ADD full_description LONGTEXT NOT NULL');
        $this->addSql("INSERT INTO `about_us` VALUES (1,'About Us','Sed pretium cursus pellentesque. Nam quis elit diam. Cras elementum quam a eros porta tempor. Nam vel ultricies odio, a vehicula ex. Maecenas nec bibendum magna. Integer lectus orci, maximus non eros vel, feugiat bibendum elit. Nullam pharetra, enim ut imperdiet consequat, elit odio lobortis mauris, nec rutrum enim tellus sed metus. Aliquam erat volutpat. Sed volutpat molestie fringilla.','5c48923e7f355604085979.jpg','2019-01-23 17:11:42','<h2>Integer a leo ac enim.</h2><p>Vestibulum facilisis est ac dolor finibus commodo. Donec nec malesuada \r\ntellus, nec varius velit. Donec faucibus diam sit amet diam consectetur \r\nsagittis. Nulla ut sollicitudin orci. Phasellus laoreet vulputate metus,\r\n ut suscipit enim sollicitudin non. Nam molestie, risus pulvinar aliquet\r\n iaculis, odio lacus iaculis nisi, vitae tincidunt metus lectus id \r\nneque. Duis non quam luctus, volutpat est ut, maximus metus. Nullam \r\naliquam, lectus nec facilisis convallis, ipsum nulla varius urna, at \r\nscelerisque dui nisi at risus. In euismod pretium malesuada.\r\n</p><p><br></p><h3>Integer pellentesque arcu metus. Maecenas</h3><p>Integer fermentum nisl nec magna dapibus suscipit. Nunc eleifend odio vel\r\n tortor pharetra consequat id sit amet nisi. Sed consequat justo in \r\ncursus tincidunt. Phasellus in congue massa. Sed imperdiet ipsum massa, \r\nut tincidunt mauris luctus ut. Vivamus convallis, mi porttitor ultricies\r\n vulputate, arcu metus aliquam diam, vitae mollis dui nunc eu felis. \r\nPellentesque habitant morbi tristique senectus et netus et malesuada \r\nfames ac turpis egestas. Donec quis purus ante. Cras ut urna tempus, \r\npretium lorem in, imperdiet odio. Proin et justo porttitor, consequat \r\neros quis, tempor lectus. Vestibulum ante ipsum primis in faucibus orci \r\nluctus et ultrices posuere cubilia Curae; Vivamus pretium enim laoreet, \r\nullamcorper tortor nec, bibendum odio. Nunc tempor, magna eu malesuada \r\nvenenatis, ex odio vestibulum felis, non dictum augue ante non lacus. \r\nSed eleifend est felis, eget hendrerit erat malesuada a.\r\n</p><p><br></p><p><br></p>')");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE about_us DROP full_description');
    }
}
