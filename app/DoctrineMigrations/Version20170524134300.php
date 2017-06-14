<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170524134300 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE bid');
        $this->addSql('ALTER TABLE event CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE news CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA371F7E88B');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3A76ED395');
        $this->addSql('DROP INDEX UNIQ_97A0ADA371F7E88B ON ticket');
        $this->addSql('DROP INDEX UNIQ_97A0ADA3A76ED395 ON ticket');
        $this->addSql('ALTER TABLE ticket CHANGE event_id event_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bid (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, text LONGTEXT NOT NULL COLLATE utf8_unicode_ci, category VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, date DATETIME NOT NULL, INDEX IDX_4AF2B3F3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bid ADD CONSTRAINT FK_4AF2B3F3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE news CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE ticket CHANGE event_id event_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA371F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_97A0ADA371F7E88B ON ticket (event_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_97A0ADA3A76ED395 ON ticket (user_id)');
    }
}
