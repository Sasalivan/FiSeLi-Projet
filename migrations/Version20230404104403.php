<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230404104403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE genre_serie (id INT AUTO_INCREMENT NOT NULL, nom_genre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie (id INT AUTO_INCREMENT NOT NULL, type_serie_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, titre_original VARCHAR(255) DEFAULT NULL, episode INT NOT NULL, duree_ep INT NOT NULL, pays_origine VARCHAR(255) DEFAULT NULL, date_sortie VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, status VARCHAR(20) NOT NULL, INDEX IDX_AA3A933414BCAF41 (type_serie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie_genre_serie (serie_id INT NOT NULL, genre_serie_id INT NOT NULL, INDEX IDX_1000BEA2D94388BD (serie_id), INDEX IDX_1000BEA26A1E7700 (genre_serie_id), PRIMARY KEY(serie_id, genre_serie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status_serie (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, serie_id INT DEFAULT NULL, nb_episode_user INT DEFAULT NULL, nom_status VARCHAR(255) DEFAULT NULL, INDEX IDX_5D60C2C4A76ED395 (user_id), INDEX IDX_5D60C2C4D94388BD (serie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_serie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE serie ADD CONSTRAINT FK_AA3A933414BCAF41 FOREIGN KEY (type_serie_id) REFERENCES type_serie (id)');
        $this->addSql('ALTER TABLE serie_genre_serie ADD CONSTRAINT FK_1000BEA2D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_genre_serie ADD CONSTRAINT FK_1000BEA26A1E7700 FOREIGN KEY (genre_serie_id) REFERENCES genre_serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE status_serie ADD CONSTRAINT FK_5D60C2C4A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE status_serie ADD CONSTRAINT FK_5D60C2C4D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE serie DROP FOREIGN KEY FK_AA3A933414BCAF41');
        $this->addSql('ALTER TABLE serie_genre_serie DROP FOREIGN KEY FK_1000BEA2D94388BD');
        $this->addSql('ALTER TABLE serie_genre_serie DROP FOREIGN KEY FK_1000BEA26A1E7700');
        $this->addSql('ALTER TABLE status_serie DROP FOREIGN KEY FK_5D60C2C4A76ED395');
        $this->addSql('ALTER TABLE status_serie DROP FOREIGN KEY FK_5D60C2C4D94388BD');
        $this->addSql('DROP TABLE genre_serie');
        $this->addSql('DROP TABLE serie');
        $this->addSql('DROP TABLE serie_genre_serie');
        $this->addSql('DROP TABLE status_serie');
        $this->addSql('DROP TABLE type_serie');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
