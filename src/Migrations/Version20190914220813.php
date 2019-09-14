<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190914220813 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie_article (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, icone VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_fiche (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE derive_fiche (id INT AUTO_INCREMENT NOT NULL, id_fiche_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, preparation LONGTEXT DEFAULT NULL, INDEX IDX_B726B32A8F89C99D (id_fiche_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE receptable_plante (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, matiere VARCHAR(255) DEFAULT NULL, forme VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_plantes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, descriptif LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE derive_fiche ADD CONSTRAINT FK_B726B32A8F89C99D FOREIGN KEY (id_fiche_id) REFERENCES fiche (id)');
        $this->addSql('ALTER TABLE article ADD id_categorie_article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66E0ADBD94 FOREIGN KEY (id_categorie_article_id) REFERENCES categorie_article (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66E0ADBD94 ON article (id_categorie_article_id)');
        $this->addSql('ALTER TABLE commentaire ADD id_article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCD71E064B FOREIGN KEY (id_article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_67F068BCD71E064B ON commentaire (id_article_id)');
        $this->addSql('ALTER TABLE fiche ADD type_plante_id INT DEFAULT NULL, ADD id_receptable_plante_id INT DEFAULT NULL, ADD id_categorie_fiche_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78A3BD57F8 FOREIGN KEY (type_plante_id) REFERENCES type_plantes (id)');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC7840A43747 FOREIGN KEY (id_receptable_plante_id) REFERENCES receptable_plante (id)');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC7864F7D6CD FOREIGN KEY (id_categorie_fiche_id) REFERENCES categorie_fiche (id)');
        $this->addSql('CREATE INDEX IDX_4C13CC78A3BD57F8 ON fiche (type_plante_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C13CC7840A43747 ON fiche (id_receptable_plante_id)');
        $this->addSql('CREATE INDEX IDX_4C13CC7864F7D6CD ON fiche (id_categorie_fiche_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66E0ADBD94');
        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC7864F7D6CD');
        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC7840A43747');
        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC78A3BD57F8');
        $this->addSql('DROP TABLE categorie_article');
        $this->addSql('DROP TABLE categorie_fiche');
        $this->addSql('DROP TABLE derive_fiche');
        $this->addSql('DROP TABLE receptable_plante');
        $this->addSql('DROP TABLE type_plantes');
        $this->addSql('DROP INDEX IDX_23A0E66E0ADBD94 ON article');
        $this->addSql('ALTER TABLE article DROP id_categorie_article_id');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCD71E064B');
        $this->addSql('DROP INDEX IDX_67F068BCD71E064B ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP id_article_id');
        $this->addSql('DROP INDEX IDX_4C13CC78A3BD57F8 ON fiche');
        $this->addSql('DROP INDEX UNIQ_4C13CC7840A43747 ON fiche');
        $this->addSql('DROP INDEX IDX_4C13CC7864F7D6CD ON fiche');
        $this->addSql('ALTER TABLE fiche DROP type_plante_id, DROP id_receptable_plante_id, DROP id_categorie_fiche_id');
    }
}
