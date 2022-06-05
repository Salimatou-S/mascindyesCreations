<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220603140322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656601AEC613E');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660CD11A2CF');
        $this->addSql('DROP INDEX IDX_4B365660CD11A2CF ON stock');
        $this->addSql('DROP INDEX IDX_4B3656601AEC613E ON stock');
        $this->addSql('ALTER TABLE stock ADD produit_id INT DEFAULT NULL, ADD taille_id INT DEFAULT NULL, DROP produits_id, DROP tailles_id');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id)');
        $this->addSql('CREATE INDEX IDX_4B365660F347EFB ON stock (produit_id)');
        $this->addSql('CREATE INDEX IDX_4B365660FF25611A ON stock (taille_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660F347EFB');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660FF25611A');
        $this->addSql('DROP INDEX IDX_4B365660F347EFB ON stock');
        $this->addSql('DROP INDEX IDX_4B365660FF25611A ON stock');
        $this->addSql('ALTER TABLE stock ADD produits_id INT DEFAULT NULL, ADD tailles_id INT DEFAULT NULL, DROP produit_id, DROP taille_id');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656601AEC613E FOREIGN KEY (tailles_id) REFERENCES taille (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660CD11A2CF FOREIGN KEY (produits_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_4B365660CD11A2CF ON stock (produits_id)');
        $this->addSql('CREATE INDEX IDX_4B3656601AEC613E ON stock (tailles_id)');
    }
}
