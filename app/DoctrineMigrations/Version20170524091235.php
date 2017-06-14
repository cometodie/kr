<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170524091235 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bid CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE event CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE news CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE ticket DROP INDEX UNIQ_97A0ADA3A76ED395, ADD INDEX IDX_97A0ADA3A76ED395 (user_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bid CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE event CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE news CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE ticket DROP INDEX IDX_97A0ADA3A76ED395, ADD UNIQUE INDEX UNIQ_97A0ADA3A76ED395 (user_id)');
    }
}
