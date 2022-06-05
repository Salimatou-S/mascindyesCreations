<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220603125304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produit_taille (produit_id INT NOT NULL, taille_id INT NOT NULL, INDEX IDX_81024002F347EFB (produit_id), INDEX IDX_81024002FF25611A (taille_id), PRIMARY KEY(produit_id, taille_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit_taille ADD CONSTRAINT FK_81024002F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_taille ADD CONSTRAINT FK_81024002FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE produit_taille');
    }
}
