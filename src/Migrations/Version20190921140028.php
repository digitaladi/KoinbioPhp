<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190921140028 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE firstname firstname VARCHAR(255) NOT NULL, CHANGE lastname lastname VARCHAR(255) NOT NULL, CHANGE phone_number phone_number INT NOT NULL, CHANGE street_number street_number INT NOT NULL, CHANGE street_type street_type VARCHAR(255) NOT NULL, CHANGE street_name street_name VARCHAR(255) NOT NULL, CHANGE postal_code postal_code INT NOT NULL, CHANGE commune commune VARCHAR(255) NOT NULL, CHANGE username username VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE firstname firstname VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE lastname lastname VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE phone_number phone_number INT DEFAULT NULL, CHANGE street_number street_number INT DEFAULT NULL, CHANGE street_type street_type VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE street_name street_name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE postal_code postal_code INT DEFAULT NULL, CHANGE commune commune VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE username username VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
