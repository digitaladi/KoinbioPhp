<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200921114653 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, categorie_article_id INT DEFAULT NULL, image VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, titre VARCHAR(255) NOT NULL, corp LONGTEXT NOT NULL, is_actif TINYINT(1) NOT NULL, auteur VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, source VARCHAR(255) DEFAULT NULL, INDEX IDX_23A0E66EC5D4C30 (categorie_article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_article (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, icone VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_fiche (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, article_id INT DEFAULT NULL, fiche_id INT DEFAULT NULL, comment LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_67F068BCA76ED395 (user_id), INDEX IDX_67F068BC7294869C (article_id), INDEX IDX_67F068BCDF522508 (fiche_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE derive_fiche (id INT AUTO_INCREMENT NOT NULL, fiche_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, preparation LONGTEXT DEFAULT NULL, INDEX IDX_B726B32ADF522508 (fiche_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche (id INT AUTO_INCREMENT NOT NULL, type_plante_id INT DEFAULT NULL, receptable_plante_id INT DEFAULT NULL, categorie_fiche_id INT DEFAULT NULL, image VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, plant_name VARCHAR(255) DEFAULT NULL, plant_scientist_name VARCHAR(255) DEFAULT NULL, origin VARCHAR(255) DEFAULT NULL, exposed_temperature INT DEFAULT NULL, arrosage VARCHAR(255) DEFAULT NULL, relative_humidity INT DEFAULT NULL, emplacement VARCHAR(255) DEFAULT NULL, descriptif LONGTEXT DEFAULT NULL, saison_floraison VARCHAR(255) DEFAULT NULL, ground VARCHAR(255) DEFAULT NULL, servicing VARCHAR(255) DEFAULT NULL, insolation VARCHAR(255) DEFAULT NULL, is_semis TINYINT(1) DEFAULT NULL, is_medicinale TINYINT(1) DEFAULT NULL, create_at DATETIME NOT NULL, conseil VARCHAR(255) DEFAULT NULL, INDEX IDX_4C13CC78A3BD57F8 (type_plante_id), UNIQUE INDEX UNIQ_4C13CC784C54C6E3 (receptable_plante_id), INDEX IDX_4C13CC78E7D56462 (categorie_fiche_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE receptable_plante (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, matiere VARCHAR(255) DEFAULT NULL, forme VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE response_commentaire (id INT AUTO_INCREMENT NOT NULL, icommentaire_id INT DEFAULT NULL, response LONGTEXT NOT NULL, INDEX IDX_C729723388B8F93C (icommentaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_plantes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, descriptif LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, phone_number INT DEFAULT NULL, street_number INT DEFAULT NULL, street_type VARCHAR(255) DEFAULT NULL, street_name VARCHAR(255) DEFAULT NULL, postal_code INT DEFAULT NULL, commune VARCHAR(255) DEFAULT NULL, username VARCHAR(255) NOT NULL, actif TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_fiche (user_id INT NOT NULL, fiche_id INT NOT NULL, INDEX IDX_AED13720A76ED395 (user_id), INDEX IDX_AED13720DF522508 (fiche_id), PRIMARY KEY(user_id, fiche_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66EC5D4C30 FOREIGN KEY (categorie_article_id) REFERENCES categorie_article (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCDF522508 FOREIGN KEY (fiche_id) REFERENCES fiche (id)');
        $this->addSql('ALTER TABLE derive_fiche ADD CONSTRAINT FK_B726B32ADF522508 FOREIGN KEY (fiche_id) REFERENCES fiche (id)');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78A3BD57F8 FOREIGN KEY (type_plante_id) REFERENCES type_plantes (id)');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC784C54C6E3 FOREIGN KEY (receptable_plante_id) REFERENCES receptable_plante (id)');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78E7D56462 FOREIGN KEY (categorie_fiche_id) REFERENCES categorie_fiche (id)');
        $this->addSql('ALTER TABLE response_commentaire ADD CONSTRAINT FK_C729723388B8F93C FOREIGN KEY (icommentaire_id) REFERENCES commentaire (id)');
        $this->addSql('ALTER TABLE user_fiche ADD CONSTRAINT FK_AED13720A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_fiche ADD CONSTRAINT FK_AED13720DF522508 FOREIGN KEY (fiche_id) REFERENCES fiche (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC7294869C');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66EC5D4C30');
        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC78E7D56462');
        $this->addSql('ALTER TABLE response_commentaire DROP FOREIGN KEY FK_C729723388B8F93C');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCDF522508');
        $this->addSql('ALTER TABLE derive_fiche DROP FOREIGN KEY FK_B726B32ADF522508');
        $this->addSql('ALTER TABLE user_fiche DROP FOREIGN KEY FK_AED13720DF522508');
        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC784C54C6E3');
        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC78A3BD57F8');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA76ED395');
        $this->addSql('ALTER TABLE user_fiche DROP FOREIGN KEY FK_AED13720A76ED395');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE categorie_article');
        $this->addSql('DROP TABLE categorie_fiche');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE derive_fiche');
        $this->addSql('DROP TABLE fiche');
        $this->addSql('DROP TABLE receptable_plante');
        $this->addSql('DROP TABLE response_commentaire');
        $this->addSql('DROP TABLE type_plantes');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_fiche');
    }
}
