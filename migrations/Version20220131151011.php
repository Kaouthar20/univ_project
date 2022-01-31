<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220131151011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE groupe_professeur (groupe_id INT NOT NULL, professeur_id INT NOT NULL, INDEX IDX_AF4863457A45358C (groupe_id), INDEX IDX_AF486345BAB22EE9 (professeur_id), PRIMARY KEY(groupe_id, professeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE groupe_professeur ADD CONSTRAINT FK_AF4863457A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe_professeur ADD CONSTRAINT FK_AF486345BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etudiant ADD groupe_id INT NOT NULL');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E37A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('CREATE INDEX IDX_717E22E37A45358C ON etudiant (groupe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE groupe_professeur');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E37A45358C');
        $this->addSql('DROP INDEX IDX_717E22E37A45358C ON etudiant');
        $this->addSql('ALTER TABLE etudiant DROP groupe_id');
    }
}
