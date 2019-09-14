<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190911220342 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, comment LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_67F068BC9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE response_commentaire (id INT AUTO_INCREMENT NOT NULL, id_commentaire_id INT DEFAULT NULL, response LONGTEXT NOT NULL, INDEX IDX_C729723387FA6C96 (id_commentaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_fiche (user_id INT NOT NULL, fiche_id INT NOT NULL, INDEX IDX_AED13720A76ED395 (user_id), INDEX IDX_AED13720DF522508 (fiche_id), PRIMARY KEY(user_id, fiche_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE response_commentaire ADD CONSTRAINT FK_C729723387FA6C96 FOREIGN KEY (id_commentaire_id) REFERENCES commentaire (id)');
        $this->addSql('ALTER TABLE user_fiche ADD CONSTRAINT FK_AED13720A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_fiche ADD CONSTRAINT FK_AED13720DF522508 FOREIGN KEY (fiche_id) REFERENCES fiche (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC789D86650F');
        $this->addSql('DROP INDEX IDX_4C13CC789D86650F ON fiche');
        $this->addSql('ALTER TABLE fiche DROP user_id_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE response_commentaire DROP FOREIGN KEY FK_C729723387FA6C96');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE response_commentaire');
        $this->addSql('DROP TABLE user_fiche');
        $this->addSql('ALTER TABLE fiche ADD user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC789D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4C13CC789D86650F ON fiche (user_id_id)');
    }
}
