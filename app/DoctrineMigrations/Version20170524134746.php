<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170524134746 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, user_id INT NOT NULL, number INT NOT NULL, sold TINYINT(1) NOT NULL, cost INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE bid');
        $this->addSql('ALTER TABLE event CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE news CHANGE date date DATETIME NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bid (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, text LONGTEXT NOT NULL COLLATE utf8_unicode_ci, category VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, date DATETIME NOT NULL, INDEX IDX_4AF2B3F3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bid ADD CONSTRAINT FK_4AF2B3F3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('ALTER TABLE event CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE news CHANGE date date DATETIME NOT NULL');
    }
}
