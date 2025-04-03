<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250403121938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE like_entity ADD posts VARCHAR(255) NOT NULL, CHANGE likes likes VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE post_entity ADD caption VARCHAR(255) DEFAULT NULL, ADD comments VARCHAR(255) NOT NULL, ADD image VARCHAR(255) NOT NULL, ADD users VARCHAR(255) NOT NULL, DROP author, DROP content, CHANGE date date VARCHAR(255) NOT NULL, CHANGE likes likes VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_entity DROP email, DROP password, DROP posts
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE like_entity DROP posts, CHANGE likes likes INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE post_entity ADD author VARCHAR(255) NOT NULL, ADD content VARCHAR(255) NOT NULL, DROP caption, DROP comments, DROP image, DROP users, CHANGE date date DATETIME NOT NULL, CHANGE likes likes INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_entity ADD email VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD posts VARCHAR(255) NOT NULL
        SQL);
    }
}
