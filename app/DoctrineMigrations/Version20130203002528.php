<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130203002528 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql", "Migration can only be executed safely on 'postgresql'.");
        
        $this->addSql("CREATE SEQUENCE sylius_cart_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE sip_content_cart_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE sip_content_cart_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE TABLE sylius_cart (id INT NOT NULL, locked BOOLEAN NOT NULL, total_items INT NOT NULL, total NUMERIC(10, 2) NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE TABLE sip_content_cart (id INT NOT NULL, locked BOOLEAN NOT NULL, total_items INT NOT NULL, total NUMERIC(10, 2) NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE TABLE sip_content_cart_item (id INT NOT NULL, cart_id INT NOT NULL, quantity INT NOT NULL, unit_price NUMERIC(10, 2) NOT NULL, total NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_D60695FB1AD5CDBF ON sip_content_cart_item (cart_id)");
        $this->addSql("ALTER TABLE sip_content_cart_item ADD CONSTRAINT FK_D60695FB1AD5CDBF FOREIGN KEY (cart_id) REFERENCES sip_content_cart (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql", "Migration can only be executed safely on 'postgresql'.");
        
        $this->addSql("ALTER TABLE sip_content_cart_item DROP CONSTRAINT FK_D60695FB1AD5CDBF");
        $this->addSql("DROP SEQUENCE sylius_cart_id_seq");
        $this->addSql("DROP SEQUENCE sip_content_cart_id_seq");
        $this->addSql("DROP SEQUENCE sip_content_cart_item_id_seq");
        $this->addSql("CREATE SEQUENCE acl_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE acl_classes_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE acl_security_identities_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE acl_object_identities_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("DROP TABLE sylius_cart");
        $this->addSql("DROP TABLE sip_content_cart");
        $this->addSql("DROP TABLE sip_content_cart_item");
    }
}
