<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201005104549 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fiche ADD taille INT DEFAULT NULL, ADD date_birth_or_buy DATETIME NOT NULL, ADD poid INT DEFAULT NULL, ADD is_actif TINYINT(1) DEFAULT NULL, ADD date_death DATETIME DEFAULT NULL, ADD reason_death LONGTEXT DEFAULT NULL, ADD why_fiche LONGTEXT DEFAULT NULL, ADD bienfaits LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE response_commentaire DROP FOREIGN KEY FK_C729723388B8F93C');
        $this->addSql('DROP INDEX IDX_C729723388B8F93C ON response_commentaire');
        $this->addSql('ALTER TABLE response_commentaire CHANGE icommentaire_id commentaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE response_commentaire ADD CONSTRAINT FK_C7297233BA9CD190 FOREIGN KEY (commentaire_id) REFERENCES commentaire (id)');
        $this->addSql('CREATE INDEX IDX_C7297233BA9CD190 ON response_commentaire (commentaire_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fiche DROP taille, DROP date_birth_or_buy, DROP poid, DROP is_actif, DROP date_death, DROP reason_death, DROP why_fiche, DROP bienfaits');
        $this->addSql('ALTER TABLE response_commentaire DROP FOREIGN KEY FK_C7297233BA9CD190');
        $this->addSql('DROP INDEX IDX_C7297233BA9CD190 ON response_commentaire');
        $this->addSql('ALTER TABLE response_commentaire CHANGE commentaire_id icommentaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE response_commentaire ADD CONSTRAINT FK_C729723388B8F93C FOREIGN KEY (icommentaire_id) REFERENCES commentaire (id)');
        $this->addSql('CREATE INDEX IDX_C729723388B8F93C ON response_commentaire (icommentaire_id)');
    }
}
