<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190914221455 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC7840A43747');
        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC7864F7D6CD');
        $this->addSql('DROP INDEX UNIQ_4C13CC7840A43747 ON fiche');
        $this->addSql('DROP INDEX IDX_4C13CC7864F7D6CD ON fiche');
        $this->addSql('ALTER TABLE fiche ADD receptable_plante_id INT DEFAULT NULL, ADD categorie_fiche_id INT DEFAULT NULL, DROP id_receptable_plante_id, DROP id_categorie_fiche_id');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC784C54C6E3 FOREIGN KEY (receptable_plante_id) REFERENCES receptable_plante (id)');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78E7D56462 FOREIGN KEY (categorie_fiche_id) REFERENCES categorie_fiche (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C13CC784C54C6E3 ON fiche (receptable_plante_id)');
        $this->addSql('CREATE INDEX IDX_4C13CC78E7D56462 ON fiche (categorie_fiche_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC784C54C6E3');
        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC78E7D56462');
        $this->addSql('DROP INDEX UNIQ_4C13CC784C54C6E3 ON fiche');
        $this->addSql('DROP INDEX IDX_4C13CC78E7D56462 ON fiche');
        $this->addSql('ALTER TABLE fiche ADD id_receptable_plante_id INT DEFAULT NULL, ADD id_categorie_fiche_id INT DEFAULT NULL, DROP receptable_plante_id, DROP categorie_fiche_id');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC7840A43747 FOREIGN KEY (id_receptable_plante_id) REFERENCES receptable_plante (id)');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC7864F7D6CD FOREIGN KEY (id_categorie_fiche_id) REFERENCES categorie_fiche (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C13CC7840A43747 ON fiche (id_receptable_plante_id)');
        $this->addSql('CREATE INDEX IDX_4C13CC7864F7D6CD ON fiche (id_categorie_fiche_id)');
    }
}
