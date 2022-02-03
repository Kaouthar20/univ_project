<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220202104353 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E37A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('CREATE INDEX IDX_717E22E37A45358C ON etudiant (groupe_id)');
        $this->addSql('ALTER TABLE note ADD professeur_id INT NOT NULL');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA14BAB22EE9 ON note (professeur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E37A45358C');
        $this->addSql('DROP INDEX IDX_717E22E37A45358C ON etudiant');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14BAB22EE9');
        $this->addSql('DROP INDEX IDX_CFBDFA14BAB22EE9 ON note');
        $this->addSql('ALTER TABLE note DROP professeur_id');
    }
}
