<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241012134738 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create personne table';
    }

    public function up(Schema $schema): void
    {
        // Check if the table already exists
        if (!$schema->hasTable('personne')) {
            $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone INT NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        }
    }

    public function down(Schema $schema): void
    {
        // Drop the table only if it exists
        if ($schema->hasTable('personne')) {
            $this->addSql('DROP TABLE personne');
        }
    }
}