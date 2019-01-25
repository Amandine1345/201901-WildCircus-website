<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190124153622 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE about_us ADD image_banner VARCHAR(255) DEFAULT NULL');
        $this->addSql("INSERT INTO `about_us` VALUES (1,'About Us','Aliquam maximus pellentesque eros nec fringilla. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed dignissim purus vel turpis scelerisque sagittis. Pellentesque feugiat eros mi, eget tempus ipsum feugiat at. Fusce placerat diam turpis, vel egestas sapien scelerisque sit amet. Integer faucibus ornare justo, tincidunt commodo diam fermentum id. Curabitur libero magna, mollis in elit congue, cursus mattis metus. Aenean rutrum blandit diam. In ac volutpat libero.','5c49d6a01be15403479428.jpg','2019-01-24 16:40:45','<h2>Integer a leo ac enim.</h2><div class=\"row\"><div class=\"col-lg-6\"><p class=\"text-center\"><img class=\"img-fluid img-thumbnail\" src=\"https://media.giphy.com/media/l0Exw6GpyKeJGRec8/giphy.gif\" alt=\"\"></p></div><div class=\"col-lg-6\"><p>Per hoc minui studium suum existimans Paulus, ut erat in conplicandis negotiis artifex dirus, unde ei Catenae inditum est cognomentum, vicarium ipsum eos quibus praeerat adhuc defensantem ad sortem periculorum communium traxit. et instabat ut eum quoque cum tribunis et aliis pluribus ad comitatum imperatoris vinctum perduceret: quo percitus ille exitio urgente abrupto ferro eundem adoritur Paulum. et quia languente dextera, letaliter ferire non potuit, iam districtum mucronem in proprium latus inpegit. hocque deformi genere mortis excessit e vita iustissimus rector ausus miserabiles casus levare multorum.</p><p>Et est admodum mirum videre plebem innumeram mentibus ardore quodam infuso cum dimicationum curulium eventu pendentem. haec similiaque memorabile nihil vel serium agi Romae permittunt. ergo redeundum ad textum.</p></div></div><p><br></p><h3>Integer pellentesque arcu metus. Maecenas</h3><div class=\"row\"><div class=\"col-lg-3 col-6 text-center\"><img class=\"img-fluid img-thumbnail\" src=\"https://media.giphy.com/media/ftGTY1fO9ARUI/giphy.gif\" alt=\"\"></div><div class=\"col-lg-3 col-6 text-center\"><img class=\"img-fluid img-thumbnail\" src=\"https://media.giphy.com/media/S7i2sED2yfDGg/giphy.gif\" alt=\"\"></div><div class=\"col-lg-3 col-6 text-center\"><img class=\"img-fluid img-thumbnail\" src=\"https://media.giphy.com/media/QJuk6WJuIi5Ow/giphy.gif\" alt=\"\"></div><div class=\"col-lg-3 col-6 text-center\"><img class=\"img-fluid img-thumbnail\" src=\"https://media0.giphy.com/media/uiOhnAT6xTJsI/giphy.gif\" alt=\"\"></div></div><p>Integer fermentum nisl nec magna dapibus suscipit. Nunc eleifend odio vel tortor pharetra consequat id sit amet nisi. Sed consequat justo in cursus tincidunt. Phasellus in congue massa. Sed imperdiet ipsum massa, ut tincidunt mauris luctus ut. Vivamus convallis, mi porttitor ultricies vulputate, arcu metus aliquam diam, vitae mollis dui nunc eu felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec quis purus ante. Cras ut urna tempus, pretium lorem in, imperdiet odio. Proin et justo porttitor, consequat eros quis, tempor lectus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus pretium enim laoreet, ullamcorper tortor nec, bibendum odio. Nunc tempor, magna eu malesuada venenatis, ex odio vestibulum felis, non dictum augue ante non lacus. Sed eleifend est felis, eget hendrerit erat malesuada a.</p>','5c49dc7d4814c404478860.jpg')");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE about_us DROP image_banner');
    }
}
