<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130216143131 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql", "Migration can only be executed safely on 'postgresql'.");
        
        $this->addSql("ALTER TABLE content_product ADD brief TEXT NOT NULL");
        $this->addSql("ALTER TABLE content_product ADD links TEXT NOT NULL");
        $this->addSql("ALTER TABLE content_product ADD information TEXT NOT NULL");
        $this->addSql("ALTER TABLE content_product ADD disabled BOOLEAN DEFAULT NULL");
        $this->addSql("ALTER TABLE content_product ADD onMain BOOLEAN DEFAULT NULL");
        $this->addSql("ALTER TABLE content_product ADD sku INT NOT NULL");
        $this->addSql("ALTER TABLE content_product ADD view INT NOT NULL");
        $this->addSql("ALTER TABLE content_product RENAME COLUMN image_id TO fullview_id");
        $this->addSql("ALTER TABLE content_product DROP CONSTRAINT fk_c42dd1e3da5256d");
        $this->addSql("DROP INDEX idx_c42dd1e3da5256d");
        $this->addSql("ALTER TABLE content_product ADD CONSTRAINT FK_C42DD1ECDE46FDB FOREIGN KEY (preview_id) REFERENCES content_media_media (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE content_product ADD CONSTRAINT FK_C42DD1E60ECA3B6 FOREIGN KEY (fullview_id) REFERENCES content_media_media (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("CREATE INDEX IDX_C42DD1ECDE46FDB ON content_product (preview_id)");
        $this->addSql("CREATE INDEX IDX_C42DD1E60ECA3B6 ON content_product (fullview_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql", "Migration can only be executed safely on 'postgresql'.");

        $this->addSql("ALTER TABLE content_product ADD image_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE content_product DROP preview_id");
        $this->addSql("ALTER TABLE content_product DROP fullview_id");
        $this->addSql("ALTER TABLE content_product DROP brief");
        $this->addSql("ALTER TABLE content_product DROP links");
        $this->addSql("ALTER TABLE content_product DROP information");
        $this->addSql("ALTER TABLE content_product DROP disabled");
        $this->addSql("ALTER TABLE content_product DROP onMain");
        $this->addSql("ALTER TABLE content_product DROP sku");
        $this->addSql("ALTER TABLE content_product DROP view");
        $this->addSql("ALTER TABLE content_product DROP CONSTRAINT FK_C42DD1ECDE46FDB");
        $this->addSql("ALTER TABLE content_product DROP CONSTRAINT FK_C42DD1E60ECA3B6");
        $this->addSql("DROP INDEX IDX_C42DD1ECDE46FDB");
        $this->addSql("DROP INDEX IDX_C42DD1E60ECA3B6");
        $this->addSql("ALTER TABLE content_product ADD CONSTRAINT fk_c42dd1e3da5256d FOREIGN KEY (image_id) REFERENCES content_media_media (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("CREATE INDEX idx_c42dd1e3da5256d ON content_product (image_id)");
    }
}
