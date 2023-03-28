<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328144315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE genre_serie (id INT AUTO_INCREMENT NOT NULL, nom_genre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie_genre_serie (serie_id INT NOT NULL, genre_serie_id INT NOT NULL, INDEX IDX_1000BEA2D94388BD (serie_id), INDEX IDX_1000BEA26A1E7700 (genre_serie_id), PRIMARY KEY(serie_id, genre_serie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status_episode (id INT AUTO_INCREMENT NOT NULL, nb_episode_user INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status_user (id INT AUTO_INCREMENT NOT NULL, nom_status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_serie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE serie_genre_serie ADD CONSTRAINT FK_1000BEA2D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_genre_serie ADD CONSTRAINT FK_1000BEA26A1E7700 FOREIGN KEY (genre_serie_id) REFERENCES genre_serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie ADD type_serie_id INT NOT NULL, ADD image VARCHAR(255) DEFAULT NULL, ADD status VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE serie ADD CONSTRAINT FK_AA3A933414BCAF41 FOREIGN KEY (type_serie_id) REFERENCES type_serie (id)');
        $this->addSql('CREATE INDEX IDX_AA3A933414BCAF41 ON serie (type_serie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE serie DROP FOREIGN KEY FK_AA3A933414BCAF41');
        $this->addSql('ALTER TABLE serie_genre_serie DROP FOREIGN KEY FK_1000BEA2D94388BD');
        $this->addSql('ALTER TABLE serie_genre_serie DROP FOREIGN KEY FK_1000BEA26A1E7700');
        $this->addSql('DROP TABLE genre_serie');
        $this->addSql('DROP TABLE serie_genre_serie');
        $this->addSql('DROP TABLE status_episode');
        $this->addSql('DROP TABLE status_user');
        $this->addSql('DROP TABLE type_serie');
        $this->addSql('DROP INDEX IDX_AA3A933414BCAF41 ON serie');
        $this->addSql('ALTER TABLE serie DROP type_serie_id, DROP image, DROP status');
    }
}
