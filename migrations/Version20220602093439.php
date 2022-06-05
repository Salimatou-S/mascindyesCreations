<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220602093439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taille ADD taille VARCHAR(5) DEFAULT NULL, DROP ts, DROP tm, DROP tl, DROP txl, DROP txxl');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taille ADD ts VARCHAR(3) DEFAULT NULL, ADD tm VARCHAR(3) DEFAULT NULL, ADD tl VARCHAR(3) DEFAULT NULL, ADD txl VARCHAR(3) DEFAULT NULL, ADD txxl VARCHAR(3) DEFAULT NULL, DROP taille');
    }
}
