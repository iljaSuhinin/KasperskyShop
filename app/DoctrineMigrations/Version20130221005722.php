<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130221005722 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql", "Migration can only be executed safely on 'postgresql'.");
        
        $this->addSql("ALTER TABLE content_discount ADD variant_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE content_discount ADD CONSTRAINT FK_B3575EE13B69A9AF FOREIGN KEY (variant_id) REFERENCES content_variant (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("CREATE INDEX IDX_B3575EE13B69A9AF ON content_discount (variant_id)");
        $this->addSql("ALTER TABLE content_variant DROP options");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql", "Migration can only be executed safely on 'postgresql'.");

        $this->addSql("ALTER TABLE content_discount DROP variant_id");
        $this->addSql("ALTER TABLE content_discount DROP CONSTRAINT FK_B3575EE13B69A9AF");
        $this->addSql("DROP INDEX IDX_B3575EE13B69A9AF");
        $this->addSql("ALTER TABLE content_variant ADD options TEXT DEFAULT NULL");
        $this->addSql("COMMENT ON COLUMN content_variant.options IS '(DC2Type:array)'");
    }
}
