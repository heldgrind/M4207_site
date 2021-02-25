<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210225103251 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE acces (id INT AUTO_INCREMENT NOT NULL, utilisateurs_id INT NOT NULL, authorisation_id INT NOT NULL, documents_id INT NOT NULL, INDEX IDX_D0F43B101E969C5 (utilisateurs_id), INDEX IDX_D0F43B108328B8E9 (authorisation_id), INDEX IDX_D0F43B105F0F2752 (documents_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE acces ADD CONSTRAINT FK_D0F43B101E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE acces ADD CONSTRAINT FK_D0F43B108328B8E9 FOREIGN KEY (authorisation_id) REFERENCES authorisation (id)');
        $this->addSql('ALTER TABLE acces ADD CONSTRAINT FK_D0F43B105F0F2752 FOREIGN KEY (documents_id) REFERENCES documents (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE acces');
    }
}
