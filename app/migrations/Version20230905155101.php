<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230905155101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE books (id INT AUTO_INCREMENT NOT NULL, genre_id INT NOT NULL, publisher_id INT NOT NULL, creator_id INT NOT NULL, author_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_4A1B2A924296D31F (genre_id), INDEX IDX_4A1B2A9240C86FCE (publisher_id), INDEX IDX_4A1B2A9261220EA6 (creator_id), INDEX IDX_4A1B2A92F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE creators (id INT AUTO_INCREMENT NOT NULL, nick VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX uq_creators_nick (nick), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genres (id INT AUTO_INCREMENT NOT NULL, genre_title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publishers (id INT AUTO_INCREMENT NOT NULL, publisher_title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations (id INT AUTO_INCREMENT NOT NULL, book_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, nick VARCHAR(255) NOT NULL, note LONGTEXT DEFAULT NULL, INDEX IDX_4DA23916A2B381 (book_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX email_idx (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE books ADD CONSTRAINT FK_4A1B2A924296D31F FOREIGN KEY (genre_id) REFERENCES genres (id)');
        $this->addSql('ALTER TABLE books ADD CONSTRAINT FK_4A1B2A9240C86FCE FOREIGN KEY (publisher_id) REFERENCES publishers (id)');
        $this->addSql('ALTER TABLE books ADD CONSTRAINT FK_4A1B2A9261220EA6 FOREIGN KEY (creator_id) REFERENCES creators (id)');
        $this->addSql('ALTER TABLE books ADD CONSTRAINT FK_4A1B2A92F675F31B FOREIGN KEY (author_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA23916A2B381 FOREIGN KEY (book_id) REFERENCES books (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE books DROP FOREIGN KEY FK_4A1B2A924296D31F');
        $this->addSql('ALTER TABLE books DROP FOREIGN KEY FK_4A1B2A9240C86FCE');
        $this->addSql('ALTER TABLE books DROP FOREIGN KEY FK_4A1B2A9261220EA6');
        $this->addSql('ALTER TABLE books DROP FOREIGN KEY FK_4A1B2A92F675F31B');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23916A2B381');
        $this->addSql('DROP TABLE books');
        $this->addSql('DROP TABLE creators');
        $this->addSql('DROP TABLE genres');
        $this->addSql('DROP TABLE publishers');
        $this->addSql('DROP TABLE reservations');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
