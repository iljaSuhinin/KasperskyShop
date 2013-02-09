<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130209014601 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql", "Migration can only be executed safely on 'postgresql'.");
        
        $this->addSql("CREATE SEQUENCE content_property_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE TABLE content_property (id INT NOT NULL, name VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))");
        $this->addSql("ALTER TABLE sylius_product_property DROP CONSTRAINT FK_8109D8F3549213EC");
        $this->addSql("ALTER TABLE sylius_product_property ADD CONSTRAINT FK_8109D8F3549213EC FOREIGN KEY (property_id) REFERENCES content_property (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_prototype_property DROP CONSTRAINT FK_99041F2A549213EC");
        $this->addSql("ALTER TABLE sylius_prototype_property ADD CONSTRAINT FK_99041F2A549213EC FOREIGN KEY (property_id) REFERENCES content_property (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql", "Migration can only be executed safely on 'postgresql'.");
        
        $this->addSql("ALTER TABLE sylius_product_property DROP CONSTRAINT FK_8109D8F3549213EC");
        $this->addSql("ALTER TABLE sylius_prototype_property DROP CONSTRAINT FK_99041F2A549213EC");
        $this->addSql("DROP SEQUENCE content_property_id_seq");
        $this->addSql("DROP TABLE content_property");
        $this->addSql("ALTER TABLE sylius_product_property DROP CONSTRAINT fk_8109d8f3549213ec");
        $this->addSql("ALTER TABLE sylius_product_property ADD CONSTRAINT fk_8109d8f3549213ec FOREIGN KEY (property_id) REFERENCES sylius_property (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_prototype_property DROP CONSTRAINT fk_99041f2a549213ec");
        $this->addSql("ALTER TABLE sylius_prototype_property ADD CONSTRAINT fk_99041f2a549213ec FOREIGN KEY (property_id) REFERENCES sylius_property (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
    }
}
