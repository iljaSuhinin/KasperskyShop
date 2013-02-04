<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130204005607 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql", "Migration can only be executed safely on 'postgresql'.");
        
        $this->addSql("CREATE SEQUENCE sylius_option_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE sylius_option_value_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE sylius_product_property_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE sylius_property_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE sylius_prototype_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE content_product_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE content_variant_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE TABLE sylius_option (id INT NOT NULL, name VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE TABLE sylius_option_value (id INT NOT NULL, option_id INT NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_E05AED9DA7C41D6F ON sylius_option_value (option_id)");
        $this->addSql("CREATE TABLE sylius_product_property (id INT NOT NULL, product_id INT NOT NULL, property_id INT NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_8109D8F34584665A ON sylius_product_property (product_id)");
        $this->addSql("CREATE INDEX IDX_8109D8F3549213EC ON sylius_product_property (property_id)");
        $this->addSql("CREATE TABLE sylius_property (id INT NOT NULL, name VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE TABLE sylius_prototype (id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE TABLE sylius_prototype_option (prototype_id INT NOT NULL, option_id INT NOT NULL, PRIMARY KEY(prototype_id, option_id))");
        $this->addSql("CREATE INDEX IDX_B458391B25998077 ON sylius_prototype_option (prototype_id)");
        $this->addSql("CREATE INDEX IDX_B458391BA7C41D6F ON sylius_prototype_option (option_id)");
        $this->addSql("CREATE TABLE sylius_prototype_property (prototype_id INT NOT NULL, property_id INT NOT NULL, PRIMARY KEY(prototype_id, property_id))");
        $this->addSql("CREATE INDEX IDX_99041F2A25998077 ON sylius_prototype_property (prototype_id)");
        $this->addSql("CREATE INDEX IDX_99041F2A549213EC ON sylius_prototype_property (property_id)");
        $this->addSql("CREATE TABLE content_product (id INT NOT NULL, image_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_C42DD1E989D9B62 ON content_product (slug)");
        $this->addSql("CREATE INDEX IDX_C42DD1E3DA5256D ON content_product (image_id)");
        $this->addSql("CREATE TABLE sylius_product_option (product_id INT NOT NULL, option_id INT NOT NULL, PRIMARY KEY(product_id, option_id))");
        $this->addSql("CREATE INDEX IDX_E4C0EBEF4584665A ON sylius_product_option (product_id)");
        $this->addSql("CREATE INDEX IDX_E4C0EBEFA7C41D6F ON sylius_product_option (option_id)");
        $this->addSql("CREATE TABLE content_variant (id INT NOT NULL, product_id INT NOT NULL, is_master BOOLEAN NOT NULL, presentation VARCHAR(255) DEFAULT NULL, available_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_2E4B661E4584665A ON content_variant (product_id)");
        $this->addSql("CREATE TABLE sylius_variant_option_value (variant_id INT NOT NULL, option_value_id INT NOT NULL, PRIMARY KEY(variant_id, option_value_id))");
        $this->addSql("CREATE INDEX IDX_C2666DC93B69A9AF ON sylius_variant_option_value (variant_id)");
        $this->addSql("CREATE INDEX IDX_C2666DC9D957CA06 ON sylius_variant_option_value (option_value_id)");
        $this->addSql("ALTER TABLE sylius_option_value ADD CONSTRAINT FK_E05AED9DA7C41D6F FOREIGN KEY (option_id) REFERENCES sylius_option (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_product_property ADD CONSTRAINT FK_8109D8F34584665A FOREIGN KEY (product_id) REFERENCES content_product (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_product_property ADD CONSTRAINT FK_8109D8F3549213EC FOREIGN KEY (property_id) REFERENCES sylius_property (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_prototype_option ADD CONSTRAINT FK_B458391B25998077 FOREIGN KEY (prototype_id) REFERENCES sylius_prototype (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_prototype_option ADD CONSTRAINT FK_B458391BA7C41D6F FOREIGN KEY (option_id) REFERENCES sylius_option (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_prototype_property ADD CONSTRAINT FK_99041F2A25998077 FOREIGN KEY (prototype_id) REFERENCES sylius_prototype (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_prototype_property ADD CONSTRAINT FK_99041F2A549213EC FOREIGN KEY (property_id) REFERENCES sylius_property (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE content_product ADD CONSTRAINT FK_C42DD1E3DA5256D FOREIGN KEY (image_id) REFERENCES content_media_media (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_product_option ADD CONSTRAINT FK_E4C0EBEF4584665A FOREIGN KEY (product_id) REFERENCES content_product (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_product_option ADD CONSTRAINT FK_E4C0EBEFA7C41D6F FOREIGN KEY (option_id) REFERENCES sylius_option (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE content_variant ADD CONSTRAINT FK_2E4B661E4584665A FOREIGN KEY (product_id) REFERENCES content_product (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_variant_option_value ADD CONSTRAINT FK_C2666DC93B69A9AF FOREIGN KEY (variant_id) REFERENCES content_variant (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_variant_option_value ADD CONSTRAINT FK_C2666DC9D957CA06 FOREIGN KEY (option_value_id) REFERENCES sylius_option_value (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sip_content_cart_item ADD variant_id INT NOT NULL");
        $this->addSql("ALTER TABLE sip_content_cart_item ADD CONSTRAINT FK_D60695FB3B69A9AF FOREIGN KEY (variant_id) REFERENCES content_variant (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("CREATE INDEX IDX_D60695FB3B69A9AF ON sip_content_cart_item (variant_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql", "Migration can only be executed safely on 'postgresql'.");
        
        $this->addSql("ALTER TABLE sylius_option_value DROP CONSTRAINT FK_E05AED9DA7C41D6F");
        $this->addSql("ALTER TABLE sylius_prototype_option DROP CONSTRAINT FK_B458391BA7C41D6F");
        $this->addSql("ALTER TABLE sylius_product_option DROP CONSTRAINT FK_E4C0EBEFA7C41D6F");
        $this->addSql("ALTER TABLE sylius_variant_option_value DROP CONSTRAINT FK_C2666DC9D957CA06");
        $this->addSql("ALTER TABLE sylius_product_property DROP CONSTRAINT FK_8109D8F3549213EC");
        $this->addSql("ALTER TABLE sylius_prototype_property DROP CONSTRAINT FK_99041F2A549213EC");
        $this->addSql("ALTER TABLE sylius_prototype_option DROP CONSTRAINT FK_B458391B25998077");
        $this->addSql("ALTER TABLE sylius_prototype_property DROP CONSTRAINT FK_99041F2A25998077");
        $this->addSql("ALTER TABLE sylius_product_property DROP CONSTRAINT FK_8109D8F34584665A");
        $this->addSql("ALTER TABLE sylius_product_option DROP CONSTRAINT FK_E4C0EBEF4584665A");
        $this->addSql("ALTER TABLE content_variant DROP CONSTRAINT FK_2E4B661E4584665A");
        $this->addSql("ALTER TABLE sylius_variant_option_value DROP CONSTRAINT FK_C2666DC93B69A9AF");
        $this->addSql("ALTER TABLE sip_content_cart_item DROP CONSTRAINT FK_D60695FB3B69A9AF");
        $this->addSql("DROP SEQUENCE sylius_option_id_seq");
        $this->addSql("DROP SEQUENCE sylius_option_value_id_seq");
        $this->addSql("DROP SEQUENCE sylius_product_property_id_seq");
        $this->addSql("DROP SEQUENCE sylius_property_id_seq");
        $this->addSql("DROP SEQUENCE sylius_prototype_id_seq");
        $this->addSql("DROP SEQUENCE content_product_id_seq");
        $this->addSql("DROP SEQUENCE content_variant_id_seq");
        $this->addSql("CREATE SEQUENCE acl_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE acl_classes_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE acl_security_identities_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE acl_object_identities_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("DROP TABLE sylius_option");
        $this->addSql("DROP TABLE sylius_option_value");
        $this->addSql("DROP TABLE sylius_product_property");
        $this->addSql("DROP TABLE sylius_property");
        $this->addSql("DROP TABLE sylius_prototype");
        $this->addSql("DROP TABLE sylius_prototype_option");
        $this->addSql("DROP TABLE sylius_prototype_property");
        $this->addSql("DROP TABLE content_product");
        $this->addSql("DROP TABLE sylius_product_option");
        $this->addSql("DROP TABLE content_variant");
        $this->addSql("DROP TABLE sylius_variant_option_value");
        $this->addSql("ALTER TABLE sip_content_cart_item DROP variant_id");
        $this->addSql("DROP INDEX IDX_D60695FB3B69A9AF");
    }
}
