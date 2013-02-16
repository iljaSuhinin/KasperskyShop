<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130216135628 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql", "Migration can only be executed safely on 'postgresql'.");
        
        $this->addSql("ALTER TABLE content_product ADD category_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE content_product ADD CONSTRAINT FK_C42DD1E12469DE2 FOREIGN KEY (category_id) REFERENCES content_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("CREATE INDEX IDX_C42DD1E12469DE2 ON content_product (category_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql", "Migration can only be executed safely on 'postgresql'.");

        $this->addSql("ALTER TABLE content_product DROP category_id");
        $this->addSql("ALTER TABLE content_product DROP CONSTRAINT FK_C42DD1E12469DE2");
        $this->addSql("DROP INDEX IDX_C42DD1E12469DE2");
    }
}
