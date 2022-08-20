<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220511144603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, slug VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) DEFAULT NULL, contenu LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, update_at DATETIME DEFAULT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre_categories (offre_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_17AD214D4CC8505A (offre_id), INDEX IDX_17AD214DA21214B7 (categories_id), PRIMARY KEY(offre_id, categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE postulation (id INT AUTO_INCREMENT NOT NULL, offre_id INT NOT NULL, contenu LONGTEXT NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, rgpd TINYINT(1) NOT NULL, pseudo VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_DA7D4E9B4CC8505A (offre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offre_categories ADD CONSTRAINT FK_17AD214D4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre_categories ADD CONSTRAINT FK_17AD214DA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE postulation ADD CONSTRAINT FK_DA7D4E9B4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC83FDE077');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC83FDE077 FOREIGN KEY (pub_id) REFERENCES publication (id)');
        $this->addSql('ALTER TABLE publication CHANGE image image VARCHAR(255) NOT NULL, CHANGE updated_at updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_categories DROP FOREIGN KEY FK_17AD214DA21214B7');
        $this->addSql('ALTER TABLE offre_categories DROP FOREIGN KEY FK_17AD214D4CC8505A');
        $this->addSql('ALTER TABLE postulation DROP FOREIGN KEY FK_DA7D4E9B4CC8505A');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE offre_categories');
        $this->addSql('DROP TABLE postulation');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC83FDE077');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC83FDE077 FOREIGN KEY (pub_id) REFERENCES publication (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE publication CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL');
    }
}
