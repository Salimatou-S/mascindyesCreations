<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220602091125 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE taille (id INT AUTO_INCREMENT NOT NULL, ts VARCHAR(3) DEFAULT NULL, tm VARCHAR(3) DEFAULT NULL, tl VARCHAR(3) DEFAULT NULL, txl VARCHAR(3) DEFAULT NULL, txxl VARCHAR(3) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille_produit (taille_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_FBC8E602FF25611A (taille_id), INDEX IDX_FBC8E602F347EFB (produit_id), PRIMARY KEY(taille_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE taille_produit ADD CONSTRAINT FK_FBC8E602FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE taille_produit ADD CONSTRAINT FK_FBC8E602F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit DROP taille');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taille_produit DROP FOREIGN KEY FK_FBC8E602FF25611A');
        $this->addSql('DROP TABLE taille');
        $this->addSql('DROP TABLE taille_produit');
        $this->addSql('ALTER TABLE produit ADD taille VARCHAR(10) NOT NULL');
    }
}
