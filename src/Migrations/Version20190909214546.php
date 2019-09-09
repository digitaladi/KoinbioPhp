<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190909214546 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, corp LONGTEXT NOT NULL, is_actif TINYINT(1) NOT NULL, auteur VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, plant_name VARCHAR(255) NOT NULL, plant_scientist_name VARCHAR(255) NOT NULL, origin VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, exposed_temperature INT DEFAULT NULL, arrosage VARCHAR(255) NOT NULL, relative_humidity INT NOT NULL, emplacement VARCHAR(255) NOT NULL, descriptif LONGTEXT NOT NULL, saison_floraison VARCHAR(255) NOT NULL, ground VARCHAR(255) NOT NULL, servicing VARCHAR(255) NOT NULL, insolation VARCHAR(255) NOT NULL, is_semis TINYINT(1) NOT NULL, is_medicinale TINYINT(1) NOT NULL, create_at DATETIME NOT NULL, conseil VARCHAR(255) NOT NULL, INDEX IDX_4C13CC789D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, phone_number INT DEFAULT NULL, street_number INT NOT NULL, street_type VARCHAR(255) DEFAULT NULL, street_name VARCHAR(255) DEFAULT NULL, postal_code INT DEFAULT NULL, commune VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC789D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC789D86650F');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE fiche');
        $this->addSql('DROP TABLE user');
    }
}
