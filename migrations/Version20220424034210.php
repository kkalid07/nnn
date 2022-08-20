<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220424034210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dislikes DROP FOREIGN KEY FK_2DF3BE1183FDE077');
        $this->addSql('ALTER TABLE dislikes ADD CONSTRAINT FK_2DF3BE1183FDE077 FOREIGN KEY (pub_id) REFERENCES publication (id)');
        $this->addSql('ALTER TABLE publication ADD image VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dislikes DROP FOREIGN KEY FK_2DF3BE1183FDE077');
        $this->addSql('ALTER TABLE dislikes ADD CONSTRAINT FK_2DF3BE1183FDE077 FOREIGN KEY (pub_id) REFERENCES publication (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE publication DROP image');
    }
}
