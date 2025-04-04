<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250404123528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE like_entity ADD post_id INT NOT NULL, ADD user_id INT NOT NULL, DROP likes, DROP users, DROP posts
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE like_entity ADD CONSTRAINT FK_30F1579A4B89032C FOREIGN KEY (post_id) REFERENCES post_entity (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE like_entity ADD CONSTRAINT FK_30F1579AA76ED395 FOREIGN KEY (user_id) REFERENCES user_entity (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_30F1579A4B89032C ON like_entity (post_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_30F1579AA76ED395 ON like_entity (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE post_entity ADD user_id INT NOT NULL, DROP likes, DROP comments, DROP users, CHANGE date date DATETIME NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE post_entity ADD CONSTRAINT FK_3E0AA00DA76ED395 FOREIGN KEY (user_id) REFERENCES user_entity (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_3E0AA00DA76ED395 ON post_entity (user_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE like_entity DROP FOREIGN KEY FK_30F1579A4B89032C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE like_entity DROP FOREIGN KEY FK_30F1579AA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_30F1579A4B89032C ON like_entity
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_30F1579AA76ED395 ON like_entity
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE like_entity ADD likes VARCHAR(255) NOT NULL, ADD users VARCHAR(255) NOT NULL, ADD posts VARCHAR(255) NOT NULL, DROP post_id, DROP user_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE post_entity DROP FOREIGN KEY FK_3E0AA00DA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_3E0AA00DA76ED395 ON post_entity
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE post_entity ADD likes VARCHAR(255) NOT NULL, ADD comments VARCHAR(255) NOT NULL, ADD users VARCHAR(255) NOT NULL, DROP user_id, CHANGE date date VARCHAR(255) NOT NULL
        SQL);
    }
}
