<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329140923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE serie ADD CONSTRAINT FK_AA3A933414BCAF41 FOREIGN KEY (type_serie_id) REFERENCES type_serie (id)');
        $this->addSql('CREATE INDEX IDX_AA3A933414BCAF41 ON serie (type_serie_id)');
        $this->addSql('ALTER TABLE status_episode ADD user_episode_id INT DEFAULT NULL, ADD stat_ep_serie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE status_episode ADD CONSTRAINT FK_D57A6B5F914CA44C FOREIGN KEY (user_episode_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE status_episode ADD CONSTRAINT FK_D57A6B5F750528D0 FOREIGN KEY (stat_ep_serie_id) REFERENCES serie (id)');
        $this->addSql('CREATE INDEX IDX_D57A6B5F914CA44C ON status_episode (user_episode_id)');
        $this->addSql('CREATE INDEX IDX_D57A6B5F750528D0 ON status_episode (stat_ep_serie_id)');
        $this->addSql('ALTER TABLE status_user ADD stat_utilisateur_serie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE status_user ADD CONSTRAINT FK_B5957BDD5177029F FOREIGN KEY (stat_utilisateur_serie_id) REFERENCES `user` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B5957BDD5177029F ON status_user (stat_utilisateur_serie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE serie DROP FOREIGN KEY FK_AA3A933414BCAF41');
        $this->addSql('DROP INDEX IDX_AA3A933414BCAF41 ON serie');
        $this->addSql('ALTER TABLE status_episode DROP FOREIGN KEY FK_D57A6B5F914CA44C');
        $this->addSql('ALTER TABLE status_episode DROP FOREIGN KEY FK_D57A6B5F750528D0');
        $this->addSql('DROP INDEX IDX_D57A6B5F914CA44C ON status_episode');
        $this->addSql('DROP INDEX IDX_D57A6B5F750528D0 ON status_episode');
        $this->addSql('ALTER TABLE status_episode DROP user_episode_id, DROP stat_ep_serie_id');
        $this->addSql('ALTER TABLE status_user DROP FOREIGN KEY FK_B5957BDD5177029F');
        $this->addSql('DROP INDEX UNIQ_B5957BDD5177029F ON status_user');
        $this->addSql('ALTER TABLE status_user DROP stat_utilisateur_serie_id');
    }
}
