<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170523195651 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bid CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE event CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE news CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE ticket ADD user_id INT DEFAULT NULL, DROP Person');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_97A0ADA3A76ED395 ON ticket (user_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bid CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE event CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE news CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3A76ED395');
        $this->addSql('DROP INDEX UNIQ_97A0ADA3A76ED395 ON ticket');
        $this->addSql('ALTER TABLE ticket ADD Person LONGTEXT NOT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:object)\', DROP user_id');
    }
}
