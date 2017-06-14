<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170523171810 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(20) NOT NULL, date DATETIME NOT NULL, numberOfTickets INT NOT NULL, remainingTickets INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(150) NOT NULL, description LONGTEXT NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, event_id INT DEFAULT NULL, Person LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', number INT NOT NULL, sold TINYINT(1) NOT NULL, cost INT NOT NULL, UNIQUE INDEX UNIQ_97A0ADA371F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA371F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE bid CHANGE date date DATETIME NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA371F7E88B');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('ALTER TABLE bid CHANGE date date DATETIME NOT NULL');
    }
}
